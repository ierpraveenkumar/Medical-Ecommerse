<!-- resources/views/orders/manage.blade.php -->

@extends('Layouts.master')

@section('head')
    {{-- Add any head content here --}}
@endsection

@section('content')
    <div class="container mx-auto my-10 p-6 bg-white rounded-md shadow-md">
        {{-- for handeling error lable from --}}
        @if (session('errormessage'))
            <div style="background: hsl(24, 87%, 42%)" class="alert">
                {{ session('errormessage') }}
            </div>
        @endif

        {{-- display error message for no rows selected for prescription --}}
        @if (session('error'))
            <div style="background: hsl(138, 94%, 49%)" class="alert">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div style="background: hsl(36, 90%, 41%)" class="alert">
                {{ session('success') }}
            </div>
        @endif


        {{-- display error message for no rows selected for error (ship to) --}}
        @if (session('errorshipto'))
            <div style="background: hsl(226, 94%, 46%)" class="alert">
                {{ session('errorshipto') }}
            </div>
        @endif

        {{-- display error message for no rows selected for  invoice --}}
        @if (session('errorinvoice'))
            <div style="background: hsl(224, 83%, 12%)" class="alert">
                {{ session('errorinvoice') }}
            </div>
        @endif


        <h1 class="text-2xl font-semibold mb-6">Manage Latest Orders</h1>

        <!-- Action buttons -->
        <div class="flex space-x-4 mb-4">
            <button type="button" id="formsub" style="background-color: #5318dfdc; "
                class="bg-pink-500 text-white px-4 py-2 rounded-md">Export
                selected Order CSV</button>



            <style>
                #importForm input[type="file"] {
                    display: none;
                }

                #importForm {
                    cursor: pointer;
                }

                #chooseFileText {
                    color: red;
                    cursor: pointer;
                }
            </style>

            <form class="bg-blue-500 text-white px-4 py-2 rounded-md" id="importForm" action="{{ route('orders.import') }}"
                method="post" enctype="multipart/form-data">
                @csrf
                <div id="chooseFileText" onclick="chooseFile()">
                    Choose File
                </div>
                <input type="file" name="csv_file" id="fileInput" accept=".csv" onchange="handleFileChange()">
                <button type="submit">Import Order CSV</button>
            </form>

            <script>
                function chooseFile() {
                    document.getElementById('fileInput').click();
                }

                function handleFileChange() {
                    // Your existing file change handling logic
                }
            </script>





            <button id="bulkExportButton" type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-md">Bulk Export
                Prescription</button>



            <button id="selectedinvoice" class="bg-indigo-500 text-white px-4 py-2 rounded-md" class="text-white">Download
                Invoice</button>
            <button id="shippingfrom" class="bg-purple-500 text-white px-4 py-2 rounded-md" class="text-white">Export
                Shipping Label From</button>
            <button id="shippingto" class="bg-pink-500 text-white px-4 py-2 rounded-md" class="text-white">Export Shipping
                Label To</button>

        </div>


        <form id="submit-order-form" class="submit-order-form" method="post">
            @csrf
            <input type="hidden" name="ids" id="ids" value="">
            {{-- <button type="submit" class="bg-pink-500 text-white px-4 py-2 rounded-md">Export selected Order CSV</button> --}}
            <!-- Orders Table -->
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-800 text-white border-b">
                    <tr>
                        <th class="py-2 px-4"><input type="checkbox" id="selectAll"></th>
                        <th class="py-2 px-4">Order Id</th>
                        <th class="py-2 px-4">Name</th>
                        <th class="py-2 px-4">Address</th>
                        <th class="py-2 px-4">Invoice Number</th>
                        <th class="py-2 px-4">Order Date</th>
                        <th class="py-2 px-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Replace the following rows with your actual data -->

                    {{-- {{ dd($leads->toArray())}} --}}
                    @foreach ($leads as $lead)
                        {{-- {{ dd($lead) }} --}}
                        @if ($lead->order)
                            <tr>
                                <td class="py-2 px-4"><input type="checkbox" name="selectedOrders[]"
                                        value="{{ $lead->order->id }}"></td>
                                <td class="py-2 px-4">{{ $lead->order->id ?? '' }}</td>
                                <td class="py-2 px-4">{{ $lead->first_name }} {{ $lead->last_name }}</td>
                                <td class="py-2 px-4">{{ $lead->order->shipping_address ?? '' }}</td>
                                <td class="py-2 px-4">{{ $lead->order->invoice->id ?? '' }}</td>
                                <td class="py-2 px-4">{{ $lead->order->created_at->format('d-m-Y') ?? '' }}</td>
                                <td> <a class="py-2 px-4"
                                        href="{{ route('show-latest-order', $lead->order->id) }}">View</a></td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </form>






        @if (session('fail'))
            <script>
                alert("{{ session('fail') }}");
            </script>
        @endif


        {{-- to select checkboxes --}}
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

        <script>
            document.getElementById('selectAll').addEventListener('change', function() {
                const checkboxes = document.querySelectorAll('input[name="selectedOrders[]"]');
                checkboxes.forEach(checkbox => {
                    checkbox.checked = !checkbox.checked;
                });
            });
        </script>


        {{-- this function is for export selected orders --}}

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#formsub').click(function(e) {
                    e.preventDefault(); // Prevent default form submission

                    //if no rows selected
                    if ($('input[name="selectedOrders[]"]:checked').length === 0) {
                        alert('Please select at least one row.');

                    }
                    //if rows selected
                    else {


                        // Serialize form data
                        var formData = $('#submit-order-form').serialize();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        // Send AJAX request
                        $.ajax({
                            url: '{{ route('orders.exportSelected') }}',
                            type: 'POST',
                            data: formData,
                            success: function(response) {
                                console.log(response);
                                var downloadLink = document.createElement('a');
                                downloadLink.href = 'data:text/csv;charset=utf-8,' +
                                    encodeURIComponent(
                                        response);
                                downloadLink.download = 'exported_data.csv';
                                downloadLink.style.display = 'none';

                                // Append the anchor to the body and trigger the download
                                document.body.appendChild(downloadLink);
                                downloadLink.click();
                                document.body.removeChild(downloadLink);

                                // Handle success response

                            },
                            error: function(xhr, status, error) {
                                // Handle error response
                                console.error(xhr.responseText);
                            }
                        });

                    }
                });
            });
        </script>









        <script>
            /**
             * this function is used to importing csv file 
             */
            function handleFileChange() {
                // Get the form and file input
                var form = document.getElementById('importForm');
                var fileInput = document.querySelector('input[name="csv_file"]');

                // Check if a file is selected
                if (fileInput.files.length > 0) {
                    // Create a FormData object to store the file data
                    var formData = new FormData(form);

                    // Send an AJAX request to submit the form
                    fetch(form.action, {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => {
                            if (!response.ok) {
                                // If the response is not successful, throw an error
                                throw new Error('Network response was not ok');
                            }
                            // Parse the JSON response
                            return response.json();
                        })
                        .then(data => {
                            // Handle the response data (if needed)
                            console.log(data);

                            // Display success or error message based on response
                            if (data.message) {
                                alert(data.message);
                            } else if (data.error) {
                                alert(data.error);
                            } else {
                                alert('Unexpected response format');
                            }
                        })
                        .catch(error => {
                            // Handle network or other errors
                            console.error('Error:', error);
                            alert('An error occurred during the import process so please check and then try...');
                        });
                }
            }
        </script>













        {{-- this is for bulk export prescription --}}


        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Get the form element
                var form = document.getElementById('submit-order-form');

                // Get the bulk export button
                var bulkExportButton = document.getElementById('bulkExportButton');

                // Add event listener to the bulk export button
                bulkExportButton.addEventListener('click', function() {
                    // Get the selected order IDs
                    var selectedOrderIds = [];
                    document.querySelectorAll('input[name="selectedOrders[]"]:checked').forEach(function(
                        checkbox) {
                        selectedOrderIds.push(checkbox.value);
                    });

                    // Set the selected order IDs as a comma-separated string to the hidden input field
                    var idsInput = document.getElementById('ids');
                    idsInput.value = selectedOrderIds.join(',');

                    // Submit the form
                    form.method = 'post'; // Change the method to POST
                    form.action =
                        '{{ route('bulk.export.prescription') }}'; // Change the action to the desired route
                    form.submit();
                });
            });
        </script>



        {{-- this is for shipping lable from --}}

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Get the form element
                var form = document.getElementById('submit-order-form');

                // Get the bulk export button
                var shippingfrom = document.getElementById('shippingfrom');

                // Add event listener to the bulk export button
                shippingfrom.addEventListener('click', function() {
                    // Get the selected order IDs
                    var selectedOrderIds = [];
                    document.querySelectorAll('input[name="selectedOrders[]"]:checked').forEach(function(
                        checkbox) {
                        selectedOrderIds.push(checkbox.value);
                    });

                    // Set the selected order IDs as a comma-separated string to the hidden input field
                    var idsInput = document.getElementById('ids');
                    idsInput.value = selectedOrderIds.join(',');

                    // Submit the form
                    form.method = 'post'; // Change the method to POST
                    form.action =
                        '{{ route('export.shipping.lable.from') }}'; // Change the action to the desired route
                    form.submit();
                });
            });
        </script>



        {{-- this is for shipping lable to --}}

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Get the form element
                var form = document.getElementById('submit-order-form');

                // Get the bulk export button
                var shippingfrom = document.getElementById('shippingto');

                // Add event listener to the bulk export button
                shippingfrom.addEventListener('click', function() {
                    // Get the selected order IDs
                    var selectedOrderIds = [];
                    document.querySelectorAll('input[name="selectedOrders[]"]:checked').forEach(function(
                        checkbox) {
                        selectedOrderIds.push(checkbox.value);
                    });

                    // Set the selected order IDs as a comma-separated string to the hidden input field
                    var idsInput = document.getElementById('ids');
                    idsInput.value = selectedOrderIds.join(',');

                    // Submit the form
                    form.method = 'post'; // Change the method to POST
                    form.action =
                        '{{ route('export.shipping.lable.to') }}'; // Change the action to the desired route
                    form.submit();
                });
            });
        </script>



        {{-- this is for invoice selected --}}

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Get the form element
                var form = document.getElementById('submit-order-form');

                // Get the bulk export button
                var selectedinvoice = document.getElementById('selectedinvoice');

                // Add event listener to the bulk export button
                selectedinvoice.addEventListener('click', function() {
                    // Get the selected order IDs
                    var selectedOrderIds = [];
                    document.querySelectorAll('input[name="selectedOrders[]"]:checked').forEach(function(
                        checkbox) {
                        selectedOrderIds.push(checkbox.value);
                    });

                    // Set the selected order IDs as a comma-separated string to the hidden input field
                    var idsInput = document.getElementById('ids');
                    idsInput.value = selectedOrderIds.join(',');

                    // Submit the form
                    form.method = 'post'; // Change the method to POST
                    form.action = '{{ route('orders.invoices') }}'; // Change the action to the desired route
                    form.submit();
                });
            });
        </script>

    </div>
    <div style="display: none">
        <a href="{{ route('razorpay') }}">Checkout via razorpay</a>
        <a href="{{ route('createTransaction') }}">Checkout via paypal</a>
    </div>
@endsection

@section('footer')
    {{-- Add any footer content here --}}
@endsection
{{-- https://medium.com/geekculture/paypal-payment-gateway-integration-with-laravel-ebebc7ccf470 --}}

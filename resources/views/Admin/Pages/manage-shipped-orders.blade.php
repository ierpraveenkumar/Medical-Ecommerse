@extends('Layouts.master')

@section('head')
    {{-- Add any head content here --}}
@endsection

@section('content')
    <div class="container mx-auto my-10 p-6 bg-white rounded-md shadow-md">
        <h1 class="text-2xl font-semibold mb-6">Manage Shipped Orders</h1>

        <!-- Action buttons -->
        <div class="flex justify-end mb-4">
            <button id="invoicedownload" class="bg-indigo-500 text-white px-4 py-2 rounded-md mr-2">Download Invoice</button>
            <button id="exportshippedselected" class="bg-green-500 text-white px-4 py-2 rounded-md">Export</button>
            {{-- <a class="bg-green-500 text-white px-4 py-2 rounded-md" href="{{ route('export.selected.shipped') }}">Export</a> --}}
        </div>

        <!-- Date filter -->
        <form action="{{ route('admin.manage.shipped.orders') }}" method="get" class="mb-4">
            @csrf
            <div class="flex mb-4 items-center">
                <span class="mr-2">Filter By Date From</span>
                <input type="date" class="border rounded-md p-2 mr-2" name="start_date"
                    value="{{ request('start_date') }}">
                <span class="mr-2">To</span>
                <input type="date" class="border rounded-md p-2" name="end_date" value="{{ request('end_date') }}">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Filter</button>
            </div>
        </form>



        <form id="submit-order-form" class="submit-order-form" method="post">
            @csrf
            <!-- Shipped Orders Table -->
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-800 text-white border-b">
                    <tr>
                        <th class="py-2 px-4"><input type="checkbox" id="selectAll"></th>
                        <th class="py-2 px-4">Order Id</th>
                        <th class="py-2 px-4">Address</th>
                        <th class="py-2 px-4">Invoice Number</th>
                        <th class="py-2 px-4">Invoice Date</th>
                        <th class="py-2 px-4">Tracking No</th>
                        <th class="py-2 px-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- {{ dd($orders->toArray()) }} --}}
                    @foreach ($orders as $order)
                        <!-- Your HTML code to display each order goes here -->
                        @if ($order->invoice)
                            <tr>
                                <td class="py-2 px-4"><input type="checkbox" name="selectedOrders[]"
                                        value="{{ $order->id }}"></td>
                                <td class="py-2 px-4">{{ $order->id }}</td>
                                <td class="py-2 px-4">{{ $order->shipping_address }}</td>
                                <td class="py-2 px-4">{{ $order->invoice->id }}</td>
                                <td class="py-2 px-4">{{ $order->invoice->created_at->format('d-m-Y') }}</td>
                                <td class="py-2 px-4">
                                    {{ app('App\Http\Controllers\AdminController')->generateTrackingId($order->invoice->id) }}
                                </td>
                                <td class="py-2 px-4"><a href="{{ route('manage-shipped-view', $order->id) }}"
                                        class="text-blue-500">View</a></td>
                            </tr>
                        @endif
                    @endforeach

                </tbody>
            </table>

        </form>
    </div>


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <script>
        document.getElementById('selectAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('input[name="selectedOrders[]"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = !checkbox.checked;
            });
        });
    </script>




<script>
    $(document).ready(function() {
        $('#invoicedownload').click(function(e) {
            e.preventDefault();

            // Check if at least one row is selected
            if ($('input[name="selectedOrders[]"]:checked').length === 0) {
                alert('Please select at least one row.');
            } else {
                // Serialize form data
                var formData = $('#submit-order-form').serialize();

                // Get an array of selected checkbox IDs
                var selectedIds = $('input[name="selectedOrders[]"]:checked').map(function() {
                    return this.value; // Assuming checkbox value is the ID
                }).get();

                // Print the selected IDs to the console
                console.log('Selected IDs:', selectedIds);

                // Make an AJAX request
                $.ajax({
                    url: '{{ route('orders.invoices.shipped') }}',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        console.log(response);

                        if (response.url) {
                            window.location.href = response.url; // Redirect to the provided URL
                        } else {
                            alert('Unexpected response from the server.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('An error occurred during the request.');
                    }
                });
            }
        });
    });
</script>





<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#exportshippedselected').click(function(e) {
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
                    url: '{{ route('export.selected.shipped') }}',
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
                        alert('hiii');

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






@endsection

@section('footer')
    {{-- Add any footer content here --}}
@endsection

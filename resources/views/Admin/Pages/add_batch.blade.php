@extends('Layouts.master')

@section('head')
    <!-- Additional head content goes here if needed -->
@endsection

@section('content')
    <div class="max-w-2xl mx-auto my-8 p-8 bg-white rounded shadow-lg">
        <form action="{{ route('add.batch') }}" method="post">
            @csrf

            <table id="batchTable" class="w-full border-collapse border border-gray-300 mb-2">
                <thead>
                    <tr>
                        <th class="p-2">Product Name</th>
                        <th class="p-2">Product Type</th>
                        <th class="p-2">Batch Number</th>
                        <th class="p-2">Quantity</th>
                        <th class="p-2">MFG Date</th>
                        <th class="p-2">Expiry Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="p-2"><input type="text" name="product_name[]" value="Khushi MT Kit"
                                class="w-full p-2 border border-gray-300 rounded"></td>
                        <td class="p-2"><input type="text" name="product_type[]" value="Kit"
                                class="w-full p-2 border border-gray-300 rounded"></td>
                        <td class="p-2"><input type="text" name="batch_no[]"
                                class="w-full p-2 border border-gray-300 rounded"></td>
                        <td class="p-2"><input type="number" name="quantity[]"
                                class="w-full p-2 border border-gray-300 rounded"></td>
                        <td class="p-2"><input type="date" name="mfg_date[]"
                                class="w-full p-2 border border-gray-300 rounded"> </td>
                        <td class="p-2"><input type="date" name="expiry_date[]"
                                class="w-full p-2 border border-gray-300 rounded"> </td>
                    </tr>
                </tbody>
            </table>

           

            <button type="button" onclick="addRow()"
                class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">Add Row</button>
            <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">Add
                Batch</button>
        </form>
    </div>

    <script>
        function addRow() {
            var table = document.getElementById("batchTable").getElementsByTagName('tbody')[0];
            var newRow = table.insertRow(table.rows.length);
            var cols = 6;

            for (var i = 0; i < cols; i++) {
                var input = document.createElement("input");
                input.type = i == 0 ? "text" : i == 3 ? "number" : "text";
                input.name = i == 0 ? "product_name[]" : i == 1 ? "product_type[]" : i == 2 ? "batch_no[]" : i == 3 ?
                    "quantity[]" : i == 4 ? "mfg_date[]" : "expiry_date[]";
                input.className = "w-full p-2 border border-gray-300 rounded";
                if (i == 4 || i == 5) {
                    input.type = "date";
                }
                var cell = newRow.insertCell(i);
                cell.appendChild(input);
            }
        }
    </script>




@endsection



@section('footer')
    <!-- Additional footer content goes here if needed -->
@endsection

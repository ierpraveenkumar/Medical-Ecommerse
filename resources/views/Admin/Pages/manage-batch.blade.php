@extends('Layouts.master')

@section('head')
<!-- Add any specific styles/scripts for this page in the head section if needed -->
<style>
    .batch-button {
        display: inline-block;
        background-color: #3498db;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        font-size: 16px;
        margin-bottom: 20px;
        border-radius: 8px;
        transition: background-color 0.3s ease;
        float: right;
    }

    .batch-button:hover {
        background-color: #2980b9;
    }

    .batches-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .batches-table th,
    .batches-table td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }

    .batches-table th {
        background-color: #2c3e50;
        color: white;
    }

    .batches-table tbody tr:nth-child(even) {
        background-color: #ecf0f1;
    }

    .batches-table tbody tr:hover {
        background-color: #bdc3c7;
    }

    .add-batch-form {
        display: none;
        margin-top: 20px;
    }
</style>
@endsection


@section('content')
<div class="container mx-auto my-10 p-6 bg-white rounded-md shadow-md">
    <h1 class="text-2xl font-semibold mb-6">Manage Batches</h1>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <a href="{{ route('add.batch.form') }}" class="batch-button" >Add Batch</a>


    <table class="batches-table">
        <!-- Table header goes here -->
        <thead>
            <tr>
                <th>Batch No</th>
                <th>Batch Import Date</th>
                <th>Product Name</th>
                <th>MFG Date</th>
                <th>Expiry Date</th>
                <th>Quantity</th>
                <th>Product Type</th>
                <th>Batch Status</th>
            </tr>
        </thead>
    
        <tbody>
            @foreach($batches as $batch)
            <tr>
                <td>{{ $batch->batch_no }}</td>
                <td>{{ $batch->batch_import_date }}</td>
                <td>{{ optional($batch->products)->name }}</td>
                <td>{{ $batch->mfg_date }}</td>
                <td>{{ $batch->expiry_date }}</td>
                <td>{{ optional($batch->products)->quantity }}</td>
                <td>{{ $batch->product_type }}</td>
                <td>{{ $batch->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
   

    
    
    
    <div class="pagination">
        {{ $batches->links() }}
    </div>
</div>


@endsection

@section('footer')
<!-- Add any specific scripts for this page in the footer section if needed -->
@endsection
@extends('Layouts.master')

@section('content')
    <div style="background-color: rgb(190, 196, 105); padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);">
        <h1 style="font-size: 24px; color: rgb(90, 33, 37);">Notifications</h1>
        <br><br><br>

        @foreach ($admin->notifications as $notification)
            <div style="margin-bottom: 20px; padding: 10px; border: 1px solid rgba(8, 186, 209, 0.918); border-radius: 5px; transition: all 0.3s;">
                <p style="color: rgba(9, 24, 235, 0.918); font-weight: bold; margin-bottom: 5px;">New Product Created:</p>
                @foreach ($notification->data['product_data']['product_name'] as $key => $product_name)
                    <p style="margin-bottom: 5px;">Product Name: {{ $product_name }}</p>
                    <p style="margin-bottom: 5px;">Batch No: {{ $notification->data['product_data']['batch_no'][$key] ?? 'N/A' }}</p>
                @endforeach
                <p style="margin-bottom: 5px;">Created At: {{ $notification->created_at->format('d-m-Y') }}</p>
            </div>
        @endforeach
    </div>
@endsection

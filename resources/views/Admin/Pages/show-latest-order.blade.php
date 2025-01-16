@extends('Layouts.master')

@section('content')
    <div style="margin: 40px">
      
            <div style="color: blue">
                <span>Order Id :</span>
                <span>{{ $data->id }}</span>
            </div>
            <div style="color: blue">
                <br><br><br>
                <span>Billing Address :</span>
                <span>{{ $data->billing_address }}</span>
            </div>
            <div style="color: blue">
                <br><br><br>
                <span>Order Date :</span>
                <span>{{ $data->created_at->format('d-m-Y') }}</span>
            </div>
        
          
    </div>
@endsection



@extends('Layouts.master')

@section('content')
<div style="margin:40px">
<div style="color: rgb(102, 151, 102)">
    <span>Order Id :</span>
    <span>{{ $data->id }}</span>
   
</div>

<div style="color: rgb(100, 139, 100)">
    <span>Shipping  Address :</span>

    <span>{{ $data->shipping_address }}</span>
</div>
<div style="color: rgb(83, 121, 83)">
    <span> Shipping Date  Started On: </span>
    <span>{{ $data->created_at->format('d-m-Y') }}</span>
</div>

</div>
@endsection
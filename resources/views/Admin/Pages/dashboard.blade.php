@extends('Layouts.master')

@section('head')
    <!-- Additional head content goes here -->
@endsection

@section('content')
    <div class="main-content flex flex-col flex-grow p-4">
        <h1 class="font-bold text-2xl text-gray-700">Dashboard</h1>
        <div class="grid grid-cols-2 gap-4 p-8">
            <a href="#">
                <div class="bg-gray-500 text-white py-12 text-center rounded-3xl">
                    <h1 class="text-7xl font-bold">{{ $todaysOrdersCount }}</h1>
                    <h2 class="text-3xl font-medium">Today's Orders</h2>
                </div>
            </a>
            <a href="#">
                <div class="bg-gray-500 text-white py-12 text-center rounded-3xl">
                    <h1 class="text-7xl font-bold">{{ $pendingOrdersCount }}</h1>
                    <h2 class="text-3xl font-medium">Pending Orders</h2>
                </div>
            </a>
            <a href="#">
                <div class="bg-gray-500 text-white py-12 text-center rounded-3xl">
                    <h1 class="text-7xl font-bold">{{ $openLeadsCount }}</h1>
                    <h2 class="text-3xl font-medium">Open Leads</h2>
                </div>
            </a>
            <a href="#">
                <div class="bg-gray-500 text-white py-12 text-center rounded-3xl">
                    <h1 class="text-7xl font-bold">{{ $completedOrdersCount }}</h1>
                    <h2 class="text-3xl font-medium">Completed Orders</h2>
                </div>
            </a>
        </div>
    </div>
@endsection

@section('footer')
    <!-- Additional footer content goes here -->
@endsection

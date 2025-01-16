@extends('Layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Transactions</div>

                    <div class="card-body">
                        <p>Welcome to the transactions page!</p>
                        
                        <!-- PayPal Transaction Process Button -->
                        <form  method="GET" action="{{ route('processTransaction') }}">
                            <button style="background-color: blue" type="submit" class="btn btn-success">Process Transaction</button>
                        </form>
                        
                        <!-- Success and Error Messages -->
                        @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    
                    @if(session()->has('email_sent_message'))
                        <div class="alert alert-success">
                            {{ session()->get('email_sent_message') }}
                        </div>
                    @endif
                    
                        
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

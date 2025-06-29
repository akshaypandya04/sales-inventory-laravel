@extends('layouts.master')
@section('title', 'Payment Details | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')


    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-file-text-o"></i>  Details</h1>
                <p>A Printable Payment Details</p>  <br>

            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Payment</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <section class="invoice">
                        <div class="row mb-12">
                            <div class="col-6">
                                <h2 class="page-header"><img width="30%;" class="img-fluid" src="{{ asset('images/atal.jpg') }}" alt="User Image"></h2>
                            </div>
                            <div class="col-6">
                                <h5 class="text-right">Date: {{$payments->date}}</h5>


                            </div>
                        </div>

                        <div class="row invoice-info">
                            
                            
<div class="col-6">
    <div class="card p-3 shadow-sm">
        <h5 class="mb-3">Customer Details</h5>
        <address class="mb-2">
            <strong class="d-block mb-1">Name:</strong> 
            <span class="text-muted">{{$customers->customer_name}}</span><br>

            <strong class="d-block mt-2 mb-1">Mobile No.:</strong> 
            <span class="text-muted">{{$customers->mobile}}</span><br>

            <strong class="d-block mt-2 mb-1">City:</strong> 
            <span class="text-muted">{{$customers->city}}</span><br>

            <strong class="d-block mt-2 mb-1">Address:</strong> 
            <span class="text-muted">{{$customers->address}}</span><br>

            <strong class="d-block mt-2 mb-1">Email ID:</strong> 
            <span class="text-muted">{{$customers->email_id}}</span><br>

            <strong class="d-block mt-2 mb-1">Document:</strong>
            @if($customers->document)
                <a href="{{ asset('uploads/customers/' . $customers->document) }}" class="btn btn-sm btn-primary mt-1" target="_blank">
                    View Attachment
                </a>
            @else
                <span class="text-muted">No document uploaded</span>
            @endif
        </address>
    </div>
</div>

<div class="col-6">
    <div class="card p-3 shadow-sm">
        <h5 class="mb-3">Payment Details</h5>
        <address class="mb-2">
            <strong class="d-block mb-1">Amount:</strong> 
            <span class="text-muted">{{$payments->amount}}</span><br>

            <strong class="d-block mt-2 mb-1">Recived Amount:</strong> 
            <span class="text-muted">{{$payments->recived_amount}}</span><br>

            <strong class="d-block mt-2 mb-1">Due Amount:</strong> 
            <span class="text-muted">{{$payments->due_amount}}</span><br>

            <strong class="d-block mt-2 mb-1">Date:</strong> 
            <span class="text-muted">{{$payments->date}}</span><br>

            <strong class="d-block mt-2 mb-1">Product Name:</strong> 
            <span class="text-muted">{{$payments->product_name}}</span><br>

        </address>
    </div>
</div>
                        </div>
                       
                                           </section>
                </div>
            </div>
        </div>
    </main>

@endsection


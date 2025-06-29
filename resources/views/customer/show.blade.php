@extends('layouts.master')
@section('title', 'Customer Details | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')


    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-file-text-o"></i> Customer Details</h1>
                <p>Customer Details</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Customer Details</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <section class="invoice">
                        <div class="row mb-4">
                            <div class="col-6">
                                    <h2 class="page-header"><img width="30%;" class="img-fluid" src="{{ asset('images/atal.jpg') }}" alt="User Image"></h2>
                            </div>
                            <div class="col-6">
                                <h5 class="text-right">Joined Date: {{$customers->created_at->format('Y-m-d')}}</h5>

                            </div>
                        </div>

                        <div class="row invoice-info">
                           <div class="col-12">
    <div class="card p-3 shadow-sm">
        <h5 class="mb-3">Customer Details</h5>
        <address class="mb-2">
            <strong class="d-block mb-1">Name:</strong> 
            <span class="text-muted">{{$customers->name}}</span><br>

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


                        </div>

                    </section>
                </div>
            </div>

                <div class="col-md-12">
                <div class="tile">
                    <section class="invoice">

                              <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped table-bordered">
    <thead class="text-white" style="background-color:#d6ba4b;">
        <tr>
            <th>Date</th>
            <th>Amount</th>
            <th>Due Amount</th>
            <th>Received Amount</th>
            <th>Payment Status</th>
            <th>Invoice</th>
        </tr>
    </thead>

    <tbody>
        @foreach($payments as $payment)
            <tr>
                <td>{{ $payment->date }}</td>
                <td>{{ number_format($payment->amount, 2) }}</td>
                <td>{{ number_format($payment->due_amount, 2) }}</td>
                <td>{{ number_format($payment->recived_amount, 2) }}</td>
                <td>
                    @if($payment->due_amount == 0)
                        <span class="badge badge-success">Paid</span>
                    @else
                        <span class="badge badge-warning">Partial</span>
                    @endif
                </td>
                <td><a href="{{ route('payment.show', $payment->id) }}" class="btn btn-sm btn-primary" target="_blank">View</a></td>
            </tr>
        @endforeach
    </tbody>

    <tfoot style="background-color: aliceblue;">
        <tr>
            <th colspan="1">TOTAL</th>
            <th></th>
            <th>{{ number_format($due_sum, 2) }}</th>
            <th>{{ number_format($recived_sum, 2) }}</th>
            <th colspan="2"></th>
        </tr>
    </tfoot>
</table>

                            </div>
                        </div>

                    </section>
                </div>
            </div>



        </div>





    </main>

@endsection






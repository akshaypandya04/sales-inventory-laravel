@extends('layouts.master')
@section('title', 'Invoice | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')


    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-file-text-o"></i> Invoice</h1>
                <p>A Printable Invoice Format</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Invoice</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <section class="invoice">
                        <div class="row mb-4">
                            <div class="col-6">
                                <h2 class="page-header"><img width="30%;" class="img-fluid" src="{{ asset('images/user/'.Auth::user()->image) }}" alt="User Image"></h2>
                            </div>
                            <div class="col-6">
                                <h5 class="text-right">Date: {{date('d/m/Y | g:i a', strtotime($invoice->created_at)) }}</h5>
                            </div>
                        </div>


                        <div class="row" style="background-color:#fdb940; padding-top: 10px;">
                             <div class="col-6">
                               <h5> Retailer Details  </h5>
                             </div>

                             <div class="col-6">
                                   <h5> Account Details  </h5>
                             </div>
                        </div> <br>

                        <div class="row invoice-info">
                            <div class="col-6">

                                <address><strong>Name : Equity Enterprise</strong><br>Mobile No. : +48729667532<br>Email : equityenterprise@gmail.com</address>
                            </div>

                            <div class="col-6">

                                 <address><strong>Name : {{$invoice->name}}</strong><br>Bank Name : {{$invoice->bank_name}}<br>Account No : {{$invoice->account_no}}<br>IFSC CODE : {{$invoice->ifsc_code}}<br>Sender No. : {{$invoice->sender_no}}</address>
                             </div>

                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr style="background-color:#fdb940;">
                                        <th>Transcation Id</th>
                                        <th>Bank Ref no</th>
                                        <th>Method</th>
                                        <th>Status</th>
                                        <th>Amount</th>
                                     </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <td>{{$invoice->transcation_id}}</td>
                                        <td>{{$invoice->bank_ref_no}}</td>
                                        <td>{{$invoice->method}}</td>
                                        <td>{{$invoice->status}}</td>
                                        <td>Rs.{{$invoice->amount}}</td>

                                     </tr>

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td><b>Total</b></td>
                                        <td><b class="total">Rs.{{$invoice->amount}}</b></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row d-print-none mt-2">
                              <a href="http://wa.me/" target="_blank"> <img src="{{asset('/images/wa_high.png')}}" style="float:right; bottom:40px; width:56px; border:none;" alt="Whatsapp Now" title="Whatsapp Now">  </a>
                              <div class="col-12 text-right"><button class="btn btn-primary" onclick="window.print()"><i class="fa fa-print"></i> Print</button></div>
                        </div>
                        <hr>
                                <p style="text-align:center;"> Please check credit of amount in your account under 2 days then we not responsible Thanks Regards.</p>
                    </section>
                </div>
            </div>
        </div>
    </main>

@endsection
@push('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>

@endpush






@extends('layouts.master')
@section('title', 'Loan | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')


    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-file-text-o"></i> Loan</h1>
                <p>A Printable Loan Format</p>  <br>

            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Loan</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <section class="invoice">
                        <div class="row mb-4">
                            <div class="col-6">
                                <h2 class="page-header"><img width="30%;" class="img-fluid" src="{{ asset('images/rd-logo.png') }}" alt="User Image"></h2>
                            </div>
                            <div class="col-6">
                                <h5 class="text-right">Date: {{$loans->created_at->format('Y-m-d')}}</h5>


                            </div>
                        </div>


                        <div class="row" style="background-color:#d6ba4b; padding-top: 10px;">
                             <div class="col-6">
                               <h5> CUSTOMER DETAILS  </h5>
                             </div>

                             <div class="col-6">
                                   <h5> LOAN DETAILS  </h5>
                             </div>
                        </div> <br>

                        <div class="row invoice-info">
                            <div class="col-6">

                                <address><strong>Customer Name : {{ (!empty($customers->name) ? $customers->name : '')  }}</strong><br>Mobile No. : {{ (!empty($customers->mobile) ? $customers->mobile : '')  }}<br>Co Applicant Name : {{ (!empty($customers->co_applicant_name) ? $customers->co_applicant_name : '')  }} <br>City : {{ (!empty($customers->city) ? $customers->city : '')  }}<br>Property Address : {{ (!empty($customers->address) ? $customers->address : '')  }}<br>Status : {{ (!empty($customers->status) ? $customers->status : '')  }}<br>Agent : {{ (!empty($customers->agent_name) ? $customers->agent_name : '')  }}<br></address>
                            </div>

                            <div class="col-6">

                                 <address><strong>Loan Amount Senctioned : {{$loans->amount_senctioned}}</strong><br>Loan Amount Disbursed : {{$loans->amount_disbursed}}<br>Rate of interest : {{$loans->rate_interest}}<br>Tenor in month : {{$loans->tenor_month}}<br>Loan Product : {{$loans->vecale}}<br>Loan start Date : {{$loans->start_date}}<br>Loan End Date : {{$loans->end_date}}<br>EMI Amount : {{$loans->emi_amount}}</address>
                             </div>

                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr style="background-color:#d6ba4b;">

                                        <th>Date</th>
                                        <th>OUTSTING</th>
                                        <th>Debit Amount</th>
                                        <th>Interest</th>
                                        <th>Over due</th>
                                        <th>Installment</th>
                                        <th>Type</th>
                                        <th>Collection Name</th>
                                     </tr>
                                    </thead>
                                    <tbody>
                                        @php

                                        $today = $loans->start_date;

                                      $sum1 =0;
                                      $sum2 =0;
                                       $sum3 =0;
                                        @endphp

                                  @for($x = 0; $x <= $loans->tenor_month; $x++)


                                  @if ($x == 0)

                                 <tr>

                                        <td>
                                        {{$loans->start_date}}
                                        </td>
                                        <td>
                                       {{$loans->amount_senctioned}}
                                        </td>
                                        <td>
                                        0
                                        </td>
                                        <td>



                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>0</td>
                                        <td>

                                        </td>
                                    </tr>

                                  @else

                                    <tr>

                                        <td>
                                        @php
                                        $repeat = strtotime("+30 day",strtotime($today));
                                        $today = date('Y-m-d',$repeat);
                                        echo $today;
                                        @endphp
                                        </td>
                                        <td>
                                            @php
                                           $f = $loans->amount_senctioned;
                                           $s = $loans->tenor_month;
                                           $finall =    $f / $s;

                                           $finall = $finall * $x;

                                           @endphp


                                            {{$loans->amount_senctioned - $finall}}
                                        </td>
                                        <td>

                                           @php
                                           $f = $loans->amount_senctioned;
                                           $s = $loans->tenor_month;
                                           $sum1 +=     $f / $s;

                                                echo $f / $s;
                                           @endphp
                                        </td>
                                        <td>
                                             @php
                                           $f = $loans->amount_senctioned;
                                           $s = $loans->tenor_month;
                                           $final =    $f / $s;
                                           $f2 = $loans->emi_amount;
                                          echo $f2 -  $final;

                                          $sum2 += $f2 -  $final;

                                           @endphp


                                        </td>
                                        <td></td>
                                        <td>{{ $loans->emi_amount }}

                                        @php
                                        $sum3 += $loans->emi_amount;
                                        @endphp
                                        </td>
                                        <td>{{ $x }}</td>
                                        <td>
                                            {{ $loans->emi_amount * $x }}
                                        </td>
                                    </tr>

                                    @endif
                                    @endfor


                                    </tbody>
                                    <tfoot>
                                    <tr>

                                        <td></td>
                                        <td><b>Total</b></td>
                                        <td><b class="total">Rs.{{ $sum1 }}</b></td>
                                        <td><b class="total">Rs.{{ $sum2 }}</b></td>
                                        <td></td>
                                        <td><b class="total">Rs.{{ $sum3 }}</b></td>
                                    </tr>

                                    <tr>

                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Total collection amount</td>
                                         <td>Rs.{{ $sum3 }}</td>

                                    </tr>
                                       <tr>

                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Total principle amount</td>
                                         <td>Rs.{{ $sum1 }}</td>

                                    </tr>
                                      <tr>

                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Saving</td>
                                         <td>Rs {{ $sum3- $sum1 }}</td>

                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row d-print-none mt-2">
                           <a href="http://wa.me/+91{{ (!empty($customers->mobile) ? $customers->mobile : '')  }}" target="_blank"> <img src="{{asset('/images/wa_high.png')}}" style="float:right; bottom:40px; width:56px; border:none;" alt="Whatsapp Now" title="Whatsapp Now">  </a>
                            <div class="col-12 text-right"><button class="btn btn-primary" onclick="window.print()"><i class="fa fa-print"></i> Print</button></div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>

@endsection






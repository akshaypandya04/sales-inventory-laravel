@extends('layouts.master')

@section('titel', 'Loan Report| ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />

<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css" rel="stylesheet" />

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i>Loan Report</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Loan</li>
                <li class="breadcrumb-item active"><a href="#">Loan Report</a></li>
            </ul>
        </div>

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif


        <div class="">

               <form action="{{route('loan.filter')}}" method="GET">

            <div class="row">

                  <div class="col-md-3">
                      <lebal>Customer</lebal>
                       <select class="form-control" name="customer_id">
                       <option value="0">--select--</option>
                           @foreach($customers as $value)
                            <option value="{{$value->id}}" {{(($value->id==$request->customer_id) ? 'selected' : '')}}>
                                      {{$value->name}}
                            </option>
                           @endforeach
                       </select>
                  </div>

                   <div class="col-md-3">
                      <lebal>Loan Product</lebal>
                  <select class="form-control" name="vecale">
                                        <option value="">Select</option>

                                        <option value="Vehicle Loan" @if(!empty($_GET['vecale']) && $_GET['vecale']=='Vehicle Loan') selected @endif>Vehicle Loan</option>
                    					<option value="Gold Loan" @if(!empty($_GET['vecale']) && $_GET['vecale']=='Gold Loan') selected @endif>Gold Loan</option>
										<option value="Property Loan" @if(!empty($_GET['vecale']) && $_GET['vecale']=='Property Loan') selected @endif>Property Loan</option>
										<option value="Parsonal Loan" @if(!empty($_GET['vecale']) && $_GET['vecale']=='Parsonal Loan') selected @endif>Parsonal Loan</option>

                  </select>
              </div>

                  <div class="col-md-3">
                      <lebal>From</lebal>
                       <input type="date" class="form-control" name="start_date" value="{{ $request->start_date }}">
                  </div>

                    <div class="col-md-3">
                        <lebal>To</lebal>
                       <input type="date" class="form-control" name="end_date" value="{{ $request->end_date }}">
                  </div>

                    <div class="col-md-3">
                        <br>
                      <button class="btn btn-primary" type="submit">Filter</button>
                  </div>
            </div>


        </form>

        </div>

        <div class="row mt-2">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                         <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="example">
                            <thead>
                            <tr>
                                <th>Loan ID </th>
                                <th>Customer Name </th>
                                <th>Loan Senctioned</th>
                                <td>Amount Disbursed</td>
                                <td>Rate Interest</td>
                                <td>Month</td>
                                <td>EMI Amount</td>
                                <th>Loan Product</th>
                                <th>Start Date </th>
                                <th>End Date</th>

                            </tr>
                            </thead>
                             <tbody>

                             @foreach($invoices as $invoice)
                                 <tr>
                                     <td>{{$invoice->unique_no}}</td>
                                         <td>
                                        @if(!empty($invoice->customer->name))
                                                 {{$invoice->customer->name}}
                                        @else
                                        -
                                        @endif

                                         </td>
                                     <td>{{$invoice->amount_senctioned}}</td>
                                     <td>{{$invoice->amount_disbursed}}</td>
                                     <td>{{$invoice->rate_interest}} %</td>
                                     <td>{{$invoice->tenor_month}}</td>
                                     <td>{{$invoice->emi_amount}}</td>
                                     <td>{{$invoice->vecale}} </td>
                                     <td>{{$invoice->start_date}}</td>
                                     <td>{{$invoice->end_date}}</td>
                                 </tr>
                             @endforeach
                            </tbody>
                        </table>
                    </div> </div>
                </div>
            </div>
        </div>
    </main>



@endsection

@push('js')
    <script type="text/javascript" src="{{asset('/')}}js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{asset('/')}}js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>


<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>


    <script>

$(document).ready(function() {
    var table = $('#example').DataTable( {
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );

    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
} );

    </script>

@endpush

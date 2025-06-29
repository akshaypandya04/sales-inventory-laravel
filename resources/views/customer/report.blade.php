@extends('layouts.master')
@section('titel', 'Customer Report| ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />

<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css" rel="stylesheet" />    
    

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> Customer Report</h1>
            
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Customer</li>
                <li class="breadcrumb-item active"><a href="#">Customer Report</a></li>
            </ul>
        </div>
        
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        
        <div class="">
            
        <form action="{{route('customer.filter')}}" method="GET">
            
            <div class="row">
                
                  <div class="col-md-4">
                      <lebal>From</lebal>
                       <input type="date" class="form-control" name="start_date"  value="{{ request('start_date', \Carbon\Carbon::now()->format('Y-m-d')) }}">
                  </div>
                  
                    <div class="col-md-4">
                        <lebal>To</lebal>
                       <input type="date" class="form-control" name="end_date" value="{{ request('end_date', \Carbon\Carbon::now()->format('Y-m-d')) }}">
                  </div>
                  
                    <div class="col-md-4">
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
                                <th>Customer Name </th>
                                <th>Address </th>
                                <th>Mobile</th>
                                <th>City</th>
                                <th>Status</th>
                                <th>Joined Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $customers as $customer)
                            <tr>
                                <td>{{ $customer->name }} </td>
                                <td>{{ $customer->address }} </td>
                                <td>{{ $customer->mobile }} </td>
                                <td>{{ $customer->city }}</td>
                                <td>{{ $customer->status }}</td>
                                <td>  {{$customer->created_at}}</td>
                                
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

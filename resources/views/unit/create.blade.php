@extends('layouts.master')
@section('title', 'Rates | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i>Create Rates</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Rates</li>
                <li class="breadcrumb-item"><a href="#">Create Rates</a></li>
            </ul>
        </div>

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="">
            <a class="btn btn-primary" href="{{route('unit.index')}}"><i class="fa fa-edit"> Manage Rates</i></a>
        </div>
        <div class="row mt-2">

            <div class="clearix"></div>
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Rates</h3>
                    <div class="tile-body">
                        <form method="POST" action="{{route('unit.store')}}">
                            @csrf
                            
                            
                      <div class="row">      
                            <div class="form-group col-md-4">
                                <label class="control-label">Customer Name</label>
                                <input name="customer_name" class="form-control @error('customer_name') is-invalid @enderror" type="text" placeholder="Enter Customer Name" required>
                                @error('customer_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label class="control-label">INR</label>
                                <input name="inr" class="form-control smtab_tot @error('inr') is-invalid @enderror" type="text" placeholder="Enter INR" id="first" oninput="add_number()" required>
                                @error('inr')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                             <div class="form-group col-md-4">
                                <label class="control-label">CUS Rate</label>
                                <input name="cus_rate" class="form-control smtab_tot @error('cus_rate') is-invalid @enderror" type="text" placeholder="Enter CUS Rate" id="second" oninput="add_number()" required>                                @error('cus_rate')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                             <div class="form-group col-md-4">
                                <label class="control-label">AED</label>
                                <input name="aed" class="form-control @error('aed') is-invalid @enderror" type="text" placeholder="AED" id="txtresult" onkeyup="reSum();" required>
                                @error('aed')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                             <div class="form-group col-md-4">
                                <label class="control-label">PUR Rate</label>
                                <input name="pur_rate" class="form-control @error('pur_rate') is-invalid @enderror" type="text" placeholder="Enter PUR Rate" id="four" required>
                                @error('pur_rate')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                              <div class="form-group col-md-4">
                                <label class="control-label">S. Prices</label>
                                <input name="s_prices" class="form-control @error('s_prices') is-invalid @enderror" type="text" placeholder="S. Prices" id="txtresults" onkeyup="reSub();reSum();" required>
                                <input class="form-control" type="hidden" id="result"> 
                                @error('s_prices')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                              <div class="form-group col-md-4">
                                <label class="control-label">Profit</label>
                                <input name="profit" class="form-control @error('profit') is-invalid @enderror" type="text" placeholder="Enter Profit" id="profit" required>
                                @error('profit')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                             <div class="form-group col-md-4">
                                <label class="control-label">Party</label>
                                <input name="party" class="form-control @error('party') is-invalid @enderror" type="text" placeholder="Enter Party" required>
                                @error('party')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                             <div class="form-group col-md-4">
                                <label class="control-label">Payment</label>
                               <select class="form-control @error('payment') is-invalid @enderror" name="payment" required>
                                   <option value="Done">DONE</option>
                                   <option value="Pending">Pending</option>
                               </select>
                                @error('payment')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                    
                    </div>        
                            
                            

                            <div class="form-group col-md-4 align-self-end">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <script type="text/javascript">
var first_number = document.getElementById("first");
var four_number = document.getElementById("four");

function reSub() {
   var first_number = parseFloat(first.value);
   if (isNaN(first_number)) first_number = 0;
   var four_number = parseFloat(four.value);
   if (isNaN(four_number)) four_number = 0;
   var result = first_number / four_number;
   document.getElementById("txtresults").value = result;
}

</script>
    
    
    <script>

         function reSum()
        {
            var num1 = parseInt(document.getElementById("txtresult").value);
            var num2 = parseInt(document.getElementById("txtresults").value);
            document.getElementById("profit").value = num1 - num2;
 
        }
        
        
    
</script>



    

<script type="text/javascript">
var first = document.getElementById("first");
var second = document.getElementById("second");

function add_number() {
   var first_number = parseFloat(first.value);
   if (isNaN(first_number)) first_number = 0;
   var second_number = parseFloat(second.value);
   if (isNaN(second_number)) second_number = 0;
   var result = first_number / second_number;
   document.getElementById("txtresult").value = result;
}

</script>
    
    


    

    
@endsection




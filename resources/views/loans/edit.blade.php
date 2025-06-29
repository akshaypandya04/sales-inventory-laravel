@extends('layouts.master')

@section('title', 'Loan | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i>Edit Loan</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Loan</li>
                <li class="breadcrumb-item"><a href="#">Edit Loan</a></li>
            </ul>
        </div>


        <div class="row">
            <div class="clearix"></div>
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Loan Details</h3>
                    <div class="tile-body">
                        <form  method="POST" action="{{route('loans.update',$invoice->id)}}">
                            @csrf
                            @method('PUT')
                           
                           
                               <div class="row">        
                            
                            <div class="form-group col-md-12">
                                <label class="control-label">Customer Name</label>
                                <select name="customer_id" class="form-control customername" id="customername">
                                    <option>Select Customer</option>
                                    @foreach($customers as $customer)
                                    
                                          <option value="{{$customer->id}}" {{(($customer->id==$invoice->customer_id) ? 'selected' : '')}}>
                                      {{$customer->name}}
                                    </option>
                                    @endforeach
                                </select> 
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label class="control-label">Customer CIF</label>
                                <input class="form-control cif" type="text" id="cif" placeholder="Customer CIF" readonly>
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label class="control-label">Customer Mobile</label>
                                <input class="form-control" type="number" id="mobile" placeholder="Customer Mobile" readonly>
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label class="control-label">Customer Address</label>
                                <input class="form-control" type="number" id="address" placeholder="Customer Address" readonly>
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label class="control-label">Loan Amount Senctioned</label>
                                <input name="amount_senctioned" class="form-control" type="number" id="amount" onchange="Calculate()" placeholder="Enter Loan Amount Senctioned" value="{{$invoice->amount_senctioned}}">
                            </div>
                            
                             <div class="form-group col-md-4">
                                <label class="control-label">Loan Amount Disbursed</label>
                                <input name="amount_disbursed" class="form-control" type="number" placeholder="Enter Loan Amount Disbursed" value="{{$invoice->amount_disbursed}}">
                            </div>
                            
                             <div class="form-group col-md-4">
                                <label class="control-label">Rate of interest</label>
                                <input name="rate_interest" class="form-control" type="number" id="rate" onchange="Calculate()" placeholder="Enter Rate of interest" value="{{$invoice->rate_interest}}">
                            </div>
                            
                            
                             <div class="form-group col-md-4">
                                <label class="control-label">Tenor in month</label>
                                <input name="tenor_month" class="form-control" type="text" id="months" onchange="Calculate()" placeholder="Enter Tenor in month" value="{{$invoice->tenor_month}}">
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label class="control-label">Loan Product</label>
                                 <select class="form-control" name="vecale">
                                           <option value="">Select</option>
                                           
                                           <option value="Vehicle Loan" {{(($invoice->vecale=='Vehicle Loan')? 'selected' : '')}}>Vehicle Loan</option>
                                           
                                           <option value="Gold Loan" {{(($invoice->vecale=='Gold Loan')? 'selected' : '')}}>Gold Loan</option>
                                           
                                             <option value="Property Loan" {{(($invoice->vecale=='Property Loan')? 'selected' : '')}}>Property Loan</option>
                                             
                                               <option value="Parsonal Loan" {{(($invoice->vecale=='Parsonal Loan')? 'selected' : '')}}>Parsonal Loan</option>
                                 </select>
                            </div>
                
                            
                             <div class="form-group col-md-4">
                                <label class="control-label">Loan start Date</label>
                                <input name="start_date"  class="form-control"  value="{{$invoice->start_date}}" type="date" >
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label class="control-label">Maturity Date</label>
                                <input name="end_date"  class="form-control"  value="{{$invoice->end_date}}" type="date" >
                            </div>
                            
                             <div class="form-group col-md-4">
                                <label class="control-label">EMI Amount</label>
                                <input name="emi_amount" class="form-control" id="total" type="number" placeholder="Enter EMI Amount" value="{{$invoice->emi_amount}}">
                            </div>
                 </div>    
                           
                           
                            <div >
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>

    </main>
    
    
    
    

@endsection

@push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
     <script src="{{asset('/')}}js/multifield/jquery.multifield.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            
            $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('change', '#customername', function (e) {
        e.preventDefault();
        var city_id = $('#customername').val();
        $.ajax({
            type    : 'GET',
            url     :'{!! URL::route('findCustomer') !!}',
            data: {
                id: city_id
            },
                    dataType: 'json',
                    success:function (data) {
                        $("#cif").val(data.cif);
                        $("#mobile").val(data.mobile);
                        $("#address").val(data.address);
                    }
                });
            });
          
        });


    </script>
    
    <script>
        
        function Calculate() {
  
    // Extracting value in the amount 
    // section in the variable
    const amount = document.querySelector("#amount").value;
  
    // Extracting value in the interest
    // rate section in the variable
    const rate = document.querySelector("#rate").value;
  
    // Extracting value in the months 
    // section in the variable
    const months = document.querySelector("#months").value;
  
    // Calculating interest per month
    const interest = (amount * rate ) / 100;
      
    // Calculating total payment
    const total = ((amount / months) + interest).toFixed(2);
  
    // document.querySelector("#total")
    //         .innerHTML = "EMI :" + total;
    
    document.querySelector("#total").value = total;        
}
        
    </script>

    

@endpush


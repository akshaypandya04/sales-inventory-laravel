@extends('layouts.master')
@section('title', 'Loan | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i>Create Loan</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Loan</li>
                <li class="breadcrumb-item"><a href="#">Create Loan</a></li>
            </ul>
        </div>


      <div class="">
            <a class="btn btn-primary" href="{{route('customer.create')}}"><i class="fa fa-plus"> Add Customer</i></a>
        </div> <br>

         <div class="row">
             <div class="clearix"></div>
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Loan Details</h3>
                    <div class="tile-body">
                        <form  method="POST" action="{{route('loans.store')}}">
                            @csrf
                            
                    <div class="row">        
                            
                            <div class="form-group col-md-12">
                                <label class="form-label required">Customer Name</label>
                                <select name="customer_id" class="form-control customername" id="customername" required>
                                    <option>Select Customer</option>
                                    @foreach($customers as $customer)
                                        <option value="{{$customer->id}}">{{$customer->name}} </option>
                                    @endforeach
                                </select> 
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label class="control-label">Customer CIF</label>
                                <input class="form-control cif" id="cif" type="text" placeholder="Customer CIF" readonly>
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label class="control-label">Customer Mobile</label>
                                <input class="form-control" id="mobile" type="number" placeholder="Customer Mobile" readonly>
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label class="control-label">Customer Address</label>
                                <input class="form-control" id="address" type="text" placeholder="Customer Address" readonly>
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label class="control-label">Loan Amount Senctioned</label>
                                <input name="amount_senctioned" class="form-control" type="number" id="amount" onchange="Calculate()" placeholder="Enter Loan Amount Senctioned" required>
                            </div>
                            
                             <div class="form-group col-md-4">
                                <label class="control-label">Loan Amount Disbursed</label>
                                <input name="amount_disbursed" class="form-control" type="number" placeholder="Enter Loan Amount Disbursed" required>
                            </div>
                            
                             <div class="form-group col-md-4">
                                <label class="control-label">Rate of interest</label>
                                <input name="rate_interest" class="form-control" id="rate" onchange="Calculate()" type="number" placeholder="Enter Rate of interest" required>
                            </div>
                            
                            
                             <div class="form-group col-md-4">
                                <label class="control-label">Tenor in month</label>
                                <input name="tenor_month" class="form-control" type="text" id="months" onchange="Calculate()" placeholder="Enter Tenor in month" required>
                            </div>
                            
                              <div class="form-group col-md-4">
                                <label class="control-label">Loan Product</label>
                                 <select class="form-control" name="vecale" required>
                                        <option value="">Select</option>
                                        
                                        <option value="Vehicle Loan">Vehicle Loan</option>
                                        
                                        <option value="Gold Loan">Gold Loan</option>
                                        
                                         <option value="Property Loan">Property Loan</option>
                                         
                                          <option value="Parsonal Loan">Parsonal Loan</option>
                                 </select>
                            </div>
                
                            
                             <div class="form-group col-md-4">
                                <label class="control-label">Loan start Date</label>
                                <input name="start_date"  class="form-control"  type="date" required>
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label class="control-label">Maturity Date</label>
                                <input name="end_date"  class="form-control"  type="date" required>
                            </div>
                            
                             <div class="form-group col-md-4">
                                <label class="control-label">EMI Amount</label>
                                <input name="emi_amount" class="form-control" id="total"  type="number" placeholder="Enter EMI Amount" required>
                                
                               
                            </div>
                 </div>           

                            <div >
                                <button class="btn btn-primary" type="submit">Submit</button>
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




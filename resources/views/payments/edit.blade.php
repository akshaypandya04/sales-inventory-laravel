@extends('layouts.master')
@section('title', 'Payment | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i>Edit Payment </h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Payment</li>
                <li class="breadcrumb-item"><a href="#">Edit Payment </a></li>
            </ul>
        </div>

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="row">
            <div class="clearix"></div>
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Edit Payment</h3>
                    <div class="tile-body">
                        <form method="POST" action="{{route('payment.update', $payments->id)}}">
                            @csrf
                            @method('PUT')
                            
                               <div class="row">
                                   
                             <div class="form-group col-md-4">
                                <label class="control-label">Date</label>
                                <input name="date" class="form-control" id="total"  type="date" value="{{$payments->date}}">
                            </div>       
                                   
                                
                              <div class="form-group col-md-4">
                                <label class="form-label required">Customer Name</label>

                                <input name="customer_name" class="form-control" id="customer_name"  type="text" placeholder="Enter Customer name" value="{{ $payments->customer_name }}">    
                                
                            </div>
                            
                            
                             <div class="form-group col-md-12">
                                <label class="control-label">Product Details</label>
                               <textarea class="form-control" row="5" name="product_name">{{ $payments->product_name }}</textarea>
                            </div>
                            

                            <div class="form-group col-md-4">
                                <label class="control-label">Amount</label>
                                <input name="amount" class="form-control" id="amount"  type="number" placeholder="Enter Amount" value="{{$payments->amount}}" >
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label class="control-label">Due Amount</label>
                                <input name="due_amount" class="form-control" id="due_amount"  type="number" value="{{$payments->due_amount}}" placeholder="Enter Due Amount">
                            </div>

                            <div class="form-group col-md-4">
                                <label class="control-label">Recived Amount</label>
                                <input name="recived_amount" class="form-control @error('recived_amount') is-invalid @enderror" type="number" placeholder="Enter Recived Amount" value="{{$payments->recived_amount}}">
                                @error('recived_amount')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            
                             <div class="form-group col-md-4">
                                <label class="form-label required">Payment Mode</label>
      <select class="form-control" name="mode" required="">
                
     <option value="">Select</option>
    <option value="Cash" {{ isset($payments) && $payments->mode == 'Cash' ? 'selected' : '' }}>Cash</option>
    <option value="Online" {{ isset($payments) && $payments->mode == 'Online' ? 'selected' : '' }}>Online</option>
                                 
   </select> 
                               
                            </div>
                            
                            
                        </div>

                      
                            <div class="form-group col-md-4 align-self-end">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
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


     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function () {

            $('select[name="customer_id"]').on('change', function () {

                var id = this.value;
                $("#loan_id").html('');
                $.ajax({
                    url: "{{url('/api/fetch-code')}}",
                    type: "POST",
                    data: {
                        customer_id: id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {

                        $('#loan_id').html('<option value="">Select Loan</option>');
                        $.each(result.loans, function (key, value) {

                            $("#loan_id").append('<option value="' + value
                                .unique_no + '">' + value.unique_no + '</option>');
                        });
                    }
                });
            });
            
            
            $(document).on('change', '#loan_id', function (e) {
        // e.preventDefault();
        var city_id = $('#loan_id').val();
        $.ajax({
            type    : 'GET',
            url     :'{!! URL::route('findLoan') !!}',
            data: {
                id: city_id
            },
                    dataType: 'json',
                    success:function (data) {
                        $("#amount_senctioned").val(data.amount_senctioned);
                        $("#rate_interest").val(data.rate_interest);
                        $("#emi_amount").val(data.emi_amount);
                        $("#months").val(data.tenor_month);
                        $("#amount_disbursed").val(data.amount_disbursed);
                        $("#vecale").val(data.vecale);
                    }
                });
            });
            
            
         
        });
    </script>


    
    

@endpush




@extends('layouts.master')

@section('title', 'Payment | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i>Create Payment</h1>
                <p>Sample forms</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Payment</li>
                <li class="breadcrumb-item"><a href="#">Create Payment</a></li>
            </ul>
        </div>

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="">
            <a class="btn btn-primary" href="{{route('payment.index')}}"><i class="fa fa-edit"> Payment</i></a>
        </div>
        <div class="row mt-2">

            <div class="clearix"></div>
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Payment</h3>
                    <div class="tile-body">
                        <form method="POST" action="{{route('payment.store')}}">
                            @csrf
                            
                            
                      <div class="row">
                          
                           <div class="form-group col-md-4">
                                <label class="control-label">Date</label>
                                <input name="date" class="form-control" id="total"  type="date" required value="{{ date('Y-m-d') }}">
                            </div>
                                
                              <div class="form-group col-md-4">
                                <label class="form-label required">Customer Name</label>
                              
                              <input name="customer_name" class="form-control" id="customer_name"  type="text" placeholder="Enter Customer name" >    
                            </div>
                            
                            
                           <div class="form-group col-md-12">
                                <label class="control-label">Product Details</label>
                               <textarea class="form-control" row="5" name="product_name"></textarea>
                            </div>
                            
                            
                            <div class="form-group col-md-4">
                                <label class="control-label">Product Amount</label>
                                <input name="amount" class="form-control" id="amount"  type="number" placeholder="Enter Product Amount" >
                            </div>
                            
                              <div class="form-group col-md-4">
                                <label class="control-label">Recived Amount</label>
                                <input name="recived_amount" class="form-control @error('recived_amount') is-invalid @enderror" type="number" placeholder="Enter Recived Amount" required>
                                @error('recived_amount')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label class="control-label">Due Amount</label>
                                <input name="due_amount" class="form-control" id="due_amount"  type="number" value="0" placeholder="Enter Due Amount">
                            </div>

    
                        <div class="form-group col-md-4">
                                <label class="form-label required">Payment Mode</label>
                             
                           
                             <select class="form-control" name="mode" required="">
                                <option value="">select</option>
                                <option value="Cash">Cash</option>
                                 <option value="Online">Online</option>
                            </select>
                               
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
         
        });
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const amountInput = document.getElementById('amount');
        const receivedInput = document.querySelector('input[name="recived_amount"]');
        const dueInput = document.getElementById('due_amount');

        function calculateDueAmount() {
            const amount = parseFloat(amountInput.value) || 0;
            const received = parseFloat(receivedInput.value) || 0;
            const due = amount - received;

            dueInput.value = due >= 0 ? due : 0;
        }

        amountInput.addEventListener('input', calculateDueAmount);
        receivedInput.addEventListener('input', calculateDueAmount);
    });
</script>

    
    

@endpush


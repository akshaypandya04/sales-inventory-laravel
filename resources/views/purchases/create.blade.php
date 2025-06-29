@extends('layouts.master')
@section('title', 'Purchase Entry | Atal Media')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i>Create Purchase Entry</h1>
                <p>Sample forms</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Purchase Entry</li>
                <li class="breadcrumb-item"><a href="#">Create Purchase Entry</a></li>
            </ul>
        </div>

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="">
            <a class="btn btn-primary" href="{{route('purchases.index')}}"><i class="fa fa-edit"> Purchase Entry</i></a>
        </div>
        <div class="row mt-2">

            <div class="clearix"></div>
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Purchase Entry</h3>
                    <div class="tile-body">
                        <form method="POST" action="{{route('purchases.store')}}">
                            @csrf
                            
                            
                      <div class="row">
                          
                           <div class="form-group col-md-4">
                                <label class="control-label">Invoice no.</label>
                                <input name="invoice_no" class="form-control" id="invoice_no"  type="text" required>
                            </div>
                          
                          <div class="form-group col-md-4">
                                <label class="control-label">Purchase Date</label>
                                <input name="purchase_date" class="form-control" id="purchase_date"  type="date" required value="{{ date('Y-m-d') }}">
                            </div>
                                
                              <div class="form-group col-md-4">
                                <label class="form-label required">Party Name</label>
                                <select name="party_id" class="form-control party_id" id="party_id" required>
                                    <option>Select Party</option>
                                    @foreach($customers as $customer)
                                        <option value="{{$customer->id}}">{{$customer->name}} </option>
                                    @endforeach
                                </select> 
                            </div>
                            
                                                      
<div class="form-group col-md-4">
    <label class="form-label required">Category</label>
    <select name="category_id" class="form-control" id="category_id" required>
        <option value="">Select Category</option>
        @foreach($category as $value)
            <option value="{{ $value->id }}">{{ $value->category_name }}</option>
        @endforeach
    </select> 
</div>

<div class="form-group col-md-4">
    <label class="form-label required">Item</label>
    <select name="item_id" class="form-control" id="item_id" required>
        <option value="">Select Item</option>
        <!-- Options will be filled based on selected category -->
    </select> 
</div>
                            
                            <div class="form-group col-md-4">
                                <label class="control-label">Price</label>
                                <input name="purchase_price" class="form-control" id="amount"  type="text" placeholder="price" >
                            </div>
                            
                              <div class="form-group col-md-4">
                                <label class="control-label">Qty</label>
                                <input name="qty" class="form-control" id="qty"  type="number" placeholder="Enter Product Qty" >
                            </div>
                            
                              <div class="form-group col-md-4">
                                <label class="control-label">Total</label>
                                <input name="total" class="form-control" type="text" placeholder="Enter Total" required>
                                @error('total')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        
   <div class="row">
    <!-- Left Column: Remarks -->
    <div class="form-group col-md-6">
        <label class="control-label">Remarks</label>
        <textarea class="form-control" name="remarks" rows="10"></textarea>
    </div>

    <!-- Right Column: Discount, Final, Paid, Remain -->
    <div class="col-md-6">
        
       
        <div class="form-group">
            <label class="control-label">Final Amount</label>
            <input name="final_amount" class="form-control" id="final_amount" type="text" required>
        </div>

        <div class="form-group">
            <label class="control-label">Paid Amount</label>
            <input name="paid_amount" class="form-control" id="paid_amount" type="text" required>
        </div>

        <div class="form-group">
            <label class="control-label">Remain Amount</label>
            <input name="remain_amount" class="form-control" id="remain_amount" type="text" required>
        </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script>
    $(document).ready(function () {
        $('#category_id').on('change', function () {
            var categoryId = $(this).val();

            if (categoryId) {
                $.ajax({
                    url: '{{url("/get-items-by-category/") }}/' + categoryId,
                    type: 'GET',
                    success: function (data) {
                        $('#item_id').empty().append('<option value="">Select Item</option>');
                        $.each(data, function (key, value) {
                            $('#item_id').append('<option value="' + value.id + '">' + value.item_name + '</option>');
                        });
                    }
                });
            } else {
                $('#item_id').html('<option value="">Select Item</option>');
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#item_id').on('change', function () {
            var itemId = $(this).val();

            if (itemId) {
                $.ajax({
                    url: '{{ url("/get-item") }}/' + itemId,
                    type: 'GET',
                    success: function (data) {
                        console.log(data); // debug
                        $('#amount').val(data.price); // Set price in input
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                    }
                });
            } else {
                $('#amount').val('');
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        function calculateTotal() {
            let price = parseFloat($('#amount').val()) || 0;
            let qty = parseFloat($('#qty').val()) || 0;
            let total = price * qty;
            $('input[name="total"]').val(total.toFixed(0));
            $('#final_amount').val(total.toFixed(0)); // setting final = total
            return total;
        }

        function calculateRemainAmount() {
            let finalAmount = parseFloat($('#final_amount').val()) || 0;
            let paidAmount = parseFloat($('#paid_amount').val()) || 0;
            let remainAmount = finalAmount - paidAmount;
            $('#remain_amount').val(remainAmount.toFixed(0));
        }

        // Event listeners
        $('#amount, #qty').on('input', function () {
            calculateTotal();
            calculateRemainAmount();
        });

        $('#paid_amount').on('input', function () {
            calculateRemainAmount();
        });

        // Initial trigger
        calculateTotal();
        calculateRemainAmount();
    });
</script>


   
@endpush   
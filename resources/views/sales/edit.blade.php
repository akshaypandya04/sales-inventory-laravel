@extends('layouts.master')
@section('title', 'Sales Entry | Atal Media')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i>Edit Sales Entry</h1>
                <p>Sample forms</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Sales Entry</li>
                <li class="breadcrumb-item"><a href="#">Edit Sales Entry</a></li>
            </ul>
        </div>

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="">
            <a class="btn btn-primary" href="{{route('sales.index')}}"><i class="fa fa-edit"> Sales Entry</i></a>
        </div>
        <div class="row mt-2">

            <div class="clearix"></div>
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Edit Sales Entry </h3>
                    <div class="tile-body">
<form method="POST" action="{{ route('sales.update', $salesEntry) }}">
    @csrf
    @method('PUT')

    <div class="row">
        <!-- Sales Date -->
        <div class="form-group col-md-4">
            <label class="control-label">Sales Date</label>
            <input name="sale_date" class="form-control" id="sale_date" type="date"
                   value="{{ old('sale_date', $salesEntry->sale_date) }}" required>
        </div>

        <!-- Customer -->
        <div class="form-group col-md-4">
            <label class="form-label required">Customer Name</label>
            <select name="customer_id" class="form-control" id="customer_id" required>
                <option>Select Customer</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}"
                        {{ old('customer_id', $salesEntry->customer_id) == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>
        
        
<div class="form-group col-md-4">
    <label class="form-label required">Category</label>
    <select name="category_id" class="form-control" id="category_id" required>
        <option value="">Select Category</option>
        @foreach($category as $value)
            <option value="{{ $value->id }}"
                {{ old('category_id', $salesEntry->category_id ?? '') == $value->id ? 'selected' : '' }}>
                {{ $value->category_name }}
            </option>
        @endforeach
    </select> 
</div>    

<!-- Item -->
<div class="form-group col-md-4">
    <label class="form-label required">Item</label>
    <select name="item_id" class="form-control" id="item_id" required>
        <option value="">Select Item</option>
        @foreach($items as $item)
            <option value="{{ $item->id }}"
                {{ old('item_id', $salesEntry->item_id ?? '') == $item->id ? 'selected' : '' }}>
                {{ $item->item_name }}
            </option>
        @endforeach
    </select>
</div>

        <!-- Height -->
        <div class="form-group col-md-4">
            <label class="control-label">Height</label>
            <input name="height" class="form-control" id="height" type="number"
                   value="{{ old('height', $salesEntry->height) }}" placeholder="Enter Height">
        </div>

        <!-- Width -->
        <div class="form-group col-md-4">
            <label class="control-label">Width</label>
            <input name="width" class="form-control" id="width" type="number"
                   value="{{ old('width', $salesEntry->width) }}" placeholder="Enter Width">
        </div>

        <!-- Sqfeet -->
        <div class="form-group col-md-4">
            <label class="control-label">Sqfeet</label>
            <input name="sq_ft" class="form-control" id="sq_ft" type="number"
                   value="{{ old('sq_ft', $salesEntry->sq_ft) }}" placeholder="Enter Sqfeet">
        </div>

        <!-- Price -->
        <div class="form-group col-md-4">
            <label class="control-label">Price</label>
            <input name="price" class="form-control" id="amount" type="number"
                   value="{{ old('price', $salesEntry->price) }}" placeholder="price">
        </div>

        <!-- Quantity -->
        <div class="form-group col-md-4">
            <label class="control-label">Qty</label>
            <input name="qty" class="form-control" id="qty" type="number"
                   value="{{ old('qty', $salesEntry->qty) }}" placeholder="Enter Product Qty">
        </div>

        <!-- Total -->
        <div class="form-group col-md-4">
            <label class="control-label">Total</label>
            <input name="total" class="form-control" type="number"
                   value="{{ old('total', $salesEntry->total) }}" required placeholder="Enter Total">
        </div>
    </div>

    <!-- Remarks + Payment Info -->
    <div class="row">
        <div class="form-group col-md-6">
            <label class="control-label">Remarks</label>
            <textarea class="form-control" name="remarks" rows="10">{{ old('remarks', $salesEntry->remarks) }}</textarea>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Discount (%)</label>
                <input name="discount" class="form-control" id="discount" type="number"
                       value="{{ old('discount', $salesEntry->discount) }}" required>
            </div>

            <div class="form-group">
                <label class="control-label">Final Amount</label>
                <input name="final_amount" class="form-control" id="final_amount" type="number"
                       value="{{ old('final_amount', $salesEntry->final_amount) }}" required>
            </div>

            <div class="form-group">
                <label class="control-label">Paid Amount</label>
                <input name="paid_amount" class="form-control" id="paid_amount" type="number"
                       value="{{ old('paid_amount', $salesEntry->paid_amount) }}" required>
            </div>

            <div class="form-group">
                <label class="control-label">Remain Amount</label>
                <input name="remain_amount" class="form-control" id="remain_amount" type="number"
                       value="{{ old('remain_amount', $salesEntry->remain_amount) }}" required>
            </div>
        </div>
    </div>

    <!-- Submit -->
    <div class="form-group col-md-4 align-self-end">
        <button class="btn btn-primary" type="submit">
            <i class="fa fa-fw fa-lg fa-check-circle"></i> Update
        </button>
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
            $('#item_id').html('<option>Loading...</option>');

            if (categoryId) {
                $.ajax({
                    url: '{{url("/get-items-by-category/") }}/' + categoryId,
                    type: 'GET',
                    success: function (data) {
                        $('#item_id').empty().append('<option value="">Select Item</option>');
                        $.each(data, function (key, value) {
                            $('#item_id').append('<option value="' + value.id + '">' + value.item_name + '</option>');
                        });
                    },
                    error: function () {
                        $('#item_id').html('<option value="">Error loading items</option>');
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

        function calculateSqFeet() {
            let height = parseFloat($('#height').val()) || 0;
            let width = parseFloat($('#width').val()) || 0;
            let sq_ft = height * width;

            // Only update if greater than 0
            if (sq_ft > 0) {
                $('#sq_ft').val(sq_ft.toFixed(0));
            } else {
                $('#sq_ft').val('');
            }

            return sq_ft;
        }

        function calculateTotalAmount() {
            let height = parseFloat($('#height').val()) || 0;
            let width = parseFloat($('#width').val()) || 0;
            let sq_ft = parseFloat($('#sq_ft').val()) || 0;
            let price = parseFloat($('#amount').val()) || 0;
            let qty = parseFloat($('#qty').val()) || 0;

            let total = 0;

            if (height > 0 && width > 0) {
                // Calculation using sqft
                total = sq_ft * price * qty;
            } else {
                // Direct calculation
                total = price * qty;
            }

            $('input[name="total"]').val(total.toFixed(0));
            return total;
        }

        function calculateFinalAmount() {
            let total = calculateTotalAmount();
            let discount = parseFloat($('#discount').val()) || 0;
            let finalAmount = total - (total * (discount / 100));
            $('#final_amount').val(finalAmount.toFixed(0));
            return finalAmount;
        }

        function calculateRemainAmount() {
            let finalAmount = calculateFinalAmount();
            let paidAmount = parseFloat($('#paid_amount').val()) || 0;
            let remainAmount = finalAmount - paidAmount;
            $('#remain_amount').val(remainAmount.toFixed(0));
        }

        // Event bindings
        $('#height, #width').on('input', function () {
            calculateSqFeet();
            calculateTotalAmount();
            calculateFinalAmount();
            calculateRemainAmount();
        });

        $('#amount, #qty').on('input', function () {
            calculateTotalAmount();
            calculateFinalAmount();
            calculateRemainAmount();
        });

        $('#discount').on('input', function () {
            calculateFinalAmount();
            calculateRemainAmount();
        });

        $('#paid_amount').on('input', function () {
            calculateRemainAmount();
        });

        // Initial call
        calculateSqFeet();
        calculateTotalAmount();
        calculateFinalAmount();
        calculateRemainAmount();
    });
</script>

   
@endpush   
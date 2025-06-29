@extends('layouts.master')
@section('title', 'Expense | Atal Media')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i> Edit Expense</h1>
               
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Expense</li>
                <li class="breadcrumb-item"><a href="#">Edit Expense</a></li>
            </ul>
        </div>


         <div class="row">
             <div class="clearix"></div>
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Expense</h3>
                    <div class="tile-body">
                       <form method="POST" action="{{ route('expenses.update', $expense) }}">
    @csrf
    @method('PUT')
 
                    <div class="row">        
                            
                            <div class="form-group col-md-6">
                                <label class="control-label">Expense Date</label>
                                <input type="date" class="form-control" name="date" value="{{$expense->date}}">
                            </div>
                            
                           <div class="form-group col-md-6">
    <label class="control-label">Expense Type</label>
    <select class="form-control" name="to" required>
        <option value="">Select Expense Type</option>
        <option value="Petrol" {{ $expense->to == 'Petrol' ? 'selected' : '' }}>Petrol</option>
        <option value="Electricity Bill" {{ $expense->to == 'Electricity Bill' ? 'selected' : '' }}>Electricity Bill</option>
        <option value="Water Bill" {{ $expense->to == 'Water Bill' ? 'selected' : '' }}>Water Bill</option>
        <option value="Internet" {{ $expense->to == 'Internet' ? 'selected' : '' }}>Internet</option>
        <option value="Mobile Recharge" {{ $expense->to == 'Mobile Recharge' ? 'selected' : '' }}>Mobile Recharge</option>
        <option value="Salary" {{ $expense->to == 'Salary' ? 'selected' : '' }}>Salary</option>
        <option value="Rent" {{ $expense->to == 'Rent' ? 'selected' : '' }}>Rent</option>
        <option value="Travel" {{ $expense->to == 'Travel' ? 'selected' : '' }}>Travel</option>
        <option value="Stationary" {{ $expense->to == 'Stationary' ? 'selected' : '' }}>Stationary</option>
        <option value="Maintenance" {{ $expense->to == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
        <option value="Other" {{ $expense->to == 'Other' ? 'selected' : '' }}>Other</option>
    </select>
</div>

                            
                              <div class="form-group col-md-6">
                                <label class="control-label">Item</label>
                                <input type="text"  class="form-control" name="item" placeholder="Enter Item" value="{{$expense->item}}">
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label class="control-label">Paid Amount</label>
                                <input type="text" class="form-control" name="paid_amount"placeholder="Enter Paid Amount" value="{{$expense->paid_amount}}">
                            </div>
                            
                             <div class="form-group col-md-6">
                                <label class="control-label">Item Description </label>
                               <textarea class="form-control" name="item_description" id="item_description">{{$expense->item_description}}</textarea>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label class="control-label">Remarks</label>
                                <textarea class="form-control" name="remarks" id="remarks">{{$expense->remarks}}</textarea>
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
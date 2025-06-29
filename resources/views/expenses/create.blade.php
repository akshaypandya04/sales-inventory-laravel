@extends('layouts.master')
@section('title', 'Expense | Atal Media')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i> Create Expense</h1>
               
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Expense</li>
                <li class="breadcrumb-item"><a href="#">Create Expense</a></li>
            </ul>
        </div>


         <div class="row">
             <div class="clearix"></div>
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Expense</h3>
                    <div class="tile-body">
                        <form  method="POST" action="{{route('expenses.store')}}">
                            @csrf
 
                    <div class="row">        
                            
                            <div class="form-group col-md-6">
                                <label class="control-label">Expense Date</label>
                                <input type="date" class="form-control" name="date" >
                            </div>
                            
                             <div class="form-group col-md-6">
    <label class="control-label">Expense Type</label>
    <select class="form-control" name="to" required>
        <option value="">Select Expense Type</option>
        <option value="Petrol">Petrol</option>
        <option value="Electricity Bill">Electricity Bill</option>
        <option value="Water Bill">Water Bill</option>
        <option value="Internet">Internet</option>
        <option value="Mobile Recharge">Mobile Recharge</option>
        <option value="Salary">Salary</option>
        <option value="Rent">Rent</option>
        <option value="Travel">Travel</option>
        <option value="Stationary">Stationary</option>
        <option value="Maintenance">Maintenance</option>
        <option value="Other">Other</option>
    </select>
</div>
                            
                              <div class="form-group col-md-6">
                                <label class="control-label">Item</label>
                                <input type="text"  class="form-control" name="item" placeholder="Enter Item">
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label class="control-label">Paid Amount</label>
                                <input type="text" class="form-control" name="paid_amount"placeholder="Enter Paid Amount">
                            </div>
                            
                             <div class="form-group col-md-6">
                                <label class="control-label">Item Description </label>
                               <textarea class="form-control" name="item_description" id="item_description"></textarea>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label class="control-label">Remarks</label>
                                <textarea class="form-control" name="remarks" id="remarks"></textarea>
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
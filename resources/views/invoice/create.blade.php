@extends('layouts.master')

@section('title', 'Invoice | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i> Create Invoice</h1>
               
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Invoice</li>
                <li class="breadcrumb-item"><a href="#">Create Invoice</a></li>
            </ul>
        </div>


         <div class="row">
             <div class="clearix"></div>
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Invoice</h3>
                    <div class="tile-body">
                        <form  method="POST" action="{{route('invoice.store')}}">
                            @csrf
 
                    <div class="row">        
                            
                            <div class="form-group col-md-3">
                                <label class="control-label">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Name">
                            </div>
                            
                              <div class="form-group col-md-3">
                                <label class="control-label">Bank Name</label>
                                <input type="text" class="form-control" name="bank_name"  placeholder="Enter Bank name">
                            </div>
                            
                              <div class="form-group col-md-3">
                                <label class="control-label">Account Number</label>
                                <input type="number"  class="form-control" name="account_no" placeholder="Enter Account Number">
                            </div>
                            
                            <div class="form-group col-md-3">
                                <label class="control-label">IFSC CODE</label>
                                <input type="text" class="form-control" name="ifsc_code"placeholder="Enter IFSC CODE">
                            </div>
                            
                             <div class="form-group col-md-3">
                                <label class="control-label">Sender No.</label>
                                <input type="text" class="form-control" name="sender_no" placeholder="Enter Sender No.">
                            </div>
                            
                            <div class="form-group col-md-3">
                                <label class="control-label">Date</label>
                                <input type="date" class="form-control datepicker"  value="<?php echo date('Y-m-d')?>" name="date" placeholder="Enter your email">
                            </div>

           </div>

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Transaction Id</th>
                                <th scope="col">Method</th>
                                <th scope="col">Status</th>
                                <th scope="col">Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><input type="text" name="transcation_id" class="form-control" ></td>
                                <td>
                                    <select class="form-control" name="method">
                                        <option>select</option>
                                        <option value="PIMPS">PIMPS</option>
                                        <option value="NEFT">NEFT</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" name="status">
                                        <option>select</option>
                                        <option value="Success">Success</option>
                                        <option value="Process">Process</option>
                                    </select>
                                </td>
                                <td><input type="text" name="amount" class="form-control" ></td>
                             </tr>
                            </tbody>
                            

                        </table>

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




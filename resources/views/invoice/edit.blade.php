@extends('layouts.master')

@section('title', 'Invoice | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i> Edit Invoice</h1>
                <p>Manage Invoice</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Invoice</li>
                <li class="breadcrumb-item"><a href="#">Edit Invoice</a></li>
            </ul>
        </div>


        <div class="row">
            <div class="clearix"></div>
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Invoice</h3>
                    <div class="tile-body">
                        <form  method="POST" action="{{route('invoice.update',$invoice->id)}}">
                            @csrf
                            @method('PUT')
                            
                          
 <div class="row">        
                            
                            <div class="form-group col-md-3">
                                <label class="control-label">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{$invoice->name}}">
                            </div>
                            
                              <div class="form-group col-md-3">
                                <label class="control-label">Bank Name</label>
                                <input type="text" class="form-control" name="bank_name"  placeholder="Enter Bank name" value="{{$invoice->bank_name}}">
                            </div>
                            
                              <div class="form-group col-md-3">
                                <label class="control-label">Account Number</label>
                                <input type="number"  class="form-control" name="account_no" placeholder="Enter Account Number" value="{{$invoice->account_no}}">
                            </div>
                            
                            <div class="form-group col-md-3">
                                <label class="control-label">IFSC CODE</label>
                                <input type="text" class="form-control" name="ifsc_code"placeholder="Enter IFSC CODE" value="{{$invoice->ifsc_code}}">
                            </div>
                            
                             <div class="form-group col-md-3">
                                <label class="control-label">Sender No.</label>
                                <input type="text" class="form-control" name="sender_no" placeholder="Enter Sender No." value="{{$invoice->sender_no}}">
                            </div>
                            
                            <div class="form-group col-md-3">
                                <label class="control-label">Date</label>
                                <input type="date" class="form-control datepicker"  value="<?php echo date('Y-m-d')?>" name="date" value="{{$invoice->amount}}" placeholder="Enter your email">
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
                                <td><input type="text" name="transcation_id" class="form-control" value="{{$invoice->transcation_id}}"></td>
                                <td><input type="text" name="amount" class="form-control" value="{{$invoice->amount}}"></td>
                                <td>
                                    <select class="form-control" name="method">
                                        <option>select</option>
                                        <option value="PIMPS" {{(($invoice->method=='PIMPS')? 'selected' : '')}}>PIMPS</option>
                                        <option value="NEFT" {{(($invoice->method=='NEFT')? 'selected' : '')}}>NEFT</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" name="status">
                                        <option>select</option>
                                        <option value="Success" {{(($invoice->status=='Success')? 'selected' : '')}}>Success</option>
                                        <option value="Process" {{(($invoice->status=='Process')? 'selected' : '')}}>Process</option>
                                    </select>
                                </td>
                             </tr>
                            </tbody>
                            

                        </table>

                        

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



            $('tbody').delegate('.productname', 'change', function () {

                var  tr = $(this).parent().parent();
                tr.find('.qty').focus();

            })

            $('tbody').delegate('.productname', 'change', function () {

                var tr =$(this).parent().parent();
                var id = tr.find('.productname').val();
                var dataId = {'id':id};
                $.ajax({
                    type    : 'GET',
                    url     :'{!! URL::route('findPrice') !!}',

                    dataType: 'json',
                    data: {"_token": $('meta[name="csrf-token"]').attr('content'), 'id':id},
                    success:function (data) {
                        tr.find('.price').val(data.sales_price);
                    }
                });
            });

            $('tbody').delegate('.qty,.price,.dis', 'keyup', function () {

                var tr = $(this).parent().parent();
                var qty = tr.find('.qty').val();
                var price = tr.find('.price').val();
                var dis = tr.find('.dis').val();
                var amount = (qty * price)-(qty * price * dis)/100;
                tr.find('.amount').val(amount);
                total();
            });
            function total(){
                var total = 0;
                $('.amount').each(function (i,e) {
                    var amount =$(this).val()-0;
                    total += amount;
                })
                $('.total').html(total);
            }

            $('.addRow').on('click', function () {
                addRow();

            });

            function addRow() {
                var addRow = '<tr>\n' +
                    '         <td><select name="product_id[]" class="form-control productname " >\n' +
                    '         <option value="0" selected="true" disabled="true">Select Product</option>\n' +
                    '                                        @foreach($products as $product)\n' +
                    '                                            <option value="{{$product->id}}">{{$product->name}}</option>\n' +
                    '                                        @endforeach\n' +
                    '               </select></td>\n' +
                    '                                <td><input type="text" name="qty[]" class="form-control qty" ></td>\n' +
                    '                                <td><input type="text" name="price[]" class="form-control price" ></td>\n' +
                    '                                <td><input type="text" name="dis[]" class="form-control dis" ></td>\n' +
                    '                                <td><input type="text" name="amount[]" class="form-control amount" ></td>\n' +
                    '                                <td><a   class="btn btn-danger remove"> <i class="fa fa-remove"></i></a></td>\n' +
                    '                             </tr>';
                $('tbody').append(addRow);
            };


            $('.remove').live('click', function () {
                var l =$('tbody tr').length;
                if(l==1){
                    alert('you cant delete last one')
                }else{

                    $(this).parent().parent().remove();

                }

            });
        });


    </script>

@endpush




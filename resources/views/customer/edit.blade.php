@extends('layouts.master')
@section('title', 'Customer | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i>Edit  Customer</h1>

            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Customer</li>
                <li class="breadcrumb-item"><a href="#">Edit Customer</a></li>
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
                    <h3 class="tile-title">Customer</h3>
                    <div class="tile-body">
                        <form  method="POST" action="{{route('customer.update', $customer->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                <div class="row">
                    
                            <div class="form-group col-md-6">
                                <label class="control-label">Type</label>
                               
<select class="form-control" name="type">
    <option value="">Select</option>
    <option value="Customer" {{ isset($customer) && $customer->type == 'Customer' ? 'selected' : '' }}>Customer</option>
    <option value="Party" {{ isset($customer) && $customer->type == 'Party' ? 'selected' : '' }}>Party</option>
</select>
                                            
                                            
                               @error('type')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                    
                    
                            <div class="form-group col-md-6">
                                <label class="control-label"> Name</label>
                                <input name="name" class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Enter Customer Name" value="{{$customer->name}}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                              <div class="form-group col-md-6">
                                <label class="control-label"> Email ID</label>
                                <input name="email_id" class="form-control @error('email_id') is-invalid @enderror" type="text" placeholder="Enter Email ID" value="{{$customer->email_id}}">
                                @error('email_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">Mobile</label>
                                <input name="mobile" class="form-control @error('mobile') is-invalid @enderror" type="text" placeholder="Enter Mobile" value="{{$customer->mobile}}">
                                @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        

                            <div class="form-group col-md-6">
                                <label class="control-label"> Address</label>
                                <textarea name="address" class="form-control @error('address') is-invalid @enderror"> {{$customer->address}} </textarea>
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">City</label>
                               <input name="city" class="form-control @error('city') is-invalid @enderror" type="text" placeholder="Enter Customer City" value="{{$customer->city}}">
                                @error('city')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-group col-md-6">
                                <label class="control-label">Upload Ducument</label>
                               <input name="document" class="form-control @error('document') is-invalid @enderror" type="file" value="{{$customer->document}}">
                                @error('document')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror


                                @if($customer->document)
                                     <a href="{{asset('uploads/customers/'. $customer->document)}}" target="_blank">VIEW</a>
                                @else
                              Document Not Upload
                                @endif


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




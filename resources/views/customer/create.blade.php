@extends('layouts.master')
@section('title', 'Customer / Party | Atal Media')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i>Create Customer / Party</h1>
              
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Customer / Party</li>
                <li class="breadcrumb-item"><a href="#">Create Customer / Party</a></li>
            </ul>
        </div>

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="">
            <a class="btn btn-primary" href="{{route('customer.index')}}"><i class="fa fa-edit"> Customer / Party </i></a>
        </div>
        <div class="row mt-2">

            <div class="clearix"></div>
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Customer / Party</h3>
                    <div class="tile-body">
                        <form method="POST" action="{{route('customer.store')}}" enctype="multipart/form-data">
                            @csrf
                            
                            
                        
                <div class="row"> 
                
                   
                             <div class="form-group col-md-6">
                                <label class="control-label"> Type</label>
                            <select class="form-control" name="type" required>
                                <option value="">select</option>
                                <option value="Customer">Customer</option>
                                <option value="Party">Party</option>
                            </select>   
                            </div> 
                
                
                            <div class="form-group col-md-6">
                                <label class="control-label"> Name</label>
                                <input name="name" class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Enter Name" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                              <div class="form-group col-md-6">
                                <label class="control-label">Email Id</label>
                                <input name="email_id" class="form-control @error('email_id') is-invalid @enderror" type="text" placeholder="Enter Email Id">
                                @error('email_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label class="control-label"> Mobile</label>
                                <input name="mobile" class="form-control @error('mobile') is-invalid @enderror" type="text" placeholder="Enter Mobile" required>
                                @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            
                            <div class="form-group col-md-6">
                                <label class="control-label">Address</label>
                                <textarea name="address" class="form-control @error('address') is-invalid @enderror"></textarea>
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">City</label>
                               <input name="city" class="form-control @error('city') is-invalid @enderror" type="text" placeholder="Enter Customer City">
                                @error('city')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">Upload Ducument</label>
                               <input name="document" class="form-control @error('document') is-invalid @enderror" type="file">
                                @error('document')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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




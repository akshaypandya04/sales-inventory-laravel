@extends('layouts.master')
@section('title', 'Item | Atal Media')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i>Create Item</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Item</li>
                <li class="breadcrumb-item"><a href="#">Create Item</a></li>
            </ul>
        </div>

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="">
            <a class="btn btn-primary" href="{{route('items.index')}}"><i class="fa fa-edit"> Manage Item</i></a>
        </div>
        <div class="row mt-2">

            <div class="clearix"></div>
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Item</h3>
                    <div class="tile-body">
                        <form method="POST" action="{{route('items.store')}}">
                            @csrf
                            
                            
                      <div class="row"> 
                      
                          <div class="form-group col-md-4">
                                <label class="control-label">Category</label>
                            <select class="form-control" name="category_id" id="category_id">   
                            <option value="">-select category-</option>
                               @foreach($category as $value)
                                  <option value="{{$value->id}}">{{$value->category_name}}</option>
                               @endforeach
                            </select>   
                               
                                @error('item_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                       
                      
                            <div class="form-group col-md-4">
                                <label class="control-label">Item Name</label>
                                <input name="item_name" class="form-control @error('item_name') is-invalid @enderror" type="text" placeholder="Enter Item Name" required>
                                @error('item_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label class="control-label">Price</label>
                                <input name="price" class="form-control smtab_tot @error('price') is-invalid @enderror" type="text" placeholder="Enter INR" id="first" required>
                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                              <div class="form-group col-md-4">
                                <label class="control-label">Qty</label>
                                <input name="qty" class="form-control smtab_tot @error('qty') is-invalid @enderror" type="text" placeholder="Enter Qty" id="first" required>
                                @error('qty')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                             <div class="form-group col-md-4">
                                <label class="control-label">Type</label>
                               
                            <select class="form-control" name="type">
                                <option value="">select</option>
                                <option value="sqfeet">Sqfeet</option>
                                <option value="direct">Fixed</option>
                            </select>   
                                            
                                            
                               @error('type')
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
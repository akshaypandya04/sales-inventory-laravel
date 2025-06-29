@extends('layouts.master')


@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-edit"></i> Password Change </h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Change Password</li>
                <li class="breadcrumb-item"><a href="#"> Password Change </a></li>
            </ul>
        </div>
        
         @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        
        
        <div  class="col-md-6 offset-md-3">
                 <div class="tile">
                         <div class="col-lg-12">
                             <div>
                                 <div>
                                 <img width="60 px" class="app-sidebar__user-avatar"  src="{{ asset('images/user/'.Auth::user()->image) }}" alt="User Image">
                                    <p><span class="badge badge-dark">{{ Auth::user()->fullname }}</span></p>
                                  </div>
                             </div>
             <form method="POST" action="{{ url('/update-pwd') }}">
    {{ csrf_field() }}

    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>
        <div class="col-md-6">
            <input id="password" type="password" class="form-control" name="current_pwd" autocomplete="current-password" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="new_pwd" class="col-md-4 col-form-label text-md-right">New Password</label>
        <div class="col-md-6">
            <input id="new_pwd" type="password" class="form-control" name="new_pwd" autocomplete="new-password" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="new_pwd_confirmation" class="col-md-4 col-form-label text-md-right">Confirm New Password</label>
        <div class="col-md-6">
            <input id="new_pwd_confirmation" type="password" class="form-control" name="new_pwd_confirmation" autocomplete="new-password" required>
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-8 offset-md-4">
            <button type="submit" class="btn btn-primary">
                Update Password
            </button>
        </div>
    </div>
</form>

                        </div>
                     <div class="tile-footer">
                    </div>
             </div>
        </div>
     </main>

 @endsection

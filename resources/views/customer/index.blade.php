@extends('layouts.master')
@section('titel', 'Customer | Atal Media')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> Customer List</h1>
            
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Customer</li>
                <li class="breadcrumb-item active"><a href="#">Customer List</a></li>
            </ul>
        </div>
        
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        
        <div class="">
            <a class="btn btn-primary" href="{{route('customer.create')}}"><i class="fa fa-plus"> Add Customer</i></a>
        </div>

        <div class="row mt-2">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                         <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>Customer Name </th>
                                <th>Type </th>
                                <th>Address </th>
                                <th>Mobile</th>
                                <th>Customer Email</th>
                                <th>Attachment</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $customers as $customer)
                            <tr>
                                <td>{{ $customer->name }} </td>
                                <td>{{ $customer->type }} </td>
                                <td>{{ $customer->address }} </td>
                                <td>{{ $customer->mobile }} </td>
                                <td>{{ $customer->email_id }} </td>
                                <td>
                                @if($customer->document)    
                                     <a href="{{asset('uploads/customers/'. $customer->document)}}" target="_blank">VIEW</a>
                                @else
                                -
                                @endif
                                </td>
                                 <td>
                                    <a class="btn btn-primary" href="{{route('customer.show', $customer->id)}}"><i class="fa fa-eye" ></i></a>
                                    <a class="btn btn-primary" href="{{route('customer.edit', $customer->id)}}"><i class="fa fa-edit" ></i></a>
                                    <button class="btn btn-danger waves-effect" type="submit" onclick="deleteTag({{ $customer->id }})">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                    <form id="delete-form-{{ $customer->id }}" action="{{ route('customer.destroy',$customer->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div> </div>
                </div>
            </div>
        </div>
    </main>



@endsection

@push('js')
    <script type="text/javascript" src="{{asset('/')}}js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{asset('/')}}js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script type="text/javascript">
        function deleteTag(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>
@endpush

@extends('layouts.master')
@section('titel', 'Payment | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i>Payment List</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Payment</li>
                <li class="breadcrumb-item active"><a href="#">Payment List</a></li>
            </ul>
        </div>
        <div class="">
            <a class="btn btn-primary" href="{{route('payment.create')}}"><i class="fa fa-plus"> Add Payment</i></a>
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
                                <th>Date</th>
                                <th>Type</th>
                                <th>Product Details</th>
                                <th>Total Amount</th>
                                <th>Recived Amount</th>
                                <th>Due Amount</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payments as $payment)
                            <tr>
                                <td> 
                                  @if(!empty($payment->customer_name))     
                                      {{$payment->customer_name}}
                                 @else
                                 -
                                 @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($payment->date)->format('d-m-Y') }}</td>
                                 <td> {{$payment->mode}} </td>
                                <td> {{$payment->product_name}} </td>
                                <td> {{$payment->amount}} </td>
                                <td> {{$payment->recived_amount}} </td>
                                <td> {{$payment->due_amount}} </td>
                                 <td>
                                    
                                    <a class="btn btn-primary" href="{{route('payment.edit',$payment->id)}}"><i class="fa fa-edit" ></i></a>
                                   <button class="btn btn-danger waves-effect" type="submit" onclick="deleteTag({{ $payment->id }})">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                    <form id="delete-form-{{ $payment->id }}" action="{{ route('payment.destroy',$payment->id) }}" method="POST" style="display: none;">
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

@extends('layouts.master')

@section('titel', 'Rates | ')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i>Rates List</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Rates</li>
                <li class="breadcrumb-item active"><a href="#">Rates List</a></li>
            </ul>
        </div>
        
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        
        <div class="">
            <a class="btn btn-primary" href="{{route('unit.create')}}"><i class="fa fa-plus"> Add Rates</i></a>
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
                                <th>INR</th>
                                <th>CUST RATE</th>
                                <th>AED</th>
                                <th>PUR RATE</th>
                                <th>S.PRICES</th>
                                <th>PROFIT</th>
                                <th>PARTY</th>
                                <th>PAYMENT</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            
                              <tfoot style="background-color: aliceblue;">
                            <tr>
                                <td> TOTAL </td>
                                <td> {{$inr_sum}} </td>
                                <td> </td>
                                <td>{{round($aed_sum, 2)}} </td>
                                <td> </td>
                                <td> {{round($s_prices_sum, 2)}}</td>
                                <td>{{$profit_sum}} </td>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                            </tr>
                        </tfoot>
                            
                            <tbody>
                            @foreach( $units as $unit)
                            <tr>
                                <td>{{ $unit->customer_name }} </td>
                                <td>{{ $unit->inr }} </td>
                                <td>{{ $unit->cus_rate }} </td>
                                <td>{{round($unit->aed, 2)}}</td>
                                <td>{{ $unit->pur_rate }} </td>
                                <td>{{round($unit->s_prices, 2)}}</td>
                                <td>{{ $unit->profit }} </td>
                                <td>{{ $unit->party }} </td>
                                <td>{{ $unit->payment }} </td>
                                <td>
                                    <a class="btn btn-primary" href="{{route('unit.edit', $unit->id)}}"><i class="fa fa-edit" ></i></a>
                                    <button class="btn btn-danger waves-effect" type="submit" onclick="deleteTag({{ $unit->id }})">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                    <form id="delete-form-{{ $unit->id }}" action="{{ route('unit.destroy',$unit->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                   </div>
                    </div>
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

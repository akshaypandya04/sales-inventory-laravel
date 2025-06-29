@extends('layouts.master')
@section('title', 'Purchase Report | Atal Media')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i>Purchase Report</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Purchase Report</li>
                <li class="breadcrumb-item active"><a href="#">Purchase Report</a></li>
            </ul>
        </div>
          <div class="">
            
        <form action="{{route('purchases.filter')}}" method="GET">
            
            <div class="row">
                
                  <div class="col-md-4">
                      <lebal>From</lebal>
                       <input type="date" class="form-control" name="start_date"  value="{{ request('start_date', \Carbon\Carbon::now()->format('Y-m-d')) }}">
                  </div>
                  
                    <div class="col-md-4">
                        <lebal>To</lebal>
                       <input type="date" class="form-control" name="end_date" value="{{ request('end_date', \Carbon\Carbon::now()->format('Y-m-d')) }}">
                  </div>
                  
                    <div class="col-md-4">
                        <br>
                      <button class="btn btn-primary" type="submit">Filter</button>
                  </div>
            </div>
            
            
        </form>    
            
            
        </div>

        <div class="row mt-2">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>Party Name </th>
                                <th>Purchase Date</th>
                                <th>Bill Amount</th>
                                <th>Paid Amount</th>
                                <th>Remain Amount</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($purchases as $purchase)
                            <tr>
                                <td> 
                                  @if(!empty($purchase->party->name))     
                                      {{$purchase->party->name}}
                                 @else
                                 -
                                 @endif
                                </td>
                                <td> {{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d-m-Y') }} </td>
                                <td> {{$purchase->final_amount}} </td>
                                <td> {{$purchase->paid_amount}} </td>
                                <td> {{$purchase->remain_amount}} </td>
                                 <td>
                                   
                                    <a class="btn btn-primary" href="{{route('purchases.edit',$purchase->id)}}"><i class="fa fa-edit" ></i></a>
                                    
                                   <button class="btn btn-danger waves-effect" type="submit" onclick="deleteTag({{ $purchase->id }})">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                    <form id="delete-form-{{ $purchase->id }}" action="{{ route('purchases.destroy',$purchase->id) }}" method="POST" style="display: none;">
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

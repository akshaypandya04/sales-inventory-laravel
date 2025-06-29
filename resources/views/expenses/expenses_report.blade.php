@extends('layouts.master')
@section('title', 'Expense Report | Atal Media')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i>Expense Report</h1>
                
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"> Expense Report</li>
                <li class="breadcrumb-item active"><a href="#">Expense Report</a></li>
            </ul>
        </div>
        
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        
        
        <div class="">
                  
        <form action="{{route('expenses.filter')}}" method="GET">
            
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
                                <th>Expense Date </th>
                                <th>To </th>
                                <th>Item </th>
                                <th>Paid Amount </th>
                                <th>Action</th>
                            </tr>
                            </thead>
                             <tbody>

                             @foreach($expenses as $expense)
                                 <tr>
                                     <td>{{ date('Y-m-d', strtotime($expense->date)) }}</td>
                                     <td>{{$expense->to}}</td>
                                     <td>{{$expense->item}}</td>
                                     <td>{{$expense->paid_amount}}</td>
                                     
                                     <td>
                                        
                                         <a class="btn btn-primary" href="{{route('expenses.edit', $expense->id)}}"><i class="fa fa-edit" ></i></a>

                                         <button class="btn btn-danger waves-effect" type="submit" onclick="deleteTag({{ $expense->id }})">
                                             <i class="fa fa-trash-o"></i>
                                         </button>
                                         <form id="delete-form-{{ $expense->id }}" action="{{ route('expenses.destroy',$expense->id) }}" method="POST" style="display: none;">
                                             @csrf
                                             @method('DELETE')
                                         </form>
                                     </td>
                                 </tr>
                             @endforeach
                            </tbody>
                        </table>
                    </div>  </div>
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

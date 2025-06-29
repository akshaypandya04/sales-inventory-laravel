@extends('layouts.master')
@section('title', 'Profit Report | Atal Media')
@section('content')
    @include('partials.header')
    @include('partials.sidebar')

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i>Profit Report</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Profit Report</li>
                <li class="breadcrumb-item active"><a href="#">Profit Report</a></li>
            </ul>
        </div>
          <div class="">
            
<form method="GET" action="{{ route('report.daywise.profit') }}">
    <div class="row">
        <div class="col-md-3">
            <label>From</label>
            <input type="date" name="from" class="form-control" 
                   value="{{ request('from', \Carbon\Carbon::now()->format('Y-m-d')) }}">
        </div>
        <div class="col-md-3">
            <label>To</label>
            <input type="date" name="to" class="form-control" 
                   value="{{ request('to', \Carbon\Carbon::now()->format('Y-m-d')) }}">
        </div>
        <div class="col-md-3 align-self-end">
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
    </div>
</form>

            
            
        </div>

        <div class="row mt-2">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="table-responsive">
                       
                       
 @if(isset($sales))
    <table class="table table-bordered mt-4">
        <tr><th>Sales</th><td>{{ number_format($sales, 2) }}</td></tr>
        <tr><th>Purchase</th><td>- {{ number_format($purchases, 2) }}</td></tr>
        <tr><th>Expense</th><td>- {{ number_format($expenses, 2) }}</td></tr>
        <tr><th>Total</th><td>{{ number_format($profit, 2) }}</td></tr>
    </table>
@endif        
                       
                       
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

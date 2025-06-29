<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
                <div class="info">
                   <a href="{{route('sales.index')}}"> <h4>Sales</h4> </a>
                    <p><b>{{  $count = \DB::table('sales_entries')->count() }}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon"><i class="icon fa fa-list fa-3x"></i>
                <div class="info">
                  <a href="{{route('purchases.index')}}">  <h4>Purchase</h4> </a>
                    <p><b>{{  $count = \DB::table('purchases')->count() }}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
                <div class="info">
              <a href="{{route('customer.index')}}">      <h4>Customers</h4> </a>
                    <p><b>{{  $count = \DB::table('customers')->count() }}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small danger coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                <div class="info">
              <a href="{{route('expenses.index')}}"> <h4> Expenses </h4> </a>
                    <p><b>{{  $count = \DB::table('expenses')->count() }}</b></p>
                </div>
            </div>
        </div>
    </div>
   
</main>

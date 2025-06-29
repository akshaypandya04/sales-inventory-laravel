<style>
    .app-header {
        background-color: #17a2b8;
    }

    .app-header__logo {
    background-color: #d6ba4b;
}

</style>

<div class="app-sidebar__overlay" data-toggle="sidebar"></div>

<aside class="app-sidebar">
    <div class="app-sidebar__user">


        <div>
            <!--<p class="app-sidebar__user-name">{{ Auth::user()->fullname }}</p>-->
             <h3 style="padding-left: 6px;">Manage Sales Purchase </h3>  
           <!--<img src="{{asset('images/atal.jpg')}}" style="height: 117px;">-->
        </div>
    </div>
    <ul class="app-menu">
        <li><a class="app-menu__item active" href="{{url('/dashboard')}}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        
        
          <li class="treeview "><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-exchange"></i><span class="app-menu__label">Master</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                
               <li><a class="treeview-item" href="{{route('customer.index')}}"><i class="icon fa fa-circle-o"></i> Manage Customer</a></li>
               
               <li><a class="treeview-item" href="{{route('party.list')}}"><i class="icon fa fa-circle-o"></i> Manage Party</a></li>

              <li><a class="treeview-item" href="{{route('payment.index')}}"><i class="icon fa fa-circle-o"></i> Manage Payment</a></li>
              
              <li><a class="treeview-item" href="{{route('items.index')}}"><i class="icon fa fa-edit"></i>Manage Item</a></li>  
        
            </ul>
        </li>
        

        <li class="treeview "><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-indent"></i><span class="app-menu__label">Manage Sales</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item " href="{{route('sales.create')}}"><i class="icon fa fa-plus"></i>Create Sales </a></li>
                 <li><a class="treeview-item" href="{{route('sales.index')}}"><i class="icon fa fa-edit"></i>Manage Sales</a></li>  
            </ul>
        </li>
        
         <li class="treeview "><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-indent"></i><span class="app-menu__label">Manage Purchase</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item " href="{{route('purchases.create')}}"><i class="icon fa fa-plus"></i>Create Purchase </a></li>
                 <li><a class="treeview-item" href="{{route('purchases.index')}}"><i class="icon fa fa-edit"></i>Manage Purchase</a></li>  
            </ul>
        </li>


        <!--<li class="treeview "><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-industry"></i><span class="app-menu__label">Category</span><i class="treeview-indicator fa fa-angle-right"></i></a>-->
        <!--    <ul class="treeview-menu">-->
        <!--        <li><a class="treeview-item " href="{{route('category.create')}}"><i class="icon fa fa-plus"></i>Create Category</a></li>-->
        <!--        <li><a class="treeview-item" href="{{route('category.index')}}"><i class="icon fa fa-edit"></i>Manage Category</a></li>-->
        <!--    </ul>-->
        <!--</li>-->

        <!--<li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-briefcase"></i><span class="app-menu__label">Product</span><i class="treeview-indicator fa fa-angle-right"></i></a>-->
        <!--    <ul class="treeview-menu">-->
        <!--        <li><a class="treeview-item" href="{{route('product.create')}}"><i class="icon fa fa-circle-o"></i> New Product</a></li>-->
        <!--        <li><a class="treeview-item" href="{{route('product.index')}}"><i class="icon fa fa-circle-o"></i> Manage Products</a></li>-->
        <!--    </ul>-->
        <!--</li>-->

        <!--<li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-object-group"></i><span class="app-menu__label">Tax</span><i class="treeview-indicator fa fa-angle-right"></i></a>-->
        <!--    <ul class="treeview-menu">-->
        <!--        <li><a class="treeview-item" href="{{route('tax.create')}}"><i class="icon fa fa-circle-o"></i> Add Tax</a></li>-->
        <!--        <li><a class="treeview-item" href="{{route('tax.index')}}"><i class="icon fa fa-circle-o"></i> Manage Taxs</a></li>-->
        <!--     </ul>-->
        <!--</li>-->

   <!--   <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-bars"></i><span class="app-menu__label">Rates</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{route('unit.create')}}"><i class="icon fa fa-circle-o"></i> Add Rates</a></li>
                <li><a class="treeview-item" href="{{route('unit.index')}}"><i class="icon fa fa-circle-o"></i> Manage Rates</a></li>
            </ul>
        </li>  -->

        <!--<li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Customer</span><i class="treeview-indicator fa fa-angle-right"></i></a>-->
        <!--<ul class="treeview-menu">-->
        <!--    <li><a class="treeview-item" href="{{route('customer.create')}}"><i class="icon fa fa-circle-o"></i> Add Customer</a></li>-->
        <!--      <li><a class="treeview-item" href="{{route('customer.index')}}"><i class="icon fa fa-circle-o"></i> Manage Customer</a></li>-->
        <!-- </ul>-->
        <!--</li>-->

      
        
         <li class="treeview "><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-exchange"></i><span class="app-menu__label">Manage Expenses</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
    
               <li><a class="treeview-item" href="{{route('expenses.create')}}"><i class="icon fa fa-circle-o"></i> Add Expenses</a></li>
               
              <li><a class="treeview-item" href="{{route('expenses.index')}}"><i class="icon fa fa-circle-o"></i> Manage Expenses</a></li>
        
            </ul>
        </li>


         <li class="treeview "><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-file"></i><span class="app-menu__label">Reports</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                
                 <li><a class="treeview-item " href="{{route('sales.report')}}"><i class="icon fa fa-circle-o"></i>Sales Report</a></li>  
                 
                <li><a class="treeview-item " href="{{route('customer.report')}}"><i class="icon fa fa-circle-o"></i>Customers Report</a></li>
                
                 <li><a class="treeview-item" href="{{route('purchases.report')}}"><i class="icon fa fa-circle-o"></i>Purchases Report</a></li> 
                 
                 <li><a class="treeview-item" href="{{route('expenses.report')}}"><i class="icon fa fa-circle-o"></i>Expenses Report</a></li> 
                 
                  <li><a class="treeview-item" href="{{route('report.daywise.profit')}}"><i class="icon fa fa-circle-o"></i>Profit Report</a></li> 
            </ul>
        </li>

       <!--   <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-money"></i><span class="app-menu__label">Payment</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{route('payment.create')}}"><i class="icon fa fa-circle-o"></i> Add Payment</a></li>
                <li><a class="treeview-item" href="{{route('payment.index')}}"><i class="icon fa fa-circle-o"></i> Manage Payment</a></li>
            </ul>
        </li>  -->

    </ul>
</aside>

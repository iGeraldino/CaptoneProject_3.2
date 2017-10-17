  <header class="main-header">
    <!-- Logo -->
    <a href="/" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Wonderbloom</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <li class="admin-name">
           @if(Auth::guard('admins')->check())
            <a href="#" class = 'dropdown-toggle' data-toggle="dropdown"> Hello Admin <b>{{ Auth::guard('admins')->user()->username }} </b></a>
            <ul class = "dropdown-menu">
              
              <a href="{{ route('adminlogout')   }}" class="text-center"> <h4> Logout </h4> </a>

            </ul>
            @endif
          </li>
          <!-- Messages: style can be found in dropdown.less-->
          <!-- Menu Footer-->
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" class = 'dropdown-toggle' data-toggle="dropdown"><span class="label label-pill label-danger count "></span><i class="material-icons md-48">notifications</i>
            </a>
            <ul class = "dropdown-menu"></ul>
          </li>

        </ul>
      </div>
    </nav>
</header>

<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: Dashboard -->
    <ul class="sidebar-menu">
      <li class="treeview">
        <a href="/inventory_dashboard">
          <i class="material-icons">dashboard</i> <span>Dashboard</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
      </li>
    </ul>
 
   <!-- sidebar menu: oRDERS -->
    <ul class="sidebar-menu">
      <li class="treeview">
        <a href="#">
          <i class="material-icons">&#xE85D;</i> <span>Orders</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="/inventory_sales_order"><i class="fa fa-circle-o"></i> Sales Order
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
        </ul>
      </li>
    </ul>  

      <!-- sidebar menu: Inventory -->
      <ul class="sidebar-menu">
        <li class="treeview">
          <a href="#">
            <i class="material-icons">&#xE0AF;</i><span>Inventory</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="#"><i class="fa fa-circle-o"></i> Flowers
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="/inventory_flower_list"><i class="fa fa-circle-o"></i> Flower List</a></li>
                <li><a href="/inventory_side_transaction"><i class="fa fa-circle-o"></i> Inventory Transaction</a></li>
                <li><a href="/inventory_side_schedule"><i class="fa fa-circle-o"></i> Schedule Inventory</a></li>
                <li><a href="/inventory_flower_price_list"><i class="fa fa-circle-o"></i> Flower Price List</a></li>
              </ul>
            </li>
            <li><a href="/acc"><i class="fa fa-circle-o"></i> Other Items</a></li>
            <li>
              <a href="#"><i class="fa fa-circle-o"></i> Inventory Transactions
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href=""><i class="fa fa-circle-o"></i> Overall Inventory Transactions</a></li>
                <li><a href="/inventory_side_flower_transaction"><i class="fa fa-circle-o"></i> Flower Inventory Transaction</a></li>
                <!--<li><a href="#"><i class="fa fa-circle-o"></i> Reserved Flowers</a></li>-->
                <li><a href=""><i class="fa fa-circle-o"></i> Accessories Invetory Transactions</a></li>
              </ul>
            </li>







            
          </ul>
        </li>
      </ul>

      <!-- sidebar menu: Online shop -->
      <ul class="sidebar-menu">
        <li class="treeview">
          <a href="/WonderbloomFlowershop">
            <i class="material-icons">store_directory</i> <span>Online Shop</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
      </ul>

    </section>
    <!-- /.sidebar -->
  </aside>

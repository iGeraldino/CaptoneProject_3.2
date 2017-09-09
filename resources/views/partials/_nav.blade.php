

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
           @if(Auth::check())
            <a href="#" class = 'dropdown-toggle' data-toggle="dropdown"> Hello Admin <b>{{ Auth::user()->username }} </b></a>
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
        <a href="/dashboard">
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
            <a href="/Sales_Qoutation"><i class="fa fa-circle-o"></i> Sales Order
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
        </ul>
        <ul class="treeview-menu">
          <li>
            <a href="/quickorder"><i class="fa fa-circle-o"></i> Make Quick Order
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
        </ul>
        <ul class="treeview-menu">
          <li>
            <a href="/Long_Sales_Order"><i class="fa fa-circle-o"></i> Make Long Order
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
        </ul>
      </li>
    </ul>

    <!-- sidebar menu: Customers -->
      <ul class="sidebar-menu">
        <li class="treeview">
          <a>
             <i class="material-icons">&#xE87C;</i> <span>Customers</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
           <ul class="treeview-menu">
                <li><a href="/customers"><i class="fa fa-circle-o"></i> Customer List</a></li>
                <li><a href="/TradeAgreements"><i class="fa fa-circle-o"></i> Customer Trade Agreement</a></li>
               <!-- <li><a href="#"><i class="fa fa-circle-o"></i> Customer_Invoice</a></li>-->
            </ul>
        </li>
      </ul>

      <!-- sidebar menu: Supplier -->
      <ul class="sidebar-menu">
        <li class="treeview">
          <a href="#">
            <i class="material-icons">&#xE8D3;</i> <span>Suppliers</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
             <ul class="treeview-menu">
            <li>
              <a href="/supplieradd"><i class="fa fa-circle-o"></i> Supplier List
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>

            <!--<li><a href="\supplierMoreDetails"><i class="fa fa-circle-o"></i> Price List</a></li>-->
          </ul>
          </a>
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
                <li><a href="/floweradd"><i class="fa fa-circle-o"></i> Flower List</a></li>
                <li><a href="/FlowerInventory_Transactions"><i class="fa fa-circle-o"></i> Inventory Transaction</a></li>
                <!--<li><a href="#"><i class="fa fa-circle-o"></i> Reserved Flowers</a></li>-->
                <li><a href="/InventoryScheduling"><i class="fa fa-circle-o"></i> Schedule Invetory</a></li>
                <li><a href="/Shop_Pricelist"><i class="fa fa-circle-o"></i> Flower Price List</a></li>
              </ul>
            </li>
            <li><a href="/acc"><i class="fa fa-circle-o"></i> Other Items</a></li>
          </ul>
        </li>
      </ul>
      <!-- sidebar menu: BOUQUET -->
      <ul class="sidebar-menu">
        <li class="treeview">
          <a href="/bouquet">
            <i class="material-icons">local_florist</i> <span>Bouquet</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
      </ul>

      <!-- sidebar menu: SETTINGS -->
      <ul class="sidebar-menu">
        <li class="treeview">
          <a href="#">
            <i class="material-icons">&#xE8B8;</i> <span>Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
      </ul>


      <!-- sidebar menu: Administrator Account Management -->
      <ul class="sidebar-menu">
        <li class="treeview">
          <a href="#">
            <i class="material-icons">&#xE8D3;</i> <span>Admin Accounts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
             <ul class="treeview-menu">
            <li>
              <a href="/Admins"><i class="fa fa-circle-o"></i> Accounts List
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
          </ul>
          </a>
        </li>
      </ul>

      <!-- sidebar menu: Online shop -->
      <ul class="sidebar-menu">
        <li class="treeview">
          <a href="/home">
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

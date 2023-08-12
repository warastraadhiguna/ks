  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ URL::to('/'); }}/admin/dashboard" class="brand-link">
      <img src="{{ URL::to('/'); }}/img/icon.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">RMS Online</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ URL::to('/admin/dashboard'); }}" class="nav-link {{ Request::is('admin/dashboard')? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item  {{ Request::is('admin/receipt*')? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                Data
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ URL::to('/admin/receipt/sale'); }}" class="nav-link {{ Request::is('admin/receipt/sale')? 'active' : '' }}">
                  <i class="far fa-circle nav-icon ml-3"></i>
                  <p>Penjualan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ URL::to('/admin/receipt/sale-resume'); }}" class="nav-link {{ Request::is('admin/receipt/sale-resume')? 'active' : '' }}">
                  <i class="far fa-circle nav-icon ml-3"></i>
                  <p>Ringkasan Penjualan</p>
                </a>
              </li>       
              <li class="nav-item">
                <a href="{{ URL::to('/admin/receipt/sale-product-resume'); }}" class="nav-link {{ Request::is('admin/receipt/sale-product-resume')? 'active' : '' }}">
                  <i class="far fa-circle nav-icon ml-3"></i>
                  <p>Ringkasan Produk</p>
                </a>
              </li>              
              <li class="nav-item">
                <a href="{{ URL::to('/admin/receipt/purchasing'); }}" class="nav-link {{ Request::is('admin/receipt/purchasing')? 'active' : '' }}">
                  <i class="far fa-circle nav-icon ml-3"></i>
                  <p>Pembelian</p>
                </a>
              </li>                           
            </ul>
          </li>   
          <li class="nav-item  {{ Request::is('admin/stock*')? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-shopping-bag"></i>
              <p>
                Stok
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ URL::to('/admin/stock/detail'); }}" class="nav-link {{ Request::is('admin/stock/detail')? 'active' : '' }}">
                  <i class="far fa-circle nav-icon ml-3"></i>
                  <p>Data Stok</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ URL::to('/admin/stock/total'); }}" class="nav-link {{ Request::is('admin/stock/total')? 'active' : '' }}">
                  <i class="far fa-circle nav-icon  ml-3"></i>
                  <p>Stok Total</p>
                </a>
              </li>
            </ul>
          </li>                  
          <li class="nav-item">
            <a href="{{ URL::to('/admin/user'); }}" class="nav-link {{ Request::is('admin/user*')? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                User
              </p>
            </a>
          </li>        
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
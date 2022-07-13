  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('adminLTE/dist/img/AdminLTELogo.png')}}" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            
          <li class="nav-item">
            <a href="{{ Route('index') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-header">Data</li>
          <li class="nav-item">
            <a href="{{ route('produk') }}" class="nav-link">
              <i class="nav-icon fa fa-plus-circle"></i>
              <p>
                Produk
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{ route('penjualan') }}" class="nav-link">
              <i class="nav-icon fa fa-plus-circle"></i>
              <p>
                Penjualan
              </p>
            </a>
          </li>
          <li class="nav-header">Perhitungan SMA</li>
          <li class="nav-item">
            <a href="{{ route('perhitungan') }}" class="nav-link">
              <i class="nav-icon fa fa-briefcase"></i>
              <p>
                Perhitungan
              </p>
            </a>
          </li>
          <li class="nav-header">Error</li>
          <li class="nav-item">
            <a href="{{ route('error') }}" class="nav-link">
              <i class="nav-icon fa fa-briefcase"></i>
              <p>
                Error
              </p>
            </a>
          </li>
          <li class="nav-header">Setting</li>
          <li class="nav-item">
            <a href="{{ route('error') }}" class="nav-link">
              <i class="nav-icon fa fa-circle"></i>
              <p>
                User
              </p>
            </a>
          </li>

          <li class="nav-item">
            <form action="{{ Route('logout') }}" method="post">
            @csrf
              <button type="submit" class="nav-link active">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                  Log out
                </p>
              </button>
            </form>
          </li>
          
          
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
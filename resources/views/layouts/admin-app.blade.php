<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Admin Dashboard - VitaGuard')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  @stack('styles')
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/') }}" class="nav-link">Lihat Web Publik</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/admin/dashboard') }}" class="brand-link">
      <span class="brand-text font-weight-light text-center d-block font-weight-bold">VitaGuard Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        @if(auth()->check() && auth()->user()->photo)
            <img src="{{ asset('storage/' . auth()->user()->photo) }}" class="img-circle elevation-2" alt="User Image">
        @else
            <img src="https://ui-avatars.com/api/?name=Admin&background=e7f1ff&color=0d6efd" class="img-circle elevation-2" alt="User Image">
        @endif
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->check() ? auth()->user()->name : 'Guest User' }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @if(auth()->check() && auth()->user()->role == 'admin')
            <!-- Admin Menu -->
            <li class="nav-header">ADMINISTRATOR</li>
            <li class="nav-item">
                <a href="{{ url('admin/dashboard') }}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <i class="nav-link-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/users') }}" class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}">
                <i class="nav-link-icon fas fa-users"></i>
                <p>Kelola User</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/doctors') }}" class="nav-link {{ request()->is('admin/doctors*') ? 'active' : '' }}">
                <i class="nav-link-icon fas fa-user-md"></i>
                <p>Kelola Dokter</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/articles') }}" class="nav-link {{ request()->is('admin/articles*') ? 'active' : '' }}">
                <i class="nav-link-icon fas fa-newspaper"></i>
                <p>Kelola Artikel</p>
                </a>
            </li>
            @endif

            @if(auth()->check() && auth()->user()->role == 'doctor')
            <!-- Doctor Menu -->
            <li class="nav-header">DOKTER</li>
            <li class="nav-item">
                <a href="{{ url('doctor/dashboard') }}" class="nav-link {{ request()->is('doctor/dashboard') ? 'active' : '' }}">
                <i class="nav-link-icon fas fa-tachometer-alt"></i>
                <p>Dashboard Dokter</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('doctor/consultations') }}" class="nav-link {{ request()->is('doctor/consultations*') ? 'active' : '' }}">
                <i class="nav-link-icon fas fa-stethoscope"></i>
                <p>Konsultasi</p>
                </a>
            </li>
            @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@yield('page-title')</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card shadow-sm">
        <div class="card-body">
            @yield('content')
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <strong>Copyright &copy; {{ date('Y') }} VitaGuard.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
@stack('scripts')
</body>
</html>

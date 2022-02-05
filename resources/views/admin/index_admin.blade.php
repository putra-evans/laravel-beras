<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Dashboard</title>
{{-- HALAMAN HEADER --}}
@include('admin.layout.header')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('assets/dist/img/padi.png')}}" alt="logo" height="100" width="100">
  </div>
{{-- HALAMAN NAV --}}
@include('admin.layout.nav')
{{-- HALAMAN SIDEBAR --}}
@include('admin.layout.sidebar')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    @yield('content')

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  {{-- HALAMAN FOOTER --}}
@include('admin.layout.footer')
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

{{-- HALAMAN SCRIPT --}}
@include('admin.layout.js')
@yield('script')
</body>
</html>

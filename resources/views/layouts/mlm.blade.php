<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>ROIC Partner Panel</title>
  <!-- Bootstrap core CSS-->
  <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="{{ asset('datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>ROIC</title>

  <!-- Scripts -->
  <script src="{{ asset('jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('js/app_mlm.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
  <!-- Styles -->
  <script>
    var domain = 'http://<?php echo $_SERVER['HTTP_HOST']; ?>/';
  </script>
</head>
<body>
  <div id="app" class="app">

    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
      <router-link class="navbar-brand" to="/dashboard">ROIC Partner</router-link>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
          <li class="nav-item" data-toggle="tooltip" data-placement="right">
            <router-link class="nav-link" to="/dashboard">
              <span class="nav-link-text">Dashboard</span>
            </router-link>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right">
            <router-link class="nav-link" to="/withdraw">
              <span class="nav-link-text">Request Withdraw</span>
            </router-link>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right">
            <router-link class="nav-link" to="/transactions">
              <span class="nav-link-text">Transaction History</span>
            </router-link>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right">
            <router-link class="nav-link" to="/income">
              <span class="nav-link-text">My Income</span>
            </router-link>
            <ul class="sidenav-second-level collapse" id="collapseComponents">
              <li>
                <a href="navbar.html">Referral Commission</a>
              </li>
            </ul>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
            <router-link class="nav-link" to="/referrals">
              <span class="nav-link-text">Referrals</span>
            </router-link>
            <ul>
              <li class="nav-item">
                <router-link to="/referrals/options">Banners & Referral Link</router-link>
              </li>
            </ul>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
            <router-link class="nav-link" to="/tree">
              <span class="nav-link-text">My Tree</span>
            </router-link>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
            <router-link class="nav-link" to="/settings">
              <span class="nav-link-text">Settings</span>
            </router-link>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
            <router-link class="nav-link" to="/support">
              <span class="nav-link-text">Support ticket</span>
            </router-link>
          </li>
        </ul>
        <ul class="navbar-nav sidenav-toggler">
          <li class="nav-item">
            <a class="nav-link text-center" id="sidenavToggler">
              <i class="fa fa-fw fa-angle-left"></i>
            </a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <!--
          <li class="nav-item">
            <form class="form-inline my-2 my-lg-0 mr-lg-2">
              <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for...">
                <span class="input-group-append">
                  <button class="btn btn-primary" type="button">
                    <i class="fa fa-search"></i>
                  </button>
                </span>
              </div>
            </form>
          </li>
          -->
          <!-- data-toggle="modal" data-target="#exampleModal" -->
          @if(Auth::user())
          <li class="nav-item">
            <a class="nav-link">
              ROIC Coins: <strong>@{{user.roic_coins}}</strong>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link">
              @{{user.email}}
            </a>
          </li>
          @else
          <li class="nav-item">
            <a class="nav-link">
              Login
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link">
              Register
            </a>
          </li>
          @endif
        </ul>
      </div>
    </nav>

    <div class="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <!--
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">My Dashboard</li>
        </ol>
        -->

        @yield('content')


      </div>
      <!-- /.container-fluid-->
      <!-- /.content-wrapper-->
      <footer class="sticky-footer">
        <div class="container">
          <div class="text-center">
            <small>Copyright © ROIC 2018</small>
          </div>
        </div>
      </footer>
      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
      </a>
      <!-- Logout Modal-->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Core plugin JavaScript-->
  <script src="{{ asset('jquery-easing/jquery.easing.min.js') }}"></script>
  <!-- Page level plugin JavaScript-->
  <script src="{{ asset('chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('datatables/dataTables.bootstrap4.js') }}"></script>
  <!-- Custom scripts for all pages-->
  <script src="{{ asset('js/sb-admin.min.js') }}"></script>
  <!-- Custom scripts for this page-->
  <script src="{{ asset('js/sb-admin-datatables.min.js') }}"></script>
  <script src="{{ asset('js/sb-admin-charts.min.js') }}"></script>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

</body>
</html>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{$title??null}}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{csrf_token()}}" />
  <link rel="stylesheet" href="{{ asset('/public/css/admin.css') }}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed text-sm">
<div class="wrapper"  id="app">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
		<li class="nav-item dropdown">
			<a class="nav-link" href="#">
				<i class="fas fa-user"></i>
				{{Auth::user()->name}}
			</a>
		</li>
		<li class="nav-item dropdown">
			<a class="nav-link" href="{{ route('logout') }}">
				<i class="fas fa-sign-out-alt"></i>
			</a>
		</li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="brand-link">
		<span class="brand-text font-weight-light ml-3">{{Config::get('app.name',null)}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
			<li class="nav-item">
				<router-link :to="{name:'AdminUsersList'}" class="nav-link" class="nav-link" active-class="active"> 
					<i class="nav-icon fas fa-users"></i>
					<p>
						{{ __('Users') }}
					</p>
				</router-link>
			</li>
			<li class="nav-item">
				<router-link :to="{name:'AdminDepartmentsList'}" class="nav-link" active-class="active"> 
					<i class="nav-icon fas fa-file-alt"></i>
					<p>
						{{ __('Departments') }}
					</p>
				</router-link>
			</li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"><router-view></router-view></div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; <a href="#">{{Config::get('app.name',null)}}</a>.</strong>
    All rights reserved. 
  </footer>
</div>
<!-- ./wrapper -->

<!-- script -->
<script src="{{ asset('/public/js/admin.js') }}"></script>
</body>
</html>

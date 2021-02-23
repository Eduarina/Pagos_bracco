<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>

  
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('bower_components') }}/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('bower_components') }}/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('bower_components') }}/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css') }}/AdminLTE.min.css">
  <link rel="stylesheet" href="{{ asset('css') }}/jquery.dataTables.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
	   folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('css') }}/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{ asset('bower_components') }}/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ asset('bower_components') }}/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ asset('bower_components') }}/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('bower_components') }}/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ asset('plugins') }}/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <style>
  .row{ margin: 1% 0%;}
  #prov_form>input{ margin-top: 5px; }
  </style>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
	<!-- Logo -->
	<a href="/home" class="logo">
	  <!-- mini logo for sidebar mini 50x50 pixels -->
	  <span class="logo-mini"><b>A</b>LT</span>
	  <!-- logo for regular state and mobile devices -->
	  <span class="logo-lg"><b>Admin</b>LTE</span>
	</a>
	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top">
	  <!-- Sidebar toggle button-->
	  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
		<span class="sr-only">Toggle navigation</span>
	  </a>

	  <div class="navbar-custom-menu">
		<ul class="nav navbar-nav">

		  <!-- User Account: style can be found in dropdown.less -->
		  <li class="dropdown user user-menu">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			  <span class="hidden-xs">Hola, {{ session()->get('nombre') }}</span>
			</a>
		  </li>
		</ul>
	  </div>
	</nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
	  <!-- search form -->
	  <form action="#" method="get" class="sidebar-form">
		<div class="input-group">
		  <input type="text" name="q" class="form-control" placeholder="Search...">
		  <span class="input-group-btn">
				<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
				</button>
			  </span>
		</div>
	  </form>
	  <!-- /.search form -->
	  <!-- sidebar menu: : style can be found in sidebar.less -->
	  <ul class="sidebar-menu" data-widget="tree">
		<li class="header">Menu</li>
		<li>
		  <a href="/home">
			<i class="fa fa-dashboard"></i> <span>Inicio</span>
		  </a>
		</li>
		<li class="active">
		  <a href="/pagos">
			<i class="fa fa-files-o"></i><span>Ver pagos</span>
		  </a>
		</li>
		<li>
		  <a href="/usuarios">
			<i class="fa fa-th"></i> <span>Usuarios</span>
		  </a>
		</li>
	  </ul>
	</section>
	<!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
		Panel de Usuarios
	  </h1>
	  <ol class="breadcrumb">
		<li><a href="/logout"><i class="fa fa-dashboard"></i> Salir</a></li>
	  </ol>
	</section>

	<!-- Main content -->
	<section class="content">
	  <!-- Small boxes (Stat box) -->
	  
	  <!-- /.row -->
	  <!-- Main row -->
	  <div class="row">
		<div class="col-md-12">
		  <div class="box" style="height:365px;">
			<div class="box-header">
			  <a class="btn btn-lg btn-primary box-title" data-target="#modal-default" data-toggle="modal">Nuevo Usuario</a>
			</div>
			<!-- /.box-header -->
			<div class="box-body no-padding">
			  <table class="table" id="dataTable">
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Nombre</th>
				    <th>Correo</th>
				    <th>Estado</th>
                    </tr>
                </thead>
				<tbody>
                @foreach( $users as $user => $value )
                <tr>
                    <td>{{ $value->id_empleado }}</td>
                    <td>{{ $value->Nombre }}</td>
                    <td>{{ $value->Correo }}</td>
                    @if( $value->Estado == 1 )
                    <td class="pagar">
                        <a onclick="change(2)" class="btn btn-sm btn-success" >Activo</a>
                    </td>
                    @else
                    <td>
                        <a onclick="change(1)" class="btn btn-sm btn-warning">Suspendido</a>
                        </td>
                    @endif
                    
                </tr>
                @endforeach
			  </tbody></table>
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->
		  <!-- /.box -->
		</div>
		<!-- right col -->
	  </div>
	  <!-- /.row (main row) -->

    </section>
	<!-- /.content -->
    </div>
    
  <div class="modal fade" id="modal-default" style="display: none;">
    <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="pago_desc"></h4>
			  </div>
			  <div class="modal-body content">
                <div class="row">
            <div class="col-md-3">
				<label for="name_prov">Nombre:</label>
            </div>
			<div class="col-md-9">
				<input type="text" placeholder="Eduardo" class="form-control" id="name_user">
			</div>
            </div>
            <div class="row">
            <div class="col-md-3">
				<label for="taller">Correo:</label>
            </div>
			<div class="col-md-9">
				<input type="text" placeholder="mail@example.com" class="form-control" id="mail">
			</div>
            </div>
        </div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-success" id="saveProv">Pagar</button>
			  </div>
			</div>
			<!-- /.modal-content -->
		  </div>
		  <!-- /.modal-dialog -->
		</div>

  <!-- /.content-wrapper -->
  <footer class="main-footer">
	<div class="pull-right hidden-xs">
	  <b>Version</b> 2.4.13
	</div>
	<strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
	reserved.
  </footer>

  <div class="content" id="prov_form" style="display:none;">
    </div>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('bower_components') }}/jquery/dist/jquery.min.js"></script>
<script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('bower_components') }}/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components') }}/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="{{ asset('bower_components') }}/raphael/raphael.min.js"></script>
<script src="{{ asset('bower_components') }}/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="{{ asset('bower_components') }}/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="{{ asset('plugins') }}/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="{{ asset('plugins') }}/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('bower_components') }}/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{ asset('bower_components') }}/moment/min/moment.min.js"></script>
<script src="{{ asset('bower_components') }}/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="{{ asset('bower_components') }}/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('plugins') }}/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="{{ asset('bower_components') }}/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="{{ asset('bower_components') }}/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js') }}/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('js') }}/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('js') }}/demo.js"></script>

<script>

    $(document).ready(function(){

        $('#saveProv').on('click', function(){
            var user = $('#name_user').val();
            var mail = $('#mail').val();

            $.ajax({
                url: '/createUser',
                method: 'POST',
                data: { user: user, mail: mail },
                success: function(e){
                   console.log(e);
                }
            });

        });
    
    });

    
</script>

</body>
</html>

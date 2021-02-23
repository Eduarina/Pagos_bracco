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
  table.dataTable tbody th, table.dataTable tbody td{ padding:2px 0px; }
  </style>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
	<!-- Logo -->
	<a href="index2.html" class="logo">
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
			  <span class="hidden-xs">Hola, {{ session()->get('name') }}</span>
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
		<li class="active treeview">
		  <a href="/home">
			<i class="fa fa-dashboard"></i> <span>Inicio<span>
		  </a>
		</li>
        <li>
		  <a href="/proveedores">
			<i class="fa fa-dashboard"></i> <span>Proveedores<span>
		  </a>
		</li>
           @if( session()->get('id') == 1 )
		<li>
		  <a href="/pagos">
			<i class="fa fa-files-o"></i>
			<span>Ver pagos</span>
		  </a>
		</li>
		<li>
		  <a href="/usuarios">
			<i class="fa fa-th"></i> <span>Usuarios</span>
		  </a>
		</li>
        @endif
	  </ul>
	</section>
	<!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
		Panel de Control
	  </h1>
	  <ol class="breadcrumb">
		<li><a href="/logout"><i class="fa fa-dashboard"></i> Salir</a></li>
	  </ol>
	</section>

	<!-- Main content -->
	<section class="content">
	  <!-- /.row -->
	  <!-- Main row -->
	  <div class="row">
		<div class="col-md-12">
		  <div class="box">
			<div class="box-header">
			  <h3 class="box-title">Proveedores</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body no-padding">
			  <table class="table" id="dataTable">
				<tbody>
                <thead>
                    <tr>
                        <th>ID</th>
				        <th>Proveedor</th>
				        <th>Telefono</th>
				        <th>Correo</th>
                        <th>Cuenta</th>
                        <th>Acciones</th>
				    </tr>
                </thead>
                <tbody>
                @foreach( $proveedores as $prov => $info )
				<tr>
				  <td>{{ $info->ID }}</td>
				  <td>{{ $info->Area }} - {{ $info->Proveedor }}</td>
				  <td>{{ $info->Telefono }}</td>
                  <td>{{ $info->Correo }}</td>
                  <td>{{ $info->Cuenta }}</td>
                  <td>
                    <a class="btn btn-info btnEdit" data-id="{{ $info->ID }}" data-toggle="modal" data-target="#modal-default">Editar</a>
                  </td>
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
				<h4 class="modal-title">Solicitar nuevo pago</h4>
			  </div>
			  <div class="modal-body content">
              <form action="/updateProvs" method="POST">
              @csrf
                <div class="row">
                    <input type="hidden" id="ID" name="ID" />
                    <div class="col-md-3">
				        <label for="name_prov">Nombre:</label>
                    </div>
			        <div class="col-md-9">
				        <input type="text" placeholder="Eduardo" name="prov" class="form-control" id="name_prov">
			        </div>
                    <div class="col-md-3">
				        <label for="phone">Telefono:</label>
                    </div>
			        <div class="col-md-9">
				        <input type="text" placeholder="2200110394" name="tel" class="form-control" id="phone">
			        </div>
                    <div class="col-md-3">
				        <label for="mail">Correo:</label>
                    </div>
			        <div class="col-md-9">
				        <input type="text" placeholder="example@domain.com" name="mail" class="form-control" id="mail">
			        </div>
                    <div class="col-md-3">
				        <label for="taller">Cuenta:</label>
                    </div>
			        <div class="col-md-9">
				        <input type="text" class="form-control" id="count" name="count">
			        </div>
                </div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
				<input type="submit" style="float:right;" class="btn btn-success" value="Guardar" />
			  </div>
              </form>
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

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('bower_components') }}/jquery/dist/jquery.min.js"></script>
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
<script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script>

    $(document).ready(function(){
        $("#dataTable").DataTable();

        $(".btnEdit").on("click", function(){
            var id = $(this).attr('data-id');
            $.ajax({
                url: '/getProvInfo',
                method: 'POST',
                data:{ id: id },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(e){
                    $("#ID").val( e[0]['id_proveedor'] );
                    $("#name_prov").val( e[0]['Nombre'] );
                    $("#phone").val( e[0]['Telefono'] );
                    $("#mail").val( e[0]['Correo'] );
                    $("#count").val( e[0]['Cuenta'] );
                }
            });
        });

    });

</script>

</body>
</html>

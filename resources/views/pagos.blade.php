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
		Panel de Pagos
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
			  <h3 class="box-title">Desglose de pagos</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body no-padding">
			  <table class="table" id="dataTable">
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Fecha</th>
				    <th>Solicita</th>
				    <th>Proveedor</th>
                    <th>Descripción</th>
				    <th>Monto</th>
                    <th>Acción</th>
                    </tr>
                </thead>
				<tbody>
                @foreach( $all as $pago => $value )
                <tr>
                    <td>{{ $value->ID }}</td>
                    <td>{{ $value->Fecha }}</td>
                    <td>{{ $value->Solicita }}</td>
                    <td>{{ $value->Area }} - {{ $value->Proveedor }}</td>
                    <td>{{ $value->Descripcion }}</td>
                    <td>${{ number_format( $value->Monto ) }} MXN</td>
                    @if( $value->Edo == 3 )
                    <td class="pagar">
                        <a class="btn btn-sm btn-info" >Pendiente</a>
                    </td>
                    @else
                    <td>
                        <a href="{{ asset('comprobantes') }}/{{ $value->Comprobante }}" download class="btn btn-sm btn-success">Pagado</a>
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
              <form action="/changePay" method="post" enctype="multipart/form-data">
              @csrf
                    <input id="ID" name="ID" type="hidden" />
					<div class="row">
						<div class="col-md-3">
						    <label for="prov">Proveedor:</label>
                		</div>
				        <div class="col-md-9">
						    <input class="form-control" name="prov" id="prov" style="width:100%;" disabled type="text" />
						</div>
					</div>
                    <div class="row">
						<div class="col-md-3">
						    <label for="prov">Cuenta:</label>
                		</div>
				        <div class="col-md-9">
						    <input class="form-control" id="cuenta" style="width:100%;" type="text" name="cuenta" />
						</div>
					</div>
					<div class="row">
		                <div class="col-md-3">
						    <label for="desc">Descripción:</label>
                		</div>
						<div class="col-md-9">
						    <textarea id="desc" class="form-control" name="desc" disabled style="height: auto;" rows="4" placeholder="Pago anticipo de cama-sofa"></textarea>
						</div>
            		</div>
					<div class="row">
					    <div class="col-md-3">
						    <label for="monto">Monto:</label>
						</div>
						<div class="col-md-9">
						    <input class="form-control" name="monto" id="monto" disabled type="text" />
						</div>
					</div>
                    <div class="row">
					    <div class="col-md-3">
						    <label for="file">Comprobante:</label>
						</div>
						<div class="col-md-9">
						    <input name="file" class="form-control" id="file" type="file" />
						</div>
					</div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
				<input type="submit" class="btn btn-success">Pagar</button>
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

        var table = $("#dataTable").DataTable();

        $('#dataTable tbody').on('click', 'td.pagar', function(){
            var tr = $(this).closest('tr');
            var row = table.row(tr);

            var data = row.data();

            getCuenta(data[0]);

            $("#pago_desc").html( "Pago solicitado por: "+data[2] );
            $("#ID").val( data[0] );
            $("#prov").val( data[3] );
            $("#desc").val( data[4] );
            $("#monto").val( data[5] );

            console.log(row.data());

            $('#modal-default').modal();
        });

        $("#saveData").on("click",function(){

            var id = $("#ID").val();

            var fd = new FormData();
            var files = $('#file')[0].files;
        
            // Check file selected or not
            if(files.length > 0 ){
               fd.append('file',files[0]);
            }


            $.ajax({
                url: '/changePay',
                method: 'POST',
                data: { file: files[0], ID: id },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(e){
                    console.log(e);
                }
            });
        });

    });

    function getCuenta(id){
        $.ajax({
            url: '/getCuentas',
            method: 'POST',
            data: { ID: id },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(e){
                $("#cuenta").val(e[0]['Cuenta']);
            }
        });
    }

</script>

</body>
</html>

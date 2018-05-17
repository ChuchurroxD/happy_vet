<?php 
	session_start();
	if(!isset($_SESSION['usuario']))
	{
		header("Location:../../index.php");
	}
	else
	{
		date_default_timezone_set('America/Lima');
		
   
 ?>
  
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset=utf-8 />
	<title>BSE Vet</title>
	<link rel="stylesheet" href="../../recursos/assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../../recursos/assets/font-awesome/4.2.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="../../recursos/assets/css/jquery-ui.custom.min.css" />
	<link rel="stylesheet" href="../../recursos/assets/fonts/fonts.googleapis.com.css" />
	<link rel="stylesheet" href="../../recursos/assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

	<link rel="stylesheet" href="../../recursos/assets/css/jquery.gritter.min.css" />
		

	<script src="../../recursos/assets/js/ace-extra.min.js"></script>

	</head>
	<body class="no-skin" >
		<?php 
		require('../sup_layout.php');
		 ?>

	<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar                  responsive">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->


				<!--Inicia la parte modificable-->

				<ul class="nav nav-list" id="permisos">
				
				</ul>
				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
			</div>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="../home/home.php">Home</a>
							</li>							
							<li>Mantenedor</li>
							<li>Clientes</li>
							<li>
								<span class="invoice-info-label">Fecha:</span>
								<span class="blue invoice-info-label"><?php echo date('d-m-Y'); ?></span>
							</li>
						</ul><!-- /.breadcrumb -->
						
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Clientes
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Listado
								</small>
								<div class="widget-toolbar no-border invoice-info">
									<button class="btn btn-xs btn-primary" id="nuevo_articulo">NUEVO</button>
									<!--button class="btn btn-xs btn-danger" id = "listar_articulo">LISTAR</button -->
								</div>								
							</h1>
						</div>				

						<div class="row">
							<div class="col-xs-12">													
								<!-- PAGE CONTENT BEGINS -->
								<div class="table-header">
									CLIENTES REGISTRADOS &nbsp;&nbsp;									
				                </div>
								
								<div>
									<table class="table table-striped table-bordered" id="tblCliente">
										<thead>
											<tr>												
												<th style="text-align: center; font-size: 11px; height: 10px; width:10%">NOMBRES</th>
												<th style="text-align: center; font-size: 11px; height: 10px; width:10%">DIRECCION</th>
												<th style="text-align: center; font-size: 11px; height: 10px; width:7%">TELEFONO</th>
												<th style="text-align: center; font-size: 11px; height: 10px; width:7%">EMAIL</th>
												<th style="text-align: center; font-size: 11px; height: 10px; width:4%">ESTADO</th>
												<th style="text-align: center; font-size: 11px; height: 10px; width:4%">Operaciones</th>											
											</tr>
										</thead>

										<tbody id="cuerpoClientes">														
										</tbody>
									</table>
								</div>	

								<br><br>
								
								<div class="table-header">
		                        MASCOTAS REGISTRADAS                             
		                        </div>
		                        <div>                                               
	                                <table class="table table-striped table-bordered" id="tblMascotas">
	                                    <thead>
	                                        <tr>                                                                                                
	                                          <th style="text-align: center; font-size: 11px; height: 10px; width:10%" >NOMBRE</th>
	                                          <th style="text-align: center; font-size: 11px; height: 10px; width:10%" >RAZA</th>                                                         
	                                          <th style="text-align: center; font-size: 11px; height: 10px; width:6%" >H. C.</th>
	                                          <th style="text-align: center; font-size: 11px; height: 10px; width:10%" >SEXO</th>
	                                          <th style="text-align: center; font-size: 11px; height: 10px; width:10%" >EDAD</th>
	                                          <th style="text-align: center; font-size: 11px; height: 10px; width:3%" >ESTADO</th>                                          
	                                        </tr>
	                                    </thead>           
	                                    <tbody id="cuerpoMascotas">

	                                          <!-- DATOS -->                                            
	                                          
	                                    </tbody>                                                  
	                                </table>		            
		                        </div>			
							</div><!-- /.col -->																			
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
			


			




			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">BSE</span>
							&copy; All Rights Reserved
						</span>

						&nbsp;
						<span class="action-buttons">							
							<a href="https://www.facebook.com/bse.com.pe/?fref=ts">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
							</a>						
						</span>
					</div>
				</div>
			</div>	

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
			<input type="hidden" dissabled="true" value="Mantenedores" id="NombreGrupo">
			<input type="hidden" dissabled="true" value="Clientes" id="NombreTarea">
		</div><!-- /.main-container -->
		

		<div class="modal fade" id="modalInfoCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width: 65% !important;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title text-center"><b>Información de Cliente</b></h4>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" class="form-horizontal" id="form_eventoPago">
                            <form role="form" id="frmRegistroEgresados" class="form-horizontal" method="POST">
                                <div class="row">
                                    <div class="modal-body">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-2" style="text-align: right">
                                                    <label class="control-label no-padding-right" for="nombreCompleto" style="font-weight: bold;">Nombre Completo:</label>
                                                </div>
                                                <div class="col-md-4" style="text-align: left;">
                                                    <label class="control-label no-padding-right" for="nombreCompleto" id="nombre_completo"></label>
                                                </div> 
                                                <div class="col-md-1" style="text-align: right">
                                                    <label class="control-label no-padding-right" for="dni" style="font-weight: bold;">DNI:</label>
                                                </div>
                                                <div class="col-md-1" style="text-align: left;">
                                                    <label class="control-label no-padding-right" for="dni" id="dni"></label>
                                                </div>  
                                                <div class="col-md-1">
                                                    
                                                </div>   
                                                <div class="col-md-1" style="text-align: right">
                                                    <label class="control-label no-padding-right" for="notificacion" style="font-weight: bold;">Notificación:</label>
                                                </div>
                                                <div class="col-md-1" style="text-align: center;">
                                                    <label class="control-label no-padding-right" for="notificacion" id="notificacion"></label>
                                                </div>                                               
                                            </div>
                                            <div class="form-group" style="text-align: right">
                                                <div class="col-md-2" style="text-align: right">
                                                    <label class="control-label no-padding-right" for="direccion" style="font-weight: bold;">Dirección:</label>
                                                </div>
                                                <div class="col-md-4" style="text-align: left;">
                                                    <label class="control-label no-padding-right" for="direccion" id="direccion"></label>
                                                </div> 
                                                <div class="col-md-2" style="text-align: right">
                                                    <label class="control-label no-padding-right" for="tipCliente" style="font-weight: bold;">Tipo Cliente:</label>
                                                </div>
                                                <div class="col-md-2" style="text-align: left;">
                                                    <label class="control-label no-padding-right" for="tipCliente" id="tipCliente"></label>
                                                </div> 
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-2" style="text-align: right">
                                                    <label class="control-label no-padding-right" for="email" style="font-weight: bold;">Email:</label>
                                                </div>
                                                <div class="col-md-4" style="text-align: left;">
                                                    <label class="control-label no-padding-right" for="email" id="email"></label>
                                                </div> 
                                                <div class="col-md-2" style="text-align: right">
                                                    <label class="control-label no-padding-right" for="telefono" style="font-weight: bold;">Telefono:</label>
                                                </div>
                                                <div class="col-md-3" style="text-align: left;">
                                                    <label class="control-label no-padding-right" for="telefono" id="telefono"></label>
                                                </div> 
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-2" style="text-align: right">
                                                    <label class="control-label no-padding-right" for="observacion" style="font-weight: bold;">Observaciones:</label>
                                                </div>
                                                <div class="col-md-4" style="text-align: left;">
                                                    <label class="control-label no-padding-right" for="observacion" id="observacion"></label>
                                                </div> 
                                                <div class="col-md-2" style="text-align: right">
                                                    <label class="control-label no-padding-right" for="estado" style="font-weight: bold;">Estado:</label>
                                                </div>
                                                <div class="col-md-3" style="text-align: left;">
                                                    <label class="control-label no-padding-right" for="estado" id="estado"></label>
                                                </div> 
                                            </div>
                                     
                                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" id="cancel_cliente">Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </form>
                    </div>
                </div>
            </div>
        </div>  

		<script src="../../recursos/assets/js/jquery.2.1.1.min.js"></script>
		<script src="../../recursos/assets/js/ace-extra.min.js"></script>

		<script src="../../recursos/assets/js/jquery-ui.custom.min.js"></script>
		<script src="../../recursos/assets/js/jquery.ui.touch-punch.min.js"></script>

		<script src="../../recursos/js/cliente.js"></script>
		<script src="../../recursos/js/utiles.js"></script>


		<script>
			jQuery(document).ready(function() {
				MLCLIENTE.init();
			});
		</script>

		<script type="text/javascript">
			window.jQuery || document.write("<script src='../../recursos/assets/js/jquery.min.js'>"+"<"+"/script>");
		</script>
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='../../recursos/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="../../recursos/assets/js/bootstrap.min.js"></script>

		
		<script src="../../recursos/assets/js/jquery-ui.custom.min.js"></script>
		<script src="../../recursos/assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="../../recursos/assets/js/chosen.jquery.min.js"></script>
		<script src="../../recursos/assets/js/fuelux.spinner.min.js"></script>
		<script src="../../recursos/assets/js/bootstrap-datepicker.min.js"></script>
		<script src="../../recursos/assets/js/bootstrap-timepicker.min.js"></script>
		<script src="../../recursos/assets/js/moment.min.js"></script>
		<script src="../../recursos/assets/js/daterangepicker.min.js"></script>
		<script src="../../recursos/assets/js/bootstrap-datetimepicker.min.js"></script>
		<script src="../../recursos/assets/js/bootstrap-colorpicker.min.js"></script>
		<script src="../../recursos/assets/js/jquery.knob.min.js"></script>
		<script src="../../recursos/assets/js/jquery.autosize.min.js"></script>
		<script src="../../recursos/assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
		<script src="../../recursos/assets/js/jquery.maskedinput.min.js"></script>
		<script src="../../recursos/assets/js/bootstrap-tag.min.js"></script>
		
		<!-- ace scripts -->
		<script src="../../recursos/assets/js/ace-elements.min.js"></script>
		<script src="../../recursos/assets/js/ace.min.js"></script>
		<script src="../../recursos/assets/js/jquery.dataTables.min.js"></script>
		<script src="../../recursos/assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="../../recursos/assets/js/jquery.gritter.min.js"></script>
	</body>
</html>
<?php } ?>
		<script src="../../recursos/js/alerta.js"></script>
		<script type="text/javascript">
			//mostrarAlertaReco();
		</script>
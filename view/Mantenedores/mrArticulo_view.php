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
	
	<link rel="stylesheet" href="../../recursos/assets/fonts/fonts.googleapis.com.css" />
	<link rel="stylesheet" href="../../recursos/assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

	<link rel="stylesheet" href="../../recursos/assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
		

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
							<li>Artículos</li>
						</ul><!-- /.breadcrumb -->
						
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Artículos
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Listado
								</small>
								<div class="widget-toolbar no-border invoice-info">
									<span class="invoice-info-label">Fecha:</span>
									<span class="blue invoice-info-label"><?php echo date('d-m-Y'); ?></span>
								</div>
							</h1>
						</div>				

						<div class="row">
							<div class="col-xs-12">													
								<!-- PAGE CONTENT BEGINS -->
								<div class="table-header">
									ARTÍCULOS REGISTRADOS &nbsp;&nbsp;
									<a id='nuevo_articulo' class='white'>
					                    <i class='ace-icon fa fa-plus-circle bigger-150'></i>
					                </a>
				                </div>
								
								<div>
									<table class="table table-striped table-bordered" id="tblArticulo">
										<thead>
											<tr>												
												<th style="text-align: center; font-size: 11px; height: 10px; width:6%">Código</th>
												<th style="text-align: center; font-size: 11px; height: 10px; width:10%">Descripción</th>
												<th style="text-align: center; font-size: 11px; height: 10px; width:6%">Código de barras</th>
												<th style="text-align: center; font-size: 11px; height: 10px; width:6%">Precio de Venta</th>
												<th style="text-align: center; font-size: 11px; height: 10px; width:6%">Costo de Compra</th>
												<th style="text-align: center; font-size: 11px; height: 10px; width:6%">Stock mínimo</th>
												<th style="text-align: center; font-size: 11px; height: 10px; width:6%">Estado</th>
												<th style="text-align: center; font-size: 11px; height: 10px; width:6%">Operaciones</th>											
											</tr>
										</thead>

										<tbody id="cuerpoTabla">														
										</tbody>
									</table>
								</div><!-- /.span -->
															
								<div id="modal-form" class="modal fade" tabindex="-1">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="blue bigger">Registro de artículos</h4>
											</div>

											<div class="modal-body">
												<div class="row">
													<form class="form-horizontal form-bordered" method="post" action="../../controller/controlarticulo/articulo_controller.php" onsubmit="return validarCampos()">                                             
							                            <div class="form-group">
							                                <label class="col-sm-3 control-label">Código de barras</label>
							                                <div class="col-sm-7">
							                                    <input class="form-control" id="codigobarras" name="param_articulo_codigoBarras" type="text" placeholder="Ingrese código de barras " >
							                                </div>
							                            </div>
							                            <div class="form-group">
							                                <label class="col-sm-3 control-label">Concepto</label>
							                                <div class="col-sm-7">
							                                    <input class="form-control" id="concepto" name="param_articulo_concepto"  type="text" placeholder="Ingrese concepto "  >
							                                </div>
							                            </div>
							                            
							                            <div class="form-group">
							                                <label class="col-sm-3 control-label">Descripción</label>
							                                <div class="col-sm-6">
							                                    <input class="form-control" id="descripcion"  name="param_articulo_descripcion" type="text" 
							                                    placeholder="Ingrese descripcion" onblur="buscarArticulo(value)">

							                                </div>
							                                <div class="col-sm-1">
							                                    <input class="form-control" id="tran" type="checkbox" onclick="transformar();" />Transformar
							                                    
							                                </div>
							                                
							                            </div>
							                            
							                            <div class="form-group">
							                                <label class="col-sm-3 control-label">Precio de Venta</label>
							                                <div class="col-sm-7">
							                                    <input class="form-control" id="precioventa"  name="param_articulo_precioVenta1" type="text"
							                                     placeholder="Ingrese precio"  >
							                                     
							                                </div>
							                            </div>
							                            <div class="form-group">
							                                <label class="col-sm-3 control-label">Presentación 1</label>
							                                <div class="col-sm-3">
							                                    <input class="form-control" id="presentacion1"  name="param_articulo_presentacion1" type="text"
							                                     placeholder="Ingrese 1° presentación"disabled="true" >
							                                </div>
							                                <div class="col-sm-2">
							                                    <input class="form-control" id="precioventa1"  name="param_articulo_precioVenta1" type="text"
							                                     placeholder="Precio" disabled="true" >
							                                     
							                                </div>
							                                <div class="col-sm-2">
							                                    <input class="form-control" id="stock1"  name="param_articulo_stockMinimo" type="text"
							                                     placeholder="Stock" disabled="true" >
							                                     
							                                </div>
							                            </div>

							                            <div class="form-group">
							                                <label class="col-sm-3 control-label">Presentación 2</label>
							                                <div class="col-sm-3">
							                                    <input class="form-control" id="presentacion2"  name="param_articulo_presentacion2" type="text"
							                                     placeholder="Ingrese 2° presentación"disabled="true" >
							                                </div>
							                                <div class="col-sm-2">
							                                    <input class="form-control" id="precioventa2"  name="param_articulo_precioVenta2" type="text"
							                                     placeholder="Precio" disabled="true" >
							                                     
							                                </div>
							                                <div class="col-sm-2">
							                                    <input class="form-control" id="stock2"  name="param_articulo_stock2" type="text"
							                                     placeholder="Stock" disabled="true" >
							                                     
							                                </div>
							                            </div>
							            
							                            <div class="form-group">
							                                <label class="col-sm-3 control-label">Proporción</label>
							                                <div class="col-sm-7">
							                                    <input class="form-control" id="proporcion"  name="param_articulo_proporcion" type="text" 
							                                    placeholder="Ingrese proporción " disabled="true" >
							                                </div>
							                            </div>
							                            

							                            <div class="form-group">
							                                <label class="col-sm-3 control-label">Costo de compra</label>
							                                <div class="col-sm-6">
							                                    <input class="form-control" id="costocompra"  name="param_articulo_costoCompra" type="text" placeholder="Ingrese costo" >
							                                </div>
							                            </div>

							                            <div class="form-group">
							                                <label class="col-sm-3 control-label">Subfamilia</label>
							                                <div class="col-sm-6" id="sub">
							                                    
							                                </div>
							                            </div>


							                            <div class="form-group">
							                                <label class="col-sm-3 control-label">Stock mínimo</label>
							                                <div class="col-sm-6">
							                                    <input class="form-control" id="stockminimo" name="param_articulo_stockMinimo" type="text" onkeypress="if(event.keyCode<48|| event.keyCode>57) event.returnValue=false;"  placeholder="Ingrese stock mínimo" >
							                                </div>
							                            </div>

							                            

							                            
							                            <div class="form-group">
							                                <label class="col-sm-3 control-label">Observaciones</label>
							                                <div class="col-sm-6">
							                                    <textarea class="form-control" id="observaciones"  name="param_articulo_observacion" placeholder="Ingrese alguna observacion" rows="1"></textarea>
							                                </div>
							                            </div>
							                            <div class="form-group">
							                                <label class="col-sm-3 control-label">IGV</label>
							                                <div class="col-sm-6">
							                                    <input class="form-control" id="igv" name="param_articulo_igv" type="text" placeholder="Ingrese IGV" value="18">
							                                </div>
							                            </div>
							                            
							                            <div class="form-group">
							                                
							                                <div class="col-sm-1"></div>
							                                <input type="hidden" value="registrar" name="param_opcion">
							                                
							                            </div>
							                            <div class="form-group">
							                                <div class="col-md-12">
							                                    <center><input type="submit" value="Registrar" class="btn btn-primary mr-xs mb-sm buttonform" ></center>
							                                </div>
							                            </div>
                            						</form>
												</div>
											</div>											
										</div>
									</div>
								</div><!-- PAGE CONTENT ENDS -->

								<div id="modalEditarArti" class="modal" tabindex="-1">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="blue bigger">Datos de Artículo</h4>
											</div>

											<div class="modal-body">
												<div class="row">
													<form class="form-horizontal form-bordered" method="post" action="../../controller/controlarticulo/articulo_controller.php">
                            
							                            <div class="form-group">
							                                
							                                <div class="col-sm-6">
							                                    <input class="form-control" id="codigo_e" name="param_articulo_id" type="text" style="visibility:hidden;" >
							                                </div>
							                            </div>

							                            <div class="form-group">
							                                <label class="col-sm-3 control-label">Código de barras</label>
							                                <div class="col-sm-6">
							                                    <input class="form-control" id="codigobarras_e" name="param_articulo_codigoBarras" type="text" placeholder="Ingrese código de barras " >
							                                </div>
							                            </div>
							                            <div class="form-group">
							                                <label class="col-sm-3 control-label">Concepto</label>
							                                <div class="col-sm-6">
							                                    <input class="form-control" id="concepto_e"  name="param_articulo_concepto"  type="text" placeholder="Ingrese concepto "  >
							                                </div>
							                            </div>
							                            
							                            <div class="form-group">
							                                <label class="col-sm-3 control-label">Descripción</label>
							                                <div class="col-sm-6">
							                                    <input class="form-control" id="descripcion_e"  name="param_articulo_descripcion" type="text" placeholder="Ingrese descripción de producto " >
							                                </div>
							                            </div>

							                            <div class="form-group">
							                                <label class="col-sm-3 control-label">Subfamilia</label>
							                                <div class="col-sm-6" id="sub_e">
							                                    
							                                </div>
							                            </div>

							                            <div class="form-group">
							                                <label class="col-sm-3 control-label">Observaciones</label>
							                                <div class="col-sm-6">
							                                    <textarea class="form-control" id="observaciones_e"  name="param_articulo_observacion" placeholder="Ingrese alguna observacion" rows="1"></textarea>
							                                </div>
							                            </div>

							                            <div class="form-group">
							                                <label class="col-sm-3 control-label">Stock</label>
							                                <div class="col-sm-6">
							                                    <input class="form-control"  id="stock_e" name="param_articulo_stock" type="text" onkeypress="if(event.keyCode<48|| event.keyCode>57) event.returnValue=false;"  placeholder="Ingrese stock " >
							                                </div>
							                            </div>

							                            <div class="form-group">
							                                <label class="col-sm-3 control-label">Stock mínimo</label>
							                                <div class="col-sm-6">
							                                    <input class="form-control"  id="stockminimo_e" name="param_articulo_stockMinimo" onkeypress="if(event.keyCode<48|| event.keyCode>57) event.returnValue=false;"  type="text" placeholder="Ingrese stock mínimo" >
							                                </div>
							                            </div>

							                            <div class="form-group">
							                                <label class="col-sm-3 control-label">Costo de compra</label>
							                                <div class="col-sm-6">
							                                    <input class="form-control"  id="costocompra_e" name="param_articulo_costoCompra" type="text" placeholder="Ingrese costo" >
							                                </div>
							                            </div>

							                            <div class="form-group">
							                                <label class="col-sm-3 control-label">Precio de venta</label>
							                                <div class="col-sm-6">
							                                    <input class="form-control"  id="precioventa_e" name="param_articulo_precioVenta1" type="text" placeholder="Ingrese precio de venta" >
							                                </div>
							                            </div>

							                            <div class="form-group">
							                                <label class="col-sm-3 control-label">IGV</label>
							                                <div class="col-sm-6">
							                                    <input class="form-control" id="igv_e" name="param_articulo_igv" type="text" placeholder="Ingrese IGV" >
							                                </div>
							                            </div>
							                            
							                            <div class="form-group">
							                                
							                                <div class="col-sm-1"></div>
							                                <input type="hidden" value="actualizar" name="param_opcion">
							                                <input type="hidden" dissabled="true" value="Mantenedores" id="NombreGrupo">
							                                <input type="hidden" dissabled="true" value="Articulos" id="NombreTarea">
							                            </div>
							                            <div class="form-group">
							                                <div class="col-md-12">
							                                    <center><input type="submit" id="actualizar" value="Actualizar" class="btn btn-primary mr-xs mb-sm buttonform" ></center>
							                                </div>
							                            </div>
                            						</form>
												</div>
											</div>										
										</div>
									</div>
								</div><!-- PAGE CONTENT ENDS -->								
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
		</div><!-- /.main-container -->
		
		<script src="../../recursos/assets/js/jquery.2.1.1.min.js"></script>
		<script src="../../recursos/assets/js/ace-extra.min.js"></script>		
		<script src="../../recursos/js/articulo.js"></script>


		<script>
			jQuery(document).ready(function() {
				MLARTICULO.init();
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
	</body>
</html>
<?php } ?>
		<script src="../../recursos/js/alerta.js"></script>
		<script type="text/javascript">
			//mostrarAlertaReco();
		</script>
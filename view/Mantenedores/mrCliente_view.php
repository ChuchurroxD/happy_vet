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
	<link rel="stylesheet" href="../../recursos/assets/css/chosen.min.css" />
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
									Registro / Actualización de Datos
								</small>
								<div class="widget-toolbar no-border invoice-info">
									<button class="btn btn-xs btn-primary" id="nuevo_cliente">NUEVO</button>
									<button class="btn btn-xs btn-danger" id = "listar_cliente">LISTAR</button>
								</div>									
							</h1>
						</div>				

						<div class="row form-horizontal">
							<div class="col-md-12">																					
								<div class="form-group">
                                    <label class="col-md-2 control-label">Cliente</label>
                                    <div class="col-md-1">
                                        <select class="form-control select" id="param_abreviatura" name="param_abreviatura" required >
                                            <option value="">>></option>
                                            <option value="DON">Don</option>
                                            <option value="DOÑA">Doña</option>
                                            <option value="DR">Dr.</option>
                                            <option value="DRA">Dra.</option>
                                            <option value="MR">Mr.</option>
                                            <option value="SR">Sr.</option>
                                            <option value="SRA">Sra.</option>
                                            <option value="SRTA">Srta.</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="param_nombres" name="param_nombres" placeholder="Nombres" class="col-xs-12" autofocus="" onkeypress="return soloLetras(event)" />
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="param_apellidos" name="param_apellidos" placeholder="Apellidos" class="col-md-12" autofocus="" onkeypress="return soloLetras(event)" />
                                    </div>
                                    <label class="col-md-1 control-label">DNI</label>
                                    <div class="col-md-2">
                                        <input type="text" id="param_dni" name="param_dni" placeholder="DNI" class="col-xs-12" autofocus="" onkeypress="return ValidaNumeros(event,this)"maxlength="8" />
                                    </div>
                                </div>	
								
								<div class="form-group" id="ubicacion">
                                    <label class="col-md-2 control-label">Departamento</label>
                                    <div class="col-md-3" id="departamento">
										<select class="form-control select" name="param_departamento" id="param_departamento" autofocus="">
                                            <option value="" disabled selected style="display: none;" >Seleccione Departamento</option>
                                        </select>
                                    </div>
                                    <label class="col-md-1 control-label">Provincia</label>
                                    <div class="col-md-3" id="provincia">
                                        <select class="form-control select" name="param_provincia" id="param_provincia" autofocus="">
                                            <option value="" disabled selected style="display: none;" >Seleccione Provincia</option>
                                        </select>
                                    </div>
                                    <label class="col-md-1 control-label">Distrito</label>
                                    <div class="col-md-2" id="distrito">
                                        <select class="form-control select" name="param_distrito" id="param_distrito" autofocus="">
                                            <option value="" disabled selected style="display: none;">Seleccione Distrito</option>
                                        </select>
                                    </div>
                                </div>

								<div class="form-group">
                                    <label class="col-md-2 control-label">Dirección</label>
                                    <div class="col-md-7">
                                        <input type="text" id="param_direccion" name="param_direccion" placeholder="Dirección" class="col-xs-12" autofocus="" />
                                    </div>                                    
                                    <label class="col-md-1 control-label">Fecha Nac.</label>
                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <input class="form-control" id="param_fechaNacimiento" name="param_fechaNacimiento" type="date" id="form-field-mask-1" required placeholder="Fecha Nacimiento" autofocus/>
                                        </div>
                                    </div>
                                </div>

								<div class="form-group">                                   
                                    <label class="col-md-2 control-label">Teléfono Fijo</label>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="ace-icon fa fa-phone"></i>
                                            </span>
                                            <input class="form-control" type="text" id="param_telefonoFijo" name="param_telefonoFijo" onkeypress="return ValidaNumeros(event,this)" placeholder="Ejm: 044-123456" autofocus=""/>
                                        </div>
                                    </div>                                   
                                    <label class="col-md-1 control-label">Celular</label>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="ace-icon fa fa-phone"></i>
                                            </span>
                                            <input class="form-control" type="text" id="param_celular" name="param_celular" onkeypress="return ValidaNumeros(event,this)" maxlength="9" placeholder="Ejm: 912345678" autofocus=""/>
                                        </div>
                                    </div>                                    
                                    <label class="col-md-1 control-label">Notificación</label>
                                    <div class="col-md-2">
                                        <select class="form-control select" id="param_notificacion" name="param_notificacion" required autofocus="">
                                            <option value="" disabled selected style="display: none;" >Vía..</option>
                                            <option value="EMAIL">EMAIL</option>
                                            <option value="SMS">SMS</option>
                                        </select>
                                    </div>
                                </div>
					
								<div class="form-group">                                    
                                    <label class="col-md-2 control-label">Correo electrónico</label>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="ace-icon fa fa-envelope"></i>
                                            </span>
                                            <input class="form-control" type="text" id="param_email" name="param_email" placeholder="example@correo.com" autofocus=""/>
                                        </div>
                                    </div>                                  
                                    <label class="col-md-1 control-label">Tipo Cli.</label>
                                    <div class="col-md-3">
                                        <select class="form-control select" id="param_tipoCliente" name="param_tipoCliente required " autofocus="">
                                            <option value="" disabled selected style="display: none;" >Seleccione..</option>
                                            <option value="1">Bueno</option>
                                            <option value="2">Especial</option>
                                            <option value="3">Malo</option>
                                            <option value="4">Moroso</option>
                                            <option value="5">Normal</option>
                                            <option value="6">Regular</option>
                                        </select>
                                    </div>

                                    <label class="col-md-1 control-label">Estado</label>
                                    <div class="col-md-2">
                                        <select class="form-control select" name="param_estado" id="param_estado">
                                            <option value="" disabled selected style="display: none;">Selecciones...</option>
                                            <option value="1">Activo</option>
                                            <option value="0">Inactivo</option>
                                        </select>
                                    </div>                                   
                                </div>

                                <div class="form-group">                                    
                                    <label class="col-md-2 control-label">Fecha Ingreso</label>
                                    <div class="col-md-3">
                                        <input class="form-control col-md-12" type="date"  name="param_fechaAlta" id="param_fechaAlta" required value="<?php echo date("Y-m-d") ?>" />
                                    </div>                                    
                                    <label class="col-md-1 control-label">Últ. Mod.</label>
                                    <div class="col-md-3">
	                                    <input class="form-control col-md-12" type="date" name="param_fechaModificacion" id="param_fechaModificacion" disabled="disabled"/>
	                                </div>
	                                <label class="col-md-1 control-label">Fecha Baja</label>                                
	                                <div class="col-md-2">
	                                    <input class="form-control col-md-12" type="date"  name="param_fechaBaja" id="param_fechaBaja" disabled="disabled"/>
	                                </div>
                                </div>

								<div class="form-group">                                    
                                    <label class="col-md-2 control-label">Observaciones</label> 
                                    <div class="col-md-10">
                                        <textarea name="param_observaciones" id="param_observaciones" rows="3" class="form-control" autofocus=""></textarea>
                                    </div>
                                </div>			
								<input type="hidden" dissabled="true" id="param_codigo">
								<div class="col-xs-12">
									<div class="modal-footer col-xs-12">		                                            
                                        <button type="button" class="btn btn-xs btn-primary" id="register_cliente"><i class="white ace-icon fa fa-save bigger-100"></i>&nbsp;Registrar</button>
                                        <button type="button" class="btn btn-xs btn-primary" id="update_cliente"><i class="white ace-icon fa fa-save bigger-100"></i>&nbsp;Modificar</button>
                                        <button type="button" class="btn btn-xs btn-primary" id="cancel_cliente"><i class="white ace-icon fa fa-close bigger-100"></i>&nbsp;Cancelar</button>
                                    </div>
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
		
		<script src="../../recursos/assets/js/jquery.2.1.1.min.js"></script>
		<script src="../../recursos/assets/js/ace-extra.min.js"></script>		
		<script src="../../recursos/js/cliente.js"></script>
		<script src="../../recursos/js/utiles.js"></script>

		<script>
			jQuery(document).ready(function() {
				MRCLIENTE.init();
			});
		</script>

		<script type="text/javascript">
			window.jQuery || document.write("<script src='../../recursos/assets/js/jquery.min.js'>"+"<"+"/script>");
		</script>
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='../../recursos/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="../../recursos/assets/js/bootstrap.min.js"></script>

		<script src="../../recursos/assets/js/jquery-ui.min.js"></script>
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
			function readURL(input) {
		    	if (input.files && input.files[0]) {
		    		var reader = new FileReader();
		    		reader.onload = function (e) {
		    			$('#img_prev').attr('src', e.target.result).width(295).height(250);   //  ACA ESPECIFICAN QUE TAMANO DE ALTO QUIEREN
		    		};
		    		reader.readAsDataURL(input.files[0]);
		    	}
		    }
		</script>

		<script>
		    
	    </script>
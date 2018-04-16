<?php
session_start();
include_once '../../model/Mantenedores_model/articulo_model.php';

$param = array();
$param['param_opcion']='';
$param['param_usuId']=0;


$param['param_articulo_id']=0;
$param['param_sucursal_id']=0;
$param['param_articulo_codigoBarras']='';
$param['param_articulo_concepto']='';
$param['param_articulo_descripcion']='';
$param['param_articulo_presentacion1']='';
$param['param_articulo_presentacion2']='';
$param['param_articulo_precioVenta1']=0;
$param['param_articulo_precioVenta2']=0;

$param['param_articulo_stock2']=0;
$param['param_articulo_referencia']='';
$param['param_articulo_proporcion']=0;
$param['param_articulo_subfamilia']='';
$param['param_articulo_observacion']='';
$param['param_articulo_stock']=0;
$param['param_articulo_stockMinimo']=0;
$param['param_articulo_costoCompra']=0;
$param['param_articulo_igv']=0;

 if (isset($_SESSION['personaID']))
     $param['param_usuId'] = $_SESSION['personaID'];
    
if (isset($_POST['param_opcion']))
    $param['param_opcion'] = $_POST['param_opcion'];

// if (isset($_POST['param_usuId']))
//     $param['param_usuId'] = $_POST['param_usuId'];


if (isset($_POST['param_articulo_id']))
    $param['param_articulo_id'] = $_POST['param_articulo_id'];
if (isset($_SESSION['usuarioSucursalID']))
    $param['param_sucursal_id'] = $_SESSION['usuarioSucursalID'];
if (isset($_POST['param_articulo_codigoBarras']))
    $param['param_articulo_codigoBarras'] = $_POST['param_articulo_codigoBarras'];
if (isset($_POST['param_articulo_concepto']))
    $param['param_articulo_concepto'] = $_POST['param_articulo_concepto'];
if (isset($_POST['param_articulo_descripcion']))
    $param['param_articulo_descripcion'] = $_POST['param_articulo_descripcion'];
if (isset($_POST['param_articulo_presentacion1']))
    $param['param_articulo_presentacion1'] = $_POST['param_articulo_presentacion1'];
if (isset($_POST['param_articulo_presentacion2']))
    $param['param_articulo_presentacion2'] = $_POST['param_articulo_presentacion2'];

if (isset($_POST['param_articulo_proporcion']))
    $param['param_articulo_proporcion'] = $_POST['param_articulo_proporcion'];
if (isset($_POST['param_articulo_subfamilia']))
    $param['param_articulo_subfamilia'] = $_POST['param_articulo_subfamilia'];
if (isset($_POST['param_articulo_observacion']))
    $param['param_articulo_observacion'] = $_POST['param_articulo_observacion'];
if (isset($_POST['param_articulo_stock']))
    $param['param_articulo_stock'] = $_POST['param_articulo_stock'];
if (isset($_POST['param_articulo_stockMinimo']))
    $param['param_articulo_stockMinimo'] = $_POST['param_articulo_stockMinimo'];
if (isset($_POST['param_articulo_costoCompra']))
    $param['param_articulo_costoCompra'] = $_POST['param_articulo_costoCompra'];

if (isset($_POST['param_articulo_precioVenta1']))
    $param['param_articulo_precioVenta1'] = $_POST['param_articulo_precioVenta1'];

if (isset($_POST['param_articulo_precioVenta2']))
    $param['param_articulo_precioVenta2'] = $_POST['param_articulo_precioVenta2'];



if (isset($_POST['param_articulo_stock2']))
    $param['param_articulo_stock2'] = $_POST['param_articulo_stock2'];
if (isset($_POST['param_articulo_igv']))
    $param['param_articulo_igv'] = $_POST['param_articulo_igv'];
$Articulo = new Articulo_Model();
echo $Articulo->gestionar($param);

?>
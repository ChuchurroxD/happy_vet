<?php
session_start();
include_once '../../model/Mantenedores_model/cliente_model.php';

$param = array();
$param['param_opcion'] = '';
$param['param_codigo'] = '';
$param['param_abreviatura'] = '';
$param['param_nombres'] = '';
$param['param_apellidos'] = '';
$param['param_dni'] = '';
$param['param_departamento']="";
$param['param_provincia']="";
$param['param_distrito']="";
$param['param_direccion']="";
$param['param_fechaNacimiento']="";
$param['param_telefonoFijo']="";
$param['param_celular']="";
$param['param_notificacion']="";
$param['param_email']="";
$param['param_tipoCliente']="";
$param['param_estado']="";
$param['param_fechaAlta']="";
$param['param_fechaModificacion']="";
$param['param_fechaBaja']="";
$param['param_observaciones']="";
$param['param_usuario']="";


if (isset($_POST['param_opcion'])) {
    $param['param_opcion'] = $_POST['param_opcion'];
}

if (isset($_POST['param_codigo'])) {
    $param['param_codigo'] = $_POST['param_codigo'];
}

if (isset($_POST['param_abreviatura'])) {
    $param['param_abreviatura'] = $_POST['param_abreviatura'];
}

if (isset($_POST['param_nombres'])) {
    $param['param_nombres'] = $_POST['param_nombres'];
}

if (isset($_POST['param_apellidos'])) {
    $param['param_apellidos'] = $_POST['param_apellidos'];
}

if (isset($_POST['param_dni'])) {
    $param['param_dni'] = $_POST['param_dni'];
}

if (isset($_POST['param_departamento'])) {
    $param['param_departamento'] = $_POST['param_departamento'];
}

if (isset($_POST['param_provincia'])) {
    $param['param_provincia'] = $_POST['param_provincia'];
}

if (isset($_POST['param_distrito'])) {
    $param['param_distrito'] = $_POST['param_distrito'];
}

if (isset($_POST['param_direccion'])) {
    $param['param_direccion'] = $_POST['param_direccion'];
}

if (isset($_POST['param_fechaNacimiento'])) {
    $param['param_fechaNacimiento'] = $_POST['param_fechaNacimiento'];
}

if (isset($_POST['param_telefonoFijo'])) {
    $param['param_telefonoFijo'] = $_POST['param_telefonoFijo'];
}

if (isset($_POST['param_celular'])) {
    $param['param_celular'] = $_POST['param_celular'];
}

if (isset($_POST['param_notificacion'])) {
    $param['param_notificacion'] = $_POST['param_notificacion'];
}

if (isset($_POST['param_email'])) {
    $param['param_email'] = $_POST['param_email'];
}


if (isset($_POST['param_tipoCliente'])) {
    $param['param_tipoCliente'] = $_POST['param_tipoCliente'];
}

if (isset($_POST['param_estado'])) {
    $param['param_estado'] = $_POST['param_estado'];
}

if (isset($_POST['param_fechaAlta'])) {
    $param['param_fechaAlta'] = $_POST['param_fechaAlta'];
}

if (isset($_POST['param_fechaModificacion'])) {
    $param['param_fechaModificacion'] = $_POST['param_fechaModificacion'];
}

if (isset($_POST['param_fechaBaja'])) {
    $param['param_fechaBaja'] = $_POST['param_fechaBaja'];
}

if (isset($_POST['param_observaciones'])) {
    $param['param_observaciones'] = $_POST['param_observaciones'];
}

if (isset($_SESSION['usuario'])) {
    $param['param_usuario'] = $_SESSION['usuario'];
}

$Cliente = new Cliente_Model();
echo $Cliente->gestionar($param);


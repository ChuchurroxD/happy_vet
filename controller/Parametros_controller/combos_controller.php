<?php
session_start();
include_once '../../model/Parametros_model/combos_model.php';

$param = array();
$param['param_opcion']='';
$param['param_codigo']='';

    
if (isset($_POST['param_opcion']))
    $param['param_opcion'] = $_POST['param_opcion'];

if (isset($_POST['param_codigo']))
    $param['param_codigo'] = $_POST['param_codigo'];

$Combos = new Combos_Model();
echo $Combos->gestionar($param);

?>
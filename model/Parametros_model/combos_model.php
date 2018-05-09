<?php
include_once '../../model/conexion_model.php';
class Combos_Model {

    private $param = array();
    private $conexion = null;
    private $result = null;

    function __construct() {
        $this->conexion = Conexion_Model::getConexion();
    }
    function cerrarAbrir()
    {
        mysqli_close($this->conexion);
        $this->conexion = Conexion_Model::getConexion();
    }
    function gestionar($param) {
        $this->param = $param;
        switch ($this->param['param_opcion']) {
            
            case "listar_familia":
                echo $this->listar_familia();
                break;

            case "listar_seccion":
                echo $this->listar_seccion();
                break;
                    

             case "listar_sub_familia":
                echo $this->listar_sub_familia();
                break;
                    
            case "listar_departamento":
                echo $this->listar_departamento();
                break;

            case "listar_provincia":
                echo $this->listar_provincia();
                break;

            case "listar_distrito":
                echo $this->listar_distrito();
                break;

                
                

            case "get":break;
        }
    }

    function prepararConsultaFamiliaListar($codigo) {
        $consultaSql = "call PA_Listar_familia(";   
        $consultaSql.="" . $codigo . ")";
        //echo $consultaSql;
        $this->result = mysqli_query($this->conexion,$consultaSql);
    }


    function listar_familia() {
        $this->prepararConsultaFamiliaListar($this->param['param_codigo']);
        $this->cerrarAbrir();
        $item = 0;
       
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "CODIGO" => $fila["FAM_codigo"],
                "DESCRIPCION" => $fila["FAM_descripcion"]));
        }

        echo '[';
        for($i=0; $i<count($datos); $i++) {
            if ($datos[$i]["ESTADO"] = '1') {
                echo '{"CODIGO":"'. utf8_decode($datos[$i]["CODIGO"]) .'",                
                "label":"'. utf8_decode($datos[$i]["DESCRIPCION"]) .'"}';
                if ($i < count($datos) - 1) {
                    echo ',';
                }
            }
            
        }
        echo ']';
    }


    function prepararConsultaSubFamiliaListar($codigo) {
        $consultaSql = "call PA_Listar_Subfamilia(";   
        $consultaSql.="" . $codigo . ")";
        //echo $consultaSql;
        $this->result = mysqli_query($this->conexion,$consultaSql);
    }


    function listar_sub_familia() {
        $this->prepararConsultaSubFamiliaListar($this->param['param_codigo']);
        $this->cerrarAbrir();
        $item = 0;
       
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "CODIGO" => $fila["SFAM_codigo"],
                "DESCRIPCION" => $fila["SFAM_descripcion"]));
        }

        echo '[';
        for($i=0; $i<count($datos); $i++) {
            if ($datos[$i]["ESTADO"] = '1') {
                echo '{"CODIGO":"'. utf8_decode($datos[$i]["CODIGO"]) .'",                
                "label":"'. utf8_decode($datos[$i]["DESCRIPCION"]) .'"}';
                if ($i < count($datos) - 1) {
                    echo ',';
                }
            }
            
        }
        echo ']';
    }

    function prepararConsultaSeccionListar($codigo) {
        $consultaSql = "call PA_Listar_seccion(";   
        $consultaSql.="" . $codigo . ")";
        //echo $consultaSql;
        $this->result = mysqli_query($this->conexion,$consultaSql);
    }


    function listar_seccion() {
        $this->prepararConsultaSeccionListar(0);
        $this->cerrarAbrir();
        $item = 0;
       
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "CODIGO" => $fila["SEC_codigo"],
                "DESCRIPCION" => $fila["SEC_descripcion"]));
        }
        echo '[';
        for($i=0; $i<count($datos); $i++) {
            echo '{"CODIGO":"'. utf8_decode($datos[$i]["CODIGO"]) .'",                
                "label":"'. utf8_decode($datos[$i]["DESCRIPCION"]) .'"}';
                if ($i < count($datos) - 1) {
                    echo ',';
                }            
        }
        echo ']';
    }

    function prepararConsultaDepartamentoListar($codigo, $opcion) {
        $consultaSql = "call PA_Listar_ubigeo(";  
        $consultaSql.="'".$opcion . "',"; 
        $consultaSql.="'" . $codigo . "')";
        //echo $consultaSql;
        $this->result = mysqli_query($this->conexion,$consultaSql);
    }

    function prepararConsultaDepartamentoListar2($codigo, $opcion) {
        $consultaSql = "call PA_Listar_ubigeo(";  
        $consultaSql.="'".$opcion . "',"; 
        $consultaSql.="'" . $codigo . "')";
        //echo $consultaSql;
        $this->result = mysqli_query($this->conexion,$consultaSql);
    }

    function listar_departamento() {
        $this->prepararConsultaDepartamentoListar(0, 'opc_combo_departamento');
        $this->cerrarAbrir();
        $item = 0;
       
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "CODIGO" => $fila["CODIGO"],
                "DESCRIPCION" => $fila["DESCRIPCION"]));
        }

        echo '[';
        for($i=0; $i<count($datos); $i++) {            
            echo '{"CODIGO":"'. utf8_decode($datos[$i]["CODIGO"]) .'",                
            "label":"'. utf8_decode($datos[$i]["DESCRIPCION"]) .'"}';
            if ($i < count($datos) - 1) {
                echo ',';
            }                        
        }
        echo ']';
    }

    function listar_provincia() {
        $this->prepararConsultaDepartamentoListar($this->param['param_codigo'], 'opc_combo_provincia');
        $this->cerrarAbrir();
        $item = 0;
       
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "CODIGO" => $fila["CODIGO"],
                "DESCRIPCION" => $fila["DESCRIPCION"]));
        }

        echo '[';
        for($i=0; $i<count($datos); $i++) {            
            echo '{"CODIGO":"'. utf8_decode($datos[$i]["CODIGO"]) .'",                
            "label":"'. utf8_decode($datos[$i]["DESCRIPCION"]) .'"}';
            if ($i < count($datos) - 1) {
                echo ',';
            }                        
        }
        echo ']';
    }

    function listar_distrito() {
        $this->prepararConsultaDepartamentoListar($this->param['param_codigo'], 'opc_combo_distrito');
        $this->cerrarAbrir();
        $item = 0;
       
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "CODIGO" => $fila["CODIGO"],
                "DESCRIPCION" => $fila["DESCRIPCION"]));
        }

        echo '[';
        for($i=0; $i<count($datos); $i++) {            
            echo '{"CODIGO":"'. utf8_decode($datos[$i]["CODIGO"]) .'",                
            "label":"'. utf8_decode($datos[$i]["DESCRIPCION"]) .'"}';
            if ($i < count($datos) - 1) {
                echo ',';
            }                        
        }
        echo ']';
    }
    
}

?>
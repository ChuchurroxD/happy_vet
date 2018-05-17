<?php
include_once '../../model/conexion_model.php';
class Cliente_Model {
    public $param = array();
    function __construct() {
        $this->conexion = Conexion_Model::getConexion();
    }

    function cerrarAbrir(){
        mysqli_close($this->conexion);
        $this->conexion = Conexion_Model::getConexion();
    }

    function gestionar($param) {
        $this->param = $param;
        switch ($this->param['param_opcion']) {
            case "listar":
                echo $this->listarClientes();
                break;
            case "registro_cliente":
                echo $this->registrarClientes();
                break;
            case "modificar_cliente":
                echo $this->modificarClientes();
                break;
            case "listar_cliente":
                echo $this->datosCliente();
                break;                                
            case "desactivar_cliente":
                echo $this->cambiarEstadoCliente();
                break;                      
            case "activar_cliente":
                echo $this->cambiarEstadoCliente();
                break;      

                






            case 'mostrarMascotasCliente':
                echo $this->mostrarMascotasCliente();
                break;            
            
            case 'modificarEstado':
                echo $this->delete_cliente();
                break;
            case 'recuperarDatos':
                echo $this->recuperar_Datos();
                break;
            case 'editarCliente':
                echo $this->editar_cliente();
                break;
            case 'verDatos':
                echo $this->ver_Datos();
                break;
            case "get":break;
        }
    }


    function prepararConsultaClienteListar($codigo) {
        $consultaSql = "call MA_Listar_clientes(";   
        $consultaSql.="" . $codigo . ")";
        //echo $consultaSql;
        $this->result = mysqli_query($this->conexion,$consultaSql);
    }

    private function getArrayClientes() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "CODIGO" => $fila["CODIGO"],
                "ABREVIATURA" => $fila["ABREVIATURA"],
                "NOMBRES" => $fila["NOMBRES"],
                "DIRECCION" => $fila["DIRECCION"],
                "DNI" => $fila["DNI"],
                "FECHA_NACIMIENTO" => $fila["FECHA_NACIMIENTO"],               
                "TELEFONO" => $fila["TELEFONO"],
                "CELULAR" => $fila["CELULAR"],
                "UBIGEO" => $fila["UBIGEO"],
                "NOTIFICACION" => $fila["NOTIFICACION"],
                "EMAIL" => $fila["EMAIL"],
                "TIPO_CLIENTE" => $fila["TIPO_CLIENTE"],
                "ESTADO" => $fila["ESTADO"],
                "FECHA_ALTA" => $fila["FECHA_ALTA"],
                "FECHA_MODIFICACION" => $fila["FECHA_MODIFICACION"],
                "FECHA_BAJA" => $fila["FECHA_BAJA"],
                "OBSERVACION" => $fila["OBSERVACION"],
                "DEPARTAMENTO" => $fila["DEPARTAMENTO"],
                "PROVINCIA" => $fila["PROVINCIA"],
                "DISTRITO" => $fila["DISTRITO"],
                "CLI_NOMBRES" => $fila["CLI_NOMBRES"],
                "CLI_APELLIDOS" => $fila["CLI_APELLIDOS"],
                "CLI_TELEFONO" => $fila["CLI_TELEFONO"],
                "LIS_ESTADO" => $fila["LIS_ESTADO"]
                                 
            ));
        }
        return $datos;
    }

    function listarClientes() {
        $datos =array();
        $this->cerrarAbrir();
        $this->prepararConsultaClienteListar(0);
        $datos = $this->getArrayClientes();        

        for($i=0; $i<count($datos); $i++) {                    
            echo "<tr>                                  
                <td style='text-align: left; font-size: 11px; height: 10px; '>".($datos[$i]["NOMBRES"])."</td>
                <td style='text-align: left; font-size: 11px; height: 10px; '>".($datos[$i]["DIRECCION"])."</td>                    
                <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["CLI_TELEFONO"])."</td>                    
                <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["EMAIL"])."</td>                  
                <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["LIS_ESTADO"])."</td>
                <td style='text-align: center' class='hidden-sm hidden-xs action-buttons'>
                <a class='blue' class='tooltip-error' data-rel='tooltip' title='Ver'>
                <i  class='ace-icon fa fa-search bigger-100' onclick='mostrarCliente(".$datos[$i]["CODIGO"].")' href='#'' type='button' data-toggle='modal' data-target='#modalVerCliente'></i>  
                </a>
                <a class='green' href='#' class='tooltip-error' data-rel='tooltip' title='Editar'>
                <i  class='ace-icon fa fa-pencil bigger-100' onclick='editarCliente(".$datos[$i]["CODIGO"].")' href='#'' type='button' data-toggle='modal' data-target='#modalEditarArti'></i>
                </a>";
                if (utf8_decode($datos[$i]["LIS_ESTADO"]) == 'ACTIVO') {
                                echo '<a href="#" class="tooltip-error" data-rel="tooltip" title="Desactivar">
                                        <span class="red">
                                            <i class="ace-icon fa fa-trash-o bigger-100" onclick="anularCliente('.$datos[$i]["CODIGO"].');"></i>
                                        </span>
                                    </a>';
                } else {
                    echo '<a href="#" class="tooltip-error" data-rel="tooltip" title="Activar">
                                 <span class="green">
                                  <i class="ace-icon fa fa-check-square-o  bigger-100" onclick="activarCliente('.$datos[$i]["CODIGO"].');"></i>
                                  </span></a>';                
                            }     
            echo "</tr>";
        }                    
    }


    function datosCliente() {
        $cod = $this->param['param_codigo'];
        $datos =array();
        $this->cerrarAbrir();
        $this->prepararConsultaClienteListar($cod);
        $datos = $this->getArrayClientes();  
        echo json_encode($datos);       
        //echo $datos;    
    }

    function prepararConsultaRegistrarCliente() {
        $consultaSql = "call MA_Registrar_clientes(";                
        $consultaSql.="'".$this->param['param_abreviatura'] . "',";
        $consultaSql.="'".$this->param['param_nombres'] . "',";
        $consultaSql.="'".$this->param['param_apellidos'] . "',";
        $consultaSql.="'".$this->param['param_dni'] . "',";
        $consultaSql.="'".$this->param['param_departamento'] . "',";
        $consultaSql.="'".$this->param['param_provincia'] . "',";
        $consultaSql.="'".$this->param['param_distrito'] . "',";
        $consultaSql.="'".$this->param['param_direccion'] . "',";
        $consultaSql.="'".$this->param['param_fechaNacimiento'] . "',";
        $consultaSql.="'".$this->param['param_telefonoFijo'] . "',";
        $consultaSql.="'".$this->param['param_celular'] . "',";
        $consultaSql.="'".$this->param['param_notificacion'] . "',";
        $consultaSql.="'".$this->param['param_email'] . "',";        
        $consultaSql.="'".$this->param['param_tipoCliente'] . "',";
        $consultaSql.="'".$this->param['param_estado'] . "',";
        $consultaSql.="'".$this->param['param_fechaAlta'] . "',";                                
        $consultaSql.="'".$this->param['param_observaciones'] . "',";
        $consultaSql.="'".$this->param['param_usuario'] . "')";    
        //echo $consultaSql;
        $this->result = mysqli_query($this->conexion,$consultaSql);
    }

    function prepararConsultaModificarCliente() {
        $consultaSql = "call MA_Modificar_clientes(";                
        $consultaSql.="'".$this->param['param_abreviatura'] . "',";
        $consultaSql.="'".$this->param['param_nombres'] . "',";
        $consultaSql.="'".$this->param['param_apellidos'] . "',";
        $consultaSql.="'".$this->param['param_dni'] . "',";
        $consultaSql.="'".$this->param['param_departamento'] . "',";
        $consultaSql.="'".$this->param['param_provincia'] . "',";
        $consultaSql.="'".$this->param['param_distrito'] . "',";
        $consultaSql.="'".$this->param['param_direccion'] . "',";
        $consultaSql.="'".$this->param['param_fechaNacimiento'] . "',";
        $consultaSql.="'".$this->param['param_telefonoFijo'] . "',";
        $consultaSql.="'".$this->param['param_celular'] . "',";
        $consultaSql.="'".$this->param['param_notificacion'] . "',";
        $consultaSql.="'".$this->param['param_email'] . "',";        
        $consultaSql.="'".$this->param['param_tipoCliente'] . "',";
        $consultaSql.="'".$this->param['param_estado'] . "',";                                    
        $consultaSql.="'".$this->param['param_observaciones'] . "',";
        $consultaSql.="'".$this->param['param_usuario'] . "',";
        $consultaSql.="'".$this->param['param_codigo'] . "')";    
        //echo $consultaSql;
        $this->result = mysqli_query($this->conexion,$consultaSql);
    }

    private function getArrayResultado() {
        $respuesta = 0;
        while ($fila = mysqli_fetch_array($this->result)) {
            $respuesta = $fila["respuesta"];
        }
        return $respuesta;
    }

    function registrarClientes() {
        $this->prepararConsultaRegistrarCliente();        
        $respuesta = $this->getArrayResultado();
        echo $respuesta;        
    }

    function modificarClientes() {
        $this->prepararConsultaModificarCliente();        
        $respuesta = $this->getArrayResultado();
        echo $respuesta;        
    }

    function prepararConsultaModificarEstadoCliente($codigo, $operacion) {
        $consultaSql = "call MA_Modificar_estado_clientes(";   
        $consultaSql.="'". $codigo . "',";
        $consultaSql.="'". $operacion . "')";  
        //echo $consultaSql;
        $this->result = mysqli_query($this->conexion,$consultaSql);
    }

    function cambiarEstadoCliente() {
        $cod = $this->param['param_codigo'];
        $operacion = $this->param['param_operacion'];
        $this->prepararConsultaModificarEstadoCliente($cod, $operacion);        
        $respuesta = $this->getArrayResultado();
        echo $respuesta;        
    }























    


    
    function mostrarClientes() {
        $this->prepararConsultaCombos('opc_listar_clientes');
        $this->cerrarAbrir();
        $item = 0;
       

        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "CODIGO" => $fila["CODIGO"],
                "NOMBRES" => $fila["NOMBRES"],
                "DNI" => $fila["DNI"],
                "EMAIL" => $fila["EMAIL"],
                "TELEFONO" => $fila["TELEFONO"],
                "DIRECCION" => $fila["DIRECCION"],                            
                "ESTADO" => $fila["ESTADO"]));
        }

        echo '[';
        for($i=0; $i<count($datos); $i++) {
            echo '{"CODIGO":"'. utf8_decode($datos[$i]["CODIGO"]) .'",
                "label":"'. utf8_decode($datos[$i]["NOMBRES"]) .'",
                "DNI":"'. utf8_decode($datos[$i]["DNI"]) .'"}';
            if ($i < count($datos) - 1) {
                echo ',';
            }
        }
        echo ']';

    }

    
    



    function delete_cliente() {
        $this->prepararConsultaGestionarCliente('opc_delete_cliente');
        $this->cerrarAbrir();
        echo 1;
    }

    function recuperar_Datos() {
        $this->prepararConsultaGestionarCliente('opc_datos_cliente');
        $row = mysqli_fetch_row($this->result);
        echo json_encode($row);
    }

    function ver_Datos() {
        $this->prepararConsultaGestionarCliente('opc_datos_cliente');
        $row = mysqli_fetch_row($this->result);
        echo json_encode($row);
    }

    function editar_cliente() {
        $this->prepararConsultaGestionarCliente('opc_editar_cliente');
        $this->cerrarAbrir();
        echo 1;
    }

    private function getArrayTotal() {
        $total = 0;
        while ($fila = mysqli_fetch_array($this->result)) {
            $total = $fila["total"];
        }
        return $total;
    }    

    private function getArrayMascota() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "masCodigo" => $fila["codigo"],
                "masNombre" => $fila["mascota"],
                "masRaza" => $fila["raza"],
                "masCliente" => $fila["cliente"],
                "masHC" => $fila["hc"],
                "masSexo" => $fila["sexo"],
                "masFechaNacimiento" => $fila["nacimiento"],                
                "masEstado" => $fila["estado"]));
        }
        return $datos;
    }

    function mostrarMascotasCliente(){
        $this->prepararConsultaGestionarCliente('opc_contarMascotasClientes');
        $total = $this->getArrayTotal();        
        $datos = array();
        if($total>0)
        {
            $this->cerrarAbrir();
            $this->prepararConsultaGestionarCliente('opc_listarMascotasCliente');
            $datos = $this->getArrayMascota();            
            for($i=0; $i<count($datos); $i++)
            {
                if (utf8_decode($datos[$i]["masEstado"]) == 'Activo')
                {
                    $class= "ace-icon fa fa-trash-o bigger-130";
                    $color= "red";
                    $estado = 0;
                    $label = "label label-lg label-success";
                }
                else
                {
                    $color="green";
                    $class= "ace-icon fa fa-check-square-o bigger-130";
                    $estado = 1;
                    $label = "label label-lg label-danger";
                }
                        

                echo "<tr>                                                      
                    <td style='text-align: center; font-size: 11px; height: 10px; width:10%'>".($datos[$i]["masNombre"])."</td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; width:10%'>".($datos[$i]["masRaza"])."</td>                                        
                    <td style='text-align: center; font-size: 11px; height: 10px; width:6%'>".utf8_decode($datos[$i]["masHC"])."</td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; width:10%'>".utf8_decode($datos[$i]["masSexo"])."</td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; width:10%'>".($datos[$i]["masFechaNacimiento"])."</td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; width:3%'> <span class='".$label."'> ".utf8_decode($datos[$i]["masEstado"])."</span></td>                                        
                </tr>";
            }
        }
        else
            {echo 'No se registraron mascotas.';}
    }



}





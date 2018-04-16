<?php
include_once '../../model/conexion_model.php';
class Articulo_Model {

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
            
            case "listar":
                echo $this->listar();
                break;
            case 'combo':
                echo $this->combo();
                break;
            case 'combo_e':
                echo $this->combo_e();
                break;
            case "registrar":
                echo $this->grabar();
                break;
            case "eliminar":
                echo $this->eliminar();
                break;
            case "eliminarF":
                echo $this->eliminarF();
                break;
            case "listarDetalle":
                echo $this->listarDetalle();
                break;
            case "buscar":
                echo $this->buscar();
                break;
            case "buscarArticulo":
                echo $this->buscarArticulo();
                break;
            case "actualizar":
                echo $this->actualizar();
                break;
            case "get":break;
        }
    }
    private function getArrayArticulo() {
        $datos = array();
        while ($fila = mysqli_fetch_array($this->result)) {
            array_push($datos, array(
                "ART_descripcion" => $fila["ART_descripcion"],
                "ART_codigo" => $fila["ART_codigo"],
                "ART_codigoBarras" => $fila["ART_codigoBarras"],
                "ART_Precioventa" => $fila["ART_Precioventa"],
                "ART_stockActual" => $fila["ART_stockActual"],
                "ART_stockMinimo" => $fila["ART_stockMinimo"],
                "ART_concepto" => $fila["ART_concepto"],
                "SEC_codigo" => $fila["SEC_codigo"],
                "ART_observaciones" => $fila["ART_observaciones"],
                "ART_costoCompra" => $fila["ART_costoCompra"],
                "ART_Estado" => $fila["ART_Estado"],
                "ART_Precioventa" => $fila["ART_Precioventa"],
                "ART_IVA" => $fila["ART_IVA"]
                
                ));
        }
        return $datos;
    }
    
    function combo() {
            $this->prepararConsultaArticulo('opc_combo');
            $this->cerrarAbrir();
            echo '
                <select class="form-control" id="subfamilia" name="param_articulo_subfamilia" >
                                    <option value="0"> Seleccione subfamilia</option>';
            while ($fila = mysqli_fetch_row($this->result)) {
                echo'<option value="'.$fila[0].'">'.utf8_encode($fila[1]).'</option>';
            }
            echo '</select>';
        }

    function combo_e() {
            $this->prepararConsultaArticulo('opc_combo');
            $this->cerrarAbrir();
            echo '
                <select class="form-control" id="subfamilia_e" name="param_articulo_subfamilia" >
                                    <option value="0"> Seleccione subfamilia</option>';
            while ($fila = mysqli_fetch_row($this->result)) {
                echo'<option value="'.$fila[0].'">'.utf8_encode($fila[1]).'</option>';
            }
            echo '</select>';
        }

    function prepararConsultaArticulo($opcion = '') {
        $consultaSql = "call sp_controlArticulo(";
        $consultaSql.="'" . $opcion . "',";
        $consultaSql.=$this->param['param_articulo_id'] . ",";
        $consultaSql.=$this->param['param_sucursal_id'] . ",";
        $consultaSql.="'" .$this->param['param_articulo_codigoBarras'] . "',";
        $consultaSql.="'" .$this->param['param_articulo_concepto'] . "',";
        $consultaSql.="'" .$this->param['param_articulo_descripcion'] . "',";
        $consultaSql.="'" .$this->param['param_articulo_referencia'] . "',";
        $consultaSql.="'" .$this->param['param_articulo_subfamilia'] . "',";
        $consultaSql.="'" .$this->param['param_articulo_observacion'] . "',";
       
        $consultaSql.=$this->param['param_articulo_stock'] . ",";
        $consultaSql.=$this->param['param_articulo_stockMinimo'] . ",";
        $consultaSql.=$this->param['param_articulo_costoCompra'] . ",";
        $consultaSql.=$this->param['param_articulo_precioVenta1'] . ",";
        $consultaSql.=$this->param['param_articulo_igv'] . ",";
        $consultaSql.="'" .$this->param['param_articulo_presentacion1'] . "',";
        $consultaSql.=$this->param['param_articulo_proporcion'] . ")";
        
        //echo $consultaSql;
        $this->result = mysqli_query($this->conexion,$consultaSql);
    }
    
    function prepararConsultaArticulo2($opcion = '') {
        $costocompra=$this->param['param_articulo_costoCompra']/$this->param['param_articulo_proporcion'];
        $consultaSql = "call sp_controlArticulo(";
        $consultaSql.="'" . $opcion . "',";
        $consultaSql.=$this->param['param_articulo_id'] . ",";
        $consultaSql.=$this->param['param_sucursal_id'] . ",";
        $consultaSql.="'" .$this->param['param_articulo_codigoBarras'] . "',";
        $consultaSql.="'" .$this->param['param_articulo_concepto'] . "',";
        $consultaSql.="'" .$this->param['param_articulo_descripcion'] . "',";
        $consultaSql.="'" .$this->param['param_articulo_referencia'] . "',";
        $consultaSql.="'" .$this->param['param_articulo_subfamilia'] . "',";
        $consultaSql.="'" .$this->param['param_articulo_observacion'] . "',";
       
        $consultaSql.=$this->param['param_articulo_stock'] . ",";
        $consultaSql.=$this->param['param_articulo_stock2'] . ",";
        $consultaSql.=$costocompra. ",";
        $consultaSql.=$this->param['param_articulo_precioVenta2'] . ",";
        $consultaSql.=$this->param['param_articulo_igv'] . ",";
        $consultaSql.="'" .$this->param['param_articulo_presentacion2'] . "',";
        $consultaSql.=$this->param['param_articulo_proporcion'] . ")";
        
        echo $consultaSql;
        $this->result = mysqli_query($this->conexion,$consultaSql);
    }

    function listar() {

                    $datos =array();
            
                    $this->cerrarAbrir();
                    $this->prepararConsultaArticulo('opc_listar');
                    $datos = $this->getArrayArticulo();
                    
                    for($i=0; $i<count($datos); $i++)
            {
                     

                echo "<tr>                                  
                    <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["ART_codigo"])."</td>
                    <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["ART_descripcion"])."</td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["ART_codigoBarras"])."</td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["ART_Precioventa"])."</td>
                    <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["ART_costoCompra"])."</td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["ART_stockMinimo"])."</td>                    
                    <td style='text-align: center; font-size: 11px; height: 10px; '>".($datos[$i]["ART_Estado"])."</td>                    
                    
                    <td style='text-align: center' class='hidden-sm hidden-xs action-buttons'>
                    <a class='blue' >
                    <i  class='ace-icon fa fa-search bigger-130' onclick='mostrarArticulo(".$datos[$i]["ART_codigo"].")' href='#'' type='button' data-toggle='modal' data-target='#modalEditarArti' value='Editar'></i>  
                    </a>
                    <a class='green' href='#'>
                    <i  class='ace-icon fa fa-pencil bigger-130' onclick='editarArticulo(".$datos[$i]["ART_codigo"].")' href='#'' type='button' data-toggle='modal' data-target='#modalEditarArti' value='Eliminar'></i>
                    </a>
                    <a class='red' >
                    <i  class='ace-icon fa fa-close bigger-130' onclick='eliminarArticuloF(".$datos[$i]["ART_codigo"].")' value='Eliminar'></i>  
                    </a>";
                    if (utf8_decode($datos[$i]["ART_Estado"]) == 'Activo') {
                                    echo '<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                            <span class="red">
                                                <i class="ace-icon fa fa-trash-o bigger-150" onclick="anularArticulo('.$datos[$i]["ART_codigo"].');"></i>
                                            </span>
                                        </a>';
                    } else {
                        echo '<a href="#" class="tooltip-error" data-rel="tooltip" title="Active">
                                     <span class="green">
                                      <i class="ace-icon fa fa-check-square-o  bigger-150" onclick="anularArticulo('.$datos[$i]["ART_codigo"].');"></i>
                                      </span></a>';

                        
                                }     
                echo "</tr>";
            }
            // }else{
            //         echo '{total:' . $total . ',datos:' . json_encode($datos) . '}';
            // }
            
    }

    
     function grabar() {
        
        if($this->param['param_articulo_presentacion1']!='')
        {$this->prepararConsultaArticulo('opc_grabarP1');
        $this->prepararConsultaArticulo2('opc_grabarP2');}
        else
            $this->prepararConsultaArticulo('opc_grabar');
        if($this->result)
        header("Location:../../view/mantenedores/articulo.php");
        //echo '{"success":true,"message":{"reason": "Grabado Correctamente"}}';
    }

    function actualizar() {
        $this->prepararConsultaArticulo('opc_actualizar');
        if($this->result)
        header("Location:../../view/mantenedores/articulo.php");
    }
    



    function eliminar() {
        $this->prepararConsultaArticulo('opc_eliminar');
        $this->cerrarAbrir();
        echo 1;
    }

    function eliminarF() {
        $this->prepararConsultaArticulo('opc_eliminarFisica');
        if($this->result)
        {echo 1;}
    
    }

    function buscar()
    {
        $datos =array();
        $this->prepararConsultaArticulo('opc_buscar');
        $datos = $this->getArrayArticulo();
        
            echo json_encode($datos);                   
        
    }

    function buscarArticulo()
    {
        $datos =array();
        $this->prepararConsultaArticulo('opc_buscarArticulo');
        $datos = $this->getArrayArticulo();
        if(count($datos)>0)
        { 

            echo '$datos[0]["ART_codigo"]';
            //else
                             
        }
    }

    
}

?>
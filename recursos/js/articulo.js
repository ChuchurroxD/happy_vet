var MLARTICULO = function () {
    var plugins = function() {
        $('#tblArticulo').DataTable();
    }

    var mostrarMenu = function() {
        var grupo = $('#NombreGrupo').val();
        var tarea = $('#NombreTarea').val();
        $.ajax({
            type:'POST',
            data: 'opcion=mostrarMenu&grupo='+grupo+'&tarea='+tarea,        
            url: "../../controller/Usuario_controller/usuario.php",
            success:function(data){                              
                $('#permisos').html(data);                
            }
        });
    }

    var alerta_almacen = function() {
        $.ajax({
            type:'POST',
            data: {opcion:'alerta_almacen'},
            url: "../../controller/Usuario_controller/usuario.php",
            success:function(data){                          
                $('#alertaalmacen').html(data);
            }
        }); 
    }

    var alerta_spa = function() {    
        $.ajax({
            type:'POST',
            data: {opcion:'alerta_spa'},
            url: "../../controller/Usuario_controller/usuario.php",
            success:function(data){                          
                $('#alertaspa').html(data);
            }
        }); 
    }

    var listarArticulo = function() {      
        $.ajax({
            type:'POST',
            data: {param_opcion:'listar'},            
            url: "../../controller/Mantenedores_controller/articulo_controller.php",
            success:function(data){                            
                $('#tblArticulo').DataTable().destroy();
                $('#cuerpoTabla').html(data);
                $('#tblArticulo').DataTable();                                                                                  
            }
        });
    }

    var eventoControles = function () {
        $('#nuevo_articulo').on('click', function () {        
            location.href = "mrArticulo_view.php";
        });

        $('#listar_articulo').on('click', function () {        
            listarArticulo();
        });    
    }

    return {
        init: function(){
            plugins();
            eventoControles();
            mostrarMenu();  
            alerta_almacen();
            alerta_spa();
            listarArticulo();
        }    
    };
}();







































window.onload = function(){    
    //mostrarMenu();  
    //alerta_almacen();  
    //alerta_spa();   
    //$('#dataTables-example').DataTable(); //SIEMPREEEEEEEEEE
    //funcionPrincipal();
    
};

//Declarar variables globales

function funcionPrincipal()
{
	//asignar eventos a componentes html
	//EJM (combo) : $("#idDelCombobox").change(nombreDeLaFuncion);
	//listarArticulo();
	mostrarSubfamilia();
    mostrarSubfamilia_e();
    limpiar();
    //transformar();
}





function mostrarSubfamilia(){ 
    var param_opcion = 'combo';
    
    $.ajax({
        type: 'POST',        
        data:'param_opcion='+param_opcion,
        url: "../../controller/controlarticulo/articulo_controller.php",
        success: function(data){
            $('#sub').html(data);
            
            

        },
        error: function(data){
                   
        }
    });    
}

function mostrarSubfamilia_e(){ 
    var param_opcion = 'combo_e';
    
    $.ajax({
        type: 'POST',        
        data:'param_opcion='+param_opcion,
        url: "../../controller/controlarticulo/articulo_controller.php",
        success: function(data){
            $('#sub_e').html(data);
            
            

        },
        error: function(data){
                   
        }
    });    
}

function buscarArticulo(articulo)
{
    
    $.ajax({
        type:'POST',
        data: {param_opcion:'buscarArticulo',param_articulo_descripcion: articulo},
        url: "../../controller/controlarticulo/articulo_controller.php",
        success:function(data)
        {   
            
            if(data.length>0)
                {alert('El Artículo ya está registrado');
                
                }
            // else
            // {
            //     document.getElementById("nombre").disabled = false;
            //     document.getElementById("apellido").disabled = false;
            //     document.getElementById("fecha").disabled = false;
            //     document.getElementById("apoderado").disabled = false;
            //     document.getElementById("parentesco").disabled = false;
            //     if (document.getElementById("dni").value.length !=8)
            //     {
            //         alert('El dni debe tener 8 caracteres');
            //         document.getElementById("dni").focus();
            //     }
                
            // }

                            
        }
    });
    
}

function editarArticulo(idArticulo)
{
    $.ajax({
        type:'POST',
        data: {param_opcion:'buscar',param_articulo_id:idArticulo},
        dataType: 'json',
        url: "../../controller/controlarticulo/articulo_controller.php",
        success:function(data){
                if(data.length > 0)
                {
                   $.each(data, function (i, value) 
                        {
                            $("#codigo_e").val(value["ART_codigo"]);
                            $("#codigobarras_e").val(value["ART_codigoBarras"]);
                            $("#concepto_e").val(value["ART_concepto"]);
                            $("#descripcion_e").val(value["ART_descripcion"]);
                            
                            $("#subfamilia_e").val(value["SEC_codigo"]);
                            $("#observaciones_e").val(value["ART_observaciones"]);
                            $("#stock_e").val(value["ART_stockActual"]);
                            $("#stockminimo_e").val(value["ART_stockMinimo"]);
                            $("#costocompra_e").val(value["ART_costoCompra"]);
                            $("#precioventa_e").val(value["ART_Precioventa"]);
                            $("#igv_e").val(value["ART_IVA"]);
                            
                            
                        });

                }
                            
        }
    });
    document.getElementById("codigo_e").disabled=false;
    document.getElementById("codigobarras_e").disabled=false;
    document.getElementById("concepto_e").disabled=false;
    document.getElementById("codigo_e").disabled=false;
    document.getElementById("descripcion_e").disabled=false;
   
    document.getElementById("subfamilia_e").disabled=false;
    document.getElementById("observaciones_e").disabled=false;
    document.getElementById("stock_e").disabled=false;
    document.getElementById("stockminimo_e").disabled=false;
    document.getElementById("costocompra_e").disabled=false;
    document.getElementById("precioventa_e").disabled=false;
    document.getElementById("igv_e").disabled=false;
document.getElementById("actualizar").style.display='block';
}


function mostrarArticulo(idArticulo)
{
    $.ajax({
        type:'POST',
        data: {param_opcion:'buscar',param_articulo_id:idArticulo},
        dataType: 'json',
        url: "../../controller/controlarticulo/articulo_controller.php",
        success:function(data){
                if(data.length > 0)
                {
                   $.each(data, function (i, value) 
                        {
                            $("#codigo_e").val(value["ART_codigo"]);
                            $("#codigobarras_e").val(value["ART_codigoBarras"]);
                            $("#concepto_e").val(value["ART_concepto"]);
                            $("#descripcion_e").val(value["ART_descripcion"]);
                           
                            $("#subfamilia_e").val(value["SEC_codigo"]);
                            $("#observaciones_e").val(value["ART_observaciones"]);
                            $("#stock_e").val(value["ART_stockActual"]);
                            $("#stockminimo_e").val(value["ART_stockMinimo"]);
                            $("#costocompra_e").val(value["ART_costoCompra"]);
                            $("#precioventa_e").val(value["ART_Precioventa"]);
                            $("#igv_e").val(value["ART_IVA"]);
                            
                            
                        });

                }
                            
        }
    });
    document.getElementById("codigo_e").disabled=true;
    document.getElementById("codigobarras_e").disabled=true;
    document.getElementById("concepto_e").disabled=true;
    document.getElementById("codigo_e").disabled=true;
    document.getElementById("descripcion_e").disabled=true;
    document.getElementById("subfamilia_e").disabled=true;
    document.getElementById("observaciones_e").disabled=true;
    document.getElementById("stock_e").disabled=true;
    document.getElementById("stockminimo_e").disabled=true;
    document.getElementById("costocompra_e").disabled=true;
    document.getElementById("precioventa_e").disabled=true;
    document.getElementById("igv_e").disabled=true;
    document.getElementById("actualizar").style.display='none';
    

}


function anularArticulo(idArticulo)
{
    

    $.ajax({
        type:'POST',
        data: {param_opcion:'eliminar',param_articulo_id: idArticulo},
        url: "../../controller/controlarticulo/articulo_controller.php",
        success:function(data)
        {
             	listarArticulo();
                            
        }
    });
    
}


function eliminarArticuloF(idArticulo)
{
    var respuesta = confirm('¿Desea eliminar de forma permanente el artículo?');
    if (respuesta == true) {
    $.ajax({
        type:'POST',
        data: {param_opcion:'eliminarF',param_articulo_id: idArticulo},
        url: "../../controller/controlarticulo/articulo_controller.php",
        success:function(data)
        {
                //alert("Artículo eliminado satisfactoriamente"); 
                listarArticulo();
                          
        },
                error: function(data){
                    alert("No se puede eliminar el artículo");
                }

    });
    }else {
        if (respuesta == false) {
          alert('Se cancelo la eliminación');
        }
    }
}

function limpiar()
{
    
    document.getElementById("codigobarras").value='';
    document.getElementById("concepto").value='';
    document.getElementById("descripcion").value='';
    document.getElementById("presentacion1").value='';
    document.getElementById("presentacion2").value='';
    document.getElementById("proporcion").value='';
    //document.getElementById("subfamilia").selectedIndex=0;
    document.getElementById("observaciones").value='';
    //document.getElementById("stock").value='';
    document.getElementById("stockminimo").value='';
    document.getElementById("stock1").value='';
    document.getElementById("stock2").value='';
    document.getElementById("costocompra").value='';
    document.getElementById("precioventa").value='';
    document.getElementById("precioventa1").value='';
    document.getElementById("precioventa2").value='';
    document.getElementById("igv").value='';
    document.getElementById("tran").checked=false;
    document.getElementById("presentacion1").disabled=true;
    document.getElementById("presentacion2").disabled=true;
    document.getElementById("precioventa").disabled=false;
    document.getElementById("precioventa1").disabled=true;
    document.getElementById("precioventa2").disabled=true;
    document.getElementById("stock1").disabled=true;
    document.getElementById("stock2").disabled=true;

}

function transformar()
{
    var campo=document.getElementById("presentacion1");
    var campo2=document.getElementById("presentacion2");
    var campo3=document.getElementById("precioventa1");
    var campo4=document.getElementById("precioventa2");
    var campo5=document.getElementById("precioventa");
    var campo6=document.getElementById("proporcion");
    var campo7=document.getElementById("stock1");
    var campo8=document.getElementById("stock2");
    var campo9=document.getElementById("stockminimo");
    var tran=document.getElementById("tran");
    campo.disabled=!tran.checked;
    campo2.disabled=!tran.checked;
    campo3.disabled=!tran.checked;
    campo4.disabled=!tran.checked;
    campo5.disabled=tran.checked;
    campo6.disabled=!tran.checked;
    campo7.disabled=!tran.checked;
    campo8.disabled=!tran.checked;
    campo9.disabled=tran.checked;
}

function validarCampos()
{
    
    var tran=document.getElementById("tran");
    concepto = document.getElementById("concepto").value;
    descripcion = document.getElementById("descripcion").value;
    //descripcion2 = document.getElementById("descripcion2").value;
    proporcion = document.getElementById("proporcion").value;
    subfamilia = document.getElementById("subfamilia").selectedIndex;
    stockminimo = document.getElementById("stockminimo").value;
    costocompra = document.getElementById("costocompra").value;
    presentacion1 = document.getElementById("presentacion1").value;
    presentacion2 = document.getElementById("presentacion2").value;
    precioventa1 = document.getElementById("precioventa1").value;
    precioventa2 = document.getElementById("precioventa2").value;
    stock1 = document.getElementById("stock1").value;
    stock2 = document.getElementById("stock2").value;
    var precio1= parseInt(precioventa1);
    var precio2= parseInt(precioventa2);
    igv = document.getElementById("igv").value;




    if( concepto == null || concepto == 0 ) {
    return false;
    }

    if( descripcion == null || descripcion == 0 ) 
    {
    return false;
    }
    
    if (tran.checked==true) {
    if( presentacion1 == null || presentacion1 == 0 ) 
    {
    return false;
    }
    if( presentacion2 == null || presentacion2 == 0 ) 
    {
    return false;
    }

    if( precioventa1 == null || precioventa1 == 0 ) 
    {
    return false;
    }
    if( precioventa2 == null || precioventa2 == 0 ) 
    {
    return false;
    }
    if( stock1 == null || stock1 == 0 ) 
    {
    return false;
    }
    if( stock2 == null || stock2 == 0 ) 
    {
    return false;
    }
    if( precio1 <= precio2 ) 
    {
    alert("Precios de venta inválidos")
    return false;
    }
    if( proporcion == null || proporcion == 0 ) {
    return false;
    }
    }
    else{

    if( precioventa == null || precioventa == 0 ) 
    {
    return false;
    }
    if( stockminimo == null || stockminimo == 0 ) {
    return false;
    }

    }

    if( subfamilia == null || subfamilia == 0 ) 
    {
    return false;
    }
    
    if( costocompra == null || costocompra == 0 ) 
    {
    return false;
    }
    
    // if( igv == null || igv == 0 ) {
    // return false;
    // }

 

    
}






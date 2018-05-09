var MLCLIENTE = function () {
    var plugins = function() {
        $('#tblCliente, #tblMascotas').DataTable();
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

    var listarCliente = function() {      
        $.ajax({
            type:'POST',
            data: {param_opcion:'listar'},            
            url: "../../controller/Mantenedores_controller/cliente_controller.php",
            success:function(data){  
                if (data == "") {
                    infoMessage('No se encontraron datos.');                         
                } else {                                        
                    $('#tblCliente').DataTable().destroy();
                    $('#cuerpoClientes').html(data);
                    $('#tblCliente').DataTable();  
                }
                                                                                                
            }
        });
    }

    var eventoControles = function () {
        $('#nuevo_articulo').on('click', function () {        
            location.href = "mrCliente_view.php";
        });

        $('#listar_articulo').on('click', function () {        
            listarCliente();
        });    
    }

    return {
        init: function(){
            plugins();
            eventoControles();
            mostrarMenu();  
            //alerta_almacen();
            //alerta_spa();
            listarCliente();
        }    
    };
}();


var MRCLIENTE = function () {
    var arrayDepartamento = [];
    var arrayProvincia = [];
    var arrayDistrito = [];

    var plugins = function() {
        $('.select').chosen();        
    }
    
    var fnCargarDepartamento = function () {  
        var param_opcion = 'listar_departamento';
        $.ajax({
           type: "post",
            data:'param_opcion='+param_opcion,
            url: '../../controller/Parametros_controller/combos_controller.php',
            contenttype: "application/json;",
            datatype: "json",
            async: false,
            success: function (datos) {
                arrayDepartamento = JSON.parse(datos); // JSON.parse(datos);
                if (arrayDepartamento.length > 0) {
                    for (var i = 0; i < arrayDepartamento.length; i++) {
                        $('#param_departamento').append('<option value="' + arrayDepartamento[i].CODIGO + '">' + arrayDepartamento[i].label + '</option>');
                    }
                    $("#param_departamento").chosen("destroy");
                    $('#param_departamento').chosen({allow_single_deselect:false}); 
                } else {
                    $('#param_departamento').chosen({allow_single_deselect:false}); 
                    $('#param_departamento').val("").trigger('chosen:updated'); // PARA SETEAR EL COMBO CON UN VALOR DETERMINADO
                } 

            },
            error: function (msg) {
                console.log("No se pudo recuperar el Detalle del Movimiento Contable.");
            }
        }); 
      
        //$('#cbo_seccion').val("5").trigger('chosen:updated');   
    };

    var fnCargarProvincia = function (p_departamento) {          
        var param_opcion = 'listar_provincia';        
        $.ajax({
           type: "post",
            data:'param_opcion='+param_opcion+'&param_codigo='+p_departamento,
            url: '../../controller/Parametros_controller/combos_controller.php',
            contenttype: "application/json;",
            datatype: "json",
            async: false,
            success: function (datos) {                           
                arrayProvincia = JSON.parse(datos); // JSON.parse(datos); 
                $("#param_provincia").chosen("destroy");
                $("#param_provincia").empty();   
                $('#param_provincia').chosen({placeholder_text_single: "Seleccione Provincia"}); 
                $("#param_distrito").chosen("destroy");
                $("#param_distrito").empty();          
                $('#param_distrito').chosen({placeholder_text_single: "Seleccione Distrito"});     
                $('#param_distrito').chosen({allow_single_deselect:false});
                if (arrayProvincia.length > 0) {                    
                    for (var i = 0; i < arrayProvincia.length; i++) {
                        $('#param_provincia').append('<option value="' + arrayProvincia[i].CODIGO + '">' + arrayProvincia[i].label + '</option>');
                    }                    
                    $('#param_provincia').chosen({allow_single_deselect:false}); 
                    $('#param_provincia').val("").trigger('chosen:updated');
                } else {
                    $('#param_provincia').chosen({allow_single_deselect:false});
                    $('#param_provincia').val("").trigger('chosen:updated'); // PARA SETEAR EL COMBO CON UN VALOR DETERMINADO
                } 

            },
            error: function (msg) {
                console.log("No se pudo recuperar el Detalle del Movimiento Contable.");
            }
        }); 
      
        //$('#cbo_seccion').val("5").trigger('chosen:updated');   
    };

    var fnCargarDistrito = function (p_provincia) {          
        var param_opcion = 'listar_distrito';        
        $.ajax({
           type: "post",
            data:'param_opcion='+param_opcion+'&param_codigo='+p_provincia,
            url: '../../controller/Parametros_controller/combos_controller.php',
            contenttype: "application/json;",
            datatype: "json",
            async: false,
            success: function (datos) {                           
                arrayDistrito = JSON.parse(datos); // JSON.parse(datos); 
                $("#param_distrito").chosen("destroy");
                $("#param_distrito").empty();  
                $('#param_distrito').chosen({placeholder_text_single: "Seleccione Distrito"});               
                if (arrayDistrito.length > 0) {                    
                    for (var i = 0; i < arrayDistrito.length; i++) {
                        $('#param_distrito').append('<option value="' + arrayDistrito[i].CODIGO + '">' + arrayDistrito[i].label + '</option>');
                    }                    
                    $('#param_distrito').chosen({allow_single_deselect:false}); 
                    $('#param_distrito').val("").trigger('chosen:updated');
                } else {
                    $('#param_distrito').chosen({allow_single_deselect:false}); 
                    $('#param_distrito').val("").trigger('chosen:updated'); // PARA SETEAR EL COMBO CON UN VALOR DETERMINADO
                } 

            },
            error: function (msg) {
                console.log("No se pudo recuperar el Detalle del Movimiento Contable.");
            }
        }); 
      
        //$('#cbo_seccion').val("5").trigger('chosen:updated');   
    };

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

    var eventoControles = function () {
        $('#nuevo_articulo').on('click', function () {        
            
        });

        $('#listar_articulo').on('click', function () {        
            location.href = "mlCliente_view.php";
        });    


        $('#param_departamento').on('change', function () {
            arrayProvincia = JSON.parse('{}'); ;                            
            var p_departamento = $(this).val();
            fnCargarProvincia(p_departamento);
        });

        $('#param_provincia').on('change', function () {
            arrayDistrito = JSON.parse('{}'); ;                            
            var p_provincia = $(this).val();
            fnCargarDistrito(p_provincia);
        });

    }

    return {
        init: function(){
            plugins();            
            fnCargarDepartamento();
            eventoControles();
            mostrarMenu();  
            //alerta_almacen();
            //alerta_spa();            
        }    
    };
}();
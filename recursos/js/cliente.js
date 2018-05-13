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
        $('#nuevo_cliente').on('click', function () {        
            window.location.href = 'mrCliente_view.php';
        });

        $('#listar_cliente').on('click', function () {        
            location.href = "mlCliente_view.php";
        });    
        
        $('#cancel_cliente').on('click', function () {        
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

        $('#register_cliente').on('click', function () {   
            let bandera = false;

            if($.trim($('#param_nombres').val()).length==0){
                $("#param_nombres").attr("style", "border-color: #8e474a;");                        
                bandera = true;
            }else{
                $("#param_nombres").removeAttr("style", "border-color: #8e474a;");
                $('#param_nombres').parent().removeClass('has-error');
                bandera = false;
            }        

            if($.trim($('#param_apellidos').val()).length==0){
                $("#param_apellidos").attr("style", "border-color: #8e474a;");                
                bandera = true;
            }else{
                $("#param_apellidos").removeAttr("style", "border-color: #8e474a;");                
                bandera = false;
            }

            if($.trim($('#param_dni').val()).length==0){
                $('#param_dni').attr("style", "border-color: #8e474a;");
                bandera = true;                
            }else{
                $('#param_dni').removeAttr("style", "border-color: #8e474a;");
                bandera = false;
            }

             if($.trim($('#param_telefonoFijo').val()).length==0){
                $("#param_telefonoFijo").attr("style", "border-color: #8e474a;");                
                bandera = true;
            }else{
                $("#param_telefonoFijo").removeAttr("style", "border-color: #8e474a;");                
                bandera = false;
            }

            if($.trim($('#param_celular').val()).length==0){
                $("#param_celular").attr("style", "border-color: #8e474a;");                
                bandera = true;                
            }else{
                $("#param_celular").removeAttr("style", "border-color: #8e474a;");                
                bandera = false;
            } 

            if (bandera) {
                advertenciaMessage('Ingrese los datos obligatorios.');
                return;
            }       

            if($.trim($('#param_dni').val()).length < 8){
                $('#param_dni').attr("style", "border-color: #8e474a;");
                advertenciaMessage('El DNI debe tener 9 digitos.');  
                bandera = true;              
            } else {
                $('#param_dni').removeAttr("style", "border-color: #8e474a;");
                bandera = false;
            }

            if ($("#param_email").val() != '') {
                if( validar_email($("#param_email").val())) {
                    $('#param_email').removeAttr("style", "border-color: #8e474a;");                    
                    bandera = false;                    
                } else {
                    $('#param_email').attr("style", "border-color: #8e474a;");
                    advertenciaMessage('El EMAIL no tiene el formato correcto.'); 
                    bandera = true;
                    return;
                }
            } 

            if (!bandera) {
                var data = {
                    'param_opcion': 'registro_cliente',
                    'param_abreviatura': $("#param_abreviatura").val(),
                    'param_nombres': $("#param_nombres").val(),
                    'param_apellidos': $("#param_apellidos").val(),
                    'param_dni': $("#param_dni").val(),
                    'param_departamento': $("#param_departamento").val(),
                    'param_provincia': $("#param_provincia").val(),
                    'param_distrito': $("#param_distrito").val(),
                    'param_direccion': $("#param_direccion").val(),
                    'param_fechaNacimiento': (($("#param_fechaNacimiento").val() == '') ? '1900-01-01' : $("#param_fechaNacimiento").val()),
                    'param_telefonoFijo': $("#param_telefonoFijo").val(),
                    'param_celular': $("#param_celular").val(),                
                    'param_notificacion': $("#param_notificacion").val(),
                    'param_email': $("#param_email").val(),
                    'param_tipoCliente': $("#param_tipoCliente").val(),
                    'param_estado': $("#param_estado").val(),
                    'param_fechaAlta': $("#param_fechaAlta").val(),                                        
                    'param_observaciones': $("#param_observaciones").val()

                };

                $.ajax({
                    type: "post",
                    data:data,
                    url: '../../controller/Mantenedores_controller/cliente_controller.php',
                    contenttype: "application/json;",
                    datatype: "json",
                    async: false,
                    success: function (datos) { 
                        if (datos == 1) {
                            errorMessage('Ocurrio un error al registrar el cliente');
                        }             

                        if (datos == 2) {
                            infoMessage('El cliente ya esta registrado');
                        }

                        if (datos > 1 || datos > 2) {
                            $("#param_codigo").val(datos);                        
                            $("#param_fechaAlta").attr("disabled", true);
                            $('#param_estado').prop('disabled', false).trigger("chosen:updated"); 
                            $("#register_cliente").attr("style", "display:none");
                            $("#update_cliente").attr("style", "display:inline");
                            exitoMessage('El cliente se registro correctamente');
                        } else {
                            errorMessage('Ocurrio un error al registrar el cliente');
                        }
                    },
                    error: function (msg) {
                        console.log("No se pudo recuperar el Detalle del Movimiento Contable.");
                    }
                }); 
                
            }    
        });

        $('#update_cliente').on('click', function () {    
            let bandera = false;

            if($.trim($('#param_nombres').val()).length==0){
                $("#param_nombres").attr("style", "border-color: #8e474a;");                        
                bandera = true;
            }else{
                $("#param_nombres").removeAttr("style", "border-color: #8e474a;");
                $('#param_nombres').parent().removeClass('has-error');
                bandera = false;
            }        

            if($.trim($('#param_apellidos').val()).length==0){
                $("#param_apellidos").attr("style", "border-color: #8e474a;");                
                bandera = true;
            }else{
                $("#param_apellidos").removeAttr("style", "border-color: #8e474a;");                
                bandera = false;
            }

            if($.trim($('#param_dni').val()).length==0){
                $('#param_dni').attr("style", "border-color: #8e474a;");
                bandera = true;                
            }else{
                $('#param_dni').removeAttr("style", "border-color: #8e474a;");
                bandera = false;
            }

             if($.trim($('#param_telefonoFijo').val()).length==0){
                $("#param_telefonoFijo").attr("style", "border-color: #8e474a;");                
                bandera = true;
            }else{
                $("#param_telefonoFijo").removeAttr("style", "border-color: #8e474a;");                
                bandera = false;
            }

            if($.trim($('#param_celular').val()).length==0){
                $("#param_celular").attr("style", "border-color: #8e474a;");                
                bandera = true;                
            }else{
                $("#param_celular").removeAttr("style", "border-color: #8e474a;");                
                bandera = false;
            } 

            if (bandera) {
                advertenciaMessage('Ingrese los datos obligatorios.');
                return;
            }       

            if($.trim($('#param_dni').val()).length < 8){
                $('#param_dni').attr("style", "border-color: #8e474a;");
                advertenciaMessage('El DNI debe tener 9 digitos.');  
                bandera = true;              
            } else {
                $('#param_dni').removeAttr("style", "border-color: #8e474a;");
                bandera = false;
            }

            if ($("#param_email").val() != '') {
                if( validar_email($("#param_email").val())) {
                    $('#param_email').removeAttr("style", "border-color: #8e474a;");                    
                    bandera = false;                    
                } else {
                    $('#param_email').attr("style", "border-color: #8e474a;");
                    advertenciaMessage('El EMAIL no tiene el formato correcto.'); 
                    bandera = true;
                    return;
                }
            } 


            if (!bandera) {
                var data = {
                    'param_opcion': 'modificar_cliente',
                    'param_codigo': $("#param_codigo").val(),
                    'param_abreviatura': $("#param_abreviatura").val(),
                    'param_nombres': $("#param_nombres").val(),
                    'param_apellidos': $("#param_apellidos").val(),
                    'param_dni': $("#param_dni").val(),
                    'param_departamento': $("#param_departamento").val(),
                    'param_provincia': $("#param_provincia").val(),
                    'param_distrito': $("#param_distrito").val(),
                    'param_direccion': $("#param_direccion").val(),
                    'param_fechaNacimiento': (($("#param_fechaNacimiento").val() == '') ? '1900-01-01' : $("#param_fechaNacimiento").val()),
                    'param_telefonoFijo': $("#param_telefonoFijo").val(),
                    'param_celular': $("#param_celular").val(),
                    'param_notificacion': $("#param_notificacion").val(),                
                    'param_email': $("#param_email").val(),
                    'param_tipoCliente': $("#param_tipoCliente").val(),
                    'param_estado': $("#param_estado").val(),                                        
                    'param_observaciones': $("#param_observaciones").val()
                };

                $.ajax({
                    type: "post",
                    data:data,
                    url: '../../controller/Mantenedores_controller/cliente_controller.php',
                    contenttype: "application/json;",
                    datatype: "json",
                    async: false,
                    success: function (datos) { 
                        if (datos == 1) {
                            errorMessage('Ocurrio un error al modificar el cliente');
                        }             

                        if (datos == 2) {
                            infoMessage('El dni ingresado ya existe');
                        }

                        if (datos == 3) {                                                                    
                            exitoMessage('El cliente se modifico correctamente');
                        }
                    },
                    error: function (msg) {
                        console.log("No se pudo recuperar el Detalle del Movimiento Contable.");
                    }
                }); 
            }        
        });
    }

    var cargaInicial = function () {
        var cod = ObtenerQueryString("cod");

        if (cod !== undefined) {
            $("#param_codigo").val(cod);
            $.ajax({
                type:'POST',
                data: {param_opcion:'listar_cliente', param_codigo:cod},            
                url: "../../controller/Mantenedores_controller/cliente_controller.php",
                success:function(data){  
                    console.log(data)
                    data = JSON.parse(data);
                    console.log(data)
                    if (data,length = 0) {
                        infoMessage('No se pudo recuperar los datos del cliente.');                         
                    } else {  
                        $("#param_fechaAlta").attr("disabled", true);                                      
                        $("#param_nombres").val(data[0].CLI_NOMBRES);
                        $("#param_apellidos").val(data[0].CLI_APELLIDOS);
                        $('#param_abreviatura').val(data[0].ABREVIATURA).trigger('chosen:updated');   
                        $("#param_direccion").val(data[0].DIRECCION);
                        $("#param_dni").val(data[0].DNI);
                        $("#param_telefonoFijo").val(data[0].TELEFONO);
                        $("#param_celular").val(data[0].CELULAR);                    
                        $('#param_notificacion').val(data[0].NOTIFICACION).trigger('chosen:updated');                       
                        $('#param_tipoCliente').val(data[0].TIPO_CLIENTE).trigger('chosen:updated');                       
                        $('#param_estado').val(data[0].ESTADO).trigger('chosen:updated');                       
                        $("#param_observaciones").val(data[0].OBSERVACION);
                        if (data[0].FECHA_NACIMIENTO != '1900-01-01') {
                            $("#param_fechaNacimiento").val(data[0].FECHA_NACIMIENTO);
                        }                    
                        $("#param_email").val(data[0].EMAIL);                    
                        $("#param_fechaAlta").val(data[0].FECHA_ALTA);
                        $("#param_fechaModificacion").val(data[0].FECHA_MODIFICACION);
                        $('#param_departamento').val(data[0].DEPARTAMENTO).trigger('chosen:updated').change();  
                        $('#param_provincia').val(data[0].PROVINCIA).trigger('chosen:updated').change();
                        $('#param_distrito').val(data[0].DISTRITO).trigger('chosen:updated');  
                        if (data[0].FECHA_BAJA != null) {
                            $("#param_fechaBaja").val(data[0].FECHA_BAJA);
                        }
                    }
                }
            });
            $("#register_cliente").attr("style", "display:none");   
            $("#update_cliente").attr("style", "display:inline");   
        } else {
            $('#param_estado').val("1").trigger('chosen:updated'); 
            $('#param_estado').prop('disabled', true).trigger("chosen:updated"); 
            $("#update_cliente").attr("style", "display:none");   
        }

                    
    }

    return {
        init: function(){
            plugins();            
            fnCargarDepartamento();
            eventoControles();
            mostrarMenu();  
            //alerta_almacen();
            //alerta_spa();            
            cargaInicial();
        }    
    };
}();

function editarCliente(codigo) {    
    window.location.href = 'mrCliente_view.php?cod='+codigo;
}

function listarCliente() {      
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


function anularCliente(codigo) {    
    $.ajax({
        type:'POST',
        data: {param_opcion:'desactivar_cliente', param_codigo:codigo, param_operacion:'1'},            
        url: "../../controller/Mantenedores_controller/cliente_controller.php",
        success:function(data){              
            if (data == 1) {
                exitoMessage('La operación se realizo correctamente');  
                listarCliente();                   
            } else {
                errorMessage('Ocurrio un error al realizar la operación');
            }
        }
    });
}

function activarCliente(codigo) {    
    $.ajax({
        type:'POST',
        data: {param_opcion:'activar_cliente', param_codigo:codigo, param_operacion:'2'},            
        url: "../../controller/Mantenedores_controller/cliente_controller.php",
        success:function(data){              
            if (data == 1) {
                exitoMessage('La operación se realizo correctamente');  
                listarCliente();                   
            } else {
                errorMessage('Ocurrio un error al realizar la operación');
            }
        }
    });
}
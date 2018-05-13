function infoMessage(mensaje) {    
    $.gritter.add({
      title: 'Información!',
      image: '../../recursos/images/info.png',        
      text: mensaje,
      sticky: false,          
      time: 2000,
      class_name: 'gritter-info gritter-light'
    });
}

function errorMessage(mensaje) {    
    $.gritter.add({
      title: 'Error!',
      image: '../../recursos/images/error.png',        
      text: mensaje,
      sticky: false,          
      time: 2000,
      class_name: 'gritter-error gritter-light'
    });
}

function exitoMessage(mensaje) {    
    $.gritter.add({
      title: 'Éxito!',
      image: '../../recursos/images/exito.png',        
      text: mensaje,
      sticky: false,          
      time: 2000,
      class_name: 'gritter-success gritter-light'
    });
}

function advertenciaMessage(mensaje) {    
    $.gritter.add({
      title: 'Advertencia!',
      image: '../../recursos/images/warning.png',        
      text: mensaje,
      sticky: false,          
      time: 2000,
      class_name: 'gritter-warning gritter-light'
    });
}

function ValidaNumeros(e, field) {
    key = e.keyCode ? e.keyCode : e.which
    // backspace
    if (key == 8) return true  
    // 0-9 
    if (key > 47 && key < 58) {
        if (field.value == "") return true
        regexp = /[0-9]{50}/;
        return !(regexp.test(field.value))
    }
    return false
}

function ValidaDecimales(e, field, cantidad, negativos) {
    var neg = negativos !== undefined ? negativos : 0;

    key = e.keyCode ? e.keyCode : e.which
    // backspace
    if (key == 8) return true



    if (cantidad == undefined) {
        regexp = /[0-9]{3}$/
    } else {
        regexp = new RegExp("[0-9]{" + cantidad + "}$")  
    }

    // 0-9 a partir del .decimal  
    if (field.value != "") {
        if ((field.value.indexOf(".")) > 0) {
            //si tiene un punto valida dos digitos en la parte decimal
            if (key > 47 && key < 58) {
                if (field.value == "") return true 
                return !(regexp.test(field.value))
            }
        }
    }
    // 0-9 
    if (key > 47 && key < 58) {
        if (field.value == "") return true
        regexp = /\d{10}/
        return !(regexp.test(field.value))
    }
    // .
    if (key == 46) {
        if (field.value == "") return false
        regexp = /^-?\d+$/
        return regexp.test(field.value)
    }

    if (neg) {
        // -
        if (key == 45) {
            if (field.value == "") return true
           // regexp = /^-?\d+(\.\d+)?$/          
        }
    }
    // other key
    return false
}

//OBTENER QUERY STRING POR JQUERY
function ObtenerQueryString(param) {
    var urlpagina = window.location.search.substring(1);
    var variables = urlpagina.split('?');
    for (var i = 0; i < variables.length; i++) {
        var nombrparam = variables[i].split('=');
        if (nombrparam[0] == param) {
            return nombrparam[1]; //valor

        }
    }
}

function soloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " �����abcdefghijklmn�opqrstuvwxyz";
    especiales = "8-37-39-46";

    tecla_especial = false
    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if (letras.indexOf(tecla) == -1 && !tecla_especial) {
        return false;
    }
}

function validar_email( email ) {
    var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email) ? true : false;
}
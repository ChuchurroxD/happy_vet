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
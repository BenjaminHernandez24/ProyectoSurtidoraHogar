const form_registro = document.getElementById('formRegistro');
//------- Evento para botón de registro de  Productos ------//
form_registro.addEventListener('submit', async(e) => {
    e.preventDefault();
    try {
        var datosRegistro = new FormData(form_registro);
        datosRegistro.append('registro_usuario', 'OK');

        var peticion = await fetch('../Controllers/Registro_Controller.php', {
            method: 'POST',
            body: datosRegistro
        });
      //----- Se obtiene la respuesta ------//
        var resjson = await peticion.json();
        
        if (resjson.respuesta == "OK" ) {
            notificacionExitosa('Usted ha sido registrado');
          

        } else {
              notificarError(resjson.respuesta);    
         }
    } catch (error) {
        notificarError('Se ha generado un error en el servidor!');
        console.log(error);
    }
})
// ------- Mensajes de Alert -------//
function notificacionExitosa(mensaje) {
    Swal.fire(
        mensaje,
        '',
        'success'
    )
}

function notificarError(mensaje) {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: mensaje
    })
}


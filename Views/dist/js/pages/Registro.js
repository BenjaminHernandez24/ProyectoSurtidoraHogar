const form_registro = document.getElementById('formRegistro');
//------- Evento para botón de registro de  Usuarios. ------//
form_registro.addEventListener('submit', async(e) => {
    e.preventDefault();
    try {
        var datosRegistro = new FormData(form_registro);
        datosRegistro.append('registro_usuario', 'OK');

        var peticion = await fetch('../Controllers/Registro_Controller.php', {
            method: 'POST',
            body: datosRegistro
        });
      //----- Se obtiene la respuesta del controlador. ------//
        var resjson = await peticion.json();
        
        if (resjson.respuesta == "OK" ) {
            notificacionExitosa('Usuario registrado');
            // --------- Limpiar campos del formulario para agregar producto -----------//
            $('#formRegistro').trigger("reset");
        } else {
              notificarError(resjson.respuesta);
              $('#formRegistro').trigger("reset");    
         }
    } catch (error) {
        notificarError('Se ha generado un error en el servidor!');
        console.log(error);
        $('#formRegistro').trigger("reset");
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

// --------- Limpiar campos del formulario para agregar producto -----------//
/*document.getElementById('nuevo_usuario').addEventListener('click', () => {
    form_registro.reset();
})*/

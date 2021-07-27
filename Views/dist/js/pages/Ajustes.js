const formRestaurar = document.getElementById('frmRestauracion');
const formUsuario = document.getElementById('frmUsuario');

formUsuario.addEventListener('submit', async(e) => {
    e.preventDefault();
    var usuario = document.getElementById('usuario').value;
    var password = document.getElementById('newpassword').value;
    var repetirPassword = document.getElementById('repetirpassword').value;

    let datos = new FormData();
    datos.append('passwordUsuario', 'OK');
    datos.append('usuario', usuario);
    datos.append('password', password);
    datos.append('repetirPassword', repetirPassword);

    if (password == repetirPassword) {
        let peticion = await fetch('../Controllers/AjustesController.php', {
            method: 'POST',
            body: datos
        });

        let resjson = await peticion.json();

        if (resjson.respuesta == "OK") {
            notificacionExitosa('Contraseña Cambiada Correctamente');
            document.getElementById('repetirpassword').value = "";
            document.getElementById('newpassword').value = "";
        } else if (resjson.respuesta == "Caracteres no admitidos") {
            notificarError('No Se Admiten Caracteres Especiales');
        }
    } else {
        notificarError('Las Contraseñas No Coinciden');
    }
})

formRestaurar.addEventListener('submit', async(e) => {
    e.preventDefault();
    const result = await Swal.fire({
        title: 'CONFIRMAR RESPALDO DE BASE DE DATOS',
        text: "Si no lo esta puede cancelar la acción!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#5bc0de',
        cancelButtonColor: '#d9534f',
        confirmButtonText: 'Realizar Backups!'
    });

    if (result.value) {
        try {

            let datos = new FormData();
            datos.append('backups', 'OK');

            let peticion = await fetch('../Controllers/AjustesController.php', {
                method: 'POST',
                body: datos
            });

            let resjson = await peticion.json();


            /*let datoss = new FormData();
            datoss.append('backups_remove', 'OK');
            datoss.append('ruta', resjson.nombre);

            let peticionn = await fetch('../Controllers/AjustesController.php', {
                method: 'POST',
                body: datoss
            });

            let resjsonn = await peticionn.json();*/
            notificacionExitosa("Respaldo realizado correctamente")
        } catch (error) {
            console.log(error);
        }

    }
})

function notificacionExitosa(mensaje) {
    Swal.fire(mensaje, '', 'success').then(result => {});
}

function notificarError(mensaje) {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: mensaje
    })
}
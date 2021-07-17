const formRestaurar = document.getElementById('frmRestauracion');

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


            let datoss = new FormData();
            datoss.append('backups_remove', 'OK');
            datoss.append('ruta', resjson.nombre);

            let peticionn = await fetch('../Controllers/AjustesController.php', {
                method: 'POST',
                body: datoss
            });

            let resjsonn = await peticionn.json();
            notificacionExitosa("Respaldo realizado correctamente")
        } catch (error) {
            console.log(error);
        }

    }
})

function notificacionExitosa(mensaje) {
    Swal.fire(mensaje, '', 'success').then(result => {});
}
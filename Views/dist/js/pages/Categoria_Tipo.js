const form_agregar_tipo = document.getElementById('frm_tipo_producto');
const form_editar_tipo = document.getElementById('frm_editar_tipo');

var tabla_tipo;
var id_tipo;

// Llenar Tabla Tipo Producto. //
async function init() {
    tabla_tipo = $("#tabCategoriaTipo").DataTable({
        "responsive": true,
        "autoWidth": false,
        "ajax": {
            "url": "../Controllers/Tipo_Producto_Controller.php",
            "type": "POST",
            "data": {
                "obtener_tipo": "OK"
            },
            "dataSrc": ""
        },
        "columns": [
            {"data": "id_tipo"},
            {"data": "descripcion_tipo"},
            {
                "data": (s) => {
                    if (s.estatus == 1) {
                        return `<button class="btn btn-success btn-sm desactivar">Activo</button>`;
                    } else {
                        return `<button class="btn btn-danger btn-sm activar">Inactivo</button>`;
                    }
                }
            },
            {
              "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-info btn-sm btnEditar'><i class='fas fa-edit'></i></button><button class='btn btn-danger btn-sm btnBorrar'><i class='fas fa-trash-alt'></i></button></div></div>"
            }]
    });
}

init();
//------- Evento para botón de registro de Tipo Producto ------//
form_agregar_tipo.addEventListener('submit', async(e) => {
    e.preventDefault();
    try {
        var datosTipo = new FormData(form_agregar_tipo);
        datosTipo.append('agregar_tipo', 'OK');

        var peticion = await fetch('../Controllers/Tipo_Producto_Controller.php', {
            method: 'POST',
            body: datosTipo
        });
      //----- Se obtiene la respuesta ------//
        var resjson = await peticion.json();

        if (resjson.respuesta == "OK") {
            notificacionExitosa('Tipo producto registrado');
            tabla_tipo.ajax.reload(null, false);

        } else if (resjson.respuesta == "EXISTE") {

            notificarError('Este tipo de producto ya ha sido registrado');

        } else {
            notificarError(resjson.respuesta);
        }
    } catch (error) {
        console.log(error);
    }
})
//------- Evento para botón de Editar el Tipo Producto ------//
form_editar_tipo.addEventListener('submit', async(e) => {
    e.preventDefault();

    try {
        var datosTipo = new FormData(form_editar_tipo);
        datosTipo.append('editar_tipo', 'OK');
        datosTipo.append('idTipo', idTipo);

        var peticion = await fetch('../Controllers/Tipo_Producto_Controller.php', {
            method: 'POST',
            body: datosTipo
        });

        var resjson = await peticion.json();

        if (resjson.respuesta == "OK") {
            notificacionExitosa('Tipo Producto actualizado');
            tabla_tipo.ajax.reload(null, false);

        } else {
            notificarError(resjson.respuesta);
        }
    } catch (error) {
        console.log(error);
    }
})

//-------  Editar el Tipo Producto ------//
$(document).on("click", ".btnEditar", function() {

    if (tabla_tipo.row(this).child.isShown()) {
        var data = tabla_tipo.row(this).data();
    } else {
        var data = tabla_tipo.row($(this).parents("tr")).data();
    }

    // ------ Obtenemos datos de inputs -------//
    idTipo = data[0];
    $("#des_tipo").val(data[1]);

    // -----Mostramos el modal -----//
    $('#editar_tipo_producto').modal('show');
});

//---- Evento para botón de Borrar el Tipo Producto ----//
$(document).on('click', ".btnBorrar", async function() {

    if (tabla_tipo.row(this).child.isShown()) {
        var data = tabla_tipo.row(this).data();
    } else {
        var data = tabla_tipo.row($(this).parents("tr")).data();
    }

    id_tipo = data[0];

    const result = await Swal.fire({
        title: '¿ESTÁ SEGURO(A) DE ELIMINAR ESTE TIPO DE PRODUCTO?',
        text: "¡Afectará las Ventas y se eliminará en Módulo Productos!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#5bc0de',
        cancelButtonColor: '#d9534f',
        confirmButtonText: '¡Estoy seguro(a)!'
    });

    if (result.value) {
        try {

            var datosTipo = new FormData();
            datosTipo.append('eliminar_tipo', 'OK');
            datosTipo.append('id_tipo', id_tipo);
 
            var peticion = await fetch('../Controllers/Tipo_Producto_Controller.php', {
                method: 'POST',
                body: datosTipo
            });

            var resjson = await peticion.json();

            if (resjson.respuesta == "OK") {
                notificacionExitosa('¡ELiminación exitosa!');
                tabla_tipo.ajax.reload(null, false);
            } else {
                notificarError(resjson.respuesta);
            }

        } catch (error) {
            console.log(error);
        }
    }

})
$(document).on('click', '.desactivar', async function() {
    try {
        notificacionInactivoTipo('Usted, ha cambiado el estado del Tipo de Producto a: "Inactivo"');
        if (tabla_tipo.row(this).child.isShown()) {
            var data = tabla_tipo.row(this).data();
        } else {
            var data = tabla_tipo.row($(this).parents("tr")).data();
        }

        let datos = new FormData();
        datos.append('desactivarTipo', 'OK');
        datos.append('id_tipo', data['id_tipo']);
        let peticion = await fetch('../Controllers/Tipo_Producto_Controller.php', {
            method: 'POST',
            body: datos
        });

        let resjson = await peticion.json();

        if (resjson.respuesta == "OK") {
            tabla_tipo.ajax.reload(null, false);
        } else {
            notificarError(resjson.respuesta);
        }

    } catch (error) {
        console.log(error)
    }
})

$(document).on('click', '.activar', async function() {
    try {
        notificacionActivoTipo('Usted, ha cambiado el estado del Tipo de producto a: "Activo"');
        if (tabla_tipo.row(this).child.isShown()) {
            var data = tabla_tipo.row(this).data();
        } else {
            var data = tabla_tipo.row($(this).parents("tr")).data();
        }

        let datos = new FormData();
        datos.append('activarTipo', 'OK');
        datos.append('id_tipo', data['id_tipo']);
        let peticion = await fetch('../Controllers/Tipo_Producto_Controller.php', {
            method: 'POST',
            body: datos
        });

        let resjson = await peticion.json();

        if (resjson.respuesta == "OK") {
            tabla_tipo.ajax.reload(null, false);
        } else {
            notificarError(resjson.respuesta);
        }

    } catch (error) {
        console.log(error)
    }
})
// ------- Mensajes de Alert -------//
function notificacionActivoTipo(mensaje) {
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: mensaje,
        showConfirmButton: false,
        timer: 3000
    })
}

function notificacionInactivoTipo(mensaje) {
    Swal.fire({
        position: 'center',
        icon: 'warning',
        title: mensaje,
        showConfirmButton: false,
        timer: 3000
    })
}
function notificacionExitosa(mensaje) {
    Swal.fire(
        mensaje,
        '',
        'success'
    ).then(result => {
        form_agregar_tipo.reset();
        $("#nuevo_cat_tipo").modal("hide");
        document.getElementById('cerrar').click();
        document.getElementById('cerrarEditar').click();
    });
}

function notificarError(mensaje) {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: mensaje
    })
}

// --------- Limpiar campos del formulario para agregar Tipo producto -----------//
document.getElementById('alta_tipo').addEventListener('click', () => {
    form_agregar_tipo.reset();
})

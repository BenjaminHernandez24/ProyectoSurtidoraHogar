const form_agregar_marca = document.getElementById('frm_marca_producto');
const form_editar_marca = document.getElementById('frm_editar_marca');

var tabla_marca;
var id_marca;

// Llenar Tabla Marca Producto. //
async function init() {
    tabla_marca = $("#tab_categoria_marca").DataTable({
        "responsive": true,
        "autoWidth": false,
        "ajax": {
            "url": "../Controllers/Marca_Producto_Controller.php",
            "type": "POST",
            "data": {
                "obtener_marca": "OK"
            },
            "dataSrc": ""
        },
        "columns": [
            {"data": "id_marca"},
            {"data": "descripcion_marca"},
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
//------- Evento para botón de registro de Marca Producto ------//
form_agregar_marca.addEventListener('submit', async(e) => {
    e.preventDefault();
    try {
        var datosMarca = new FormData(form_agregar_marca);
        datosMarca.append('agregar_marca', 'OK');

        var peticion = await fetch('../Controllers/Marca_Producto_Controller.php', {
            method: 'POST',
            body: datosMarca
        });
      //----- Se obtiene la respuesta ------//
        var resjson = await peticion.json();

        if (resjson.respuesta == "OK") {
            notificacionExitosa('Marca producto registrado');
            tabla_marca.ajax.reload(null, false);

        } else if (resjson.respuesta == "EXISTE") {

            notificarError('Esta marca de producto ya ha sido registrada');

        } else {
            notificarError(resjson.respuesta);
        }
    } catch (error) {
        console.log(error);
    }
})
//------- Evento para botón de Editar la Marca de Producto ------//
form_editar_marca.addEventListener('submit', async(e) => {
    e.preventDefault();

    try {
        var datosMarca = new FormData(form_editar_marca);
        datosMarca.append('editar_marca', 'OK');
        datosMarca.append('idMarca', idMarca);

        var peticion = await fetch('../Controllers/Marca_Producto_Controller.php', {
            method: 'POST',
            body: datosMarca
        });

        var resjson = await peticion.json();

        if (resjson.respuesta == "OK") {
            notificacionExitosa('Marca Producto actualizado');
            tabla_marca.ajax.reload(null, false);

        } else {
            notificarError(resjson.respuesta);
        }
    } catch (error) {
        console.log(error);
    }
})

//-------  Editar la Marca de Producto ------//
$(document).on("click", ".btnEditar", function() {

    if (tabla_marca.row(this).child.isShown()) {
        var data = tabla_marca.row(this).data();
    } else {
        var data = tabla_marca.row($(this).parents("tr")).data();
    }

    // ------ Obtenemos datos de inputs -------//
    idMarca = data[0];
    $("#des_marca").val(data[1]);

    // -----Mostramos el modal -----//
    $('#editar_marca_producto').modal('show');
});

//---- Evento para botón de Borrar la Marca de Producto ----//
$(document).on('click', ".btnBorrar", async function() {

    if (tabla_marca.row(this).child.isShown()) {
        var data = tabla_marca.row(this).data();
    } else {
        var data = tabla_marca.row($(this).parents("tr")).data();
    }

    id_marca = data[0];

    const result = await Swal.fire({
        title: '¿ESTÁ SEGURO(A) DE ELIMINAR ESTA MARCA DE PRODUCTO?',
        text: "¡Afectará las Ventas y se eliminará en Módulo Productos!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#5bc0de',
        cancelButtonColor: '#d9534f',
        confirmButtonText: '¡Estoy seguro(a)!'
    });

    if (result.value) {
        try {

            var datosMarca = new FormData();
            datosMarca.append('eliminar_marca', 'OK');
            datosMarca.append('id_marca', id_marca);
 
            var peticion = await fetch('../Controllers/Marca_Producto_Controller.php', {
                method: 'POST',
                body: datosMarca
            });

            var resjson = await peticion.json();

            if (resjson.respuesta == "OK") {
                notificacionExitosa('¡ELiminación exitosa!');
                tabla_marca.ajax.reload(null, false);
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
        notificacionInactivoMarca('Usted, ha cambiado el estado de Marca de Producto a: "Inactivo"');
        if (tabla_marca.row(this).child.isShown()) {
            var data = tabla_marca.row(this).data();
        } else {
            var data = tabla_marca.row($(this).parents("tr")).data();
        }

        let datos = new FormData();
        datos.append('desactivarMarca', 'OK');
        datos.append('id_marca', data['id_marca']);
        let peticion = await fetch('../Controllers/Marca_Producto_Controller.php', {
            method: 'POST',
            body: datos
        });

        let resjson = await peticion.json();

        if (resjson.respuesta == "OK") {
            tabla_marca.ajax.reload(null, false);
        } else {
            notificarError(resjson.respuesta);
        }

    } catch (error) {
        console.log(error)
    }
})

$(document).on('click', '.activar', async function() {
    try {
        notificacionActivoMarca('Usted, ha cambiado el estado de Marca de producto a: "Activo"');
        if (tabla_marca.row(this).child.isShown()) {
            var data = tabla_marca.row(this).data();
        } else {
            var data = tabla_marca.row($(this).parents("tr")).data();
        }

        let datos = new FormData();
        datos.append('activarMarca', 'OK');
        datos.append('id_marca', data['id_marca']);
        let peticion = await fetch('../Controllers/Marca_Producto_Controller.php', {
            method: 'POST',
            body: datos
        });

        let resjson = await peticion.json();

        if (resjson.respuesta == "OK") {
            tabla_marca.ajax.reload(null, false);
        } else {
            notificarError(resjson.respuesta);
        }

    } catch (error) {
        console.log(error)
    }
})
// ------- Mensajes de Alert Estados -------//
function notificacionActivoMarca(mensaje) {
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: mensaje,
        showConfirmButton: false,
        timer: 3000
    })
}

function notificacionInactivoMarca(mensaje) {
    Swal.fire({
        position: 'center',
        icon: 'warning',
        title: mensaje,
        showConfirmButton: false,
        timer: 3000
    })
}
// ------- Mensajes de Alert -------//
function notificacionExitosa(mensaje) {
    Swal.fire(
        mensaje,
        '',
        'success'
    ).then(result => {
        form_agregar_marca.reset();
        $("#nueva_marca").modal("hide");
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

// --------- Limpiar campos del formulario para agregar Marca producto -----------//
document.getElementById('alta_marca').addEventListener('click', () => {
    form_agregar_marca.reset();
})


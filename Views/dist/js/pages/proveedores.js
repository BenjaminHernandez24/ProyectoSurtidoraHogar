const formaddProveedor = document.getElementById('frmProveedor');
const formupdateProveedor = document.getElementById('frmEditarProveedor');

var tablaProveedores;
var idProveedor;

/* LLENADO DE TABLA PROVEEDORES */
async function init() {
    tablaProveedores = $("#tblProveedores").DataTable({
        "responsive": true,
        "autoWidth": false,
        "ajax": {
            "url": "../Controllers/ProveedoresController.php",
            "type": "POST",
            "data": {
                "obtenerProveedores": "OK"
            },
            "dataSrc": ""
        },
        "columns": [{
                "data": "id_prov"
            },
            {
                "data": "nom_empresa"
            },
            {
                "data": "tel_empresa"
            },
            {
                "data": "nom_prov"
            },
            {
                "data": "tel_prov"
            },
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
            }
        ]
    });
}

init();

/* CUANDO SE PRESIONA EL BOTON REGISTRAR EN EL MODAL DE REGISTRAR PROVEEDOR */
formaddProveedor.addEventListener('submit', async(e) => {
    e.preventDefault();

    try {
        var datosProveedores = new FormData(formaddProveedor);
        datosProveedores.append('agregarProveedores', 'OK');

        var peticion = await fetch('../Controllers/ProveedoresController.php', {
            method: 'POST',
            body: datosProveedores
        });

        var resjson = await peticion.json();

        if (resjson.respuesta == "OK") {
            notificacionExitosa('¡Alta Exitoso!');
            tablaProveedores.ajax.reload(null, false);

        } else {
            notificarError('Ocurrio un Error');
        }
    } catch (error) {
        console.log(error);
    }
})

/* CUANDO SE PRESIONA EL BOTON GUARDAR EN EL MODAL DE EDITAR PROVEEDOR */
formupdateProveedor.addEventListener('submit', async(e) => {
    e.preventDefault();

    try {
        var datosProveedores = new FormData(formupdateProveedor);
        datosProveedores.append('editarProveedores', 'OK');
        datosProveedores.append('idProveedor', idProveedor);

        var peticion = await fetch('../Controllers/ProveedoresController.php', {
            method: 'POST',
            body: datosProveedores
        });

        var resjson = await peticion.json();

        if (resjson.respuesta == "OK") {
            notificacionExitosa('¡Modificación Exitoso!');
            tablaProveedores.ajax.reload(null, false);

        } else {
            notificarError('Ocurrio un Error');
        }
    } catch (error) {
        console.log(error);
    }
})

/* CUANDO SE PRESIONA EL BOTON EDITAR */
$(document).on("click", ".btnEditar", function() {

    if (tablaProveedores.row(this).child.isShown()) {
        var data = tablaProveedores.row(this).data();
    } else {
        var data = tablaProveedores.row($(this).parents("tr")).data();
    }

    /* Cargamos los datos obtenidos al modal editar */
    idProveedor = data[0];
    $("#nom_empresa").val(data[1]);
    $("#tel_empresa").val(data[2]);
    $("#nom_prov").val(data[3]);
    $("#tel_prov").val(data[4]);

    /* Hacemos visible el modal */
    $('#editar_proveedor').modal('show');
});

/* CUANDO SE PRESIONA EL BOTON BORRAR */
$(document).on('click', ".btnBorrar", async function() {

    if (tablaProveedores.row(this).child.isShown()) {
        var data = tablaProveedores.row(this).data();
    } else {
        var data = tablaProveedores.row($(this).parents("tr")).data();
    }

    idProveedor = data[0];

    const result = await Swal.fire({
        title: '¿ESTA SEGURO DE ELIMINAR AL PROVEEDOR?',
        text: "Si no lo esta puede cancelar la acción",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#5bc0de',
        cancelButtonColor: '#d9534f',
        confirmButtonText: 'Si, eliminar'
    });

    if (result.value) {
        try {

            var datosProveedores = new FormData();
            datosProveedores.append('eliminarProveedores', 'OK');
            datosProveedores.append('idProveedor', idProveedor);

            var peticion = await fetch('../Controllers/ProveedoresController.php', {
                method: 'POST',
                body: datosProveedores
            });

            var resjson = await peticion.json();

            if (resjson.respuesta == "OK") {
                notificacionExitosa('¡ELiminación exitosa!');
                tablaProveedores.ajax.reload(null, false);
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

        if (tablaProveedores.row(this).child.isShown()) {
            var data = tablaProveedores.row(this).data();
        } else {
            var data = tablaProveedores.row($(this).parents("tr")).data();
        }

        let datos = new FormData();
        datos.append('desactivarProveedores', 'OK');
        datos.append('idProveedor', data['id_prov']);
        let peticion = await fetch('../Controllers/ProveedoresController.php', {
            method: 'POST',
            body: datos
        });

        let resjson = await peticion.json();

        if (resjson.respuesta == "OK") {
            tablaProveedores.ajax.reload(null, false);
        } else {
            notificarError(resjson.respuesta);
        }

    } catch (error) {
        console.log(error)
    }
})

$(document).on('click', '.activar', async function() {
    try {

        if (tablaProveedores.row(this).child.isShown()) {
            var data = tablaProveedores.row(this).data();
        } else {
            var data = tablaProveedores.row($(this).parents("tr")).data();
        }

        let datos = new FormData();
        datos.append('activarProveedores', 'OK');
        datos.append('idProveedor', data['id_prov']);
        let peticion = await fetch('../Controllers/ProveedoresController.php', {
            method: 'POST',
            body: datos
        });

        let resjson = await peticion.json();

        if (resjson.respuesta == "OK") {
            tablaProveedores.ajax.reload(null, false);
        } else {
            notificarError(resjson.respuesta);
        }

    } catch (error) {
        console.log(error)
    }
})

function notificacionExitosa(mensaje) {
    Swal.fire(
        mensaje,
        '',
        'success'
    ).then(result => {
        formaddProveedor.reset();
        $("#nuevo_proveedor").modal("hide");
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

/* Limpiar campos del formulario agregar Proveedor */
document.getElementById('altaProveedor').addEventListener('click', () => {
    formaddProveedor.reset();
})
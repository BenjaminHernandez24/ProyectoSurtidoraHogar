var tablaClientes;
var idClientes;
let datosClientes;
let peticion;
var resjson;
var data;

/* LLENAMOS LA TABLA CON CLIENTES */
async function init() {
    tablaClientes = $("#tblClientes").DataTable({
        "responsive": true,
        "autoWidth": false,
        "ajax": {
            "url": "../Controllers/ClienteController.php",
            "type": "POST",
            "data": {
                "getClientes": ""
            },
            "dataSrc": ""
        },
        "columns": [{
            "data": "id_cli"
        }, {
            "data": "nombre_cli"
        }, {
            "data": "tipo"
        }, {
            "data": "telefono"
        }, {
            "data": (s) => {
                if (s.Estatus == 1) {
                    return `<button class="btn btn-success btn-sm desactivar">Activo</button>`;
                } else {
                    return `<button class="btn btn-danger btn-sm activar">Inactivo</button>`;
                }
            }
        }, {
            "defaultContent": "<div class='text-center'><div class='btn-group'><button id='btnEditar' class='btn btn-info btn-sm btnEditar'><i class='fas fa-edit'></i></button><button id='btnBorrar' class='btn btn-danger btn-sm btnBorrar'><i class='fas fa-trash-alt'></i></button></div></div>"
        }]
    });
}

/* INICIALIZAMOS LA TABLA LLENA DE CLIENTES */
init();

/* DAR UN CLIENTE DE ALTA */
frmClientes.addEventListener('submit', async(e) => {
    e.preventDefault();
    try {
        datosClientes = new FormData(frmClientes);
        datosClientes.append('AgregarCliente', 'OK');
        peticion = await fetch('../Controllers/ClienteController.php', {
            method: 'POST',
            body: datosClientes
        });
        
        resjson = await peticion.json();
        console.log(resjson.respuesta);
        if (resjson.respuesta == "OK") {
            notificacionExitosa('Cliente Registrado', 'nuevo_cliente');
        } else if (resjson.respuesta == "existe") {
            notificarError('El Cliente ya ha sido registrado');
        } else if (resjson.respuesta == "caracteres"){
            notificarError('Se encontr?? un caracter desconocido');
        }else{
            notificarError('No se pudo registrar');
        }
        tablaClientes.ajax.reload(null, false);
    } catch (error) {
        notificarError(error);
    }
})

/* OBTENER ID CUANDO DA CLICK EN EDITAR */
$(document).on("click", ".btnEditar", function() {
    if (tablaClientes.row(this).child.isShown()) {
        data = tablaClientes.row(this).data();
    } else {
        data = tablaClientes.row($(this).parents("tr")).data();
    }
    console.log(tablaClientes.row($(this).parents("tr")));
    if (data[4] == 0) {
        notificarError('Por favor, active el estado del cliente para realizar esta acci??n');
    } else {
        /* Cargamos los datos obtenidos al modal editar */
        idClientes = data[0];
        $("#nombre").val(data[1]);
        $("#tipo").val(data[2]);
        $("#telefono").val(data[3]);
        /* Hacemos visible el modal */
        $('#modalEditarCliente').modal('show');
    }
});

/* OBTENEMOS FORMULARIO Y CREAMOS UN OBJETO */
formEditCliente.addEventListener('submit', async(e) => {
    e.preventDefault();
    try {
        datosClientes = new FormData(formEditCliente);
        datosClientes.append('editarCliente', 'OK');
        datosClientes.append('idCliente', idClientes);
        peticion = await fetch('../Controllers/ClienteController.php', {
            method: 'POST',
            body: datosClientes
        });

        resjson = await peticion.json();
        if (resjson.respuesta == "OK") {
            notificacionExitosa('Cliente Modificado', 'modalEditarCliente');
        } else if (resjson.respuesta == "existe") {
            notificarError('Ya existe un cliente con el mismo nombre');
        } else if (resjson.respuesta == "caracteres"){
            notificarError('Se encontr?? un caracter desconocido');
        }else {
            notificarError(resjson.respuesta);
        }
        tablaClientes.ajax.reload(null, false);
    } catch (error) {
        notificarError(error);
    }
})

/* OBTENER ID Y ELIMINAR */
$(document).on('click', ".btnBorrar", async function() {
    if (tablaClientes.row(this).child.isShown()) {
        data = tablaClientes.row(this).data();
    } else {
        data = tablaClientes.row($(this).parents("tr")).data();
    }
    idClientes = data[0];
    const result = await Swal.fire({
        title: '??EST?? SEGURO DE ELIMINAR ESTE CLIENTE?',
        text: "??La eliminaci??n es permanente!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#5bc0de',
        cancelButtonColor: '#d9534f',
        confirmButtonText: '??Estoy seguro!'
    });
    if (result.value) {
        try {
            datosClientes = new FormData();
            datosClientes.append('eliminarCliente', 'OK');
            datosClientes.append('idCliente', idClientes);
            peticion = await fetch('../Controllers/ClienteController.php', {
                method: 'POST',
                body: datosClientes
            });

            resjson = await peticion.json();
            if (resjson.respuesta == "OK") {
                notificacionExitosa('??Cliente eliminado correctamente!', 'nuevo_cliente');
            } else {
                notificarError(resjson.respuesta);
            }
            tablaClientes.ajax.reload(null, false);
        } catch (error) {
            notificarError(error);
        }
    }
})

$(document).on('click', ".activar", async function() {
    notificacionActivoCliente('Usted, ha cambiado el estado del cliente a: "Activo"');
    try {
        if (tablaClientes.row(this).child.isShown()) {
            data = tablaClientes.row(this).data();
        } else {
            data = tablaClientes.row($(this).parents("tr")).data();
        }
        datos = new FormData();
        datos.append('activarClientes', 'OK');
        datos.append('idCliente', data['id_cli']);
        peticion = await fetch('../Controllers/ClienteController.php', {
            method: 'POST',
            body: datos
        });
        resjson = await peticion.json();
        if (resjson.respuesta != "OK") {
            notificarError(resjson.respuesta);
        }
        tablaClientes.ajax.reload(null, false);
    } catch (error) {
        notificarError(error);
    }
})

$(document).on('click', ".desactivar", async function() {
    notificacionInactivoCliente('Usted, ha cambiado el estado del cliente a: "Inactivo"');
    try {
        if (tablaClientes.row(this).child.isShown()) {
            data = tablaClientes.row(this).data();
        } else {
            data = tablaClientes.row($(this).parents("tr")).data();
        }
        datos = new FormData();
        datos.append('desactivarClientes', 'OK');
        datos.append('idCliente', data['id_cli']);
        peticion = await fetch('../Controllers/ClienteController.php', {
            method: 'POST',
            body: datos
        });
        resjson = await peticion.json();
        if (resjson.respuesta != "OK") {
            notificarError(resjson.respuesta);
        }
        tablaClientes.ajax.reload(null, false);
    } catch (error) {
        notificarError(error);
    }
})

/********************* MENSAJES DE NOTIFICACI??N **************************/

function notificacionExitosa(mensaje, formulario) {
    Swal.fire(mensaje, '', 'success').then(result => {
        frmClientes.reset();
        $("#" + formulario).modal("hide");
    });
}

function notificacionActivoCliente(mensaje) {
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: mensaje,
        showConfirmButton: false,
        timer: 3000
    })
}

function notificacionInactivoCliente(mensaje) {
    Swal.fire({
        position: 'center',
        icon: 'warning',
        title: mensaje,
        showConfirmButton: false,
        timer: 3000
    })
}

function notificarError(mensaje) {
    Swal.fire({
        icon: 'error',
        title: 'Ops...',
        text: mensaje
    })
}

/* Limpiar campos del formulario agregar Proveedor */
document.getElementById('altaCliente').addEventListener('click', () => {
    frmClientes.reset();
})



//Requerimos imprimir los numeros pares que se encuentran
//compredidos entre el 1 y el 10
for(var i = 0; i < 10; i++){ // SENTENCIA 1
    if(i%2 == 0) //SENTENCIA 2
        console.log(i) //SENTENCIA 3
}
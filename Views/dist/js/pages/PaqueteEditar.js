
const form_editar_paquete = document.getElementById('frm_editar_paquete');

var tabla_paquete;
var id_paquete;

//---------- Función para llenar Tabla Paquetes. ---------//
async function tab_Productos() {
    tabla_paquete = $("#TablaPaquetes").DataTable({
        "responsive": true,
        "autoWidth": false,
        "ajax": {
            "url": "../Controllers/PaqueteController.php",
            "type": "POST",
            "data": {
                "obtener_paquete": "OK"
            },
           
            "dataSrc": ""
        },
        "columns": [
            {"data": "id_producto"},
            {"data": "nombre_producto"},
            {"data": "descripcion_tipo"},
            {"data": "descripcion_marca"},
            {"data": "precio_publico"},
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
                "defaultContent": "<div class='text-center'><div class='btn-group'><button id='btnEditar' class='btn btn-info btn-sm btnEditar'><i class='fas fa-edit'></i></button><button id='btnBorrar' class='btn btn-danger btn-sm btnBorrar'><i class='fas fa-trash-alt'></i></button></div></div>"
            }
        ]
    });
}
tab_Productos();

async function llenar_Tipo_Producto() {
    try {

        var datosProducto = new FormData();
        datosProducto.append('obtener_tipo_paquete', 'OK');

        var peticion = await fetch('../controllers/PaqueteController.php', {
            method: 'POST',
            body: datosProducto
        });

        var resjson = await peticion.json();

        var selectTipoProducto = document.getElementById('tipo_paquete');

        for (item of resjson) {
            let option_r = document.createElement('option');
            option_r.value = item.descripcion_tipo;
            option_r.text = item.descripcion_tipo;
            selectTipoProducto.appendChild(option_r);

        }

    } catch (error) {
        notificarError(error);
    }
}
llenar_Tipo_Producto();

//---------- FUNCION PARA LLENAR SELECT DE MARCA PAQUETE ---------//
async function llenar_Marca_Producto() {
    try {

        var datosProducto = new FormData();
        datosProducto.append('obtener_marca_paquete', 'OK');

        var peticion = await fetch('../controllers/PaqueteController.php', {
            method: 'POST',
            body: datosProducto
        });

        var resjson = await peticion.json();

        var selectMarcaProducto = document.getElementById('marca_paquete');

        for (item of resjson) {
            let optionM1 = document.createElement('option');
            optionM1.value = item.descripcion_marca;
            optionM1.text = item.descripcion_marca;
            selectMarcaProducto.appendChild(optionM1);
        }

    } catch (error) {
        notificarError(error);
    }
}
llenar_Marca_Producto();

//---- FUNCIÓN PARA BORRAR PAQUETE ----//
 $(document).on('click', ".btnBorrar", async function() {

    if (tabla_paquete.row(this).child.isShown()) {
        var data = tabla_paquete.row(this).data();
    } else {
        var data = tabla_paquete.row($(this).parents("tr")).data();
    }

    id_paquete = data[0];

    const result = await Swal.fire({
        title: '¿ESTÁ SEGURO(A) DE ELIMINAR ESTE PAQUETE?',
        text: "¡Afectará las Ventas y se eliminará en: Compras, Ventas, Productos e Inventario!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#5bc0de',
        cancelButtonColor: '#d9534f',
        confirmButtonText: '¡Estoy seguro(a)!'
    });
//------- Si el usuario está seguro de la eliminación se ejecuta función Eliminar paquete------//
    if (result.value) {
        try {

            var datosPaquete = new FormData();
            datosPaquete.append('eliminar_paquete', 'OK');
            datosPaquete.append('id_paquete', id_paquete);
 
            var peticion = await fetch('../Controllers/PaqueteController.php', {
                method: 'POST',
                body: datosPaquete
            });
 //---------- Esperamos la respuesta que obtiene nuestro controlador para hacer la consulta. ---------//
            var resjson = await peticion.json();
            if (resjson.respuesta == "OK") {
                notificacionExitosa('¡ELiminación exitosa!');
                tabla_paquete.ajax.reload(null, false);
            } else {
                notificarError(resjson.respuesta);
            }
        } catch (error) {
            notificarError(error);
        }
    }
});

//Activar el estatus del paquete
$(document).on('click', ".activar", async function() {
    WarningEstatus('Usted, ha cambiado el estado del paquete a: "Activo"','success');
    try {
        if (tabla_paquete.row(this).child.isShown()) {
            var data = tabla_paquete.row(this).data();
        } else {
            var data = tabla_paquete.row($(this).parents("tr")).data();
        }
        let datos = new FormData();
        datos.append('activarPaquete', 'OK');
        datos.append('idPaquete', data[0]);
        peticion = await fetch('../Controllers/PaqueteController.php', {
            method: 'POST',
            body: datos
        });
        resjson = await peticion.json();
        if (resjson.respuesta != "OK") {
            notificarError(resjson.respuesta);
        }
        tabla_paquete.ajax.reload(null, false);
    } catch (error) {
        notificarError(error);
    }
});

//Desactivar el estatus del paquete
$(document).on('click', ".desactivar", async function() {
    WarningEstatus('Usted, ha cambiado el estado del paquete a: "Inactivo"','warning');
    try {
        if (tabla_paquete.row(this).child.isShown()) {
            var data = tabla_paquete.row(this).data();
        } else {
            var data = tabla_paquete.row($(this).parents("tr")).data();
        }
        let datos = new FormData();
        datos.append('desactivarPaquete', 'OK');
        datos.append('idPaquete', data[0]);
        peticion = await fetch('../Controllers/PaqueteController.php', {
            method: 'POST',
            body: datos
        });
        resjson = await peticion.json();
        if (resjson.respuesta != "OK") {
            notificarError(resjson.respuesta);
        }
        tabla_paquete.ajax.reload(null, false);
    } catch (error) {
        notificarError(error);
    }
});

//------- EDITAR EL PAQUETE -------//
$(document).on('click', ".btnEditar", async function() {
    try {
        if (tabla_paquete.row(this).child.isShown()) {
            var data = tabla_paquete.row(this).data();
        } else {
            var data = tabla_paquete.row($(this).parents("tr")).data();
        }

        //En el modal mostramos los datos de la fila seleccionada.
        $("#nom_paquete").val(data[1]);
        document.querySelector("#tipo_paquete").value = data[2];
        document.querySelector("#marca_paquete").value = data[3];
        $("#subtotal").val(data[4]);
        $("#total").val(data[4]);
    }catch(error){
        notificarError(error);
    }
    $('#informacionPaquete').modal('show');
});



//------- MENSAJES MOSTRAR --------//
function WarningEstatus(mensaje,icono) {
    Swal.fire({
        position: 'center',
        icon: icono,
        title: mensaje,
        showConfirmButton: false,
        timer: 3000
    })
}
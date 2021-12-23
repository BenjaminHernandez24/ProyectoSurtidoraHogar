
const form_editar_paquete = document.getElementById('frm_editar_paquete');
const form_datos_paquete = document.getElementById('frmDatosPaqueteEditar');

var tabla_paquete;
var id_paquete;

//---------------BUSQUEDA DE AUTOCOMPLETADO DE LOS PRODUCTOS ----------------//
//Si encuentra el producto, llena el nombre del producto y el precio automáticamente//
$(document).ready(async function autocompletado() {
    try {
        var Productos = new FormData();
        Productos.append('obtenerProductos', 'OK');

        var peticion = await fetch('../Controllers/PaqueteController.php', {
            method: 'POST',
            body: Productos
        });

        var data = await peticion.json();

        $('#buscar').autocomplete({
            source: data,
            select: async function (event, item) {
                try {
                    var DatosProductos = new FormData();
                    DatosProductos.append('obtener_lista_productos', 'OK');
                    DatosProductos.append('valor', item.item.value);

                    var peticionDatos = await fetch('../Controllers/PaqueteController.php', {
                        method: 'POST',
                        body: DatosProductos
                    });

                    var datos = await peticionDatos.json();
                    $("#nombre_producto").val(datos.productos);
                    $("#precio").val(datos.precio);

                } catch (error) {
                    notificarError(error);
                }
            }
        });
    } catch (error) {
        notificarError(error);
    }
});

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
            { "data": "id_producto" },
            { "data": "nombre_producto" },
            { "data": "descripcion_tipo" },
            { "data": "descripcion_marca" },
            { "data": "precio_publico" },
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
$(document).on('click', ".btnBorrar", async function () {

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

//----------- ACTIVAR EL ESTATUS DEL PAQUETE -----------------//
$(document).on('click', ".activar", async function () {
    WarningEstatus('Usted, ha cambiado el estado del paquete a: "Activo"', 'success');
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

//----------- DESACTIVAR EL ESTATUS DEL PAQUETE -------------//
$(document).on('click', ".desactivar", async function () {
    WarningEstatus('Usted, ha cambiado el estado del paquete a: "Inactivo"', 'warning');
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
$(document).on('click', ".btnEditar", async function () {
    try {
        if (tabla_paquete.row(this).child.isShown()) {
            var data = tabla_paquete.row(this).data();
        } else {
            var data = tabla_paquete.row($(this).parents("tr")).data();
        }

        //Limpiamos nuestra tabla de editar paquetes desde un inicio
        $("#tablapqtEditar").DataTable().clear().draw();

        //En el modal mostramos los datos de la fila seleccionada.
        $("#nom_paquete").val(data[1]);
        document.querySelector("#tipo_paquete").value = data[2];
        document.querySelector("#marca_paquete").value = data[3];
        $("#subtotal").val(data[4]);
        $("#total").val(data[4]);

        //Extraemos los datos para formar la tablita automática.
        let crearTabla = new FormData();
        crearTabla.append("crearTabla", "OK");
        crearTabla.append("nombre_paquete", data[1]);

        var peticion = await fetch('../Controllers/PaqueteController.php', {
            method: 'POST',
            body: crearTabla
        });

        var respuesta =  await peticion.json();

        for (var i = 0; i < respuesta.length; i++) {
            //Obtengo el subtotal
            var subtotal = parseFloat(respuesta[i]["piezas"]) * parseFloat(respuesta[i]["precio"]);

            //Preparo mi tabla para descargar los datos de manera automática
            $('#tablapqtEditar').DataTable().destroy();
            $('#tablapqtEditar').find('tbody').append(`<tr id="">
                
            <td class="row-index">
                <p>${respuesta[i]["id_producto"]}</p>
                </td>
                <td class="row-index">
                <p>${respuesta[i]["nombre_producto"]}</p>
                </td>
                <td class="row-index">
                <p>${respuesta[i]["piezas"]}</p>
                </td>
                <td class="row-index">
                <p>${respuesta[i]["precio"]}</p>
                </td>
                <td class="row-index">
                <p>${subtotal}</p>
                </td>
                <td class="">
                <button class='btn btn-info btn-sm btnTablaEditar'><i class='fas fa-edit'></i></button><button class='btn btn-danger btn-sm btnTablaBorrar'><i class='fas fa-trash-alt'></i></button>
                </td>
                </tr>`);
            $('#tablapqtEditar').DataTable().draw();
        }

    } catch (error) {
        notificarError(error);
    }
    $('#informacionPaquete').modal('show');
});

//----------- FUNCION PARA AGREGAR UN PRODUCTO A LA TABLA --------------------//
form_datos_paquete.addEventListener('submit', async function (e) {
    e.preventDefault();
    let producto = document.getElementById('nombre_producto').value;
    let cantidad = parseFloat(document.getElementById('cantidad').value);
    let precio = parseFloat(document.getElementById('precio').value);
    let subtotal = precio * cantidad;
    var i = 0;
    try {
        try {
            //Obtener ID del producto seleccionado
            var obtenerID = new FormData();
            obtenerID.append('obtenerID', 'OK');
            obtenerID.append('nombre', producto);
            peticion = await fetch('../Controllers/PaqueteController.php', {
                method: 'POST',
                body: obtenerID
            });

            var respuesta = await peticion.json();

            if (respuesta == 0) {
                notificarError("Producto no existente");
            } else {
                
                $('#tablapqtEditar').DataTable().destroy();
                $('#tablapqtEditar').find('tbody').append(`<tr id="">
                
                    <td class="row-index">
                     <p>${respuesta}</p>
                     </td>
                     <td class="row-index">
                     <p>${producto}</p>
                     </td>
                     <td class="row-index">
                     <p>${cantidad}</p>
                     </td>
                     <td class="row-index">
                     <p>${precio}</p>
                     </td>
                     <td class="row-index">
                     <p>${subtotal}</p>
                     </td>
                     <td class="">
                     <button class='btn btn-info btn-sm btnTablaEditar'><i class='fas fa-edit'></i></button><button class='btn btn-danger btn-sm btnTablaBorrar'><i class='fas fa-trash-alt'></i></button>
                     </td>
                      </tr>`);
                $('#tablapqtEditar').DataTable().draw();

                if (document.getElementById('subtotal').value == "") {
                    $("#subtotal").val(subtotal.toFixed(2));
                    $("#total").val(subtotal.toFixed(2));
                } else {
                    let total = parseFloat(document.getElementById('subtotal').value);
                    let suma_total = total + subtotal;
                    $("#total").val(suma_total.toFixed(2));
                    $("#subtotal").val(suma_total.toFixed(2));
                }
            }
            limpiarCampos("limpiartodo");
        } catch (error) {
            notificarError("Ocurrio un Error");
        }
        //cierre de else (pintar tabla)
    } catch (error) {
        notificarError("No se ha podido agregar los productos");
    }
});

//---------------- FUNCION PARA  EDITAR LOS VALORES DEL PAQUETE-----------//
$('#tablapqtEditar').on("click", ".btnTablaEditar", async function () {
    fila_editar = this.parentNode.parentNode;

    //Obtenemos valores de la fila de la tablita a editar
    cantidad_editar = fila_editar.getElementsByTagName("td")[2].getElementsByTagName("P")[0].innerHTML;
    precio_editar = fila_editar.getElementsByTagName("td")[3].getElementsByTagName("P")[0].innerHTML;
    total_editar = fila_editar.getElementsByTagName("td")[4].getElementsByTagName("P")[0].innerHTML;
    valor_guardar = total_editar;

    //En el modal mostramos los datos de la fila seleccionada.
    $("#cantidadEditar").val(cantidad_editar);
    $("#total_editar").val(total_editar);

    $('#editar_cantidad_precio').modal('show');
});

//---------------- MODAL EDITAR CANTIDAD DE PRODUCTO A PAQUETE --------------//
form_editar_paquete.addEventListener('submit', async function (e) {
    e.preventDefault();

    //Obtenemos los valores de los campos del modal
    var cantidad = parseFloat(document.getElementById("cantidadEditar").value);
    var total_editar = parseFloat(document.getElementById("total_editar").value);

    //Añadimos los valores correspondiente, a la fila correspondiente
    fila_editar.getElementsByTagName("td")[2].getElementsByTagName("P")[0].innerHTML = cantidad;
    fila_editar.getElementsByTagName("td")[4].getElementsByTagName("P")[0].innerHTML = total_editar;

    //Obtenemos el subtotal que hay actualmente.
    var total = parseFloat(document.getElementById('subtotal').value);

    //Si la cantidad fué mayor se suma el resto de lo contrario el resto, se resta.
    if ((valor_guardar - total_editar) < 0) {
        total += (total_editar - valor_guardar);
    } else {
        total -= (valor_guardar - total_editar);
    }

    //Asignamos valores a subtotal y total
    $("#total").val(total.toFixed(2));
    $("#subtotal").val(total.toFixed(2));

    //Escondemos el modal
    $('#editar_cantidad_precio').modal('hide');
});

//-- FUNCIÓN PARA EDITAR EN TIEMPO REAL EL TOTAL DE ACUERDO A LA CANTIDAD QUE SE MODIFIQUE --//
document.getElementById('cantidadEditar').addEventListener('keyup', () => {
    var cantidad = document.getElementById("cantidadEditar").value;
    var subtotal_editar = cantidad * precio_editar;
    $("#total_editar").val(subtotal_editar);
});

//----------- FUNCION PARA ELIMINAR PRODUCTO DE LA LISTA DE PAQUETE ----------//
$('#tablapqtEditar').on('click', '.btnTablaBorrar', async function () {
    var a = this.parentNode.parentNode;
    var total = 0;

    //Obtener valores necesarios para restar del subtotal y total
    var cantidad = a.getElementsByTagName("td")[2].getElementsByTagName("P")[0].innerHTML;
    var precio = a.getElementsByTagName("td")[3].getElementsByTagName("P")[0].innerHTML;

    total = parseFloat(document.getElementById('subtotal').value);
    total = total - (cantidad * precio);
    $("#subtotal").val(total.toFixed(2));
    $("#total").val(total.toFixed(2));

    //Verificamos que la tablita no esté vacía
    var cont = $('#tablapqtEditar tr').length;
    var total_art = cont - 2;

    $('#tablapqtEditar').DataTable().destroy();
    $(this).closest('tr').remove();
    $('#tablapqtEditar').DataTable().draw();
});

//------- MENSAJES MOSTRAR --------//
function WarningEstatus(mensaje, icono) {
    Swal.fire({
        position: 'center',
        icon: icono,
        title: mensaje,
        showConfirmButton: false,
        timer: 3000
    })
}

function limpiarCampos(mensaje) {
    if (mensaje == 'limpiartodo') {
        //form_datos_paquete.reset();
        document.getElementById('precio').value = "";
        document.getElementById('cantidad').value = "";
        document.getElementById('buscar').value = "";
        document.getElementById('nombre_producto').value = "";
    }
}
/* VARIABLES PARA FORMULARIOS */
const formDatosProducto = document.getElementById('frmDatosProducto');
const formDatosVenta = document.getElementById('frmDatosVenta');
const formEditarDatosProducto = document.getElementById('frmEditarCantidad');

let timeout;

/* VARIABLES PARA LA PARTE DE CLIENTE */
var idCliente;
var tipo_cliente = "";
let datosClientes;
var tablaClientes;

/* VARIABLES PARA VENTAS */
var id_inventario;
var tablaDatosVentas;
var stock_inicial;
var stock_editar;
var cantidad_editar;
var fila_editar;

/* ===========================
    FUNCIONES PARA INICIALIZAR
 =============================*/

/* HACEMOS UNA FUNCION QUE CONTENDRA LA CREACION DE LA TABLA DE VENTA Y CLIENTE */
async function init() {
    tablaDatosVentas = $('#tblDetalleVenta').DataTable({
        "responsive": true,
        "autoWidth": false
    });

    tablaClientes = $("#tblClientes").DataTable({
        "responsive": true,
        "autoWidth": false,
        "ajax": {
            "url": "../Controllers/VentasController.php",
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
            "defaultContent": "<button class='btn btn-info btn-sm btnAgregar'>Agregar</button>"
        }]
    });
}

/* INICIALIZAMOS LA FUNCION*/
init();

/* ===========================
    FUNCIONES DE CLIENTES
 =============================*/

/* FUNCION PARA DAR DE ALTA UN CLIENTE*/
frmClientes.addEventListener('submit', async(e) => {
    e.preventDefault();
    try {
        datosClientes = new FormData(frmClientes);
        datosClientes.append('AgregarCliente', 'OK');
        peticion = await fetch('../Controllers/ClienteController.php', {
            method: 'POST',
            body: datosClientes
        });
        /* RECIBO RESPUESTA PARA PODER VALIDAR */
        resjson = await peticion.json();
        if (resjson.respuesta == "OK") {
            notificacionExitosa('Cliente Registrado', 'nuevo_cliente');
            tablaClientes.ajax.reload(null, false);
        } else if (resjson.respuesta == "existe") {
            notificarError('El Cliente ya ha sido registrado');
        } else {
            notificarError('No se pudo registrar');
        }
    } catch (error) {
        console.log(error);
    }
})

/* CUANDO SE PRESIONA EL BOTON AGREGAR CLIENTE EN LA TABLA DE CLIENTES*/
$(document).on("click", ".btnAgregar", function(e) {
    e.preventDefault();
    if (tablaClientes.row(this).child.isShown()) {
        data = tablaClientes.row(this).data();
    } else {
        data = tablaClientes.row($(this).parents("tr")).data();
    }

    /* Cargamos los datos obtenidos al modal editar */
    idCliente = data[0];
    tipo_cliente = data[2];

    let subtotal = parseFloat(document.getElementById('subtotal').value);
    let descuento_aplicado;
    let total;
    if (tipo_cliente == "Mayoreo") {
        let descuento_decimal = 12 / 100;
        descuento_aplicado = subtotal * descuento_decimal;
        total = subtotal - descuento_aplicado;
    } else if (tipo_cliente == "Tecnico") {
        let descuento_decimal = 8 / 100;
        descuento_aplicado = subtotal * descuento_decimal;
        total = subtotal - descuento_aplicado;
    } else {
        let descuento_decimal = 8 / 100;
        descuento_aplicado = subtotal * descuento_decimal;
        total = subtotal - descuento_aplicado;
    }
    document.getElementById('total').value = total;
    document.getElementById('descuento').disabled = true;
    document.getElementById('descuento').value = "";
    $("#nombre_cliente").val(data[1]);
    /* Hacemos visible el modal */
    $("#modalcliente").modal("hide");

});

/* ===========================
    FUNCIONES AUTOCOMPLETADO
 =============================*/

/* BUSQUEDA DE AUTOCOMPLETADO DE LOS PRODUCTOS */
$(document).ready(async function() {
    try {
        var Productos = new FormData();
        Productos.append('obtenerProductos', 'OK');

        var peticion = await fetch('../Controllers/VentasController.php', {
            method: 'POST',
            body: Productos
        });
        var data = await peticion.json();

        $('#buscar').autocomplete({
            source: data,

            select: async function(event, item) {
                var DatosProductos = new FormData();
                DatosProductos.append('obtenerDatosProductos', 'OK');
                DatosProductos.append('valor', item.item.value);

                var peticionDatos = await fetch('../Controllers/VentasController.php', {
                    method: 'POST',
                    body: DatosProductos
                });

                var datos = await peticionDatos.json();
                stock_inicial = datos.stock;
                id_inventario = datos.inventario;
                $("#nombre_producto").val(datos.productos);
                $("#stock").val(datos.stock);
                $("#precio").val(datos.precio);
                document.getElementById('precio').disabled = false;
                document.getElementById('cantidad').disabled = false;
            }
        });
    } catch (error) {
        console.log(error);
    }
});

/* ===========================
    FUNCIONES PARA LA TABLA DE LISTA VENTA
 =============================*/

/* LLENADO DE TABLA DATOS DE VENTA AL PRESIONAR EL BOTON DE AGREGAR */
formDatosProducto.addEventListener('submit', async function(e) {
    e.preventDefault();

    let producto = document.getElementById('nombre_producto').value;
    let cantidad = parseFloat(document.getElementById('cantidad').value);
    let precio = parseFloat(document.getElementById('precio').value);
    let total = precio * cantidad;

    try {
        var restarInventario = new FormData();
        restarInventario.append('restarInventario', 'OK');
        restarInventario.append('idInventario', id_inventario);
        restarInventario.append('cantidad', cantidad);

        var peticion = await fetch('../Controllers/VentasController.php', {
            method: 'POST',
            body: restarInventario
        });
    } catch (error) {
        console.log(error);
    }

    if (cantidad < 0 || precio < 0 || producto == "" || cantidad == "" || total == "") {
        Error("Error Datos Erroneos");
    } else {
        $('#tblDetalleVenta').DataTable().destroy();
        $('#tblDetalleVenta').find('tbody').append(`<tr id="">
            <td class="row-index">
             <p>${id_inventario}</p>
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
             <p>${total}</p>
             </td>
              <td class="">
              <button class='btn btn-info btn-sm btnEditar'><i class='fas fa-edit'></i></button><button class='btn btn-danger btn-sm btnBorrar'><i class='fas fa-trash-alt'></i></button>
                </td>
              </tr>`);
        $('#tblDetalleVenta').DataTable().draw();

        if (document.getElementById('subtotal').value == "") {
            $("#total").val(total);
            $("#subtotal").val(total);
            document.getElementById('buscar_cliente').disabled = false;
            document.getElementById('descuento').disabled = false;
            document.getElementById('cobro').disabled = false;
        } else {
            let subtotal = parseFloat(document.getElementById('subtotal').value);
            var suma_subtotal = total + subtotal;
            $("#subtotal").val(suma_subtotal);
            if (tipo_cliente == "") {
                $("#total").val(suma_subtotal);
            } else {
                let descuento_aplicado;
                let total;
                if (tipo_cliente == "Mayoreo") {
                    let descuento_decimal = 12 / 100;
                    descuento_aplicado = suma_subtotal * descuento_decimal;
                    total = suma_subtotal - descuento_aplicado;
                } else if (tipo_cliente == "Tecnico") {
                    let descuento_decimal = 8 / 100;
                    descuento_aplicado = suma_subtotal * descuento_decimal;
                    total = suma_subtotal - descuento_aplicado;
                } else {
                    let descuento_decimal = 8 / 100;
                    descuento_aplicado = suma_subtotal * descuento_decimal;
                    total = suma_subtotal - descuento_aplicado;
                }
                $("#total").val(total);
            }
        }
        limpiarCampos("limpiartodo");
    }
})

/* FUNCION PARA ELIMINAR LA FILA AL PRESIONAR EL BOTON EN LA TABLA DE DATOS DE VENTA */
$('#tbody').on('click', '.btnBorrar', async function() {
    var a = this.parentNode.parentNode;
    var ID_inventario = a.getElementsByTagName("td")[0].getElementsByTagName("P")[0].innerHTML;
    var producto = a.getElementsByTagName("td")[1].getElementsByTagName("P")[0].innerHTML;
    var cantidad = a.getElementsByTagName("td")[2].getElementsByTagName("P")[0].innerHTML;
    var precio = a.getElementsByTagName("td")[3].getElementsByTagName("P")[0].innerHTML;
    var total = a.getElementsByTagName("td")[4].getElementsByTagName("P")[0].innerHTML;

    //datos_tabla = [ID_inventario, producto, cantidad, precio, total];
    $('#tblDetalleVenta').DataTable().destroy();
    $(this).closest('tr').remove();
    $('#tblDetalleVenta').DataTable().draw();

    try {
        var sumarInventario = new FormData();
        sumarInventario.append('sumarInventario', 'OK');
        sumarInventario.append('idInventario', ID_inventario);
        sumarInventario.append('cantidad', cantidad);

        var peticion = await fetch('../Controllers/VentasController.php', {
            method: 'POST',
            body: sumarInventario
        });
    } catch (error) {
        console.log(error);
    }

    let subtotal = parseFloat(document.getElementById('subtotal').value);
    let resta_subtotal = subtotal - total;
    if (resta_subtotal == 0) {
        $("#subtotal").val("");
        $("#total").val("");
        document.getElementById('buscar_cliente').disabled = true;
        document.getElementById('descuento').disabled = true;
        document.getElementById('cobro').disabled = true;
        document.getElementById('cobro').value = "";
        document.getElementById('cambio').value = "";
        document.getElementById('descuento').value = "";
        document.getElementById('nombre_cliente').value = "";
    } else {
        $("#subtotal").val(resta_subtotal);
        if (tipo_cliente == "") {
            $("#total").val(resta_subtotal);
        } else {
            let descuento_aplicado;
            let total;
            if (tipo_cliente == "Mayoreo") {
                let descuento_decimal = 12 / 100;
                descuento_aplicado = resta_subtotal * descuento_decimal;
                total = resta_subtotal - descuento_aplicado;
            } else if (tipo_cliente == "Tecnico") {
                let descuento_decimal = 8 / 100;
                descuento_aplicado = resta_subtotal * descuento_decimal;
                total = resta_subtotal - descuento_aplicado;
            } else {
                let descuento_decimal = 8 / 100;
                descuento_aplicado = resta_subtotal * descuento_decimal;
                total = resta_subtotal - descuento_aplicado;
            }
            $("#total").val(total);
        }
    }
});

formEditarDatosProducto.addEventListener('submit', async function(e) {
    e.preventDefault();
    var ID_inventario = fila_editar.getElementsByTagName("td")[0].getElementsByTagName("P")[0].innerHTML;
    var cantidad = document.getElementById("cantidadEditar").value;
    var precio = fila_editar.getElementsByTagName("td")[3].getElementsByTagName("P")[0].innerHTML;
    var subtotal_actual = parseFloat(document.getElementById('subtotal').value);
    var total_editado;
    var nuevo_subtotal;
    total_editado = cantidad * precio;
    var cantidad_a_enviar;

    if (cantidad > cantidad_editar) {
        /*COMO SE AÑADE MAS, SE RESTA AL INVENTARIO*/
        cantidad_a_enviar = parseFloat(cantidad) - parseFloat(cantidad_editar);
        nuevo_subtotal = (cantidad_a_enviar * precio) + subtotal_actual;
        $("#subtotal").val(nuevo_subtotal);
        if (tipo_cliente == "") {
            $("#total").val(nuevo_subtotal);
        } else {
            let descuento_aplicado;
            let total;
            if (tipo_cliente == "Mayoreo") {
                let descuento_decimal = 12 / 100;
                descuento_aplicado = nuevo_subtotal * descuento_decimal;
                total = nuevo_subtotal - descuento_aplicado;
            } else if (tipo_cliente == "Tecnico") {
                let descuento_decimal = 8 / 100;
                descuento_aplicado = nuevo_subtotal * descuento_decimal;
                total = nuevo_subtotal - descuento_aplicado;
            } else {
                let descuento_decimal = 8 / 100;
                descuento_aplicado = nuevo_subtotal * descuento_decimal;
                total = nuevo_subtotal - descuento_aplicado;
            }
            $("#total").val(total);
        }
        try {
            var restarInventario = new FormData();
            restarInventario.append('restarInventario', 'OK');
            restarInventario.append('idInventario', ID_inventario);
            restarInventario.append('cantidad', cantidad_a_enviar);

            var peticion = await fetch('../Controllers/VentasController.php', {
                method: 'POST',
                body: restarInventario
            });
        } catch (error) {
            console.log(error);
        }

    } else if (cantidad < cantidad_editar) {
        /*COMO SE QUITA PRODUCTO, SE SUMA AL INVENTARIO*/
        cantidad_a_enviar = parseFloat(cantidad_editar) - parseFloat(cantidad);
        nuevo_subtotal = subtotal_actual - (cantidad_a_enviar * precio);
        $("#subtotal").val(nuevo_subtotal);
        if (tipo_cliente == "") {
            $("#total").val(nuevo_subtotal);
        } else {
            let descuento_aplicado;
            let total;
            if (tipo_cliente == "Mayoreo") {
                let descuento_decimal = 12 / 100;
                descuento_aplicado = nuevo_subtotal * descuento_decimal;
                total = nuevo_subtotal - descuento_aplicado;
            } else if (tipo_cliente == "Tecnico") {
                let descuento_decimal = 8 / 100;
                descuento_aplicado = nuevo_subtotal * descuento_decimal;
                total = nuevo_subtotal - descuento_aplicado;
            } else {
                let descuento_decimal = 8 / 100;
                descuento_aplicado = nuevo_subtotal * descuento_decimal;
                total = nuevo_subtotal - descuento_aplicado;
            }
            $("#total").val(total);
        }
        try {
            var sumarInventario = new FormData();
            sumarInventario.append('sumarInventario', 'OK');
            sumarInventario.append('idInventario', ID_inventario);
            sumarInventario.append('cantidad', cantidad_a_enviar);

            var peticion = await fetch('../Controllers/VentasController.php', {
                method: 'POST',
                body: sumarInventario
            });
        } catch (error) {
            console.log(error);
        }
    } else {
        console.log("es la misma cantidad");
    }

    fila_editar.getElementsByTagName("td")[2].getElementsByTagName("P")[0].innerHTML = cantidad;
    fila_editar.getElementsByTagName("td")[4].getElementsByTagName("P")[0].innerHTML = total_editado;
    $('#modalEditarCantidad').modal('hide');
})

$('#tbody').on("click", ".btnEditar", async function() {
    fila_editar = this.parentNode.parentNode;
    var ID_inventario = fila_editar.getElementsByTagName("td")[0].getElementsByTagName("P")[0].innerHTML;
    cantidad_editar = fila_editar.getElementsByTagName("td")[2].getElementsByTagName("P")[0].innerHTML;

    try {
        var ExtraerStock = new FormData();
        ExtraerStock.append('ExtraerStock', 'OK');
        ExtraerStock.append('idInventario', ID_inventario);

        var peticion = await fetch('../Controllers/VentasController.php', {
            method: 'POST',
            body: ExtraerStock
        });
        var datos = await peticion.json();
        stock_editar = datos[0]['STOCK'];
        $("#stockEditar").val(datos[0]['STOCK']);
        $("#cantidadEditar").val(cantidad_editar);
    } catch (error) {
        console.log(error);
    }


    /* Hacemos visible el modal */
    $('#modalEditarCantidad').modal('show');
});

/* ===========================
    FUNCIONES PARA LA CREACION DE VENTA
 =============================*/

/* FUNCION PARA ADJUNTAR TODO LOS DATOS PARA MANDAR A LA BD */
formDatosVenta.addEventListener('submit', async function(e) {
    e.preventDefault();
    /*Datos tabla*/
    var valorestabla = document.getElementById("tblDetalleVenta").getElementsByTagName("p");
    var filastabla = document.getElementById("tblDetalleVenta").getElementsByTagName('tr');
    var columnastabla = document.getElementById("tblDetalleVenta").getElementsByTagName('th');

    /*Datos para mandar a la Base de datos*/
    let listado_venta = new Array();
    let subtotal_venta = document.getElementById("subtotal").value;
    let total_venta = document.getElementById("total").value;
    let cliente_venta = document.getElementById("nombre_cliente").value;
    let metodo_pago_venta = document.getElementById("nuevoMetodoPago").value;
    let Descuento_venta = document.getElementById("descuento").value;
    let cobro_venta = document.getElementById("cobro").value;
    let cambio_venta = document.getElementById("cambio").value;

    if (valorestabla.length == 0 && subtotal_venta == "" && total_venta == "") {
        notificarError("Campos Erroneos");
    } else {

        if (metodo_pago_venta == "Efectivo") {
            if (cobro_venta == "" || cobro_venta <= 0 || Descuento_venta < 0) {
                notificarError("Campos Erroneos");
            } else {
                insertar_tablas(cliente_venta, metodo_pago_venta, total_venta, cobro_venta, cambio_venta, filastabla, columnastabla, valorestabla);
            }
        } else {
            /*ES OTRO TIPO DE PAGO, NO VALIDAMOS CAMPOS DE COBRO NI CAMBIO*/
            if (Descuento_venta < 0) {
                notificarError("Campos Erroneos");
            } else {
                console.log("entra aqui?");
                insertar_tablas(cliente_venta, metodo_pago_venta, total_venta, cobro_venta, cambio_venta, filastabla, columnastabla, valorestabla);
            }
        }
    }
})

/* FUNCION PARA INSERTAR LOS DATOS DE VENTA A LA BASE DE DATOS*/
async function insertar_tablas(cliente, pago, total, cobro, cambio, filastabla, columnastabla, valorestabla) {
    var lista = {};
    var k = 0;
    let detalle_salida_venta = new FormData();
    let peticion;
    let validar_tabla1, validar_tabla2;

    if (cliente == "") {
        cliente = "cliente";
    }
    /* PRIMERO INSERTAMOS A LA BASE DE DATO AGREGAR_DETALLE_SALIDA_VENTA */
    detalle_salida_venta.append('AgregarDetalleSalidaVenta', 'OK');
    detalle_salida_venta.append('cliente', cliente);
    detalle_salida_venta.append('pago', pago);
    detalle_salida_venta.append('total', total);

    if (pago == "Efectivo") {
        detalle_salida_venta.append('cobro', cobro);
        detalle_salida_venta.append('cambio', cambio);
        peticion = await fetch('../Controllers/VentasController.php', {
            method: 'POST',
            body: detalle_salida_venta
        });
    } else {
        detalle_salida_venta.append('cobro', '0');
        detalle_salida_venta.append('cambio', '0');
        peticion = await fetch('../Controllers/VentasController.php', {
            method: 'POST',
            body: detalle_salida_venta
        });
    }
    var resjson = await peticion.json();

    if (resjson.respuesta == "OK") {
        validar_tabla1 = "OK";
    } else {
        validar_tabla1 = "ERROR";
    }

    /* POSTERIORMENTE INSERTAMOS A LA TABLA DE AGREGAR_SALIDA_VENTA*/
    for (var i = 0; i < filastabla.length - 1; i++) {
        lista = {};
        for (var j = 0; j < columnastabla.length - 1; j++) {
            var valor_input = valorestabla[k].innerHTML;
            lista[j] = valor_input;
            k++;
        }
        lista = JSON.stringify(lista);
        var salida_venta = new FormData();
        salida_venta.append('AgregarSalidaVenta', 'OK');
        salida_venta.append('datos', lista);
        var peticion_salida_venta = await fetch('../Controllers/VentasController.php', {
            method: 'POST',
            body: salida_venta
        });

        var respuesta_json = await peticion_salida_venta.json();

        if (respuesta_json.respuesta == "OK") {
            validar_tabla2 = "OK"
        } else {
            validar_tabla2 = "ERROR";
        }
    }

    /* VALIDAMOS AMBAS INSERCIONES PARA SABER SI TODO ESTA CORRECTO */
    if (validar_tabla1 == "OK" && validar_tabla2 == "OK") {
        notificacionExitosa("Venta Exitosa");
        limpiarCampos("limpiarventa");
    } else {
        notificarError("No Se Pudo Realizar la Venta");
    }
}

/* ===========================
    FUNCIONES PARA MODALS
 =============================*/

/* FUNCION PARA ABRIR EL MODAL DE AGREGAR NUEVO CLIENTE */
document.getElementById('nuevo_cliente').addEventListener('click', () => {
    $("#modalnuevocliente").modal("show");
    frmClientes.reset();
})

/* FUNCION PARA ABRIR EL MODAL DE LA TABLA DE CLIENTES */
document.getElementById('buscar_cliente').addEventListener('click', () => {
    $("#modalcliente").modal("show");
})

/* ===========================
    FUNCIONES PARA VALIDACIONES
 =============================*/

/* FUNCION PARA ELEGIR OPCION EN EL COMBO DE PAGO */
document.getElementById('nuevoMetodoPago').addEventListener('change', () => {
    var valor = document.getElementById("nuevoMetodoPago").value;
    if (valor == "Efectivo") {
        document.getElementById('cobro').value = "";
        document.getElementById('cambio').value = "";
        $("#fila_cobro").slideDown();
    } else {
        $("#fila_cobro").slideUp();
    }
})

/* FUNCION PARA BORRAR DATOS CUANDO NO SE ESTE ESCRIBIBIENDO EN EL INPUT DE BUSCAR PRODUCTO */
document.getElementById('buscar').addEventListener('keyup', () => {

    if (document.getElementById('buscar').value == "") {
        limpiarCampos("limpiartodo");
    }
})

/* FUNCION PARA IR VALIDANDO EL PRECIOS SEA MAYOR A UN NUMERO NEGATIVO*/
document.getElementById('precio').addEventListener('keyup', () => {
    if (!document.getElementById('precio').value == "") {
        let precio = parseFloat(document.getElementById('precio').value);
        if (precio < 0) {
            Error("No Puede Ingresar Números Negativos");
        }
    } else {
        //document.getElementById('precio').value = stock_inicial;
    }
})

/* FUNCION PARA IR VALIDANDO EL COBRO SEA MAYOR A UN NUMERO NEGATIVO*/
document.getElementById('cobro').addEventListener('keydown', () => {
    clearTimeout(timeout)
    timeout = setTimeout(() => {
        if (!document.getElementById('cobro').value == "") {
            let cobro = parseFloat(document.getElementById('cobro').value);
            let total = parseFloat(document.getElementById('total').value);
            if (cobro < 0) {
                Error("No Puede Ingresar Números Negativos");
            } else {
                if (cobro < total) {
                    Error("Error");
                } else {
                    let cambio = cobro - total;
                    document.getElementById('cambio').value = cambio;
                }
            }
        } else {
            document.getElementById('cambio').value = "";
        }
        clearTimeout(timeout)
    }, 1000)
})

/* FUNCION PARA IR RESTANDO EL STOCK MIENTRAS SE ESCRIBE*/
document.getElementById('cantidad').addEventListener('keyup', () => {
    if (!document.getElementById('cantidad').value == "") {
        let cantidad = parseFloat(document.getElementById('cantidad').value);
        if (cantidad > stock_inicial) {
            Error("Cantidad Ingresada Mayor al Stock");
        } else {
            if (cantidad >= 0) {
                var resta_stock = stock_inicial - cantidad;
                document.getElementById('stock').value = resta_stock;
            } else {
                Error("No Puede Ingresar Números Negativos");
            }

        }
    } else {
        document.getElementById('stock').value = stock_inicial;
    }
})

/* FUNCION PARA IR RESTANDO EL STOCK MIENTRAS SE ESCRIBE*/
document.getElementById('cantidadEditar').addEventListener('keyup', () => {
    if (!document.getElementById('cantidadEditar').value == "") {
        let cantidad = parseFloat(document.getElementById('cantidadEditar').value);
        if (cantidad > stock_editar) {
            Error("Cantidad Ingresada Mayor al Stock");
        } else {
            if (cantidad > 0) {
                var resta = stock_editar - cantidad
                var resta_stock = resta + parseFloat(cantidad_editar);
                document.getElementById('stockEditar').value = resta_stock;
            } else {
                Error("Error, Ingrese otra cantidad");
            }

        }
    } else {
        document.getElementById('stockEditar').value = stock_editar;
    }
})

/* FUNCION PARA IR APLICANDO DESCUENTO AL TOTAL DE LA VENTA*/
document.getElementById('descuento').addEventListener('keyup', () => {
    if (!document.getElementById('descuento').value == "") {
        let descuento = parseFloat(document.getElementById('descuento').value);
        let subtotal = parseFloat(document.getElementById('subtotal').value);
        if (descuento < 0) {
            Error("No Puede Ingresar Números Negativos");
        } else {
            if (!subtotal == "") {
                let descuento_decimal = descuento / 100;
                let descuento_aplicado = subtotal * descuento_decimal;
                let total = subtotal - descuento_aplicado;
                document.getElementById('total').value = total;
            }
        }
    } else {
        document.getElementById('total').value = document.getElementById('subtotal').value;
    }
})

/* ===========================
    FUNCIONES PARA NOTIFICACIONES ERROR/SUCCESS/WARNING
 =============================*/

function notificacionExitosa(mensaje) {
    Swal.fire(mensaje, '', 'success').then(result => {
        frmClientes.reset();
        $("#modalnuevocliente").modal("hide");
    });
}

function notificarError(mensaje) {
    Swal.fire({
        icon: 'error',
        title: 'Ops...',
        text: mensaje
    })
}

/* FUNCION DE MENSAJE DE ERROR*/
function Error(mensaje) {
    Swal.fire({
        position: 'center',
        icon: 'warning',
        title: mensaje,
        showConfirmButton: false,
        timer: 3000
    })
}
/* FUNCION PARA LIMPIAR CAMPOS EN EL FORMULARIO */
function limpiarCampos(mensaje) {
    if (mensaje == 'limpiartodo') {
        formDatosProducto.reset();
        document.getElementById('precio').disabled = true;
        document.getElementById('cantidad').disabled = true;
    }
    if (mensaje == "limpiarventa") {
        document.getElementById('cobro').value = "";
        document.getElementById('cambio').value = "";
        document.getElementById('descuento').value = "";
        document.getElementById('subtotal').value = "";
        document.getElementById('total').value = "";
        document.getElementById('nombre_cliente').value = "";

        document.getElementById('buscar_cliente').disabled = true;
        document.getElementById('cobro').disabled = true;
        document.getElementById('descuento').disabled = true;

        $("#tblDetalleVenta").DataTable().clear().draw();
        $("#tblDetalleVenta").DataTable().destroy();
        $('#tblDetalleVenta').DataTable().draw();
    }
}
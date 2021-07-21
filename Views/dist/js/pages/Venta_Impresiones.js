const formDatosVenta = document.getElementById('frmDatosVenta');

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
    let subtotal_venta = document.getElementById("subtotal").value;
    let total_venta = document.getElementById("total").value;
    let cliente_venta = document.getElementById("nombre_cliente").value;
    let metodo_pago_venta = document.getElementById("nuevoMetodoPago").value;
    let impresion = document.getElementById("generar").value;
    let cobro_venta = document.getElementById("cobro").value;
    let cambio_venta = document.getElementById("cambio").value;

    if (valorestabla.length == 0 && subtotal_venta == "" && total_venta == "") {
        notificarError("Campos Erroneos");
    } else {

        if (metodo_pago_venta == "Efectivo") {
            if (cobro_venta == "" || cobro_venta <= 0) {
                notificarError("Campos Erroneos");
            } else {
                insertar_tablas(cliente_venta, metodo_pago_venta, total_venta, cobro_venta, cambio_venta, filastabla, columnastabla, valorestabla, impresion);
            }
        } else {
            /*ES OTRO TIPO DE PAGO, NO VALIDAMOS CAMPOS DE COBRO NI CAMBIO*/
            insertar_tablas(cliente_venta, metodo_pago_venta, total_venta, cobro_venta, cambio_venta, filastabla, columnastabla, valorestabla, impresion);
        }
    }
})

/* FUNCION PARA INSERTAR LOS DATOS DE VENTA A LA BASE DE DATOS*/
async function insertar_tablas(cliente, pago, total, cobro, cambio, filastabla, columnastabla, valorestabla, impresion) {
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
    detalle_salida_venta.append('impresion', impresion);

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
    validar_impresion(validar_tabla1, validar_tabla2, impresion);
}

function validar_impresion(validar_tabla1, validar_tabla2, impresion) {
    if (validar_tabla1 == "OK" && validar_tabla2 == "OK") {
        if (impresion == "Ticket" || impresion == "Ambos") {
            //ACA VA LA FUTURA FUNCION PARA IMPRIMIR EL TICKET
            notificacionExitosa("Venta Exitosa \n Recoja su Ticket");
        } else if (impresion == "Factura" || impresion == "Ninguno") {
            notificacionExitosa("Venta Exitosa");
        }
        limpiarCampos("limpiarventa");
    } else {
        notificarError("No Se Pudo Realizar la Venta");
    }
}
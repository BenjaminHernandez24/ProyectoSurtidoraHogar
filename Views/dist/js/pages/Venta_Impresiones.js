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
    let cobro_venta = parseFloat(document.getElementById("cobro").value);
    let cambio_venta = document.getElementById("cambio").value;
    if (valorestabla.length == 0 && subtotal_venta == "" && total_venta == "") {
        notificarError("Campos Erroneos");
    } else {
        if (metodo_pago_venta == "Efectivo") {
            if (document.getElementById("cobro").value == "" || cobro_venta <= 0 || cobro_venta < total_venta) {
                notificarError("Campos Erroneos");
            } else {
                insertar_tablas(cliente_venta, metodo_pago_venta, total_venta, cobro_venta, cambio_venta, filastabla, columnastabla, valorestabla, impresion, subtotal_venta);
            }
        } else {
            /*ES OTRO TIPO DE PAGO, NO VALIDAMOS CAMPOS DE COBRO NI CAMBIO*/
            insertar_tablas(cliente_venta, metodo_pago_venta, total_venta, cobro_venta, cambio_venta, filastabla, columnastabla, valorestabla, impresion, subtotal_venta);
        }
    }
})
/* FUNCION PARA INSERTAR LOS DATOS DE VENTA A LA BASE DE DATOS*/
async function insertar_tablas(cliente, pago, total, cobro, cambio, filastabla, columnastabla, valorestabla, impresion, subtotal_venta) {
    var lista = {};
    var lista1 = new Array();
    var lista2 = new Array();
    var k = 0;
    let detalle_salida_venta = new FormData();
    let peticion;
    if (cliente == "") {
        cliente = "cliente";
    }
    /* POSTERIORMENTE GUARDAMOS EN UNA LISTA DE ARREGLOS LOS PRODUCTOS AGREGADOS A LA VENTA*/
    for (var i = 0; i < filastabla.length - 1; i++) {
        lista = {};
        for (var j = 0; j < columnastabla.length - 1; j++) {
            var valor_input = valorestabla[k].innerHTML;
            lista[j] = valor_input;
            k++;
        }
        lista1[i] = {
            "Inventario": lista[0],
            "Producto": lista[1],
            "Cantidad": lista[2],
            "Precio": lista[3],
            "Total": lista[4]
        };
    }
    lista2 = JSON.stringify(lista1);
    /* MANDAMOS A LA BASE DE DATO TODO LOS DATOS QUE INSERTARAREMOS EN AMBAS TABLAS DE VENTAS*/
    detalle_salida_venta.append('AgregarDetalleSalidaVenta', 'OK');
    detalle_salida_venta.append('cliente', cliente);
    detalle_salida_venta.append('pago', pago);
    detalle_salida_venta.append('total', total);
    detalle_salida_venta.append('impresion', impresion);
    detalle_salida_venta.append('datos', lista2);
    detalle_salida_venta.append('subtotal', subtotal_venta);
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
        if (impresion == "Ticket" || impresion == "Ambos") {
            const result = await Swal.fire({
                title: 'Venta Exitosa \n ¿DESEA GENERAR UN TICKET?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#5bc0de',
                cancelButtonColor: '#d9534f',
                confirmButtonText: '¡Estoy seguro!'
            });
            if (result.value) {
                let datos_imprimir = new FormData();
                datos_imprimir.append('GenerarTicket', 'OK');
                datos_imprimir.append('pago', pago);
                datos_imprimir.append('total', total);
                datos_imprimir.append('datos', lista2);
                datos_imprimir.append('folio',resjson.folio);
                if (pago == "Efectivo") {
                    datos_imprimir.append('cobro', cobro);
                    datos_imprimir.append('cambio', cambio);
                    peticion = await fetch('../Controllers/VentasController.php', {
                        method: 'POST',
                        body: datos_imprimir
                    });
                } else {
                    datos_imprimir.append('cobro', '0');
                    datos_imprimir.append('cambio', '0');
                    peticion = await fetch('../Controllers/VentasController.php', {
                        method: 'POST',
                        body: datos_imprimir
                    });
                }
            }
        } else if (impresion == "Factura" || impresion == "Ninguno") {
            notificacionExitosa("Venta Exitosa");
        }
        limpiarCampos("limpiarventa");
    } else {
        notificarError("No Se Pudo Realizar la Venta");
    }
}
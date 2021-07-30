var tablaVentas;

/* HACEMOS UNA FUNCION QUE CONTENDRA LA CREACION DE LA TABLA DE VENTA DEL DIA*/
async function init() {
    tablaVentas = $("#tblImpresion").DataTable({
        "responsive": true,
        "autoWidth": false,
        "ajax": {
            "url": "../Controllers/EstadisticaController.php",
            "type": "POST",
            "data": {
                "getVentas": ""
            },
            "dataSrc": ""
        },
        "columns": [{
            "data": "id_detalle_salida_venta"
        }, {
            "data": "cliente"
        }, {
            "data": "metodo_pago"
        }, {
            "data": "total"
        }, {
            "data": "hora"
        }, {
            "defaultContent": `<button class="btn btn-primary btn-sm ticket">Ticket</button>`
        }, {
            "defaultContent": `<button class="btn btn-primary btn-sm factura">Factura</button>`
        }, {
            "defaultContent": `<button class="btn btn-primary btn-sm ambos">Ticket/Factura</button>`
        }]
    });
}

/* INICIALIZAMOS LA FUNCION*/
init();

/* FUNCION PARA GENERAR UN TICKET DE VENTA */
$(document).on('click', '.ticket', async function() {
    if (tablaVentas.row(this).child.isShown()) {
        var data = tablaVentas.row(this).data();
    } else {
        var data = tablaVentas.row($(this).parents("tr")).data();
    }

    const result = await Swal.fire({
        title: '¿DESEA GENERAR UN TICKET?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#5bc0de',
        cancelButtonColor: '#d9534f',
        confirmButtonText: '¡Estoy seguro!'
    });

    if (result.value) {
        try {

            var impresion = new FormData();
            impresion.append('obtenerimpresion', 'OK');
            impresion.append('idVenta', data[0]);
            impresion.append('estatus', "Ticket");

            var peticion = await fetch('../Controllers/ImpresionController.php', {
                method: 'POST',
                body: impresion
            });

            var resjson = await peticion.json();

            if (resjson == "Ticket" || resjson == "Ambos") {
                notificacionExitosa('¡Ticket Generado Correctamente!');
            } else {
                var Cambiarimpresion = new FormData();
                Cambiarimpresion.append('cambiarimpresion', 'OK');
                Cambiarimpresion.append('idVenta', data[0]);

                /*POR AQUI GENERARE EL TICKET*/
                if (resjson == "Factura") {
                    //cambiare a ambos porque ya tiene factura y ahora tendra tambien ticket
                    Cambiarimpresion.append('estatus', "Factura");
                    Cambiarimpresion.append('impresiones', 'Ambos');
                } else if (resjson == "Ninguno") {
                    //cambiare a ticket porque se generada ticket
                    Cambiarimpresion.append('estatus', "Ticket");
                    Cambiarimpresion.append('impresiones', 'Ticket');
                }

                var peticiones = await fetch('../Controllers/ImpresionController.php', {
                    method: 'POST',
                    body: Cambiarimpresion
                });
                var res = await peticiones.json();

                if (res.respuesta == "OK") {
                    notificacionExitosa('¡Ticket Generado Correctamente!');
                } else {
                    notificarError(res.respuesta);
                }
            }
        } catch (error) {
            notificarError(error);
        }
    }
})

/* FUNCION PARA INDICAR UNA FACTURA */
$(document).on('click', '.factura', async function() {
    if (tablaVentas.row(this).child.isShown()) {
        var data = tablaVentas.row(this).data();
    } else {
        var data = tablaVentas.row($(this).parents("tr")).data();
    }

    const result = await Swal.fire({
        title: '¿DESEA GENERAR UNA FACTURA?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#5bc0de',
        cancelButtonColor: '#d9534f',
        confirmButtonText: '¡Estoy seguro!'
    });

    if (result.value) {
        try {

            var impresion = new FormData();
            impresion.append('obtenerimpresion', 'OK');
            impresion.append('idVenta', data[0]);
            impresion.append('estatus', "Factura");
            var peticion = await fetch('../Controllers/ImpresionController.php', {
                method: 'POST',
                body: impresion
            });

            var resjson = await peticion.json();

            if (resjson == "Factura" || resjson == "Ambos") {
                notificacionExitosa('¡Factura Generado Correctamente!');
            } else {
                var Cambiarimpresion = new FormData();
                Cambiarimpresion.append('cambiarimpresion', 'OK');
                Cambiarimpresion.append('idVenta', data[0]);

                /*POR AQUI GENERARE EL TICKET*/
                if (resjson == "Ticket") {
                    Cambiarimpresion.append('estatus', "Factura");
                    //cambiare a ambos porque ya tiene ticket y ahora tendra tambien factura
                    Cambiarimpresion.append('impresiones', 'Ambos');
                } else if (resjson == "Ninguno") {
                    Cambiarimpresion.append('estatus', "Factura");
                    //cambiare a factura porque se generada factura
                    Cambiarimpresion.append('impresiones', 'Factura');
                }

                var peticiones = await fetch('../Controllers/ImpresionController.php', {
                    method: 'POST',
                    body: Cambiarimpresion
                });
                var res = await peticiones.json();

                if (res.respuesta == "OK") {
                    notificacionExitosa('¡Factura Generado Correctamente!');
                } else {
                    notificarError(res.respuesta);
                }
            }
        } catch (error) {
            notificarError(error);
        }
    }
})

/* FUNCION PARA INDICAR QUE SE DESEA UN TICKET Y UNA FACTURA */
$(document).on('click', '.ambos', async function() {
    if (tablaVentas.row(this).child.isShown()) {
        var data = tablaVentas.row(this).data();
    } else {
        var data = tablaVentas.row($(this).parents("tr")).data();
    }

    const result = await Swal.fire({
        title: '¿DESEA GENERAR UN TICKET Y UNA FACTURA?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#5bc0de',
        cancelButtonColor: '#d9534f',
        confirmButtonText: '¡Estoy seguro!'
    });

    if (result.value) {
        try {
            var Cambiarimpresion = new FormData();
            Cambiarimpresion.append('cambiarimpresion', 'OK');
            Cambiarimpresion.append('idVenta', data[0]);
            Cambiarimpresion.append('impresiones', 'Ambos');
            Cambiarimpresion.append('estatus', "Ambos");

            var peticiones = await fetch('../Controllers/ImpresionController.php', {
                method: 'POST',
                body: Cambiarimpresion
            });
            var res = await peticiones.json();

            if (res.respuesta == "OK") {
                notificacionExitosa('¡Ticket y Factura Generado Correctamente!');
            } else {
                notificarError(res.respuesta);
            }
        } catch (error) {
            notificarError(error);
        }
    }
})

/* FUNCION PARA ABRIR EL MODAL DE LA TABLA DE CLIENTES */
document.getElementById('boton_factura').addEventListener('click', (e) => {
    e.preventDefault();
    tablaVentas.ajax.reload(null, false);
    $("#ModalVentasTicket").modal("show");
})


function notificacionExitosa(mensaje) {
    Swal.fire(mensaje, '', 'success').then(result => {
        $("#ModalVentasTicket").modal("hide");
    });
}

function notificarError(mensaje) {
    Swal.fire({
        icon: 'error',
        title: 'Ops...',
        text: mensaje
    })
}
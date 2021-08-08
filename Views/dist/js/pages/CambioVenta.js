/* ===========================
    FUNCIONES DE AUTOCOMPLETADO
 =============================*/
var data_cambio;
/* BUSQUEDA DE AUTOCOMPLETADO DE LOS PRODUCTOS */
$(document).ready(async function autocompletado() {
    try {
        var Productos = new FormData();
        Productos.append('obtenerProductos', 'OK');

        var peticion = await fetch('../Controllers/VentasController.php', {
            method: 'POST',
            body: Productos
        });

        var data_cambio = await peticion.json();
        $('#buscar_devuelve').autocomplete({

            source: data_cambio,

            select: async function(event, item) {
                try {

                    var datosProductos = {
                        'obtenerDatosProductos': 'OK',
                        'valor': item.item.value
                    };

                    $.ajax({
                        url: "../Controllers/VentasController.php",
                        method: "POST",
                        data: datosProductos,
                        dataType: "json",

                        success: function(data) {
                            if (data.stock == 0) {
                                notificarError("El Producto No Tiene Stock");
                                $("#buscar_devuelve").val("");
                            } else {
                                $('#productos_devuelve').DataTable().destroy();
                                $('#productos_devuelve').find('tbody').append(`<tr id="">
                                <td class="row-index">
                                 <p>${data.inventario}</p>
                                 </td>
                                 <td class="row-index">
                                 <p>${data.productos}</p>
                                 </td>
                                 <td class="row-index">
                                 <p>1</p>
                                 </td>
                                 <td class="row-index">
                                 <p>${data.precio}</p>
                                 </td>
                                  <td class="">
                                  <button class='btn btn-danger btn-sm btnBorrar'><i class='fas fa-trash-alt'></i></button>
                                    </td>
                                  </tr>`);
                                $('#productos_devuelve').DataTable().draw();

                                if (document.getElementById('total_devuelve').value == "") {
                                    $("#total_devuelve").val(data.precio);
                                } else {
                                    let suma_productos_devuelve = parseFloat(document.getElementById('total_devuelve').value) + parseFloat(data.precio);
                                    $("#total_devuelve").val(suma_productos_devuelve);
                                }

                                if (!document.getElementById('total_cambia').value == "") {
                                    let valor_total_devuelve = parseFloat(document.getElementById('total_devuelve').value);
                                    let valor_total_cambia = parseFloat(document.getElementById('total_cambia').value);
                                    let resta_valores = valor_total_devuelve - valor_total_cambia;
                                    if (resta_valores < 0) {
                                        $("#diferencia_cobro").val(Math.abs(resta_valores));
                                    }
                                }
                                $("#buscar_devuelve").val("");
                            }
                        }
                    });
                } catch (error) {
                    notificarError(error);
                }
            }
        });

        $('#buscar_cambia').autocomplete({

            source: data_cambio,

            select: async function(event, item) {
                try {

                    var datosProductos = {
                        'obtenerDatosProductos': 'OK',
                        'valor': item.item.value
                    };

                    $.ajax({
                        url: "../Controllers/VentasController.php",
                        method: "POST",
                        data: datosProductos,
                        dataType: "json",

                        success: function(data) {
                            if (data.stock == 0) {
                                notificarError("El Producto No Tiene Stock");
                                $("#buscar_cambia").val("");
                            } else {
                                $('#productos_cambia').DataTable().destroy();
                                $('#productos_cambia').find('tbody').append(`<tr id="">
                            <td class="row-index">
                             <p>${data.inventario}</p>
                             </td>
                             <td class="row-index">
                             <p>${data.productos}</p>
                             </td>
                             <td class="row-index">
                             <p>1</p>
                             </td>
                             <td class="row-index">
                             <p>${data.precio}</p>
                             </td>
                              <td class="">
                              <button class='btn btn-danger btn-sm btnBorrar'><i class='fas fa-trash-alt'></i></button>
                                </td>
                              </tr>`);
                                $('#productos_cambia').DataTable().draw();

                                if (document.getElementById('total_cambia').value == "") {
                                    $("#total_cambia").val(data.precio);
                                } else {
                                    let suma_productos_cambia = parseFloat(document.getElementById('total_cambia').value) + parseFloat(data.precio);
                                    $("#total_cambia").val(suma_productos_cambia);
                                }

                                if (!document.getElementById('total_devuelve').value == "") {
                                    let valor_total_devuelve = parseFloat(document.getElementById('total_devuelve').value);
                                    let valor_total_cambia = parseFloat(document.getElementById('total_cambia').value);
                                    let resta_valores = valor_total_devuelve - valor_total_cambia;
                                    if (resta_valores < 0) {
                                        $("#diferencia_cobro").val(Math.abs(resta_valores));
                                    }
                                }

                                $("#buscar_cambia").val("");
                            }
                        }
                    });
                } catch (error) {
                    notificarError(error);
                }
            }
        });

    } catch (error) {
        notificarError(error);
    }
});

/* FUNCION PARA ELIMINAR LA FILA AL PRESIONAR EL BOTON EN LA TABLA DE PRODUCTOS QUE DEVUELVE*/
$('#tbody_devuelve').on('click', '.btnBorrar', async function() {
    var a = this.parentNode.parentNode;
    var precio = a.getElementsByTagName("td")[3].getElementsByTagName("P")[0].innerHTML;

    let resta_productos_devuelve = parseFloat(document.getElementById('total_devuelve').value) - parseFloat(precio);
    if (resta_productos_devuelve > 0) {
        $("#total_devuelve").val(resta_productos_devuelve);
    } else {
        $("#total_devuelve").val("");
    }

    let valor_total_devuelve = parseFloat(document.getElementById('total_devuelve').value);
    let valor_total_cambia = parseFloat(document.getElementById('total_cambia').value);
    let resta_valores = valor_total_devuelve - valor_total_cambia;
    if (resta_valores < 0) {
        $("#diferencia_cobro").val(Math.abs(resta_valores));
    } else {
        $("#diferencia_cobro").val("");
    }

    //datos_tabla = [ID_inventario, producto, cantidad, precio, total];
    $('#productos_devuelve').DataTable().destroy();
    $(this).closest('tr').remove();
    $('#productos_devuelve').DataTable().draw();

})

/* FUNCION PARA ELIMINAR LA FILA AL PRESIONAR EL BOTON EN LA TABLA DE PRODUCTOS QUE CAMBIA*/
$('#tbody_cambia').on('click', '.btnBorrar', async function() {
    var a = this.parentNode.parentNode;
    var precio = a.getElementsByTagName("td")[3].getElementsByTagName("P")[0].innerHTML;

    let resta_productos_cambia = parseFloat(document.getElementById('total_cambia').value) - parseFloat(precio);
    if (resta_productos_cambia > 0) {
        $("#total_cambia").val(resta_productos_cambia);
    } else {
        $("#total_cambia").val("");
    }

    let valor_total_devuelve = parseFloat(document.getElementById('total_devuelve').value);
    let valor_total_cambia = parseFloat(document.getElementById('total_cambia').value);
    let resta_valores = valor_total_devuelve - valor_total_cambia;
    if (resta_valores < 0) {
        $("#diferencia_cobro").val(Math.abs(resta_valores));
    } else {
        $("#diferencia_cobro").val("");
    }


    //datos_tabla = [ID_inventario, producto, cantidad, precio, total];
    $('#productos_cambia').DataTable().destroy();
    $(this).closest('tr').remove();
    $('#productos_cambia').DataTable().draw();

})

function notificarError(mensaje) {
    Swal.fire({
        icon: 'error',
        title: 'Ops...',
        text: mensaje
    })
}

$("#CambiosVentas").click(function() {
    var valorestabla_devuelve = document.getElementById("productos_devuelve").getElementsByTagName("p");
    var filastabla_devuelve = document.getElementById("productos_devuelve").getElementsByTagName('tr');
    var columnastabla_devuelve = document.getElementById("productos_devuelve").getElementsByTagName('th');

    var valorestabla_cambia = document.getElementById("productos_cambia").getElementsByTagName("p");
    var filastabla_cambia = document.getElementById("productos_cambia").getElementsByTagName('tr');
    var columnastabla_cambia = document.getElementById("productos_cambia").getElementsByTagName('th');

    if (document.getElementById('total_cambia').value == "" || document.getElementById('total_devuelve').value == "") {
        notificarError("Campos Erroneos");
    } else {
        if (document.getElementById('diferencia_cobro').value == "") {
            /*SOLAMENTE SUMAMOS Y RESTAMOS AL STOCK*/
            sumar_restar_inventario(valorestabla_devuelve, filastabla_devuelve, columnastabla_devuelve, valorestabla_cambia, filastabla_cambia, columnastabla_cambia);
        } else {
            /*CREAMOS NUEVA VENTA*/
            var total_cambio = parseFloat(document.getElementById('diferencia_cobro').value);
            sumar_restar_inventario(valorestabla_devuelve, filastabla_devuelve, columnastabla_devuelve, valorestabla_cambia, filastabla_cambia, columnastabla_cambia);
            insertar_cambio("cliente", "Efectivo", total_cambio, "0", "0", filastabla_cambia, columnastabla_cambia, valorestabla_cambia, "Ninguno", total_cambio);
        }
        notificacionExitosa("Cambio Realizado Correctamente");
    }
});

async function sumar_restar_inventario(valorestabla_devuelve, filastabla_devuelve, columnastabla_devuelve, valorestabla_cambia, filastabla_cambia, columnastabla_cambia) {
    var lista_devuelve = {};
    var lista1_devuelve = new Array();
    var lista2_devuelve = new Array();
    var k = 0;
    var respuesta_devuelve;
    var lista_cambia = {};
    var lista1_cambia = new Array();
    var lista2_cambia = new Array();
    var respuesta_cambia;

    /* POSTERIORMENTE GUARDAMOS EN UNA LISTA DE ARREGLOS LOS PRODUCTOS QUE DEVUELVE*/
    for (var i = 0; i < filastabla_devuelve.length - 1; i++) {
        lista_devuelve = {};
        for (var j = 0; j < columnastabla_devuelve.length - 1; j++) {
            var valor_input = valorestabla_devuelve[k].innerHTML;
            lista_devuelve[j] = valor_input;
            k++;
        }
        lista1_devuelve[i] = {
            "Inventario": lista_devuelve[0],
            "Cantidad": lista_devuelve[2],
        };
    }
    lista2_devuelve = JSON.stringify(lista1_devuelve);
    try {
        var sumarInventario = new FormData();
        sumarInventario.append('SumarProductosCambio', 'OK');
        sumarInventario.append('productos', lista2_devuelve);

        var peticion_devuelve = await fetch('../Controllers/VentasController.php', {
            method: 'POST',
            body: sumarInventario
        });

        var resjson_devuelve = await peticion_devuelve.json();

        if (resjson_devuelve.respuesta == "OK") {
            respuesta_devuelve = "OK";
        }
    } catch (error) {
        notificarError("Error");
    }

    /* POSTERIORMENTE GUARDAMOS EN UNA LISTA DE ARREGLOS LOS PRODUCTOS QUE CAMBIA*/
    k = 0;
    for (var i = 0; i < filastabla_cambia.length - 1; i++) {
        lista_cambia = {};
        for (var j = 0; j < columnastabla_cambia.length - 1; j++) {
            var valor_input = valorestabla_cambia[k].innerHTML;
            lista_cambia[j] = valor_input;
            k++;
        }
        lista1_cambia[i] = {
            "Inventario": lista_cambia[0],
            "Cantidad": lista_cambia[2]
        };
    }
    lista2_cambia = JSON.stringify(lista1_cambia);
    try {
        var RestarInventario = new FormData();
        RestarInventario.append('RestarProductosCambio', 'OK');
        RestarInventario.append('productos', lista2_cambia);

        var peticion_cambia = await fetch('../Controllers/VentasController.php', {
            method: 'POST',
            body: RestarInventario
        });

        var resjson_cambia = await peticion_cambia.json();

        if (resjson_cambia.respuesta == "OK") {
            respuesta_cambia = "OK";
        }

        if (respuesta_devuelve == "OK" && respuesta_cambia == "OK") {
            limpiarcamposcambio();
        }
    } catch (error) {
        notificarError("Error");
    }
}

async function insertar_cambio(cliente, pago, total, cobro, cambio, filastabla, columnastabla, valorestabla, impresion, subtotal_venta) {
    var lista = {};
    var lista1 = new Array();
    var lista2 = new Array();
    var k = 0;
    let detalle_salida_venta = new FormData();
    let peticion;

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
            "Total": lista[3]
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
    detalle_salida_venta.append('cobro', cobro);
    detalle_salida_venta.append('cambio', cambio);
    peticion = await fetch('../Controllers/VentasController.php', {
        method: 'POST',
        body: detalle_salida_venta
    });

    var resjson = await peticion.json();

    if (resjson.respuesta == "OK") {
        limpiarcamposcambio();
    } else {
        notificarError("No Se Pudo Realizar la Venta");
    }
}

$("#EditarVenta").click(function() {
    //$("#buscar_devuelve").DataTable().clear().draw();
    //$("#buscar_devuelvea").DataTable().clear().draw();
    //$("#buscar_devuelve").DataTable().destroy();
    //$('#buscar_devuelve').DataTable().draw();
    $('#modalFrmVentaCambio').modal('show');
    //$('#buscar_devuelve').DataTable().draw();
});

function limpiarcamposcambio() {
    $("#productos_cambia").DataTable().clear().draw();
    $("#productos_cambia").DataTable().destroy();
    $('#productos_cambia').DataTable().draw();
    $("#productos_devuelve").DataTable().clear().draw();
    $("#productos_devuelve").DataTable().destroy();
    $('#productos_devuelve').DataTable().draw();
    $("#total_cambia").val("");
    $("#total_devuelve").val("");
    $("#diferencia_cobro").val("");
}
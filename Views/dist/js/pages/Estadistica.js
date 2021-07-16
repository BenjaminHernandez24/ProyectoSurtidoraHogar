var tablaVentas;

/* HACEMOS UNA FUNCION QUE CONTENDRA LA CREACION DE LA TABLA DE VENTA DEL DIA*/
async function init() {
    tablaVentas = $("#tblVentaDia").DataTable({
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
            "data": "cliente"
        }, {
            "data": "metodo_pago"
        }, {
            "data": "total"
        }, {
            "data": "hora"
        }]
    });
}

/* INICIALIZAMOS LA FUNCION*/
init();
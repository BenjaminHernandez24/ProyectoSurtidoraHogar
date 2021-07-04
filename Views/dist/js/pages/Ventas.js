const formDatosProducto = document.getElementById('frmDatosProducto');

var tablaClientes;
var tablaDatosVentas;
var rowIdx;

/* LLENAMOS LA TABLA CON CLIENTES */
async function init() {
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
            "defaultContent": "<button id='btnAgregar' class='btn btn-info btn-sm btnAgregar'>Agregar</button>"
        }]
    });
}

/* INICIALIZAMOS LA TABLA LLENA DE CLIENTES */
init();

/* CUANDO SE PRESIONA EL BOTON AGREGAR CLIENTE EN LA TABLA DE CLIENTES*/
$(document).on("click", ".btnAgregar", function(e) {
    e.preventDefault();
    if (tablaClientes.row(this).child.isShown()) {
        data = tablaClientes.row(this).data();
    } else {
        data = tablaClientes.row($(this).parents("tr")).data();
    }

    /* Cargamos los datos obtenidos al modal editar */
    idClientes = data[0];
    $("#nombre").val(data[1]);
    $("#tipo").val(data[2]);
    $("#telefono").val(data[3]);

    $("#nombre_cliente").val(data[1]);
    /* Hacemos visible el modal */
    $("#modalcliente").modal("hide");

});

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

                $("#nombre_producto").val(datos.productos);
                $("#stock").val(datos.stock);
                $("#precio").val(datos.precio);
                document.getElementById('precio').disabled = false;
                document.getElementById('cantidad').disabled = false;
                document.getElementById('descuento').disabled = false;
            }
        });
    } catch (error) {
        console.log(error);
    }
});

/* LLENADO DE TABLA DATOS DE VENTA AL PRESIONAR EL BOTON DE AGREGAR */
formDatosProducto.addEventListener('submit', function(e) {

    e.preventDefault();

    // Denotes total number of rows
    rowIdx = 0;
    $('#tblDetalleVenta').find('tbody').append(`<tr id="">
         <td class="row-index">
         <p>${formDatosProducto.querySelector('#nombre_producto').value}</p>
         </td>
         <td class="row-index">
         <p>${formDatosProducto.querySelector('#cantidad').value}</p>
         </td>
         <td class="row-index">
         <p>${formDatosProducto.querySelector('#precio').value}</p>
         </td>
         <td class="row-index">
         <p>hola</p>
         </td>
          <td class="">
          </button><button class='btn btn-danger btn-sm btnBorrar'><i class='fas fa-trash-alt'></i></button>
            </td>
          </tr>`);

    if (document.getElementById('subtotal').value == "") {
        console.log(document.getElementById('precio').value);
        $("#subtotal").val(document.getElementById('precio').value);
    } else {
        var suma = parseFloat(document.getElementById('precio').value) + parseFloat(document.getElementById('subtotal').value);
        console.log(suma);
        $("#subtotal").val(suma);
    }

    limpiarCampos("limpiartodo");
})

/* FUNCION PARA ELIMINAR LA FILA AL PRESIONAR EL BOTON EN LA TABLA DE DATOS DE VENTA */
$('#tbody').on('click', '.btnBorrar', function() {
    // Getting all the rows next to the row
    // containing the clicked button
    var child = $(this).closest('tr').nextAll();

    // Iterating across all the rows 
    // obtained to change the index
    child.each(function() {

        // Getting <tr> id.
        var id = $(this).attr('id');

        // Getting the <p> inside the .row-index class.
        var idx = $(this).children('.row-index').children('p');

        // Gets the row number from <tr> id.
        var dig = parseInt(id.substring(1));

        // Modifying row index.
        idx.html(`Row ${dig - 1}`);

        // Modifying row id.
        $(this).attr('id', `R${dig - 1}`);
    });

    // Removing the current row.
    $(this).closest('tr').remove();

    // Decreasing total number of rows by 1.
    rowIdx--;

    console.log(data);

});

/* FUNCION PARA ABRIR EL MODAL DE LA TABLA DE CLIENTES */
document.getElementById('buscar_cliente').addEventListener('click', () => {
    $("#modalcliente").modal("show");
})

/* FUNCION PARA BORRAR DATOS CUANDO NO SE ESTE ESCRIBIBIENDO EN EL INPUT DE BUSCAR PRODUCTO */
document.getElementById('buscar').addEventListener('keyup', () => {

    if (document.getElementById('buscar').value == "") {
        limpiarCampos("limpiar");
    }
})

/* FUNCION PARA LIMPIAR CAMPOS EN EL FORMULARIO */
function limpiarCampos(mensaje) {
    if (mensaje == 'limpiartodo') {
        formDatosProducto.reset();
        document.getElementById('precio').disabled = true;
        document.getElementById('cantidad').disabled = true;
        document.getElementById('descuento').disabled = true;
    } else if (mensaje == 'limpiar') {
        document.getElementById('precio').disabled = true;
        document.getElementById('cantidad').disabled = true;
        document.getElementById('descuento').disabled = true;
        document.getElementById('precio').value = "";
        document.getElementById('stock').value = "";
        document.getElementById('nombre_producto').value = "";
    }
}
const form_agregar_productoInv = document.getElementById('frm_registro_productoInv');
const form_editar_productoInv = document.getElementById('frm_editar_productoInv');

var tabla_inventario;
var id_inventario;

// Llenar Tabla de Inventario //
async function inventario() {
    tabla_inventario = $("#tab_inventario").DataTable({
        "responsive": true,
        "autoWidth": false,
        "ajax": {
            "url": "../Controllers/InventarioController.php",
            "type": "POST",
            "data": {
                "obtener_inventario": "OK"
            },
            
            "dataSrc": ""
        },
        "columns": [
            {"data": "id_inventario"},
            {"data": "nombre_producto"},
            {"data": "stock"},

            {"defaultContent": "<button class='btn btn-success btn-sm btnVerStatus'>Ver</button>"},
           
            {
                "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-info btn-sm btnEditar'><i class='fas fa-edit'></i></button><button class='btn btn-danger btn-sm btnBorrar'><i class='fas fa-trash-alt'></i></button></div></div> "
               
              } 
        ]
    });
}
inventario();
//------- Función para llenar Select de Productos ------//
async function llenar_Producto(){
    try {

        var datosProducto = new FormData();
        datosProducto.append('obtener_producto','OK');
        
        var peticion = await fetch('../controllers/InventarioController.php', {
            method : 'POST',
            body : datosProducto
        });

        var resjson = await peticion.json();
        var selectProductoEdi = document.getElementById('producto_editar');
       
        for(item of resjson){
            let option1 = document.createElement('option');
            option1.value = item.nombre_producto;
            option1.text = item.nombre_producto;
            selectProductoEdi.appendChild(option1);
        }
        
    } catch (error) {
        notificarError(error);
    }
}
llenar_Producto();
/* BUSQUEDA DE AUTOCOMPLETADO DE LOS PRODUCTOS */
$(document).ready(async function autocompletado() {
    try {
        var Productos = new FormData();
        Productos.append('obtenerProductos', 'OK');

        var peticion = await fetch('../Controllers/InventarioController.php', {
            method: 'POST',
            body: Productos
        });

        var data = await peticion.json();

        $('#buscar').autocomplete({

            source: data,

            select: async function(event, item) {
                try {
                    var DatosProductos = new FormData();
                    DatosProductos.append('obtener_lista_productos', 'OK');
                    DatosProductos.append('valor', item.item.value);

                    var peticionDatos = await fetch('../Controllers/InventarioController.php', {
                        method: 'POST',
                        body: DatosProductos
                    });

                    var datos = await peticionDatos.json();
                        $("#nombre_producto").val(datos.productos);
                    
                } catch (error) {
                    notificarError(error);
                }
            }
        });
    } catch (error) {
        notificarError(error);
    }
});
///------- Evento para botón de registro de Productos en Inventario------//
form_agregar_productoInv.addEventListener('submit', async(e) => {
    e.preventDefault();
    
    let nombre_producto = document.getElementById('nombre_producto').value;

    if (document.getElementById("nombre_producto").value === "") {
        notificarError('Seleccione un producto');
    }else{

    try {
        var datosProducto = new FormData(form_agregar_productoInv);
        datosProducto.append('agregar_producto_inv', 'OK');
        datosProducto.append('nombre_producto', nombre_producto);

        var peticion = await fetch('../Controllers/InventarioController.php', {
            method: 'POST',
            body: datosProducto
        });
      //----- Se obtiene la respuesta del controlador. ------//
        var resjson = await peticion.json();

        if (resjson.respuesta == "OK") {
            notificacionExitosa('Producto registrado en Inventario');
            tabla_inventario.ajax.reload(null, false);
        } else if (resjson.respuesta == "EXISTE") {

            notificarError('Ese producto ya existe en Inventario');

        } else {
            notificarError(resjson.respuesta);
        }
    
    } catch (error) {
        notificarError(error);
    }
   }
})
//---------- Fin Registrar un Producto en Inventario ---------//
//---------- Evento para Editar un Producto en Inventario ---------//
form_editar_productoInv.addEventListener('submit', async (e) => {
    e.preventDefault();
    //-------- variables que guardan los ID de inputs para editar tipo y marca de producto------//
    let selectProductoEdi = document.getElementById('producto_editar');
    //---------- validación cuando no se ha escogido un tipo y marca de producto ---------//
    if(selectProductoEdi.value === "default"){
        notificarError('Seleccione un Producto');
    }else{
        try {
            
            var datosProducto = new FormData(form_editar_productoInv);
            datosProducto.append('editar_producto_inv', 'OK');
            datosProducto.append('id_inventario', id_inventario);
            var peticion = await fetch('../controllers/InventarioController.php', {
                method : 'POST',
                body : datosProducto
            });
    
            var resjson = await peticion.json();
    
            if(resjson.respuesta == "OK"){
                notificacionExitosa('Producto Actualizado');
               
            } else if (resjson.respuesta == "NO") {

                notificarError('Elige el producto correcto');
    
            }else {
                notificarError(resjson.respuesta);
            }
        
            tabla_inventario.ajax.reload(null,false);
        } catch (error) {
            notificarError(error);
        }
    }
});
//---------- Al dar click en el botón Editar un Producto se muestra el modal ---------//
$(document).on('click', '.btnEditar', async function(){
    
    if(tabla_inventario.row(this).child.isShown()){
        var data = tabla_inventario.row(this).data();
    }else{
        var data = tabla_inventario.row($(this).parents("tr")).data();
    }
    id_inventario = data['id_inventario'];
    try {

        var datosProducto = new FormData();
        datosProducto.append('obtener_alert', 'OK');
        datosProducto.append('id_inventario', id_inventario);

        var peticion = await fetch('../Controllers/InventarioController.php', {
            method: 'POST',
            body: datosProducto
        });
//---------- Esperamos la respuesta que obtiene nuestro controlador para hacer la consulta. ---------//
        let respuesta = await peticion.json();
        var array = new Array();
        array = Object.values(respuesta);
        $("#estatus_alert_editar").val(array[0]["estatus_alerta"]);
        

    } catch (error) {
        notificarError(error);
    }

    document.querySelector("#producto_editar").value = data['nombre_producto'];

    $("#stock_editar").val(data['stock']);
    // -----Mostramos el modal -----//
    $('#editar_producto_inventario').modal('show');

});  
//---------- FIN editar producto en Inventario---------//
//---- Al dar click en botón Borrar Producto se obtiene el ID del inventario----//
$(document).on('click', ".btnBorrar", async function() {

    if (tabla_inventario.row(this).child.isShown()) {
        var data = tabla_inventario.row(this).data();
    } else {
        var data = tabla_inventario.row($(this).parents("tr")).data();
    }

    id_inventario = data['id_inventario'];
    const result = await Swal.fire({
        title: '¿ESTÁ SEGURO(A) DE ELIMINAR ESTE PRODUCTO DEL INVENTARIO?',
        text: "¡Se eliminará en Módulo: Ventas !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#5bc0de',
        cancelButtonColor: '#d9534f',
        confirmButtonText: '¡Estoy seguro(a)!'
    });
//------- Si el usuario está seguro de la eliminación se realiza la función para eliminar el producto ------//
    if (result.value) {
        try {

            var datosProducto = new FormData();
            datosProducto.append('eliminar_producto_inv', 'OK');
            datosProducto.append('id_inventario', id_inventario);
 
            var peticion = await fetch('../Controllers/InventarioController.php', {
                method: 'POST',
                body: datosProducto
            });
 //---------- Esperamos la respuesta que obtiene nuestro controlador para hacer la consulta. ---------//
            var resjson = await peticion.json();

            if (resjson.respuesta == "OK") {
                notificacionExitosa('¡ELiminación exitosa!');
                tabla_inventario.ajax.reload(null, false);
            } else {
                notificarError(resjson.respuesta);
            }

        } catch (error) {
            notificarError(error);
        }
    }

})
//---------- Fin Borrar un Producto de Inventario ---------//

//---------- Funcion para Ver Estado del Stock en Inventario ---------//
$(document).on('click', '.btnVerStatus', async function(){
    
    try {
        if (tabla_inventario.row(this).child.isShown()) {
            var data = tabla_inventario.row(this).data();
        } else {
            var data = tabla_inventario.row($(this).parents("tr")).data();
        }
        id_inventario = data['id_inventario'];
        var datosPro = new FormData();
        datosPro.append('obtener_estatus', 'OK');
        datosPro.append('id_inventario', id_inventario);

        var peticion = await fetch('../Controllers/InventarioController.php', {
            method: 'POST',
            body: datosPro
        });
//---------- Esperamos la respuesta que obtiene nuestro controlador para hacer la consulta. ---------//
        var resjson = await peticion.json();

        if (resjson.respuesta == "ACEPTABLE") {
            mensajeStockAceptable('El stock es aceptable');
           
        } else if (resjson.respuesta == "ALERTA"){
            mensajeStockBajo('El stock es bajo!!');
        } else {
            notificarError(resjson.respuesta);
        }
    } catch (error) {
        console.log(error);
    }
     
});
//---------- Fin Ver Estado de Stock en inventario ---------//



//---------- Validar números negativos-estatus alerta en Registro---------//
document.getElementById('estatus_alert').addEventListener('keyup', () => {
    if (!document.getElementById('estatus_alert').value == "") {
        let precio = parseFloat(document.getElementById('estatus_alert').value);
        if (precio <= 0) {
            Error("No Puede Ingresar Números Negativos o Cero");
        }
    }
})
//---------- Validar números negativos-stock en Registro---------//
document.getElementById('stock').addEventListener('keyup', () => {
    if (!document.getElementById('stock').value == "") {
        let precio = parseFloat(document.getElementById('stock').value);
        if (precio <= 0) {
            Error("No Puede Ingresar Números Negativos o Cero");
        }
    }
})

//---------- Validar números negativos-estatus alerta en Editar---------//
document.getElementById('estatus_alert_editar').addEventListener('keyup', () => {
    if (!document.getElementById('estatus_alert_editar').value == "") {
        let precio = parseFloat(document.getElementById('estatus_alert_editar').value);
        if (precio <= 0) {
            Error("No Puede Ingresar Números Negativos o Cero");
        }
    }
})
//---------- Validar números negativos-stock en Editar---------//
document.getElementById('stock_editar').addEventListener('keyup', () => {
    if (!document.getElementById('stock_editar').value == "") {
        let precio = parseFloat(document.getElementById('stock_editar').value);
        if (precio <= 0) {
            Error("No Puede Ingresar Números Negativos o Cero");
        }
    }
})

function notificarError(mensaje) {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: mensaje
    })
}
// ------- Mensajes de Alert -------//
function Error(mensaje) {
    Swal.fire({
        position: 'center',
        icon: 'warning',
        title: mensaje,
        showConfirmButton: false,
        timer: 3000
    })
}
function notificacionExitosa(mensaje) {
    Swal.fire(
        mensaje,
        '',
        'success'
    ).then(result => {
        form_agregar_productoInv.reset();
        $('#nuevo_producto_inv').modal('hide');	
        document.getElementById('cerrar').click();
        document.getElementById('cerrarEditar').click();
    });
}
function mensajeStockAceptable(mensaje) {
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Estatus Aceptable',
        showConfirmButton: false,
        timer: 2000
    })
}
function mensajeStockBajo(mensaje) {
    Swal.fire({
        position: 'center',
        icon: 'warning',
        title: 'Estatus Alerta!!',
        showConfirmButton: false,
        timer: 2000
    })
}

// --------- Limpiar campos del formulario para agregar producto a inventario. -----------//
document.getElementById('alta_producto_inv').addEventListener('click', () => {
    form_agregar_productoInv.reset();
})


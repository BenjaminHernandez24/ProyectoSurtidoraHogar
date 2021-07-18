const form_agregar_productoInv = document.getElementById('frm_registro_productoInv');
const form_editar_productoInv = document.getElementById('frm_editar_productoInv');

var tabla_inventario;
var id_inventario;
var producto_reg;
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
            {"data": "estatus_aceptable"},
            {"data": "estatus_alerta"},
            {"data": "stock"},
            { "defaultContent": "<button class='btn btn-success btn-sm '>Ver</button>"},
            
           
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

        var selectProducto = document.getElementById('producto');
        var selectProductoEdi = document.getElementById('producto_editar');
       
        for(item of resjson){
            let option = document.createElement('option');
            option.value = item.id_producto;
            option.text = item.nombre_producto;
            selectProducto.appendChild(option);
            let option1 = document.createElement('option');
            option1.value = item.id_producto;
            option1.text = item.nombre_producto;
            selectProductoEdi.appendChild(option1);
        }
        
    } catch (error) {
        console.log(error);
    }
}
llenar_Producto();
///------- Evento para botón de registro de Productos en Inventario------//
form_agregar_productoInv.addEventListener('submit', async(e) => {
    e.preventDefault();
    let selectProducto = document.getElementById('producto');

    if(selectProducto.value === "default"){
        notificarError('Seleccione un producto');
    }else{

    try {
        var datosProducto = new FormData(form_agregar_productoInv);
        datosProducto.append('agregar_producto_inv', 'OK');

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
        console.log(error);
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
                tabla_inventario.ajax.reload(null,false);
            } else if (resjson.respuesta == "NO") {

                notificarError('Elige el producto correcto');
    
            } else {
                notificarError(resjson.respuesta);
            }
        
            
        } catch (error) {
            console.log(error);
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
     // Cargamos datos de la tabla del producto elegido //
    id_inventario = data[0];
    $("#estatus_acept_editar").val(data[2]);
    $("#estatus_alert_editar").val(data[3]);
    $("#stock_editar").val(data[4]);
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

    id_inventario = data[0];
    const result = await Swal.fire({
        title: '¿ESTÁ SEGURO(A) DE ELIMINAR ESTE PRODUCTO DEL INVENTARIO?',
        text: "¡La eliminación es permanente!",
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
            console.log(error);
        }
    }

})
$(document).on('click', '.btnVer', async function(){
    
    if(tabla_inventario.row(this).child.isShown()){
        var data = tabla_inventario.row(this).data();
    }else{
        var data = tabla_inventario.row($(this).parents("tr")).data();
    }
     
});  
//---------- Fin Borrar un Producto de Inventario ---------//
function notificarError(mensaje) {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: mensaje
    })
}
// ------- Mensajes de Alert -------//

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

// --------- Limpiar campos del formulario para agregar producto a inventario. -----------//
document.getElementById('alta_producto_inv').addEventListener('click', () => {
    form_agregar_productoInv.reset();
})


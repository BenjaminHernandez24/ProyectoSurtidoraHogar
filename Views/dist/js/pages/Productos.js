const form_agregar_producto = document.getElementById('frm_registro_producto');
const form_editar_producto = document.getElementById('frm_editar_producto');
var tabla_productos;
var id_producto;

//---------- Función para llenar Tabla  de Productos. ---------//
async function tab_Productos() {
    tabla_productos = $("#TablaProductos").DataTable({
        "responsive": true,
        "autoWidth": false,
        "ajax": {
            "url": "../Controllers/ProductosController.php",
            "type": "POST",
            "data": {
                "obtener_producto": "OK"
            },
            "dataSrc": ""
        },
        "columns": [
            {"data": "id_producto"},
            {"data": "nombre_producto"},
            {"data": "precio_publico"},
            {"data": "descripcion_tipo"},
            {"data": "descripcion_marca"},
            {
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-info btn-sm btnEditar'><i class='fas fa-edit'></i></button><button class='btn btn-danger btn-sm btnBorrar'><i class='fas fa-trash-alt'></i></button></div></div>"
              
            }
        ]
    });
}
tab_Productos();
//---------- Función para llenar Select de Tipo de Productos. (en Formularios de Registro y Editar)---------//
async function llenar_Tipo_Producto(){
    try {

        var datosProducto = new FormData();
        datosProducto.append('obtener_tipo_producto','OK');
        
        var peticion = await fetch('../controllers/ProductosController.php', {
            method : 'POST',
            body : datosProducto
        });

        var resjson = await peticion.json();

        var selectTipoProducto = document.getElementById('tipo_producto');
        var selectTipoProductoEdi = document.getElementById('tipo_producto_editar');
        for(item of resjson){
            let option_r = document.createElement('option');
            option_r.value = item.id_tipo;
            option_r.text = item.descripcion_tipo;
            selectTipoProducto.appendChild(option_r);

            let option_e = document.createElement('option');
            option_e.value = item.descripcion_tipo;
            option_e.text = item.descripcion_tipo;
            selectTipoProductoEdi.appendChild(option_e);
        }
        
    } catch (error) {
        console.log(error);
    }
}
llenar_Tipo_Producto();
//---------- Función para llenar Select de Marca de Productos. (en Formularios de Registro y Editar)---------//
async function llenar_Marca_Producto(){
    try {

        var datosProducto = new FormData();
        datosProducto.append('obtener_marca_producto','OK');
        
        var peticion = await fetch('../controllers/ProductosController.php', {
            method : 'POST',
            body : datosProducto
        });

        var resjson = await peticion.json();

        var selectMarcaProducto = document.getElementById('marca_producto');
        var selectMarcaProductoEdi = document.getElementById('marca_producto_editar');
        for(item of resjson){
            let optionM1 = document.createElement('option');
            let optionM2 = document.createElement('option');
            optionM1.value = item.id_marca;
            optionM1.text = item.descripcion_marca;
            selectMarcaProducto.appendChild(optionM1);

        /*En vez de pasarle como value el id_marca, le pasamos la descripcion*/
        /*OJO ESTO SOLO SE HACE CON EDITAR QUE ES LO QUE NECESITAMOS*/
            optionM2.value = item.descripcion_marca;
            optionM2.text = item.descripcion_marca;
            selectMarcaProductoEdi.appendChild(optionM2);
        }
        
    } catch (error) {
        console.log(error);
    }
}
llenar_Marca_Producto();
//------- Evento para botón de registro de Productos ------//
form_agregar_producto.addEventListener('submit', async(e) => {
    e.preventDefault();
    let selectTipoProducto = document.getElementById('tipo_producto');
    let selectMarcaProducto = document.getElementById('marca_producto');

    if(selectTipoProducto.value === "default"){
        notificarError('Seleccione un tipo de producto');
    }else if(selectMarcaProducto.value === "default"){
        notificarError('Seleccione una marca de producto');

    }else{

    try {
        var datosProducto = new FormData(form_agregar_producto);
        datosProducto.append('agregar_producto', 'OK');

        var peticion = await fetch('../Controllers/ProductosController.php', {
            method: 'POST',
            body: datosProducto
        });
      //----- Se obtiene la respuesta del controlador. ------//
        var resjson = await peticion.json();

        if (resjson.respuesta == "OK") {
            notificacionExitosa('Producto registrado');
            tabla_productos.ajax.reload(null, false);

        } else if (resjson.respuesta == "EXISTE") {

            notificarError('Ese producto ya ha sido registrado');

        } else {
            notificarError(resjson.respuesta);
        }
    
    } catch (error) {
        console.log(error);
    }
}
})
//---------- Fin Registrar un Producto ---------//

//---------- Evento para Editar un Producto ---------//
form_editar_producto.addEventListener('submit', async (e) => {
    e.preventDefault();
    //-------- variables que guardan los ID de inputs para editar tipo y marca de producto------//
    let selectTipoProductoEdi = document.getElementById('tipo_producto_editar');
    let selectMarcaProductoEdi = document.getElementById('marca_producto_editar');
    //---------- validación cuando no se ha escogido un tipo y marca de producto ---------//
    if(selectTipoProductoEdi.value === "default"){
        notificarError('Seleccione un tipo de producto');
    }else if (selectMarcaProductoEdi.value === "default"){
        notificarError('Seleccione una marca de producto');
    }else{
        try {
            console.log(document.getElementById('frm_editar_producto'));
            var datosProducto = new FormData(form_editar_producto);
            datosProducto.append('editar_producto', 'OK');
            datosProducto.append('id_producto', id_producto);
            var peticion = await fetch('../controllers/ProductosController.php', {
                method : 'POST',
                body : datosProducto
            });
    
            var resjson = await peticion.json();
    
            if(resjson.respuesta == "OK"){
                notificacionExitosa('Producto Actualizado');
                tabla_productos.ajax.reload(null,false);
            }else{
                notificarError(resjson.respuesta);
            }
            
        } catch (error) {
            console.log(error);
        }
    }
});
//---------- Al dar click en el botón Editar un Producto se muestra el modal ---------//
$(document).on('click', '.btnEditar', async function(){
   
    if(tabla_productos.row(this).child.isShown()){
        var data = tabla_productos.row(this).data();
    }else{
        var data = tabla_productos.row($(this).parents("tr")).data();
    }
     
    console.log(data);
    id_producto = data[0];
    $("#nom_producto_editar").val(data[1]);
    $("#precio_pub_editar").val(data[2]);
    /*Le decimos al combo que se pocisione por predeterminado donde el valor
      sea igual a lo que se está obteniendo en el data de la tabla*/
    document.querySelector("#tipo_producto_editar").value = data[3];
    document.querySelector("#marca_producto_editar").value = data[4];
    // -----Mostramos el modal -----//
    $('#editar_producto').modal('show');

});  
//---------- Fin Editar un Producto ---------//

//---- Al dar click en botón Borrar Producto se obtiene el ID del producto----//
$(document).on('click', ".btnBorrar", async function() {

    if (tabla_productos.row(this).child.isShown()) {
        var data = tabla_productos.row(this).data();
    } else {
        var data = tabla_productos.row($(this).parents("tr")).data();
    }

    id_producto = data[0];
    const result = await Swal.fire({
        title: '¿ESTÁ SEGURO(A) DE ELIMINAR ESTE PRODUCTO?',
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
            datosProducto.append('eliminar_producto', 'OK');
            datosProducto.append('id_producto', id_producto);
 
            var peticion = await fetch('../Controllers/ProductosController.php', {
                method: 'POST',
                body: datosProducto
            });
 //---------- Esperamos la respuesta que obtiene nuestro controlador para hacer la consulta. ---------//
            var resjson = await peticion.json();

            if (resjson.respuesta == "OK") {
                notificacionExitosa('¡ELiminación exitosa!');
                tabla_productos.ajax.reload(null, false);
            } else {
                notificarError(resjson.respuesta);
            }

        } catch (error) {
            console.log(error);
        }
    }

})
//---------- Fin Borrar un Producto ---------//
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
        form_agregar_producto.reset();
        $('#nuevo_producto').modal('hide');	
        document.getElementById('cerrar').click();
        document.getElementById('cerrarEditar').click();
    });
}

// --------- Limpiar campos del formulario para agregar producto -----------//
document.getElementById('alta_producto').addEventListener('click', () => {
    form_agregar_producto.reset();
})

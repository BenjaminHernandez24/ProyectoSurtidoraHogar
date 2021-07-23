const form_agregar_compra = document.getElementById('frm_registro_compras');
const form_editar_compra = document.getElementById('frm_editar_compras');

var tabla_compras;
var id_entrada_compra;

// Llenar Tabla de Inventario //
async function compras() {
    tabla_compras = $("#tab_compras").DataTable({
        "responsive": true,
        "autoWidth": false,
        "ajax": {
            "url": "../Controllers/ComprasController.php",
            "type": "POST",
            "data": {
                "obtener_compras": "OK"
            },
           
            "dataSrc": ""
        },
        "columns": [
            {"data": "id_entrada_compra"},
            {"data": "nom_empresa"},
            {"data": "nombre_producto"},
            {"data": "num_piezas"},
            {"data": "precio_unitario"},
            {"data": "subtotal"},
            {"data": "fecha"},
            {"data": "hora"},
           
            {
                "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-info btn-sm btnEditar'><i class='fas fa-edit'></i></button><button class='btn btn-danger btn-sm btnBorrar'><i class='fas fa-trash-alt'></i></button></div></div> "
               
              } 
        ]
    });
}
compras();
//------- Función para llenar Select de Proveedor ------//
async function llenar_Proveedor(){
    try {

        var datosProducto = new FormData();
        datosProducto.append('obtener_proveedor','OK');
        
        var peticion = await fetch('../controllers/ComprasController.php', {
            method : 'POST',
            body : datosProducto
        });

        var resjson = await peticion.json();

        var selectProveedor = document.getElementById('proveedor_registro');
        var selectProveedorEdi = document.getElementById('proveedor_editar');
       
        for(item of resjson){
            let option = document.createElement('option');
            option.value = item.id_prov;
            option.text = item.nom_empresa;
            selectProveedor.appendChild(option);

            let option1 = document.createElement('option');
            option1.value = item.nom_empresa;
            option1.text = item.nom_empresa;
            selectProveedorEdi.appendChild(option1);
        }
        
    } catch (error) {
        console.log(error);
    }
}
llenar_Proveedor();
async function llenar_Producto(){
    try {

        var datosProducto = new FormData();
        datosProducto.append('obtener_productos_inv','OK');
        
        var peticion = await fetch('../controllers/ComprasController.php', {
            method : 'POST',
            body : datosProducto
        });

        var resjson = await peticion.json();
        var selectProducto = document.getElementById('producto_registro');
        var selectProductoEdi = document.getElementById('producto_editar');
       
        for(item of resjson){
            let option = document.createElement('option');
            option.value = item.id_producto;
            option.text = item.nombre_producto;
            selectProducto.appendChild(option);

            let option1 = document.createElement('option');
            option1.value = item.nombre_producto;
            option1.text = item.nombre_producto;
            selectProductoEdi.appendChild(option1);
        }
        
    } catch (error) {
        console.log(error);
    }
}
llenar_Producto();
//------- Evento para botón de registro de Compras------//
form_agregar_compra.addEventListener('submit', async(e) => {
    e.preventDefault();
    let selectProducto = document.getElementById('producto_registro');
    let selectProveedor = document.getElementById('proveedor_registro');
    if(selectProveedor.value === "default"){
        notificarError('Seleccione un proveedor');
    }else if(selectProducto.value === "default"){
        notificarError('Seleccione un producto');
    }else{
    try {
        var datosCompra = new FormData(form_agregar_compra);
        datosCompra.append('agregar_compra', 'OK');
        

        var peticion = await fetch('../Controllers/ComprasController.php', {
            method: 'POST',
            body: datosCompra
        });
      //----- Se obtiene la respuesta del controlador. ------//
        var resjson = await peticion.json();

        if (resjson.respuesta == "OK") {
            notificacionExitosa('Stock actualizado y Compra registrada');
            tabla_compras.ajax.reload(null, false);
        } else {
            notificarError(resjson.respuesta);
        }
    
    } catch (error) {
        console.log(error);
    }
   }
})
//------- FIN Evento para botón de registro de Compras------//
//---------- Evento para Editar una Compra ---------//
form_editar_compra.addEventListener('submit', async (e) => {
    e.preventDefault();
    //-------- variables que guardan los ID de inputs para editar tipo y marca de producto------//
    let selectProductoEdi = document.getElementById('producto_editar');
    let selectProveedorEdi = document.getElementById('proveedor_editar');
    //---------- validación cuando no se ha escogido un tipo y marca de producto ---------//
    if(selectProductoEdi.value === "default"){
        notificarError('Seleccione un Producto');
    }else if(selectProveedorEdi.value === "default"){
        notificarError('Seleccione un Proveedor');
    }else{
        try {
            
            var datosCompra = new FormData(form_editar_compra);
            datosCompra.append('editar_compra', 'OK');
            datosCompra.append('id_entrada_compra', id_entrada_compra);
            var peticion = await fetch('../controllers/ComprasController.php', {
                method : 'POST',
                body : datosCompra
            });
    
            var resjson = await peticion.json();
    
            if(resjson.respuesta == "OK"){
                notificacionExitosa('Compra Actualizada');
                tabla_compras.ajax.reload(null,false);
            }else{
                notificarError(resjson.respuesta);
            }
            
        } catch (error) {
            console.log(error);
        }
    }
});

//---------- Al dar click en el botón Editar una compra ---------//
$(document).on('click', '.btnEditar', async function(){
   
    if(tabla_compras.row(this).child.isShown()){
        var data = tabla_compras.row(this).data();
    }else{
        var data = tabla_compras.row($(this).parents("tr")).data();
    }
    console.log(data);
     // Cargamos datos de la tabla de la compra elegida //
    id_entrada_compra = data[0];
    document.querySelector("#proveedor_editar").value = data[1];
    document.querySelector("#producto_editar").value = data[2];
    $("#piezas_editar").val(data[3]);
    $("#precio_unit_editar").val(data[4]);
    // -----Mostramos el modal -----//
    $('#editar_compra').modal('show');
    

});  
//---------- FIN editar Compra ---------//
//---- Al dar click en botón Borrar Compra ----//
$(document).on('click', ".btnBorrar", async function() {

    if (tabla_compras.row(this).child.isShown()) {
        var data = tabla_compras.row(this).data();
    } else {
        var data = tabla_compras.row($(this).parents("tr")).data();
    }

    id_entrada_compra = data[0];
    const result = await Swal.fire({
        title: '¿ESTÁ SEGURO(A) DE ELIMINAR ESTA COMPRA?',
        text: "¡La eliminación es permanente!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#5bc0de',
        cancelButtonColor: '#d9534f',
        confirmButtonText: '¡Estoy seguro(a)!'
    });
//------- Si el usuario está seguro de la eliminación se realiza la función para eliminar la compra ------//
    if (result.value) {
        try {

            var datosCompra = new FormData();
            datosCompra.append('eliminar_compra', 'OK');
            datosCompra.append('id_entrada_compra', id_entrada_compra);
           
            var peticion = await fetch('../Controllers/ComprasController.php', {
                method: 'POST',
                body: datosCompra
            });
 //---------- Esperamos la respuesta que obtiene nuestro controlador para hacer la consulta. ---------//
            var resjson = await peticion.json();

            if (resjson.respuesta == "OK") {
                notificacionExitosa('¡ELiminación exitosa!');
                tabla_compras.ajax.reload(null, false);
            } else {
                notificarError(resjson.respuesta);
            }

        } catch (error) {
            console.log(error);
        }
    }

})
//---------- Validar números negativos-num_piezas en Registro---------//
document.getElementById('piezas').addEventListener('keyup', () => {
    if (!document.getElementById('piezas').value == "") {
        let precio = parseFloat(document.getElementById('piezas').value);
        if (precio <= 0) {
            Error("No Puede Ingresar Números Negativos o Cero");
        }
    }
})
//---------- Validar números negativos-precio_unitario en Registro ----------//
document.getElementById('precio_unit').addEventListener('keyup', () => {
    if (!document.getElementById('precio_unit').value == "") {
        let precio = parseFloat(document.getElementById('precio_unit').value);
        if (precio <= 0) {
            Error("No Puede Ingresar Números Negativos o Cero");
        }
    }
})
//---------- Validar números negativos-num_piezas en Editar---------//
document.getElementById('piezas_editar').addEventListener('keyup', () => {
    if (!document.getElementById('piezas_editar').value == "") {
        let precio = parseFloat(document.getElementById('piezas_editar').value);
        if (precio <= 0) {
            Error("No Puede Ingresar Números Negativos o Cero");
        }
    }
})
//---------- Validar números negativos-precio_unitario en Editar ----------//
document.getElementById('precio_unit_editar').addEventListener('keyup', () => {
    if (!document.getElementById('precio_unit_editar').value == "") {
        let precio = parseFloat(document.getElementById('precio_unit_editar').value);
        if (precio <= 0) {
            Error("No Puede Ingresar Números Negativos o Cero");
        }
    }
})
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
        form_agregar_compra.reset();
        $('#nueva_compra').modal('hide');	
        document.getElementById('cerrar').click();
        document.getElementById('cerrarEditar').click();
    });
}

// --------- Limpiar campos del formulario para agregar producto a inventario. -----------//
document.getElementById('alta_compra').addEventListener('click', () => {
    form_agregar_compra.reset();
})


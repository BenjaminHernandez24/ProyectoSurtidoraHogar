const form_datos_paquete = document.getElementById('frmDatosPaquete');
const form_editar_paquete = document.getElementById('frm_editar_paquete');
const form_agregar_paquete =document.getElementById('frmDetallePaquete')

var tabla_paquete;
var id_paquete;
var cantidad_editar;
var precio_editar;
var cont=0;
//---------------BUSQUEDA DE AUTOCOMPLETADO DE LOS PRODUCTOS ----------------//
$(document).ready(async function autocompletado() {
    try {
        var Productos = new FormData();
        Productos.append('obtenerProductos', 'OK');

        var peticion = await fetch('../Controllers/PaqueteController.php', {
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

                    var peticionDatos = await fetch('../Controllers/PaqueteController.php', {
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
//---------- FUNCION PARA LLENAR SELECT DE TIPO DE PAQUETE ---------//
async function llenar_Tipo_Producto(){
    try {

        var datosProducto = new FormData();
        datosProducto.append('obtener_tipo_paquete','OK');
        
        var peticion = await fetch('../controllers/PaqueteController.php', {
            method : 'POST',
            body : datosProducto
        });

        var resjson = await peticion.json();

        var selectTipoProducto = document.getElementById('tipo_paquete');
        
        for(item of resjson){
            let option_r = document.createElement('option');
            option_r.value = item.id_tipo;
            option_r.text = item.descripcion_tipo;
            selectTipoProducto.appendChild(option_r);

        }
        
    } catch (error) {
       notificarError(error);
    }
}
llenar_Tipo_Producto();
//---------- FUNCION PARA LLENAR SELECT DE MARCA PAQUETE ---------//
async function llenar_Marca_Producto(){
    try {

        var datosProducto = new FormData();
        datosProducto.append('obtener_marca_paquete','OK');
        
        var peticion = await fetch('../controllers/PaqueteController.php', {
            method : 'POST',
            body : datosProducto
        });

        var resjson = await peticion.json();

        var selectMarcaProducto = document.getElementById('marca_paquete');
       
        for(item of resjson){
            let optionM1 = document.createElement('option');
            optionM1.value = item.id_marca;
            optionM1.text = item.descripcion_marca;
            selectMarcaProducto.appendChild(optionM1);

        }
        
    } catch (error) {
        notificarError(error);
    }
}
llenar_Marca_Producto();

///------- Evento para botón de registro de Paquete------//
form_agregar_paquete.addEventListener('submit', async function(e) {
    e.preventDefault();
    var cont = $('#tablapqt tr').length;
    var total_art = cont-1 ;
    //notificacionExitosa('Número de artículos ' + total_art); 

    if(total_art < 2){
        notificarError('Agregue más productos al paquete');
    }else{
        //notificacionExitosa('Paquete armado :D'); 

        let selectTipoProducto = document.getElementById('tipo_paquete');
        let selectMarcaProducto = document.getElementById('marca_paquete');
    
        if(selectTipoProducto.value === "default"){
            notificarError('Seleccione un tipo de producto');
        }else if(selectMarcaProducto.value === "default"){
            notificarError('Seleccione una marca de producto');
        }else if (document.getElementById('total').value == "") {
            notificarError('Ingrese el total');
        }else{
            notificacionExitosa('Paquete armado :D'); 
        }
    }   
}) //Cierra función agregar paquete

//------------- LISTA DE PAQUETES (TABLA)  -----------//
form_datos_paquete.addEventListener('submit', async function(e) {
    e.preventDefault();
    let producto = document.getElementById('nombre_producto').value;
    let cantidad = parseFloat(document.getElementById('cantidad').value);
    let precio = parseFloat(document.getElementById('precio').value);
    let subtotal = precio * cantidad;
    var i = 0;
    try {
        
            if (cantidad < 0 || precio < 0 || producto == "" || cantidad == "" ) {
                Error("Error en campo(s)");
            } else {
               
                $('#tablapqt').DataTable().destroy();
                $('#tablapqt').find('tbody').append(`<tr id="">
                
                     <td class="row-index">
                     <p>${producto}</p>
                     </td>
                     <td class="row-index">
                     <p>${cantidad}</p>
                     </td>
                     <td class="row-index">
                     <p>${precio}</p>
                     </td>
                     <td class="row-index">
                     <p>${subtotal}</p>
                     </td>
                      <td class="">
                      <button class='btn btn-info btn-sm btnEditar'><i class='fas fa-edit'></i></button><button class='btn btn-danger btn-sm btnBorrar'><i class='fas fa-trash-alt'></i></button>
                        </td>
                      </tr>`);
                $('#tablapqt').DataTable().draw();
                if (document.getElementById('total').value == "") {
                    $("#subtotal").val(subtotal);
                    $("#total").val(subtotal);
                } else {
                    let total = parseFloat(document.getElementById('total').value);
                    let suma_total = total + subtotal;
                    $("#total").val(suma_total);

                    $("#subtotal").val(subtotal.toFixed(2));
                }   
                
               try {
                var DatosProductoPqt = new FormData();
                DatosProductoPqt.append('agregar_producto', 'OK');
                DatosProductoPqt.append('nombre_producto', nombre);
                DatosProductoPqt.append('cantidad', cantidad);
                var peticion = await fetch('../Controllers/PaqueteController.php', {
                    method: 'POST',
                    body: DatosProductoPqt
                });
            } catch (error) {
                notificarError("Ocurrio un Error");
            }
            //limpiarCampos("limpiartodo");
        }//cierre de else (pintar tabla)
    } catch (error) {
        notificarError("No se ha podido agregar los productos");
    }

})

//---------------- FUNCION PARA  EDITAR EL PRODUCTO DE PAQUETE-----------//
$('#tbody').on("click", ".btnEditar", async function() {
    fila_editar = this.parentNode.parentNode;
    var producto = fila_editar.getElementsByTagName("td")[0].getElementsByTagName("P")[0].innerHTML;
    cantidad_editar = fila_editar.getElementsByTagName("td")[1].getElementsByTagName("P")[0].innerHTML;
    precio_editar = fila_editar.getElementsByTagName("td")[2].getElementsByTagName("P")[0].innerHTML;

   
        var n_cantidad = $("#cantidadEditar").val(cantidad_editar);
        var n_precio = $("#precioEditar").val(precio_editar);
        if (n_cantidad < 0 || n_precio < 0 || n_cantidad == "" || n_precio == "" ) {
            Error("Error en campo(s)");
        }else {
            $("#stockEditar").val(n_cantidad);
            $("#cantidadEditar").val(n_precio);

        }
});
//----------- FUNCION PARA ELIMINAR PRODUCTO DE LA LISTA DE PAQUETE ----------//
$('#tbody').on('click', '.btnBorrar', async function() {
    var a = this.parentNode.parentNode;
   
    var producto = a.getElementsByTagName("td")[0].getElementsByTagName("P")[0].innerHTML;
    var cantidad = a.getElementsByTagName("td")[1].getElementsByTagName("P")[0].innerHTML;
    var precio = a.getElementsByTagName("td")[2].getElementsByTagName("P")[0].innerHTML;
    //var total_ini= a.getElementById('total').value;

    $('#tablapqt').DataTable().destroy();
    $(this).closest('tr').remove();
    $('#tablapqt').DataTable().draw();

    let total_ini = parseFloat(document.getElementById('total').value);
     let sub_restar = cantidad * precio;
     let total_ac =  total_ini - sub_restar;
     $("#total").val(total_ac);


})
document.getElementById('buscar').addEventListener('keyup', () => {

    if (document.getElementById('buscar').value == "") {
        limpiarCampos("limpiartodo");
    }
})
//--------- FUNCIÓN PARA VALIDAR NO INGRESAR NÚMEROS NEGATIVOS EN EL PRECIO ----------//
document.getElementById('precio').addEventListener('keyup', () => {
    if (!document.getElementById('precio').value == "") {
        let precio = parseFloat(document.getElementById('precio').value);
        if (precio < 0) {
            Error("Ingrese un valor positivo en el precio");
        }
    } 
})
/* FUNCION PARA BORRAR DATOS CUANDO NO SE ESTE ESCRIBIBIENDO EN EL INPUT DE BUSCAR PRODUCTO */
document.getElementById('buscar').addEventListener('keyup', () => {

    if (document.getElementById('buscar').value == "") {
        limpiarCampos("limpiartodo");
    }
})
//---------- Notificaciones ---------//
function notificarError(mensaje) {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: mensaje
    })
}
function notificacionExitosa(mensaje) {
    Swal.fire(
        mensaje,
        '',
        'success'
    ).then(result => {
        form_agregar_paquete.reset();
        $('#nuevo_paquete').modal('hide');	
        document.getElementById('cerrar').click();
        document.getElementById('cerrarEditar').click();
    });
}
/* FUNCION DE MENSAJE DE ERROR*/
function Error(mensaje) {
    Swal.fire({
        position: 'center',
        icon: 'warning',
        title: mensaje,
        showConfirmButton: false,
        timer: 3000
    })
}
function limpiarCampos(mensaje) {
    if (mensaje == 'limpiartodo') {
        //form_datos_paquete.reset();
        document.getElementById('precio').value = "";
        document.getElementById('cantidad').value = "";
        document.getElementById('buscar').value = "";
        document.getElementById('nombre_producto').value = "";
    }
}
/*if (mensaje == "limpiarventa") {
    
    document.getElementById('subtotal').value = "";
    document.getElementById('total').value = "";
    
    $("#tablapqt").DataTable().clear().draw();
    $("#tablapqt").DataTable().destroy();
    $('#tablapqt').DataTable().draw();

    //--- VARIABLES DE PAQUETE//
    cantidad_editar = "";
    precio_editar = "";
}*/

// --------- Limpiar campos del formulario para agregar paquete -----------//
/*document.getElementById('alta_paquete').addEventListener('click', () => {
    form_agregar_paquete.reset();
})*/




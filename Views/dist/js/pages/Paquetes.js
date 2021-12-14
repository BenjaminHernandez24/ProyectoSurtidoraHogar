const form_datos_paquete = document.getElementById('frmDatosPaquete');
const form_editar_paquete = document.getElementById('frm_editar_paquete');
const form_agregar_paquete =document.getElementById('frmDetallePaquete')

var tabla_paquete;
var id_paquete;
var cantidad_editar;
var precio_editar;
var cont=0;

//---------- Función para llenar Tabla  de Productos. ---------//
/*async function tab_Productos() {
    tabla_paquete = $("#TablaPaquetes").DataTable({
        "responsive": true,
        "autoWidth": false,
        "ajax": {
            "url": "../Controllers/PaqueteController.php",
            "type": "POST",
            "data": {
                "obtener_paquete": "OK"
            },
           
            "dataSrc": ""
        },
        "columns": [
            {"data": "nombre_paquete"},
            {"data": "num_piezas"},
            {"data": "subtotal"},
            {"defaultContent": "<button class='btn btn-success btn-sm btnVerStatus'>Ver</button>"},
            {
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-danger btn-sm btnBorrar'><i class='fas fa-trash-alt'></i></button></div></div>"
              
            }
        ]
    });
}

tab_Productos();
*/

//---------------BUSQUEDA DE AUTOCOMPLETADO DE LOS PRODUCTOS ----------------//
//Si encuentra el producto, llena el nombre del producto y el precio automáticamente//
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
                        $("#precio").val(datos.precio);
                    
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

    if(total_art < 2){
        notificarError('Agregue más productos al paquete');
    }else{
        notificacionExitosa('¡Paquete armado! (' + total_art + '  Articulos)');
        document.getElementById('nom_paquete').disabled = false; 
        document.getElementById('nom_paquete').value = "";
    }   
}) //Cierra función agregar paquete

//------------- LISTA DE PAQUETES (TABLA)  -----------//
form_datos_paquete.addEventListener('submit', async function(e) {
    e.preventDefault();
    let nombre_paquete = document.getElementById('nom_paquete').value;
    let producto = document.getElementById('nombre_producto').value;
    let cantidad = parseFloat(document.getElementById('cantidad').value);
    let precio = parseFloat(document.getElementById('precio').value);
    let subtotal = precio * cantidad;
    var i = 0;
    try {
        
            if (cantidad < 0 || precio < 0 || producto == "" || cantidad == "" || $.trim(nombre_paquete).length == 0) {
                Error("Error en campo(s) o Falta nombre de paquete");
            } else {
               
                document.getElementById('nom_paquete').disabled = true;
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

                if (document.getElementById('subtotal').value == "") {
                    $("#subtotal").val(subtotal.toFixed(2));
                    $("#total").val(subtotal.toFixed(2));
                } else {
                    let total = parseFloat(document.getElementById('subtotal').value);
                    let suma_total = total + subtotal;
                    $("#total").val(suma_total.toFixed(2));
                    $("#subtotal").val(suma_total.toFixed(2));
                }   
                
               try {
                var DatosProductoPqt = new FormData();
                DatosProductoPqt.append('agregar_producto', 'OK');
                DatosProductoPqt.append('nombre_producto', producto);
                DatosProductoPqt.append('nom_paquete', nombre_paquete);
                DatosProductoPqt.append('cantidad', cantidad);
                DatosProductoPqt.append('subtotal', subtotal);
                var peticion = await fetch('../Controllers/PaqueteController.php', {
                    method: 'POST',
                    body: DatosProductoPqt
                });
            } catch (error) {
                notificarError("Ocurrio un Error");
            }
            limpiarCampos("limpiartodo");
        }//cierre de else (pintar tabla)
    } catch (error) {
        notificarError("No se ha podido agregar los productos");
    }

});

//---------------- FUNCION PARA  EDITAR LOS VALORES DEL PAQUETE-----------//
$('#tablapqt').on("click", ".btnEditar", async function() {
    fila_editar = this.parentNode.parentNode;

    //Obtenemos valores de la fila de la tablita a editar
    cantidad_editar = fila_editar.getElementsByTagName("td")[1].getElementsByTagName("P")[0].innerHTML;
    precio_editar = fila_editar.getElementsByTagName("td")[2].getElementsByTagName("P")[0].innerHTML;
    total_editar = fila_editar.getElementsByTagName("td")[3].getElementsByTagName("P")[0].innerHTML;
    valor_guardar = total_editar;

    //En el modal mostramos los datos de la fila seleccionada.
    $("#cantidadEditar").val(cantidad_editar);
    $("#total_editar").val(total_editar);

    $('#editar_cantidad_precio').modal('show');
});

//---------------- MODAL EDITAR CANTIDAD DE PRODUCTO A PAQUETE --------------//
form_editar_paquete.addEventListener('submit', async function(e) {
    e.preventDefault();

    //Obtenemos los valores de los campos del modal
    var cantidad = parseFloat(document.getElementById("cantidadEditar").value);
    var total_editar = parseFloat(document.getElementById("total_editar").value);

    //Añadimos los valores correspondiente, a la fila correspondiente
    fila_editar.getElementsByTagName("td")[1].getElementsByTagName("P")[0].innerHTML = cantidad;
    fila_editar.getElementsByTagName("td")[3].getElementsByTagName("P")[0].innerHTML = total_editar;

    //Obtenemos el subtotal que hay actualmente.
    let total = parseFloat(document.getElementById('subtotal').value);

    //Si la cantidad fué mayor se suma el resto de lo contrario el resto, se resta.
    if((valor_guardar - total_editar) < 0){
        total += (total_editar - valor_guardar);
    }else{
        total -= (valor_guardar - total_editar); 
    }

    //Asignamos valores a subtotal y total
    $("#total").val(total.toFixed(2));
    $("#subtotal").val(total.toFixed(2));

    //Escondemos el modal
    $('#editar_cantidad_precio').modal('hide');
});

//-- FUNCIÓN PARA EDITAR EN TIEMPO REAL EL TOTAL DE ACUERDO A LA CANTIDAD QUE SE MODIFIQUE --//
document.getElementById('cantidadEditar').addEventListener('keyup', () => {
    var cantidad = document.getElementById("cantidadEditar").value;
    var subtotal_editar = cantidad*precio_editar;
    $("#total_editar").val(subtotal_editar);
});

//----------- FUNCION PARA ELIMINAR PRODUCTO DE LA LISTA DE PAQUETE ----------//
$('#tablapqt').on('click', '.btnBorrar', async function() {
    var a = this.parentNode.parentNode;

    //Obtener valores necesarios para restar del subtotal y total
    var cantidad = a.getElementsByTagName("td")[1].getElementsByTagName("P")[0].innerHTML;
    var precio = a.getElementsByTagName("td")[2].getElementsByTagName("P")[0].innerHTML;

    total = parseFloat(document.getElementById('subtotal').value);
    total = total - (cantidad*precio);
    $("#subtotal").val(total.toFixed(2));
    $("#total").val(total.toFixed(2));

    //Verificamos que la tablita no esté vacía
    var cont = $('#tablapqt tr').length;
    var total_art = cont-2 ;

    //Si está vacía, permitimos modificar el nombre del paquete
    if(total_art < 1){
        document.getElementById('nom_paquete').disabled = false;
    }

    $('#tablapqt').DataTable().destroy();
    $(this).closest('tr').remove();
    $('#tablapqt').DataTable().draw();
});

document.getElementById('buscar').addEventListener('keyup', () => {
    if (document.getElementById('buscar').value == "") {
        limpiarCampos("limpiartodo");
    }
});

//--------- FUNCIÓN PARA VALIDAR NO INGRESAR NÚMEROS NEGATIVOS EN EL PRECIO ----------//
document.getElementById('precio').addEventListener('keyup', () => {
    if (!document.getElementById('precio').value == "") {
        let precio = parseFloat(document.getElementById('precio').value);
        if (precio < 0) {
            Error("Ingrese un valor positivo en el precio");
        }
    } 
});

/* FUNCION PARA BORRAR DATOS CUANDO NO SE ESTE ESCRIBIBIENDO EN EL INPUT DE BUSCAR PRODUCTO */
document.getElementById('buscar').addEventListener('keyup', () => {

    if (document.getElementById('buscar').value == "") {
        limpiarCampos("limpiartodo");
    }
});

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

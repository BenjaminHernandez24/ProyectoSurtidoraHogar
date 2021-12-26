const form_datos_paquete = document.getElementById('frmDatosPaquete');
const form_editar_paquete = document.getElementById('frm_editar_paquete');
const form_agregar_paquete = document.getElementById('frmDetallePaquete');

var id_paquete;
var cantidad_editar;
var precio_editar;
var cont = 0;

///------- EVENTO PARA MANDAR LOS DATOS A LA BASE DE DATOS ------//
form_agregar_paquete.addEventListener('submit', async function (e) {
    e.preventDefault();
    let nombre_paquete = document.getElementById('nom_paquete').value;
    let selectTipoPaquete = document.getElementById('tipo_paquete').value;
    let selectMarcaPaquete = document.getElementById('marca_paquete').value;
    var cont = $('#tablapqt tr').length;
    var total_art = cont - 1;

     /*Datos tabla*/
     var valorestabla = document.getElementById("tablapqt").getElementsByTagName("p");
     var valor_probar = valorestabla[2].innerHTML;
    
    if (total_art < 2 && valor_probar < 2 ) {
        notificarError('Agregue más productos al paquete');
    } else if(nombre_paquete.trim() == 0 || selectTipoPaquete == "default" || selectMarcaPaquete == "default"){
        notificarError('Verifique que haya agregado un nombre y seleccionado un tipo y marca producto.');
    }else {
        /*Datos tabla*/
        var filastabla = document.getElementById("tablapqt").getElementsByTagName('tr');
        var columnastabla = document.getElementById("tablapqt").getElementsByTagName('th');

        var lista = {};
        var lista1 = new Array();
        var lista2 = new Array();

        var k = 0;
        let crearPaquete = new FormData();
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
                "id_Producto": lista[0],
                "Cantidad": lista[2],
            };

            lista2 = JSON.stringify(lista1);
        }
    
        let total_paquete = document.getElementById('total').value;
        nombre_paquete = document.getElementById('nom_paquete').value;
        selectTipoPaquete = document.getElementById('tipo_paquete').value;
        selectMarcaPaquete = document.getElementById('marca_paquete').value;

        var DatosProductoPqt = new FormData();
        DatosProductoPqt.append('agregar_producto', 'OK');
        DatosProductoPqt.append('nom_paquete', nombre_paquete);
        DatosProductoPqt.append('datos', lista2);
        DatosProductoPqt.append('tipo_paquete', selectTipoPaquete);
        DatosProductoPqt.append('marca_paquete', selectMarcaPaquete);
        DatosProductoPqt.append('total', total_paquete);
        peticion = await fetch('../Controllers/PaqueteController.php', {
            method: 'POST',
            body: DatosProductoPqt
        });

        respuesta = await peticion.json();
        if (respuesta == "OK") {
            if(total_art > 1){
                notificacionExitosa('¡Paquete armado! (' + total_art + '  Articulos)');
            }else{
                notificacionExitosa('¡Paquete armado! (' + total_art + '  Articulo)');
            }
            document.getElementById('nom_paquete').value = "";
            $("#tablapqt").DataTable().clear().draw();
            $("#tablapqt").DataTable().destroy();
            $('#tablapqt').DataTable().draw();
        } else if(respuesta == "existe"){
            notificarError("El nombre del paquete ya existe");
        }else{
            notificarError("Ocurrió un Error, paquete no creado!");
        }
    }
});

//------------- LISTA DE PAQUETES (TABLA)  -----------//
form_datos_paquete.addEventListener('submit', async function (e) {
    e.preventDefault();
    let producto = document.getElementById('nombre_producto').value;
    let cantidad = parseFloat(document.getElementById('cantidad').value);
    let precio = parseFloat(document.getElementById('precio').value);
    let subtotal = precio * cantidad;
    var i = 0;
    try {
        try {
            //Obtener ID del producto seleccionado
            var obtenerID = new FormData();
            obtenerID.append('obtenerID', 'OK');
            obtenerID.append('nombre', producto);
            peticion = await fetch('../Controllers/PaqueteController.php', {
                method: 'POST',
                body: obtenerID
            });

            var respuesta = await peticion.json();

            if (respuesta == 0) {
                notificarError("Producto no existente");
            } else {
                
                $('#tablapqt').DataTable().destroy();
                $('#tablapqt').find('tbody').append(`<tr id="">
                
                    <td class="row-index">
                     <p>${respuesta}</p>
                     </td>
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
            }
            limpiarCampos("limpiartodo");
        } catch (error) {
            notificarError("Ocurrio un Error");
        }
        //cierre de else (pintar tabla)
    } catch (error) {
        notificarError("No se ha podido agregar los productos");
    }
});

//---------------- FUNCION PARA  EDITAR LOS VALORES DEL PAQUETE-----------//
$('#tablapqt').on("click", ".btnEditar", async function () {
    fila_editar = this.parentNode.parentNode;

    //Obtenemos valores de la fila de la tablita a editar
    cantidad_editar = fila_editar.getElementsByTagName("td")[2].getElementsByTagName("P")[0].innerHTML;
    precio_editar = fila_editar.getElementsByTagName("td")[3].getElementsByTagName("P")[0].innerHTML;
    total_editar = fila_editar.getElementsByTagName("td")[4].getElementsByTagName("P")[0].innerHTML;
    valor_guardar = total_editar;

    //En el modal mostramos los datos de la fila seleccionada.
    $("#cantidadEditar").val(cantidad_editar);
    $("#total_editar").val(total_editar);

    $('#editar_cantidad_precio').modal('show');
});

//---------------- MODAL EDITAR CANTIDAD DE PRODUCTO A PAQUETE --------------//
form_editar_paquete.addEventListener('submit', async function (e) {
    e.preventDefault();

    //Obtenemos los valores de los campos del modal
    var cantidad = parseFloat(document.getElementById("cantidadEditar").value);
    var total_editar = parseFloat(document.getElementById("total_editar").value);

    //Añadimos los valores correspondiente, a la fila correspondiente
    fila_editar.getElementsByTagName("td")[2].getElementsByTagName("P")[0].innerHTML = cantidad;
    fila_editar.getElementsByTagName("td")[4].getElementsByTagName("P")[0].innerHTML = total_editar;

    //Obtenemos el subtotal que hay actualmente.
    var total = parseFloat(document.getElementById('subtotal').value);

    //Si la cantidad fué mayor se suma el resto de lo contrario el resto, se resta.
    if ((valor_guardar - total_editar) < 0) {
        total += (total_editar - valor_guardar);
    } else {
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
    var subtotal_editar = cantidad * precio_editar;
    $("#total_editar").val(subtotal_editar);
});

//----------- FUNCION PARA ELIMINAR PRODUCTO DE LA LISTA DE PAQUETE ----------//
$('#tablapqt').on('click', '.btnBorrar', async function () {
    var a = this.parentNode.parentNode;
    var total = 0;

    //Obtener valores necesarios para restar del subtotal y total
    var cantidad = a.getElementsByTagName("td")[2].getElementsByTagName("P")[0].innerHTML;
    var precio = a.getElementsByTagName("td")[3].getElementsByTagName("P")[0].innerHTML;

    total = parseFloat(document.getElementById('subtotal').value);
    total = total - (cantidad * precio);
    $("#subtotal").val(total.toFixed(2));
    $("#total").val(total.toFixed(2));

    //Verificamos que la tablita no esté vacía
    var cont = $('#tablapqt tr').length;
    var total_art = cont - 2;

    $('#tablapqt').DataTable().destroy();
    $(this).closest('tr').remove();
    $('#tablapqt').DataTable().draw();
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
        //document.getElementById('cerrar').click();
        document.getElementById('cerrarEditar').click();
    });
}

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
            source: data.productos,
            select: async function (event, item) {
                try {
                    $("#nombre_producto").val(item.item.value);
                    let indice = data.productos.indexOf(item.item.value);
                    $("#precio").val(data.precio[indice]);

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
async function llenar_Tipo_Producto() {
    try {

        var datosProducto = new FormData();
        datosProducto.append('obtener_tipo_paquete', 'OK');

        var peticion = await fetch('../controllers/PaqueteController.php', {
            method: 'POST',
            body: datosProducto
        });

        var resjson = await peticion.json();

        var selectTipoProducto = document.getElementById('tipo_paquete');

        for (item of resjson) {
            let option_r = document.createElement('option');
            option_r.value = item.descripcion_tipo;
            option_r.text = item.descripcion_tipo;
            selectTipoProducto.appendChild(option_r);

        }

    } catch (error) {
        notificarError(error);
    }
}
llenar_Tipo_Producto();

//---------- FUNCION PARA LLENAR SELECT DE MARCA PAQUETE ---------//
async function llenar_Marca_Producto(numero) {
    try {

        var datosProducto = new FormData();
        datosProducto.append('obtener_marca_paquete', 'OK');

        var peticion = await fetch('../controllers/PaqueteController.php', {
            method: 'POST',
            body: datosProducto
        });

        var resjson = await peticion.json();

        var selectMarcaProducto = document.getElementById('marca_paquete');

        for (item of resjson) {
            let optionM1 = document.createElement('option');
            optionM1.value = item.descripcion_marca;
            optionM1.text = item.descripcion_marca;
            selectMarcaProducto.appendChild(optionM1);

        }

    } catch (error) {
        notificarError(error);
    }
}
llenar_Marca_Producto();

/* FUNCION PARA BORRAR DATOS CUANDO NO SE ESTE ESCRIBIBIENDO EN EL INPUT DE BUSCAR PRODUCTO */
document.getElementById('buscar').addEventListener('keyup', () => {
    if (document.getElementById('buscar').value == "") {
        limpiarCampos("limpiartodo");
    }
});

function limpiarCampos(mensaje) {
    if (mensaje == 'limpiartodo') {
        //form_datos_paquete.reset();
        document.getElementById('precio').value = "";
        document.getElementById('cantidad').value = "";
        document.getElementById('buscar').value = "";
        document.getElementById('nombre_producto').value = "";
    }
}
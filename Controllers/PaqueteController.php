<?php
    require_once "../Models/PaquetesModel.php";
    require_once "../Models/ValidacionesProductos/ValidacionProducto.php";

    //---------- Agregar Producto -------//
    if (isset($_POST['agregar_producto'])) {
        //¿Existe otro producto o paquete con el mismo nombre?
        $valor = [
            "nombre_producto" => $_POST['nom_paquete']
        ];
        $respuesta = ValidacionProducto::ValidarProductoEditar($valor);

        if ($respuesta == true) {
            $respuesta = "existe";
        } else {
            $posiciones = 0;
            $data = json_decode($_POST['datos'], true);
            $posiciones = count($data);
            $respuesta = PaqueteModelo::agregar_productos(
                $_POST['nom_paquete'],
                $data,
                $posiciones,
                $_POST['tipo_paquete'],
                $_POST['marca_paquete'],
                $_POST['total']);
        }
         echo json_encode($respuesta);
     }

    //---------- Obtener Tipo Paquete -------//
    if (isset($_POST['obtener_tipo_paquete'])) {
        $tipo = PaqueteModelo::obtener_tipo_paquetes();
        echo json_encode($tipo);
    }

    //Obtener el id de los productos que se van agregando a la tabla
    if (isset($_POST['obtenerID'])) {
        $respuesta = PaqueteModelo::obtenerID($_POST['nombre']);
        echo json_encode($respuesta);
    }

    //---------- Obtener Marca Paquete -------//
    if (isset($_POST['obtener_marca_paquete'])) {
        $marca = PaqueteModelo::obtener_marca_paquetes();
        echo json_encode($marca);
    }

    //---- Funciones para autocompletado de Productos ------//
    if (isset($_POST['obtenerProductos'])) {
        $data = PaqueteModelo::obtenerProductos();
        for ($i = 0; $i < sizeof($data); $i++) {
            $productos[]    = $data[$i]['nombre_producto'];
            $valor[]        = $data[$i]['precio_publico'];
        }
        $respuesta = [
            "productos" => $productos,
            "precio" => $valor
        ];
        echo json_encode($respuesta);
    }

    //---------------------- PAQUETE EDITAR --------------------//
    
    //---------- Obtener Paquete -------//
    if (isset($_POST['obtener_paquete'])) {
        $data = PaqueteModelo::obtener_paquetes();
        echo json_encode($data);
    }
    //---------- Eliminar Paquete -------//
    if (isset($_POST['eliminar_paquete'])) {
        $respuesta = PaqueteModelo::eliminar_paquete($_POST['id_paquete']);
        echo json_encode(['respuesta' => $respuesta]);
    }
    
    //Activar paquete
    if (isset($_POST['activarPaquete'])) {

        $Paquete = array(
            "id_producto"  => $_POST['idPaquete'],
            "estatus" => 1,
        );

        $respuesta = PaqueteModelo::Estatus($Paquete);
        echo json_encode(['respuesta' => $respuesta]);
    }

    //Desactivar paquete
    if (isset($_POST['desactivarPaquete'])) {

        $Paquete = array(
            "id_producto"  => $_POST['idPaquete'],
            "estatus" => 0,
        );

        $respuesta = PaqueteModelo::Estatus($Paquete);
        echo json_encode(['respuesta' => $respuesta]);
    }

    //Preparar la tabla de paquetes para editar
    if(isset($_POST['crearTabla'])){
        $respuesta = PaqueteModelo::extraerDatosTablaEditar($_POST['nombre_paquete']);
        echo json_encode($respuesta);
    }
?>
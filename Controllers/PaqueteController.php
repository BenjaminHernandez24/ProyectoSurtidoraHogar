<?php
    require_once "../Models/PaquetesModel.php";

    //---------- Agregar Producto -------//
    if (isset($_POST['agregar_producto'])) {
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
        }
        echo json_encode($productos);
    }

    if (isset($_POST['obtener_lista_productos'])) {
        $data = PaqueteModelo::obtener_lista_productos($_POST['valor']);
        for ($i = 0; $i < sizeof($data); $i++) {
            $productos[]    = $data[$i]['nombre_producto'];
            $precio_unitario = $data[$i]['precio_publico'];
        }
        $respuesta = [
            "productos" => $productos,
            "precio" => $precio_unitario,
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
?>
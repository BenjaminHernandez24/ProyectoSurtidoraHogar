<?php
require_once "../Models/PaquetesModel.php";

//---------- Agregar Producto -------//
if (isset($_POST['agregar_producto'])) {
    
   $respuesta = PaqueteModelo::agregar_productos($_POST['nombre_producto'], $_POST['cantidad'],$_POST['subtotal']);
    echo json_encode($respuesta);
}

//---------- Obtener Tipo Paquete -------//
if (isset($_POST['obtener_tipo_paquete'])) {

    $tipo = PaqueteModelo::obtener_tipo_paquetes();
    echo json_encode($tipo);
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
    }

    $respuesta = [
        "productos" => $productos,
    ];
    echo json_encode($respuesta);
}
//---- Funciones para agregar paquete  ------//
if (isset($_POST['agregar_producto'])) {
    
    $Paquete = array(
        "nombre_producto" => $_POST['nombre_producto'],

    );
    $respuesta = PaqueteModelo::agregar_paquetes($Paquete);
    echo json_encode(['respuesta' => $respuesta]); 
}


?>
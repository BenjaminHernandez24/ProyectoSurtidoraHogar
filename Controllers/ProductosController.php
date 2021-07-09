<?php
require_once "../Models/ProductosModel.php";

//---------- Agregar Producto -------//
if (isset($_POST['agregar_producto'])) {
    if ( 
          preg_match('/^[0-9]+$/', $_POST['precio_pub'])
       ) {
    $Producto = array(
    
        "nombre_producto" => $_POST['nom_producto'], //Variables de input (name) //
        "id_tipo" => $_POST['tipo_producto'],
        "id_marca" => $_POST['marca_producto'], 
        "precio_publico" => $_POST['precio_pub'], 
    );
    $respuesta = ProductoModelo::agregar_productos($Producto);
    echo json_encode(['respuesta' => $respuesta]);
   } else {
    echo json_encode(['respuesta' => 'Error de escritura en los campos.']);
   }
}
//---------- Editar Producto -------//
if (isset($_POST['editar_producto'])) {
    if ( 
          preg_match('/^[0-9]+$/', $_POST['precio_pub_editar'])
       ) {
    $producto_editar = array(
        "id_producto" => $_POST['id_producto'],
        "nombre_producto" => $_POST['nom_producto_editar'], //Variables de input (name) //
        "id_tipo" => $_POST['tipo_producto_editar'],
        "id_marca" => $_POST['marca_producto_editar'], 
        "precio_publico" => $_POST['precio_pub_editar'], 

    );
    $respuesta = ProductoModelo::editar_productos($producto_editar);
    echo json_encode(['respuesta' => $respuesta]);
} else {
    echo json_encode(['respuesta' => 'Error de escritura en los campos.']);
   }
}

//---------- Eliminar Producto -------//
if (isset($_POST['eliminar_producto'])) {

    $respuesta = ProductoModelo::eliminar_producto($_POST['id_producto']);
    echo json_encode(['respuesta' => $respuesta]);
}

//---------- Obtener  Producto -------//
if (isset($_POST['obtener_producto'])) {

    $data = ProductoModelo::obtener_productos();
    echo json_encode($data);
}
//---------- Obtener Tipo Producto -------//
if (isset($_POST['obtener_tipo_producto'])) {

    $tipo = ProductoModelo::obtener_tipo_productos();
    echo json_encode($tipo);
}
//---------- Obtener Marca Producto -------//
if (isset($_POST['obtener_marca_producto'])) {

    $marca = ProductoModelo::obtener_marca_productos();
    echo json_encode($marca);
}
if (isset($_POST['obtener_id'])) {

    $id = ProductoModelo::obtener_id_producto($_POST['id_producto']);
    echo json_encode($id);
}
?>
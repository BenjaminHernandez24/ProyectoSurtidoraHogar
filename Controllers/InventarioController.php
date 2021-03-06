<?php
require_once "../Models/InventarioModel.php";
require_once "../Models/ValidacionesInventario/ValidacionInventario.php";

if (isset($_POST['obtener_inventario'])) {

$inventario = InventarioModelo::obtener_inventario_producto();
echo json_encode($inventario,JSON_UNESCAPED_UNICODE);
}
//---------- Agregar Producto en Inventario -------//
if (isset($_POST['agregar_producto_inv'])) {
    if ( 
          
          preg_match('/^[0-9]+$/', $_POST['estatus_alert']) &&
          preg_match('/^[0-9]+$/', $_POST['stock']) 
       ) {
    $Producto_Inv = array(
    
        //"id_producto" => $_POST['producto'], //Variables de input (name) //
        "estatus_alerta" => $_POST['estatus_alert'], 
        "stock" => $_POST['stock'],
        
    );
    $respuesta = InventarioModelo::agregar_producto_inventario($Producto_Inv, $_POST['nombre_producto']);
    echo json_encode(['respuesta' => $respuesta]);
   } else {
    echo json_encode(['respuesta' => 'Error de escritura en los campos.']);
   }
}
//---------- Obtener  Producto -------//
if (isset($_POST['obtener_producto'])) {

    $data = InventarioModelo::obtener_productos();
    echo json_encode($data);
}
//---------- Editar Producto en Inventario -------//
if (isset($_POST['editar_producto_inv'])) {
    if ( 
        preg_match('/^[0-9]+$/', $_POST['estatus_alert_editar']) &&
        preg_match('/^[0-9]+$/', $_POST['stock_editar'])
       ) {
    $producto_editar = array(
        "id_inventario" => $_POST['id_inventario'],
        "id_producto" => $_POST['producto_editar'], //Variables de input (name) //
        "estatus_alerta" => $_POST['estatus_alert_editar'],
        "stock" => $_POST['stock_editar'], 

    );
    
    $respuesta = InventarioModelo::editar_productos_inventario($producto_editar);

    echo json_encode(['respuesta' => $respuesta]);
} else {
    echo json_encode(['respuesta' => 'Error de escritura en los campos.']);
   }
}
if (isset($_POST['eliminar_producto_inv'])) {

    $respuesta = InventarioModelo::eliminar_producto_inventario($_POST['id_inventario']);
    echo json_encode(['respuesta' => $respuesta]);
}
if (isset($_POST['obtener_estatus'])) {

    $respuesta = InventarioModelo::obtener_estatus($_POST['id_inventario']);
    echo json_encode(['respuesta' => $respuesta]);
}

if (isset($_POST['obtener_alert'])) {

    
    $estatus = InventarioModelo::obtener_alert($_POST['id_inventario']);
    $respuesta = [];
    $respuesta = 
    [
        "estatus_alerta" => $estatus[0]["estatus_alerta"],
        
    ];
    
    echo json_encode(['respuesta' => $respuesta]);
    }

    //---- Funciones para autocompletado de Productos ------//
if (isset($_POST['obtenerProductos'])) {
    $data = InventarioModelo::obtenerProductos();
    for ($i = 0; $i < sizeof($data); $i++) {
        $productos[]    = $data[$i]['nombre_producto'];
    }
    echo json_encode($productos);
}

if (isset($_POST['obtener_lista_productos'])) {
    $data = InventarioModelo::obtener_lista_productos($_POST['valor']);
    for ($i = 0; $i < sizeof($data); $i++) {
        $productos[]    = $data[$i]['nombre_producto'];
    }

    $respuesta = [
        "productos" => $productos,
    ];
    echo json_encode($respuesta);
}


?>
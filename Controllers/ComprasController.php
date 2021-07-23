<?php
require_once "../Models/ComprasModel.php";
//---------- Obtener datos de Compras  -------//

if (isset($_POST['obtener_compras'])) {

$compras = ComprasModelo::obtener_compras_inv();
echo json_encode($compras);
}
//---------- Obtener datos de Productos registrados en inventario  -------//

if (isset($_POST['obtener_productos_inv'])) {

$productos = ComprasModelo::obtener_productos_inventario();
echo json_encode($productos);
}
//---------- Obtener proveedores-------//

if (isset($_POST['obtener_proveedor'])) {

    $proveedores = ComprasModelo::obtener_proveedores();
    echo json_encode($proveedores);
    }
//---------- Agregar Producto en Inventario -------//
if (isset($_POST['agregar_compra'])) {
    if ( 
          preg_match('/^[0-9]+$/', $_POST['piezas']) 
         
       ) {
    $Compra = array(
        
        "id_prov" => $_POST['proveedor_registro'], //Variables de input (name) //
        "id_producto" => $_POST['producto_registro'],
        "num_piezas" => $_POST['piezas'],
        "precio_unitario" => $_POST['precio_unit'], 
        
    );
    $respuesta = ComprasModelo::agregar_compras($Compra);
    echo json_encode(['respuesta' => $respuesta]);
   } else {
    echo json_encode(['respuesta' => 'Error de escritura en los campos.']);
   }
}
//---------- Editar Compra -------//
if (isset($_POST['editar_compra'])) {
    if ( 
        preg_match('/^[0-9]+$/', $_POST['piezas_editar']) 
       ) {
    $Compra_editar = array(
        "id_entrada_compra" => $_POST['id_entrada_compra'],
        "id_prov" => $_POST['proveedor_editar'], //Variables de input (name) //
        "id_producto" => $_POST['producto_editar'],
        "num_piezas" => $_POST['piezas_editar'],
        "precio_unitario" => $_POST['precio_unit_editar'], 

    );
    $respuesta = ComprasModelo::editar_compras($Compra_editar);
    echo json_encode(['respuesta' => $respuesta]);
} else {
    echo json_encode(['respuesta' => 'Error de escritura en los campos.']);
   }
}
//---------- Editar Compra -------//
if (isset($_POST['eliminar_compra'])) {
    $respuesta = ComprasModelo::eliminar_compras($_POST['id_entrada_compra']);
    echo json_encode(['respuesta' => $respuesta]);
}

?>
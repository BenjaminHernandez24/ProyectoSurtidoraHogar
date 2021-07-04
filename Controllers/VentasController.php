<?php
require_once "../Models/VentasModel.php";

/* OBTENEMOS A TODO LOS CLIENTES() */
if (isset($_POST['getClientes'])) {

    $data = VentasModelo::getClientes();
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}

if (isset($_POST['obtenerProductos'])) {
    $data = VentasModelo::obtenerProductos();
    for ($i = 0; $i < sizeof($data); $i++) {
        $productos[]    = $data[$i]['nombre_producto'];
    }
    echo json_encode($productos);
}

if (isset($_POST['obtenerDatosProductos'])) {
    $data = VentasModelo::obtenerDatosProductos($_POST['valor']);
    for ($i = 0; $i < sizeof($data); $i++) {
        $productos[]    = $data[$i]['nombre_producto'];
        $stock[]    = $data[$i]['stock'];
        $precio[]    = $data[$i]['precio_publico'];
    }

    $respuesta = [
        "productos" => $productos,
        "stock"    => $stock,
        "precio"    => $precio,
    ];
    echo json_encode($respuesta);
}

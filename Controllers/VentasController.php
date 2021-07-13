<?php
require_once "../Models/VentasModel.php";

if (isset($_POST['AgregarSalidaVenta'])) {
    $data = json_decode($_POST['datos'], true);
    $respuesta = VentasModelo::AgregarSalidaVenta($data);
    echo json_encode(['respuesta' => $respuesta]);
}

if (isset($_POST['AgregarDetalleSalidaVenta'])) {
    $venta = array(
        "cliente" => $_POST['cliente'],
        "pago"       => $_POST['pago'],
        "total"   => $_POST['total'],
        "cobro"       => $_POST['cobro'],
        "cambio"   => $_POST['cambio'],
    );
    $respuesta = VentasModelo::AgregarDetalleSalidaVenta($venta);
    echo json_encode(['respuesta' => $respuesta]);
}

/* REDIRECCIÓN AL MÉTODO AgregarClientes() */
if (isset($_POST['AgregarCliente'])) {

    $Cliente = array(
        "nombre_cli" => $_POST['nombre'],
        "tipo"       => $_POST['tipo'],
        "telefono"   => $_POST['telefono'],
    );

    $respuesta = ValidacionCliente::ValidarClienteNombre($Cliente);

    if ($respuesta == false) {
        $respuesta = VentasModelo::AgregarCliente($Cliente);
    } else {
        $respuesta = "existe";
    }

    echo json_encode(['respuesta' => $respuesta]);
}

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

if (isset($_POST['ExtraerStock'])) {
    $data = VentasModelo::obtenerStock($_POST['idInventario']);
    echo json_encode($data);
}

if (isset($_POST['restarInventario'])) {
    $respuesta = VentasModelo::restarInventario($_POST['idInventario'],$_POST['cantidad']);
    echo json_encode($respuesta);
}

if (isset($_POST['sumarInventario'])) {
    $respuesta = VentasModelo::sumarInventario($_POST['idInventario'],$_POST['cantidad']);
    echo json_encode($respuesta);
}

if (isset($_POST['obtenerDatosProductos'])) {
    $data = VentasModelo::obtenerDatosProductos($_POST['valor']);
    for ($i = 0; $i < sizeof($data); $i++) {
        $inventario[] = $data[$i]['id_inventario'];
        $productos[]    = $data[$i]['nombre_producto'];
        $stock[]    = $data[$i]['stock'];
        $precio[]    = $data[$i]['precio_publico'];
    }

    $respuesta = [
        "inventario" => $inventario,
        "productos" => $productos,
        "stock"    => $stock,
        "precio"    => $precio,
    ];
    echo json_encode($respuesta);
}

<?php
require_once "../Models/ImpresionModel.php";

/* ===========================
        ELIMINAR PROVEEDOR
     =============================*/
if (isset($_POST['obtenerimpresion'])) {

    $respuesta = ImpresionModelo::ObtenerImpresion($_POST['idVenta']);
    echo json_encode($respuesta);
}

if (isset($_POST['cambiarimpresion'])) {

    $respuesta = ImpresionModelo::CambiarImpresion($_POST['impresiones'],$_POST['idVenta']);
    echo json_encode(['respuesta' => $respuesta]);
}
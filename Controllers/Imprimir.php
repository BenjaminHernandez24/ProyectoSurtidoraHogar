<?php

//require_once "../ticket/autoload.php";
require __DIR__ . '/ticket/autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

if (isset($_POST['ImprimirTicket'])) {
    $data = json_decode($_POST['productos'], true);
    $posiciones = count($data);
    $tipo_pago = $_POST['tipo_pago'];
    $total = $_POST['total'];
    $subtotal = $_POST['subtotal'];
    $cobro = $_POST['cobro'];
    $cambio = $_POST['cambio'];

    /*NOMBRE DE LA IMPRESORA*/
    $nombre_impresora = "XP-58";

    /*ABRIMOS CONEXION*/
    $connector = new WindowsPrintConnector($nombre_impresora);
    $printer = new Printer($connector);

    /*JUSTIFICAMOS AL CENTRO*/
    $printer->setJustification(Printer::JUSTIFY_CENTER);

    /*Intentaremos cargar e imprimir el logo*/
    try {
        $logo = EscposImage::load("../Views/dist/img/LogoTicket.png", false);
        $printer->bitImage($logo);
    } catch (Exception $e) {/*No hacemos nada si hay error*/
    }

    /*Ahora vamos a imprimir un encabezado*/
    $printer->text("\n" . "La Surtidora Del Hogar" . "\n");
    $printer->text("Direccion: AV.CENTRAL NORTE  20 CENTRO" . "\n");
    $printer->text("CP. 30700 TAPACHULA,CHIAPAS" . "\n");
    $printer->text("Tel: 9621359650 y 9626285427" . "\n");
    $printer->text("DAVID SALVADOR DOMINGUEZ LOPEZ" . "\n");
    date_default_timezone_set("America/Mexico_City");
    $printer->text(date("Y-m-d H:i:s") . "\n");
    $printer->text("-----------------------------" . "\n");
    $printer->setJustification(Printer::JUSTIFY_LEFT);
    $printer->text("CANT  DESCRIPCION    P.U   IMP.\n");
    $printer->text("-----------------------------" . "\n");

    /*Ahora vamos a imprimir los productos*/
    /*Alinear a la izquierda para la cantidad y el nombre*/
    $printer->setJustification(Printer::JUSTIFY_LEFT);
    for ($i = 0; $i < $posiciones; $i++) {
        $producto = $data[$i]['Producto'];
        $cantidad = $data[$i]['Cantidad'];
        $precio = $data[$i]['Precio'];
        $total_producto = $data[$i]['Total'];
        $printer->text("$producto\n");
        $printer->text("$cantidad  pieza    $precio $total_producto   \n");
    }

    /*Terminamos de imprimir los productos, ahora va el total*/
    $printer->text("-----------------------------" . "\n");
    $printer->setJustification(Printer::JUSTIFY_RIGHT);
    if ($tipo_pago == "Efectivo") {
        $printer->text("METODO DE PAGO: $tipo_pago\n");
        $printer->text("COBRO: $cobro\n");
        $printer->text("CAMBIO: $cambio\n");
    }else if($tipo_pago == "Tarjeta Crédito"){
        $printer->text("METODO DE PAGO: Tarjeta Credito\n");
    }else{
        $printer->text("METODO DE PAGO: Tarjeta Debito\n");
    }
    $printer->text("SUBTOTAL: $subtotal\n");
    $printer->text("TOTAL: $total\n");


    /*Podemos poner también un pie de página*/
    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->text("EN PARTES ELECTRICAS\n");
    $printer->text("NO HAY GARANTIA\n");
    $printer->text("Muchas gracias por su compra\n");



    /*Alimentamos el papel 3 veces*/
    $printer->feed(3);

    /*Cortamos el papel. Si nuestra impresora no tiene soporte para ello, no generará ningún error*/
    $printer->cut();

    /*Para imprimir realmente, tenemos que "cerrar"
	la conexión con la impresora. Recuerda incluir esto al final de todos los archivos*/
    $printer->close();

    $respuesta = "OK";
    echo json_encode(['respuesta' => $respuesta]);
}

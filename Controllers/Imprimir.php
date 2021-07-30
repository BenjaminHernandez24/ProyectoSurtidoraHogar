<?php

require __DIR__ . '/ticket/autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class Imprimir
{
    public static function datosimprimir($tipo_pago, $total, $cobro, $cambio, $lista_productos, $subtotal, $folio)
    {
        $data = json_decode($lista_productos, true);
        $posiciones = count($data);

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
        $printer->text("DAVID SALVADOR DOMINGUEZ LOPEZ" . "\n");
        $printer->text("RFC: DOLD71115BV9" . "\n");
        $printer->text("Direccion: AV.CENTRAL NORTE  20 CENTRO" . "\n");
        $printer->text("CP. 30700 TAPACHULA,CHIAPAS" . "\n");
        $printer->text("Tel: 9621359650 y 9626285427" . "\n");
        $printer->text("FOLIO: $folio" . "\n");

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
            $printer->text("$cantidad  pieza            $$precio   $$total_producto   \n");
        }
        /*Terminamos de imprimir los productos, ahora va el total*/
        $printer->text("-----------------------------" . "\n");
        $printer->setJustification(Printer::JUSTIFY_RIGHT);
        if ($tipo_pago == "Efectivo") {
            $printer->text("METODO DE PAGO: $tipo_pago\n");
            $printer->text("SUBTOTAL $ $subtotal\n");
            $printer->text("TOTAL $ $total\n");
            $printer->text("EFECTIVO $ $cobro\n");
            $printer->text("CAMBIO $ $cambio\n");
        } else if ($tipo_pago == "Tarjeta Crédito") {
            $printer->text("METODO DE PAGO: Tarjeta Credito\n");
            $printer->text("SUBTOTAL $ $subtotal\n");
            $printer->text("TOTAL $ $total\n");
        } else {
            $printer->text("METODO DE PAGO: Tarjeta Debito\n");
            $printer->text("SUBTOTAL $ $subtotal\n");
            $printer->text("TOTAL $ $total\n");
        }



        /*Podemos poner también un pie de página*/
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("Este ticket forma parte de la\n");
        $printer->text("factura global del dia\n");
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
    }

    public static function tablaimprimir($data,$folio)
    {


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
        $printer->text("DAVID SALVADOR DOMINGUEZ LOPEZ" . "\n");
        $printer->text("RFC: DOLD71115BV9" . "\n");
        $printer->text("Direccion: AV.CENTRAL NORTE  20 CENTRO" . "\n");
        $printer->text("CP. 30700 TAPACHULA,CHIAPAS" . "\n");
        $printer->text("Tel: 9621359650 y 9626285427" . "\n");
        $printer->text("FOLIO: $folio" . "\n");

        date_default_timezone_set("America/Mexico_City");
        $printer->text(date("Y-m-d H:i:s") . "\n");
        $printer->text("-----------------------------" . "\n");
        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->text("CANT  DESCRIPCION    P.U   IMP.\n");
        $printer->text("-----------------------------" . "\n");

        /*Ahora vamos a imprimir los productos*/
        /*Alinear a la izquierda para la cantidad y el nombre*/
        $printer->setJustification(Printer::JUSTIFY_LEFT);
        for ($i = 0; $i < sizeof($data); $i++) {
            $producto = $data[$i]['producto'];
            $cantidad = $data[$i]['piezas'];
            $precio = $data[$i]['precio_pub'];
            $total_producto = $data[$i]['subtotal'];
            $printer->text("$producto\n");
            $printer->text("$cantidad  pieza            $$precio  $$total_producto   \n");
        }

        /*Terminamos de imprimir los productos, ahora va el total*/
        $printer->text("-----------------------------" . "\n");
        $printer->setJustification(Printer::JUSTIFY_RIGHT);
        $total_tranformado = $data[0]['total'];
        if ($data[0]['metodo_pago'] == "Efectivo") {
            $efectivo_transformado =$data[0]['pago'];
            $cambio_transformado =$data[0]['cambio'];
            $printer->text("METODO DE PAGO: Efectivo\n");
            $printer->text("TOTAL $ $total_tranformado\n");
            $printer->text("EFECTIVO $ $efectivo_transformado\n");
            $printer->text("CAMBIO $ $cambio_transformado\n");
        } else if ($data[0]['metodo_pago'] == "Tarjeta Crédito") {
            $printer->text("METODO DE PAGO: Tarjeta Credito\n");
            $printer->text("TOTAL $ $total_tranformado\n");
        } else {
            $printer->text("METODO DE PAGO: Tarjeta Debito\n");
            $printer->text("TOTAL $ $total_tranformado\n");
        }



        /*Podemos poner también un pie de página*/
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("Este ticket forma parte de la\n");
        $printer->text("factura global del dia\n");
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
    }
}
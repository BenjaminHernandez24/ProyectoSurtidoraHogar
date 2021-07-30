<?php
require_once "../Models/ImpresionModel.php";
require_once "../Controllers/Imprimir.php";

/* ===========================
        ELIMINAR PROVEEDOR
     =============================*/
if (isset($_POST['obtenerimpresion'])) {
    $respuesta = ImpresionModelo::ObtenerImpresion($_POST['idVenta']);
    if($_POST['estatus'] == "Ticket" || $_POST['estatus'] == "Ambos"){
        $data = ImpresionModelo::obtenerDatosProductos($_POST['idVenta']);
        if($data[0]['folio'] == 0){
        }else{
            Imprimir::tablaimprimir($data,$data[0]['folio']);
        }
    }
    echo json_encode($respuesta);
}

if (isset($_POST['cambiarimpresion'])) {
    if($_POST['estatus'] == "Ticket" || $_POST['estatus'] == "Ambos"){
        $consulta = ImpresionModelo::ContarVentas();
        if ($consulta['ventas'] == 0 || $consulta['contador'] == 0) {
            $folio = 80001;
        } else {
            $folio = $consulta['maximo'] + 1;
        }
    }

    $respuesta = ImpresionModelo::CambiarImpresion($_POST['impresiones'],$_POST['idVenta']);

    if($_POST['estatus'] == "Ticket" || $_POST['estatus'] == "Ambos"){
        if($respuesta == "OK"){
            ImpresionModelo::editarFolio($_POST['idVenta'],$folio);
            $data = ImpresionModelo::obtenerDatosProductos($_POST['idVenta']);
            Imprimir::tablaimprimir($data,$folio);
        }
    }
    echo json_encode(['respuesta' => $respuesta]);
}
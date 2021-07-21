<?php
require_once "../Models/reportesGraficasModel.php";

if (isset($_POST['top5Productos'])) {
    $data = reportesGraficasModel::top5ProductosModel();

    $parametros = [];
    $cadenaTemporal1 = "";
    $cadenaTemporal2 = "";
    $arregloTemporal = [];
    for ($i = 0; $i < sizeof($data); $i++) {
        $arrayPalabras = explode(" ",$data[$i]['productos']);
        
        for($k = 0; $k < sizeof($arrayPalabras); $k++){
            $cadena = str_replace(' ', '', $arrayPalabras[$k]);
            if(strlen($cadena) != 0){
                $arregloTemporal[] = $cadena;
            }
        }

        for($j=0; $j<sizeof($arregloTemporal); $j++){
            if(($j%2) == 0){
                $cadenaTemporal2 = $cadenaTemporal1." ".$arregloTemporal[$j];

                if(strlen($cadenaTemporal2) <= 12){
                    $variable[] = $cadenaTemporal1." ".$arregloTemporal[$j];
                }else{
                    if(strlen($cadenaTemporal1) != 0){
                        $variable[] = $cadenaTemporal1;
                        $variable[] = $arregloTemporal[$j];
                    }else{
                        $variable[] = $arregloTemporal[$j];
                    }
                }

            } else if(sizeof($arregloTemporal) == 1){
                $variable[] = $arregloTemporal[$j];
            }else if($j == sizeof($arrayPalabras)-1){
                $variable[] = $arregloTemporal[$j];
            }else{
                $cadenaTemporal1 = $arregloTemporal[$j]; 
            }
        }
        $parametros[] = $variable;
        $arrayPalabras = [];
        $arregloTemporal = [];
        $variable = [];
        $cadenaTemporal1 = "";
        $cadenaTemporal2 = "";
        $valores[]    = $data[$i]['piezas'];
    }

    if($parametros != NULL){
        $respuesta = [
            "parametros" => $parametros,
            "valores"    => $valores,
        ];
    }else{
        $respuesta = [
            "parametros" => "F"
        ];
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}

if (isset($_POST['obtenerProductos'])) {
    $data = reportesGraficasModel::obtenerProductos();
    $productos = [];
    for ($i = 0; $i < sizeof($data); $i++) {
        $productos[]    = $data[$i]['nombre_producto'];
    }
    if($productos == NULL){
        $productos[] = "F"; 
    }
    echo json_encode($productos);
}

if (isset($_POST['datosProveedor'])) {
    $datos = array(
        "valor" => $_POST['valor']
    );
    $data = reportesGraficasModel::obtenerProveedor($datos);

    echo json_encode($data);
}

if (isset($_POST['getComprasGeneralesRango'])) {
    $arreglo = array(
        "fecha_inicio" => $_POST['fecha_inicial'],
        "fecha_final" => $_POST['fecha_final']
    );
    $data = reportesGraficasModel::getComprasGenerales($arreglo);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}

if (isset($_POST['getComprasGeneralesUnicas'])) {
    $arreglo = array(
        "fecha" => $_POST['fecha']
    );
    $data = reportesGraficasModel::getComprasGeneralesUnicas($arreglo);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}

if (isset($_POST['obtenerProveedor'])) {
    $data = reportesGraficasModel::obtenerTodosProveedores();
    $proveedor = [];
    for ($i = 0; $i < sizeof($data); $i++) {
        $proveedor[]    = $data[$i]['nom_prov'];
    }
    if($proveedor == NULL){
        $proveedor[] = "F"; 
    }
    echo json_encode($proveedor);
}

if (isset($_POST['getComprasEspecificoRango'])) {
    $arreglo = array(
        "fecha_inicio" => $_POST['fecha_inicial'],
        "fecha_final" => $_POST['fecha_final'],
        "proveedor" => $_POST['proveedor']
    );
    $data = reportesGraficasModel::getComprasEspecificoRango($arreglo);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}

if (isset($_POST['getComprasEspecificoUnico'])) {
    $arreglo = array(
        "fecha" => $_POST['fecha'],
        "proveedor" => $_POST['proveedor']
    );
    $data = reportesGraficasModel::getComprasEspecificaUnicas($arreglo);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}

if (isset($_POST['getVentasRango'])) {
    $arreglo = array(
        "fecha_inicio" => $_POST['fecha_inicial'],
        "fecha_final" => $_POST['fecha_final']
    );
    $data = reportesGraficasModel::reporteVentasRango($arreglo);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}

if (isset($_POST['getVentasUnicas'])) {
    $arreglo = array(
        "fecha" => $_POST['fecha']
    );
    $data = reportesGraficasModel::reporteVentasUnicas($arreglo);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}

if (isset($_POST['getImpresionesRango'])) {
    $arreglo = array(
        "fecha_inicio" => $_POST['fecha_inicial'],
        "fecha_final" => $_POST['fecha_final'],
        "impresiones" => $_POST['impresion']
    );
    $data = reportesGraficasModel::reporteImpresionesRango($arreglo);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}

if (isset($_POST['getImpresionesUnicas'])) {
    $arreglo = array(
        "fecha" => $_POST['fecha'],
        "impresiones" => $_POST['impresion']
    );
    $data = reportesGraficasModel::reporteImpresionesUnicas($arreglo);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}
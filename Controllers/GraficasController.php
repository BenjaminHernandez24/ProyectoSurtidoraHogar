<?php
require_once "../Models/GraficasModel.php";

if (isset($_POST['frecuenciaClientes'])) {
    $data = GraficasModel::frecuenciaClientes();

    $parametros = [];
    for ($i = 0; $i < sizeof($data); $i++) {
        $parametros[] = $data[$i]['clientes'];
        $valores[]    = $data[$i]['frecuencia'];
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

    echo json_encode($respuesta);
}

if (isset($_POST['ventasTotalesPorMes'])) {
    $data = GraficasModel::ventasTotalesPorMes();

    $parametros = [];
    for ($i = 0; $i < sizeof($data); $i++) {
        $parametros[] = $data[$i]['mes'];
        $valores[]    = $data[$i]['ventasTotales'];
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
    echo json_encode($respuesta);
}

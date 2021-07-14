<?php
require_once "../Models/GraficasModel.php";

if (isset($_POST['frecuenciaClientes'])) {
    $data = GraficasModel::frecuenciaClientes();

    for ($i = 0; $i < sizeof($data); $i++) {
        $parametros[] = $data[$i]['clientes'];
        $valores[]    = $data[$i]['frecuencia'];
    }

    $respuesta = [
        "parametros" => $parametros,
        "valores"    => $valores,
    ];

    echo json_encode($respuesta);
}

if (isset($_POST['ventasTotalesPorMes'])) {
    $data = GraficasModel::ventasTotalesPorMes();

    for ($i = 0; $i < sizeof($data); $i++) {
        $parametros[] = $data[$i]['mes'];
        $valores[]    = $data[$i]['ventasTotales'];
    }

    $respuesta = [
        "parametros" => $parametros,
        "valores"    => $valores,
    ];

    echo json_encode($respuesta);
}

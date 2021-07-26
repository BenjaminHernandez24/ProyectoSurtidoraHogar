<?php
require_once "../Models/GraficasModel.php";

if (isset($_POST['frecuenciaClientes'])) {
    $data = GraficasModel::frecuenciaClientes();

    $palabraCorta="";
    $acumuladorCorto = "";
    $cadena = [];
    for ($i = 0; $i < sizeof($data); $i++) {
        $arrayPalabras = explode(" ",$data[$i]['clientes']);
        for($j = 0; $j < sizeof($arrayPalabras); $j++){
            $palabraCorta = $arrayPalabras[$j];
            if(strlen($palabraCorta) < 14){
                $acumuladorCorto .= $palabraCorta." ";
                if(strlen($acumuladorCorto) > 13){
                    $acumuladorCorto = rtrim($acumuladorCorto," ");
                    $cadena[] = substr($acumuladorCorto,0,(strlen($acumuladorCorto)-strlen($palabraCorta)-1));
                    $acumuladorCorto = $palabraCorta." ";
                }
            }else{
                if($acumuladorCorto != ""){
                    $cadena[] = $acumuladorCorto;
                }
                $cadena[] = $palabraCorta;
                $acumuladorCorto = "";
            }
        }
        $acumuladorCorto = rtrim($acumuladorCorto," ");
        $cadena[] = $acumuladorCorto;
        $palabraCorta="";
        $acumuladorCorto = "";
        $parametros[] = $cadena;
        $valores[]    = $data[$i]['frecuencia'];
        $cadena = [];
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

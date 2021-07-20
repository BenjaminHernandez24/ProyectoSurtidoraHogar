<?php
require_once "../Models/GraficasModel.php";

if (isset($_POST['frecuenciaClientes'])) {
    $data = GraficasModel::frecuenciaClientes();

    $parametros = [];
    $cadenaTemporal1 = "";
    $cadenaTemporal2 = "";
    $arregloTemporal = [];
    for ($i = 0; $i < sizeof($data); $i++) {
        $arrayPalabras = explode(" ",$data[$i]['clientes']);
        
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

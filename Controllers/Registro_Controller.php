<?php
require_once "../Models/RegistroModel.php";

//---------- Agregar Marca Producto -------//
if (isset($_POST['registro_usuario'])) {
    $Registro = array(
        "user" => $_POST['usuario'],  //Variables de input (name) //
        "password" => $_POST['contra'], 
    );
    $respuesta = RegistroModelo::registro_usuarios($Registro);
    echo json_encode(['respuesta' => $respuesta]);
}
?>
<?php

require_once "../Models/Conexion.php";
require_once "../Models/AjustesModel.php";


if (isset($_POST['passwordUsuario'])) {

    if (
        preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ_., ]+$/', $_POST['password']) &&
        preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ_., ]+$/', $_POST['repetirPassword'])
    ) {
        $respuesta = AjustesModelo::passwordUsuario($_POST['usuario'],$_POST['password']);
        echo json_encode(['respuesta' => $respuesta]);
    } else {
        echo json_encode(['respuesta' => 'Caracteres no admitidos']);
    }
}

if (isset($_POST['backups'])) {
    $conexion = new Conexion();
    $backups = $conexion->backup_tables();
    echo json_encode($backups);
}

if (isset($_POST['backups_remove'])) {
    $conexion = new Conexion();
    $r = $conexion->backup_remove($_POST['ruta']);
    echo json_encode(['respuesta' => $r]);
}

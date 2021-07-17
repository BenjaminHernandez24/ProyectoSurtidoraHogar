<?php

require_once "../Models/Conexion.php";

if (isset($_POST['backups'])) {
    $conexion = new Conexion();
    $backups = $conexion->backup_tables();
    echo json_encode($backups);
}

if(isset($_POST['backups_remove'])){
    $conexion = new Conexion();
    $r = $conexion->backup_remove($_POST['ruta']);
    echo json_encode(['respuesta'=>$r]);
}

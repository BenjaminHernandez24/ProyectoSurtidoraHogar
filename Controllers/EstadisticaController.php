<?php
require_once "../Models/EstadisticaModel.php";

/* OBTENEMOS A TODO LOS CLIENTES() */
if (isset($_POST['getVentas'])) {

    $data = EstadisticaModelo::getVentas();
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}
class EstadisticasControlador{

    public function obtenerFecha(){
        $mdl = new EstadisticaModelo;
        $mdl-> ObtenerFechaBD();
    }

    public function printTotalProveedores(){
        $mdl = new EstadisticaModelo();
        $mdl->printTotalProveedores();
    }

    public function printTotalVentas(){
        $mdl = new EstadisticaModelo();
        $mdl->printTotalVentas();
    }

    public function printTotalInventario(){
        $mdl = new EstadisticaModelo();
        $mdl->printTotalInventario();
    }
}
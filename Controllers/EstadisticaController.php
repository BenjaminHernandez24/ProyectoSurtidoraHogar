<?php
require_once "../Models/EstadisticaModel.php";

class EstadisticasControlador{

    public function obtenerFecha(){
        $mdl = new EstadisticaModelo;
        $mdl-> ObtenerFechaBD();
    }
}
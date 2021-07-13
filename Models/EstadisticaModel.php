<?php
require_once "Conexion.php";

class EstadisticaModelo{
    public function ObtenerFechaBD()
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            $pst = $conn->prepare("SELECT CURRENT_DATE");
            $pst->execute();
            $fecha = $pst->fetch();
            echo $fecha['CURRENT_DATE'];

            $conexion->closeConexion();
            $conn = null;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
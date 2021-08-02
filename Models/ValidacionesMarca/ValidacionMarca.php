<?php
require_once '../Models/Conexion.php';

class ValidacionMarca
{

    private static $VerificarMarca = "SELECT * FROM marcas_producto WHERE descripcion_marca=?";
    private static $ObtenerDescripcion    = "SELECT descripcion_marca FROM marcas_producto WHERE id_marca=?";

    public static function ValidarMarcaEditar($marca)
    {
        try {
            $conexion = new Conexion();
           $conn     = $conexion->getConexion();

            //--- Consultamos si hay una marca con la misma descripcion ----//
            $pst = $conn->prepare(self::$VerificarMarca);
            $pst->execute([$marca['descripcion_marca']]);
            $validar = $pst->fetch();

            /* ¿ENCONTRÓ ALGUNA? */
            if (empty($validar)) {
                $msg = false;
            } else {
                $msg = true;
            }

            $conn = null;
            $conexion->closeConexion();

            return $msg;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function ValidarMarcaDescripcion($marca)
    {
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            $pst = $conn->prepare(self::$ObtenerDescripcion);
            $pst->execute([$marca['id_marca']]);
            $validar = $pst->fetch();

            if (strcmp($validar[0], $marca['descripcion_marca']) !== 0) {
                $msg = true;
            } else {
                $msg = false;
            }

            $conn = null;
            $conexion->closeConexion();

            return $msg;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}

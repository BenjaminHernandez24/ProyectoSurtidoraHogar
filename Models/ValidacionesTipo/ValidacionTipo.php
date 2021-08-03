<?php
require_once '../Models/Conexion.php';

class ValidacionTipo
{

    private static $VerificarTipo = "SELECT * FROM tipo_producto WHERE descripcion_tipo=?";
    private static $ObtenerDescripcion   = "SELECT descripcion_tipo FROM tipo_producto WHERE id_tipo=?";

    public static function ValidarTipoEditar($tipo)
    {
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            //---- Se verifica si hay algún tipo de producto con el mismo nombre-----//
            $pst = $conn->prepare(self::$VerificarTipo);
            $pst->execute([$tipo['descripcion_tipo']]);
            $validar = $pst->fetch();

            /* ¿ENCONTRÓ ALGUNO? */
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

    public static function ValidarTipoDescripcion($tipo)
    {
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            $pst = $conn->prepare(self::$ObtenerDescripcion);
            $pst->execute([$tipo['id_tipo']]);
            $validar = $pst->fetch();

            if (strcmp($validar[0], $tipo['descripcion_tipo']) !== 0) {
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

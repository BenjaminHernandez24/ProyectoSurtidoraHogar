<?php
require_once '../Models/Conexion.php';

class ValidacionProducto
{

    private static $VerificarProducto = "SELECT * FROM productos WHERE nombre_producto=?";
    private static $ObtenerNombre    = "SELECT nombre_producto FROM productos WHERE id_producto=?";

    public static function ValidarProductoEditar($producto)
    {
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            //------- Se verifica si hay un producto con el mismo nombre ------//
            $pst = $conn->prepare(self::$VerificarProducto);
            $pst->execute([$producto['nombre_producto']]);
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

    public static function ValidarProductoNombre($producto)
    {
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            $pst = $conn->prepare(self::$ObtenerNombre);
            $pst->execute([$producto['id_producto']]);
            $validar = $pst->fetch();

            if (strcmp($validar[0], $producto['nombre_producto']) !== 0) {
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

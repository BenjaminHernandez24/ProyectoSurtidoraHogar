<?php
require_once '../Models/Conexion.php';

class ValidacionInventario
{

    private static $obtenerIDProducto = "SELECT id_producto FROM productos WHERE nombre_producto=?";
    private static $VerificarProducto = "SELECT * FROM inventario WHERE id_producto=?";
    private static $ObtenerNombre = "SELECT p.nombre_producto FROM productos p INNER JOIN inventario i ON i.id_producto=? LIMIT 1";

    public static function ValidarProductoEditar($producto)
    {
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            $pst = $conn->prepare(self::$obtenerIDProducto);
            $pst->execute([$producto['id_producto']]);
            $validar = $pst->fetchAll(PDO::FETCH_ASSOC);
            $id_p = $validar[0]["id_producto"];

            //------- Se verifica si hay un producto con el mismo nombre ------//
            $pst = $conn->prepare(self::$VerificarProducto);
            $pst->execute([$id_p]);
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

            $pst = $conn->prepare(self::$obtenerIDProducto);
            $pst->execute([$producto['id_producto']]);
            $validar = $pst->fetchAll(PDO::FETCH_ASSOC);
            $id_p = $validar[0]["id_producto"];


            $pst = $conn->prepare(self::$ObtenerNombre);
            $pst->execute([$id_p]);
            $validar = $pst->fetch();

            if (strcmp($validar[0], $producto['id_producto']) !== 0) {
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

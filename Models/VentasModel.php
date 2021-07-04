<?php
require_once "Conexion.php";

class VentasModelo
{
    private static $SELECT_ALL = "SELECT p.nombre_producto FROM inventario i INNER JOIN productos p ON i.id_producto=p.id_producto";
    private static $SELECT_DATE_PRODUCTOS = "SELECT i.id_inventario, p.nombre_producto,i.stock,p.precio_publico FROM productos p INNER JOIN inventario i ON p.nombre_producto=? AND i.id_producto=p.id_producto ORDER BY (i.id_inventario) DESC LIMIT 1";
    private static $CLIENTES = "SELECT id_cli,nombre_cli,tipo,telefono FROM `clientes` WHERE Estatus = 1";

    /* ===========================
        FUNCION PARA OBTENER TODO LOS CLIENTES
     =============================*/
    public function getClientes()
    {
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            $pst = $conn->prepare(self::$CLIENTES);
            $pst->execute();

            $clientes = $pst->fetchAll();

            $conn = null;
            $conexion->closeConexion();

            return $clientes;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /* ===========================
        FUNCION PARA OBTENER TODO LOS PRODUCTOS
     =============================*/
    public static function obtenerProductos()
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            $pst = $conn->prepare(self::$SELECT_ALL);
            $pst->execute();

            $productos = $pst->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            $conexion->closeConexion();

            return $productos;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function obtenerDatosProductos($nombre)
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            $pst = $conn->prepare(self::$SELECT_DATE_PRODUCTOS);
            $pst->execute([$nombre]);

            $datosProductos = $pst->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            $conexion->closeConexion();

            return $datosProductos;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}

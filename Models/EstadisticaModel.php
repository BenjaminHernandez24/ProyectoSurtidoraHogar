<?php
require_once "Conexion.php";

class EstadisticaModelo
{
    private static $VENTAS = "SELECT cliente,metodo_pago,total,hora FROM detalle_salida_venta WHERE fecha = (SELECT CURRENT_DATE);";

    /* ===========================
        FUNCION PARA OBTENER TODO LOS CLIENTES
     =============================*/
    public static function getVentas()
    {
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            $pst = $conn->prepare(self::$VENTAS);
            $pst->execute();

            $ventas = $pst->fetchAll();

            $conn = null;
            $conexion->closeConexion();

            return $ventas;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

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

    public function printTotalProveedores()
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            $pst = $conn->prepare("SELECT COUNT(*) AS total FROM proveedores");
            $pst->execute();
            $proveedores = $pst->fetch();
            echo $proveedores['total'];;

            $conexion->closeConexion();
            $conn = null;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function printTotalVentas()
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            $pst = $conn->prepare("SELECT COUNT(*) AS total FROM detalle_salida_venta");
            $pst->execute();
            $ventas = $pst->fetch();
            echo $ventas['total'];;

            $conexion->closeConexion();
            $conn = null;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function printTotalInventario()
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            $pst = $conn->prepare("SELECT COUNT(*) AS total FROM inventario");
            $pst->execute();
            $inventario = $pst->fetch();
            echo $inventario['total'];;

            $conexion->closeConexion();
            $conn = null;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}

<?php
require_once 'Conexion.php';
class NotificacionModel{
 private static $vacios = "SELECT p.nombre_producto as nombre, i.stock as stock FROM inventario i INNER JOIN productos p ON (i.stock <= i.estatus_alerta OR i.stock < 4) AND p.id_producto=i.id_producto ORDER BY p.nombre_producto ASC";
 private static $boton = "SELECT boton FROM notificaciones";
 private static $uno = "UPDATE notificaciones SET boton=1";
 private static $total = "SELECT * FROM notificaciones";
 private static $enviar = "UPDATE notificaciones SET total = ?";

    public static function productosConStockVacio(){
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            $pst = $conn->prepare(self::$vacios);
            $pst->execute();

            $datos = $pst->fetchAll(PDO::FETCH_ASSOC);

            $conn = null;
            $conexion->closeConexion();

            return $datos;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function validarBoton(){
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            $pst = $conn->prepare(self::$boton);
            $pst->execute();

            $datos = $pst->fetchAll(PDO::FETCH_ASSOC);

            $conn = null;
            $conexion->closeConexion();

            return $datos;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function cambiarUno(){
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            $pst = $conn->prepare(self::$uno);
            $resultado = $pst->execute();

            if($resultado == true){
                $msg = "OK";
            }else{
                $msg = "fallo";
            }

            $conn = null;
            $conexion->closeConexion();

            return $msg;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function validarTotal(){
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            $pst = $conn->prepare(self::$total);
            $pst->execute();

            $datos = $pst->fetchAll(PDO::FETCH_ASSOC);

            $conn = null;
            $conexion->closeConexion();

            return $datos;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function enviarTotal($total){
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            $conn -> beginTransaction();

            $pst = $conn->prepare(self::$enviar);
            $resultado = $pst->execute([$total['total']]);

            if($resultado == true){
                $msg = "OK";
                $conn->commit();
            }else{
                $msg = "fallo";
                $conn->rollback();
            }

            $conn = null;
            $conexion->closeConexion();

            return $msg;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

}
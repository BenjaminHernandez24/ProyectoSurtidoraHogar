<?php
require_once "Conexion.php";
class ImpresionModelo
{
    private static $SELECT_IMPRESION = "SELECT impresiones FROM detalle_salida_venta where id_detalle_salida_venta = ?";
    private static $EDITAR_IMPRESION = "UPDATE detalle_salida_venta set impresiones=? WHERE id_detalle_salida_venta = ?";

    /* ===========================
        FUNCION PARA OBTENER EL TIPO DE IMPRESION
     =============================*/
    public static function ObtenerImpresion($ID)
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            $pst = $conn->prepare(self::$SELECT_IMPRESION);
            $pst->execute([$ID]);
            $impresion = $pst->fetch();
            $valor = $impresion['impresiones'];
            $conexion->closeConexion();
            $conn = null;

            return $valor;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /* ===========================
        FUNCION PARA EDITAR EL TIPO DE IMPRESION
     =============================*/
    public static function CambiarImpresion($valor, $ID)
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            $pst = $conn->prepare(self::$EDITAR_IMPRESION);
            $resultado = $pst->execute([$valor, $ID]);

            if ($resultado == 1) {
                $msg = "OK";
            } else {
                $msg = "Fallo al editar";
            }

            $conexion->closeConexion();
            $conn = null;

            return $msg;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}

<?php
require_once "Conexion.php";
class ImpresionModelo
{
    private static $SELECT_IMPRESION = "SELECT impresiones FROM detalle_salida_venta where id_detalle_salida_venta = ?";
    private static $EDITAR_IMPRESION = "UPDATE detalle_salida_venta set impresiones=? WHERE id_detalle_salida_venta = ?";
    private static $EXTRAER_DATOS = "SELECT dsv.id_detalle_salida_venta as venta,p.nombre_producto as producto,sv.num_piezas as piezas,sv.precio_a_vender as precio_pub,sv.subtotal as subtotal,dsv.pago,dsv.cambio,dsv.metodo_pago,dsv.folio,dsv.total as total FROM salida_venta sv INNER JOIN detalle_salida_venta dsv ON dsv.id_detalle_salida_venta=? AND sv.id_detalle_salida_venta=dsv.id_detalle_salida_venta INNER JOIN inventario i ON i.id_inventario=sv.id_inventario INNER JOIN productos p ON p.id_producto = i.id_producto ORDER BY dsv.fecha,dsv.hora ASC";
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

    /* ===========================
        FUNCION PARA EDITAR EL TIPO DE IMPRESION
     =============================*/
    public static function obtenerDatosProductos($ID)
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            $pst = $conn->prepare(self::$EXTRAER_DATOS);
            $pst->execute([$ID]);

            $datosProductos = $pst->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            $conexion->closeConexion();

            return $datosProductos;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function ContarVentas()
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            $pst = $conn->prepare("SELECT COUNT(*) AS total FROM detalle_salida_venta");
            $pst->execute();
            $ventas = $pst->fetch();

            $pst = $conn->prepare("SELECT MAX(folio) FROM detalle_salida_venta WHERE impresiones = 'Ticket' or impresiones= 'Ambos'");
            $pst->execute();
            $maximo = $pst->fetch();

            $pst = $conn->prepare("SELECT COUNT(impresiones) FROM detalle_salida_venta WHERE impresiones = 'Ticket' or impresiones= 'Ambos'");
            $pst->execute();
            $contador = $pst->fetch();

            $resultado_consultas =[
                "ventas" => $ventas['total'],
                "maximo"       => $maximo['MAX(folio)'],
                "contador"       => $contador['COUNT(impresiones)'],
            ];

            return $resultado_consultas;

            $conexion->closeConexion();
            $conn = null;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

        /* ===========================
        FUNCION PARA EDITAR PROVEEDOR
     =============================*/
     public static function editarFolio($ID,$folio)
     {
         try {
 
             $conexion = new Conexion();
             $conn = $conexion->getConexion();
 
             //Abro la transacción.
             $conn->beginTransaction();
 
             $pst = $conn->prepare("UPDATE detalle_salida_venta set folio=? WHERE id_detalle_salida_venta = ?");
 
             $resultado = $pst->execute([$folio,$ID]);
 
             if ($resultado == 1) {
                 $msg = "OK";
                 //Si todo esta correcto insertamos.
                 $conn->commit();
             } else {
                 $msg = "Fallo al editar";
                 //Si algo falla, reestablece la bd a como estaba en un inicio.
                 $conn->rollBack();
             }
 
             $conn = null;
             $conexion->closeConexion();
 
             return $msg;
         } catch (PDOException $e) {
             return $e->getMessage();
         }
     }
}

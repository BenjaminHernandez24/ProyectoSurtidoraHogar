<?php
require_once "Conexion.php";
class TipoModelo
{
    private static $INSERTAR_TIPO = "INSERT INTO tipo_producto (descripcion_tipo, estatus) values (?,?)";
    private static $EDITAR_TIPO = "UPDATE tipo_producto set descripcion_tipo = ? WHERE id_tipo = ?";
    private static $BORRAR_TIPO = "DELETE FROM tipo_producto WHERE id_tipo = ?";
    private static $SELECT_ALL_TIPO = "SELECT * FROM tipo_producto";
    private static $VALIDAR_TIPO_EXISTENTE = "SELECT * FROM tipo_producto WHERE descripcion_tipo = ? ";
    private static $ESTATUS_TIPO = "UPDATE tipo_producto set estatus=? WHERE id_tipo = ?";
//-------- FUNCIÓN PARA AGREGAR TIPO DE PRODUCTO -------//
    public static function agregar_tipo_producto($tipo)
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();
            //Se abre la transacción.
            $conn->beginTransaction();
            //-------- Se verifica si ya existe el tipo de producto -------//
            $pst = $conn->prepare(self::$VALIDAR_TIPO_EXISTENTE);
            $pst->execute([$tipo ['descripcion_tipo']]);
            $validar = $pst->fetchAll();

            if (empty($validar)) {
                $pst = $conn->prepare(self::$INSERTAR_TIPO);
                $resultado =$pst->execute([$tipo ['descripcion_tipo'], 1]);
                if ($resultado == 1) {
                    $msg = "OK";
                    //Si todo está correcto se inserta.
                    $conn->commit();
                } else {
                    $msg = "Falló al insertar";
                    //Si algo falla, reestablece la bd a como estaba en un inicio.
                    $conn->rollBack();
                }
               
                $conn = null;
                $conexion->closeConexion();

                return $msg;
            } else {
                return $msg="EXISTE";
            }
            $conn = null;
            $conexion->closeConexion();

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

 //-------- FUNCIÓN PARA EDITAR TIPO DE PRODUCTO -------//
     public static function editar_tipo_producto($tipo)
     {
         try {
 
             $conexion = new Conexion();
             $conn = $conexion->getConexion();
             //Se abre la transacción.
            $conn->beginTransaction();
 
             $pst = $conn->prepare(self::$EDITAR_TIPO);
 
             $resultado =$pst->execute([$tipo['descripcion_tipo'], $tipo['id_tipo']]);
 
             if ($resultado == 1) {
                $msg = "OK";
                //Si todo está correcto se inserta.
                $conn->commit();
            } else {
                $msg = "Falló al actualizar";
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
 
    //-------- FUNCIÓN PARA ELIMINAR TIPO DE PRODUCTO -------//
     public static function eliminar_tipo_producto($id)
     {
         try {
 
             $conexion = new Conexion();
             $conn = $conexion->getConexion();
             //Se abre la transacción.
            $conn->beginTransaction();
             $pst = $conn->prepare(self::$BORRAR_TIPO);
             $resultado =$pst->execute([$id]);
             if ($resultado == 1) {
                $msg = "OK";
                //Si todo está correcto se inserta.
                $conn->commit();
            } else {
                $msg = "Falló al eliminar";
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
 //-------- FUNCIÓN PARA OBTENER LOS TIPOS DE PRODUCTO -------//
     public static function obtener_tipo_producto()
     {
         try {
             $conexion = new Conexion();
             $conn = $conexion->getConexion();
 
             $pst = $conn->prepare(self::$SELECT_ALL_TIPO);
             $pst->execute();
 
             $tipo = $pst->fetchAll();
             $conn = null;
             $conexion->closeConexion();
 
             return $tipo;
         } catch (PDOException $e) {
             return $e->getMessage();
         }
     }

 //-------- FUNCIÓN PARA DESACTIVAR LOS TIPOS DE PRODUCTO -------//
public static function desactivarTipoProducto($id)
{
    try {

        $conexion = new Conexion();
        $conn = $conexion->getConexion();

        //Abro la transacción.
        $conn->beginTransaction();

        $pst = $conn->prepare(self::$ESTATUS_TIPO);
        $resultado = $pst->execute([0, $id]);

        if ($resultado == 1) {
            $msg = "OK";
            //Si todo esta correcto insertamos.
            $conn->commit();
        } else {
            $msg = "Fallo al cambiar estatus";
            //Si algo falla, reestablece la bd a como estaba en un inicio.
            $conn->rollBack();
        }

        $conexion->closeConexion();
        $conn = null;

        return $msg;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

//-------- FUNCIÓN PARA ACTIVAR LOS TIPOS DE PRODUCTO -------//
public static function activarTipoProducto($id)
{
    try {

        $conexion = new Conexion();
        $conn = $conexion->getConexion();

        //Abro la transacción.
        $conn->beginTransaction();

        $pst = $conn->prepare(self::$ESTATUS_TIPO);
        $resultado = $pst->execute([1, $id]);

        if ($resultado == 1) {
            $msg = "OK";
            //Si todo esta correcto insertamos.
            $conn->commit();
        } else {
            $msg = "Fallo al cambiar estatus";
            //Si algo falla, reestablece la bd a como estaba en un inicio.
            $conn->rollBack();
        }

        $conexion->closeConexion();
        $conn = null;

        return $msg;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
}

?>
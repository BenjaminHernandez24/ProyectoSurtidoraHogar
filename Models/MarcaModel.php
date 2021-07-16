<?php
require_once "Conexion.php";
class MarcaModelo
{
    private static $INSERTAR_MARCA = "INSERT INTO marcas_producto (descripcion_marca) values (?)";
    private static $EDITAR_MARCA = "UPDATE marcas_producto set descripcion_marca = ? WHERE id_marca = ?";
    private static $BORRAR_MARCA = "DELETE FROM marcas_producto WHERE id_marca = ?";
    private static $SELECT_ALL_MARCA = "SELECT * FROM marcas_producto";
    private static $VALIDAR_MARCA_EXISTENTE = "SELECT * FROM marcas_producto WHERE descripcion_marca = ? ";

//-------- FUNCIÓN PARA AGREGAR MARCA DE PRODUCTO -------//
    public static function agregar_marca_producto($marca)
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();
            //Se abre la transacción.
            $conn->beginTransaction();
            //-------- Se verifica si ya existe la marca de producto -------//
            $pst = $conn->prepare(self::$VALIDAR_MARCA_EXISTENTE);
           $pst->execute([$marca ['descripcion_marca']]);
            $validar = $pst->fetchAll();

            if (empty($validar)) {
                $pst = $conn->prepare(self::$INSERTAR_MARCA);
                $resultado =$pst->execute([$marca ['descripcion_marca']]);
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

 //-------- FUNCIÓN PARA EDITAR MARCA DE PRODUCTO -------//
     public static function editar_marca_producto($marca)
     {
         try {
 
             $conexion = new Conexion();
             $conn = $conexion->getConexion();
             //Se abre la transacción.
            $conn->beginTransaction();
 
             $pst = $conn->prepare(self::$EDITAR_MARCA);
             $resultado =$pst->execute([$marca['descripcion_marca'], $marca['id_marca']]);
             if ($resultado == 1) {
                $msg = "OK";
                //Si todo está correcto se inserta.
                $conn->commit();
            } else {
                $msg = "Falló al editar";
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
 
    //-------- FUNCIÓN PARA ELIMINAR MARCA DE PRODUCTO -------//
     public static function eliminar_marca_producto($id)
     {
         try {
 
             $conexion = new Conexion();
             $conn = $conexion->getConexion();
              //Se abre la transacción.
            $conn->beginTransaction();
 
 
             $pst = $conn->prepare(self::$BORRAR_MARCA);
             $resultado =$pst->execute([$id]);
 
             if ($resultado == 1) {
                $msg = "OK";
                //Si todo está correcto se inserta.
                $conn->commit();
            } else {
                $msg = "Falló al editar";
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
 //-------- FUNCIÓN PARA OBTENER LAS MARCAS DE PRODUCTO -------//
     public static function obtener_marca_producto()
     {
         try {
             $conexion = new Conexion();
             $conn = $conexion->getConexion();
 
             $pst = $conn->prepare(self::$SELECT_ALL_MARCA);
             $pst->execute();
 
             $marca = $pst->fetchAll();
             $conn = null;
             $conexion->closeConexion();
 
             return $marca;
         } catch (PDOException $e) {
             return $e->getMessage();
         }
     }

}
?>
<?php
require_once "Conexion.php";
class TipoModelo
{
    private static $INSERTAR_TIPO = "INSERT INTO tipo_producto (descripcion) values (?)";
    private static $EDITAR_TIPO = "UPDATE tipo_producto set descripcion = ? WHERE id_tipo = ?";
    private static $BORRAR_TIPO = "DELETE FROM tipo_producto WHERE id_tipo = ?";
    private static $SELECT_ALL_TIPO = "SELECT * FROM tipo_producto";
    private static $VALIDAR_TIPO_EXISTENTE = "SELECT * FROM tipo_producto WHERE descripcion = ? ";

//-------- FUNCIÓN PARA AGREGAR TIPO DE PRODUCTO -------//
    public static function agregar_tipo_producto($tipo)
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            //-------- Se verifica si ya existe el tipo de producto -------//
            $pst = $conn->prepare(self::$VALIDAR_TIPO_EXISTENTE);
            $pst->execute([$tipo ['descripcion']]);
            $validar = $pst->fetchAll();

            if (empty($validar)) {
                $pst = $conn->prepare(self::$INSERTAR_TIPO);
                $pst->execute([$tipo ['descripcion']]);

                $conn = null;
                $conexion->closeConexion();

                return $msg="OK";
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
 
             $pst = $conn->prepare(self::$EDITAR_TIPO);
 
             $pst->execute([$tipo['descripcion'], $tipo['id_tipo']]);
 
             $conn = null;
             $conexion->closeConexion();
 
             return "OK";
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
 
             $pst = $conn->prepare(self::$BORRAR_TIPO);
 
             $pst->execute([$id]);
 
             $conn = null;
             $conexion->closeConexion();
 
             return "OK";
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

}
?>
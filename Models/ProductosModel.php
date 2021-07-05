<?php
require_once "Conexion.php";
class ProductoModelo
{
    private static $INSERTAR_PRODUCTO = "INSERT INTO productos (nombre_producto, id_tipo, id_marca, precio_publico) values (?, ?, ?, ?)";
    private static $EDITAR_PRODUCTO = "UPDATE productos set nombre_producto = ?, id_tipo = ?, id_marca =?, precio_publico=? WHERE id_producto = ?";
    private static $BORRAR_PRODUCTO = "DELETE FROM productos WHERE id_producto = ?";
    private static $SELECT_ALL_PRODUCTO = "SELECT * FROM productos";
    private static $VALIDAR_PRODUCTO_EXISTENTE = "SELECT * FROM productos WHERE nombre_producto = ? ";
    private static $SELECT_ALL_TIPO_PRODUCTO = "SELECT * FROM tipo_producto ";
    private static $SELECT_ALL_MARCA_PRODUCTO = "SELECT * FROM marcas_producto ";

//-------- FUNCIÓN PARA AGREGAR TIPO DE PRODUCTO -------//
    public static function agregar_productos($producto)
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            //-------- Se verifica si ya existe el tipo de producto -------//
            $pst = $conn->prepare(self::$VALIDAR_PRODUCTO_EXISTENTE);
            $pst->execute([$producto ['nombre_producto']]);
            $validar = $pst->fetchAll();

            if (empty($validar)) {
                $pst = $conn->prepare(self::$INSERTAR_PRODUCTO);
                $pst->execute([$producto ['nombre_producto'],$producto ['id_tipo'],$producto ['id_marca'], $producto ['precio_publico']]);

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
     public static function editar_productos($producto_edi)
     {
         try {
 
             $conexion = new Conexion();
             $conn = $conexion->getConexion();
 
             $pst = $conn->prepare(self::$EDITAR_PRODUCTO);
 
             $pst->execute([$producto_edi['nombre_producto'],$producto_edi ['id_tipo'],$producto_edi['id_marca'], $producto_edi ['precio_publico'], $producto_edi ['id_producto']]);
 
             $conn = null;
             $conexion->closeConexion();
 
             return "OK";
         } catch (PDOException $e) {
             return $e->getMessage();
         }
     }
 
    //-------- FUNCIÓN PARA ELIMINAR TIPO DE PRODUCTO -------//
     public static function eliminar_producto($id)
     {
         try {
 
             $conexion = new Conexion();
             $conn = $conexion->getConexion();
 
             $pst = $conn->prepare(self::$BORRAR_PRODUCTO);
 
             $pst->execute([$id]);
 
             $conn = null;
             $conexion->closeConexion();
 
             return "OK";
         } catch (PDOException $e) {
             return $e->getMessage();
         }
     }
 //-------- FUNCIÓN PARA OBTENER LOS PRODUCTOS -------//
     public static function obtener_productos()
     {
         try {
             $conexion = new Conexion();
             $conn = $conexion->getConexion();
 
             $pst = $conn->prepare(self::$SELECT_ALL_PRODUCTO);
             $pst->execute();
 
             $productos = $pst->fetchAll();
             $conn = null;
             $conexion->closeConexion();
 
             return $productos;
         } catch (PDOException $e) {
             return $e->getMessage();
         }
     }
    
      //-------- FUNCIÓN PARA OBTENER LOS TIPOS DE PRODUCTO -------//
      public static function obtener_tipo_productos()
      {
          try {
              $conexion = new Conexion();
              $conn = $conexion->getConexion();
  
              $pst = $conn->prepare(self::$SELECT_ALL_TIPO_PRODUCTO);
              $pst->execute();
  
              $tipos = $pst->fetchAll();
              $conn = null;
              $conexion->closeConexion();
  
              return $tipos;
          } catch (PDOException $e) {
              return $e->getMessage();
          }
      }
       //-------- FUNCIÓN PARA OBTENER LAS MARCAS DE PRODUCTO -------//
       public static function obtener_marca_productos()
       {
           try {
               $conexion = new Conexion();
               $conn = $conexion->getConexion();
   
               $pst = $conn->prepare(self::$SELECT_ALL_MARCA_PRODUCTO);
               $pst->execute();
   
               $marcas = $pst->fetchAll();
               $conn = null;
               $conexion->closeConexion();
   
               return $marcas;
           } catch (PDOException $e) {
               return $e->getMessage();
           }
       }
 

}
?>
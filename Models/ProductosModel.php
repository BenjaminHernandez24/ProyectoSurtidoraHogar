<?php
require_once "Conexion.php";
class ProductoModelo
{
    private static $INSERTAR_PRODUCTO = "INSERT INTO productos (nombre_producto, id_tipo, id_marca, precio_publico, estatus) values (?, ?, ?, ?, ?)";
    private static $EDITAR_PRODUCTO = "UPDATE productos set nombre_producto = ?, id_tipo = ?, id_marca =?, precio_publico=? WHERE id_producto = ?";
    private static $BORRAR_PRODUCTO = "DELETE FROM productos WHERE id_producto = ?";
    private static $VALIDAR_PRODUCTO_EXISTENTE = "SELECT * FROM productos WHERE nombre_producto = ? ";
    private static $SELECT_ALL_TIPO_PRODUCTO = "SELECT * FROM tipo_producto WHERE estatus = 1 ORDER BY descripcion_tipo ";
    private static $SELECT_ALL_MARCA_PRODUCTO = "SELECT * FROM marcas_producto WHERE estatus = 1 ORDER BY descripcion_marca";
    private static $SELECT_PRODUCTOS_TIPO_MARCA = "SELECT p.id_producto, p.nombre_producto, p.precio_publico, tp.descripcion_tipo, mp.descripcion_marca, p.estatus FROM productos p INNER JOIN tipo_producto tp ON p.id_tipo=tp.id_tipo INNER JOIN marcas_producto mp ON p.id_marca=mp.id_marca";
    private static $SELECT_ID_PRODUCTO = "SELECT id_producto  FROM productos WHERE id_producto= ?";
    private static $ESTATUS_PRODUCTO = "UPDATE productos set estatus=? WHERE id_producto = ?";
    private static $obtenerIdMarca = "SELECT * FROM marcas_producto WHERE descripcion_marca = ?";
    private static $obtenerIDProducto = "SELECT * FROM tipo_producto WHERE descripcion_tipo=?";
    private static $SELECT_ESTATUS_PRODUCTOS = "SELECT estatus FROM productos";

   
//-------- FUNCIÓN PARA AGREGAR TIPO DE PRODUCTO -------//
    public static function agregar_productos($producto)
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();
             //Se abre la transacción.
             $conn->beginTransaction();

            //-------- Se verifica si ya existe el tipo de producto -------//
            $pst = $conn->prepare(self::$VALIDAR_PRODUCTO_EXISTENTE);
            $pst->execute([$producto ['nombre_producto']]);
            $validar = $pst->fetchAll();

            if (empty($validar)) {
                $pst = $conn->prepare(self::$INSERTAR_PRODUCTO);
                $resultado=$pst->execute([$producto ['nombre_producto'],$producto ['id_tipo'],$producto ['id_marca'], $producto ['precio_publico'], 1]);
                    
            if ($resultado == 1) {
                $msg = "OK";
                //Si todo está correcto se inserta.
                $conn->commit();
            } else {
                $msg = "Falló al agregar";
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
     public static function editar_productos($producto_edi)
     {
         try {
 
             $conexion = new Conexion();
             $conn = $conexion->getConexion();
            //Se abre la transacción.
            $conn->beginTransaction();

            //En el apartado de id_marca no estamos recibiendo el id_marca
            //si no el valor, la descripcion que contiene, por eso por medio de una
            //consulta debemos obtener el id marca que corresponde a esa descripcion
             $pst = $conn->prepare(self::$obtenerIdMarca); //preparamos consulta
             $pst->execute([$producto_edi['id_marca']]); //pasamos descripcion
             $resultado = $pst->fetchAll(PDO::FETCH_ASSOC); //obtenemos la fila en array
             $p1 = $resultado[0]["id_marca"];

             $pst = $conn->prepare(self::$obtenerIDProducto); 
             $pst->execute([$producto_edi['id_tipo']]); 
             $resultado = $pst->fetchAll(PDO::FETCH_ASSOC); 
             $p2 = $resultado[0]["id_tipo"];


             $pst = $conn->prepare(self::$EDITAR_PRODUCTO);
             /*En el parametro de marcas, pasamos el valor del id_marca obtenido en la consulta anterior, resultado en su pocision 0 en el campo id_marca*/
             $resultado =$pst->execute([$producto_edi['nombre_producto'],$p2,$p1, $producto_edi ['precio_publico'], $producto_edi ['id_producto']]);
             
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
 
    //-------- FUNCIÓN PARA ELIMINAR TIPO DE PRODUCTO -------//
     public static function eliminar_producto($id)
     {
         try {
 
             $conexion = new Conexion();
             $conn = $conexion->getConexion();
             //Se abre la transacción.
            $conn->beginTransaction();

             $pst = $conn->prepare(self::$BORRAR_PRODUCTO);
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
 //-------- FUNCIÓN PARA OBTENER LOS PRODUCTOS -------//
     public static function obtener_productos()
     {
         try {
             $conexion = new Conexion();
             $conn = $conexion->getConexion();
 
             $pst = $conn->prepare(self::$SELECT_PRODUCTOS_TIPO_MARCA);
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
       public static function obtener_id_producto($id)
       {
           try {
               $conexion = new Conexion();
               $conn = $conexion->getConexion();
   
               $pst = $conn->prepare(self::$SELECT_ID_PRODUCTO);
               $pst->execute([$id]);
   
               $id_en = $pst->fetch();
               $conn = null;
               $conexion->closeConexion();
   
               return $id_en;
           } catch (PDOException $e) {
               return $e->getMessage();
           }
       }
  //-------- FUNCIÓN PARA DESACTIVAR LOS  PRODUCTOS -------//
public static function desactivarProductos($id)
{
    try {

        $conexion = new Conexion();
        $conn = $conexion->getConexion();

        //Abro la transacción.
        $conn->beginTransaction();

        $pst = $conn->prepare(self::$ESTATUS_PRODUCTO);
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

//-------- FUNCIÓN PARA ACTIVAR LOS PRODUCTOS -------//
public static function activarProductos($id)
{
    try {

        $conexion = new Conexion();
        $conn = $conexion->getConexion();

        //Abro la transacción.
        $conn->beginTransaction();

        $pst = $conn->prepare(self::$ESTATUS_PRODUCTO);
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

 //-------- FUNCIÓN PARA OBTENER ESTATUS DE PRODUCTO -------//
 public static function obtener_estatus_productos()
 {
     try {
         $conexion = new Conexion();
         $conn = $conexion->getConexion();

         $pst = $conn->prepare(self::$SELECT_ESTATUS_PRODUCTOS);
         $pst->execute();

         $estatus = $pst->fetchAll();
         $conn = null;
         $conexion->closeConexion();

         return $estatus;
     } catch (PDOException $e) {
         return $e->getMessage();
     }
 }

}
?>
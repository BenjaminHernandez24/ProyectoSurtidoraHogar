<?php
require_once "Conexion.php";

class InventarioModelo{

private static $SELECT_ALL_INVENTARIO = "SELECT i.id_inventario, p.nombre_producto, i.estatus_aceptable, i.estatus_alerta, i.stock
FROM inventario i INNER JOIN productos p ON i.id_producto=p.id_producto";
private static $INSERTAR_PRODUCTO_INVENTARIO = "INSERT INTO inventario (id_producto, estatus_aceptable, estatus_alerta, stock) values (?, ?, ?, ?)";
private static $VALIDAR_PRODUCTO_EXISTENTE = "SELECT * FROM inventario WHERE id_producto = ? ";
private static $SELECT_PRODUCTOS =  "SELECT id_producto, nombre_producto FROM productos WHERE estatus = 1 order by nombre_producto";
private static $EDITAR_PRODUCTO_INVENTARIO = "UPDATE inventario set id_producto = ?, estatus_aceptable = ?, estatus_alerta =?, stock=? WHERE id_inventario = ?";
private static $BORRAR_PRODUCTO_INVENTARIO = "DELETE FROM inventario WHERE id_inventario = ?";

private static $OBTENER_ESTATUS_COMPARAR ="SELECT stock, estatus_aceptable from inventario WHERE id_inventario = ?";
private static $obtenerIDProducto = "SELECT * FROM productos WHERE nombre_producto=?";
//-------- FUNCIÓN PARA OBTENER  PRODUCTOS EN INVENTARIO -------//
 public static function obtener_inventario_producto()
 {
     try {
         $conexion = new Conexion();
         $conn = $conexion->getConexion();
         
         $pst = $conn->prepare(self::$SELECT_ALL_INVENTARIO);
         $pst->execute();
         $inventario = $pst->fetchAll();

         
         $conn = null;
         $conexion->closeConexion();

         return $inventario;
     } catch (PDOException $e) {
         return $e->getMessage();
     }
 }

 //-------- FUNCIÓN PARA AGREGAR PRODUCTOS EN INVENTARIO -------//
 public static function agregar_producto_inventario($producto_inv)
 {
     try {
         $conexion = new Conexion();
         $conn = $conexion->getConexion();
         //Se abre la transacción.
        $conn->beginTransaction();
         
         //-------- Se verifica si ya existe el producto en inventario-------//
         $pst = $conn->prepare(self::$VALIDAR_PRODUCTO_EXISTENTE);
         $pst->execute([$producto_inv ['id_producto']]);
         $validar = $pst->fetchAll();

         if (empty($validar)) {
             $pst = $conn->prepare(self::$INSERTAR_PRODUCTO_INVENTARIO);
             $resultado  = $pst->execute([$producto_inv ['id_producto'],$producto_inv ['estatus_aceptable'],$producto_inv['estatus_alerta'],$producto_inv ['stock'],]);

             if ($resultado == 1) {
                
                $msg = "OK";
                
                //Si todo está correcto se inserta.
                $conn->commit();
                
            } else {
                $msg = "Falló al insertar";
                //Si algo falla, se reestablece la bd a como estaba en un inicio.
                $conn->rollBack();
            }
            //-------- Se verifica el estatus -------//
        
         } else {
            return $msg="EXISTE";
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

        $pst = $conn->prepare(self::$SELECT_PRODUCTOS);
        $pst->execute();

        $productos = $pst->fetchAll();
        $conn = null;
        $conexion->closeConexion();

        return $productos;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
//-------- FUNCIÓN PARA EDITAR  PRODUCTO EN INVENTARIO -------//
public static function editar_productos_inventario($producto_edi)
{
    try {

        $conexion = new Conexion();
        $conn = $conexion->getConexion();
        //Se abre la transacción.
        $conn->beginTransaction();
        //-------- Se verifica si ya existe el producto en inventario-------//
        $pst = $conn->prepare(self::$obtenerIDProducto); 
        $pst->execute([$producto_edi['id_producto']]); 
        $resultado = $pst->fetchAll(PDO::FETCH_ASSOC); 
        $id_p = $resultado[0]["id_producto"];
       
        $pst = $conn->prepare(self::$EDITAR_PRODUCTO_INVENTARIO);
        $resultado =$pst->execute([$id_p,$producto_edi ['estatus_aceptable'],$producto_edi['estatus_alerta'],$producto_edi['stock'], $producto_edi ['id_inventario']]);
        

        if ($resultado == 1) {
            $msg = "OK";
            //Si todo está correcto se inserta.
            $conn->commit();
        } else {
            $msg = "Falló al actualizar";
            //Si algo falla, se reestablece la bd a como estaba en un inicio.
            $conn->rollBack();
        }
        $conn = null;
        $conexion->closeConexion();
        return $msg;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
  //-------- FUNCIÓN PARA ELIMINAR  PRODUCTO DE INVENTARIO -------//
  public static function eliminar_producto_inventario($id)
  {
      try {

          $conexion = new Conexion();
          $conn = $conexion->getConexion();
          //Se abre la transacción.
        $conn->beginTransaction();

          $pst = $conn->prepare(self::$BORRAR_PRODUCTO_INVENTARIO);
          $resultado = $pst->execute([$id]);
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
  //-------- FUNCIÓN PARA OBTENER  PRODUCTOS EN INVENTARIO -------//
 public static function obtener_estatus($id)
 {
     try {
         $conexion = new Conexion();
         $conn = $conexion->getConexion();

         $pst = $conn->prepare(self::$OBTENER_ESTATUS_COMPARAR);
         $pst->execute([$id]);
         $resultado = $pst->fetchAll(PDO::FETCH_ASSOC);
         $stock_p = $resultado[0]["stock"];
         $estatus_acep = $resultado[0]["estatus_aceptable"];
       
        if ($stock_p >= $estatus_acep) {
           
            $conn = null;
          $conexion->closeConexion();
            $msg="ACEPTABLE";

        }else {
            $conn = null;
            $conexion->closeConexion();
           $msg= "ALERTA";
        }
        $conn = null;
        $conexion->closeConexion();
         return $msg;
         
     } catch (PDOException $e) {
         return $e->getMessage();
     }
 }

}
?>
<?php
require_once "Conexion.php";

class InventarioModelo{

private static $SELECT_ALL_INVENTARIO = "SELECT i.id_inventario, p.nombre_producto, i.estatus_aceptable, i.estatus_alerta, i.stock
FROM inventario i INNER JOIN productos p ON i.id_producto=p.id_producto; SELECT stock, estatus_aceptable, estatus_alerta from inventario ";
private static $INSERTAR_PRODUCTO_INVENTARIO = "INSERT INTO inventario (id_producto, estatus_aceptable, estatus_alerta, stock) values (?, ?, ?, ?)";
private static $VALIDAR_PRODUCTO_EXISTENTE = "SELECT * FROM inventario WHERE id_producto = ? ";
private static $SELECT_PRODUCTOS =  "SELECT id_producto, nombre_producto FROM productos";
private static $EDITAR_PRODUCTO_INVENTARIO = "UPDATE inventario set id_producto = ?, estatus_aceptable = ?, estatus_alerta =?, stock=? WHERE id_inventario = ?";
private static $BORRAR_PRODUCTO_INVENTARIO = "DELETE FROM inventario WHERE id_inventario = ?";
private static $OBTENER_ESTATUS_COMPARAR ="SELECT STOCK, ESTATUS_ACEPTABLE, ESTATUS_ALERTA from inventario WHERE id_producto = ?";
private static $INSERTAR_ESTATUS ="UPDATE inventario set  estatus=? WHERE id_producto=?";
private static $VALIDAR_EDITAR = "SELECT DISTINCT id_producto=? FROM inventario";
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
        $pst = $conn->prepare(self::$VALIDAR_EDITAR);
        $pst->execute([$producto_edi ['id_producto']]);
        $validar = $pst->fetchAll();

        if (!empty($validar)) {
       
        $pst = $conn->prepare(self::$EDITAR_PRODUCTO_INVENTARIO);

        $resultado =$pst->execute([$producto_edi['id_producto'],$producto_edi ['estatus_aceptable'],$producto_edi['estatus_alerta'],$producto_edi['stock'], $producto_edi ['id_inventario']]);
        

        if ($resultado == 1) {
            $msg = "OK";
            //Si todo está correcto se inserta.
            $conn->commit();
        } else {
            $msg = "Falló al actualizar";
            //Si algo falla, se reestablece la bd a como estaba en un inicio.
            $conn->rollBack();
        }

    } else {
        return $msg="NO";
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
 /*public static function obtener_estatus()
 {
     try {
         $conexion = new Conexion();
         $conn = $conexion->getConexion();

         $pst = $conn->prepare(self::$OBTENER_ESTATUS );
         $resultado = $pst->execute();
         $inventario = $pst->fetchAll(PDO::FETCH_ASSOC);
         if ($inventario['stock'] >= $inventario['status_aceptable'] ){
           
            $msg = "ACEPTABLE";
         }else if ($inventario['stock'] <= $inventario['status_aceptable'] ) {
            $msg = "ALERTA";
           
         }

         $conn = null;
         $conexion->closeConexion();

         return $msg;
     } catch (PDOException $e) {
         return $e->getMessage();
     }
 }*/

}
?>
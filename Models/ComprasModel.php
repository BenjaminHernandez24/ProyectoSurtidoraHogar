<?php
require_once "Conexion.php";

class ComprasModelo{


//-------------------- Función para llenar Tabla Compras -----------------//
private static $SELECT_ALL_COMPRAS = "SELECT ec.id_entrada_compra, ec.num_piezas, ec.precio_unitario,ec.subtotal, ec.fecha, ec.hora,prov.nom_empresa, prod.nombre_producto
FROM entrada_compra ec INNER JOIN proveedores prov ON ec.id_prov=prov.id_prov INNER JOIN inventario i ON i.id_inventario=ec.id_inventario INNER JOIN productos prod ON i.id_producto=prod.id_producto ";
//-------------------- Funciones  para llenar Select de Productos y Proveedores --------------------//
private static $SELECT_ALL_PRODUCTOS = "SELECT i.id_producto as id_producto,  p.nombre_producto as nombre_producto  FROM inventario i INNER JOIN productos p ON i.id_producto=p.id_producto";
private static $SELECT_ALL_PROVEEDORES = "SELECT id_prov, nom_empresa FROM proveedores WHERE estatus=1";
//-------------------- Funciones para agregar Compras -----------------------------//
private static $SELECT_ID_INVENTARIO_PRODUCTO = "SELECT * FROM inventario WHERE id_producto= ? ";
private static $SELECT_STOCK = "SELECT stock FROM inventario WHERE id_producto=?";
private static $ACTUALIZAR_STOCK_INSERTAR_ENTRADA_COMPRA = "UPDATE inventario set stock=? WHERE id_producto=?; INSERT INTO entrada_compra (id_prov, id_inventario, num_piezas, precio_unitario,subtotal,fecha,hora) VALUES  (?,?,?,?,?, CURDATE(), CURTIME())";
//--------------------- Funciones para Editar una Compra ---------------------//
private static $ACTUALIZAR_STOCK_ACTUALIZAR_ENTRADA_COMPRA = "UPDATE inventario set stock=(stock+?) WHERE id_inventario=?; UPDATE entrada_compra SET id_prov=?, id_inventario=?, num_piezas=?, precio_unitario=?, subtotal=?, fecha=CURDATE(), hora=CURTIME() WHERE id_entrada_compra=?";
private static $UPDATE1_STOCK="UPDATE inventario set stock=(stock-?) WHERE id_inventario=?";

//------------ Función para Eliminar una Compra-----------//
private static $BORRAR_COMPRA_ACTUALIZAR_STOCK ="DELETE FROM entrada_compra WHERE id_entrada_compra = ?;UPDATE inventario set stock=(stock-?) WHERE id_inventario=?";
private static $SELECT_ID_INVENTARIO ="SELECT id_inventario FROM  entrada_compra WHERE id_entrada_compra=?";
private static $SELECT_NUM_PIEZAS = " SELECT NUM_PIEZAS FROM entrada_compra WHERE id_entrada_compra=?";

private static $obtenerIDProducto = "SELECT * FROM productos WHERE nombre_producto=?";
private static $obtenerIDProveedor = "SELECT * FROM proveedores WHERE nom_empresa=?";
//-------- FUNCIÓN PARA OBTENER  COMPRAS -------//
public static function obtener_compras_inv()
{
    try {
        $conexion = new Conexion();
        $conn = $conexion->getConexion();

        $pst = $conn->prepare(self::$SELECT_ALL_COMPRAS);
        $pst->execute();

        $compras = $pst->fetchAll();
        $conn = null;
        $conexion->closeConexion();

        return $compras;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
//-------- FUNCIÓN PARA OBTENER PRODUCTO EN INVENTARIO -------//
public static function obtener_productos_inventario()
{
    try {
        $conexion = new Conexion();
        $conn = $conexion->getConexion();

        $pst = $conn->prepare(self::$SELECT_ALL_PRODUCTOS);
        $pst->execute();

        $productos = $pst->fetchAll();
        $conn = null;
        $conexion->closeConexion();

        return $productos;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
//-------- FUNCIÓN PARA OBTENER PROVEEDORES -------//
public static function obtener_proveedores()
{
    try {
        $conexion = new Conexion();
        $conn = $conexion->getConexion();

        $pst = $conn->prepare(self::$SELECT_ALL_PROVEEDORES);
        $pst->execute();

        $proveedores = $pst->fetchAll();
        $conn = null;
        $conexion->closeConexion();

        return $proveedores;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
//-------- FUNCIÓN PARA AGREGAR UNA COMPRA DE PRODUCTOS -------//
public static function agregar_compras($compras)
{
    try {
        $conexion = new Conexion();
        $conn = $conexion->getConexion();
        //Se abre la transacción.
        $conn->beginTransaction();

            //--- Obtenemos el ID de producto con el nombre de producto ----//
            $pst = $conn->prepare(self::$obtenerIDProducto); 
            $pst->execute([$compras['id_producto']]); 
            $resultado = $pst->fetchAll(PDO::FETCH_ASSOC); 
            $id_produc = $resultado[0]["id_producto"];
            //--- Obtenemos el ID del proveedor con el nombre de la empresa a la que pertenece. ----//
            $pst = $conn->prepare(self::$obtenerIDProveedor); 
            $pst->execute([$compras['id_prov']]); 
            $resultado = $pst->fetchAll(PDO::FETCH_ASSOC); 
            $id_prov = $resultado[0]["id_prov"];
            //-------- Se consulta el  ID de inventario del producto seleccionado-------//
            $pst = $conn->prepare(self::$SELECT_ID_INVENTARIO_PRODUCTO);
            $pst->execute([$id_produc]);
            $resultado = $pst->fetchAll(PDO::FETCH_ASSOC);
            $id_inv = $resultado[0]["id_inventario"];
            // ---------- Consultamos el stock en inventario ------------//
            $pst = $conn->prepare(self::$SELECT_STOCK);
             $pst->execute([$id_produc]);
            $resultado = $pst->fetch();
            $sum_stock= $resultado['stock'] + $compras['num_piezas'];

         
        // ---------- obtenemos el subtotal-----------//
        $sub= $compras ['precio_unitario'] * $compras ['num_piezas'];
            //--------Actualizamos el stock en inventario de la compra e insertamos los datos de Compra -------//
            $pst = $conn->prepare(self::$ACTUALIZAR_STOCK_INSERTAR_ENTRADA_COMPRA );
            $resultado = $pst->execute([$sum_stock ,$id_produc,$id_prov,$id_inv,$compras['num_piezas'],$compras['precio_unitario'],$sub]);
             
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

//-------- FUNCIÓN PARA EDITAR  PRODUCTO EN INVENTARIO -------//
public static function editar_compras($Compras_editar)
{
    
    try {
        
        $conexion = new Conexion();
        $conn = $conexion->getConexion();
         
        //-------- Se verifica si existe el producto seleccionado con un ID de inventario-------//
        $pst = $conn->prepare(self::$SELECT_ID_INVENTARIO_PRODUCTO);
        $pst->execute([$Compras_editar ['id_producto']]);
        $res = $pst->fetch();
        if (!empty($res)) {

         // ---------- Consultamos las piezas que se había registrado ------------//
         $pst = $conn->prepare(self::$SELECT_NUM_PIEZAS);
         $pst->execute([$Compras_editar['id_entrada_compra']]);
         $piezas = $pst->fetchAll(PDO::FETCH_ASSOC);
         $res_piezas=$piezas[0]["NUM_PIEZAS"];
            
         // --- Le quitamos al stock del inventario las piezas que se registraron con anterioridad---//
      $pst = $conn->prepare(self::$UPDATE1_STOCK);
      $pst->execute([$res_piezas,$res['id_inventario']]);
       
       // ---------- obtenemos el subtotal-----------//
      $subt= $Compras_editar ['precio_unitario'] * $Compras_editar ['num_piezas'];
     
       //--------Actualizamos el stock en inventario de la compra e insertamos los datos de Compra que se editó -------//
       $pst = $conn->prepare(self::$ACTUALIZAR_STOCK_ACTUALIZAR_ENTRADA_COMPRA );
       $resultado = $pst->execute([$Compras_editar['num_piezas'],$res['id_inventario'],$Compras_editar['id_prov'],$res['id_inventario'],$Compras_editar['num_piezas'],$Compras_editar['precio_unitario'],$subt, $Compras_editar['id_entrada_compra']]);

      
        $conn = null;
        $conexion->closeConexion();
        return $msg="OK";
       }
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

//-------- FUNCIÓN PARA ELIMINAR UNA COMPRA -------//
public static function eliminar_compras($id)
{
    try {
        $conexion = new Conexion();
        $conn = $conexion->getConexion();
        //Se abre la transacción.
        $conn->beginTransaction();
        //-------- OBTENEMOS EL ID DE INVENTARIO DEL QUE NECESITAMOS SELECCIONAR STOCK-------//
        $pst = $conn->prepare(self::$SELECT_ID_INVENTARIO);
       $pst->execute([$id]);
       $res = $pst->fetch();
       
         // ---------- Consultamos las piezas que se había registrado ------------//
        $pst = $conn->prepare(self::$SELECT_NUM_PIEZAS);
        $pst->execute([$id]);
        $resultado = $pst->fetchAll(PDO::FETCH_ASSOC);
        $res_piezas=$resultado[0]["NUM_PIEZAS"];
         
    //--------Eliminamos la compra y Actualizamos (restamos) el stock en inventario de la compra eliminada -------//
    $pst = $conn->prepare(self::$BORRAR_COMPRA_ACTUALIZAR_STOCK);
    $resultado = $pst->execute([$id,$res_piezas,$res['id_inventario']]);
        
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

}
?>
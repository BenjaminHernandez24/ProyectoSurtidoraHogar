<?php
require_once "Conexion.php";

class ComprasModelo{


//-------------------- Función para llenar Tabla Compras -----------------//
private static $SELECT_ALL_COMPRAS = "SELECT ec.id_entrada_compra,prov.nom_empresa, prod.nombre_producto, ec.num_piezas, ec.precio_unitario,ec.subtotal, ec.fecha, ec.hora
FROM entrada_compra ec INNER JOIN proveedores prov ON ec.id_prov=prov.id_prov INNER JOIN inventario i ON i.id_inventario=ec.id_inventario INNER JOIN productos prod ON i.id_producto=prod.id_producto";
//-------------------- Funciones  para llenar Select de Productos y Proveedores --------------------//
private static $SELECT_ALL_PRODUCTOS = "SELECT i.id_producto as id_producto,  p.nombre_producto as nombre_producto  FROM inventario i INNER JOIN productos p ON i.id_producto=p.id_producto WHERE p.estatus=1 ORDER BY p.nombre_producto ";
private static $SELECT_ALL_PROVEEDORES = "SELECT id_prov, nom_empresa FROM proveedores WHERE estatus=1 ORDER BY nom_empresa";
//-------------------- Funciones para agregar Compras -----------------------------//
private static $SELECT_ID_INVENTARIO_PRODUCTO_AND_STOCK = "SELECT id_inventario, stock FROM inventario WHERE id_producto= ? ";
private static $ACTUALIZAR_STOCK = "UPDATE inventario set stock=? WHERE id_producto=?";
private static $ENTRADA_COMPRA = "INSERT INTO entrada_compra (id_prov, id_inventario, num_piezas, precio_unitario,subtotal,fecha,hora) VALUES  (?,?,?,?,?, CURDATE(), CURTIME())";
//--------------------- Funciones para Editar una Compra ---------------------//
private static $ACTUALIZAR_STOCK_EC = "UPDATE inventario set stock=(stock+?) WHERE id_inventario=?";
private static $ACTUALIZAR_ENTRADA_COMPRA = "UPDATE entrada_compra SET id_prov=?, id_inventario=?, num_piezas=?, precio_unitario=?, subtotal=?, fecha=CURDATE(), hora=CURTIME() WHERE id_entrada_compra=?";
private static $UPDATE1_STOCK="UPDATE inventario set stock=(stock-?) WHERE id_inventario=?";
private static $SELECT_ID_INVENTARIO_PRODUCTO = "SELECT id_inventario FROM inventario WHERE id_producto= ? ";
private static $SELECT_ID_PRODUCTO = "SELECT id_producto FROM productos WHERE nombre_producto=?";
private static $SELECT_ID_PROVEEDOR = "SELECT id_prov FROM proveedores WHERE nom_empresa=?";
private static $SELECT_NUM_PIEZAS_EDITAR = "SELECT  num_piezas FROM  entrada_compra WHERE id_entrada_compra=? AND fecha = CURDATE()";
//------------ Función para Eliminar una Compra-----------//
private static $BORRAR_COMPRA ="DELETE FROM entrada_compra WHERE id_entrada_compra = ?";
private static $ACTUALIZAR_STOCK_B ="UPDATE inventario set stock=(stock-?) WHERE id_inventario=?";
private static $SELECT_ID_INVENTARIO_AND_NUM_PIEZAS ="SELECT id_inventario, num_piezas FROM  entrada_compra WHERE id_entrada_compra=? AND fecha = CURDATE()";
//------------ Funciones para Autocompletado -----------//
private static $SELECT_ALL = "SELECT p.nombre_producto FROM inventario i INNER JOIN productos p ON i.id_producto=p.id_producto ";
private static $SELECT_LISTA_PRODUCTOS ="SELECT i.id_inventario, p.nombre_producto FROM productos p INNER JOIN inventario i ON p.nombre_producto=? AND i.id_producto=p.id_producto ORDER BY (i.id_inventario) DESC LIMIT 1";

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
public static function agregar_compras($compras, $nombre_producto)
{
    try {
        $conexion = new Conexion();
        $conn = $conexion->getConexion();
            //Se abre la transacción.
            $conn->beginTransaction();
            
            //Recibo id proveedor desde el desplegable de agregar proveedor.
            $id_prov = $compras['id_prov'];
        //-----Consultamos el id_producto con Nombre de Producto -----//
            $pst = $conn->prepare(self::$SELECT_ID_PRODUCTO);
            $pst->execute([$nombre_producto]);
            $resultado_ID= $pst->fetchAll(PDO::FETCH_ASSOC);
            $id_produc = $resultado_ID[0]["id_producto"];

            //-------- Se consulta el  ID de inventario, Y Stock del producto seleccionado-------//
            $pst = $conn->prepare(self::$SELECT_ID_INVENTARIO_PRODUCTO_AND_STOCK);
            $pst->execute([$id_produc]);
            $resultado_produc_stock = $pst->fetchAll(PDO::FETCH_ASSOC);
            $id_inv = $resultado_produc_stock[0]["id_inventario"];
            $sum_stock= $resultado_produc_stock[0]['stock'] + $compras['num_piezas'];
            
            // ---------- obtenemos el subtotal-----------//
            $sub= $compras ['precio_unitario'] * $compras ['num_piezas'];
            //--------Actualizamos el stock en inventario de la compra e insertamos los datos de Compra -------//
            $pst = $conn->prepare(self::$ACTUALIZAR_STOCK);
            $resultado = $pst->execute([$sum_stock ,$id_produc]);

            //Si se ejecutó bien la actualizacion de stock, que inserte en compras.
            if($resultado == 1){
                $pst = $conn->prepare(self::$ENTRADA_COMPRA);
                $resultado = $pst->execute([$id_prov,$id_inv,$compras['num_piezas'],$compras['precio_unitario'],$sub]); 

                //¿Se hizo bien la insercion en compras?
                if ($resultado == 1) {
                    $msg = "OK";
                    //Si todo está correcto se inserta.
                    $conn->commit();
                } else {
                    $msg = "Falló al insertar";
                    //Si algo falla, reestablece la bd a como estaba en un inicio.
                    $conn->rollBack();
                }
            }else{
                $msg = "Falló al insertar";
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
        //Se abre la transacción.
        $conn->beginTransaction();
         //-------Consultamos ID producto -----------//
        $pst = $conn->prepare(self::$SELECT_ID_PRODUCTO);
        $pst->execute([$Compras_editar ['id_producto']]);
        $res = $pst->fetch();
        $res_id_producto = $res ['id_producto'];
           //-------Consultamos ID proveedor-----------//
        $pst = $conn->prepare(self::$SELECT_ID_PROVEEDOR);
        $pst->execute([$Compras_editar ['id_prov']]);
        $res = $pst->fetch();
        $res_id_proveedor = $res ['id_prov'];

        //-------- Se verifica si existe el producto seleccionado con un ID de inventario-------//
        $pst = $conn->prepare(self::$SELECT_ID_INVENTARIO_PRODUCTO);
        $pst->execute([$res_id_producto]);
        $res = $pst->fetch();
        $res_id_inventario = $res['id_inventario'];
        
         // ---------- Consultamos las piezas que se había registrado y se Valida la fecha de la Compra------------//
         $pst = $conn->prepare(self::$SELECT_NUM_PIEZAS_EDITAR);
         $pst->execute([$Compras_editar['id_entrada_compra']]);
         $piezas = $pst->fetchAll(PDO::FETCH_ASSOC);
         
         if (!empty($piezas)) {
            $res_piezas=$piezas[0]["num_piezas"];

         // --- Le quitamos al stock del inventario las piezas que se registraron con anterioridad---//
      $pst = $conn->prepare(self::$UPDATE1_STOCK);
      $pst->execute([$res_piezas, $res_id_inventario]);
       
       // ---------- obtenemos el subtotal-----------//
      $subt= $Compras_editar ['precio_unitario'] * $Compras_editar ['num_piezas'];
     
       //--------Actualizamos el stock en inventario de la compra e insertamos los datos de Compra que se editó -------//
       $pst = $conn->prepare(self::$ACTUALIZAR_STOCK_EC );
       $resultado = $pst->execute([$Compras_editar['num_piezas'], $res_id_inventario]);

       $pst = $conn->prepare(self::$ACTUALIZAR_ENTRADA_COMPRA);
       $resultado = $pst->execute([$res_id_proveedor, $res_id_inventario,$Compras_editar['num_piezas'],$Compras_editar['precio_unitario'],$subt, $Compras_editar['id_entrada_compra']]);
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
          //------ Si la compra no es actual, no se permite realizar cambios. -----// 
        } else {
            return $msg="NO";
        }
        $conn = null;
        $conexion->closeConexion();
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
         //---------- Se valida fecha actual de Compra -----------//
        //-------- OBTENEMOS EL ID DE INVENTARIO DEL QUE NECESITAMOS SELECCIONAR STOCK-------//
        $pst = $conn->prepare(self::$SELECT_ID_INVENTARIO_AND_NUM_PIEZAS);
       $pst->execute([$id]);
       $result = $pst->fetchAll(PDO::FETCH_ASSOC);
       if (!empty($result)) {

       $id_inventario = $result[0]["id_inventario"];
       $res_piezas=$result[0]["num_piezas"];
    

    $pst = $conn->prepare(self::$ACTUALIZAR_STOCK_B);
    $resultado = $pst->execute([$res_piezas,$id_inventario]);
         
    //--------Eliminamos la compra y Actualizamos (restamos) el stock en inventario de la compra eliminada -------//
    $pst = $conn->prepare(self::$BORRAR_COMPRA);
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
       //------ Si la compra no es actual, no se permite realizar cambios. -----//
    } else {
        return $msg="NO";
    }

    $conn = null;
    $conexion->closeConexion();

    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
//--------------- FUNCIONES PARA AUTOCOMPLETADO DE PRODUCTOS -------------//
public static function obtenerProductos()
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            $pst = $conn->prepare(self::$SELECT_ALL);
            $pst->execute();

            $productos = $pst->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            $conexion->closeConexion();

            return $productos;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
public static function obtener_lista_productos($nombre)
{
    try {
        $conexion = new Conexion();
        $conn = $conexion->getConexion();

        $pst = $conn->prepare(self::$SELECT_LISTA_PRODUCTOS);
        $pst->execute([$nombre]);

        $datosProductos = $pst->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        $conexion->closeConexion();

        return $datosProductos;
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}


}
?>
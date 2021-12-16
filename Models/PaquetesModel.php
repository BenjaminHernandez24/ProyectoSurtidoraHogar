<?php
require_once "Conexion.php";
class PaqueteModelo
{
    //------------ Consultas para Autocompletado -----------//
    private static $SELECT_ALL = "SELECT nombre_producto FROM productos WHERE estatus=1";
    private static $SELECT_LISTA_PRODUCTOS ="SELECT nombre_producto,precio_publico FROM productos WHERE estatus=1 AND nombre_producto=? ORDER BY (nombre_producto) DESC LIMIT 1";
    //------------ Consultas para Select de Tipo y Marca Paquete -----------//
    //private static $INSERTAR_PRODUCTO = "INSERT INTO productos (nombre_producto, id_tipo, id_marca, precio_publico, estatus) values (?, ?, ?, ?, ?)";
    private static $SELECT_ALL_TIPO_PRODUCTO = "SELECT * FROM tipo_producto WHERE estatus = 1 ORDER BY descripcion_tipo ";
    private static $SELECT_ALL_MARCA_PRODUCTO = "SELECT * FROM marcas_producto WHERE estatus = 1 ORDER BY descripcion_marca";
    //---------- Consultas para actualizar estatus de productos ------------// 
    private static $ACTUALIZAR_PRODUCTO = "UPDATE productos set estatus_paquete = 1 WHERE id_producto = ?";
    private static $BUSCAR_PROD_ID = "SELECT id_producto FROM productos WHERE nombre_producto=?";
    //---------- Consultas para insertar paquete ------------// 
    private static $INSERTAR_PAQUETE = "INSERT INTO paquetes (id_prod_asociado, id_prod_generado, num_piezas) values (?, ?, ?)";
    private static $BORRAR_PRODUCTO = "DELETE FROM paquetes WHERE  id_prod_asociado = ?";
    private static $SELECT_PAQUETES = "SELECT nombre_paquete, num_piezas, subtotal FROM paquetes";
    private static $BUSCAR_PRODUCTO = "SELECT id_producto FROM productos WHERE nombre_producto = ?";
    private static $INSERTAR_PRODUCTO_PAQUETE = "INSERT INTO productos (nombre_producto, id_tipo, id_marca, precio_publico, estatus, estatus_paquete) values (?, ?, ?, ?, ?, ?);";
    private static $BUSCAR_ID_GENERADO_PAQUETE = "SELECT * FROM productos WHERE nombre_producto = ? ORDER BY id_producto DESC LIMIT 1;";
   //-------- FUNCIÓN PARA INSERTAR PRODUCTO-PAQUETE  -------//
   public static function agregar_productos($nombre,$nombre_paquete, $cantidad, $tipo, $marca, $total_paquete)
   {
       try {
           $conexion = new Conexion();
           $conn = $conexion->getConexion();
           
           //Se abre la transacción.
           $conn->beginTransaction();

           //-------- Se busca el ID del producto ------//
           $pst = $conn->prepare(self::$BUSCAR_PRODUCTO);
           $pst->execute([$nombre]);
           $res_consulta= $pst->fetchAll(PDO::FETCH_ASSOC);
           $id_producto = $res_consulta[0]["id_producto"];

           if (!empty($id_producto)) { 
 
              /* Insertamos el producto-paquete en tabla PRODUCTOS. */
               $pst = $conn->prepare(self::$INSERTAR_PRODUCTO_PAQUETE); 
               $resultado=$pst->execute([$nombre_paquete, $tipo, $marca, $total_paquete, 1, 1]); 
              /* Recuperamos el id del producto generado. */
               $pst = $conn->prepare(self::$BUSCAR_ID_GENERADO_PAQUETE); 
               $pst->execute([$nombre_paquete]); 
               $resultado2 = $pst->fetchAll(PDO::FETCH_ASSOC); 
               $id_producto_generado = $resultado2[0]["id_producto"];

               if($resultado == 1){
                /* Si obtenemos el id_generado, insertamos en tabla PAQUETES. */
                $pst = $conn->prepare(self::$INSERTAR_PAQUETE);
                $resultado=$pst->execute([$id_producto, $id_producto_generado, $cantidad]); 
                   
               if ($resultado == 1) {
                   $msg = "OK";
                   //Si todo está correcto se inserta.
                   $conn->commit();
               } else {
                   $msg = "Falló al agregar productos";
                   //Si algo falla, reestablece la bd a como estaba en un inicio.
                   $conn->rollBack();
               }

               $conn = null;
               $conexion->closeConexion();

               return $msg;
        } else {
               return $msg="ERROR";
           }
        }else{
            $msg = "ERROR";
            $conn->rollBack();
        }
           $conn = null;
           $conexion->closeConexion();  
          
       } catch (PDOException $e) {
           return $e->getMessage();
       }
   }
    //-------- FUNCIÓN PARA ELIMINAR PRODUCTO -------//
    public static function eliminar_productos($producto)
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();
            //Se abre la transacción.
            $conn->beginTransaction();

            //-------- Se busca el ID del producto ------//
            $pst = $conn->prepare(self::$BUSCAR_PROD_ID);
            $pst->execute([$producto]);
            $id_prod= $pst->fetchAll(PDO::FETCH_ASSOC);
            $id_producto = $id_prod[0]["id_producto"];

            if (!empty($id_producto)) {
                $pst = $conn->prepare(self::$BORRAR_PRODUCTO);
                $resultado=$pst->execute([$id_producto]);

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

            } else {
                return $msg="ERROR";
            }

            $conn = null;
            $conexion->closeConexion();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    //-------- FUNCIÓN PARA OBTENER LOS PRODUCTOS DE PAQUETES-------//
    public static function obtener_paquetes()
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            $pst = $conn->prepare(self::$SELECT_PAQUETES);
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
    public static function obtener_tipo_paquetes()
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
    public static function obtener_marca_paquetes()
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
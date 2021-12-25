<?php
require_once "Conexion.php";
class PaqueteModelo
{
    //------------ Consultas para Autocompletado -----------//
    private static $SELECT_ALL = "SELECT nombre_producto, precio_publico FROM productos WHERE estatus=1 AND estatus_paquete = 0";
    private static $obtenerID = "SELECT id_producto FROM productos WHERE nombre_producto=?";
    private static $ID_TIPO = "SELECT id_tipo FROM tipo_producto WHERE descripcion_tipo = ?";
    private static $ID_MARCA = "SELECT id_marca FROM marcas_producto WHERE descripcion_marca= ?";
    
    //------------ Consultas para Select de Tipo y Marca Paquete -----------//
    //private static $INSERTAR_PRODUCTO = "INSERT INTO productos (nombre_producto, id_tipo, id_marca, precio_publico, estatus) values (?, ?, ?, ?, ?)";
    private static $SELECT_ALL_TIPO_PRODUCTO = "SELECT * FROM tipo_producto WHERE estatus = 1 ORDER BY descripcion_tipo ";
    private static $SELECT_ALL_MARCA_PRODUCTO = "SELECT * FROM marcas_producto WHERE estatus = 1 ORDER BY descripcion_marca";
    
    //---------- Consultas para actualizar estatus de productos ------------// 
    private static $ACTUALIZAR_PRODUCTO = "UPDATE productos set estatus_paquete = 1 WHERE id_producto = ?";
    
    //---------- Consultas para Insertar paquete ------------// 
    private static $INSERTAR_PAQUETE = "INSERT INTO paquetes (id_prod_asociado, id_prod_generado, piezas) values (?, ?, ?)";
    private static $BORRAR_PRODUCTO = "DELETE FROM paquetes WHERE  id_prod_asociado = ?";
    private static $SELECT_PAQUETES_PRODUCTOS = "SELECT p.id_producto, p.nombre_producto, tp.descripcion_tipo, mp.descripcion_marca, p.precio_publico, p.estatus FROM productos p INNER JOIN tipo_producto tp ON p.id_tipo=tp.id_tipo INNER JOIN marcas_producto mp ON p.id_marca=mp.id_marca AND p.estatus_paquete = 1;";
    private static $BUSCAR_PRODUCTO = "SELECT id_producto FROM productos WHERE nombre_producto = ?";
    private static $INSERTAR_PRODUCTO_PAQUETE = "INSERT INTO productos (nombre_producto, id_tipo, id_marca, precio_publico, estatus, estatus_paquete) values (?, ?, ?, ?, ?, ?);";
    private static $BUSCAR_ID_GENERADO_PAQUETE = "SELECT * FROM productos WHERE nombre_producto = ? ORDER BY id_producto DESC LIMIT 1;";
    
    //---------- Consultas para Borrar paquete ------------// 
    private static $BORRAR_PRODUCTO_RELACIONADO = "DELETE FROM paquetes WHERE id_prod_generado = ?;";
    private static $BORRAR_PRODUCTO_PAQUETE = "DELETE FROM productos WHERE id_producto = ?;";
    private static $CAMBIAR_ESTATUS = "UPDATE productos SET estatus = ? WHERE id_producto = ?;";
    private static $OBTENER_ID_PRODUCTOS = "SELECT pa.id_prod_asociado, pa.id_prod_generado FROM productos p INNER JOIN paquetes pa ON p.nombre_producto = ? AND pa.id_prod_generado = p.id_producto;";
    private static $OBTENER_DATOS_PRODUCTOS = "SELECT p.nombre_producto, p.precio_publico, pa.piezas FROM productos p INNER JOIN paquetes pa ON p.id_producto = ? AND pa.id_prod_generado = ?";
    
    //-------- FUNCIÓN PARA INSERTAR PRODUCTO-PAQUETE  -------//
    public static function agregar_productos($nombre_paquete, $datos, $pocisiones, $tipo, $marca, $total_paquete)
    {
        $estado = 0;
        try 
        {
            $msg = "";
            $conexion = new Conexion();
            $conn = $conexion->getConexion();
        
            //Se abre la transacción.
            $conn->beginTransaction();

            //Obtenemos tipo
            $pst = $conn->prepare(self::$ID_TIPO); 
            $pst->execute([$tipo]);
            $tipo_prod = $pst->fetch();

            //obtenemos marca
            $pst = $conn->prepare(self::$ID_MARCA); 
            $pst->execute([$marca]);
            $marca_prod = $pst->fetch();

            /* Insertamos el producto-paquete en tabla PRODUCTOS. */
            $pst = $conn->prepare(self::$INSERTAR_PRODUCTO_PAQUETE); 
            $resultado=$pst->execute([$nombre_paquete, $tipo_prod[0], $marca_prod[0], $total_paquete, 1, 1]);

            if($resultado == 1){
                //Si se insertó bien, vamos a extraer el ID insertado.
                $pst       = $conn->prepare("SELECT LAST_INSERT_ID();");
                $pst->execute();
                $id_paquete = $pst->fetch();

                //Insertamos dinámicamente en la tabla de paquetes.
                for($i = 0; $i < $pocisiones; $i++){
                    $pst = $conn->prepare(self::$INSERTAR_PAQUETE);
                    $resultado = $pst->execute([$datos[$i]["id_Producto"], $id_paquete[0], $datos[$i]["Cantidad"]]);
                    
                    if ($resultado != 1) {
                        $estado = 1;
                        break;
                    }
                }

                if($estado == 0){
                    $msg = "OK";
                    //Si todo esta correcto insertamos.
                    $conn->commit();
                }else{
                    $msg = "Fallo al insertar";
                    //Si algo falla, reestablece la bd a como estaba en un inicio.
                    $conn->rollBack();
                    $estado = 0;
                }
            }else{
                $msg = "Fallo al insertar";
                //Si algo falla, reestablece la bd a como estaba en un inicio.
                $conn->rollBack();
            }

            return $msg;   
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

            $pst = $conn->prepare(self::$SELECT_PAQUETES_PRODUCTOS);
            $pst->execute();

            $productos = $pst->fetchAll();
            $conn = null;
            $conexion->closeConexion();

            return $productos;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    //-------- FUNCIÓN PARA OBTENER ID DE LOS PRODUCTOS AGREGADOS A LA TABLA-------//
    public static function obtenerID($nombre)
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            $pst = $conn->prepare(self::$obtenerID);
            $pst->execute([$nombre]);

            $id = $pst->fetchAll();
            
            $conn = null;
            $conexion->closeConexion();

            if($id == NULL){
                $msg = 0;
            }else{
                $msg = $id[0]["id_producto"];
            }
            return $msg;
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

    //-------- FUNCIÓN PARA ELIMINAR PAQUETE -------//
    public static function eliminar_paquete($id_paquete)
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();
            //Se abre la transacción.
            $conn->beginTransaction();

            //Independiente del cascade eliminamos manualmente de paquetes
            $pst = $conn->prepare(self::$BORRAR_PRODUCTO_RELACIONADO);
            $resultado =$pst->execute([$id_paquete]);

            if ($resultado == 1) {
                //y luego de productos
                $pst = $conn->prepare(self::$BORRAR_PRODUCTO_PAQUETE);
                $resultado =$pst->execute([$id_paquete]);
                if ($resultado == 1) {
                    $msg = "OK";
                    //Si todo está correcto se inserta.
                    $conn->commit();
                } else {
                    $msg = "Falló al eliminar";
                    //Si algo falla, reestablece la bd a como estaba en un inicio.
                    $conn->rollBack();
                }
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

    //FUNCION PARA CAMBIAR EL ESTATUS DEL PAQUETE
    public static function Estatus($paquete)
    {
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            //Abro la transacción.
            $conn->beginTransaction();

            $pst       = $conn->prepare(self::$CAMBIAR_ESTATUS);
            $resultado = $pst->execute([$paquete['estatus'], $paquete['id_producto']]);

            if ($resultado == 1) {
                $msg = "OK";
                //Si todo esta correcto insertamos.
                $conn->commit();
            } else {
                $msg = "Fallo al cambiar estatus";
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

    //EXTRAER DATOS PARA EDITAR LOS PAQUETES
    public static function extraerDatosTablaEditar($nombre_paquete){
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            //Obtenemos los ID relacionados al paquete seleccionado
            $pst = $conn->prepare(self::$OBTENER_ID_PRODUCTOS);
            $pst->execute([$nombre_paquete]);
            $resultado = $pst->fetchAll();

            $enviar_datos = [];

            for($i = 0; $i < count($resultado); $i++){
                //Obtenemos informacion por separado de los productos asociados al paquete
                $pst = $conn->prepare(self::$OBTENER_DATOS_PRODUCTOS);
                $pst->execute([$resultado[$i]["id_prod_asociado"],$resultado[0]["id_prod_generado"]]);
                $datos_producto = $pst->fetchAll();

                //Arreglo preparado
                $enviar_datos[$i] = [
                    "id_producto" => $resultado[$i]["id_prod_asociado"],
                    "nombre_producto" => $datos_producto[$i]["nombre_producto"],
                    "piezas" => $datos_producto[$i]["piezas"],
                    "precio" => $datos_producto[$i]["precio_publico"]
                ];
            }

            $conn = null;
            $conexion->closeConexion();

            return $enviar_datos;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
?>
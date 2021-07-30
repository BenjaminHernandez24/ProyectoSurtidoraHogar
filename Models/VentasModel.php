<?php
require_once "Conexion.php";

class VentasModelo
{
    private static $INSERTAR_CLIENTE = "INSERT INTO clientes(nombre_cli, tipo, telefono, Estatus) VALUES(?,?,?,1)";
    private static $INSERTAR_DETALLE_SALIDA_VENTA = "INSERT INTO detalle_salida_venta(cliente,metodo_pago,total,pago,cambio,impresiones,fecha,hora,folio) values(?,?,?,?,?,?,(SELECT CURRENT_DATE),(SELECT CURRENT_TIME),?);";
    private static $INSERTAR_SALIDA_VENTA = "INSERT INTO salida_venta(id_inventario,num_piezas,precio_a_vender,subtotal,id_detalle_salida_venta) VALUES(?,?,?,?,?)";
    private static $SELECT_ALL = "SELECT p.nombre_producto FROM inventario i INNER JOIN productos p ON i.id_producto=p.id_producto AND i.stock > 0";
    private static $SELECT_DATE_PRODUCTOS = "SELECT i.id_inventario, p.nombre_producto,i.stock,p.precio_publico FROM productos p INNER JOIN inventario i ON p.nombre_producto=? AND i.id_producto=p.id_producto ORDER BY (i.id_inventario) DESC LIMIT 1";
    private static $CLIENTES = "SELECT id_cli,nombre_cli,tipo,telefono FROM `clientes` WHERE Estatus = 1";
    private static $RESTA_STOCK = "UPDATE inventario SET stock= (stock-?) WHERE id_inventario = ?";
    private static $SUMA_STOCK = "UPDATE inventario SET stock= (stock+?) WHERE id_inventario = ?";
    private static $STOCK = "SELECT STOCK FROM inventario WHERE id_inventario = ?";
    /* ===========================
        FUNCION PARA AGREGAR DETALLE SALIDA VENTA
     =============================*/
    public static function AgregarDetalleSalidaVenta($venta, $datos, $posicion)
    {
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            //Abro la transacción.
            $conn->beginTransaction();

            $pst       = $conn->prepare(self::$INSERTAR_DETALLE_SALIDA_VENTA);
            $resultado = $pst->execute([$venta['cliente'], $venta['pago'], $venta['total'], $venta['cobro'], $venta['cambio'], $venta['impresion'],$venta['folio']]);

            $pst       = $conn->prepare("SELECT LAST_INSERT_ID();");
            $pst->execute();
            $id = $pst->fetch();

            if ($resultado == 1) {
                $pst       = $conn->prepare(self::$INSERTAR_SALIDA_VENTA);

                for ($i = 0; $i < $posicion; $i++) {
                    $resultado = $pst->execute([$datos[$i]['Inventario'], $datos[$i]['Cantidad'], $datos[$i]['Precio'], $datos[$i]['Total'], $id[0]]);
                }

                if ($resultado == 1) {
                    $msg = "OK";
                    //Si todo esta correcto insertamos.
                    $conn->commit();
                } else {
                    $msg = "Fallo al insertar";
                    //Si algo falla, reestablece la bd a como estaba en un inicio.
                    $conn->rollBack();
                }
            } else {
                $msg = "Fallo al insertar";
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

    /* ===========================
        FUNCION PARA AGREGAR CLIENTES
     =============================*/
    public static function AgregarCliente($cliente)
    {
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            //Abro la transacción.
            $conn->beginTransaction();

            $pst       = $conn->prepare(self::$INSERTAR_CLIENTE);
            $resultado = $pst->execute([$cliente['nombre_cli'], $cliente['tipo'], $cliente['telefono']]);

            if ($resultado == 1) {
                $msg = "OK";
                //Si todo esta correcto insertamos.
                $conn->commit();
            } else {
                $msg = "Fallo al insertar";
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

    /* ===========================
        FUNCION PARA OBTENER TODO LOS CLIENTES
     =============================*/
    public static function getClientes()
    {
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            $pst = $conn->prepare(self::$CLIENTES);
            $pst->execute();

            $clientes = $pst->fetchAll();

            $conn = null;
            $conexion->closeConexion();

            return $clientes;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /* ===========================
        FUNCION PARA OBTENER TODO LOS PRODUCTOS
     =============================*/
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

    /* ===========================
        FUNCION PARA OBTENER STOCK DEL PRODUCTO
     =============================*/
    public static function obtenerStock($ID)
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            $pst = $conn->prepare(self::$STOCK);
            $pst->execute([$ID]);

            $productos = $pst->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            $conexion->closeConexion();

            return $productos;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /* ===========================
        FUNCION PARA OBTENER LOS DATOS DEL PRODUCTO
     =============================*/
    public static function obtenerDatosProductos($nombre)
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            $pst = $conn->prepare(self::$SELECT_DATE_PRODUCTOS);
            $pst->execute([$nombre]);

            $datosProductos = $pst->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            $conexion->closeConexion();

            return $datosProductos;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /* ===========================
        FUNCION PARA RESTAR STOCK
     =============================*/
    public static function restarInventario($id, $cantidad)
    {
        try {

            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            //Abro la transacción.
            $conn->beginTransaction();

            $pst = $conn->prepare(self::$RESTA_STOCK);

            $resultado = $pst->execute([$cantidad, $id]);

            if ($resultado == 1) {
                //Si todo esta correcto insertamos.

                $pst = $conn->prepare(self::$STOCK);
                $pst->execute([$id]);

                $stock_verificar = $pst->fetchAll(PDO::FETCH_ASSOC);

                if ($stock_verificar[0]["STOCK"] < 0) {
                    $msg = "ERROR";
                    $conn->rollBack();
                } else {
                    $msg = "OK";
                    $conn->commit();
                }
            } else {
                //Si algo falla, reestablece la bd a como estaba en un inicio.
                $msg = "ERROR";
                $conn->rollBack();
            }

            $conn = null;
            $conexion->closeConexion();

            return $msg;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    /* ===========================
        FUNCION PARA SUMAR STOCK
     =============================*/
    public static function sumarInventario($id, $cantidad)
    {
        try {

            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            //Abro la transacción.
            $conn->beginTransaction();

            $pst = $conn->prepare(self::$SUMA_STOCK);

            $resultado = $pst->execute([$cantidad, $id]);

            if ($resultado == 1) {
                //Si todo esta correcto insertamos.
                $conn->commit();
            } else {
                //Si algo falla, reestablece la bd a como estaba en un inicio.
                $conn->rollBack();
            }

            $conn = null;
            $conexion->closeConexion();

            return "OK";
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function ContarVentas()
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            $pst = $conn->prepare("SELECT COUNT(*) AS total FROM detalle_salida_venta");
            $pst->execute();
            $ventas = $pst->fetch();

            $pst = $conn->prepare("SELECT MAX(folio) FROM detalle_salida_venta WHERE impresiones = 'Ticket' or impresiones= 'Ambos'");
            $pst->execute();
            $maximo = $pst->fetch();

            $pst = $conn->prepare("SELECT COUNT(impresiones) FROM detalle_salida_venta WHERE impresiones = 'Ticket' or impresiones= 'Ambos'");
            $pst->execute();
            $contador = $pst->fetch();

            $resultado_consultas =[
                "ventas" => $ventas['total'],
                "maximo"       => $maximo['MAX(folio)'],
                "contador"       => $contador['COUNT(impresiones)'],
            ];

            return $resultado_consultas;

            $conexion->closeConexion();
            $conn = null;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}

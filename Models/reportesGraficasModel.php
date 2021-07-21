<?php
require_once "Conexion.php";
class reportesGraficasModel
{
    private static $top5Productos = "SELECT p.nombre_producto as productos, SUM(sv.num_piezas) as piezas 
    FROM detalle_salida_venta dsv 
    INNER JOIN salida_venta sv ON sv.id_detalle_salida_venta = dsv.id_detalle_salida_venta
    INNER JOIN inventario i ON i.id_inventario = sv.id_inventario
    INNER JOIN productos p ON p.id_producto = i.id_producto
    AND MONTH(dsv.fecha)= (SELECT MONTH(CURRENT_DATE))
    AND YEAR(dsv.fecha) = (SELECT YEAR(CURRENT_DATE)) GROUP BY(sv.id_inventario)
    ORDER BY (SUM(sv.num_piezas)) DESC LIMIT 5";

    private static $obtenerTodosProductos = "SELECT p.nombre_producto FROM inventario i INNER JOIN productos p ON i.id_producto=p.id_producto";

    private static $obtenerProveedor = "SELECT prov.nom_prov as proveedor, ec.precio_unitario as precio,ec.fecha as fecha, ec.hora as hora 
    FROM entrada_compra ec INNER JOIN proveedores prov ON prov.id_prov=ec.id_prov 
    AND ec.id_entrada_compra IN
    (SELECT MAX(ec.id_entrada_compra) FROM entrada_compra ec
    INNER JOIN productos p ON p.nombre_producto=?
    INNER JOIN inventario i ON i.id_producto = p.id_producto AND ec.id_inventario = i.id_inventario
    GROUP BY ec.id_prov) ORDER BY ec.precio_unitario ASC LIMIT 1";

    private static $ExtraerComprasGenerales = "SELECT prov.nom_prov as proveedor, p.nombre_producto producto, 
    ec.num_piezas as piezas, ec.precio_unitario as precio_unitario, ec.subtotal as subtotal, ec.fecha as fecha, ec.hora as hora 
    FROM entrada_compra ec
    INNER JOIN proveedores prov ON prov.id_prov= ec.id_prov
    INNER JOIN inventario i ON i.id_inventario = ec.id_inventario
    INNER JOIN productos p ON p.id_producto = i.id_producto
    AND ec.fecha >= ? AND ec.fecha<= ?
    ORDER BY ec.fecha, ec.hora ASC";

    private static $ExtraerComprasGeneralesUnicas = "SELECT prov.nom_prov as proveedor, p.nombre_producto producto, 
    ec.num_piezas as piezas, ec.precio_unitario as precio_unitario, ec.subtotal as subtotal, ec.fecha as fecha, ec.hora as hora 
    FROM entrada_compra ec
    INNER JOIN proveedores prov ON prov.id_prov= ec.id_prov
    INNER JOIN inventario i ON i.id_inventario = ec.id_inventario
    INNER JOIN productos p ON p.id_producto = i.id_producto
    AND ec.fecha = ?
    ORDER BY ec.fecha, ec.hora ASC";

    private static $ExtraerComprasEspecificoRango = "SELECT p.nombre_producto producto, 
    ec.num_piezas as piezas, ec.precio_unitario as precio_unitario, ec.subtotal as subtotal, ec.fecha as fecha, ec.hora as hora 
    FROM proveedores prov
    INNER JOIN entrada_compra ec ON prov.nom_prov=? AND ec.id_prov=prov.id_prov
    INNER JOIN inventario i ON i.id_inventario = ec.id_inventario
    INNER JOIN productos p ON p.id_producto = i.id_producto
    AND ec.fecha >= ? AND ec.fecha<= ?
    ORDER BY ec.fecha, ec.hora ASC";

    private static $ExtraerComprasEspecificoUnico = "SELECT p.nombre_producto producto, 
    ec.num_piezas as piezas, ec.precio_unitario as precio_unitario, ec.subtotal as subtotal, ec.fecha as fecha, ec.hora as hora 
    FROM proveedores prov
    INNER JOIN entrada_compra ec ON prov.nom_prov=? AND ec.id_prov=prov.id_prov
    INNER JOIN inventario i ON i.id_inventario = ec.id_inventario
    INNER JOIN productos p ON p.id_producto = i.id_producto
    AND ec.fecha = ?
    ORDER BY ec.fecha, ec.hora ASC";

    private static $obtenerTodosLosProveedores = "SELECT nom_prov FROM proveedores";
    
    private static $ventasTotalesUnicas = "SELECT dsv.id_detalle_salida_venta as venta, dsv.cliente as cliente,p.nombre_producto as producto,sv.num_piezas as piezas,sv.precio_a_vender as precio_pub,sv.subtotal as subtotal,dsv.fecha as fecha,dsv.hora as hora, dsv.total as total FROM salida_venta sv 
    INNER JOIN detalle_salida_venta dsv ON dsv.fecha =?  AND sv.id_detalle_salida_venta=dsv.id_detalle_salida_venta
    INNER JOIN inventario i ON i.id_inventario=sv.id_inventario
    INNER JOIN productos p ON p.id_producto = i.id_producto ORDER BY dsv.fecha,dsv.hora ASC";

    private static $ventasTotalesRango = "SELECT dsv.id_detalle_salida_venta as venta, dsv.cliente as cliente,p.nombre_producto as producto,sv.num_piezas as piezas,sv.precio_a_vender as precio_pub,sv.subtotal as subtotal,dsv.fecha as fecha,dsv.hora as hora, dsv.total as total FROM salida_venta sv 
    INNER JOIN detalle_salida_venta dsv ON dsv.fecha >=? AND dsv.fecha <= ? AND sv.id_detalle_salida_venta=dsv.id_detalle_salida_venta
    INNER JOIN inventario i ON i.id_inventario=sv.id_inventario
    INNER JOIN productos p ON p.id_producto = i.id_producto ORDER BY dsv.fecha,dsv.hora ASC";
    /*==============================================================================*/

    public static function top5ProductosModel()
    {
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            $pst = $conn->prepare(self::$top5Productos);
            $pst->execute();

            $datos = $pst->fetchAll(PDO::FETCH_ASSOC);

            $conn = null;
            $conexion->closeConexion();

            return $datos;

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function obtenerProductos()
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            $pst = $conn->prepare(self::$obtenerTodosProductos);
            $pst->execute();

            $productos = $pst->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            $conexion->closeConexion();

            return $productos;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function obtenerProveedor($datos)
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            $pst = $conn->prepare(self::$obtenerProveedor);
            $pst->execute([$datos['valor']]);

            $productos = $pst->fetchAll(PDO::FETCH_ASSOC);
            $conn = null;
            $conexion->closeConexion();

            return $productos;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /* OBTENER LOS CLIENTES DE LA BASE DE DATOS */
    public static function getComprasGenerales($datos)
    {
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            $pst = $conn->prepare(self::$ExtraerComprasGenerales);
            $pst->execute([$datos['fecha_inicio'],$datos['fecha_final']]);

            $compras = $pst->fetchAll(PDO::FETCH_ASSOC);

            $conn = null;
            $conexion->closeConexion();

            return $compras;

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function getComprasGeneralesUnicas($datos)
    {
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            $pst = $conn->prepare(self::$ExtraerComprasGeneralesUnicas);
            $pst->execute([$datos['fecha']]);

            $compras = $pst->fetchAll(PDO::FETCH_ASSOC);

            $conn = null;
            $conexion->closeConexion();

            return $compras;

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function obtenerTodosProveedores()
    {
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            $pst = $conn->prepare(self::$obtenerTodosLosProveedores);
            $pst->execute();

            $proveedores = $pst->fetchAll(PDO::FETCH_ASSOC);

            $conn = null;
            $conexion->closeConexion();

            return $proveedores;

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function getComprasEspecificoRango($dato)
    {
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            $pst = $conn->prepare(self::$ExtraerComprasEspecificoRango);
            $pst->execute([$dato['proveedor'],$dato['fecha_inicio'],$dato['fecha_final']]);

            $compras = $pst->fetchAll(PDO::FETCH_ASSOC);

            $conn = null;
            $conexion->closeConexion();

            return $compras;

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function getComprasEspecificaUnicas($datos)
    {
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            $pst = $conn->prepare(self::$ExtraerComprasEspecificoUnico);
            $pst->execute([$datos['proveedor'], $datos['fecha']]);

            $compras = $pst->fetchAll(PDO::FETCH_ASSOC);

            $conn = null;
            $conexion->closeConexion();

            return $compras;

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function reporteVentasRango($datos)
    {
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            $pst = $conn->prepare(self::$ventasTotalesRango);
            $pst->execute([$datos['fecha_inicio'],$datos['fecha_final']]);

            $compras = $pst->fetchAll(PDO::FETCH_ASSOC);

            $conn = null;
            $conexion->closeConexion();

            return $compras;

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function reporteVentasUnicas($datos)
    {
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            $pst = $conn->prepare(self::$ventasTotalesUnicas);
            $pst->execute([$datos['fecha']]);

            $compras = $pst->fetchAll(PDO::FETCH_ASSOC);

            $conn = null;
            $conexion->closeConexion();

            return $compras;

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

}

<?php
require_once "Conexion.php";
class GraficasModel
{

    private static $frecuenciaClientes = "
        SELECT dsv.cliente as clientes, COUNT(*) as frecuencia FROM detalle_salida_venta dsv WHERE YEAR(dsv.fecha)=(SELECT YEAR(current_date)) 
        AND MONTH(dsv.fecha)=(SELECT MONTH(current_date))
        AND dsv.cliente!= 'cliente'
        GROUP BY (dsv.cliente) ORDER BY (COUNT(*)) 
        DESC LIMIT 4";

    private static $idioma              = "SET lc_time_names = 'es_ES'";
    private static $ventasTotalesPorMes = "
        SELECT UPPER(MONTHNAME(dsv.fecha)) as mes, 
        SUM(dsv.total) as ventasTotales 
        FROM detalle_salida_venta dsv 
        WHERE YEAR(dsv.fecha)=(SELECT YEAR(current_date)) 
        GROUP BY(UPPER(MONTHNAME(dsv.fecha))) 
        ORDER BY dsv.fecha";

    /* ===================================================================================
    OBTENER LOS PRIMEROS 4 CLIENTES, RETORNAR SUS NOMBRES Y LAS VECES QUE HAN COMPRADO DURANTE EL MES
    ===================================================================================*/
    public static function frecuenciaClientes()
    {
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            $pst = $conn->prepare(self::$frecuenciaClientes);
            $pst->execute();

            $datos = $pst->fetchAll(PDO::FETCH_ASSOC);

            $conn = null;
            $conexion->closeConexion();

            return $datos;

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /* ===================================================================================
    OBTENER LAS VENTAS TOTALES POR MES, RETORNAR NOMBRE DEL MES Y LA CANTIDAD TOTAL
    ===================================================================================*/
    public static function ventasTotalesPorMes()
    {
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            $pst = $conn->prepare(self::$idioma);
            $pst->execute();

            $pst = $conn->prepare(self::$ventasTotalesPorMes);
            $pst->execute();

            $datos = $pst->fetchAll(PDO::FETCH_ASSOC);

            $conn = null;
            $conexion->closeConexion();

            return $datos;

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}

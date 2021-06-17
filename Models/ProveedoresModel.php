<?php
require_once "Conexion.php";
class ProveedoresModelo
{
    private static $INSERTAR_PROVEEDOR = "INSERT INTO proveedores(nom_empresa,tel_empresa,nom_prov,tel_prov) values (?,?,?,?)";
    private static $SELECT_ALL = "SELECT * FROM proveedores";

    public static function agregarProveedor($proveedor)
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            $pst = $conn->prepare(self::$INSERTAR_PROVEEDOR);
            $pst->execute([$proveedor['nom_empresa'], $proveedor['tel_empresa'], $proveedor['nom_prov'], $proveedor['tel_prov']]);

            $conn = null;
            $conexion->closeConexion();

            return "OK";
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function obtenerProveedores()
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            $pst = $conn->prepare(self::$SELECT_ALL);
            $pst->execute();

            $proveedores = $pst->fetchAll();
            $conn = null;
            $conexion->closeConexion();

            return $proveedores;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}

?>

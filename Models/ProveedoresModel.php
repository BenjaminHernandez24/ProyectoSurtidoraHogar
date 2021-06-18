  
<?php
require_once "Conexion.php";
class ProveedoresModelo
{
    private static $INSERTAR_PROVEEDOR = "INSERT INTO proveedores(nom_empresa,tel_empresa,nom_prov,tel_prov,estatus) values (?,?,?,?,?)";
    private static $EDITAR_PROVEEDOR = "UPDATE proveedores set nom_empresa=?,tel_empresa=?,nom_prov=?,tel_prov=? WHERE id_prov = ?";
    private static $BORRAR_PROVEEDOR = "DELETE FROM proveedores WHERE id_prov = ?";
    private static $ESTATUS_PROVEEDOR = "UPDATE proveedores set estatus=? WHERE id_prov = ?";
    private static $SELECT_ALL = "SELECT * FROM proveedores";
    private static $VALIDAR_EXISTENTE = "SELECT *FROM proveedores WHERE nom_empresa = ? and nom_prov = ?";

    /* ===========================
        FUNCION PARA AGREGAR  PROVEEDOR
     =============================*/
    public static function agregarProveedor($proveedor)
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            /*Verificamos si ya existe el proveedor o la empresa*/
            $pst = $conn->prepare(self::$VALIDAR_EXISTENTE);
            $pst->execute([$proveedor['nom_empresa'], $proveedor['nom_prov']]);
            $validar = $pst->fetchAll();

            if (empty($validar)) {
                $pst = $conn->prepare(self::$INSERTAR_PROVEEDOR);
                $pst->execute([$proveedor['nom_empresa'], $proveedor['tel_empresa'], $proveedor['nom_prov'], $proveedor['tel_prov'], 1]);

                $conn = null;
                $conexion->closeConexion();

                return $msg="OK";
            } else {
                return $msg="EXISTE";
            }
            $conn = null;
            $conexion->closeConexion();

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /* ===========================
        FUNCION PARA EDITAR PROVEEDOR
     =============================*/
    public static function editarProveedor($proveedor)
    {
        try {

            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            $pst = $conn->prepare(self::$EDITAR_PROVEEDOR);

            $pst->execute([$proveedor['nom_empresa'], $proveedor['tel_empresa'], $proveedor['nom_prov'], $proveedor['tel_prov'], $proveedor['id']]);

            $conn = null;
            $conexion->closeConexion();

            return "OK";
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /* ===========================
        FUNCION PARA ELIMINAR PROVEEDOR
     =============================*/
    public static function eliminarProveedor($id)
    {
        try {

            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            $pst = $conn->prepare(self::$BORRAR_PROVEEDOR);

            $pst->execute([$id]);

            $conn = null;
            $conexion->closeConexion();

            return "OK";
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /* ===========================
        FUNCION PARA OBTENER TODO LOS DATOS DEL PROVEEDOR
     =============================*/
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

    /* ===========================
        FUNCION PARA DAR DE BAJA A UN PROVEEDOR
     =============================*/
    public static function desactivarProveedores($Id)
    {
        try {

            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            $pst = $conn->prepare(self::$ESTATUS_PROVEEDOR);
            $pst->execute([0, $Id]);

            $conexion->closeConexion();
            $conn = null;

            return "OK";
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /* ===========================
        FUNCION PARA DAR DE ALTA A UN PROVEEDOR
     =============================*/
    public static function activarProveedores($Id)
    {
        try {

            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            $pst = $conn->prepare(self::$ESTATUS_PROVEEDOR);
            $pst->execute([1, $Id]);

            $conexion->closeConexion();
            $conn = null;

            return "OK";
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}

?>
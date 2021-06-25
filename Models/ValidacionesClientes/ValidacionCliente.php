<?php
require_once '../Models/Conexion.php';

class ValidacionCliente
{

    private static $VerificarCliente = "SELECT * FROM clientes WHERE nombre_cli=?";
    private static $ObtenerNombre    = "SELECT nombre_cli FROM clientes WHERE id_cli=?";

    public static function ValidarClienteNombre($cliente)
    {
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            /* ¿HAY UN CLIENTE CON EL MISMO NOMBRE? */
            $pst = $conn->prepare(self::$VerificarCliente);
            $pst->execute([$cliente['nombre_cli']]);
            $validar = $pst->fetch();

            /* ¿ENCONTRÓ ALGUNO? */
            if (empty($validar)) {
                $msg = false;
            } else {
                $msg = true;
            }

            $conn = null;
            $conexion->closeConexion();

            return $msg;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function ValidarClienteEditar($cliente)
    {
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            $pst = $conn->prepare(self::$ObtenerNombre);
            $pst->execute([$cliente['id_cli']]);
            $validar = $pst->fetch();

            if (strcmp($validar[0], $cliente['nombre_cli']) !== 0) {
                $msg = true;
            } else {
                $msg = false;
            }

            $conn = null;
            $conexion->closeConexion();

            return $msg;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}

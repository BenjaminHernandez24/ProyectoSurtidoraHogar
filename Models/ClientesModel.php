<?php

require_once 'Conexion.php';

class ClientesModel
{
    private static $ExtraerClientes = "SELECT * FROM clientes";
    private static $InsertarCliente = "INSERT INTO clientes(nombre_cli, tipo, telefono, Estatus) VALUES(?,?,?,1)";
    private static $UpdateClientes  = "UPDATE clientes SET nombre_cli=?, tipo=?, telefono=? WHERE id_cli=?";
    private static $EliminarCliente = "DELETE FROM clientes WHERE id_cli=?";
    private static $UpdateEstado    = "UPDATE clientes set Estatus=? WHERE id_cli=?";
    private $clientes;

    /* OBTENER LOS CLIENTES DE LA BASE DE DATOS */
    public static function getClientes()
    {
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            $pst = $conn->prepare(self::$ExtraerClientes);
            $pst->execute();

            $clientes = $pst->fetchAll();

            $conn = null;
            $conexion->closeConexion();

            return $clientes;

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /* INSERTAR CLIENTES EN LA BASE DE DATOS */
    public static function AgregarCliente($cliente)
    {
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            $pst       = $conn->prepare(self::$InsertarCliente);
            $resultado = $pst->execute([$cliente['nombre_cli'], $cliente['tipo'], $cliente['telefono']]);

            if ($resultado == 1) {
                $msg = "OK";
            } else {
                $msg = "Fallo al insertar";
            }

            $conn = null;
            $conexion->closeConexion();

            return $msg;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /* EDITAR CLIENTES EN LA BASE DE DATOS */
    public static function EditarCliente($cliente)
    {
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            $pst       = $conn->prepare(self::$UpdateClientes);
            $resultado = $pst->execute([$cliente['nombre_cli'], $cliente['tipo'], $cliente['telefono'], $cliente['id_cli']]);

            if ($resultado == 1) {
                $msg = "OK";
            } else {
                $msg = "Fallo al editar";
            }

            $conn = null;
            $conexion->closeConexion();

            return $msg;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /* ELIMINAR CLIENTES EN LA BASE DE DATOS */
    public static function EliminarCliente($cliente)
    {
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            $pst       = $conn->prepare(self::$EliminarCliente);
            $resultado = $pst->execute([$cliente['id_cli']]);

            if ($resultado == 1) {
                $msg = "OK";
            } else {
                $msg = "Fallo al eliminar";
            }

            $conn = null;
            $conexion->closeConexion();

            return $msg;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /* CAMBIAR ESTATUS DE CLIENTE */
    public static function Estatus($cliente)
    {
        try {
            $conexion = new Conexion();
            $conn     = $conexion->getConexion();

            $pst       = $conn->prepare(self::$UpdateEstado);
            $resultado = $pst->execute([$cliente['Estatus'], $cliente['id_cli']]);

            if ($resultado == 1) {
                $msg = "OK";
            } else {
                $msg = "Fallo al cambiar estatus";
            }

            $conn = null;
            $conexion->closeConexion();

            return $msg;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

}

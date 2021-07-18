<?php
require_once "Conexion.php";

class AjustesModelo
{

    public static function passwordUsuario($usuario,$password)
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();
            $pst = $conn->prepare("UPDATE administrador SET password = ? WHERE user = ?");
            $pass_fuerte = password_hash($password, PASSWORD_DEFAULT);
            $resultado = $pst->execute([$pass_fuerte,$usuario]);

            if ($resultado == 1) {
                $msg = "OK";
            } else {
                $msg = "Fallo al editar";
            }

            $conexion->closeConexion();
            $conn = null;

            return $msg;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
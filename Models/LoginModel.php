<?php
require_once "Conexion.php";
session_start();

   // Clase en la que se verifican los datos introducidos en el Login con los de la BD. //
  // Se comunica con LoginController e inicia sesiones. //
class LoginModel
{

    private static $SELECT_USERS = "SELECT * FROM administrador WHERE user = ? and password = ?";

    public static function validarUsuarios($admon)
    {
        try {

            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            $pst = $conn->prepare(self::$SELECT_USERS);

            $pst->execute([$admon['user'], $admon['password']]);

            $datosUsuario = $pst->fetch();

            // Se verifica el usuario en la tabla administrador
            if (empty($datosUsuario)) {
                $msg = "Usuario o contraseña incorrectos";
            }else{
                $msg = "OK";
            }
     
           //Obtenemos el Usuario de la BD//
            $pst = $conn->prepare("SELECT user  FROM administrador  WHERE user = ? ");
            $pst->execute([$datosUsuario['user']]);
            $tipoUsuario = $pst->fetch();

            // Verificamos el tipo de usuario Administrador //
            if ($tipoUsuario['user'] == "Administrador") {
                // Se inicia la sesión
                $_SESSION['user'] = $datosUsuario['user'];
                

              // Verificamos el tipo de usuario Empleado //
            }else if ($tipoUsuario['user'] == "Empleado") {
                
                // Se inicia la sesión
                $_SESSION['user'] = $datosUsuario['user'];                
            } 
            $conn = null;
            $conexion->closeConexion();
            // Devolvemos el mensaje según lo obtenido de la consulta //
            return $msg;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
?>
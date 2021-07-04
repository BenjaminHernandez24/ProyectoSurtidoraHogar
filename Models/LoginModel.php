<?php
require_once "Conexion.php";
session_start();

   // Clase en la que se verifican los datos introducidos en el Login con los de la BD. //
  // Se comunica con LoginController e inicia sesiones. //
class LoginModel
{

    private static $SELECT_USERS = "SELECT * FROM administrador WHERE user = ? ";

    public static function validarUsuarios($admon)
    {
        try {

            $conexion = new Conexion();
            $conn = $conexion->getConexion();
            $pst = $conn->prepare(self::$SELECT_USERS);
             
            $pst->execute([$admon['user']]);
            $datosUsuario = $pst->fetch();
            
            //Verificamos si existe el usuario y desencriptamos la contraseña para compararla con la introducida. //
           
    if (!empty($datosUsuario) && (password_verify($admon['password'], $datosUsuario['password']))) {
            
            //if (strcmp($admon['password'],$datosUsuario['password'] ) !== 0){
              //return "Verifique la contraseña (Mayúsculas y minúsculas).";
            //}
           //Obtenemos el Usuario de la BD//
            $pst = $conn->prepare("SELECT user  FROM administrador  WHERE user = ? ");
            $pst->execute([$datosUsuario['user']]);
            $tipoUsuario = $pst->fetch();

            // Verificamos el tipo de usuario Administrador //
            if ($tipoUsuario['user'] == "Administrador1") {
                // Se inicia la sesión
                $_SESSION['user'] = $datosUsuario['user'];
                
            }else if ($tipoUsuario['user'] == "Administrador2") {
                    // Se inicia la sesión
                    $_SESSION['user'] = $datosUsuario['user'];
           
              // Verificamos el tipo de usuario Empleado //
            }else if ($tipoUsuario['user'] == "Empleado") {
                
                // Se inicia la sesión
                $_SESSION['user'] = $datosUsuario['user'];                
            } 
        }else { 
            return "Usuario o contraseña incorrectos";
            }
            // Devolvemos el mensaje según lo obtenido de la consulta //
            $conn = null;
            $conexion->closeConexion();
            return "OK";
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
?>
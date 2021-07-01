<?php
require_once "Conexion.php";
class RegistroModelo
{
    private static $INSERTAR_USUARIO = "INSERT INTO administrador (user, password) values (?,?)";
    private static $VALIDAR_USUARIO_EXISTENTE = "SELECT * FROM administrador WHERE user = ? ";

//-------- FUNCIÓN PARA AGREGAR USUARIO -------//
    public static function registro_usuarios($registro)
    {
        try {
            $conexion = new Conexion();
            $conn = $conexion->getConexion();

            //-------- Se verifica si ya existe el usuario -------//
            $pst = $conn->prepare(self::$VALIDAR_USUARIO_EXISTENTE);
            $pst->execute([$registro ['user']]);
            $validar = $pst->fetchAll();
            $usuarios = array(
                "user1" => "Administrador1",
                "user2" => "Administrador2",
                "user3" => "Empleado",
            );
            //if (strcmp($registro ['user'], $usuarios ['user2'] ) !== 0){ 
                //return "Usuario no válido";   
            //}

             if (empty($validar)) {
                $pass_fuerte = password_hash($registro ['password'], PASSWORD_DEFAULT);
                $pst = $conn->prepare(self::$INSERTAR_USUARIO);
                $pst->execute([ $registro ['user'], $pass_fuerte ]);
    
          }else{
            return "Ese usuario ya existe"; 
            }
            $conn = null;
            $conexion->closeConexion();
            return "OK";
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

}
?>
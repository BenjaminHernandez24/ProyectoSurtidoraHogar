<?php

    require_once "../Models/LoginModel.php";

    if( isset($_POST['ingresar'])){

        if(
            preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ_., ]+$/', $_POST['usu']) &&
            preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ_., ]+$/', $_POST['contra'])
        ){
            // Se declara el array que guarda los campos de inputs (name) en el Login. //
            $admon = array(
            "user" => $_POST['usu'], 
            "password" => $_POST['contra']
            );

            // Se guarda el mensaje de respuesta de la funcion ValidarUsuarios en el Model. //
            $respuesta = LoginModel::validarUsuarios($admon);
            
            echo json_encode(['respuesta'=>$respuesta]);
        }else{
            echo json_encode(['respuesta'=>'Caracteres no admitidos']);
        }
        
    }
    ?>
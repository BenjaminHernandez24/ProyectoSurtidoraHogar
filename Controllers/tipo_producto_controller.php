<?php
require_once "../Models/TipoModel.php";

//---------- Agregar Tipo Producto -------//
if (isset($_POST['agregar_tipo'])) {
    $Tipo = array(
        "descripcion" => $_POST['des_tipo'],  //Variables de input (name) //
    );
    $respuesta = TipoModelo::agregar_tipo_producto($Tipo);
    echo json_encode(['respuesta' => $respuesta]);
}
//---------- Editar Tipo Producto -------//
if (isset($_POST['editar_tipo'])) {
    $Tipo = array(
        "id_tipo" => $_POST['idTipo'],
        "descripcion" => $_POST['des_tipo'], //Variables de input (name) //

    );
    $respuesta = TipoModelo::editar_tipo_producto($Tipo);
    echo json_encode(['respuesta' => $respuesta]);
}

//---------- Eliminar Tipo Producto -------//
if (isset($_POST['eliminar_tipo'])) {

    $respuesta = TipoModelo::eliminar_tipo_producto($_POST['id_tipo']);
    echo json_encode(['respuesta' => $respuesta]);
}

//---------- Obtener Tipo Producto -------//
if (isset($_POST['obtener_tipo'])) {

    $data = TipoModelo::obtener_tipo_producto();
    echo json_encode($data);
}
?>

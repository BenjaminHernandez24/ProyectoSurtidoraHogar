<?php
require_once "../Models/MarcaModel.php";

//---------- Agregar Marca Producto -------//
if (isset($_POST['agregar_marca'])) {
    $Marca = array(
        "descripcion" => $_POST['des_marca'],  //Variables de input (name) //
    );
    $respuesta = MarcaModelo::agregar_marca_producto($Marca);
    echo json_encode(['respuesta' => $respuesta]);
}
//---------- Editar Marca Producto -------//
if (isset($_POST['editar_marca'])) {
    $Marca = array(
        "id_marca" => $_POST['idMarca'],
        "descripcion" => $_POST['des_marca'], //Variables de input (name) //

    );
    $respuesta = MarcaModelo::editar_marca_producto($Marca);
    echo json_encode(['respuesta' => $respuesta]);
}

//---------- Eliminar Marca Producto -------//
if (isset($_POST['eliminar_marca'])) {

    $respuesta = MarcaModelo::eliminar_marca_producto($_POST['id_marca']);
    echo json_encode(['respuesta' => $respuesta]);
}

//---------- Obtener Marca Producto -------//
if (isset($_POST['obtener_marca'])) {

    $data = MarcaModelo::obtener_marca_producto();
    echo json_encode($data);
}
?>

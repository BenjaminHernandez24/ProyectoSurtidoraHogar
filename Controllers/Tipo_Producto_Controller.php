<?php
require_once "../Models/TipoModel.php";

//---------- Agregar Tipo Producto -------//
if (isset($_POST['agregar_tipo'])) {
    if ( preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\(\) ]+$/', $_POST['des_tipo']) ) {
    $Tipo = array(
        "descripcion_tipo" => $_POST['des_tipo'],  //Variables de input (name) //
    );
    $respuesta = TipoModelo::agregar_tipo_producto($Tipo);
    echo json_encode(['respuesta' => $respuesta]);
  }else {
    echo json_encode(['respuesta' => 'Error de escritura en los campos.']);
   }
}
//---------- Editar Tipo Producto -------//
if (isset($_POST['editar_tipo'])) {
    if ( preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\(\) ]+$/', $_POST['des_tipo']) ) {
    $Tipo = array(
        "id_tipo" => $_POST['idTipo'],
        "descripcion_tipo" => $_POST['des_tipo'], //Variables de input (name) //

    );
    $respuesta = TipoModelo::editar_tipo_producto($Tipo);
    echo json_encode(['respuesta' => $respuesta]);
   }else {
    echo json_encode(['respuesta' => 'Error de escritura en los campos.']);
   }
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
//---------- Desactivar Tipo Producto -------//
if (isset($_POST['desactivarTipo'])) {

    $respuesta = TipoModelo::desactivarTipoProducto($_POST['id_tipo']);
    echo json_encode(['respuesta' => $respuesta]);
}
//----------Activar Tipo Producto -------//
if (isset($_POST['activarTipo'])) {

    $respuesta = TipoModelo::activarTipoProducto($_POST['id_tipo']);
    echo json_encode(['respuesta' => $respuesta]);
}
?>

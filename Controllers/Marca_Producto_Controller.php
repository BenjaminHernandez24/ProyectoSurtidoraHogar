<?php
require_once "../Models/MarcaModel.php";
require_once "../Models/ValidacionesMarca/ValidacionMarca.php";
//---------- Agregar Marca Producto -------//
if (isset($_POST['agregar_marca'])) {
    if ( preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\(\) ]+$/', $_POST['des_marca'])) {
    $Marca = array(
        "descripcion_marca" => $_POST['des_marca'],  //Variables de input (name) //
    );
    $respuesta = MarcaModelo::agregar_marca_producto($Marca);
    echo json_encode(['respuesta' => $respuesta]);
  }else{
    echo json_encode(['respuesta' => 'Error de escritura.']);
   }
}
//---------- Editar Marca Producto -------//
if (isset($_POST['editar_marca'])) {
    if ( preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\(\) ]+$/', $_POST['des_marca'])) {
    $Marca = array(
        "id_marca" => $_POST['idMarca'],
        "descripcion_marca" => $_POST['des_marca'], //Variables de input (name) //

    );
    
    $respuesta = ValidacionMarca::ValidarMarcaEditar($Marca);
    if ($respuesta == true) {
        $respuesta = ValidacionMarca::ValidarMarcaDescripcion($Marca);
        if ($respuesta == true) {
            $respuesta = "existe";
        } else {
            $respuesta = MarcaModelo::editar_marca_producto($Marca);
        }
    } else {
        $respuesta = MarcaModelo::editar_marca_producto($Marca);
    }
    echo json_encode(['respuesta' => $respuesta]);
 }else{
    echo json_encode(['respuesta' => 'Error de escritura.']);
   }
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
//---------- Desactivar Marca Producto -------//
if (isset($_POST['desactivarMarca'])) {

    $respuesta = MarcaModelo::desactivarMarcaProducto($_POST['id_marca']);
    echo json_encode(['respuesta' => $respuesta]);
}
//----------Activar Marca Producto -------//
if (isset($_POST['activarMarca'])) {

    $respuesta = MarcaModelo::activarMarcaProducto($_POST['id_marca']);
    echo json_encode(['respuesta' => $respuesta]);
}
?>

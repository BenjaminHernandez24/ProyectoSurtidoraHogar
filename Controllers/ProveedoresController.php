<?php
require_once "../Models/ProveedoresModel.php";

/* ===========================
        AGREGAR PROVEEDOR
     =============================*/
if (isset($_POST['agregarProveedores'])) {

    if (
        preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\(\) ]+$/', $_POST['nom_empresa']) &&
        preg_match('/^[0-9]+$/', $_POST['tel_empresa']) &&
        preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\(\) ]+$/', $_POST['nom_prov']) &&
        preg_match('/^[0-9]+$/', $_POST['tel_prov']) &&
        preg_match('/^[0-9]+$/', $_POST['num_cuenta']) &&
        preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\(\) ]+$/', $_POST['nom_banco']) &&
        preg_match('/^[0-9]+$/', $_POST['clave_interbancaria'])
    ) {
        $Proveedor = array(
            "nom_empresa" => $_POST['nom_empresa'], //son variables de name del imput
            "tel_empresa" => $_POST['tel_empresa'],
            "nom_prov" => $_POST['nom_prov'],
            "tel_prov" => $_POST['tel_prov'],
            "num_cuenta" => $_POST['num_cuenta'],
            "nom_banco" => $_POST['nom_banco'],
            "clave_interbancaria" => $_POST['clave_interbancaria']
        );
        $respuesta = ProveedoresModelo::agregarProveedor($Proveedor);
        echo json_encode(['respuesta' => $respuesta]);
    } else {
        echo json_encode(['respuesta' => 'Error en caracteres.']);
    }
}

/* ===========================
        EDITAR PROVEEDOR
     =============================*/
if (isset($_POST['editarProveedores'])) {
    if (
        preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\(\) ]+$/', $_POST['nom_empresa']) &&
        preg_match('/^[0-9]+$/', $_POST['tel_empresa']) &&
        preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\(\) ]+$/', $_POST['nom_prov']) &&
        preg_match('/^[0-9]+$/', $_POST['tel_prov']) &&
        preg_match('/^[0-9]+$/', $_POST['num_cuenta']) &&
        preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\(\) ]+$/', $_POST['nom_banco']) &&
        preg_match('/^[0-9]+$/', $_POST['clave_interbancaria'])
    ) {
        $Proveedor = array(
            "id" => $_POST['idProveedor'],
            "nom_empresa" => $_POST['nom_empresa'], //son variables de name del imput
            "tel_empresa" => $_POST['tel_empresa'],
            "nom_prov" => $_POST['nom_prov'],
            "tel_prov" => $_POST['tel_prov'],
            "num_cuenta" => $_POST['num_cuenta'],
            "nom_banco" => $_POST['nom_banco'],
            "clave_interbancaria" => $_POST['clave_interbancaria']
        );
        $respuesta = ProveedoresModelo::editarProveedor($Proveedor);
        echo json_encode(['respuesta' => $respuesta]);
    } else {
        echo json_encode(['respuesta' => 'Error en caracteres.']);
    }
}

/* ===========================
        ELIMINAR PROVEEDOR
     =============================*/
if (isset($_POST['eliminarProveedores'])) {

    $respuesta = ProveedoresModelo::eliminarProveedor($_POST['idProveedor']);
    echo json_encode(['respuesta' => $respuesta]);
}

/* ===========================
        DESACTIVAR PROVEEDOR
     =============================*/
if (isset($_POST['desactivarProveedores'])) {

    $respuesta = ProveedoresModelo::desactivarProveedores($_POST['idProveedor']);
    echo json_encode(['respuesta' => $respuesta]);
}

/* ===========================
        ACTIVAR PROVEEDOR
     =============================*/
if (isset($_POST['activarProveedores'])) {

    $respuesta = ProveedoresModelo::activarProveedores($_POST['idProveedor']);
    echo json_encode(['respuesta' => $respuesta]);
}

/* ===========================
        DEVUELVE TODO LOS PROVEEDORES
     =============================*/
if (isset($_POST['obtenerProveedores'])) {

    $data = ProveedoresModelo::obtenerProveedores();
    echo json_encode($data);
}

<?php
require_once "../Models/ProveedoresModel.php";

/* ===========================
        AGREGAR PROVEEDOR
     =============================*/
if (isset($_POST['agregarProveedores'])) {
    $Proveedor = array(
        "nom_empresa" => $_POST['nom_empresa'], //son variables de name del imput
        "tel_empresa" => $_POST['tel_empresa'],
        "nom_prov" => $_POST['nom_prov'],
        "tel_prov" => $_POST['tel_prov']
    );
    $respuesta = ProveedoresModelo::agregarProveedor($Proveedor);
    echo json_encode(['respuesta' => $respuesta]);
}

/* ===========================
        DEVUELVE TODO LOS PROVEEDORES
     =============================*/
if (isset($_POST['obtenerProveedores'])) {

    $data = ProveedoresModelo::obtenerProveedores();
    echo json_encode($data);
}

?>

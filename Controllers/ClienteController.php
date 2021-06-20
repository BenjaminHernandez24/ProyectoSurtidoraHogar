<?php
	require_once "../Models/ClientesModel.php";

	/* REDIRECCIÓN AL MÉTODO getClientes() */
	if (isset($_POST['getClientes'])) {
	
    	$data = ClientesModel::getClientes();
    	echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}

	/* REDIRECCIÓN AL MÉTODO AgregarClientes() */
	if (isset($_POST['AgregarCliente'])) {
	    $Cliente = array(
	        "nombre_cli" => $_POST['nombre'], //son variables de name del imput
	        "tipo" => $_POST['tipo'],
	        "telefono" => $_POST['telefono']
	    );
	    
	    $respuesta = ClientesModel::AgregarCliente($Cliente);
	    echo json_encode(['respuesta' => $respuesta]);
	}

	/* REDIRECCIÓN AL MÉTODO EditarClientes() */
	if (isset($_POST['editarCliente'])) {
	    $Cliente = array(
	    	"id_cli" => $_POST['idCliente'],
	        "nombre_cli" => $_POST['nombre'], //son variables de name del imput
	        "tipo" => $_POST['tipo'],
	        "telefono" => $_POST['telefono']
	    );
	    
	    $respuesta = ClientesModel::EditarCliente($Cliente);
	    echo json_encode(['respuesta' => $respuesta]);
	}

	/* REDIRECCIÓN AL MÉTODO EliminarClientes() */
	if (isset($_POST['eliminarCliente'])) {
	    $Cliente = array(
	    	"id_cli" => $_POST['idCliente']
	    );
	    
	    $respuesta = ClientesModel::EliminarCliente($Cliente);
	    echo json_encode(['respuesta' => $respuesta]);
	}

	/* REDIRECCIÓN AL MÉTODO Estatus() */
	if (isset($_POST['activarClientes'])) {

		$Cliente = array(
			"id_cli" => $_POST['idCliente'],
			"Estatus"=> 1
		);

	    $respuesta = ClientesModel::Estatus($Cliente);
	    echo json_encode(['respuesta' => $respuesta]);
	}

	/* REDIRECCIÓN AL MÉTODO Estatus() */
	if (isset($_POST['desactivarClientes'])) {

		$Cliente = array(
			"id_cli" => $_POST['idCliente'],
			"Estatus"=> 0
		);

	    $respuesta = ClientesModel::Estatus($Cliente);
	    echo json_encode(['respuesta' => $respuesta]);
	}
?>
<?php

require_once 'Conexion.php';

	class ClientesModel
	{
		private static $ExtraerClientes = "SELECT * FROM clientes";
		private static $VerificarCliente = "SELECT * FROM clientes WHERE nombre_cli=?";
		private static $InsertarCliente = "INSERT INTO clientes(nombre_cli, tipo, telefono, Estatus) VALUES(?,?,?,1)";
		private static $UpdateClientes = "UPDATE clientes SET nombre_cli=?, tipo=?, telefono=? WHERE id_cli=?";
		private static $EliminarCliente = "DELETE FROM clientes WHERE id_cli=?";
		private static $UpdateEstado = "UPDATE clientes set Estatus=? WHERE id_cli=?";
		private static $NombreCliente = "SELECT nombre_cli FROM clientes WHERE id_cli=?";
		private $clientes;
		
	/* OBTENER LOS CLIENTES DE LA BASE DE DATOS */
		public function getClientes()
		{
			try {
				$conexion = new Conexion();
				$conn = $conexion->getConexion();

				$pst = $conn->prepare(self::$ExtraerClientes);
				$pst->execute();

				$clientes = $pst->fetchAll();

				$conn = null;
				$conexion->closeConexion();
				
				return $clientes;

			} catch (PDOException $e) {
				return $e->getMessage();
			}
		}

	/* INSERTAR CLIENTES EN LA BASE DE DATOS */
		public static function AgregarCliente($cliente)
	    {
	        try {
	            $conexion = new Conexion();
	            $conn = $conexion->getConexion();

	            /* ¿HAY UN CLIENTE CON EL MISMO NOMBRE? */
	            $pst = $conn->prepare(self::$VerificarCliente);
	            $pst->execute([$cliente['nombre_cli']]);
	            $validar = $pst->fetch();

	            /* ¿ENCONTRÓ ALGUNO? */
	            if(empty($validar)){

	            	$pst = $conn->prepare(self::$InsertarCliente);
	            	$resultado = $pst->execute([$cliente['nombre_cli'], $cliente['tipo'], $cliente['telefono']]);

	            	if($resultado == 1){
	            		return $msg = "OK";
	            	}else{
	            		return $msg = "Fallo al insertar";
	            	}

	            }else{
	            	return $msg = "existe";
	            }

	            $conn = null;
	            $conexion->closeConexion();

	        } catch (PDOException $e) {
	            return $e->getMessage();
	        }
	    }

	/* EDITAR CLIENTES EN LA BASE DE DATOS */   
		public function EditarCliente($cliente)
		{
			try {
				$conexion = new Conexion();
				$conn = $conexion->getConexion();

				$pst = $conn->prepare(self::$NombreCliente);
				$pst->execute([$cliente['id_cli']]);
				$Obtener = $pst->fetch();

				/* ¿SE CAMBIÓ EL NOMBRE? */
				if(strcmp($Obtener[0],$cliente['nombre_cli']) !== 0){
					$pst = $conn->prepare(self::$VerificarCliente);
					$pst->execute([$cliente['nombre_cli']]);
					$Obtener = $pst->fetch();

					/* ¿EL NOMBRE A EDITAR YA EXISTE EN LA BD? */
					if(empty($Obtener)){
						$pst = $conn->prepare(self::$UpdateClientes);
						$pst->execute([$cliente['nombre_cli'], $cliente['tipo'], $cliente['telefono'], $cliente['id_cli']]);

						return $msg = "OK";
					}else{
						return $msg = "existe";
					}
				}else{
					$pst = $conn->prepare(self::$UpdateClientes);
					$pst->execute([$cliente['nombre_cli'], $cliente['tipo'], $cliente['telefono'], $cliente['id_cli']]);

					return $msg = "OK";
				}

				$conn = null;
				$conexion->closeConexion();
				
			} catch (PDOException $e) {
				return $e->getMessage();
			}
		}

	/* ELIMINAR CLIENTES EN LA BASE DE DATOS */
		public function EliminarCliente($cliente)
		{
			try{
				$conexion = new Conexion();
				$conn = $conexion->getConexion();

				$pst = $conn->prepare(self::$EliminarCliente);
				$pst->execute([$cliente['id_cli']]);

				$conn = null;
				$conexion->closeConexion();

				return "OK";
			}catch(PDOException $e){
				return $e->getMessage();
			}
		}

	/* CAMBIAR ESTATUS DE CLIENTE */
		public function Estatus($cliente)
		{
			try{
				$conexion = new Conexion();
				$conn = $conexion->getConexion();

				$pst = $conn->prepare(self::$UpdateEstado);
				$pst->execute([$cliente['Estatus'], $cliente['id_cli']]);

				$conn = null;
				$conexion->closeConexion();

				return "OK";
			}catch(PDOException $e){
				return $e->getMessage();
			}
		}
		
	}
?>
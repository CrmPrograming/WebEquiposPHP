<?php
	// Script para la modificación de un equipo en la base de datos

	try {
		if (isset($_POST['id'], $_POST['nombreEquipo'], $_POST['localidad'], $_POST['liga'])) {
			include("conexion.php");
			include("estados.php");

			$pdo = conectaDB();
			$id = $_POST['id'];
			$nombre = $_POST['nombreEquipo'];		
			$liga = $_POST['liga'];
			$localidad = $_POST['localidad'];
			$internacional = isset($_POST['internacional']);
			
			$_dato = array('nombre' => $nombre, 'liga' => $liga, 'localidad' => $localidad, 'internacional' => $internacional, 'id' => $id);
			$stmt = $pdo->prepare("UPDATE equipos SET nomEquipo = :nombre, codLiga = :liga, localidad = :localidad, internacional = :internacional WHERE codEquipo = :id");

			$stmt->execute($_dato);
			$pdo = null;
			header("location:../index.php?estado=". Estado::EXITO);
			exit();
		} else {
			header("location:../index.php");
			exit();
		}
	} catch (PDOException $e) {
		header("location:../index.php?estado=". Estado::ERROR ."&operacion=". Operacion::MODIFICAR ."&err=". TipoError::ERROR_DESCONOCIDO);
	}
?>
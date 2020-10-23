<?php
	// Script para la baja de un equipo en la base de datos

	try {
		if (isset($_POST['id'])) {
			include("conexion.php");
			include("estados.php");

			$pdo = conectaDB();
			
			$_dato = array($_POST['id']);
			$stmt = $pdo->prepare("DELETE FROM equipos WHERE codEquipo = ?");

			$stmt->execute($_dato);
			$pdo = null;
			header("location:../index.php?estado=". Estado::EXITO);
			exit();
		} else {
			header("location:../index.php");
			exit();
		}

	} catch (PDOException $e) {
		if ($e->getCode() == '23000')
			header("location:../index.php?estado=". Estado::ERROR ."&operacion=". Operacion::BAJA ."&err=". TipoError::FK_JUGADOR_EQUIPO);

	}
?>
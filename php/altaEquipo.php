<?php
	try {
		if (isset($_POST['nombreEquipo'], $_POST['localidad'], $_POST['liga'])) {
			include("conexion.php");
			include("estados.php");

			$pdo = conectaDB();
			$nombre = $_POST['nombreEquipo'];		
			$liga = $_POST['liga'];
			$localidad = $_POST['localidad'];
			$internacional = isset($_POST['internacional']);
				
			$_dato = array($nombre, $liga, $localidad, $internacional);
			$stmt = $pdo->prepare("INSERT INTO equipos (nomEquipo, codLiga, localidad, internacional) VALUES (?, ?, ?, ?)");

			$stmt->execute($_dato);
			$pdo = null;
			header("location:../equipos.php?estado=". Estado::EXITO);
		} else {
			header("location:../equipos.php");
		}
	} catch (PDOException $e) {
		header("location:../equipos.php?estado=". Estado::ERROR ."&operacion=". Operacion::ALTA . "&err=". TipoError::ERROR_DESCONOCIDO);
	}
?>
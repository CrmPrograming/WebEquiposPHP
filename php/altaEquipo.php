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

			$stmt = $pdo->prepare("Call insertarEquipo(:nombre, :liga, :localidad, :internacional, @estadoLiga, @estadoInsercion)");
			$stmt->bindParam(":nombre", $nombre);
			$stmt->bindParam(":liga", $liga);
			$stmt->bindParam(":localidad", $localidad);
			$stmt->bindParam(":internacional", $internacional);

			$stmt->execute();

			$stmt = $pdo->query("SELECT @estadoLiga AS estadoLiga, @estadoInsercion AS estadoInsercion");
			$row = $stmt->fetch();
			$pdo = null;

			if (((int) $row['estadoLiga']) == 0) {
				// estadoLiga = 0 -> Liga NO existe
				header("location:../equipos.php?estado=". Estado::ERROR . "&operacion=". Operacion::ALTA ."&err=". TipoError::ALTA_LIGA_NO_EXISTE);
			} else if (((int) $row['estadoInsercion']) == 0) {
				// estadoInsercion = 0-> Equipo YA existe
				header("location:../equipos.php?estado=". Estado::ERROR . "&operacion=". Operacion::ALTA ."&err=". TipoError::ALTA_EQUIPO_YA_EXISTE);
			} else {
				header("location:../equipos.php?estado=". Estado::EXITO);
			}
			exit();
		} else {
			header("location:../equipos.php");
			exit();
		}
	} catch (PDOException $e) {
		header("location:../equipos.php?estado=". Estado::ERROR ."&operacion=". Operacion::ALTA . "&err=". TipoError::ERROR_DESCONOCIDO);
	}
?>
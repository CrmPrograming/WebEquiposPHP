<?php
	try {
		if (isset($_POST['id'])) {
			include("conexion.php");
			include("estados.php");

			$pdo = conectaDB();
			
			$_dato = array($_POST['id']);
			$stmt = $pdo->prepare("DELETE FROM equipos WHERE codEquipo = ?");

			$stmt->execute($_dato);
			$pdo = null;
			header("location:../equipos.php?estado=". Estado::EXITO);
		} else {
			header("location:../equipos.php");
		}

	} catch (PDOException $e) {
		if ($e->getCode() == '23000')
			header("location:../equipos.php?estado=". Estado::ERROR ."&operacion=". Operacion::BAJA ."&err=". TipoError::FK_JUGADOR_EQUIPO);

	}
?>
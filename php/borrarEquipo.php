<?php
	if (isset($_POST['id'])) {
		include("conexion.php");

		$pdo = conectaDB();
		
		$_dato = array($_POST['id']);
		$stmt = $pdo->prepare("DELETE FROM equipos WHERE codEquipo = ?");

		$stmt->execute($_dato);
		$pdo = null;
	}

	header("location:../equipos.php");
?>
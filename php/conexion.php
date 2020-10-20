<?php
	// Función encargada de establecer conexión con la base de datos.
	// Requiere del fichero config.php para funcionar correctamente.
	function conectaDB() {
		$_config = include("config.php");
		try {
			$pdo = new PDO("mysql:host=$_config[host];dbname=$_config[dbname];charset=utf8", $_config['user'], $_config['pass']);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			unset($_config);

		} catch(PDOException $e) {
			echo $e->getMessage();
		}
		return $pdo;
	}
?>
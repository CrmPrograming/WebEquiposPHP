<?php
	function conectaDB() {
		$_config = include("config.php");
		try {
			$pdo = new PDO("mysql:host=$_config[host];dbname=$_config[dbname];charset=utf8", $_config['user'], $_config['pass']);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			unset($host, $dbname, $user, $pass);

		} catch(PDOException $e) {
			echo $e->getMessage();
		}
		return $pdo;
	}
?>
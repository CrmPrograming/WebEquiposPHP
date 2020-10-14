<?php
	include("config.php");
	function conectaDB() {
		try {
			$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			unset($host, $dbname, $user, $pass);

		} catch(PDOException $e) {
			echo $e->getMessage();
		}
		return $pdo;
	}
?>
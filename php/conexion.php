<?php
	function conectaDB() {
		try {
			$host = "localhost";
			$dbname = "bdfutbol";
			$user = "root";
		   	$pass = "";
			$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		} catch(PDOException $e) {
			echo $e->getMessage();
		}
		return $pdo;
	}
?>
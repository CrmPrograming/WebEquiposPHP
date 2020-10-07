<?php

class Pagina {

	private $pagina;
	private $descripcion;
	private $autor = "César Ravelo Martínez";

	public function __construct($pagina, $descripcion) {
		$this->pagina = $pagina;
		$this->descripcion = $descripcion;
	}

	public function construirHeader() {
		echo '<meta charset="utf-8">';
    	echo '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
    	echo '<meta name="description" content="'. $this->descripcion .'">';
    	echo '<meta name="author" content="'. $this->autor .'">';
    	echo "<title>". $this->getTitulo() ."</title>";
    	$this->inyectarLibreriasEstilo();
	}

	private function inyectarLibreriasEstilo() {
		?>
		<!-- Bootstrap core CSS -->
    	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" rel="stylesheet">
    	<!-- Custom styles for this template -->    	
    	<?php
    	echo "<link href='styles/". $this->pagina .".css' rel='stylesheet'>";
	}

	public function getTitulo() {
		return "". $this->autor ." - ". ucwords(str_replace("_", " ", $this->pagina));
	}

	public function construirTablaEditable($_cabecera, $_dato) {
		// Cabecera de la tabla
		echo '<div class="row mb-12 cabecera">';
		foreach ($_cabecera as $i) {
			echo "<div class='col-2 themed-grid-col'>$i</div>";
		}

		echo "<div class='col-1 themed-grid-col'>Modificar</div>";
		echo "<div class='col-1 themed-grid-col'>Baja</div>";
		echo '</div>';

		// Fila de la tabla
		echo '<div class="row mb-12 entrada">';

		/*
		foreach ($_dato as $i) {
			echo "<div class='col-2 themed-grid-col'>TODO: DATOS</div>";	      
		    echo '<div class="col-1 themed-grid-col"><i class="fas fa-edit"></i></div>';
		    echo '<div class="col-1 themed-grid-col"><i class="fas fa-trash-alt"></i></div>';
		}
		*/
		?>
			<div class="col-2 themed-grid-col">dato1</div>
	      	<div class="col-2 themed-grid-col">dato2</div>
	      	<div class="col-2 themed-grid-col">dato3</div>
	      	<div class="col-2 themed-grid-col">dato4</div>
	      	<div class="col-2 themed-grid-col">dato5</div>
	      	<div class="col-1 themed-grid-col"><a href="modificar.php?"><i class="fas fa-edit"></i></a></div>
	      	<div class="col-1 themed-grid-col"><a href="www.google.com"><i class="fas fa-trash-alt"></i></a></div>
		<?php
		echo '</div>';
	}
}
?>
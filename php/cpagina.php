<?php
include("conexion.php");

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
		<!-- IntroJS core CSS -->
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.9.3/introjs-rtl.min.css" integrity="sha512-N1VYbmjTnI1KkjRZRSK9leLv8GEq9ndZgxPi4/1tTFHILhQXEDzjLe5YY9OQfGMEdaYU2t1LQpVF/YH5ymSilg==" crossorigin="anonymous" />
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.9.3/introjs.min.css" integrity="sha512-DcHJLWkmfnv+isBrT8M3PhKEhsHWhEgulhr8m5EuGhdAG9w+vUyjlwgR4ISLN0+s/m4ItmPsTOqPzW714dtr5w==" crossorigin="anonymous" />

		<!-- Bootstrap core CSS -->
    	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" rel="stylesheet">

    	<!-- Custom styles for this template -->
    	<link href="styles/general.css" rel="stylesheet">
    	<?php
    	echo "<link href='styles/". $this->pagina .".css' rel='stylesheet'>";
	}

	public function inyectarLibreriasScripts() {
		?>
		<!-- IntroJS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.9.3/intro.min.js" integrity="sha512-VTd65gL0pCLNPv5Bsf5LNfKbL8/odPq0bLQ4u226UNmT7SzE4xk+5ckLNMuksNTux/pDLMtxYuf0Copz8zMsSA==" crossorigin="anonymous"></script>

		<!-- Custom scripts -->
		<script src="scripts/general.js" type="text/javascript"></script>
		<?php
	}

	public function construirBotonCancelar($idStep) {
		?>
		<button <?php echo "data-step='$idStep'"; ?> data-intro="En caso de querer cancelar la operación, puede hacer click aquí y volver al listado de equipos" onclick="location.href='equipos.php'" title="Volver al listado de equipos" id="btnVolverEquipos"><i class="far fa-window-close"></i></button>
		<?php
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

		// Insertamos la primera entrada de la tabla aparte del resto
		// para permitir la correcta funcionalidad de IntroJS
		echo '<div class="row mb-12 entrada" data-step="2" data-intro="Cada entrada de la tabla representa a un conjunto de información">';
		for ($i = 0; $i < count($_cabecera); $i++) {
			echo "<div class='col-2 themed-grid-col'>". $_dato[0][$_cabecera[$i]] ."</div>";
		}			
		echo "<div class='col-1 themed-grid-col'><a href='modificar_equipo.php?id=". $_dato[0]['id'] ."'><i class='fas fa-edit'></i></a></div>";
	    echo "<div class='col-1 themed-grid-col'><a href='borrar_equipo.com?id=". $_dato[0]['id'] ."'><i class='fas fa-trash-alt'></i></a></div>";
	    echo "</div>";

	    $_dato = array_slice($_dato, 1);

	    // Insertamos el resto de entradas
		foreach ($_dato as $col) {
			echo '<div class="row mb-12 entrada">';
			for ($i = 0; $i < count($_cabecera); $i++) {
				echo "<div class='col-2 themed-grid-col'>". $col[$_cabecera[$i]] ."</div>";
			}			
			echo "<div class='col-1 themed-grid-col'><a href='modificar_equipo.php?id=". $col['id'] ."'><i class='fas fa-edit'></i></a></div>";
	      	echo "<div class='col-1 themed-grid-col'><a href='borrar_equipo.php?id=". $col['id'] ."'><i class='fas fa-trash-alt'></i></a></div>";
	      	echo "</div>";
		}

	}

	public function construirTablaSimple($_cabecera, $_dato) {
		// Cabecera de la tabla		
		echo '<div class="row mb-12 cabecera">';
		foreach ($_cabecera as $i) {
			echo "<div class='col-3 themed-grid-col'>$i</div>";
		}
		echo '</div>';

		echo '<div class="row mb-12 entrada">';
		for ($i = 0; $i < count($_cabecera); $i++) {
			echo "<div class='col-3 themed-grid-col'>". $_dato[0][$_cabecera[$i]] ."</div>";
		}
	    echo "</div>";	    
	}

	public function construirCombo($nombre, $descripcion, $_dato) {
		echo "<label for='$nombre'>". ucwords($nombre) ."<i class='fas fa-trophy'></i></label>";
	    echo "<select name='$nombre' class='custom-select' id='$nombre' required>";
	    echo "<option value='' disabled selected hidden>$descripcion</option>";
	    foreach ($_dato as $col) {
	    	echo "<option value='". $col['codLiga'] ."'>". $col['nomLiga'] ."</option>";
	    }
	    echo "</select>";
	}

	public function getTitulo() {
		return "". $this->autor ." - ". ucwords(str_replace("_", " ", $this->pagina));
	}

}
?>
<?php
	include("conexion.php");
	include("estados.php");

	// Clase gestora de la aplicación. Funciona a modo de plantilla para todas
	// las páginas. Su finalidad es reutilizar código y no reescribir aquellos
	// aspectos comunes como son la inyección de las librerías, tablas, selectores, etc.

	class Pagina {

		private $pagina; // Nombre del fichero de la página actual
		private $descripcion; // Descripción de la página a añadir en la cabecera
		private $autor = "César Ravelo Martínez"; // Autor de la página a añadir en la cabecera

		// Constructor de la clase, requiere el nombre del fichero sin extensión y la descripción
		// de dicha página.
		public function __construct($pagina, $descripcion) {
			$this->pagina = $pagina;
			$this->descripcion = $descripcion;
		}

		// Método encargado de comprobar el estado de la última operación realizada.
		// Mostrará un mensaje en la parte superior derecha de la aplicación con el resultado de la misma.
		// Los distintos estados y mensajes de error se pueden ver en el fichero estados.php.
		public function comprobarOperacion() {
			if (isset($_GET['estado'])) {
	    		if ($_GET['estado'] == Estado::EXITO) {
	    			// OPERACIÓN CON ÉXITO
	    			?>
	    				<div class="toast toast-success" data-delay="30000">
						   	<div class="toast-header">
							    <strong class="mr-auto"><i class="fas fa-check-circle"></i> Operación completada</strong>
							    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Cerrar">
							    	<span aria-hidden="true">&times;</span>
							    </button>
						    </div>
						    <div class="toast-body">
						      Se ha realizado la operación con éxito.
						    </div>
						</div>
	    			<?php
	    		} else if(isset($_GET['operacion'], $_GET['err'])) {
	    			// OPERACIÓN CON ERROR
	    			?>
	    				<div class="toast toast-error" data-delay="30000">
						   	<div class="toast-header">
							    <strong class="mr-auto">
							    	<i class="fas fa-exclamation-triangle"></i> No se pudo completar la operación <?php echo Operacion::_MENSAJE[$_GET['operacion']]; ?>
							    </strong>
							    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Cerrar">
							    	<span aria-hidden="true">&times;</span>
							    </button>
						    </div>
						    <div class="toast-body">
						    	<?php echo TipoError::_MENSAJE[$_GET['err']]; ?>
						    </div>
						</div>
	    			<?php
	    		}
	  		}
		}

		// Método encargado de inyectar en la cabecera de la página web la metainformación necesaria
		// junto con las distintas librerías de estilo. Más información en el método inyectarLibreriasEstilo().
		public function construirHeader() {
			echo '<meta charset="utf-8">';
	    	echo '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
	    	echo '<meta name="description" content="'. $this->descripcion .'">';
	    	echo '<meta name="author" content="'. $this->autor .'">';
	    	echo "<title>". $this->getTitulo() ."</title>";
	    	$this->inyectarLibreriasEstilo();
		}

		// Método encargado de inyectar las distintas librerías css que utiliza la aplicación.
		// Se da por sentado que cada fichero tendrá también creado un fichero css con el mismo nombre a él mismo.
		// Ejemplo, el fichero index.php deberá tener en la carpeta css un fichero llamado equipos.css
		private function inyectarLibreriasEstilo() {
			?>
			<!-- IntroJS core CSS -->
	    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.9.3/introjs-rtl.min.css" integrity="sha512-N1VYbmjTnI1KkjRZRSK9leLv8GEq9ndZgxPi4/1tTFHILhQXEDzjLe5YY9OQfGMEdaYU2t1LQpVF/YH5ymSilg==" crossorigin="anonymous" />
	    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.9.3/introjs.min.css" integrity="sha512-DcHJLWkmfnv+isBrT8M3PhKEhsHWhEgulhr8m5EuGhdAG9w+vUyjlwgR4ISLN0+s/m4ItmPsTOqPzW714dtr5w==" crossorigin="anonymous" />

			<!-- Bootstrap core CSS -->
	    	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


	    	<!-- Fontawesome -->
	    	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" rel="stylesheet">

	    	<!-- Custom styles for this template -->
	    	<link href="styles/general.css" rel="stylesheet">
	    	<?php
	    	echo "<link href='styles/". $this->pagina .".css' rel='stylesheet'>";
		}

		// Método encargado de inyectar las librerías js que utiliza la aplicación.
		public function inyectarLibreriasScripts() {
			?>
			<!-- JQuery -->
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js" integrity="sha512-/DXTXr6nQodMUiq+IUJYCt2PPOUjrHJ9wFrqpJ3XkgPNOZVfMok7cRw6CSxyCQxXn6ozlESsSh1/sMCTF1rL/g==" crossorigin="anonymous"></script>

			<!-- PopperJS -->
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

			<!-- Bootstrap -->
			<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha512-kBFfSXuTKZcABVouRYGnUo35KKa1FBrYgwG4PAx7Z2Heroknm0ca2Fm2TosdrrI356EDHMW383S3ISrwKcVPUw==" crossorigin="anonymous"></script>

			<!-- IntroJS -->
			<script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.9.3/intro.min.js" integrity="sha512-VTd65gL0pCLNPv5Bsf5LNfKbL8/odPq0bLQ4u226UNmT7SzE4xk+5ckLNMuksNTux/pDLMtxYuf0Copz8zMsSA==" crossorigin="anonymous"></script>

			<!-- Custom scripts -->
			<script src="scripts/general.js" type="text/javascript"></script>
			<?php
		}

		// Método encargado de añadir a las páginas que lo invoquen un botón en la parte superior
		// derecha de la página capaz de retornar a la página principal
		public function construirBotonCancelar($idStep) {
			?>
			<button <?php echo "data-step='$idStep'"; ?> data-intro="En caso de querer cancelar la operación, puede hacer click aquí y volver al listado de equipos" onclick="location.href='index.php'" title="Volver al listado de equipos" id="btnVolverEquipos"><i class="far fa-window-close"></i></button>
			<?php
		}

		// Método encargado de construir una tabla la cual contará en sus dos últimas columnas de opciones
		// para modificar sus datos o borrarlos.
		// Espera como parámetros dos arrays:
		//
		// - El primer array se corresponde a las claves asociadas a los datos del segundo array
		// - El segundo array contiene los valores a construir en cada una de las filas
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
				if ((strcmp($_cabecera[$i], "id") != 0) && ((strcmp($_dato[0][$_cabecera[$i]], "1") == 0) || (strcmp($_dato[0][$_cabecera[$i]], "0") == 0))) {
					echo "<div class='col-2 themed-grid-col'>";
					echo (strcmp($_dato[0][$_cabecera[$i]], "1") == 0)? "<i class='fas fa-check'></i>" : "<i class='fas fa-times'></i>";
					echo "</div>";
				} else {
				echo "<div class='col-2 themed-grid-col'>". $_dato[0][$_cabecera[$i]] ."</div>";
				}
			}
			echo "<div class='col-1 themed-grid-col' data-step='3' data-intro='Si desea modificar un registro, puede seleccionar esta opción'><a href='modificar_equipo.php?id=". $_dato[0]['id'] ."'><i class='fas fa-edit'></i></a></div>";
		    echo "<div class='col-1 themed-grid-col' data-step='4' data-intro='En caso de querer borrar un registro, puede hacerlo con un click aquí'><a href='borrar_equipo.php?id=". $_dato[0]['id'] ."' ><i class='fas fa-trash-alt'></i></a></div>";
		    echo "</div>";

		    $_dato = array_slice($_dato, 1);

		    // Insertamos el resto de entradas
			foreach ($_dato as $col) {
				echo '<div class="row mb-12 entrada">';
				for ($i = 0; $i < count($_cabecera); $i++) {
					if ((strcmp($_cabecera[$i], "id") != 0) && ((strcmp($col[$_cabecera[$i]], "1") == 0) || (strcmp($col[$_cabecera[$i]], "0") == 0))) {
						echo "<div class='col-2 themed-grid-col'>";
						echo (strcmp($col[$_cabecera[$i]], "1") == 0)? "<i class='fas fa-check'></i>" : "<i class='fas fa-times'></i>";
						echo "</div>";
					} else {
					echo "<div class='col-2 themed-grid-col'>". $col[$_cabecera[$i]] ."</div>";
					}
				}
				echo "<div class='col-1 themed-grid-col'><a href='modificar_equipo.php?id=". $col['id'] ."'><i class='fas fa-edit'></i></a></div>";
		      	echo "<div class='col-1 themed-grid-col'><a href='borrar_equipo.php?id=". $col['id'] ."'><i class='fas fa-trash-alt'></i></a></div>";
		      	echo "</div>";
			}

		}

		// Método encargado de construir una tabla simple. Espera tres parámetros distintos:
		// - Array con las claves asociadas al array de datos
		// - Array con los datos a construir en cada una de las filas
		// - Array con las distintas dimensiones de celda que espera BootStrap
		public function construirTablaSimple($_cabecera, $_dato, $_dimension) {
			$dimensionActual = 0;
			// Cabecera de la tabla
			echo '<div class="row mb-12 cabecera">';
			foreach ($_cabecera as $i) {
				echo "<div class='col-". $_dimension[$dimensionActual] ." themed-grid-col'>$i</div>";
				$dimensionActual++;
			}
			echo '</div>';

			$dimensionActual = 0;
			echo '<div class="row mb-12 entrada">';
			foreach($_dato as $_row) {
				for ($i = 0; $i < count($_cabecera); $i++) {
					echo "<div class='col-". $_dimension[$dimensionActual] ." themed-grid-col'>";
					if ((strcmp($_cabecera[$i], "id") != 0) && ((strcmp($_row[$_cabecera[$i]], "1") == 0) || (strcmp($_row[$_cabecera[$i]], "0") == 0))) {	
						echo (strcmp($_row[$_cabecera[$i]], "1") == 0)? "<i class='fas fa-check'></i>" : "<i class='fas fa-times'></i>";
					} else {
						echo $_row[$_cabecera[$i]];
					}
					echo "</div>";
					$dimensionActual++;
				}
				$dimensionActual = 0;
			}
		    echo "</div>";
		}

		// Método encargado de construir un combo con todas las opciones disponibles en el mismo.
		// Espera tres parámetros distintos:
		// - Nombre principal del select
		// - Descripción en la opción no seleccionable
		// - Array con el conjunto de datos a mostrar en el seleccionable
		public function construirCombo($nombre, $descripcion, $_dato) {
			echo "<label for='$nombre'>". ucwords($nombre) ."<i class='fas fa-trophy'></i></label>";
		    echo "<select name='$nombre' class='custom-select' id='$nombre' required>";
		    echo "<option value='' disabled selected hidden>$descripcion</option>";
		    foreach ($_dato as $col) {
		    	echo "<option value='". $col['id'] ."'>". $col['nombre'] ."</option>";
		    }
		    echo "</select>";
		}

		// Método encargado de construir un combo con todas las opciones disponibles en el mismo, marcando
		// una opción preseleccionada por defecto.
		// Espera cuatro parámetros distintos:
		// - Nombre principal del select
		// - Descripción en la opción no seleccionable
		// - Array con el conjunto de datos a mostrar en el seleccionable
		// - Valor de la opción seleccionada por defecto
		public function construirComboPreseleccion($nombre, $descripcion, $_dato, $seleccionado) {
			echo "<label for='$nombre'>". ucwords($nombre) ."<i class='fas fa-trophy'></i></label>";
		    echo "<select name='$nombre' class='custom-select' id='$nombre' required>";
		    echo "<option value='' disabled hidden>$descripcion</option>";
		    foreach ($_dato as $col) {
		    	if (strcmp($col['id'], $seleccionado) == 0)
		    		echo "<option value='". $col['id'] ."' selected>". $col['nombre'] ."</option>";
		    	else
		    		echo "<option value='". $col['id'] ."'>". $col['nombre'] ."</option>";
		    }
		    echo "</select>";
		}

		// Método encargado de construir el título de la página web
		public function getTitulo() {
			return "". $this->autor ." - ". ucwords(str_replace("_", " ", $this->pagina));
		}
	}
?>
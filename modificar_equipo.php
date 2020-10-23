<?php
	if (!isset($_GET['id']))
		header("location:index.php");

	include("php/cpagina.php");

	$pagina = new Pagina("modificar_equipo", "Formulario para la modificación de equipos existentes");
?>
<!doctype html>
<html lang="es">
  <head>
    <?php
    	$pagina->construirHeader();
    ?>
  </head>
  <body class="bg-light">
    <div class="container">
	  <div class="py-5 text-center">    
	    <h1><?php echo $pagina->getTitulo(); ?></h1>

	    <p class="lead">Mediante el siguiente formulario, se pueden modificar los valores de un equipo existente.</p>
	    <p class="lead">Para ello, se debe cumplimentar los siguientes campos
		con la información requerida. <a href="javascript:mostrarTutorial();"><i class="fas fa-question-circle"></i></a></p>
	  </div>

	  <div class="row" data-step="1" data-intro="Mediante este formulario, puede modificar los datos de un equipo existente siguiendo estos pasos">
	    <div class="col-md-12">
	      <h4 class="mb-3">Datos nuevos del equipo</h4>

	      <?php
	      	// Recogemos los datos del equipo a modificar
	      	$pdo = conectaDB();

	      	$stmt = $pdo->prepare("SELECT nomEquipo, codLiga, localidad, internacional FROM equipos WHERE codEquipo=?");
			$_dato = array($_GET['id']);
			$stmt->execute($_dato);

			// Comprobamos si realmente se preguntó por un equipo existente
			// En caso contrario retornamos a la página principal
			// Con esto evitamos que accedan a la página sin dar un equipo
			if ($stmt->rowCount() == 0) {
			  	header("location:index.php");
			  	exit();
			}

			$_equipo = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
			$pdo = null;

	      ?>

	      <form method="post" action="php/modificarEquipo.php">
	        <!-- Nombre y localidad -->
	        <div class="row">
	          <div class="col-md-6 mb-3" data-step="2" data-intro="En este campo podrá indicar qué nombre tendrá el equipo">
	            <label for="nombreEquipo">Nombre del equipo <i class="far fa-futbol"></i></label>
	            <input name="nombreEquipo" type="text" class="form-control" id="nombreEquipo" placeholder="" value="<?php echo $_equipo['nomEquipo']; ?>" maxlength="40" required>
	          </div>
	          <div class="col-md-6 mb-3" data-step="3" data-intro="Dónde está ubicado el equipo se puede especificar con este campo">
	            <label for="localidad">Localidad <i class="fas fa-home"></i></label>
	            <input name="localidad" type="text" class="form-control" id="localidad" placeholder="" value="<?php echo $_equipo['localidad']; ?>" maxlength="60" required>
	          </div>
	        </div>

	        <!-- Ligas -->
	        <div class="row" data-step="4" data-intro="No olvide seleccionar a qué liga pertenece el equipo">
	        	<div class="col-md-5 mb-3">
	        		<?php
	        			$pdo = conectaDB();

					    $stmt = $pdo->query("SELECT codLiga AS id, nomLiga AS nombre FROM ligas");
					    $_row = $stmt->fetchAll(PDO::FETCH_ASSOC);

					    $pagina->construirComboPreseleccion("liga", "Indique a qué liga pertenece el equipo", $_row, $_equipo['codLiga']);
					    $pdo = null;
	        		?>
	          </div>
	        </div>
	        <div class="custom-control custom-checkbox" data-step="5" data-intro="En caso de que el equipo juegue torneos internacionales,
	        puede indicarlo marcando la siguiente casilla">
	          <input name="internacional" type="checkbox" class="custom-control-input" id="internacional"
	           <?php echo (($_equipo['internacional'])?'checked':''); ?>>
	          <label class="custom-control-label" for="internacional">Internacional <i class="fas fa-flag"></i></label>
	        </div>
	        <hr class="mb-4">
	        <input name="id" type="hidden" value="<?php echo $_GET['id']; ?>"/>
	        <button class="btn btn-primary btn-lg btn-block" type="submit" data-step="6" data-intro="Finalmente con este botón si todos los campos
	        fueron rellenados correctamente, se actualizarán los datos del equipo">Confirmar y actualizar <i class="fas fa-user-plus"></i></button>
	      </form>
	    </div>
	  </div>  
  	</div>
  	<?php
  		$pagina->construirBotonCancelar(7);
    	$pagina->inyectarLibreriasScripts();
  	?>
  </body>
</html>

<?php
	include("php/cpagina.php");

	$pagina = new Pagina("insertar_equipo", "Formulario para la creación de nuevos equipos");
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

	    <p class="lead">Mediante el siguiente formulario, se puede dar de alta un
	    nuevo equipo en la liga que se desee.</p>
	    <p class="lead">Para ello, se debe cumplimentar los siguientes campos
		con la información requerida. <a href="javascript:mostrarTutorial();"><i class="fas fa-question-circle"></i></a></p>
	  </div>

	  <div class="row" data-step="1" data-intro="Mediante este formulario, puede dar de alta un nuevo equipo siguiendo estos pasos">
	    <div class="col-md-12">
	      <h4 class="mb-3">Datos del nuevo equipo</h4>

	      <form method="post" action="php/altaEquipo.php">
	        <!-- Nombre y localidad -->
	        <div class="row">
	          <div class="col-md-6 mb-3" data-step="2" data-intro="En este campo podrá indicar qué nombre tendrá el nuevo equipo">
	            <label for="nombreEquipo">Nombre del equipo <i class="far fa-futbol"></i></label>
	            <input name="nombreEquipo" type="text" class="form-control" id="nombreEquipo" placeholder="" value="" maxlength="40" required>
	          </div>
	          <div class="col-md-6 mb-3" data-step="3" data-intro="Dónde estará ubicado el equipo se puede especificar con este campo">
	            <label for="localidad">Localidad <i class="fas fa-home"></i></label>
	            <input name="localidad" type="text" class="form-control" id="localidad" placeholder="" value="" maxlength="60" required>
	          </div>
	        </div>

	        <!-- Ligas -->
	        <div class="row" data-step="4" data-intro="No olvide seleccionar a qué liga pertenece el nuevo equipo">
	        	<div class="col-md-5 mb-3">
	        		<?php
	        			$pdo = conectaDB();

					    $stmt = $pdo->query("SELECT codLiga AS id, nomLiga AS nombre FROM ligas");
					    $_row = $stmt->fetchAll(PDO::FETCH_ASSOC);

					    $pagina->construirCombo("liga", "Indique a qué liga pertenece el equipo", $_row);
					    $pdo = null;
	        		?>
	          </div>
	        </div>
	        <div class="custom-control custom-checkbox" data-step="5" data-intro="En caso de que el equipo juegue torneos internacionales,
	        puede indicarlo marcando la siguiente casilla">
	          <input name="internacional" type="checkbox" class="custom-control-input" id="internacional">
	          <label class="custom-control-label" for="internacional">Internacional <i class="fas fa-flag"></i></label>
	        </div>
	        <hr class="mb-4">
	        <button class="btn btn-primary btn-lg btn-block" type="submit" data-step="6" data-intro="Finalmente con este botón si todos los campos
	        fueron rellenados correctamente, se dará de alta al nuevo equipo">Confirmar y crear <i class="fas fa-user-plus"></i></button>
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

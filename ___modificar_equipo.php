<?php
	include("php/cpagina.php");

	$pagina = new Pagina("modificar_equipo", "Formulario para la modificación de un equipo existente");
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

	    <p class="lead">Mediante el siguiente formulario, se pueden modificar los datos de
	    un equipo existente.</p>
	    <p class="lead">Para ello, se debe cumplimentar los siguientes campos
		con la información requerida y confirmar una vez terminado. En caso contrario, puede
		<a href="equipos.php">volver a la pantalla anterior sin realizar cambios</a></p>
	  </div>

	  <div class="row">    
	    <div class="col-md-12">
	      <h4 class="mb-3">Datos del equipo</h4> <!-- TODO: Mostrar aquí el nombre del equipo -->

	      <form method="POST" action="">
	        <!-- Nombre y localidad -->
	        <div class="row">
	          <div class="col-md-6 mb-3">
	            <label for="nombreEquipo">Nombre del equipo <i class="far fa-futbol"></i></label>
	            <input type="text" class="form-control" id="nombreEquipo" placeholder="" value="" required>
	          </div>
	          <div class="col-md-6 mb-3">
	            <label for="localidad">Localidad <i class="fas fa-home"></i></label>
	            <input type="text" class="form-control" id="localidad" placeholder="" value="" required>
	          </div>
	        </div>

	        <!-- Ligas -->
	        <div class="row">
	        	<div class="col-md-5 mb-3">
	            	<label for="liga">Liga <i class="fas fa-trophy"></i></label>
	            	<select class="custom-select" id="liga" required>
	            		<option value="" disabled selected hidden>Indique a qué liga pertenece el equipo</option>
	              		<option value="">Primera División Nacional</option>
	              		<option value="">Segunda División Nacional</option>
	              		<option value="">Segunda División Nacional B</option>
	            	</select>
	          </div>
	        </div>
	        <div class="custom-control custom-checkbox">
	          <input type="checkbox" class="custom-control-input" id="internacional">
	          <label class="custom-control-label" for="internacional">Internacional <i class="fas fa-flag"></i></label>
	        </div>
	        <hr class="mb-4">
	        <button class="btn btn-primary btn-lg btn-block" type="submit">Confirmar y actualizar <i class="fas fa-user-plus"></i></button>
	      </form>
	    </div>
	  </div>  
  	</div>
  </body>
</html>

<?php
	include("php/cpagina.php");

	$pagina = new Pagina("listar_contrato_futbolista", "Formulario para la consulta de los contratos de un futbolista");
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

	    <p class="lead">Mediante el siguiente formulario, se puede consultar los contratos de un futbolista.</p>
	    <p class="lead">Para ello, indique a continuación la información requerida. <a href="javascript:mostrarTutorial();"><i class="fas fa-question-circle"></i></a></p>
	  </div>

	  <div class="row" data-step="1" data-intro="Mediante este formulario, puede dar de alta un nuevo equipo siguiendo estos pasos">
	    <div class="col-md-12">
	      <h4 class="mb-3">Datos requeridos</h4>

	      <form method="post" action="listar_contrato_futbolista.php">
	        <!-- Nombre y localidad -->
	        <div class="row">
	          <div class="col-md-6 mb-3" data-step="2" data-intro="En este campo podrá indicar qué nombre tendrá el nuevo equipo">
	            <label for="dniJugador">DNI del jugador <i class="far fa-futbol"></i></label>
	            <input name="dniJugador" type="text" class="form-control" id="dniJugador" placeholder="" value="" maxlength="9" required>
	          </div>
	        </div>	        
	        <hr class="mb-4">
	        <button class="btn btn-primary btn-lg btn-block" type="submit" data-step="6" data-intro="Finalmente con este botón si todos los campos
	        fueron rellenados correctamente, se dará de alta al nuevo equipo">Buscar información <i class="fas fa-search"></i></button>
	      </form>

	      <div class="mb-3">
	      	<?php
	      		if (isset($_POST['dniJugador'])) {
	      			echo "<hr class='mb-4'>";
	      			$pdo = conectaDB();
	      			$id = $_POST['dniJugador'];

	      			$stmt = $pdo->prepare("Call listarContratoFutbolista(:codigoFutbolista)");
	      			$stmt->bindParam(":codigoFutbolista", $id);
	      			$stmt->execute();

	      			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
	      			$_cabeceraEquipo = array_keys($row[0]);

	      			if (strcmp($_cabeceraEquipo[0], "No existe contratos para el jugador con el dni dado") == 0) {
	      				?>
	      				<div class="alert alert-info" role="alert">
					  		No existe contratos para el jugador con el dni dado.
						</div>
	      				<?php
	      			} else {

	      				echo "<div class='container'>";
	      				$pagina->construirTablaSimple($_cabeceraEquipo, $row, [1, 1, 2, 2, 2, 2, 2]);
	      				echo "</div>";
	      			}

	      			$pdo = null;
	      		}
	      	?>
	      </div>
	    </div>
	  </div>  
  	</div>
  	<?php
  		$pagina->construirBotonCancelar(7);
    	$pagina->inyectarLibreriasScripts();
  	?>
  </body>
</html>
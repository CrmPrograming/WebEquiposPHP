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

	  <div class="row" data-step="1" data-intro="Mediante este formulario, puede buscar la información de los contratos de un futbolista.">
	    <div class="col-md-12">
	      <h4 class="mb-3">Datos requeridos</h4>

	      <form method="post" action="listar_contrato_futbolista.php">
	        <div class="row">
	          <div class="col-md-6 mb-3" data-step="2" data-intro="En este campo podrá indicar el DNI o NIE del jugador a consultar">
	            <label for="dniJugador">DNI del jugador <i class="far fa-futbol"></i></label>
	            <input name="dniJugador" type="text" class="form-control" id="dniJugador" placeholder="" value="" maxlength="9" required>
	          </div>
	        </div>	        
	        <hr class="mb-4">
	        <button class="btn btn-primary btn-lg btn-block" type="submit" data-step="3" data-intro="Con este botón se hará el proceso de búsqueda.">Buscar información <i class="fas fa-search"></i></button>
	      </form>

	      <div class="mb-3" data-step="4" data-intro="En esta sección aparecerán los datos asociados al jugador indicado.">
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
	      				      			
	      			if (strcmp($_cabeceraEquipo[0], TipoError::_MENSAJE[TipoError::DNI_SIN_CONTRATOS]) == 0) {
	      				echo "<div class='alert alert-info' role='alert'>";
					  	echo TipoError::_MENSAJE[TipoError::DNI_SIN_CONTRATOS];
						echo "</div>";
	      			} else {
	      				echo "<div class='container'>";
	      				$pagina->construirTablaSimple($_cabeceraEquipo, $row[0], [1, 1, 2, 2, 2, 2, 2]);
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
  		$pagina->construirBotonCancelar(5);
    	$pagina->inyectarLibreriasScripts();
  	?>
  </body>
</html>

<?php
	include("php/cpagina.php");

	$pagina = new Pagina("futbolistas_activos", "Formulario para la consulta de jugadores activos para un equipo dado");
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

	    <p class="lead">Mediante el siguiente formulario, se pueden consultar los jugadores en activo para un equipo específico.</p>
	    <p class="lead">Para ello, indique a continuación la información requerida. <a href="javascript:mostrarTutorial();"><i class="fas fa-question-circle"></i></a></p>
	  </div>

	  <div class="row" data-step="1" data-intro="Mediante este formulario, puede buscar la información de los activos de un equipo">
	    <div class="col-md-12">
	      <h4 class="mb-3">Datos requeridos</h4>

	      <form method="post" action="futbolistas_activos.php">
	        <div class="row">

	          <!-- Equipo -->
	          <div class="col-md-6 mb-3" data-step="2" data-intro="En este campo podrá indicar el equipo a consultar">

	        	<?php
	        		$pdo = conectaDB();
	        		$stmt = $pdo->query("SELECT codEquipo AS id, nomEquipo AS nombre FROM equipos");
	        		$_row = $stmt->fetchAll(PDO::FETCH_ASSOC);

	        		$pagina->construirCombo("equipo", "Indique a qué equipo pertenece el jugador", $_row);

	        		$pdo = null;
	        	?>
	          </div>

	          <div class="col-md-6 mb-3" data-step="2" data-intro="En este campo podrá indicar el precio anual máximo a evaluar">
	            <label for="precioAnual">Precio Anual <i class="fas fa-calendar-alt"></i></label>
	            <input name="precioAnual" type="number" class="form-control" id="precioAnual" placeholder="" value="" min="1" max="999999999999" required>
	          </div>

	          <div class="col-md-6 mb-3" data-step="3" data-intro="En este campo podrá indicar el precio de recisión máximo a evaluar">
	            <label for="precioRecision">Precio de recisión del contrato <i class="fas fa-money-bill-alt"></i></label>
	            <input name="precioRecision" type="number" class="form-control" id="precioRecision" placeholder="" value="" min="1" max="999999999999" required>
	          </div>

	        </div>	        
	        <hr class="mb-4">
	        <button class="btn btn-primary btn-lg btn-block" type="submit" data-step="4" data-intro="Con este botón se hará el proceso de búsqueda">Buscar información <i class="fas fa-search"></i></button>
	      </form>

	      <div class="mb-3" data-step="5" data-intro="En esta sección aparecerán los datos asociados la búsqueda realizada">
	      	<?php
	      		if (isset($_POST['equipo'], $_POST['precioAnual'], $_POST['precioRecision'])) {
	      			echo "<hr class='mb-4'>";
	      			$pdo = conectaDB();

	      			$stmt = $pdo->prepare("Call futbolistasActivos(:pEquipo, :pPrecio, :pRecis, @oActivosEquipo, @oActivosPrecioAnual)");

	      			$stmt->bindParam(":pEquipo", $_POST['equipo']);
	      			$stmt->bindParam(":pPrecio", $_POST['precioAnual']);
	      			$stmt->bindParam(":pRecis", $_POST['precioRecision']);

	      			$stmt->execute();

	      			$stmt = $pdo->query("SELECT @oActivosEquipo AS activosEquipo, @oActivosPrecioAnual AS activosPrecioAnual");

	      			$row = $stmt->fetch();
	      			$pdo = null;

	      			if (((int) $row['activosEquipo'] == -1)) {
	      				echo "<div class='alert alert-info' role='alert'>";
					  	echo TipoError::_MENSAJE[TipoError::EQUIPO_NO_EXISTE];
						echo "</div>";
	      			} else {
	      				$_cabecera = ["activosEquipo", "activosPrecioAnual"];

	      				echo "<div class='container'>";
	      				
						// Cabecera de la tabla
						echo '<div class="row mb-12 cabecera">';
						foreach ($_cabecera as $i) {
							echo "<div class='col-6 themed-grid-col'>$i</div>";							
						}
						echo '</div>';
						
						echo '<div class="row mb-12 entrada">';
						for ($i = 0; $i < count($_cabecera); $i++) {
							echo "<div class='col-6 themed-grid-col'>";
							echo $row[$_cabecera[$i]];
							echo "</div>";
						}
					    echo "</div>";
					    echo "</div>";
	      			}

	      		}
	      	?>
	      </div>
	    </div>
	  </div>  
  	</div>
  	<?php
  		$pagina->construirBotonCancelar(6);
    	$pagina->inyectarLibreriasScripts();
  	?>
  </body>
</html>

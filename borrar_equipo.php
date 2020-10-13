<?php
	if (!isset($_GET['id']))
		header("location:equipos.php");

	include("php/cpagina.php");

	$pagina = new Pagina("borrar_equipo", "Formulario para confirmar el borrado de un equipo");
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

	    <p class="lead">Está a punto de borrar el siguiente equipo:</p>
	  </div>

	  <div class="row">
	    <div class="col-md-12">
	    	<div class="jumbotron">
	    		<div class="container">
	    			<?php
					    $pdo = conectaDB();

					    $stmt = $pdo->prepare("SELECT nomEquipo, nomLiga, localidad, internacional FROM equipos INNER JOIN ligas ON equipos.codLiga = ligas.codLiga WHERE codEquipo=?");
					    $_dato = array($_GET['id']);
					    $stmt->execute($_dato);

					    // Comprobamos si realmente se preguntó por un equipo existente
					    // En caso contrario retornamos a la página principal
					    // Con esto evitamos que accedan a la página sin dar un equipo
					    if ($stmt->rowCount() == 0)
					    	header("location:equipos.php");

					    $_row = $stmt->fetchAll(PDO::FETCH_ASSOC);
						$_cabeceraEquipo = array_keys($_row[0]);

						$pagina->construirTablaSimple($_cabeceraEquipo, $_row);
					    $pdo = null;
						?>
	    			
	    			<hr class="my-4">
	    			<div class="alert alert-danger" role="alert">
					  <strong>AVISO:</strong> Esta operación es irreversible; una vez borrado no se puede recuperar el equipo.
					</div>
					<form id="formBorrar" action="php/borrarEquipo.php" method="post">
						<input name="id" type="hidden" value="<?php echo $_GET['id']; ?>"/>
	    				<a class="btn btn-primary btn-lg" href="javascript:document.getElementById('formBorrar').submit();" role="button">Confirmar borrado <i class="fas fa-trash-alt"></i></a>
	    			</form>
	    		</div>
	    	</div>
	    </div>
	  </div>  
  	</div>
  	<?php
  		$pagina->construirBotonCancelar(1);
    	$pagina->inyectarLibreriasScripts();
  	?>
  </body>
</html>

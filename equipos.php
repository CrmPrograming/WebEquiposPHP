<?php
	include("php/cpagina.php");

	$pagina = new Pagina("equipos", "Listado de equipos almacenados");
  $pagina->comprobarOperacion();
?>
<!doctype html>
<html lang="es">
  <head>
    <?php
    	$pagina->construirHeader();
    ?>
  </head>
  <body class="py-4">
    <div class="container" data-step="1" data-intro="En esta página podrá consultar los distintos equipos almacenados">

    <h1><?php echo $pagina->getTitulo(); ?></h1>    

    <h2 class="mt-4">Listado de Equipos existentes</h2>
    <p>A continuación se muestra el listado de equipos almacenados. Para añadir más, utilizar el formulario
    accesible desde el botón a continuación. <a href="javascript:mostrarTutorial();"><i class="fas fa-question-circle"></i></a></p>

    <div class="row mb-12">
      <button type="button" class="btn btn-primary" onclick="location.href='insertar_equipo.php'" data-step="3" data-intro="Si queremos añadir más equipos, este botón nos llevará al formulario de alta">Añadir Equipo <i class="fas fa-user-plus"></i></button>
    </div>

    <hr/>

	<?php
    $pdo = conectaDB();

    $stmt = $pdo->query("SELECT codEquipo AS id, nomEquipo, codLiga, localidad, internacional FROM equipos");

    $_row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$_cabeceraEquipo = array_keys($_row[0]);

		$pagina->construirTablaEditable($_cabeceraEquipo, $_row);
    $pdo = null;
	?>

  </div>

  <?php
    $pagina->inyectarLibreriasScripts();
  ?>

  </body>
</html>

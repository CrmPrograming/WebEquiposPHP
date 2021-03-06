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
      <div class="btn-group" role="group" aria-label="Opciones del menú">
        <button type="button" class="btn btn-primary" onclick="location.href='insertar_equipo.php'" data-step="5" data-intro="Si queremos añadir más equipos, este botón nos llevará al formulario de alta">Añadir Equipo <i class="fas fa-user-plus"></i></button>

        <div class="btn-group" role="group" data-step="6" data-intro="El resto de funciones y procedimientos disponibles se encuentran en este menú">
          <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Funciones y procedimientos
          </button>
          <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
            <a class="dropdown-item" href="listar_contrato_futbolista.php">Contratos de un futbolista <i class="fas fa-file-contract"></i></a>
            <a class="dropdown-item" href="futbolistas_activos.php">Futbolistas en activos de un equipo <i class="fas fa-futbol"></i></a>
            <a class="dropdown-item" href="total_meses_futbolista.php">Meses en activo de un futbolista <i class="fas fa-calendar-alt"></i></a>
          </div>
        </div>
        
      </div>
    </div>

    <hr/>

	<?php
    $pdo = conectaDB();

    $stmt = $pdo->query("SELECT codEquipo AS id, nomEquipo, nomLiga, localidad, internacional FROM equipos INNER JOIN ligas ON equipos.codLiga = ligas.codLiga");

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

<?php
	include("php/cpagina.php");

	$pagina = new Pagina("equipos", "Listado de equipos almacenados");
?>
<!doctype html>
<html lang="es">
  <head>
    <?php
    	$pagina->construirHeader();
    ?>
  </head>
  <body class="py-4">
    <div class="container">

    <h1><?php echo $pagina->getTitulo(); ?></h1>    

    <h2 class="mt-4">Listado de Equipos existentes</h2>
    <p>A continuación se muestra el listado de equipos almacenados. Para añadir más, utilizar el formulario
    accesible desde el botón a continuación.</p>

    <div class="row mb-12">
      <button type="button" class="btn btn-primary" onclick="location.href='insertar_equipo.php'">Añadir Equipo <i class="fas fa-user-plus"></i></button>
    </div>    

    <hr/>

	<?php
		$_cabeceraEquipo = ['codEquipo', 
							'nomEquipo',
							'codLiga',
							'localidad',
							'internacional'];

		$pagina->construirTablaEditable($_cabeceraEquipo, []);
	?>

  </div>

  </body>
</html>

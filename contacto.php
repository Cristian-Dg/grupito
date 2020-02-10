<?php

	require_once('bbdd/bbdd.php');
	
	$pagina='contacto';
	$titulo='Contacta con nosotros';
	
	require_once('inc/encabezado.php');
	require_once('inc/funciones.php');
	
?>

<?php
	$productos = seleccionarOfertasPortada(numOfertas);
?>

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Contacto </h1>
	  <p >Formulario de Contacto:</p>
      <p><a class="btn btn-primary btn-lg" href="productos.php" role="button">Contactanos >></a></p>
    </div>
  </div>
  </div> <!-- /container -->

</main>

<?php
	require_once('inc/pie.php');
?>

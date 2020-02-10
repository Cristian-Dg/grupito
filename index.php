<?php
	require_once('bbdd/bbdd.php');
	require_once('bbdd/bbdd(usuarios).php');
	session_start();
	if(isset($_SESSION['usuario'])){
		$usuario = seleccionarUsuario($_SESSION['usuario']);
	}
	$pagina='index';
	$titulo='My Grupito';
	
	require_once('inc/encabezado.php');
	require_once('inc/funciones.php');
	
?>

<?php
	$productos = seleccionarOfertasPortada(numOfertas);
?>

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Welcome to My Grupito!</h1>
      <p >La tienda en Spanglish con las mejores ofertas de internet que podrás compartir con tus amigos.</p>
      <p><a class="btn btn-primary btn-lg" href="productos.php" role="button">Nuestras ofertas »</a></p>
    </div>
  </div>

  <div class="container">
  <?php mostrarProductos($productos); ?>
  <hr>
  </div> <!-- /container -->

</main>

<?php
	require_once('inc/pie.php');
?>

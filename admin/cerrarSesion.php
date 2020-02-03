<?php 
	session_start();
	require_once "inc/bbdd(productos).php";
	require_once "inc/encabezado.php";
?>
	<main role="main" class="container">
		<h1 class='mt-5' align='center'>Cerrar Sesión</h1>
		<?php
			if(isset($_SESSION['nombre'])){
				session_destroy();
				echo '<h4>Sesión cerrada</h4>';
			}
			else{
				echo '<h4>Error, la sesión no existe</h4>';
			}
		?>
		<p><a href='index.php' class='btn btn-dark'>Volver al inicio de sesión</a></p>
	</main>

<?php
	require_once "inc/pie.php";
?>
<?php
	session_start();
	require_once('bbdd/bbdd.php');
	if(isset($_SESSION['usuario'])){
		$usuario = seleccionarUsuario($_SESSION['usuario']);
	}
	require_once('inc/encabezado.php');
	require_once('inc/funciones.php');
?>

  <div class="jumbotron">
    <div class="container">
      <h2 class="display-3">Mis Datos</h2>
      <p><a class="btn btn-primary btn-lg" href="modificarDatos.php" role="button">Modificar Datos »</a></p>
    </div>
  </div>
<?php

	echo "<p><strong>Nombre:</strong> ".$usuario['nombre']."</p>";
	echo "<p><strong>Apellidos:</strong> ".$usuario['apellidos']."</p>";
	echo "<p><strong>Email:</strong> ".$usuario['email']."</p>";
	echo "<p><strong>Direccion:</strong> ".$usuario['direccion']."</p>";
	echo "<p><strong>Telefono:</strong> ".$usuario['telefono']."</p>";

?>
	</div>
	</div>
</main>

<?php
	require_once('inc/pie.php');
?>
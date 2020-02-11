<?php 
	require_once "inc/funciones.php";
	require_once "bbdd/bbdd.php";
	require_once "inc/encabezado.php";
?>

	<main role="main" class="container">
    <h1 class='mt-5' align='center'>Borrar Usuario</h1>
<?php
	$idUsuario=recoge('idUsuario');
	if($idUsuario==''){
		header("location: index(Usuarios).php");
		exit();
	}
	$funciona=borrarUsuario($idUsuario);
	if(!$funciona){
		echo'<div class="alert alert-danger" role="alert">Error al borrar el usuario</div>';
		echo "<p><a href='index(Usuarios).php' class='btn btn-dark'>Volver al listado de usuarios</a></p>";
	}
	else{
		echo'<div class="alert alert-success" role="alert">El usuario '.$idUsuario.' ha sido borrado</div>';
		echo "<p><a href='index(Usuarios).php' class='btn btn-dark'>Volver al listado de usuarios</a></p>";
	}
?>
	</main>

<?php
	require_once "inc/pie.php";
?>
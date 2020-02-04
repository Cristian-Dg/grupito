<?php 
	require_once "inc/bbdd.php";
	require_once "inc/funciones.php";
	require_once "inc/encabezado.php";
?>

	<main role="main" class="container">
    <h1 class='mt-5' align='center'>Borrar producto</h1>
<?php
	$idProducto=recoge('idProducto');
	if($idProducto==''){
		header("location: index.php");
		exit();
	}
	$funciona=borrarProducto($idProducto);
	if(!$funciona){
		echo'<div class="alert alert-danger" role="alert">Error al borrar el producto</div>';
		echo "<p><a href='index(productos).php' class='btn btn-dark'>Volver al listado de productos</a></p>";
	}
	else{
		echo'<div class="alert alert-success" role="alert">El producto '.$idProducto.' ha sido borrado</div>';
		echo "<p><a href='index(productos).php' class='btn btn-dark'>Volver al listado de productos</a></p>";
	}
?>
	</main>

<?php
	require_once "inc/pie.php";
?>
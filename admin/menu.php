<?php 
	session_start();
	if(empty($_SESSION['nombre'])){
		header ('location: index.php?redirect=1');
	}
	require_once "inc/encabezado.php";
?>
	<main role="main" class="container">
    <h1 class='mt-5' align='center'>-_MENÚ_-</h1>
	<p><a href='index(productos).php' class='btn btn-info btn-block'>Listado de Productos</a></p>
	</main>

<?php
	require_once "inc/pie.php";
?>

<?php 
	session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<title>Cerrar Sesión</title>
</head>

<body>
	<h1 align='center'>Cerrar Sesión</h1>
	<?php
		if(isset($_SESSION['usuario'])){
			session_destroy();
			header ('location: index.php');
		}
		else{
			echo '<h4>Error, la sesión no existe</h4>';
			echo '<p><a href="index.php" class="btn btn-dark">Volver a Inicio</a></p>';
		}
	?>
</body>

</html>

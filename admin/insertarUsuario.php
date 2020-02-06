<?php 
	require_once "inc/funciones.php";
	require_once "inc/bbdd.php";
	require_once "inc/encabezado.php";
?>

<?php
	function imprimirFormulario($nombre,$password){
?>
	<form method='POST'>
		<div class="form-group">
			<label for="nombre"><strong>Nombre</strong></label>
			<input type="text" class="form-control" id="nombre" name="nombre" value='<?php echo $nombre; ?>'/>
		</div>
		<div class="form-group">
			<label for="password"><strong>Password</strong></label>
			<input type="password" class="form-control" id="password" name="password" value='<?php echo $password; ?>'/>
		</div>
		<p><br><button type="submit" class="btn btn-secondary" name='guardar' value='guardar'>Guardar</button></p>
	</form>
<?php
	}
?>
	<main role="main" class="container">
    <h1 class='mt-5' align='center'>Nuevo usuario</h1>
<?php
	if(!isset($_REQUEST['guardar'])){
		$nombre='';
		$password='';
		imprimirFormulario($nombre,$password);
	}
	else{
		$nombre=recoge('nombre');
		$password=recoge('password');
		$usuario=comprobarUsuario($nombre);
		$errores='';
		if($nombre==''){
			$errores=$errores.'<li>El campo nombre no puede estar vacío</li>';
		}
		if($usuario){
			$errores=$errores.'<li>El usuario ya existe</li>';
		}
		if($password==''){
			$errores=$errores.'<li>El campo password no puede estar vacío</li>';
		}
		if($errores!=''){
			echo "<h3>Errores:</h3><ul>".$errores."</ul>";
			imprimirFormulario($nombre,$password);
		}
		else{
			$idUsuario=insertarusuario($nombre,$password);
			if($idUsuario==0){
				echo'<div class="alert alert-danger" role="alert">Error al insertar el usuario</div>';
				imprimirFormulario($nombre,$password);
			}
			else{
				echo'<div class="alert alert-success" role="alert">El usuario '.$idUsuario.' ha sido insertado</div>';
				echo "<p><a href='index(Usuarios).php' class='btn btn-dark'>Volver</a></p>";
			}
		}
	}
?>
	</main>

<?php
	require_once "inc/pie.php";
?>
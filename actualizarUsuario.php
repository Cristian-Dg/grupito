<?php
	session_start();
	require_once('bbdd/bbdd.php');
	if(isset($_SESSION['usuario'])){
		$usuario = seleccionarUsuario($_SESSION['usuario']);
	}
	$pagina='misDatos';
	$titulo='Actualizar Datos';
	require_once('inc/funciones.php');
	require_once('inc/encabezado.php');
?>

<?php
	function imprimirFormulario($idUsuario,$nombre,$apellidos,$email,$direccion,$telefono){
?>
	<form method='POST'>
		<div class="form-group">
			<label for="idUsuario"><strong>ID</strong></label>
			<input type="number" class="form-control" id="idUsuario" name="idUsuario" value='<?php echo $idUsuario; ?>' readonly />
		</div>
		<div class="form-group">
			<label for="nombre"><strong>Nombre</strong></label>
			<input type="text" class="form-control" id="nombre" name="nombre" value='<?php echo $nombre; ?>'/>
		</div>
		<div class="form-group">
			<label for="apellidos"><strong>Apellidos</strong></label>
			<input type="text" class="form-control" id="apellidos" name="apellidos" value='<?php echo $apellidos; ?>'/>
		</div>
		<div class="form-group">
			<label for="email"><strong>Email</strong></label>
			<input type="email" class="form-control" id="email" name="email" value='<?php echo $email; ?>' readonly />
		</div>
		<div class="form-group">
			<label for="direccion"><strong>Dirección</strong></label>
			<input type="text" class="form-control" id="direccion" name="direccion" value='<?php echo $direccion; ?>'/>
		</div>
		<div class="form-group">
			<label for="telefono"><strong>Telefono</strong></label>
			<input type="text" class="form-control" id="telefono" name="telefono" value='<?php echo $telefono; ?>'/>
		</div>
		<p>
			<br><button type="submit" class="btn btn-secondary" name='guardar' value='guardar'>Guardar</button><button style="margin-left: 10px" type="submit" class="btn btn-secondary" name='volver' value='volver'>Volver</button>
		</p>
	</form>
<?php
	}
?>

	<main role="main" class="container">
    <h1 class='mt-5' align='center'>Actualizar Datos</h1>
<?php
	if(isset($_REQUEST['volver'])){
		header("location: misDatos.php");
	}
	if(!isset($_REQUEST['guardar'])){
		if(empty($usuario)){
			header("location: index.php");
			exit();	
		}
		$idUsuario = $usuario['idUsuario'];
		$nombre = $usuario['nombre'];
		$apellidos = $usuario['apellidos'];
		$email = $usuario['email'];
		$direccion = $usuario['direccion'];
		$telefono = $usuario['telefono'];
		imprimirFormulario($idUsuario,$nombre,$apellidos,$email,$direccion,$telefono);
	}
	else{
		$idUsuario=recoge('idUsuario');
		$nombre=recoge('nombre');
		$apellidos = recoge('apellidos');
		$email = recoge('email');
		$direccion = recoge('direccion');
		$telefono = recoge('telefono');
		$usuario=comprobarUsuario($nombre);
		$errores='';
		if($nombre==''){
			$errores=$errores.'<li>El campo nombre no puede estar vacío</li>';
		}
		if($errores!=''){
			echo "<h3>Errores:</h3><ul>".$errores."</ul>";
			imprimirFormulario($idUsuario,$nombre,$apellidos,$email,$direccion,$telefono);
		}
		else{
			$funciona=actualizarDatos($idUsuario,$nombre,$apellidos,$email,$direccion,$telefono);
			if(!$funciona){
				echo'<div class="alert alert-danger" role="alert">Error al actualizar tus datos</div>';
				imprimirFormulario($idUsuario,$nombre,$apellidos,$email,$direccion,$telefono);
			}
			else{
				$mensaje = "Datos Actualizados";
				mostrarMensaje($mensaje);
				echo '<a href="misDatos.php" class="btn btn-outline-success my-2 my-sm-0">volver</a>';
			}
		}
	}
?>
	</main>

<?php
	require_once "inc/pie.php";
?>
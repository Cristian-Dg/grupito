<?php 
	require_once "inc/funciones.php";
	require_once "bbdd/bbdd.php";
	require_once "inc/encabezado.php";
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
			<input type="email" class="form-control" id="email" name="email" value='<?php echo $email; ?>'/>
		</div>
		<div class="form-group">
			<label for="direccion"><strong>Dirección</strong></label>
			<input type="text" class="form-control" id="direccion" name="direccion" value='<?php echo $direccion; ?>'/>
		</div>
		<div class="form-group">
			<label for="telefono"><strong>Telefono</strong></label>
			<input type="text" class="form-control" id="telefono" name="telefono" value='<?php echo $telefono; ?>'/>
		</div>
		<div class="form-group">
			<label for="aPassword"><strong>Password antigua</strong></label>
			<input type="password" class="form-control" id="aPassword" name="aPassword" />
		</div>
		<div class="form-group">
			<label for="nPassword1"><strong>Password nueva</strong></label>
			<input type="password" class="form-control" id="nPassword1" name="nPassword1" />
		</div>
		<div class="form-group">
			<label for="nPassword2"><strong>Repetir Password</strong></label>
			<input type="password" class="form-control" id="nPassword2" name="nPassword2" />
		</div>
		<p>
			<br><button type="submit" class="btn btn-secondary" name='guardar' value='guardar'>Guardar</button><button style="margin-left: 10px" type="submit" class="btn btn-secondary" name='volver' value='volver'>Volver</button>
		</p>
	</form>
<?php
	}
?>

	<main role="main" class="container">
    <h1 class='mt-5' align='center'>Actualizar usuario</h1>
<?php
	if(isset($_REQUEST['volver'])){
		header("location: index(Usuarios).php");
	}
	if(!isset($_REQUEST['guardar'])){
		$email=recoge('email');
		if($idUsuario==''){
			header("location: index(Usuarios).php");
			exit();
		}
		$usuario=seleccionarUsuario($email);
		if(empty($usuario)){
			header("location: index(Usuarios).php");
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
		$password=recoge('aPassword');
		$newPassword=recoge('nPassword1');
		$verifPassword=recoge('nPassword2');
		$usuario=comprobarUsuario($nombre);
		$ok=password_verify($password,$usuario['password']);
		$errores='';
		if($nombre==''){
			$errores=$errores.'<li>El campo nombre no puede estar vacío</li>';
		}
		if($password==''){
			$errores=$errores.'<li>El campo password antigua no puede estar vacío</li>';
		}
		if($newPassword!=$verifPassword){
			$errores=$errores.'<li>La Password nueva no coincide</li>';
		}
		if (!$ok){
			$errores=$errores.'<li>Password antigua incorrecta</li>';
		}
		if($errores!=''){
			echo "<h3>Errores:</h3><ul>".$errores."</ul>";
			imprimirFormulario($idUsuario,$nombre,$apellidos,$email,$direccion,$telefono);
		}
		else{
			$funciona=actualizarUsuario($idUsuario,$nombre,$newPassword,$apellidos,$email,$direccion,$telefono);
			if(!$funciona){
				echo'<div class="alert alert-danger" role="alert">Error al actualizar el usuario</div>';
				imprimirFormulario($idUsuario,$nombre,$apellidos,$email,$direccion,$telefono);
			}
			else{
				echo'<div class="alert alert-success" role="alert">El usuario '.$idUsuario.' ha sido actualizado</div>';
				echo "<p><a href='index(Usuarios).php' class='btn btn-dark'>Volver al listado de usuarios</a></p>";
			}
		}
	}
?>
	</main>

<?php
	require_once "inc/pie.php";
?>
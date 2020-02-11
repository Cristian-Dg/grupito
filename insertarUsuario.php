<?php 
	require_once "inc/funciones.php";
	require_once('bbdd/bbdd.php');
	require_once "inc/encabezado.php";
?>

<?php
	function imprimirFormulario($nombre,$password,$apellidos,$email,$direccion,$telefono){
?>
	<form method='POST'>
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
			<label for="password"><strong>Password</strong></label>
			<input type="password" class="form-control" id="password" name="password" value='<?php echo $password; ?>'/>
		</div>
		<p>
			<br><button type="submit" class="btn btn-secondary" name='guardar' value='guardar'>Guardar</button><button style="margin-left: 10px" type="submit" class="btn btn-secondary" name='volver' value='volver'>Volver</button>
		</p>
	</form>
<?php
	}
?>
	<main role="main" class="container">
    <h1 class='mt-5' align='center'>Nuevo usuario</h1>
<?php
	if(isset($_REQUEST['volver'])){
		header("location: index(Usuarios).php");
	}
	if(!isset($_REQUEST['guardar'])){
		$nombre = '';
		$apellidos = '';
		$email = '';
		$direccion = '';
		$telefono ='';
		$password='';
		imprimirFormulario($nombre,$password,$apellidos,$email,$direccion,$telefono);
	}
	else{
		$nombre=recoge('nombre');
		$password=recoge('password');
		$apellidos = recoge('apellidos');
		$email = recoge('email');
		$direccion = recoge('direccion');
		$telefono = recoge('telefono');
		$usuario=comprobarUsuario($email);
		$errores='';
		if($nombre==''){
			$errores=$errores.'<li>El campo nombre no puede estar vacío</li>';
		}
		if($usuario){
			$errores=$errores.'<li>El usuario ya existe</li>';
		}
		if($apellidos==''){
			$errores=$errores.'<li>El campo apellidos no puede estar vacío</li>';
		}
		if($email==''){
			$errores=$errores.'<li>El campo email no puede estar vacío</li>';
		}
		if($direccion==''){
			$errores=$errores.'<li>El campo direccion no puede estar vacío</li>';
		}
		if($telefono==''){
			$errores=$errores.'<li>El campo telefono no puede estar vacío</li>';
		}
		if($password==''){
			$errores=$errores.'<li>El campo password no puede estar vacío</li>';
		}
		if($errores!=''){
			echo "<h3>Errores:</h3><ul>".$errores."</ul>";
			imprimirFormulario($nombre,$password,$apellidos,$email,$direccion,$telefono);
		}
		else{
			$idUsuario=insertarUsuario($nombre,$password,$apellidos,$email,$direccion,$telefono);
			if($idUsuario==0){
				echo'<div class="alert alert-danger" role="alert">Error al insertar el usuario</div>';
				imprimirFormulario($nombre,$password,$apellidos,$email,$direccion,$telefono);
			}
			else{
				echo'<div class="alert alert-success" role="alert">El usuario '.$idUsuario.' ha sido insertado</div>';
				echo "<p><a href='index.php' class='btn btn-dark'>Volver</a></p>";
			}
		}
	}
?>
	</main>

<?php
	require_once "inc/pie.php";
?>
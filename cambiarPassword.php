<?php
	session_start();
	require_once('bbdd/bbdd.php');
	if(isset($_SESSION['usuario'])){
		$usuario = seleccionarUsuario($_SESSION['usuario']);
	}
	$pagina='misDatos';
	$titulo='Actualizar Password';
	require_once('inc/funciones.php');
	require_once('inc/encabezado.php');
?>

<?php
	function imprimirFormulario(){
?>
	<form method='POST'>
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
    <h1 class='mt-5' align='center'>Actualizar Password</h1>
<?php
	if(isset($_REQUEST['volver'])){
		header("location: misDatos.php");
	}
	if(!isset($_REQUEST['guardar'])){
		if(empty($usuario)){
			header("location: index.php");
			exit();	
		}
		imprimirFormulario();
	}
	else{
		$password=recoge('aPassword');
		$newPassword=recoge('nPassword1');
		$verifPassword=recoge('nPassword2');
		$usuario=comprobarUsuario($nombre);
		$ok=password_verify($password,$usuario['password']);
		$errores='';
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
			$funciona=actualizarPassword($idUsuario,$newPassword);
			if(!$funciona){
				echo'<div class="alert alert-danger" role="alert">Error al actualizar la password</div>';
				imprimirFormulario();
			}
			else{
				$mensaje = "Password Actualizados";
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
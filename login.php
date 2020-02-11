<?php 
	session_start();
	require_once('bbdd/bbdd.php');
	require_once "inc/funciones.php";

	function imprimirFormulario($email,$password){
?>
	<form method='POST'>
		<div class="form-group">
			<label for="email"><strong>email</strong></label>
			<input type="text" class="form-control" id="email" name="email" value='<?php echo $email; ?>'/>
		</div>
		<div class="form-group">
			<label for="password"><strong>Password</strong></label>
			<input type="password" class="form-control" id="password" name="password" value='<?php echo $password; ?>'/>
		</div>
		<p><br><button type="submit" class="btn btn-outline-success" name='enviar' value='enviar'>Inicia Sesión</button></p>
		<p><a href='insertarUsuario.php' class='btn btn-dark'>Nuevo usuario</a></p>
	</form>
<?php
	}
?>

<!doctype html>
<html lang="esp">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Inicio Sesión</title>
  </head>
  <body>

	<main role="main" class="container">
    <h1 class='mt-5' align='center'>Inicio Sesión</h1>
	
<?php
	if(!isset($_REQUEST['enviar'])){
		$email='';
		$password='';
		imprimirFormulario($email,$password);
	}
	else{
		$email=recoge('email');
		$password=recoge('password');
		$errores='';
		if($email==''){
			$errores=$errores.'<li>El campo email no puede estar vacío</li>';
		}
		if($password==''){
			$errores=$errores.'<li>El campo password no puede estar vacío</li>';
		}
		if($errores!=''){
			echo "<h3>Errores:</h3><ul>".$errores."</ul>";
			imprimirFormulario($email,$password);
		}
		else{
			$usuario=comprobarUsuario($email);
			$ok=password_verify($password,$usuario['password']);
			if (!$ok){
				echo "<h4>Usuario o password incorrectos</h4>";
				echo "<p><a href='loging.php' class='btn btn-dark'>Volver al inicio de sesión</a></p>";
			}
			else{
				$_SESSION['usuario']=$email;
				header ('location: index.php');
			}
		}
	}
?>

	</main>

<?php
	require_once "inc/pie.php";
?>
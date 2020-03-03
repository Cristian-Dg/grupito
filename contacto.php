<?php
	session_start();
	require_once('bbdd/bbdd.php');
	require_once('inc/funciones.php');
	if(isset($_SESSION['usuario'])){
		$usuario = seleccionarUsuario($_SESSION['usuario']);
	}
	if(isset($_SESSION['contacto'])){
		if($_SESSION['contacto']==true){
			$mensaje = "el Mensaje fue enviado";
			mostrarMensaje($mensaje);
			unset($_SESSION['contacto']);
		}
		else{
			$mensaje = "el Mensaje no pudo ser enviado";
			mostrarMensaje($mensaje);
			unset($_SESSION['contacto']);
		}
	}
	
	$pagina='contacto';
	$titulo='Contacta con nosotros';
	
	require_once('inc/encabezado.php');
	
	
	function formularioCorreo(){
?>
	<form method='POST'>
		<p ><h5>Formulario de Contacto:</h5></p>
		<p><label for='email'>Email: </label> <input type='email' name='email' id='email' <?php if(isset($_SESSION['usuario'])){ ?> value='<?php echo $_SESSION['usuario']; ?>' <?php } ?>/><p>
		<p><label for='mailBody'>Mensaje: </label><br><textarea name='mailBody' id='mailBody'></textarea><p>
		<p><button type="submit" class="btn btn-info" name='guardar' value='guardar'>Contáctanos</button></p>
	</form>
<?php
	}	
?>
  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Contacto </h1>
<?php
	if(empty($_REQUEST['guardar'])){
		formularioCorreo();
	}else{
		$email=recoge('email');
		$mailBody=recoge('mailBody');
		$errores='';
		if($email==''){
			$errores=$errores.'<li>El campo email no puede estar vacío</li>';
		}
		if($mailBody==''){
			$errores=$errores.'<li>El campo mensaje no puede estar vacío</li>';
		}
		if($errores!=''){
			echo "<h3>Errores:</h3><ul>".$errores."</ul>";
			formularioCorreo();
		}
		else{
			$_SESSION['correo']=$email;
			$_SESSION['body']=$mailBody;
			header("location: ../enviarCorreo/index.php");
		}
	}
?>
    </div>
  </div>
  </div> <!-- /container -->

</main>

<?php
	require_once('inc/pie.php');
?>

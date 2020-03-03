<?php
	session_start();
	require_once('bbdd/bbdd.php');
	require_once('inc/funciones.php');
	require_once('inc/encabezado.php');
	
	
	if(isset($_SESSION['usuario'])){
		$usuario = seleccionarUsuario($_SESSION['usuario']);
		$total = $_SESSION['total'];
		$detallePedido = $_SESSION['carrito'];
		$idUsuario = $usuario['idUsuario'];
		
		$idPedido = insertarPedido($idUsuario,$detallePedido,$total);
		
		$_SESSION['idPedido'] = $idPedido;
		
		unset($_SESSION['total']);
		unset($_SESSION['carrito']);
		
		$_SESSION['email']=$_SESSION['usuario'];
		header("location: ../enviarCorreo/correoPedidos.php");

	}
	else{
		echo "<h4>No puedes confirmar un pedido sin iniciar sesión</h4>";
		echo '<a href="login.php" class="btn btn-outline-success my-2 my-sm-0">Inicia sesión</a>';
	}
?>
<?php
	session_start();
	include_once "bbdd/bbdd.php";
	require_once('inc/funciones.php');
	require_once('inc/encabezado.php');
?>

<?php
	$idProducto=recoge("id");
	$op = recoge("op");
	
	if($idProducto=="" OR $op==""){
		header("Location: index.php");
	}
	
	$producto = seleccionarProducto($idProducto);
	
	if(empty($producto)){
		header("Location: index.php");
	}
	
	switch($op){
		case "add":
			if(isset($_SESSION['carrito'][$idProducto])){
				$_SESSION['carrito'][$idProducto]++;
				$_SESSION['totalCant']++;
			}
			else{
				$_SESSION['carrito'][$idProducto]=1;
				$_SESSION['totalCant']++;
			}	
			break;
		case "remove":
			if(isset($_SESSION['carrito'][$idProducto])){
				$_SESSION['carrito'][$idProducto]--;
				$_SESSION['totalCant']--;
				if($_SESSION['carrito'][$idProducto]<=0){
					unset($_SESSION['carrito'][$idProducto]);
				}
			}
			break;
		case "empty":
			unset($_SESSION['carrito']);
			$_SESSION['totalCant']=0;
			break;
		default:
			header("Location: index.php");
	}
	
	if($_SESSION['totalCant']<0){
		$_SESSION['totalCant']=0;
	}
	header("Location: carrito.php");
?>
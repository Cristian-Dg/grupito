<?php require_once('configuracion.php'); ?>

<?php
function conectarBD(){
	try{
		$con = new PDO ("mysql:host=".HOST.";dbname=".DBNAME.";charset=utf8",USER,PASS);
		$con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
		echo "Error de conexión: ".$e->getMessage();
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $con;
}

function desconectarBD($con){
	$con=NULL;
	return $con;
}

//funcion seleccionar producto portada:
function seleccionarOfertasPortada($numOfertas){
	$con = conectarBD();
	
	try{
		$sql = 'SELECT * FROM productos LIMIT :numOfertas';
		$stmt = $con->prepare($sql);
		$stmt->bindParam(':numOfertas',$numOfertas,PDO::PARAM_INT);
		$stmt->execute();
		$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e){
		echo "Error al seleccionar Ofertas Portada: ".$e->getMessage();
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $rows;
}

//funcion seleccionar todos producto:
function seleccionarTodasOfertas(){
	$con = conectarBD();
	
	try{
		$sql = 'SELECT * FROM productos WHERE online=1';
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e){
		echo "Error al seleccionar productos: ".$e->getMessage();
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $rows;
}

//funcion seleccionar producto:
function seleccionarProducto($idProducto){ 
	$con = conectarBD();
	
	try{
		$sql = 'SELECT * FROM productos WHERE idProducto=:idProducto';
		$stmt = $con->prepare($sql);
		$stmt->bindParam(':idProducto',$idProducto,PDO::PARAM_INT);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e){
		echo "Error al seleccionar producto: ".$e->getMessage();
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $row;
}

//funcion borrar producto:
function borrarProducto($idProducto){
	$con=conectarBD();
	try{
		$sql="UPDATE productos SET online=0 WHERE idProducto=:idProducto";
		$stmt = $con->prepare($sql);
		$stmt->bindParam(':idProducto',$idProducto);
		$stmt->execute();
	}
	catch(PDOException $e){
		echo "Error al borrar producto: ".$e->getMessage();
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $stmt->rowCount();
}

?>
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

?>
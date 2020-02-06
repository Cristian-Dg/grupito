<?php include "configuracion.php"; ?>

<?php
//funcion --> conectarnos BD
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

//funcion --> desconectar BD
function desconectarBD($con){
	$con=NULL;
	return $con;
}

//funcion --> insertar usuario
function insertarUsuario($nombre,$password,$apellidos,$email,$direccion,$telefono){
	$password=password_hash($password,PASSWORD_DEFAULT);
	$con=conectarBD();
	try{
		$sql = "INSERT INTO usuarios (nombre,password,apellidos,email,direccion,telefono,online) VALUES (:nombre,:password,:apellidos,:email,:direccion,:telefono,1)";
		$stmt = $con->prepare($sql);
		$stmt->bindParam(':nombre',$nombre);
		$stmt->bindParam(':password',$password);
		$stmt->bindParam(':email',$email);
		$stmt->bindParam(':apellidos',$apellidos);
		$stmt->bindParam(':direccion',$direccion);
		$stmt->bindParam(':telefono',$telefono);
		$stmt->execute();
	}
	catch(PDOException $e){
		echo "Error al insertar usuario: ".$e->getMessage();
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $con->lastInsertId();
}

//funcion --> actualizar usuario
function actualizarUsuario($idUsuario,$nombre,$password,$apellidos,$email,$direccion,$telefono){
	$password=password_hash($password,PASSWORD_DEFAULT);
	$con=conectarBD();
	try{
		$sql="UPDATE usuarios SET nombre=:nombre, apellidos:apellidos, direccion=:direccion, telefono=:telefono email=:email, password=:password WHERE idUsuario=:idUsuario";
		$stmt = $con->prepare($sql);
		$stmt->bindParam(':idUsuario',$idUsuario);
		$stmt->bindParam(':nombre',$nombre);
		$stmt->bindParam(':password',$password);
		$stmt->bindParam(':email',$email);
		$stmt->bindParam(':apellidos',$apellidos);
		$stmt->bindParam(':direccion',$direccion);
		$stmt->bindParam(':telefono',$telefono);
		$stmt->execute();
	}
	catch(PDOException $e){
		echo "Error al actualizar usuario: ".$e->getMessage();
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $stmt->rowCount();
}


//funcion --> borrar usuario
function borrarUsuario($idUsuario){
	$con = conectarBD();
	try{
		$sql = "UPDATE usuarios SET online=0 WHERE idUsuario=:idUsuario";
		$stmt = $con->prepare($sql);
		$stmt->bindParam(':idUsuario',$idUsuario);
		$stmt->execute();
	}
	catch(PDOException $e){
		echo "Error al borrar usuario: ".$e->getMessage();
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $stmt->rowCount();
}

//funcion --> seleccionar todas usuarios
function seleccionarTodosUsuarios(){
	$con = conectarBD();
	try{
		$sql = "SELECT * FROM usuarios WHERE online=1";
		$stmt = $con->query($sql);
		$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e){
		echo "Error al seleccionar todos usuarios: ".$e->getMessage();
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $rows;
}

//funcion --> contar usuarios
function contarUsuarios(){
	$con = conectarBD();
	try{
		$sql = "SELECT * FROM usuarios";
		$stmt = $con->query($sql);
	}
	catch(PDOException $e){
		echo "Error al contar usuarios: ".$e->getMessage();
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $stmt->rowCount();
}

//funcion --> seleccionar 1 usuario
function seleccionarUsuario($idUsuario){
	$con = conectarBD();
	try{
		$sql = "SELECT * FROM usuarios WHERE idUsuario=:idUsuario";
		$stmt = $con->prepare($sql);
		$stmt->bindParam(':idUsuario',$idUsuario);
		$stmt->execute();
		$rows=$stmt->fetch(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e){
		echo "Error al seleccionar un usuario: ".$e->getMessage();
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $rows;	
}

//funcion --> comprobar usuario
function comprobarUsuario($email){
	$con = conectarBD();
	try{
		$sql = "SELECT * FROM usuarios WHERE email=:email";
		$stmt = $con->prepare($sql);
		$stmt->bindParam(':email',$email);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e){
		echo "Error al comprobar un usuario: ".$e->getMessage();
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $row;
}

//funcion --> paginacion
function paginacion($inicio,$num){
	$con = conectarBD();
	try{
		$sql = "SELECT * FROM usuarios LIMIT $inicio,$num";
		$stmt = $con->query($sql);
		$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e){
		echo "Error al seleccionar usuarios: ".$e->getMessage();
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $rows;
}

?>
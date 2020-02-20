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

//funcion --> insertar usuarios
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

//funcion --> actualizar Datos
function actualizarDatos($idUsuario,$nombre,$apellidos,$email,$direccion,$telefono){
	$con=conectarBD();
	try{
		$sql="UPDATE usuarios SET nombre=:nombre, apellidos:apellidos, direccion=:direccion, telefono=:telefono, email=:email WHERE idUsuario=:idUsuario";
		$stmt = $con->prepare($sql);
		$stmt->bindParam(':idUsuario',$idUsuario);
		$stmt->bindParam(':nombre',$nombre);
		$stmt->bindParam(':email',$email);
		$stmt->bindParam(':apellidos',$apellidos);
		$stmt->bindParam(':direccion',$direccion);
		$stmt->bindParam(':telefono',$telefono);
		$stmt->execute();
	}
	catch(PDOException $e){
		echo "Error al actualizar datos: ".$e->getMessage();
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $stmt->rowCount();
}

//funcion --> actualizar Password
function actualizarPassword($idUsuario,$password){
	$password=password_hash($password,PASSWORD_DEFAULT);
	$con=conectarBD();
	try{
		$sql="UPDATE usuarios SET password=:password WHERE idUsuario=:idUsuario";
		$stmt = $con->prepare($sql);
		$stmt->bindParam(':idUsuario',$idUsuario);
		$stmt->bindParam(':password',$password);
		$stmt->execute();
	}
	catch(PDOException $e){
		echo "Error al actualizar Password: ".$e->getMessage();
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
function seleccionarUsuario($email){
	$con = conectarBD();
	try{
		$sql = "SELECT * FROM usuarios WHERE email=:email";
		$stmt = $con->prepare($sql);
		$stmt->bindParam(':email',$email);
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

// funcion --> insertar un pedido
function insertarPedido($idUsuario,$detallePedido,$total){
	$conexion = conectarBD();
	try{
		$conexion -> beginTransaction();
		
		$sql = "INSERT INTO pedidos (idUsuario, total, estado) VALUES (:idUsuario, :total, 1)";
		
		$sentencia = $conexion -> prepare($sql);
		
		$sentencia -> bindparam(":idUsuario", $idUsuario);
		$sentencia -> bindparam(":total", $total);
		
		$sentencia -> execute();
		
		$idPedido = $conexion->lastInsertId();
		
		foreach($detallePedido as $idProducto => $cantidad){
			
			$producto = seleccionarProducto($idProducto);
			$precio = $producto['precioOferta'];
			
			$sql2 = "INSERT INTO detallePedido (idPedido, idProducto, cantidad, precio) VALUES (:idPedido, :idProducto, :cantidad, :precio)";
			$sentencia = $conexion -> prepare($sql2);
		
			$sentencia -> bindparam(":idPedido", $idPedido);
			$sentencia -> bindparam(":idProducto", $idProducto);
			$sentencia -> bindparam(":cantidad", $cantidad);
			$sentencia -> bindparam(":precio", $precio);
			
			$sentencia -> execute();			
		}
		$conexion -> commit();
	}
	catch(PDOException $e){
		$conexion -> rollback();
		echo "Error: Error al insertar un pedido".$e->getMessage();
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a').$e->getMessage(),FILE_APPEND);
		exit;
	}
	return $idPedido;
}

//funcion --> seleccionar todos pedidos
function seleccionarTodosPedidos(){
	$con = conectarBD();
	try{
		$sql = "SELECT * FROM pedidos WHERE estado=1";
		$stmt = $con->query($sql);
		$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e){
		echo "Error al seleccionar todos pedidos: ".$e->getMessage();
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $rows;
}

//funcion --> seleccionar 1 pedido
function seleccionarPedido($idPedido){
	$con = conectarBD();
	try{
		$sql = "SELECT * FROM pedidos WHERE idPedido=:idPedido";
		$stmt = $con->prepare($sql);
		$stmt->bindParam(':idPedido',$idPedido);
		$stmt->execute();
		$rows=$stmt->fetch(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e){
		echo "Error al seleccionar un Pedido: ".$e->getMessage();
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $rows;	
}


?>
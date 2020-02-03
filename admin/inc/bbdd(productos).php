<?php include "configuracion(grupito).php"; ?>

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

//funcion --> insertar producto
function insertarProducto($nombre,$introDescripcion,$descripcion,$imagen,$precio,$precioOferta,$online){
	$con=conectarBD();
	try{
		$sql = "INSERT INTO productos (nombre,introDescripcion,descripcion,imagen,precio,precioOferta,online) VALUES (:nombre,:introDescripcion,:descripcion,:imagen,:precio,:precioOferta,:online)";
		$stmt = $con->prepare($sql);
		$stmt->bindParam(':nombre',$nombre);
		$stmt->bindParam(':introDescripcion',$introDescripcion);
		$stmt->bindParam(':descripcion',$descripcion);
		$stmt->bindParam(':imagen',$imagen);
		$stmt->bindParam(':precio',$precio);
		$stmt->bindParam(':precioOferta',$precioOferta);
		$stmt->bindParam(':online',$online);
		$stmt->execute();
	}
	catch(PDOException $e){
		echo "Error al insertar producto: ".$e->getMessage();
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $con->lastInsertId();
}

//funcion --> actualizar producto
function actualizarProducto($idProducto,$nombre,$introDescripcion,$descripcion,$imagen,$precio,$precioOferta,$online){
	$con=conectarBD();
	try{
		$sql="UPDATE productos SET nombre=:nombre, introDescripcion=:introDescripcion, descripcion=:descripcion, imagen=:imagen, precio=:precio, precioOferta=:precioOferta, online=:online WHERE idProducto=:idProducto";
		$stmt = $con->prepare($sql);
		$stmt->bindParam(':idProducto',$idProducto);
		$stmt->bindParam(':nombre',$nombre);
		$stmt->bindParam(':introDescripcion',$introDescripcion);
		$stmt->bindParam(':descripcion',$descripcion);
		$stmt->bindParam(':imagen',$imagen);
		$stmt->bindParam(':precio',$precio);
		$stmt->bindParam(':precioOferta',$precioOferta);
		$stmt->bindParam(':online',$online);
		$stmt->execute();
	}
	catch(PDOException $e){
		echo "Error al actualizar producto: ".$e->getMessage();
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $stmt->rowCount();
}


//funcion --> borrar producto
function borrarProducto($idProducto){
	$con = conectarBD();
	try{
		$sql = "DELETE FROM productos WHERE idProducto=$idProducto;";
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

//funcion --> seleccionar todas productos
function seleccionarTodosProductos(){
	$con = conectarBD();
	try{
		$sql = "SELECT * FROM productos";
		$stmt = $con->query($sql);
		$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e){
		echo "Error al seleccionar todos los productos: ".$e->getMessage();
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $rows;
}

// funcion --> productos paginadas
function paginacionProductos($inicio,$cant){
	$con = conectarBD();
	try{
		$sql = "SELECT * FROM productos LIMIT :inicio,:cant";
		$stmt = $con->prepare($sql);
		$stmt->bindParam(':inicio',$inicio,PDO::PARAM_INT); //PARAM_INT para convertir en entero
		$stmt->bindParam(':cant',$cant,PDO::PARAM_INT);
		$stmt->execute();
		$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e){
		echo "Error al seleccionar los productos: ".$e->getMessage();
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $rows;
}

//funcion --> seleccionar 1 producto
function seleccionarProducto($idProducto){
	$con = conectarBD();
	try{
		$sql = "SELECT * FROM productos WHERE idProducto=$idProducto";
		$stmt = $con->prepare($sql);
		$stmt->bindParam(':idProducto',$idProducto);
		$stmt->execute();
		$rows=$stmt->fetch(PDO::FETCH_ASSOC);
	}
	catch(PDOException $e){
		echo "Error al seleccionar un producto: ".$e->getMessage();
		file_put_contents("PDOErrors.txt","\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $rows;	
}

?>
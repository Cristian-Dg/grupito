<?php 
	require_once "inc/bbdd(productos).php";
	require_once "inc/funciones.php";
	require_once "inc/encabezado.php";
?>

<?php
	function imprimirFormulario($idProducto,$nombre,$introDescripcion,$descripcion,$imagen,$precio,$precioOferta,$online){
?>
	<form method='POST'>
		<div class="form-group">
			<label for="idProducto"><strong>ID</strong></label>
			<input type="number" class="form-control" id="idProducto" name="idProducto" value='<?php echo $idProducto; ?>' readonly />
		</div>
		<div class="form-group">
			<label for="nombre"><strong>Nombre</strong></label>
			<input type="text" class="form-control" id="nombre" name="nombre" value='<?php echo $nombre; ?>'/>
		</div>
		<div class="form-group">
			<label for="introDescripcion"><strong>intoDescripción</strong></label>
			<input type="text" class="form-control" id="introDescripcion" name="introDescripcion" value='<?php echo $introDescripcion; ?>'/>
		</div>
		<div class="form-group">
			<label for="descripcion"><strong>Descripción</strong></label>
			<input type="text" class="form-control" id="descripcion" name="descripcion" value='<?php echo $descripcion; ?>'/>
		</div>
		<div class="form-group">
			<label for="imagen"><strong>Imagen</strong></label>
			<input type="text" class="form-control" id="imagen" name="imagen" value='<?php echo $imagen; ?>'/>
		</div>
		<div class="form-group">
			<label for="precio"><strong>Precio</strong></label>
			<input type="text" class="form-control" id="precio" name="precio" value='<?php echo $precio; ?>'/>
		</div>
		<div class="form-group">
			<label for="precioOferta"><strong>PrecioOferta</strong></label>
			<input type="text" class="form-control" id="precioOferta" name="precioOferta" value='<?php echo $precioOferta; ?>'/>
		</div>
		<div class="form-group">
			<label for="online"><strong>Online</strong></label>
			<input type="text" class="form-control" id="online" name="online" value='<?php echo $online; ?>'/>
		</div>
		<p><br><button type="submit" class="btn btn-success" name='guardar' value='guardar'>Guardar</button></p>
	</form>
<?php
	}
?>

	<main role="main" class="container">
    <h1 class='mt-5' align='center'>Actualizar producto</h1>
<?php
	if(!isset($_REQUEST['guardar'])){
		$idProducto=recoge('idProducto');
		if($idProducto==''){
			header("location: index.php");
			exit();
		}
		$producto=seleccionarProducto($idProducto);
		if(empty($producto)){
			header("location: index.php");
			exit();	
		}
		$idProducto = $producto['idProducto'];
		$nombre = $producto['nombre'];
		$introDescripcion = $producto['introDescripcion'];
		$descripcion = $producto['descripcion'];
		$imagen = $producto['imagen'];
		$precio = $producto['precio'];
		$precioOferta = $producto['precioOferta'];
		$online = $producto['online'];
		imprimirFormulario($idProducto,$nombre,$introDescripcion,$descripcion,$imagen,$precio,$precioOferta,$online);
	}
	else{
		$idProducto = $producto['idProducto'];
		$nombre = $producto['nombre'];
		$introDescripcion = $producto['introDescripcion'];
		$descripcion = $producto['descripcion'];
		$imagen = $producto['imagen'];
		$precio = $producto['precio'];
		$precioOferta = $producto['precioOferta'];
		$online = $producto['online'];
		$errores='';
		if($nombre==''){
			$errores=$errores.'<li>El campo nombre no puede estar vacío</li>';
		}
		if($introDescripcion==''){
			$errores=$errores.'<li>El campo introDescripcion no puede estar vacío</li>';
		}
		if($descripcion==''){
			$errores=$errores.'<li>El campo descripcion no puede estar vacío</li>';
		}
		if($imagen==''){
			$errores=$errores.'<li>El campo imagen no puede estar vacío</li>';
		}
		if($precio==''){
			$errores=$errores.'<li>El campo precio no puede estar vacío</li>';
		}
		if($precioOferta==''){
			$errores=$errores.'<li>El campo precioOferta no puede estar vacío</li>';
		}
		if($online==''){
			$errores=$errores.'<li>El campo online no puede estar vacío</li>';
		}
		if($errores!=''){
			echo "<h3>Errores:</h3><ul>".$errores."</ul>";
			imprimirFormulario($idProducto,$nombre,$introDescripcion,$descripcion,$imagen,$precio,$precioOferta,$online);
		}
		else{
			$funciona=actualizarProducto($idProducto,$nombre,$introDescripcion,$descripcion,$imagen,$precio,$precioOferta,$online);
			if(!$funciona){
				echo'<div class="alert alert-danger" role="alert">Error al actualizar la producto</div>';
				imprimirFormulario($idProducto,$nombre,$introDescripcion,$descripcion,$imagen,$precio,$precioOferta,$online);
			}
			else{
				echo'<div class="alert alert-success" role="alert">La producto '.$idProducto.' ha sido actualizada</div>';
				echo "<p><a href='index(productos).php' class='btn btn-dark'>Volver al listado de productos</a></p>";
			}
		}
	}
?>
	</main>

<?php
	require_once "inc/pie.php";
?>

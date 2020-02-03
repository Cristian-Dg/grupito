<?php /*
	session_start();
	if(empty($_SESSION['nombre'])){
		header ('location: index.php?redirect=1');
	} */
	require_once "inc/bbdd(productos).php";
	require_once "inc/encabezado.php";
?>
	<main role="main" class="container">
    <h1 class='mt-5' align='center'>listado Productos</h1>
	<?php
		$productos=seleccionarTodosProductos();
	?>
	<table class="table table-striped">
	  <thead>
		<tr align='center'>
		  <th scope="col">idProducto</th>
		  <th scope="col">Imagen</th>
		  <th scope="col">Nombre</th>
		  <th scope="col">introDescripcion</th>
		  <th scope="col">Precio</th>
		  <th scope="col">PrecioOferta</th>
		  <th scope="col">Online</th>
		  <th scope="col">Operaciones</th>
		</tr>
	  </thead>
	  <tbody>
	  <?php
		foreach($productos as $producto){
			$idProducto = $producto['idProducto'];
			$nombre = $producto['nombre'];
			$introDescripcion = $producto['introDescripcion'];
			$imagen = $producto['imagen'];
			$precio = $producto['precio'];
			$precioOferta = $producto['precioOferta'];
			$online = $producto['online'];
	  ?>
		<tr align='center'>
		  <th scope="row"><?php echo $idProducto; ?></th>
		  <td><img src='img/<?php echo $imagen; ?>' width="150" height="100"/></td>
		  <td><?php echo $nombre; ?></td>
		  <td><?php echo $introDescripcion; ?></td>
		  <td><?php echo $precio; ?> €</td>
		  <td><?php echo $precioOferta; ?> €</td>
		  <td><?php echo $online; ?></td>
		  <td>
			<p><a href='actualizar(producto).php?idProducto=<?php echo $idProducto; ?>' class='btn btn-secondary'>Editar</a>
			<a href='borrar(producto).php?idProducto=<?php echo $idProducto; ?>' onClick='return confirmar("Realmente quiere Borrar?");' class='btn btn-outline-danger'>Borrar</a></p>
		  </td>
		</tr>
	  <?php
		}
	  ?>
	  </tbody>
	</table>
	<p><a href='insertar(producto).php' class='btn btn-dark btn-lg btn-block'>Nuevo producto</a></p>
	<p><a href='cerrarSesion.php' class='btn btn-danger btn-lg btn-block'>Cerrar Sesión</a></p>
	</main>

<script>
	function confirmar (mensaje){
		return (confirm(mensaje))?true:false;
	}
</script>

<?php
	require_once "inc/pie.php";
?>

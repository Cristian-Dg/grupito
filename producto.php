<?php
	session_start();
	require_once('bbdd/bbdd.php');
	require_once('inc/funciones.php');
	if(isset($_SESSION['usuario'])){
		$usuario = seleccionarUsuario($_SESSION['usuario']);
	}
	
	$idProducto = recoge('id');
	$producto = seleccionarProducto($idProducto);
	
	$nombre = $producto['nombre'];
	$introDescripcion = $producto['introDescripcion'];
	$descripcion = $producto['descripcion'];
	$imagen = $producto['imagen'];
	$precio = $producto['precio'];
	$precioOferta = $producto['precioOferta'];
	
	$pagina='productos';
	$titulo=$nombre;
?>

<?php
	require_once('inc/funciones.php');
	require_once('inc/encabezado.php');
?>

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3"><?php echo $producto['nombre']; ?></h1>
    </div>
  </div>

  <div class="container">
	<div class="row col-10 mx-auto">
		<div class="col-6 mx-auto">
			<p><?php echo $producto['descripcion']; ?></p>
			<div class="row col-12 mx-auto d-flex justify-content-center">
				<a href="procesarCarrito.php?id=<?php echo $idProducto; ?>&op=add" class="btn btn-success text-justify">Add to the Carrito</a>
			</div>
		</div>
		<div class="col-6 mx-auto">
			<p><img src="imagenes/<?php echo $producto['imagen'];?>" class="card-img-top rounded" alt="<?php echo $producto['imagen'];?>"></p>
			<!-- <div class="row mt-2 mx-auto"> -->
			<div class="row mx-auto">
				<span class="text-danger col-6 text-justify display-4">
					<del>Antes <?php echo $producto['precio'];?>€</del>
				</span>
				<span class="text-success col-6 text-right display-4">
					Ahora <?php echo $producto['precioOferta'];?>€
				</span>
			</div>
		</div>
	</div>
  <hr>
  </div> <!-- /container -->

</main>

<?php
	require_once('inc/pie.php');
?>

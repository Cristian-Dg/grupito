<?php 
	require_once "inc/bbdd(productos).php";
	require_once "inc/funciones.php";
	require_once "inc/encabezado.php";
?>
	<main role="main" class="container">
    <h1 class='mt-5' align='center'>listado productos pendientes</h1>
	<?php
		$productos = seleccionarTodosProductos();
		$numproductos = count($productos);
		$productosPagina = 2;
		$paginas = ceil($numproductos/$productosPagina);
		$pagina = recoge('pagina');
		if($pagina==false || $pagina<=0 || $pagina>$paginas){
			$pagina=1;
		}
		$inicio = ($pagina-1)*$productosPagina;
		$productos = paginacionproductos($inicio,$productosPagina);
	?>
	<table class="table table-striped" >
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
		  <td><?php echo $precio; ?></td>
		  <td><?php echo $precioOferta; ?></td>
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
	<nav aria-label="...">
	  <ul class="pagination">
		<li class="page-item <?php if ($pagina<=1){echo ' disable';}?>">
		<a class="page-link" href="paginacion(productos).php?pagina=<?php echo $pagina-1; ?>" tabindex="-1" aria-disabled="true">Anterior</a>
		</li>
		<?php
			for($i=1;$i<=$paginas;$i++){
		?>
		<li class="page-item <?php if ($pagina==$i){echo ' active';}?>"><a class="page-link" href="paginacion(productos).php?pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
		<?php
			}
		?>
		<li class="page-item <?php if ($pagina>=$paginas){echo ' disable';}?>">
		 <a class="page-link" href="paginacion(productos).php?pagina=<?php echo $pagina+1; ?>">Siguiente</a>
		</li>
	  </ul>
	</nav>
	<p><a href='insertar(producto).php' class='btn btn-dark btn-lg btn-block'>Nueva producto</a></p>
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

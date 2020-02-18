<?php
	session_start();
	include_once "bbdd/bbdd.php";
	include_once "inc/funciones.php";
	if(isset($_SESSION['usuario'])){
		$usuario = seleccionarUsuario($_SESSION['usuario']);
	}
	$pagina='carrito';
	$titulo='My Carrito';
	require_once'inc/encabezado.php';
?>

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">My Carrito</h1>
      <p><a class="btn btn-primary btn-lg" href="productos.php" role="button">Seguir comprando »</a></p>
    </div>
  </div>
  
<?php
  if(empty($_SESSION['carrito'])){
	  $mensaje = "carrito vacío";
	  mostrarMensaje($mensaje);
  }else{
?>
  
  <div class="container">
	<div class="row px-5">
	
		<table class="table">
		  <thead>
			<tr class="bg-secondary">
			  <th scope="col">Producto</th>
			  <th scope="col">Cantidad</th>
			  <th scope="col">Precio</th>
			  <th scope="col">SubTotal</th>
			</tr>
		  </thead>
		  <tbody >
<?php
			$total=0;
			foreach($_SESSION['carrito'] as $id => $cantidad){
				$producto = seleccionarProducto($id);
				$nombre = $producto['nombre'];
				$precio = $producto['precioOferta'];
				$subTotal = $precio * $cantidad;
				$total=$total+$subTotal;
?>	
				<tr>
				  <td><a href='producto.php?id=<?php echo $id; ?>'><?php echo $nombre; ?></a></td>
				  <td><a href="procesarCarrito.php?id=<?php echo $id; ?>&op=remove"><i class="far fa-minus-square"></i></a> <?php echo $cantidad; ?> <a href="procesarCarrito.php?id=<?php echo $id; ?>&op=add"><i class="far fa-plus-square"></i></a></td>
				  <td><?php echo $precio; ?> €</td>
				  <td><?php echo $subTotal; ?> €</td>
				</tr>
<?php	
			}
?>
		  </tbody>
		  <tfoot>
			<tr>
				<th scope="row" colspan="3" class="text-right">Total</th>
				<td><?php echo $total; ?> €</td>
			</tr>
		  </tfoot>
		</table>
		
		<p><a href="procesarCarrito.php?id=<?php echo $id; ?>&op=empty"><button type="button" class="btn btn-outline-danger">Vaciar Carrito</button></a></p>
		<p><a href="confirmarPedido.php"><button type="button" class="btn btn-success">Confirmar Pedido</button></a></p>
		
	</div>
	</div>
<?php
	$_SESSION['total']=$total;
  }
?>
</main>

<?php
	require_once('inc/pie.php');
?>
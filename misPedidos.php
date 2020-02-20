<?php
	session_start();
	require_once('bbdd/bbdd.php');
	if(isset($_SESSION['idPedido'])){
		$pedidos = seleccionarTodosPedidos();
	}
	else{
		$mensaje = "No hay Pedidos";
		mostrarMensaje($mensaje);
		echo '<a href="carrito.php" class="btn btn-outline-success my-2 my-sm-0">volver</a>';
	}
	$pagina='misPedidos';
	$titulo='Mis Pedidos';
	require_once('inc/funciones.php');
	require_once('inc/encabezado.php');
?>

  <div class="jumbotron">
    <div class="container">
      <h2 class="display-3">Mis Pedidos</h2>
    </div>
  </div>
  <div class="container">
	<div class="row px-5">
	
		<table class="table">
		  <thead>
			<tr class="bg-secondary">
			  <th scope="col">idPedido</th>
			  <th scope="col">fecha</th>
			  <th scope="col">total</th>
			  <th scope="col">estado</th>
			  
			</tr>
		  </thead>
		  <tbody >
<?php
	foreach($pedidos as $pedido){
?>
		<tr>
		  <td><?php echo $pedido['idPedido']; ?></td>
		  <td><?php echo $pedido['fecha']; ?></td>
		  <td><?php echo $pedido['total']; ?> €</td>
		  <td>En proceso de envío</td>
		</tr>
<?php
	}

?>
		  </tbody>
		</table>

	</div>
	</div>
</main>

<?php
	require_once('inc/pie.php');
?>
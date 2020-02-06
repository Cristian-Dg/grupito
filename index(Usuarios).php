<?php /*
	session_start();
	if(empty($_SESSION['nombre'])){
		header ('location: index.php?redirect=1');
	} */
	require_once "inc/encabezado.php";
	require_once "bbdd/bbdd(Usuarios).php";
?>
	<main role="main" class="container">
    <h1 class='mt-5' align='center'>listado Usuarios</h1>
	<?php
		$usuarios = seleccionarTodosUsuarios();
	?>
	<table class="table table-striped" >
	  <thead>
		<tr align='center'>
		  <th scope="col">idUsuario</th>
		  <th scope="col">Nombre</th>
		  <th scope="col">Apellidos</th>
		  <th scope="col">Email</th>
		  <th scope="col">Dirección</th>
		  <th scope="col">Telefono</th>
		  <th scope="col">Operaciones</th>
		</tr>
	  </thead>
	  <tbody>
	  <?php
		foreach($usuarios as $usuario){
			$idUsuario = $usuario['idUsuario'];
			$nombre = $usuario['nombre'];
			$apellidos = $usuario['apellidos'];
			$email = $usuario['email'];
			$direccion = $usuario['direccion'];
			$telefono = $usuario['telefono'];
	  ?>
		<tr align='center'>
		  <th scope="row"><?php echo $idUsuario; ?></th>
		  <td><?php echo $nombre; ?></td>
		  <td><?php echo $apellidos; ?></td>
		  <td><?php echo $email; ?></td>
		  <td><?php echo $direccion; ?></td>
		  <td><?php echo $telefono; ?></td>
		  <td>
			<p><a href='actualizarUsuario.php?idUsuario=<?php echo $idUsuario; ?>' class='btn btn-secondary'>Editar</a>
			<a href='borrarUsuario.php?idUsuario=<?php echo $idUsuario; ?>' onClick='return confirmar("Realmente quiere Borrar?");' class='btn btn-outline-danger'>Borrar</a></p>
		  </td>
		</tr>
	  <?php
		}
	  ?>
	  </tbody>
	</table>
	<p><a href='insertarUsuario.php' class='btn btn-dark btn-lg btn-block'>Nuevo usuario</a></p>
	</main>

<script>
	function confirmar (mensaje){
		return (confirm(mensaje))?true:false;
	}
</script>

<?php
	require_once "inc/pie.php";
?>

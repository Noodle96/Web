
//$_POST['name']
<?php
	try{
		require_once('funciones/bd_conexion.php');
		$sql = "SELECT * FROM contactos";
		$resultado = $conn->query($sql);
	}catch(Exception $e){
		$error = $e->getMessage();
	}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/estilos.css">
        <title> Agenda php </title>
    </head>
    <body>
        <div class="contenedor">
            <h1>Agenda de contactos</h1>
            <div class="contenido" id="contacto">
                <h2>Nuevo Contacto</h2>
                <form class="clearfix" action="crear.php" method="post" id="formulario_crear_usuario">
                    <div class="campo"><!--nombre-->
                        <label for="nombre">Nombre:
                            <input type="text" name="nombre" id ="nombre" placeholder="Tu Nombre ">
                         </label>
                    </div>
                    <div class="campo"><!--numero-->
                        <label for="numero">Numero:
                            <input type="text" name="numero" id ="numero" placeholder="Tu numero">
                         </label>
                    </div>
                    <input type="submit"  class="boton"name="" value="Agregar" id="agregar">
                </form>
            </div>
        </div><!--contenedor-->

		<div class="contenido existentes">
			<h2>Contactos Existentes</h2>
			<p>
				Numero de Contactos: <?php echo $resultado->num_rows;?>
			</p>

			<table id ="registrados">
				<thead>
					<tr>
						<th>nombre</th>
						<th>Telefono</th>
						<th>Editar</th>
						<th>
							<button type="button" name="borrar" id="btn_borrar" class="borrar">Borrar</button>
						</th>
					</tr>
				</thead>
				<tbody>

					<?php while($registros = $resultado->fetch_assoc()){?>
						<tr>
							<td><?php echo $registros['nombreContacto'] ?></td>
							<td><?php echo $registros['telefono'] ?></td>
							<td>
								<a href="editar.php?id=<?php echo $registros['idContacto'] ?>">Editar</a>
							</td>
							<td class="borrar">
								<!-- <a href="eliminar.php?id=<?php echo $registros['idContacto'] ?>">Eliminar</a> -->

								<input type="checkbox" name="<?php echo $registros['idContacto'] ?>" class="borrar_contacto" value="">
							</td>
						</tr>
						<!-- <pre>
							<?php var_dump($registros); ?>
						</pre> -->
					<?php } ?>
				</tbody>
			</table>

		</div>
		<?php
			$conn->close();
		 ?>


		 <script src="js/app.js"></script>
    </body>
</html>

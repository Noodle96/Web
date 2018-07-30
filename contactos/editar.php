<?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
	try{
		require_once('funciones/bd_conexion.php');
		$sql = "SELECT * FROM contactos WHERE `idContacto` = {$id};";
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
            <h2><?php echo "ID: ".$id; ?></h2>
            <h2><?php echo $sql; ?></h2>

            <div class="contenido">
                <h2>Editar Contactooo</h2>

                <form class="" action="actualizar.php" method="get">
                    <?php while($registro = $resultado->fetch_assoc()){ ?>
                    <div class="campo"><!--nombre-->
                        <label for="nombre">Nombre:
                            <input type="text" name="nombre" id ="nombre" value=<?php echo $registro['nombreContacto'] ?> laceholder="Tu Nombre ">
                         </label>
                    </div>
                    <div class="campo"><!--numero-->
                        <label for="numero">Numero:
                            <input type="text" name="numero" value=<?php echo $registro['telefono'] ?> id ="numero" placeholder="Tu numero">
                         </label>
                    </div>
                    <input type="hidden" name="idbarraxa" value=<?php echo $registro['idContacto'] ?>>
                    <input type="submit"  class="boton"name="" value="Actualizar">
                    <?php } ?>
                </form>
            </div>
        </div><!--contenedor-->


		<?php
			$conn->close();
		 ?>
    </body>
</html>

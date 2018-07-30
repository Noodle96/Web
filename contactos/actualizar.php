<!--verificacion si ha sido creado en contacto  -->
<?php
    if(isset($_GET['nombre'])){
        $nombre = $_GET['nombre'];
    }
    if(isset($_GET['numero'])){
        $numero = $_GET['numero'];
    }
    if(isset($_GET['idbarraxa'])){
        $id = $_GET['idbarraxa'];
    }
	try{
		require_once('funciones/bd_conexion.php');
        $sql = "UPDATE contactos SET";
        $sql .= "`telefono` = '{$numero}',";
        $sql .= "`nombreContacto` = '{$nombre}'";
        $sql .= "WHERE `IdContacto` = '{$id}';";
        $resultado = $conn->query($sql);
	}catch(Exception $e){
		echo $error = $e->getMessage();
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
            <div class="contenido">
                <?php
                    echo $sql; // sirve mucho
                    echo "<br>";
                    if($resultado){
                        echo "Contacto Actualizado";
                        echo $resultado;
                    }else{
                        echo "error". $conn->error;
                    }
                 ?>
                 <br>
                 <a class="volver" href="index.php">Volver a Inicio</a>
            </div>
            <!-- cerrar la conexion a la base de datos -->
            <?php
                $conn->close();
             ?>
        </div>
    </body>
</html>

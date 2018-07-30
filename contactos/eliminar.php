<!--verificacion si ha sido creado en contacto  -->
<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
	try{
		require_once('funciones/bd_conexion.php');
        $sql = "DELETE FROM contactos WHERE `idcontacto` = '{$id}';"; 
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
                <!-- <pre>
                    <?php
                        var_dump($_POST);
                    ?>
                </pre> -->
                <?php
                    echo $sql; // sirve mucho
                    if($resultado){
                        echo "Contacto Eliminado";
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

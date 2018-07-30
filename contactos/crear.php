<?php
    function peticion_ajax(){
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ;
    }

    if(isset($_POST['nombre'])){
        $nombre = htmlspecialchars($_POST['nombre']);
    }
    if(isset($_POST['numero'])){
        $numero = htmlspecialchars($_POST['numero']);
    }
	try{
		require_once('funciones/bd_conexion.php');
        $sql = "INSERT INTO `contactos` (`idContacto`,`nombreContacto`,`telefono`)";
        $sql .= "VALUES (NULL, '{$nombre}','{$numero}');";
        $resultado = $conn->query($sql);

        if(peticion_ajax()){
            echo json_encode(array(
                'respuesta' => $resultado,
                'nombre' => $nombre,
                'telefono' => $numero,
                'id' => $conn->insert_id
            ));
        }
        else{
            // exit;
            echo json_encode(array(
                'error' => 'mi_Error'
            ));
        }

	}catch(Exception $e){
		echo $error = $e->getMessage();
	}

    $conn->close();
?>

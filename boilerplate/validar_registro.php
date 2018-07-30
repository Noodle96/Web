<?php if (isset($_POST['submit'])): ?>
<?php
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $regalo = $_POST['regalo'];
    $total_pedido = $_POST['total_pedido'];
    $fecha = date('Y-m-d H:i:s');
    //EVENTOS
    $evento = $_POST['registro'];
 ?>
 <?php
    //PEDIDOS
    $boletos = $_POST['boletos'];
    $camisas = $_POST['pedido_camisas'];
    $etiquetas = $_POST['pedido_etiquetas'];

    include_once 'includes/funciones/functions.php';
    $products_json = productos_json($boletos, $camisas, $etiquetas );
    $eventos_json = eventos_json($evento);


    try {
        require_once('includes/funciones/bd_connection.php');
        $stmt = $conn->prepare(" INSERT INTO registrados (nameRegistrado, apellidoRegistrado, emailRegistrado, fechaRegistro, pasesArticulo, talleresRegistrado, regalo, totalPagado) VALUES (?,?,?,?,?,?,?,?); ");
        $stmt->bind_param("ssssssis",$nombre, $apellido, $email, $fecha, $products_json, $eventos_json, $regalo, $total_pedido);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        header('Location: validar_registro.php?exitoso=1');
    } catch (\Exception $e) {
        echo $e->getMesage();
    }
  ?>
<?php endif; ?>



<?php include_once 'includes/templates/header.php'; ?>

<!-- ----------------------------------------------------------------------------------------------------->
    <section class="seccion contenedor">
        <h2>Resumen de REGISTROS</h2>
        <?php
        if(isset($_GET['exitoso'])):
            if($_GET['exitoso'] == 1):
                echo "Register Succesfull";
            endif;
        endif;
         ?>

    </section>


<!-- ----------------------------------------------------------------------------------------------------->

<?php include_once 'includes/templates/footer.php'; ?>

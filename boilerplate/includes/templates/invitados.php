
<?php
    try {
        require_once('includes/funciones/bd_connection.php');
        $sql = " SELECT * FROM invitados; ";
        $resul = $conn->query($sql);
    } catch (\Exception $e) {
        echo $e->getMesage();
    }
 ?>

 <section class="invitados seccion contenedor">
     <h2>Nuestros  Invitados</h2>
     <ul class="lista_invitados clearfix">
    <?php
    // echo $sql;
    while($invitados = $resul->fetch_assoc()){ ?>
        <?php $url = "img/".$invitados['urlImagen'];?>

        <li>
            <div class="invitado">
                <a class="invitado_info" href="#invitado<?php echo $invitados['idInvitado']; ?>"  >    <!--     href="<?php echo $url;?>"  -->
                    <img src="<?php echo $url;?>" alt="imagen invitado">
                    <p><?php echo  $invitados['nameInvitado'] . " " . $invitados['apellidoInvitado']; ?></p>
                </a>
            </div>
        </li>
        <!-- box: colobox resul -->
        <div style="display:none;" class="emergente">
            <div class="invitado_info" id="invitado<?php echo $invitados['idInvitado'];?>">
                <h2><?php echo $invitados['nameInvitado']. " " . $invitados['apellidoInvitado']; ?></h2>
                <img src="<?php echo $url;?>" alt="imagen invitado">
                <p><?php echo $invitados['descripcion'] ?></p>
                <p>---------REDES SOCIALES -------</p>
            </div>
        </div>
        <!-- <pre>
            <?php var_dump($invitados)?>
        </pre> -->
    <?php } ?> <!--end while-->
    </ul><!--.lista_invitados-->
</section><!--.invitados-->

 <?php
    $conn->close();
  ?>

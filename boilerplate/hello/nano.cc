<!-- <?php include_once 'includes/templates/header.php'; ?> -->
<!-- <?php include_once 'includes/templates/footer.php'; ?> -->

<!-- Solo cargaremos el .css o .js que qureamos en una deterninada pagina -->

<?php
    $arhivo = basename($_SERVER['PHP_SELF']);
    $pagina = str_replace(".php","",$archivo);
    if($pagina == 'invitados'){
        echo '<script src="js/jquery.colorbox-min.js"></script>';
    }else if($pagina == 'conferencias'){
        echo '<script src="js/lightbox.js"></script>';
    }
?>

<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Web Boilerplate</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="manifest" href="site.webmanifest">
        <link rel="apple-touch-icon" href="icon.png">
        <!-- Place favicon.ico in the root directory -->
        <!-- <link rel="stylesheet" href="css/lightbox.css"> -->
        <!-- <link rel="stylesheet" href="css/colorbox.css"> -->
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Alegreya" rel="stylesheet">
        <!--google fonts oswald-->
        <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
        <!--google PT Sans-->
        <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
        <link rel="stylesheet" href="css/main.css">
        <?php
        $archivo = basename($_SERVER['PHP_SELF']);
        $pagina = str_replace(".php","",$archivo);
         ?>
    </head>


    <!--begin-->


    <body class="<?php echo $pagina;?>">
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        <!-- Add your site or application content here -->

        <header class="site-header">
            <div class="hero">
                <div class="contenido-header">
                    <nav class="redes-sociales">
                        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                    </nav><!--.redes-sociales-->

                    <div class="informacion-evento">
                        <div class="clearfix">
                            <p class="fecha"><i class="fa fa-calendar" aria-hidden="true"></i>07-12-18</p>
                            <p class="ciudad"><i class="fa fa-map-marker" aria-hidden="true"></i>Arequipa</p>
                        </div><!--.clearfix-->
                        <h1 class="nombre-sitio">GdlWebcamp</h1>
                        <p class="slogan">La mejor conferencia de <span>Diseño Web con Nano</span></p>
                        <p>estams en <?php echo $pagina;?></p>
                    </div><!--.informacion-evento-->


                </div><!--.contenido-header-->

            </div><!--hero-->
        </header><!--.site-header-->

        <div class="barra">
            <div class="contenedor clearfix">
                <div class="logo">
                    <a href="index.php"><img src="img/logo.svg" alt="logo de gdlwebcamp"></a>
                </div><!--.logo-->

                <div class="menu-movil">
                    <span></span>
                    <span></span>
                    <span></span>
                </div><!--.menu-movil-->

                <nav class="navegacion-principal clearfix">
                    <a href="conferencias.php">Conferencia</a>
                    <a href="calendario.php">Calendario</a>
                    <a href="invitados.php">Invitados</a>
                    <a href="reservaciones.php">Reservaciones</a>
                </nav>
            </div><!--.contenedor-->
        </div><!--.barra-->

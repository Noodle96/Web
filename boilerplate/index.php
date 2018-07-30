<?php include_once 'includes/templates/header.php'; ?>

<!---------------------------------------------------------------------------------------------------------->

        <section class="seccion contenedor">
            <h2>La mejor conferencia de diseño web en español</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem aspernatur dicta eius debitis enim, illo eligendi repellendus vero, ducimus eaque voluptatem magnam mollitia magni quam facere fugiat tempora, molestiae dignissimos?</p>
        </section><!--.seccion-->

        <!--agregando la seccion de talleres conferencias y seminarios-->
        <section class="programa">
            <div class="contenedor-video">
                <video autoplay loop poster="img/gorilaz3.jpg">
                    <source src="video/video.mp4" type="video/mp4">
                    <source src="video/video.webm" type="video/webm">
                    <source src="video/video.ogv" type="video/ogg">
                </video>
            </div><!--.contenedor-video-->


            <div class="contenido-programa">
                <div class="contenedor">
                    <div class="programa-evento">
                        <h2>Programa del evento</h2>
                        <?php
                            try {
                                require_once('includes/funciones/bd_connection.php');
                                $sql = " SELECT * FROM categoria ;";
                                $resul = $conn->query($sql);
                            } catch (\Exception $e) {
                                echo $e->getMesage();
                            }
                         ?>

                        <nav class="menu-programa">
                            <?php
                                while($cat = $resul->fetch_assoc()){?>
                                    <a href="#<?php echo $cat['nameCategoria']; ?>"><i class="fa <?php echo $cat['iconoCategoria'];?>" aria-hidden="true"></i><?php echo $cat['nameCategoria']; ?></a>
                        <?php } ?>
                        </nav>

                        <?php
                            try {
                                require_once('includes/funciones/bd_connection.php');
                                // $sql = "SELECT * FROM evento";
                                $sql = " SELECT idEvento, nameEvento, fechaEvento, horaEvento, nameCategoria, iconoCategoria, nameInvitado, apellidoInvitado ";
                                $sql .= " FROM evento ";
                                $sql .= " INNER JOIN categoria ";
                                $sql .= " ON evento.idCategoriaFK = categoria.idCategoria ";
                                $sql .= " INNER JOIN invitados ";
                                $sql .= " ON evento.idInvitadoFK = invitados.idInvitado ";
                                $sql .= " AND  evento.idCategoriaFK = 1 ";
                                $sql .= " ORDER BY idEvento limit 2; ";

                                $sql .= " SELECT idEvento, nameEvento, fechaEvento, horaEvento, nameCategoria, iconoCategoria, nameInvitado, apellidoInvitado ";
                                $sql .= " FROM evento ";
                                $sql .= " INNER JOIN categoria ";
                                $sql .= " ON evento.idCategoriaFK = categoria.idCategoria ";
                                $sql .= " INNER JOIN invitados ";
                                $sql .= " ON evento.idInvitadoFK = invitados.idInvitado ";
                                $sql .= " AND  evento.idCategoriaFK = 2 ";
                                $sql .= " ORDER BY idEvento limit 2; ";

                                $sql .= " SELECT idEvento, nameEvento, fechaEvento, horaEvento, nameCategoria, iconoCategoria, nameInvitado, apellidoInvitado ";
                                $sql .= " FROM evento ";
                                $sql .= " INNER JOIN categoria ";
                                $sql .= " ON evento.idCategoriaFK = categoria.idCategoria ";
                                $sql .= " INNER JOIN invitados ";
                                $sql .= " ON evento.idInvitadoFK = invitados.idInvitado ";
                                $sql .= " AND  evento.idCategoriaFK = 3 ";
                                $sql .= " ORDER BY idEvento limit 2; ";
                            } catch (\Exception $e) {
                                echo $e->getMesage();
                            }
                         ?>
                         <?php  $conn->multi_query($sql);?>
                         <?php
                                do {
                                    $resultado = $conn->store_result();
                                    $row = $resultado->fetch_all(MYSQLI_ASSOC); ?>

                                    <?php $i =0;?>
                                    <?php foreach ($row as $evento): ?>
                                        <!--SEMINARIOS,Conferencias y talleres-->
                                        <?php if ($i % 2 == 0 ): ?>
                                            <div id="<?php echo $evento['nameCategoria']; ?>" class="info-curso ocultar clearfix">
                                        <?php endif; ?>
                                            <div class="detalle-evento">
                                                <h3><?php echo $evento['nameEvento'] ?></h3>
                                                <p><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo $evento['horaEvento']; ?></p>
                                                <p><i class="fa fa-calendar" aria-hidden="true"></i><?php echo $evento['fechaEvento']; ?></p>
                                                <p><i class="fa fa-user" aria-hidden="true"></i><?php echo $evento['nameInvitado'] . " " . $evento['apellidoInvitado'] ;?></p>
                                            </div><!--.detalle-evento-->

                                            <?php if ($i %2 == 1) { ?>
                                                    <a href="calendario.php" class="button float-right">Ver Todos</a>
                                                </div><!--#seminarios,conferencias y talleres-->
                                            <?php } ?>

                                        <?php $i++;?>
                                    <?php endforeach; ?>
                                    <?php $resultado->free(); ?>
                        <?php  } while ($conn->more_results() && $conn->next_result());?>


                    </div><!--.programa-evento-->
                </div><!--.contenedor-->

            </div><!--.contenido-programa-->
        </section><!--.programa-->

        <!---------------------------------------------------------------------------------------------------------->

        <?php include_once 'includes/templates/invitados.php'; ?>

        <!---------------------------------------------------------------------------------------------------------->



        <div class="contador parallax">
            <div class="contenedor">
                <ul class="resumen_evento clearfix">
                    <li> <p class="numero"></p> Invitados</li>
                    <li> <p class="numero"></p> Talleres</li>
                    <li> <p class="numero"></p> Días</li>
                    <li> <p class="numero"></p> Conferencias</li>
                </ul>
            </div><!--.contenedor-->
        </div><!--.contador-->


        <section class="precios seccion">
            <h2>Precios</h2>
            <div class="contenedor">
                <ul class="lista_precios clearfix">
                    <li><!--1li-->
                        <div class="tabla_precio">
                            <h3>Pase por día</h3>
                            <p class="numero">$40</p>
                            <ul>
                                <li>Bocadillos gratis</li>
                                <li>Todas las conferencias</li>
                                <li>Todos los talleres</li>
                            </ul>
                            <a href="#" class="button hollow">Comprar</a>
                        </div>
                    </li>

                    <li><!--2li-->
                        <div class="tabla_precio">
                            <h3>Todos los días</h3>
                            <p class="numero">$50</p>
                            <ul>
                                <li>Bocadillos gratis</li>
                                <li>Todas las conferencias</li>
                                <li>Todos los talleres</li>
                            </ul>
                            <a href="#" class="button">Comprar</a>
                        </div>
                    </li>

                    <li><!--3li-->
                        <div class="tabla_precio">
                            <h3>Pase por 2 días</h3>
                            <p class="numero">$45</p>
                            <ul>
                                <li>Bocadillos gratis</li>
                                <li>Todas las conferencias</li>
                                <li>Todos los talleres</li>
                            </ul>
                            <a href="#" class="button hollow">Comprar</a>
                        </div>
                    </li>
                </ul>
            </div><!--.contenedor-->
        </section><!--.precios-->


        <div id="mapa" class="mapa">

        </div><!--.mapa-->


        <section class="seccion">
            <h2>testimoniales</h2>
            <div class="testimoniales contenedor clearfix">
                <div class="testimonial">
                    <blockquote cite="http://youtube.com">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam ipsa, quae quisquam aliquam vel nihil voluptatum, dolore aspernatur rerum cupiditate. Quidem laudantium, exercitationem repellendus voluptates odio, asperiores officiis dolores sapiente!</p>
                        <footer class="info_testimonial clearfix">
                            <img src="img/testimonial.jpg" alt="imagen de testimonial">
                            <cite>Pedro Pablo Leon <span>Diseñador en armas</span></cite>
                        </footer>
                    </blockquote>
                </div><!--.testimonial-->

                <div class="testimonial">
                    <blockquote cite="http://youtube.com">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam ipsa, quae quisquam aliquam vel nihil voluptatum, dolore aspernatur rerum cupiditate. Quidem laudantium, exercitationem repellendus voluptates odio, asperiores officiis dolores sapiente!</p>
                        <footer class="info_testimonial clearfix">
                            <img src="img/testimonial.jpg" alt="imagen de testimonial">
                            <cite>Pedro Pablo Leon <span>Diseñador en armas</span></cite>
                        </footer>
                    </blockquote>
                </div><!--.testimonial-->

                <div class="testimonial">
                    <blockquote cite="http://youtube.com">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam ipsa, quae quisquam aliquam vel nihil voluptatum, dolore aspernatur rerum cupiditate. Quidem laudantium, exercitationem repellendus voluptates odio, asperiores officiis dolores sapiente!</p>
                        <footer class="info_testimonial clearfix">
                            <img src="img/testimonial.jpg" alt="imagen de testimonial">
                            <cite>Pedro Pablo Leon <span>Diseñador en armas</span></cite>
                        </footer>
                    </blockquote>
                </div><!--.testimonial-->
            </div><!--.testimoniales-->

        </section><!--.seccion -->


        <div class="newletter parallax">
            <div class="contenido contenedor">
                <p>Registrate a newletter:</p>
                <h3>GdlwebCamp</h3>
                <a href="#mc_embed_signup" class="boton_newletter button transparente">Registro</a>
            </div><!--.contenido-->
        </div><!--.newletter-->

        <section class="seccion fondo">
            <h2>Faltan</h2>
            <div class="cuenta_regresiva contenedor">
                <ul class="clearfix">
                    <li><p id="dias" class="numero"></p>días</li>
                    <li><p id="horas" class="numero"></p>Horas</li>
                    <li><p id="minutos" class="numero"></p>Minutos</li>
                    <li><p id="segundos" class="numero"></p>Segundos</li>
                </ul>
            </div><!--.cuenta_regresiva-->
        </section><!--.seccion-->

        <!---------------------------------------------------------------------------------------------------------->
        <?php include_once 'includes/templates/footer.php'; ?>

<?php include_once 'includes/templates/header.php'; ?>

<!---------------------------------------------------------------------------------------------------------->


        <section class="seccion contenedor" >
            <h2>Calendario de Eventos</h2>

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
                    $sql .= " ORDER BY idEvento; ";
                    $resul = $conn->query($sql);
                } catch (\Exception $e) {
                    echo $e->getMesage();
                }
             ?>

            <div class="calendario">
                <?php
                    // echo $sql;
                    $calendario = array();
                    while($eventos = $resul->fetch_assoc()){
                        $fecha = $eventos['fechaEvento'];
                        $evento = array(
                            'titulo' => $eventos['nameEvento'],
                            'fecha' => $eventos['fechaEvento'],
                            'hora' => $eventos['horaEvento'],
                            'categoria' => $eventos['nameCategoria'],
                            'icono' => "fa " . $eventos['iconoCategoria'],
                            'invitado' => $eventos['nameInvitado'] . " " . $eventos['apellidoInvitado']
                        );
                        $calendario[$fecha][] = $evento;


                    } ?>
                    <?php foreach($calendario as $dia =>$lista_eventos){?>
                        <!-- calendaria tiene un Array de 3 de[dia]y dentro otro array[lista_eventos] -->

                        <h3 class="fecha_exacta">
                            <i class="fa fa-calendar"></i>
                            <?php
                            // PARA LINUX
                            setlocale(LC_TIME,'es_ES.UTF-8');
                            //PARA WINDOWS
                            // setlocale(LC_TIME,'spanish');
                            echo strftime("%A , %d de %B del %Y", strtotime($dia));
                            ?>
                        </h3>

                        <!-- En even tendre todo el array formateado -->
                        <?php foreach ($lista_eventos as $even): ?>
                            <div class="dia">
                                <p class="titulo"><?php echo $even['titulo']; ?></p>
                                <p class="hora">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                                    <?php echo $even['fecha'] . "   " . $even['hora'];?>
                                </p>
                                <p class="categoria">
                                    <i class="<?php echo $even['icono']?>" aria-hidden="true"></i>
                                    <?php echo $even['categoria'];?>
                                </p>

                                <p class="user">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <?php echo $even['invitado'];?>
                                </p>

                                <!-- <pre>
                                    <?php var_dump($even);?>
                                </pre> -->

                            </div><!--.dia-->
                        <?php endforeach; ?>
                    <?php }?>

            </div> <!--.calendario-->

             <?php
                $conn->close();
              ?>

        </section>

<!---------------------------------------------------------------------------------------------------------->
<?php include_once 'includes/templates/footer.php'; ?>

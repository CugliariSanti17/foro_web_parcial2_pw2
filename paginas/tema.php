<?php 
    require_once '../conexion.php';  
    session_start();  

    if (!isset($_GET['id']) || !is_numeric($_GET['id'])){
        die("Error: Tema no encontrado o URL inválida.");
    }

    require_once '../componentes/select_temas_respuestas.php';
    
    $sql_vistas = "UPDATE temas SET vistas = vistas + 1 WHERE id_tema = $id_tema";
    mysqli_query($conexion, $sql_vistas);

    $id_usuario_actual = 1; // Variable de prueba hasta tener session 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$tema['titulo']?> | El Tintero</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/tema.css">
</head>

<body>

    <?php 
        include_once '../componentes/nav.php'
    ?>
    <div class="container contenedor-tema">

        <!-- Publicación Principal -->
        <main class="tema-principal">
            <div class="tema-detalle-card">
                <div class="tema-cabecera">
                    <span class="etiqueta <?=htmlspecialchars($tema['color_etiqueta'])?>">
                        <?=htmlspecialchars($tema['nombre_categoria'])?>
                    </span>
                    <h1>
                        <?=htmlspecialchars($tema['titulo'])?>
                    </h1>
                    <div class="tema-autor-meta">
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Juan" alt="Avatar" class="avatar">
                        <div class="meta-info">
                            <strong>
                                <?=htmlspecialchars($tema['username'])?>
                            </strong>
                            <span>Publicado el
                                <?=date('d/m/Y H:i', strtotime($tema['fecha_creacion']))?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="tema-cuerpo">
                    <p>
                        <?=nl2br(htmlspecialchars($tema['contenido']))?>
                    </p>
                </div>

                <div class="tema-acciones">
                    <form action="../dar_like_tema.php" method="POST">
                        <input type="hidden" name="id_tema" value="<?=$tema['id_tema']?>">
                        <button class="btn btn-ghost">👍<?=$tema['likes']?> Likes</button>
                    </form>
                    <button class="btn btn-ghost">Compartir</button>
                </div>
                <?php 
                    $tiempo_creacion = strtotime($tema['fecha_creacion']);
                    $limiteTiempo = strtotime('-24 hours');
                    $esta_en_tiempo = ($tiempo_creacion >= $limiteTiempo);

                    if($tema['id_usuario'] == $id_usuario_actual && $esta_en_tiempo){
                    ?>
                        <form action="../editar_tema.php" method="POST" class="tema-acciones">
                            <input type="hidden" name="id_tema" value="<?=$tema['id_tema']?>">

                            <a href="./formularioDiscusion.php?id=<?=$tema['id_tema']?>" class="btn btn-ghost">Editar</a>
                        </form>
                    <?php
                    } 
                    
                    if($tema['id_usuario'] == $id_usuario_actual){
                        ?>
                        <form action="../eliminar_tema.php" class="tema-acciones" method="POST">
                            <input type="hidden" name="id_tema" value="<?=$tema['id_tema']?>">

                            <button class="btn btn-solid btn-eliminar" onclick="return confirm('¿Estás seguro de que quieres borrar el tema?')">Eliminar</button>
                        </form>
                        <?php
                    }
                ?>
                
            </div>

            <!-- Sección de Respuestas -->
            <section class="seccion-respuestas">
                <h2>Respuestas (<?=mysqli_num_rows($resultado_respuestas)?>)</h2>
                <?php 
                    if(mysqli_num_rows($resultado_respuestas) == 0){
                        echo "<p>El tema no posee comentarios por el momento.</p>";
                    }else{
                        while($respuesta = mysqli_fetch_assoc($resultado_respuestas)){
                            ?>
                            <article class="comentario-card">
                                <div class="comentario-votos">
                                    <form action="../dar_like_respuesta.php" method="POST">
                                        <input type="hidden" name="id_tema" value="<?=$tema['id_tema']?>">
                                        <input type="hidden" name="id_respuesta" value="<?=$respuesta['id_respuesta']?>">
                                        <button class="btn-voto">👍</button>
                                    </form>
                                    <span>
                                        <?=$respuesta['likes'] ?> Likes
                                    </span>
                                </div>
                                <div class="comentario-contenido">
                                    <div class="comentario-meta">
                                        <strong>@
                                            <?=htmlspecialchars($respuesta['username'])?>
                                        </strong> <span>•
                                            <?=date('d/m/Y H:i', strtotime($respuesta['fecha_creacion']))?>
                                        </span>
                                    </div>
                                    <p>
                                        <?=nl2br(htmlspecialchars($respuesta['contenido']))?>
                                    </p>

                                    <?php 
                                        if($respuesta['id_usuario'] == $id_usuario_actual){
                                        ?>
                                            <form action="../eliminar_respuesta.php" method="POST" class="form-eliminar">
                                                <input type="hidden" name="id_respuesta" value="<?=$respuesta['id_respuesta']?>">
                                                <input type="hidden" name="id_tema" value="<?=$tema['id_tema']?>"> 
            
                                                <button type="submit" class="btn btn-solid btn-eliminar" onclick="return confirm('¿Estás seguro de que quieres borrar tu respuesta?')">
                                                    Eliminar
                                                </button>
                                            </form>      
                                            <?php                                  
                                        }
                                    ?>
                                </div>
                            </article>
                            <?php
                        }
                    }
                    ?>
            </section>

            <!-- Formulario para responder -->
            <section class="caja-respuesta">
                <h3>Dejar una respuesta</h3>
                <form action="../guardar_respuesta.php" method="POST">
                    <input type="hidden" name="id_tema" value="<?=$tema['id_tema']?>">

                    <textarea placeholder="Escribe tu respuesta aquí... Sé respetuoso y aporta valor." rows="5"
                        class="input-textarea" name="contenido" required></textarea>

                        <?php 
                            if(isset($_SESSION['errores']['contenido'])){
                                ?>
                                <p class="msj-error"><?=$_SESSION['errores']['contenido']?></p>
                            <?php
                            }
                        ?>
                    <button type="submit" class="btn btn-solid">Publicar respuesta</button>
                </form>
            </section>
        </main>

        <!-- Barra lateral con información -->
        <aside class="foro-sidebar">
            <div class="card-sidebar">
                <h3>Acerca de este tema</h3>
                <p><strong>Categoría:</strong> <?=htmlspecialchars($tema['nombre_categoria'])?></p>
                <p><strong>Vistas:</strong> <?=$tema['vistas']?></p>
                <p><strong>Respuestas:</strong> <?=mysqli_num_rows($resultado_respuestas)?></p>
                <a href="../paginas/discusiones.php" class="btn btn-ghost btn-full">← Volver al listado</a>
            </div>
        </aside>
    </div>

    <?php 
        include_once '../componentes/footer.php';
        
        unset($_SESSION['errores']);
    ?>
</body>

</html>
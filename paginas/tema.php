<?php 
    require_once '../conexion.php';

    

    if (!isset($_GET['id']) || !is_numeric($_GET['id'])){
        die("Error: Tema no encontrado o URL inválida.");
    }

    $id_tema = (int) $_GET['id'];

    $sql_tema = "SELECT 
        temas.*,
        usuarios.username,
        categorias.nombre AS nombre_categoria,
        categorias.color_etiqueta
        FROM temas
        INNER JOIN usuarios on temas.id_usuario = usuarios.id_usuario
        INNER JOIN categorias on temas.id_categoria = categorias.id_categoria
        WHERE temas.id_tema = $id_tema
    ";

    $resultado_tema = mysqli_query($conexion, $sql_tema);
    $tema = mysqli_fetch_assoc($resultado_tema);

    if(!$tema){
        die("El tema que buscas no existe o fue eliminado.");
    }

    $sql_vistas = "UPDATE temas SET vistas = vistas + 1 WHERE id_tema = $id_tema";
    mysqli_query($conexion, $sql_vistas);

    $sql_respuestas = "SELECT
        respuestas.*,
        usuarios.username
        FROM respuestas
        INNER JOIN usuarios ON respuestas.id_usuario = usuarios.id_usuario
        WHERE respuestas.id_tema = $id_tema
        ORDER BY respuestas.fecha_creacion DESC
    ";

    $resultado_respuestas = mysqli_query($conexion, $sql_respuestas);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tema | El Tintero</title>
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
                    <span class="etiqueta <?=$tema['color_etiqueta']?>">
                        <?=htmlspecialchars($tema['nombre_categoria'])?>
                    </span>
                    <h1>
                        <?=htmlspecialchars($tema['titulo'])?>
                    </h1>
                    <div class="tema-autor-meta">
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Juan" alt="Avatar" class="avatar">
                        <div class="meta-info">
                            <strong>
                                <?=$tema['username']?>
                            </strong>
                            <span>Publicado el
                                <?=date('d/m/Y H:i', strtotime($tema['fecha_creacion']))?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="tema-cuerpo">
                    <p>
                        <?=htmlspecialchars($tema['contenido'])?>
                    </p>
                </div>

                <div class="tema-acciones">
                    <button class="btn btn-ghost">▲
                        <?=$tema['likes']?> Likes
                    </button>
                    <button class="btn btn-ghost">Compartir</button>
                </div>

                <div class="tema-acciones">
                    <button class="btn btn-ghost">Editar</button>
                </div>
            </div>

            <!-- Sección de Respuestas -->
            <section class="seccion-respuestas">
                <h2>Respuestas (<?=mysqli_num_rows($resultado_respuestas)?>)</h2>
                <?php 
                    if(mysqli_num_rows($resultado_respuestas) === 0){
                        echo "<p>El tema no posee comentarios por el momento.</p>";
                    }else{
                        while($respuesta = mysqli_fetch_assoc($resultado_respuestas)){
                            ?>
                            <article class="comentario-card">
                                <div class="comentario-votos">
                                    <button class="btn-voto">▲</button>
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
                                </div>
                            </article>
                            <?php
                        }
                    }
                    ?>

                <!-- Comentario de prueba -->
                <article class="comentario-card">
                    <div class="comentario-votos">
                        <button class="btn-voto">▲</button>
                        <span>15</span>
                    </div>
                    <div class="comentario-contenido">
                        <div class="comentario-meta">
                            <strong>@ana_ux</strong> <span>• hace 2 horas</span>
                        </div>
                        <p>Para empezar, te sugiero crear al menos tres carpetas: <code>/assets</code> (para CSS, JS e
                            imágenes), <code>/includes</code> (para tu nav, footer y conexión a la BD) y dejar en la
                            raíz solo las páginas que el usuario visita directamente (index, tema, login).</p>
                    </div>
                </article>

                <!-- Comentario de prueba -->
                <article class="comentario-card">
                    <div class="comentario-votos">
                        <button class="btn-voto">▲</button>
                        <span>3</span>
                    </div>
                    <div class="comentario-contenido">
                        <div class="comentario-meta">
                            <strong class="rol-admin">@admin</strong> <span>• hace 1 hora</span>
                        </div>
                        <p>Totalmente de acuerdo con Ana. No hace falta que uses un patrón MVC completo al principio.
                            Mantén la lógica simple pero separada del HTML repetitivo.</p>
                    </div>
                </article>

            </section>

            <!-- Formulario para responder -->
            <section class="caja-respuesta">
                <h3>Dejar una respuesta</h3>
                <form action="#" method="POST">
                    <input type="hidden" name="id_tema" value="<?=$tema['id_tema']?>">

                    <textarea placeholder="Escribe tu respuesta aquí... Sé respetuoso y aporta valor." rows="5"
                        class="input-textarea"></textarea>
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
        include_once '../componentes/nav.php'
    ?>
</body>

</html>
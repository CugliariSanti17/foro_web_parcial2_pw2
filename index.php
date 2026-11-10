<?php 
    require_once './conexion.php';

    require_once './componentes/select_temas_index.php';

    if(isset($_COOKIE['ultima_visita'])){
        $mensaje_cookie = "Tu ultima visita fue el " . $_COOKIE['ultima_visita'];
    }else{
        $mensaje_cookie = "Bienvenido por primera vez al foro";
    }

    setcookie('ultima_visita', date('d/m/Y H:i'), time() + (86400 * 30), "/");

    $sql_categorias = 'SELECT nombre, color_etiqueta FROM categorias LIMIT 10';

    $resultado_categorias = mysqli_query($conexion, $sql_categorias);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foro de novedades</title>
    <link rel="stylesheet" href="./css/estilos.css">
    <link rel="stylesheet" href="./css/nav.css">
</head>
<body>
    <?php 
        include_once './componentes/nav.php'
    ?>

    <header class="foro-header">
        <h1>Foro Principal</h1>
        <p>Lee, comenta y comparte conocimiento en nuestra comunidad.</p>

        <p class="mensaje-visita">
            <?= $mensaje_cookie ?>
        </p>
        
        <form class="search-box" method="GET">
            <input type="text" placeholder="Buscar palabras clave..." name="busqueda" value="<?=htmlspecialchars($_GET['busqueda'] ?? '')?>">
            <button class="btn btn-solid">Buscar</button>
        </form>
    </header>

    <div class="container">
        <main class="foro-main">
            <?php
            if(isset($resultado_busqueda)){
                if(mysqli_num_rows($resultado_busqueda) > 0){
                    while($respuesta_busqueda = mysqli_fetch_assoc($resultado_busqueda)){
                        ?>
                        <article class="card-tema">
                            <div class="tema-votos">
                                <button class="btn-voto">👍</button>
                                <span><?=$respuesta_busqueda['likes']?></span>
                            </div>
                            <div class="tema-contenido">
                                <span class="etiqueta <?=htmlspecialchars($respuesta_busqueda['color_etiqueta'])?>"><?=htmlspecialchars($respuesta_busqueda['nombre_categoria'])?></span>
                                <h2><a href="./paginas/tema.php?id=<?=$respuesta_busqueda['id_tema']?>"><?=htmlspecialchars($respuesta_busqueda['titulo'])?></a></h2>
                                <p class="tema-meta">Publicado por <strong><?=htmlspecialchars($respuesta_busqueda['username'])?></strong> el <?=date('d/m/Y H:i', strtotime($respuesta_busqueda['fecha_creacion']))?></p>
                            </div>
                        </article>
                        <?php
                    }
                }else{
                    ?>
                    <p class="tema-meta">No hay resultados para tu busqueda</p>
                    <?php
                }
            }else{
                while($respuesta = mysqli_fetch_assoc($resultado_temas)){
                    ?>
                    <article class="card-tema">
                        <div class="tema-votos">
                            <button class="btn-voto">👍</button>
                            <span><?=$respuesta['likes']?></span>
                        </div>
                        <div class="tema-contenido">
                            <span class="etiqueta <?=htmlspecialchars($respuesta['color_etiqueta'])?>"><?=htmlspecialchars($respuesta['nombre_categoria'])?></span>
                            <h2><a href="./paginas/tema.php?id=<?=$respuesta['id_tema']?>"><?=htmlspecialchars($respuesta['titulo'])?></a></h2>
                            <p class="tema-meta">Publicado por <strong><?=htmlspecialchars($respuesta['username'])?></strong> el <?=date('d/m/Y H:i', strtotime($respuesta['fecha_creacion']))?></p>
                        </div>
                    </article>
                    <?php
                }
            }    
            ?>
        </main>

        <aside class="foro-sidebar">
            <div class="card-sidebar">
                <h3>Sobre el foro</h3>
                <p>Un lugar minimalista para evitar distracciones y centrarnos en el contenido.</p>
                <a href="./paginas/formularioDiscusion.php" class="btn btn-solid btn-full">Empezar una discusión nueva</a>
            </div>

            <div class="card-sidebar">
                <h3>Crear nuevo tema</h3>
                <p>Función unicamente disponible para administradores</p>
                <a href="./paginas/formularioTopicos.php" class="btn btn-solid btn-full">Crear tema</a>
            </div>

            <!--Lista de etiquetas (prueba)-->
            <div class="card-sidebar">
                <h3>Etiquetas Populares</h3>
                <div class="tag-cloud">
                    <?php 
                        while($categoria = mysqli_fetch_assoc($resultado_categorias)){
                        ?>
                            <span class="etiqueta <?=$categoria['color_etiqueta']?>"><?=$categoria['nombre']?></span>
                        <?php
                        }
                    ?>
                </div>
            </div>
        </aside>
    </div>

    <?php 
        include_once './componentes/footer.php'
    ?>
</body>
</html>
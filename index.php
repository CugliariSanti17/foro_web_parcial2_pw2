<?php 
    require_once 'conexion.php';

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
        <div class="search-box">
            <input type="text" placeholder="Buscar palabras clave...">
            <button class="btn btn-solid">Buscar</button>
        </div>
    </header>

    <div class="container">
        <main class="foro-main">
            <!-- Discusion de prueba 1 -->
            <article class="card-tema">
                <div class="tema-votos">
                    <button class="btn-voto">▲</button>
                    <span>42</span>
                </div>
                <div class="tema-contenido">
                    <span class="etiqueta rojo">Desarrollo</span>
                    <h2><a href="./paginas/tema.php">¿Cómo estructurar un proyecto desde cero?</a></h2>
                    <p class="tema-meta">Publicado por <strong>@dev_juan</strong> hace 2 horas • 15 respuestas</p>
                </div>
            </article>

            <!-- Discusion de prueba 2 -->
            <article class="card-tema">
                <div class="tema-votos">
                    <button class="btn-voto">▲</button>
                    <span>18</span>
                </div>
                <div class="tema-contenido">
                    <span class="etiqueta azul">Diseño</span>
                    <h2><a href="./paginas/tema.php">Teoría del color aplicada a interfaces web</a></h2>
                    <p class="tema-meta">Publicado por <strong>@ana_ux</strong> ayer • 8 respuestas</p>
                </div>
            </article>

             <!-- Discusion de prueba 3 -->
             <article class="card-tema">
                <div class="tema-votos">
                    <button class="btn-voto">▲</button>
                    <span>5</span>
                </div>
                <div class="tema-contenido">
                    <span class="etiqueta amarillo">General</span>
                    <h2><a href="./paginas/tema.php">Presentaciones de nuevos usuarios (2026)</a></h2>
                    <p class="tema-meta">Publicado por <strong>@admin</strong> hace 3 días • 120 respuestas</p>
                </div>
            </article>
        </main>

        <!--Información extra con llamados a la accion-->
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
 <?php 
    require_once '../conexion.php';

    $sql_discusiones = "SELECT 
        temas.*,
        usuarios.username,
        categorias.nombre AS nombre_categoria,
        categorias.color_etiqueta
        FROM temas
        INNER JOIN usuarios ON temas.id_usuario = usuarios.id_usuario
        INNER JOIN categorias on temas.id_categoria = categorias.id_categoria
        ORDER BY temas.fecha_creacion DESC
    ";

    $resultado_discusiones = mysqli_query($conexion, $sql_discusiones);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discusiones | El Tintero</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/discusiones.css">
</head>
<body>

    <?php 
        include_once '../componentes/nav.php'
    ?>
    <div class="page-header">
        <div class="page-header-content">
            <h1>Explorar Discusiones</h1>
            <p>Encuentra las respuestas que buscas o inicia un nuevo debate.</p>
        </div>
    </div>

    <div class="container">
        <main class="foro-main">
            <!-- Filtros -->
            <div class="filtros-bar">
                <div class="filtros-grupo">
                    <button class="btn btn-solid btn-sm">Todos</button>
                    <button class="btn btn-ghost btn-sm">Desarrollo</button>
                    <button class="btn btn-ghost btn-sm">Diseño</button>
                    <button class="btn btn-ghost btn-sm">General</button>
                </div>

                <div class="orden-grupo">
                    <select class="select-brutal">
                        <option>Más recientes</option>
                        <option>Más votados</option>
                        <option>Sin respuestas</option>
                    </select>
                </div>
            </div>

            <!-- Discusiones -->
            <div class="lista-temas">

                <?php 
                    while ($discusion = mysqli_fetch_assoc($resultado_discusiones)){
                    ?>
                        <article class="card-tema">
                            <div class="tema-votos">
                                <button class="btn-voto">▲</button>
                                <span><?= $discusion['likes'] ?></span>
                            </div>
                            <div class="tema-contenido">
                                <span class="etiqueta <?=$discusion['color_etiqueta']?>"><?= $discusion['nombre_categoria']?></span>
                                <h2><a href="./tema.php?id=<?=$discusion['id_tema']?>"><?= htmlspecialchars($discusion['titulo'])?></a></h2>
                                <p class="tema-meta">Publicado por <strong><?= htmlspecialchars($discusion['username'])?></strong> el <?=date('d/m/Y H:i', strtotime($discusion['fecha_creacion'])) ?> • <?=$discusion['vistas']?> vistas</p>
                            </div>
                        </article>
                        <?php 
                    }
                ?>
                <!-- Discusion de prueba 1 -->
                
                <!-- Discusion de prueba 2 -->
                <article class="card-tema">
                    <div class="tema-votos">
                        <button class="btn-voto">▲</button>
                        <span>18</span>
                    </div>
                    <div class="tema-contenido">
                        <span class="etiqueta color-2">Diseño</span>
                        <h2><a href="tema.php">Teoría del color aplicada a interfaces web</a></h2>
                        <p class="tema-meta">Publicado por <strong>@ana_ux</strong> ayer • 8 respuestas</p>
                    </div>
                </article>

                <!-- Discusion de prueba 3 -->
                <article class="card-tema">
                    <div class="tema-votos">
                        <button class="btn-voto">▲</button>
                        <span>0</span>
                    </div>
                    <div class="tema-contenido">
                        <span class="etiqueta color-1">Desarrollo</span>
                        <h2><a href="./tema.php">Problema conectando PDO con MySQL 8.0</a></h2>
                        <p class="tema-meta">Publicado por <strong>@rookie_dev</strong> hace 5 horas • 0 respuestas</p>
                    </div>
                </article>

                <!-- Discusion de prueba 4 -->
                <article class="card-tema">
                    <div class="tema-votos">
                        <button class="btn-voto">▲</button>
                        <span>112</span>
                    </div>
                    <div class="tema-contenido">
                        <span class="etiqueta color-3">General</span>
                        <h2><a href="./tema.php">Compartan sus setups de trabajo (Edición 2026)</a></h2>
                        <p class="tema-meta">Publicado por <strong>@admin</strong> hace 1 semana • 45 respuestas</p>
                    </div>
                </article>
            </div>

            <!-- Paginación (ver si dejarlo o no) -->
            <div class="paginacion">
                <button class="btn btn-ghost" disabled>← Anterior</button>
                <div class="paginas-numeros">
                    <button class="btn btn-solid">1</button>
                    <button class="btn btn-ghost">2</button>
                    <button class="btn btn-ghost">3</button>
                    <span>...</span>
                    <button class="btn btn-ghost">10</button>
                </div>
                <button class="btn btn-ghost">Siguiente →</button>
            </div>

        </main>

        <!-- Barra lateral con llamados a la accion y estadisticas -->
        <aside class="foro-sidebar">
            <div class="card-sidebar card-destacada">
                <h3>¿Tienes una duda?</h3>
                <p>La comunidad está lista para ayudarte. Asegúrate de leer las reglas antes de publicar.</p>
                <a href="./formularioDiscusion.php" class="btn btn-solid btn-full">Crear Nueva Discusión</a>
            </div>

            <div class="card-sidebar">
                <h3>Estadísticas Globales</h3>
                <ul class="stats-list">
                    <li>Temas totales: <strong>1,402</strong></li>
                    <li>Respuestas: <strong>8,930</strong></li>
                    <li>Usuarios: <strong>450</strong></li>
                </ul>
            </div>
        </aside>
    </div>

    <?php 
        include_once '../componentes/footer.php'
    ?>
</body>
</html>
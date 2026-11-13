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
    ";

    if(isset($_GET['id_categoria']) && is_numeric($_GET['id_categoria'])){
        $id_categoria = (int) $_GET['id_categoria'];

        $sql_discusiones .= " WHERE temas.id_categoria = $id_categoria";
    }

    $sql_discusiones .= " ORDER BY temas.fecha_creacion DESC"; 

    $sql_respuestas = 'SELECT * FROM respuestas';

    $sql_usuarios = 'SELECT username FROM usuarios';

    $sql_categorias = 'SELECT nombre, id_categoria FROM categorias';

    $resultado_discusiones = mysqli_query($conexion, $sql_discusiones);
    $resultado_respuestas = mysqli_query($conexion, $sql_respuestas);
    $resultado_usuarios = mysqli_query($conexion, $sql_usuarios);
    $resultado_categorias = mysqli_query($conexion, $sql_categorias);
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
            <div class="filtros-bar">
                <div class="filtros-grupo">
                    <a class="btn btn-solid btn-sm" href="./discusiones.php">Todos</a>
                    <?php 
                        while($respuesta = mysqli_fetch_assoc($resultado_categorias)){
                            ?>
                            <a href="./discusiones.php?id_categoria=<?=$respuesta['id_categoria']?>" class="btn btn-ghost btn-sm"><?=$respuesta['nombre']?></a>
                            <?php
                        }
                    ?>
                </div>

                <div class="orden-grupo">
                    <select class="select-brutal">
                        <option>Más recientes</option>
                        <option>Más votados</option>
                        <option>Sin respuestas</option>
                    </select>
                </div>
            </div>

            <div class="lista-temas">

                <?php 
                    while ($discusion = mysqli_fetch_assoc($resultado_discusiones)){
                    ?>
                        <article class="card-tema">
                            <div class="tema-votos">
                                <p class="btn-voto">👍</p>
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
                
            <!-- Paginación (ver si dejarlo o no)
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
             -->
             
        </main>

        <aside class="foro-sidebar">
            <div class="card-sidebar card-destacada">
                <h3>¿Tienes una duda?</h3>
                <p>La comunidad está lista para ayudarte. Asegúrate de leer las reglas antes de publicar.</p>
                <a href="./formularioDiscusion.php" class="btn btn-solid btn-full">Crear Nueva Discusión</a>
            </div>

            <div class="card-sidebar">
                <h3>Estadísticas Globales</h3>
                <ul class="stats-list">
                    <li>Temas totales: <strong><?=mysqli_num_rows($resultado_discusiones)?></strong></li>
                    <li>Respuestas: <strong><?=mysqli_num_rows($resultado_respuestas)?></strong></li>
                    <li>Usuarios: <strong><?=mysqli_num_rows($resultado_usuarios)?></strong></li>
                </ul>
            </div>
        </aside>
    </div>

    <?php 
        include_once '../componentes/footer.php'
    ?>
</body>
</html>
<?php 
    require_once __DIR__ . '/../conexion.php';

    $sql_temas = "SELECT 
        temas.*,
        usuarios.username,
        categorias.nombre AS nombre_categoria,
        categorias.color_etiqueta
        FROM temas
        INNER JOIN usuarios ON temas.id_usuario = usuarios.id_usuario
        INNER JOIN categorias on temas.id_categoria = categorias.id_categoria
        ORDER BY temas.likes DESC LIMIT 4
    ";

    $resultado_temas = mysqli_query($conexion, $sql_temas);
?>
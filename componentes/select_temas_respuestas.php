<?php 
    require_once __DIR__ . '/../conexion.php';

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
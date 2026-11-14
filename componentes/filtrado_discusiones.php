<?php 
    require_once __DIR__ . '/../conexion.php';

     $sql_discusiones = "SELECT 
        temas.*,
        usuarios.username,
        categorias.nombre AS nombre_categoria,
        categorias.color_etiqueta
        FROM temas
        INNER JOIN usuarios ON temas.id_usuario = usuarios.id_usuario
        INNER JOIN categorias on temas.id_categoria = categorias.id_categoria
    ";

    $condiciones = [];

    if(isset($_GET['id_categoria']) && is_numeric($_GET['id_categoria'])){
        $id_categoria = (int) $_GET['id_categoria'];

        $condiciones[] = "temas.id_categoria = ?";
    }

    $filtro = isset($_GET['filtro']) ? $_GET['filtro'] : 'recientes';

    if ($filtro === 'sin_respuestas'){
        $condiciones[] = "(SELECT COUNT(*) FROM respuestas WHERE respuestas.id_tema = temas.id_tema) = 0";
    }

    if(count($condiciones) > 0){
        $sql_discusiones .= " WHERE " . implode(" AND ", $condiciones);
    }

    if($filtro === 'likes'){
        $sql_discusiones .= " ORDER BY temas.likes DESC, temas.fecha_creacion DESC";
    }else{
        $sql_discusiones .= " ORDER BY temas.fecha_creacion DESC";
    }

    $stmt_discusiones = mysqli_prepare($conexion, $sql_discusiones);
    
    if(count($condiciones) > 0){
        mysqli_stmt_bind_param($stmt_discusiones, 'i', $id_categoria);
    }

    mysqli_stmt_execute($stmt_discusiones);
    $resultado_discusiones = mysqli_stmt_get_result($stmt_discusiones);
?>
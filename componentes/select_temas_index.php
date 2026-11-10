<?php 
    require_once __DIR__ . '/../conexion.php';

    if(isset($_GET['busqueda']) && trim($_GET['busqueda'] != '')){
        $busqueda = trim($_GET['busqueda']);
        $parametro_busqueda = "%" . $busqueda . "%";

        $sql_busqueda = "SELECT 
            temas.*, 
            categorias.color_etiqueta,
            categorias.nombre AS nombre_categoria, 
            usuarios.username 
            FROM temas 
            INNER JOIN categorias ON temas.id_categoria = categorias.id_categoria
            INNER JOIN usuarios ON temas.id_usuario = usuarios.id_usuario
            WHERE temas.titulo LIKE ? OR temas.contenido LIKE ?
            ORDER BY temas.fecha_creacion DESC";

        $stmt_busqueda = mysqli_prepare($conexion, $sql_busqueda);
        mysqli_stmt_bind_param($stmt_busqueda, "ss", $parametro_busqueda, $parametro_busqueda);
        mysqli_stmt_execute($stmt_busqueda);
        $resultado_busqueda = mysqli_stmt_get_result($stmt_busqueda);

    }else{

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
    }
    
?>
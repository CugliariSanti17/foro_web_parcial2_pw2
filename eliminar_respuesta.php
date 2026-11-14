<?php 
    require_once './conexion.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $id_respuesta = $_POST['id_respuesta'];
        $id_tema = $_POST['id_tema'];

        $id_usuario_actual = 1;

        $sql_eliminar_respuesta = 'DELETE FROM respuestas WHERE id_respuesta = ? AND id_usuario = ?';

        $stmt = mysqli_prepare($conexion, $sql_eliminar_respuesta);

        if($stmt){
            mysqli_stmt_bind_param($stmt, 'ii', $id_respuesta, $id_usuario_actual);

            if(mysqli_stmt_execute($stmt)){
                header("Location: paginas/tema.php?id=" . $id_tema);
                exit();
            }else{
                die("Error al borrar comentario");
            }

            mysqli_stmt_close($stmt);
        }else{
            die("Error preparando la consulta");
        }
    }else{
        die("Acceso denegado");
    }
?>
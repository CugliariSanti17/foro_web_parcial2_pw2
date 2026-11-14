<?php 
    require_once './conexion.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id_tema = $_POST['id_tema'];
        $id_usuario_actual = 1; // Valor provisorio hasta aplicar SESSION

        //eliminar respuestas
        $sql_eliminar_respuesta = "DELETE FROM respuestas WHERE id_tema = ?";
        $stmt_respuestas = mysqli_prepare($conexion, $sql_eliminar_respuesta);
        
        
        if($stmt_respuestas){
            mysqli_stmt_bind_param($stmt_respuestas, 'i', $id_tema);
            mysqli_stmt_execute($stmt_respuestas);
            mysqli_stmt_close($stmt_respuestas);
        }

        //eliminar tema
        $sql_eliminar_tema = "DELETE FROM temas WHERE id_tema = ? AND id_usuario = ?";
        $stmt_tema = mysqli_prepare($conexion, $sql_eliminar_tema);

        if($stmt_tema){
            mysqli_stmt_bind_param($stmt_tema, 'ii', $id_tema, $id_usuario_actual);

            if (mysqli_stmt_execute($stmt_tema)){
                header("Location: paginas/discusiones.php");
                exit();
            }else{
                die("Error al borrar tema");
            }

            mysqli_stmt_close($stmt_tema);
        }else{
            die("Error al preparar la consulta");
        }
    }else{
        die("Acceso denegado");
    }
?>
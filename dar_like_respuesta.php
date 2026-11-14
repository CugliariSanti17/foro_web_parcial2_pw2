<?php 
     require_once './conexion.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if(!isset($_POST['id_tema'])){
            die("Error: No se recibió el id del tema.");
        }

        $id_tema = $_POST['id_tema'];
        $id_respuesta = $_POST['id_respuesta'];

        $sql_likes = "UPDATE respuestas SET likes = likes + 1 WHERE id_respuesta = ?";
        
        $stmt = mysqli_prepare($conexion, $sql_likes);

        if($stmt){
            mysqli_stmt_bind_param($stmt, 'i', $id_respuesta);

            if(mysqli_stmt_execute($stmt)){
                header("Location: paginas/tema.php?id=" . $id_tema);
                exit();
            }else{
                die("Error al dar like");
            }

            mysqli_stmt_close($stmt);
        }else{
            die("Error preparando la consulta");
        }
    }else{
        die("Acceso denegado");
    }
?>
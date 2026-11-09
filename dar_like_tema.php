<?php 
    require_once './conexion.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if(!isset($_POST['id_tema'])){
            die("Error: No se recibió el id del tema.");
        }

        $id_tema = $_POST['id_tema'];

        $sql_likes = "UPDATE temas SET likes = likes + 1 WHERE id_tema = ?";
        
        $stmt = mysqli_prepare($conexion, $sql_likes);

        if($stmt){
            mysqli_stmt_bind_param($stmt, 'i', $id_tema);

            if(mysqli_stmt_execute($stmt)){
                header("Location: paginas/tema.php?id=" . $id_tema);
                exit();
            }else{
                echo "<p>Error al dar like</p>";
            }

            mysqli_stmt_close($stmt);
        }else{
            echo "<p>Error preparando la consulta</p>";
        }
    }else{
        echo "<p>Acceso denegado</p>";
    }
?>
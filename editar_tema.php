<?php 
    require_once './conexion.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id_tema = $_POST['id_tema'];
        $titulo = trim($_POST['titulo']);
        $contenido = trim($_POST['contenido']);
        $id_categoria = $_POST['categoria'];
        $id_usuario_actual = 1; // valor de prueba hasta aplicar session

        if (empty($titulo) || empty($contenido) || empty($id_categoria)) {
            echo "<p>Todos los campos son obligatorios</p>";
        }

        if(strlen($titulo) <= 5){
            echo "<p>El titulo debe tener más de 5 caracteres</p>";
        }

        if(strlen($contenido) <= 5){
            echo "<p>El contenido debe tener más de 5 caracteres</p>";
        }

        $sql_verificar = "SELECT id_usuario, fecha_creacion FROM temas WHERE id_tema = ?";
        $stmt_verificar = mysqli_prepare($conexion, $sql_verificar);

        if($stmt_verificar){
            mysqli_stmt_bind_param($stmt_verificar, 'i', $id_tema);
            mysqli_stmt_execute($stmt_verificar);
            $resultado_verificacion = mysqli_stmt_get_result($stmt_verificar);
            $tema_original = mysqli_fetch_assoc($resultado_verificacion);

            if(!$tema_original || $tema_original['id_usuario'] != $id_usuario_actual){
                die("No tienes autorización para editar este tema.");
            }

            $tiempo_creacion = strtotime($tema_original['fecha_creacion']);
            $tiempo_limite = strtotime('-24 hours');

            if($tiempo_creacion < $tiempo_limite){
                die("El tiempo límite para editar este tema ha expirado.");
            }
        }

        $sql_actualizar_tema = "UPDATE temas SET titulo = ?, contenido = ?, id_categoria = ? WHERE id_tema = ? AND id_usuario = ?";
        $stmt_actualizar_tema = mysqli_prepare($conexion, $sql_actualizar_tema);

        if($stmt_actualizar_tema){
            mysqli_stmt_bind_param($stmt_actualizar_tema, 'ssiii', $titulo, $contenido, $id_categoria, $id_tema, $id_usuario_actual);

            if(mysqli_stmt_execute($stmt_actualizar_tema)){
                header("Location: paginas/tema.php?id=" . $id_tema);
                exit();
            }else{
                echo "<p>Error al actualizar el tema</p>";
            }

            mysqli_stmt_close($stmt_update);
        }
    }else{
        echo "<p>Acceso denegado</p>";
    }
?>
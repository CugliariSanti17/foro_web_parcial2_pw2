<?php 
    require_once './conexion.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nombre = trim($_POST['nombre']);
        $apellido = trim($_POST['apellido']);
        $email = trim($_POST['email']);
        $motivo_sugerencia = trim($_POST['motivo']);
        $mensaje = trim($_POST['mensaje']);

        if (empty($nombre) || empty($apellido) || empty($email) || empty($motivo_sugerencia) || empty($mensaje)){
            echo '<p>Todos los campos deben ser completos</p>';
        }

        if (!str_contains($email, "@")){
            echo "<p>El email debe tener un formato correcto</p>";
        }

        $sql_sugerencia = "INSERT INTO sugerencias (nombre, apellido, email, motivo, mensaje, fecha_envio) VALUES (?,?,?,?,?, NOW())";
        $stmt_sugerencia = mysqli_prepare($conexion, $sql_sugerencia);

        if($stmt_sugerencia){
            mysqli_stmt_bind_param($stmt_sugerencia, "sssss" ,$nombre, $apellido, $email, $motivo_sugerencia, $mensaje);

            if(mysqli_stmt_execute($stmt_sugerencia)){
                header("Location: paginas/confirmacion_sugerencia.php");
                exit();
            }else{
                echo "<p>Error al guardar la sugerencia</p>";
            }

             mysqli_stmt_close($stmt_sugerencia);
        }else{
            echo "<p>Error preparando la consulta SQL</p>";
        }
    }else{
        echo '<p>Acceso denegado</p>';
    }   
?>
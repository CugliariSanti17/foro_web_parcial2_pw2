<?php 
    require_once './conexion.php';
    session_start();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nombre = trim($_POST['nombre']);
        $apellido = trim($_POST['apellido']);
        $email = trim($_POST['email']);
        $motivo_sugerencia = trim($_POST['motivo']);
        $mensaje = trim($_POST['mensaje']);

        $errores = [];

        if (empty($nombre) || empty($apellido) || empty($email) || empty($motivo_sugerencia) || empty($mensaje)){
            $errores['general'] = "Todos los campos deben ser completos";
        }

        if (!str_contains($email, "@")){
            $errores['email'] = "El email debe tener un formato correcto";
        }

        if(strlen($mensaje) <= 3){
            $errores['mensaje'] = "El campo mensaje debe tener más de 3 caracteres";
        }

        if(count($errores)){
            $_SESSION['errores'] = $errores;
            $_SESSION['datos'] = $_POST;

            header("Location: paginas/sugerencias.php"); 
            exit();
        }

        $sql_sugerencia = "INSERT INTO sugerencias (nombre, apellido, email, motivo, mensaje, fecha_envio) VALUES (?,?,?,?,?, NOW())";
        $stmt_sugerencia = mysqli_prepare($conexion, $sql_sugerencia);

        if($stmt_sugerencia){
            mysqli_stmt_bind_param($stmt_sugerencia, "sssss" ,$nombre, $apellido, $email, $motivo_sugerencia, $mensaje);

            if(mysqli_stmt_execute($stmt_sugerencia)){
                header("Location: paginas/confirmacion_sugerencia.php");
                exit();
            }else{
                die("Error al guardar la sugerencia");
            }

             mysqli_stmt_close($stmt_sugerencia);
        }else{
            die("Error preparando la consulta SQL");
        }
    }else{
        die("Acceso denegado");
    }   
?>
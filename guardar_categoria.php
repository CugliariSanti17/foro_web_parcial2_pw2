<?php 
    require_once './conexion.php';

    session_start();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nombre = trim($_POST['nombre_categoria']);
        $descripcion = trim($_POST['descripcion_categoria']);
        $color_etiqueta = $_POST['color_etiqueta'];

        $errores = [];

        if (empty($nombre) || empty($descripcion) || empty($color_etiqueta)){
            $errores['general'] = "Todos los campos deben ser completos";
        }

        if(strlen($nombre) < 3){
            $errores['nombre'] = "El campo nombre debe tener más de 3 caracteres";
        }

        if(strlen($descripcion) < 5){
            $errores['descripcion'] = "El campo descripcion debe tener más de 5 caracteres";
        }

        if(count($errores) > 0){
            $_SESSION['errores'] = $errores;
            $_SESSION['datos'] = $_POST;

            header("Location: paginas/formularioTopicos.php"); 
            exit();
        }

        $sql_crear_categoria = "INSERT INTO categorias (nombre, descripcion, color_etiqueta) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conexion, $sql_crear_categoria);

        if ($stmt){
            mysqli_stmt_bind_param($stmt, 'sss', $nombre, $descripcion, $color_etiqueta);
            
            if(mysqli_stmt_execute($stmt)){
                header("Location: index.php");
                exit();
            }else{
                die("Error al crear una nueva categoria");
            }

            mysqli_stmt_close($stmt);
        }else{
            die("Error al ejecutar la consulta");
        }
    }else{
        die("Acceso denegado");
    }
?>
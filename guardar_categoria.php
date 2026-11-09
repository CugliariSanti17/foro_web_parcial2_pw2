<?php 
    require_once './conexion.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nombre = trim($_POST['nombre_categoria']);
        $descripcion = trim($_POST['descripcion_categoria']);
        $color_etiqueta = $_POST['color_etiqueta'];

        if (empty($nombre) || empty($descripcion) || empty($color_etiqueta)){
            echo "<p>Todos los campos deben ser completos</p>";
        }

        if(strlen($nombre) < 3){
            echo "<p>El campo título debe tener más de 3 caracteres</p>";
        }

        if(strlen($descripcion) < 5){
            echo "<p>El campo descripcion debe tener más de 5 caracteres</p>";
        }

        $sql_crear_categoria = "INSERT INTO categorias (nombre, descripcion, color_etiqueta) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conexion, $sql_crear_categoria);

        if ($stmt){
            mysqli_stmt_bind_param($stmt, 'sss', $nombre, $descripcion, $color_etiqueta);
            
            if(mysqli_stmt_execute($stmt)){
                header("Location: index.php");
                exit();
            }else{
                echo "<p>Error al crear una nueva categoria</p>";
            }

            mysqli_stmt_close($stmt);
        }else{
            echo "<p>Error al ejecutar la consulta</p>";
        }
    }else{
        echo "<p>Acceso denegado</p>";
    }
?>
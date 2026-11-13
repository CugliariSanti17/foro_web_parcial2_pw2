<?php 
    require_once './conexion.php';
    session_start();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $titulo = $_POST['titulo'];
        $contenido = $_POST['contenido'];
        $id_categoria = $_POST['categoria'];

        $id_usuario_actual = 1; //LINEA PROVISORIA HASTA APLICAR SESSION 

        $errores = [];

        if(empty($titulo) || empty($contenido) || empty($id_categoria)){
            $errores['general'] = "Todos los campos deben ser completados";
        }

         if(strlen($titulo) <= 5){
            $errores['titulo'] = "El titulo debe tener más de 5 caracteres";
        }

        if(strlen($contenido) <= 5){
            $errores['contenido'] = "El contenido debe tener más de 5 caracteres";
        }

        if(count($errores) > 0){
            $_SESSION['errores'] = $errores;
            $_SESSION['datos'] = $_POST;

            header("Location: paginas/formularioDiscusion.php"); 
            exit();
        }

        $sql_publicar_tema = 'INSERT INTO temas (titulo, contenido, id_categoria, id_usuario, fecha_creacion) VALUES (?, ?, ?, ?, NOW())';

        $stmt = mysqli_prepare($conexion, $sql_publicar_tema);

        if($stmt){
            mysqli_stmt_bind_param($stmt, 'ssii', $titulo, $contenido, $id_categoria, $id_usuario_actual);

            if(mysqli_stmt_execute($stmt)){
                header("Location: paginas/discusiones.php");
                exit();
            }else {
                echo "<p>Error al guardar el tema</p>";
            }
            mysqli_stmt_close($stmt);
        }else{
            echo "<p>Error preparando la consulta SQL</p>";
        }
    }else{
        echo "<p>Acceso denegado</p>";
    }
?>
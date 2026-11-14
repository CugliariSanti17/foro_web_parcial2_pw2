<?php 
    include_once './conexion.php';
    session_start();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id_tema = $_POST['id_tema'];
        $contenido = trim($_POST['contenido']);

        $id_usuario = 1; // No tengo session aplicado, sino se aplicaria en esta linea

        $errores = [];

        if(empty($contenido)){
            $errores['contenido'] = 'La respuesta no debe estar vacia';
        }

        if(count($errores) > 0){
            $_SESSION['errores'] = $errores;

            header("Location: paginas/tema.php?id=" . $id_tema); 
            exit();
        }

        $sql_respuesta = 'INSERT INTO respuestas (contenido, id_tema, id_usuario, fecha_creacion) VALUES (?, ?, ?, NOW())';
        
        $stmt = mysqli_prepare($conexion, $sql_respuesta);

        if($stmt){
            mysqli_stmt_bind_param($stmt, "sii", $contenido, $id_tema, $id_usuario);

            if(mysqli_stmt_execute($stmt)){
                header("Location: paginas/tema.php?id=" . $id_tema);
                exit();
            }else {
                die("Error al guardar la respuesta");
            }

            mysqli_stmt_close($stmt);
        }else{
            die("Error preparando la consulta SQL");
        }     
    }else{
        die("Acceso denegado");
    }
?>
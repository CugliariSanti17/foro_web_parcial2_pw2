<?php 
    include_once './conexion.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id_tema = $_POST['id_tema'];
        $contenido = trim($_POST['contenido']);

        $id_usuario = 1; // No tengo session aplicado, sino se aplicaria en esta linea

        if(empty($contenido)){
            die('La respuesta no debe estar vacia');
        }

        if(strlen($contenido) <= 5){
            die('La respuesta debe tener mas de 5 caracteres');
        }

        $sql_respuesta = 'INSERT INTO respuestas (contenido, id_tema, id_usuario, fecha_creacion) VALUES (?, ?, ?, NOW())';
        
        $stmt = mysqli_prepare($conexion, $sql_respuesta);

        if($stmt){
            mysqli_stmt_bind_param($stmt, "sii", $contenido, $id_tema, $id_usuario);

            if(mysqli_stmt_execute($stmt)){
                header("Location: paginas/tema.php?id=" . $id_tema);
                exit();
            }else {
                echo "<p>Error al guardar la respuesta</p>";
            }

            mysqli_stmt_close($stmt);
        }else{
            echo "<p>Error preparando la consulta SQL</p>";
        }     
    }else{
        echo "<p>Acceso denegado</p>";
    }
?>
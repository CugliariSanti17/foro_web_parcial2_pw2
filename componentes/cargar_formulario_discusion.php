<?php 
    require_once '../conexion.php';

    $id_usuario_actual = 1; // Variable provisoria hasta agregar session

    $id_tema = "";
    $titulo = "";
    $contenido = "";
    $id_categoria_actual = "";
    $es_edicion = false;
    $titulo_pagina = "Crear nuevo tema";
    $url_form = "../guardar_tema.php";

    if(isset($_GET['id']) && is_numeric($_GET['id'])){
        $id_tema = (int) $_GET['id'];

        $sql_cargar_form = "SELECT * FROM temas WHERE id_tema = ?";
        $stmt = mysqli_prepare($conexion, $sql_cargar_form);

        if($stmt){
            mysqli_stmt_bind_param($stmt, 'i', $id_tema);
            mysqli_stmt_execute($stmt);
            $resultado = mysqli_stmt_get_result($stmt);
            $tema = mysqli_fetch_assoc($resultado);
            mysqli_stmt_close($stmt);

            if($tema){
                if($tema['id_usuario'] != $id_usuario_actual){
                    echo "<p>No tienes permiso para editar este tema</p>";
                }
                
                $tiempo_creacion = strtotime($tema['fecha_creacion']);
                $limite_tiempo = strtotime('-24 hours'); // 24 horas

                if($tiempo_creacion < $limite_tiempo){
                    echo "<p>El plazo limite de 24hs para editar la publicación ya expiro</p>";
                }
                
                $titulo = $tema['titulo'];
                $contenido = $tema['contenido'];
                $id_categoria_actual = $tema['id_categoria'];
                $es_edicion = true;
                $titulo_pagina = "Editar tema";
                $url_form = "../editar_tema.php";


            }else{
                echo "<p>El tema solicitado no existe</p>";
            }
        }
    }
?>
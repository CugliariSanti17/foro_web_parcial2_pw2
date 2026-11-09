<?php 
    require_once './conexion.php';

    $tiempo_creacion = strtotime($tema['fecha_creacion']);
    $limite_24hs = strtotime('-24 hours');

    if ($tiempo_creacion < $limite_24hs) {
        die("Error: El tiempo para editar esta publicación (24 horas) ya ha expirado.");
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id_tema = $_POST['id_tema'];
        $id_usuario_actual = 1; // valor de prueba hasta aplicar session

        
    }
?>
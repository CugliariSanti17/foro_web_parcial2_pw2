<?php 
    $credenciales = require 'credenciales.php';

    //Establecer conexion
    $conexion = mysqli_connect(
        $credenciales['host'], 
        $credenciales['user'], 
        $credenciales['pass'], 
        $credenciales['db'], 
        $credenciales['port']
    );

    //Por si falla la conexion
    if (!$conexion) {
        die("Fallo en la conexión: " . mysqli_connect_error());
    }

    //Configuracion de codificacion
    mysqli_set_charset($conexion, "utf8mb4");
?>
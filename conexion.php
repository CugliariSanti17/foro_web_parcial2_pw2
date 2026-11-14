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

/* // Detectamos si estamos corriendo en XAMPP (local) o en InfinityFree (producción)  
    $esLocal = ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === '127.0.0.1');

    //if ($esLocal) {
    // 1. Entorno Local (XAMPP) -> Incluye la subcarpeta del proyecto
    define('BASE_URL', '/repoGitHub');

    $host = '127.0.0.1';
    $user = 'root';
    $pass = '';
    $baseDatos = 'nombrebd';
} else {
    // 2. Entorno Hosting (InfinityFree) -> Va directo a la raíz del dominio
    define('BASE_URL', '');

    $host = 'sqlXXX.infinityfree.com';
    $user = 'if0_XXXXXXXX';
    $pass = 'clave_del_hosting';
    $baseDatos = 'if0_XXXXXXXX_user';
} */

?>
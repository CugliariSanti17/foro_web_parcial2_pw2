<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmacion | El Tintero</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/confirmacion.css">
</head>
<body>

    <?php 
        require_once '../componentes/nav.php';
    ?>

    <main class="contenedor-confirmacion">
        <article class="tarjeta-confirmacion">
            <div class="icono-exito">✅</div>
            <h2>¡Gracias por tu sugerencia!</h2>
            <p>Hemos recibido tu mensaje correctamente. Valoramos mucho tu aporte para seguir mejorando nuestra comunidad.</p>
            <a href="../index.php" class="btn btn-solid">Volver al inicio</a>
        </article>
    </main>

    <?php 
        require_once '../componentes/footer.php';
    ?>
</body>
</html>
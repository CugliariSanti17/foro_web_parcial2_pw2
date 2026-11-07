<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar comentarios | El Tintero</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/formularios.css">
</head>
<body>
    <?php 
        include_once '../componentes/nav.php'
    ?>

    <div class="page-header header-formularios">
        <div class="page-header-content">
            <h1>Editar Respuesta</h1> 
        </div>
    </div>

    <div class="container contenedor-centrado">
        <main class="form-card w-100">
            <!--Formulario para la edicion de comentarios -->
            <form action="#" method="POST" class="formulario-brutal">
                
                <input type="hidden" name="id_comentario" value="42">

                <div class="form-group">
                    <label for="contenido_respuesta">Tu respuesta</label>
                    <textarea id="contenido_respuesta" name="contenido_respuesta" rows="8" required>Para empezar, te sugiero crear al menos tres carpetas...</textarea>
                </div>

                <div class="form-acciones">
                    <a href="tema.php?id=15" class="btn btn-ghost">Descartar cambios</a>
                    <button type="submit" class="btn btn-solid">Guardar Cambios</button>
                </div>
            </form>
        </main>
    </div>

    <?php 
        include_once '../componentes/footer.php'
    ?>
</body>
</html>
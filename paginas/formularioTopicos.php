<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear - Editar Topicos | El Tintero</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/formularios.css">
</head>
<body>

    <?php 
        include_once '../componentes/nav.php'
    ?>

    <div class="page-header header-admin">
        <div class="page-header-content">
            <h1>Crear Nueva Categoría</h1>
            <p>Añade una nueva sección principal para organizar las discusiones del foro.</p>
        </div>
    </div>

    <div class="container contenedor-centrado">
        <main class="form-card w-100">

        <!--Formulario para la creacion de tópicos -->
            <form action="#" method="POST" class="formulario-brutal">
                
                <div class="form-group">
                    <label for="nombre_categoria">Nombre de la Categoría</label>
                    <input type="text" id="nombre_categoria" name="nombre_categoria" placeholder="Ej: Bases de Datos, Off-Topic, etc." required>
                </div>

                <div class="form-group">
                    <label for="descripcion_categoria">Descripción breve</label>
                    <textarea id="descripcion_categoria" name="descripcion_categoria" rows="3" placeholder="¿De qué trata esta sección? (Aparecerá debajo del nombre)" required></textarea>
                </div>

                <div class="form-group">
                    <label>Color de la Etiqueta (Para diferenciar visualmente)</label>
                    <div class="selector-colores">
                        <label class="radio-color">
                            <input type="radio" name="color_etiqueta" value="rojo" checked>
                            <span class="muestra-color rojo"></span>
                        </label>
                        <label class="radio-color">
                            <input type="radio" name="color_etiqueta" value="azul">
                            <span class="muestra-color azul"></span>
                        </label>
                        <label class="radio-color">
                            <input type="radio" name="color_etiqueta" value="amarillo">
                            <span class="muestra-color amarillo"></span>
                        </label>
                    </div>
                </div>

                <div class="form-acciones">
                    <a href="../index.php" class="btn btn-ghost">Cancelar</a>
                    <button type="submit" class="btn btn-solid">Guardar Categoría</button>
                </div>
            </form>
        </main>
    </div>

    <?php 
        include_once '../componentes/footer.php'
    ?>
</body>
</html>
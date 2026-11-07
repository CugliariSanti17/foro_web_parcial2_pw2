<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear - Editar Temas | El Tintero</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/formularios.css">
    
</head>
<body>

    <?php 
        include_once '../componentes/nav.php'
    ?>

    <div class="page-header header-formularios">
        <div class="page-header-content">
            <!-- Agregar PHP para cambiar título -->
            <h1>Publicar un nuevo tema</h1> 
        </div>
    </div>

    <div class="container contenedor-centrado">
        <main class="form-card w-100">
            <!--Formulario para creacion / edicion de temas -->
            <form action="#" method="POST" class="formulario-brutal">
                
                <div class="form-group">
                    <label for="titulo">Título del tema</label>
                    <input type="text" id="titulo" name="titulo" placeholder="Ej: ¿Cómo centrar un div en 2026?" required>
                </div>

                <div class="form-group">
                    <label for="categoria">Categoría</label>
                    <select id="categoria" name="categoria" required>
                        <option value="" disabled selected>Selecciona dónde publicar...</option>
                        <option value="1">Desarrollo</option>
                        <option value="2">Diseño</option>
                        <option value="3">General</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="contenido">Contenido</label>
                    <textarea id="contenido" name="contenido" rows="10" placeholder="Explica tu duda o comparte tu idea con detalle..." required></textarea>
                </div>

                <div class="form-acciones">
                    <button type="button" class="btn btn-ghost">Cancelar</button>
                    <button type="submit" class="btn btn-solid">Publicar Tema</button>
                </div>
            </form>
        </main>
    </div>

    <?php 
        include_once '../componentes/footer.php'
    ?>
</body>
</html>
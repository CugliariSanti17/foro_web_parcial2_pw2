<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sugerencias | El tintero</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/sugerencias.css">

</head>
<body>

    <?php 
        include_once '../componentes/nav.php'
    ?>
    
    <div class="page-header header-sugerencias">
        <div class="page-header-content">
            <h1>Formulario de Sugerencias</h1>
            <p>¿Faltan categorías? ¿Tenés ideas para mejorar el foro? Queremos leerte.</p>
        </div>
    </div>

    <div class="container">
        
        <main class="foro-main">
            <div class="form-card">
                <h2>Envíanos tu mensaje</h2>
                
                <!-- Formulario sugerencias -->
                <form action="#" method="POST" class="formulario-brutal">
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="apellido">Apellido</label>
                            <input type="text" id="apellido" name="apellido" placeholder="Tu apellido" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" id="email" name="email" placeholder="tucorreo@ejemplo.com" required>
                    </div>

                    <div class="form-group">
                        <label for="motivo">Motivo de la sugerencia</label>
                        <select id="motivo" name="motivo" required>
                            <option value="" disabled selected>Selecciona un motivo...</option>
                            <option value="falta_temas">Faltan categorías o temas</option>
                            <option value="mejora_visual">Sugerencia de diseño / visual</option>
                            <option value="reporte_error">Reportar un error técnico</option>
                            <option value="otro">Otras sugerencias</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="mensaje">Mensaje</label>
                        <textarea id="mensaje" name="mensaje" rows="6" placeholder="Escribe tu sugerencia o idea aquí..." required></textarea>
                    </div>

                    <button type="submit" class="btn btn-solid btn-full">Enviar Sugerencia</button>
                </form>
            </div>
        </main>

        <!-- Informacion extra -->
        <aside class="foro-sidebar">
            <div class="card-sidebar card-info-contacto">
                <h3>¿Por qué enviar sugerencias?</h3>
                <p>ElTintero es una comunidad construida por y para sus usuarios. Leemos cada mensaje para implementar nuevas funcionalidades y mejorar la convivencia.</p>
            </div>
            
            <div class="card-sidebar">
                <h3>Tiempos de respuesta</h3>
                <p>No solemos responder cada sugerencia de forma individual por correo, pero las actualizaciones aprobadas son anunciadas en la categoría <strong>General</strong> del foro.</p>
            </div>
        </aside>
    </div>

    <?php 
        include_once '../componentes/footer.php'
    ?>
</body>
</html>
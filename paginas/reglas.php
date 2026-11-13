<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reglas | El Tintero</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/reglas.css">
</head>
<body>

    <?php 
        include_once '../componentes/nav.php'
    ?>

    <div class="page-header header-reglas">
        <div class="page-header-content">
            <h1>Reglas de la Comunidad</h1>
            <p>Para mantener un ambiente limpio, ordenado y útil para todos, te pedimos que respetes estas normas básicas.</p>
        </div>
    </div>

    <div class="container">
        <main class="foro-main">
            <div class="lista-reglas">
    
                <article class="regla-card">
                    <div class="regla-numero color-1">01</div>
                    <div class="regla-contenido">
                        <h2>Respeto mutuo y cero toxicidad</h2>
                        <p>No se tolerarán insultos, discriminación, acoso ni menosprecio. Estamos aquí para aprender y debatir de forma constructiva. Si no estás de acuerdo con alguien, argumenta tu posición sin atacar a la persona.</p>
                    </div>
                </article>

                <article class="regla-card">
                    <div class="regla-numero color-2">02</div>
                    <div class="regla-contenido">
                        <h2>Títulos claros y descriptivos</h2>
                        <p>Evita usar títulos como "AYUDAAAA", "Tengo un problema" o "Entra aquí". El título debe resumir de qué trata tu tema. Un buen título ayuda a que otros te respondan más rápido y facilita la búsqueda en el futuro.</p>
                    </div>
                </article>

                <article class="regla-card">
                    <div class="regla-numero color-3">03</div>
                    <div class="regla-contenido">
                        <h2>Cero Spam y Autopromoción</h2>
                        <p>Está prohibido publicar enlaces de afiliados, publicidad no solicitada o crear hilos con el único propósito de promocionar tus propios servicios o productos sin aportar valor previo a la comunidad.</p>
                    </div>
                </article>

                <article class="regla-card">
                    <div class="regla-numero" style="background-color: #1a1a1a; color: #fdfbf7;">04</div>
                    <div class="regla-contenido">
                        <h2>Usa el formato correcto para el código</h2>
                        <p>Si vas a compartir código, utiliza los bloques correspondientes para que sea legible. Pegar 200 líneas de código sin formato dificulta la lectura y hace que sea menos probable que alguien te ayude.</p>
                    </div>
                </article>
            </div>
        </main>
        
        <aside class="foro-sidebar">
            <div class="card-sidebar card-advertencia">
                <h3>¿Qué pasa si rompo las reglas?</h3>
                <p>El equipo de moderación actúa según la gravedad:</p>
                <ul class="lista-consecuencias">
                    <li><strong>Aviso:</strong> Un recordatorio amistoso.</li>
                    <li><strong>Edición/Borrado:</strong> Eliminación del tema o mensaje.</li>
                    <li><strong>Suspensión:</strong> Bloqueo temporal de la cuenta.</li>
                    <li><strong>Baneo:</strong> Expulsión permanente (casos graves).</li>
                </ul>
            </div>

            <div class="card-sidebar">
                <h3>¿Todo claro?</h3>
                <p>Si ya leíste las reglas y estás listo para participar, vuelve al foro y únete a la conversación.</p>
                <a href="../paginas/discusiones.php" class="btn btn-solid btn-full">Ir a Discusiones</a>
            </div>
        </aside>
    </div>

    <?php 
        include_once '../componentes/footer.php'
    ?>
</body>
</html>
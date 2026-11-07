<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tema | El Tintero</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/tema.css">
</head>
<body>

    <?php 
        include_once '../componentes/nav.php'
    ?>
    <div class="container contenedor-tema">
        
        <!-- Publicación Principal -->
        <main class="tema-principal">
            
            <div class="tema-detalle-card">
                <div class="tema-cabecera">
                    <span class="etiqueta color-1">Desarrollo</span>
                    <h1>¿Cómo estructurar un proyecto desde cero?</h1>
                    <div class="tema-autor-meta">
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Juan" alt="Avatar" class="avatar">
                        <div class="meta-info">
                            <strong>@dev_juan</strong>
                            <span>Publicado el 12 de Noviembre, 2026</span>
                        </div>
                    </div>
                </div>

                <div class="tema-cuerpo">
                    <p>¡Hola a todos!</p>
                    <p>Siempre que empiezo un proyecto nuevo con PHP y MySQL termino haciendo un desastre con las carpetas. Empiezo poniendo todo en la raíz y a las dos semanas tengo 40 archivos sueltos.</p>
                    <p>¿Tienen alguna recomendación de cómo organizar los archivos? Me hablaron de separar vistas, controladores y modelos, pero me parece muy complejo para un foro simple.</p>
                    <p>¡Gracias de antemano!</p>
                </div>

                <div class="tema-acciones">
                    <button class="btn btn-ghost">▲ 42 Votos</button>
                    <button class="btn btn-ghost">Compartir</button>
                </div>

                <div class="tema-acciones">
                    <button class="btn btn-ghost">Editar</button>
                </div>
            </div>

            <!-- Sección de Respuestas -->
            <section class="seccion-respuestas">
                <h2>Respuestas (2)</h2>

                <!-- Comentario de prueba -->
                <article class="comentario-card">
                    <div class="comentario-votos">
                        <button class="btn-voto">▲</button>
                        <span>15</span>
                    </div>
                    <div class="comentario-contenido">
                        <div class="comentario-meta">
                            <strong>@ana_ux</strong> <span>• hace 2 horas</span>
                        </div>
                        <p>Para empezar, te sugiero crear al menos tres carpetas: <code>/assets</code> (para CSS, JS e imágenes), <code>/includes</code> (para tu nav, footer y conexión a la BD) y dejar en la raíz solo las páginas que el usuario visita directamente (index, tema, login).</p>
                    </div>
                </article>

                <!-- Comentario de prueba -->
                <article class="comentario-card">
                    <div class="comentario-votos">
                        <button class="btn-voto">▲</button>
                        <span>3</span>
                    </div>
                    <div class="comentario-contenido">
                        <div class="comentario-meta">
                            <strong class="rol-admin">@admin</strong> <span>• hace 1 hora</span>
                        </div>
                        <p>Totalmente de acuerdo con Ana. No hace falta que uses un patrón MVC completo al principio. Mantén la lógica simple pero separada del HTML repetitivo.</p>
                    </div>
                </article>

            </section>

            <!-- Formulario para responder -->
            <section class="caja-respuesta">
                <h3>Dejar una respuesta</h3>
                <form action="#" method="POST">
                    <textarea placeholder="Escribe tu respuesta aquí... Sé respetuoso y aporta valor." rows="5" class="input-textarea"></textarea>
                    <button type="submit" class="btn btn-solid">Publicar respuesta</button>
                </form>
            </section>

        </main>

        <!-- Barra lateral con información -->
        <aside class="foro-sidebar">
            <div class="card-sidebar">
                <h3>Acerca de este tema</h3>
                <p><strong>Categoría:</strong> Desarrollo</p>
                <p><strong>Vistas:</strong> 342</p>
                <p><strong>Respuestas:</strong> 2</p>
                <a href="../paginas/discusiones.php" class="btn btn-ghost btn-full">← Volver al listado</a>
            </div>
        </aside>
    </div>

    <?php 
        include_once '../componentes/nav.php'
    ?>
</body>
</html>
<?php 
    require_once '../conexion.php';

    require_once '../componentes/cargar_formulario_discusion.php';

    session_start();

    $sql_categorias = 'SELECT id_categoria, nombre FROM categorias';

    $resultado_categorias = mysqli_query($conexion, $sql_categorias);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $es_edicion ? 'Editar tema | El tintero' : 'Crear tema | El tintero'?></title>
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/formularios.css">
    
</head>
<body>

    <?php 
        include_once '../componentes/nav.php';
    ?>

    <div class="page-header header-formularios">
        <div class="page-header-content">
            <h1><?=$titulo_pagina?></h1> 
        </div>
    </div>

    <div class="container contenedor-centrado">
        <main class="form-card w-100">
            <!--Formulario para creacion / edicion de temas -->
            <form action="<?=$url_form?>" method="POST" class="formulario-brutal">
                
                <?php 
                    if($es_edicion){
                    ?>
                        <input type="hidden" name="id_tema" value="<?=$id_tema?>">
                    <?php
                    }
                ?>

                <?php 
                    if(isset($_SESSION['errores']['general'])){
                        ?>
                        <p class="msj-error"><?=$_SESSION['errores']['general']?></p>
                        <?php
                    }
                ?>
                
                <div class="form-group">
                    <label for="titulo">Título del tema</label>
                    <input type="text" id="titulo" name="titulo" value="<?=$_SESSION['datos']['titulo'] ?? htmlspecialchars($titulo ?? '')?>" placeholder="¿Cómo centrar un div en 2026?" required>

                    <?php 
                    if(isset($_SESSION['errores']['titulo'])){
                        ?>
                        <p class="msj-error"><?=$_SESSION['errores']['titulo']?></p>
                        <?php
                    }
                ?>
                </div>

                <div class="form-group">
                    <label for="categoria">Categoría</label>
                    <select id="categoria" name="categoria" required>
                        <option value="" disabled>Selecciona una categoria...</option>
                        <?php 
                            while($resultado = mysqli_fetch_assoc($resultado_categorias)){
                               ?>
                                <option value="<?=$resultado['id_categoria']?>" <?=$resultado['id_categoria'] == $id_categoria_actual ? 'selected' : ''?>>
                                    <?=htmlspecialchars($resultado['nombre'])?>
                                </option>
                                <?php
                            }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="contenido">Contenido</label>
                    <textarea id="contenido" name="contenido" rows="10" placeholder="Explica tu duda o comparte tu idea con detalle..." required><?=$_SESSION['datos']['titulo'] ?? htmlspecialchars($contenido ?? '')?></textarea>

                    <?php 
                    if(isset($_SESSION['errores']['contenido'])){
                        ?>
                        <p class="msj-error"><?=$_SESSION['errores']['contenido']?></p>
                        <?php
                    }
                ?>
                </div>

                <div class="form-acciones">
                    <a class="btn btn-ghost" href="./discusiones.php">Cancelar</a>
                    <button type="submit" class="btn btn-solid"><?=$es_edicion ? 'Editar tema' : 'Crear tema'?></button>
                </div>
            </form>
        </main>
    </div>

    <?php 
        include_once '../componentes/footer.php';

        unset($_SESSION['errores']);
        unset($_SESSION['datos']);
    ?>
</body>
</html>
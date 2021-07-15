<?php 
    require_once 'conexion.php';
    require_once 'helpers.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLOG</title>
    <link rel="stylesheet" type="text/css" href="assets/estilos/styles.css">
</head>
<body>
<!--Cabecera -->
<header id="cabecera">
<!--LOGO-->
    <div id="logo">
        <a href="index.php">
            Blog de VideoJuegos
        </a>
    </div>

<!--MENU-->

<nav id="menu">
    <ul>
        <li>
            <a href="index.php">Inicio</a>
        </li>
        <?php 
            $categorias=conseguirCategorias($db);
            if(!empty($categorias)):
            while($categoria =mysqli_fetch_assoc($categorias)):
        ?>  
            <li>
                <a href="categoria.php?id=<?=$categoria['id']; ?>"><?=$categoria['nombre'];?></a>
            </li>
        <?php 
            endwhile; 
            endif;   
        ?>
        <li>
            <a href="sobre-nosotros.php">Sobre nosotros</a>
        </li>
        <li>
            <a href="contacto.php">Contacto</a>
        </li>
    </ul>

</nav>
<div class="clearfix"></div>
</header>
<div id="contenedor">

<?php require_once './includes/header.php'; ?>
<?php require_once './includes/lateral.php'; ?>

<?php
            $categoria = conseguirCategoria( $db, $_GET['id']);
            if(!isset($categoria['id'])){
                header("Location:index.php");
            }
?>


<!--Caja principal-->
    <div id="principal">

        <h1>Entradas de <?=$categoria['nombre']?></h1>
        
        <?php
            $entradas = conseguirEntradas($db,null,$_GET['id']);
                                    //Si hay 1 o mas filas para recorrer
            if(!empty($entradas) && mysqli_num_rows($entradas)>=1):
                while($entrada = mysqli_fetch_assoc($entradas)):
        ?>
            <article class="entrada">
                <a href="entrada.php?id=<?=$entrada['id'];?>"> 
                    <h2><?=$entrada['titulo']; ?></h2>
                    <span class="fecha"><?=$entrada['categoria'].' | '.$entrada['fecha']; ?></span>
                    <p><!--Limitamos los caracteres -->
                       <?= substr($entrada['descripcion'],0,100).'...' ?>
                    </p>
                </a>
            </article>
        <?php
                endwhile;
            else:
        ?>
        <div class="alerta alerta-error">No hay entradas en esta categoria</div>
        <?php endif;?>

    </div> <!--Fin principal-->

<?php require_once './includes/footer.php'; ?>

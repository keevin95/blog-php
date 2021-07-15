<?php
            
            
            if(!isset($_POST['busqueda'])){
                header("Location:index.php");
            }
            
?>
<?php require_once './includes/header.php'; ?>
<?php require_once './includes/lateral.php'; ?>


<!--Caja principal-->
    <div id="principal">

        <h1>Busqueda: <?=$_POST['busqueda']?></h1>
        
        <?php
            $entrada_buscada = conseguirEntradas($db,null,null,$_POST['busqueda']);
                                    
            //Si hay 1 o mas filas para recorrer
            if(!empty($entrada_buscada) && mysqli_num_rows($entrada_buscada)>=1):
                while($entrada = mysqli_fetch_assoc($entrada_buscada)):
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

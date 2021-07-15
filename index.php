<?php require_once './includes/header.php'; ?>

<?php require_once './includes/lateral.php'; ?>

<!--Caja principal-->
    <div id="principal">
        <h1>Ultimas entradas</h1>

        <?php
            $entradas = conseguirEntradas($db,true);
            if(!empty($entradas)):
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
            endif;
        
        ?>
        <div id="ver-todas">
        <a href="entradas.php">Ver todas las entradas</a>
    </div>
    </div> <!--Fin principal-->

<?php require_once './includes/footer.php'; ?>

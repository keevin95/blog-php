<?php require_once './includes/header.php'; ?>
<?php require_once './includes/lateral.php'; ?>

<?php
            $entrada_actual = conseguirEntrada($db, $_GET['id']);

            if(!isset($entrada_actual['id'])){
                header("Location:index.php");
            }
?>

<!--Caja principal-->
    <div id="principal">
            <h1><?=$entrada_actual['titulo'];?></h1>
            <a href="categoria.php?id=<?=$entrada_actual['categoria_id'];?>">
            <h2><?=$entrada_actual['categoria'];?></h2>
            </a>
            <h3><?=$entrada_actual['fecha'];?> | <?=$entrada_actual['usuario'];?> </h3>
        
        <p><?=$entrada_actual['descripcion'];?></p>

        

        <?php if(isset($_SESSION['usuario']) && ($_SESSION['usuario']['id'])==$entrada_actual['usuario_id']): ?>
            <a href="editar-entrada.php?id=<?=$entrada_actual['id'];?>" class="boton editar-entrada">Editar entrada</a> <br>
            <a href="borrar-entrada.php?id=<?=$entrada_actual['id'];?>" class="boton borrar-entrada">Borrar entradas</a>
        <?php endif ?>


    </div> <!--Fin principal-->

<?php require_once './includes/footer.php'; ?>

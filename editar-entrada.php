<?php require_once './includes/redireccion.php'; ?>
<?php require_once './includes/conexion.php'; ?>
<?php require_once 'includes/header.php';?>
<?php require_once './includes/lateral.php'; ?>


<?php
            $entrada_actual = conseguirEntrada($db, $_GET['id']);

            if(!isset($entrada_actual['id'])){
                header("Location:index.php");
            }
?>


<!--Caja principal-->
<div id="principal">
        <h1>Editar entrada</h1>
        <p>Edita tu entrada: <?=$entrada_actual['titulo'] ?></p>
        
      
    <form action="guardar-entradas.php?editar=1" method="POST">
        <label for="titulo_entrada">Titulo de entrada</label>
        <input type="text" name="titulo_entrada" value="<?=$entrada_actual['titulo'];?> ">
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarErrores($_SESSION['errores_entrada'],'titulo_entrada') : '' ?>

        <label for="descripcion_entrada">Descripcion</label>
        <textarea name="descripcion_entrada"> <?=$entrada_actual['descripcion'] ?></textarea>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarErrores($_SESSION['errores_entrada'],'descripcion_entrada') : '' ?>
        
        <label for="categoria">Categoria</label>
        <select name="categoria" >
            <?php   
                $categorias =conseguirCategorias($db);
                if(!empty($categorias)):
                    while($categoria = mysqli_fetch_assoc($categorias)):          
            ?>
                <option value="<?=$categoria['id']?>" <?=($categoria['id'] == $entrada_actual['id']) ? "selected ='selected'":''?>>
                        <?=$categoria['nombre']; ?>
                </option> 
                <?php 
                endwhile; 
                endif;
                ?>
        </select>
        
        
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarErrores($_SESSION['errores_entrada'],'categoria') : '' ?>
        <input type="submit" value="Guardar">

    </form>
    <?php borrarErrores();?>
    </div> <!--Fin principal-->





<?php require_once 'includes/footer.php';?>
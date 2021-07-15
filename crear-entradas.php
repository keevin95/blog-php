<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/lateral.php';?>
<?php require_once 'includes/redireccion.php'; ?>



<!--Caja principal-->
<div id="principal">
        <h1>Crear Entradas</h1>
        <p>Carga tu entrada!</p>
        <br>
    <form action="guardar-entradas.php" method="POST">
        <label for="titulo_entrada">Titulo de entrada</label>
        <input type="text" name="titulo_entrada" >
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarErrores($_SESSION['errores_entrada'],'titulo_entrada') : '' ?>

        <label for="descripcion_entrada">Descripcion</label>
        <textarea name="descripcion_entrada"></textarea>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarErrores($_SESSION['errores_entrada'],'descripcion_entrada') : '' ?>
        
        <label for="categoria">Categoria</label>
        <select name="categoria" >
            <?php   
                $categorias =conseguirCategorias($db);
                if(!empty($categorias)):
                    while($categoria = mysqli_fetch_assoc($categorias)):
            ?>
                <option value="<?=$categoria['id']; ?>"><?=$categoria['nombre']; ?></option>
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

<?php require_once './includes/footer.php'; ?>
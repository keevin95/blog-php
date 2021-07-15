<?php require_once 'includes/redireccion.php';?>
<?php require_once 'includes/header.php';?>
<?php require_once 'includes/lateral.php';?>


<div id="principal">
        <h1>Mis datos</h1>

        <?php if(isset($_SESSION['completado'])) :?>
            <div class="alerta alerta_exito">
                <?=$_SESSION['completado']?> 
            </div>
            
        <?php elseif(isset($_SESSION['errores']['general'])): ?>
                <div class="alerta alerta_error">
                    <?= $_SESSION['errores']['general']?>
                </div>
        <?php endif;?>
    
        <form action="actualizar-usuario.php" method="POST">
            <label for="name">Nombre</label>
            <input type="text" name="nombre" value="<?=$_SESSION['usuario']['nombre'];?>">
            <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'],'nombre') : '' ?>
            
            <label for="apellidos">Apellido</label>
            <input type="text" name="apellidos" value="<?=$_SESSION['usuario']['apellidos'];?>">
            <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'],'nombre') : '' ?>
            
            <label for="email">Email</label>
            <input type="email" name="email" value="<?=$_SESSION['usuario']['email'];?>">
            <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'],'email') : '' ?>
            

            
            <input type="submit" name="submit" value="Actualizar">
            <?php borrarErrores();?>
            
        </form>

        
</div> <!--Fin principal-->

<?php require_once './includes/footer.php'; ?>
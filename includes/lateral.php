<?php 
    require_once 'includes/helpers.php' 
    
?>



<aside id="sidebar">
<div id="buscador" class="bloque">
    <h3>Buscar</h3>




        <form action="buscar.php" method="POST">
            <input type="text" name="busqueda">
            <input type="submit" value="Buscar">
            
        </form>
    </div>








    <?php if(isset($_SESSION['usuario'])) : ?>
        <div id="usuario-logueado" class="bloque">
            <h3>Bienvenido, <?= $_SESSION['usuario']['nombre'].' '. $_SESSION['usuario']['apellidos'];?></h3>
            <!--BOTONES -->

            
            <a href="mis-datos.php" class="boton boton-datos">Mis datos</a>
            <a href="crear-entradas.php" class="boton boton-entradas">Crear entradas</a>
            <a href="crear-categorias.php" class="boton boton-datos">Crear categoria</a>
            <a href="cerrar-sesion.php" class="boton">Cerrar sesion</a>
        </div>

    <?php endif;?>

    <?php if(!isset($_SESSION['usuario'])) :?>
    <div id="login" class="bloque">
        <h3>Ingresar</h3>

        <?php if(isset($_SESSION['error_login'])) : ?>
            <div class="alerta alerta_error">
               <?php echo $_SESSION['error_login']?>
            </div>

        <?php endif;?>

        <form action="login.php" method="POST">
            <label for="email">Email</label>
            <input type="email" name="email">
            <label for="password">Password</label>
            <input type="password" name="password">
            
            <input type="submit" value="Entrar">
            
        </form>
    </div>

    <div id="registro" class="bloque">
        <h3>Crear cuenta</h3>

        <!--Mostrar errores-->
        <?php if(isset($_SESSION['completado'])) :?>
            <div class="alerta alerta_exito">
                <?=$_SESSION['completado']?> 
            </div>
            
        <?php elseif(isset($_SESSION['errores']['general'])): ?>
                <div class="alerta alerta_error">
                    <?= $_SESSION['errores']['general']?>
                </div>
        <?php endif;?>
    
        <form action="registro.php" method="POST">
            <label for="name">Nombre</label>
            <input type="text" name="nombre">
            <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'],'nombre') : '' ?>
            
            <label for="apellidos">Apellido</label>
            <input type="text" name="apellidos">
            <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'],'nombre') : '' ?>
            
            <label for="email">Email</label>
            <input type="email" name="email">
            <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'],'email') : '' ?>
            
            <label for="password">Password</label>
            <input type="password" name="password">
            <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'],'password') : '' ?>
            
            <input type="submit" name="submit" value="Crear cuenta">
            <?php borrarErrores();?>
            
        </form>
    </div>
        <?php endif;?>
</aside>
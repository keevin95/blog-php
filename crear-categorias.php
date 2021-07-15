<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/lateral.php';?>
<?php require_once 'includes/redireccion.php'; ?>




<!--Caja principal-->
<div id="principal">
        <h1>Crear Categorias</h1>
        <p>Añade tu categoria para que otros usuarios puedan disfrutarlas!</p>
        <br>
    <form action="guardar-categorias.php" method="POST">
        <label for="nombre_categoria">Nombre De Categoria</label>
        <input type="text" name="nombre_categoria">
        <input type="submit" value="Guardar">

    </form>
    </div> <!--Fin principal-->

<?php require_once './includes/footer.php'; ?>

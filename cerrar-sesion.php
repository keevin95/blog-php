<?php
    require_once './includes/conexion.php';


    if(isset($_SESSION['usuario'])){
 
        session_destroy();
    }

    header('location:index.php');


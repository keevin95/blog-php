<?php

//iniciar sesion y conexion a la base
require_once './includes/conexion.php';

//recoger datos del formulario

if(isset($_POST)){
    //borrar error antiguo
    if(isset($_SESSION['error_login'])){
        unset($_SESSION['error_login']);
    }

    //recojo datos del formulario
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    //Consulta a la base para ver si hay coincidencia entre el usuario que intenta logearse y la base
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    //REALIZAMOS LA CONSULTA EN LA BASE DE DATOS PARA VER SI HAY COINCIDENCIA DE MAIL
    $login = mysqli_query($db,$sql);

            //Cuenta el numero de filas que devuelve la consulta!!
    if($login && mysqli_num_rows($login)==1){
        /*La consulta devuelve un array con la informacion completa del usuario con ese mail*/ 
        $usuario = mysqli_fetch_assoc($login);
        
        //comprobar contraseña / cifrar
       $verify = password_verify($password,$usuario['password']);
       if($verify){
        //Utilizar una sesion para guardar los datos del usuario logueado
        $_SESSION['usuario'] = $usuario;
    
       }else{
        //Si algo falla enviar una sesion con el fallo
        $_SESSION['error_login'] = 'Login incorrecto';
       }
    
    }else{
        //Mensaje de error
        $_SESSION['error_login'] = 'Login incorrecto';
  
    
    }
    //redirigir a index.php
}
header('location:index.php');

?>
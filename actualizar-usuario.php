<?php

if(isset($_POST)){

    //cargamos conexion a la base de datos
    require_once 'includes/conexion.php';

    // Iniciar sesion por si falla la conexion
    if(!$_SESSION){
        session_start();
    }

    $usuario = $_SESSION['usuario'];

    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']):false;
    //el trim es para que se guarde sin espacios
    $email= isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) :false;

    //Array de errores

    $errores = array();



    //---------------------VALIDAMOS DATOS DEL FORMULARIO-----------------------//
    //Si la variable no esta vacia, y no es un numero, y no hay numeros de 0 al 9 en la variable nombre
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/",$nombre)){
        $nombre_validado =  true;
    }else{
        $nombre_validado = false;
        $errores['nombre'] = 'El nombre no es valido';
    }

    if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/",$apellidos)){
        $apellidos_validado =  true;
    }else{
        $apellidos_validado = false;
        $errores['apellidos'] = 'El Apellido no es valido';
    }

    //Validar email
    if(!empty($email) && filter_var($email,FILTER_VALIDATE_EMAIL)){
        $email_validado =  true;
    }else{
        $email_validado = false;
        $errores['email'] = 'El Email no es valido';
    }
 


    if(count($errores)==0){
        
        $guardar_usuario = true;

        // comprobar si el email ya existe

        $sql  = "SELECT id, email FROM usuarios WHERE email ='$email'";


        $isset_email = mysqli_query($db,$sql);
        $isset_user = mysqli_fetch_assoc($isset_email);
       

        if($isset_user['id'] == $usuario['id'] || empty($isset_user)){
            //Actualizar usuario en la bbdd
            
            $sql = "UPDATE usuarios SET nombre='$nombre',
                    apellidos ='$apellidos',
                    email='$email' WHERE id = ".$usuario['id'];
    
                
            $guardar_usuario = mysqli_query($db,$sql);

            if ($guardar_usuario){
                //Actualizamos los datos en la sesion!
                $_SESSION['usuario'] ['nombre'] = $nombre;
                $_SESSION['usuario'] ['apellidos'] = $apellidos;
                $_SESSION['usuario'] ['email'] = $email;
                
                $_SESSION['completado']='La actualizacion se ha completado con exito';
            }else{
                $_SESSION['errores'] ['general'] = 'Fallo al actualizar los datos';
            }
        }else{
            $_SESSION['errores'] ['general'] = 'El usuario ya existe';
        }
            
    }else{
        $_SESSION['errores'] = $errores;
    }
}

header("Location:mis-datos.php");
?>
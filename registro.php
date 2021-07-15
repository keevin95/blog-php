<?php

if(isset($_POST)){
    //cargamos conexion a la base de datos
    require_once './includes/conexion.php';

    // Iniciar sesion por si falla la conexion
    if(!$_SESSION){
        session_start();
    }
    
    //------------------RECOGEMOS DATOS DEL FORMULARIO--------------------- //
    
    //OPERADOR TERNARIO
    // si isset es true el valor de la varialbe va a ser lo que trae post, si no es true, el valor de $apellidos
    // lo que haya dsp de los dos puntos ejemplo ---> :false, :-1, : 'no hay nada'
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']):false;
    //el trim es para que se guarde sin espacios
    $email= isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']): false;

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

    if(!empty($password)){
        $password_validado =  true;
    }else{
        $password_validado = false;
        $errores['password'] = 'Las password esta vacia';
    }
    $guardar_usuario = false;
    //SI TODO ESTA BIEN Y NO HAY ERRORES EN EL FORMULARIO---->
    if(count($errores)==0){
        
        $guardar_usuario = true;
        
        //Cifrar la contraseña es decir para que no se pueda ver en la base de datos
                                //Recibe la pass,tipo de cifrado(mas recomendado),y en la opcion le mandamos el numero de veces que se cifra
        $password_segura = password_hash($password,PASSWORD_BCRYPT,['cost'=>4]);

        //Insertar usuario en la bbdd

        $sql = "INSERT INTO usuarios VALUES(NULL,'$nombre','$apellidos','$email','$password_segura',CURDATE())";
        $guardar_usuario = mysqli_query($db,$sql);

    

        if ($guardar_usuario){
            $_SESSION['completado']='El registro se ha completado con exito';
        }else{
            $_SESSION['errores'] ['general'] = 'Fallo al guardar usuario en la base de datos';

        }
        
    }else{
        $_SESSION['errores'] = $errores;
    }
    
}

header('Location:index.php');



?>
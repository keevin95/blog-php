<?php
    if(isset($_POST)){

        //cargamos conexion a la base de datos
        require_once './includes/conexion.php';

        // Iniciar sesion por si falla la conexion
        if(!$_SESSION){
            session_start();
        }
    

        //Recogemos formulario
        $categoria_nombre= isset($_POST['nombre_categoria']) ? mysqli_real_escape_string($db,$_POST['nombre_categoria']) : false;

           //Array de errores

        $errores = array();



        //---------------------VALIDAMOS DATOS DEL FORMULARIO-----------------------//
        //Si la variable no esta vacia, y no es un numero, y no hay numeros de 0 al 9 en la variable nombre
        if(!empty($categoria_nombre) && !is_numeric($categoria_nombre) && !preg_match("/[0-9]/",$categoria_nombre)){
            $nombre_validado =  true;
        }else{
            $nombre_validado = false;
            // Le indicamos donde esta el error, 
            //el error estaria en el valor que trae el input con nombre " nombre_categoria"
            $errores['nombre_categoria'] = 'El nombre no es valido';
        }

        $guardar_categoria = false;

        if(count($errores)==0){
            $sql= "INSERT INTO categorias VALUES(NULL,'$categoria_nombre')";
            $guardar_categoria = mysqli_query($db,$sql);
        }

    }
    header("Location:index.php");

?>
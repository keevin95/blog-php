<?php 
    if(isset($_POST)){
        //cargamos conexion a la base de datos
        require_once 'includes/conexion.php';

        // Iniciar sesion por si falla la conexion
        if(!$_SESSION){
            session_start();
        }
    
        //Recogemos formulario
        $titulo = isset($_POST['titulo_entrada']) ? mysqli_real_escape_string($db,$_POST['titulo_entrada']) : false;
        $descripcion = isset($_POST['descripcion_entrada']) ?  mysqli_real_escape_string($db,$_POST['descripcion_entrada']) : false;
         
                                                    //Casteamos el dato a un entero
        $id_categoria = isset($_POST['categoria']) ? (int)$_POST['categoria'] : false;
        //recogemos la id del usuario 
        $id_usuario = (int)$_SESSION['usuario']['id'];

        //Array de errores

        $errores = array();

        //---------------------VALIDAMOS DATOS DEL FORMULARIO-----------------------//

        if(!empty($titulo) && !is_numeric($titulo)){
            $titulo_validado = true;
        }else{
            $titulo_validado = false;
            // Le indicamos donde esta el error, 
            //el error estaria en el valor que trae el input con nombre " titulo_entrada"
            $errores['titulo_entrada'] = 'El titulo de la entrada es invalido';
        }
        
        if(!empty($descripcion)){
            $descripcion_validada = true;
        }else{
            $descripcion_validada = false;
            $errores['descripcion_entrada'] = 'La descripcion esta vacia';
        }

        if(!empty($id_categoria) && is_numeric($id_categoria)){
            $id_validado = true;
        }
        else{
            $id_validado = false;
            $errores['categoria'] = 'ID incorrecto/La id no tiene un valor valido';
        }
        
        $guardar_entrada = false;

        if(count($errores)==0){
            if(isset($_GET['editar'])){
                $entrada_id = $_GET['editar'];
                $usuario_actual = $_SESSION['usuario']['id'];
                $sql = "UPDATE entradas SET titulo = '$titulo',descripcion='$descripcion',categoria_id='$id_categoria'
                WHERE usuario_id = $usuario_actual ";


            }else{
                $sql = "INSERT INTO entradas VALUES(NULL,'$id_usuario','$id_categoria','$titulo','$descripcion',CURDATE())";
            }
            $guardar_entrada = mysqli_query($db,$sql);

            header("Location:index.php");

        }else{
            $_SESSION["errores_entrada"] = $errores;
            if(isset($_GET['editar'])){
                header("Location: editar-entrada.php?id=".$_GET['editar']);
            }else{
                header("Location:crear-entradas.php");
            }
            
        }

    }

?>
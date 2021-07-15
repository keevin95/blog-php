<?php

function mostrarErrores($errores,$campo){
    $alerta = '';
    if(isset($errores[$campo])&& !empty($campo)){
        $alerta = "<div class= 'alerta alerta_error'>".$errores[$campo]."</div>";
    }

    return $alerta;
}

function borrarErrores(){
    $borrado = false;
    if(isset($_SESSION['errores'])){
        $_SESSION['errores'] = null;
        $borrado = $_SESSION['errores'];
        return $borrado;
    }
    if(isset($_SESSION['completado'])){
        $_SESSION['completado']=null;
        $completado_borrado = $_SESSION['completado'];
        return $completado_borrado;
    }
    if(isset($_SESSION['errores_entrada'])){
        $_SESSION['errores_entrada'] = null;
    }

}

function conseguirCategoria($conexion, $id){
    $sql = "SELECT * FROM categorias WHERE id =$id;";
    $categorias = mysqli_query($conexion,$sql);
    $result = array ();
    if($categorias && mysqli_num_rows($categorias)>=1){
        $result = mysqli_fetch_assoc($categorias);
    } 
    return $result;
}


function conseguirCategorias($conexion){
    $sql = "SELECT * FROM categorias ORDER BY id ASC;";
    $categorias = mysqli_query($conexion,$sql);
    $result = array ();
    if($categorias && mysqli_num_rows($categorias)>=1){
        $result = $categorias;
    } 
    return $result;
}

function conseguirEntradas($conexion,$limit=null,$categoria=null,$busqueda = null){
   $sql = 'SELECT e.*, c.nombre AS "categoria" FROM entradas e 
        INNER JOIN categorias c ON e.categoria_id = c.id';
        
    //concatenamos a la consulta "inicial" la categoria que recibe por URL
    if(!empty($categoria)){
  
        $sql .=' WHERE e.categoria_id ='.$categoria;
    }

    if(!empty($busqueda)){
        $sql .=" WHERE e.titulo LIKE '%$busqueda%' ";
    }

    $sql .= ' ORDER BY e.id ';

    if($limit){
        $sql .="LIMIT 4";
    }
    

    $entradas  = mysqli_query($conexion,$sql);


    
    
    $resultado = array();
    if($entradas && mysqli_num_rows($entradas)>=1){
        $resultado=$entradas;
    }
    
    return $resultado;
}

function conseguirEntrada($conexion,$id){
    /*$sql ='SELECT e.*, c.nombre AS "categoria" FROM entradas e
            INNER JOIN categorias c ON e.categoria_id = c.id
            WHERE e.id ='.$id;*/

        $sql ='SELECT e.*, c.nombre AS "categoria", CONCAT(u.nombre," ",u.apellidos) AS "usuario" FROM entradas e
        INNER JOIN categorias c ON e.categoria_id = c.id
        INNER JOIN usuarios u ON e.usuario_id = u.id
        WHERE e.id ='.$id;
    


    $entrada = mysqli_query($conexion,$sql);
 
    $resultado = array();

    if($entrada && mysqli_num_rows($entrada)>=1){
        $resultado = mysqli_fetch_assoc($entrada);
    }

    return $resultado;

 }
 
 






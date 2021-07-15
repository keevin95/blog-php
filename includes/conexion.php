<?php

$server = 'localhost';
$usuario = 'root';
$password = '';
$baseDeDatos = 'blog_master';

$db = mysqli_connect($server,$usuario,$password,$baseDeDatos);

/*Cuando la informacion traiga un caracter "especial" lo arrojara correctamente*/ 
mysqli_query($db,"SET NAMES 'utf8'"); 


//inciar sesion

if(!isset($_SESSION)){
    session_start();
}

?>


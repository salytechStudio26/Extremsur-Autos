<?php
$servidor = "localhost";
$usuario = "root";
$clave = "";
$baseDato ="concesionario";

$conexion = new mysqli($servidor, $usuario, $clave, $baseDato);

if($conexion ->connect_error){
    die("Error de conexion". $conexion->connect_error);
}

// Si quieres comprobar que funciona:
//echo "Conexión exitosa";


?>
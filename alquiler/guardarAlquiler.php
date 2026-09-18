<?php
include "../conexion/conexion.php";

$idCatalogo      = $_POST['idCatalogo'];
$nombre          = $_POST['nombre'];
$direccion       = $_POST['direccion'];
$dniCif          = $_POST['dniCif'];
$telefono        = $_POST['telefono'];
$correo          = $_POST['correo'];
$carnetConducir  = $_POST['carnetConducir'];
$tipoPago        = $_POST['tipoPago'];
$fechaInicial    = $_POST['fechaInicial'];
$fechaFinal      = $_POST['fechaFinal'];
$diasTotales     = $_POST['diasTotales'];
$precio          = $_POST['precio'];
$fianza          = $_POST['fianza'];
$totalAPagar     = $_POST['totalAPagar'];
$observaciones   = $_POST['observaciones'];

$sql = "INSERT INTO alquiler 
        (idCatalogo, nombre, direccion, dniCif, telefono, correo, carnetConducir,
         tipoPago, fechaInicial, fechaFinal, diasTotales, precio, fianza, totalApagar, observaciones)
        VALUES 
        ('$idCatalogo', '$nombre', '$direccion', '$dniCif', '$telefono', '$correo', '$carnetConducir',
         '$tipoPago', '$fechaInicial', '$fechaFinal', '$diasTotales', '$precio', '$fianza', '$totalAPagar', '$observaciones')";

if ($conexion->query($sql)) {
    echo $conexion->insert_id;
} else {
    echo "ERROR: " . $conexion->error;
}
?>
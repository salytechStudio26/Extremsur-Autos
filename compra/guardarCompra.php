<?php
require_once "../conexion/conexion.php";

// ===============================
// 1. RECOGER DATOS DEL FORMULARIO
// ===============================

$idTipoVehiculo   = $_POST['idTipoVehiculo'];
$Fecha            = $_POST['Fecha'];
$nombre           = $_POST['nombre'];
$Apellidos        = $_POST['Apellidos'];
$Direccion        = $_POST['Dirección'];
$CP               = $_POST['CP'];
$localidad        = $_POST['localidad'];
$provincia        = $_POST['provincia'];
$telefono         = $_POST['telefono'];
$correo           = $_POST['correo'];
$anioFabricacion  = $_POST['añoFabricacion'];
$marca            = $_POST['marca'];
$modelo           = $_POST['modelo'];
$observaciones    = $_POST['observaciones'];

// ===============================
// 2. INSERTAR EN LA BASE DE DATOS
// ===============================

$sql = "INSERT INTO compra 
(idTipoVehiculo, Fecha, nombre, Apellidos, Dirección, CP, localidad, provincia, telefono, correo, añoFabricacion, marca, modelo, observaciones)
VALUES
('$idTipoVehiculo', '$Fecha', '$nombre', '$Apellidos', '$Direccion', '$CP', '$localidad', '$provincia', '$telefono', '$correo', '$anioFabricacion', '$marca', '$modelo', '$observaciones')";

if ($conexion->query($sql)) {

    // ID de la compra recién creada
    $idCompra = $conexion->insert_id;

    // REDIRECCIÓN DIRECTA AL PDF
    header("Location: generarTicketCompra.php?idCompra=$idCompra");
    exit;

} else {
    echo "Error al guardar la compra: " . $conexion->error;
}
?>

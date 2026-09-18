<?php
require_once "../conexion/conexion.php";

// ===============================
// 1. RECOGER DATOS DEL FORMULARIO
// ===============================

$idTipoVehiculo = $_POST['idTipoVehiculo'];   // INT (FK)
$Fecha          = $_POST['Fecha'];
$nombre         = $_POST['nombre'];
$Apellidos      = $_POST['Apellidos'];
$telefono       = $_POST['telefono'];
$correo         = $_POST['correo'];
$FechaCita      = $_POST['FechaCita'];
$HoraCita       = $_POST['HoraCita'];
$Marca          = $_POST['Marca'];
$Modelo         = $_POST['Modelo'];
$Descripcion    = $_POST['Descripcion'];

// ===============================
// 2. INSERTAR EN LA BASE DE DATOS
// ===============================

$sql = "INSERT INTO taller 
(idTipoVehiculo, Fecha, nombre, Apellidos, telefono, correo, FechaCita, HoraCita, Marca, Modelo, Descripcion)
VALUES
('$idTipoVehiculo', '$Fecha', '$nombre', '$Apellidos', '$telefono', '$correo', '$FechaCita', '$HoraCita', '$Marca', '$Modelo', '$Descripcion')";

if ($conexion->query($sql)) {

    // ID del taller recién creado
    $idTaller = $conexion->insert_id;

    // REDIRECCIÓN DIRECTA AL PDF
    header("Location: generarTicketPDF.php?idTaller=$idTaller");
    exit;

} else {
    echo "Error al guardar la cita de taller: " . $conexion->error;
}
?>

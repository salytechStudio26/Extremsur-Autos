<?php
include "../conexion/conexion.php";

$marca = $_GET['marca'];
$modelo = $_GET['modelo'];

$sql = "SELECT c.idCatalogo, c.precio, t.fianza
        FROM catalogo c
        INNER JOIN tipovehiculo t ON c.idTipoVehiculo = t.idTipoVehiculo
        WHERE c.marca='$marca'
        AND c.modelo='$modelo'
        AND c.tipo='Alquiler'
        LIMIT 1";

$result = $conexion->query($sql);
$data = $result->fetch_assoc();

echo json_encode($data);
?>

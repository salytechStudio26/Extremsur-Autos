<?php
include "../conexion/conexion.php";

$marca = $_GET['marca'];
$modelo = $_GET['modelo'];

$sql = "SELECT idCatalogo, precio, idTipoVehiculo, tipo
        FROM catalogo
        WHERE marca='$marca' AND modelo='$modelo'
        LIMIT 1";

$result = $conexion->query($sql);
$data = $result->fetch_assoc();

$respuesta = [
    "idCatalogo" => $data["idCatalogo"],
    "idTipoVehiculo" => $data["idTipoVehiculo"],
    "tipo" => $data["tipo"],
    "precio" => ($data["tipo"] === "Venta") ? $data["precio"] : ""
];

echo json_encode($respuesta);
?>

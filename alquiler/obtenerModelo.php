<?php
include "../conexion/conexion.php";

$marca = $_GET['marca'];

$sql = "SELECT modelo 
        FROM catalogo 
        WHERE marca='$marca' 
        AND tipo='Alquiler'
        ORDER BY modelo ASC";

$result = $conexion->query($sql);

$modelos = [];

while ($row = $result->fetch_assoc()) {
    $modelos[] = ["modelo" => $row["modelo"]];
}

echo json_encode($modelos);
?>

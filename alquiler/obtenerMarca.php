<?php
include "../conexion/conexion.php";

$sql = "SELECT DISTINCT marca 
        FROM catalogo 
        WHERE tipo = 'Alquiler'
        ORDER BY marca ASC";

$result = $conexion->query($sql);

$marcas = [];

while ($row = $result->fetch_assoc()) {
    $marcas[] = ["marca" => $row["marca"]];
}

echo json_encode($marcas);
?>

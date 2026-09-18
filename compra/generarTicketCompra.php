<?php
require_once "../conexion/conexion.php";
require_once "../librerias/fpdf19/fpdf.php";

// Función para convertir UTF‑8 a ISO‑8859‑1 sin avisos
function txt($cadena) {
    return iconv("UTF-8", "ISO-8859-1//TRANSLIT", $cadena);
}

// ------------------------------------------------------------
// 1. RECIBIR ID DE COMPRA
// ------------------------------------------------------------
$idCompra = $_GET['idCompra'];

// ------------------------------------------------------------
// 2. OBTENER DATOS DE LA COMPRA
// ------------------------------------------------------------
$sql = "SELECT * FROM compra WHERE idCompra = $idCompra";
$result = $conexion->query($sql);
$compra = $result->fetch_assoc();

// ------------------------------------------------------------
// 3. OBTENER TEXTO DEL TIPO DE VEHÍCULO
// ------------------------------------------------------------
$idTipoVehiculo = $compra['idTipoVehiculo'];

$sqlTipo = "SELECT tipo FROM tipovehiculo WHERE idTipoVehiculo = $idTipoVehiculo";
$resultTipo = $conexion->query($sqlTipo);
$tipoVehiculoTexto = $resultTipo->fetch_assoc()['tipo'];

// ------------------------------------------------------------
// 4. CREAR PDF
// ------------------------------------------------------------
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont("Arial", "", 12);

$pdf->Cell(0, 10, txt("EXTREMSUR AUTOS - Ticket de Compra"), 0, 1, "C");
$pdf->Ln(5);

$pdf->Cell(0, 8, txt("Compra Nº: " . $compra['idCompra']), 0, 1);
$pdf->Cell(0, 8, txt("Fecha: " . $compra['Fecha']), 0, 1);
$pdf->Ln(5);

// ------------------------------------------------------------
// DATOS DEL CLIENTE
// ------------------------------------------------------------
$pdf->SetFont("Arial", "B", 12);
$pdf->Cell(0, 8, txt("Datos del Cliente:"), 0, 1);
$pdf->SetFont("Arial", "", 12);

$pdf->Cell(0, 8, txt("Nombre: " . $compra['nombre']), 0, 1);
$pdf->Cell(0, 8, txt("Apellidos: " . $compra['Apellidos']), 0, 1);
$pdf->Cell(0, 8, txt("Dirección: " . $compra['Dirección']), 0, 1);
$pdf->Cell(0, 8, txt("CP: " . $compra['CP']), 0, 1);
$pdf->Cell(0, 8, txt("Localidad: " . $compra['localidad']), 0, 1);
$pdf->Cell(0, 8, txt("Provincia: " . $compra['provincia']), 0, 1);
$pdf->Cell(0, 8, txt("Teléfono: " . $compra['telefono']), 0, 1);
$pdf->Cell(0, 8, txt("Correo: " . $compra['correo']), 0, 1);
$pdf->Ln(5);

// ------------------------------------------------------------
// DATOS DEL VEHÍCULO
// ------------------------------------------------------------
$pdf->SetFont("Arial", "B", 12);
$pdf->Cell(0, 8, txt("Datos del Vehículo:"), 0, 1);
$pdf->SetFont("Arial", "", 12);

$pdf->Cell(0, 8, txt("Tipo: " . $tipoVehiculoTexto), 0, 1);
$pdf->Cell(0, 8, txt("Marca: " . $compra['marca']), 0, 1);
$pdf->Cell(0, 8, txt("Modelo: " . $compra['modelo']), 0, 1);
$pdf->Cell(0, 8, txt("Año de fabricación: " . $compra['añoFabricacion']), 0, 1);
$pdf->Ln(5);

// ------------------------------------------------------------
// OBSERVACIONES
// ------------------------------------------------------------
$pdf->SetFont("Arial", "B", 12);
$pdf->Cell(0, 8, txt("Observaciones:"), 0, 1);
$pdf->SetFont("Arial", "", 12);
$pdf->MultiCell(0, 8, txt($compra['observaciones']));
$pdf->Ln(10);

// ------------------------------------------------------------
// DESCARGAR PDF
// ------------------------------------------------------------
$pdf->Output("D", "ticket_compra_" . $compra['idCompra'] . ".pdf");
exit;
?>

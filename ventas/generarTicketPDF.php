<?php
// ============================================================
// GENERAR PDF DEL TICKET DE VENTA
// ============================================================

// RUTAS CORRECTAS
require_once "../conexion/conexion.php";
require_once "../librerias/fpdf19/fpdf.php";

// ------------------------------------------------------------
// 1. VALIDAR ID DE VENTA
// ------------------------------------------------------------
if (!isset($_GET['idVenta']) || empty($_GET['idVenta'])) {
    die("ERROR: No se recibió el ID de la venta.");
}

$idVenta = intval($_GET['idVenta']); // seguridad

// ------------------------------------------------------------
// 2. OBTENER DATOS DE LA VENTA
// ------------------------------------------------------------
$sql = "SELECT * FROM ventas WHERE idVentas = $idVenta";
$result = $conexion->query($sql);

if (!$result || $result->num_rows === 0) {
    die("ERROR: No se encontró la venta con ID $idVenta.");
}

$venta = $result->fetch_assoc();

// ------------------------------------------------------------
// 3. CREAR PDF
// ------------------------------------------------------------
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont("Arial", "", 12);

// TÍTULO
$pdf->Cell(0, 10, "EXTREMSUR AUTOS - Ticket de Venta", 0, 1, "C");
$pdf->Ln(5);

// DATOS PRINCIPALES
$pdf->Cell(0, 8, "Venta Nº: " . $venta['idVentas'], 0, 1);
$pdf->Cell(0, 8, "Fecha: " . $venta['fechaVenta'], 0, 1);
$pdf->Ln(5);

// DATOS DEL CLIENTE
$pdf->SetFont("Arial", "B", 12);
$pdf->Cell(0, 8, "Datos del Cliente:", 0, 1);
$pdf->SetFont("Arial", "", 12);

$pdf->Cell(0, 8, "Nombre: " . $venta['nombre'], 0, 1);
$pdf->Cell(0, 8, "Direccion: " . $venta['direccion'], 0, 1);
$pdf->Cell(0, 8, "DNI/CIF: " . $venta['dniCif'], 0, 1);
$pdf->Cell(0, 8, "Telefono: " . $venta['telefono'], 0, 1);
$pdf->Cell(0, 8, "Correo: " . $venta['correo'], 0, 1);
$pdf->Cell(0, 8, "Carnet: " . $venta['carnetConducir'], 0, 1);
$pdf->Ln(5);

// DATOS DEL VEHÍCULO Y PAGO
$pdf->SetFont("Arial", "B", 12);
$pdf->Cell(0, 8, "Datos del Vehiculo y Pago:", 0, 1);
$pdf->SetFont("Arial", "", 12);

$pdf->Cell(0, 8, "ID Catalogo: " . $venta['idCatalogo'], 0, 1);
$pdf->Cell(0, 8, "Tipo de pago: " . $venta['tipoPago'], 0, 1);
$pdf->Cell(0, 8, "Precio: " . number_format($venta['precio'], 2) . " €", 0, 1);
$pdf->Cell(0, 8, "Cuota: " . number_format($venta['cuota'], 2) . " €", 0, 1);
$pdf->Cell(0, 8, "Precio final: " . number_format($venta['precioFinal'], 2) . " €", 0, 1);
$pdf->Ln(5);

// OBSERVACIONES
$pdf->SetFont("Arial", "B", 12);
$pdf->Cell(0, 8, "Observaciones:", 0, 1);
$pdf->SetFont("Arial", "", 12);
$pdf->MultiCell(0, 8, $venta['observaciones']);
$pdf->Ln(10);

// ------------------------------------------------------------
// 4. INSERTAR QR
// ------------------------------------------------------------
$qrRuta = "../imagenes/qr_venta_" . $venta['idVentas'] . ".png";

if (file_exists($qrRuta)) {
    $pdf->Image($qrRuta, 10, $pdf->GetY(), 40, 40);
}

// ------------------------------------------------------------
// 5. DESCARGAR PDF
// ------------------------------------------------------------
$pdf->Output("D", "ticket_venta_" . $venta['idVentas'] . ".pdf");
exit;
?>

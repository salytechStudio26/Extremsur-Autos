<?php
require_once "../conexion/conexion.php";
require_once "../librerias/fpdf19/fpdf.php";

// Función para convertir UTF‑8 a ISO‑8859‑1 sin avisos
function txt($cadena) {
    return iconv("UTF-8", "ISO-8859-1//TRANSLIT", $cadena);
}

// ------------------------------------------------------------
// 1. RECIBIR ID DE ALQUILER
// ------------------------------------------------------------
$idAlquiler = $_GET['idAlquiler'];

// ------------------------------------------------------------
// 2. OBTENER DATOS DEL ALQUILER
// ------------------------------------------------------------
$sql = "SELECT * FROM alquiler WHERE idAlquiler = $idAlquiler";
$result = $conexion->query($sql);
$alquiler = $result->fetch_assoc();

// ------------------------------------------------------------
// 3. OBTENER DATOS DEL VEHÍCULO (catalogo)
// ------------------------------------------------------------
$idCatalogo = $alquiler['idCatalogo'];

$sqlVehiculo = "SELECT marca, modelo, idTipoVehiculo
                FROM catalogo
                WHERE idCatalogo = $idCatalogo";

$resultVehiculo = $conexion->query($sqlVehiculo);
$vehiculo = $resultVehiculo->fetch_assoc();

// ------------------------------------------------------------
// 4. OBTENER TEXTO DEL TIPO DE VEHÍCULO
// ------------------------------------------------------------
$idTipoVehiculo = $vehiculo['idTipoVehiculo'];

$sqlTipo = "SELECT tipo FROM tipovehiculo WHERE idTipoVehiculo = $idTipoVehiculo";
$resultTipo = $conexion->query($sqlTipo);
$tipoVehiculoTexto = $resultTipo->fetch_assoc()['tipo'];

// ------------------------------------------------------------
// 5. CREAR PDF
// ------------------------------------------------------------
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont("Arial", "", 12);

$pdf->Cell(0, 10, txt("EXTREMSUR AUTOS - Ticket de Alquiler"), 0, 1, "C");
$pdf->Ln(5);

$pdf->Cell(0, 8, txt("Alquiler Nº: " . $alquiler['idAlquiler']), 0, 1);
$pdf->Cell(0, 8, txt("Fecha inicial: " . $alquiler['fechaInicial']), 0, 1);
$pdf->Cell(0, 8, txt("Fecha final: " . $alquiler['fechaFinal']), 0, 1);
$pdf->Ln(5);

$pdf->SetFont("Arial", "B", 12);
$pdf->Cell(0, 8, txt("Datos del Cliente:"), 0, 1);
$pdf->SetFont("Arial", "", 12);

$pdf->Cell(0, 8, txt("Nombre: " . $alquiler['nombre']), 0, 1);
$pdf->Cell(0, 8, txt("Direccion: " . $alquiler['direccion']), 0, 1);
$pdf->Cell(0, 8, txt("DNI/CIF: " . $alquiler['dniCif']), 0, 1);
$pdf->Cell(0, 8, txt("Telefono: " . $alquiler['telefono']), 0, 1);
$pdf->Cell(0, 8, txt("Correo: " . $alquiler['correo']), 0, 1);
$pdf->Cell(0, 8, txt("Carnet: " . $alquiler['carnetConducir']), 0, 1);
$pdf->Ln(5);

$pdf->SetFont("Arial", "B", 12);
$pdf->Cell(0, 8, txt("Datos del Vehiculo:"), 0, 1);
$pdf->SetFont("Arial", "", 12);

$pdf->Cell(0, 8, txt("Marca: " . $vehiculo['marca']), 0, 1);
$pdf->Cell(0, 8, txt("Modelo: " . $vehiculo['modelo']), 0, 1);
$pdf->Cell(0, 8, txt("Tipo: " . $tipoVehiculoTexto), 0, 1);
$pdf->Ln(5);

$pdf->SetFont("Arial", "B", 12);
$pdf->Cell(0, 8, txt("Detalles del Alquiler:"), 0, 1);
$pdf->SetFont("Arial", "", 12);

$pdf->Cell(0, 8, txt("Dias totales: " . $alquiler['diasTotales']), 0, 1);
$pdf->Cell(0, 8, txt("Precio por dia: " . number_format($alquiler['precio'], 2) . " €"), 0, 1);
$pdf->Cell(0, 8, txt("Fianza: " . number_format($alquiler['fianza'], 2) . " €"), 0, 1);
$pdf->Cell(0, 8, txt("Total a pagar: " . number_format($alquiler['totalApagar'], 2) . " €"), 0, 1);
$pdf->Cell(0, 8, txt("Tipo de pago: " . $alquiler['tipoPago']), 0, 1);
$pdf->Ln(5);

$pdf->SetFont("Arial", "B", 12);
$pdf->Cell(0, 8, txt("Observaciones:"), 0, 1);
$pdf->SetFont("Arial", "", 12);
$pdf->MultiCell(0, 8, txt($alquiler['observaciones']));
$pdf->Ln(10);

// ------------------------------------------------------------
// 6. QR (opcional)
// ------------------------------------------------------------
$qrRuta = "../imagenes/qr_alquiler_" . $alquiler['idAlquiler'] . ".png";

if (file_exists($qrRuta)) {
    $pdf->Image($qrRuta, 10, $pdf->GetY(), 40, 40);
}

// ------------------------------------------------------------
// 7. DESCARGAR PDF
// ------------------------------------------------------------
$pdf->Output("D", "ticket_alquiler_" . $alquiler['idAlquiler'] . ".pdf");
exit;
?>

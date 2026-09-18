<?php
require_once "../conexion/conexion.php";
require_once "../librerias/fpdf19/fpdf.php";

// Función para convertir UTF‑8 a ISO‑8859‑1 sin avisos
function txt($cadena) {
    return iconv("UTF-8", "ISO-8859-1//TRANSLIT", $cadena);
}

// ------------------------------------------------------------
// 1. RECIBIR ID DE TALLER
// ------------------------------------------------------------
$idTaller = $_GET['idTaller'];

// ------------------------------------------------------------
// 2. OBTENER DATOS DEL REGISTRO DE TALLER
// ------------------------------------------------------------
$sql = "SELECT * FROM taller WHERE idTaller = $idTaller";
$result = $conexion->query($sql);
$taller = $result->fetch_assoc();

// ------------------------------------------------------------
// 3. OBTENER TEXTO DEL TIPO DE VEHÍCULO
// ------------------------------------------------------------
$idTipoVehiculo = $taller['idTipoVehiculo'];

$sqlTipo = "SELECT tipo FROM tipovehiculo WHERE idTipoVehiculo = $idTipoVehiculo";
$resultTipo = $conexion->query($sqlTipo);
$tipoVehiculoTexto = $resultTipo->fetch_assoc()['tipo'];

// ------------------------------------------------------------
// 4. CREAR PDF
// ------------------------------------------------------------
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont("Arial", "", 12);

$pdf->Cell(0, 10, txt("EXTREMSUR AUTOS - Cita de Taller"), 0, 1, "C");
$pdf->Ln(5);

$pdf->Cell(0, 8, txt("Cita Nº: " . $taller['idTaller']), 0, 1);
$pdf->Cell(0, 8, txt("Fecha de registro: " . $taller['Fecha']), 0, 1);
$pdf->Ln(5);

// ------------------------------------------------------------
// DATOS DEL CLIENTE
// ------------------------------------------------------------
$pdf->SetFont("Arial", "B", 12);
$pdf->Cell(0, 8, txt("Datos del Cliente:"), 0, 1);
$pdf->SetFont("Arial", "", 12);

$pdf->Cell(0, 8, txt("Nombre: " . $taller['nombre']), 0, 1);
$pdf->Cell(0, 8, txt("Apellidos: " . $taller['Apellidos']), 0, 1);
$pdf->Cell(0, 8, txt("Teléfono: " . $taller['telefono']), 0, 1);
$pdf->Cell(0, 8, txt("Correo: " . $taller['correo']), 0, 1);
$pdf->Ln(5);

// ------------------------------------------------------------
// DATOS DE LA CITA
// ------------------------------------------------------------
$pdf->SetFont("Arial", "B", 12);
$pdf->Cell(0, 8, txt("Detalles de la Cita:"), 0, 1);
$pdf->SetFont("Arial", "", 12);

$pdf->Cell(0, 8, txt("Fecha de la cita: " . $taller['FechaCita']), 0, 1);
$pdf->Cell(0, 8, txt("Hora de la cita: " . $taller['HoraCita']), 0, 1);
$pdf->Ln(5);

// ------------------------------------------------------------
// DATOS DEL VEHÍCULO
// ------------------------------------------------------------
$pdf->SetFont("Arial", "B", 12);
$pdf->Cell(0, 8, txt("Datos del Vehículo:"), 0, 1);
$pdf->SetFont("Arial", "", 12);

$pdf->Cell(0, 8, txt("Tipo: " . $tipoVehiculoTexto), 0, 1);
$pdf->Cell(0, 8, txt("Marca: " . $taller['Marca']), 0, 1);
$pdf->Cell(0, 8, txt("Modelo: " . $taller['Modelo']), 0, 1);
$pdf->Ln(5);

// ------------------------------------------------------------
// DESCRIPCIÓN DEL PROBLEMA
// ------------------------------------------------------------
$pdf->SetFont("Arial", "B", 12);
$pdf->Cell(0, 8, txt("Descripción del problema:"), 0, 1);
$pdf->SetFont("Arial", "", 12);
$pdf->MultiCell(0, 8, txt($taller['Descripcion']));
$pdf->Ln(10);

// ------------------------------------------------------------
// DESCARGAR PDF
// ------------------------------------------------------------
$pdf->Output("D", "taller_" . $taller['idTaller'] . ".pdf");
exit;
?>

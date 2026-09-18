<?php
// ============================================================
// GUARDAR VENTA EN LA BASE DE DATOS
// ============================================================

require_once "../conexion/conexion.php";
require_once "../librerias/phpqrcode/qrlib.php";

// ------------------------------------------------------------
// 1. RECIBIR DATOS DEL FORMULARIO
// ------------------------------------------------------------

$fechaVenta     = $_POST['fechaVenta'];
$idClienteTipo  = $_POST['idClienteTipo'];
$nombre         = $_POST['nombre'];
$direccion      = $_POST['direccion'];
$dniCif         = $_POST['dniCif'];
$telefono       = $_POST['telefono'];
$correo         = $_POST['correo'];
$carnet         = $_POST['carnetConducir'];

$idCatalogo     = $_POST['idCatalogo'];
$tipoPago       = $_POST['tipoPago'];
$precio         = $_POST['precio'];
$cuota          = $_POST['cuota'];
$precioFinal    = $_POST['precioFinal'];

$observaciones  = $_POST['observaciones'];

// ------------------------------------------------------------
// 2. INSERTAR VENTA EN LA BD
// ------------------------------------------------------------

$sql = "INSERT INTO ventas 
        (fechaVenta, idClienteTipo, nombre, direccion, dniCif, telefono, correo, carnetConducir,
         idCatalogo, tipoPago, precio, cuota, precioFinal, observaciones)
        VALUES
        ('$fechaVenta', '$idClienteTipo', '$nombre', '$direccion', '$dniCif', '$telefono', '$correo', '$carnet',
         '$idCatalogo', '$tipoPago', '$precio', '$cuota', '$precioFinal', '$observaciones')";

if ($conexion->query($sql) === TRUE) {

    // ------------------------------------------------------------
    // 3. OBTENER ID DE LA VENTA GENERADO POR AUTO_INCREMENT
    // ------------------------------------------------------------
    $idVenta = $conexion->insert_id;

    // ------------------------------------------------------------
    // 4. GENERAR QR
    // ------------------------------------------------------------
    $qrTexto = "Venta Nº: $idVenta\nCliente: $nombre\nPago: $tipoPago\nPrecio Final: $precioFinal €";
    $qrRuta = "../imagenes/qr_venta_" . $idVenta . ".png";

    QRcode::png($qrTexto, $qrRuta, QR_ECLEVEL_L, 4);

    // ------------------------------------------------------------
    // 5. REDIRIGIR AL PDF
    // ------------------------------------------------------------
    header("Location: generarTicketPDF.php?idVenta=$idVenta");
    exit;

} else {
    echo "ERROR al guardar la venta: " . $conexion->error;
}

?>

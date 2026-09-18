<?php
// panelCuotas.php
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Simulador de Cuotas</title>

    <!-- Estilos globales -->
    <link rel="stylesheet" href="./ventas.css">
</head>

<body>

<!-- CONTENEDOR PRINCIPAL CON LA CLASE CORRECTA -->
<div class="panelCuotas">

    <h2>Simulador de Cuotas</h2>

    <!-- ============================================================
         REQUISITOS MÍNIMOS
    ============================================================ -->
    <div class="bloque-requisitos">
        <h3>Requisitos mínimos</h3>

        <p><strong>Renting particulares:</strong></p>
        <ul>
            <li>Salario ≥ 1500 €</li>
            <li>Antigüedad laboral ≥ 2 años</li>
            <li>Antigüedad carnet ≥ 2 años</li>
            <li>Vehículos ≥ 20.000 €</li>
            <li>Las motos no entran en renting</li>
            <li>Sin interés, 48 cuotas</li>
        </ul>

        <p><strong>Renting empresas:</strong></p>
        <ul>
            <li>Ingresos ≥ 30.000 €</li>
            <li>Antigüedad actividad ≥ 2 años</li>
            <li>Antigüedad carnet ≥ 2 años</li>
            <li>Vehículos ≥ 20.000 €</li>
            <li>Las motos no entran en renting</li>
            <li>Sin interés, 60 cuotas</li>
        </ul>

        <p><strong>Financiación particulares:</strong></p>
        <ul>
            <li>Salario ≥ 1100 €</li>
            <li>Antigüedad laboral ≥ 2 años</li>
            <li>Antigüedad carnet ≥ 2 años</li>
            <li>Interés 4.5%</li>
            <li>Cuotas: 36, 48, 60, 72, 84</li>
        </ul>

        <p><strong>Financiación empresas:</strong></p>
        <ul>
            <li>Ingresos ≥ 20.000 €</li>
            <li>Antigüedad actividad ≥ 2 años</li>
            <li>Antigüedad carnet ≥ 2 años</li>
            <li>Interés 6.5%</li>
            <li>Cuotas: 36, 48, 60, 72, 84</li>
        </ul>
    </div>

    <!-- ============================================================
         NOTA IMPORTANTE
    ============================================================ -->
    <div class="bloque-nota">
        <strong>NOTA IMPORTANTE:</strong><br>
        En caso de que su cuota salga aceptada, la última palabra la tiene el concesionario, ya que deberá presentar la documentación pertinente.<br>
        Tanto para Renting como para Financiación, el cliente debe recoger el vehículo en el concesionario más cercano.
    </div>

    <!-- ============================================================
         FORMULARIO DE SIMULACIÓN
    ============================================================ -->
    <div class="bloque-formulario">

        <label>Precio del vehículo (€)</label>
        <input type="number" id="precioVehiculo" readonly>

        <label>Tipo de cliente</label>
        <select id="tipoCliente">
            <option value="">Seleccione...</option>
            <option value="particular">Particular</option>
            <option value="empresa">Empresa</option>
        </select>

        <label>Tipo de pago</label>
        <select id="tipoPagoCuota">
            <option value="">Seleccione...</option>
            <option value="renting">Renting</option>
            <option value="financiacion">Financiación</option>
        </select>

        <!-- CAMPOS DINÁMICOS -->
        <div id="camposDinamicos"></div>

        <!-- BOTONES -->
        <div class="botones-cuotas">
            <button id="btnCalcular">Calcular cuota</button>
            <button id="btnAceptar">Aceptar</button>
            <button id="btnCancelar">Cancelar</button>
        </div>

        <!-- RESULTADO -->
        <div id="resultadoCuota"></div>

    </div>

</div>

<!-- Lógica del panel -->
<script src="panelCuotas.js" defer></script>

</body>
</html>

<?php
include '../conexion/conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas</title>

    <link rel="stylesheet" href="../inicio/estilo.css">
    <link rel="stylesheet" href="ventas.css">
</head>

<body>

<header class="cabecera">
    <div class="zonaSuperior"></div>

    <img src="../imagenes/LOGOTIPO Y ESLOGA.png" alt="logo">
    <h1>EXTREMSUR AUTOS</h1>

   <div class="barraNavegacion">
            <nav class="navbar">
                <ul>
                    <li><a href="../inicio/index.html">Inicio</a></li>
                    <li><a href="../catalogo/catalogo.php">Catálogo</a></li>
                    <li><a href="../ventas/ventas.php">Ventas</a></li>
                    <li><a href="../alquiler/alquiler.php">Alquiler</a></li>
                    <li><a href="../compra/compra.php">Compra</a></li>
                    <li><a href="../taller/taller.php">Taller</a></li>
                    <li><a href="../localizacion/localizacion.php">Localización</a></li>
                    <li><a href="../contacto/contacto.php">Contacto</a></li>
                </ul>
            </nav>
        </div>

</header>

<main class="contenido">

    <h2 class="tituloVentas">Formulario de Ventas</h2>

    <!-- FORMULARIO REAL -->
    <form action="guardarVentas.php" method="POST" id="formVentas">

        <!-- BLOQUE I: FECHA -->
        <div class="fecha">
            <label for="fechaVenta">Fecha</label>
            <input type="date" name="fechaVenta" id="fechaVenta" required>
        </div>

        <!-- BLOQUE II: DATOS PERSONALES -->
        <div class="datosPersonales">

            <label for="tipoClientes">Tipo cliente</label>
            <select id="tipoClientes" required>
                <option value="">Selecciona una opción</option>
                <option value="particular">Particular</option>
                <option value="empresa">Empresa</option>
            </select>

            <input type="hidden" name="idClienteTipo" id="idClienteTipo">

            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre" required>

            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" id="direccion" placeholder="Calle, número, ciudad" required>

            <label for="dnicif">DNI / CIF</label>
            <input type="text" name="dniCif" id="dnicif" placeholder="00000000X" required>

            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" id="telefono" placeholder="600100200" required>

            <label for="correo">Correo electrónico</label>
            <input type="email" name="correo" id="correo" placeholder="correo@ejemplo.com" required>

        </div>

        <!-- BLOQUE III: CARNET -->
        <div class="tipoCarnet">
            <label for="carnetConducir">Tipo carnet</label>
            <select name="carnetConducir" id="carnetConducir" required>
                <option value="">Selecciona una opción</option>
                <option value="A">A</option>
                <option value="A1">A1</option>
                <option value="A2">A2</option>
                <option value="B">B</option>
                <option value="BE">BE</option>
                <option value="C">C</option>
                <option value="C1">C1</option>
                <option value="C1E">C1E</option>
                <option value="CE">CE</option>
                <option value="D">D</option>
                <option value="D1">D1</option>
                <option value="D1E">D1E</option>
                <option value="DE">DE</option>
            </select>
        </div>

        <!-- BLOQUE IV: DATOS DEL VEHÍCULO -->
        <div class="datosVehiculos">

            <label for="marca">Marca</label>
            <select name="marcaVehiculo" id="marca" required></select>

            <label for="modelo">Modelo</label>
            <select name="modeloVehiculo" id="modelo" required></select>

            <label for="precio">Precio</label>
            <input type="text" name="precio" id="precio" placeholder="00.000 €" readonly required>

            <input type="hidden" name="idCatalogo" id="idCatalogo">

            <label for="tipoPago">Tipo pago</label>
            <select name="tipoPago" id="tipoPago" required>
                <option value="">Selecciona una opción</option>
                <option value="Contado">Contado</option>
                <option value="Transferencia">Transferencia</option>
                <option value="Financiado">Financiado</option>
                <option value="Renting">Renting</option>
            </select>

            <label for="cuota">Cuota</label>
            <input type="text" name="cuota" id="cuota" placeholder="000.00 €">

            <button type="button" id="btnCalcularCuota">Calcular cuota</button>

            <label for="precioFinal">Precio Final</label>
            <input type="text" name="precioFinal" id="precioFinal" placeholder="00000 €" required>

            <!-- OBSERVACIONES CORREGIDO (SELECT) -->
            <label for="observaciones">Observaciones</label>
            <select name="observaciones" id="observaciones" required>
                <option value="">Selecciona una opción</option>
            </select>

        </div>

        <button type="submit" class="btnGuardar">Guardar venta</button>

    </form>

</main>

<footer class="piePagina">
    <p>
        Extremsur Autos tiene sucursales en:
        Sevilla · Murcia · Alicante · Barcelona · Navarra · León · Cáceres · Mérida · Toledo · Madrid · Bilbao · Vigo
    </p>
</footer>

<!-- SCRIPTS CORRECTOS -->
<script src="./select.js"></script>
<script src="./ventas.js"></script>

</body>
</html>

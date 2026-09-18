<?php
include '../conexion/conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alquiler</title>

    <link rel="stylesheet" href="../inicio/estilo.css">
    <link rel="stylesheet" href="alquiler.css">
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

    <h2 class="tituloAlquiler">Formulario de alquiler de vehículos</h2>

    <form action="guardarAlquiler.php" method="POST" id="formAlquiler">

        <!-- idCatalogo (oculto) -->
        <input type="hidden" name="idCatalogo" id="idCatalogo">


        <!-- nombre -->
        <label>Nombre</label>
        <input type="text" name="nombre" id="nombre" required>

        <!-- direccion -->
        <label>Dirección</label>
        <input type="text" name="direccion" id="direccion" required>

        <!-- dniCif -->
        <label>DNI / CIF</label>
        <input type="text" name="dniCif" id="dniCif" required>

        <!-- telefono -->
        <label>Teléfono</label>
        <input type="text" name="telefono" id="telefono" required>

        <!-- correo -->
        <label>Correo electrónico</label>
        <input type="email" name="correo" id="correo" required>

        <!-- carnetConducir -->
        <label>Tipo carnet</label>
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
            <option value="Minusvalido">Minusválido</option>
        </select>

        <!-- BLOQUE: DATOS DEL VEHÍCULO -->
        <label for="marca">Marca</label>
        <select name="marcaVehiculo" id="marca" required>
            <option value="">Selecciona una opción</option>
        </select>

        <label for="modelo">Modelo</label>
        <select name="modeloVehiculo" id="modelo" required>
            <option value="">Selecciona una opción</option>
        </select>

        <!-- tipoPago -->
        <label>Tipo pago</label>
        <select name="tipoPago" id="tipoPago" required>
            <option value="">Selecciona una opción</option>
            <option value="Transferencia">Transferencia</option>
            <option value="Tarjeta">Tarjeta</option>
            <option value="Bizum">Bizum</option>
            <option value="Fraccionado">Fraccionado</option>
        </select>

        <!-- fechaInicial -->
        <label>Fecha inicial</label>
        <input type="date" name="fechaInicial" id="fechaInicial" required>

        <!-- fechaFinal -->
        <label>Fecha final</label>
        <input type="date" name="fechaFinal" id="fechaFinal" required>

        <!-- diasTotales -->
        <label>Días totales</label>
        <input type="number" name="diasTotales" id="diasTotales" readonly>

        <!-- precio -->
        <label>Precio por día (€)</label>
        <input type="number" step="0.01" name="precio" id="precio" readonly>

        <!-- fianza -->
        <label>Fianza (€)</label>
        <input type="number" step="0.01" name="fianza" id="fianza" readonly>

        <!-- totalAPagar -->
        <label>Total a pagar (€)</label>
        <input type="number" step="0.01" name="totalAPagar" id="totalAPagar" readonly>

        <!-- observaciones -->
        <label>Observaciones</label>
        <textarea name="observaciones" id="observaciones"></textarea>

        <button type="submit" class="btnGuardar">Guardar Alquiler</button>

    </form>

</main>

<footer class="piePagina">
    <p>
        Extremsur Autos tiene sucursales en:
        Sevilla · Murcia · Alicante · Barcelona · Navarra · León · Cáceres · Mérida · Toledo · Madrid · Bilbao · Vigo
    </p>
</footer>

<script src="./select.js"></script>
<script src="./alquiler.js"></script>

</body>
</html>

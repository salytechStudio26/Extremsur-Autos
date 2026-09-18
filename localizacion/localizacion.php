<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Localización - Extremsur Autos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS general -->
    <link rel="stylesheet" href="../inicio/estilo.css">

    <!-- Leaflet CSS (mapa) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <!-- CSS propio -->
    <link rel="stylesheet" href="localizacion.css">
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

    <h2 class="tituloLocalizacion">LOCALIZACIÓN DE CONCESIONARIOS</h2>

    <!-- FORMULARIO -->
    <section class="busquedaLocalizacion">
        <h3>Busca el concesionario más cercano</h3>

        <form id="formLocalizacion">
            <label for="localidad">Localidad</label>
            <input type="text" id="localidad" name="localidad" placeholder="Ej: Don Benito" required>

            <label for="provincia">Provincia</label>
            <input type="text" id="provincia" name="provincia" placeholder="Ej: Badajoz" required>

            <button type="submit" class="btnBuscar">Buscar concesionario</button>
        </form>

        <div id="resultadoConcesionario" class="resultadoConcesionario">
            <!-- Aquí aparecerá el concesionario más cercano -->
        </div>
    </section>

    <!-- MAPA -->
    <section class="mapaLocalizacion">
        <h3>Mapa de concesionarios</h3>
        <div id="map" style="width: 100%; height: 400px;"></div>
    </section>

</main>

<footer class="piePagina">
    <p>
        Extremsur Autos tiene sucursales en:
        Sevilla · Murcia · Alicante · Barcelona · Navarra · León · Cáceres · Mérida · Toledo · Madrid · Bilbao · Vigo
    </p>
</footer>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<!-- JS propio -->
<script src="localizacion.js"></script>

</body>
</html>

<?php
include '../conexion/conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra</title>

    <link rel="stylesheet" href="../inicio/estilo.css">
    <link rel="stylesheet" href="compra.css">
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

    <h2 class="tituloCompra">COMPRAMOS TU VEHÍCULO</h2>

    <form action="guardarCompra.php" method="POST" id="formCompra">

        <!-- Fecha -->
        <label>Fecha</label>
        <input type="date" name="Fecha" id="Fecha" required>

        <!-- Tipo de vehículo -->
        <label>Tipo de vehículo</label>
        <select name="idTipoVehiculo" id="idTipoVehiculo" required>
            <option value="">Selecciona una opción</option>

            <?php
            $sqlTipos = "SELECT * FROM tipovehiculo";
            $resultTipos = $conexion->query($sqlTipos);

            while ($row = $resultTipos->fetch_assoc()) {
                echo "<option value='".$row['idTipoVehiculo']."'>".$row['tipo']."</option>";
            }
            ?>
        </select>

        <!-- Nombre -->
        <label>Nombre</label>
        <input type="text" name="nombre" id="nombre" required>

        <!-- Apellidos -->
        <label>Apellidos</label>
        <input type="text" name="Apellidos" id="Apellidos" required>

        <!-- Dirección -->
        <label>Dirección</label>
        <input type="text" name="Dirección" id="Dirección" required>

        <!-- Código Postal -->
        <label>Código Postal</label>
        <input type="text" name="CP" id="CP" required>

        <!-- Localidad -->
        <label>Localidad</label>
        <input type="text" name="localidad" id="localidad" required>

        <!-- Provincia -->
        <label>Provincia</label>
        <input type="text" name="provincia" id="provincia" required>

        <!-- Teléfono -->
        <label>Teléfono</label>
        <input type="text" name="telefono" id="telefono" required>

        <!-- Correo -->
        <label>Correo electrónico</label>
        <input type="email" name="correo" id="correo" required>

        <!-- Año de fabricación -->
        <label>Año de fabricación</label>
        <input type="number" name="añoFabricacion" id="añoFabricacion" required>

        <!-- Marca -->
        <label>Marca</label>
        <input type="text" name="marca" id="marca" required>

        <!-- Modelo -->
        <label>Modelo</label>
        <input type="text" name="modelo" id="modelo" required>

        <!-- Observaciones -->
        <label>Observaciones</label>
        <textarea name="observaciones" id="observaciones"></textarea>

        <button type="submit" class="btnGuardar">Guardar compra</button>

    </form>

</main>

<footer class="piePagina">
    <p>
        Extremsur Autos tiene sucursales en:
        Sevilla · Murcia · Alicante · Barcelona · Navarra · León · Cáceres · Mérida · Toledo · Madrid · Bilbao · Vigo
    </p>
</footer>

<script src="./compra.js"></script>

</body>
</html>


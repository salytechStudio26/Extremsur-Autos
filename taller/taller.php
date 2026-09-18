<?php
include '../conexion/conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taller</title>

    <link rel="stylesheet" href="../inicio/estilo.css">
    <link rel="stylesheet" href="taller.css">
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
    
    <h2 class="tituloTaller">CITA PARA TALLER</h2>
    <img src="../imagenes/taller.png" alt="ventas">

    <form action="guardarTaller.php" method="POST" id="formTaller">

        <!-- FECHA DE REGISTRO -->
        <label for="Fecha">Fecha</label>
        <input type="date" name="Fecha" id="Fecha" required>

        <!-- TIPO DE VEHÍCULO -->
        <label for="idTipoVehiculo">Tipo de vehículo</label>
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

        <!-- NOMBRE -->
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" required>

        <!-- APELLIDOS -->
        <label for="Apellidos">Apellidos</label>
        <input type="text" name="Apellidos" id="Apellidos" required>

        <!-- TELÉFONO -->
        <label for="telefono">Teléfono</label>
        <input type="text" name="telefono" id="telefono" required>

        <!-- CORREO -->
        <label for="correo">Correo electrónico</label>
        <input type="email" name="correo" id="correo" required>

        <!-- FECHA CITA -->
        <label for="FechaCita">Fecha de la cita</label>
        <input type="date" name="FechaCita" id="FechaCita" required>

        <!-- HORA CITA -->
        <label for="HoraCita">Hora de la cita</label>
        <input type="time" name="HoraCita" id="HoraCita" required>

        <!-- MARCA -->
        <label for="Marca">Marca</label>
        <input type="text" name="Marca" id="Marca" required>

        <!-- MODELO -->
        <label for="Modelo">Modelo</label>
        <input type="text" name="Modelo" id="Modelo" required>

        <!-- DESCRIPCIÓN -->
        <label for="Descripcion">Descripción</label>
        <textarea name="Descripcion" id="Descripcion"></textarea>

        <button type="submit" class="btnGuardar">Guardar taller</button>

    </form>

</main>

<footer class="piePagina">
    <p>
        Extremsur Autos tiene sucursales en:
        Sevilla · Murcia · Alicante · Barcelona · Navarra · León · Cáceres · Mérida · Toledo · Madrid · Bilbao · Vigo
    </p>
</footer>

<script src="./taller.js"></script>

</body>
</html>

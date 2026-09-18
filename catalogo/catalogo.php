<?php
include '../conexion/conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo</title>
    <link rel="stylesheet" href="../inicio/estilo.css">
    <link rel="stylesheet" href="catalogo.css">
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

        <!-- COCHES -->
        <div class="coches">
            <h3>NUESTROS COCHES</h3>

            <?php
            $sql = "SELECT * FROM catalogo WHERE idTipoVehiculo = 1";
            $resultado = $conexion->query($sql);

            while ($fila = $resultado->fetch_assoc()) {
                echo '
                <div class="tarjetaVehiculo">
                    <img src="../' . $fila['imagen'] . '" alt="vehiculo">
                    <h4>' . $fila['marca'] . ' ' . $fila['modelo'] . '</h4>
                    <p><strong>Tipo:</strong> ' . $fila['tipo'] . '</p>
                    <p><strong>Precio:</strong> ' . $fila['precio'] . ' €</p>
                </div>
                ';
            }
            ?>
        </div>

        <!-- MOTOS -->
        <div class="motos">
            <h3>NUESTRAS MOTOS</h3>

            <?php
            $sql = "SELECT * FROM catalogo WHERE idTipoVehiculo = 2";
            $resultado = $conexion->query($sql);

            while ($fila = $resultado->fetch_assoc()) {
                echo '
                <div class="tarjetaVehiculo">
                    <img src="../' . $fila['imagen'] . '" alt="vehiculo">
                    <h4>' . $fila['marca'] . ' ' . $fila['modelo'] . '</h4>
                    <p><strong>Tipo:</strong> ' . $fila['tipo'] . '</p>
                    <p><strong>Precio:</strong> ' . $fila['precio'] . ' €</p>
                </div>
                ';
            }
            ?>
        </div>

        <!-- FURGONETAS -->
        <div class="furgonetas">
            <h3>NUESTRAS FURGONETAS</h3>

            <?php
            $sql = "SELECT * FROM catalogo WHERE idTipoVehiculo = 3";
            $resultado = $conexion->query($sql);

            while ($fila = $resultado->fetch_assoc()) {
                echo '
                <div class="tarjetaVehiculo">
                    <img src="../' . $fila['imagen'] . '" alt="vehiculo">
                    <h4>' . $fila['marca'] . ' ' . $fila['modelo'] . '</h4>
                    <p><strong>Tipo:</strong> ' . $fila['tipo'] . '</p>
                    <p><strong>Precio:</strong> ' . $fila['precio'] . ' €</p>
                </div>
                ';
            }
            ?>
        </div>

        <!-- CARAVANAS -->
        <div class="caravanas">
            <h3>NUESTRAS CARAVANAS, AUTOCARAVANAS Y CAMPERS</h3>

            <?php
            $sql = "SELECT * FROM catalogo WHERE idTipoVehiculo = 4";
            $resultado = $conexion->query($sql);

            while ($fila = $resultado->fetch_assoc()) {
                echo '
                <div class="tarjetaVehiculo">
                    <img src="../' . $fila['imagen'] . '" alt="vehiculo">
                    <h4>' . $fila['marca'] . ' ' . $fila['modelo'] . '</h4>
                    <p><strong>Tipo:</strong> ' . $fila['tipo'] . '</p>
                    <p><strong>Precio:</strong> ' . $fila['precio'] . ' €</p>
                </div>
                ';
            }
            ?>
        </div>

        <!-- MINUSVÁLIDOS -->
        <div class="minusvalidos">
            <h3>NUESTROS VEHÍCULOS PARA PERSONAS CON MOVILIDAD REDUCIDA</h3>

            <?php
            $sql = "SELECT * FROM catalogo WHERE idTipoVehiculo = 5";
            $resultado = $conexion->query($sql);

            while ($fila = $resultado->fetch_assoc()) {
                echo '
                <div class="tarjetaVehiculo">
                    <img src="../' . $fila['imagen'] . '" alt="vehiculo">
                    <h4>' . $fila['marca'] . ' ' . $fila['modelo'] . '</h4>
                    <p><strong>Tipo:</strong> ' . $fila['tipo'] . '</p>
                    <p><strong>Precio:</strong> ' . $fila['precio'] . ' €</p>
                </div>
                ';
            }
            ?>
        </div>

    </main>

    <footer class="piePagina">
        <p>
            Extremsur Autos tiene sucursales en las siguientes localidades:
            <br>
            Sevilla · Murcia · Alicante · Barcelona · Navarra · León · Cáceres · Mérida · Toledo · Madrid · Bilbao · Vigo
        </p>
    </footer>

</body>
</html>

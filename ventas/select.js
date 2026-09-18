/* ============================================================
   SELECTS DINÁMICOS PARA EL FORMULARIO DE VENTAS
   ============================================================ */

/* ------------------------------------------------------------
   1. CARGAR MARCAS (solo Venta)
   ------------------------------------------------------------ */

fetch("obtenerMarcas.php")
    .then(r => r.json())
    .then(data => {
        const selectMarca = document.getElementById("marca");
        data.forEach(item => {
            const option = document.createElement("option");
            option.value = item.marca;
            option.textContent = item.marca;
            selectMarca.appendChild(option);
        });
    });

/* ------------------------------------------------------------
   2. CARGAR MODELOS (solo Venta)
   ------------------------------------------------------------ */

document.getElementById("marca").addEventListener("change", () => {

    const marca = document.getElementById("marca").value;
    const selectModelo = document.getElementById("modelo");

    selectModelo.innerHTML = '<option value="">Seleccione modelo...</option>';

    fetch(`obtenerModelos.php?marca=${marca}`)
        .then(r => r.json())
        .then(data => {
            data.forEach(item => {
                const option = document.createElement("option");
                option.value = item.modelo;
                option.textContent = item.modelo;
                selectModelo.appendChild(option);
            });
        });
});

/* ------------------------------------------------------------
   3. CARGAR PRECIO + idCatalogo + tipo
   ------------------------------------------------------------ */

document.getElementById("modelo").addEventListener("change", () => {

    const marca = document.getElementById("marca").value;
    const modelo = document.getElementById("modelo").value;

    fetch(`obtenerPrecio.php?marca=${marca}&modelo=${modelo}`)
        .then(r => r.json())
        .then(data => {

            document.getElementById("idCatalogo").value = data.idCatalogo;

            // Guardar idTipoVehiculo para ventas.js
            window.idTipoVehiculo = data.idTipoVehiculo;

            // ✔ SOLO VENTA RELLENA PRECIO
            if (data.tipo === "Venta") {
                document.getElementById("precio").value = data.precio;
            } else {
                document.getElementById("precio").value = "";
            }

            // ✔ BLOQUEAR RENTING SI ES MOTO
            if (window.idTipoVehiculo == 2) {
                document.querySelector('#tipoPago option[value="Renting"]').disabled = true;
            } else {
                document.querySelector('#tipoPago option[value="Renting"]').disabled = false;
            }

            // ✔ BLOQUEAR FINANCIADO SI ES ALQUILER
            if (data.tipo === "Alquiler") {
                document.querySelector('#tipoPago option[value="Financiado"]').disabled = true;
            } else {
                document.querySelector('#tipoPago option[value="Financiado"]').disabled = false;
            }

        });
});

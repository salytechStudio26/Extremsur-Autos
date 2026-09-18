// ============================================================
// ventas.js — Controlador general del formulario de ventas
// ============================================================

// ------------------------------------------------------------
// 1. ASIGNAR idClienteTipo AUTOMÁTICAMENTE
// ------------------------------------------------------------
document.getElementById("tipoClientes").addEventListener("change", () => {
    const tipo = document.getElementById("tipoClientes").value;
    const idClienteTipo = document.getElementById("idClienteTipo");

    if (tipo === "particular") idClienteTipo.value = 1;
    if (tipo === "empresa") idClienteTipo.value = 2;
});

// ------------------------------------------------------------
// 2. CARGAR MARCAS DESDE obtenerMarcas.php (solo Venta)
// ------------------------------------------------------------
fetch("obtenerMarcas.php")
    .then(res => res.json())
    .then(data => {
        const selectMarca = document.getElementById("marca");
        data.forEach(item => {
            const option = document.createElement("option");
            option.value = item.marca;
            option.textContent = item.marca;
            selectMarca.appendChild(option);
        });
    });

// ------------------------------------------------------------
// 3. CARGAR MODELOS SEGÚN MARCA (solo Venta)
// ------------------------------------------------------------
document.getElementById("marca").addEventListener("change", () => {
    const marca = document.getElementById("marca").value;

    fetch("obtenerModelos.php?marca=" + marca)
        .then(res => res.json())
        .then(data => {
            const selectModelo = document.getElementById("modelo");
            selectModelo.innerHTML = "";

            data.forEach(item => {
                const option = document.createElement("option");
                option.value = item.modelo;
                option.textContent = item.modelo;
                selectModelo.appendChild(option);
            });

            // ⭐ SI SOLO HAY UN MODELO → FORZAR LA CARGA DEL PRECIO
            if (data.length === 1) {
                document.getElementById("modelo").value = data[0].modelo;
                cargarPrecio(); // LLAMADA MANUAL
            }
        });
});

// ------------------------------------------------------------
// 4. CARGAR PRECIO E idCatalogo SEGÚN MODELO (solo Venta)
// ------------------------------------------------------------
document.getElementById("modelo").addEventListener("change", () => {
    cargarPrecio();
});

// ------------------------------------------------------------
// FUNCIÓN PARA CARGAR PRECIO (USADA EN DOS SITIOS)
// ------------------------------------------------------------
function cargarPrecio() {
    const marca = document.getElementById("marca").value;
    const modelo = document.getElementById("modelo").value;

    if (!modelo) return;

    fetch(`obtenerPrecio.php?marca=${marca}&modelo=${modelo}`)
        .then(res => res.json())
        .then(data => {

            document.getElementById("idCatalogo").value = data.idCatalogo;
            window.idTipoVehiculo = data.idTipoVehiculo;

            if (data.tipo === "Venta") {
                document.getElementById("precio").value = data.precio;
            } else {
                document.getElementById("precio").value = "";
            }

            // BLOQUEAR RENTING SI ES MOTO
            document.querySelector('#tipoPago option[value="Renting"]').disabled =
                (window.idTipoVehiculo == 2);

            // BLOQUEAR FINANCIADO SI ES ALQUILER
            document.querySelector('#tipoPago option[value="Financiado"]').disabled =
                (data.tipo === "Alquiler");
        });
}

// ------------------------------------------------------------
// 5. ABRIR PANEL DE CUOTAS
// ------------------------------------------------------------
document.getElementById("btnCalcularCuota").addEventListener("click", () => {
    window.open("panelCuotas.php", "panelCuotas", "width=600,height=500");
});

// ------------------------------------------------------------
// 6. CALCULAR PRECIO FINAL SEGÚN TIPO DE PAGO
// ------------------------------------------------------------
document.getElementById("tipoPago").addEventListener("change", () => {
    actualizarObservaciones();
    calcularPrecioFinal();
});

function calcularPrecioFinal() {

    const precio = Number(document.getElementById("precio").value);
    const cuota = Number(document.getElementById("cuota").value);
    const tipoPago = document.getElementById("tipoPago").value;
    const tipoCliente = Number(document.getElementById("idClienteTipo").value);

    let precioFinal = 0;

    if ((tipoPago === "Contado" || tipoPago === "Transferencia") && precio > 0) {
        precioFinal = precio;
    }

    if (tipoPago === "Renting" && cuota > 0) {
        precioFinal = cuota;
    }

    if (tipoPago === "Financiado" && precio > 0) {
        let interes = (tipoCliente === 1)
            ? precio * 0.045
            : precio * 0.065;

        precioFinal = precio + interes;
    }

    document.getElementById("precioFinal").value = precioFinal.toFixed(2);
}

// ------------------------------------------------------------
// 7. OBSERVACIONES SEGÚN TIPO DE PAGO
// ------------------------------------------------------------
function actualizarObservaciones() {
    const tipoPago = document.getElementById("tipoPago").value;
    const obs = document.getElementById("observaciones");

    if (tipoPago === "Contado" || tipoPago === "Transferencia") {
        obs.innerHTML = `
            <option value="">Selecciona una opción</option>
            <option value="concesionario">Recoger en concesionario</option>
            <option value="domicilio">Envío a domicilio</option>
        `;
        obs.disabled = false;
    }

    if (tipoPago === "Financiado" || tipoPago === "Renting") {
        obs.innerHTML = `
            <option value="concesionario">Recoger en concesionario</option>
        `;
        obs.disabled = true;
    }
}

// ------------------------------------------------------------
// 8. VALIDACIÓN FINAL ANTES DE ENVIAR
// ------------------------------------------------------------
document.getElementById("formVentas").addEventListener("submit", (e) => {

    if (!document.getElementById("idClienteTipo").value) {
        alert("Debes seleccionar un tipo de cliente.");
        e.preventDefault();
        return;
    }

    if (!document.getElementById("idCatalogo").value) {
        alert("Debes seleccionar marca y modelo.");
        e.preventDefault();
        return;
    }

    if (!document.getElementById("precioFinal").value) {
        alert("Debes calcular el precio final.");
        e.preventDefault();
        return;
    }
});

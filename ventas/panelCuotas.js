// ============================================================
// panelCuotas.js
// ============================================================

// -----------------------------
// 1. CARGAR PRECIO DESDE VENTAS
// -----------------------------
window.onload = function () {
    const precio = window.opener.document.getElementById("precio").value;
    document.getElementById("precioVehiculo").value = precio;
};


// -----------------------------
// 2. CAMPOS DINÁMICOS
// -----------------------------
document.getElementById("tipoPagoCuota").addEventListener("change", mostrarCampos);
document.getElementById("tipoCliente").addEventListener("change", mostrarCampos);

function mostrarCampos() {

    const tipoCliente = document.getElementById("tipoCliente").value;
    const tipoPago = document.getElementById("tipoPagoCuota").value;
    const contenedor = document.getElementById("camposDinamicos");

    contenedor.innerHTML = ""; // limpiar

    if (!tipoCliente || !tipoPago) return;

    // -----------------------------
    // RENTING PARTICULARES
    // -----------------------------
    if (tipoCliente === "particular" && tipoPago === "renting") {

        contenedor.innerHTML = `
            <label>Salario mensual (€)</label>
            <input type="number" id="salario">

            <label>Año de inicio laboral</label>
            <input type="number" id="añoInicioLaboral">

            <label>Año de obtención del carnet</label>
            <input type="number" id="añoInicioCarnet">
        `;
    }

    // -----------------------------
    // RENTING EMPRESAS
    // -----------------------------
    if (tipoCliente === "empresa" && tipoPago === "renting") {

        contenedor.innerHTML = `
            <label>Ingresos anuales (€)</label>
            <input type="number" id="ingresos">

            <label>Año de inicio de actividad</label>
            <input type="number" id="añoInicioActividad">

            <label>Año de obtención del carnet</label>
            <input type="number" id="añoInicioCarnet">
        `;
    }

    // -----------------------------
    // FINANCIACIÓN PARTICULARES
    // -----------------------------
    if (tipoCliente === "particular" && tipoPago === "financiacion") {

        contenedor.innerHTML = `
            <label>Salario mensual (€)</label>
            <input type="number" id="salario">

            <label>Año de inicio laboral</label>
            <input type="number" id="añoInicioLaboral">

            <label>Año de obtención del carnet</label>
            <input type="number" id="añoInicioCarnet">

            <label>Cuotas</label>
            <select id="cuotas">
                <option value="36">36 meses</option>
                <option value="48">48 meses</option>
                <option value="60">60 meses</option>
                <option value="72">72 meses</option>
                <option value="84">84 meses</option>
            </select>
        `;
    }

    // -----------------------------
    // FINANCIACIÓN EMPRESAS
    // -----------------------------
    if (tipoCliente === "empresa" && tipoPago === "financiacion") {

        contenedor.innerHTML = `
            <label>Ingresos anuales (€)</label>
            <input type="number" id="ingresos">

            <label>Año de inicio de actividad</label>
            <input type="number" id="añoInicioActividad">

            <label>Año de obtención del carnet</label>
            <input type="number" id="añoInicioCarnet">

            <label>Cuotas</label>
            <select id="cuotas">
                <option value="36">36 meses</option>
                <option value="48">48 meses</option>
                <option value="60">60 meses</option>
                <option value="72">72 meses</option>
                <option value="84">84 meses</option>
            </select>
        `;
    }
}


// ============================================================
// 3. BOTÓN CALCULAR CUOTA
// ============================================================
document.getElementById("btnCalcular").addEventListener("click", function () {

    const precio = Number(document.getElementById("precioVehiculo").value);
    const tipoCliente = document.getElementById("tipoCliente").value;
    const tipoPago = document.getElementById("tipoPagoCuota").value;

    const añoActual = new Date().getFullYear();
    let cuota = 0;

    // -----------------------------
    // RENTING PARTICULARES
    // -----------------------------
    if (tipoCliente === "particular" && tipoPago === "renting") {

        const salario = Number(document.getElementById("salario").value);
        const añoInicioLaboral = Number(document.getElementById("añoInicioLaboral").value);
        const añoInicioCarnet = Number(document.getElementById("añoInicioCarnet").value);

        const antiguedadLaboral = añoActual - añoInicioLaboral;
        const antiguedadCarnet = añoActual - añoInicioCarnet;

        if (salario < 1500 || antiguedadLaboral < 2 || antiguedadCarnet < 2 || precio < 20000) {
            alert("No cumple los requisitos para Renting particulares.");
            return;
        }

        cuota = (precio - 10000) / 48;
    }

    // -----------------------------
    // RENTING EMPRESAS
    // -----------------------------
    if (tipoCliente === "empresa" && tipoPago === "renting") {

        const ingresos = Number(document.getElementById("ingresos").value);
        const añoInicioActividad = Number(document.getElementById("añoInicioActividad").value);
        const añoInicioCarnet = Number(document.getElementById("añoInicioCarnet").value);

        const antiguedadActividad = añoActual - añoInicioActividad;
        const antiguedadCarnet = añoActual - añoInicioCarnet;

        if (ingresos < 30000 || antiguedadActividad < 2 || antiguedadCarnet < 2 || precio < 20000) {
            alert("No cumple los requisitos para Renting empresas.");
            return;
        }

        cuota = (precio - 10000) / 60;
    }

    // -----------------------------
    // FINANCIACIÓN PARTICULARES
    // -----------------------------
    if (tipoCliente === "particular" && tipoPago === "financiacion") {

        const salario = Number(document.getElementById("salario").value);
        const añoInicioLaboral = Number(document.getElementById("añoInicioLaboral").value);
        const añoInicioCarnet = Number(document.getElementById("añoInicioCarnet").value);
        const cuotas = Number(document.getElementById("cuotas").value);

        const antiguedadLaboral = añoActual - añoInicioLaboral;
        const antiguedadCarnet = añoActual - añoInicioCarnet;

        if (salario < 1100 || antiguedadLaboral < 2 || antiguedadCarnet < 2) {
            alert("No cumple los requisitos para Financiación particulares.");
            return;
        }

        const interes = precio * 0.045;
        cuota = (precio + interes) / cuotas;
    }

    // -----------------------------
    // FINANCIACIÓN EMPRESAS
    // -----------------------------
    if (tipoCliente === "empresa" && tipoPago === "financiacion") {

        const ingresos = Number(document.getElementById("ingresos").value);
        const añoInicioActividad = Number(document.getElementById("añoInicioActividad").value);
        const añoInicioCarnet = Number(document.getElementById("añoInicioCarnet").value);
        const cuotas = Number(document.getElementById("cuotas").value);

        const antiguedadActividad = añoActual - añoInicioActividad;
        const antiguedadCarnet = añoActual - añoInicioCarnet;

        if (ingresos < 20000 || antiguedadActividad < 2 || antiguedadCarnet < 2) {
            alert("No cumple los requisitos para Financiación empresas.");
            return;
        }

        const interes = precio * 0.065;
        cuota = (precio + interes) / cuotas;
    }

    document.getElementById("resultadoCuota").innerHTML =
        "Cuota mensual: <strong>" + cuota.toFixed(2) + " €</strong>";
});


// ============================================================
// 4. BOTÓN ACEPTAR → ENVIAR CUOTA A VENTAS
// ============================================================
document.getElementById("btnAceptar").addEventListener("click", function () {

    const resultado = document.getElementById("resultadoCuota").innerHTML;

    if (!resultado.includes("€")) {
        alert("Primero debe calcular la cuota.");
        return;
    }

    const cuota = resultado.replace("Cuota mensual: <strong>", "").replace(" €</strong>", "");

    window.opener.document.getElementById("cuota").value = cuota;

    window.close();
});


// ============================================================
// 5. BOTÓN CANCELAR → CERRAR SIN CAMBIOS
// ============================================================
document.getElementById("btnCancelar").addEventListener("click", function () {
    window.close();
});

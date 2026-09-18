// ============================================================
// CONTROLADOR GLOBAL DEL FORMULARIO DE ALQUILER
// ============================================================

// ------------------------------------------------------------
// 1. CALCULAR DÍAS TOTALES
// ------------------------------------------------------------
function calcularDias() {
    const fechaInicio = document.getElementById("fechaInicial").value;
    const fechaFinal = document.getElementById("fechaFinal").value;

    if (fechaInicio === "" || fechaFinal === "") return;

    const inicio = new Date(fechaInicio);
    const fin = new Date(fechaFinal);

    const diferencia = fin - inicio;

    if (diferencia < 0) {
        alert("La fecha final no puede ser anterior a la inicial.");
        document.getElementById("diasTotales").value = "";
        return;
    }

    const dias = diferencia / (1000 * 60 * 60 * 24);

    document.getElementById("diasTotales").value = dias;
    calcularTotal();
}


// ------------------------------------------------------------
// 2. CALCULAR TOTAL A PAGAR
// ------------------------------------------------------------
function calcularTotal() {

    const dias = Number(document.getElementById("diasTotales").value);
    const precio = Number(document.getElementById("precio").value);
    const fianza = Number(document.getElementById("fianza").value);

    if (dias > 0 && precio > 0) {
        const total = (dias * precio) + fianza;
        document.getElementById("totalAPagar").value = total.toFixed(2);
        bloquearMetodosPago(total);
    }
}


// ------------------------------------------------------------
// 3. BLOQUEAR MÉTODOS DE PAGO SEGÚN IMPORTE
// ------------------------------------------------------------
function bloquearMetodosPago(total) {

    const tipoPago = document.getElementById("tipoPago");

    [...tipoPago.options].forEach(op => {
        if (op.value === "Bizum") op.disabled = total > 500;
        if (op.value === "Fraccionado") op.disabled = total < 600;
    });
}


// ------------------------------------------------------------
// 4. REACCIONES A CAMBIOS DEL FORMULARIO
// ------------------------------------------------------------
document.getElementById("fechaInicial").addEventListener("change", calcularDias);
document.getElementById("fechaFinal").addEventListener("change", calcularDias);


// ------------------------------------------------------------
// 5. VALIDACIÓN FINAL ANTES DE ENVIAR
// ------------------------------------------------------------
document.getElementById("formAlquiler").addEventListener("submit", async (e) => {
    e.preventDefault();

    const dias = document.getElementById("diasTotales").value;
    const precio = document.getElementById("precio").value;
    const total = document.getElementById("totalAPagar").value;

    if (dias === "" || precio === "" || total === "") {
        alert("Faltan cálculos automáticos. Revisa fechas, modelo y fianza.");
        return;
    }

    if (Number(dias) <= 0) {
        alert("Los días totales deben ser mayores que 0.");
        return;
    }

    const formData = new FormData(e.target);

    const respuesta = await fetch("./guardarAlquiler.php", {
        method: "POST",
        body: formData
    });

    const idAlquiler = await respuesta.text();

    if (idAlquiler.includes("ERROR")) {
        alert("Error al guardar el alquiler.");
        console.log(idAlquiler);
        return;
    }

    alert("Alquiler guardado correctamente.");

    window.location.href = "./generarTicketPDF.php?idAlquiler=" + idAlquiler;
});

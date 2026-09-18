// =====================================
// VALIDACIONES DEL FORMULARIO DE CONTACTO
// =====================================

document.getElementById("formContacto").addEventListener("submit", function(e) {
    e.preventDefault();

    // Obtener valores
    const nombre = document.getElementById("nombre").value.trim();
    const apellidos = document.getElementById("apellidos").value.trim();
    const telefono = document.getElementById("telefono").value.trim();
    const correo = document.getElementById("correo").value.trim();
    const motivo = document.getElementById("motivo").value;
    const mensaje = document.getElementById("mensaje").value.trim();

    const resultado = document.getElementById("resultadoContacto");
    resultado.innerHTML = ""; // limpiar mensajes previos

    // ============================
    // VALIDACIONES
    // ============================

    // Nombre
    if (nombre.length < 2) {
        mostrarError("El nombre debe tener al menos 2 caracteres.");
        return;
    }

    // Apellidos
    if (apellidos.length < 2) {
        mostrarError("Los apellidos deben tener al menos 2 caracteres.");
        return;
    }

    // Teléfono (solo números y 9 dígitos)
    const regexTelefono = /^[0-9]{9}$/;
    if (!regexTelefono.test(telefono)) {
        mostrarError("El teléfono debe tener 9 dígitos y solo números.");
        return;
    }

    // Correo electrónico
    const regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!regexCorreo.test(correo)) {
        mostrarError("El correo electrónico no es válido.");
        return;
    }

    // Motivo
    if (motivo === "") {
        mostrarError("Debes seleccionar un motivo de contacto.");
        return;
    }

    // Mensaje
    if (mensaje.length < 10) {
        mostrarError("El mensaje debe tener al menos 10 caracteres.");
        return;
    }

    // ============================
    // SI TODO ES CORRECTO
    //============================

    resultado.innerHTML = `
        <p class="okContacto">
            ✔ Tu mensaje ha sido validado correctamente.<br>
            (Este formulario no envía datos, solo valida la información.)
        </p>
    `;

    resultado.style.borderLeft = "4px solid #28a745";
    resultado.style.background = "#e8fbe8";
});

// =====================================
// FUNCIÓN PARA MOSTRAR ERRORES
// =====================================

function mostrarError(texto) {
    const resultado = document.getElementById("resultadoContacto");
    resultado.innerHTML = `<p class="errorContacto">⚠ ${texto}</p>`;
    resultado.style.borderLeft = "4px solid #d9534f";
    resultado.style.background = "#fdeaea";
}

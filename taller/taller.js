document.addEventListener("DOMContentLoaded", () => {

    const form = document.getElementById("formTaller");

    form.addEventListener("submit", (e) => {

        // ============================
        // CAPTURA DE CAMPOS
        // ============================

        const Fecha          = document.getElementById("Fecha").value;
        const idTipoVehiculo = document.getElementById("idTipoVehiculo").value;
        const nombre         = document.getElementById("nombre").value.trim();
        const Apellidos      = document.getElementById("Apellidos").value.trim();
        const telefono       = document.getElementById("telefono").value.trim();
        const correo         = document.getElementById("correo").value.trim();
        const FechaCita      = document.getElementById("FechaCita").value;
        const HoraCita       = document.getElementById("HoraCita").value;
        const Marca          = document.getElementById("Marca").value.trim();
        const Modelo         = document.getElementById("Modelo").value.trim();
        const Descripcion    = document.getElementById("Descripcion").value.trim();

        // ============================
        // VALIDACIONES
        // ============================

        // Tipo de vehículo
        if (idTipoVehiculo === "") {
            alert("Debes seleccionar el tipo de vehículo.");
            e.preventDefault();
            return;
        }

        // Fecha de registro
        if (Fecha === "") {
            alert("Debes seleccionar la fecha de registro.");
            e.preventDefault();
            return;
        }

        // Nombre
        if (nombre.length < 2) {
            alert("El nombre es demasiado corto.");
            e.preventDefault();
            return;
        }

        // Apellidos
        if (Apellidos.length < 2) {
            alert("Los apellidos son demasiado cortos.");
            e.preventDefault();
            return;
        }

        // Teléfono
        if (!/^\d{9}$/.test(telefono)) {
            alert("El teléfono debe tener 9 números.");
            e.preventDefault();
            return;
        }

        // Correo
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(correo)) {
            alert("El correo electrónico no es válido.");
            e.preventDefault();
            return;
        }

        // Fecha de cita
        if (FechaCita === "") {
            alert("Debes seleccionar la fecha de la cita.");
            e.preventDefault();
            return;
        }

        // Hora de cita
        if (HoraCita === "") {
            alert("Debes seleccionar la hora de la cita.");
            e.preventDefault();
            return;
        }

        // Marca
        if (Marca.length < 2) {
            alert("La marca es demasiado corta.");
            e.preventDefault();
            return;
        }

        // Modelo
        if (Modelo.length < 1) {
            alert("El modelo es demasiado corto.");
            e.preventDefault();
            return;
        }

        // Descripción (opcional, pero si existe debe tener sentido)
        if (Descripcion.length > 0 && Descripcion.length < 3) {
            alert("La descripción es demasiado corta.");
            e.preventDefault();
            return;
        }

        // ============================
        // SI TODO ESTÁ BIEN → ENVIAR
        // ============================
        // No hacemos preventDefault → se envía y el PDF se descarga automáticamente
    });

});

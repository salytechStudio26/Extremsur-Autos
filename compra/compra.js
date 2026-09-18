document.addEventListener("DOMContentLoaded", () => {

    const form = document.getElementById("formCompra");

    form.addEventListener("submit", (e) => {

        // ============================
        // VALIDACIONES BÁSICAS
        //============================

        const idTipoVehiculo = document.getElementById("idTipoVehiculo").value;
        const Fecha = document.getElementById("Fecha").value;
        const nombre = document.getElementById("nombre").value.trim();
        const Apellidos = document.getElementById("Apellidos").value.trim();
        const Direccion = document.getElementById("Dirección").value.trim();
        const CP = document.getElementById("CP").value.trim();
        const localidad = document.getElementById("localidad").value.trim();
        const provincia = document.getElementById("provincia").value.trim();
        const telefono = document.getElementById("telefono").value.trim();
        const correo = document.getElementById("correo").value.trim();
        const añoFabricacion = document.getElementById("añoFabricacion").value.trim();
        const marca = document.getElementById("marca").value.trim();
        const modelo = document.getElementById("modelo").value.trim();

        // ============================
        // VALIDAR SELECT TIPO VEHÍCULO
        //============================
        if (idTipoVehiculo === "") {
            alert("Debes seleccionar el tipo de vehículo.");
            e.preventDefault();
            return;
        }

        // ============================
        // VALIDAR FECHA
        //============================
        if (Fecha === "") {
            alert("Debes seleccionar la fecha.");
            e.preventDefault();
            return;
        }

        // ============================
        // VALIDAR NOMBRE Y APELLIDOS
        //============================
        if (nombre.length < 2) {
            alert("El nombre es demasiado corto.");
            e.preventDefault();
            return;
        }

        if (Apellidos.length < 2) {
            alert("Los apellidos son demasiado cortos.");
            e.preventDefault();
            return;
        }

        // ============================
        // VALIDAR DIRECCIÓN
        //============================
        if (Direccion.length < 5) {
            alert("La dirección es demasiado corta.");
            e.preventDefault();
            return;
        }

        // ============================
        // VALIDAR CP
        //============================
        if (!/^\d{5}$/.test(CP)) {
            alert("El código postal debe tener 5 números.");
            e.preventDefault();
            return;
        }

        // ============================
        // VALIDAR LOCALIDAD Y PROVINCIA
        //============================
        if (localidad.length < 2) {
            alert("La localidad es demasiado corta.");
            e.preventDefault();
            return;
        }

        if (provincia.length < 2) {
            alert("La provincia es demasiado corta.");
            e.preventDefault();
            return;
        }

        // ============================
        // VALIDAR TELÉFONO
       // ============================
        if (!/^\d{9}$/.test(telefono)) {
            alert("El teléfono debe tener 9 números.");
            e.preventDefault();
            return;
        }

        // ============================
        // VALIDAR EMAIL
       // ============================
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(correo)) {
            alert("El correo electrónico no es válido.");
            e.preventDefault();
            return;
        }

        // ============================
        // VALIDAR AÑO DE FABRICACIÓN
       // ============================
        const añoActual = new Date().getFullYear();

        if (añoFabricacion < 1950 || añoFabricacion > añoActual) {
            alert("El año de fabricación no es válido.");
            e.preventDefault();
            return;
        }

        // ============================
        // VALIDAR MARCA Y MODELO
        //============================
        if (marca.length < 2) {
            alert("La marca es demasiado corta.");
            e.preventDefault();
            return;
        }

        if (modelo.length < 1) {
            alert("El modelo es demasiado corto.");
            e.preventDefault();
            return;
        }

        // ============================
        // SI TODO ESTÁ BIEN → ENVIAR
       // ============================
        // No hacemos preventDefault → se envía correctamente
    });

});

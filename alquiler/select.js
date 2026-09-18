// ===============================
// CARGAR MARCAS DE ALQUILER
// ===============================
document.addEventListener("DOMContentLoaded", () => {

    fetch("./obtenerMarca.php")
        .then(r => r.json())
        .then(data => {

            const selectMarca = document.getElementById("marca");
            selectMarca.innerHTML = "<option value=''>Selecciona una opción</option>";

            data.forEach(item => {
                const option = document.createElement("option");
                option.value = item.marca;
                option.textContent = item.marca;
                selectMarca.appendChild(option);
            });
        });
});


// ===============================
// CARGAR MODELOS SEGÚN MARCA
// ===============================
document.getElementById("marca").addEventListener("change", () => {

    const marca = document.getElementById("marca").value;

    if (marca === "") {
        document.getElementById("modelo").innerHTML = "<option value=''>Selecciona una opción</option>";
        return;
    }

    fetch(`./obtenerModelo.php?marca=${marca}`)
        .then(r => r.json())
        .then(data => {

            const selectModelo = document.getElementById("modelo");
            selectModelo.innerHTML = "<option value=''>Selecciona una opción</option>";

            data.forEach(item => {
                const option = document.createElement("option");
                option.value = item.modelo;
                option.textContent = item.modelo;
                selectModelo.appendChild(option);
            });
        });
});


// ===============================
// CARGAR PRECIO + idCatalogo + FIANZA
// ===============================
document.getElementById("modelo").addEventListener("change", () => {

    const marca = document.getElementById("marca").value;
    const modelo = document.getElementById("modelo").value;

    if (modelo === "") return;

    fetch(`./obtenerPrecio.php?marca=${marca}&modelo=${modelo}`)
        .then(r => r.json())
        .then(data => {

            // Guardar idCatalogo
            document.getElementById("idCatalogo").value = data.idCatalogo;

            // Rellenar precio desde catalogo
            document.getElementById("precio").value = Number(data.precio);

            // Rellenar fianza desde tipoVehiculo
            document.getElementById("fianza").value = Number(data.fianza);

            // Recalcular total
            calcularTotal();
        });
});

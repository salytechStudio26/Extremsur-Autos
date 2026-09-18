// ===============================
// 1. LISTA DE CONCESIONARIOS
// ===============================

const concesionarios = [
    { nombre: "Sevilla", lat: 37.3891, lon: -5.9845 },
    { nombre: "Murcia", lat: 37.9922, lon: -1.1307 },
    { nombre: "Alicante", lat: 38.3452, lon: -0.4810 },
    { nombre: "Barcelona", lat: 41.3874, lon: 2.1686 },
    { nombre: "Navarra", lat: 42.8125, lon: -1.6458 },
    { nombre: "León", lat: 42.5987, lon: -5.5671 },
    { nombre: "Cáceres", lat: 39.4763, lon: -6.3722 },
    { nombre: "Mérida", lat: 38.9190, lon: -6.3430 },
    { nombre: "Toledo", lat: 39.8628, lon: -4.0273 },
    { nombre: "Madrid", lat: 40.4168, lon: -3.7038 },
    { nombre: "Bilbao", lat: 43.2630, lon: -2.9350 },
    { nombre: "Vigo", lat: 42.2406, lon: -8.7226 }
];

// ===============================
// 2. CREAR MAPA
// ===============================

const map = L.map('map').setView([40.0, -3.7], 6); // España centrada

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
}).addTo(map);

// Marcadores de concesionarios
concesionarios.forEach(c => {
    L.marker([c.lat, c.lon]).addTo(map)
        .bindPopup(`<b>${c.nombre}</b>`);
});

// ===============================
// 3. FUNCIÓN PARA CALCULAR DISTANCIA (Haversine)
// ===============================

function calcularDistancia(lat1, lon1, lat2, lon2) {
    const R = 6371; // km
    const dLat = (lat2 - lat1) * Math.PI / 180;
    const dLon = (lon2 - lon1) * Math.PI / 180;

    const a =
        Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(lat1 * Math.PI / 180) *
        Math.cos(lat2 * Math.PI / 180) *
        Math.sin(dLon / 2) *
        Math.sin(dLon / 2);

    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    return R * c;
}

// ===============================
// 4. BUSCAR COORDENADAS DE LOCALIDAD + PROVINCIA
// ===============================

async function obtenerCoordenadas(localidad, provincia) {
    const url = `https://nominatim.openstreetmap.org/search?city=${localidad}&state=${provincia}&country=España&format=json`;

    const respuesta = await fetch(url);
    const datos = await respuesta.json();

    if (datos.length === 0) return null;

    return {
        lat: parseFloat(datos[0].lat),
        lon: parseFloat(datos[0].lon)
    };
}

// ===============================
// 5. EVENTO DEL FORMULARIO
// ===============================

document.getElementById("formLocalizacion").addEventListener("submit", async (e) => {
    e.preventDefault();

    const localidad = document.getElementById("localidad").value.trim();
    const provincia = document.getElementById("provincia").value.trim();

    if (!localidad || !provincia) {
        alert("Debes escribir localidad y provincia.");
        return;
    }

    const coords = await obtenerCoordenadas(localidad, provincia);

    if (!coords) {
        alert("No se han encontrado coordenadas para esa localidad.");
        return;
    }

    // ===============================
    // 6. CALCULAR CONCESIONARIO MÁS CERCANO
    // ===============================

    let mejor = null;
    let mejorDistancia = Infinity;

    concesionarios.forEach(c => {
        const dist = calcularDistancia(coords.lat, coords.lon, c.lat, c.lon);

        if (dist < mejorDistancia) {
            mejorDistancia = dist;
            mejor = c;
        }
    });

    // ===============================
    // 7. MOSTRAR RESULTADO
    // ===============================

    const resultado = document.getElementById("resultadoConcesionario");
    resultado.innerHTML = `
        <h4>Concesionario más cercano:</h4>
        <p><b>${mejor.nombre}</b></p>
        <p>Distancia aproximada: ${mejorDistancia.toFixed(1)} km</p>
    `;

    // ===============================
    // 8. MARCAR EN EL MAPA
    // ===============================

    // Punto del usuario
    const usuarioMarker = L.marker([coords.lat, coords.lon], {color: 'blue'})
        .addTo(map)
        .bindPopup(`<b>${localidad}, ${provincia}</b>`);

    // Punto del concesionario
    const concesionarioMarker = L.marker([mejor.lat, mejor.lon], {color: 'red'})
        .addTo(map)
        .bindPopup(`<b>${mejor.nombre}</b>`);

    // Centrar mapa entre ambos puntos
    const group = new L.featureGroup([usuarioMarker, concesionarioMarker]);
    map.fitBounds(group.getBounds());
});

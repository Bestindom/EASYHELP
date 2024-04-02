let map;
window.addEventListener("DOMContentLoaded", showMap);

function showMap() {
    mapboxgl.accessToken =
        "pk.eyJ1IjoiamlhamllMTIiLCJhIjoiY2x1aGZkN3Q1MGYxMjJpbnBwZWFrbTB2aSJ9.Xyzq7WQrgVz5BBlgBK3dvg";
    map = new mapboxgl.Map({
        container: "map",
        style: "mapbox://styles/mapbox/streets-v11", // Estilo del mapa
        center: [2.1734, 41.3851], // Coordenadas de Barcelona [longitud, latitud]
        zoom: 12, // Zoom inicial
        maxBounds: [
            [0.5, 40.25], // Coordenadas sudoeste de Cataluña
            [3.4, 42.5], // Coordenadas noreste de Cataluña
        ],
    });
    window.addEventListener("click", addMark);
}

function addMark() {
    const marker1 = new mapboxgl.Marker()
        .setLngLat([2.13974, 41.383605])
        .addTo(map);
}

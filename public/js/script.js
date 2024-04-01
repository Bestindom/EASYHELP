mapboxgl.accessToken =
    "pk.eyJ1IjoiamlhamllMTIiLCJhIjoiY2x1aGZkN3Q1MGYxMjJpbnBwZWFrbTB2aSJ9.Xyzq7WQrgVz5BBlgBK3dvg";
// const map = new mapboxgl.Map({
//     container: "map",
//     style: "mapbox://styles/mapbox/dark-v11", // Estilo del mapa
//     center: [2.1734, 41.3851], // Coordenadas de Barcelona [longitud, latitud]
//     zoom: 12, // Zoom inicial
// });

const bounds = [
    [2.032, 41.317], // Coordenadas sudoeste de Barcelona
    [2.229, 41.468]  // Coordenadas noreste de Barcelona
];

const map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/standard', // Estilo del mapa
    center: [2.1734, 41.3851], // Coordenadas de Barcelona [longitud, latitud]
    maxBounds: bounds, // Límites del mapa
    zoom: 10 // Zoom inicial
});

// mapbox://styles/mapbox/standard
// mapbox://styles/mapbox/streets-v12
// mapbox://styles/mapbox/outdoors-v12
// mapbox://styles/mapbox/light-v11
// mapbox://styles/mapbox/dark-v11
// mapbox://styles/mapbox/satellite-v9
// mapbox://styles/mapbox/satellite-streets-v12
// mapbox://styles/mapbox/navigation-day-v1
// mapbox://styles/mapbox/navigation-night-v1
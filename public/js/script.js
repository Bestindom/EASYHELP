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

    map.on("dblclick", function (e) {
        // Prevenir el zoom por defecto
        e.preventDefault();

        // Pedir confirmación al usuario
        const confirmar = window.confirm(
            "¿Deseas añadir una marca en esta ubicación?"
        );

        // Si el usuario confirma, añadir la marca
        if (confirmar) {
            // Obtiene las coordenadas del lugar donde se hizo doble clic
            const lngLat = e.lngLat;

            // Crea un marcador en la ubicación del clic
            new mapboxgl.Marker().setLngLat(lngLat).addTo(map);

            // Guarda las coordenadas en variables o en una base de datos si es necesario
            const latitud = lngLat.lat;
            const longitud = lngLat.lng;

            // Haz lo que necesites con las coordenadas (por ejemplo, imprimir en la consola)
            console.log(latitud, longitud);
        }
    });
}

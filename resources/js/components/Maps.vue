<template>
    <div>
        <div id="map" style="width: 100%; height: 100vh"></div>
    </div>
</template>
<script>
let map;

window.addEventListener("DOMContentLoaded", showMap);

function showMap() {
    mapboxgl.accessToken =
        "pk.eyJ1IjoiamlhamllMTIiLCJhIjoiY2x1aGZkN3Q1MGYxMjJpbnBwZWFrbTB2aSJ9.Xyzq7WQrgVz5BBlgBK3dvg";
    map = new mapboxgl.Map({
        container: "map",
        style: "mapbox://styles/mapbox/streets-v11",
        center: [2.1734, 41.3851],
        zoom: 12,
        maxBounds: [
            [0.5, 40.25],
            [3.4, 42.5],
        ],
    });

    map.on("dblclick", addMarks);
}

function addMarks(e) {
    e.preventDefault();

    const confirmar = window.confirm(
        "¿Deseas añadir una marca en esta ubicación?"
    );

    if (confirmar) {
        const lngLat = e.lngLat;

        const marker = new mapboxgl.Marker().setLngLat(lngLat).addTo(map);

        const popupContent = `
                <h1>McDonald's</h1>
                <button type="button" class="btn btn-light" id="remove">Light</button>
                <img src="img/repartidor.png" alt="Imagen">
            `;

        const popup = new mapboxgl.Popup({ offset: 25 }).setHTML(popupContent);

        marker.setPopup(popup);

        const latitud = lngLat.lat;
        const longitud = lngLat.lng;

        console.log(latitud, longitud);

        const deleteButton = document.getElementById("remove");

        deleteButton.addEventListener("click", function () {
            marker.remove();
        });
    }
}

export default {};
</script>
<style></style>

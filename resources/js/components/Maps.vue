<template>
    <div id="map" style="width: 100%; height: 100vh"></div>

    <div class="modal" tabindex="-1" id="infoModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Añadir Púa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="closeModal"></button>
                </div>
                <div class="modal-body">
                    <form class="form-floating">
                        <input type="text" class="form-control" id="name" placeholder="McDonald's">
                        <label for="floatingInputValue">Nombre</label>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="addMark">Aceptar</button>
                </div>
            </div>
        </div>
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
    const infoModal = document.getElementById("infoModal");
    const closeModalButton = document.getElementById("closeModal");
    const addMarkButton = document.getElementById("addMark");

    e.preventDefault();

    infoModal.style.display = "flex";

    closeModalButton.addEventListener("click", function () {
        infoModal.style.display = "none";
        addMarkButton.removeEventListener("click", confirmAddMark);
    });

    function confirmAddMark() {
        infoModal.style.display = "none";

        const lngLat = e.lngLat;

        const marker = new mapboxgl.Marker().setLngLat(lngLat).addTo(map);

        const inputName = document.getElementById("name");
        const name = inputName.value;

        const popupContent = addPopupContent(name);

        const popup = new mapboxgl.Popup({ offset: 25 }).setHTML(popupContent);

        marker.setPopup(popup);

        deletePopup(popup, marker);

        const latitud = lngLat.lat;
        const longitud = lngLat.lng;

        console.log(latitud, longitud);
        inputName.value = "";
        addMarkButton.removeEventListener("click", confirmAddMark);
    }

    addMarkButton.removeEventListener("click", confirmAddMark);
    addMarkButton.addEventListener("click", confirmAddMark);
}

function addPopupContent(name) {
    const popupContent = `
        <h1>${name}</h1>
        <img src="img/repartidor.png" alt="Imagen">
        <button type="button" class="btn btn-light" id="remove"><i class="bi bi-trash"></i>Delete</button>
    `;
    return popupContent;
}

function deletePopup(popup, marker) {
    popup.on("open", function () {
        const deleteButton = document.getElementById("remove");
        deleteButton.addEventListener("click", function () {
            marker.remove();
            popup.remove();
        });
    });
}
export default {};
</script>


<style>
.mapboxgl-popup-content {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    width: 300px;
    height: 400px;
}

.modal {
    display: none;
    align-items: center;
    justify-content: center;
}

.modal-dialog {
    width: 500px;
}

.modal-content {
    height: 500px;
}
</style>

<template>
<<<<<<< Updated upstream
    <div>
        <div id="map" style="width: 100%; height: 100vh"></div>
    </div>
=======
    <!-- Insert Modal -->
>>>>>>> Stashed changes


    <!-- Insert Modal -->

    <div class="modal" tabindex="-1" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure to delete</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" @click="deleteUser()">
                        <i class="bi bi-trash"></i> Accept
                    </button>
                </div>
            </div>
        </div>
    </div>

</template>
<<<<<<< Updated upstream
<script>
=======

<script>

import * as bootstrap from 'bootstrap'
import axios from 'axios';

export default {
    data() {
        return {
            points: [],
            point: {},
            myModal: {},

        }
    },
    methods: {
        showMap() {
            const me = this

            mapboxgl.accessToken =
                "pk.eyJ1IjoiamlhamllMTIiLCJhIjoiY2x1aGZkN3Q1MGYxMjJpbnBwZWFrbTB2aSJ9.Xyzq7WQrgVz5BBlgBK3dvg";
            me.map = new mapboxgl.Map({
                container: "map",
                style: "mapbox://styles/mapbox/streets-v11",
                center: [2.1734, 41.3851],
                zoom: 12,
                maxBounds: [
                    [0.5, 40.25],
                    [3.4, 42.5],
                ],
            });

            me.map.on("dblclick", me.addMarks);
        },
        addMarks(e) {
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
        },
>>>>>>> Stashed changes

import * as bootstrap from 'bootstrap'
import axios from 'axios';

<<<<<<< Updated upstream
export default {
    data() {
        return {
            points: [],
            point: {},
            myModal: {},
            map: null,
        }
    },
    methods: {
        showMap() {
            mapboxgl.accessToken =
                "pk.eyJ1IjoiamlhamllMTIiLCJhIjoiY2x1aGZkN3Q1MGYxMjJpbnBwZWFrbTB2aSJ9.Xyzq7WQrgVz5BBlgBK3dvg";
            this.map = new mapboxgl.Map({
                container: "map",
                style: "mapbox://styles/mapbox/streets-v11", // Estilo del mapa
                center: [2.1734, 41.3851], // Coordenadas de Barcelona [longitud, latitud]
                zoom: 12, // Zoom inicial
                maxBounds: [
                    [0.5, 40.25], // Coordenadas sudoeste de Cataluña
                    [3.4, 42.5], // Coordenadas noreste de Cataluña
                ],
            });

            this.map.on("dblclick", function (e) {
                // Prevenir el zoom por defecto
                e.preventDefault();

                // Pedir confirmación al usuario
                const confirmar = window.confirm(
                    "¿Deseas añadir una marca en esta ubicación?"
                );

                // showConfirm();

                // Si el usuario confirma, añadir la marca con popup
                if (confirmar) {
                    // Obtiene las coordenadas del lugar donde se hizo doble clic
                    const lngLat = e.lngLat;

                    // Crea un marcador en la ubicación del clic
                    const marker = new mapboxgl.Marker().setLngLat(lngLat).addTo(map);

                    // Crea un popup asociado al marcador

                    const popupContent = `
                <h1>McDonald's</h1>
                <button type="button" class="btn btn-light">Light</button>
                <img src="img/repartidor.png" alt="Imagen">
            `;

                    const popup = new mapboxgl.Popup({ offset: 25 }).setHTML(
                        popupContent
                    );

                    // Añade el popup al marcador
                    marker.setPopup(popup);

                    // Guarda las coordenadas en variables o en una base de datos si es necesario
                    const latitud = lngLat.lat;
                    const longitud = lngLat.lng;

                    this.insertPoint(latitud, longitud)
                    // Haz lo que necesites con las coordenadas (por ejemplo, imprimir en la consola)
                    console.log(latitud, longitud);
                }
            });
        },
        showConfirm() {
            this.myModal = new bootstrap.Modal('#userModal')
            this.myModal.show()
        },
        insertPoint(latitud, longitud) {
            point =
            {
                latitud: latitud,
                longitud: longitud
            }

            const me = this
            axios
                .post('point', me.point)
                .then(response => {
                    me.selectPoints()
                    me.myModal.hide()
                })
        },
        selectPoints() {
            const me = this
            axios
                .get('point')
                .then(response => {
                    console.log('mis puas: ' + response.data);
                    me.points = response.data
                })
        },
    },
    created() {
        this.showMap()
        this.selectPoints()
    },

};
</script>
<style></style>
=======

        showConfirm() {
            this.myModal = new bootstrap.Modal('#userModal')
            this.myModal.show()
        },
        addPopupContent(name) {
            const popupContent = `
                <h1>${name}</h1>
                <img src="img/repartidor.png" alt="Imagen">
                <button type="button" class="btn btn-light" id="remove"><i class="bi bi-trash"></i>Delete</button>
            `;
            return popupContent;
        },
        deletePopup(popup, marker) {
            popup.on("open", function () {
                const deleteButton = document.getElementById("remove");
                deleteButton.addEventListener("click", function () {
                    marker.remove();
                    popup.remove();
                });
            });
        },

        insertPoint(latitud, longitud) {
            point =
            {
                latitud: latitud,
                longitud: longitud
            }

            const me = this
            axios
                .post('point', me.point)
                .then(response => {
                    me.selectPoints()
                    me.myModal.hide()
                })
        },
        selectPoints() {
            const me = this
            axios
                .get('point')
                .then(response => {
                    console.log('mis puas: ' + response.data);
                    me.points = response.data
                })
        },
    },
    created() {
        this.showMap()
        this.selectPoints()
    },

};
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
}</style>
>>>>>>> Stashed changes

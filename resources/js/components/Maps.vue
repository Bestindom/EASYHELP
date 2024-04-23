<template>
<div>
    <button style="margin: 5%;" display="block;">hola</button>
</div>
    <!-- INSERT PUA -->
<div id="providers" style="display: block;">

</div>

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
                        <div class="form-floating row mb-3 mx-3">
                            <input class="form-control" id="amount" name="amount"
                                v-model="customer.amount">
                            <label for="amount">Cantidad</label>
                        </div>
                        <div class="form-floating row mb-3 mx-3" style="display: none;">
                            <input class="form-control" id="latitud" name="latitud"
                                v-model="customer.latitud">
                            <label for="latitud">Cantidad</label>
                        </div>
                        <div class="form-floating row mb-3 mx-3" style="display: none;">
                            <input class="form-control" id="longitud" name="longitud"
                                v-model="customer.longitud">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="addMark">Agg Pua</button>
                </div>
            </div>
        </div>
    </div>


    <!-- delete modal -->
    
    <div class="modal" tabindex="-1" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Realizar Entrega</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="closeModal"></button>
                </div>
                <div class="modal-body">
                    <form class="form-floating">
                        <input type="text" class="form-control" id="name" placeholder="McDonald's">
                        <label for="floatingInputValue">Numero de Menús</label>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="addMark">Entregar  </button>
                </div>
            </div>
        </div>
    </div>
</template>


<script>


import * as bootstrap from 'bootstrap'
import axios from 'axios';
import providers from './Providers.vue';

export default {
    data() {
        return {
            points: [],
            point: {},
            customers: [],
            customer: {},
            myModal: {},
            amount: '',
            latitud: '',
            longitud: '',
            map: null
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
        addMarks(e, map) {
            const infoModal = document.getElementById("infoModal");
            const closeModalButton = document.getElementById("closeModal");
            const addMarkButton = document.getElementById("addMark");

            e.preventDefault();

            infoModal.style.display = "flex";

            closeModalButton.addEventListener("click", () => {
                infoModal.style.display = "none";
                addMarkButton.removeEventListener("click", confirmAddMark);
            });

            const confirmAddMark = () => {
                infoModal.style.display = "none";

                const lngLat = e.lngLat;

                const marker = new mapboxgl.Marker().setLngLat(lngLat).addTo(this.map);

                const inputName = document.getElementById("name");
                const name = inputName.value;

                // const popupContent = this.addPopupContent(name);

                const popup = new mapboxgl.Popup({ offset: 25 });
                // const popup = new mapboxgl.Popup({ offset: 25 }).setHTML(popupContent);

                marker.setPopup(popup);

                // this.deletePopup(popup, marker);

                this.latitud = lngLat.lat;
                this.longitud = lngLat.lng;
                const latitud = lngLat.lat;
                const longitud = lngLat.lng;

                // this.insertPoint();
                this.insertCustomer();

                console.log('mis lat y long: ' + this.latitud + ' ' + this.longitud);

                inputName.value = "";
                addMarkButton.removeEventListener("click", confirmAddMark);
            }

            addMarkButton.removeEventListener("click", confirmAddMark);
            addMarkButton.addEventListener("click", confirmAddMark);
        },
        // addPopupContent(name) {
        //     const popupContent = `
        //         <h1>${name}</h1>
        //         <img src="img/repartidor.png" alt="Imagen">
        //         <button type="button" class="btn btn-light" id="remove"><i class="bi bi-trash"></i>Delete</button>
        //     `;
        //     return popupContent;
        // },
        // deletePopup(popup, marker) {
        //     popup.on("open", function () {
        //         const deleteButton = document.getElementById("remove");
        //         deleteButton.addEventListener("click", function () {
        //             marker.remove();
        //             popup.remove();
        //         });
        //     });
        // },
        insertCustomer()
        {
            const me = this
            me.amount = me.customer.amount
            me.customer =
            {
                amount: me.amount,
                latitud: me.latitud,
                longitud: me.longitud
            }
            axios
                .post('customer', me.customer)
                .then(response => {
                    me.selectCustomers()
                })
                .catch(error => {
                    console.log(error)
                })
        },
        selectCustomers() {
            const me = this
            axios
                .get('customer')
                .then(response => {
                    me.customers = response.data
                    console.log('mis customers: ' + me.customers);
                    for (let i = 0; i < me.customers.length; i++) {
                        const marker = new mapboxgl.Marker()
                            .setLngLat([me.customers[i].longitud, me.customers[i].latitud])
                            .addTo(me.map); // Añadir el marcador al mapa

                        // Agg Evente Listener
                        marker.getElement().addEventListener('click', () => {
                            // Abre el deleteModal
                            const deleteModal = document.getElementById('deleteModal');
                            const deleteModalInstance = new bootstrap.Modal(deleteModal);
                            deleteModalInstance.show();
                        });

                    }
                })
        },
    },
    created() {
        this.showMap()
        this.selectCustomers()
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
}

</style>
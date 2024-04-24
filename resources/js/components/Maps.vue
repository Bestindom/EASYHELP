<template>
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
                        <label for="floatingInputValue">Numero de Homeless</label>
                        <div class="form-floating row mb-3 mx-3">
                            <input class="form-control" id="amount" name="amount" v-model="customer.amount">
                            <label for="amount">Cantidad</label>
                        </div>
                        <div class="form-floating row mb-3 mx-3" style="display: none;">
                            <input class="form-control" id="latitud" name="latitud" v-model="customer.latitud">
                            <label for="latitud">Cantidad</label>
                        </div>
                        <div class="form-floating row mb-3 mx-3" style="display: none;">
                            <input class="form-control" id="longitud" name="longitud" v-model="customer.longitud">
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
                    <h5 class="modal-title">Selecciona la order que quieras entregar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="closeModal"></button>
                </div>
                <div class="modal-body" id="container-cards">
                    <form class="form-floating">
                        <input type="text" class="form-control" id="name">
                        <label for="floatingInputValue">Menús a entregar</label>
                        <div v-for="(order, index) in orders" :key="index" class="col">
                            <div class="card mb-3" style="max-width: 540px;">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="/public/img/negocios/negocio1.png" class="img-fluid rounded-start"
                                            alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ order.provider.name }}</h5>
                                            <p class="card-text"><strong>{{ order.menus }}</strong> Menús</p>
                                        </div>
                                        <div class="text-end">
                                            <button type="button" class="btn btn-primary">Entregar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
            customers: [],
            customer: {},
            orders: [],
            order: {},
            myModal: {},
            amount: '',
            latitud: '',
            longitud: '',
            userloged: {},
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
        getUser() {
            const me = this
            axios
                .get("http://localhost/EASYHELP/public/getUser")
                .then(response => {
                    console.log(response.data);
                    me.userloged = response.data[0];
                    console.log('username: ' + me.userloged.username);
                })
        },
        insertCustomer() {
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
        selectOrders() {
            const me = this
            axios
                .get('order')
                .then(response => {
                    console.log(response.data);
                    me.orders = response.data
                })
        }
    },
    created() {
        this.showMap();
        this.selectCustomers();
        this.selectOrders();
        this.getUser();
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
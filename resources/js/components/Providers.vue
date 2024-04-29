<template>
    <button @click="toggleProveedores" class="ver-proveedores-btn">VER PROVEEDORES</button>
    <div class="row row-cols-1 row-cols-md-3 g-0 card-container divProveedores"
        :style="{ display: showProveedores ? 'flex' : 'none' }">
        <div v-for="(provider, index) in providers" :key="index" class="col">

            <!-- PROVIDERS CARDS-->

            <div v-if="userloged.id == provider.user_id" class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ provider.user_id + '. ' + provider.name }}</h5>
                    <form>
                        <div class="form-floating row mb-3">
                            <input class="form-control" id="menus" name="menus" autofocus v-model="provider.menus">
                            <label for="username">Menús</label>
                        </div>
                    </form>
                    <button @click="increment(index)">+</button>
                    <button @click="decrement(index)">-</button><br>
                    <h5 class="card-title">{{ provider.street }}</h5>
                </div>
                <div class="modal-footer">
                    <button v-if="userloged.id == provider.user_id" type="button" class="btn btn-primary"
                        @click="updateMenus(provider)">
                        <i class="bi bi-bag-check-fill"></i> Modificar
                    </button>
                    <button v-else type="button" class="btn btn-primary" @click="updateMenus(provider)">
                        <i class="bi bi-bag-check-fill"></i> {{ userloged.username }}
                    </button>
                </div>
            </div>

            <!-- RIDER CARDS -->

            <div v-else class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ provider.user_id + '. ' + provider.name }}</h5>
                    <form>
                        <div class="form-floating row mb-3">
                            <input class="form-control" id="menus" name="menus" autofocus
                                v-model="provider.order.menus">
                            <label for="menus">Menús</label>
                        </div>
                        <div class="form-floating" style="display: none;">
                            <input class="form-control" id="rider_id" name="rider_id" v-model="order.rider_id">
                        </div>
                        <div class="form-floating" style="display: none;">
                            <input class="form-control" id="provider_id" name="provider_id" v-model="provider.user_id">
                        </div>
                    </form>
                    <button @click="increment(index)">+</button>
                    <button @click="decrement(index)">-</button><br>
                    <h5 class="card-title">Menus Disponibles {{ provider.menus }}</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" @click="insertOrder(provider);">
                        <i class="bi bi-bag-check-fill"></i> Reservar
                    </button>
                </div>
            </div>
        </div>
    </div>


</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            providers: [],
            provider: {},
            users: [],
            user: {},
            menus: [],
            messageError: '',
            userloged: {},
            order: { menus: 0 },
            updateProvider_menus: '',
            showProveedores: false
        };
    },
    methods: {
        toggleProveedores() {
            this.showProveedores = !this.showProveedores;
        },

        selectProviders() {
            const me = this;
            axios
                .get('provider')
                .then(response => {
                    console.log(response.data);
                    me.providers = response.data.map(provider => ({
                        ...provider,
                        order: { menus: 0 }
                    }));
                    console.log(me.providers)
                });
        },
        selectUsers() {
            const me = this
            axios
                .get('user')
                .then(response => {
                    console.log(response.data);
                    me.users = response.data
                })
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
        increment(index) {
            this.providers[index].order.menus++;
        },
        decrement(index) {
            if (this.providers[index].order.menus > 0) {
                this.providers[index].order.menus--;
            }
        },
        updateMenus(provider) {
            const me = this
            axios
                .put('provider/' + provider.user_id, provider)
                .then(response => {
                    me.selectProviders()
                })
                .catch(error => {
                    console.log(error)
                    me.messageError = error.response.data.error
                })
        },
        insertOrder(provider) {
            const me = this;
            const orderMenus = provider.order.menus;
            const availableMenus = provider.menus;

            if (orderMenus > availableMenus) {
                alert("No hay suficientes menús disponibles para realizar esta reserva.");
                return;
            }

            const orderData = {
                menus: orderMenus,
                rider_id: me.userloged.id,
                provider_id: provider.user_id
            };
            provider.menus -= orderMenus;
            console.log(orderData);
            axios
                .post('order', orderData)
                .then(response => {
                    me.updateMenus(provider);
                    me.selectProviders();
                })
                .catch(error => {
                    console.log(error);
                    me.messageError = error.response.data.error;
                });
        },
    },
    created() {
        this.selectProviders();
        this.selectUsers();
        this.getUser();
    },

}
</script>

<style scoped>
.card-container {
    display: flex;
    overflow-x: auto;
    flex-wrap: nowrap;
    gap: 0;
    padding-bottom: 20px;
}

.col {
    width: 17% !important;
}

.card {
    flex: 0 0 auto;
    width: 300px;
    margin-right: 0;
}

.row-cols-md-3>* {
    flex: 0 0 auto;
    width: 33.33333333%;
    margin-top: 5%;
}

.ver-proveedores-btn {
    background-color: #e09448;
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin-bottom: 10px;
    cursor: pointer;
    border-radius: 5px;
    height: 35px;
    margin-left: 40%;
}


.card-container::-webkit-scrollbar {
    width: 10px;
}

.card-container::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.card-container::-webkit-scrollbar-thumb {
    background: #888;
}

.card-container::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>
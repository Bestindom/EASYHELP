<template>
    <div>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div v-for="(provider, index) in providers" :key="index" class="col">

                <!-- Provider Card-->

                <div v-if="userloged.id == provider.user_id" class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ provider.user_id + '. ' + provider.name }}</h5>
                        <form>
                            <div class="form-floating row mb-3">
                                <input class="form-control" id="menus" name="menus" autofocus
                                    v-model="provider.menus">
                                <label for="username">Menús</label>
                            </div>
                        </form>
                        <button @click="increment(index)">+</button>
                        <button @click="decrement(index)">-</button><br>
                        <h5 class="card-title">{{ provider.street }}</h5>
                    </div>
                    <div class="modal-footer">
                        <button v-if="userloged.id == provider.user_id" type="button" class="btn btn-primary" @click="updateMenus(provider)">
                            <i class="bi bi-bag-check-fill"></i> Modificar
                        </button>
                        <button v-else type="button" class="btn btn-primary" @click="updateMenus(provider)">
                            <i class="bi bi-bag-check-fill"></i> {{ userloged.username }}
                        </button>
                    </div>
                </div>

                <!-- Riders Cards -->

                <div v-else class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ provider.user_id + '. ' + provider.name }}</h5>
                        <form>
                            <div class="form-floating row mb-3">
                                <input class="form-control" id="menus" name="menus" autofocus
                                    v-model="order.menus">
                                <label for="menus">Menús</label>
                            </div>
                            <div class="form-floating">
                                <input class="form-control" id="rider_id" name="rider_id"
                                    v-model="order.rider_id">
                            </div>
                            <div class="form-floating">
                                <input class="form-control" id="provider_id" name="provider_id"
                                    v-model="provider.user_id">
                            </div>
                        </form>
                        <button @click="increment(index)">+</button>
                        <button @click="decrement(index)">-</button><br>
                        <h5 class="card-title">{{ provider.street }}</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="insertOrder(provider)">
                            <i class="bi bi-bag-check-fill"></i> Reservar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
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
            order: {},
        };
    },
    methods: {
        selectProviders() {
            const me = this
            axios
                .get('provider')
                .then(response => {
                    console.log(response.data);
                    me.providers = response.data
                })
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
        getUser(){
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
            this.providers[index].menus++;
        },
        decrement(index) {
            if (this.providers[index].menus > 0) {
                this.providers[index].menus--;
            }
        },
        updateMenus(provider) 
        {
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
        insertOrder(provider)
        {
            const me = this
            me.order.rider_id = me.userloged.id;
            me.order.provider_id = provider.user_id
            console.log(me.order);
            axios
                .post('order', me.order)
                .then(response => {
                    me.selectProviders()
                })
                .catch(error => {
                    console.log(error)
                    me.messageError = error.response.data.error
                })
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
  /* Estilos para el contenedor de cartas */
  .card-container {
    display: flex;
    overflow-x: auto;
    gap: 10px;
    justify-content: flex-start;
    padding-bottom: 20px; /* Ajuste para el espacio del botón del mapa */
  }
  
  .providers {
    flex: 0 0 auto;
  }
  
  .card {
    height: 100%;
    user-select: none;
  }
  
  .card-header {
    height: 200px;
    background-repeat: no-repeat;
    background-size: cover;
  }
  
  .card-body {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }
  
  .provider-name {
    display: flex;
    gap: 5px;
    text-align: right;
  }
  
  .menus-left {
    background-color: #FB8500;
    border-radius: 50px;
    width: 100px;
    height: 35px;
    display: flex;
    justify-content: center;
    margin-left: auto;
    align-items: center;
  }
  
  .get-menus {
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    gap: 15px;
  }
  
  .card-footer {
    display: flex;
    justify-content: right;
  }
  
  .increment,
  .decrement {
    border-radius: 50px;
    width: 50px;
  }
  
  /* Estilos para la barra de desplazamiento horizontal */
  .card-container::-webkit-scrollbar {
    height: 12px;
    background-color: transparent;
  }
  
  .card-container::-webkit-scrollbar-thumb {
    background-color: #888;
    border-radius: 6px;
  }
  
  .card-container::-webkit-scrollbar-thumb:hover {
    background-color: #555;
  }
  
  .card-container::-webkit-scrollbar-track {
    background-color: transparent;
  }
  
  .card-container::-webkit-scrollbar-corner {
    background-color: transparent;
  }
  
  /* Estilos para el mapa y el botón */
  .map-container {
    text-align: center;
    margin-top: 20px;
  }
  
  .map-image {
  max-width: 700px;
  height: auto;
  border: 2px solid #ccc; /* Añadir un borde sólido de 2px con color gris claro */
  border-radius: 10px; /* Aplicar bordes curvos con un radio de 10px */
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Añadir una sombra suave */
}
  
  .map-button {
    margin-top: 10px;
    margin-left: 46%;
  }
  
  /* Estilos responsivos */
  @media (max-width: 768px) {
    .providers {
      min-width: calc(100vw - 20px); /* Ancho igual al ancho de la pantalla menos el espacio para el margen */
    }
    .map-image {
      max-width: 100%;
      height: 500px;
    }
  }
  </style>
  



<template>
    <div>
      <div class="card-container" ref="cardContainer">
        <div v-for="(provider, index) in providers" :key="index" class="providers">
          <div class="card h-100">
            <div class="card-header" :style="{ 'background-image': 'url(' + provider.img + ')' }"></div>
            <div class="card-body">
              <div class="provider-name">
                <h5 class="name">{{ provider.name }}</h5>
                <h5>-</h5>
                <h5 class="street">{{ provider.street }}</h5>
                <div class="menus-left">
                  <h5>{{ provider.menus }} menús</h5>
                </div>
              </div>
              <div class="get-menus">
                <button class="btn btn-primary increment" @click="increment(index)"><i class="bi bi-plus"></i></button>
                <h5>0</h5>
                <button class="btn btn-primary decrement" @click="decrement(index)"><i class="bi bi-dash"></i></button>
              </div>
            </div>
            <div class="card-footer">
              <button class="btn btn-primary">Reservar</button>
            </div>
          </div>
        </div>
      </div>
  
      <!-- Mapa y botón -->
      <div class="map-container">
        <a href="{{ route('map') }}">
          <img class="map-image" src="http://localhost:80/EASYHELP/public/img/mapa.jpg" alt="Descripción de la imagen">
        </a>
        <button class="btn btn-primary map-button">Ver Mapa</button>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        providers: [],
      };
    },
    methods: {
      selectProviders() {
        axios
          .get('provider')
          .then(response => {
            this.providers = response.data;
          })
          .catch(error => {
            console.error('Error fetching providers:', error);
          });
      },
      increment(index) {
        this.providers[index].menus++;
      },
      decrement(index) {
        if (this.providers[index].menus > 0) {
          this.providers[index].menus--;
        }
      },
    },
    mounted() {
      this.selectProviders();
    }
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
    max-width: 100%;
    height: auto;
  }
  
  .map-button {
    margin-top: 10px;
  }
  
  /* Estilos responsivos */
  @media (max-width: 768px) {
    .providers {
      min-width: calc(100vw - 20px); /* Ancho igual al ancho de la pantalla menos el espacio para el margen */
    }
    .map-image {
      max-width: 700px;
      height: 500px;
    }
  }
  </style>
  
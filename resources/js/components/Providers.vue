<template>
    <button @click="toggleProveedores" class="ver-proveedores-btn">VER PROVEEDORES</button>
     <div class="row row-cols-1 row-cols-md-3 g-0 card-container divProveedores" :style="{ display: showProveedores ? 'flex' : 'none' }">
           <div v-for="(provider, index) in providers" :key="index" class="col">
 
             <!-- PROVIDERS CARDS-->
 
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
 
             <!-- RIDER CARDS -->
 
             <div v-else class="card h-100">
                 <div class="card-body">
                     <h5 class="card-title">{{ provider.user_id + '. ' + provider.name }}</h5>
                     <form>
                         <div class="form-floating row mb-3">
                             <input class="form-control" id="menus" name="menus" autofocus
                                 v-model="order.menus">
                             <label for="menus">Menús</label>
                         </div>
                         <div class="form-floating" style="display: none;">
                             <input class="form-control" id="rider_id" name="rider_id"
                                 v-model="order.rider_id">
                         </div>
                         <div class="form-floating" style="display: none;">
                             <input class="form-control" id="provider_id" name="provider_id"
                                 v-model="provider.user_id">
                         </div>
                     </form>
                     <button @click="increment(index)">+</button>
                     <button @click="decrement(index)">-</button><br>
                     <h5 class="card-title">Menus Disponibles {{ provider.menus }}</h5>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-primary" @click="insertOrder(provider); ">
                         <i class="bi bi-bag-check-fill"></i> Reservar
                     </button>
                 </div>
             </div>
         </div>
     </div>
    
 
 </template>
 
 <script>
 import * as bootstrap from 'bootstrap'
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
         order: {},
         updateProvider_menus: '',
         showProveedores: false
     };
 },
 methods: {
     toggleProveedores() {
       this.showProveedores = !this.showProveedores;
     },
 
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
         if (this.order[index].menus > 0) {
             this.order[index].menus--;
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
         provider.menus -= me.order.menus
         console.log(me.order);
         axios
             .post('order', me.order)
             .then(response => {
                 me.updateMenus(provider)
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
 overflow-x: auto; /* Permitir desplazamiento horizontal */
 flex-wrap: nowrap; /* Evitar el ajuste de contenido a la siguiente línea */
 gap: 0; /* Eliminar el espacio entre las cartas */
 padding-bottom: 20px; /* Ajuste para el espacio del botón del mapa */
 }
 .col{
 width: 17% !important;
 }
 .card {
 flex: 0 0 auto; /* Evitar que las tarjetas se expandan para ajustarse */
 width: 300px; /* Ancho fijo para cada tarjeta */
 margin-right: 0; /* Eliminar el margen entre las cartas */
 }
 .row-cols-md-3 > * {
       flex: 0 0 auto;
       width: 33.33333333%;
       margin-top: 5%;
   }
 
 /* Estilo para el botón "VER PROVEEDORES" */
 .ver-proveedores-btn {
   background-color: #4CAF50; /* Color de fondo */
   border: none; /* Sin borde */
   color: white; /* Color de texto */
   padding: 10px 20px; /* Espaciado interno */
   text-align: center; /* Alineación del texto */
   text-decoration: none; /* Sin subrayado */
   display: inline-block;
   font-size: 16px;
   margin-bottom: 10px; /* Espacio inferior */
   cursor: pointer; /* Cambio de cursor al pasar el ratón */
   border-radius: 5px; /* Borde redondeado */
 }
 
 /* Estilo para la barra de desplazamiento */
 .card-container::-webkit-scrollbar {
   width: 10px; /* Ancho de la barra */
 }
 
 .card-container::-webkit-scrollbar-track {
   background: #f1f1f1; /* Color de fondo de la barra */
 }
 
 .card-container::-webkit-scrollbar-thumb {
   background: #888; /* Color del pulgar */
 }
 
 .card-container::-webkit-scrollbar-thumb:hover {
   background: #555; /* Color del pulgar al pasar el ratón */
 }
 </style> 
 
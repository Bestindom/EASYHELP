<template>

  <!-- RIDER -->

  <div class="register">
    <div class="row">
      <div class="col-6 rider-col">
        <div class="toggle-buttons" id="riderButtons">
          <div class="buttons">
            <button :class="{ active: activeOption === 'rider' }" @click="changeForm('rider')">Rider</button>
            <button :class="{ active: activeOption === 'provider' }" @click="changeForm('provider')">Proveedor</button>
          </div>
        </div>
        <div class="container-fluid rider" id="form2">
          <div class="provider-register-container">
            <h1>Registro Riders</h1>
            <form class="rider-form">
              <div class="mb-3">
                <input type="text" class="form-control nombre" aria-describedby="emailHelp"
                  placeholder="Introduce nombre de usuario o email" name="username" id="username"
                  v-model="user.username">
              </div>
              <div class="mb-3">
                <input type="password" class="form-control" placeholder="Contraseña" name="password" id="password"
                  v-model="user.password">
              </div>
              <div class="form-check mb-3" style="display: none;">
                <input class="form-check-input" type="radio" value="2" id="type" name="type" v-model="user.type"
                  checked>
                <label class="form-check-label" for="actiu">Actiu</label>
              </div>
              <img src="../../../public/img/repartidor.png" alt="Rider_Icon">
            </form>
            <button type="button" class="btn btn-primary" @click="insertUser(user)">
              Submit
            </button>
          </div>
        </div>
      </div>

      <!-- PROVIDER -->

      <div class="col-6 provider-col">
        <div class="toggle-buttons" id="providerButtons">
          <div class="buttons">
            <button :class="{ active: activeOption === 'rider' }" @click="changeForm('rider')">Rider</button>
            <button :class="{ active: activeOption === 'provider' }" @click="changeForm('provider')">Proveedor</button>
          </div>
        </div>
        <div class="container-fluid provider" id="form1">
          <div class="provider-register-container cosas">
            <h1>Registro Proveedores</h1>
            <form class="provider-form">
              <div class="mb-3">
                <input type="text" class="form-control nombre" aria-describedby="emailHelp"
                  placeholder="Introduce nombre de usuario o email" v-model="user.username">
              </div>
              <div class="mb-3">
                <input type="password" class="form-control paswd" placeholder="Contraseña" v-model="user.password">
              </div>
              <div class="mb-3">
                <input type="text" class="form-control nombre" placeholder="Nombre" v-model="provider.name">
              </div>
              <div class="mb-3">
                <input type="text" class="form-control calle" placeholder="Calle">
              </div>
              <img src="../../../public/img/provider.svg" alt="Provider_Icon">
            </form>
            <button type="submit" class="btn btn-primary" @click="insertUser(user)">
              Submit
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>


</template>
<script>

import * as bootstrap from 'bootstrap'
import axios from 'axios';
import { provide } from 'vue';

export default {
  data() {
    return {
      activeOption: 'rider',
      user: {},
      provider: {},
    };
  },
  methods: {
    changeForm(option) {
      const rider = document.getElementById("form2");
      const provider = document.getElementById("form1");
      const riderButtons = document.getElementById("riderButtons");
      const providerButtons = document.getElementById("providerButtons");
      const riderCol = document.querySelector(".rider-col");
      const providerCol = document.querySelector(".provider-col");
      this.activeOption = option === 'rider' ? 'rider' : 'provider';

      if (this.activeOption === 'rider') {
        rider.style.display = "flex";
        provider.style.display = "none";
        riderButtons.style.display = "flex";
        providerButtons.style.display = "none";
        providerCol.style.backgroundImage = "url(img/registro/rider.webp)";
        riderCol.style.backgroundImage = "none";
      } else {
        rider.style.display = "none";
        provider.style.display = "flex";
        riderButtons.style.display = "none";
        providerButtons.style.display = "flex";
        riderCol.style.backgroundImage = "url(img/registro/provider.jpg)";
        providerCol.style.backgroundImage = "none";
      }
    },
    insertUser(user) {
      const me = this
      me.user = {
        username: user.username,
        password: user.password,
        type: 2
      }
      console.log(me.user)
      axios
        .post('user', me.user)
        .then(response => {
          me.user.id = response.data.id; // Asigna el ID del usuario creado

          if (me.user.type == '2') {
            me.insertRider();
          } else {
            me.insertProvider();
          }
          window.open('/EASYHELP/public/login');
        })
        .catch(error => {
          console.log(error)
        })
    },
    insertRider() {
      const me = this
      console.log('ESTE ES MI USER ID: ' + me.user.id)
      axios
        .post('rider', me.user)
        .then(response => {
          console.log('rider add')
        })
        .catch(error => {
          me.isError = true
          console.log(error)
          me.messageError = error.response.data.error
        })
    },
    insertProvider() {
      const me = this
      axios
        .post('provider', me.user)
        .then(response => {
          console.log('provider add')
        })
        .catch(error => {
          me.isError = true
          console.log(error)
          me.messageError = error.response.data.error
        })
    },
  }
};
</script>
<style scoped>
body {
  overflow: hidden;
}

.register {
  height: 100vh;
  overflow-x: hidden;
  overflow-y: hidden;
}

.container-fluid.provider {
  display: none;
  justify-content: center;
  align-items: center;
  height: 60vh;
  flex-direction: column;
}

input {
  width: 400px;
  height: 50px;
  border-radius: 50px;
}

.btn {
  width: 300px;
  height: 55px;
  border-radius: 30px;
}

.provider-form,
.rider-form {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}

.container-fluid.rider {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  height: 60vh;
}

.rider-col {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  /* background-image: url(img/registro/provider.jpg); */
  background-size: cover;
}

.provider-col {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  background-image: url(img/registro/rider.webp);
  background-size: cover;
}

.toggle-buttons {
  display: flex;
  justify-content: center;
  align-items: center;
}

#providerButtons,
#provider-img {
  display: none;
}

.buttons {
  border-radius: 50px;
  gap: 15px;
}

.toggle-buttons button {
  width: 150px;
  height: 40px;
  border-radius: 50px;
  transition: background-color .6s;
}

.active {
  background-color: #ffb703;
  border-color: #fb8500;
  color: white;
}

.provider-register-container,
.rider-register-container {
  text-align: center;
}

.cosas{
  margin-top: 100px;
}
.row {
  height: 100%;
}

.register-form {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  background-color: red;
}

.image {
  background-color: aquamarine;
}
</style>
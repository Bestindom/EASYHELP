<template>

  <div class="register">
    <div class="row">
      <div class="col-6 image">
        <div class="row background-images">
          <div class="col-6"></div>
          <div class="col-6"></div>
          <div class="col-6"></div>
          <div class="col-6"></div>
        </div>
      </div>
      <div class="col-6 register-form">
        <div class="toggle-buttons">
          <div class="buttons">
            <button :class="{ active: activeOption === 'rider' }" @click="changeForm('rider')">Rider</button>
            <button :class="{ active: activeOption === 'provider' }" @click="changeForm('provider')">Proveedor</button>
          </div>
        </div>

        <div class="container-fluid provider" id="form1">
          <div class="provider-register-container">
            <h1>Registro Proveedores</h1>
            <form class="provider-form">
              <div class="mb-3">
                <input type="text" class="form-control nombre" aria-describedby="emailHelp"
                  placeholder="Introduce nombre de usuario o email">
              </div>
              <div class="mb-3">
                <input type="password" class="form-control paswd" placeholder="Contraseña">
              </div>
              <div class="mb-3">
                <input type="number" class="form-control nombre" placeholder="Nombre">
              </div>
              <div class="mb-3">
                <input type="text" class="form-control calle" placeholder="Calle">
              </div>
              <img src="../../../public/img/provider.svg" alt="Provider_Icon">
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>

        <div class="container-fluid rider" id="form2">
          <div class="provider-register-container">
            <h1>Registro Riders</h1>
            <form class="rider-form">
              <div class="mb-3">
                <input type="text" class="form-control nombre" aria-describedby="emailHelp"
                  placeholder="Introduce nombre de usuario o email">
              </div>
              <div class="mb-3">
                <input type="password" class="form-control paswd" placeholder="Contraseña">
              </div>
              <img src="../../../public/img/repartidor.png" alt="Rider_Icon">
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
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
      activeOption: 'rider'
    };
  },
  methods: {
    changeForm(option) {
      const rider = document.getElementById("form2");
      const provider = document.getElementById("form1");
      this.activeOption = option === 'rider' ? 'rider' : 'provider';

      if (this.activeOption === 'rider') {
        rider.style.display = "flex";
        provider.style.display = "none";
      } else {
        rider.style.display = "none";
        provider.style.display = "flex";
      }
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
}

.container-fluid.provider {
  display: none;
  justify-content: center;
  align-items: center;
  height: 70vh;
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
  background-color: #219EBC;
  color: #FFFDFD;
  border: 1px solid #000000;
  font-weight: bold;
  font-family: "Nunito", sans-serif;
  font-optical-sizing: auto;
  font-style: normal;
  box-shadow: 2px 2px 0px 0px #035177;
  display: flex;
  align-items: center;
  justify-content: center;
}

.provider-form {
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
  height: 70vh;
}

.rider-form {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}

.toggle-buttons {
  display: flex;
  justify-content: center;
  align-items: center;
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

.row  {
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

.col-6.background-images {
  background-image: url(img/register.jpg);
  background-repeat: no-repeat;
  background-size: cover;
}
</style>
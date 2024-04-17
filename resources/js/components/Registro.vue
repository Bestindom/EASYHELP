<template>
    <div>
        <div id="carouselExampleIndicators" class="carousel slide">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">  
        <h1>PROVIDERS</h1>
        <form>
          <div class="mb-3">
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Introduce nombre de usuario o email">
          </div>
          <div class="mb-3">
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña">
            <img src="../../../public/img/provider.svg" alt="Imagen">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
      <div class="carousel-item">
        <h1>RIDERS</h1>
        <form>
          <div class="mb-3">
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Introduce nombre de usuario o email">
          </div>
          <div class="mb-3">
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña">
            <img src="../../../public/img/repartidor.png" alt="Imagen">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
      <div class="carousel-item">
        <h1>COMEDORES</h1>
        <form>
          <div class="mb-3">
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Introduce nombre de usuario o email">
          </div>
          <div class="mb-3">
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña">
            <img src="../../../public/img/comedor.svg" alt="Imagen">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
    </div>
</template>
<script>
export default {
    
}
</script>
<style scoped>
.carousel-inner{
  width:500px;
  height:600px;
  margin-top:10%;
  margin-left:38%;
}
#exampleInputEmail1.form-control, #exampleInputPassword1.form-control{
  width: 100%;
  height: 50px;
  border-radius: 30px;
  background-color: #FFFBE8;
  border: 2px solid #035177;
}
.btn{
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
    margin-left:18%;
}
.carousel-control-prev, .carousel-control-next {
  position: absolute;
  top: 0;
  bottom: 0;
  z-index: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 15%;
  padding: 0;
  text-align: center;
  border: 0;
  height: 50px;
  width: 30px;
  margin-top: 10%;
  margin-left: 35%;
  margin-right: 33%;
}
.carousel-control-next-icon,.carousel-control-prev-icon{
  filter:invert(1)grayscale(100); 
}
placeholder{
  font-weight: bold;
}
.carousel-indicators [data-bs-target] {
    background-color: #035177;
}
</style>
<style>
  .masthead {
  height: 92vh;
  min-height: 500px;
  position:relative;
  display: flex;
  align-items: center;
  justify-content: center;
  
}

.masthead::before{
  content: "";
  background-image: url('../img/bg.jpg'), linear-gradient(rgba(0,0,0,0.2),rgba(0,0,0,0.75));
    background-blend-mode: overlay;

  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  position: absolute;
  top: 0px;
  right: 0px;
  bottom: 0px;
  left: 0px;
  opacity: 0.8;
}

h1 {
  position: relative;
  line-height: 0.9;
  text-align: center;
}


</style>
<header class="masthead">
  <div class="container h-100">
    <div class="row h-100 align-items-center">
      <div class="col-12 text-center pt-3 pb-3 slideanim">
        <h1 class="text-white display-1 slideanim">Perwira Steel</h1>
        <p class="lead text-white slideanim">Our quality product lead you to the next level</p>
        <a class="btn btn-primary text-white slideanim" href='#product-container'>See Our Product</a>
      </div>
    </div>
  </div>
</header>


<?php include("../templates/header.php"); 


?>


<!-- div one -->
<div class="p-3 col-md-12  text-center" style="background-color: #014421">
  <div class="col-md-5 p-lg-2 mx-auto my-5 text-warning">
    <hr style="color: black;">
    <h1 class="display-4 font-weight-bold">CARS</h1>
      <p class="lead font-weight-normal">The newest ______ dropping soon...</p>
      <button class="btn btn-outline text-warning" style="background-color: #80040c" href="#"><strong>Coming soon</button>
    <hr style="color: black;">
  </div>
  <div class="product-device box-shadow d-none d-md-block"></div>
  <div class="product-device product-device-2 box-shadow d-none d-md-block"></div>
</div>



<!-- FEATURED CARS DISPLAY -->
  <div class="row col-md-12 mx-auto">

    <div class="col-md-5 rounded-lg p-5 my-4 mx-auto shadow bg-light">
      <hr style="width:50%; background-color:#80040c;">
      <h2 class="display-5"><strong>Truck</strong> Line-Up</h2>

      <div class="text-right"><button class="btn btn-warning">More..</button></div>
      
      <!-- carrosell -->
        <div id="carouselExampleIndicators" class="carousel slide mt-3" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
            <img >
            </div>
            <div class="carousel-item">
              <img >
            </div>
            <div class="carousel-item">
              <img >
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"  data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"  data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
    </div>

    <div class="col-md-5 rounded-lg p-5 my-4 mx-auto shadow bg-light">
        <h2 class="display-5"><strong>Sedan</strong> Line-Up</h2>
          
        </div>
    </div>
    
    <div class="col-md-5 rounded-lg p-5 my-4 mx-auto shadow bg-light">
      <h2 class="display-5"><strong>SUV</strong> Line-Up</h2>
    </div>

    <div class="col-md-5 rounded-lg p-5 my-4 mx-auto shadow bg-light">
      <h2 class="display-5"><strong>Luxury</strong> Line-Up</h2>
    </div>

  </div>



<!-- FOOTER INLCUDED -->
<?php include('../templates/footer.php'); ?>
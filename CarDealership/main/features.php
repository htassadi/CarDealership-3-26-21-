<?php 

include("../templates/header.php"); 
include("../config/db_connect.php");

$carInventory = mysqli_query($conn, "SELECT * FROM car_lineup");

?>

<div class="p-4 text-center text-warning" style = "background-color:#014421">
    
    <!-- DIV TITLE -->
    <hr style="color:black; width:25%; margin:auto;">
    <h3>FEATURES</h3>
    <hr style="color:black; width:25%; margin:auto;">

</div>



<div class="col-xl-12 p-3">
   
    <!-- <div class="bg-dark rounded-lg p-5 shadow"> -->
        <div class="row">
            <?php
                if (mysqli_num_rows($carInventory) > 0){
                                        
                    while($row = mysqli_fetch_assoc($carInventory)){
                        if($row['sale']== 'yes'){
                    ?> 
                        <!-- PRODUCT CARDS -->
                        <div class="col-md-12 bg-danger p-3 text-light text-center mx-auto"><h2>SALE</h2></div>
                        <div class="col-md-12 p-5 shadow bg-dark text-warning mx-auto">
                            <h2 class="display-5"><strong><?php echo $row['year']." ".$row['brand']." ".$row['model']; ?></strong></h2>
                            <hr style="width:50%;color:white">
                            <h3><strong><?php echo "Starting at $".$row['price']?></strong> 
                            <button class="btn btn-outline-warning text-right" type="button" data-toggle="modal" data-target="#addToCartModal"><ion-icon name="add"></ion-icon><ion-icon name="cart"></ion-icon></button>
                            <button class="btn btn-outline-secondary text-right" type="button" data-toggle="modal" data-target="#moreInfoModal"><ion-icon name="information-circle"></ion-icon></button>

                        </div>

                        <div>
                            <!-- IMG -->
                            <div class="col-md-6  p-4 m-auto text-center">
                                <img width="100%" height="75%" <?php echo $row['exterior'];?> >
                            </div>
                        </div>
                    
                    <?php
                    }}

                } else {
                    echo "No Records Found";
                }

                ?>
        </div>
    </div>
    <!-- </div> -->
</div>








<?php 

include("../templates/footer.php"); 

?>
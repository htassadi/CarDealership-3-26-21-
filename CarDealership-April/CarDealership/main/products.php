<?php 

include("../templates/header.php"); 
include("../config/db_connect.php");

$carInventory = mysqli_query($conn, "SELECT * FROM car_lineup");

session_start();
$displayingFilterdItems= [];      

// FILTER BY _____
if (isset($_GET['filterByThisBrand'])){
    $filterByThisBrand = "$_GET[filterByThisBrand]";
    echo "Filters are being Used";
    echo $filterByThisBrand ;
    while($row = mysqli_fetch_assoc($carInventory)){
        if($row["brand"] == $filterByThisBrand){
            array_push($displayingFilterdItems, $row);
        }
    }
    $filterByThisBrand='';
} elseif(isset($_GET['filterByThisPriceRange'])){
    $filterByThisType = $_GET['filterByThisPriceRange'];
    while($row = mysqli_fetch_assoc($carInventory)){
        if($filterByThisType == "sale"){
            if($row["sale"] == 'yes'){
                array_push($displayingFilterdItems, $row);
            }
        }
    }
} elseif(isset($_GET['filterByThisType'])){
    $filterByThisType = $_GET['filterByThisType'];
    echo "Filters are being Used";
    var_dump($filterByThisType) ;
    while($row = mysqli_fetch_assoc($carInventory)){
        if($row["type"] == $filterByThisType){
            array_push($displayingFilterdItems, $row);
        }
    }
}

$_SESSION['cartItemsIds']=[];


if(isset($_POST['addToCartBtn'])){
    var_dump($_POST['addToCartBtn']);
    array_push($_SESSION['cartItemsIds'], $_POST['addToCartBtn']);
}

?>

<div class="p-4 text-center text-warning" style = "background-color:#014421">
    
    <!-- DIV TITLE -->
    <hr style="color:black; width:25%; margin:auto;">
    <h3>PRODUCTS</h3>
    <hr style="color:black; width:25%; margin:auto;">

    <!-- DROP DOWN ORGANIZING PRODUCTS BUTTON -->
    <div class="dropdown text-right">
        <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            Filter
        </button>

        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <!-- FILTER 1 -->
            <li><a class="dropdown-item-text"><strong>By Brand</strong></a></li>
            <div class="dropdown-divider"></div>
                <li><a class="dropdown-item text-right" href="products.php?filterByThisBrand=Ford">Ford</a></li>
                <li><a class="dropdown-item text-right" href="products.php?filterByThisBrand=Toyota">Toyota</a></li>
                <li><a class="dropdown-item text-right" href="products.php?filterByThisBrand=Lexus">Lexus</a></li>
                <li><a class="dropdown-item text-right" href="products.php?filterByThisBrand=Porsche">Porsche</a></li>
                <li><a class="dropdown-item text-right" href="products.php?filterByThisBrand=Acura">Acura</a></li>
                <li><a class="dropdown-item text-right" href="products.php?filterByThisBrand=Dodge">Dodge</a></li>
                <li><a class="dropdown-item text-right" href="products.php?filterByThisBrand=Hyundai">Hyundai</a></li>
                <li><a class="dropdown-item text-right" href="products.php?filterByThisBrand=Nissan">Nissan</a></li>

            <!-- FILTER 2 -->
            <li><a class="dropdown-item-text"><strong>By Price</strong></a></li>
            <div class="dropdown-divider"></div>
                <li><a class="dropdown-item text-right" href="products.php?filterByThisPriceRange=High-Low">High-Low</a></li>
                <li><a class="dropdown-item text-right" href="products.php?filterByThisPriceRange=Low-High">Low-High</a></li>
                <li><a class="dropdown-item text-right" href="products.php?filterByThisPriceRange=sale">SALE</a></li>


            <!-- FILTER 3 -->
            <li><a class="dropdown-item-text"><strong>By Type</strong></a></li>
            <div class="dropdown-divider"></div>
                <li><a class="dropdown-item text-right" href="products.php?filterByThisType=Sedan">Sedan</a></li>
                <li><a class="dropdown-item text-right" href="products.php?filterByThisType=Truck">Trucks</a></li>
                <li><a class="dropdown-item text-right" href="products.php?filterByThisType=Crossovers and SUVs">Crossovers & SUVs</a></li>
                <li><a class="dropdown-item text-right" href="products.php?filterByThisType=Sports Car">Sports Car</a></li>
                <li><a class="dropdown-item text-right" href="products.php?filterByThisType=Luxury Sedan">Luxury Sedan</a></li>
                <li><a class="dropdown-item text-right" href="products.php?filterByThisType=Luxury Crossovers and SUVs">Luxury Crossovers & SUVs</a></li>
                <li><a class="dropdown-item text-right" href="products.php?filterByThisType=Super Car">Supercars</a></li>

            <!-- FILTER 3 -->
            <div class="dropdown-divider"></div>
            <div class="dropdown-divider"></div>
            <li><a class="dropdown-item text-center" href="products.php"><strong>ALL PRODUCTS</strong></a></li>


        </ul>
    </div>

</div>



<div class="col-xl-12 p-3">
   
    <!-- <div class="bg-dark rounded-lg p-5 shadow"> -->
        <div class="row mx-auto">
            <?php
            if (count($displayingFilterdItems) > 0){
                for($i=0 ; $i < count($displayingFilterdItems); $i++){
                    ?>
                    <div class="col-md-4 rounded-lg my-2">
                            
                            <!-- heading -->
                            <div class="rounded-lg p-5 bg-dark text-warning">
                                <h4 class="display-6"><strong><?php echo $displayingFilterdItems[$i]['year']." ".$displayingFilterdItems[$i]['brand']?></strong></h4>
                                <h4><?php echo $displayingFilterdItems[$i]['model']; ?></h4>
                                <hr style="width:50%;color:white">
                            </div>

                            <!-- img -->
                            <div class="p-5 bg-light text-warning">
                                <!-- IMG -->
                                <img width="100%" height="75%" <?php echo $displayingFilterdItems[$i]['exterior'];?> >
                            </div>

                            <!-- price -->
                            <?php  if ($displayingFilterdItems[$i]['sale'] == "yes"){ ?>
                                <div class="p-4 row text-light bg-danger shadow" >
                                    <div class="col-md-4">
                                        <h4>SALE!</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <h4>$<?php echo $displayingFilterdItems[$i]['price']; ?></h4>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="p-4 text-warning" style="background-color:#014421">
                                    <h4>$<?php echo $displayingFilterdItems[$i]['price']; ?>
                                </div>
                            <?php } ?>
                            
                            <!-- btns -->
                            <div class="rounded-lg p-2 shadow bg-dark text-warning">
                                <div class="col-xl-12 my-4 text-center">
                                    <button class="btn btn-secondary btn" type="button" data-toggle="modal" data-target="#moreInfoModal"><ion-icon name="information-circle"></ion-icon></button>
                                    
                                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                                        <button id="goToCart" class="btn btn-warning btn" type="submit" name="addToCartBtn" value="<?php echo $displayingFilterdItems[$i]['id']?>"><ion-icon name="add"></ion-icon><ion-icon name="cart"></ion-icon></button>
                                    </form>
                                   
                                    <!-- GO TO CART ON CLICK OF ADD TO CART BUTTON -->
                                    <script type="text/javascript">
                                        document.getElementById("goToCart").onclick = function () {
                                            document.location = `../main/cart.php`;
                                        };
                                    </script>
                                </div>
                            </div>
                        </div>
                    <?php
                }
                
            } else if (mysqli_num_rows($carInventory) > 0){          
                    while($row = mysqli_fetch_assoc($carInventory)){
                    ?>
                        <!-- PRODUCT CARDS -->
                        <div class="col-md-4 rounded-lg my-2">
                            
                            <!-- heading -->
                            <div class="rounded-lg p-5 bg-dark text-warning">
                                <h4 class="display-6"><strong><?php echo $row['year']." ".$row['brand']?></strong></h4>
                                <h4><?php echo $row['model']; ?></h4>
                                <hr style="width:50%;color:white">
                            </div>

                            <!-- img -->
                            <div class="p-5 bg-light text-warning">
                                <!-- IMG -->
                                <img width="100%" height="75%" <?php echo $row['exterior'];?> >
                            </div>

                            <!-- price -->
                            <?php  if ($row['sale'] == "yes"){ ?>
                                <div class="p-4 row text-light bg-danger shadow" >
                                    <div class="col-md-4">
                                        <h4>SALE!</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <h4>$<?php echo $row['price']; ?></h4>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="p-4 text-warning" style="background-color:#014421">
                                    <h4>$<?php echo $row['price']; ?>
                                </div>
                            <?php } ?>
                            
                            <!-- btns -->
                            <div class="rounded-lg p-2 shadow bg-dark text-warning">
                                <div class="col-xl-12 my-4 text-center">
                                    <button class="btn btn-secondary btn" type="button" data-toggle="modal" data-target="#moreInfoModal"><ion-icon name="information-circle"></ion-icon></button>
                                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST"><button class="btn btn-warning btn" type="submit" name="addToCartBtn" value="<?php echo $row['id']?>"><ion-icon name="add"></ion-icon><ion-icon name="cart"></ion-icon></button></form>
                                </div>
                            </div>
                        </div>
                    
                    <?php
                    }

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
<?php 
include("../templates/header.php"); 
include("../config/db_connect.php");

session_start();

//Initalizing shoping cart array if somone in logged  in?
$shoppingCartArray=[];

// Preparing Items to be added into cart
if($_SESSION['cartItemsIds'] != []) {
    $itemId = $_SESSION['cartItemsIds'][0];
    $items = mysqli_query($conn,"SELECT * FROM car_lineup WHERE id = $itemId");
    foreach ($items as $item){
    }

    if ($items != ""){
        array_push($shoppingCartArray, $item);
    }
}

if(isset($_POST['removeItemFromCartBtn'])){
    $shoppingCartArray=[];
}


?>

<div class="container py-5">
    <div class="row">
        <div class="col-xl-8 mb-5">
            <div class="bg-white rounded-lg p-5 shadow">
                <h3>Cart</h3>

                <?php
                if (count($shoppingCartArray)>0){
                    for ($i=0 ; $i < count($shoppingCartArray); $i++) {
                    ?>
                    <div class="col-sm-12 row rounded shadow p-2" style = "background-color:#014421">
                        <h6 class="text-warning">Item #<?php echo ($i+1)?></h6>
                        
                        <div class="col-sm-12 bg-light row rounded shadow mx-auto">
                            <!-- col- 12 for TITLE --> 
                            <div class="col-sm-12 rounded m-3">
                                <h2 class="text-dark"><strong><?php echo $shoppingCartArray[$i]['year']." ".$shoppingCartArray[$i]['model'];?></strong></h2>
                            </div>
                            
                            <!-- Div 2 Small -->
                            <div class="col-sm-8 p-2 rounded" >
                                <img width="100%" height="100%" <?php echo $shoppingCartArray[$i]['exterior'];?>>
                            </div>

                            <div class="col-sm-4 text-center" >
                                <h2 class="text-dark bg-warning rounded p-2"><strong>$<?php echo $shoppingCartArray[$i]['price']?></strong></h2>
                                <br>
                                <form>
                                    <div class="form-group">
                                        <label for="inputState"><strong>Quantity</strong></label>
                                        <select id="inputState" class="form-control">
                                            <option selected> 1 </option>
                                            <option>For Quantities Higher than 1, we encorage contacting the dealership for proscessing</option>
                                        </select>
                                    </div>
                                </form>


                                <!-- REMOVE ITEM FROM CART -->
                                <form action=" <?php echo $_SERVER['PHP_SELF'] ?> " method="POST">
                                    <button name="removeItemFromCartBtn" class="btn btn-danger m-3">Remove</button> 
                                </form>

                            </div>
                        </div>
                        
                    </div>

                    <?php
                    }

                    } else {
                        echo "Your cart is Empty";
                    }
                ?>
            </div>
        </div>

        <div class="col-xl-4 mb-3">
            <div class="bg-white rounded-lg p-5 shadow">
                <h3>Receipt</h3>
                <div class="rounded-lg my-4 mx-auto p-4 bg-warning">
                
                <?php if (count($shoppingCartArray)>0) { ?>
                        <h5><strong>OG Price:</strong>  <?php echo $shoppingCartArray[0]["price"]?></h5>
                        <h5><strong>Upgrades:</strong> -----</h4>
                        <h5><strong>Promos:</strong> -----</h4>
                        <h5><strong>Warrenty: </strong><?php echo number_format(((int)(str_replace(",", '', $shoppingCartArray[0]["price"]))* 0.05),2);?></h4>
                            <h6 class="text-muted text-center">Mandatory, 3 year warrenty</h6>
                    <hr>
                        <h5><strong>Subtotal: </strong> <?php echo number_format(((int)(str_replace(",", '', $shoppingCartArray[0]["price"]))* 1.05),2);?> </h4>
                        <h5><strong>Tax (7.25%):</strong> <?php echo number_format(((int)(str_replace(",", '', $shoppingCartArray[0]["price"]))* 1.05) * 0.0725,2);?></h4>
                    <hr>
                        <h4>Total: <div class="text-right">$<?php echo number_format(((int)(str_replace(",", '', $shoppingCartArray[0]["price"]))* 1.05) * 1.0725, 2);?></div></h4>
                </div>

                <!-- COMPLETE TRANSACTION -->
                <button class="btn-lg btn-dark text-warning mx-auto"><strong> Process Payment </strong></button>
                
                <?php } else { 
                    echo "Add Items to cart to display infromation";
                } 
                ?>

            </div>
        </div>
    </div>
</div>




<!-- FOOTER INLCUDED -->
<?php include('../templates/footer.php'); ?>
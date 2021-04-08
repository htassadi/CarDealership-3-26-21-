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

//Removing Cart Items
if (isset($_POST['removeItemFromCartBtn'])){
    $shoppingCartArray=[];
}


//Uploading order to Database for admin to see/change
if (isset($_POST['submitPaymentBtn'])){
    $orderPrice = number_format(((int)(str_replace(",", '', $shoppingCartArray[0]['price']))* 1.05) * 1.0725, 2);
    $orderModel =json_encode($shoppingCartArray[0]['model']);
    $orderBrand = json_encode($shoppingCartArray[0]['brand']);
    $carId = (int)($shoppingCartArray[0]['id']);

    // <!-- Add order to orders database -->
    mysqli_query($conn,"INSERT INTO orders (brandOrderd, modelOrderd, orderPrice, payed, status, car_id) 
                            VALUES ('$orderBrand', '$orderModel', '$orderPrice', 'Pending','Pending', '$carId' )");

    // <!-- Clear cart array -->
    $shoppingCartArray=[];

    // Alert that the payemnt was confimed -->
    echo '<script>alert("Congratualtions! Aww yeah, you successfully completed your transaction on your future car! Let us know your thoughts on your expirence and your opinons about our line up of cars! ")</script>';
    
    header('Location:home.php');  
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

                <button class="btn-lg btn-dark text-warning mx-auto" data-bs-toggle="modal" data-bs-target="#processPaymentModal"><strong> Process Payment </strong></button>


                <!-- COMPLETE TRANSACTION -->
                
                <?php } else { 
                    echo "Add Items to cart to display infromation";
                } 
                ?>
            </div>
        </div>
    </div>
</div>


<!-- Prossess payement modal -->
<div id="processPaymentModal" class="modal fade " tabindex="-1" role="dialog" aria-labelledby="processPaymentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" style="font-weight:bold">Process & Complete Payment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <!-- Display Item -->
                <h6><strong>Subtotal: </strong> <?php echo number_format(((int)(str_replace(",", '', $shoppingCartArray[0]["price"]))* 1.05),2);?> </h4>
                <h6><strong>Tax (7.25%):</strong> <?php echo number_format(((int)(str_replace(",", '', $shoppingCartArray[0]["price"]))* 1.05) * 0.0725,2);?></h4>
                <hr>
                <div class="text-right bg-warning p-2" style="font-weight:100;"><h4>Total: $<?php echo  number_format(((int)(str_replace(",", '', $shoppingCartArray[0]["price"]))* 1.05) * 1.0725, 2);?></h4></div>
            
            <!--Display information in Form form for porcessing-->

            <div class="container">
                <form class="mt-4" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div>
                        <h3>Account Info</h3>
                        <div class="row">
                            <div class="col-md-6"> <input type="text" class="form-control" placeholder="Name" required> </div>
                            <div class="col-md-6"> <input type="text" class="form-control" placeholder="Email" required> </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6"> <input type="text" class="form-control" placeholder="Password" required> </div>
                            <div class="col-md-6"> <input type="text" class="form-control" placeholder="Repeat password" required> </div>
                        </div>
                    </div>
        
                    <br>
                    <div>
                        <h3>Personal Info</h3>
                        <div class="row">
                            <div class="col-md-6"> <input type="text" class="form-control" placeholder="Address" required> </div>
                            <div class="col-md-6"> <input type="text" class="form-control" placeholder="City" required> </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6"> <input type="text" class="form-control" placeholder="State" required> </div>
                            <div class="col-md-6"> <input type="text" class="form-control" placeholder="Country" required> </div>
                        </div>
                    </div>

                    <br>
                    <div>
                        <h3>Personal Info</h3>
                        <div class="row">
                            <div class="col-md-6"> <input type="text" class="form-control" placeholder="Card Number" required> </div>
                            <div class="col-md-6"> <input type="text" class="form-control" placeholder="Card Holder Name" required> </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6"> <input type="text" class="form-control" placeholder="CVV" required> </div>
                            <div class="col-md-6"> <input type="text" class="form-control" placeholder="Mobile Number" required> </div>
                        </div>
                    </div>
                    <br>
                    
                    <button class='btn btn-danger' type="submit" name="submitPaymentBtn" value="submit">Confirm & Submit Payment</button>
                </form>
            </div>
        </div>



        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>  
    </div>
  </div>
</div>




<!-- FOOTER INLCUDED -->
<?php include('../templates/footer.php'); ?>


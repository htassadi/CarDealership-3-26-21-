<?php 

include("../templates/header.php"); 
include("../config/db_connect.php");

$queryCarOrders = mysqli_query($conn, "SELECT * FROM orders");


//GET OrderNum to update infromation 
if (isset($_GET["orderNum"]) && isset($_GET["col"]) && isset($_GET["new"])) {
    $updatingOrders = mysqli_query($conn, "UPDATE orders SET $_GET[col] = '$_GET[new]' WHERE orderNum = $_GET[orderNum]");
    header('Location: '.$_SERVER['PHP_SELF']);  
}


?>

<!-- PAGE TILE -->
<div class="container text-left py-3">
    <div class="col-xl-3">
        <div class=" rounded p-2 shadow text-warning" style = "background-color: #014421">
            <h6> Admin Account: </h6>
        </div>
    </div>
</div>


<!-- ORDERS DIV/TABLE -->
<div class="py-4 mx-4">

    <!-- NAV BAR FOR ORDERS AND INVENOTORY -->
    <nav class=" text-right ml-auto py-3  " style="width: 40%; font-weight:bold;">
        <div class="container flex-column flex-md-row">
            <a class="mx-4 p-4 text-warning bg-dark rounded" href="../admin/adminPageInventory.php">Inventory</a>
            <a class="mx-3 p-4 text-warning bg-dark rounded" href="../admin/adminPageOrders.php">Orders</a>
        </div>
    </nav>


    <div class="col-xl-12 ">
        <div class="bg-white rounded-lg p-5 shadow">
            <div class="row">
                <h1>Orders</h1>
            </div>
            
            <hr>

            <table class="table table-hover">
                <thead>
                    <tr scope="col" data-id="<?php echo $row['orderNum'] ?>" >
                        <th scope="col">Order Number</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Model</th>
                        <th scope="col">Price</th>
                        <th scope="col">Date Orderd</th>
                        <th scope="col">Transaction Status</th>
                        <th scope="col">Car Status</th>
                            <!-- output if order is pendding, shipped, deliverd, compleate -->
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php 
                        if (mysqli_num_rows($queryCarOrders) > 0){
                            
                            while($row = mysqli_fetch_assoc($queryCarOrders)){
                                ?>
                            <tr data-id="<?php echo $row['orderNum'];?>">
                                <td><?php echo $row['orderNum'];?></th>
                                <td id="editible" data-prop="brandOrderd"><?php echo $row['brandOrderd']; ?></td>
                                <td id="editible" data-prop="modelOrderd"><?php echo $row['modelOrderd']; ?></td>
                                <td id="editible" data-prop="orderPrice"><?php echo $row['orderPrice']; ?></td>
                                <td><?php echo $row['datePlaced']; ?></td>
                                
                                <!-- TRANSACTION STATUS -->
                                <?php if($row['payed'] == 'Pending'){
                                    ?> <td id="editible" class="text-danger" style="font-weight:bold;" data-prop="payed"><?php echo $row['payed'];?></td>
                                    <?php } elseif ($row['payed'] == 'Complete'){
                                        ?> <td id="editible" class="text-success" data-prop="payed" style="font-weight:bold" ><?php echo $row['payed'];?></td>
                                <?php } ?>

                                
                                <!-- CAR SIPPING STATUS -->
                                <?php if($row['status'] == 'Pending'){
                                    ?> <td id="editible" class="text-danger" data-prop="status" style="font-weight:bold;"><?php echo $row['status'];?></td>
                                    <?php } elseif ($row['status'] == 'Delivered'){
                                        ?> <td id="editible" class="text-success" data-prop="status" style="font-weight:bold"><?php echo $row['status'];?></td>
                                    <?php } elseif ($row['status'] == 'Shipping') {
                                        ?> <td id="editible" class="text-warning" data-prop="status" style="font-weight:bold"><?php echo $row['status'];?></td>
                                <?php } ?>

                                <td><button class="btn btn-outline-secondary" type="button" name="deleteOrderBtn"  data-bs-toggle="modal" data-bs-target="#deleteOrderModal"><ion-icon name="trash"></ion-icon></button>                            </td>
                            </tr>
                            
                            <?php
                            }

                        } else {
                            echo "No Records Found";
                        }
                    ?>     
                </tbody>

            </table>
            <hr>
        </div>
    </div>
</div>





<!-- Delete ORDERS -->
<div class="modal fade" id="deleteOrderModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Delete ORDER</h4>
            </div>

            <div class="modal-body text-center">
                <form action=" <?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <button class="btn-lg btn-danger" name="deleteInventoryBtn">Delete Order</button>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>



<!-- JS FOR UPDATING -->
<script src="../templates/orders.js"></script>

<?php 
include("../templates/footer.php"); 
?>
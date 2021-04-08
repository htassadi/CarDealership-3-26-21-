<?php 

include("../templates/header.php"); 
include("../config/db_connect.php");

$queryCarInvetory = mysqli_query($conn, "SELECT * FROM car_lineup");
$queryCarOrders = mysqli_query($conn, "SELECT * FROM orders");

//GET id to update infromation 
if (isset($_GET["id"]) && isset($_GET["col"]) && isset($_GET["new"])) {
    $updatingInventory = mysqli_query($conn, "UPDATE car_lineup SET $_GET[col] = '$_GET[new]' WHERE id = $_GET[id]");
    header('Location: '.$_SERVER['PHP_SELF']);  
}


//ADD TO INVETORY
if (isset($_POST["addInventoryBtn"])) {
    mysqli_query($conn,"INSERT INTO car_lineup (brand, model, type, year, exterior, interior, price, sale, stock) 
                            VALUES ('$_POST[newInventoryBrand])', '$_POST[newInventoryModel])', '$_POST[newInventoryType])',
                            '$_POST[newInventoryYear])', '$_POST[newInventoryExterior])','$_POST[newInventoryInterior])',
                            '$_POST[newInventoryPrice])', '$_POST[newInventorySale])', '$_POST[newInventoryStock])' ");
    header('Location: '.$_SERVER['PHP_SELF']);  
}


// <!-- DELETING FROM DATABASE -->         
if (isset($_POST['deleteInventoryBtn'])) {
    if (!$conn){
        echo "Could not delete info; could not fetch car ID to delete";  
    }
    
    mysqli_query($conn, "DELETE FROM car_lineup WHERE id LIKE '$row[id]'");
    echo "Car with Id ".$row['id']." has been deleted, no information of this invetory will be displayed";
} 
   
?>

<!-- PAGE TILE -->
<div class="container text-left py-3">
    <div class="col-xl-3">
        <div class=" p-2 shadow text-warning rounded" style = "background-color: #014421">
            <h6>Admin Account: </h6>
        </div>
    </div>
</div>


<!-- INVENTORY DIV -->
<div class="py-4 mx-4">

    <!-- NAV BAR FOR ORDERS AND INVENOTORY -->
    <nav class=" text-right ml-auto py-3  " style="width: 40%; font-weight:bold;">
        <div class="container flex-column flex-md-row">
            <a class="mx-4 p-4 text-warning bg-dark rounded" href="../admin/adminPageInventory.php">Inventory</a>
            <a class="mx-3 p-4 text-warning bg-dark rounded" href="../admin/adminPageOrders.php">Orders</a>
        </div>
    </nav>

    <div class="col-xl-12">
        <div class="bg-white rounded-lg p-5 shadow">
            <div class="row">
                <h1>Inventory</h1>
                <div class="text-right">
                    <button class="btn btn-outline-warning" type="button" data-bs-toggle="modal" data-bs-target="#addInventoryModal"><ion-icon size="small" name="add-outline"></ion-icon><ion-icon size="small" name="car-sport-outline"></ion-icon></button>
                </div>
            </div>

            <hr>
            <!-- INVETORY TABLE OUTPUT -->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Car ID</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Model</th>
                        <th scope="col">Year</th>
                        <th scope="col">Stock</th>
                        <th scope="col">SALE</th>
                        <th scope="col">Price</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                
                <?php 
                    if (mysqli_num_rows($queryCarInvetory) > 0){
                        
                        while($row = mysqli_fetch_assoc($queryCarInvetory)){
                            ?>
                        <tr data-id="<?php echo $row['id'] ?>">
                            <td><?php echo $row['id']; ?></td>
                            <td id="editible" data-prop="brand"><?php echo $row['brand']; ?></td>
                            <td id="editible" data-prop="model"><?php echo $row['model']; ?></td>
                            <td id="editible" data-prop="year"><?php echo $row['year']; ?></td>
                            <td id="editible" data-prop="stock"><?php echo $row['stock']; ?></td>
                            
                            <?php if($row['sale'] == 'yes'){
                                ?> <td id="editible" class="text-danger" style="font-weight:bold;" data-prop="sale"><?php echo $row['sale'];?></td>
                            <?php } else {
                                ?> <td id="editible" data-prop="sale" style="font-weight:bold" ><?php echo $row['sale'];?></td>
                            <?php } ?>
                            
                            <td id="editible" data-prop="price"><?php echo $row['price']; ?></td>

                            <td><button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#deleteInventoryModal" <?php echo $row['id'];?>><ion-icon name="trash"></ion-icon></button></td>

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



<!-- ADD TO INVENTORY MODAL -->
<div class="modal fade" id="addInventoryModal" role="dialog" data-bs-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add New Inventory</h4>
            </div>

            <div class="modal-body" style="font-weight:bold">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                
                    <label class="form-label">Brand</label>
                    <input class="form-control <?php echo htmlspecialchars($_POST['newInventoryBrand']); ?>">

                    <label class="form-label">Model</label>
                    <input class="form-control <?php echo htmlspecialchars($_POST['newInventoryModel']); ?>">

                    <div class="row m-2">
                        <div class="col">
                            <label class="form-label">Type</label>
                            <select id="inputType" class="form-control" <?php echo htmlspecialchars($_POST['newInventoryType']); ?>>
                                <option selected>Choose...</option>
                                <option>Trucks</option>
                                <option>Sedans</option>
                                <option>Crossovers and SUVs</option>
                                <option>Sports Car</option>
                                <option>Luxury Crossovers and SUVs</option>
                                <option>Luxury Sedan</option>
                                <option>Super Car</option>
                            </select>
                        </div>

                        <div class="col">
                            <label class="form-label">Year</label>
                                <input class="form-control" <?php echo htmlspecialchars($_POST['newInventoryYear']); ?>> 
                        </div>
                    </div>

                    <label class="form-label">Exterior Image</label>
                        <input class="form-control" <?php echo htmlspecialchars($_POST['newInventoryExterior']); ?>>

                    <label class="form-label">Interior Image</label>
                        <input class="form-control" <?php echo htmlspecialchars($_POST['newInventoryInterior']); ?>>

                    <div class="row m-2">
                        <div class="col">
                            <label class="form-label">Price</label>
                                <input class="form-control" <?php echo htmlspecialchars($_POST['newInventoryPrice']); ?>>
                        </div>
                        <div class="col">
                            <label class="form-label">Stock</label>
                                <input class="form-control" <?php echo htmlspecialchars($_POST['newInventoryStock']); ?>>
                        </div>
                    </div>

                    <div class="row m-4">
                        <button type="submit" name="addInventoryBtn" value="submit" class="btn btn-warning btn-lg"><ion-icon name="cloud-upload"></ion-icon></button>
                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>




<!-- Delete INVENTORY -->
<div class="modal fade" id="deleteInventoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Delete Car Information</h4>
            </div>

            <div class="modal-body text-center">
                <form action=" <?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <button class="btn-lg btn-danger" name="deleteInventoryBtn">Delete Info</button>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<!-- JS FOR UPDATING -->
<script src="../templates/inventory.js"></script>

<?php 
include("../templates/footer.php"); 
?>
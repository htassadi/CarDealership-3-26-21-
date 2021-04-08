<!-- //MySQLi approcach, using user we created and database -->
<!-- connect to data base -->
<?php 
    $conn = mysqli_connect("localhost", "hala", "halaspizza", "car_dealership");

    if(!$conn){
        echo "connection error: ". mysqli_connect_error();
    }

?>
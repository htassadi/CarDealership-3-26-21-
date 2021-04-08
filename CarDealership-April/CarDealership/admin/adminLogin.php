<?php 

include("../templates/header.php"); 

//connection
include("../config/db_connect.php");


//LOGIN VALIDATION 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['adminLoginBtn'])) {
     
    $AdminUsername = htmlspecialchars($_POST['username']);
    $AdminPassword = htmlspecialchars($_POST['password']);
    $accounts = mysqli_query($conn, "SELECT * FROM admin_accounts WHERE username = '$AdminUsername' && password = '$AdminPassword' ");

    if(mysqli_num_rows($accounts) > 0){
        header("Location: ../admin/adminPageInventory.php");
    } else {
        echo "<script language = 'javascript'>";
        echo "alert('WRONG INFORMATION')";
        echo "</script>";
    }
}
?>

<!-- HTML CODE -->

<div class="container py-5">

    <div class="col-sm-8 mb-5">
        <div class="bg-white rounded-lg p-3 shadow">
        <h3><ion-icon name="person-circle-outline"></ion-icon>   Admin Login </h3>
        </div>
    </div>

    <div class="col-xl-12 mb-3">
        <div class="bg-white rounded-lg p-4 shadow">
                <div class="rounded-lg mx-auto p-2" style = "background-color: #014421">
                    <div class="rounded-lg mx-auto p-2 bg-warning">
                        <div class="rounded-lg mx-auto shadow p-4 bg-light">

                            <form class="bg-light col-xl-6 mx-auto py-4" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                    <input type="username" class="form-control" id="inputUsername3" name="username">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                    <input type="password" class="form-control" id="inputPassword3" name="password">
                                    </div>
                                </div>

                                <button class="btn btn-outline-warning" style="color:#014421;" type="submit" name="adminLoginBtn"><strong>Login</strong></button>
                            </form>


                        </div>
                    </div>
                </div>
        </div>
    </div>

</div>



<?php include("../templates/footer.php"); ?>
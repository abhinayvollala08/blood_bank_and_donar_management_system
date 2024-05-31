<?php
include("connection.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="css/style1.css">
</head>

<body>
    <div id="full">
        <div id="inner-full">
            <div id="header">
                <h2 class="logo"><a href="admin-home.php" style=" text-decoration: none; color: black;">Blood Bank Management System</a></h2>
            </div>
            <div id="body">
                <br>
                <?php
                    $uname=$_SESSION['uname'];
                    if(!$uname){
                        header('Location:index.php');
                    }
                ?>
                <h1>Welcome Admin</h1>
                <br><br>
                <ul>
                    <li><a href="donor-reg.php">Donor Registration</a></li>
                    <li><a href="donor-list.php">Donor List</a></li>
                    <li><a href="stock-blood-list.php">Stock Blood List</a></li>
                </ul>
                <br><br><br><br>
                <ul>
                    <li><a href="out-stock-blood-list.php">Out-Stock Blood List</a></li>
                    <li><a href="exchange-blood-list.php">Exchange Blood Registration</a></li>
                    <li><a href="exchange-blood-list1.php">Exchange Blood List</a></li>
                    <!-- <li><a href="ngo-list.php">NGO List</a></li> -->
                </ul>
            </div>
            <div id="footer">
                <h4>Copyright</h4>
                <p style="color= black;"><a href="logout.php">Logout</a></p>
            </div>
        </div>
    </div>
</body>

</html>
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
                <h2 class="logo">Blood Bank Manageent System</h2>
            </div>
            <div id="body">
                <br><br><br><br>
                <form action="" method="post">
                <table align="center">
                    <tr>
                        <td width="200px" height="70px"><b>Enter Username</b></td>
                        <td width="100px" height="70px"><input type="text" name="uname" placeholder="Enter Username"
                                style="width: 150px; height: 30px; border-radius: 10px;"></td>
                    </tr>
                    <tr>
                        <td width="200px" height="70px"><b>Enter Password</b></td>
                        <td width="200px" height="70px"> <input type="text" name="pword" placeholder="Enter Password"
                                style="width: 150px; height: 30px; border-radius: 10px;"></td>
                    </tr>
                    <tr>
                        <!-- <td width="100px" height="50px"><b>Enter Password</b></td> -->
                        <td> <input type="submit" name="submit" value="Login"
                                style="width: 60px; height: 20px; border-radius: 3px; align-items: center"></td>
                    </tr>
                </table>
                </form>
                <?php
                if(isset($_POST["submit"]))
                {
                    $uname=$_POST['uname'];
                    $pword=$_POST['pword'];
                    $q=$db->prepare("SELECT * FROM admin WHERE uname='$uname' && pword='$pword'");
                    $q->execute();
                    $r=$q->fetchAll(PDO::FETCH_OBJ); 
                    // print_r($r);
                    if($r){

                        $_SESSION['uname']=$uname;
                        header("Location:admin-home.php");
                    }
                    else{
                        echo "<script>alert('Wrong Username or Password')</script>";
                    }
                }
                ?>
            </div>
            <div id="footer">
                <h4>Copyright</h4>
            </div>
        </div>
    </div>
</body>

</html>
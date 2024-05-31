<?php
include("connection.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Registration</title>
    <link rel="stylesheet" type="text/css" href="css/style1.css">
</head>

<body>
    <div id="full">
        <div id="inner-full">
            <div id="header">
                <h2 class="logo"><a href="admin-home.php" style=" text-decoration: none; color: black;">Blood Bank
                        Management System</a></h2>
            </div>
            <div id="body">
                <br>
                <?php
                $uname = $_SESSION['uname'];
                if (!$uname) {
                    header('Location:index.php');
                }
                ?>
                <h1>Donor Registration</h1>
                <center>
                    <div id="form">
                        <form action="" method="post">
                            <table>
                                <tr>
                                    <td width="200px" height="50px">Enter Name</td>
                                    <td width="200px" height="50px"><input type="text" name="name"
                                            placeholder="Enter Name"></td>
                                    <td width="200px" height="50px">Enter Father's Name</td>
                                    <td width="200px" height="50px"><input type="text" name="fname"
                                            placeholder="Enter Father Name"></td>
                                </tr>
                                <tr>
                                    <td width="200px" height="50px">Enter Address</td>
                                    <td width="200px" height="50px"><textarea name="address" id="address" cols="20"
                                            rows="5"></textarea></td>
                                    <td width="200px" height="50px">Enter City</td>
                                    <td width="200px" height="50px"><input type="text" name="city"
                                            placeholder="Enter City"></td>
                                </tr>
                                <tr>
                                    <td width="200px" height="50px">Enter Age</td>
                                    <td width="200px" height="50px"><input type="text" name="age"
                                            placeholder="Enter Age"></td>
                                    <td width="200px" height="50px">Blood Group</td>
                                    <td width="200px" height="50px">
                                        <select name="bgroup">
                                            <option value="O+">O+</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="200px" height="50px">Enter E-Mail</td>
                                    <td width="200px" height="50px"><input type="text" name="email"
                                            placeholder="Enter E-Mail"></td>
                                    <td width="200px" height="50px">Enter Mobile No.</td>
                                    <td width="200px" height="50px"><input type="text" name="mno"
                                            placeholder="Enter Mobile No"></td>
                                </tr>
                                <tr>
                                    <td><input type="submit" name="submit" value="Save"></td>
                                </tr>
                            </table>
                        </form>
                        <?php
                        if (isset($_POST['submit'])) {
                            // if ($_POST['submit'] == '') {}
                            $name=$_POST['name'];
                            $fname=$_POST['fname'];
                            $address=$_POST['address'];
                            $city=$_POST['city'];
                            $age=$_POST['age'];
                            $bgroup=$_POST['bgroup'];
                            $email=$_POST['email'];
                            $mno=$_POST['mno'];
                            // echo "<script> alert('Hello done')</script>";

                            $q=$db->prepare("INSERT INTO donor_registration (name,fname,address,city,age,bgroup,mno,email) VALUES(:name,:fname,:address,:city,:age,:bgroup,:mno,:email) ");
                            $q->bindValue("name", $name);
                            $q->bindValue("fname", $fname);
                            $q->bindValue("address", $address);
                            $q->bindValue("city", $city);
                            $q->bindValue("age", $age);
                            $q->bindValue("bgroup", $bgroup);
                            $q->bindValue("email", $email);
                            $q->bindValue("mno", $mno);
                            if($q->execute()){
                                echo "<script> alert('Donor Registration Successfull')</script>";
                            }
                            else{
                                echo "<script> alert('Donor Registration UnSuccessfull...!!!')</script>";
                            }
                        }
                        // else{
                        //     // echo "Not done";
                        //     // echo "<script> alert('Hello not done')</script>";
                        // }
                        ?>
                    </div>
                </center>
            </div>
            <div id="footer">
                <h4>Copyright</h4>
                <p style="color= black;"><a href="logout.php">Logout</a> <a href="admin-home.php">Back</a> </p>
                <!-- <p style="color= black;"><a href="admin-home.php">Back</a></p> -->
            </div>
        </div>
    </div>
</body>

</html>
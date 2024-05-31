<?php
include("connection.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exchange Blood Registration</title>
    <link rel="stylesheet" type="text/css" href="css/style1.css">
    <style>
        /* #form1{
            width: 80%;
            height: 320px;
            background-color: red;
            color: white;
            border-radius: 10px;
        } */
    </style>
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
                <h1>Exchange Blood Donor Registration</h1>
                <center>
                    <div id="form">
                        <form action="" method="post">
                            <table>
                                <tr>
                                    <td width="200px" height="50px">Enter Name</td>
                                    <td width="200px" height="50px"><input type="text" name="name" placeholder="Enter Name"></td>
                                    <td width="200px" height="50px">Enter Father's Name</td>
                                    <td width="200px" height="50px"><input type="text" name="fname"placeholder="Enter Father Name"></td>
                                </tr>
                                <tr>
                                    <td width="200px" height="50px">Enter Address</td>
                                    <td width="200px" height="50px"><textarea name="address" id="address" cols="20" rows="2"></textarea></td>
                                    <td width="200px" height="50px">Enter City</td>
                                    <td width="200px" height="50px"><input type="text" name="city"
                                            placeholder="Enter City"></td>
                                </tr>
                                <tr>
                                    <td width="200px" height="50px">Enter Age</td>
                                    <td width="200px" height="50px"><input type="text" name="age"
                                            placeholder="Enter Age"></td>
                                    <td width="200px" height="50px">Enter E-Mail</td>
                                    <td width="200px" height="50px"><input type="text" name="email"
                                            placeholder="Enter E-Mail"></td>
                                    
                                </tr>
                                <tr>   
                                    <td width="200px" height="50px">Enter Mobile No.</td>
                                    <td width="200px" height="50px"><input type="text" name="mno"
                                            placeholder="Enter Mobile No"></td>
                                </tr>
                                <tr>
                                <td width="200px" height="50px">Select Blood Group</td>
                                    <td width="200px" height="50px">
                                        <select name="bgroup">
                                            <option value="O+">O+</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                        </select>
                                    </td>
                                    <td width="200px" height="50px">Exchange Blood Group</td>
                                    <td width="200px" height="50px">
                                        <select name="exbgroup">
                                            <option value="O+">O+</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="submit" name="submit" value="Save"></td>
                                </tr>
                            </table>
                        </form>
                        <?php
                        if(isset($_POST['submit']))  {
                            //data input start
                            $name=$_POST['name'];
                            $fname=$_POST['fname'];
                            $address=$_POST['address'];
                            $city=$_POST['city'];
                            $age=$_POST['age'];
                            $bgroup=$_POST['bgroup'];
                            $mno=$_POST['mno'];
                            $email=$_POST['email'];
                            $exbgroup=$_POST['exbgroup'];
                            //data input end

                            //select and insert start
                            $q2="SELECT * FROM donor_registration WHERE bgroup='$bgroup' ";
                            $st=$db->query($q2);
                            $num_row=$st->fetch();
                            echo $id=$num_row['id'];
                            echo $name=$num_row['name'];
                            echo $b1=$num_row['bgroup'];
                            echo $mno=$num_row['mno'];
                            $q1="INSERT INTO out_stock_blood (bname,name,mno) value(?,?,?)";
                            $st1=$db->prepare($q1);
                            $st1->execute([$b1,$name,$mno]);

                            //   if($st1->execute([$b1,$name,$mno])){
                            //     echo "Insert";
                            // }
                            // else{
                            //     echo "Not Insert";
                            // }

                            //select and insert end

                            // delete query start
                            $delete_q="DELETE FROM donor_registration WHERE id='$id' ";
                            $st1=$db->prepare($delete_q);
                            $st1->execute();
                            //delete query end

                            //exchange information start
                            $q=$db->prepare("INSERT INTO exchange_b (name,fname,address,city,age,email,mno,bgroup,ebgroup) VALUES (:name,:fname,:address,:city,:age,:email,:mno,:bgroup,:ebgroup) ");
                            $q->bindValue('name',$name);
                            $q->bindValue('fname',$fname);
                            $q->bindValue('address',$address);
                            $q->bindValue('city',$city);
                            $q->bindValue('age',$age);
                            $q->bindValue('bgroup',$bgroup);
                            $q->bindValue('mno',$mno);
                            $q->bindValue('email',$email);
                            $q->bindValue('exbgroup',$exbgroup);
                            if($q->execute()){
                                echo "<script>alert('Registration Successfull')</script>";
                            }
                            else{
                                echo "<script>alert('Registration Un-Successfull...!!!!')</script>";
                            }

                            //exchange infromation end
                        }                      
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
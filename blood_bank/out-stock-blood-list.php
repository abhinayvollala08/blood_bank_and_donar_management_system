<?php
include("connection.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exchange Blood List</title>
    <link rel="stylesheet" type="text/css" href="css/style1.css">
    <style>
        td{
            width: 200px;
            height: 40px;
        }
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
                <h1>Out Stock Blood List</h1>
                <center>
                    <div id="form">
                       <table>
                        <tr>
                            <td><center><font color=black><b>Name</b></font></center></td>
                            <td><center><font color=black><b>Mobile Number</b></font></center></td>
                            <td><center><font color=black><b>Blood Group</b></font></center></td>
                        </tr>
                        <?php
                        // $q=$db->prepare('SELECT * FROM donor_registration');
                        // $q->fetchAll(PDO::FETCH_ASSOC);
                        // $r1=$q->execute();
                        $q=$db->query('SELECT * FROM out_stock_blood');
                        while($r1=$q->fetch(PDO::FETCH_OBJ)){
                            ?>
                            <tr>
                            <td><center><?=$r1->name; ?></center></td>
                            <td><center><?=$r1->mno; ?></center></td>
                            <td><center><?=$r1->bname; ?></center></td>
                        </tr>
                        <?php
                        }
                        ?>
                        
                       </table> 
                    </div>
                </center>
            </div>
            <div id="footer">
                <h4>Copyright</h4>
                <p style="color= black;"><a href="logout.php">Logout</a> <a href="admin-home.php">Back</a></p>
            </div>
        </div>
    </div>
</body>

</html>
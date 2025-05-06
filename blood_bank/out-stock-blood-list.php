<?php
include("connection.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Stock Management</title>
    <link rel="stylesheet" type="text/css" href="css/style1.css">
    <style>
        td, th {
            width: 200px;
            height: 40px;
            padding: 8px;
        }
        .section {
            margin-bottom: 40px;
        }
        h2 {
            color: #2c3e50;
            margin-top: 30px;
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
                
                <!-- Critically Low Stock Section -->
                <div class="section">
                    <h1>Critically Low Blood Stock (Less than 5 units)</h1>
                    <center>
                        <div id="form">
                           <table>
                            <tr>
                                <th><center>Blood Group</center></th>
                                <th><center>Available Units</center></th>
                            </tr>
                            <?php
                            $q = $db->query("SELECT * FROM blood_stock WHERE units < 5");
                            if($q->rowCount() > 0) {
                                while($r = $q->fetch(PDO::FETCH_OBJ)){
                                    ?>
                                    <tr>
                                    <td><center><?=$r->blood_group; ?></center></td>
                                    <td><center><?=$r->units; ?></center></td>
                                </tr>
                                <?php
                                }
                            } else {
                                echo '<tr><td colspan="2"><center>No blood groups in critical stock</center></td></tr>';
                            }
                            ?>
                           </table> 
                        </div>
                    </center>
                </div>

                <!-- Donation History Section -->
                <div class="section">
                    <h2>Donation History</h2>
                    <center>
                        <div id="form">
                           <table>
                            <tr>
                                <th><center>Donor Name</center></th>
                                <th><center>Donation Date</center></th>
                                <th><center>Blood Group</center></th>
                            </tr>
                            <?php
                            $donationQuery = $db->query("SELECT * FROM donations ORDER BY donation_date DESC");
                            if($donationQuery->rowCount() > 0) {
                                while($donation = $donationQuery->fetch(PDO::FETCH_OBJ)){
                                    ?>
                                    <tr>
                                    <td><center><?=$donation->donor_name; ?></center></td>
                                    <td><center><?=date('d-m-Y', strtotime($donation->donation_date)); ?></center></td>
                                    <td><center><?=$donation->blood_group; ?></center></td>
                                </tr>
                                <?php
                                }
                            } else {
                                echo '<tr><td colspan="3"><center>No donation records found</center></td></tr>';
                            }
                            ?>
                           </table> 
                        </div>
                    </center>
                </div>
            </div>
            <div id="footer">
                <h4>Copyright</h4>
                <p style="color= black;"><a href="logout.php">Logout</a> <a href="admin-home.php">Back</a></p>
            </div>
        </div>
    </div>
</body>
</html>

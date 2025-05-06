<?php
include("connection.php");
session_start();

// Redirect if not logged in
if (!isset($_SESSION['uname'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Request Management</title>
    <link rel="stylesheet" type="text/css" href="css/style1.css">
</head>
<body>
    <div id="full">
        <div id="inner-full">
            <div id="header">
                <h2 class="logo"><a href="admin-home.php" style="text-decoration: none; color: black;">Blood Bank Management System</a></h2>
            </div>
            <div id="body">
                <br>
                <h1>Blood Request Registration</h1>
                <center>
                    <div id="form">
                        <form action="" method="post">
                            <table>
                                <tr>
                                    <td width="200px" height="50px">Requester Name</td>
                                    <td width="200px" height="50px"><input type="text" name="name" placeholder="Full Name" required></td>
                                    <td width="200px" height="50px">Contact Person</td>
                                    <td width="200px" height="50px"><input type="text" name="contact_person" placeholder="Contact Person" required></td>
                                </tr>
                                <tr>
                                    <td width="200px" height="50px">Hospital/Organization</td>
                                    <td width="200px" height="50px"><input type="text" name="hospital" placeholder="Hospital Name" required></td>
                                    <td width="200px" height="50px">Requested Blood Group</td>
                                    <td width="200px" height="50px">
                                        <select name="blood_group" required>
                                            <option value="O+">O+</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="200px" height="50px">Quantity Needed (Units)</td>
                                    <td width="200px" height="50px"><input type="number" name="quantity" min="1" required></td>
                                    <td width="200px" height="50px">Urgency Level</td>
                                    <td width="200px" height="50px">
                                        <select name="urgency" required>
                                            <option value="Normal">Normal</option>
                                            <option value="Emergency">Emergency</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="200px" height="50px">Contact Number</td>
                                    <td width="200px" height="50px"><input type="tel" name="contact" placeholder="Contact Number" required></td>
                                    <td width="200px" height="50px">Email Address</td>
                                    <td width="200px" height="50px"><input type="email" name="email" placeholder="Email Address" required></td>
                                </tr>
                                <tr>
                                    <td colspan="4" align="center" height="50px">
                                        <input type="submit" name="submit" value="Submit Request">
                                    </td>
                                </tr>
                            </table>
                        </form>

                        <?php
                        if(isset($_POST['submit'])) {
                            // Sanitize inputs
                            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
                            $contact_person = filter_input(INPUT_POST, 'contact_person', FILTER_SANITIZE_STRING);
                            $hospital = filter_input(INPUT_POST, 'hospital', FILTER_SANITIZE_STRING);
                            $blood_group = filter_input(INPUT_POST, 'blood_group', FILTER_SANITIZE_STRING);
                            $quantity = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_NUMBER_INT);
                            $urgency = filter_input(INPUT_POST, 'urgency', FILTER_SANITIZE_STRING);
                            $contact = filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING);
                            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

                            try {
                                // Insert into blood_requests table
                                $stmt = $db->prepare("INSERT INTO blood_requests 
                                    (requester_name, contact_person, hospital, blood_group, quantity, urgency, contact_number, email, request_date, status)
                                    VALUES (:name, :contact_person, :hospital, :blood_group, :quantity, :urgency, :contact, :email, NOW(), 'Pending')");

                                $stmt->execute([
                                    ':name' => $name,
                                    ':contact_person' => $contact_person,
                                    ':hospital' => $hospital,
                                    ':blood_group' => $blood_group,
                                    ':quantity' => $quantity,
                                    ':urgency' => $urgency,
                                    ':contact' => $contact,
                                    ':email' => $email
                                ]);

                                echo "<script>alert('Blood request submitted successfully!')</script>";
                                
                                // Optional: Add inventory check and update logic here

                            } catch(PDOException $e) {
                                error_log("Database Error: " . $e->getMessage());
                                echo "<script>alert('Error submitting request. Please try again.')</script>";
                            }
                        }
                        ?>
                    </div>
                </center>
            </div>
            <div id="footer">
                <h4>Copyright</h4>
                <p><a href="logout.php">Logout</a> | <a href="admin-home.php">Back to Dashboard</a></p>
            </div>
        </div>
    </div>
</body>
</html>

<?php
include("connection.php");
session_start();

// Redirect to login if not authenticated
if (!isset($_SESSION['uname'])) {
    header('Location: index.php');
    exit(); // Always exit after header redirect
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/style1.css">
    <style>
        .dashboard-section {
            margin: 20px 0;
            padding: 20px;
            border-bottom: 1px solid #eee;
        }
        .nav-menu {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            list-style: none;
            padding: 0;
        }
        .nav-menu li {
            background: #f8f9fa;
            border-radius: 8px;
            transition: transform 0.2s;
        }
        .nav-menu li:hover {
            transform: translateY(-3px);
        }
        .nav-menu a {
            display: block;
            padding: 1.5rem;
            text-decoration: none;
            color: #212529;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div id="full">
        <div id="inner-full">
            <div id="header">
                <h2 class="logo">
                    <a href="admin-home.php" style="text-decoration: none; color: black;">
                        Blood Bank Management System
                    </a>
                </h2>
            </div>
            
            <div id="body">
                <div class="dashboard-section">
                    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['uname']); ?></h1>
                    
                    <nav aria-label="Main navigation">
                        <ul class="nav-menu">
                            <!-- Donor Management -->
                            <li>
                                <a href="donor-reg.php">
                                    🩸 Donor Registration
                                </a>
                            </li>
                            <li>
                                <a href="donor-list.php">
                                    📋 Registered Donors
                                </a>
                            </li>

                            <!-- Inventory Management -->
                            <li>
                                <a href="stock-blood-list.php">
                                    🧪 Blood Inventory
                                </a>
                            </li>
                            <li>
                                <a href="out-stock-blood-list.php">
                                    🔴 Critical Stock
                                </a>
                            </li>

                            <!-- Request Management -->
                            <li>
                                <a href="blood-request-list.php">
                                    🚑 New Blood Request
                                </a>
                            </li>
                            <li>
                                <a href="blood-request-list.php">
                                    📦 Active Requests
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div id="footer">
                <h4>Blood Bank Management System © <?php echo date('Y'); ?></h4>
                <p>
                    <a href="logout.php" style="color: #dc3545;">Logout</a> | 
                    <a href="audit-log.php">Audit Log</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>

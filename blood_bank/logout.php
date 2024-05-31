<?php
session_start();
$uname=$_SESSION['uname'];
// unset($uname);
session_destroy(); 
header('Location:index.php');
?>

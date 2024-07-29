<?php
session_start(); 
session_destroy(); // destroy session
header("location:../user/login.php"); 
?>


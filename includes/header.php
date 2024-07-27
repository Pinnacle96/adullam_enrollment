<?php
include('includes/dbconnection.php');
session_start();
error_reporting(0);
?>
<!doctype html>
<html lang="en">

<head>

  <title>ADULLAM || Admission Management System||Courses</title>
  <!-- web fonts -->
  <link href="//fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
  <!-- //web fonts -->
  <!-- Favicons -->
  <link rel="icon" href="./assets/images/favicon/favicon.png" type="image/x-icon" />
  <link rel="apple-touch-icon" sizes="180x180" href="./assets/images//favicon/favicon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="./assets/images//favicon/favicon.png">
  <link rel="icon" type="image/png" sizes="16x16" href="./assets/images//favicon/favicon.png">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style-starter.css">
  </head>

<body><!-- Top Menu 1 -->
<section class="w3l-top-menu-1">
  <div class="top-hd">
    <div class="container">
  <header class="row top-menu-top">
    <div class="accounts col-md-9 col-6">
      <?php

$ret=mysqli_query($con,"select * from tblpage where PageType='contactus' ");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
        <li class="top_li"><span class="fa fa-phone"></span>+234<?php  echo $row['MobileNumber'];?></li>
        <li class="top_li1"><span class="fa fa-envelope-o"></span> <?php  echo $row['Email'];?> </li>
    </div><?php } ?>
    <div class="social-top col-md-3 col-6">
      <a href="#user/login.php" class="btn btn-secondary btn-theme4">E-Portal</a>
    </div>
  </header>
</div>
</div>
</section>
<!-- //Top Menu 1 -->
<section class="w3l-bootstrap-header">
  <nav class="navbar navbar-expand-lg navbar-light py-lg-2 py-2">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <img src="./assets/images/logo1.png" alt="" height="45px" width="150px" class="logo"></a>
     
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon fa fa-bars"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
            <li class="nav-item">
            <a class="nav-link" href="courses.php">Program</a>
          </li>
        
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="notice-details.php">Public Notice</a>
          </li>
         <!-- <li class="nav-item">
            <a class="nav-link" href="admin/login.php">Admin</a>
          </li>-->
          <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Admission
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="user/login.php">Undergraduate Program</a>
        <a class="dropdown-item" href="pgdt/login.php">Postgraduate Program</a>
        <!-- Add more items as needed -->
    </div>
</li>
        </ul>
       
      </div>
    </div>
  </nav>
</section>
<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/dbconnection.php');

if (strlen($_SESSION['aid']) == 0) {
    header('location:logout.php');
    exit;
}

if (isset($_POST['submit'])) {
    $fname = $_POST['AdminName'];
    $mname = $_POST['AdminuserName'];
    $contno = $_POST['MobileNumber'];
    $email = $_POST['Email'];
    $password = password_hash($_POST['Password'], PASSWORD_DEFAULT); // Use password_hash for better security

    // Use prepared statements to prevent SQL injection
    $stmt = $con->prepare("SELECT Email FROM tblmanage WHERE Email = ? OR MobileNumber = ?");
    if (!$stmt) {
        die("Prepare failed: " . $con->error);
    }
    
    $stmt->bind_param("ss", $email, $contno);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('This email or Contact Number is already associated with another account');</script>";
    } else {
        $stmt = $con->prepare("INSERT INTO tblmanage (AdminName, AdminuserName, MobileNumber, Email, Password) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("Prepare failed: " . $con->error);
        }
        
        $stmt->bind_param("sssss", $fname, $mname, $contno, $email, $password);

        if ($stmt->execute()) {
            echo "<script>alert('You have successfully registered');</script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again');</script>";
            echo "Error: " . $stmt->error; // Display SQL error
        }
    }
}
?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <title>College Admission Management System | User Signup</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .errorWrap { padding: 10px; margin: 20px 0; background: #fff; border-left: 4px solid #dd3d36; box-shadow: 0 1px 1px rgba(0,0,0,.1); }
        .succWrap { padding: 10px; margin: 0 0 20px; background: #fff; border-left: 4px solid #5cb85c; box-shadow: 0 1px 1px rgba(0,0,0,.1); }
    </style>
</head>
<body class="vertical-layout vertical-menu-modern 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
        <?php include('includes/header.php'); ?>
        <?php include('includes/leftbar.php'); ?>
        <div class="app-content content">
            <div class="content-wrapper">
                <div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                        <h3 class="content-header-title mb-0 d-inline-block">Between Dates Report Details</h3>
                        <div class="row breadcrumbs-top d-inline-block">
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Between Dates Report Details</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-body">
                                    <div class="card-body">
                                        <form method="post" name="signup" onSubmit="return checkpass();">
                                            <div class="row">
                                                <div class="col-12 col-sm-12 col-md-12">
                                                    <fieldset class="form-group position-relative has-icon-left">
                                                        <input type="text" name="AdminName" id="AdminName" required="true" class="form-control input-lg" placeholder="FullName" tabindex="1">
                                                        <div class="form-control-position">
                                                            <i class="ft-user"></i>
                                                        </div>
                                                    </fieldset>
                                                </div>

                                                <div class="col-12 col-sm-12 col-md-12">
                                                    <fieldset class="form-group position-relative has-icon-left">
                                                        <input type="text" name="AdminuserName" id="AdminuserName" required="true" class="form-control input-lg" placeholder="UserName" tabindex="2">
                                                        <div class="form-control-position">
                                                            <i class="ft-user"></i>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-12 col-md-12">
                                                    <fieldset class="form-group position-relative has-icon-left">
                                                        <input type="text" name="MobileNumber" id="contactno" class="form-control input-lg" placeholder="Contact Number" required="true" maxlength="20" tabindex="3">
                                                        <div class="form-control-position">
                                                            <i class="ft-phone"></i>
                                                        </div>
                                                        <div class="help-block font-small-3"></div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-12 col-md-12">
                                                    <fieldset class="form-group position-relative has-icon-left">
                                                        <input type="email" name="Email" id="Email" class="form-control input-lg" placeholder="Email Address" tabindex="4" required="true">
                                                        <div class="form-control-position">
                                                            <i class="ft-mail"></i>
                                                        </div>
                                                        <div class="help-block font-small-3"></div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-12 col-md-12">
                                                    <fieldset class="form-group position-relative has-icon-left">
                                                        <input type="password" name="Password" id="Password" class="form-control input-lg" placeholder="Password" tabindex="5" required>
                                                        <div class="form-control-position">
                                                            <i class="la la-key"></i>
                                                        </div>
                                                        <div class="help-block font-small-3"></div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-12 col-md-12">
                                                    <button type="submit" name="submit" class="btn btn-info btn-lg btn-block"><i class="ft-user"></i> Register</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
     
                <footer class="footer footer-static footer-light navbar-border navbar-shadow">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
      <span class="float-md-left d-block d-md-inline-block">Designed & Developed By Pinnacle Tech Hub</span>
    </p>
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
      <span class="float-md-left d-block d-md-inline-block">Copyright &copy; <?php
                    $currentYear = date('Y');
                    $endYear = 2027; // You can change this to any future year
                ?>
                <?php echo $currentYear; ?> - <?php echo $endYear; ?> <a class="text-bold-800 grey darken-2">ADULLAM </a>, All rights reserved. </span>
    </p>
  </footer>
  <script src="../app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>

  <script src="../app-assets/vendors/js/forms/extended/typeahead/typeahead.bundle.min.js" type="text/javascript"></script>
  <script src="../app-assets/vendors/js/forms/extended/typeahead/bloodhound.min.js" type="text/javascript"></script>
  <script src="../app-assets/vendors/js/forms/extended/typeahead/handlebars.js" type="text/javascript"></script>
  <script src="../app-assets/vendors/js/forms/extended/inputmask/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
  <script src="../app-assets/vendors/js/forms/extended/formatter/formatter.min.js" type="text/javascript"></script>
  <script src="../app-assets/vendors/js/forms/extended/maxlength/bootstrap-maxlength.js" type="text/javascript"></script>
  <script src="../app-assets/vendors/js/forms/extended/card/jquery.card.js" type="text/javascript"></script>
  <script src="../app-assets/js/core/app-menu.js" type="text/javascript"></script>
  <script src="../app-assets/js/core/app.js" type="text/javascript"></script>
  <script src="../app-assets/js/scripts/customizer.js" type="text/javascript"></script>
  <script src="../app-assets/js/scripts/forms/extended/form-typeahead.js" type="text/javascript"></script>
  <script src="../app-assets/js/scripts/forms/extended/form-inputmask.js" type="text/javascript"></script>
  <script src="../app-assets/js/scripts/forms/extended/form-formatter.js" type="text/javascript"></script>
  <script src="../app-assets/js/scripts/forms/extended/form-maxlength.js" type="text/javascript"></script>
  <script src="../app-assets/js/scripts/forms/extended/form-card.js" type="text/javascript"></script>
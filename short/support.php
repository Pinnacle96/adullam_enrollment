<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('includes/dbconnection.php');

// Check if user is logged in
if (strlen($_SESSION['uid']) == 0) {
    header('location:logout.php');
    exit(); // Stop further execution
} else {
    // Check if form is submitted
    if (isset($_POST['submit'])) {
        // Store all POST data in the session
        foreach ($_POST as $key => $value) {
            $_SESSION['post'][$key] = $value;
        }

        // Define the list of files to handle
        $files = ['birthCert', 'lgaCert', 'refLetter', 'acadCert'];

        // Handle file uploads
        $uploadDir = '..user/uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        foreach ($files as $file) {
            if (isset($_FILES[$file]) && $_FILES[$file]['error'] == UPLOAD_ERR_OK) {
                // Generate a unique file name to avoid overwriting
                $fileName = uniqid() . '_' . basename($_FILES[$file]['name']);
                $uploadFile = $uploadDir . $fileName;

                // Move the uploaded file to the directory
                if (move_uploaded_file($_FILES[$file]['tmp_name'], $uploadFile)) {
                    // Save the file path in the session
                    $_SESSION['post'][$file] = $fileName; // Only store the file name
                } else {
                    echo "Error moving the uploaded file: $file.";
                    // Handle this error gracefully as needed
                }
            } else {
                // Handle file upload errors if necessary
                if (isset($_FILES[$file]['error']) && $_FILES[$file]['error'] != UPLOAD_ERR_OK) {
                    echo "Error uploading file: $file. Error code: " . $_FILES[$file]['error'];
                    // Handle this error gracefully as needed
                }
            }
        }

        // Redirect to the next step (e.g., support.php)
        header("Location: fees.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <title>Admission Management System || Admission Form</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <style>
        .errorWrap {
            padding: 10px;
            margin: 20px 0 0px 0;
            background: #fff;
            border-left: 4px solid #dd3d36;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        }
        .succWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #5cb85c;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        }
    </style>
</head>
<body class="vertical-layout vertical-menu-modern 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
<?php include('includes/header.php'); ?>
<?php include('includes/leftbar.php'); ?>
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">Admission Application Form</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Application</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <p style="font-size:16px; color:red" align="center">No admission form found.</p>
            <form name="submit" method="post" enctype="multipart/form-data">        
                <section class="formatter" id="formatter">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">ADMISSION FORM</h4>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row" style="margin-top: 2%">
                                        </div>
            <fieldset>
				<h4 class="card-title"><b>SUPPORTING DOCUMENT</b></h4><br>
				<div class="row">
					<div class="col-xl-6 col-lg-4">
						<h5>Upload Birth Certificate or Declaration of Age</h5>
						<div class="form-group">
							<input class="form-control white_bg" id="birthCert" name="birthCert" type="file" >
						</div>
					</div>

					<div class="col-xl-6 col-lg-4">

						<h5>Upload State/Local Government of Origin</h5>
						<div class="form-group">
							<input class="form-control white_bg" id="lgaCert" name="lgaCert" type="file" >
						</div>

					</div>
					<div class="col-xl-6 col-lg-4">

						<h5>Upload Reference Letter from a Clergy</h5>
						<div class="form-group">
							<input class="form-control white_bg" id="refLetter" name="refLetter" type="file" >
						</div>

					</div>
					<div class="col-xl-6 col-lg-4">

						<h5>Upload Academic Degree Certificate (Diploma degree or it's equivalent)</h5>
						<div class="form-group">
							<input class="form-control white_bg" id="acadCert" name="acadCert" type="file" >
						</div>
					</div>
				</div>
                <a href="reference.php"> <input type="button" class="next btn btn-info mb-3" value="Previous" /></a>
                <input type="submit" name="submit" class="next btn btn-info mb-3" value="Next" />
			</fieldset>
			</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </div>
</div>
<?php include 'includes/footer.php';?>
<script>
function CallPrint(strid) {
var prtContent = document.getElementById("exampl");
var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
WinPrint.document.write(prtContent.innerHTML);
WinPrint.document.close();
WinPrint.focus();
WinPrint.print();
}
</script>
</body>
</html>
<?php //}?>

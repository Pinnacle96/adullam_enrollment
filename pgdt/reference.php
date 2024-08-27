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
    // // Fetch user data from the database
    // $userEmail = $_SESSION['SESSION_EMAIL'];
    // $query = "SELECT fname, lname, mname, email FROM tbluser WHERE email = ?";
    // $stmt = $con->prepare($query);
    // $stmt->bind_param('s', $userEmail);
    // $stmt->execute();
    // $stmt->bind_result($fname, $lname, $mname, $email);
    // $stmt->fetch();
    // $stmt->close();

    // Check if form is submitted
    if (isset($_POST['submit'])) {
        // Store all POST data in the session
        foreach ($_POST as $key => $value) {
            $_SESSION['post'][$key] = $value;
        }

        // Handle file upload if any
        // if (isset($_FILES['userpic']) && $_FILES['userpic']['error'] == UPLOAD_ERR_OK) {
        //     // Create upload directory if it doesn't exist
        //     $uploadDir = './uploads/';
        //     if (!is_dir($uploadDir)) {
        //         mkdir($uploadDir, 0777, true);
        //     }

        //     // Generate a unique file name to avoid overwriting
        //     $fileName = uniqid() . '_' . basename($_FILES['userpic']['name']);
        //     $uploadFile = $uploadDir . $fileName;

        //     // Move the uploaded file to the directory
        //     if (move_uploaded_file($_FILES['userpic']['tmp_name'], $uploadFile)) {
        //         // Save the file path in the session
        //         $_SESSION['post']['userpic'] = $fileName; // Only store the file name
        //     } else {
        //         echo "Error moving the uploaded file.";
        //         // You might want to handle this case more gracefully
        //     }
        // } else {
        //     // Handle file upload errors if necessary
        //     if (isset($_FILES['userpic']['error']) && $_FILES['userpic']['error'] != UPLOAD_ERR_OK) {
        //         echo "Error uploading file: " . $_FILES['userpic']['error'];
        //         // Again, handle this case as needed
        //     }
        // }

        // Redirect to profile.php
        header("Location: support.php");
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
				<h4 class="card-title"><b>REFERENCE</b></h4><br>
				<div class="row">
					<div class="col-xl-6 col-lg-4">
						<h5>Reference 1 Name </h5>
						<div class="form-group">
							<input class="form-control white_bg" id="ref1Name" name="ref1Name" type="text" value="<?php echo isset($_SESSION['post']['ref1Name']) ? $_SESSION['post']['ref1Name'] : ''; ?>" required>
						</div>
					</div>
					<div class="col-xl-6 col-lg-4">

						<h5>Reference 1 Phone Number </h5>
						<div class="form-group">
							<input class="form-control white_bg" id="ref1Phone" name="ref1Phone" type="text" value="<?php echo isset($_SESSION['post']['ref1Phone']) ? $_SESSION['post']['ref1Phone'] : ''; ?>" required>
						</div>
					</div>
					<div class="col-xl-6 col-lg-4">
						<h5>Reference 1 Email </h5>
						<div class="form-group">
							<input class="form-control white_bg" id="ref1Email" name="ref1Email" type="email" value="<?php echo isset($_SESSION['post']['ref1Email']) ? $_SESSION['post']['ref1Email'] : ''; ?>" required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-6 col-lg-4">

						<h5>Reference 2 Name </h5>
						<div class="form-group">
							<input class="form-control white_bg" id="ref2Name" name="ref2Name" type="text" value="<?php echo isset($_SESSION['post']['ref2Name']) ? $_SESSION['post']['ref2Name'] : ''; ?>"  required>
						</div>


					</div>
					<div class="col-xl-6 col-lg-4">

						<h5>Reference 2 Phone Number </h5>
						<div class="form-group">
							<input class="form-control white_bg" id="ref2Phone" name="ref2Phone" type="text" value="<?php echo isset($_SESSION['post']['ref2Phone']) ? $_SESSION['post']['ref2Phone'] : ''; ?>" required>
						</div>

					</div>
					<div class="col-xl-6 col-lg-4">

						<h5>Reference 2 Email </h5>
						<div class="form-group">
							<input class="form-control white_bg" id="ref2Email" name="ref2Email" type="email" value="<?php echo isset($_SESSION['post']['ref2Email']) ? $_SESSION['post']['ref2Email'] : ''; ?>" required>
						</div>
					</div>
				</div>
                <a href="autobiography.php"> <input type="button" class="next btn btn-info mb-3" value="Previous" /></a>
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
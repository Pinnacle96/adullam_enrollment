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
        header("Location: church.php");
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
    <h4 class="card-title"><b>PERSONAL</b></h4>

    <h4 class="card-title"><b>MARITAL STATUS</b></h4>
    <div class="row">
        <div class="col-xl-6 col-lg-6">
            <h5>Marital Status as at the time of enrollment</h5>
            <div class="form-group">
                <select class="form-control white_bg" name="maritalstatus" id="maritalstatus" required>
                    <option value="">Marital Status</option>
                    <option value="Married" <?php echo isset($_SESSION['post']['maritalstatus']) && $_SESSION['post']['maritalstatus'] == 'Married' ? 'selected' : ''; ?>>Married</option>
                    <option value="Divorced" <?php echo isset($_SESSION['post']['maritalstatus']) && $_SESSION['post']['maritalstatus'] == 'Divorced' ? 'selected' : ''; ?>>Divorced</option>
                    <option value="Remarried" <?php echo isset($_SESSION['post']['maritalstatus']) && $_SESSION['post']['maritalstatus'] == 'Remarried' ? 'selected' : ''; ?>>Remarried</option>
                    <option value="Separated" <?php echo isset($_SESSION['post']['maritalstatus']) && $_SESSION['post']['maritalstatus'] == 'Separated' ? 'selected' : ''; ?>>Separated</option>
                    <option value="Single" <?php echo isset($_SESSION['post']['maritalstatus']) && $_SESSION['post']['maritalstatus'] == 'Single' ? 'selected' : ''; ?>>Single</option>
                    <option value="Widowed" <?php echo isset($_SESSION['post']['maritalstatus']) && $_SESSION['post']['maritalstatus'] == 'Widowed' ? 'selected' : ''; ?>>Widowed</option>
                </select>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
            <h5>Number of Children</h5>
            <div class="form-group">
                <input class="form-control white_bg" id="children" name="children" type="text" value="<?php echo isset($_SESSION['post']['children']) ? $_SESSION['post']['children'] : ''; ?>" required>
            </div>
        </div>
    </div>

    <h4 class="card-title"><b>DISABILITIES</b></h4>
    <div class="row">
	<div class="col-xl-12 col-lg-12">
            <h5>Do you have any physical, mental or emotional disabilities which may require special assistance?</h5>
            <div class="form-group">
                <select class="form-control white_bg" name="dhealth" id="dhealth" required>
                    <option value="">Choose an Option</option>
                    <option value="Yes" <?php echo isset($_SESSION['post']['dhealth']) && $_SESSION['post']['dhealth'] == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                    <option value="No" <?php echo isset($_SESSION['post']['dhealth']) && $_SESSION['post']['dhealth'] == 'No' ? 'selected' : ''; ?>>No</option>
                </select>
            </div>
        </div>
    </div>

    <h4 class="card-title"><b>Academic or Disciplinary Probation</b></h4>
    <div class="row">
	<div class="col-xl-12 col-lg-12">
            <h5>Have you ever been dismissed, placed on academic or disciplinary probation, or asked to withdraw by any educational institution?</h5>
            <div class="form-group">
                <select class="form-control white_bg" name="disciplinary" id="disciplinary" required>
                    <option value="">Choose an Option</option>
                    <option value="Yes" <?php echo isset($_SESSION['post']['disciplinary']) && $_SESSION['post']['disciplinary'] == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                    <option value="No" <?php echo isset($_SESSION['post']['disciplinary']) && $_SESSION['post']['disciplinary'] == 'No' ? 'selected' : ''; ?>>No</option>
                </select>
            </div>
        </div>
    </div>

    <h4 class="card-title"><b>Mental Health Care</b></h4>
    <div class="row">
	<div class="col-xl-12 col-lg-12">
            <h5>Have you ever been under the care of a psychologist, mental health counselor, or psychiatrist?</h5>
            <div class="form-group">
                <select class="form-control white_bg" name="mental_health" id="mental_health" required>
                    <option value="">Choose an Option</option>
                    <option value="Yes" <?php echo isset($_SESSION['post']['mental_health']) && $_SESSION['post']['disciplinary'] == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                    <option value="No" <?php echo isset($_SESSION['post']['mental_health']) && $_SESSION['post']['disciplinary'] == 'No' ? 'selected' : ''; ?>>No</option>
                </select>
            </div>
        </div>
    </div>

    <h4 class="card-title"><b>Bankruptcy</b></h4>
    <div class="row">
	<div class="col-xl-12 col-lg-12">
            <h5>Have you ever declared bankruptcy or incurred any legal action against you associated with your finances?</h5>
            <div class="form-group">
                <select class="form-control white_bg" name="fbank" id="fbank" required>
                    <option value="">Choose an Option</option>
                    <option value="Yes" <?php echo isset($_SESSION['post']['fbank']) && $_SESSION['post']['fbank'] == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                    <option value="No" <?php echo isset($_SESSION['post']['fbank']) && $_SESSION['post']['fbank'] == 'No' ? 'selected' : ''; ?>>No</option>
                </select>
            </div>
        </div>
    </div>

    <h4 class="card-title"><b>Drug/Alcohol Abuse</b></h4>
    <div class="row">
	<div class="col-xl-12 col-lg-12">
            <h5>Have you ever used illegal drugs or abused alcohol?</h5>
            <div class="form-group">
                <select class="form-control white_bg" name="drug" id="drug" required>
                    <option value="">Choose an Option</option>
                    <option value="Yes" <?php echo isset($_SESSION['post']['drug']) && $_SESSION['post']['drug'] == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                    <option value="No" <?php echo isset($_SESSION['post']['drug']) && $_SESSION['post']['drug'] == 'No' ? 'selected' : ''; ?>>No</option>
                </select>
            </div>
        </div>
    </div>

    <h4 class="card-title"><b>Employment</b></h4>
    <div class="row">
	<div class="col-xl-12 col-lg-12">
            <h5>Have you ever been dismissed, terminated, or fired from any place of employment?</h5>
            <div class="form-group">
                <select class="form-control white_bg" name="employment" id="employment" required>
                    <option value="">Choose an Option</option>
                    <option value="Yes" <?php echo isset($_SESSION['post']['employment']) && $_SESSION['post']['employment'] == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                    <option value="No" <?php echo isset($_SESSION['post']['employment']) && $_SESSION['post']['employment'] == 'No' ? 'selected' : ''; ?>>No</option>
                </select>
            </div>
        </div>
    </div>

    <h4 class="card-title"><b>Felony/Dishonorable Discharge</b></h4>
    <div class="row">
	<div class="col-xl-12 col-lg-12">
            <h5>Have you ever been convicted of any felony or been dishonorably discharged from any branch of the Armed Services?</h5>
            <div class="form-group">
                <select class="form-control white_bg" name="felony" id="felony" required>
                    <option value="">Choose an Option</option>
                    <option value="Yes" <?php echo isset($_SESSION['post']['felony']) && $_SESSION['post']['felony'] == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                    <option value="No" <?php echo isset($_SESSION['post']['felony']) && $_SESSION['post']['felony'] == 'No' ? 'selected' : ''; ?>>No</option>
                </select>
            </div>
        </div>
    </div>

    <h4 class="card-title"><b>Sexual Misconduct</b></h4>
    <div class="row">
	<div class="col-xl-12 col-lg-12">
            <h5>Have you ever been accused or charged with any sexually related misconduct?</h5>
            <div class="form-group">
                <select class="form-control white_bg" name="smisconduct" id="smisconduct" required>
                    <option value="">Choose an Option</option>
                    <option value="Yes" <?php echo isset($_SESSION['post']['smisconduct']) && $_SESSION['post']['smisconduct'] == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                    <option value="No" <?php echo isset($_SESSION['post']['smisconduct']) && $_SESSION['post']['smisconduct'] == 'No' ? 'selected' : ''; ?>>No</option>
                </select>
            </div>
        </div>
    </div>

    <h4 class="card-title"><b>Sex Offence</b></h4>
    <div class="row">
	<div class="col-xl-12 col-lg-12">
            <h5>Are you a registered sex offender or convicted of a sex-related offence?</h5>
            <div class="form-group">
                <select class="form-control white_bg" name="soffence" id="soffence" required>
                    <option value="">Choose an Option</option>
                    <option value="Yes" <?php echo isset($_SESSION['post']['soffence']) && $_SESSION['post']['soffence'] == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                    <option value="No" <?php echo isset($_SESSION['post']['soffence']) && $_SESSION['post']['soffence'] == 'No' ? 'selected' : ''; ?>>No</option>
                </select>
            </div>
        </div>
    </div>

    <h4 class="card-title"><b>Divorce</b></h4>
    <div class="row">
	<div class="col-xl-12 col-lg-12">
            <h5>Have you ever been divorced?</h5>
            <div class="form-group">
                <select class="form-control white_bg" name="divource" id="divource" required>
                    <option value="">Choose an Option</option>
                    <option value="Yes" <?php echo isset($_SESSION['post']['divource']) && $_SESSION['post']['divource'] == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                    <option value="No" <?php echo isset($_SESSION['post']['divource']) && $_SESSION['post']['divource'] == 'No' ? 'selected' : ''; ?>>No</option>
                </select>
            </div>
        </div>
    </div>

    <h4 class="card-title"><b>Spouse</b></h4>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <h5>If married, is your spouse in full agreement with your desire to pursue this program?</h5>
            <div class="form-group">
                <select class="form-control white_bg" name="spouse" id="spouse" required>
                    <option value="">Choose an Option</option>
                    <option value="Yes" <?php echo isset($_SESSION['post']['spouse']) && $_SESSION['post']['spouse'] == 'Yes' ? 'selected' : ''; ?>>Yes</option>
                    <option value="No" <?php echo isset($_SESSION['post']['spouse']) && $_SESSION['post']['spouse'] == 'No' ? 'selected' : ''; ?>>No</option>
                </select>
            </div>
        </div>
    </div>
	<a href="addmission-form.php"> <input type="button" class="next btn btn-info mb-3" value="Previous" /></a>
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
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
    // Fetch user data from the database
    $userEmail = $_SESSION['uid'];
    $query = "SELECT fname, lname, mname, email FROM tbluser WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('s', $userEmail);
    $stmt->execute();
    $stmt->bind_result($fname, $lname, $mname, $email);
    $stmt->fetch();
    $stmt->close();

    // Check if form is submitted
    $formSubmitted = false;
    $admissionData = [];
    if (isset($_POST['submit'])) {
        // Store all POST data in the session
        foreach ($_POST as $key => $value) {
            $_SESSION['post'][$key] = $value;
        }

        // Handle file upload if any
        if (isset($_FILES['userpic']) && $_FILES['userpic']['error'] == UPLOAD_ERR_OK) {
            // Create upload directory if it doesn't exist
            $uploadDir = '..user/uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Generate a unique file name to avoid overwriting
            $fileName = uniqid() . '_' . basename($_FILES['userpic']['name']);
            $uploadFile = $uploadDir . $fileName;

            // Move the uploaded file to the directory
            if (move_uploaded_file($_FILES['userpic']['tmp_name'], $uploadFile)) {
                // Save the file path in the session
                $_SESSION['post']['userpic'] = $fileName; // Only store the file name
            } else {
                echo "Error moving the uploaded file.";
                // You might want to handle this case more gracefully
            }
        } else {
            // Handle file upload errors if necessary
            if (isset($_FILES['userpic']['error']) && $_FILES['userpic']['error'] != UPLOAD_ERR_OK) {
                echo "Error uploading file: " . $_FILES['userpic']['error'];
                // Again, handle this case as needed
            }
        }

        // Redirect to profile.php
        header("Location: profile.php");
        exit();
    }

    // Check if the admission form is already submitted
$stuid = $_SESSION['uid'];
$query = mysqli_query($con, "SELECT tbladmission.*, tbluser.program, tbluser.learningmode 
                             FROM tbladmission 
                             JOIN tbluser ON tbluser.id = tbladmission.userid 
                             WHERE tbladmission.userid = $stuid");
$admissionData = mysqli_fetch_assoc($query);
$formSubmitted = !empty($admissionData);
}
?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <title>Admission Management System || Admission Form</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        .table th, .table td {
            vertical-align: middle;
        }
        .form-details {
            margin-top: 20px;
        }
        .print-button {
            margin-top: 20px;
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
                <?php if ($formSubmitted): ?>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Admission Form Details</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                    <td><b>Reg No</b></td>
                                            <td><?php echo htmlspecialchars($admissionData['regno'] ?? 'N/A', ENT_QUOTES); ?></td>
                                            <td>Title</td>
                                            <td><?php echo htmlspecialchars($admissionData['title'] ?? 'N/A', ENT_QUOTES); ?></td>
                                           
                                            <td><img src="uploads/<?php echo htmlspecialchars($admissionData['userpic'] ?? 'default.png', ENT_QUOTES); ?>" alt="Userpic" style="width: 150px;"></td>
                                        </tr>
                                        <tr>
                                            <td>Program</td>
                                            <td><?php echo htmlspecialchars($admissionData['program'] ?? 'N/A', ENT_QUOTES); ?></td>
                                            <td>Learning Mode</td>
                                            <td><?php echo htmlspecialchars($admissionData['learningmode'] ?? 'N/A', ENT_QUOTES); ?></td>
                                        </tr>
                                         <tr>
                                            <td>First Name</td>
                                            <td><?php echo htmlspecialchars($admissionData['fname'] ?? 'N/A', ENT_QUOTES); ?></td>
                                            <td>Last Name</td>
                                            <td><?php echo htmlspecialchars($admissionData['lname'] ?? 'N/A', ENT_QUOTES); ?></td>
                                            <td>Email</td>
                                            <td><?php echo htmlspecialchars($admissionData['email'] ?? 'N/A', ENT_QUOTES); ?></td>
                                        </tr>
                                     <tr>
                                            <td>Phone</td>
                                            <td><?php echo htmlspecialchars($admissionData['phone'] ?? 'N/A', ENT_QUOTES); ?></td>
                                            <td>Gender</td>
                                            <td><?php echo htmlspecialchars($admissionData['gender'] ?? 'N/A', ENT_QUOTES); ?></td>
                                            <td>Date of Birth</td>
                                            <td><?php echo htmlspecialchars($admissionData['dob'] ?? 'N/A', ENT_QUOTES); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Birth Certificate</td>
                                            <td><a href="uploads/<?php echo htmlspecialchars($admissionData['birthCert'] ?? 'default.pdf', ENT_QUOTES); ?>" target="_blank">View</a></td>
                                            <td>LGA Certificate</td>
                                            <td><a href="uploads/<?php echo htmlspecialchars($admissionData['lgaCert'] ?? 'default.pdf', ENT_QUOTES); ?>" target="_blank">View</a></td>
                                            <td>Reference Letter</td>
                                            <td><a href="uploads/<?php echo htmlspecialchars($admissionData['refLetter'] ?? 'default.pdf', ENT_QUOTES); ?>" target="_blank">View</a></td>
                                        </tr>
                                       
                                        <tr>
                                            <td>Academic Certificate</td>
                                            <td><a href="uploads/<?php echo htmlspecialchars($admissionData['acadCert'] ?? 'default.pdf', ENT_QUOTES); ?>" target="_blank">View</a></td>
                                            <td>Receipt</td>
                                            <td><a href="uploads/<?php echo htmlspecialchars($admissionData['receipt'] ?? 'default.pdf', ENT_QUOTES); ?>" target="_blank">View</a></td>
                                            <td>Admin Remark</td>
                                            <td><?php echo htmlspecialchars($admissionData['AdminRemark'] ?? 'N/A', ENT_QUOTES); ?></td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Fee Amount</td>
                                            <td><?php echo htmlspecialchars($admissionData['FeeAmount'] ?? 'N/A', ENT_QUOTES); ?></td>
                                            <td>Admin Status</td>
<td>
    <?php 
    if (!isset($admissionData['AdminStatus']) || $admissionData['AdminStatus'] === "") {
        echo "Pending";
    } elseif ($admissionData['AdminStatus'] == "1") {
        echo "Admitted";
    } elseif ($admissionData['AdminStatus'] == "2") {
        echo "Not Admitted";
    }
    ?>
</td>


                                            <td>Admin Remark Date</td>
                                            <td><?php echo htmlspecialchars($admissionData['AdminRemarkDate'] ?? 'N/A', ENT_QUOTES); ?></td>
                                        </tr>
                                       
                                        
                                        
                                    </tbody>
                                </table>
                                <div class="print-button text-center">
                                    <button onclick="window.print();" class="btn btn-secondary">Print</button>
                                    <a href="edit_admission_form.php" class="btn btn-warning">Edit Form</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Admission Form -->
                   <form name="submit" method="post" enctype="multipart/form-data">        
                <section class="formatter" id="formatter">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Admission Form</h4>
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

                                        <!-- Step 1: Personal Background -->
                                        <fieldset>
                                            <h4 class="card-title"><b>PERSONAL BACKGROUND</b></h4>
                                            <div class="row">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control white_bg" name="regno" id="regno" value="">
                                                </div>
                                                <div class="col-xl-6 col-lg-4">
                                                    <h5>Title</h5>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control white_bg" id="title" name="title"
                                                            placeholder="Title" value="<?php echo isset($_SESSION['post']['title']) ? htmlspecialchars($_SESSION['post']['title'], ENT_QUOTES) : ''; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-4">
                                                    <h5>Applicant Passport</h5>
                                                    <div class="form-group">
                                                        <input class="form-control white_bg" id="userpic" name="userpic" type="file" required>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-4">
                                                    <h5>First Name</h5>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control white_bg" id="fname" name="fname"
                                                            placeholder="First Name" value="<?php echo isset($fname) ? htmlspecialchars($fname, ENT_QUOTES) : ''; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-4">
                                                    <h5>Last Name</h5>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control white_bg" id="lname" name="lname"
                                                            placeholder="Last Name" value="<?php echo isset($lname) ? htmlspecialchars($lname, ENT_QUOTES) : ''; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-4">
                                                    <h5>Middle Name</h5>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control white_bg" id="mname" name="mname"
                                                            placeholder="Middle Name" value="<?php echo isset($mname) ? htmlspecialchars($mname, ENT_QUOTES) : ''; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-4">
                                                    <h5>Email</h5>
                                                    <div class="form-group">
                                                        <input type="email" class="form-control white_bg" id="email" name="email"
                                                            placeholder="Email Address" value="<?php echo isset($email) ? htmlspecialchars($email, ENT_QUOTES) : ''; ?>" required>
                                                    </div>
                                                </div>               <div class="col-xl-6 col-lg-4">
                   <h5>Phone Number</h5>
                   <div class="form-group">
                       <input type="text" class="form-control white_bg" id="phone" name="phone"
                           placeholder="Phone Number" value="<?php echo isset($_SESSION['post']['phone']) ? $_SESSION['post']['phone'] : ''; ?>" required>
                   </div>
               </div>
               <div class="col-xl-6 col-lg-4">
                   <h5>Gender</h5>
                   <div class="form-group">
                       <label class="radio-inline">
                           <input type="radio" name="gender" value="Male" required
                               <?php echo isset($_SESSION['post']['gender']) && $_SESSION['post']['gender'] == 'Male' ? 'checked' : ''; ?>>
                           Male
                       </label>
                       <label class="radio-inline">
                           <input type="radio" name="gender" value="Female" required
                               <?php echo isset($_SESSION['post']['gender']) && $_SESSION['post']['gender'] == 'Female' ? 'checked' : ''; ?>>
                           Female
                       </label>
                   </div>
               </div>
               <div class="col-xl-6 col-lg-4">
                   <h5>Date of Birth</h5>
                   <div class="form-group">
                       <input class="form-control white_bg" id="dob" name="dob" type="date" value="<?php echo isset($_SESSION['post']['dob']) ? $_SESSION['post']['dob'] : ''; ?>" required>
                       <small class="text-muted">DOB Must be in this format (YYYY-MM-DD)</small>
                   </div>
               </div>
           </div>
           <h4 class="card-title"><b>RESIDENTIAL ADDRESS</b></h4>
           <div class="row">

               <div class="col-xl-6 col-lg-4">
                   <h5>Country of Resident</h5>
                   <div class="form-group">
                       <input type="text" class="form-control white_bg" id="rcountry" name="rcountry"
                           placeholder="Country of Resident" value="<?php echo isset($_SESSION['post']['rcountry']) ? $_SESSION['post']['rcountry'] : ''; ?>" required>
                   </div>
               </div>
               <div class="col-xl-6 col-lg-4">
                   <h5>Street Address</h5>
                   <div class="form-group">
                       <input type="text" class="form-control white_bg" id="rstreet" name="rstreet"
                           placeholder="Street Address" value="<?php echo isset($_SESSION['post']['rstreet']) ? $_SESSION['post']['rstreet'] : ''; ?>" required>
                   </div>
               </div>
               <div class="col-xl-6 col-lg-4">
                   <h5>City</h5>
                   <div class="form-group">
                       <input type="text" class="form-control white_bg" id="rcity" name="rcity"
                           placeholder="City of Resident" value="<?php echo isset($_SESSION['post']['rcity']) ? $_SESSION['post']['rcity'] : ''; ?>" required>
                   </div>
               </div>
               <div class="col-xl-6 col-lg-4">
                   <h5>Region</h5>
                   <div class="form-group">
                       <input type="text" class="form-control white_bg" id="rregion" name="rregion"
                           placeholder="Region of Resident" value="<?php echo isset($_SESSION['post']['rregion']) ? $_SESSION['post']['rregion'] : ''; ?>" required>
                   </div>
               </div>
               <div class="col-xl-6 col-lg-4">
                   <h5>Postal Code</h5>
                   <div class="form-group">
                       <input type="text" class="form-control white_bg" id="rpostalcode" name="rpostalcode"
                           placeholder="Postal code of Resident" value="<?php echo isset($_SESSION['post']['rpostalcode']) ? $_SESSION['post']['rpostalcode'] : ''; ?>" required>
                   </div>
               </div>
           </div>
           <h4 class="card-title"><b>PERMANENT ADDRESS</b></h4>
           <div class="row">

               <div class="col-xl-6 col-lg-4">
                   <h5>Country</h5>
                   <div class="form-group">
                       <input type="text" class="form-control white_bg" id="pcountry" name="pcountry"
                           placeholder="Country" value="<?php echo isset($_SESSION['post']['pcountry']) ? $_SESSION['post']['pcountry'] : ''; ?>" required>
                   </div>
               </div>
               <div class="col-xl-6 col-lg-4">
                   <h5>Street Address</h5>
                   <div class="form-group">
                       <input type="text" class="form-control white_bg" id="pstreet" name="pstreet"
                           placeholder="Street Address" value="<?php echo isset($_SESSION['post']['pstreet']) ? $_SESSION['post']['pstreet'] : ''; ?>" required>
                   </div>
               </div>
               <div class="col-xl-6 col-lg-4">
                   <h5>City</h5>
                   <div class="form-group">
                       <input type="text" class="form-control white_bg" id="pcity" name="pcity"
                           placeholder="City" value="<?php echo isset($_SESSION['post']['pcity']) ? $_SESSION['post']['pcity'] : ''; ?>" required>
                   </div>
               </div>
               <div class="col-xl-6 col-lg-4">
                   <h5>Region</h5>
                   <div class="form-group">
                       <input type="text" class="form-control white_bg" id="pregion" name="pregion"
                           placeholder="Region" value="<?php echo isset($_SESSION['post']['pregion']) ? $_SESSION['post']['pregion'] : ''; ?>" required>
                   </div>
               </div>
               <div class="col-xl-6 col-lg-4">
                   <h5>Postal Code</h5>
                   <div class="form-group">
                       <input type="text" class="form-control white_bg" id="ppostalcode" name="ppostalcode"
                           placeholder="Postal code" value="<?php echo isset($_SESSION['post']['ppostalcode']) ? $_SESSION['post']['ppostalcode'] : ''; ?>" required>
                   </div>
               </div>
           </div>
           <input type="reset" class="next btn btn-info mb-3" value="Reset" />
           <input type="submit" name="submit" class="next btn btn-info mb-3" value="Next" />
       </fieldset>
       <?php
//}?>
       </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
            <?php endif; ?>
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
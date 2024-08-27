<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('includes/dbconnection.php');
session_start();
if (strlen($_SESSION['uid']) == 0) {
    header('location:logout.php');
    exit(); // Stop further execution
} else {
// Check if the form was submitted
if (isset($_POST['submit'])) {
    // Store all POST data in the session
    foreach ($_POST as $key => $value) {
        $_SESSION['post'][$key] = $value;
    }

    // Handle file upload if any
    if (isset($_FILES['userpic']) && $_FILES['userpic']['error'] == UPLOAD_ERR_OK) {
        // Create upload directory if it doesn't exist
        $uploadDir = './uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Generate a unique file name to avoid overwriting
        $fileName = uniqid() . '_' . basename($_FILES['userpic']['name']);
        $uploadFile = $uploadDir . $fileName;

        // Move the uploaded file to the directory
        if (move_uploaded_file($_FILES['userpic']['tmp_name'], $uploadFile)) {
            // Save the file path in the session
            $_SESSION['post']['userpic'] = $uploadFile;
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <style type="text/css">
        body {
            padding-top: 20px;
            padding-bottom: 30px;
        }

        #regiration_form fieldset:not(:first-of-type) {
            display: none;
        }

        .error {
            color: red;
        }
    </style>
    <title>Online Admission Form</title>
</head>

<body>
    <div class="container py-4">
        <h4 class="card-title mb-0"><b>APPLICATION FORM</b></h4>
        <hr />
        <form class="mb-3" id="regiration_form" action="personal.php" method="post" enctype="multipart/form-data">
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
                                placeholder="Title" value="<?php echo isset($_SESSION['post']['title']) ? $_SESSION['post']['title'] : ''; ?>" required>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-4">
                        <h5>Applicant Passport</h5>
                        <div class="form-group">
                            <input class="form-control white_bg" id="userpic" name="userpic" type="file" value="<?php echo isset($_SESSION['post']['userpic']) ? $_SESSION['post']['userpic'] : ''; ?>" required>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-4">
                        <h5>First Name</h5>
                        <div class="form-group">
                            <input type="text" class="form-control white_bg" id="fname" name="fname"
                                placeholder="First Name" value="<?php echo isset($_SESSION['post']['fname']) ? $_SESSION['post']['fname'] : ''; ?>" required>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-4">
                        <h5>Last Name</h5>
                        <div class="form-group">
                            <input type="text" class="form-control white_bg" id="lname" name="lname"
                                placeholder="Last Name" value="<?php echo isset($_SESSION['post']['lname']) ? $_SESSION['post']['lname'] : ''; ?>" required>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-4">
                        <h5>Middle Name</h5>
                        <div class="form-group">
                            <input type="text" class="form-control white_bg" id="mname" name="mname"
                                placeholder="Middle Name" value="<?php echo isset($_SESSION['post']['mname']) ? $_SESSION['post']['mname'] : ''; ?>" required>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-4">
                        <h5>Email</h5>
                        <div class="form-group">
                            <input type="text" class="form-control white_bg" id="email" name="email"
                                placeholder="Email Address" value="<?php echo isset($_SESSION['post']['email']) ? $_SESSION['post']['email'] : ''; ?>" required>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-4">
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
                <div class="row">
                    <h4 class="card-title"><b>RESIDENTIAL ADDRESS</b></h4>
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
                <div class="row">
                    <h4 class="card-title"><b>PERMANENT ADDRESS</b></h4>
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
        </form>
    </div>
</body>

</html>
<?php } ?>
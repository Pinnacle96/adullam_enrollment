<?php
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start(); // Start the session

// Load Composer's autoloader
require 'vendor/autoload.php';
include 'config.php';

$msg = "";

if (isset($_POST['submit'])) {
    // Sanitize and validate form inputs
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $mname = mysqli_real_escape_string($conn, $_POST['mname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $program = mysqli_real_escape_string($conn, $_POST['program']);
    $learningmode = mysqli_real_escape_string($conn, $_POST['learningmode']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];
    $code = md5(rand());

    // Check if email or contact number already exists
    $ret = mysqli_query($conn, "SELECT * FROM tbluser WHERE email='$email'");
    $result = mysqli_fetch_array($ret);

    if ($result) {
        $msg = "<div class='alert alert-danger'>This email address is already registered.</div>";
    } else {
        if ($password === $confirm_password) {
            // Hash the password
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            // Insert user data into the database
            $sql = "INSERT INTO tbluser (fname, lname, mname, email, program, learningmode, password, code) VALUES ('$fname', '$lname', '$mname', '$email', '$program', '$learningmode', '$passwordHash', '$code')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                // Send verification email using PHPMailer
                $mail = new PHPMailer(true);

                try {
                    // Server settings
                    $mail->SMTPDebug = SMTP::DEBUG_OFF; // Turn off debug output
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'rcntsonline@gmail.com';
                    $mail->Password   = 'xdez xgzg mpyr ssyk';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Port       = 465;

                    // Recipients
                    $mail->setFrom('rcntsonline@gmail.com', 'RCNT Online');
                    $mail->addAddress($email);

                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = 'Email Verification';
                    $mail->Body    = 'Here is the verification link <b><a href="http://127.0.0.1/cams/user/?verification=' . $code . '">http://127.0.0.1/cams/user/?verification=' . $code . '</a></b><br> Below are your details:<br>Name: ' . $fname . ' ' . $lname . ' ' . $mname . '<br>Email: ' . $email . '<br>Login Password: ' . $password;

                    $mail->send();
                    $msg = "<div class='alert alert-info'>A verification link has been sent to your email address <b>$email</b>. Please check your Spam folder if you don't see the email.</div>";
                } catch (Exception $e) {
                    $msg = "<div class='alert alert-danger'>Message could not be sent. Mailer Error: {$mail->ErrorInfo}</div>";
                }
            } else {
                $msg = "<div class='alert alert-danger'>Something went wrong. Please try again.</div>";
            }
        } else {
            $msg = "<div class='alert alert-danger'>Password and Confirm Password do not match.</div>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Login Form - Brave Coder</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords"
        content="Login Form" />
    <!-- //Meta tag Keywords -->

    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!--/Style-CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <!--//Style-CSS -->

    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>

</head>

<body>

    <!-- form section start -->
    <section class="w3l-mockup-form">
        <div class="container">
            <!-- /form -->
            <div class="workinghny-form-grid">
                <div class="main-mockup">
                    <div class="alert-close">
                        <span class="fa fa-close"></span>
                    </div>
                    <div class="w3l_form align-self">
                        <div class="left_grid_info">
                            <img src="images/image2.svg" alt="">
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Create Account Now</h2>
                        <p>Welcome to Admission Registration Page, Please Create an Account to get started </p>
                        <?php echo $msg; ?>
                        <form action="" method="post">
                            <input type="text" class="form-control white_bg" name="fname" placeholder="Enter Your Name" value="<?php if (isset($_POST['submit'])) { echo $fname; } ?>" required>
                            <input type="text" class="form-control white_bg" name="lname" placeholder="Enter Your Name" value="<?php if (isset($_POST['submit'])) { echo $lname; } ?>" required>
                            <input type="text" class="form-control white_bg" name="mname" placeholder="Enter Your Name" value="<?php if (isset($_POST['submit'])) { echo $mname; } ?>" >
                            <input type="email" class="form-control white_bg" name="email" placeholder="Enter Your Email" value="<?php if (isset($_POST['submit'])) { echo $email; } ?>" required>
                            <div class="form-group">
                            <select class="form-control white_bg" name="program" id="program" required>
								<option value="">Select Program Type</option>
								<option value="Certificate in Theology">Certificate in Theology</option>
								<option value="Diploma in Theology">Diploma in Theology</option>
								<option value="Bachelor of Divinity">Bachelor of Divinity</option>
								<option value="Postgraduate Diploma">Postgraduate Diploma</option>
								<option value="Masters">Masters</option>
								<option value="Short Course">Short Course</option>
							</select>
                            </div>
                            <div class="form-group">
                            <select class="form-control white_bg" name="learningmode" id="learningmode" required>
								<option value="">Select Mode of Learning</option>
								<option value="Onsite">Onsite</option>
								<option value="Online">Online</option>
								<option value="Hybrid">Hybrid</option>
							</select>
                            </div>
                            <input type="password" class="form-control white_bg" name="password" placeholder="Enter Your Password" required>
                            <input type="password" class="form-control white_bg" name="confirm-password" placeholder="Enter Your Confirm Password" required>
                            <button name="submit" class="btn btn-primary" type="submit">Create Account</button>
                        </form>
                        <div class="social-icons">
                            <p>Have an account! <a href="index.php">Login</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //form -->
        </div>
    </section>
    <!-- //form section start -->

    <script src="js/jquery.min.js"></script>
    <script>
        $(document).ready(function (c) {
            $('.alert-close').on('click', function (c) {
                $('.main-mockup').fadeOut('slow', function (c) {
                    $('.main-mockup').remove();
                });
            });
        });
    </script>

</body>

</html>
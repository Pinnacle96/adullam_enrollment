<?php
session_start();

include 'config.php';
$msg = "";

// Redirect to index if user is already logged in
if (isset($_SESSION['uid'])) {
    header("Location: dashboard.php");
    die();
}

// Handle account verification
if (isset($_GET['verification'])) {
    $verificationCode = mysqli_real_escape_string($conn, $_GET['verification']);
    $query = mysqli_query($conn, "SELECT * FROM tbluser WHERE code='$verificationCode'");

    if (mysqli_num_rows($query) > 0) {
        $updateQuery = mysqli_query($conn, "UPDATE tbluser SET code='' WHERE code='$verificationCode'");
        
        if ($updateQuery) {
            $msg = "<div class='alert alert-success'>Account verification has been successfully completed.</div>";
        } else {
            $msg = "<div class='alert alert-danger'>Account verification failed. Please try again.</div>";
        }
    } else {
        header("Location: index.php");
        die();
    }
}

// Handle user login
if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM tbluser WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        // Verify password
        if (password_verify($password, $row['password'])) {
            if (empty($row['code'])) {
                // Set session ID
                $_SESSION['uid'] = $row['id'];

                // Get the user's degree
                $degree = $row['program'];

                // Redirect based on the degree
                if ($degree == 'Certificate in Theology' || 'Diploma in Theology' || 'Bachelor of Divinity') {
                    echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
                } elseif ($degree == 'Postgraduate Diploma' || 'Masters') {
                    echo "<script type='text/javascript'> document.location ='../pgdt/dashboard.php'; </script>";
                }elseif ($degree == 'Short Course') {
                    echo "<script type='text/javascript'> document.location ='../short/dashboard.php'; </script>";
                } else { 
                    echo "<script>alert('Degree not recognized');</script>";
                }
                die();
            } else {
                $msg = "<div class='alert alert-info'>First verify your account and try again.</div>";
            }
        } else {
            $msg = "<div class='alert alert-danger'>Email or password do not match.</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>Email or password do not match.</div>";
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
                            <img src="images/image.svg" alt="">
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Login Now</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
                        <?php echo $msg; ?>
                        <form action="" method="post">
                            <input type="email" class="email" name="email" placeholder="Enter Your Email" required>
                            <input type="password" class="password" name="password" placeholder="Enter Your Password" style="margin-bottom: 2px;" required>
                            <p><a href="forgot-password.php" style="margin-bottom: 15px; display: block; text-align: right;">Forgot Password?</a></p>
                            <button name="submit" name="submit" class="btn" type="submit">Login</button>
                        </form>
                        <div class="social-icons">
                            <p>Create Account! <a href="register.php">Register</a>.</p>
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

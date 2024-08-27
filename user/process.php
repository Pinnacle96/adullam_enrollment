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
if (isset($_POST['submit'])) {

    // Retrieve the current highest registration number
    $result = mysqli_query($con, "SELECT MAX(regno) AS max_regno FROM tbladmission");

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $maxRegno = $row['max_regno'];
    } else {
        $maxRegno = 'ADM/JAN/2025/00000'; // Default value if no rows exist
    }

    // Extract and increment the number part
    $number = (int)substr($maxRegno, -5) + 1;
    $formattedNumber = str_pad($number, 5, '0', STR_PAD_LEFT);
    $regno = 'ADM/JAN/2025/' . $formattedNumber;

 // Retrieve the user's email from the session
    $uid = $_SESSION['uid'];
    // Retrieve all fields from the session
    $title = $_SESSION['post']['title'];
    $userpic = $_SESSION['post']['userpic'];
    $fname = $_SESSION['post']['fname'];
    $lname = $_SESSION['post']['lname'];
    $mname = $_SESSION['post']['mname'];
    $email = $_SESSION['post']['email'];
    $phone = $_SESSION['post']['phone'];
    $gender = $_SESSION['post']['gender'];
    $dob = $_SESSION['post']['dob'];
    $rcountry = $_SESSION['post']['rcountry'];
    $rstreet = $_SESSION['post']['rstreet'];
    $rcity = $_SESSION['post']['rcity'];
    $rregion = $_SESSION['post']['rregion'];
    $rpostalcode = $_SESSION['post']['rpostalcode'];
    $pcountry = $_SESSION['post']['pcountry'];
    $pstreet = $_SESSION['post']['pstreet'];
    $pcity = $_SESSION['post']['pcity'];
    $pregion = $_SESSION['post']['pregion'];
    $ppostalcode = $_SESSION['post']['ppostalcode'];
    $maritalstatus = $_SESSION['post']['maritalstatus'];
    $children = $_SESSION['post']['children'];
    $dhealth = $_SESSION['post']['dhealth'];
    $disciplinary = $_SESSION['post']['disciplinary'];
    $mental_health = $_SESSION['post']['mental_health'];
    $fbank = $_SESSION['post']['fbank'];
    $drug = $_SESSION['post']['drug'];
    $employment = $_SESSION['post']['employment'];
    $felony = $_SESSION['post']['felony'];
    $smisconduct = $_SESSION['post']['smisconduct'];
    $soffence = $_SESSION['post']['soffence'];
    $divource = $_SESSION['post']['divource'];
    $spouse = $_SESSION['post']['spouse'];
    $church_name = $_SESSION['post']['church_name'];
    $caddress = $_SESSION['post']['caddress'];
    $qgospel = $_SESSION['post']['qgospel'];
    $sgrowth = $_SESSION['post']['sgrowth'];
    $callto = $_SESSION['post']['callto'];
    $ref1Name = $_SESSION['post']['ref1Name'];
    $ref1Phone = $_SESSION['post']['ref1Phone'];
    $ref1Email = $_SESSION['post']['ref1Email'];
    $ref2Name = $_SESSION['post']['ref2Name'];
    $ref2Phone = $_SESSION['post']['ref2Phone'];
    $ref2Email = $_SESSION['post']['ref2Email'];
    $birthCert = $_SESSION['post']['birthCert'];
    $lgaCert = $_SESSION['post']['lgaCert'];
    $refLetter = $_SESSION['post']['refLetter'];
    $acadCert = $_SESSION['post']['acadCert'];
    $receipt = $_SESSION['post']['receipt'];
    $agreement = isset($_POST['agreement']) ? 1 : 0; // Retrieve 'agreement' field from POST data


    // Prepare an SQL statement to insert the data
    $sql = "INSERT INTO tbladmission 
    (userid, regno, title, userpic, fname, lname, mname, email, phone, gender, dob, rcountry, rstreet, rcity, rregion, rpostalcode, pcountry, pstreet, pcity, pregion, ppostalcode, maritalstatus, children, dhealth, disciplinary, mental_health, fbank, drug, employment, felony, smisconduct, soffence, divource, spouse, church_name, caddress, qgospel, sgrowth, callto, ref1Name, ref1Phone, ref1Email, ref2Name, ref2Phone, ref2Email, birthCert, lgaCert, refLetter, acadCert, receipt, agreement) 
    VALUES 
    (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($con, $sql);

    if ($stmt === false) {
        // Output an error message and stop the script
        die('Error preparing the statement: ' . mysqli_error($con));
    }

    // Bind the parameters
    mysqli_stmt_bind_param($stmt, 'ssssssssssssssssssssssssssssssssssssssssssssssssssi',
        $uid, $regno, $title, $userpic, $fname, $lname, $mname, $email, $phone, $gender, $dob, 
        $rcountry, $rstreet, $rcity, $rregion, $rpostalcode, $pcountry, $pstreet, 
        $pcity, $pregion, $ppostalcode, $maritalstatus, $children, $dhealth, $disciplinary, 
        $mental_health, $fbank, $drug, $employment, $felony, $smisconduct, $soffence, 
        $divource, $spouse, $church_name, $caddress, $qgospel, $sgrowth, $callto, 
        $ref1Name, $ref1Phone, $ref1Email, $ref2Name, $ref2Phone, $ref2Email, 
        $birthCert, $lgaCert, $refLetter, $acadCert, $receipt, $agreement
    );

   // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // If successful, clear the session and redirect to personal.php
            unset($_SESSION['post']); 
            // session_destroy();
            echo "<script>alert('Application submitted successfully!'); window.location.href='dashboard.php';</script>";
            exit();
        } else {
            // If the insertion fails, redirect back to agreement.php with an error message
            echo "<script>alert('Error: Could not submit the application.'); window.location.href='agreement.php';</script>";
            exit();
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($con);
}
?>
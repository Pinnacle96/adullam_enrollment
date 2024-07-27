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
        // Initialize variables
        $uid = $_SESSION['uid'];
        $title = $_POST['title'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $contadd = isset($_POST['contadd']) ? $_POST['contadd'] : '';
        $city = $_POST['city'];
        $state = $_POST['state'];
        $country = $_POST['country'];
        $postalcode = $_POST['postalcode'];
        $phone = $_POST['phone'];
        $nationality = isset($_POST['Nationality']) ? $_POST['Nationality'] : '';
        $salvation = $_POST['salvation'];    
        $conversion = $_POST['conversion'];
        $ministry = $_POST['ministry'];
        $calltoministry = $_POST['calltoministry'];
        $spiritual = $_POST['spiritual'];
        $reasons = $_POST['reasons'];
        $churchName = $_POST['churchName'];
        $churchAddress = $_POST['churchAddress'];
        $ministerName = $_POST['ministerName'];
        $ministerEmail = $_POST['ministerEmail'];
        $ministerPhone = $_POST['ministerPhone'];
        $churchActivities = $_POST['churchActivities'];
        $bwater = $_POST['bwater'];
        $bwaterDate = $_POST['bwaterDate'];
        $tongues = $_POST['tongues'];
        $programApplied = $_POST['programApplied'];
        $learningOption = $_POST['learningOption'];
        $disability = $_POST['disability'];
        $mentalIllness = $_POST['mentalIllness'];
        $eatingDisorder = $_POST['eatingDisorder'];
        $medicalProblem = $_POST['medicalProblem'];
        $prescribedMed = $_POST['prescribedMed'];
        $specialDiet = $_POST['specialDiet'];
        $learningDisability = $_POST['learningDisability'];
        $hobbies = $_POST['hobbies'];
        $workExperience = $_POST['workExperience'];
        $emergencyName = $_POST['emergencyName'];
        $emergencyPhone = $_POST['emergencyPhone'];
        $emergencyEmail = $_POST['emergencyEmail'];
        $ref1Name = $_POST['ref1Name'];
        $ref1Phone = $_POST['ref1Phone'];
        $ref1Email = $_POST['ref1Email'];
        $ref2Name = $_POST['ref2Name'];
        $ref2Phone = $_POST['ref2Phone'];
        $ref2Email = $_POST['ref2Email'];
        $accommodation = $_POST['accommodation'];
        $agreement = $_POST['agreement'];
        $userpic = $_FILES["userpic"]["name"];
        $birthCert = $_FILES["birthCert"]["name"];
        $lgaCert = $_FILES["lgaCert"]["name"];
        $acadCert = $_FILES["acadCert"]["name"];
        $refLetter = $_FILES["refLetter"]["name"];
        $receipt = $_FILES["receipt"]["name"];
        
        // File extensions
        $extension = strtolower(substr($userpic, strrpos($userpic, '.')));
        $extensiontc = strtolower(substr($birthCert, strrpos($birthCert, '.')));
        $extensiontm = strtolower(substr($lgaCert, strrpos($lgaCert, '.')));
        $extensiontwm = strtolower(substr($acadCert, strrpos($acadCert, '.')));
        $extensionref = strtolower(substr($refLetter, strrpos($refLetter, '.')));
        $extensionrec = strtolower(substr($receipt, strrpos($receipt, '.')));

        // Allowed extensions
        $allowed_extensions = array(".jpg", ".jpeg", ".png", ".gif", ".pdf");

        // Validation for allowed extensions
        if (!in_array($extension, $allowed_extensions)) {
            echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
        } elseif (!in_array($extensiontc, $allowed_extensions)) {
            echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif/pdf format allowed');</script>";
        } elseif (!in_array($extensiontm, $allowed_extensions)) {
            echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif/pdf format allowed');</script>";
        } elseif (!in_array($extensiontwm, $allowed_extensions)) {
            echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif/pdf format allowed');</script>";
        } elseif (!in_array($extensionref, $allowed_extensions)) {
            echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif/pdf format allowed');</script>";
        } elseif (!in_array($extensionrec, $allowed_extensions)) {
            echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif/pdf format allowed');</script>";
        } else {
            // Rename files
            $userpic = md5($userpic) . $extension;
            $birthCert = md5($birthCert) . $extensiontc;
            $lgaCert = md5($lgaCert) . $extensiontm;
            $acadCert = md5($acadCert) . $extensiontwm;
            if (!empty($refLetter)) {
                $refLetter = md5($refLetter) . $extensionref;
            } else {
                $refLetter = "";
            }
            if (!empty($receipt)) {
                $receipt = md5($receipt) . $extensionrec;
            } else {
                $receipt = "";
            }

            // Move uploaded files to destination folder
            move_uploaded_file($_FILES["birthCert"]["tmp_name"], "userdocs/" . $birthCert);
            move_uploaded_file($_FILES["lgaCert"]["tmp_name"], "userdocs/" . $lgaCert);
            move_uploaded_file($_FILES["acadCert"]["tmp_name"], "userdocs/" . $acadCert);
            move_uploaded_file($_FILES["refLetter"]["tmp_name"], "userdocs/" . $refLetter);
            move_uploaded_file($_FILES["receipt"]["tmp_name"], "userdocs/" . $receipt);
            move_uploaded_file($_FILES["userpic"]["tmp_name"], "userimages/" . $userpic);

            //  // Generate ADM No (e.g., ADM/2024/UND/00001)
            // $prefix = "ADM/2024/UND/";
            // $query_count = mysqli_query($con, "SELECT COUNT(ID) as total FROM tbladmapplications");
            // $row_count = mysqli_fetch_assoc($query_count);
            // $count = $row_count['total'] + 1;
            // $adm_no = $prefix . sprintf('%05d', $count);

            // Prepare SQL statement
            $query = mysqli_prepare($con, "INSERT INTO tbladmapplications (UserId, title, dob, gender, contadd, city, state, country, postalcode, phone, Nationality, salvation, conversion, ministry, calltoministry, spiritual, reasons, churchName, churchAddress, ministerName, ministerEmail, ministerPhone, churchActivities, bwater, bwaterDate, tongues, programApplied, learningOption, disability, mentalIllness, eatingDisorder, medicalProblem, prescribedMed, specialDiet, learningDisability, hobbies, workExperience, emergencyName, emergencyPhone, emergencyEmail, ref1Name, ref1Phone, ref1Email, ref2Name, ref2Phone, ref2Email, accommodation, agreement, userpic, birthCert, lgaCert, refLetter, acadCert, receipt) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)");

            if ($query === false) {
                trigger_error('Statement prepare failed!', E_USER_ERROR);
            }

            // Bind parameters
            mysqli_stmt_bind_param($query, "ssssssssssssssssssssssssssssssssssssssssssssssssssssss", $uid, $title, $dob, $gender, $contadd, $city, $state, $country, $postalcode, $phone, $nationality, $salvation, $conversion, $ministry, $calltoministry, $spiritual, $reasons, $churchName, $churchAddress, $ministerName, $ministerEmail, $ministerPhone, $churchActivities, $bwater, $bwaterDate, $tongues, $programApplied, $learningOption, $disability, $mentalIllness, $eatingDisorder, $medicalProblem, $prescribedMed, $specialDiet, $learningDisability, $hobbies, $workExperience, $emergencyName, $emergencyPhone, $emergencyEmail, $ref1Name, $ref1Phone, $ref1Email, $ref2Name, $ref2Phone, $ref2Email, $accommodation, $agreement, $userpic, $birthCert, $lgaCert, $refLetter, $acadCert, $receipt);

            // Execute statement
            mysqli_stmt_execute($query);

            // Check if query executed successfully
            if (mysqli_stmt_affected_rows($query) > 0) {
                echo '<script>alert("Data has been added successfully.")</script>';
            } else {
                echo '<script>alert("Error: Unable to add data. Please try again.")</script>';
            }

            // Close statement
            mysqli_stmt_close($query);
        }
    }
}
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>

  <title>Admission Management System|| Admission Form</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
  rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
  rel="stylesheet">

     <style>
    .errorWrap {
    padding: 10px;
    margin: 20px 0 0px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
    </style>
</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
<?php include('includes/header.php');?>
<?php include('includes/leftbar.php');?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">
           Admission Application Form
          </h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a>
                </li>
            
                </li>
                <li class="breadcrumb-item active">Application
                </li>
              </ol>
            </div>
          </div>
        </div>
   
      </div>
      <div class="content-body">
  
<?php 
$stuid=$_SESSION['uid'];
$query=mysqli_query($con,"select tbladmapplications.*,tbluser.*,tbladmapplications.ID as appid from tbladmapplications 
                          join tbluser on tbluser.ID=tbladmapplications.UserId where UserId=$stuid");
$rw=mysqli_num_rows($query);
if($rw>0) {
    while($row=mysqli_fetch_array($query)) {
?>
    <p style="font-size:16px; color:red" align="center">Your Admission Form already submitted.</p>
    <div id="exampl">  
<div class="table-responsive">
        <table class="table table-bordered border-0 mb-0">
          <tr>
            <td></td>
            <td></td>
            <td></td>
                <td><img src="userimages/<?php echo $row['userpic'];?>" width="150" height="150"></td>
              
              </tr>
               <tr>
                  <?php if($row['AdminStatus']==""): ?>
            <?php else: ?>
                    
                </tr>
                <tr>
                    <th>Admin Status</th>
                    <td>
                        <?php 
                        if($row['AdminStatus']==""){
                            echo "admin remark is pending";
                        } 
                        if($row['AdminStatus']=="1"){
                            echo "Admitted";
                        }
                        if($row['AdminStatus']=="2"){
                            echo "Not Admitted";
                        }
                        ?>
                    </td>
                    <th>Date Admited</th>
                    <td><?php echo $row['AdminRemarkDate'];?></td>
                </tr>
                
            <tr>
              <th>Applicant Name</th>
                <td><?php echo $row['FirstName']." ".$row['LastName'];?></td>
               
            </tr>
            <tr>
                <th>Program Applied</th>
                <td><?php echo $row['programApplied'];?></td>
                 <th>Registration Date</th>
                <td><?php echo $row['programApplieddate'];?></td>
            </tr>
            <tr>
                <th>Gender</th>
                <td><?php echo $row['gender'];?></td>
                <th>Country of Residence</th>
                <td><?php echo $row['country'];?></td>
            </tr>
            <tr>
                <th>DOB</th>
                <td><?php echo $row['dob'];?></td>
                <th>Nationality</th>
                <td><?php echo $row['Nationality'];?></td>
            </tr>
            <tr>
                <th>Contact Address</th>
                <td><?php echo $row['contadd'];?></td>
                <th>Learning Option</th>
                <td><?php echo $row['learningOption'];?></td>
            </tr>
            <tr>
                <th>Emergency Name</th>
                <td><?php echo $row['emergencyName'];?></td>
                <th>Emergency Contact</th>
                <td><?php echo $row['emergencyPhone'];?></td>
            </tr>
            <tr>
                <th>Birth Certificate</th>
                <td><a href="userdocs/<?php echo $row['birthCert'];?>" target="_blank">View File</a></td>
                <th>LGA Certificate</th>
                <td><a href="userdocs/<?php echo $row['lgaCert'];?>" target="_blank">View File</a></td>
            </tr>
            <tr>
                <th>Academic Certificate</th>
                <td><a href="userdocs/<?php echo $row['acadCert'];?>" target="_blank">View File</a></td>
                <th>Reference Letter</th>
                <td>
                    <?php if($row['refLetter']==""){ ?>
                        NA
                    <?php } else{ ?>
                        <a href="userdocs/<?php echo $row['refLetter'];?>" target="_blank">View File</a>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <th>Application fees</th>
                <td>
                    <?php if($row['receipt']==""){ ?>
                        NA
                    <?php } else{ ?>
                        <a href="userdocs/<?php echo $row['receipt'];?>" target="_blank">View File</a>
                    <?php } ?>
                </td>
            </tr>
           
            <?php endif; ?>
        </table>
        
      </div>
    </div>
    <div style="float:right;">
        <button class="btn btn-primary" style="cursor: pointer;" onClick="CallPrint(this.value)">Print</button>
    </div>
    <?php 
        if ($row['AdminStatus']==""){
    ?>
    <p style="text-align: center; font-size: 20px;"><a href="edit-appform.php?editid=<?php echo $row['appid'];?>">Edit Details</a></p>
    <?php 
        }
    } // End while loop
} else { 
?>
    <!-- Add your HTML content for form not submitted case here -->

<form name="submit" method="post" enctype="multipart/form-data">        
        <section class="formatter" id="formatter">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Addimission Form</h4>

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
  
<div class="col-xl-12 col-lg-12"><h4 class="card-title"><b>Personal Profile</b></h4> <hr />
</div>
</div>

<div class="row">
  <!-- <div class="col-xl-6 col-lg-12">
 <fieldset>
  <h5>Title</h5>
   <div class="form-group">
    <input class="form-control white_bg" id="Adm_no" name="Adm_no"  type="hidden" value="<?php echo $adm_no; ?>" required>
    </div>
</fieldset>
                   
</div> -->
<div class="col-xl-6 col-lg-12">
 <fieldset>
  <h5>Title</h5>
   <div class="form-group">
    <input class="form-control white_bg" id="title" name="title"  type="text" placeholder="Title" required>
    </div>
</fieldset>
                   
</div>

<div class="col-xl-6 col-lg-12">
 <fieldset>
  <h5>Passport </h5>
   <div class="form-group">
    <input class="form-control white_bg" id="userpic" name="userpic"  type="file" required>
    </div>
</fieldset>                  
</div>
 </div>    
<div class="row">


<div class="col-xl-6 col-lg-12">
 <fieldset>
  <h5>Date of Birth</h5>
   <div class="form-group">
    <input class="form-control white_bg" id="dob" name="dob"  type="date" required>
    <small class="text-muted">DOB Must be in this format (YYYY-MM-DD)</small>
    </div>
</fieldset>                  
</div>
<div class="col-xl-6 col-lg-12">
 <fieldset>
  <h5>Gender                </h5>
   <div class="form-group">

   <select class="form-control white_bg" id="gender" name="gender"  required>
    <option value="">-----Select-----</option>
<option value="Male">Male</option>
<option value="Female">Female</option>
   </select>
                          </div>
                        </fieldset>
                      </div>
<div class="col-xl-6 col-lg-12">
 <fieldset>
  <h5>Contact Address </h5>
   <div class="form-group">
    <input class="form-control white_bg" id="contadd" name="contadd"  type="text" required>
    </div>
</fieldset>                  
</div>
<div class="col-xl-6 col-lg-12">
 <fieldset>
  <h5>City</h5>
   <div class="form-group">
   <input class="form-control white_bg" id="city" name="city"  type="text" required>
    </div>
</fieldset>               
</div>
 </div>               
 <div class="row">

<div class="col-xl-6 col-lg-12">
 <fieldset>
  <h5>State/Province                 </h5>
   <div class="form-group">
   <input class="form-control white_bg" id="state" name="state"  type="text" required>
                          </div>
                        </fieldset>
                      </div>
<div class="col-xl-6 col-lg-12">
 <fieldset>
  <h5>Country                  </h5>
   <div class="form-group">
   <input class="form-control white_bg" id="country" name="country"  type="text" required>
    </div>

</fieldset>                  
</div>
                    </div>
<div class="row">
<div class="col-xl-3 col-lg-12">
 <fieldset>
  <h5>Postal Code/ZIP</h5>
   <div class="form-group">
   <input class="form-control white_bg" id="postalcode" name="postalcode"  type="text" required>
                          </div>

                        </fieldset>
                      </div>


<div class="col-xl-3 col-lg-12">
 <fieldset>
  <h5>WhatsApp Contact</h5>
   <div class="form-group">
   <input class="form-control white_bg" id="phone" name="phone"  type="text" required>
                          </div>

                        </fieldset>
                      </div>

<div class="col-xl-3 col-lg-12">
 <fieldset>
  <h5>Nationality</h5>
   <div class="form-group">
   <input class="form-control white_bg" id="Nationality" name="Nationality"  type="text" required>
                          </div>

                        </fieldset>
                      </div>
<div class="col-xl-3 col-lg-12">
 <fieldset>
  <h5>Profession/Training</h5>
   <div class="form-group">
   <input class="form-control white_bg" id="profession" name="profession"  type="text" required>
                          </div>

                        </fieldset>
                      </div>
                    </div>
                    <div class="row" style="margin-top: 2%">
  
<div class="col-xl-12 col-lg-12"><h4 class="card-title"><b>Christian Experience</b></h4> <hr />
</div>
</div>
<div class="row">

   <div class="col-xl-3 col-lg-12">
    <fieldset>
       <h5>Are you Born Again? </h5>
   
<select class="form-control white_bg" id="salvation" name="salvation"  required>
    <option value="">-----Select-----</option>
    <option value="Yes">Yes</option>
    <option value="No">No</option>
</select>
    </fieldset>
   
</div>
<div class="col-xl-9 col-lg-12">
    <fieldset>
       <h5>Give a brief account of your conversion and experience of the Lord Jesus Christ</h5>
   <div class="form-group">
<textarea class="form-control white_bg" id="conversion" name="conversion"  type="text" required rows="1"></textarea></div>
    </fieldset>
   
</div>
</div>
<div class="row">
   <div class="col-xl-6 col-lg-12">
    <fieldset>
       <h5>Are you (whether part-time or full-time) into ministry now? </h5>
   <div class="form-group">
<select class="form-control white_bg" id="ministry" name="ministry"  required>
    <option value="">-----Select-----</option>
    <option value="Yes">Yes</option>
    <option value="No">No</option>
</select></div>
    </fieldset>
   
</div>
<div class="col-xl-6 col-lg-12">
    <fieldset>
       <h5>If no, do you sense the call of God to go into ministry?</h5>
       <div class="form-group">
       <select class="form-control white_bg" id="calltoministry" name="calltoministry"  required>
    <option value="">-----Select-----</option>
    <option value="Yes">Yes</option>
    <option value="No">No</option>
</select></div>
  </fieldset>
 </div>
</div>
<div class="row">
<div class="col-xl-6 col-lg-12">
 <fieldset>
  <h5>Are there any spiritual gifts in expression in your life?</h5>
   <div class="form-group">
   <input class="form-control white_bg" id="spiritual" name="spiritual"  type="text" required>
     </div>                    

                        </fieldset>
                      </div>


<div class="col-xl-6 col-lg-12">
 <fieldset>
  <h5>What are your reasons for wishing to attend the Bible Seminary?</h5>
   <div class="form-group">
   <input class="form-control white_bg" id="reasons" name="reasons"  type="text" required>
                         
</div>
                        </fieldset>
                      </div>

</div>
<div class="row">

<div class="col-xl-6 col-lg-12">
 <fieldset>
  <h5>Give the name of the Church/Ministry you attend </h5>
   <div class="form-group">
   <input class="form-control white_bg" id="churchName" name="churchName"  type="text" required>
                          </div>
                        </fieldset>
                      </div>
<div class="col-xl-6 col-lg-12">
 <fieldset>
  <h5>Give the address of the Church/Ministry you attend                  </h5>
   <div class="form-group">
   <input class="form-control white_bg" id="churchAddress" name="churchAddress"  type="text" required>
    </div>

</fieldset>                  
</div>
                    </div>
<div class="row">

<div class="col-xl-4 col-lg-12">
 <fieldset>
  <h5>Church Minister's Name </h5>
   <div class="form-group">
   <input class="form-control white_bg" id="ministerName" name="ministerName"  type="text" required>
                          </div>
                        </fieldset>
                      </div>
<div class="col-xl-4 col-lg-12">
 <fieldset>
  <h5>Church Minister's Email                  </h5>
   <div class="form-group">
   <input class="form-control white_bg" id="ministerEmail" name="ministerEmail"  type="email" required>
    </div>

</fieldset>                  
</div>
<div class="col-xl-4 col-lg-12">
 <fieldset>
  <h5>Church Minister's Contact                 </h5>
   <div class="form-group">
   <input class="form-control white_bg" id="ministerPhone" name="ministerPhone"  type="text" required>
    </div>

</fieldset>                  
</div>
                    </div>
                    <div class="row">
<div class="col-xl-6 col-lg-12">
 <fieldset>
  <h5>Describe any Church-related activities in which you are presently or have been involved</h5>
    <div class="form-group">
<textarea class="form-control white_bg" id="churchActivities" name="churchActivities"  type="text" required rows="1"></textarea></div>
                        </fieldset>
                      </div>


<div class="col-xl-6 col-lg-12">
 <fieldset>
  <h5>Have you been baptized in water by immersion?</h5>
   <div class="form-group">
       <select class="form-control white_bg" id="bwater" name="bwater"  required>
    <option value="">-----Select-----</option>
    <option value="Yes">Yes</option>
    <option value="No">No</option>
</select></div>
                        </fieldset>
                      </div>

</div>
<div class="row">
<div class="col-xl-6 col-lg-12">
 <fieldset>
  <h5>if yes, when?</h5>
    <div class="form-group">
<input class="form-control white_bg" id="bwaterDate" name="bwaterDate"  type="date" required ></div>
                        </fieldset>
                      </div>


<div class="col-xl-6 col-lg-12">
 <fieldset>
  <h5>Have you been baptized in the Holy Ghost with the evidence of speaking in tongues?</h5>
   <div class="form-group">
       <select class="form-control white_bg" id="tongues" name="tongues"  required>
    <option value="">-----Select-----</option>
    <option value="Yes">Yes</option>
    <option value="No">No</option>
</select></div>
                        </fieldset>
                      </div>

</div>

<div class="row" style="margin-top: 1%">
  
<div class="col-xl-12 col-lg-12"><h4 class="card-title"><b>Program Type and Mode of Learning</b></h4> <hr />
</div>
</div>
<div class="row">
  <div class="col-xl-6 col-lg-12">
 <fieldset>
  <h5>Program Applied                   </h5>
   <div class="form-group">
   <select name='programApplied' id="programApplied" class="form-control white_bg" required="true">
     <option value="">-----Select Program Applied-----</option>
     
                   <option value="Certificate in Theology">Certificate</option> 
                    <option value="Diploma in Theology">Diploma</option> 
                     <option value="Bachelor of Theology">Bachelor of Theology</option>
                     <option value="Postgraduate degree">Postgraduate degree</option> 
   </select>
    </div>
</fieldset>
                   
</div>
  <div class="col-xl-6 col-lg-12">
    <fieldset>
       <h5>Learning Option </h5>
  <div class="form-group"> 
<select class="form-control white_bg" id="learningOption" name="learningOption"  required>
    <option value="">-----Select learning Option-----</option>
    <option value="Online">Online</option>
    <option value="On-Campus">On-Campus</option>
</select></div>
    </fieldset>
   
</div>
</div>
<div class="row" style="margin-top: 1%">
  
<div class="col-xl-12 col-lg-12"><h4 class="card-title"><b>Health and Medical Information</b></h4> <hr />
</div></div>
<div class="row">
<div class="col-xl-12 col-lg-12">
<h6><strong>The following questions in this section are for counselling purposes and will in no way jeopardize your acceptance into the Theological Seminary. Please note that you are required to resume on Campus with a Certificate of Fitness from a Government Hospital. <a href="#">Click here</a> to download the Health Form, which should be filled and submitted upon resumption.</strong></h6>
 </div>
 </div> 
  <div class="row">
  <div class="col-xl-6 col-lg-12">
 <fieldset>
  <h5>Do you suffer from any disability, which would limit your participation in practical duties? </h5>
  <div class="form-group"> 
<select class="form-control white_bg" id="disability" name="disability" required>
    <option value="">-----Select-----</option>
    <option value="Yes">Yes</option>
    <option value="No">No</option>
</select></div>
</fieldset>
                   
</div>
  <div class="col-xl-6 col-lg-12">
    <fieldset>
      <h5>Have you had a nervous or mental illness at any time? </h5>
  <div class="form-group"> 
<select class="form-control white_bg" id="mentalIllness" name="mentalIllness" required>
    <option value="">-----Select-----</option>
    <option value="Yes">Yes</option>
    <option value="No">No</option>
</select></div>
    </fieldset>
   
</div>
</div>
 <div class="row">
  <div class="col-xl-6 col-lg-12">
 <fieldset>
  <h5>Have you suffered from or had treatment for anorexia nervosa or bulimia? </h5>
  <div class="form-group"> 
<select class="form-control white_bg" id="eatingDisorder" name="eatingDisorder" required>
    <option value="">-----Select-----</option>
    <option value="Yes">Yes</option>
    <option value="No">No</option>
</select></div>
</fieldset>
                   
</div>
  <div class="col-xl-6 col-lg-12">
    <fieldset>
      <h5>Do you have diabetes, epilepsy, blackouts or other diagnosed medical problem?</h5>
  <div class="form-group"> 
<select class="form-control white_bg" id="medicalProblem" name="medicalProblem" required>
    <option value="">-----Select-----</option>
    <option value="Yes">Yes</option>
    <option value="No">No</option>
</select></div>
    </fieldset>
   
</div>
</div>
 <div class="row">
  <div class="col-xl-6 col-lg-12">
 <fieldset>
  <h5>Do you require any regular prescribed medication? </h5>
  <div class="form-group"> 
<select class="form-control white_bg" id="prescribedMed" name="prescribedMed" required>
    <option value="">-----Select-----</option>
    <option value="Yes">Yes</option>
    <option value="No">No</option>
</select></div>
</fieldset>
                   
</div>
  <div class="col-xl-6 col-lg-12">
    <fieldset>
      <h5>Do you require a special diet for medical reasons? </h5>
  <div class="form-group"> 
<select class="form-control white_bg" id="specialDiet" name="specialDiet" required>
    <option value="">-----Select-----</option>
    <option value="Yes">Yes</option>
    <option value="No">No</option>
</select></div>
    </fieldset>
   
</div>
</div>
<div class="row">
  <div class="col-xl-6 col-lg-12">
 <fieldset>
  <h5>Do you have a learning disability? </h5>
  <div class="form-group"> 
<select class="form-control white_bg" id="learningDisability" name="learningDisability" required>
    <option value="">-----Select-----</option>
    <option value="Yes">Yes</option>
    <option value="No">No</option>
</select></div>
</fieldset>
                   
</div>
</div>
<div class="row" style="margin-top: 1%">
  
<div class="col-xl-12 col-lg-12"><h4 class="card-title"><b>Talents, Hobbies, and Work</b></h4> <hr />
</div></div>
<div class="row">
  <div class="col-xl-6 col-lg-12">
 <fieldset>
  <h5>Do you have any hobbies or talents? Please describe. </h5>
  <div class="form-group"> 
 <textarea class="form-control white_bg" id="hobbies" name="hobbies"  type="text" required rows="1"></textarea></div>
</fieldset>
  </div>
  <div class="col-xl-6 col-lg-12">
    <fieldset>
      <h5>Describe your work experience.</h5>
  <div class="form-group"> 
<textarea class="form-control white_bg" id="workExperience" name="workExperience"  type="text" required rows="1"></textarea></div>
</div>
    </fieldset>
   
</div>

<div class="row" style="margin-top: 1%">
  
<div class="col-xl-12 col-lg-12"><h4 class="card-title"><b>Emergency Contact</b></h4> <hr />
</div></div>
<div class="row">
  <div class="col-xl-4 col-lg-12">
 <fieldset>
  <h5>Emergency Contact Name </h5>
  <div class="form-group"> 
 <input class="form-control white_bg" id="emergencyName" name="emergencyName"  type="text" required></div>
</fieldset>
                   
</div>
 <div class="col-xl-4 col-lg-12">
 <fieldset>
  <h5>Emergency Contact Phone Number </h5>
  <div class="form-group"> 
 <input class="form-control white_bg" id="emergencyPhone" name="emergencyPhone"  type="text" required></div>
</fieldset>
                   
</div>
<div class="col-xl-4 col-lg-12">
 <fieldset>
  <h5>Emergency Contact Email </h5>
  <div class="form-group"> 
 <input class="form-control white_bg" id="emergencyEmail" name="emergencyEmail"  type="email" required></div>
</fieldset>
                   
</div>
</div>
<div class="row" style="margin-top: 1%">
  
<div class="col-xl-12 col-lg-12"><h4 class="card-title"><b>References</b></h4> <hr />
</div></div>
<div class="row">
  <div class="col-xl-4 col-lg-12">
 <fieldset>
  <h5>Reference 1 Name </h5>
  <div class="form-group"> 
 <input class="form-control white_bg" id="ref1Name" name="ref1Name"  type="text" required></div>
</fieldset>
                   
</div>
 <div class="col-xl-4 col-lg-12">
 <fieldset>
  <h5>Reference 1 Phone Number </h5>
  <div class="form-group"> 
 <input class="form-control white_bg" id="ref1Phone" name="ref1Phone"  type="text" required></div>
</fieldset>
                   
</div>
<div class="col-xl-4 col-lg-12">
 <fieldset>
  <h5>Reference 1 Email </h5>
  <div class="form-group"> 
 <input class="form-control white_bg" id="ref1Email" name="ref1Email"  type="email" required></div>
</fieldset>
                   
</div>
</div>
<div class="row">
  <div class="col-xl-4 col-lg-12">
 <fieldset>
  <h5>Reference 2 Name </h5>
  <div class="form-group"> 
 <input class="form-control white_bg" id="ref2Name" name="ref2Name"  type="text" required></div>
</fieldset>
                   
</div>
 <div class="col-xl-4 col-lg-12">
 <fieldset>
  <h5>Reference 2 Phone Number </h5>
  <div class="form-group"> 
 <input class="form-control white_bg" id="ref2Phone" name="ref2Phone"  type="text" required></div>
</fieldset>
                   
</div>
<div class="col-xl-4 col-lg-12">
 <fieldset>
  <h5>Reference 2 Email </h5>
  <div class="form-group"> 
 <input class="form-control white_bg" id="ref2Email" name="ref2Email"  type="email" required></div>
</fieldset>
                   
</div>
</div>
<div class="row" style="margin-top: 1%">
  
<div class="col-xl-12 col-lg-12"><h4 class="card-title"><b>Accommodation Option</b></h4> <hr />
</div></div>
<div class="row">
  <div class="col-xl-6 col-lg-12">
 <fieldset>
  <h5>Would you require accommodation on campus? </h5>
  <div class="form-group"> 
<select class="form-control white_bg" id="accommodation" name="accommodation" required>
    <option value="">-----Select Accommodation Option-----</option>
    <option value="Yes">Yes</option>
    <option value="No">No</option>
</select></div>
</fieldset>
                   
</div>
</div>
<div class="row" style="margin-top: 2%">
  
<div class="col-xl-12 col-lg-12"><h4 class="card-title"><b>Document Upload</b></h4> <hr />
</div>
</div>
<div class="row" style="margin-top: 2%">
<div class="col-xl-6 col-lg-12">
 <fieldset>
  <h5>Upload Birth Certificate or Declaration of Age</h5>
   <div class="form-group">
    <input class="form-control white_bg" id="birthCert" name="birthCert"  type="file" required>
    </div>
</fieldset>
                 
</div>
<div class="col-xl-6 col-lg-12">
 <fieldset>
  <h5>Upload State/Local Government of Origin                  </h5>
   <div class="form-group">
    <input class="form-control white_bg" id="lgaCert" name="lgaCert"  type="file" required>
    </div>
</fieldset>                 
</div>
</div>
 <div class="row">
<div class="col-xl-6 col-lg-12">
 <fieldset>
  <h5>Upload Reference Letter from a Clergy                   </h5>
   <div class="form-group">
    <input class="form-control white_bg" id="refLetter" name="refLetter"  type="file" required>
    </div>
</fieldset>                 
</div>
<div class="col-xl-6 col-lg-12">
  <fieldset>
  <h5>Upload Academic Degree Certificate</h5>
   <div class="form-group">
    <input class="form-control white_bg" id="acadCert" name="acadCert"  type="file">
    </div>
</fieldset>
 </div>
                    </div>        
  
<div class="row" style="margin-top: 2%">
  
<div class="col-xl-12 col-lg-12"><h4 class="card-title"><b>Enrollment Agreement</b></h4> <hr />
</div>
</div>
 <div class="row">
<div class="col-xl-12 col-lg-12">
<h5>I certify that the information I provided on this application is complete and accurate to the best of my knowledge, and that Adullam (RCN Theological Seminary) is authorized to make whatever enquiries are necessary to certify the accuracy of my records. I have read through, fully understand & agree to the above "Conditions of Enrolment" and the Financial payment option. I agree to unreservedly carry out my studies and duties in accordance with this agreement at all times to the best of my ability. Further, I consent to the use of reference letters and reference checks in evaluating my application. If accepted as a student at Adullam, and in consideration thereof, I will submit cheerfully to all the regulations and policies of the seminary and seek to maintain a high standard of Christian integrity and conduct. I also agree that upon admission that unreserved right be afforded the Seminary to authorize my medical treatment when need arise under the recommendations of a qualified medical personnel.</h5>
 </div>
 </div>               
<div class="row"> 
<div class="col-xl-6 col-lg-12">
 <fieldset>
  <h5>Do you agree to the terms and conditions of enrollment?</h5>
  <div class="form-group"> 
<select class="form-control white_bg" id="agreement" name="agreement" required>
    <option value="">-----Select Enrollment Agreement-----</option>
    <option value="Yes">Yes</option>
    <option value="No">No</option>
</select></div>
</fieldset>
                   
</div>
</div>
<div class="row" style="margin-top: 2%">
  
<div class="col-xl-12 col-lg-12"><h4 class="card-title"><b>Application Fees</b></h4> <hr />
</div>
</div>
<div class="row">
<div class="col-xl-12 col-lg-12">
<h5><b>Please pay the $10 non-refundable application processing fee for your application to be processed, and send your proof of payment (transaction receipt or a screenshot of your debit alert) to the following email adullamfees@gmail.com.
</b></h5>
 </div>
 </div> 
 <div class="row">
<div class="col-xl-12 col-lg-12">
<h6><b>Account Details:</b><br>
<b>NAIRA</b><br>
Access Bank Plc<br>
Account Name: Remnant Christian Network Theological Seminary - Adullam <br>
1652191540<br>
NB. Please use 800 naira per dollar as the exchange rate for making payment into the naira account<br>

<b>USD</b><br>
Beneficiary bank: Access Bank Plc<br>
Account Name: Remnant Christian Network Theological Seminary - Adullam<br>
Account No: 1665250883<br>
Swift Code: ABNGNGLA<br>
Routing Number: 021000089<br>
Intermediary bank: Citibank...CITIUS33<br>

<b>GBP</b><br>
Beneficiary bank: Access Bank Plc<br>
Account Name: Remnant Christian Network Theological Seminary - Adullam<br>
Account No: 1667594370<br>
Banks Swift code: ABNGNGLA<br>
Beneficiary banks IBAN NO: GB27CITI18500811071211<br>
Intermediary Bank Swift code: CITIGB2L<br>
Sort code: 185008<br>

<b>EURO</b><br>
Beneficiary bank: Access Bank Plc<br>
Account Name: Remnant Christian Network Theological Seminary - Adullam<br>
Account No: 1664879355<br>
Banks Swift code: ABNGNGLA<br>
Beneficiary banks IBAN NO: GB74CITI18500811071238<br>
Intermediary Bank Swift code: CITIGB2L<br>
Sort code: 185008<br>

</h6>
 </div>
 </div> 
<div class="row">
<div class="col-xl-4 col-lg-12">
  <fieldset>
 <h5>Upload Payment Receipt</h5>
   <div class="form-group">
    <input class="form-control white_bg" id="receipt" name="receipt"  type="file" >
    </div>
</fieldset>
</div>
</div>
<div class="row" style="margin-top: 2%">
<div class="col-xl-6 col-lg-12">
<button type="submit" name="submit" class="btn btn-info btn-min-width mr-1 mb-1">Submit</button>
</div>
</div>
 </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <?php } ?>
        <!-- Formatter end -->
      </form>  
      </div>
    </div>
  </div>
<?php include('includes/footer.php');?>
 
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
<?php  } ?>

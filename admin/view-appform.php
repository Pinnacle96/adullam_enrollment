<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('includes/dbconnection.php');

if (strlen($_SESSION['aid'] == 0)) {
    header('location:logout.php');
    die();
} else {
    if (isset($_POST['submit'])) {
        $cid = $_GET['aticid'];
        $admrmk = $_POST['AdminRemark'];
        $admsta = $_POST['Adminst'];
        $feeamt = $_POST['feeamt'];
        $toemail = $_POST['useremail'];
        $query = mysqli_query($con, "UPDATE tbladmission SET AdminRemark='$admrmk', FeeAmount='$feeamt', AdminStatus='$admsta' WHERE id='$cid'");
        if ($query) {
            $subj = "Admission Application Status";
            $heade .= "MIME-Version: 1.0" . "\r\n";
            $heade .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $heade .= 'From:Adullam<noreply@adullam.ng>' . "\r\n"; // Put your sender email here
            $msgec .= "<html></body><div><div>Hello,</div></br></br>";
            $msgec .= "<div style='padding-top:8px;'>Your Admission application has been $$admsta ) </br>
<strong>Admin Remark: </strong> $admrmk </div><div></div></body></html>";
            mail($toemail, $subj, $msgec, $heade);
            echo "<script>alert('Admin Remark and Status has been updated.');</script>";
            echo "<script>window.location.href ='pending-application.php'</script>";
        } else {
            echo "<script>alert('Something Went Wrong. Please try again.');</script>";
            echo "<script>window.location.href ='pending-application.php'</script>";
        }
    }
?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <title>Admission Management System || View Form</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
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
                <h3 class="content-header-title mb-0 d-inline-block">View Application Form</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Application Form</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div id="exampl">
                <?php
                $cid = $_GET['aticid'];
                $userid = isset($_GET['userid']) ? intval($_GET['userid']) : 0; // Fallback if userid is not set
                $ret = mysqli_query($con, "SELECT tbladmission.*, tbluser.fname, tbluser.lname, tbluser.program, tbluser.learningmode, tbluser.email FROM tbladmission INNER JOIN tbluser ON tbluser.id = tbladmission.userid WHERE tbladmission.id='$cid' OR tbladmission.userid='$userid'");
                $cnt = 1;
                $count = mysqli_num_rows($ret);
                if ($count == 0) {
                    echo "<p style='color:red'>Not applied Yet</p>";
                } else {
                    while ($row = mysqli_fetch_array($ret)) {
                ?>
                
<table border="1" width="100%" class="table table-bordered mg-b-0">
<tr>
   <th>Applicant Name</th>
  <td><?php echo $row['fname']." ".$row['lname'];?></td>
    <th>Reg Date</th>
    <td><?php  echo $row['programApplieddate'];?></td>
  </tr>
   <tr>
    <th>Program Applied</th>
    <td><?php  echo $row['program'];?></td>
    <th>Student Fullname</th>
    <td><?php  echo $row['fname']." ".$row['lname'];?></td>
  </tr>

    <tr>
    <th>Application No</th>
    <td><?php  echo $row['regno'];?></td>
    <th>Student Email</th>
    <td><?php  echo $row['email'];?></td>
  </tr>

  <tr>
  <th>Student Pic</th>
  <td><img src="../user/uploads/<?php echo $row['userpic'];?>" width="200" height="150"></td>
    <th>Gender</th>
    <td><?php  echo $row['gender'];?></td>
  </tr>
  
  <tr>
    <th>Country</th>
    <td><?php  echo $row['rcountry'];?></td>
    <th>  DOB</th>
    <td><?php  echo $row['dob'];?></td>
  </tr>
  <tr>
    <th>Nationality</th>
    <td><?php  echo $row['pcountry'];?></td>
    <th>Contact Address</th>
    <td><?php  echo $row['rstreet'];?></td>
  </tr>
  <tr>
    <th>Marital Status</th>
    <td><?php  echo $row['maritalstatus'];?></td>
  <th>Learning Option</th>
  <td><?php echo $row['learningmode'];?></td>
</tr>
<tr>
  <th>Registration Date</th>
  <td><?php echo $row['programApplieddate'];?></td>
  <th>Birth Certificate</th>
  <td><a href="../user/uploads/<?php echo $row['birthCert'];?>" target="_blank">View File </a></td>
</tr>
<tr>
  <th>LGA Certificate</th>
  <td><a href="../user/uploads/<?php echo $row['lgaCert'];?>" target="_blank">View File </a></td>

  <th>Academic Certificate</th>
  <td><a href="../user/uploads/<?php echo $row['acadCert'];?>" target="_blank">View File </a></td>
  </tr>
  <tr>
  <th>Reference Letter</th>
  <td>
<?php if($row['refLetter']==""){ ?>
  NA
<?php } else{ ?>
    <a href="../user/uploads/<?php echo $row['refLetter'];?>" target="_blank">View File </a>
<?php } ?>
  </td>

  <th>Application Fees</th>
  <td>
<?php if($row['receipt']==""){ ?>
  NA
<?php } else{ ?>
    <a href="../user/uploads/<?php echo $row['receipt'];?>" target="_blank">View File </a>
<?php } ?>
  </td>
</tr>
</table>

  <table class="table mb-0" border="1" width="100%">



 <tr>
    <th colspan="5"><font color="red">Declaration : </font>I hereby state that the facts mentioned above are true to the best of my knowledge and belief.<br />
(<?php  echo $row['agreement'];?>)
    </th>
  </tr>
</table>
<table class="table mb-0" border="1" width="100%">

<?php if($row['AdminRemark']==""){ ?>


<form name="submit" method="post" enctype="multipart/form-data"> 
<input type="hidden" name="useremail" value="<?php  echo $row['email'];?>">
  <tr>
    <th>Application Status :</th>
    <td>
   <select name="status" id="status"  class="form-control wd-450" required="true" >
    <option value="">Select Option</option>
     <option value="1">Admitted</option>
     <option value="2">Not Admitted</option>
   </select></td>
  </tr>

<tr>
    <th>Admin Remark :</th>
    <td>
    <textarea name="AdminRemark" placeholder="" rows="6" cols="14" class="form-control wd-450" required="true"></textarea></td>
  </tr>
<tr id="fee">
    <th>Fee Amount :</th>
    <td>
    <input name="feeamt" id="feeamt" placeholder="" class="form-control wd-450"></td>
  </tr>


  <tr align="center">
    <td colspan="2"><button type="submit" name="submit" class="btn btn-primary">Update</button></td>
  </tr>
  </form>
<?php } else { ?>

<tr>
    <th>Admin Remark</th>
    <td><?php echo $row['AdminRemark']; ?></td>
  </tr>
<tr>
    <th>Fee Amount</th>
    <td><?php echo $row['FeeAmount']; ?></td>
  </tr>

<tr>
<th>Admin Remark date</th>
<td><?php echo $row['AdminRemarkDate']; ?>  </td>

<tr>
    <th>Application Status</th>
    <td><?php  
if($row['AdminStatus']=="1")
{
  echo "Admitted";
}

if($row['AdminStatus']=="2")
{
  echo "Not Admitted";
}

     ;?></td>
  </tr>

  </tr>

  <?php } ?>
 




</table>

<?php }} ?>
            </div>
            <div style="float:right;">
                <button class="btn btn-primary" style="cursor: pointer;" OnClick="CallPrint(this.value)">Print</button>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
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
<script type="text/javascript">
    $('#fee').hide();
    $(document).ready(function() {
        $('#status').change(function() {
            if ($('#status').val() == '1') {
                $('#fee').show();
                jQuery("#feeamt").prop('required', true);
            } else {
                $('#fee').hide();
            }
        })
    })
</script>
</body>
</html>
<?php } ?>

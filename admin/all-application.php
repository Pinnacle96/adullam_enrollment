<?php  
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['aid']) == 0) {
  header('location:logout.php');
} else {

  // Fetch all applications
  $query = "SELECT tbladmapplications.programApplied, tbladmapplications.AdminStatus, tbladmapplications.ID as apid, tbluser.FirstName, tbluser.LastName, tbluser.MobileNumber, tbluser.Email 
            FROM tbladmapplications 
            INNER JOIN tbluser ON tbluser.ID = tbladmapplications.UserId";
  $result = mysqli_query($con, $query);

  // Group data by program
  $programs = [];
  while ($row = mysqli_fetch_array($result)) {
    $program = $row['programApplied'];
    if (!isset($programs[$program])) {
      $programs[$program] = [];
    }
    $programs[$program][] = $row;
  }
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <title>Admission Management System || All Application</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
  <style>
    .errorWrap { padding: 10px; margin: 20px 0 0px 0; background: #fff; border-left: 4px solid #dd3d36; -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1); box-shadow: 0 1px 1px 0 rgba(0,0,0,.1); }
    .succWrap { padding: 10px; margin: 0 0 20px 0; background: #fff; border-left: 4px solid #5cb85c; -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1); box-shadow: 0 1px 1px 0 rgba(0,0,0,.1); }
    .program-section { margin-bottom: 30px; }
    .program-section h4 { margin-bottom: 20px; }
  </style>
</head>
<body class="vertical-layout vertical-menu-modern 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
  <?php include('includes/header.php'); ?>
  <?php include('includes/leftbar.php'); ?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">View Application</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Pending Application</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-body">
        <!-- Display data grouped by program -->
        <?php foreach ($programs as $program => $applicants) { ?>
          <div class="program-section">
            <h4><?php echo htmlspecialchars($program); ?></h4>
            <div class="table-responsive">
              <table class="table table-bordered mb-0">
              <thead>
                <tr>
                  <th>S.NO</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Mobile Number</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $cnt = 1;
                foreach ($applicants as $applicant) {
                ?>
                  <tr>
                    <td><?php echo $cnt; ?></td>
                    <td><?php echo htmlspecialchars($applicant['FirstName']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['LastName']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['MobileNumber']); ?></td>
                    <td><?php echo htmlspecialchars($applicant['Email']); ?></td>
                    <?php if ($applicant['AdminStatus'] == "") { ?>
                      <td><?php echo "Not Updated Yet"; ?></td>
                    <?php } if ($applicant['AdminStatus'] == "1") { ?>
                      <td><?php echo "Admitted"; ?></td>
                    <?php } if ($applicant['AdminStatus'] == "2") { ?>
                      <td><?php echo "Not Admitted"; ?></td>
                    <?php } ?>
                    <td><a href="view-appform.php?aticid=<?php echo $applicant['apid']; ?>" target="_blank"><i class="la la-eye"></i></a></td>
                  </tr>
                <?php
                  $cnt++;
                } ?>
              </tbody>
            </table>
          </div></div>
        <?php } ?>
      </div>
    </div>
  </div>

  <?php include('includes/footer.php'); ?>
</body>
</html>
<?php } ?>

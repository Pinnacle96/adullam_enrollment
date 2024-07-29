<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['aid']) == 0) {
    header('location:logout.php');
} else {
    // Get the date inputs
    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];

    // Convert dates to 'YYYY-MM-DD HH:MM:SS' format for SQL
    $fdate = date("Y-m-d 00:00:00", strtotime($fromdate)); // Start of the day
    $tdate = date("Y-m-d 23:59:59", strtotime($todate)); // End of the day

    ?>
    <!DOCTYPE html>
    <html class="loading" lang="en" data-textdirection="ltr">
    <head>
        <title>College Admission Management System | Between Dates Report Details</title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
        <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <style>
            .errorWrap { padding: 10px; margin: 20px 0 0px 0; background: #fff; border-left: 4px solid #dd3d36; -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1); box-shadow: 0 1px 1px 0 rgba(0,0,0,.1); }
            .succWrap { padding: 10px; margin: 0 0 20px 0; background: #fff; border-left: 4px solid #5cb85c; -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1); box-shadow: 0 1px 1px 0 rgba(0,0,0,.1); }
        </style>
    </head>
    <body class="vertical-layout vertical-menu-modern 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
        <?php include('includes/header.php'); ?>
        <?php include('includes/leftbar.php'); ?>
        <div class="app-content content">
            <div class="content-wrapper">
                <div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                        <h3 class="content-header-title mb-0 d-inline-block">Between Dates Report Details</h3>
                        <div class="row breadcrumbs-top d-inline-block">
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Between Dates Report Details</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-body">
                    <h1>B/w Dates Report Details From <?php echo date("d-m-Y", strtotime($fromdate)); ?> To <?php echo date("d-m-Y", strtotime($todate)); ?></h1>

                    <?php
                    // Prepare and execute the SQL query
                    $stmt = $con->prepare("SELECT tblfees.ID AS feesid, tbladmapplications.programApplied, tbladmapplications.ID AS apid, tbladmapplications.AdminStatus, tbladmapplications.AdminRemarkDate, tbluser.FirstName, tbluser.LastName, tbluser.MobileNumber, tbluser.Email 
                                            FROM tbladmapplications 
                                            INNER JOIN tbluser ON tbluser.ID = tbladmapplications.UserId 
                                            LEFT JOIN tblfees ON tblfees.UserID = tbladmapplications.UserID 
                                            WHERE tbladmapplications.AdminStatus = '1' AND tbladmapplications.AdminRemarkDate BETWEEN ? AND ?");
                    $stmt->bind_param("ss", $fdate, $tdate);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    // Check if there are results
                    if ($result->num_rows > 0) {
                        // Initialize an array to hold results grouped by program
                        $programs = [];

                        // Fetch results and group by program
                        while ($row = $result->fetch_assoc()) {
                            $program = $row['programApplied'];
                            if (!isset($programs[$program])) {
                                $programs[$program] = [];
                            }
                            $programs[$program][] = $row;
                        }

                        // Display results grouped by program
                        foreach ($programs as $program => $rows) {
                            ?>
                            <h2>Program: <?php echo htmlspecialchars($program); ?></h2>
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
                                        foreach ($rows as $row) {
                                            ?>
                                            <tr>
                                                <td><?php echo $cnt; ?></td>
                                                <td><?php echo htmlspecialchars($row['FirstName']); ?></td>
                                                <td><?php echo htmlspecialchars($row['LastName']); ?></td>
                                                <td><?php echo htmlspecialchars($row['MobileNumber']); ?></td>
                                                <td><?php echo htmlspecialchars($row['Email']); ?></td>
                                                <td>
                                                    <?php
                                                    if ($row['AdminStatus'] == "") {
                                                        echo "Not Updated Yet";
                                                    } elseif ($row['AdminStatus'] == "1") {
                                                        echo "Admitted";
                                                    } elseif ($row['AdminStatus'] == "2") {
                                                        echo "Not Admitted";
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="view-appform.php?aticid=<?php echo $row['apid']; ?>" target="_blank"><i class="la la-eye"></i></a> |
                                                    <a href="view-fees.php?docid=<?php echo $row['feesid']; ?>" target="_blank"><i class="la la-eye"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                            $cnt++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                              
                            </div>
                            <?php
                        }
                    } else {
                        echo '<p>No records found</p>';
                    }
                    $stmt->close();
                    ?>
                </div>
            </div>
        </div>
        <?php include('includes/footer.php'); ?>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
    </html>
    <?php
}
?>

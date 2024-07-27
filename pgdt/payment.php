<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['uid']==0)) {
  header('location:logout.php');
} 
?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <title>College Admission Management System || Admission Fees</title>
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
  <?php include('includes/header.php');?>
  <?php include('includes/leftbar.php');?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">
            Admission Fees
          </h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                </li>
                <li class="breadcrumb-item active">Payment Details</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-body" id="exampl">
      <div class="row">
  <div class="col-xl-12">
    <fieldset>
      <h5><b>Please pay the $10 non-refundable application processing fee for your application to be processed, and send your proof of payment (transaction receipt or a screenshot of your debit alert) to the following email adullamfees@gmail.com.
</b></h5>
      <h6><b>Account Details:</b><br><br>
<b>NAIRA</b><br><br>
Access Bank Plc<br>
Account Name: Remnant Christian Network Theological Seminary - Adullam <br>
1652191540<br>
NB. Please use 800 naira per dollar as the exchange rate for making payment into the naira account<br><br>

<b>USD</b><br><br>
Beneficiary bank: Access Bank Plc<br>
Account Name: Remnant Christian Network Theological Seminary - Adullam<br>
Account No: 1665250883<br>
Swift Code: ABNGNGLA<br>
Routing Number: 021000089<br>
Intermediary bank: Citibank...CITIUS33<br><br>

<b>GBP</b><br><br>
Beneficiary bank: Access Bank Plc<br>
Account Name: Remnant Christian Network Theological Seminary - Adullam<br>
Account No: 1667594370<br>
Banks Swift code: ABNGNGLA<br>
Beneficiary banks IBAN NO: GB27CITI18500811071211<br>
Intermediary Bank Swift code: CITIGB2L<br>
Sort code: 185008<br><br>

<b>EURO</b><br><br>
Beneficiary bank: Access Bank Plc<br>
Account Name: Remnant Christian Network Theological Seminary - Adullam<br>
Account No: 1664879355<br>
Banks Swift code: ABNGNGLA<br>
Beneficiary banks IBAN NO: GB74CITI18500811071238<br>
Intermediary Bank Swift code: CITIGB2L<br>
Sort code: 185008<br>

    </fieldset>
  </div>
</div> 


<!--<div class="row" style="margin-top: 2%">
  <div class="col-xl-12">
    <img src="userimages/qr.png" alt="QR Code" width="200" height="200">
  </div>
</div>-->


       
      </div>
    </div>
  </div>
  <?php include('includes/footer.php');?>
</body>
</html>

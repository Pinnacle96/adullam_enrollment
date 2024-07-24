  <link rel="stylesheet" type="text/css" href="../app-assets/css/vendors.css">
  <link rel="stylesheet" type="text/css" href="../app-assets/css/app.css">
  <link rel="stylesheet" type="text/css" href="../app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
  <link rel="stylesheet" type="text/css" href="../app-assets/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/forms/extended/form-extended.css">
<style>
  .avatar img {
    max-width: 40px; /* Adjust the max-width to your preference */
    height: 35px;
    border-radius: 50%; /* Ensures a round avatar */
  }
</style>
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
          <li class="nav-item mr-auto">
            <a class="navbar-brand" href="dashboard.php">
        
              <h3 class="brand-text">ADULLAM User</h3>
            </a>
          </li>
          <li class="nav-item d-none d-md-block float-right"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="toggle-icon ft-toggle-right font-medium-3 white" data-ticon="ft-toggle-right"></i></a></li>
          <li class="nav-item d-md-none">
            <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
          </li>
        </ul>
      </div>
      <div class="navbar-container content">
        <div class="collapse navbar-collapse" id="navbar-mobile">
          <ul class="nav navbar-nav mr-auto float-left">
            <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>

           
          </ul>
          <ul class="nav navbar-nav float-right">
            <li class="dropdown dropdown-user nav-item">
              <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                <span class="mr-1">Hello,
                  <?php
              $uid = $_SESSION['uid'];
              $query = mysqli_query($con, "SELECT tu.FirstName, ta.userpic FROM tbluser tu JOIN tbladmapplications ta ON tu.ID = ta.UserId WHERE ta.UserId='$uid'");
              $row = mysqli_fetch_array($query);
              $name = $row['FirstName'];
              $userpic = $row['userpic']; // Get the userpic filename
            ?>
                  <span class="user-name text-bold-700" ><?php echo $name; ?></span>
                </span>
                <span class="avatar avatar-online">
                 <img src="userimages/<?php echo $row['userpic']; ?>" alt="user avatar"><i></i></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="userprofile.php"><i class="ft-user"></i> Edit Profile</a>
                <span class="avatar avatar-online">
                  </span>
              </a>
              <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="change-password.php"><i class="ft-user"></i> Change Pass</a>


                
                <div class="dropdown-divider"></div><a class="dropdown-item" href="logout.php"><i class="ft-power"></i> Logout</a>
              </div>
            </li>

        
     
          </ul>
        </div>
      </div>
    </div>
  </nav>
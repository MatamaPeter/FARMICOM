<?php 
include ("config.php");
session_start();

if (!isset($_SESSION['farmers'])) {
  header("location:../../lform.php");
  exit;
  
} else {
  $username = $_SESSION['farmers'];
  $member = $_SESSION['member'] ;
  $photo = $_SESSION['photo'] ;
}

 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Farmicom Farmers</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
  </head>
  <body>
   
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="index.html"><img src="assets/images/logo.svg" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <div class="search-field d-none d-md-block">
            
          </div>
          <ul class="navbar-nav navbar-nav-right">
         
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                <img src="../Admin/<?php echo $photo?>" alt="image">
                <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black"><?php echo $username ?></p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                
                <a class="dropdown-item" href="../../logout_admins.php">
                  <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
                  <a class="dropdown-item" href="profile.php">
                  <i class="mdi mdi-account me-2 text-primary"></i> Profile </a>
                  
              </div>
              
            </li>
            <li class="nav-item d-none d-lg-block full-screen-link">
              <a class="nav-link">
                <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
              </a>
            </li>



          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
              <li class="nav-item">
              <a class="nav-link" href="Supplies.php">
                <span class="menu-title">Supplies</span>
                <i class="mdi mdi-truck-delivery menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Pricelist.php">
                <span class="menu-title">Price List</span>
                <i class="mdi mdi-format-list-bulleted  menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="profile.php">
                <span class="menu-title">Account Management</span>
                <i class="mdi mdi mdi-account menu-icon"></i>
              </a>
            </li>
            
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard
               
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  
                </ul>
              </nav>
            </div>
            <div class="row">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <?php
                     $total_paid = 0;
                     $select_supplies =mysqli_query($con, "SELECT * FROM supplies WHERE Bill_status='cleared'AND Farmer_no='$member'");
                     while($sum_paid = $select_supplies->fetch_assoc()){
                      $total_paid += $sum_paid['Total'];
                     }


                     ?>
                    <h4 class="font-weight-normal mb-3">Total amount paid <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">KES. <?php echo $total_paid?></h2>
                    <h6 class="card-text">Total for all supplies since registration</h6>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <?php
                    $total_pending = 0;
                    $select_supplies =mysqli_query($con, "SELECT * FROM supplies WHERE Bill_status='uncleared'AND Farmer_no='$member'");
                    while($sum_paid = $select_supplies->fetch_assoc()){
                      $total_pending += $sum_paid['Total'];
                     }
                     ?>
                    <h4 class="font-weight-normal mb-3">Pendings Bills <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">KES. <?php echo $total_pending?></h2>
                    <h6 class="card-text">Amount for unpaid supplies</h6>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <?php 
                    
                     $select_supplies =mysqli_query($con, "SELECT * FROM supplies WHERE Farmer_no='$member'");
                     $supplies = $select_supplies->num_rows;
                     
                     ?>
                    <h4 class="font-weight-normal mb-3">Supplies made<i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?php echo $supplies?> Supplies</h2>
                    <h6 class="card-text">Number of all supplies made</h6>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                  
                      <table class="table table-striped">
                      <thead>
                        <tr>
                          <th> Invoice No. </th>
                          <th> Date </th>
                          <th> Member No. </th>
                          <th> Name </th>
                          <th> Products </th>
                          <th> Quantity </th>
                          <th> Bill </th>
                          <th> Bill Status </th>
                          
                        </tr>
                      </thead>
                      <tbody>
                      <h4 class="card-title">Recent Supplies</h4>
                      <?php
                          $select_supplies = mysqli_query($con, "SELECT * FROM supplies  WHERE Farmer_no='$member'LIMIT 5") or die ("Query failed");
                          while($supplies_dtls = $select_supplies->fetch_assoc()){

                        ?>
                        <form action="" method="post">
                        
                        
                        <tr>
                          
                          <td> <?php echo $supplies_dtls['Invoice_no']?></td>
                          <input type="hidden" name="invoice" value="<?php echo $supplies_dtls['Invoice_no']?>">
                          <td> <?php echo $supplies_dtls['Date']?></td>
                          <td> <?php echo $supplies_dtls['Farmer_no']?></td>
                          <td> <?php echo $supplies_dtls['Name']?></td>
                          <td> <?php echo $supplies_dtls['Product']?></td>
                          <td> <?php echo $supplies_dtls['Quantity']?></td>
                          <td> <?php echo $supplies_dtls['Total']?></td>
                          <td> 
                          <?php if($supplies_dtls['Bill_status']=='cleared'){
                                echo " <label class='badge badge-gradient-success'>Cleared</label>";
                              }elseif ($supplies_dtls['Bill_status']== 'uncleared') {
                                echo " <label class='badge badge-gradient-danger'>Uncleared</label>";
                              }
                                ?>
                          
                          </td>
                          
                          
                        </tr>
                        
                        </form>
                        <?php } ?>
                         
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
          

        
            </div>

          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="container-fluid d-flex justify-content-between">
              <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Copyright © Farmicom.com 2024</span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- End custom js for this page -->
    <script>
      var yesterdayCount = <?php echo $data['yesterday_count']; ?>;
      var todayCount = <?php echo $data['today_count']; ?>;
        var monthsData = <?php echo $monthsJSON; ?>;
         var ordersData = <?php echo $ordersJSON; ?>;
    </script>
  </body>
</html>
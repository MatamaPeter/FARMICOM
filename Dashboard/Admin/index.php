<?php 
include ("config.php");
session_start();

if (!isset($_SESSION['email'])) {
  header("location:lform.php");
  exit;
  
} else {
  $username = $_SESSION['email'];
}

 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Farmicom Admin</title>
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
          <?php
                  $select_messages=mysqli_query($con,"SELECT * FROM messages");
                  if($select_messages->num_rows==0){
                    ?>
                    <li class="nav-item dropdown">
                    <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="mdi mdi-email-outline"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                      <h6 class="p-3 mb-0">Messages</h6>

                      <?php
                  }else{
                    
                    ?>
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-email-outline"></i>
                <span class="count-symbol bg-warning"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                <h6 class="p-3 mb-0">Messages</h6>
                <?php while($message=$select_messages->fetch_assoc()){ ?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="assets/images/faces/face4.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal"><?php echo $message['Name']?> sent you a message</h6>
                  </div>
                </a>
                <?php }}?>
                <div class="dropdown-divider"></div>
                <h6 class="p-3 mb-0 text-center"><?php echo $select_messages->num_rows?> new messages</h6>
              </div>
            </li>
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                  <img src="assets/images/faces/face1.jpg" alt="image">
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black"><?php echo $username ?></p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                
                <a class="dropdown-item" href="logout.php">
                  <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
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
              <a class="nav-link" href="orders.php">
                <span class="menu-title">Orders</span>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
              </a>
                          </li>
            <li class="nav-item">
              <a class="nav-link" href="users.php">
                <span class="menu-title">Users</span>
                <i class="mdi mdi-account-multiple menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="farmers.php">
                <span class="menu-title">Farmers</span>
                <i class="mdi mdi-worker menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="categories.php">
                <span class="menu-title">Supplies</span>
                <i class="mdi mdi-truck-delivery menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="messages.php">
                <span class="menu-title">Messages</span>
                <i class="mdi mdi-email menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="products.php">
                <span class="menu-title">Products</span>
                <i class="mdi mdi-briefcase menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="categories.php">
                <span class="menu-title">Categories</span>
                <i class="mdi mdi-view-stream menu-icon"></i>
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
                     $select_orders =mysqli_query($con, "SELECT * FROM orders WHERE payment_status='complete'");
                     while($sum_paid = $select_orders->fetch_assoc()){
                      $total_paid += $sum_paid['total'];
                     }


                     ?>
                    <h4 class="font-weight-normal mb-3">Total Paid <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">KES. <?php echo $total_paid?></h2>
                    <h6 class="card-text">Total for all cleared orders</h6>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <?php
                    $total_pending = 0;
                     $select_orders =mysqli_query($con, "SELECT * FROM orders WHERE payment_status='pending'");
                     while($sum_paid = $select_orders->fetch_assoc()){
                      $total_pending += $sum_paid['total'];
                     }
                     ?>
                    <h4 class="font-weight-normal mb-3">Pendings Bills <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">KES. <?php echo $total_pending?></h2>
                    <h6 class="card-text">Amount for all pending orders</h6>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <?php 
                    
                     $select_orders =mysqli_query($con, "SELECT * FROM orders WHERE order_status='processing'");
                     $order_pending = $select_orders->num_rows;
                     
                     ?>
                    <h4 class="font-weight-normal mb-3">Pending orders<i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?php echo $order_pending?> Orders</h2>
                    <h6 class="card-text">Orders not dispatched</h6>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-7 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="clearfix">
                      <h4 class="card-title float-left">Sales Statistics</h4>
                      <?php
                         
                          $query = "SELECT DATE_FORMAT(orderDate, '%b') AS month, COUNT(*) AS num_orders 
                                    FROM orders 
                                    GROUP BY DATE_FORMAT(orderDate, '%b')";
                          $result = mysqli_query($con, $query);

                          // Initialize arrays to store the months and corresponding orders
                          $months = [];
                          $orders = [];

                          // Fetch data and populate the arrays
                          while ($row = mysqli_fetch_assoc($result)) {
                              $months[] = $row['month'];
                              $orders[] = $row['num_orders'];
                          }

                          // Convert the PHP arrays to JSON format
                          $monthsJSON = json_encode($months);
                          $ordersJSON = json_encode($orders);
                          ?>
                      <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                    </div>
                    <canvas id="visit-sale-chart" class="mt-4"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-md-5 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Today/Yesterday Comparison</h4>
                    <?php


                        // Get yesterday and today's date
                        $yesterday = date('Y-m-d', strtotime("-1 days"));
                        $today = date('Y-m-d');

                        // Fetch yesterday's and today's records from the orders table
                        $sql_yesterday = "SELECT COUNT(*) AS yesterday_count FROM orders WHERE DATE(orderDate) = '$yesterday'";
                        $sql_today = "SELECT COUNT(*) AS today_count FROM orders WHERE DATE(orderDate) = '$today'";

                        $result_yesterday = $con->query($sql_yesterday);
                        $result_today = $con->query($sql_today);

                        $yesterday_count = 0;
                        $today_count = 0;

                        if ($result_yesterday->num_rows > 0) {
                            $row = $result_yesterday->fetch_assoc();
                            $yesterday_count = $row['yesterday_count'];
                        }

                        if ($result_today->num_rows > 0) {
                            $row = $result_today->fetch_assoc();
                            $today_count = $row['today_count'];
                        }

                    

                        // Prepare data to be sent as JSON
                        $data = array(
                            'yesterday_count' => $yesterday_count,
                            'today_count' => $today_count
                        );

                        ?>


                    <canvas id="traffic-chart"></canvas>
                    <div id="traffic-chart-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Recent Orders</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> User </th>
                            <th> Product </th>
                            <th> Payment status </th>
                            <th> Order Status </th>
                            <th> Payment ID </th>
                            <th> Amount </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $select_latest_orders = mysqli_query($con,"SELECT * FROM ORDERS LIMIT 10") or die("Query failed");
                          while($order_dtls=$select_latest_orders->fetch_assoc()){                      
                          
                          ?>
                          <tr>
                            <td> <?php echo $order_dtls['User_email'] ?></td>
                            <td> <?php echo $order_dtls['product'] ?></td>
                            <td>
                              <?php if($order_dtls['payment_status']=='complete'){
                                echo " <label class='badge badge-gradient-success'>DONE</label>";
                              }elseif ($order_dtls['payment_status']== 'pending') {
                                echo " <label class='badge badge-gradient-warning'>PENDING</label>";
                              }
                                ?>
                            </td>
                            <td><?php echo $order_dtls['order_status'] ?> </td>
                            <td> <?php echo $order_dtls['payment_id'] ?> </td>
                            <td> <?php echo $order_dtls['total'] ?> </td>
                          </tr>
                            <?php } ?>
                     
                        </tbody>
                      </table>
                    </div>
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
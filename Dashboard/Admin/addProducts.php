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
                  $select_messages=mysqli_query($con,"SELECT * FROM messages LIMIT 5");
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
                <i class="mdi mdi mdi-basket menu-icon"></i>
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
                  <i class="mdi mdi mdi-basket"></i>
                </span> Add products
               
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  
                </ul>
              </nav>
            </div>
            <div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add Product</h4>
                   
                    <form class="forms-sample" action="addProduct.php" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="exampleInputUsername1">Name</label>
                        <input type="text" class="form-control" name="product" id="exampleInputUsername1" placeholder="Product name">
                      </div>
                      <div class="form-group">
                         
                        <label for="exampleInputEmail1">Category</label>
                        <select class="form-control" name="category" id="">
                             <option selected value="">Select category</option>
                             <?php
                              $select_category = mysqli_query($con, "SELECT * FROM category");
                              while($category_dtls=$select_category->fetch_assoc()){
                             ?>
                             <option value="<?php echo $category_dtls['Category']?>"><?php echo $category_dtls['Category']?></option>
                             <?php } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Price</label>
                        <input type="number" class="form-control" name="price" id="exampleInputPassword1" placeholder="Price">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputConfirmPassword1">Buying price</label>
                        <input type="number" class="form-control" name="bp" id="exampleInputConfirmPassword1" placeholder="Buying Price">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputConfirmPassword1">Image</label>
                        <input type="file" class="form-control" name="photo"  placeholder="Product image">
                      </div>
                      
                      <button type="submit" name="addproduct" class="btn btn-gradient-primary me-2">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add Category</h4>
                    <form class="forms-sample" action="addProduct.php" method="post">
                      <div class="form-group">
                        <label for="exampleInputUsername1">Category</label>
                        <input type="text" class="form-control" name="category" id="exampleInputUsername1" placeholder="Category">
                      </div>
                      
                      <button type="submit" name="addcategory" class="btn btn-gradient-primary me-2">Submit</button>
                    </form>
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
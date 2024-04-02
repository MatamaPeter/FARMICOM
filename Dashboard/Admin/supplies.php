<?php 
include ("config.php");
session_start();

if (!isset($_SESSION['email'])) {
  header("location:../../lform.php");
  exit;
  
} else {
  $username = $_SESSION['email'];
}

if (isset($_POST['delete'])) {

    $invoice= mysqli_real_escape_string($con, $_POST['invoice']);
    
    $delete_query = mysqli_query($con, "DELETE FROM supplies WHERE Invoice_no = '$invoice'");
    
    header("Location:supplies.php");
    exit;
  }
  

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addsupply']))  {
    $farmerNumber = $_POST['farmerNumber'];

    $select_farmers = mysqli_query($con, "SELECT * FROM farmers WHERE Member_number = '$farmerNumber'");
    if($select_farmers->num_rows > 0) {
        $farmers_dtls = $select_farmers->fetch_assoc();
        
        $firstName = $farmers_dtls['Firstname'];
        $lastName = $farmers_dtls['Lastname'];
        
        $name = $firstName . " " . $lastName;
        
        $product = $_POST['product'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $total = $_POST['total'];
        $billStatus = $_POST['billStatus'];
        $Date =  date('Y-m-d');
        $invoiceNo = "INV-" . time();

        $sql = "INSERT INTO `supplies` (`Invoice_no`, `Farmer_no`, `Name`, `Product`, `Quantity`, `Price`, `Total`, `Bill_status`, `Date`)
                VALUES ('$invoiceNo', '$farmerNumber', '$name', '$product', '$quantity', '$price', '$total', '$billStatus', '$Date')";

        if ($con->query($sql) === TRUE) {
            echo "<script>setTimeout(function() {alert('Data inserted successfully');}, 1000); </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    } else {
        echo "Error: Farmer details not found for the selected farmer number.";
    }
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
              <a class="nav-link" href="Supplies.php">
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
                  <i class="mdi mdi-truck-delivery"></i>
                </span> Supplies
               
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  
                </ul>
              </nav>
            </div>
                  
            <form method="post" action="" id="supplies-form">
                <select class="input-field input-drpdown" id="farmerNumber" name="farmerNumber" required>
                <option selected value="">Select Farmer</option>
                             <?php
                              $select_farmers = mysqli_query($con, "SELECT * FROM farmers");
                              while($farmers_dtls=$select_farmers->fetch_assoc()){
                             ?>
                             <option value="<?php echo $farmers_dtls['Member_number']?>"><?php echo $farmers_dtls['Member_number']?></option>
                             <?php } ?>
                </select>
                <br>
               


                <select class="input-field input-drpdown" id="product" name="product" onchange="updatePriceAndTotal()" required>
                <option selected value="">Select Product</option>
                             <?php
                              $select_product = mysqli_query($con, "SELECT * FROM products");
                              while($product_dtls=$select_product->fetch_assoc()){
                             ?>
                             <option value="<?php echo $product_dtls['Product_name']?>" data-price="<?php echo $product_dtls['Price']; ?>"><?php echo $product_dtls['Product_name']?></option>
                             <?php } ?>
                </select>
                <br>

                <input class="input-field" type="number" id="quantity" name="quantity" placeholder="Quantity" oninput="updatePriceAndTotal()" required>
                <br>

                <input class="input-field" type="text" id="price" name="price" placeholder="Price" readonly>
                <br>

                <input class="input-field" type="text" id="total" name="total" placeholder="Total" readonly>
                <br>

                <select  class="input-field" id="billStatus" name="billStatus" required>
                    <option value="cleared">Cleared</option>
                    <option value="uncleared">Uncleared</option>
                </select>
                <br>

                <button type="submit" name="addsupply" class="input-frm_btn btn-add-farmer btn-icon-text">
                <i class="mdi mdi-file-plus btn-icon-prepend"></i> Add Supply </button>
                </form>
                <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                  
                      <table class="table table-striped">
                      <thead>
                        <tr>
                          <th> Invoice No. </th>
                          <th> Date</th>
                          <th> Member No. </th>
                          <th> Name </th>
                          <th> Products </th>
                          <th> Quantity </th>
                          <th> Bill </th>
                          <th> Bill Status </th>
                          <th> Action </th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                          $select_supplies = mysqli_query($con, "SELECT * FROM supplies") or die ("Query failed");
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
                          
                          <td> 
                            
                            <button type="submit" name="delete" class="btn-icon-text btn-tbl-farmers-dg">
                            <i class="mdi mdi-delete btn-icon-prepend"></i>Delete</button>
                            
                          </td>
                          
                        </tr>
                        
                        </form>
                        <?php } ?>
                         
                      </tbody>
                    </table>
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
        function updatePriceAndTotal() {
            const productSelect = document.getElementById('product');
            const priceInput = document.getElementById('price');
            const quantityInput = document.getElementById('quantity');
            const totalInput = document.getElementById('total');

            const selectedOption = productSelect.options[productSelect.selectedIndex];
            const price = selectedOption.dataset.price;

            priceInput.value = price;

            const quantity = quantityInput.value;
            const total = price * quantity;

            totalInput.value = total;
        }
</script>

</script>
  </body>
</html>
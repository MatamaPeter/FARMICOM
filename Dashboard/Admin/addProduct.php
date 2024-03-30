<?php 
include("config.php");
session_start();

// Redirect to login page if user is not logged in
if (!isset($_SESSION['email'])) {
    header("location: lform.php");
    exit;
} else {
    $username = $_SESSION['email'];
}

if(isset($_POST['addproduct'])) {
    if(isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/product-pics/';
        $uploadFile = $uploadDir . basename($_FILES['photo']['name']);


        if(move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
            $photo = mysqli_real_escape_string($con, $uploadFile);
            $productname = mysqli_real_escape_string($con, $_POST['product']);
            $category = mysqli_real_escape_string($con, $_POST['category']);
            $price = mysqli_real_escape_string($con, $_POST['price']);
            $BP = mysqli_real_escape_string($con, $_POST['bp']);

            $query = "INSERT INTO products (Product_name, Product_category, Price, Product_img, Buying_price)
                      VALUES('$productname', '$category', '$price', '$photo', '$BP')";

            if(mysqli_query($con, $query)) {
                echo "<script>alert('Product added successfully.');</script>";
                echo "<script>setTimeout(function(){ window.location.href = 'products.php'; }, 1000);</script>"; // Redirect after 3 seconds
                exit;
            } else {
                echo "<script>alert('Failed to add product to the database: " . mysqli_error($con) . "');</script>";
                echo "<script>setTimeout(function(){ window.location.href = 'products.php'; }, 1000);</script>"; // Redirect after 3 seconds
                exit;
            }
        } else {
            echo "<script>alert('Failed to move uploaded file.');</script>";
            echo "<script>setTimeout(function(){ window.location.href = 'products.php'; }, 1000);</script>"; // Redirect after 3 seconds
                exit;
        }
    } else {
        echo "<script>alert('No file uploaded or file upload error occurred.');</script>";
        echo "<script>setTimeout(function(){ window.location.href = 'products.php'; }, 1000);</script>"; // Redirect after 3 seconds
                exit;
    }
}

if(isset($_POST['addcategory'])) {
  $CATEGORY = mysqli_real_escape_string($con, $_POST['category']);
mysqli_query($con,"INSERT INTO category (Category)VALUES('$CATEGORY')");
}
echo "<script>alert('Category added successfully.');</script>";
                echo "<script>setTimeout(function(){ window.location.href = 'products.php'; }, 1000);</script>"; // Redirect after 3 seconds
                exit;
?>

<?php
session_start();
include("config.php");

if (!isset($_SESSION['email'])) {
    $message = 'Kindly login to place order';
    echo $message;
    exit;
    
} else {
    $username = $_SESSION['email'];
}

$product_name = $_POST['product_name'];
$product_price = $_POST['price'];
$product_image = $_POST['product_image'];

$check_cart_query = mysqli_query($con, "SELECT * FROM `cart` WHERE name = '$product_name' AND username = '$username'");

if (mysqli_num_rows($check_cart_query) > 0) {
    $cart_item = mysqli_fetch_assoc($check_cart_query);
    $sub_total = $cart_item['quantity'] * $cart_item['price'];
    $message = 'The product is already added to the cart!';
} else {
    $sub_total = $product_price;
    mysqli_query($con, "INSERT INTO `cart`(username, name, price, subtotal, image) VALUES('$username', '$product_name', '$product_price', '$sub_total', '$product_image')") or die("Query failed: " . mysqli_error($con));
    $message = 'The product has been added to the cart!';
}

echo $message; // Send the response back to the client

?>
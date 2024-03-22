<?php
session_start();
$username = $_SESSION['username'];
include("config.php");

$username = $_SESSION['username'];
echo $username;

$product_name = isset($_POST['product_name']) ? $_POST['product_name'] : '';
$price = isset($_POST['price']) ? $_POST['price'] : '';
$product_image = isset($_POST['product_image']) ? $_POST['product_image'] : '';
 echo $product_image.$price.$product_name;

 $check_cart_numbers = mysqli_query($con, "SELECT * FROM `cart` WHERE name = '$product_name' AND username = '$username'") or die('query failed');

 if(mysqli_num_rows($check_cart_numbers) > 0){
    $message[] = 'already added to cart!';
 }else{
    mysqli_query($con, "INSERT INTO `cart`(username, name, price, image) VALUES('$username', '$product_name', '$price', '$product_image')") or die('query failed');
    $message[] = 'product added to cart!';
 }


?>
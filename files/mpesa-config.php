<?php
require_once 'vendor/autoload.php';

$consumerKey = 'gqVkKQRQmfzKHNH5SoEPMGkKTApm34rkTtK3fUlBG6AnIBYu'; // Replace with your Consumer Key
$consumerSecret = 'FYvM3uzpa1AMsDrZdC4SaeJftShEXQI2n7mtHcvYG9841FSPhg5haSlEApDGJv0K'; // Replace with your Consumer Secret

$env = 'sandbox'; // Use 'live' for production

$mpesaConfig = [
    'env' => $env,
    'customer_key' => $consumerKey,
    'customer_secret' => $consumerSecret,
    'short_code' => 'YOUR_SHORTCODE', // Replace with your M-Pesa short code
    'passkey' => 'YOUR_PASSKEY', // Replace with your M-Pesa passkey
];
?>
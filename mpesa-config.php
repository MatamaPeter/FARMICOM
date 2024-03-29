<?php
require 'vendor/autoload.php';

$consumerKey = 'G7RD0il4My4G76AGP2AZd0sZUvvkrxpg'; // Replace with your Consumer Key
$consumerSecret = 's0G8fWDHg4VQfSu5'; // Replace with your Consumer Secret

$env = 'sandbox'; // Use 'live' for production

$mpesaConfig  = [
    'env' => $env,
    'customer_key' => $consumerKey,
    'customer_secret' => $consumerSecret,
    'short_code' => '174379', // Replace with your M-Pesa short code
    'passkey' => 'MTc0Mzc5YmZiMjc5TliZGJjZjE1OGU5N2RkNzFhNDY3Y2QyZTBjODkzMDU5YjEwZjc4ZTZiNzJhZGExZWQyYzkxOTIwMTYwMjE2MTY1NjI3', // Replace with your M-Pesa passkey
];
?>
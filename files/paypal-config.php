<?php
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Core\ProductionEnvironment;

// Replace these values with your PayPal app's Client ID and Secret
$clientId = "AVrpS-IfYQtzj0s949Kf_aYmbVJ_UcF7E6lhKpCQkHFGvX2VkpTYC_vIW4j1HUz6D0hbBaOvAYAc4D9p";
$clientSecret = "ELf4EBNW9I64UpY31c1H98sQt9GXcm6z01YKza-dFVATSPNc4yKUBi3WGvhpsl0f1iYQ801tIjrgoQdR";

// If you're using a sandbox environment, uncomment the lines below
$environment = new SandboxEnvironment($clientId, $clientSecret);
$client = new PayPalHttpClient($environment);

// If you're using a production environment, uncomment the lines below
// $environment = new ProductionEnvironment($clientId, $clientSecret);
// $client = new PayPalHttpClient($environment);
?>
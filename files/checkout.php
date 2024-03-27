<?php 
session_start();

require 'paypal-includes.php';
require 'paypal-config.php';
require 'mpesa-config.php';
require 'vendor/autoload.php';




include("config.php");

use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalHttp\HttpException;




if (!isset($_SESSION['email'])) {
    $message = 'Kindly login to Checkout';
    echo "<script>alert('$message');</script>";
    echo "<script>window.setTimeout(function() { window.location.href = 'product.php'; }, 600);</script>";
    exit;
} else {
    $username = $_SESSION['email'];
}

if (isset($_SESSION['email'])) {
    $stmt = $con->prepare("SELECT * FROM cart WHERE Username = ?") or die("Query failed");
    $stmt->bind_param("s", $_SESSION['email']);
    $stmt->execute();
    $cart_sum = $stmt->get_result();
    $Cart_number = $cart_sum->num_rows;
}else{$Cart_number=0;}

    
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_btn'])) {
    $User_email = $username;
    $country = mysqli_real_escape_string($con, $_POST['country']);
    $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $building = mysqli_real_escape_string($con, $_POST['building']);
    $town = mysqli_real_escape_string($con, $_POST['town']);
    $orderDate = date("Y-m-d");
    $payment_id = mysqli_real_escape_string($con, 000);
    $payment_status = mysqli_real_escape_string($con, "complete");
    $order_status = mysqli_real_escape_string($con, "processing");
    $total = $_POST['cartprice'];

    if (isset($_POST['mpesa'])) {

        
            $payment_method = "M-pesa";
            $phone = mysqli_real_escape_string($con, $_POST['phone']);
            $payment_id = "MPESA_" . uniqid();
            $select_cart = mysqli_query($con, "SELECT * FROM cart WHERE username = '$username'");
        
            if ($select_cart->num_rows !== 0) {
                $subtotal = 0;
                while ($cart_items = mysqli_fetch_assoc($select_cart)) {
                    if (isset($cart_items['quantity']) && isset($cart_items['price'])) {
                        $sub_total = ($cart_items['price']) * $cart_items['quantity'];
                        $subtotal += $sub_total;
                    }
                    if ($subtotal >= 5000) {
                        $Shipping_cost = 0;
                    } else {
                        $Shipping_cost = round(0.45 * $subtotal, 0);
                    }
                    $gtotal = $subtotal + $Shipping_cost;
                    $amount = $gtotal;
                }
            }
        
            if (!preg_match('/^254\d{9}$/', $phone)) {
                echo "<script>alert('Invalid phone number format. Please enter a valid Kenyan phone number starting with 254.');</script>";
                exit;
            }
            function getAccessToken($consumer_key, $consumer_secret)
        {
            $credentials = base64_encode($consumer_key . ':' . $consumer_secret);
        
            $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
            $headers = [
                'Authorization: Basic ' . $credentials
            ];
        
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
            $response = curl_exec($ch);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
        
            if ($http_code !== 200) {
                return null;
            }
        
            $response_data = json_decode($response, true);
            return $response_data['access_token'];
        }
        
            $consumer_key = 'G7RD0il4My4G76AGP2AZd0sZUvvkrxpg';
            $consumer_secret = 's0G8fWDHg4VQfSu5';
            $access_token = getAccessToken($consumer_key, $consumer_secret);
        
            if (!$access_token) {
                echo "<script>alert('Failed to obtain access token from M-Pesa API');</script>";
                exit;
            }
        
            $business_short_code = '174379';
            $passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
            $timestamp = date("YmdHms"); // Get the current timestamp in the required format
            $password = $business_short_code . $passkey . $timestamp;
            $encoded_password = base64_encode($password);
        
            $ch = curl_init('https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest');
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer ' . $access_token,
                'Content-Type: application/json'
            ]);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, [
                "BusinessShortCode" => $business_short_code,
                "Password" => $encoded_password,
                "Timestamp" => $timestamp,
                "TransactionType" => "CustomerPayBillOnline",
                "Amount" => $amount,
                "PartyA" => $phone,
                "PartyB" => $business_short_code,
                "PhoneNumber" => $phone,
                "CallBackURL" => "https://mydomain.com/path",
                "AccountReference" => $payment_id,
                "TransactionDesc" => "Payment for order"
            ]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
            $response = curl_exec($ch);
            curl_close($ch);
            echo $response;
        
        /**
         * Function to get access token from M-Pesa API
         *
         * @param string $consumer_key
         * @param string $consumer_secret
         *
         * @return string|null
         */
        
         $payload = [
            "BusinessShortCode" => $business_short_code,
            "Password" => $encoded_password,
            "Timestamp" => $timestamp,
            "TransactionType" => "CustomerPayBillOnline",
            "Amount" => $amount,
            "PartyA" => $phone,
            "PartyB" => $business_short_code,
            "CallBackURL" => "https://mydomain.com/path",
            "AccountReference" => $payment_id,
            "TransactionDesc" => "Payment for order"
        ];
        
        echo json_encode($payload, JSON_PRETTY_PRINT);
    }elseif (isset($_POST['paypal'])) {
        $payment_id = mysqli_real_escape_string($con, "PAYPAL-" . uniqid());
        $payment_method = "PayPal";
    
        // Calculate $gtotal
        $select_cart = mysqli_query($con, "SELECT * FROM cart WHERE username = '$username'");
        if($select_cart->num_rows!==0){
            $subtotal = 0;
        while ($cart_items = mysqli_fetch_assoc($select_cart)) {
            
            

            if (isset($cart_items['quantity']) && isset($cart_items['price'])) {
                $sub_total = ($cart_items['price']) * $cart_items['quantity'] ;  
                $subtotal += $sub_total;
        }
        if ($subtotal >= 5000) {
            $Shipping_cost = 0;
        } else {
            $Shipping_cost = round(0.45 * $subtotal, 0);
        }
        $gtotal = $subtotal + $Shipping_cost;
        $amount = $gtotal;}}
    
        // Create a PayPal order
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = array(
            'intent' => 'CAPTURE',
            'purchase_units' => array(
                array(
                    'amount' => array(
                        'currency_code' => 'USD', // Update with your desired currency code
                        'value' => $gtotal 
                    )
                )
            )
        );
    
        try {
            $response = $client->execute($request);
            $approvalUrl = $response->result->links[1]->href;
            // Redirect the user to the PayPal approval URL
            header("Location: $approvalUrl");
            exit;
        } catch (HttpException $ex) {
            echo $ex->statusCode;
            print_r($ex->getMessage());
        }
    }else {
        echo "<script>alert('Please select a payment method');</script>";
        exit;
    }

    $sql = "INSERT INTO orders (`User_email`, `country`, `firstname`, `lastname`, `address`, `building`, `town`, `orderDate`, `payment_id`, `payment_method`, `payment_status`, `order_status`, `product`, `total`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);

    foreach ($_POST['cartitem'] as $key => $product) {
        $price = $_POST['cartprice'][$key];
        $stmt->bind_param("ssssssssssssss", $User_email, $country, $firstname, $lastname, $address, $building, $town, $orderDate, $payment_id, $payment_method, $payment_status, $order_status, $product, $price);
        if ($stmt->execute()) {
            echo "<script>alert('Order made successfully');</script>";
            mysqli_query($con,"DELETE FROM cart WHERE username = '$username'");
        } else {
            echo "<script>alert('Order failed);</script>";
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
}


 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Farmicom || Online Farming Market</title>
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/favicon-16x16.png">
    <link rel="manifest" href="assets/images/favicons/site.webmanifest">

    <!-- Fonts-->
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet">
    <!-- Css-->
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/swiper.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-select.min.css">

    <link rel="stylesheet" href="assets/css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="assets/css/vegas.min.css">
    <link rel="stylesheet" href="assets/css/nouislider.min.css">
    <link rel="stylesheet" href="assets/css/nouislider.pips.css">
    <link rel="stylesheet" href="assets/css/agrikol_iconl.css">
    <!-- Template styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">

</head>

<body>

    <div class="preloader">
        <img src="assets/images/loader.png" class="preloader__image" alt="">
    </div><!-- /.preloader -->

    <div class="page-wrapper">


        <div class="site-header__header-one-wrap">

            <div class="topbar-one">
                <div class="topbar_bg" style="background-image: url(assets/images/shapes/header-bg.png)"></div>
                <div class="container">
                    <div class="topbar-one__left">
                        <a href="mail to: info@farmicom.com"><span class="icon-message"></span>info@farmicom.com</a>
                        <a href="+254 712 345 678"><span class="icon-phone-call"></span>+254 712 345 678</a>
                    </div>
                    <div class="topbar-one__middle">
                        <a href="index.php" class="main-nav__logo">
                            <img src="assets/images/resources/logo.png" class="main-logo" alt="Awesome Image" />
                        </a>
                    </div>
                    <div class="topbar-one__right">
                        <div class="topbar-one__social">
                            <a href="#"><i class="fab fa-facebook-square"></i></a>
                            <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
                                <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
                              </svg></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-dribbble"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <header class="main-nav__header-one">
                <nav class="header-navigation stricky">
                    <div class="container clearfix">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="main-nav__left">
                            <a href="#" class="main-nav__search search-popup__toggler"><i
                                    class="icon-magnifying-glass"></i></a>
                            <a href="#" class="side-menu__toggler">
                                <i class="fa fa-bars"></i>
                            </a>
                        </div>
                        <div class="main-nav__main-navigation">
                            <ul class=" main-nav__navigation-box">
                                <li class="dropdown">
                                    <a href="index.php">Home</a>
                                  
                                </li>
                                <li class="dropdown current">
                                    <a href="product.php">Shop</a>
                                    <ul>
                                        <li><a href="cart.php">Cart</a></li>
                                        <li><a href="checkout.php">Checkout</a></li>
                                        <li><a href="orders.php">Orders</a></li>

                                    </ul><!-- /.sub-menu -->
                                </li>
                                
                                                         
                                <li class="dropdown">
                                    <a href="about.php">About Us</a>
                                    <ul>
                                        <li><a href="why_choose_us.php">Why Choose Us</a></li>
                                        
                                    </ul><!-- /.sub-menu -->
                                </li>
                                
                                <li>
                                    <a href="contact.php">Contacts</a>
                                </li>
                                <li>
                                    <a href="farmers.php">Farmers</a>
                                </li>

                            </ul>
                        
                        </div><!-- /.navbar-collapse -->

                        <div class="main-nav__right">
                            <div class="icon_cart_box">
                                <?php
                                if(isset($_SESSION['email'])){
                                    
                                    echo"<div class='usern'>{$_SESSION['email']}</div>
                                     <center><a href='logout.php'><button class='logout-button'>Logout</button></a></center>";
                                }else{
                                    echo"<center><a href='lform.php'><button class='logout-button'>Login</button></a></center>";
                                }
                                ?>
                            </div>
                            <div class="icon_cart_box">
                                
                            <a href="cart.php">
                            
                                    <sup><?php echo $Cart_number?></sup><span class="icon-shopping-cart"></span>
                                  </a>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
        </div>
        </div>
        <section class="page-header" style="background-image: url(assets/images/backgrounds/page-header-contact.jpg);">
            <div class="container">
                <h2>Checkout</h2>
                <ul class="thm-breadcrumb list-unstyled">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="" class="shop_style">Shop</a></li>
                    <li><span>checkout</span></li>
                </ul>
            </div>
        </section>

        <section class="checkout">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        <div class="billing_details">
                            <div class="billing_title">
                                
                                <h2>Billing Details</h2>
                            </div>
                            <form class="billing_details_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="billing_input_box">
                                            <select name="country" id="currency" class="selectpicker" >
                                                <option value="Country">Select a country</option>
                                                <option value="Afghanistan">Afghanistan</option>
                                                <option value="Åland Islands">Åland Islands</option>
                                                <option value="Albania">Albania</option>
                                                <option value="Algeria">Algeria</option>
                                                <option value="American Samoa">American Samoa</option>
                                                <option value="Andorra">Andorra</option><option value="Angola">Angola</option>
                                                <option value="Anguilla">Anguilla</option>
                                                <option value="Antarctica">Antarctica</option>
                                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                <option value="Argentina">Argentina</option>
                                                <option value="Armenia">Armenia</option>
                                                <option value="Aruba">Aruba</option>
                                                <option value="Australia">Australia</option>
                                                <option value="Austria">Austria</option>
                                                <option value="Azerbaijan">Azerbaijan</option>
                                                <option value="Bahamas">Bahamas</option>
                                                <option value="Bahrain">Bahrain</option>
                                                <option value="Bangladesh">Bangladesh</option>
                                                <option value="Barbados">Barbados</option>
                                                <option value="Belarus">Belarus</option>
                                                <option value="Belgium">Belgium</option>
                                                <option value="Belize">Belize</option>
                                                <option value="Benin">Benin</option>
                                                <option value="Bermuda">Bermuda</option>
                                                <option value="Bhutan">Bhutan</option>
                                                <option value="Bolivia">Bolivia</option>
                                                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                                <option value="Botswana">Botswana</option>
                                                <option value="Bouvet Island">Bouvet Island</option>
                                                <option value="Brazil">Brazil</option>
                                                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                                <option value="Brunei Darussalam">Brunei Darussalam</option>
                                                <option value="Bulgaria">Bulgaria</option>
                                                <option value="Burkina Faso">Burkina Faso</option>
                                                <option value="Burundi">Burundi</option>
                                                <option value="Cambodia">Cambodia</option>
                                                <option value="Cameroon">Cameroon</option>
                                                <option value="Canada">Canada</option>
                                                <option value="Cape Verde">Cape Verde</option>
                                                <option value="Cayman Islands">Cayman Islands</option>
                                                <option value="Central African Republic">Central African Republic</option>
                                                <option value="Chad">Chad</option>
                                                <option value="Chile">Chile</option>
                                                <option value="China">China</option>
                                                <option value="Christmas Island">Christmas Island</option>
                                                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                                <option value="Colombia">Colombia</option>
                                                <option value="Comoros">Comoros</option>
                                                <option value="Congo">Congo</option>
                                                <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                                <option value="Cook Islands">Cook Islands</option>
                                                <option value="Costa Rica">Costa Rica</option>
                                                <option value="Cote D'ivoire">Cote D'ivoire</option>
                                                <option value="Croatia">Croatia</option>
                                                <option value="Cuba">Cuba</option>
                                                <option value="Cyprus">Cyprus</option>
                                                <option value="Czech Republic">Czech Republic</option>
                                                <option value="Denmark">Denmark</option>
                                                <option value="Djibouti">Djibouti</option>
                                                <option value="Dominica">Dominica</option>
                                                <option value="Dominican Republic">Dominican Republic</option>
                                                <option value="Ecuador">Ecuador</option>
                                                <option value="Egypt">Egypt</option>
                                                <option value="El Salvador">El Salvador</option>
                                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                <option value="Eritrea">Eritrea</option>
                                                <option value="Estonia">Estonia</option>
                                                <option value="Ethiopia">Ethiopia</option>
                                                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                                <option value="Faroe Islands">Faroe Islands</option>
                                                <option value="Fiji">Fiji</option>
                                                <option value="Finland">Finland</option>
                                                <option value="France">France</option>
                                                <option value="French Guiana">French Guiana</option>
                                                <option value="French Polynesia">French Polynesia</option>
                                                <option value="French Southern Territories">French Southern Territories</option>
                                                <option value="Gabon">Gabon</option>
                                                <option value="Gambia">Gambia</option>
                                                <option value="Georgia">Georgia</option>
                                                <option value="Germany">Germany</option>
                                                <option value="Ghana">Ghana</option>
                                                <option value="Gibraltar">Gibraltar</option>
                                                <option value="Greece">Greece</option>
                                                <option value="Greenland">Greenland</option>
                                                <option value="Grenada">Grenada</option>
                                                <option value="Guadeloupe">Guadeloupe</option>
                                                <option value="Guam">Guam</option>
                                                <option value="Guatemala">Guatemala</option>
                                                <option value="Guernsey">Guernsey</option>
                                                <option value="Guinea">Guinea</option>
                                                <option value="Guinea-bissau">Guinea-bissau</option>
                                                <option value="Guyana">Guyana</option>
                                                <option value="Haiti">Haiti</option>
                                                <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                                <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                                <option value="Honduras">Honduras</option>
                                                <option value="Hong Kong">Hong Kong</option>
                                                <option value="Hungary">Hungary</option>
                                                <option value="Iceland">Iceland</option>
                                                <option value="India">India</option>
                                                <option value="Indonesia">Indonesia</option>
                                                <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                                <option value="Iraq">Iraq</option>
                                                <option value="Ireland">Ireland</option>
                                                <option value="Isle of Man">Isle of Man</option>
                                                <option value="Israel">Israel</option>
                                                <option value="Italy">Italy</option>
                                                <option value="Jamaica">Jamaica</option>
                                                <option value="Japan">Japan</option>
                                                <option value="Jersey">Jersey</option>
                                                <option value="Jordan">Jordan</option>
                                                <option value="Kazakhstan">Kazakhstan</option>
                                                <option value="Kenya" selected>Kenya</option>
                                                <option value="Kiribati">Kiribati</option>
                                                <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                                <option value="Korea, Republic of">Korea, Republic of</option>
                                                <option value="Kuwait">Kuwait</option>
                                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                                <option value="Latvia">Latvia</option>
                                                <option value="Lebanon">Lebanon</option>
                                                <option value="Lesotho">Lesotho</option>
                                                <option value="Liberia">Liberia</option>
                                                <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                                <option value="Liechtenstein">Liechtenstein</option>
                                                <option value="Lithuania">Lithuania</option>
                                                <option value="Luxembourg">Luxembourg</option>
                                                <option value="Macao">Macao</option>
                                                <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                                <option value="Madagascar">Madagascar</option>
                                                <option value="Malawi">Malawi</option>
                                                <option value="Malaysia">Malaysia</option>
                                                <option value="Maldives">Maldives</option>
                                                <option value="Mali">Mali</option>
                                                <option value="Malta">Malta</option>
                                                <option value="Marshall Islands">Marshall Islands</option>
                                                <option value="Martinique">Martinique</option>
                                                <option value="Mauritania">Mauritania</option>
                                                <option value="Mauritius">Mauritius</option>
                                                <option value="Mayotte">Mayotte</option>
                                                <option value="Mexico">Mexico</option>
                                                <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                                <option value="Moldova, Republic of">Moldova, Republic of</option>
                                                <option value="Monaco">Monaco</option>
                                                <option value="Mongolia">Mongolia</option>
                                                <option value="Montenegro">Montenegro</option>
                                                <option value="Montserrat">Montserrat</option>
                                                <option value="Morocco">Morocco</option>
                                                <option value="Mozambique">Mozambique</option>
                                                <option value="Myanmar">Myanmar</option>
                                                <option value="Namibia">Namibia</option>
                                                <option value="Nauru">Nauru</option>
                                                <option value="Nepal">Nepal</option>
                                                <option value="Netherlands">Netherlands</option>
                                                <option value="Netherlands Antilles">Netherlands Antilles</option>
                                                <option value="New Caledonia">New Caledonia</option>
                                                <option value="New Zealand">New Zealand</option>
                                                <option value="Nicaragua">Nicaragua</option>
                                                <option value="Niger">Niger</option>
                                                <option value="Nigeria">Nigeria</option>
                                                <option value="Niue">Niue</option>
                                                <option value="Norfolk Island">Norfolk Island</option>
                                                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                                <option value="Norway">Norway</option>
                                                <option value="Oman">Oman</option>
                                                <option value="Pakistan">Pakistan</option>
                                                <option value="Palau">Palau</option>
                                                <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                                <option value="Panama">Panama</option>
                                                <option value="Papua New Guinea">Papua New Guinea</option>
                                                <option value="Paraguay">Paraguay</option>
                                                <option value="Peru">Peru</option>
                                                <option value="Philippines">Philippines</option>
                                                <option value="Pitcairn">Pitcairn</option>
                                                <option value="Poland">Poland</option>
                                                <option value="Portugal">Portugal</option>
                                                <option value="Puerto Rico">Puerto Rico</option>
                                                <option value="Qatar">Qatar</option>
                                                <option value="Reunion">Reunion</option>
                                                <option value="Romania">Romania</option>
                                                <option value="Russian Federation">Russian Federation</option>
                                                <option value="Rwanda">Rwanda</option>
                                                <option value="Saint Helena">Saint Helena</option>
                                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                <option value="Saint Lucia">Saint Lucia</option>
                                                <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                                <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                                <option value="Samoa">Samoa</option>
                                                <option value="San Marino">San Marino</option>
                                                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                                <option value="Saudi Arabia">Saudi Arabia</option>
                                                <option value="Senegal">Senegal</option>
                                                <option value="Serbia">Serbia</option>
                                                <option value="Seychelles">Seychelles</option>
                                                <option value="Sierra Leone">Sierra Leone</option>
                                                <option value="Singapore">Singapore</option>
                                                <option value="Slovakia">Slovakia</option>
                                                <option value="Slovenia">Slovenia</option>
                                                <option value="Solomon Islands">Solomon Islands</option>
                                                <option value="Somalia">Somalia</option>
                                                <option value="South Africa">South Africa</option>
                                                <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                                <option value="Spain">Spain</option>
                                                <option value="Sri Lanka">Sri Lanka</option>
                                                <option value="Sudan">Sudan</option>
                                                <option value="Suriname">Suriname</option>
                                                <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                                <option value="Swaziland">Swaziland</option>
                                                <option value="Sweden">Sweden</option>
                                                <option value="Switzerland">Switzerland</option>
                                                <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                                <option value="Taiwan">Taiwan</option>
                                                <option value="Tajikistan">Tajikistan</option>
                                                <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                                <option value="Thailand">Thailand</option>
                                                <option value="Timor-leste">Timor-leste</option>
                                                <option value="Togo">Togo</option>
                                                <option value="Tokelau">Tokelau</option>
                                                <option value="Tonga">Tonga</option>
                                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                                <option value="Tunisia">Tunisia</option>
                                                <option value="Turkey">Turkey</option>
                                                <option value="Turkmenistan">Turkmenistan</option>
                                                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                                <option value="Tuvalu">Tuvalu</option>
                                                <option value="Uganda">Uganda</option>
                                                <option value="Ukraine">Ukraine</option>
                                                <option value="United Arab Emirates">United Arab Emirates</option>
                                                <option value="United Kingdom">United Kingdom</option>
                                                <option value="United States">United States</option>
                                                <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                                <option value="Uruguay">Uruguay</option>
                                                <option value="Uzbekistan">Uzbekistan</option>
                                                <option value="Vanuatu">Vanuatu</option>
                                                <option value="Venezuela">Venezuela</option>
                                                <option value="Viet Nam">Viet Nam</option>
                                                <option value="Virgin Islands, British">Virgin Islands, British</option>
                                                <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                                <option value="Wallis and Futuna">Wallis and Futuna</option>
                                                <option value="Western Sahara">Western Sahara</option>
                                                <option value="Yemen">Yemen</option>
                                                <option value="Zambia">Zambia</option>
                                                <option value="Zimbabwe">Zimbabwe</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="billing_input_box">
                                            <input type="text" name="firstname" value="" placeholder="First name"
                                                required="">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="billing_input_box">
                                            <input type="text" name="lastname" value="" placeholder="Last name"
                                                required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                   
                                    <div class="col-xl-12">
                                        <div class="billing_input_box">
                                            <input type="text" name="address" value="" placeholder="Address" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="billing_input_box">
                                            <input type="tel" name="phone" value=""
                                                placeholder="phone" required="">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="billing_input_box">
                                            <input type="text" name="building" value=""
                                                placeholder="Appartment, Unit, etc." required="">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="billing_input_box">
                                            <input type="text" name="town" value="" placeholder="Town / City"
                                                required="">
                                        </div>
                                    </div>
                                </div>
                                
                                
                           
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="billing_details ship_different_address">
                            <div class="your_order">
                                <h2>Your Order</h2>
                                <div class="row">
                                    
                                        <div class="order_table_box">
                                            <table class="order_table_detail">
                                                <thead class="order_table_head">
                                                    <tr>
                                                        <th>Product</th>
                                                        <th class="text-right">Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                     <?php
                                                        if (isset($_SESSION['email'])) {
                                                            $username = $_SESSION['email'];
                                                            $select_cart = mysqli_query($con, "SELECT * FROM cart WHERE username = '$username'");
                                                            if($select_cart->num_rows!==0){
                                                                $subtotal = 0;
                                                            while ($cart_items = mysqli_fetch_assoc($select_cart)) {
                                                                
                                                                
                                                    
                                                                if (isset($cart_items['quantity']) && isset($cart_items['price'])) {
                                                                    $sub_total = ($cart_items['price']) * $cart_items['quantity'] ;  
                                                                    $subtotal += $sub_total;
                                                       ?>              
                                                       
                                                    <tr>
                                                        <td class="pro__title"><?php echo $cart_items['name']; ?></td>
                                                        <td class="pro__price"><?php echo $sub_total; ?></td>
                                                    </tr>
                                                  
                                                    <input type="hidden" name="cartitem[]" value="<?php echo $cart_items['name']; ?>">
                                                     <input type="hidden" name="cartprice[]" value="<?php echo $cart_items['price']; ?>">

                                                    <?php } } } } ?>
                                                    <tr>
                                                        <td class="pro__title"><b>Subtotal</b></td>
                                                        <td class="pro__price"><?php echo "KES ". $subtotal ?> </td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td class="pro__title"><b>Shipping</b></td>
                                                        <td class="pro__price">
                                                            <?php if($subtotal >= 5000){$Shipping_cost = 0;}
                                                                  else {$Shipping_cost = round(0.45 * $subtotal, 0);
                                                                   }echo "KES ". $Shipping_cost;
                                                            ?> </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pro__title"><b>Total</b></td>
                                                        <td class="pro__price"><?php echo "KES ". $gtotal = $subtotal + $Shipping_cost?> </td>
                                                    </tr>
                                                   
                                                </tbody>
                                            </table>
                                        </div>
                                    </div><br>
                                    
                                        <div class="payments_part">
                                            <div class="direct">
                                                <div class="checkbox">
                                                    <label>
                                                        <input name="mpesa" type="radio">
                                                        <span>M-pesa payment</span>
                                                        <i class="paypal_card"><img src="assets/images/shop/paypal-card.jpg"
                                                                alt=""></i>
                                                    </label>
                                                </div>
                                                <div class="payments_part_text">
                                                    <p> </p>
                                                </div>
                                            </div>
                                            <div class="paypal_payment">
                                                <div class="checkbox">
                                                    <label>
                                                        <input name="paypal" type="radio">
                                                        <span>Paypal Payment</span>
                                                        <i class="paypal_card"><img src="assets/images/shop/paypal-card.jpg"
                                                                alt=""></i>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="place_order_btn">
                                                    <button name="order_btn" class="thm-btn">Place Your Order</button>
                                                </div>
                                 
                                            </div>
                                        </div>
                                   
                            </form>
                        </div>
                    </div>
                </div>
                
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="site-footer">
            <div class="site-footer_farm_image"><img src="assets/images/resources/site-footer-farm.png"
                    alt="Farm Image"></div>
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="footer-widget__column footer-widget__about wow fadeInUp" data-wow-delay="100ms">
                            <div class="footer-widget__title">
                                <h3>About</h3>
                            </div>
                            <div class="footer-widget_about_text">
                                <p>Experience elevated farming with Farmicom : where seamless online shopping, top-quality products, 
                                    and innovative solutions converge  </p>
                            </div>
                            <?php
                                if(isset($_POST['subscribe'])){
                                    $Email = mysqli_real_escape_string($con, $_POST['email']);
                                    
                                    $stmt = $con->prepare("SELECT * FROM subscriptions WHERE Email = ?");
                                    $stmt -> bind_param("s",$Email);
                                    $stmt -> execute();
                                    $fetch_sub = $stmt -> get_result();

                                    if($fetch_sub->num_rows!==0){
                                        echo "<script>alert('Already subscribed');</script>";
                                    }else{
                                        mysqli_query($con, "INSERT INTO subscriptions (email) VALUES('$Email')");
                                        echo "<script>alert('Subscribed successfully');</script>";
                                    }
                                }
                            ?>
                            <form action="" method="post">
                                <div class="footer_input-box">
                                    <input type="Email"  name = "email" placeholder="Email Address">
                                    <button type="submit" name="subscribe" class="button"><i class="fa fa-check"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-6">
                        <div class="footer-widget__column footer-widget__link wow fadeInUp" data-wow-delay="200ms">
                            <div class="footer-widget__title">
                                <h3>Explore</h3>
                            </div>
                            <ul class="footer-widget__links-list list-unstyled">
                                <li><a href="about.php">About Us</a></li>
                                <li><a href="product.php">Shop with us</a></li>
                                <li><a href="farmers.php">Meet the Farmers</a></li>
                                <li><a href="contact.php">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="footer-widget__column footer-widget__contact wow fadeInUp" data-wow-delay="400ms">
                            <div class="footer-widget__title">
                                <h3>Contact</h3>
                            </div>
                            <div class="footer-widget_contact">
                                <p>Nairobi, Kenya<br>365-00100, Nairobi</p>
                                <a href="mailto:info@farmicom.com">info@farmicom.com</a><br>
                                <a href="tel:+254 712 345 678">+254 712 345 678</a>
                                <div class="site-footer__social">
                                    <a href="#"><i class="fab fa-facebook-square"></i></a>
                                    <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
                                        <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
                                      </svg></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                    <a href="#"><i class="fab fa-dribbble"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </footer>

        <div class="site-footer_bottom">
            <div class="container">
                <div class="site-footer_bottom_copyright">
                    <p>@ All copyright 2024, <a href="#">Farmicom.com</a></p>
                </div>
                <div class="site-footer_bottom_menu">
                    <ul class="list-unstyled">
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Use</a></li>
                    </ul>
                </div>
            </div>
        </div>




    </div><!-- /.page-wrapper -->


    <a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fa fa-angle-up"></i></a>


    <div class="side-menu__block">


        <div class="side-menu__block-overlay custom-cursor__overlay">
            <div class="cursor"></div>
            <div class="cursor-follower"></div>
        </div><!-- /.side-menu__block-overlay -->
        <div class="side-menu__block-inner ">
            <div class="side-menu__top justify-content-end">

                <a href="#" class="side-menu__toggler side-menu__close-btn"><img
                        src="assets/images/shapes/close-1-1.png" alt=""></a>
            </div><!-- /.side-menu__top -->


            <nav class="mobile-nav__container">
                <!-- content is loading via js -->
            </nav>
            <div class="side-menu__sep"></div><!-- /.side-menu__sep -->
            <div class="side-menu__content">
                <p><a href="mailto:info@farmicom.com">info@farmicom.com</a> <br> <a href="tel:254-712-3456">+254 712 345
                        678</a></p>
                <div class="side-menu__social">
                    <a href="#"><i class="fab fa-facebook-square"></i></a>
                    <a href="#"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
  <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
</svg></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                </div>
            </div>
        </div><!-- /.side-menu__block-inner -->
    </div><!-- /.side-menu__block -->



    <div class="search-popup">
        <div class="search-popup__overlay custom-cursor__overlay">
            <div class="cursor"></div>
            <div class="cursor-follower"></div>
        </div><!-- /.search-popup__overlay -->
        <div class="search-popup__inner">
             <form action="search.php" class="search-popup__form" method="post">
                <input type="text" name="search" placeholder="Type here to Search....">
                <button name= "btnt" type="submit"><i class="fa fa-search"></i></button>
            </form>
            
        </div>
    </div>


    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/TweenMax.min.js"></script>
    <script src="assets/js/wow.js"></script>
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="assets/js/swiper.min.js"></script>
    <script src="assets/js/typed-2.0.11.js"></script>
    <script src="assets/js/vegas.min.js"></script>
    <script src="assets/js/jquery.validate.min.js"></script>
    <script src="assets/js/bootstrap-select.min.js"></script>
    <script src="assets/js/countdown.min.js"></script>
    <script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="assets/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/js/nouislider.min.js"></script>
    <script src="assets/js/isotope.js"></script>
    <script src="assets/js/appear.js"></script>
    <script src="assets/js/jquery-ui.js"></script>
    <script src="assets/js/jquery.bootstrap-touchspin.js"></script>

    <script src="https://www.paypal.com/sdk/js?client-id=AVrpS-IfYQtzj0s949Kf_aYmbVJ_UcF7E6lhKpCQkHFGvX2VkpTYC_vIW4j1HUz6D0hbBaOvAYAc4D9p&currency=USD"></script>
    <!-- template scripts -->
    <script src="assets/js/theme.js"></script>
</body>

</html>
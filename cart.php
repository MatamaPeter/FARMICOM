<?php

include 'config.php';

session_start();

if (isset($_SESSION['mail'])) {
    $username = $_SESSION['mail'];
    $stmt = $con->prepare("SELECT * FROM cart WHERE Username = ?") or die("Query failed");
    $stmt->bind_param("s", $_SESSION['mail']);
    $stmt->execute();
    $cart_sum = $stmt->get_result();
    $Cart_number = $cart_sum->num_rows;
}else{
    $Cart_number = 0;
    $username = "guest";
}

if (isset($_POST['update'])) {
    if (isset($_SESSION['mail'])) {
        $username = $_SESSION['mail'];
      
        foreach ($_POST['cart_id'] as $key => $cartId) {
            $quantity = $_POST['quantity'][$cartId];
            $update_query = mysqli_query($con, "UPDATE cart SET quantity = '$quantity' WHERE id = '$cartId' AND username = '$username'");
        }
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
}
// Check if the delete button is clicked
if (isset($_POST['delete'])) {
    if (isset($_SESSION['mail'])) {
        $username = $_SESSION['mail'];
        
        // Retrieve cart ID of the item to be deleted
        $cartId = $_POST['delete'];

        // Construct and execute DELETE SQL query
        $delete_query = mysqli_query($con, "DELETE FROM cart WHERE id = '$cartId' AND username = '$username'");
        
        // Redirect to the same page after deletion
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
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
                                <li class="dropdown  current">
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
                                    if(isset($_SESSION['mail'])){
                                        echo"<div class='usern'>{$_SESSION['mail']}</div>
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
                    </div>
                </nav>
            </header>
        </div>
        </div>
        <section class="page-header" style="background-image: url(assets/images/backgrounds/page-header-contact.jpg);">
            <div class="container">
                <h2>Cart</h2>
                <ul class="thm-breadcrumb list-unstyled">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="" class="shop_style">Shop</a></li>
                    <li><span>Cart</span></li>
                </ul>
            </div>
        </section>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">        <section class="cart">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="cart_table_box">
                        <table class="cart_table">
    <thead class="cart_table_head">
        <?php
    if (isset($_SESSION['mail'])) {
        $username = $_SESSION['mail'];
        $select_cart = mysqli_query($con, "SELECT * FROM cart WHERE username = '$username'");
        if($select_cart->num_rows!==0){
            ?>
            <tr>
                <th>Item</th>
                <th></th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Remove</th>
            </tr>
    <?php 
        }
    } else {
        echo "";
    }
    ?>
    
   
                    </thead>
                    <tbody><?php
if (isset($_SESSION['mail'])) {
    $username = $_SESSION['mail'];
    $select_cart = mysqli_query($con, "SELECT * FROM cart WHERE username = '$username'");
    $subtotal = 0; // Initialize $subtotal to 0
    if ($select_cart->num_rows !== 0) {
        while ($cart_items = mysqli_fetch_assoc($select_cart)) {
            if (isset($cart_items['quantity']) && isset($cart_items['price'])) {
                $item_subtotal = $cart_items['price'] * $cart_items['quantity'];
                $subtotal += $item_subtotal; // Add the item subtotal to the overall subtotal
?>
                <tr>
                    <td colspan="2">
                        <div class="colum_box">
                            <div class="prod_thum">
                                <img width="150px" height="relative" src="Dashboard/Admin/<?php echo $cart_items['image']; ?>" alt=""></a>
                            </div>
                            <div class="title">
                                <h3 class="prod-title"><?php echo $cart_items['name']; ?></h3>
                            </div>
                        </div>
                    </td>
                    <td class="pro_price">KES <?php echo $cart_items['price']; ?></td>
                    <td class="pro_qty">
                        <div class="product-quantity-box">
                            <div class="input-box">
                                <input type="hidden" name="cart_id[]" value="<?php echo $cart_items['id']; ?>">
                                <input class="quantity-spinner" type="text" value="<?php echo $cart_items['quantity']; ?>" name="quantity[<?php echo $cart_items['id']; ?>]">
                            </div>
                        </div>
                    </td>
                    <td class="pro_sub_total">KES <?php echo $item_subtotal; ?></td>
                    <td>
                        <div class="pro_remove">
                            <button class="btn_delete" type="submit" name="delete" value="<?php echo $cart_items['id']; ?>"><i class="fas fa-times"></i></button>
                        </div>
                    </td>
                </tr>
<?php
            }
        }
    } else {
        echo "<centre><h1>Cart is empty</h1></centre>";
    }
} else {
    echo "Cart is empty";
}
?>
</table>
</div>
</div>
</div>
<div class="row cart_apply_coupon_box">
<div class="row">
<div class="col-xl-12">
<div class="button_box">
<?php
$select_cart = mysqli_query($con, "SELECT * FROM cart WHERE username = '$username'");
if ($select_cart->num_rows !== 0) {
?>
<button class="thm-btn update_btn" type="submit" name="update">Update</button>
<button onclick="redirectToCheckout()" class="thm-btn checkout_btn" type="button" name="checkout">Checkout</button>

<script>
    // JavaScript function to redirect to checkout.php
    function redirectToCheckout() {
        // Redirect to the checkout.php page
        window.location.href = "checkout.php";
    }
</script>
</div>
</div>
</div>
<div class="col-xl-6">
<ul class="total_box list-unstyled">
<li><span>Subtotal</span> <?php echo "KES " . $subtotal; ?></li>
<li><span>Shipping Cost</span> <?php
                                if ($subtotal >= 5000) {
                                    $Shipping_cost = 0;
                                } else {
                                    $Shipping_cost = round(0.45 * $subtotal, 0);
                                }
                                echo "KES " . $Shipping_cost;
                                ?></li>
<li><span>Total</span><?php echo "KES " . ($gtotal = $subtotal + $Shipping_cost); ?> </li>
<?php
} else {
    echo "";
}
?>
                        </ul>
                    </div>
                </div>
                
            </div>
        </section>
        </form>
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
                <p><a href="mailto:needhelp@tripo.com">needhelp@tripo.com</a> <br> <a href="tel:888-999-0000">888 999
                        0000</a></p>
                <div class="side-menu__social">
                    <a href="#"><i class="fab fa-facebook-square"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                </div>
            </div><!-- /.side-menu__content -->
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


    <!-- template scripts -->
    <script src="assets/js/theme.js"></script>
</body>

</html>
<?php 
session_start();
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['send_message'])){

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $subject = mysqli_real_escape_string($con, $_POST['subject']);
    $message = mysqli_real_escape_string($con, $_POST['message']);
    
    
        mysqli_query($con, "INSERT INTO messages(Name, Email, Phone, Subject, Message) VALUES ('$name','$email','$phone','$subject','$message')") or die ("Query failed");
        echo "<script>alert('Message Sent, we will reply soon');</script>";
    }else{
        echo "<script>alert('Message Failed');</script>";
    }
}
    

if (isset($_SESSION['mail'])) {
    $stmt = $con->prepare("SELECT * FROM cart WHERE Username = ?") or die("Query failed");
    $stmt->bind_param("s", $_SESSION['mail']);
    $stmt->execute();
    $cart_sum = $stmt->get_result();
    $Cart_number = $cart_sum->num_rows;
}else{$Cart_number=0;}



    
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact || Farmicom</title>
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
                                <li>
                                    <a href="index.php">Home</a>
                                  
                                </li>
                                <li class="dropdown">
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
                                
                                <li class="current">
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
                </nav>
            </header>
        </div>


        <section class="page-header" style="background-image: url(assets/images/backgrounds/page-header-contact.jpg);">
            <div class="container">
                <h2>Contact</h2>
                <ul class="thm-breadcrumb list-unstyled">
                    <li><a href="index.php">Home</a></li>
                    <li><span>Contact</span></li>
                </ul>
            </div>
        </section>

        <section class="location">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="location_single">
                            <h2>Peter M.</h2>
                            <p>365-00100, Nairobi</p>
                            <a href="info@farmicom.com">info@farmicom.com</a><br>
                            <a href="tel:+254 123 456 789">+254 123 456 789</a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="location_single">
                            <h2>Peter M.</h2>
                            <p>365-00100, Nairobi</p>
                            <a href="info@farmicom.com">info@farmicom.com</a><br>
                            <a href="tel:+254 123 456 789">+254 123 456 789</a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="location_single">
                            <h2>Peter M.</h2>
                            <p>365-00100, Nairobi</p>
                            <a href="mailto:info@farmicom.com">info@farmicom.com</a><br>
                            <a href="tel:+254 123 456 789">+254 123 456 789</a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="location_single">
                            <h2>Peter M.</h2>
                            <p>365-00100, Nairobi</p>
                            <a href="info@farmicom.com">info@farmicom.com</a><br>
                            <a href="tel:+254 123 456 789">+254 123 456 789</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="contact-one">
            <div class="container">
                <div class="row">
                    <div class="col-xl-7">
                        <div class="contact-one__form__wrap">
                            <div class="block-title text-left">
                                <p>contact with us</p>
                                <h3>write us a message</h3>
                                <div class="leaf">
                                    <img src="assets/images/resources/leaf.png" alt="">
                                </div>
                            </div>
                            <form action="" class="contact-one__form" method="post">
                                <div class="row low-gutters">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="text" name="name" placeholder="Your Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="text" name="email" placeholder="Email Address">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="text" name="phone" placeholder="Phone Number">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="text" name="subject" placeholder="Subject">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <textarea name="message" placeholder="Write Message"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-group contact__btn">
                                            <button type="submit" name="send_message" class="thm-btn contact-one__btn">Send message</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-5">
                        <div class="have_questions">
                            <div class="image_box">
                                <img src="assets/images/resources/contact_img.jpg" alt="">
                            </div>
                            <div class="block-title text-center">
                                <p>get in touch with us</p>
                                <h3>Have question?</h3>
                                <div class="leaf">
                                    <img src="assets/images/resources/leaf.png" alt="">
                                </div>
                            </div>
                            <div class="have_questions_text">
                                <p>Connect with us effortlessly, getting in touch with us is simple and quick. Reach out through our contact form, email, or social media – we value your input and look forward to hearing from you</p>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="contact_google_map_1">
            <iframe
                src="https://www.google.com/maps/d/embed?mid=1SuwNJ-HqTWSF2Bmaur7HqmVqZBk&hl=en&ehbc=2E312F"
                class="google-map__contact1" allowfullscreen></iframe>
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
                    <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
                        <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
                      </svg></i></a>
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

    <!-- template scripts -->
    <script src="assets/js/theme.js"></script>
</body>

</html>
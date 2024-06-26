<?php 
session_start();
include("config.php");

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
    <title>About ||Farmicom </title>
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
    <link rel="stylesheet" href="assets/css/jquery.bxslider.css">
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
                                
                                                         
                                <li class="dropdown current">
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
                </nav>
            </header>
        </div>


        <section class="page-header" style="background-image: url(assets/images/backgrounds/page-header-contact.jpg);">
            <div class="container">
                <h2>About</h2>
                <ul class="thm-breadcrumb list-unstyled">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="" class="shop_style">Pages</a></li>
                    <li><span>About</span></li>
                </ul>
            </div>
        </section>

        <section class="about_two">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="block-title text-left">
                            <p>About Farmicom</p>
                            <h3>We’re Providing The Best Solution</h3>
                            <div class="leaf">
                                <img src="assets/images/resources/leaf.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="about_two_text">
                            <p>At Farmicom, we cultivate a digital space where agriculture meets convenience. 
                                Our e-commerce platform is dedicated to connecting farmers, suppliers, and enthusiasts,
                                 bringing the bounty of the farm to your fingertips.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-5 col-lg-5">
                        <div class="about_two_left">
                            <img src="assets/images/about/about_page_left-img.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5">
                        <div class="about_two_middle">
                            <img src="assets/images/about/about_page_middle-img.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2">
                        <div class="about_two-right">
                            <img src="assets/images/about/about_page_right-img.jpg" alt="">
                            <div class="about_two_content">
                                <h2>We’ve 40 Years Agriculture Experience</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bx-testimonial bx-testimonial2 about_bx-testimonial2">
            <div class="bx-testimonial_bg" style="background-image: url(assets/images/testimonials/bx-testi-bg.png)">
            </div>
            <div class="container">
                <div class="block-title text-center">
                    <p>testimonails</p>
                    <h3>What people say</h3>
                    <div class="leaf">
                        <img src="assets/images/resources/leaf.png" alt="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="bx_testimonial_slider">

                            <div class="slider-pager">
                                <ul class="thumb-box list-unstyled text-center">
                                    <li>
                                        <a class="active" data-slide-index="0" href="#">
                                            <div class="img-holder">
                                                <img src="assets/images/testimonials/bx-testi-1.png" alt="">
                                                <div class="quote_testimonial">
                                                    <img src="assets/images/icon/quote_1.png" alt="">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a data-slide-index="1" href="#">
                                            <div class="img-holder">
                                                <img src="assets/images/testimonials/bx-testi-2.png" alt="">
                                                <div class="quote_testimonial">
                                                    <img src="assets/images/icon/quote_1.png" alt="">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a data-slide-index="2" href="#">
                                            <div class="img-holder">
                                                <img src="assets/images/testimonials/bx-testi-3.png" alt="">
                                                <div class="quote_testimonial">
                                                    <img src="assets/images/icon/quote_1.png" alt="">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <ul class="slider-content clearfix bxslider list-unstyled text-center">
                                <li>
                                    <div class="bx_testimonial_single clearfix">
                                        <div class="bx_testimonial_text">
                                            <p>This is due to their excellent service, competitive pricing and customer
                                                support. It’s throughly refresing to get such a personal touch.</p>
                                            <h3>Kelvin O.</h3>
                                            <h6>Customer</h6>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="bx_testimonial_single clearfix">
                                        <div class="bx_testimonial_text">
                                            <p>This is due to their excellent service, competitive pricing and customer
                                                support. It’s throughly refresing to get such a personal touch.</p>
                                            <h3>Christine R.</h3>
                                            <h6>Customer</h6>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="bx_testimonial_single clearfix">
                                        <div class="bx_testimonial_text">
                                            <p>This is due to their excellent service, competitive pricing and customer
                                                support. It’s throughly refresing to get such a personal touch.</p>
                                            <h3>Musa T.</h3>
                                            <h6>Customer</h6>
                                        </div>
                                    </div>
                                </li>
                            </ul>


                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="brand-one">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="brand-one-carousel owl-carousel">
                            <div class="single_brand_item">
                                <a href="#"><img src="assets/images/resources/brand-1-1.png" alt="brand"></a>
                            </div>
                            <div class="single_brand_item">
                                <a href="#"><img src="assets/images/resources/brand-1-2.png" alt="brand"></a>
                            </div>
                            <div class="single_brand_item">
                                <a href="#"><img src="assets/images/resources/brand-1-3.png" alt="brand"></a>
                            </div>
                            <div class="single_brand_item">
                                <a href="#"><img src="assets/images/resources/brand-1-4.png" alt="brand"></a>
                            </div>
                            <div class="single_brand_item">
                                <a href="#"><img src="assets/images/resources/brand-1-5.png" alt="brand"></a>
                            </div>
                            <div class="single_brand_item">
                                <a href="#"><img src="assets/images/resources/brand-1-1.png" alt="brand"></a>
                            </div>
                            <div class="single_brand_item">
                                <a href="#"><img src="assets/images/resources/brand-1-2.png" alt="brand"></a>
                            </div>
                            <div class="single_brand_item">
                                <a href="#"><img src="assets/images/resources/brand-1-3.png" alt="brand"></a>
                            </div>
                            <div class="single_brand_item">
                                <a href="#"><img src="assets/images/resources/brand-1-4.png" alt="brand"></a>
                            </div>
                            <div class="single_brand_item">
                                <a href="#"><img src="assets/images/resources/brand-1-5.png" alt="brand"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="video-one" style="background-image:url(assets/images/resources/video-bg-1.jpg);">
            <div class="container text-center">
                <a href="https://www.youtube.com/watch?v=i9E_Blai8vk" class="video-one__btn video-popup"><i
                        class="fa fa-play"></i></a>
                <p>Modern agriculture types</p>
                <h3>Agriculture matters to the<br>future of development</h3>
            </div>
        </section>

        <section class="product-one">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        <div class="product_img">
                            <img src="assets/images/resources/product-1-img-1.jpg" alt="Product One Img">
                            <div class="experience_box">
                                <h2>40 Year</h2>
                                <p>Of Experience</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="growing_product">
                            <div class="block-title text-left">
                                <p>fresh products</p>
                                <h3>Growing products</h3>
                                <div class="leaf">
                                    <img src="assets/images/resources/leaf.png" alt="">
                                </div>
                            </div>
                            <div class="growing_product_text">
                                <p>Explore the essence of freshness with Farmicom's bountiful selection of farm-to-table delights.
                                    From vibrant, freshly harvested produce to cutting-edge solutions for growing success, 
                                    we cultivate a marketplace that celebrates the best in both fresh and growing products. 
                                    Elevate your culinary and agricultural experience with Farmicom..</p>
                            </div>
                            <div class="progress-levels">
                                <!--Skill Box-->
                                <div class="progress-box">
                                    <div class="inner count-box">
                                        <div class="text">Agriculture</div>
                                        <div class="bar">
                                            <div class="bar-innner">
                                                <div class="skill-percent">
                                                    <span class="count-text" data-speed="3000" data-stop="68">0</span>
                                                    <span class="percent">%</span>
                                                </div>
                                                <div class="bar-fill" data-percent="68"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Skill Box-->
                                <div class="progress-box">
                                    <div class="inner count-box">
                                        <div class="text">Organic</div>
                                        <div class="bar">
                                            <div class="bar-innner">
                                                <div class="skill-percent">
                                                    <span class="count-text" data-speed="3000" data-stop="98">0</span>
                                                    <span class="percent">%</span>
                                                </div>
                                                <div class="bar-fill" data-percent="98"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="team_one about_team_one">
            <div class="container">
                <div class="block-title text-center">
                    <p>our team members</p>
                    <h3>meet the farmers</h3>
                    <div class="leaf">
                        <img src="assets/images/resources/leaf.png" alt="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="team_one_single wow fadeInUp">
                            <div class="team_one_image">
                                <img src="assets/images/team/team_1-img-1.jpg" alt="">
                            </div>
                            <div class="team_one_deatils">
                                <p>farmer</p>
                                <h2><a href="#">David J.</a></h2>
                                <div class="team_one_social">
                                    <a href="#"><i class="fab fa-facebook-square"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="team_one_single wow fadeInDown">
                            <div class="team_one_image">
                                <img src="assets/images/team/team_1-img-2.jpg" alt="">
                            </div>
                            <div class="team_one_deatils">
                                <p>farmer</p>
                                <h2><a href="#">Travis Brown</a></h2>
                                <div class="team_one_social">
                                    <a href="#"><i class="fab fa-facebook-square"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="team_one_single wow fadeInUp">
                            <div class="team_one_image">
                                <img src="assets/images/team/team_1-img-3.jpg" alt="">
                            </div>
                            <div class="team_one_deatils">
                                <p>farmer</p>
                                <h2><a href="#">Kevin K.</a></h2>
                                <div class="team_one_social">
                                    <a href="#"><i class="fab fa-facebook-square"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="team_one_single wow fadeInDown">
                            <div class="team_one_image">
                                <img src="assets/images/team/team_1-img-4.jpg" alt="">
                            </div>
                            <div class="team_one_deatils">
                                <p>farmer</p>
                                <h2><a href="#">Albert O.</a></h2>
                                <div class="team_one_social">
                                    <a href="#"><i class="fab fa-facebook-square"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="cta-one" style="background-image: url(assets/images/resources/cta_one_bg-1.jpg)">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="cta_one_content">
                            <h1>Provide you the Highest Quality products<br>that Meets your Expectation</h1>
                            <p>Elevate your agricultural journey. Shop now for a prosperous harvest ahead!</p>
                            <div class="cta_one__button-block">
                                <a href="" class="thm-btn cta_one__btn">Discover More</a>
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
    <script src="assets/js/jquery.bxslider.min.js"></script>
    <script src="assets/js/appear.js"></script>

    <!-- template scripts -->
    <script src="assets/js/theme.js"></script>
</body>

</html>
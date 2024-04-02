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
                                <li class="dropdown current">
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

        <!-- Banner Section -->
        <section class="banner-section banner-one">

            <div class="banner-carousel owl-theme owl-carousel">
                <!-- Slide Item -->
                <div class="slide-item">
                    <div class="image-layer" style="background-image: url(assets/images/main-slider/slide_v1_1.jpg);">
                    </div>
                    <div class="auto-container">
                        <div class="content-box">
                            <div class="content">
                                <div class="inner">
                                    <div class="sub-title">The best Agriculture products</div>
                                    <h1>Welcome<br> to Farmicom </h1>
                                    <div class="link-box">
                                        <a href="product.php" class="thm-btn">Shop with us</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slide Item -->
                <div class="slide-item">
                    <div class="image-layer" style="background-image: url(assets/images/main-slider/slide_v1_2.jpg);">
                    </div>
                    <div class="auto-container">
                        <div class="content-box">
                            <div class="content">
                                <div class="inner">
                                    <div class="sub-title">The best Agriculture products</div>
                                    <h1>The best online<br> farming store</h1>
                                    <div class="link-box">
                                        <a href="product.php" class="thm-btn">Shop with us</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slide Item -->
                <div class="slide-item">
                    <div class="image-layer" style="background-image: url(assets/images/main-slider/slide_v1_3.jpg);">
                    </div>
                    <div class="auto-container">
                        <div class="content-box">
                            <div class="content">
                                <div class="inner">
                                    <div class="sub-title">The best Agriculture products</div>
                                    <h1>With quality<br> organic products</h1>
                                    <div class="link-box">
                                        <a href="product.php" class="thm-btn">Shop with us</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </section>
        <!--End Banner Section -->



        <section class="about_one">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        <div class="about1_img">
                            <div class="about1_shape_1"></div>
                            <img src="assets/images/about/about-1-img-1.jpg" alt="About-Img">
                            <div class="about1_icon-box">
                                <div class="circle">
                                    <span class="icon-focus"></span>
                                </div>
                            </div>
                            <div class="about_img_2">
                                <img src="assets/images/about/about-1-img-2.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="block-title text-left">
                            <p>About Farmicon</p>
                            <h3>A leading agriculture market</h3>
                            <div class="leaf">
                                <img src="assets/images/resources/leaf.png" alt="">
                            </div>
                        </div>
                        <div class="about_content">
                            <div class="text">
                                <p>At Farmicom, we cultivate a digital space where agriculture meets convenience. 
                                    Our e-commerce platform is dedicated to connecting farmers, suppliers, and enthusiasts,
                                     bringing the bounty of the farm to your fingertips.</p>
                            </div>
                            <div class="about1_icon_wrap">
                                <div class="about1_icon_single">
                                    <div class="about1_icon">
                                        <span class="icon-harvest"></span>
                                    </div>
                                    <p>Growing Fruits and Vegetables</p>
                                </div>
                                <div class="about1_icon_single">
                                    <div class="about1_icon">
                                        <span class="icon-temperature"></span>
                                    </div>
                                    <p>Tips for Ripening your Fruits</p>
                                </div>
                            </div>
                            <div class="bottom_text">
                                <p> Our digital marketplace is the heartbeat of a new era in agriculture, providing a cutting-edge 
                                    platform for farmers, agribusinesses, and enthusiasts alike..</p>
                            </div>
                            <div class="about1__button-block">
                                <a href="about.php" class="thm-btn about_one__btn">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="service_one">
            <div class="container">
                <div class="block-title text-center">
                    <p>What we do</p>
                    <h3>Our  Products</h3>
                    <div class="leaf">
                        <img src="assets/images/resources/leaf.png" alt="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="service_1_single wow fadeInUp">
                            <div class="content">
                                <h3>Organic<br>Products</h3>
                                <p>Embrace the organic lifestyle with us. Shop now and let nature's bounty enrich your life!</p>
                            </div>
                            <div class="service_1_img">
                                <img src="assets/images/service/service-1-img-1.jpg" alt="Service Image">
                                <div class="hover_box">
                                    <a href="product.php"><span class="icon-left-arrow"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="service_1_single wow fadeInUp" data-wow-delay="300ms">
                            <div class="content">
                                <h3>agricultural<br>products</h3>
                                <p>Elevate your agricultural journey. Shop now for a prosperous harvest ahead.</p>
                            </div>
                            <div class="service_1_img">
                                <img src="assets/images/service/service-1-img-2.jpg" alt="Service Image">
                                <div class="hover_box">
                                    <a href="product.php"><span class="icon-left-arrow"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="service_1_single wow fadeInUp" data-wow-delay="600ms">
                            <div class="content">
                                <h3>Fresh<br>vegetables</h3>
                                <p>Tantalize your meals with quality and freshness. Experience the difference. </p>
                            </div>
                            <div class="service_1_img">
                                <img src="assets/images/service/service-1-img-3.jpg" alt="Service Image">
                                <div class="hover_box">
                                    <a href="product.php"><span class="icon-left-arrow"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="service_1_single wow fadeInUp" data-wow-delay="900ms">
                            <div class="content">
                                <h3>Dairy<br>Products</h3>
                                <p>Indulge in Pure Dairy Delights!.Treat yourself to the best with the finest dairy products</p>
                            </div>
                            <div class="service_1_img">
                                <img src="assets/images/service/service-1-img-4.jpg" alt="Service Image">
                                <div class="hover_box">
                                    <a href="product.php"><span class="icon-left-arrow"></span></a>
                                </div>
                            </div>
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

        <section class="featured-one">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 wow slideInLeft" data-wow-delay="100ms">
                        <div class="single_featured_box">
                            <img src="assets/images/resources/featured-leaf.png" alt=""><span>We Sell Best Agriculture
                                Products</span><img src="assets/images/resources/featured-leaf.png" alt="">
                        </div>
                    </div>
                    <div class="col-xl-6 wow slideInRight" data-wow-delay="100ms">
                        <div class="single_featured_box">
                            <img src="assets/images/resources/featured-leaf.png" alt=""><span>We’ve 40 years experience
                                in field</span><img src="assets/images/resources/featured-leaf.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="video-one" style="background-image:url(assets/images/resources/video-bg-1.jpg);">
            <div class="container text-center">
                <a href="assets/images/resources/production_id_4219204 (1080p).mp4" class="video-one__btn video-popup"><i
                        class="fa fa-play"></i></a>
                <p>Modern agriculture types</p>
                <h3>Agriculture matters to the<br>future of development</h3>
            </div>
        </section>

        <section class="testimonials-one">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        <div class="testimonials_one_left">
                            <div class="block-title text-left">
                                <p>testimonails</p>
                                <h3>What our customers are<br>talking about</h3>
                                <div class="leaf">
                                    <img src="assets/images/resources/leaf.png" alt="">
                                </div>
                            </div>
                            <div class="testimonials_one_text">
                                <p>At Farmicom, we cultivate a digital space where agriculture 
                                    meets convenience. Our e-commerce platform is dedicated to 
                                    connecting farmers, suppliers, and enthusiasts, bringing 
                                    the bounty of the farm to your fingertips.</p>
                            </div>
                            <div class="project_counted wow fadeInUp" data-wow-delay="300ms">
                                <div class="icon_box">
                                    <span class="icon-farmer"></span>
                                </div>
                                <div class="project-content">
                                    <h3 class="counter">4,850</h3>
                                    <p>Farmers have joined Farmicom</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="testimonials_one_content">
                            <div class="testimonials_one_carousel owl-theme owl-carousel">
                                <div class="testimonials_one_single_item">
                                    <div class="text">
                                        <p>Farmicom revolutionized my farming! Seamless online experience, top-notch 
                                            products, and innovative solutions skyrocketed my farm's productivity. Beyond e-commerce, Farmicom is an empowering community.</p>
                                    </div>
                                    <div class="client_thumbnail">
                                        <div class="client_img">
                                            <img src="assets/images/testimonials/testimonial-1-img-1.png"
                                                alt="testimonial1-img">
                                        </div>
                                        <div class="client_title">
                                            <h4>Kevin</h4>
                                            <p>Happy Farmer</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="testimonials_one_single_item">
                                    <div class="text">
                                        <p>Farmicom exceeded my expectations for organic farming. The curated selection of products and sustainable solutions is impressive. It's more than shopping; it's a movement towards a greener, 
                                            healthier future. Farmicom has earned my trust.</p>
                                    </div>
                                    <div class="client_thumbnail">
                                        <div class="client_img">
                                            <img src="assets/images/testimonials/testimonial-1-img-3.png"
                                                alt="testimonial1-img">
                                        </div>
                                        <div class="client_title">
                                            <h4>Mark</h4>
                                            <p>Organic Enthusiast</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="testimonials_one_single_item">
                                    <div class="text">
                                        <p>Impressed with the quality of fresh vegetables from Farmicom. It's like having a farmer's market at my fingertips! Incredibly fresh produce, prompt delivery. Farmicom 
                                            is my trusted source for top-notch, farm-to-table goodness.</p>
                                    </div>
                                    <div class="client_thumbnail">
                                        <div class="client_img">
                                            <img src="assets/images/testimonials/testimonial-1-img-2.png"
                                                alt="testimonial1-img">
                                        </div>
                                        <div class="client_title">
                                            <h4>Emily</h4>
                                            <p>Satisfied Customer </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="recent-project">
            <div class="container">
                <div class="block-title text-center">
                    <p>Farmicom</p>
                    <h3>THE BEST ONLINE FARM</h3>
                    <div class="leaf">
                        <img src="assets/images/resources/leaf.png" alt="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-lg-4">
                        <div class="recent_project_single wow fadeInUp" data-wow-delay="300ms">
                            <div class="project_img_box">
                                <img src="assets/images/project/recent-pro-img-1.jpg" alt="Recent Project Img">
                                <div class="project_content">
                                    <h3>organic<br>solutions</h3>
                                </div>
                                <div class="hover_box">
                                    <a href="about.php"><span class="icon-left-arrow"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4">
                        <div class="recent_project_single wow fadeInUp" data-wow-delay="600ms">
                            <div class="project_img_box">
                                <img src="assets/images/project/recent-pro-img-2.jpg" alt="Recent Project Img">
                                <div class="project_content">
                                    <h3>Harvest<br>Innovations</h3>
                                </div>
                                <div class="hover_box">
                                    <a href="about.php"><span class="icon-left-arrow"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="900ms">
                        <div class="recent_project_single">
                            <div class="project_img_box">
                                <img src="assets/images/project/recent-pro-img-3.jpg" alt="Recent Project Img">
                                <div class="project_content">
                                    <h3>Agriculture<br>farming</h3>
                                </div>
                                <div class="hover_box">
                                    <a href="about.php"><span class="icon-left-arrow"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="benefits">
            <div class="benefits_bg" style="background-image: url(assets/images/resources/benifits_bg.png)"></div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="block-title text-left">
                            <p>Our benefits</p>
                            <h3>Agriculture & Eco<br>Farming</h3>
                            <div class="leaf">
                                <img src="assets/images/resources/leaf.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 d-flex">
                        <div class="my-auto">
                            <div class="benefits_text">
                                <p>Experience elevated farming with Farmicom – where seamless online shopping, 
                                   top-quality products, and innovative solutions converge to enhance productivity 
                                   and foster a supportive agricultural community. From exclusive deals to a thriving
                                    community, Farmicom is not just a platform; it's a holistic farming experience designed for success and collaboration.</p>
                            </div>
                        </div><!-- /.my-auto -->
                    </div>
                </div>
                <div class="benefits_bottom_part">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-6">
                            <div class="benefits_single wow fadeInUp" data-wow-delay="300ms">
                                <div class="icon-box">
                                    <span class="icon-tractor"></span>
                                </div>
                                <h3>We Use New technology</h3>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6">
                            <div class="benefits_single wow fadeInUp" data-wow-delay="600ms">
                                <div class="icon-box">
                                    <span class="icon-cart"></span>
                                </div>
                                <h3>professional farmers</h3>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6">
                            <div class="benefits_single wow fadeInUp" data-wow-delay="900ms">
                                <div class="icon-box">
                                    <span class="icon-watering-can"></span>
                                </div>
                                <h3>We’re certified company</h3>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6">
                            <div class="benefits_single wow fadeInUp" data-wow-delay="1200ms">
                                <div class="icon-box">
                                    <span class="icon-log"></span>
                                </div>
                                <h3>We deliver everywhere</h3>
                            </div>
                        </div>
                    </div>
                </div>
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
                                     Elevate your culinary and agricultural experience with Farmicom.</p>
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

        

        <section class="cta-one" style="background-image: url(assets/images/resources/cta_one_bg-1.jpg)">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="cta_one_content">
                            <h1>Provide you the Highest Quality products<br>that Meets your Expectation</h1>
                            <p>a holistic farming experience designed for success and collaboration.</p>
                            <div class="cta_one__button-block">
                                <a href="about.php" class="thm-btn cta_one__btn">Discover More</a>
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
        </div>
    </div>


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
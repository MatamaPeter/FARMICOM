<?php session_start(); 

include("config.php");
unset($_SESSION['search_results']);
if (isset($_POST['btnt'])) {
    $search_item = mysqli_real_escape_string($con, $_POST['search']);
    $select_item = mysqli_query($con, "SELECT * FROM products WHERE Product_name LIKE '%{$search_item}%'") or die("Query failed");

    if ($select_item->num_rows > 0) {
        $search_results = array();

        while ($row = $select_item->fetch_assoc()) {
            $search_results[] = array(
                'product_img' => $row['Product_img'],
                'Product_name' => $row['Product_name'],
                'Price' => $row['Price']
            );
        }
        $_SESSION['search_results'] = $search_results;
        
    } 
}
     
?>
<!DOCTYPE html>
<html lang="en">


    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title> Shop || Farmicom</title>
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
                                    <li >
                                        <a href="index.html">Home</a>
                                      
                                    </li>
                                    <li class="dropdown current">
                                        <a href="product.html">Shop</a>
                                        <ul>
                                            
                                            <li><a href="cart.html">Cart</a></li>
                                            <li><a href="checkout.html">Checkout</a></li>
                                        </ul><!-- /.sub-menu -->
                                    </li>
                                    
                                                             
                                    <li class="dropdown">
                                        <a href="about.html">About Us</a>
                                        <ul>
                                            <li><a href="why_choose_us.html">Why Choose Us</a></li>
                                            
                                        </ul><!-- /.sub-menu -->
                                    </li>
                                    
                                    <li>
                                        <a href="contact.html">Contacts</a>
                                    </li>
                                    <li>
                                        <a href="farmers.html">Farmers</a>
                                    </li>

                                </ul>
                            
                            </div><!-- /.navbar-collapse -->
    
                            <div class="main-nav__right">
                                <div class="icon_cart_box">
                                    <?php
                                    if(isset($_SESSION['username'])){
                                        echo"<div class='usern'>{$_SESSION['email']}</div>
                                         <center><a href='logout.php'><button class='logout-button'>Logout</button></a></center>";
                                    }else{
                                        echo"<center><a href='lform.php'><button class='logout-button'>Login</button></a></center>";
                                    }
                                    ?>
                                </div>
                                <div class="icon_cart_box">
                                  <a href="cart.html">
                                    <sup>2</sup><span class="icon-shopping-cart"></span>
                                  </a>
                                </div>
                                
                              </div>
                        </div>
                    </nav>
                </header>
            </div>
        <section class="product">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="sidebar-wrapper style2">
                            <!--Start single sidebar-->
                            <div class="single-sidebar wow fadeInUp animated" data-wow-delay="0.1s"
                                data-wow-duration="1200ms">
                                <div class="sidebar-search-box">
                                    <form class="search-form" action="#">
                                        <input placeholder="Search" type="text">
                                        <button type="submit"><i class="icon-magnifying-glass"
                                                aria-hidden="true"></i></button>
                                    </form>
                                </div>
                            </div>
                            <!--End single sidebar-->
                            
                            <!--Start sidebar categories Box-->
                            <div class="single-sidebar wow fadeInUp animated" data-wow-delay="0.3s"
                                data-wow-duration="1200ms">
                                <div class="categories-box">
                                    <div class="title">
                                        <h3>Categories</h3>
                                    </div>
                                    <ul class="categories clearfix">
                                        <li><a href="#">Vegetables</a></li>
                                        <li><a href="#">Fruit Basket</a></li>
                                        <li><a href="#">Dairy Products</a></li>
                                        <li><a href="#">Tomatoes</a></li>
                                        <li><a href="#">Oranges</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!--End sidebar categories Box-->
                            <!--Start single sidebar-->
                            <div class="single-sidebar wow fadeInUp animated" data-wow-delay="0.5s"
                                data-wow-duration="1200ms">
                                <div class="top_sellers">
                                    <div class="title">
                                        <h3>Latest Products</h3>
                                    </div>
                                    <ul class="top-products">
                                        <li>
                                            <div class="product_item">
                                                <div class="img-box">
                                                    <img src="assets/images/shop/top-product-1.jpg" alt="Awesome Image">
                                                    <div class="overlay-content">
                                                        <a href="#"><i class="fa fa-link" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                                <div class="title-box">
                                                    <h4><a href="#">Wheat Bag</a></h4>
                                                    <div class="value"> KES 999.00</div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="product_item">
                                                <div class="img-box">
                                                    <img src="assets/images/shop/top-product-2.jpg" alt="Awesome Image">
                                                    <div class="overlay-content">
                                                        <a href="#"><i class="fa fa-link" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                                <div class="title-box">
                                                    <h4><a href="#">Pinepale</a></h4>
                                                    <div class="value">KES 85.00</div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--End single sidebar-->

                        </div>
                    </div>
                    <!--End Sidebar Wrapper-->
                    <div class="col-xl-9 col-lg-9">
                        <div class="product-items">
                           
                        
                        <div class="all_products">
                                <div class="row">
                                    
                                
                                <?php if (isset($_SESSION['search_results'])): 
            foreach ($_SESSION['search_results'] as $result):
            ?>
        
        <div class="col-xl-4 col-lg-4 col-md-6">
            <div class="all_products_single text-center">
                <div class="all_product_item_image">
                   <img src="<?php echo $result['product_img']; ?>" alt="">
                    <div class="all_product_hover">
                        <div class="all_product_icon">
                            <a href="cart.html"><span class="icon-shopping-cart"></span></a>
                        </div>
                    </div>
                </div>
                <h4><?php echo $result['Product_name'];?></h4>
                <p><?php echo $result['Price'];?></p>
                <?php endforeach; ?>
                <?php else: ?>
                 <p>No results found</p>
                <?php endif; ?>
                
            </div>
        </div>
        <?php
    
 
?>

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
                            <form>
                                <div class="footer_input-box">
                                    <input type="Email" placeholder="Email Address">
                                    <button type="submit" class="button"><i class="fa fa-check"></i></button>
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
                                <li><a href="about.html">About Us</a></li>
                                <li><a href="product.html">Shop with us</a></li>
                                <li><a href="farmers.html">Meet the Farmers</a></li>
                                <li><a href="contact.html">Contact</a></li>
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

 
            <form action="" class="search-popup__form" method="post">
                <input type="text" name="search" placeholder="Type here to Search....">
                <button type="submit" name="btnt"><i class="fa fa-search"></i></button>
            </form>
    
        </div><!-- /.search-popup__inner -->
    </div><!-- /.search-popup -->


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

    <!-- template scripts -->
    <script src="assets/js/theme.js"></script>
</body>

</html>
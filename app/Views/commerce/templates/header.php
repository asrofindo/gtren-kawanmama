
    <header class="header-area header-style-3 header-height-2 mb-30">
        <div class="header-top header-top-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info">
                            <ul>
                                <li><a href="#">(+01) - 2345 - 6789</a></li>
                                <li class="w-100"><i class="fa fa-map-marker-alt mr-5"></i><a id="location" target="_blank" href="page-location.html">Lokasi Toko Kami</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-4">
                        <!-- <div class="text-center">
                            <div id="news-flash" class="d-inline-block">
                                <ul>
                                    <li><i class="fa fa-angle-double-right mr-5"></i> Get great devices up to 50% off <a class="active" href="shop-grid-right.html">View details</a></li>
                                    <li><i class="fa fa-asterisk mr-5"></i><b>Supper Value Deals</b> - Save more with coupons</li>
                                    <li><i class="fa fa-bell mr-5"></i> <b> Trendy 25</b> silver jewelry, save up 35% off today <a href="shop-grid-right.html">Shop now</a></li>
                                </ul>
                            </div>
                        </div> -->
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info header-info-right">
                            <ul>
                                <!-- <li>
                                    <a class="language-dropdown-active" href="#"> <i class="fa fa-globe-americas"></i> English <i class="fa fa-chevron-down"></i></a>
                                    <ul class="language-dropdown">
                                        <li><a href="#">Français</a></li>
                                        <li><a href="#">Deutsch</a></li>
                                        <li><a href="#">РУССКИЙ</a></li>
                                    </ul>
                                </li> -->
                                <li><a href="page-account.html"><i class="far fa-truck-moving"></i> Cek Pesananmu</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle header-middle-ptb-1 d-none d-md-block ">
            <div class="container">
                <div class="header-wrap header-space-between">
                    <div class="logo logo-width-1">
                        <a href="<?= base_url() ?>"><img class="w-25" src="<?= base_url() ?>/frontend/imgs/theme/gtren.png" alt="logo"></a>
                    </div>
                    <div class="search-style-1 w-100">
                        <form action="<?= base_url() ?>/products/search" method="get" class="w-100">
                            <input type="text" placeholder="Cari Produk" name="search" class="rounded-3">
                            <button type="submit"> <i class="far fa-search"></i> </button>
                        </form>
                    </div>
                    <div class="header-action-right">
                        <div class="header-action-2">
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="/cart">
                                    <img alt="wowy" src="<?= base_url() ?>/frontend/imgs/theme/icons/icon-cart.svg">
                                    <!-- <span class="pro-count blue">2</span> -->
                                </a>
                                <!-- <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    <ul>
                                        <li>
                                            <div class="shopping-cart-img">
                                                <a href="shop-product-right.html"><img alt="wowy" src="<?= base_url() ?>/frontend/imgs/shop/thumbnail-3.jpg"></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="shop-product-right.html">Apple Watch Serial 7</a></h4>
                                                <h3><span>1 × </span>$800.00</h3>
                                            </div>
                                            <div class="shopping-cart-delete">
                                                <a href="#"><i class="far fa-times"></i></a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="shopping-cart-img">
                                                <a href="shop-product-right.html"><img alt="wowy" src="<?= base_url() ?>/frontend/imgs/shop/thumbnail-1.jpg"></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="shop-product-right.html">Macbook Pro 2022</a></h4>
                                                <h3><span>1 × </span>$3200.00</h3>
                                            </div>
                                            <div class="shopping-cart-delete">
                                                <a href="#"><i class="far fa-times"></i></a>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <h4>Total <span>$4000.00</span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="shop-cart.html">View cart</a>
                                            <a href="shop-checkout.html">Checkout</a>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                            <div class="header-action-icon-2">
                                <?php if(!logged_in()): ?>
                                    <a href="<?= route_to('login') ?>">
                                        <button class="btn btn-primary btn-sm">Login</button>
                                    </a>
                                <?php else: ?>
                                <a href="/account">
                                    <img alt="wowy" src="<?= base_url() ?>/frontend/imgs/theme/icons/icon-user.svg">
                                </a>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom header-bottom-bg-color sticky-bar gray-bg sticky-blue-bg">
            <div class="container">
                <div class="header-wrap header-space-between position-relative main-nav">
                    <div class="logo logo-width-1 d-block d-md-none">
                        <a href="<?= base_url()?>" class="w-25"><img src="<?= base_url()?>/frontend/imgs/theme/gtren-t.png" alt="logo"></a>
                    </div>
                    <div class="main-categori-wrap d-none d-md-block">
                        <a class="categori-button-active" href="#">
                            <span class="fa fa-list"></span> Browse Categories <i class="down far fa-chevron-down"></i> <i class="up far fa-chevron-up"></i>
                        </a>
                        <div class="categori-dropdown-wrap categori-dropdown-active-large" style="z-index:1000;">
                            <ul>
                                <?php foreach ($category as $data) {?>
                                    <li><a href="<?= base_url() ?>/category/product/<?= $data->id?>"><?= $data->category ?></a></li>
                                <?php }?>
                            </ul>
                        </div>
                    </div>
                    <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block main-menu hover-boder hover-boder-white" style="width:65%">
                        <nav>
                            <ul>
                                <li>
                                    <a class="active" href="<?= base_url() ?>">Home</a>
                                </li>
                                <li>
                                    <a href="<?= base_url()?>/about">About</a>
                                </li>
                                <li>
                                    <a href="<?= base_url()?>/contact">Contact</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
  
                    <div class="header-action-right d-block d-md-none">
                        <div class="header-action-2">
                            <div class="header-action-icon-2">
                                <a href="shop-wishlist.html">
                                    <img alt="wowy" src="<?= base_url() ?>/frontend/imgs/theme/icons/icon-heart-white.svg">
                                    <span class="pro-count white">4</span>
                                </a>
                            </div>
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="shop-cart.html">
                                    <img alt="wowy" src="<?= base_url() ?>/frontend/imgs/theme/icons/icon-cart-white.svg">
                                    <!-- <span class="pro-count white">02</span> -->
                                </a>
                                <!-- <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    <ul>
                                        <li>
                                            <div class="shopping-cart-img">
                                                <a href="shop-product-right.html"><img alt="wowy" src="<?= base_url() ?>/frontend/imgs/shop/thumbnail-3.jpg"></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="shop-product-right.html">Apple Watch Serial 7</a></h4>
                                                <h3><span>1 × </span>$800.00</h3>
                                            </div>
                                            <div class="shopping-cart-delete">
                                                <a href="#"><i class="far fa-times"></i></a>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <h4>Total <span>$383.00</span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="shop-cart.html">View cart</a>
                                            <a href="shop-checkout.html">Checkout</a>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                            <div class="header-action-icon-2">
                                <a href="page-login-register.html">
                                    <img alt="wowy" src="<?= base_url() ?>/frontend/imgs/theme/icons/icon-user-white.svg">
                                </a>
                            </div>
                            <div class="header-action-icon-2 d-block d-lg-none">
                                <div class="burger-icon burger-icon-white">
                                    <span class="burger-icon-top"></span>
                                    <span class="burger-icon-mid"></span>
                                    <span class="burger-icon-bottom"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="mobile-header-active mobile-header-wrapper-style">
        <div class="mobile-header-wrapper-inner">
                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            <div class="mobile-header-content-area">
                <div class="mobile-search search-style-3 mobile-header-border">
                    <form action="<?= base_url() ?>/products/search" method="get">
                        <input type="text" placeholder="Search…" name="search">
                        <button type="submit"> <i class="far fa-search"></i> </button>
                    </form>
                </div>
                <div class="mobile-menu-wrap mobile-header-border">
                    <div class="main-categori-wrap mobile-header-border">
                        <a class="categori-button-active-2" href="#">
                            <span class="far fa-bars"></span> Browse Categories <i class="down far fa-chevron-down"></i>
                        </a>
                        <div class="categori-dropdown-wrap categori-dropdown-active-small">
                            <ul>
                            <?php foreach ($category as $data) {?>
                                <li><a href=""><?= $data->category ?></a></li>
                            <?php }?>
                            </ul>
                        </div>
                    </div>
                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu">
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="<?= base_url()?>/about">About</a></li>
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="<?= base_url()?>/contact">Contact</a></li>
                        </ul>
                    </nav>
                    <!-- mobile menu end -->
                </div>
                <div class="mobile-social-icon">
                    <a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="twitter" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="tumblr" href="#"><i class="fab fa-tumblr"></i></a>
                    <a class="instagram" href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
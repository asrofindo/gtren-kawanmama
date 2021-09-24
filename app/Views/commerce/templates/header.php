
    <header class="header-area header-style-3 header-height-2 mb-30">
        <div class="header-top header-top-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info">
                            <ul>
                                <?php if (!in_groups(3)) {?>
                                <li><a href="<?php base_url() ?>/upgrade/stockist">Distributor</a></li>
                                <?php }?>
                                <?php if (in_groups(3)) {?>
                                <li><a href="<?php base_url() ?>/seller">Distributor</a></li>
                                <?php }?>
                                <?php if (!in_groups(4)) {?>
                                <li><a href="<?php base_url() ?>/upgrade/affiliate">Affiliate</a></li>
                                <?php }?>
                                <?php if (in_groups(4)) {?>
                                <li><a href="<?php base_url() ?>/affiliate">Affiliate</a></li>
                                <?php }?>
                                <li>Download</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-4">
                   
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
                                <?php if(user() != null): ?>
                                    <li><a href="<?php base_url() ?>/account"><i class="far fa"></i><?= user()->fullname; ?></a></li>                                
                                <?php else: ?>
                                    <li><a href="<?php base_url() ?>/register"><i class="far fa"></i>Daftar</a></li>
                                    <li><a href="<?php base_url() ?>/login"><i class="far "></i>Masuk</a></li>
                                <?php endif; ?>
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
                        <form action="<?= base_url() ?>/products/search_p" method="get" class="w-100">
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
                                        <button class="btn btn-primary btn-sm">Masuk</button>
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
                        <a href="<?= base_url()?>" class="w-25 m-1"><img src="<?= base_url()?>/public/frontend/imgs/theme/gtren-t.png" alt="logo"></a>
                    </div>
                    <div class="main-categori-wrap d-none d-md-block">
                        <a class="categori-button-active" href="#">
                            <span class="fa fa-list"></span> Kategori Produk <i class="down far fa-chevron-down"></i> <i class="up far fa-chevron-up"></i>
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
                                    <a href="<?= base_url()?>/orders">Pesanan</a>
                                </li>
                                <li>
                                    <a href="<?= base_url()?>/tracking">Cek Pesanan</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
  
                    <div class="header-action-right d-block d-md-none">
                        <div class="header-action-2">
                            <!-- <div class="header-action-icon-2">
                                <a href="shop-wishlist.html">
                                    <img alt="wowy" src="<?= base_url() ?>/frontend/imgs/theme/icons/icon-heart-white.svg">
                                    <span class="pro-count white">4</span>
                                </a>
                            </div> -->
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="<?= base_url() ?>/cart">
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
                                <a href="<?= base_url() ?>/account">
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
                    <form action="<?= base_url() ?>/products/search_p" method="get">
                        <input type="text" placeholder="Cari" name="search">
                        <button type="submit"> <i class="far fa-search"></i> </button>
                    </form>
                </div>
                <div class="mobile-menu-wrap mobile-header-border">
                    <?php if (user()==null) {?>
                        <div class="main-categori-wrap mobile-header-border">
                            <a class="categori-button-active-2" href="#">
                                <span class="far fa-bars"></span> Kategori Produk <i class="down far fa-chevron-down"></i>
                            </a>
                            <div class="categori-dropdown-wrap categori-dropdown-active-small">
                                <ul>
                                <?php foreach ($category as $data) {?>
                                    <li><a href="<?= base_url() ?>/category/product/<?= $data->id?>"><?= $data->category ?></a></li>
                                <?php }?>
                                </ul>
                            </div>
                        </div>
                    <?php }?>
                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu">
                        <?php if (user()!=null) {?>
                            <a href="<?= base_url()?>/account"><li class="menu-item-has-children"><span class="menu-expand"></span>Dashboard</li></a>
                            <a href="<?= base_url()?>/orders"><li class="menu-item-has-children"><span class="menu-expand"></span>Pembelian</li></a>
                            <a href="<?= base_url()?>/rekening"><li class="menu-item-has-children"><span class="menu-expand"></span>Rekening Anda</li></a>
                            <a href="<?= base_url()?>/tracking"><li class="menu-item-has-children"><span class="menu-expand"></span>Cek Pesanan</li></a>
                            <a href="<?= base_url()?>/address"><li class="menu-item-has-children"><span class="menu-expand"></span>Alamat</li></a>
                            <a href="<?= base_url()?>/profile"><li class="menu-item-has-children"><span class="menu-expand"></span>Profile Saya</li></a>
                            <?php if (in_groups(4)) {?>
                                <a href="<?= base_url()?>/affiliate"><li class="menu-item-has-children"><span class="menu-expand"></span>Dashboard Affiliate</li></a>
                            <?php }?>
                            <?php if (!in_groups(4)) {?>
                                <a href="<?= base_url()?>/upgrade/affiliate"><li class="menu-item-has-children"><span class="menu-expand"></span>Daftar Affiliate</li></a>
                            <?php }?>
                            <?php if (in_groups(3)) {?>
                                <a href="<?= base_url()?>/seller"><li class="menu-item-has-children"><span class="menu-expand"></span>Dashboard Distributor</li></a>
                            <?php }?>
                            <?php if (!in_groups(3)) {?>
                                <a href="<?= base_url()?>/upgrade/stockist"><li class="menu-item-has-children"><span class="menu-expand"></span>Jadi Distributor</li></a>
                            <?php }?>
                            <a href="<?= base_url()?>/logout"><li class="menu-item-has-children"><span class="menu-expand"></span>Keluar</li></a>
                        <?php } ?>
                        <?php if (user()==null) { ?>
                            <a href="<?= base_url()?>/login"><li class="menu-item-has-children"><span class="menu-expand"></span>Masuk</li></a>
                            <a href="<?= base_url()?>/register"><li class="menu-item-has-children"><span class="menu-expand"></span>Daftar</li></a>
                        <?php }?>
                        </ul>
                    </nav>
                    <!-- mobile menu end -->
                </div>
                <div class="mobile-social-icon">
                    <?php foreach ($sosial as $key => $value) {?>
                                <a class="<?php
                                    if ($value->name=='youtube') {
                                        echo 'instagram';
                                    }else{
                                       echo $value->name ;
                                    }
                                    ?>" href="<?= $value->link?>"><i class="fab fa-<?= $value->name?>"></i></a>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
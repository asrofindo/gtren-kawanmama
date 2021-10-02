    <?= $this->extend('commerce/templates/index') ?>
    <?= $this->section('content') ?>

        <!-- <div class="container"> -->
           <!--  <section class="home-slider bg-grey-9 position-relative">
                <div class="hero-slider-1 style-2 dot-style-1 dot-style-1-position-1">
                    <?php foreach ($banners as $banner): ?>
                    <div class="single-hero-slider single-animation-wrap">
                        <div class="container">
                            <div class="slider-1-height-2 slider-animated-1">
                                <div class="hero-slider-content-2">
                                    <h4 class="animated"><?= $banner->offer ?></h4>
                                    <h2 class="animated fw-900"><?= $banner->title?></h2>
                                    <h1 class="animated fw-900 text-brand"><?= $banner->sub_title ?></h1>
                                    <p class="animated"><?= $banner->description ?></p>
                                </div>
                                <div class="single-slider-img single-slider-img-1">
                                    <img class="animated" src="<?= base_url() ?>/public/uploads/banner/<?= $banner->photo?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
                <div class="slider-arrow hero-slider-1-arrow"></div>
            </section> -->

        <!-- </div> -->
        <div class="container d-block d-xl-none d-md-none d-lg-none">
            <div class="row p-3">
                <div class="card col-3">
                    <a href="<?=base_url()?>/kategori">
                        <img src="<?=base_url()?>/public/uploads/banner/kategori.png" alt="" class="p-2">
                    </a>
                    <div class="card-body p-0 text-center">
                        <h6 class="card-title">kategori</h6>
                    </div>
                </div>
                <?php if (user()!=null) {?>
                    <?php if (!in_groups(3)) {?>
                    <div class="card col-3 p-0">
                        <a href="<?=base_url()?>/upgrade/affiliate">
                            <img src="<?=base_url()?>/public/uploads/banner/tas.png" alt="" class="p-2">
                        </a>
                        <div class="card-body p-0 text-center">
                            <h6 class="card-title">jadi distributor</h6>
                        </div>
                    </div>
                    <?php }else{?>
                        <div class="card col-3 p-0">
                        <a href="<?=base_url()?>/affiliate">
                            <img src="<?=base_url()?>/public/uploads/banner/tas.png" alt="" class="p-2">
                        </a>
                        <div class="card-body p-0 text-center">
                            <h6 class="card-title">distributor</h6>
                        </div>
                    </div>
                    <?php }?>
                    <?php if (!in_groups(4)) {?>
                    <div class="card col-3 p-0">
                        <a href="<?=base_url()?>/upgrade/affiliate">
                            <img src="<?=base_url()?>/public/uploads/banner/affiliate.png" alt="" class="p-2">
                        </a>
                        <div class="card-body p-0 text-center">
                            <h6 class="card-title">daftar affiliate</h6>
                        </div>
                    </div>
                    <?php }else{?>
                        <div class="card col-3 p-0">
                        <a href="<?=base_url()?>/affiliate">
                            <img src="<?=base_url()?>/public/uploads/banner/affiliate.png" alt="" class="p-2">
                        </a>
                        <div class="card-body p-0 text-center">
                            <h6 class="card-title">affiliasi</h6>
                        </div>
                    </div>
                    <?php }?>
                <?php }else{?>
                    <div class="card col-3 p-0">
                        <a href="<?=base_url()?>/login">
                            <img src="<?=base_url()?>/public/uploads/banner/masuk.png" alt="" class="p-2">
                        </a>
                        <div class="card-body p-0 text-center">
                            <h6 class="card-title">masuk</h6>
                        </div>
                    </div>
                    <div class="card col-3 p-0">
                        <a href="<?=base_url()?>/register">
                            <img src="<?=base_url()?>/public/uploads/banner/gtren.png" alt="" class="p-2">
                        </a>
                        <div class="card-body p-0 text-center">
                            <h6 class="card-title">daftar</h6>
                        </div>
                    </div>
                <?php }?>
                <div class="card col-3 p-0">
                    <a href="<?=base_url()?>/products/search_p?search=">
                        <img src="<?=base_url()?>/public/uploads/banner/cari.png" alt="" class="p-2">
                    </a>
                    <div class="card-body p-0 text-center">
                        <h6 class="card-title">cari</h6>
                    </div>
                </div>
            </div>
        </div>
        <section class="product-tabs pt-30 pb-30 wow fadeIn animated">
            <div class="container">
                
                <div class="row product-grid-4">
                    <!-- Start -->
                    <?php  foreach ($products as $product): ?>
                    <div class="col-lg-3 col-md-4 col-6  col-sm-6">
                        <div class="product-cart-wrap mb-30">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="<?= base_url('product/'. $product->slug)?>">
                                    <?php for($i = 0; $i < 2; $i++): ?>
                                        <img class="<?= $i == 0 ? 'default-img' : 'hover-img'  ?>" src="<?= base_url() ?>/public/uploads/product_photos/<?= $product->photos[$i]; ?>" alt="">
                                    <?php endfor ?>
                                    </a>
                                </div>
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    <span class="hot">Hot</span>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <?php $categories = $product->getCategory($product->categories); ?>
                                    
                                    <?php foreach($categories as $category): ?>
                                        <a href="<?= base_url('category/product/'.$category->id) ?>">
                                        <?= $category->category ?>
                                        </a>
                                    <?php endforeach ?>

                                </div>
                                <h2><a href="<?= base_url('product/'. $product->slug) ?>"><?= $product->name ?></a></h2>
                                <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width:<?php if ($product->rating==null) {
                                                echo '0';
                                            }else {
                                                echo $product->rating;
                                            }?>%">
                                            </div>
                                        </div>
                                    </div>
                                <div class="product-price">
                                    <span><?= rupiah($product->sell_price) ?></span>
                                    <!-- <span class="old-price">$245.8</span> -->
                                </div>
                             
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                    <!-- End -->
                    <div class="pagination-area mt-30 mb-50">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-start">
                                <?= $pager->links('products', 'commerce_pagination'); ?>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!--End product-grid-4-->
            </div>
        </section>

         <?php foreach ($kategori as $ka): ?>
        <section class="bg-grey-9 section-padding-60 py-5 my-5">
            <div class="container">
                <div class="heading-tab d-flex">
                    <div class="heading-tab-left wow fadeIn animated">
                        <h3 class="section-title mb-35">Produk Dengan Kategori <span><a href="<?= base_url('category/'. strtolower($ka->category)) ?>"><?= $ka->category ?></a></span></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="tab-content wow fadeIn animated" >
                            <div class="tab-pane fade show active">
                                <div class="carausel-4-columns-cover arrow-center position-relative">
                                    <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-<?= $ka->id ?>-arrows"></div>
                                    <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns-<?= $ka->id ?>">
                                        <?php $ids = [intval($ka->id)]; foreach($ka->getProduct($ids) as $p): ?>
                                        <div class="product-cart-wrap mb-30">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="<?= base_url('product/'. $p->slug)?>">
                                                     <?php for($i = 0; $i < 2; $i++): ?>
                                                        <img class="<?= $i == 0 ? 'default-img' : 'hover-img'  ?>" src="<?= base_url() ?>/public/uploads/product_photos/<?= $p->photos[$i] ?>" alt="">
                                                    <?php endfor ?>
                                                    </a>
                                                </div>
                                                <!-- <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="hot">Hot</span>
                                                </div> -->
                                            </div>
                                            <div class="product-content-wrap">
                                                <!-- <div class="product-category">
                                                    
                                                </div> -->
                                                <h2>
                                                    <a href="<?= base_url('product/'. $p->slug) ?>"><?= $p->name ?></a>
                                                </h2>
                                                <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width:<?php if ($product->rating==null) {
                                                echo '0';
                                            }else {
                                                echo $product->rating;
                                            }?>%">
                                            </div>
                                        </div>
                                    </div>
                                                <div class="product-price">
                                                    <span><?= rupiah($p->sell_price) ?> </span>
                                                </div>
                                              
                                            </div>
                                        </div>
            <?php endforeach ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php endforeach ?>
        



<!-- 
        <section class="banner-2 pt-60 pb-60">
            <div class="container">
                <div class="banner-img banner-big wow fadeIn animated">
                    <img src="<?= base_url() ?>/frontend/imgs/banner/banner-4.png" alt="">
                    <div class="banner-text">
                        <h4 class="mb-15 mt-40 text-white">Repair Services</h4>
                        <h2 class="fw-600 mb-20 text-white">We're an Apple <br>Authorised Service Provider</h2>
                        <a href="shop-grid-right.html" class="btn">Learn More <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </section> -->
    <!-- Preloader Start -->
   <!-- <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center">
                    <img class="jump" src="<?= base_url() ?>/frontend/imgs/theme/favico.svg" alt="">
                    <h5 class="mb-5">Loading...</h5>
                    <div class="loader">
                        <div class="bar bar1"></div>
                        <div class="bar bar2"></div>
                        <div class="bar bar3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>  -->
    <!-- Vendor JS-->
        <?= $this->endSection() ?>



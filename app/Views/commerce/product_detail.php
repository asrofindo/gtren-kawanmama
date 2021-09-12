<?= $this->extend('commerce/templates/index') ?>
<?= $this->section('content') ?>
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html" rel="nofollow">Home</a>     
            <span></span> <?= $product->getCategory($product->categories)[0]->category; ?>
            <span></span> <?= $product->name ?>
        </div>
    </div>
</div>
<section class="mt-60 mb-60">
    <div class="container">
        <div class="row">
            <?php if(session()->getFlashData('success')){
                ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Comment <?= session()->getFlashData('success')?>
                </button>
                </div>
            <?php } ?>
            <div class="col-lg-9">
                <div class="product-detail accordion-detail">
                    <div class="row mb-50">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-gallery">
                                <span class="zoom-icon"><i class="fa fa-search-plus"></i></span>
                                <!-- MAIN SLIDES -->
                                <div class="product-image-slider">
                                    <?php foreach($product->photos as $photo): ?>
                                        <figure class="">
                                            <img src="<?= base_url() ?>/public/uploads/product_photos/<?= $photo ?>" alt="product image">
                                        </figure>
                                        <?php endforeach ?>
                                </div>
                                <!-- THUMBNAILS -->
                                <div class="slider-nav-thumbnails pl-15 pr-15">
                                    <?php foreach($product->photos as $photo): ?>
                                        <div>
                                            <img src="<?= base_url() ?>/public/uploads/product_photos/<?= $photo ?>" alt="">
                                        </div>
                                        <?php endforeach ?>
                                </div>
                            </div>
                            <!-- End Gallery -->
                            <div class="single-social-share clearfix mt-50 mb-15">
                            <?php if ( user()!=null && user()->affiliate_link!=null ) {?>
                                    <div class="row">
                                        <input type="text" value="<?=base_url()?>/product/<?=$product->slug?>/src/<?=user()->id?>" id="copy" readonly />
                                        <button type="button" onclick="copy_text()" class="btn btn-sm m-1" id="copy">Copy Link Affiliate</button>
                                    </div>
                                    <p class="mb-15 mt-30 font-sm"> <i class="fa fa-share-alt mr-5"></i> Share this</p>
                                    <div class="mobile-social-icon wow fadeIn  mb-sm-5 mb-md-0 animated">
                                        <a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?=base_url()?>/product/<?=$product->slug?>/src/<?=user()->id?>"><i class="fab fa-facebook-f"></i></a>
                                        <a class="twitter" href="https://twitter.com/share?url=<?=base_url()?>/product/<?=$product->slug?>/src/<?=user()->id?>"><i class="fab fa-twitter"></i></a>
                                        <a class="bg-success" href="https://wa.me/?text=<?=base_url()?>/product/<?=$product->slug?>/src/<?=user()->id?>"><i class="fab fa-whatsapp"></i></a>
                                        <a class="instagram" href="#"><i class="fab fa-instagram"></i></a>
                                    </div>
                                    <?php }else{?> 
                                    <p class="mb-15 mt-30 font-sm"> <i class="fa fa-share-alt mr-5"></i> Share this</p>
                                    <div class="mobile-social-icon wow fadeIn  mb-sm-5 mb-md-0 animated">
                                        <a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?=base_url()?>/product/<?=$product->slug?>"><i class="fab fa-facebook-f"></i></a>
                                        <a class="twitter" href="https://twitter.com/share?url=<?=base_url()?>/product/<?=$product->slug?>"><i class="fab fa-twitter"></i></a>
                                        <a class="bg-success" href="https://wa.me/?text=<?=base_url()?>/product/<?=$product->slug?>"><i class="fab fa-whatsapp"></i></a>
                                        <a class="instagram" href="#"><i class="fab fa-instagram"></i></a>
                                    </div> 
                                    <?php }?> 
                                </div>
                            </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-info">
                                <h2 class="title-detail"><?= $product->name ?></h2>
                                <div class="product-detail-rating">
                                    <!-- <div class="pro-details-brand">
                                        <span> Brands: <a href="shop-grid-right.html">Bootstrap</a></span>
                                    </div> -->
                                    <div class="product-rate-cover text-end">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width:<?=$avgrating?>%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix product-price-cover">
                                    <div class="product-price primary-color float-left">
                                        <ins><span class="text-brand "><?= "Rp. ". number_format($product->sell_price) ?></span></ins>
                                        <input style="display: none" type="" id="price" value="<?= $product->sell_price; ?>" name="">
                                    </div>
                                </div>
                                <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                                <div class="short-desc mb-30">
                                    <p>
                                        <?= $product->description ?>
                                    </p>
                                </div>
                                <!-- <div class="product_sort_info font-xs mb-30">
                                    <ul>
                                        <li class="mb-10"><i class="far fa-hourglass mr-5 text-brand"></i> 1 Year AL Jazeera Brand Warranty</li>
                                        <li class="mb-10"><i class="far fa-paper-plane mr-5 text-brand"></i> 30 Day Return Policy</li>
                                        <li><i class="far fa-address-card mr-5 text-brand"></i> Cash on Delivery available</li>
                                    </ul>
                                </div> -->
                                <!-- <div class="attr-detail attr-color mb-15">
                                    <strong class="mr-10">Color</strong>
                                    <ul class="list-filter color-filter">
                                        <li><a href="#" data-color="Red"><span class="product-color-red"></span></a></li>
                                        <li><a href="#" data-color="Yellow"><span class="product-color-yellow"></span></a></li>
                                        <li class="active"><a href="#" data-color="White"><span class="product-color-white"></span></a></li>
                                        <li><a href="#" data-color="Orange"><span class="product-color-orange"></span></a></li>
                                        <li><a href="#" data-color="Cyan"><span class="product-color-cyan"></span></a></li>
                                        <li><a href="#" data-color="Green"><span class="product-color-green"></span></a></li>
                                        <li><a href="#" data-color="Purple"><span class="product-color-purple"></span></a></li>
                                    </ul>
                                </div> -->
                                <!-- <div class="attr-detail attr-size">
                                    <strong class="mr-10">Size</strong>
                                    <ul class="list-filter size-filter font-small">
                                        <li><a href="#">S</a></li>
                                        <li class="active"><a href="#">M</a></li>
                                        <li><a href="#">L</a></li>
                                        <li><a href="#">XL</a></li>
                                        <li><a href="#">XXL</a></li>
                                    </ul>
                                </div> -->
                                <!-- <div class="bt-1 border-color-1 mt-30 mb-30"></div> -->
                                <div class="detail-extralink">
                                        <div class="detail-qty border radius" style="display: none">
                                            <a href="#" class="qty-down"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                                            <span class="qty-val">1</span>
                                            <a href="#" class="qty-up"><i class="fa fa-caret-up" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="product-extra-link2">
                                           <?php if(count($address) > 0): ?>
                                                <button data-toggle="modal" data-target="#exampleModalCenter" type="submit" class="button button-add-to-cart btn-store">Beli</button>
                                            <?php endif; ?>
                                            <?php if(count($address) == 0 ): ?>
                                                <button data-toggle="modal" data-target="#exampleModalCenter" type="submit" class="button button-add-to-cart btn-store">Beli</button>
                                            <?php endif; ?>
                                        </div>
                                </div>
                                <!-- <ul class="product-meta font-xs color-grey mt-50">
                                    <li class="mb-5">SKU: <a href="#">FWM15VKT</a></li>
                                    <li class="mb-5">Tags: <a href="#" rel="tag">Cloth</a>, <a href="#" rel="tag">Women</a>, <a href="#" rel="tag">Dress</a> </li>
                                    <li>Availability:<span class="in-stock text-success ml-5">8 Items In Stock</span></li>
                                </ul> -->
                            </div>
                            <!-- Detail Info -->
                        </div>
                    </div>
                    <div class="tab-style3">
                        <ul class="nav nav-tabs text-uppercase">
                            <li class="nav-item">
                                <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Reviews</a>
                            </li>
                        </ul>
                        <div class="tab-content shop_info_tab entry-main-content">
                            <div class="tab-pane fade show active" id="Description">
                                <div class="">
                                    <?= $product->description ?>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="Reviews">
                                <!--Comments-->
                                <div class="comments-area">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <h4 class="mb-30">Customer questions & answers</h4>
                                            <div class="comment-list">
                                                <?php foreach ($comment as $data) {?>
                                                    <div class="single-comment justify-content-between d-flex">
                                                        <div class="user justify-content-between d-flex">
                                                            <div class="thumb text-center">
                                                                <img src="<?= base_url() ?>/frontend/imgs/page/<?= $data['image'] ?>" alt="">
                                                                <h6><a href="#"><?= $data['name'] ?></a></h6>
                                                            </div>
                                                            <div class="desc">
                                                                <div class="product-rate d-inline-block">
                                                                    <div class="product-rating" style="width:<?= $data['rating'] ?>%">
                                                                    </div>
                                                                </div>
                                                                <p><?= $data['comment']?></p>
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="d-flex align-items-center">
                                                                        <p class="font-xs mr-30"><?= $data['created_at'] ?></p>
                                                                    </div>
                                                                </div>
                                                                <?php if (user()!=null) {
                                                                 if (user()->id == $data['user_id']) { ?>
                                                                    <a href="<?=base_url()?>/comment/delete/<?=$data['id']?>">delete</a> 
                                                                <?php }} ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                <?php   }?>
                                                <!--single-comment -->
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <h4 class="mb-30">Customer reviews</h4>
                                            <div class="d-flex mb-30">
     
                                                <h6>4.8 out of 5</h6>
                                            </div>
                                            <div class="progress">
                                                <span>5 star</span>
                                                <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                                            </div>
                                            <div class="progress">
                                                <span>4 star</span>
                                                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                            </div>
                                            <div class="progress">
                                                <span>3 star</span>
                                                <div class="progress-bar" role="progressbar" style="width: 45%;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%</div>
                                            </div>
                                            <div class="progress">
                                                <span>2 star</span>
                                                <div class="progress-bar" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">65%</div>
                                            </div>
                                            <div class="progress mb-30">
                                                <span>1 star</span>
                                                <div class="progress-bar" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div>
                                            </div>
                                            <a href="#" class="font-xs text-muted">How are ratings calculated?</a>
                                        </div>
                                    </div>
                                </div>
                                <!--comment form-->
                                <div class="comment-form">
                                    <h4 class="mb-15">Add a review</h4>
                                   
                                    <div class="row">
                                        <div class="col-lg-8 col-md-12">
                                            <div class="row">
                                                    <form action="<?= base_url() ?>/comment/save" method="post">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                                                        </div>
                                                    </div>
                                                    <p>Rating Star</p>
                                                    <fieldset class="rating">
                                                        <input type="radio" id="star5" name="rating" value="100" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                                        <input type="radio" id="star4half" name="rating" value="80 and a half" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                                        <input type="radio" id="star4" name="rating" value="80" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                                        <input type="radio" id="star3half" name="rating" value="60 and a half" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                                        <input type="radio" id="star3" name="rating" value="60" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                                        <input type="radio" id="star2half" name="rating" value="40 and a half" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                                        <input type="radio" id="star2" name="rating" value="40" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                                        <input type="radio" id="star1half" name="rating" value="20 and a half" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                                        <input type="radio" id="star1" name="rating" value="20" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                                        <input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                                    </fieldset>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <input hidden class="form-control" name="user_id" id="email" placeholder="Email" value="<?php if (user() != null) {
                                                            echo user()->id;} ?>">
                                                            <input hidden class="form-control" name="product_id"  value="<?=$product->id?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                    <button type="submit" >Submit
                                                    Comment</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-60">
                        <div class="col-12">
                            <h3 class="section-title style-1 mb-30">Related products</h3>
                        </div>
                        <div class="row">
                        <?php  foreach ($products as $product): ?>
                            <div class="col-lg-4 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="<?= base_url('product/'. $product->slug)?>">
                                                <?php for($i = 0; $i < 2; $i++): ?>
                                                    <img class="<?= $i == 0 ? 'default-img' : 'hover-img'  ?>" src="<?=$product->photos[$i]?>" alt="">
                                                <?php endfor ?>
                                            </a>
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
                                            <span><?= "Rp. ". number_format($product->sell_price) ?></span>
                                            <!-- <span class="old-price">$245.8</span> -->
                                        </div>
                                        <div class="product-action-1 show">
                                            <a aria-label="Add To Cart" class="action-btn hover-up" href="shop-cart.html"><i class="far fa-shopping-bag"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php endforeach ?>
                        </div>
                    </div>
                    <!-- <div class="banner-img banner-big wow fadeIn f-none animated mt-50">
                        <img class="border-radius-10" src="<?= base_url() ?>/frontend/imgs/banner/banner-4.png" alt="">
                        <div class="banner-text">
                            <h4 class="mb-15 mt-40 text-white">Repair Services</h4>
                            <h2 class="fw-600 mb-20 text-white">We're an Apple <br>Authorised Service Provider</h2>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="col-lg-3 primary-sidebar sticky-sidebar">
                <div class="widget-area">
                    <!--Widget categories-->
                    <div class="sidebar-widget widget_categories mb-30 p-30 bg-grey border-radius-10">
                        <div class="widget-header position-relative mb-20 pb-10">
                            <h5 class="widget-title mb-10">Categories</h5>
                            <div class="bt-1 border-color-1"></div>
                        </div>
                        <div class="">
                            <ul class="categor-list">
                                <?php foreach ($kategory  as $data) {?>
                                        <li class="cat-item text-muted"><a href="<?= base_url() ?>/category/product/<?= $data->id?>"><?= $data->category ?></a></li>
  
                                        <?php }?>
                                    <li><a href="<?= base_url() ?>/category/product/<?= $data->id?>"><?= $data->category ?></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Fillter By Price -->
                    <!-- <div class="sidebar-widget price_range range mb-30">
                        <div class="widget-header position-relative mb-20 pb-10">
                            <h5 class="widget-title mb-10">Fill by price</h5>
                            <div class="bt-1 border-color-1"></div>
                        </div>
                        <div class="price-filter">
                            <div class="price-filter-inner">
                                <div id="slider-range"></div>
                                <div class="price_slider_amount">
                                    <div class="label-input">
                                        <span>Range:</span><input type="text" name="price" placeholder="Add Your Price" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="list-group">
                            <div class="list-group-item mb-10 mt-10">
                                <label class="fw-900">Color</label>
                                <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="">
                                    <label class="form-check-label" for="exampleCheckbox1"><span>Red (56)</span></label>
                                    <br>
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox2" value="">
                                    <label class="form-check-label" for="exampleCheckbox2"><span>Green (78)</span></label>
                                    <br>
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox3" value="">
                                    <label class="form-check-label" for="exampleCheckbox3"><span>Blue (54)</span></label>
                                </div>
                                <label class="fw-900 mt-15">Item Condition</label>
                                <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox11" value="">
                                    <label class="form-check-label" for="exampleCheckbox11"><span>New (1506)</span></label>
                                    <br>
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox21" value="">
                                    <label class="form-check-label" for="exampleCheckbox21"><span>Refurbished (27)</span></label>
                                    <br>
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox31" value="">
                                    <label class="form-check-label" for="exampleCheckbox31"><span>Used (45)</span></label>
                                </div>
                            </div>
                        </div>
                        <a href="shop-grid-right.html" class="btn btn-sm btn-default"><i class="fa fa-filter mr-5 ml-0"></i> Fillter</a>
                    </div> -->
                    <!-- Product sidebar Widget -->
                    <!-- <div class="sidebar-widget product-sidebar  mb-30 p-30 bg-grey border-radius-10">
                        <div class="widget-header position-relative mb-20 pb-10">
                            <h5 class="widget-title mb-10">New products</h5>
                            <div class="bt-1 border-color-1"></div>
                        </div>
                        <div class="single-post clearfix">
                            <div class="image">
                                <img src="<?= base_url() ?>/frontend/imgs/shop/thumbnail-3.jpg" alt="#">
                            </div>
                            <div class="content pt-10">
                                <h5><a href="shop-product-detail.html">Chen Cardigan</a></h5>
                                <p class="price mb-0 mt-5">$99.50</p>
                                <div class="product-rate">
                                    <div class="product-rating" style="width:90%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="single-post clearfix">
                            <div class="image">
                                <img src="<?= base_url() ?>/frontend/imgs/shop/thumbnail-4.jpg" alt="#">
                            </div>
                            <div class="content pt-10">
                                <h6><a href="shop-product-detail.html">Chen Sweater</a></h6>
                                <p class="price mb-0 mt-5">$89.50</p>
                                <div class="product-rate">
                                    <div class="product-rating" style="width:80%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="single-post clearfix">
                            <div class="image">
                                <img src="<?= base_url() ?>/frontend/imgs/shop/thumbnail-5.jpg" alt="#">
                            </div>
                            <div class="content pt-10">
                                <h6><a href="shop-product-detail.html">Colorful Jacket</a></h6>
                                <p class="price mb-0 mt-5">$25</p>
                                <div class="product-rate">
                                    <div class="product-rating" style="width:60%"></div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!--Widget ads-->
                    <div class="sidebar-widget widget-ads mb-30">
                        <div class="banner-img banner-1 wow fadeIn  animated" style="visibility: visible; animation-name: fadeIn;">
                            <img class="border-radius-10" src="<?= base_url() ?>/frontend/imgs/banner/banner-10.jpg" alt="">
                            <div class="banner-text">
                                <span>Gaming Area</span>
                                <h4>Save 17% on <br>Assus Laptop</h4>
                                <a href="shop-grid-right.html">Shop Now <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <!--Widget categories-->
                    <!-- <div class="sidebar-widget widget_categories mb-50 p-30 bg-grey border-radius-10">
                        <div class="widget-header position-relative mb-20 pb-10">
                            <h5 class="widget-title mb-10">Manufacturers</h5>
                            <div class="bt-1 border-color-1"></div>
                        </div>
                        <div class="">
                            <ul class="categor-list">
                                <li class="cat-item text-muted"><a href="shop-grid-right.html">Adidas</a>(125)</li>
                                <li class="cat-item text-muted"><a href="shop-grid-right.html">Armani</a>(68)</li>
                                <li class="cat-item text-muted"><a href="shop-grid-right.html">Burberry</a>(274)</li>
                                <li class="cat-item text-muted"><a href="shop-grid-right.html">Chanel</a>(152)</li>
                                <li class="cat-item text-muted"><a href="shop-grid-right.html">Prada</a>(302)</li>
                            </ul>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</section>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Pilih Distributor</h4>
          </div>
          <div class="modal-body">
            <ul style="z-index: -1" class="list-group">
                <?php foreach($product_distributors as $distributor): ?>  

                    <?php if (get_cookie('affiliate') != null) {?>
                        <form method="post" action="<?= base_url();?>/cart/<?= get_cookie('affiliate')?>" >
                    <?php }else{?>
                        <form method="post" action="<?= base_url();?>/cart" >
                    <?php } ?> 
                        <input style="display: none" type="text" value="" name="amount" class="amount">
                        <input style="display: none" type="text" value="" name="price_sell" class="price_sell">
                        <input style="display: none" type="text" value="<?= $distributor->product_id ?>" name="product_id">
                        <input style="display: none" type="text" value="<?= $distributor->distributor_id ?>" name="distributor_id">
                        <li style="position: relative;" type="submit" class="list-group-item d-flex justify-content-between align-items-center h-50">
                            <?= $distributor->username ?> <br>
                            Alamat : <?= $distributor->detail_alamat;  ?>
                            kecamatan : <?= $distributor->kecamatan; ?> <br>
                            kabupaten : <?= $distributor->kabupaten; ?> <br>
  
                        </li>
                        <button class="btn-sm btn-primary" type="submit">Pilih</button>
                    </form>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function copy_text() {
            document.getElementById("copy").select();
            document.execCommand("copy");
            alert("Text berhasil dicopy");
        }
    $(document).ready(function(){
 
        // get Edit Product
        $('.btn-store').on('click',function(){
            // get data from button edit
           
            // Call Modal Edit

            const val = $('.qty-val')
            const price = $('#price')
            $('.amount').each((index, obj) => {
                $(obj).val(val[0].innerHTML);
            })

             $('.price_sell').each((index, obj) => {
                $(obj).val( $('#price').val());
            })

            $('#myModal').modal('show');
        });

         $('.close').on('click',function(){
            // get data from button edit
            $('#myModal').modal('hide');
        });

         
    });

    $(function(){
    console.log('ready');

    $('.list-group li').click(function(e) {
        e.preventDefault()

        $that = $(this);

        $that.parent().find('li').removeClass('active');
        $that.addClass('active');
        $('#forms').submit();
    });
})

</script>
<?= $this->endSection() ?>
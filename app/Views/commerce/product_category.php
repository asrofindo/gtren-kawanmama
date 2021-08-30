<?= $this->extend('commerce/templates/index') ?>
<?= $this->section('content') ?>
<div class="page-header breadcrumb-wrap">
    <div class="container">
    <div class="row product-grid-4">
                    <!-- Start -->
                    <?php  foreach ($products as $product): ?>
                    <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="shop-product-right.html">
                                        <?php for($i = 0; $i < 2; $i++): ?>
                                            <img class="<?= $i == 0 ? 'default-img' : 'hover-img'  ?>" src="<?= base_url() ?>/uploads/product_photos/<?= $product->photos[$i] ?>" alt="">
                                        <?php endfor ?>
                                    </a>
                                </div>

                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <?php $categories = $product->getCategory($product->categories); ?>
                                    
                                    <?php foreach($categories as $category): ?>
                                        <a href="<?= base_url('product/category/'. strtolower($category->category) ) ?>">
                                        <?= $category->category ?>
                                        </a>
                                    <?php endforeach ?>

                                </div>
                                <h2><a href="<?= base_url('product/'. $product->slug) ?>"><?= $product->name ?></a></h2>
                                <div class="rating-result" title="50%">
                                    <span>
                                        <span>50%</span>
                                    </span>
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
                    <!-- End -->

                </div>
    </div>

<?= $this->endSection() ?>
<?= $this->extend('commerce/templates/index') ?>
<?= $this->section('content') ?>
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="row m-2 d-block d-xl-none d-md-none d-lg-none">
            <div class="search-style-1 w-100">
                        <form action="<?= base_url() ?>/products/search_p" method="get" class="w-100">
                            <input type="text" placeholder="Cari Produk" name="search" class="rounded-3">
                            <button type="submit"> <i class="far fa-search"></i> </button>
                        </form>
            </div>
        </div>
    <div class="row product-grid-4">
                    <!-- Start -->
                    <?php  foreach ($products as $product): ?>
                    <div class="col-lg-3 col-md-4 col-6 col-sm-6">
                        <div class="product-cart-wrap mb-30">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="<?= base_url('product/'. $product->slug) ?>">
                                        <?php for($i = 0; $i < 2; $i++): ?>
                                            <img class="<?= $i == 0 ? 'default-img' : 'hover-img'  ?>" src="<?= base_url() ?>/public/uploads/product_photos/<?= $product->photos[$i] ?>" alt="">
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
    </div>

<?= $this->endSection() ?>
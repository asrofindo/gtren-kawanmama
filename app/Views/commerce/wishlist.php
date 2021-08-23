<?= $this->extend('commerce/templates/index') ?>
<?= $this->section('content') ?>
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html" rel="nofollow">Home</a>
            <span></span> Shop
            <span></span> Wishlist
        </div>
    </div>
</div>
<section class="mt-60 mb-60">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table shopping-summery text-center">
                        <thead>
                            <tr class="main-heading">
                                <th scope="col" colspan="2">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Stock Status</th>
                                <th scope="col">Action</th>
                                <th scope="col">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="image product-thumbnail"><img src="<?= base_url() ?>/frontend/imgs/shop/product-1-2.jpg" alt="#"></td>
                                <td class="product-des product-name">
                                    <p class="product-name"><a href="shop-product-right.html">J.Crew Mercantile Women's Short-Sleeve</a></p>
                                    <p class="font-xs">Maboriosam in a tonto nesciung eget<br> distingy magndapibus.
                                    </p>
                                </td>
                                <td class="price" data-title="Price"><span>$65.00 </span></td>
                                <td class="text-center" data-title="Stock">
                                    <span class="color3 font-weight-bold">In Stock</span>
                                </td>
                                <td class="text-right" data-title="Cart">
                                    <button class="btn btn-rounded btn-sm"><i class="far fa-shopping-bag mr-5"></i>Add to cart</button>
                                </td>
                                <td class="action" data-title="Remove"><a href="#"><i class="fa fa-trash-alt"></i></a></td>
                            </tr>
                            <tr>
                                <td class="image"><img src="<?= base_url() ?>/frontend/imgs/shop/product-1-3.jpg" alt="#"></td>
                                <td class="product-des">
                                    <p class="product-name"><a href="shop-product-right.html">Amazon Essentials Women's Tank</a></p>
                                    <p class="font-xs">Sit at ipsum amet clita no est,<br> sed amet sadipscing et gubergren</p>
                                </td>
                                <td class="price" data-title="Price"><span>$75.00 </span></td>
                                <td class="text-center" data-title="Stock">
                                    <span class="color3 font-weight-bold">In Stock</span>
                                </td>
                                <td class="text-right" data-title="Cart">
                                    <button class="btn btn-rounded btn-sm"><i class="far fa-shopping-bag mr-5"></i>Add to cart</button>
                                </td>
                                <td class="action" data-title="Remove"><a href="#"><i class="fa fa-trash-alt"></i></a></td>
                            </tr>
                            <tr>
                                <td class="image"><img src="<?= base_url() ?>/frontend/imgs/shop/product-2-1.jpg" alt="#"></td>
                                <td class="product-des">
                                    <p class="product-name"><a href="shop-product-right.html">Amazon Brand - Daily Ritual Women's Jersey </a></p>
                                    <p class="font-xs">Erat amet et et amet diam et et.<br> Justo amet at dolore
                                    </p>
                                </td>
                                <td class="price" data-title="Price"><span>$62.00 </span></td>
                                <td class="text-center" data-title="Stock">
                                    <span class="text-danger font-weight-bold">Out of stock</span>
                                </td>
                                <td class="text-right" data-title="Cart">
                                    <button class="btn btn-rounded btn-sm btn-secondary"><i class="far fa-envelope mr-5"></i>Contact Us</button>
                                </td>
                                <td class="action" data-title="Remove"><a href="#"><i class="fa fa-trash-alt"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
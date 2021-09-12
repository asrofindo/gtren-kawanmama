<?= $this->extend('commerce/templates/index') ?>
<?= $this->section('content') ?>
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html" rel="nofollow">Home</a>
            <span></span> Shop
            <span></span> Your Cart
        </div>
    </div>
</div>
<section class="mt-60 mb-60">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table shopping-summery text-center clean">
                        <thead>
                            <tr class="main-heading">
                                <th scope="col">Foto</th>
                                <th scope="col">Produk</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col">Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php foreach($carts as $cart): ?>
                            <tr>
                                <?php $photo = explode(',', $cart->photos); ?>

                                <td class="image product-thumbnail"><img src="<?php base_url() ?>/public/uploads/product_photos/<?= $photo[0] ?>" alt="#"></td>
                                <td class="product-des product-name">
                                    <p class="product-name"><a href="shop-product-right.html"><?= $cart->name; ?></a></p>

                                </td>
                                <td class="price" data-title="Price"><span><?= $cart->sell_price; ?></span></td>
                                <td class="text-center" data-title="Stock">
                                    <div class="detail-qty border radius  m-auto">
                                        <a href="<?= base_url() ?>/cart/substruct/<?= $cart->id ?>" style="width:100px"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                                        <span class="qty-val"><?= $cart->amount ?></span>
                                        <a href="<?= base_url() ?>/cart/add/<?= $cart->id ?>" ><i class="fa fa-caret-up" aria-hidden="true"></i></a>
                                    </div>
                                </td>
                                <td class="text-right" data-title="Cart">
                                    <span><?= $cart->total; ?></span>
                                </td>
                                <td class="action" data-title="Remove"><a href="<?= base_url() ?>/cart/delete/<?= $cart->id ?>" class="text-muted"><i class="fa fa-trash-alt"></i></a></td>
                                <?php endforeach ?>
                                <tr>
                                <td colspan="6" class="text-end">
                                    <a href="<?= base_url() ?>/cart/delete/all" class="text-muted"> <i class="fa fa-times-circle"></i>Bersihkan Keranjang</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="col-lg-6 col-md-12">
                <div class="border p-md-4 p-30 border-radius-10 cart-totals">
                    <div class="heading_s1 mb-3">
                        <h4>Nilai Belanja</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table">      
                            <tr>
                                <td class="cart_total_label">Total</td>
                                <td class="cart_total_amount"><strong><span class="font-xl fw-900 text-brand"><?= $total;  ?></span></strong></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <a href="<?=base_url()?>/checkout" class="btn btn-rounded"> <i class="fa fa-share-square mr-10"></i>Lanjutkan</a>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
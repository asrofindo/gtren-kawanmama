<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Detail Pesanan</h2>
<!--         <p>Details for Order ID: 3453012</p>
 -->    </div>
</div>
<div class="card">
 <!-- card-header end// -->
    <div class="card-body">
        <div class="row mb-50 mt-20 order-info-wrap">
            <?php foreach($detail_orders as $order): ?>
                <div class="col-md-4">
                    <article class="icontext align-items-start">
                        <span class="icon icon-sm rounded-circle bg-primary-light">
                            <i class="text-primary material-icons md-person"></i>
                        </span>
                        <div class="text">
                            <h6 class="mb-1">Customer</h6>
                            <p class="mb-1">
                               <?= $order['username'] ?> <br> <?= $order['email'] ?> <br>
                            </p>
                            <a href="#">View profile</a>
                        </div>
                    </article>
                </div> <!-- col// -->
                <div class="col-md-4">
                    <article class="icontext align-items-start">
                        <span class="icon icon-sm rounded-circle bg-primary-light">
                            <i class="text-primary material-icons md-local_shipping"></i>
                        </span>
                        <div class="text">
                            <h6 class="mb-1">Order info</h6>
                            <p class="mb-1">
                                Shipping: <?= $order['kurir'] ?> <br> etd: <?= $order['etd'] ?> <br> ongkir:Rp <?= number_format($order['ongkir']); ?>
                            </p>
                            <a href="#">Download info</a>
                        </div>
                    </article>
                </div> <!-- col// -->
                <div class="col-md-4">
                    <article class="icontext align-items-start">
                        <span class="icon icon-sm rounded-circle bg-primary-light">
                            <i class="text-primary material-icons md-place"></i>
                        </span>
                        <div class="text">
                            <h6 class="mb-1">Deliver to</h6>
                            <p class="mb-1">
                                kabupaten: <?= $order['kabupaten'] ?> <br>kecamatan : <?= $order['kecamatan'] ?><br> kode pos : <?= $order['kode_pos'] ; ?>
                            </p>
                            <a href="#">View profile</a>
                        </div>
                    </article>
                </div> <!-- col// -->
            <?php endforeach; ?>
        </div> <!-- row // -->
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="20%">Product</th>
                                <th width="20%">Resi</th>
                                <th width="20%">Unit Price</th>
                                <th width="20%">Quantity</th>
                                <th width="20%">status pemesanan</th>
                                <th width="20%" class="text-end">Total</th>
                                <th width="20%" class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($detail_orders as $order):?>
                                <?php foreach ($order['products'] as $product): ?>
                                    <tr>
                                            <td>
                                                <a class="itemside" href="#">
                                                    <div class="left">
                                                         <?php for($i = 0; $i < 1; $i++): ?>
                                                            <img src="<?php base_url() ?>/public/uploads/product_photos/<?= $product->photos[$i] ?>" width="40" height="40" class="img-xs" alt="Item">
                                                        <?php endfor; ?>
                                                    </div>
                                                    <div class="info"><?= $product->name;  ?></div>
                                                </a>
                                            </td>
                                            <td> <?= $product->resi; ?> </td>
                                            <td> Rp <?= number_format($product->total / $product->amount); ?> </td>
                                            <td> <?= $product->amount; ?> </td>
                                            <td> 
                                               <?php if($product->status_barang == null && $product->status_pembayaran == 'paid'): ?>
                                                    <span class="badge rounded-pill alert-warning">Menunggu Konfirmasi Seller</span>
                                                <?php elseif($product->status_barang == null && $product->status_pembayaran == 'pending'): ?>
                                                    <span class="badge rounded-pill alert-warning">Menunggu pembayaran</span>
                                                <?php elseif($product->status_barang == 'dikirim'): ?>
                                                    <span class="badge rounded-pill alert-success">Sudah Dikirim Oleh Seler</span>
                                                <?php elseif($product->status_barang == 'refund'): ?>
                                                    <span class="badge rounded-pill alert-warning">Dana Dikembalikan oleh user</span>
                                                <?php elseif($product->status_barang == 'ditolak'): ?>
                                                    <span class="badge rounded-pill alert-danger">Pesanan Di Tolak Oleh distributor</span>
                                                <?php elseif($product->status_barang == 'diterima_seller'): ?>
                                                    <span class="badge rounded-pill alert-success">Penyiapan Barang</span>
                                                <?php endif; ?>

                                            </td>
                                            <td class="text-end">Rp <?= number_format($product->total);  ?> </td>
                                            <td class="text-end">
                                                <div class="dropdown">
                                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                                    <div class="dropdown-menu">
                                                         <a class="dropdown-item" href="<?= base_url() ?>/order/acc/<?= $product->id; ?>">Terima</a>
                                                        <a class="dropdown-item text-danger" href="<?= base_url() ?>/order/ignore/<?= $product->id; ?>">Tolak</a>
                                                    </div>
                                                </div> <!-- dropdown //end -->
                                            </td>

                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td colspan="4">
                                        <article class="float-end">
                                            <dl class="dlist">
                                                <dt>Ongkos Kirim:</dt>
                                                <dd>Rp<?= number_format($order['ongkir']);  ?></dd>
                                            </dl>
                                            <dl class="dlist">
                                                <dt>total tagihan:</dt>
                                                <dd> <b class="h5">Rp<?= number_format($order['total_transaksi']);  ?></b> </dd>
                                            </dl>
                                        </article>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div> <!-- table-responsive// -->
            </div> <!-- col// -->
            <div class="col-lg-1"></div> <!-- col// -->
        </div>
    </div> <!-- card-body end// -->
</div>
<?php $this->endSection() ?>
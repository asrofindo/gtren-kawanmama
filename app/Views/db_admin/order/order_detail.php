<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Detail Pesanan</h2>
<!--         <p>Details for Order ID: 3453012</p>
 -->    </div>
</div>
<div class="card">
    <header class="card-header">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 mb-lg-0 mb-15">
                <span>
<!--                     <i class="material-icons md-calendar_today"></i> <b>Wed, Aug 13, 2020, 4:34PM</b>
 -->                </span> <br>
<!--                 <small class="text-muted">Order ID: 3453012</small>
 -->            </div>
            <div class="col-lg-6 col-md-6 ms-auto text-md-end">
                <form action="<?= base_url() ?>/order/update/<?= $transaksi_id; ?>" method="post">       
                    <select name="status" class="form-select d-inline-block mb-lg-0 mb-15 mw-200">
                            <option selected disabled="">Change status</option>
                            <option value="pending">Menunggu Pembayaran</option>
                            <option value="paid">Sudah Bayar</option>
                            <option value="cancel">di Gagalkan</option>

                    </select>
                    <button class="btn btn-primary" type="submit">Save</button>
                    <a class="btn btn-secondary print ms-2" href="#"><i class="icon material-icons md-print"></i></a>
                </form>
            </div>
        </div>
    </header> <!-- card-header end// -->
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
                                Shipping: <?= $order['kurir'] ?> <br> etd: <?= $order['etd'] ?> <br> ongkir: <?= $order['ongkir'] ?>
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
                                <th width="20%">Seller</th>
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
                                                        <img src="<?= $product->photos; ?>" width="40" height="40" class="img-xs" alt="Item">
                                                    </div>
                                                    <div class="info"><?= $product->name;  ?></div>
                                                </a>
                                            </td>
                                            <td> <?= $product->locate; ?> </td>
                                            <td> <?= $product->total / $product->amount; ?> </td>
                                            <td> <?= $product->amount; ?> </td>
                                            <td> 
                                               <?php if($product->status_barang == 'pending' && $product->status_pembayaran == 'paid'): ?>
                                                    <span class="badge rounded-pill alert-warning">Menunggu Konfirmasi Dari Admin</span>
                                                <?php elseif($product->status_barang == 'pending' && $product->status_pembayaran == 'pending'): ?>
                                                    <span class="badge rounded-pill alert-warning">Menunggu pembayaran</span>
                                                <?php elseif($product->status_pembayaran == 'pending'): ?>
                                                    <span class="badge rounded-pill alert-warning">Menunggu pembayaran</span>
                                                 <?php elseif($product->status_pembayaran == 'paid'): ?>
                                                    <span class="badge rounded-pill alert-warning">Menunggu Konfirmasi Dari Seller</span>
                                                <?php elseif($product->status_barang == 'refund'): ?>
                                                    <span class="badge rounded-pill alert-warning">Dana Dikembalikan oleh user</span>
                                                <?php elseif($product->status_barang == 'ditolak'): ?>
                                                    <span class="badge rounded-pill alert-danger">Pesanan Di Tolak Oleh distributor</span>
                                                <?php elseif($product->status_barang == 'diterima'): ?>
                                                    <span class="badge rounded-pill alert-success">Pesanan Di Terima oleh distributor</span>
                                                <?php endif; ?>

                                            </td>
                                            <td class="text-end"> <?= $product->total;  ?> </td>
                                            <td class="text-end">
                                                <div class="dropdown">
                                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="<?= base_url()  ?>/order/refund/<?= $transaksi_id  ?>/<?= $product->id ?>">Refund</a>
                                                    </div>
                                                </div> <!-- dropdown //end -->
                                            </td>

                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td colspan="4">
                                        <article class="float-end">
                                            <dl class="dlist">
                                                <dt>Shipping cost:</dt>
                                                <dd><?= $order['ongkir'];  ?></dd>
                                            </dl>
                                            <dl class="dlist">
                                                <dt>total tagihan:</dt>
                                                <dd> <b class="h5"><?= $order['total_transaksi'];  ?></b> </dd>
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
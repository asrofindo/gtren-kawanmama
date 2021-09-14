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
            <div class="col-lg-4 col-md-4 mb-lg-0 mb-15">
                
         </div>
            <div class="col-lg-8 col-md-8 ms-auto text-md-end">
                <form action="<?= base_url() ?>/order/update/<?= $transaksi_id; ?>" method="post">       
                    <?php foreach($detail_orders as $order): ?>
                        <?php if($order['status_pembayaran'] == 'paid'): ?>
                            <a class="btn badge rounded-pill alert-success">Sudah Bayar</a>
                        <?php else: ?>
                            <a class="btn badge rounded-pill alert-warning">Belum Bayar</a>
                        <?php endif; ?>
                    <?php endforeach; ?>            
                    <select name="status" class="form-select d-inline-block mb-lg-0 mb-15 mw-200">
                        <option selected disabled="">Rubah Status Pembayaran</option>
                        <option value="paid">Sudah Bayar</option>
                    </select>
                    <button class="btn btn-primary" type="submit">Simpan</button>
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
                               <?= $order['fullname'] ?> <br> <?= $order['email'] ?> <br> <?= $order['phone'] ?>
                            </p>
                        </div>
                    </article>
                </div> <!-- col// -->
                <div class="col-md-4">
                    <article class="icontext align-items-start">
                        <span class="icon icon-sm rounded-circle bg-primary-light">
                            <i class="text-primary material-icons md-place"></i>
                        </span>
                        <div class="text">
                            <h6 class="mb-1">Dikirim Ke</h6>
                            <p class="mb-1">
                                <?php $alamat = explode(',', $order['alamat']); ?>
                                <?php echo $alamat[4]; ?> <br>
                                <?php echo $alamat[2]; ?> <br>
                                <?php echo $alamat[1]; ?> <br>
                                <?php echo $alamat[0]; ?> <br>
                            </p>
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
                                Shipping: <?= $order['kurir'] ?> <br> etd: <?= $order['etd'] ?> <br> ongkir: Rp. <?= number_format($order['ongkir']) ?> <br>
                                Bank : <?php echo $order['bank']; ?>
                            </p>
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
                                                        <?php $photo = explode(',', $product->photos) ?>
                                                        <img src="<?php base_url() ?>/public/uploads/product_photos/<?= $photo[0]; ?>" width="40" height="40" class="img-xs" alt="Item">
                                                    </div>
                                                    <div class="info"><?= $product->name;  ?></div>
                                                </a>
                                            </td>
                                            <td> <?= $product->locate; ?> </td>
                                            <td> Rp. <?= number_format($product->total / $product->amount); ?> </td>
                                            <td> <?= $product->amount; ?> </td>
                                            <td> 
                                               <?php if($product->status_barang == 'pending' && $product->status_pembayaran == 'paid'): ?>
                                                    <span class="badge rounded-pill alert-warning">Menunggu Konfirmasi Dari Admin</span>
                                                <?php elseif($product->status_barang == 'pending' && $product->status_pembayaran == 'pending'): ?>
                                                    <span class="badge rounded-pill alert-warning">Menunggu pembayaran</span>
                                                <?php elseif($product->status_pembayaran == 'pending'): ?>
                                                    <span class="badge rounded-pill alert-warning">Menunggu pembayaran</span>
                                                 <?php elseif($product->status_pembayaran == 'paid' && $product->status_barang == null): ?>
                                                    <span class="badge rounded-pill alert-warning">Menunggu Konfirmasi Dari DIstributor</span>
                                                <?php elseif($product->status_barang == 'refund'): ?>
                                                    <span class="badge rounded-pill alert-warning">Dana Dikembalikan Kepada Pembeli</span>
                                                <?php elseif($product->status_barang == 'ditolak'): ?>
                                                    <span class="badge rounded-pill alert-danger">Pesanan Di Tolak Oleh distributor</span>
                                                <?php elseif($product->status_barang == 'diterima_seller'): ?>
                                                    <span class="badge rounded-pill alert-success">Pesanan Dalam Antrian distributor</span>
                                                <?php endif; ?>

                                            </td>
                                            <td class="text-end">Rp. <?= number_format($product->total);  ?> </td>
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
                                                <dt>Ongkos Kirim:</dt>
                                                <dd>Rp. <?= number_format($order['ongkir']);  ?></dd>
                                            </dl>
                                            <dl class="dlist">
                                                <dt>total tagihan:</dt>
                                                <dd> <b class="h5">Rp. <?= number_format($order['total_transaksi']);  ?></b> </dd>
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
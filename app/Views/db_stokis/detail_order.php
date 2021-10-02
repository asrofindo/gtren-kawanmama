<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Detail Pesanan</h2>
<!--         <p>Details for Order ID: 3453012</p>
 -->     <a class="btn btn-secondary print ms-2" href="#"><i class="icon material-icons md-print"></i></a> 
    </div>
</div>
<div class="card" id="pesanan">
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
                </div>
                <div class="col-md-4">
                    <article class="icontext align-items-start">
                        <span class="icon icon-sm rounded-circle bg-primary-light">
                            <i class="text-primary material-icons md-local_shipping"></i>
                        </span>
                        <div class="text">
                            <h6 class="mb-1">Order info</h6>
                            <p class="mb-1">
                                Shipping: <?= $order['kurir'] ?> <br> etd: <?= $order['etd'] ?> <br> ongkir:<?= rupiah($order['ongkir']); ?> <br>
                                 Bank : <?php echo $order['bank']; ?>
                            </p>
                        </div>
                    </article>
                </div> <!-- col// -->
               <!-- col// -->
            <?php endforeach; ?>
        </div> <!-- row // -->
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="20%">Produk</th>
                                <th width="20%">Resi</th>
                                <th width="20%">Harga</th>
                                <th width="20%">Jumlah Barang</th>
                                <th width="20%">Status Pemesanan</th>
                                <th width="20%" class="text-end">Total</th>
                                <th width="20%" class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($detail_orders as $order):?>
                                <?php foreach ($order['products'] as $product): ?>
                                    <tr>
                                            <td>
                                                <a class="itemside" href="#">
                                                    <div class="left">
                                                         <?php $photo = explode(',', $product->photos); ?>
                                                            <img src="<?php base_url() ?>/public/uploads/product_photos/<?= $photo[0]; ?>" width="40" height="40" class="img-xs" alt="Item">
                                                    </div>
                                                    <div class="info"><?= $product->name;  ?></div>
                                                </a>
                                            </td>
                                            <td> <?= $product->resi; ?> </td>
                                            <td> <?= rupiah($product->total / $product->amount); ?> </td>
                                            <td> <?= $product->amount; ?> </td>
                                            <td> 
                                               <?php if($product->status_barang == null && $product->status_pembayaran == 'paid'): ?>
                                                    <span class="badge rounded-pill alert-warning">Menunggu Konfirmasi Seller</span>
                                                <?php elseif($product->status_barang == null && $product->status_pembayaran == 'pending'): ?>
                                                    <span class="badge rounded-pill alert-warning">Menunggu pembayaran</span>
                                                <?php elseif($product->status_barang == 'dikirim'): ?>
                                                    <span class="badge rounded-pill alert-success">Sudah Dikirim Oleh Seler</span>
                                                <?php elseif($product->status_barang == 'refund'): ?>
                                                    <span class="badge rounded-pill alert-primary">Dana Dikembalikan Kepada Pembeli</span>
                                                <?php elseif($product->status_barang == 'ditolak'): ?>
                                                    <span class="badge rounded-pill alert-danger">Pesanan Di Tolak Oleh distributor</span>
                                                <?php elseif($product->status_barang == 'diterima_seller'): ?>
                                                    <span class="badge rounded-pill alert-success">Penyiapan Barang</span>
                                                 <?php elseif($product->status_barang == 'diterima_pembeli'): ?>
                                                    <span class="badge rounded-pill alert-success">Barang Sudah Diterima Pembeli</span>
                                                <?php endif; ?>

                                            </td>
                                            <td class="text-end"><?= rupiah($product->total);  ?> </td>
                                            <td class="text-end">
                                                <div class="dropdown">
                                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                                    <div class="dropdown-menu">

                                                        <?php if($product->status_barang == null): ?>
                                                            <a onclick="return confirm('Apakah Anda Yakin Mau Terima ?')" class="dropdown-item" href="<?= base_url() ?>/order/acc/<?= $product->id; ?>">Terima</a>
                                                            <a onclick="return confirm('Apakah Anda Yakin Mau Menolak ?')" class="dropdown-item text-danger" href="<?= base_url() ?>/order/ignore/<?= $product->id; ?>">Tolak</a>
                                                        <?php endif; ?>
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
                                                <dd><?= rupiah($order['ongkir']);  ?></dd>
                                            </dl>
                                            <dl class="dlist">
                                                <dt>total tagihan:</dt>
                                                <dd> <b class="h5"><?= rupiah($total_transaksi[0]->total_transaksi);  ?></b> </dd>
                                            </dl>
                                            <dl class="dlist">
                                                <dt>Uang Yang Akan Anda Terima:</dt>
                                                <dd> <b class="h5"><?= rupiah($order['stockist_commission']);  ?></b> </dd>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.3.2/dist/html2canvas.min.js"></script>
<script type="text/javascript">  
$('.print').click(() => {    
            html2canvas($("#pesanan"), {
                onrendered: function(canvas) {
                    theCanvas = canvas;


                    canvas.toBlob(function(blob) {
                        saveAs(blob, "Dashboard.png"); 
                    });
                }
            });
})

</script>
<?php $this->endSection() ?>
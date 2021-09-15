<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Pesanan </h2>
        <p>data semua pesanan</p>
    </div>
</div>
<div class="card mb-4">
    <header class="card-header">
        <div class="row gx-3">
            <div class="col-lg-4 col-md-12 me-auto">
                <form method="post" action="<?php base_url() ?>/order/search">                    
                    <input type="text" placeholder="Cari Nama" name="keyword" class="form-control">
                    <button class="btn btn-sm btn-primary" type="submit">Cari</button>
                </form>
            </div>
            <div class="col-lg-2 col-6 col-md-3">
                <form  method="post" action="<?php base_url() ?>/order/search">
                    <select name="status" class="form-select">
                        <option disabled>Status</option>
                        <option value="paid">Sudah Bayar</option>
                        <option value="pending" >Belum Bayar</option>
                    </select>
                    <button class="btn btn-sm btn-primary" type="submit">Cari</button>
                </form>
            </div>
        </div>
    </header> <!-- card-header end// -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Total</th>
                        <th scope="col">Status Pembayaran</th>
                        <th scope="col">Perhatian Admin</th>
                        <th scope="col">Batas Pesanan</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col" class="text-end"> Aksi </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?= $order->id; ?></td>
                            <td><b><?php echo $order->fullname; ?></b></td>
                            <td><?php echo $order->total ?></td>
                            <td>
                                <?php if($order->status_pembayaran == 'pending'): ?>
                                    <span class="badge rounded-pill alert-warning">Menunggu Pembayaran</span>
                                <?php elseif($order->status_pembayaran == 'paid'): ?>
                                    <span class="badge rounded-pill alert-success">Sudah Dibayar</span>
                                 <?php elseif($order->status_pembayaran == 'cancel'): ?>
                                    <span class="badge rounded-pill alert-danger">di gagalkan</span>
                                <?php endif; ?>
                            </td>
                            <?php $status_barang = explode(',', $order->status_barang); ?>
                            <td>
                                <?php $i = 0;  foreach ($status_barang as $s): ?>
                                    <?php if($s == 'ditolak'): ?>
                                        <span class="badge  rounded-pill alert-warning"><?php echo "tolak"; ?></span>
                                    <?php endif; ?>
                                    <?php if($s == 'refund'): ?>
                                        <span class="badge  rounded-pill alert-warning"><?php echo "refund"; ?></span>
                                    <?php endif; ?>
                                    <?php if($s == 'diterima_seller'): ?>
                                        <span class="badge  rounded-pill alert-warning"><?php echo "dikonfirmasi"; ?></span>
                                    <?php endif; ?>
                                    <?php if($s == 'diterima_pembeli'): ?>
                                        <span class="badge  rounded-pill alert-warning"><?php echo "selesai"; ?></span>
                                    <?php endif; ?>
                                    <?php if($s == 'dipantau'): ?>
                                        <span class="badge  rounded-pill alert-warning"><?php echo "dipantau"; ?></span>
                                    <?php endif; ?>
                                <?php endforeach ?>
                            </td>
                            <td><?= $order->batas_pesanan; ?></td>
                            <td><?= $order->created_at; ?></td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-light" href="<?= base_url() ?>/orderdetail/<?= $order->id; ?>">Lihat Detail</a>
                                <!-- dropdown //end -->
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div> <!-- table-responsive //end -->
    </div> <!-- card-body end// -->
</div> <!-- card end// -->
<div class="pagination-area mt-30 mb-50">
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-start">
            <?= $pager->links('orders', 'product_pagination'); ?>
        </ul>
    </nav>
</div>

<?php $this->endSection() ?>
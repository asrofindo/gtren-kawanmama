<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Order List </h2>
        <p>Lorem ipsum dolor sit amet.</p>
    </div>
    <div>
        <input type="text" placeholder="Search order ID" class="form-control bg-white">
    </div>
</div>
<div class="card mb-4">
    <header class="card-header">
        <div class="row gx-3">
            <div class="col-lg-4 col-md-6 me-auto">
                <input type="text" placeholder="Search..." class="form-control">
            </div>
            <div class="col-lg-2 col-6 col-md-3">
                <select class="form-select">
                    <option>Status</option>
                    <option>Active</option>
                    <option>Disabled</option>
                    <option>Show all</option>
                </select>
            </div>
            <div class="col-lg-2 col-6 col-md-3">
                <select class="form-select">
                    <option>Show 20</option>
                    <option>Show 30</option>
                    <option>Show 40</option>
                </select>
            </div>
        </div>
    </header> <!-- card-header end// -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Status Barang</th>
                        <th scope="col">Status Pembayaran</th>
                        <th scope="col">Total</th>
                        <th scope="col">Date</th>
               
                        <th scope="col" class="text-end"> Action </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><b><?php echo $order->id; ?></b></td>
                            <td><b><?php echo $order->name; ?></b></td>
                            <td><?php echo $order->status_barang == null ? "menunggu pengiriman" : $order->status_barang; ?></td>
                            <td><?php echo $order->status_pembayaran; ?></td>
                            <td>$<?php echo $order->total; ?></td>
                            <td><?php echo $order->created_at; ?></td>
                             <td class="text-end">
                                <div class="dropdown">
                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="<?= base_url() ?>/order/acc/<?= $order->id; ?>">Terima</a>
                                        <a class="dropdown-item" href="#">Kirim Barang</a>
                                        <a class="dropdown-item text-danger" href="<?= base_url() ?>/order/ignore/<?= $order->id; ?>">Tolak</a>
                                    </div>
                                </div> <!-- dropdown //end -->
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
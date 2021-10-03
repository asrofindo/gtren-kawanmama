<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Produk Anda</h2>
        <!-- <p>Lorem ipsum dolor sit amet.</p> -->
    </div>
</div>
<div class="attention">
    <?php if(!empty(session()->getFlashdata('success'))){ ?>

        <div class="alert alert-success bg-success text-white">
            <?php echo session()->getFlashdata('success');?>
        </div>

    <?php } ?>

    <?php if(!empty(session()->getFlashdata('danger'))){ ?>

        <div class="alert alert-danger bg-danger text-white">
            <?php echo session()->getFlashdata('danger');?>
        </div>

    <?php } ?>
</div>
<div class="card mb-4">
    <header class="card-header">
        <div class="row align-items-center">
            <div class="col-md-12 col-12 me-auto mb-md-0 mb-3">
                <form method="POST" action="<?= base_url() ?>/products/search">
                <div class="row gx-3">
                    <div class="col-lg-3 col-md-2">
                        <input name="keyword" type="text" placeholder="Cari Produk..." class="form-control bg-white">
                    </div>
                    <div class="col-lg-6 col-md-2 me-auto">
                        <button type="submit" class="btn btn-primary btn-sm rounded">Cari</button>
                    </div>
                </div>
        </div>
    </header> <!-- card-header end// -->
    <div class="card-body">
    <div class="col-md-12">
                <div class="table">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th class="d-none d-sm-block">Harga Member Gtren</th>
                                <th >Harga Jual</th>
                                <th >Komisi Distributor</th>
                                <th >Stock Yang Anda Punya</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product): ?>
                            <tr>
                    
                                <td>
                                    <h6 class=""><?= $product->name ?></h6>
                                </td>
                                <td ><?= rupiah($product->fixed_price) ;?></td>
                                <td class="d-none d-sm-block"><?=  rupiah($product->sell_price); ?></td>
                                <td><?=  rupiah($product->stockist_commission); ?></td>
                                <td ><?= $product->jumlah?></td>
                                <td class="text-end">
                                    <div class="dropdown">
                                        <a href="#" data-bs-toggle="dropdown" class="btn btn-sm btn-light rounded font-sm"> <i class="material-icons md-more_vert"></i> </a>
                                        <div class="dropdown-menu">
                                            
                                            <a class="dropdown-item" href="<?= base_url('products/stockist/edit/'.$product->product_id)?>/<?= $product->d_id?>">Edit Stok</a>
                                            <a class="dropdown-item" href="<?= base_url('products/delete/stock/'.$product->product_id)?>">Hapus Stok</a>

                                        </div>
                                    </div> <!-- dropdown //end -->
                                </td>
                            </tr>
                                                           
                        <?php endforeach  ?>

                        </tbody>

                    </table>
                    <div class="pagination-area mt-30 mb-50">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-start">
                                <?php //$pager->links('users', 'product_pagination'); ?>
                                <!-- <li class="page-item active"><a class="page-link" href="#">01</a></li>
                                <li class="page-item"><a class="page-link" href="#">02</a></li>
                                <li class="page-item"><a class="page-link" href="#">03</a></li>
                                <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                                <li class="page-item"><a class="page-link" href="#">16</a></li>
                                <li class="page-item"><a class="page-link" href="#"><i class="material-icons md-chevron_right"></i></a></li> -->

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
    </div> <!-- card-body end// -->
</div> <!-- card end// -->
<div class="pagination-area mt-30 mb-50">
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-start">
            <?= $pager->links('products', 'product_pagination'); ?>
            <!-- <li class="page-item active"><a class="page-link" href="#">01</a></li>
            <li class="page-item"><a class="page-link" href="#">02</a></li>
            <li class="page-item"><a class="page-link" href="#">03</a></li>
            <li class="page-item"><a class="page-link dot" href="#">...</a></li>
            <li class="page-item"><a class="page-link" href="#">16</a></li>
            <li class="page-item"><a class="page-link" href="#"><i class="material-icons md-chevron_right"></i></a></li> -->

        </ul>
    </nav>
</div>
<?php $this->endSection() ?>
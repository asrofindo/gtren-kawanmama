<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
    <div class="row">
        <div class="col-lg-3">
            <div class="card card-body mb-4">
                <article class="icontext">
                    <span class="icon icon-sm rounded-circle bg-warning-light"><i class="text-warning material-icons md-qr_code"></i></span>
                    <div class="text">
                        <h6 class="mb-1 card-title">Link Affiliate</h6> 
                        <span><?= user()->affiliate_link ;?></span>

                    </div>
                </article>
            </div>
        </div>
    </div>
    <div class="card">
    <div class="card-header row">
            <h5>Untuk mengajak teman : </h5>
            <div class=" me-auto">
                <input onclick="copy_text('affiliate')" type="text" value="<?= base_url()."/src/".user()->id?>" id="affiliate" class="form-control" readonly />
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <header class="card-header">
        <div class="row align-items-center">
            <div class="col-md-12 col-12 me-auto mb-md-0 mb-3">
                <form method="POST" action="<?= base_url() ?>/market/affiliate">
                <div class="row gx-3">
                    <div class="col-lg-3 col-md-2">
                        <input name="keyword" type="text" placeholder="Cari Produk..." class="form-control">
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
                                <th class="">Fee Affiliate</th>
                                <th >Link Affiliate</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product): ?>
                            <tr>
                                <td>
                                    <h6 class=""><?= $product->name ?></h6>
                                </td>
                                <td ><?= rupiah($product->affiliate_commission) ;?></td>
                                <td > 
                                   <input type="text" value="<?=base_url()."/product/".$product->slug."/src/".user()->id?>" id="<?=$product->slug?>" class="form-control" readonly />
                                </td>
                                <td class="text-end">
                                        <a onclick="copy_text('<?=$product->slug?>')" class="btn btn-light rounded btn-sm font-sm"> Copy </a>
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
<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Data Produk</h2>
        <!-- <p>Lorem ipsum dolor sit amet.</p> -->
    </div>
    <div><!-- 
        <a href="#" class="btn btn-light rounded font-md">Export</a>
        <a href="#" class="btn btn-light rounded  font-md">Import</a> -->
        <?php if(in_groups(1)){ ?>
        <a href="<?= base_url() ?>/tambahproduk" class="btn btn-primary btn-sm rounded">Create new</a>
        <?php } ?>
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
       
    </header> <!-- card-header end// -->
    <div class="card-body">
    <div class="col-md-12">
                <div class="table">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    img
                                </th>
                                <th>product</th>
                                <th class="d-none d-sm-block">harga member</th>
                                <th >harga non member</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td class="text-center">
                                    <?php for($i = 0; $i < 1; $i++): ?>
                                        <img class="img-sm img-thumbnail" src="<?= $product->photos[$i] ?>" alt="">
                                    <?php endfor ?>
                                </td>
                                <td>
                                    <h6 class=""><?= $product->name ?></h6>
                                </td>
                                <td class="d-none d-sm-block"><?= $product->sell_price ?></td>
                                <td ><?= $product->fixed_price?></td>
          
                                <td class="text-end">
                                    <div class="dropdown">
                                        <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_vert"></i> </a>
                                        <div class="dropdown-menu">
                                        <a class="dropdown-item" href="<?= base_url('products/update/stock/'.$product->id)  ?>">Jual</a>
                                            <a class="dropdown-item" href="<?= base_url('products/edit/'.$product->id)  ?>">Edit info</a>
                                            <a class="dropdown-item text-danger" href="<?= base_url('products/delete/'.$product->id)  ?>">Delete</a>
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
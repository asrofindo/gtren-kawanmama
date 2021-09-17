<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Data Affiliate </h2>
    </div>
</div>
<div class="card">
    <div class="card-body">
   <!--  <form method="post" action="<?= base_url('/distributor/list') ?>">            
            <div class="row gx-3">
            <div class="col-lg-4 col-md-6 me-auto">
                <input type="text" placeholder="cari nama toko..." class="form-control" name="locate">
            </div>

            <div class="col-lg-2 col-6 col-md-3">
                <button type="submit" class="btn btn-info btn-sm w-100 m-1">Cari </button>
            </div>
        </form> -->
        <br>
        <br>

        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                             
                                <th>id</th>
                                <th>pemilik</th>
                                <th>Link Affiliate</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                             <?php foreach ($affiliate as $value): ?>

                            <tr>
                                <td class="id"><?= $value->id  ?></td>
                                <td ><?= $value->username  ?></td>
                                <td ><?= $value->affiliate_link  ?></td>
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
            </div> <!-- .col// -->
        </div> <!-- .row // -->
    </div> <!-- card body .// -->
</div> <!-- card .// -->
<div class="pagination-area mt-30 mb-50">
<!-- modal -->

<?php $this->endSection() ?>

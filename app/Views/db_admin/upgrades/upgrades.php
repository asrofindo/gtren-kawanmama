
<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>

<div class="content-header">
    <div>
        <h2 class="content-title card-title">upgrade </h2>
        <p>Add, edit or delete a upgrade</p>
    </div>
    <div>
        <form action="<?= base_url('upgrades/search') ?>" method="post" class="row row-cols-lg-auto g-3 align-items-center">
            <div class="col-12">
                <input type="text" placeholder="Cari account" class="form-control bg-white" name="keyword">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">
                    Cari
                </button>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-body">

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

        <div class="row">

            <div class="col-md-12">
                <div class="table-responsive">
                    
                        <table class="table table-hover">
                            <thead>
                                <tr>   
                                    <th>Bukti TF</th>
                                    <th>Name</th> 
                                    <th>status</th>
                                    <th>type</th>
                                    <th>Affiliate Link</th>
                                    <th>Bank Transfer</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($upgrades as $upgrade): ?>  
		                            <tr>
                                        <td><img style="width:100px; height:80px" class="w-10 d-inline-block p-0" src="<?= base_url()  ?>/uploads/bukti/<?= $upgrade->photo ?>"></td>
		                                <td><b><?= $upgrade->username ?></b></td>
                                        <?php if($upgrade->status_request == 'pending'): ?>
                                            <td><b class="badge rounded-pill alert-warning"><?= $upgrade->status_request ?></b></td>
                                        <?php else: ?>
                                            <td><b class="badge rounded-pill alert-success"><?= $upgrade->status_request ?></b></td>
                                        <?php endif; ?>
                                        <td><b><?= $upgrade->type ?></b></td>
                                        <td><b><?= $upgrade->affiliate_link ?></b></td>
                                        <td><b><?= $upgrade->bank_name ?> - <?= $upgrade->owner ?></b></td>
		                                <td><b><?= rupiah($upgrade->total) ?></b></td>
		                                <td>
                                            <?php if($upgrade->status_request == 'pending'): ?>
		                                    <a href="<?= base_url('upgrades/update/'.$upgrade->id) ?>" class="btn btn-brand rounded btn-sm font-sm">
		                                        <i class="material-icons"></i>
		                                        Verifikasi
		                                    </a>
                                            <?php else: ?>
                                            <a class="btn btn-brand rounded btn-sm font-sm">
                                                <i class="material-icons"></i>
                                                Verified
                                            </a>
                                            <?php endif; ?>
		                                  
		                                </td>
		                            </tr>
	                            <?php endforeach ?>
                            </tbody>
                        </table>
                   
                </div>
                            <div class="pagination-area mt-30 mb-50">
							    <nav aria-label="Page navigation example">
							        <ul class="pagination justify-content-start">
							            <?= $pager->links('upgrades', 'product_pagination'); ?>
							            <!-- <li class="page-item active"><a class="page-link" href="#">01</a></li>
							            <li class="page-item"><a class="page-link" href="#">02</a></li>
							            <li class="page-item"><a class="page-link" href="#">03</a></li>
							            <li class="page-item"><a class="page-link dot" href="#">...</a></li>
							            <li class="page-item"><a class="page-link" href="#">16</a></li>
							            <li class="page-item"><a class="page-link" href="#"><i class="material-icons md-chevron_right"></i></a></li> -->

							        </ul>
							    </nav>
							</div>
            </div> <!-- .col// -->
        </div> <!-- .row // -->
    </div> <!-- card body .// -->
</div> <!-- card .// -->

<?php $this->endSection() ?>
<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
offer
<div class="content-header">
    <div>
        <h2 class="content-title card-title">offer </h2>
        <p>Add, edit or delete a offer</p>
    </div>
    <div>
        <form action="<?= base_url('offer/search') ?>" method="post" class="row row-cols-lg-auto g-3 align-items-center">
            <div class="col-12">
                <input type="text" placeholder="Cari offer" class="form-control bg-white" name="keyword">
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
            <div class="col-md-3">

                    <h4>Tambah offer</h4>
                    <hr>
                    <form action="<?= base_url('offer') ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-4">
                            <label for="offer" class="form-label">Title</label>
                            <input type="text" placeholder="Type here" name="title" class="form-control" id="offer" />
                        </div>
                         <div class="mb-4">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" placeholder="Type here" name="description" class="form-control" id="description" />
                        </div>
                        <div class="mb-4">
                            <label for="photo" class="form-label">Photo</label>
                            <input type="file" placeholder="Type here" name="photo" class="form-control" id="photo" />
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary" type="submit">Simpan Data</button>
                        </div>
                    </form>       
          
            </div>
            <div class="col-md-9">
                <div class="table-responsive">
                    
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="80">Photo</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($offers as $offer): ?>           
		                            <tr>
		                                <td><img class="w-10 d-inline-block p-0" src="<?= base_url()  ?>/uploads/offer/<?= $offer->photo ?>"></td>
		                                <td><b><?= $offer->title ?></b></td>
		                                <td><b><?= $offer->description ?></b></td>
		                                <td>
		                                    <a href="<?= base_url('offer/edit/'.$offer->id) ?>" class="btn btn-brand rounded btn-sm font-sm">
		                                        <i class="material-icons md-edit"></i>
		                                        Edit
		                                    </a>
		                                    <a href="<?= base_url('offer/delete/'.$offer->id) ?>" class="btn btn-light btn-sm font-sm rounded">
		                                        <i class="material-icons md-delete_forever"></i>
		                                        Hapus
		                                    </a>
		                                </td>
		                            </tr>
	                            <?php endforeach ?>
                            </tbody>
                        </table>
                   
                </div>
                            <div class="pagination-area mt-30 mb-50">
							    <nav aria-label="Page navigation example">
							        <ul class="pagination justify-content-start">
							            <?= $pager->links('offers', 'product_pagination'); ?>
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
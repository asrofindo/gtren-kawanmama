<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Perusahaan </h2>
        <p>Add, edit or delete a perusahaan</p>
    </div>
    <div>
        <form action="<?= base_url('factory/search') ?>" method="post" class="row row-cols-lg-auto g-3 align-items-center">
            <div class="col-12">
                <input value="<?= $profile->title ?>" type="text" placeholder="Cari Perusahaan" class="form-control bg-white" name="keyword">
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

                    <h4>Update Perusahaan</h4>
                    <hr>

                    <form action="<?= base_url('factory/update') ?>/<?= $profile->id ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-4">
                            <label for="profile" class="form-label">Nama Perusahaan</label>
                            <input value="<?= $profile->title ?>" type="text" placeholder="Type here" name="title" class="form-control" id="profile" />
                        </div>
                        <div class="mb-4">
                            <label for="favicon" class="form-label">Favicon</label>
                            <img class="w-10 d-inline-block p-0" style="width: 100px;" src="<?= base_url()  ?>/uploads/banner/<?= $profile->favicon ?>">
                            <input value="<?= $profile->favicon ?>" type="file" placeholder="Type here" name="favicon" class="form-control" id="favicon" />
                        </div>
                        <div class="mb-4">
                            <label for="photo" class="form-label">Logo</label>
                            <img class="w-10 d-inline-block p-0" style="width: 100px;" src="<?= base_url()  ?>/uploads/banner/<?= $profile->photo ?>">
                            <input value="<?= $profile->photo ?>" type="file" placeholder="Type here" name="photo" class="form-control" id="photo" />
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary" type="submit">Ubah Data</button>
                        </div>
                    </form>       
          
            </div>
            <div class="col-md-9">
                <div class="table-responsive">
                    
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="80">Logo</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Favicon</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
		                            <tr>
                                        <td><img class="w-10 d-inline-block p-0" style="width: 100px; height: 100px" src="<?= base_url()  ?>/uploads/banner/<?= $profile->photo ?>"></td>
		                                <td><b><?= $profile->title ?></b></td>
		                                <td><img class="w-10 d-inline-block p-0" style="width: 100px;" src="<?= base_url()  ?>/uploads/banner/<?= $profile->favicon ?>"></td>
		                                <td>
		                                    <a href="<?= base_url('factory/edit/'.$profile->id) ?>" class="btn btn-brand rounded btn-sm font-sm">
		                                        <i class="material-icons md-edit"></i>
		                                        Edit
		                                    </a>
		                                    <a href="<?= base_url('factory/delete/'.$profile->id) ?>" class="btn btn-light btn-sm font-sm rounded">
		                                        <i class="material-icons md-delete_forever"></i>
		                                        Hapus
		                                    </a>
		                                </td>
		                            </tr>
                            </tbody>
                        </table>
                   
                </div>
            </div> <!-- .col// -->
        </div> <!-- .row // -->
    </div> <!-- card body .// -->
</div> <!-- card .// -->

<?php $this->endSection() ?>
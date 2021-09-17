<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Tambah Api Key </h2>
        <p>Add, edit or delete a Api key</p>
    </div>
    <div>
        <form action="<?= base_url('offer/search') ?>" method="post" class="row row-cols-lg-auto g-3 align-items-center">
            <div class="col-12">
                <input type="text" placeholder="Cari Api" class="form-control bg-white" name="keyword">
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

                <h4>Tambah Api Key</h4>
                <hr>
                <form action="<?= base_url('setting') ?>/api/edit" method="post" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label for="offer" class="form-label">Nama </label>
                        <input value="<?= $apis->name; ?>" type="text" placeholder="Tulis Disini" name="nama" class="form-control" id="offer" />
                        <input value="<?= $apis->id; ?>" type="hidden" placeholder="Tulis Disini" name="id" class="form-control" id="offer" />
                    </div>
                     <div class="mb-4">
                        <label for="description" class="form-label">Token</label>
                        <input value="<?= $apis->token; ?>" type="text" placeholder="Tulis Disini" name="token" class="form-control" id="description" />
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
                                    <th>Nama</th>
                                    <th>Token</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td><b><?= $apis->name ?></b></td>
                                        <td><b><?= $apis->token ?></b></td>
                                        <td>
                                            <a href="<?= base_url('apis/edit/'.$apis->id) ?>" class="btn btn-brand rounded btn-sm font-sm">
                                                <i class="material-icons md-edit"></i>
                                                Edit
                                            </a>
                                            <a href="<?= base_url('apis/delete/'.$apis->id) ?>" class="btn btn-light btn-sm font-sm rounded">
                                                <i class="material-icons md-delete_forever"></i>
                                                Hapus
                                            </a>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                   
                </div>
            </div>
           <!-- .col// -->
        </div> <!-- .row // -->
    </div> <!-- card body .// -->
</div> <!-- card .// -->

<?php $this->endSection() ?>
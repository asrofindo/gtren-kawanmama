<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
Pengaturan Notifikasi Admin
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Pengaturan Notifikasi Admin </h2>
        <p>Masukan nomer untuk notifikasi Whatsapp</p>
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
                    <h4>Tambah Kontak</h4>
                    <hr>
                    <form action="<?= base_url('notifikasi') ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-4">
                            <label for="contact" class="form-label">name</label>
                            <input type="text" placeholder="Type here" name="name" class="form-control" id="contact" />
                        </div>
                    <div class="mb-4">
                            <label for="contact" class="form-label">phone</label>
                            <input type="text" placeholder="Type here" name="phone" class="form-control" id="contact" />    
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
                                    <th>name</th>
                                    <th>phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($contacts as $key => $value): ?>           
		                            <tr>
                                        <td><b><?= $value['name'] ?></b></td>
		                                <td><b><?= $value['phone'] ?></b></td>
		                                <td>
		                                    <a href="<?= base_url('notifikasi/delete/'.$value['id'] ) ?>" class="btn btn-light btn-sm font-sm rounded">
		                                        <i class="material-icons md-delete_forever"></i>
		                                        Hapus
		                                    </a>
		                                </td>
		                            </tr>
	                            <?php endforeach ?>
                            </tbody>
                        </table>
                   
                </div>

            </div> <!-- .col// -->
        </div> <!-- .row // -->
    </div> <!-- card body .// -->
</div> <!-- card .// -->

<?php $this->endSection() ?>
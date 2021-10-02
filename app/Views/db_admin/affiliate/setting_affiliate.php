<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Setting affiliate </h2>
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

                    <h4>setting affiliate</h4>
                    <hr>
                    <?php if($settings == null): ?>
                        <form action="<?= base_url('setting/affiliate/add') ?>" method="post" enctype="multipart/form-data">
                             <div class="mb-4">
                                <label  for="description" class="form-label">Biaya Affiliate</label>
                                <input type="text" placeholder="Tulis Disini" name="minimal" class="form-control" id="description" />
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-primary" type="submit">Simpan Data</button>
                            </div>
                        </form>   
                    <?php endif; ?>    
          
            </div>
            <div class="col-md-9">
                <div class="table-responsive">     
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Biaya affiliate</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($settings as $setting): ?>           
	                            <tr>
	                                <td><b>Rp. <?= number_format($setting->minimal); ?></b></td>
	                                <td>
	                                    <a href="<?= base_url('affiliate//edit/'.$setting->id) ?>" class="btn btn-brand rounded btn-sm font-sm">
	                                        <i class="material-icons md-edit"></i>
	                                        Edit
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
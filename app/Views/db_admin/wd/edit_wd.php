<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">setting WD</h2>
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

                    <h4>setting wd</h4>
                    <hr>

                    <form action="<?= base_url('setting/wd/edit') ?>" method="post" enctype="multipart/form-data">
                         <div class="mb-4">
                            <label for="description" class="form-label">Minimal Withdraw</label>
                            <input type="hidden" name="id" value="<?php echo $setting->id ?>">
                            <textarea value="<?= $setting->minimal ?>" type="text" placeholder="Type here" name="minimal" class="form-control" id="description" /><?= $setting->minimal ?></textarea>
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
                                    <th>Minimal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
		                            <tr>
		                                <td><b><?= number_format($setting->minimal) ?></b></td>
		                                <td>
		                                    <a href="<?= base_url('setting/edit/'.$setting->id) ?>" class="btn btn-brand rounded btn-sm font-sm">
		                                        <i class="material-icons md-edit"></i>
		                                        Edit
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


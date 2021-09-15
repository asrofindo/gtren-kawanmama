<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Rekening Admin</h2>
        <p>Add, edit or delete a Rekening</p>
    </div>
    <div>
        <form method="post" action="<?= base_url('bill/search') ?>">            
            <input type="text" placeholder="Search Bank Name" class="form-control bg-white" name="keyword">
        </form>
    </div>
</div>

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
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">

        <?php if (isset($bill)): ?>
            <form method="POST" action="<?= base_url('bills/update/'.$bill->id) ?>" class="my-3">
                <div class="form-group">
                    <label>Nama Bank</label>
                    <?php if(isset(session('errors')['bank_name'])): ?>

                        <input type="text" name="bank_name" value="<?= old('bank_name') ?? $bill->bank_name ?>" class="form-control is-invalid">
                        <div class="invalid-feedback">
                            <?= session('errors')['bank_name'] ?>
                        </div>
                    <?php else: ?>
                        <input type="text" name="bank_name" value="<?= old('bank_name') ?? $bill->bank_name ?>" class="form-control">
                    <?php endif ?>
                </div>
                <div class="form-group">
                    <label>Nomor Rekening</label>
                    <?php if(isset(session('errors')['bank_number'])): ?>
                        <input type="text" name="bank_number" value="<?= old('bank_number') ?? $bill->bank_number ?>" class="form-control is-invalid">
                        <div class="invalid-feedback"><?= session('errors')['bank_number'] ?></div>
                    <?php else: ?>
                        <input type="text" name="bank_number" value="<?= old('bank_number') ?? $bill->bank_number ?>" class="form-control">
                    <?php endif ?>
                </div>
                <div class="form-group">
                    <label>Nama Pemilik Rekening</label>
                    <?php if(isset(session('errors')['owner'])): ?>
                        <input type="text" name="owner" value="<?= old('owner') ?? $bill->owner ?>" class="form-control is-invalid">
                        <div class="invalid-feedback"><?= session('errors')['owner'] ?></div>
                    <?php else: ?>
                        <input type="text" name="owner" value="<?= old('owner') ?? $bill->owner ?>" class="form-control">
                    <?php endif ?>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary mt-3">Update</button>
                </div>
            </form>
        <?php else: ?>
            <form method="POST" class="my-3">
                <div class="form-group">
                    <label>Nama Bank</label>
                <?php if(isset(session('errors')['bank_name'])): ?>
                    <input type="text" name="bank_name" value="<?= old('bank_name') ?>" class="form-control is-invalid">
                    <div class="invalid-feedback"><?= session('errors')['bank_name'] ?></div>
                <?php else: ?>
                    <input type="text" name="bank_name" value="<?= old('bank_name') ?>" class="form-control">
                <?php endif ?>
                </div>
                <div class="form-group">
                    <label>Nomor Rekening</label>
                    <?php if(isset(session('errors')['bank_number'])): ?>
                    <input type="number" name="bank_number" value="<?= old('bank_number') ?>" class="form-control is-invalid">
                    <div class="invalid-feedback"><?= session('errors')['bank_number'] ?></div>
                <?php else: ?>
                    <input type="number" name="bank_number" value="<?= old('bank_number') ?>" class="form-control">
                    <?php endif ?>
                </div>
                <div class="form-group">
                    <label>Nama Pemilik Rekening</label>
                    <?php if(isset(session('errors')['owner'])): ?>
                    <input type="text" name="owner" value="<?= old('owner') ?>" class="form-control is-invalid">
                    <div class="invalid-feedback"><?= session('errors')['owner'] ?></div>
                <?php else: ?>
                    <input type="text" name="owner" value="<?= old('owner') ?>" class="form-control">
                <?php endif ?>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary mt-3">Save</button>
                </div>
            </form>
        <?php endif ?>

            </div>
            <div class="col-md-9">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-stripped">

            <thead>
                <tr>
                    <th>Nama Bank</th>
                    <th>Nomor Rekening</th>
                    <th>Nama Pemilik</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php if (isset($bill)): ?>
                        <tr>
                            <td><?= $bill->bank_name ?></td>
                            <td><?= $bill->bank_number ?></td>
                            <td><?= $bill->owner ?></td>
                            <td><?= $bill->total ?></td>
                            <td>
                                <a class="btn btn-light rounded btn-sm font-sm" href="<?= base_url('bills/edit/'.$bill->id) ?>">Edit</a> 
                            </td>
                        </tr>
                
                <?php else: ?>
                    <?php $no = 1; foreach($bills as $bill):  ?>
                        <tr>
                            <td><?= $bill->bank_name ?></td>
                            <td><?= $bill->bank_number ?></td>
                            <td><?= $bill->owner ?></td>
                            <td><?= $bill->total ?></td>
                            
                            <td>
                                <a class="btn btn-light rounded btn-sm font-sm" href="<?= base_url('bills/edit/'.$bill->id) ?>">Edit</a> 
                            </td>
                        </tr>
                    <?php endforeach;  ?>
                <?php endif ?>
            </tbody>
            
        </table>
                </div>
            </div> <!-- .col// -->
        </div> <!-- .row // -->
    </div> <!-- card body .// -->
</div> <!-- card .// -->

<?php $this->endSection() ?>
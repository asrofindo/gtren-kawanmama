<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Saldo Tabungan</h2>
        <?php if(count($pendapatan) == 0): ?>
            <p>Rp 0</p>
        <?php else: ?>
            <p><?= rupiah($pendapatan[0]->total); ?></p>
        <?php endif; ?>
    </div>

</div>
<div class="content-header" style="justify-content: left; ">
     <div>
        <h5 class="content-title card-title"> Affiliate</h5>
        <?php if(count($pendapatan_affiliate) == 0): ?>
            <p>Rp 0</p>
        <?php else: ?>
            <p><?= rupiah($pendapatan_affiliate[0]->total); ?></p>
        <?php endif; ?>
    </div>
</div>
<?php if(in_groups(3)): ?>
    <div class="content-header" style="justify-content: left; ">
         <div>
            <h5 class="content-title card-title"> Distributor</h5>
            <?php if(count($pendapatan_stockist) == 0): ?>
                <p>Rp 0</p>
            <?php else: ?>
                <p><?= rupiah($pendapatan_stockist[0]->total); ?></p>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
<?php if(!empty(session()->getFlashdata('danger'))){ ?>

    <div class="alert alert-success bg-danger text-white">
        <?php echo session()->getFlashdata('danger');?>
    </div>

<?php } ?>
<?php if(!empty(session()->getFlashdata('success'))){ ?>

    <div class="alert alert-success bg-success text-white">
        <?php echo session()->getFlashdata('success');?>
    </div>

<?php } ?>
<div class="row">
    <div class="card mb-4 col-md-12">
        <div class="row m-2">
            <form method="post" action="<?php base_url() ?>/request/otp">
                    <button type="submit" class="btn btn-primary btn-sm rounded">Request Kode OTP</button>
            </form>
        </div>
        <header class="card-header">
            <form method="POST" action="<?= base_url() ?>/request/wd">
                <div class="row gx-3">
                        <div class="col-lg-3 col-md-2">
                            <input name="jumlah_wd" type="number" placeholder="Masukan Nominal Dana" class="form-control">
                        </div>
                        <div class="col-lg-3 col-md-2">
                            <input name="otp" type="number" placeholder="Masukan Kode OTP" class="form-control">
                        </div>
                        <div class="col-lg-3 col-md-2">
                            <select class="form-control" name="status_dana">
                                <option disabled selected class="form-control">Pilih Jenis Tabungan</option>
                                <option value="affiliate" class="form-control">Affiliate</option>
                                <?php if(in_groups(3)): ?><option value="distributor" class="form-control">Distributor</option><?php endif; ?>
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-2 me-auto">
                            <button type="submit" class="btn btn-primary btn-sm rounded">Tarik</button>
                        </div>
                </div>
            </form>
        </header> <!-- card-header end// -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th scope="col">Jumlah Diminta</th>
                            <th scope="col">Tanggal Permintaan</th>
                            <th scope="col">Status Pencairan</th>
                            <th scope="col">Jenis Tabungan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($wds as $wd): ?>  
                            <tr>
                                <td><b><?= $wd['id'] ?></b></td>
                                <td><b><?= $wd['jumlah_wd'] ?></b></td>
                                <td><b><?= $wd['created_at'] ?></b></td>
                                <td>
                                    <?php if($wd['status'] == 'sudah'): ?>
                                        <b><span class="badge rounded-pill alert-success"><?= $wd['status'] ?></span></b>
                                    <?php else: ?>
                                        <b><span class="badge rounded-pill alert-warning"><?= $wd['status'] ?></span></b>
                                    <?php endif; ?>
                                </td>
                                <td><b><?= $wd['status_dana'] ?></b></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div> <!-- table-responsive //end -->
        </div> <!-- card-body end// -->
    </div>
</div>
<?php $this->endSection() ?>
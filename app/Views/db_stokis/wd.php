<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Saldo Tabungan</h2>
        <p>Rp <?= $pendapatan; ?></p>
    </div>
    <div>
        <input type="text" placeholder="Search pendapatan ID" class="form-control bg-white">
    </div>
</div>
<div class="row">
    <div class="card mb-4 col-md-12">
        <header class="card-header">
            <form method="POST" action="<?= base_url() ?>/request/wd">
                <div class="row gx-3">
                        <div class="col-lg-3 col-md-2">
                            <input name="jumlah_wd" type="text" placeholder="Masukan Nominal Dana" class="form-control bg-white">
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
                            <th scope="col">Jumlah Wd</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($wds as $wd): ?>  
                            <tr>
                                <td><b><?= $wd['id'] ?></b></td>
                                <td><b><?= $wd['jumlah_wd'] ?></b></td>
                                <td><b><?= $wd['created_at'] ?></b></td>
                                <td><b><?= $wd['status'] ?></b></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div> <!-- table-responsive //end -->
        </div> <!-- card-body end// -->
    </div>
</div>
<?php $this->endSection() ?>
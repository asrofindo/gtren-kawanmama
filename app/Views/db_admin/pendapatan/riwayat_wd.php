<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Riwayat Withdraw</h2>
    </div>
</div>
<div class="row">
    <div class="card mb-4 col-md-12">
        <header class="card-header">
            <form method="POST" action="<?= base_url() ?>/request/wd">
                <div class="row gx-3">
                        <div class="col-lg-3 col-md-2">
                            <input type="text" placeholder="Cari" class="form-control bg-white">
                        </div>
                        <div class="col-lg-2 col-md-2 me-auto">
                            <button type="submit" class="btn btn-primary btn-sm rounded">Pencarian</button>
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
                            <th scope="col">Nama</th>
                            <th scope="col">Jumlah Wd</th>
                            <th scope="col">Status Dana</th>
                            <th scope="col">Status</th>
                            <th scope="col">Bank</th>
                            <th scope="col">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($wds as $wd): ?>  
                            <tr>
                                <td><b><?= $wd['id'] ?></b></td>
                                <td><b><?= $wd['username'] ?></b></td>
                                <td><b><?= rupiah($wd['jumlah_wd']) ?></b></td>
                                <td><b><?= $wd['status_dana'] ?></b></td>
                                <td><b><?= $wd['status_wd'] ?></b></td>
                                <td><b><?= $wd['bank_name'] ?> - <?= $wd['owner'] ?></b></td>
                                <td><b><?= $wd['created_at'] ?></b></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div> <!-- table-responsive //end -->
        </div> <!-- card-body end// -->
    </div>
</div>
<?php $this->endSection() ?>
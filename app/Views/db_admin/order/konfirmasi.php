<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Konfirmasi Pembayaran </h2>
    </div>
</div>
<div class="card mb-4">
    <header class="card-header">
        <div class="row gx-3">
            <form method="POST" action="<?= base_url() ?>/admin/konfirmasi">
                <div class="row gx-3">
                        <div class="col-lg-3 col-md-2">
                            <input type="text" placeholder="Cari nama..." class="form-control" name="name">
                        </div>
                        <div class="col-lg-2 col-md-2 me-auto">
                            <button type="submit" class="btn btn-primary btn-sm rounded">Pencarian</button>
                        </div>
                </div>
        </div>
    </header> <!-- card-header end// -->
    <div class="card-body">
            </form>
        <div class="table-responsive">
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th scope="col">Nomor Transaksi</th>
                        <th scope="col">Nama Pengirim</th>
                        <th scope="col">Tujuan Rekening</th>
                        <th scope="col">Tanggal Transfer</th>
                        <th scope="col">Jumlah Transfer</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col" class="text-end"> Aksi </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($konfirmasi as $value) {?>
                        <tr>
                            <td><?= $value->transaksi_id; ?></td>
                            <td><b><?= $value->name?></b></td>
                            <td><b><?= $value->bill?></b></td>
                            <td><b><?= $value->date?></b></td>
                            <td><?= $value->total ?></td>
                            <td><?= $value->keterangan ?></td>
                            <td class="text-end">
                            <div class="dropdown">
                                        <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                        <div class="dropdown-menu">
                                        <a class="dropdown-item" href="<?=base_url()?>/konfirmasi/delete/<?=$value->id?>">Hapus</a>
                                       </div>
                                    </div>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div> <!-- table-responsive //end -->
    </div> <!-- card-body end// -->
</div> <!-- card end// -->

<?php $this->endSection() ?>
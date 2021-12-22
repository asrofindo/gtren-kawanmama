<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Tambah Payment Channels </h2>
        <p>Add, edit or delete a Payment Channels</p>
    </div>
    <div>
        <form action="<?= base_url('offer/search') ?>" method="post" class="row row-cols-lg-auto g-3 align-items-center">
            <div class="col-12">
                <input type="text" placeholder="Cari channel" class="form-control bg-white" name="keyword">
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

                <h4>Tambah Payment Channels</h4>
                <hr>
                <form action="<?= base_url('setting') ?>/channels/add" method="post" enctype="multipart/form-data">
                    <div class="mb-4"  style="height: 400px; overflow: auto;">
                        <label for="offer" class="form-label">Pilih Untuk Mengaktifkan </label>
                        <?php foreach ($payment_channels as $key => $value): ?>  
                            <div class="d-flex w-100 flex-row justify-content-space-around align-items-center">
                                <input id="form-control" class="border" style="margin-right: 10px; padding:20px" type="radio" name="payment_channel" value="<?= $value['channel_code'] ?>" />
                                <img class="w-25 d-block mr-4" src="<?= base_url() ?>/payment/<?= $value['channel_code'] ?>.png">
                            </div>
                            <h5 class="mb-4">
                                <label for="img">
                                    <?= $value['channel_code'] ?>
                                </label> 
                            </h5>
                        <?php endforeach ?>
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
                                    <th>IMG</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="connectedSortable" id="table">
                                <?php foreach ($channels as $key => $channel): ?>
                                    <tr style="cursor: move;" class="drag">
                                        <td><b><?= $channel['name'] ?></b></td>
                                        <td>
                                            <img style="width: 50px" class="d-block mr-4" src="<?= base_url() ?>/payment/<?= $channel['channel_code'] ?>.png">
                                        </td>
                                        <td>
                                            <a href="<?= base_url('channels/delete/'.$channel['id']) ?>" class="btn btn-light btn-sm font-sm rounded">
                                                <i class="material-icons md-delete_forever"></i>
                                                Hapus
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                   
                </div>
            </div>
           <!-- .col// -->
        </div> <!-- .row // -->
    </div> <!-- card body .// -->
</div> <!-- card .// -->

<?php $this->endSection() ?>
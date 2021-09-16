<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Sosial Media Perusahaan </h2>
    </div>
</div>
<div class="card mb-4">
    <header class="card-header">
        <div class="row gx-3">
            <form method="POST" action="<?= base_url() ?>/sosial">
                <div class="row gx-3">
                        <div class="col-lg-3 col-md-2">
                        <select class="form-select"  name="name">
                            <option>facebook</option>
                            <option>instagram</option>
                            <option>youtube</option>
                            <option>twitter</option>
                        </select>
                        </div>
                        <div class="col-lg-3 col-md-2">
                            <input type="text" placeholder="link" class="form-control" name="link">
                        </div>
                        
                        <div class="col-lg-2 col-md-2 me-auto">
                            <button type="submit" class="btn btn-primary btn-sm rounded">Tambah</button>
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
                        <th scope="col">sosial media</th>
                        <th scope="col">link</th>
                        <th scope="col" class="text-end"> Aksi </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sosial as $key =>$value) {?>
                        <tr>
                            <td><?= $value->name; ?></td>
                            <td><b><?= $value->link?></b></td>
                            <td class="text-end">
                            <div class="dropdown">
                                        <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                        <div class="dropdown-menu">
                                        <a class="dropdown-item" href="<?=base_url()?>/sosial/delete/<?=$value->id?>">Hapus</a>
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
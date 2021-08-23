<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Daftar Kategori Produk </h2>
        <!-- <p>Add, edit or delete a category</p> -->
    </div>
    <div>
        <form action="<?= base_url('category/search') ?>" method="post" class="row row-cols-lg-auto g-3 align-items-center">
            <div class="col-12">
                <input type="text" placeholder="Cari Kategori" class="form-control bg-white" name="keyword">
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
                <?php if (isset($category)): ?>
                    <h4>Edit Kategori</h4>
                    <hr>
                    <form action="<?= base_url('category/update/'.$category->id) ?>" method="post">
                        <div class="mb-4">
                            <label for="category" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" name="category" id="category" value="<?= $category->category ?>" />
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea type="text" class="form-control" name="description" id="category" value="<?= $category->description ?>"><?= $category->description ?></textarea>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary" type="submit">Simpan Data</button>
                        </div>
                    </form>
                <?php else: ?>
                    <h4>Tambah Kategori</h4>
                    <hr>
                    <form action="<?= base_url('category/save') ?>" method="post">
                        <div class="mb-4">
                            <label for="category" class="form-label">Nama Kategori</label>
                            <input type="text" placeholder="Type here" name="category" class="form-control" id="category" />
                            <label for="category" class="form-label">Deskripsi</label>
                            <textarea type="text" placeholder="Type here" name="description" class="form-control" id="description" /></textarea>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary" type="submit">Simpan Data</button>
                        </div>
                    </form>       
                <?php endif ?>               
            </div>
            <div class="col-md-9">
                <div class="table-responsive">
                    <?php if (isset($category)): ?>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><b><?= $category->category ?></b></td>
                                    <td><b><?= $category->description ?></b></td>
                                    <td>
                                        <a href="<?= base_url('category/edit/'.$category->id) ?>">
                                            <button class="btn btn-primary rounded">
                                                <i class="material-icons md-edit"></i>
                                                Edit
                                            </button>
                                        </a>
                                        <a href="<?= base_url('category/delete/'.$category->id) ?>">
                                            <button class="btn rounded">
                                                <i class="material-icons md-delete"></i>
                                                Hapus
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                    
                            </tbody>
                        </table>
                    <?php else: ?>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($categories as $category): ?>
                                    
                                <tr>
                                    <td><b><?= $category->category ?></b></td>
                                    <td><b><?= $category->description ?></b></td>
                                    <td>
                                        <a href="<?= base_url('category/edit/'.$category->id) ?>" class="btn btn-brand rounded btn-sm font-sm">
                                            <i class="material-icons md-edit"></i>
                                            Edit
                                        </a>
                                        <a href="<?= base_url('category/delete/'.$category->id) ?>" class="btn btn-light btn-sm font-sm rounded">
                                            <i class="material-icons md-delete_forever"></i>
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                                    
                            </tbody>
                        </table>
                    <?php endif ?>
                </div>
            </div> <!-- .col// -->
        </div> <!-- .row // -->
    </div> <!-- card body .// -->
</div> <!-- card .// -->

<?php $this->endSection() ?>
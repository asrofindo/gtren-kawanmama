<?php $this->extend('dashboard') ?>

<?php $this->section('content') ?>

<form action="<?= base_url('/tambahproduk') ?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-9">
            <div class="content-header">
                <h2 class="content-title">Tambah Produk</h2>
                <div>
                    <button class="btn btn-light rounded font-sm mr-5 text-body hover-up">Save to draft</button>
                    <button type="submit" class="btn btn-md rounded font-sm hover-up">Publikasikan</button>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <?php if (! empty($errors)) : ?>
                <div class="alert bg-danger text-white">
                <?php foreach ($errors as $field => $error) : ?>
                    <p><?= $error ?></p>
                <?php endforeach ?>
                </div>
            <?php endif ?>
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Basic</h4>
                </div>
                <div class="card-body">
                        <div class="mb-4">
                            <label for="product_name" class="form-label">Nama Produk</label>
                            <?php if(isset(session('errors')['name'])): ?>
                                <input name="name" type="text" placeholder="Tulis Disini" class="is-invalid form-control" id="product_name">
                                <div class="invalid-feedback">
                                    <?= session('errors')['name'] ?>
                                </div>
                            <?php else: ?>
                                <input name="name" type="text" placeholder="Tulis Disini" class="form-control" id="product_name">
                            <?php endif ?>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Deskripsi</label>
                            <?php if(isset(session('errors')['description'])): ?>
                                <textarea name="description" id="summernote" placeholder="Tulis Disini" class="is-invalid form-control" rows="4"></textarea>
                                <div class="invalid-feedback">
                                    <?= session('errors')['description'] ?>
                                </div>
                            <?php else: ?>
                                <textarea name="description" id="summernote" placeholder="Tulis Disini" class="form-control" rows="4"></textarea>
                            <?php endif ?>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label class="form-label">Harga Pokok</label>
                                    <div class="row gx-2">
                                        <?php if(isset(session('errors')['fixed_price'])): ?>
                                            <input name="fixed_price" placeholder="Rp" type="number" class="form-control is-invalid">
                                            <div class="invalid-feedback">
                                                <?= session('errors')['fixed_price'] ?>
                                            </div>
                                        <?php else: ?>
                                            <input name="fixed_price" placeholder="Rp" type="number" class="form-control">
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label class="form-label">Harga Jual</label>
                                    <?php if(isset(session('errors')['sell_price'])): ?>
                                        <input name="sell_price" placeholder="Rp" type="number" class="form-control is-invalid">
                                        <div class="invalid-feedback">
                                            <?= session('errors')['sell_price'] ?>
                                        </div>
                                    <?php else: ?>
                                        <input name="sell_price" placeholder="Rp" type="number" class="form-control">
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label class="form-label">Komisi Affiliate</label>
                                    <?php if(isset(session('errors')['affiliate_commission'])): ?>
                                        <input name="affiliate_commission" type="number" placeholder="Rp" class="form-control is-invalid" id="product_name">
                                        <div class="invalid-feedback">
                                            <?= session('errors')['affiliate_commission'] ?>
                                        </div>
                                    <?php else: ?>
                                        <input name="affiliate_commission" type="number" placeholder="Rp" class="form-control" id="product_name">
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label class="form-label">Komisi Distributor</label>
                                    <?php if(isset(session('errors')['stockist_commission'])): ?>
                                        <input name="stockist_commission" type="number" placeholder="Rp" class="form-control is-invalid" id="product_name">
                                        <div class="invalid-feedback">
                                            <?= session('errors')['stockist_commission'] ?>
                                        </div>
                                    <?php else: ?>
                                        <input name="stockist_commission" type="number" placeholder="Rp" class="form-control" id="product_name">
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label class="form-label">Berat Produk</label>
                                    <?php if(isset(session('errors')['weight'])): ?>
                                        <input name="weight" type="number" placeholder="gram" class="form-control is-invalid" id="product_name">
                                        <div class="invalid-feedback">
                                            <?= session('errors')['weight'] ?>
                                        </div>
                                    <?php else: ?>
                                        <input name="weight" type="number" placeholder="gram" class="form-control" id="weight">
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                </div>
            </div> 
        </div>
        <div class="col-lg-3">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Media</h4>
                </div>
                <div class="card-body">
                    <p>Pilih minimal 2 foto product</p>
                    <p>Foto pertama dan kedua akan menjadi tumbnail</p>

                    <div class="input-upload">
                        <?php if(isset(session('errors')['file'])): ?>
                            <input name="file[]" class="form-control is-invalid" type="file" id="file" onchange="preview_image();" multiple>
                            <div class="invalid-feedback">
                                <?= session('errors')['file'] ?>
                            </div>
                        <?php else: ?>
                            <label class="btn btn-info" for="gallery-photo-add">Pilih Foto</label>
                            <input hidden name="file[]" class="" type="file" id="gallery-photo-add" multiple>
                        <?php endif ?>
                    </div>
                    <div class="row gallery p-1"></div>

                    
                </div>
            </div> <!-- card end// -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Kategori</h4>
                </div>
                <div class="card-body">
                        <div class="mb-4">
                            <label class="form-label">Kategori</label>
                            <?php foreach ($categories as $category): ?>

                                <div class="custom-control custom-radio">
                                  <input type="checkbox" id="customRadio1" name="category[]" value="<?= $category->id ?>" class="custom-control-input">
                                  <label class="custom-control-label" for="customRadio1"><?= $category->category ?></label>
                              </div>

                            <?php endforeach ?>
                          </div>
                        </div>
                    </div> <!-- row.// -->
                </div>
            </div> <!-- card end// -->
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.css">
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/theme/monokai.css">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/mode/xml/xml.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/2.36.0/formatting.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js" defer></script>
<script type="text/javascript">
   $(document).ready(function() {
  $('#summernote').summernote();
});
</script>
<?php $this->endSection() ?>

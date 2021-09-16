<?php $this->extend('dashboard') ?>

<?php $this->section('content') ?>
<form action="<?= base_url('/updateproduk') ?>/<?= $product->id ?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-9">
            <div class="content-header">
                <?php if(in_groups(1)): ?>
                    <h2 class="content-title">Edit Produk</h2>
                <?php else: ?>
                    <h2 class="content-title">Detail Produk</h2>
                <?php endif; ?>
                <div>
                    <?php if(in_groups(1)): ?>
                        <button class="btn btn-light rounded font-sm mr-5 text-body hover-up">Save to draft</button>
                        <button type="submit" class="btn btn-md rounded font-sm hover-up">Perbarui</button>
                    <?php endif; ?>
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
                    <h4>Produk</h4>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <label for="product_name" class="form-label">Nama Produk</label>
                        <?php if(isset(session('errors')['name'])): ?>
                            <input name="name" type="text" placeholder="Type here" class="form-control is-invalid" id="product_name" value="<?= old('name') ?? $product->name ?>">
                            <div class="invalid-feedback">
                                <?= session('errors')['name'] ?>
                            </div>
                        <?php else: ?>
                            <input name="name" type="text" placeholder="Type here" class="form-control" id="product_name" value="<?= old('name') ?? $product->name ?>">
                        <?php endif ?>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Deskripsi</label>
                        <?php if(isset(session('errors')['description'])): ?>
                            <textarea name="description" placeholder="Type here" class="is-invalid form-control" rows="4"><?= old('description') ?? $product->description ?></textarea>
                            <div class="invalid-feedback">
                                <?= session('errors')['description'] ?>
                            </div>
                        <?php else: ?>
                            <textarea name="description" placeholder="Type here" class="form-control" rows="4"><?= old('description') ?? $product->description ?></textarea>
                        <?php endif ?>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Harga Pokok</label>
                                <div class="row gx-2">
                                    <?php if(isset(session('errors')['fixed_price'])): ?>
                                        <input name="fixed_price" placeholder="$" type="text" class="form-control is-invalid" value="<?= old('fixed_price') ?? $product->fixed_price ?>">
                                        <div class="invalid-feedback">
                                            <?= session('errors')['fixed_price'] ?>
                                        </div>
                                    <?php else: ?>
                                        <input name="fixed_price" placeholder="$" type="text" class="form-control" value="<?= old('fixed_price') ?? $product->fixed_price ?>">
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Harga Jual</label>
                                <?php if(isset(session('errors')['sell_price'])): ?>
                                    <input name="sell_price" placeholder="$" type="number" class="form-control is-invalid" value="<?= old('sell_price') ?? $product->sell_price ?>">
                                    <div class="invalid-feedback">
                                        <?= session('errors')['sell_price'] ?>
                                    </div>
                                <?php else: ?>
                                    <input name="sell_price" placeholder="$" type="number" class="form-control" value="<?= old('sell_price') ?? $product->sell_price ?>">
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Komisi Affiliate</label>
                                <?php if(isset(session('errors')['affiliate_commission'])): ?>
                                    <input name="affiliate_commission" type="number" placeholder="Rp" class="form-control is-invalid" id="product_name" value="<?= old('affiliate_commission') ?? $product->affiliate_commission ?>">
                                    <div class="invalid-feedback">
                                        <?= session('errors')['affiliate_commission'] ?>
                                    </div>
                                <?php else: ?>
                                    <input name="affiliate_commission" type="number" placeholder="Rp" class="form-control" id="product_name" value="<?= old('affiliate_commission') ?? $product->affiliate_commission ?>">
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Komisi Stokis</label>
                                <?php if(isset(session('errors')['stockist_commission'])): ?>
                                    <input name="stockist_commission" type="number" placeholder="Rp" class="form-control is-invalid" id="product_name" value="<?= old('stockist_commission') ?? $product->stockist_commission ?>">
                                    <div class="invalid-feedback">
                                        <?= session('errors')['stockist_commission'] ?>
                                    </div>
                                <?php else: ?>
                                    <input name="stockist_commission" type="number" placeholder="Rp" class="form-control" id="product_name" value="<?= old('stockist_commission') ?? $product->stockist_commission ?>">
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label">Weight</label>
                                <?php if(isset(session('errors')['weight'])): ?>
                                    <input name="weight" type="number" placeholder="Gram" class="form-control is-invalid" id="weight" value="<?= old('weight') ?? $product->weight ?>">
                                    <div class="invalid-feedback">
                                        <?= session('errors')['weight'] ?>
                                    </div>
                                <?php else: ?>
                                    <input name="weight" type="number" placeholder="Gram" class="form-control" id="weight" value="<?= old('weight') ?? $product->weight ?>">
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 

            <div class="card mb-4">
                <div class="card-header">
                    <h4>Gambar</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php for($i = 0; $i < count($product->photos); $i++): ?>
                            <div class="col-lg-6 col-md-12 mb-4 mb-lg-0">
                                <?php if(in_groups(1)): ?>
                                <a class="d-inline btn-sm btn-primary" href="<?= base_url('/products/delete_photo')?>/<?= $product->id ?>/<?= $i ?>">Hapus</a>     
                                <?php endif; ?>        
                                <img
                                  src="<?= base_url() ?>/public/uploads/product_photos/<?= $product->photos[$i] ?>"
                                  class="w-100 shadow-1-strong mb-4"
                                  alt="jkkj"
                                />
                            </div>
                        <?php  endfor; ?>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h4>Kategori</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php for($i = 0; $i < count($product_categories); $i++): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                  <div class="fw-bold"><?= $product_categories[$i]->category ?></div>
                                </div>
                                <a class="d-inline btn btn-sm btn-light" href="<?= base_url('/products/delete_category')?>/<?= $product->id ?>/<?= $i ?>">Hapus</a>             
                            </li>
                        <?php endfor; ?>
                    </ul>
                </div>
            </div> 

        </div>
        <div class="col-lg-3">
            <?php if(in_groups(1)): ?>
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Media</h4>
                </div>
                <div class="card-body">
                    <div class="input-upload">
                        <img src="<?= base_url() ?>/backend/imgs/theme/upload.svg" alt="">
                        <?php if(isset(session('errors')['file'])): ?>
                            <input name="file[]" class="form-control is-invalid" type="file" id="file" multiple>
                            <div class="invalid-feedback">
                                <?= session('errors')['file'] ?>
                            </div>
                        <?php else: ?>
                            <input name="file[]" class="form-control" type="file" id="file" multiple>
                        <?php endif ?>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h4>Kategori</h4>
                </div>
                <div class="card-body h-100">
                    <?php foreach ($categories as $category): ?>

                        <div class="custom-control custom-radio">
                          <input type="checkbox" id="customRadio1" name="category[]" value="<?= $category->id ?>" class="custom-control-input">
                          <label class="custom-control-label" for="customRadio1"><?= $category->category ?></label>
                        </div>

                    <?php endforeach ?>
                </div>
            </div>
            <?php endif; ?>  <!-- card end// -->
            <!--  --> <!-- card end// -->
        </div>
    </div>
</form>

<?php $this->endSection() ?>

<?php Rpthis->extend('dashboard') ?>

<?php Rpthis->section('content') ?>
<form action="<?= base_url('/tambahproduk') ?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-9">
            <div class="content-header">
                <h2 class="content-title">Tambah Produk</h2>
                <div>
                    <button class="btn btn-light rounded font-sm mr-5 text-body hover-up">Save to draft</button>
                    <button type="submit" class="btn btn-md rounded font-sm hover-up">Publich</button>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <?php if (! empty(Rperrors)) : ?>
                <div class="alert bg-danger text-white">
                <?php foreach (Rperrors as Rpfield => Rperror) : ?>
                    <p><?= Rperror ?></p>
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
                                <textarea name="description" placeholder="Tulis Disini" class="is-invalid form-control" rows="4"></textarea>
                                <div class="invalid-feedback">
                                    <?= session('errors')['description'] ?>
                                </div>
                            <?php else: ?>
                                <textarea name="description" placeholder="Tulis Disini" class="form-control" rows="4"></textarea>
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
                                    <label class="form-label">Komisi Stokis</label>
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
            </div> <!-- card end// -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Kategori</h4>
                </div>
                <div class="card-body">
                        <div class="mb-4">
                            <label class="form-label">Kategori</label>
                            <?php foreach (Rpcategories as Rpcategory): ?>

                                <div class="custom-control custom-radio">
                                  <input type="checkbox" id="customRadio1" name="category[]" value="<?= Rpcategory->id ?>" class="custom-control-input">
                                  <label class="custom-control-label" for="customRadio1"><?= Rpcategory->category ?></label>
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

<?php Rpthis->endSection() ?>

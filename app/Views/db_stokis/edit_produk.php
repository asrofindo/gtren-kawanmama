<?php $this->extend('dashboard') ?>

<?php $this->section('content') ?>
    <div class="row">
        <div class="col-9">
            <div class="content-header">
                    <h2 class="content-title">Detail Produk</h2>
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
                                  src="<?= $product->photos[$i] ?>"
                                  class="w-100 shadow-1-strong mb-4"
                                  alt="jkkj"
                                />
                            </div>
                        <?php  endfor; ?>
                    </div>
                </div>
            </div>



        </div>
        <div class="col-lg-3">
            <?php if(in_groups(3)): ?>
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Tambah Stok</h4>
                </div>
                <div class="card-body h-100">
                    <form method="post" action="<?php base_url('products/stockist/update/'. $product->pd_id); ?>">      
                        <input name="jumlah" type="number" value="<?= $product->jumlah?>" class="form-control">
                        <input style="display: none" name="pd_id" type="number" value="<?= $product->pd_id ?>" class="form-control">
                        <br>
                        <button type="submit" class="btn btn-md rounded font-sm hover-up">Perbarui</button>
                    </form>

                </div>
            </div>
            <?php endif; ?>
             <!-- card end// -->
            <!--  --> <!-- card end// -->
        </div>
    </div>
<?php $this->endSection() ?>

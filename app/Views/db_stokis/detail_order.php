<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Order detail</h2>
        <p>Details for Order ID: 3453012</p>
    </div>
</div>
<div class="card">
    <header class="card-header">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 mb-lg-0 mb-15">
                <span>
                    <i class="material-icons md-calendar_today"></i> <b>Wed, Aug 13, 2020, 4:34PM</b>
                </span> <br>
                <small class="text-muted">Order ID: 3453012</small>
            </div>
            <div class="col-lg-6 col-md-6 ms-auto text-md-end">
                <form action="<?= base_url() ?>/order/update/<?= $transaksi_id; ?>" method="post">       
                    <select class="form-select d-inline-block mb-lg-0 mb-15 mw-200">
                            <option selected disabled="">Change status</option>
                            <option value="proses">Awaiting payment</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="shipped">Shipped</option>
                            <option value="delivered">Delivered</option>
                    </select>
                    <button class="btn btn-primary" type="submit">Save</button>
                    <a class="btn btn-secondary print ms-2" href="#"><i class="icon material-icons md-print"></i></a>
                </form>
            </div>
        </div>
    </header> <!-- card-header end// -->
    <div class="card-body">
        <div class="row mb-50 mt-20 order-info-wrap">
            <?php foreach($detail_orders as $order): ?>
                <div class="col-md-4">
                    <article class="icontext align-items-start">
                        <span class="icon icon-sm rounded-circle bg-primary-light">
                            <i class="text-primary material-icons md-person"></i>
                        </span>
                        <div class="text">
                            <h6 class="mb-1">Customer</h6>
                            <p class="mb-1">
                               <?= $order['username'] ?> <br> <?= $order['email'] ?> <br>
                            </p>
                            <a href="#">View profile</a>
                        </div>
                    </article>
                </div> <!-- col// -->
                <div class="col-md-4">
                    <article class="icontext align-items-start">
                        <span class="icon icon-sm rounded-circle bg-primary-light">
                            <i class="text-primary material-icons md-local_shipping"></i>
                        </span>
                        <div class="text">
                            <h6 class="mb-1">Order info</h6>
                            <p class="mb-1">
                                Shipping: <?= $order['kurir'] ?> <br> etd: <?= $order['etd'] ?> <br> ongkir: <?= $order['ongkir'] ?>
                            </p>
                            <a href="#">Download info</a>
                        </div>
                    </article>
                </div> <!-- col// -->
                <div class="col-md-4">
                    <article class="icontext align-items-start">
                        <span class="icon icon-sm rounded-circle bg-primary-light">
                            <i class="text-primary material-icons md-place"></i>
                        </span>
                        <div class="text">
                            <h6 class="mb-1">Deliver to</h6>
                            <p class="mb-1">
                                kabupaten: <?= $order['kabupaten'] ?> <br>kecamatan : <?= $order['kecamatan'] ?><br> kode pos : <?= $order['kode_pos'] ; ?>
                            </p>
                            <a href="#">View profile</a>
                        </div>
                    </article>
                </div> <!-- col// -->
            <?php endforeach; ?>
        </div> <!-- row // -->
        <div class="row">
            <div class="col-lg-7">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="40%">Product</th>
                                <th width="20%">Unit Price</th>
                                <th width="20%">Quantity</th>
                                <th width="20%" class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($detail_orders as $order):?>
                                <?php foreach ($order['products'] as $product): ?>
                                    <tr>
                                            <td>
                                                <a class="itemside" href="#">
                                                    <div class="left">
                                                        <img src="assets/imgs/items/1.jpg" width="40" height="40" class="img-xs" alt="Item">
                                                    </div>
                                                    <div class="info"><?= $product->name;  ?></div>
                                                </a>
                                            </td>
                                            <td> <?= $product->total / $product->amount; ?> </td>
                                            <td> <?= $product->amount; ?> </td>
                                            <td class="text-end"> <?= $product->total;  ?> </td>

                                    </tr>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div> <!-- table-responsive// -->
            </div> <!-- col// -->
            <div class="col-lg-1"></div>
            <div class="col-lg-4">
               <!--  <div class="box shadow-sm bg-light">
                    <h6 class="mb-15">Payment info</h6>
                    <p>
                        <img src="assets/imgs/card-brands/2.png" class="border" height="20"> Master Card **** **** 4768 <br>
                        Business name: Grand Market LLC <br>
                        Phone: +1 (800) 555-154-52
                    </p>
                </div> -->
                <div class="h-25 pt-4">
                    <div class="mb-3">
                        <label>Notes</label>
                        <textarea class="form-control" name="notes" id="notes" placeholder="Masukan Nomor"></textarea>
                    </div>
                    <button class="btn btn-primary">Save note</button>
                </div>
            </div> <!-- col// -->
        </div>
    </div> <!-- card-body end// -->
</div>
<?php $this->endSection() ?>
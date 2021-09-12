<?= $this->extend('commerce/templates/index') ?>
<?= $this->section('content') ?>
<section class="pt-50 pb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="row">
                    <div class="col-md-4">
                        <div class="dashboard-menu">
                            <ul class="nav flex-column" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link <?= ($segments[0] == "account" ? "active" : null) ?>" id="dashboard-tab" href="<?= base_url('account') ?>" role="tab" aria-controls="dashboard" aria-selected="false"><i class="fa fa-atom mr-15"></i>Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($segments[0] == "orders" ? "active" : null) ?>" id="orders-tab" href="<?= base_url('orders') ?>"><i class="fa fa-shopping-basket mr-15"></i>Pembelian</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($segments[0] == "tracking" ? "active" : null) ?>" id="track-orders-tab" href="<?= base_url('tracking') ?>" role="tab" aria-controls="track-orders" aria-selected="false"><i class="fa fa-paper-plane mr-15"></i>Track Your Order</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($segments[0] == "address" || $segments[0] == "billing-address" || $segments[0] == "shipping-address" || $segments[0] == "edit-billing" || $segments[0] == "edit-shipping" ? "active" : null) ?>" id="address-tab" href="<?= base_url('address') ?>" role="tab" aria-controls="address" aria-selected="true"><i class="fa fa-map-marked mr-15"></i>Alamat</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($segments[0] == "profile" ? "active" : null) ?>" id="account-detail-tab" href="<?= base_url('profile') ?>" role="tab" aria-controls="account-detail" aria-selected="true"><i class="fa fa-user-edit mr-15"></i>Profile Saya</a>
                                </li>

                            <?php if (in_groups(4)) {?>
                                <li class="nav-item">
                                    <?php if(count($segments) > 1) : ?>
                                    <a class="nav-link <?= ($segments[1] == "affiliate" ? "active" : null) ?>" id="upgrade-tab" href="<?= base_url('upgrade/affiliate') ?>" role="tab" aria-controls="upgrade" aria-selected="true"><i class="fa fa-upload mr-15"></i>Affiliasi Anda</a>
                                    <?php else : ?>
                                    <a class="nav-link <?= ($segments[0] == "affiliate" ? "active" : null) ?>" id="upgrade-tab" href="<?= base_url('upgrade/affiliate') ?>" role="tab" aria-controls="upgrade" aria-selected="true"><i class="fa fa-upload mr-15"></i>Affiliasi Anda</a>    
                                    <?php endif; ?>
                                </li>
                            <?php } ?>
                            <?php if (!in_groups(4)) {?>
                                <li class="nav-item">
                                    <?php if(count($segments) > 1) : ?>
                                    <a class="nav-link <?= ($segments[1] == "affiliate" ? "active" : null) ?>" id="upgrade-tab" href="<?= base_url('upgrade/affiliate') ?>" role="tab" aria-controls="upgrade" aria-selected="true"><i class="fa fa-upload mr-15"></i>Daftar Program Referal</a>
                                    <?php else : ?>
                                    <a class="nav-link <?= ($segments[0] == "affiliate" ? "active" : null) ?>" id="upgrade-tab" href="<?= base_url('upgrade/affiliate') ?>" role="tab" aria-controls="upgrade" aria-selected="true"><i class="fa fa-upload mr-15"></i>Daftar Program Referal</a>    
                                    <?php endif; ?>
                                </li>
                            <?php } ?>
                            <?php if (!in_groups(4)) {?>
                                 <li class="nav-item">
                                    <?php if(count($segments) > 1): ?>
                                    <a class="nav-link <?= ($segments[1] == "stockist" ? "active" : null) ?>" id="upgrade-tab" href="<?= base_url('upgrade/stockist') ?>" role="tab" aria-controls="upgrade" aria-selected="true"><i class="fa fa-upload mr-15"></i>Jadi Distributor</a>
                                    <?php else : ?>
                                    <a class="nav-link <?= ($segments[0] == "stockist" ? "active" : null) ?>" id="upgrade-tab" href="<?= base_url('upgrade/stockist') ?>" role="tab" aria-controls="upgrade" aria-selected="true"><i class="fa fa-upload mr-15"></i>Jadi Distributor</a> 
                                    <?php endif; ?>
                                </li>
                            <?php } ?>
                            <?php if (in_groups(4)) {?>
                                 <li class="nav-item">
                                    <?php if(count($segments) > 1): ?>
                                    <a class="nav-link <?= ($segments[1] == "stockist" ? "active" : null) ?>" id="upgrade-tab" href="<?= base_url('upgrade/stockist') ?>" role="tab" aria-controls="upgrade" aria-selected="true"><i class="fa fa-upload mr-15"></i>Toko Anda</a>
                                    <?php else : ?>
                                    <a class="nav-link <?= ($segments[0] == "stockist" ? "active" : null) ?>" id="upgrade-tab" href="<?= base_url('upgrade/stockist') ?>" role="tab" aria-controls="upgrade" aria-selected="true"><i class="fa fa-upload mr-15"></i>Toko Anda</a> 
                                    <?php endif; ?>
                                </li>
                            <?php } ?>

                                <li class="nav-item bg-danger">
                                    <a class="nav-link text-white" href="/logout"><i class="text-white fa fa-sign-out mr-15"></i>Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content dashboard-content">
                            <?php if($segments[0] == "orders"): ?>
                                <div class="tab-pane fade active show" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0">Pesanan Anda</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Nomor</th>
                                                            <th>Tanggal Pemesanan</th>
                                                            <th>Status Pembayaran</th>
                                                            <th>Total Tagihan</th>
                                                            <th>Pembayaran Melalui</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($transaksis as $transaksi): ?>
                                                            <tr>
                                                                <td><?= $transaksi->id;  ?></td>
                                                                <td><?= $transaksi->created_at;  ?></td>
                                                                <td>
                                                                     <?php if($transaksi->status_pembayaran == 'pending'): ?>
                                                                        <span class="badge rounded-pill alert-warning">Menunggu Pembayaran</span>
                                                                    <?php elseif($transaksi->status_pembayaran == 'paid'): ?>
                                                                        <span class="badge rounded-pill alert-success">Sudah Dibayar</span>
                                                                     <?php elseif($transaksi->status_pembayaran == 'cancel'): ?>
                                                                        <span class="badge rounded-pill alert-danger">di gagalkan</span>
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td><?= $transaksi->total; ?></td>
                                                                <td><?= $transaksi->bank_name; ?> - <?= $transaksi->bank_number; ?> - <?= $transaksi->owner; ?></td>
                                                                <td><a href="<?= base_url() ?>/detail/<?= $transaksi->id ?>" class="btn-small d-block">Detail</a></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php elseif($segments[0] == "detail"): ?>
                                <div class="tab-pane fade active show" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0">Detail Pesanan Anda</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Nomor</th>
                                                            <th>Produk </th>
                                                            <th>Jumlah </th>
                                                            <th>Status Pengiriman</th>
                                                            <th>Kurir</th>
                                                            <th>Resi</th>
                                                            <th>Tanggal</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($details_order as $order): ?>
                                                            <?php $photo = explode(',', $order->photos); ?>
                                                            <tr>
                                                                <td><?= $order->id;  ?></td>
                                                                <td>                                             
                                                                    <a class="itemside" href="#">
                                                                        <div class="left">
                                                                            <img src="<?= base_url()  ?>/public/uploads/product_photos/<?= $photo[0]; ?>" width="40" height="40" class="img-xs" alt="Item">
                                                                        </div>
                                                                        <div class="info"><?= $order->name;  ?></div>
                                                                    </a>
                                                                </td>
                                                                <td><?= $order->amount;  ?></td>
                                                                <td>
                                                                    <?php if($order->status_barang == null): ?>
                                                                        <span class="badge rounded-pill alert-warning">Menunggu Konfirmasi Seller </span>
                                                                    <?php elseif($order->status_barang == 'dikirim'): ?>
                                                                        <span class="badge rounded-pill alert-primary">Sedang Dikirim</span>
                                                                    <?php elseif($order->status_barang == 'diterima_seller'): ?>
                                                                        <span class="badge rounded-pill alert-primary"><?= 'Penyiapan Barang'; ?></span>
                                                                    <?php elseif($order->status_barang == 'diterima_pembeli'): ?>
                                                                        <span class="badge rounded-pill alert-success">Diterima Oleh Pembeli</span>
                                                                    <?php elseif($order->status_barang == 'ditolak'): ?>
                                                                        <span class="badge rounded-pill alert-danger">Ditolak Oleh DIstributor</span>
                                                                    <?php elseif($order->status_barang == 'refund'): ?>
                                                                        <span class="badge rounded-pill alert-danger">Dana Dikembalikan</span>
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td><?= $order->kurir ?>,Perkiraan <?= $order->etd ?></td>
                                                                <td><?= $order->resi ? $order->resi: 'proses'; ?></td>
                                                                <td><?= $order->created_at;  ?></td>
                                                                <td>
                                                                    <?php if($order->status_barang == 'dikirim'): ?>
                                                                        <a class="btn btn-sm btn-primary" href="<?= base_url() ?>/order/verify/<?= $order->id ?>" class="btn-small d-block">
                                                                            Sudah Terima Barang ?
                                                                        </a>
                                                                    <?php elseif($order->status_barang == null): ?>
                                                                        <span class="badge rounded-pill alert-danger">Menunggu Konfirmasi</span>
                                                                    <?php elseif($order->status_barang == 'diterima'): ?>
                                                                       <span class="badge rounded-pill alert-success">Diterima Oleh Pembeli</span>
                                                                    <?php endif; ?>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php elseif($segments[0] == "tracking"): ?>
                                <div class="tab-pane fade active show" id="track-orders" role="tabpanel" aria-labelledby="track-orders-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0">Orders tracking</h5>
                                        </div>
                                        <div class="card-body contact-from-area">
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

                                            <p>To track your order please enter your OrderID in the box below and press "Track" button. This was given to you on your receipt and in the confirmation email you should have received.</p>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <form class="contact-form-style mt-30 mb-50" action="<?php base_url() ?>/track" method="post">

                                                            <div class="input-style mb-20">
                                                                 <label class="form-label">Kurir</label>
                                                                <select class="form-select" name="courier">
                                                                    <?php foreach ($couries as $courier): ?>
                                                                        <option value="<?= $courier['code'] ?>">
                                                                            <?= $courier['description'] ?>
                
                                                                        </option>
                                                                    <?php endforeach ?>
                                                                </select>
                                                            </div>

                                                        <div class="input-style mb-20">
                                                            <label>Nomor Resi</label>
                                                            <input name="awb" placeholder="Found in your order confirmation email" type="text" class="square">
                                                        </div>
                                                        <button class="btn-sm submit submit-auto-width" type="submit"><i class="fa fa-paper-plane mr-15"></i>Track</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php elseif($segments[0] == "address"): ?>
                                <div class="tab-pane fade active show" id="address" role="tabpanel" aria-labelledby="address-tab">
                                    <div class="row mb-3">
                                    <?php if( !empty(session()->getFlashdata('success'))){ ?>
                                            <div class="alert alert-success bg-success text-white">
                                                <?php echo session()->getFlashdata('success');?>
                                            </div>
                                        <?php } ?>
                                            <div class="dropdown">
                                              <a class="btn btn-primary dropdown-toggle" href="<?php base_url() ?>/billing-address">
                                                Tambah Alamat
                                              </a>
                                            </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="card mb-3 mb-lg-0">
                                                <div class="card-header">
                                                    <h5 class="mb-0">Alamat</h5>
                                                </div>
                                                <div class="card-body">
                                                    <?php foreach ($billing_address as $billing) :?>
                                                        <?php if($billing->type == 'billing'): ?>
                                                        <address><?= $billing->provinsi ?><br> <?= $billing->kabupaten ?>,<br> <?= $billing->kecamatan ?> <br><?= $billing->kode_pos ?> <br>
                                                            <p><?= $billing->detail_alamat  ?></p>
                                                        </address>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                    <?php if($billing_address): ?>
                                                    <a href="<?php base_url() ?>/edit-billing" class="btn-small">Ubah</a>
                                                    <a href="<?php base_url() ?>/address/delete/<?= $billing_address[0]->id ?>" class="btn-small">Hapus</a>

                                                    <?php endif ?>
                                                </div>
                                            </div>
                                        </div>
<!--                                         <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="mb-0">Shipping Address</h5>
                                                </div>
                                                <div class="card-body">
                                                    <?php foreach ($shipping_address as $shipping) :?>
                                                        <address><?= $shipping->provinsi ?><br> <?= $shipping->kabupaten ?>,<br> <?= $shipping->kecamatan ?> <br><?= $shipping->kode_pos ?> <br>
                                                            <p><?= $shipping->detail_alamat  ?></p>
                                                        </address>
                                                    <?php endforeach; ?>
                                                    <?php if($shipping_address): ?>
                                                    <a href="<?php base_url() ?>/edit-shipping" class="btn-small">Edit</a>
                                                    <a href="<?php base_url() ?>/address/delete/<?= $shipping_address[0]->id ?>" class="btn-small">Hapus</a>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            <?php elseif($segments[0] == "billing-address"): ?>
                                <div class="tab-pane fade active show" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Tambah Alamat</h5>
                                        </div>
                                        <div class="card-body">
                                            <?php $id = user()->id; ?>
                                            <form method="post" action="/billing-address/<?= $id ?>">
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label>Provinsi<span class="required">*</span></label>
                                                        <select required="" class="form-control square" name="provinsi" id="provinsi">
                                                            
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Kabupaten<span class="required">*</span></label>
                                                         <select required="" class="form-control square" name="kabupaten" id="kabupaten">
                                                            
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Kecamatan<span class="required">*</span></label>
                                                         <select required="" class="form-control square" name="kecamatan" id="kecamatan">
                                                            
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <input id="kode_pos" value="" required="" class="form-control square" name="kode_pos" type="hidden">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Detail Alamat<span class="required">*</span></label>
                                                        <input required="" class="form-control square" name="detail_alamat" type="text">
                                                    </div>

                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-fill-out submit" name="submit" value="Submit">Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php elseif($segments[0] == "edit-billing"): ?>
                                <div class="tab-pane fade active show" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Ubah Alamat</h5>
                                        </div>
                                        <div class="card-body">
                                            <?php foreach ($billing_address as $address): ?>
                                                <?php if($address->type == 'billing'): ?>
                                                    <form method="post" action="/edit-billing/<?= $address->id ?>">
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <label>Provinsi<span class="required">*</span></label>
                                                                <select required="" class="form-control square" name="provinsi" id="provinsi">
                                                                    <option selected value="<?php $address->provinsi ?>" disabled=""><?= $address->provinsi ?></option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label>Kabupaten<span class="required">*</span></label>
                                                                <select required="" class="form-control square" name="kabupaten" id="kabupaten">
                                                                    <option selected value="<?= $address->kabupaten  ?>" disabled=""><?= $address->kabupaten ?></option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label>Kecamatan<span class="required">*</span></label>
                                                                <select required="" class="form-control square" name="kecamatan" id="kecamatan">
                                                                    <option selected value="<?= $address->kecamatan  ?>" disabled=""><?= $address->kecamatan ?></option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <input value="<?= $address->kode_pos ?>" id="kode_pos" required="" class="form-control square" name="kode_pos" type="hidden">
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label>Detail Alamat<span class="required">*</span></label>
                                                                <input value="<?= $address->detail_alamat ?>" required="" class="form-control square" name="detail_alamat" type="text">
                                                            </div>

                                                            <div class="col-md-12">
                                                                <button type="submit" class="btn btn-fill-out submit" name="submit" value="Submit">Ubah</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                <?php endif ?>
                                                <?php endforeach ?>
                                        </div>
                                    </div>
                                </div>
                            <?php elseif($segments[0] == "edit-shipping"): ?>

                                <div class="tab-pane fade active show" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Ubah Alamat Shipping</h5>
                                        </div>
                                        <div class="card-body">
                                            <?php foreach ($shipping_address as $address): ?>
                                                <?php if($address->type == 'shipping'): ?>
                                                    <form method="post" action="/edit-shipping/<?= $address->id ?>">
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <label>Provinsi<span class="required">*</span></label>
                                                                <select required="" class="form-control square" name="provinsi" id="provinsi">
                                                                    <option selected value="<?php $address->provinsi ?>" disabled=""><?= $address->provinsi ?></option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label>Kabupaten<span class="required">*</span></label>
                                                                <select required="" class="form-control square" name="kabupaten" id="kabupaten">
                                                                    <option selected value="<?= $address->kabupaten  ?>" disabled=""><?= $address->kabupaten ?></option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label>Kecamatan<span class="required">*</span></label>
                                                                <select required="" class="form-control square" name="kecamatan" id="kecamatan">
                                                                    <option selected value="<?= $address->kecamatan  ?>" disabled=""><?= $address->kecamatan ?></option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <input value="<?= $address->kode_pos ?>" required="" class="form-control square" name="kode_pos" id="kode_pos" type="hidden">
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label>Detail Alamat<span class="required">*</span></label>
                                                                <input value="<?= $address->detail_alamat ?>" required="" class="form-control square" name="detail_alamat" type="text">
                                                            </div>

                                                            <div class="col-md-12">
                                                                <button type="submit" class="btn btn-fill-out submit" name="submit" value="Submit">Ubah</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                <?php endif ?>
                                                <?php endforeach ?>
                                        </div>
                                    </div>
                                </div>
                            <?php elseif($segments[0] == "profile"): ?>
                                <div class="tab-pane fade active show" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Profil Saya</h5>
                                        </div>
                                        <div class="card-body">
                                        <?php if( !empty(session()->getFlashdata('success'))){ ?>
                                            <div class="alert alert-success bg-success text-white">
                                                <?php echo session()->getFlashdata('success');?>
                                            </div>
                                        <?php } ?>

                                        <?php if(!empty(session()->getFlashdata('error'))){ ?>

                                        <div class="alert alert-danger bg-danger text-white">
                                            <?php echo session()->getFlashdata('error');?>
                                        </div>

                                        <?php } ?>
                                            <form method="post" action="<?= base_url()?>/profile">
                                                <div class="row">
                                                    <p>Sapaan<span class="required">*</span></p>
                                                    <div class="input-group">
                                                        <div class="form-check">
                                                        <label class="form-check-label m-2">
                                                            <input type="radio" class="form-check-input" <?php if(user()->greeting=='Kak') echo 'checked'?> name="greeting" value="Kak" required>Kak
                                                        </label>
                                                        </div>
                                                        <div class="form-check m-2">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" <?php if(user()->greeting=='Pak') echo 'checked'?>  name="greeting" value="Pak" required>Pak
                                                        </label>
                                                        </div>
                                                        <div class="form-check m-2">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" <?php if(user()->greeting=='Bu') echo 'checked'?> name="greeting" value="Bu" required>Bu
                                                        </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Nama Lengkap <span class="required">*</span></label>
                                                        <input required="" class="form-control square" name="fullname" type="text" value="<?= user()->fullname ?>">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Username <span class="required">*</span></label>
                                                        <input required="" class="form-control square" name=username type="text"  value="<?= user()->username ?>">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Email Address <span class="required">*</span></label>
                                                        <input required="" class="form-control square" name="email" type="email"  value="<?= user()->email ?>">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Nomer Hp<span class="required">*</span></label>
                                                        <input required="" class="form-control square" value="<?= user()->phone ?>" name="phone" type="text">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Password Saat ini <span class="required">*</span></label>
                                                        <input required="" class="form-control square" name="password" type="password">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-fill-out submit" name="submit" value="Submit">Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>                        
                            <?php elseif(count($segments) > 1 && $segments[1] == "affiliate"): ?>
                                <div class="tab-pane fade active show" id="upgrade" role="tabpanel" aria-labelledby="upgrade-tab">
                                    <div class="card">

                                        <div class="card-header">
                                            <h5>Upgrade Akun</h5>
                                        </div>
                                        <div class="card-body">
                                            <?php if(count($upgrades) < 1 && !in_groups(4) ): ?>
                                            <p class="pb-5 mb-20">
                                                 Username Kamu <b><?= user()->username; ?></b>
                                            </p>
                                                <p class="pb-5 mb-20">
                                                     Biaya Affiliate : Rp <b><?= 50000 ?></b>
                                                </p>
                                                <p class="pb-5 mb-20">
                                                    <?php $kode = 50000 + $generate; ?>
                                                    Kode Unik : <b><?= substr($kode, 2, 5) ?></b>
                                                </p>
                                                <p class="pb-5 mb-20">
                                                     Total Tagihan : Rp <b><?= 50000 + $generate ?></b>
                                                </p>
                                            <?php endif; ?>
                                            <?php if($segments[1] == "affiliate" && !empty(session()->getFlashdata('success'))){ ?>
                                            <?php if (!in_groups(4)) {?>
                                                <p>Registrasi program affiliasi Anda <b>Menunggu Pembayaran<b>.</p>
                                                <p>Mohon dilakukan pembayaran <strong>Rp <strong><b><?= 50000 + ($generate - 1) ?></strong></b></strong></p>
                                                <p>ke Rekening Bank Dibawah ini :<br>
                                                
                                                    Rekening : <strong><?= $bill->bank_name?></strong> <br> Nomor : <strong><?= $bill->bank_number?></strong> <br> A/N : <strong><?= $bill->owner?>.</strong> </p>
                                            <?php }else{ ?>
                                                <div class="alert alert-success bg-success text-white">
                                                     <br> Link Affiliate <b>(<?= user()->affiliate_link;?>)</b>
                                                </div>
                                            <?php } ?>
                                            <?php } ?>

                                            <?php if($segments[1] == "affiliate" && !empty(session()->getFlashdata('danger'))){ ?>

                                                <div class="alert alert-danger bg-danger text-white">
                                                    <?php echo session()->getFlashdata('danger');?>
                                                </div>

                                            <?php } ?>
                                            <?php $id = user()->id; ?>
                                            <?php if(count($upgrades) < 1 && !in_groups(4)): ?>
                                                <form method="post" action="<?= base_url()  ?>/upgrades/<?= $id  ?>" enctype="multipart/form-data">
                                                    <div class="form-group col-md-12">
                                                        <input  value="<?= 50000 + $generate ?>" required class="form-control square" name="total" id="total" style="display: none;" type="text">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <input type="text" name="type" value="affiliate" style="display: none;">
                                                        <input type="text" name="code" value="<?= substr($kode, 2, 5) ?>" style="display: none">
                                                    </div>
                                                     <div class="form-group col-md-12">
                                                        <label>Transfer Bank<span class="required">*</span></label>
                                                        <select required="" class="form-control square" name="bill" id="bill">
                                                            <?php foreach($bills as $bill): ?>
                                                                <option selected value="<?= $bill->id;  ?>">
                                                                    <?= $bill->bank_name  ?> - <?= $bill->bank_number  ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-sm btn-fill-out submit" name="submit" value="Submit">
                                                            <i class="fa fa-send"></i> Bayar
                                                        </button>
                                                    </div>
                                                </form>
                                            <?php elseif(count($upgrades) > 1 && !in_groups(4)): ?>
                                               <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>photo</th>
                                                            <th>status</th>
                                                            <th>Type</th>
                                                            <th>Total</th>
                                                            <th>bill</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($upgrades as $upgrade): ?>
                                                            <tr>
                                                                <td>
                                                                <?php if(strlen($upgrade->photo) > 5): ?>
                                                                    <img style="width:100px" class="img-responsive circle" src="<?php base_url() ?>/uploads/bukti/<?= $upgrade->photo ?>"></td>
                                                                <?php else: ?>
                                                                    Upload Bukti Foto
                                                                <?php endif; ?>
                                                                <td><?= $upgrade->status_request ?></td>
                                                                <td><?= $upgrade->type ?></td>
                                                                <td>Rp <?= $upgrade->total ?></td>
                                                                <td><?= $upgrade->bill ?></td>
                                                                <td>
                                                                    <?php if($upgrade->status_request != 'active'): ?>
                                                                    <form method="post" action="<?= base_url()  ?>/upgrades/upload/<?= $id  ?>" enctype="multipart/form-data">
                                                                        <div class="form-group col-md-12">
                                                                            <input type="file" name="photo" style="width: 100px; border:none" class="is-invalid form-control">
                                                                            <button type="submit" class="btn btn-sm btn-fill-out submit" name="submit" value="Submit">
                                                                                <i class="fa fa-send"></i> Bayar
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                    <?php else: ?>
                                                                        <button type="submit" class="btn btn-sm btn-fill-out submit" name="submit" value="Submit">
                                                                            <i class="fa fa-send"></i> Verified
                                                                        </button>
                                                                    <?php endif; ?>
                                                                </td>

                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            <?php endif; ?>
                                        </div>
                                       <!--  <div class="card-body">
                                            <div class="sidebar">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div id="listings" class="listings">asdasd</div>
                                                    </div>
                                                    <div  style="height: 400px" class="col-8 ">
                                                        <div id="map" class="map h-100 w-100" style="height: 400px"></div>
                                                     </div>
                                                </div>     
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            <?php elseif( count($segments) > 1 && $segments[1] == "stockist"): ?>
                                <div class="tab-pane fade active show" id="upgrade" role="tabpanel" aria-labelledby="upgrade-tab">
                                    <div class="card">

                                        <div class="card-header">
                                            <h5>Upgrade Akun Sebagai Distributor</h5>
                                        </div>
                                        <div class="card-body">
                                                <?php if( $segments[1] == "stockist" && !empty(session()->getFlashdata('successs'))){ ?>
                                                    <div class="alert alert-success bg-success text-white">
                                                        <?php echo session()->getFlashdata('successs');?>
                                                    </div>
                                                <?php } ?>

                                                <?php if($segments[1] == "stockist" && !empty(session()->getFlashdata('danger'))){ ?>

                                                    <div class="alert alert-danger bg-danger text-white">
                                                        <?php echo session()->getFlashdata('danger');?>
                                                    </div>

                                                <?php } ?>
                                             <?php $id = user()->id; ?>
                                            <?php if(!in_groups(3)): ?>
                                            <h5>
                                                Untuk menjadi distributor Anda harus sudah tergabung sebagai Member Gtren. 
                                            </h5>
                                            <br>
                                            <p>
                                                A. Untuk menjadi member Gtren silakan melakukan pembelian salah satu produk yang disediakan, kemudian hubungi pengirim barang Anda!
                                            </p>
                                            <br>
                                            <p>
                                                B. Nomor MID dan username dapat anda temukan di sini <a href="https://g-tren.com/m">https://g-tren.com/m</a>
                                            </p>
                                            <br>
                                            <h5>Masukan Data Nomor MID dan Username Gtren</h5>
                                            <br>
                                            <form method="post" action="<?= base_url()  ?>/upgrades/<?= $id  ?>"  enctype="multipart/form-data">
                                                <div class="form-group col-md-12">
                                                    <label>No. MID<span class="required">*</span></label>
                                                    <input required class="form-control square" name="code" type="text">
                                                </div>
                                                 <div class="form-group col-md-12">
                                                    <label>Username Gtren<span class="required">*</span></label>
                                                    <input required class="form-control square" name="username" type="text">
                                                </div>
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-sm btn-fill-out submit" name="submit" value="Submit">
                                                        <i class="fa fa-upload"></i> Upgrade
                                                    </button>
                                                </div>
                                            </form>
                                            <?php else: ?>
                                                <a href="<?= base_url('/dashboard') ?>"><button class="btn btn-lg btn">Klik Untuk Kunjungi Dashboard</button></a>    
                                            <?php endif; ?>

                                            </div>
                                       <!--  <div class="card-body">
                                            <div class="sidebar">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div id="listings" class="listings">asdasd</div>
                                                    </div>
                                                    <div  style="height: 400px" class="col-8 ">
                                                        <div id="map" class="map h-100 w-100" style="height: 400px"></div>
                                                     </div>
                                                </div>     
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            <?php elseif($segments[0] == "account"): ?>
                                <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0"><?= greeting(user()->username) ?> </h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="text-center">
                                                <img src="<?= base_url() ?>/frontend/imgs/page/avatar-1.jpg" class="img-fluid rounded-circle w-25">
                                                <h3><?= user()->fullname ?></h3>
                                                <h6><?= user()->email ?></h6>
                                                <p>
                                                    <?php foreach (user()->getRoles() as $role): ?>
                                                        <?= $role ?>
                                                    <?php endforeach ?>
                                                </p>

                                            </div>
                                            <?php if(in_groups(3)){?>
                                            <div class="roe m-1">
                                                <div class="col-12">
                                                    <a href="<?= base_url('/dashboard') ?>"><button class="btn btn-lg w-100">Klik Untuk Kunjungi Dashboard</button></a>
                                                </div>
                                            </div>
                                            <?php }?>
                                            <?php if(!in_groups(3)){?>
                                            <div class="roe m-1">
                                                <div class="col-12">
                                                    <a href="<?= base_url('/upgrade/stockist') ?>"><button class="btn btn-lg w-100">klik Untuk Jadi Distributor</button></a>
                                                </div>
                                            </div>
                                            <?php }?>
                                            <?php if(!in_groups(4)){?>
                                            <div class="roe m-1">
                                                <div class="col-12">
                                                    <a href="<?= base_url('/upgrade/affiliate') ?>"><button class="btn btn-lg w-100  bg-warning">klik Daftar Program Referal</button></a>
                                                </div>
                                            </div>
                                            <?php }?>
                                            <div class="row my-3">
                                                <div class="card">
                                                    <div class="col-lg-6">
                                                        <div class="card-body">
                                                            <h2 class="">35</h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">

</script>
<script type="text/javascript">
    $.get( "/province",
        function( data ) {


        $.each(data, function (i, item) {
            $('#provinsi').append($('<option>', { 
                value: [item.provinsi_id, item.provinsi],
                text : item.provinsi
            }));
        });
    });


    $('#provinsi').change(function(data) {
        const val = data.target.value;
        const arr = val.split(',');
        $.get( `/city/${arr[0]}`, function( data ) {

            $('#kabupaten')
            .find('option')
            .remove()
            .end()

            $('#kecamatan')
            .find('option')
            .remove()
            .end()
           
            $.each(data, function (i, item) {
                console.log(item)
                $('#kabupaten')
                .append($('<option>', { 
                    value: [item.id_kota, item.kota, item.kode_pos],
                    text : item.kota,
                }));
            });
        });
    });

    $('#kabupaten').change(function(data) {

        const val = data.target.value;
        const arr = val.split(',');

        $.get( `/subdistrict/${arr[0]}`, function( data ) {
            
            $('#kecamatan')
            .find('option')
            .remove()
            .end()
           
           $('#kode_pos').val(arr[2]);
            $.each(data, function (i, item) {
                console.log(item)
                $('#kecamatan').append($('<option>', { 
                    value: [item.subsdistrict_id, item.subsdistrict_name],
                    text : item.subsdistrict_name 
                }));
            });
        });
    });

</script>

<?= $this->endSection()  ?>
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
                                    <a class="nav-link <?= ($segments[0] == "orders" ? "active" : null) ?>" id="orders-tab" href="<?= base_url('orders') ?>"><i class="fa fa-shopping-basket mr-15"></i>Orders</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($segments[0] == "tracking" ? "active" : null) ?>" id="track-orders-tab" href="<?= base_url('tracking') ?>" role="tab" aria-controls="track-orders" aria-selected="false"><i class="fa fa-paper-plane mr-15"></i>Track Your Order</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($segments[0] == "address" || $segments[0] == "billing-address" || $segments[0] == "shipping-address" || $segments[0] == "edit-billing" || $segments[0] == "edit-shipping" ? "active" : null) ?>" id="address-tab" href="<?= base_url('address') ?>" role="tab" aria-controls="address" aria-selected="true"><i class="fa fa-map-marked mr-15"></i>My Address</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($segments[0] == "profile" ? "active" : null) ?>" id="account-detail-tab" href="<?= base_url('profile') ?>" role="tab" aria-controls="account-detail" aria-selected="true"><i class="fa fa-user-edit mr-15"></i>Account details</a>
                                </li>
                                <li class="nav-item">
                                    <?php if(count($segments) > 1) : ?>
                                    <a class="nav-link <?= ($segments[1] == "affiliate" ? "active" : null) ?>" id="upgrade-tab" href="<?= base_url('upgrade/affiliate') ?>" role="tab" aria-controls="upgrade" aria-selected="true"><i class="fa fa-upload mr-15"></i>Upgrade Affiliate</a>
                                    <?php else : ?>
                                    <a class="nav-link <?= ($segments[0] == "affiliate" ? "active" : null) ?>" id="upgrade-tab" href="<?= base_url('upgrade/affiliate') ?>" role="tab" aria-controls="upgrade" aria-selected="true"><i class="fa fa-upload mr-15"></i>Upgrade Affiliate</a>    
                                    <?php endif; ?>
                                </li>
                                 <li class="nav-item">
                                    <?php if(count($segments) > 1): ?>
                                    <a class="nav-link <?= ($segments[1] == "stockist" ? "active" : null) ?>" id="upgrade-tab" href="<?= base_url('upgrade/stockist') ?>" role="tab" aria-controls="upgrade" aria-selected="true"><i class="fa fa-upload mr-15"></i>Upgrade Stockist</a>
                                    <?php else : ?>
                                    <a class="nav-link <?= ($segments[0] == "stockist" ? "active" : null) ?>" id="upgrade-tab" href="<?= base_url('upgrade/stockist') ?>" role="tab" aria-controls="upgrade" aria-selected="true"><i class="fa fa-upload mr-15"></i>Upgrade Stockist</a> 
                                <?php endif; ?>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link text-white" href="/logout"><i class="text-white fa fa-lock mr-15"></i>Logout</a>
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
                                            <h5 class="mb-0">Your Orders</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Order</th>
                                                            <th>Date</th>
                                                            <th>Status</th>
                                                            <th>Total</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>#1357</td>
                                                            <td>March 45, 2020</td>
                                                            <td>Processing</td>
                                                            <td>$125.00 for 2 item</td>
                                                            <td><a href="#" class="btn-small d-block">View</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>#2468</td>
                                                            <td>June 29, 2020</td>
                                                            <td>Completed</td>
                                                            <td>$364.00 for 5 item</td>
                                                            <td><a href="#" class="btn-small d-block">View</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>#2366</td>
                                                            <td>August 02, 2020</td>
                                                            <td>Completed</td>
                                                            <td>$280.00 for 3 item</td>
                                                            <td><a href="#" class="btn-small d-block">View</a></td>
                                                        </tr>
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
                                            <div class="dropdown">
                                              <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                Tambah Address
                                              </button>
                                              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li><a class="dropdown-item" href="<?php base_url() ?>/billing-address">Billing</a></li>
                                                <li><a class="dropdown-item" href="<?php base_url() ?>/shipping-address">Shipping</a></li>
                                              </ul>
                                            </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="card mb-3 mb-lg-0">
                                                <div class="card-header">
                                                    <h5 class="mb-0">Billing Address</h5>
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
                                                    <a href="<?php base_url() ?>/edit-billing" class="btn-small">Edit</a>
                                                    <a href="<?php base_url() ?>/address/delete/<?= $billing_address[0]->id ?>" class="btn-small">Hapus</a>

                                                    <?php endif ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
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
                                        </div>
                                    </div>
                                </div>
                            <?php elseif($segments[0] == "billing-address"): ?>
                                <div class="tab-pane fade active show" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Tambah Alamat Billing</h5>
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
                                                        <label>Kode Pos<span class="required">*</span></label>
                                                        <input required="" class="form-control square" name="kode_pos" type="text">
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
                            <?php elseif($segments[0] == "shipping-address"): ?>
                                <div class="tab-pane fade active show" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Tambah Alamat Shipping</h5>
                                        </div>
                                        <div class="card-body">
                                            <?php $id = user()->id; ?>
                                            <form method="post" action="/shipping-address/<?= $id ?>">
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
                                                        <label>Kode Pos<span class="required">*</span></label>
                                                        <input required="" class="form-control square" name="kode_pos" type="text">
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
                                            <h5>Ubah Alamat Billing</h5>
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
                                                                <label>Kode Pos<span class="required">*</span></label>
                                                                <input value="<?= $address->kode_pos ?>" required="" class="form-control square" name="kode_pos" type="text">
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
                                                                <label>Kode Pos<span class="required">*</span></label>
                                                                <input value="<?= $address->kode_pos ?>" required="" class="form-control square" name="kode_pos" type="text">
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
                                            <h5>Account Details</h5>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" action="/profile">
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label>Full Name <span class="required">*</span></label>
                                                        <input required="" class="form-control square" name="fullname" type="text">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Username <span class="required">*</span></label>
                                                        <input required="" class="form-control square" name=username type="text">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Email Address <span class="required">*</span></label>
                                                        <input required="" class="form-control square" name="email" type="email">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Current Password <span class="required">*</span></label>
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
                                            <p class="pb-5 mb-20">
                                                Silahkan 
                                            </p>
                                            <?php if(!empty(session()->getFlashdata('success'))): ?>

                                                <div class="alert alert-success bg-success text-white">
                                                    <?php echo session()->getFlashdata('success');?>
                                                </div>

                                            <?php else : ?>
                                                <div >
                                                </div>
                                            <?php endif ?>
                                             <?php $id = user()->id; ?>
                                            <form method="post" action="<?= base_url()  ?>/upgrades/<?= $id  ?>" enctype="multipart/form-data">
                                                <div class="form-group col-md-12">
                                                    <label>Bukti Transfer <span class="required">*</span></label>
                                                    <input required class="form-control square" name="file" type="file">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Pilih Tipe Akun <span class="required">*</span></label>
                                                    <select required="" class="form-control square" name="type" id="type">
                                                        <option selected value="affiliate">affiliate</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3 form-check">
                                                    <input type="checkbox" required class="form-check-input" id="exampleCheck1">
                                                    <label class="form-check-label" for="exampleCheck1">Saya benar telah mendapatkan kode dari admin</label>
                                                  </div>
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-sm btn-fill-out submit" name="submit" value="Submit">
                                                        <i class="fa fa-upload"></i> Upgrade
                                                    </button>
                                                </div>
                                            </form>
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
                                            <h5>Upgrade Akun</h5>
                                        </div>
                                        <div class="card-body">
                                            <p class="pb-5 mb-20">
                                                Silahkan 
                                            </p>
                                            <?php if(!empty(session()->getFlashdata('success'))): ?>

                                                <div class="alert alert-success bg-success text-white">
                                                    <?php echo session()->getFlashdata('success');?>
                                                </div>

                                            <?php else : ?>
                                                <div >
                                                </div>
                                            <?php endif ?>
                                             <?php $id = user()->id; ?>
                                            <form method="post" action="<?= base_url()  ?>/upgrades/<?= $id  ?>">
                                                <div class="form-group col-md-12">
                                                    <label>Kode <span class="required">*</span></label>
                                                    <input required class="form-control square" name="code" type="text">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Pilih Tipe Akun <span class="required">*</span></label>
                                                    <select required="" class="form-control square" name="type" id="type">
                                                        <option selected value="affiliate">affiliate</option>
                                                        <option selected value="stockist">Stockist</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-sm btn-fill-out submit" name="submit" value="Submit">
                                                        <i class="fa fa-upload"></i> Upgrade
                                                    </button>
                                                </div>
                                            </form>
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
                                                <p>
                                                    <?php foreach (user()->getRoles() as $role): ?>
                                                        <?= $role ?>
                                                    <?php endforeach ?>
                                                </p>

                                            </div>
                                            <div class="row my-3">
                                                <div class="col-lg-6">
                                                    <div class="card bg-primary">
                                                        <div class="card-body">
                                                            <h2 class="text-white">35</h2>
                                                            <p class="text-white">Total Orders</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="card bg-danger">
                                                        <div class="card-body">
                                                            <h2 class="text-white">35</h2>
                                                            <p class="text-white">Total Orders</p>
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
    $.get( "https://api.binderbyte.com/wilayah/provinsi?api_key=a5a1a7f6f6c9392dee2d0a5183eef3065eead977634d64a845b4d1051491ae6d", function( data ) {
        $.each(data.value, function (i, item) {
            $('#provinsi').append($('<option>', { 
                value: [item.id, item.name],
                text : item.name
            }));
        });
    });


    $('#provinsi').change(function(data) {
        const val = data.target.value;
        const arr = val.split(',');
        $.get( `https://api.binderbyte.com/wilayah/kabupaten?api_key=a5a1a7f6f6c9392dee2d0a5183eef3065eead977634d64a845b4d1051491ae6d&id_provinsi=${arr[0]}`, function( data ) {
            $('#kabupaten')
            .find('option')
            .remove()
            .end()

            $('#kecamatan')
            .find('option')
            .remove()
            .end()

            $.each(data.value, function (i, item) {
                $('#kabupaten')
                .append($('<option>', { 
                    value: [item.id, item.name],
                    text : item.name,
                }));
            });
        });
    });

    $('#kabupaten').change(function(data) {
        const val = data.target.value;
        const arr = val.split(',');

        $.get( `https://api.binderbyte.com/wilayah/kecamatan?api_key=a5a1a7f6f6c9392dee2d0a5183eef3065eead977634d64a845b4d1051491ae6d&id_kabupaten=${arr[0]}`, function( data ) {
            
            $('#kecamatan')
            .find('option')
            .remove()
            .end()

            $.each(data.value, function (i, item) {
                $('#kecamatan').append($('<option>', { 
                    value: [item.id, item.name],
                    text : item.name 
                }));
            });
        });
    });

        if (!('remove' in Element.prototype)) {
        Element.prototype.remove = function () {
          if (this.parentNode) {
            this.parentNode.removeChild(this);
          }
        };
      }

      mapboxgl.accessToken = 'pk.eyJ1IjoiaW1yb25wdWppIiwiYSI6ImNrcWllYWptcjBnNGkycG81NnZ6ZjJ4aGEifQ.rtzqR7kNhMsubMbsnLoJcA';

      /**
       * Add the map to the page
       */
      var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/light-v10',
        center: [-77.034084142948, 38.909671288923],
        zoom: 13,
        scrollZoom: false
      });

      var stores = {
        'type': 'FeatureCollection',
        'features': [
          {
            'type': 'Feature',
            'geometry': {
              'type': 'Point',
              'coordinates': [-77.034084142948, 38.909671288923]
            },
            'properties': {
              'phoneFormatted': '(202) 234-7336',
              'phone': '2022347336',
              'address': '1471 P St NW',
              'city': 'Washington DC',
              'country': 'United States',
              'crossStreet': 'at 15th St NW',
              'postalCode': '20005',
              'state': 'D.C.'
            }
          },
          {
            'type': 'Feature',
            'geometry': {
              'type': 'Point',
              'coordinates': [-77.049766, 38.900772]
            },
            'properties': {
              'phoneFormatted': '(202) 507-8357',
              'phone': '2025078357',
              'address': '2221 I St NW',
              'city': 'Washington DC',
              'country': 'United States',
              'crossStreet': 'at 22nd St NW',
              'postalCode': '20037',
              'state': 'D.C.'
            }
          },
          {
            'type': 'Feature',
            'geometry': {
              'type': 'Point',
              'coordinates': [-77.043929, 38.910525]
            },
            'properties': {
              'phoneFormatted': '(202) 387-9338',
              'phone': '2023879338',
              'address': '1512 Connecticut Ave NW',
              'city': 'Washington DC',
              'country': 'United States',
              'crossStreet': 'at Dupont Circle',
              'postalCode': '20036',
              'state': 'D.C.'
            }
          },
          {
            'type': 'Feature',
            'geometry': {
              'type': 'Point',
              'coordinates': [-77.0672, 38.90516896]
            },
            'properties': {
              'phoneFormatted': '(202) 337-9338',
              'phone': '2023379338',
              'address': '3333 M St NW',
              'city': 'Washington DC',
              'country': 'United States',
              'crossStreet': 'at 34th St NW',
              'postalCode': '20007',
              'state': 'D.C.'
            }
          },
          {
            'type': 'Feature',
            'geometry': {
              'type': 'Point',
              'coordinates': [-77.002583742142, 38.887041080933]
            },
            'properties': {
              'phoneFormatted': '(202) 547-9338',
              'phone': '2025479338',
              'address': '221 Pennsylvania Ave SE',
              'city': 'Washington DC',
              'country': 'United States',
              'crossStreet': 'btwn 2nd & 3rd Sts. SE',
              'postalCode': '20003',
              'state': 'D.C.'
            }
          },
          {
            'type': 'Feature',
            'geometry': {
              'type': 'Point',
              'coordinates': [-76.933492720127, 38.99225245786]
            },
            'properties': {
              'address': '8204 Baltimore Ave',
              'city': 'College Park',
              'country': 'United States',
              'postalCode': '20740',
              'state': 'MD'
            }
          },
          {
            'type': 'Feature',
            'geometry': {
              'type': 'Point',
              'coordinates': [-77.097083330154, 38.980979]
            },
            'properties': {
              'phoneFormatted': '(301) 654-7336',
              'phone': '3016547336',
              'address': '4831 Bethesda Ave',
              'cc': 'US',
              'city': 'Bethesda',
              'country': 'United States',
              'postalCode': '20814',
              'state': 'MD'
            }
          },
          {
            'type': 'Feature',
            'geometry': {
              'type': 'Point',
              'coordinates': [-77.359425054188, 38.958058116661]
            },
            'properties': {
              'phoneFormatted': '(571) 203-0082',
              'phone': '5712030082',
              'address': '11935 Democracy Dr',
              'city': 'Reston',
              'country': 'United States',
              'crossStreet': 'btw Explorer & Library',
              'postalCode': '20190',
              'state': 'VA'
            }
          },
          {
            'type': 'Feature',
            'geometry': {
              'type': 'Point',
              'coordinates': [-77.10853099823, 38.880100922392]
            },
            'properties': {
              'phoneFormatted': '(703) 522-2016',
              'phone': '7035222016',
              'address': '4075 Wilson Blvd',
              'city': 'Arlington',
              'country': 'United States',
              'crossStreet': 'at N Randolph St.',
              'postalCode': '22203',
              'state': 'VA'
            }
          },
          {
            'type': 'Feature',
            'geometry': {
              'type': 'Point',
              'coordinates': [-75.28784, 40.008008]
            },
            'properties': {
              'phoneFormatted': '(610) 642-9400',
              'phone': '6106429400',
              'address': '68 Coulter Ave',
              'city': 'Ardmore',
              'country': 'United States',
              'postalCode': '19003',
              'state': 'PA'
            }
          },
          {
            'type': 'Feature',
            'geometry': {
              'type': 'Point',
              'coordinates': [-75.20121216774, 39.954030175164]
            },
            'properties': {
              'phoneFormatted': '(215) 386-1365',
              'phone': '2153861365',
              'address': '3925 Walnut St',
              'city': 'Philadelphia',
              'country': 'United States',
              'postalCode': '19104',
              'state': 'PA'
            }
          },
          {
            'type': 'Feature',
            'geometry': {
              'type': 'Point',
              'coordinates': [-77.043959498405, 38.903883387232]
            },
            'properties': {
              'phoneFormatted': '(202) 331-3355',
              'phone': '2023313355',
              'address': '1901 L St. NW',
              'city': 'Washington DC',
              'country': 'United States',
              'crossStreet': 'at 19th St',
              'postalCode': '20036',
              'state': 'D.C.'
            }
          }
        ]
      };

      /**
       * Assign a unique id to each store. You'll use this `id`
       * later to associate each point on the map with a listing
       * in the sidebar.
       */
      stores.features.forEach(function (store, i) {
        store.properties.id = i;
      });

      /**
       * Wait until the map loads to make changes to the map.
       */
      map.on('load', function (e) {
        /**
         * This is where your '.addLayer()' used to be, instead
         * add only the source without styling a layer
         */
        map.addSource('places', {
          'type': 'geojson',
          'data': stores
        });

        /**
         * Create a new MapboxGeocoder instance.
         */
        var geocoder = new MapboxGeocoder({
          accessToken: mapboxgl.accessToken,
          mapboxgl: mapboxgl,
          marker: true,
          bbox: [-77.210763, 38.803367, -76.853675, 39.052643]
        });

        /**
         * Add all the things to the page:
         * - The location listings on the side of the page
         * - The search box (MapboxGeocoder) onto the map
         * - The markers onto the map
         */
        buildLocationList(stores);
        map.addControl(geocoder, 'top-left');
        addMarkers();

        /**
         * Listen for when a geocoder result is returned. When one is returned:
         * - Calculate distances
         * - Sort stores by distance
         * - Rebuild the listings
         * - Adjust the map camera
         * - Open a popup for the closest store
         * - Highlight the listing for the closest store.
         */
        geocoder.on('result', function (ev) {
          /* Get the coordinate of the search result */
          var searchResult = ev.result.geometry;

          /**
           * Calculate distances:
           * For each store, use turf.disance to calculate the distance
           * in miles between the searchResult and the store. Assign the
           * calculated value to a property called `distance`.
           */
          var options = { units: 'miles' };
          stores.features.forEach(function (store) {
            Object.defineProperty(store.properties, 'distance', {
              value: turf.distance(searchResult, store.geometry, options),
              writable: true,
              enumerable: true,
              configurable: true
            });
          });

          /**
           * Sort stores by distance from closest to the `searchResult`
           * to furthest.
           */
          stores.features.sort(function (a, b) {
            if (a.properties.distance > b.properties.distance) {
              return 1;
            }
            if (a.properties.distance < b.properties.distance) {
              return -1;
            }
            return 0; // a must be equal to b
          });

          /**
           * Rebuild the listings:
           * Remove the existing listings and build the location
           * list again using the newly sorted stores.
           */
          var listings = document.getElementById('listings');
          while (listings.firstChild) {
            listings.removeChild(listings.firstChild);
          }
          buildLocationList(stores);

          /* Open a popup for the closest store. */
          createPopUp(stores.features[0]);

          /** Highlight the listing for the closest store. */
          var activeListing = document.getElementById(
            'listing-' + stores.features[0].properties.id
          );
          activeListing.classList.add('active');

          /**
           * Adjust the map camera:
           * Get a bbox that contains both the geocoder result and
           * the closest store. Fit the bounds to that bbox.
           */
          var bbox = getBbox(stores, 0, searchResult);
          map.fitBounds(bbox, {
            padding: 100
          });
        });
      });

      /**
       * Using the coordinates (lng, lat) for
       * (1) the search result and
       * (2) the closest store
       * construct a bbox that will contain both points
       */
      function getBbox(sortedStores, storeIdentifier, searchResult) {
        var lats = [
          sortedStores.features[storeIdentifier].geometry.coordinates[1],
          searchResult.coordinates[1]
        ];
        var lons = [
          sortedStores.features[storeIdentifier].geometry.coordinates[0],
          searchResult.coordinates[0]
        ];
        var sortedLons = lons.sort(function (a, b) {
          if (a > b) {
            return 1;
          }
          if (a.distance < b.distance) {
            return -1;
          }
          return 0;
        });
        var sortedLats = lats.sort(function (a, b) {
          if (a > b) {
            return 1;
          }
          if (a.distance < b.distance) {
            return -1;
          }
          return 0;
        });
        return [
          [sortedLons[0], sortedLats[0]],
          [sortedLons[1], sortedLats[1]]
        ];
      }

      /**
       * Add a marker to the map for every store listing.
       **/
      function addMarkers() {
        /* For each feature in the GeoJSON object above: */
        stores.features.forEach(function (marker) {
          /* Create a div element for the marker. */
          var el = document.createElement('div');
          /* Assign a unique `id` to the marker. */
          el.id = 'marker-' + marker.properties.id;
          /* Assign the `marker` class to each marker for styling. */
          el.className = 'marker';

          /**
           * Create a marker using the div element
           * defined above and add it to the map.
           **/
          new mapboxgl.Marker(el, { offset: [0, -23] })
            .setLngLat(marker.geometry.coordinates)
            .addTo(map);

          /**
           * Listen to the element and when it is clicked, do three things:
           * 1. Fly to the point
           * 2. Close all other popups and display popup for clicked store
           * 3. Highlight listing in sidebar (and remove highlight for all other listings)
           **/
          el.addEventListener('click', function (e) {
            flyToStore(marker);
            createPopUp(marker);
            var activeItem = document.getElementsByClassName('active');
            e.stopPropagation();
            if (activeItem[0]) {
              activeItem[0].classList.remove('active');
            }
            var listing = document.getElementById(
              'listing-' + marker.properties.id
            );
            listing.classList.add('active');
          });
        });
      }

      /**
       * Add a listing for each store to the sidebar.
       **/
      function buildLocationList(data) {
        data.features.forEach(function (store, i) {
          /**
           * Create a shortcut for `store.properties`,
           * which will be used several times below.
           **/
          var prop = store.properties;

          /* Add a new listing section to the sidebar. */
          var listings = document.getElementById('listings');
          var listing = listings.appendChild(document.createElement('div'));
          /* Assign a unique `id` to the listing. */
          listing.id = 'listing-' + prop.id;
          /* Assign the `item` class to each listing for styling. */
          listing.className = 'item';

          /* Add the link to the individual listing created above. */
          var link = listing.appendChild(document.createElement('a'));
          link.href = '#';
          link.className = 'title';
          link.id = 'link-' + prop.id;
          link.innerHTML = prop.address;

          /* Add details to the individual listing. */
          var details = listing.appendChild(document.createElement('div'));
          details.innerHTML = prop.city;
          if (prop.phone) {
            details.innerHTML += ' &middot; ' + prop.phoneFormatted;
          }
          if (prop.distance) {
            var roundedDistance = Math.round(prop.distance * 100) / 100;
            details.innerHTML +=
              '<p><strong>' + roundedDistance + ' miles away</strong></p>';
          }

          /**
           * Listen to the element and when it is clicked, do four things:
           * 1. Update the `currentFeature` to the store associated with the clicked link
           * 2. Fly to the point
           * 3. Close all other popups and display popup for clicked store
           * 4. Highlight listing in sidebar (and remove highlight for all other listings)
           **/
          link.addEventListener('click', function (e) {
            for (var i = 0; i < data.features.length; i++) {
              if (this.id === 'link-' + data.features[i].properties.id) {
                var clickedListing = data.features[i];
                flyToStore(clickedListing);
                createPopUp(clickedListing);
              }
            }
            var activeItem = document.getElementsByClassName('active');
            if (activeItem[0]) {
              activeItem[0].classList.remove('active');
            }
            this.parentNode.classList.add('active');
          });
        });
      }

      /**
       * Use Mapbox GL JS's `flyTo` to move the camera smoothly
       * a given center point.
       **/
      function flyToStore(currentFeature) {
        map.flyTo({
          center: currentFeature.geometry.coordinates,
          zoom: 15
        });
      }

      /**
       * Create a Mapbox GL JS `Popup`.
       **/
      function createPopUp(currentFeature) {
        var popUps = document.getElementsByClassName('mapboxgl-popup');
        if (popUps[0]) popUps[0].remove();

        var popup = new mapboxgl.Popup({ closeOnClick: false })
          .setLngLat(currentFeature.geometry.coordinates)
          .setHTML(
            '<h3>Sweetgreen</h3>' +
              '<h4>' +
              currentFeature.properties.address +
              '</h4>'
          )
          .addTo(map);
      }
</script>

<?= $this->endSection()  ?>
<?= $this->extend('commerce/templates/index') ?>
<?= $this->section('content') ?>
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html" rel="nofollow">Home</a>
            <span></span> Shop
            <span></span> Checkout
        </div>
    </div>
</div>
<section class="mt-60 mb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="toggle_info">
                    <span><i class="far fa-user mr-5"></i><span class="text-muted">Already have an account?</span> <a href="#loginform" data-bs-toggle="collapse" class="collapsed" aria-expanded="false">Click here to login</a></span>
                </div>
                <div class="panel-collapse collapse login_form" id="loginform">
                    <div class="panel-body">
                        <p class="mb-30 font-sm">If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing &amp; Shipping section.</p>
                        <form method="post">
                            <div class="form-group">
                                <input type="text" name="email" placeholder="Username Or Email">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" placeholder="Password">
                            </div>
                            <div class="login_footer form-group">
                                <div class="chek-form">
                                    <div class="custome-checkbox">
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="remember" value="">
                                        <label class="form-check-label" for="remember"><span>Remember me</span></label>
                                    </div>
                                </div>
                                <a href="#">Forgot password?</a>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-md btn-rounded" name="login">Log in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="toggle_info">
                    <span><i class="far fa-gem mr-5"></i><span class="text-muted">Have a coupon?</span> <a href="#coupon" data-bs-toggle="collapse" class="collapsed" aria-expanded="false">Click here to enter your code</a></span>
                </div>
                <div class="panel-collapse collapse coupon_form " id="coupon">
                    <div class="panel-body">
                        <p class="mb-30 font-sm">If you have a coupon code, please apply it below.</p>
                        <form method="post">
                            <div class="form-group">
                                <input type="text" placeholder="Enter Coupon Code...">
                            </div>
                            <div class="form-group">
                                <button class="btn  btn-rounded btn-md" name="login">Apply Coupon</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="divider mt-50 mb-50"></div>
            </div>
        </div>
        <div class="row">
           <!--  <div class="col-md-6">
                <div class="mb-25">
                    <h4>Billing Details</h4>
                </div>
                <form method="post">
                    <div class="form-group">
                        <input type="text" required="" value="<?= user()->username; ?>" name="fname" placeholder="Username">
                    </div>
                    <div class="form-group">
                    <div class="form-group">
                        <input type="text" name="kecamatan" value="<?= $address[0]->kecamatan; ?>" required="" placeholder="Kecamatan *">
                    </div>
                    <div class="form-group">
                        <input type="text" name="kabupaten"  value="<?= $address[0]->kabupaten ?>" required="" placeholder="Kabupaten">
                    </div>
                    <div class="form-group">
                        <input required="" type="text"  name="provinsi"  value="<?= $address[0]->provinsi ?>" placeholder="Provinsi*">
                    </div>
                    <div class="form-group">
                        <input required="" type="text"  name="desa"  value="<?= $address[0]->desa ?>" placeholder="desa*">
                    </div>
                    <div class="form-group">
                        <input required="" type="text"  name="kode_pos"  value="<?= $address[0]->kode_pos ?>" placeholder="Postcode / ZIP *">
                    </div>
                        <input required="" type="text" name="email" value="<?= user()->email ?>" placeholder="Email address[0] *">
                    </div>
                </form>
            </div> -->
            <div class="col-md-12">
                <div class="order_review">
                    <div class="mb-20">
                        <h4>Your Orders</h4>
                    </div>
                    <div class="table-responsive order_table text-center">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Product</th>
                                    <th>amount</th>
                                    <th>harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($carts as $cart):?>
                                    <?php foreach ($cart['products'] as $product): ?>
                                        <tr style="height:30px">
                                            <td style="width:40px; "><img src="<?= $product->photos; ?>" style="width:60%; height:100px"></td>
                                            <td style="width: 100px"><?= $product->name ?></td>
                                            <td style="width: 100px"><?= $product->amount ?></td>
                                            <td style="width: 100px"><?= $product->sell_price ?></td>
                                        </tr>
                                        
                                    <?php endforeach; ?>
                                    <tr>
                                        <th colspan="1"><h4>Penjual</h4></th>
                                        <td colspan="1" class="product-subtotal">
                                            <span class="font-xl text-brand fw-900"><?= $cart['locate'];  ?></span>
                                        </td>
                                        <td colspan="2" class="product-subtotal" style="width:150px">
                                            <span>
                                                produkmu akan dikirim dari kecamatan <?= $cart['kecamatan'];  ?> <br>      
                                                kabupaten <?= $cart['kabupaten'];  ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="1"><h4>Pilih Kurir</h4></th>
                                        <td colspan="1" class="product-subtotal">
                                            <span class="font-xl text-brand fw-900">
                                                <form method="POST" action="<?= base_url()  ?>/transaksi/check">
                                                    <input style="display: none" type="text" name="origin" value="<?= $billing->city_id ?>" >
                                                    <input style="display: none" type="text" name="destination" value="<?= $cart['id_kota'] ?>" >
                                                    <input style="display: none" type="text" name="distributor_id" value="<?= $cart['distributor_id'] ?>" >
                                                     <input style="display: none" type="text" name="weight" value="<?= $cart['weight'][0] ?>" >
                                                     <input style="display: none" type="text" name="cart_id" value="<?= $cart['cart_id'][0] ?>" >
                                                    <select type="submit" name="courier" onchange="this.form.submit()">
                                                        <option selected disabled>Pilih Kurir</option>
                                                        <option value="jne">JNE</option>
                                                        <option value="pos">POS</option>
                                                        <option value="jnt">JNT</option>
                                                    </select>
                                                </form>
                                            </span>
                                        </td>
                                        <td>
                                            dikirim Lewat
                                            <?= $cart['kurir'] ?>
                                        </td>
                                        <td>
                                            <?= $cart['ongkir'] ?> ||
                                            <?= $cart['etd'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>sub total</th>
                                        <td colspan="3" class="product-subtotal"><span class="font-xl text-brand fw-900"><?= $cart['subtotal'][0];?></span></td>
                                    </tr>
                                    
                                <?php endforeach; ?>
                                    <tr>
                                        <th><h3>Total Tagihan</h3></th>
                                        <td><?= $total;  ?></td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                    <form action="<?= base_url() ?>/transaksi/save" method="post">
                        <div class="payment_method">
                            <div class="mb-25">
                                <h5>Payment</h5>
                            </div>
                            <div class="payment_option">
                                <div class="custome-radio">
                                    <select name="bill">
                                        <?php foreach ($bills as $bill): ?>
                                                <option value="<?= $bill->id  ?>"><?= $bill->bank_name ?> - <?= $bill->bank_number ?>
                                                    
                                                </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <input type="number" style="display: none" name="total" value="<?= $total;  ?>">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-fill-out btn-block mt-30">Place Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
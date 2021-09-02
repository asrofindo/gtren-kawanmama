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
            <div class="col-md-6">
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
            </div>
            <div class="col-md-6">
                <div class="order_review">
                    <div class="mb-20">
                        <h4>Your Orders</h4>
                    </div>
                    <div class="table-responsive order_table text-center">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="2">Product</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($carts as $cart):?>
                                <tr>
                                    <td class="image product-thumbnail"><img src="assets/imgs/shop/product-1-2.jpg" alt="#"></td>
                                    <td><a href="shop-product-full.html"><?= $cart->name ?></a> <span class="product-qty">x <?= $cart->amount ?></span></td>
                                    <td><?= $cart->total ?></td>
                                </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <th>Shipping</th>
                                    <td colspan="2"><em><button class="btn-sm">JNE</button></em></td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td colspan="2" class="product-subtotal"><span class="font-xl text-brand fw-900"><?= $total;  ?></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                    <div class="payment_method">
                        <div class="mb-25">
                            <h5>Payment</h5>
                        </div>
                        <div class="payment_option">
                            <?php foreach ($bills as $bill): ?>
                            <div class="custome-radio">
                                <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios3" checked="">
                                <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse" data-target="#bankTranfer" aria-controls="bankTranfer"><?= $bill->bank_name ?>r</label>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <a href="#" class="btn btn-fill-out btn-block mt-30">Place Order</a>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
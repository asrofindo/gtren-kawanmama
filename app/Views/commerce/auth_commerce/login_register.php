<?= $this->extend('commerce/templates/index') ?>
<?= $this->section('content') ?>
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="<?= base_url()?>">Home</a>
            <span></span> Pages
            <span></span> Login / Register
        </div>
    </div>
</div>
<section class="pt-40 pb-20">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 m-auto">
                <div class="row">
                    <div class="col-lg-5">
                       <?= view('Myth\Auth\Views\_message_block') ?>
                        <div class="login_wrap widget-taber-content p-30 background-white border-radius-10">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h3 class="mb-30">Login</h3>
                                </div>
                                <form action="<?= route_to('login') ?>" method="post">
                                <?= csrf_field() ?>
                                <?php if ($config->validFields === ['email']): ?>
                                    <div class="form-group">
                                        <label for="login"><?=lang('Auth.email')?></label>
                                        <input type="email" class="form-control <?php if(session('errors.login')) : ?>is-invalid<?php endif ?>"
                                               name="login" placeholder="<?=lang('Auth.email')?>">
                                        <div class="invalid-feedback">
                                            <?= session('errors.login') ?>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="form-group">
                                        <label for="login"><?=lang('Auth.emailOrUsername')?></label>
                                        <input type="text" class="form-control <?php if(session('errors.login')) : ?>is-invalid<?php endif ?>"
                                               name="login" placeholder="<?=lang('Auth.emailOrUsername')?>">
                                        <div class="invalid-feedback">
                                            <?= session('errors.login') ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                    <div class="form-group">
                                        <label for="password"><?=lang('Auth.password')?></label>
                                        <input type="password" name="password" class="form-control  <?php if(session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.password')?>">
                                        <div class="invalid-feedback">
                                            <?= session('errors.password') ?>
                                        </div>
                                    </div>

                                <?php if ($config->allowRemembering): ?>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="remember" class="form-check-input" <?php if(old('remember')) : ?> checked <?php endif ?>>
                                            <?=lang('Auth.rememberMe')?>
                                        </label>
                                    </div>
                                <?php endif; ?>
                                    <button type="submit" class="btn btn-primary btn-block">masuk</button>
                                </form>
                                <hr>

                                <?php if ($config->allowRegistration) : ?>
                                    <p><a href="<?= route_to('register') ?>"><?=lang('Auth.needAnAccount')?></a></p>
                                <?php endif; ?>
                                <?php if ($config->activeResetter): ?>
                                    <p><a href="<?= route_to('forgot') ?>"><?=lang('Auth.forgotYourPassword')?></a></p>
                                <?php endif; ?>
                                <!-- form login end -->

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                    
                    <div class="col-lg-6">

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
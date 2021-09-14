<?= $this->extend('auth/templates/index') ?>
<?= $this->section('content') ?>
<main>
<?= $this->include('auth/templates/navbar') ?>
    <section class="content-main mt-80 mb-80">
        <div class="card mx-auto card-login">
            <div class="card-body">
                <h4 class="card-title mb-4">Masuk</h4>
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
                        <br>
                    <?php endif; ?>

                        <div class="form-group">
                            <label for="password"><?=lang('Auth.password')?></label>
                            <input type="password" name="password" class="form-control  <?php if(session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.password')?>">
                            <div class="invalid-feedback">
                                <?= session('errors.password') ?>
                            </div>
                        </div>
                        <br>
                    <?php if ($config->allowRemembering): ?>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" name="remember" class="form-check-input" <?php if(old('remember')) : ?> checked <?php endif ?>>
                                <?=lang('Auth.rememberMe')?>
                            </label>
                        </div>
                    <?php endif; ?>
                        <br>
                        <button type="submit" class="btn btn-primary btn-block  w-100"><?=lang('Auth.loginAction')?></button>
                    </form>
                    <br>
                <p class="text-center mb-4">Don't have account? <a href="<?php base_url() ?>/auth/register">Sign up</a></p>
            </div>
        </div>
    </section>

    <?= $this->include('auth/templates/footer') ?>
</main>
<?= $this->endSection() ?> 
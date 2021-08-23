
<div class="container">
    <form action="<?= base_url('register_proses') ?>" method="post">
    <?php if (isset($_GET['ref'])): ?>
        <input type="hidden" name="ref" value="<?= $_GET['ref'] ?>">
    <?php else: ?>
        <input type="hidden" name="ref" value="">
    <?php endif; ?>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Nama</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nama"><br>
         <label for="exampleInputEmail1" class="form-label">Phone</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="phone"><br>
         <label for="exampleInputEmail1" class="form-label">Email</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email"><br>
         <label for="exampleInputEmail1" class="form-label">Alamat</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="alamat">

    </div>
    <button type="submit" class="btn btn-primary" name="button">Submit</button>
</form>
</div>
  <?= $this->extend('auth/templates/index') ?>
  <?= $this->section('content') ?>
      <main>
            <?= $this->include('auth/templates/navbar') ?>

        <section class="content-main mt-80 mb-80">
            <div class="card mx-auto card-login">
                <div class="card-body">
                    <h4 class="card-title mb-4">Create an Account</h4>
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input class="form-control" placeholder="Your email" type="text">
                        </div> <!-- form-group// -->
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <div class="row gx-2">
                                <div class="col-4"> <input class="form-control" value="+998" type="text"> </div>
                                <div class="col-8"> <input class="form-control" placeholder="Phone" type="text"> </div>
                            </div>
                        </div> <!-- form-group// -->
                        <div class="mb-3">
                            <label class="form-label">Create password</label>
                            <input class="form-control" placeholder="Password" type="password">
                        </div> <!-- form-group// -->
                        <div class="mb-3">
                            <p class="small text-center text-muted">By signing up, you confirm that you’ve read and accepted our User Notice and Privacy Policy.</p>
                        </div> <!-- form-group  .// -->
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary w-100"> Login </button>
                        </div> <!-- form-group// -->
                    </form>
                    <p class="text-center mb-2">Already have an account? <a href="#">Sign in now</a></p>
                </div>
            </div>
        </section>
                   <?= $this->include('auth/templates/footer') ?>

    </main>
  <?= $this->endSection() ?>

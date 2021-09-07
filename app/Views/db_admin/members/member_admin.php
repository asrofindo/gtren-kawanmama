<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Member </h2>
        <p>Add, edit or delete a Member</p>
    </div>
    <div>
        <form method="post" action="<?= base_url('/members') ?>">            
            <input type="text" placeholder="Search Username" class="form-control" name="user">
            <input type="text" placeholder="Search role" class="form-control" name="role">
            <button type="submit" class="btn btn-info btn-sm w-100 m-1"> search </button>
        </form>
    </div>
</div>
<?= view('Myth\Auth\Views\_message_block') ?>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
               <form action="<?= route_to('register') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <label for="email"><?=lang('Auth.email')?></label>
                        <input type="email" class="form-control <?php if(session('errors.email')) : ?>is-invalid<?php endif ?>"
                               name="email" aria-describedby="emailHelp" placeholder="<?=lang('Auth.email')?>" value="<?= old('email') ?>">
<!--                         <small id="emailHelp" class="form-text text-muted"><?=lang('Auth.weNeverShare')?></small>
 -->                    </div>
                    <br>
                    <div class="form-group">
                        <label for="username"><?=lang('Auth.username')?></label>
                        <input type="text" class="form-control <?php if(session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?=lang('Auth.username')?>" value="<?= old('username') ?>">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="password"><?=lang('Auth.password')?></label>
                        <input type="password" name="password" class="form-control <?php if(session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.password')?>" autocomplete="off">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="pass_confirm"><?=lang('Auth.repeatPassword')?></label>
                        <input type="password" name="pass_confirm" class="form-control <?php if(session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.repeatPassword')?>" autocomplete="off">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="pass_confirm">Role Type</label>
                        <select name="role" class="form-select">
                            <option value="admin">admin</option>
                            <option value="finance">finance</option>
                        </select>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary btn-block w-100"><?=lang('Auth.register')?></button>
                    <br>
                </form>

            </div>
            <div class="col-md-9">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" />
                                    </div>
                                </th>
                                <th>username</th>
                                <th>email</th>
                                <th>akses</th>
                                <th>status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php foreach ($users as $user): ?>

                            <tr>
                                <td class="text-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" />
                                    </div>
                                </td>
                                <td><b><?= $user->username ?></b></td>
                                <td ><?= $user->email  ?></td>
                                <td><?= $user->role  ?></td>
                                <?php if($user->active == 0) : ?>
                                    <td>non active</td>
                                <?php else : ?>
                                    <td>active</td>
                                <?php endif ?>
                                <td class="text-end">
                                    <div class="dropdown">
                                        <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                        <div class="dropdown-menu">
                                        <?php if($user->active != 1) { ?>
                                            <a onclick = "return confirm('Yakin Aktivasi Akun');" class="dropdown-item" href="<?=base_url()?>/user/active/<?=$user->id?>">Active account</a>
                                        <?php }else{ ?>
                                            <a onclick = "return confirm('Yakin Non Aktivasi Akun');" class="dropdown-item" href="<?=base_url()?>/user/nonactive/<?=$user->id?>">Non Active Account</a>
                                        <?php } ?>
                                            <a onclick = "return confirm('Yakin Data Akan Dihapus');" class="dropdown-item text-danger" href="<?=base_url()?>/role/delete/<?=$user->id?>/<?=$user->role?>">Delete role</a>
                                            <a onclick = "return confirm('Yakin Data Akan Dihapus');" class="dropdown-item text-danger" href="<?=base_url()?>/user/delete/<?=$user->id?>">Delete</a>
                                        </div>
                                    </div> <!-- dropdown //end -->
                                </td>
                            </tr>
                                                           

                        <?php endforeach  ?>

                        </tbody>

                    </table>
                    <div class="pagination-area mt-30 mb-50">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-start">
                                <?php //$pager->links('users', 'product_pagination'); ?>
                                <!-- <li class="page-item active"><a class="page-link" href="#">01</a></li>
                                <li class="page-item"><a class="page-link" href="#">02</a></li>
                                <li class="page-item"><a class="page-link" href="#">03</a></li>
                                <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                                <li class="page-item"><a class="page-link" href="#">16</a></li>
                                <li class="page-item"><a class="page-link" href="#"><i class="material-icons md-chevron_right"></i></a></li> -->

                            </ul>
                        </nav>
                    </div>
                </div>
            </div> <!-- .col// -->
        </div> <!-- .row // -->
    </div> <!-- card body .// -->
</div> <!-- card .// -->
<div class="pagination-area mt-30 mb-50">

<?php $this->endSection() ?>
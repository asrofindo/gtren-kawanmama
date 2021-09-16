<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Data Pengguna </h2>
        <p>Add, edit or delete a Data</p>
    </div>
</div>
<?= view('Myth\Auth\Views\_message_block') ?>
<div class="card">
    <div class="card-body">
        <form method="post" action="<?= base_url('/members') ?>">            
            <div class="row gx-3">
            <div class="col-lg-4 col-md-6 me-auto">
                <input type="text" placeholder="Search Username..." class="form-control" name="name">
            </div>
            <div class="col-lg-2 col-6 col-md-3">
                <select class="form-select"  name="role">
                    <option>user</option>
                    <option>admin</option>
                    <option value="stockist">Distributor</option>
                    <option>affiliate</option>
                </select>
            </div>
            <div class="col-lg-2 col-6 col-md-3">
                <button type="submit" class="btn btn-info btn-sm w-100 m-1">Search </button>
            </div>
        </form>
        </div>
        <div class="row">
            <div class="col-md-12">
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
                                <th>nomor hp</th>
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
                                <td ><?= $user->phone  ?></td>
                                <?php if($user->active == 0) : ?>
                                    <td>non active</td>
                                <?php else : ?>
                                    <td>active</td>
                                <?php endif ?>
                                <td class="text-end">
                                    <div class="dropdown">
                                        <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                        <div class="dropdown-menu">
                                        <a class="dropdown-item" href="<?=base_url()?>/members/<?=$user->id?>">Detail</a>
                                        <?php if($user->active != 1) { ?>
                                            <a onclick = "return confirm('Yakin Aktivasi Akun');" class="dropdown-item" href="<?=base_url()?>/user/active/<?=$user->id?>">Active account</a>
                                        <?php }else{ ?>
                                            <a onclick = "return confirm('Yakin Non Aktivasi Akun');" class="dropdown-item" href="<?=base_url()?>/user/nonactive/<?=$user->id?>">Non Active Account</a>
                                        <?php } ?>
                                            <!-- <a onclick = "return confirm('Yakin Data Akan Dihapus');" class="dropdown-item text-danger" href="<?=base_url()?>/user/delete/<?=$user->id?>">Delete</a> -->
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
<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Jaringan Anda </h2>
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
                                <th>Tgl Daftar</th>
                                <th>Nama</th>
                                <th>No Whatsapp</th>
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
                                <td><b><?= $user->created_at ?></b></td>
                                <td ><?= $user->username ?></td>
                                <td ><a href="https://api.whatsapp.com/send?phone=<?=$user->phone?>"><?= $user->phone ?></a></td>
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
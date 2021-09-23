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

            <div class="col-lg-4 col-6 col-md-4">
                <h3>Sponsor Anda</h3>
                <h5>Nama : <?=$sponsor->fullname?></h5>
                <h5>Status : <?php if ($sponsor->role == "stockist") {
                    echo "distributor";
                }else{
                    echo $sponsor->role;
                }?></h5>
                <h5>Whatsapp : <a href="https://api.whatsapp.com/send?phone=<?=$sponsor->phone?>"><?=$sponsor->phone?></a></h5>
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
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>No Whatsapp</th>
                                <th>Status</th>
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
                                <td ><?= $user->fullname ?></td>
                                <td ><?= $user->email ?></td>
                                <td ><?php if ($user->role == "stockist") {
                                        echo "distributor";
                                    }else{
                                        echo $user->role;
                                    }?></td>
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
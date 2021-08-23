<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Member </h2>
        <p>Add, edit or delete a Member</p>
    </div>
    <div>
        <form method="post" action="<?= base_url('member/search') ?>">            
            <input type="text" placeholder="Search Username" class="form-control bg-white" name="keyword">
        </form>
    </div>
</div>
<div class="card">
    <div class="card-body">

        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Kode</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($members as $member): ?>
                           <tr>
                               <td><?= $member->username ?></td>
                               <td><?= $member->email ?></td>
                               <td><?= $member->code ?></td>
                               <td><?= status($member->status) ?></td>
                               <td>
                                   <a href="<?= base_url('user/action/verify/'. $member->id ) ?>" class="btn btn-primary btn-xs">
                                       Verifikasi
                                   </a>
                                   <a href="<?= base_url('user/action/reject/'. $member->id ) ?>" class="btn btn-secondary btn-xs bg-danger">
                                       Tolak
                                   </a>
                               </td>
                           </tr> 
                        <?php endforeach ?>

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
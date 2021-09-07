<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Order List </h2>
        <p>Lorem ipsum dolor sit amet.</p>
    </div>
    <div>
        <input type="text" placeholder="Search order ID" class="form-control bg-white">
    </div>
</div>
<div class="card mb-4">
    <header class="card-header">
        <div class="row gx-3">
            <div class="col-lg-4 col-md-6 me-auto">
                <input type="text" placeholder="Search..." class="form-control">
            </div>
            <div class="col-lg-2 col-6 col-md-3">
                <select class="form-select">
                    <option>Status</option>
                    <option>Active</option>
                    <option>Disabled</option>
                    <option>Show all</option>
                </select>
            </div>
            <div class="col-lg-2 col-6 col-md-3">
                <select class="form-select">
                    <option>Show 20</option>
                    <option>Show 30</option>
                    <option>Show 40</option>
                </select>
            </div>
        </div>
    </header> <!-- card-header end// -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Total</th>
                        <th scope="col">Status</th>
                        <th scope="col">Date</th>
                        <th scope="col" class="text-end"> Action </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $key => $value) {?>
                        <tr>
                            <td><?= $value->id?></td>
                            <td><b><?= $value->name?></b></td>
                            <td><?= $value->email?></td>
                            <td><?= $value->total?></td>

                            <td><span class="badge rounded-pill alert-success"><?= $value->status?></span></td>
                            
                            <td><?= $value->created_at?></td>
                            <td class="text-end">
                                <a href="<?= base_url()?>/order/<?= $value->id?>" class="btn btn-md rounded font-sm">Detail</a>
                                <a href="<?= base_url()?>/order/<?= $value->id?>" class="btn btn-md rounded font-sm bg-danger">Delete</a>
                            </td>
                    <?php } ?>
                    </tr>
                </tbody>
            </table>
        </div> <!-- table-responsive //end -->
    </div> <!-- card-body end// -->
</div> <!-- card end// -->
<div class="pagination-area mt-15 mb-50">
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-start">
            <li class="page-item active"><a class="page-link" href="#">01</a></li>
            <li class="page-item"><a class="page-link" href="#">02</a></li>
            <li class="page-item"><a class="page-link" href="#">03</a></li>
            <li class="page-item"><a class="page-link dot" href="#">...</a></li>
            <li class="page-item"><a class="page-link" href="#">16</a></li>
            <li class="page-item"><a class="page-link" href="#"><i class="material-icons md-chevron_right"></i></a></li>
        </ul>
    </nav>
</div>

<?php $this->endSection() ?>
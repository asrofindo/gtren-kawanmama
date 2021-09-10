<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Stockist </h2>
        <p>dana Semua Stockist</p>
    </div>
    <div>
        <input type="text" placeholder="Search pendapatan ID" class="form-control bg-white">
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
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Masuk</th>
                        <th scope="col">Keluar</th>
                        <th scope="col">Total</th>
                        <th scope="col">Date</th>
                        <th scope="col" class="text-end"> Action </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pendapatans as $pendapatan): ?>
                        <tr>
                            <td class="id"><?= $pendapatan->id; ?></td>
                            <td><b><?php echo $pendapatan->username; ?></b></td>
                            <td><?php echo $pendapatan->masuk ?></td>
                            <td><?php echo $pendapatan->keluar ?></td>
                            <td><?php echo $pendapatan->total; ?></td>
                            <td><?= $pendapatan->created_at; ?></td>
                            <td class="text-end">
                                <div class="dropdown">
                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item btn-acc">TF Dana</a>
                                    </div>
                                </div> <!-- dropdown //end -->
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div> <!-- table-responsive //end -->
    </div> <!-- card-body end// -->
</div> <!-- card end// -->
<div class="pagination-area mt-30 mb-50">
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-start">
            <?= $pager->links('pendapatan', 'product_pagination'); ?>
        </ul>
    </nav>
</div>
<!-- modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Kirim Dana</h4>
          </div>
          <div class="modal-body">
            <form action="<?php base_url()  ?>/transaksi/wd" method="post">
                <div class="mb-4">
                    <input style="display: none" type="text" id="pendapatan_id" name="pendapatan_id">
                    <input class="form-control" type="text" name="wd" placeholder="Masukan Jumlah Dana">
                    <button class="btn-sm btn-primary" type="submit">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

    $(document).ready(function(){

        $('.btn-acc').on('click',function(){

            $('.id').each((index, obj) => {
                $('#pendapatan_id').val(obj.innerHTML);
            })

            $('#myModal').modal('show');
        });

         
    });

</script>
<?php $this->endSection() ?>
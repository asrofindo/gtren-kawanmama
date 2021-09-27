<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">User </h2>
        <p>Dana Semua User</p>
    </div>
</div>
<div class="attention">
    <?php if(!empty(session()->getFlashdata('success'))){ ?>

        <div class="alert alert-success bg-success text-white">
            <?php echo session()->getFlashdata('success');?>
        </div>

    <?php } ?>

    <?php if(!empty(session()->getFlashdata('danger'))){ ?>

        <div class="alert alert-danger bg-danger text-white">
            <?php echo session()->getFlashdata('danger');?>
        </div>

    <?php } ?>
</div>
<div class="card mb-4">
    <header class="card-header">
        <div class="row gx-3">
            <div class="col-lg-4 col-md-6 me-auto">
                <input type="text" placeholder="Search..." class="form-control">
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
                        <th scope="col">widthdraw</th>
                        <th scope="col" class="text-end"> Action </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pendapatans as $pendapatan): ?>
                        <tr>
                            <td class="id"><?= $pendapatan->id; ?></td>
                            <td><b><?php echo $pendapatan->username; ?></b></td>
                            <td><?php echo rupiah($pendapatan->masuk) ?></td>
                            <td><?php echo rupiah($pendapatan->keluar) ?></td>
                            <td><?php echo rupiah($pendapatan->total); ?></td>
                            <td class="<?php if ($pendapatan->penarikan_dana>0) { echo 'bg-danger text-white'; } ?>"><?php echo $pendapatan->penarikan_dana; ?></td>
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
            <button type="button" class=" btn-primary btn-sm" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Kirim Dana</h4>
          </div>
          <div class="modal-body">
            <form action="<?php base_url()  ?>/transaksi/wd" method="post">
                <div class="mb-4">
                    <input type="hidden" id="pendapatan_id" name="pendapatan_id">
                    <input type="hidden" name="status_dana" value="user">
                    <input type="hidden" name="wd" id="wd">
                    Total : Rp<h5 id="total_wd"> </h5>
                    <select class="form-control"  name="bill">
                        <?php foreach ($bills as $bill): ?>
                                <option value="<?php echo $bill->id ?>"><?php echo $bill->bank_name ?> - <?php echo $bill->owner ?> - <?php echo rupiah($bill->total) ?></option>
                        <?php endforeach ?>
                    </select><br>
                    <button class="btn btn-sm btn-primary" type="submit">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

    $(document).ready(function(){

        $('.btn-acc').on('click',function(data){

            let val = data.target.parentElement.parentElement.parentElement.parentElement.childNodes[1].innerHTML
            $('#pendapatan_id').val(val);

            let wd = data.target.parentElement.parentElement.parentElement.parentElement.childNodes[11]

            if(wd.innerHTML < 1){
                alert('maaf kamu tidak bisa wd')
            } else {
                $('#wd').val(wd.innerHTML);

                $("#total_wd").text(wd.innerHTML);

                $('#myModal').modal('show'); 
            }
            
        });

         
    });

</script>
<?php $this->endSection() ?>
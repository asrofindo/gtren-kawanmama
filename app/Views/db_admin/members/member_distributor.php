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
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                             
                                <th>id</th>
                                <th>pemilik</th>
                                <th>nama toko</th>
                                <th>level</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                             <?php foreach ($distributor as $value): ?>

                            <tr>
                                <form action="<?php base_url()  ?>/distributor/level" method="post"> 
                                <td class="id"><?= $value['id']  ?></td>
                                <td ><?= $value['username']  ?></td>
                                <td ><?= $value['locate']  ?></td>
                                <td > 
                                    <input type="hidden" id="user_id" name="user" value="<?= $value['id']?>">
                                    <select id="inputState" class="form-control" name="level">
                                            <option><?= $value['level']  ?></option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                    </select>  
                                </td>
                                <td class="text-end">
                                    <button class="btn-sm btn-primary" type="submit">Simpan</button>
                                </td> 
                            </form>
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
<!-- modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Masukan Nomor Resi</h4>
          </div>
          <div class="modal-body">
            <form action="<?php base_url()  ?>/distributor/level/" method="post">
                <div class="mb-4">
                    <input  id="user_id" name="user">
                    <select id="inputState" class="form-control">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>

                    </select>      
                  <button class="btn-sm btn-primary" type="submit">Simpan</button>
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
                
            $('#user_id').val(val);

            $('#myModal').modal('show');
        });

         $('.close').on('click',function(data){

            $('#myModal').modal('hide');
        });

         
    });

</script>
<?php $this->endSection() ?>

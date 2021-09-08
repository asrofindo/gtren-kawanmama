<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Member </h2>
        <p>Add, edit or delete a Member</p>
    </div>
    <div>
        <input type="text" placeholder="Search Categories" class="form-control bg-white">
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-9">
                    <div class="mb-4">
                        <label for="product_name" class="form-label">Username</label>
                        <input readonly type="text" value="<?= $user->username?>" class="form-control" id="product_name" />
                    </div>
                    <div class="mb-4">
                        <label for="product_slug" class="form-label">email</label>
                        <input readonly type="text" value="<?= $user->email?>" class="form-control" id="product_name" />
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Roles</label>
                        <table>
                            <?php foreach ($roles as $key => $value) {?>
                                <tr>
                                    <td><p><?= $value->name?></p></td>
                                    <td>||</td>
                                    <td><a href="<?=base_url()?>/role/delete/<?=$user->id?>/<?= $value->name?>">(delete)</a></td>
                                </tr>
                            <?php } ?>
                        </table>
                        <div class="row">
                        
                            <div class="search-style-1 w-100">
                                <p>Add Role</p>
                                <form action="<?= base_url() ?>/add/role/<?= $value->id?>" method="post" class="w-100">
                                    <select name="role">
                                        <?php foreach ($group as $key => $value) {?>
                                            <option value="<?= $value['id']?>"><?= $value['name']?></option>
                                        <?php }?>
                                    </select>              
                                  <button type="submit"> <i class="far fa-search"></i>save </button>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>

        </div> <!-- .row // -->
    </div> <!-- card body .// -->
</div> <!-- card .// -->

<?php $this->endSection() ?>
<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Setting Perusahaan</h2>
        <p>Add, edit or delete a Perusahaan</p>
    </div>
    <div>
        <form action="<?= base_url('factory/search') ?>" method="post" class="row row-cols-lg-auto g-3 align-items-center">
            <div class="col-12">
                <input type="text" placeholder="Cari Perusahaan" class="form-control bg-white" name="keyword">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">
                    Cari
                </button>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-body">

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

        <div class="row">
            <div class="col-md-3">

                <h4>Setting Perusahaan</h4>
                <hr>
                <form action="<?= base_url('factory') ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label for="profile" class="form-label">Nama Perusahaan</label>
                        <input type="text" placeholder="Type here" name="title" class="form-control" id="profile" />
                    </div>
                    <div class="mb-4">
                        <label for="favicon" class="form-label">Favicon (1x1)</label>
                        <input type="file" placeholder="Type here" name="favicon" class="form-control" id="favicon" />
                    </div>
                    <div class="mb-4">
                        <label for="photo" class="form-label">Logo (200px x 50px)</label>
                        <input type="file" placeholder="Type here" name="photo" class="form-control" id="photo" />
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-primary" type="submit">Simpan Data</button>
                    </div>
                </form>       
                
            </div>
            <div class="col-md-9">
                <div class="table-responsive">
                    
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="80">Logo</th>
                                <th>Nama Perusahaan</th>
                                <th>Favicon</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($profiles as $profile): ?>           
                              <tr>
                                  <td class="w-10" style="width: 100px;"><img style="height: 50px; width: 200px" class="w-10 d-inline-block p-0" src="<?= base_url()  ?>/uploads/banner/<?= $profile->photo ?>"></td>
                                  <td><b><?= $profile->title ?></b></td>
                                  <td class="w-10" style="width: 100px;"><img class="w-10 d-inline-block p-0" src="<?= base_url()  ?>/uploads/banner/<?= $profile->favicon ?>"></td>
                                  <td>
                                      <a href="<?= base_url('factory/edit/'.$profile->id) ?>" class="btn btn-brand rounded btn-sm font-sm">
                                          <i class="material-icons md-edit"></i>
                                          Edit
                                      </a>
                                      <a href="<?= base_url('factory/delete/'.$profile->id) ?>" class="btn btn-light btn-sm font-sm rounded">
                                          <i class="material-icons md-delete_forever"></i>
                                          Hapus
                                      </a>
                                  </td>
                              </tr>
                          <?php endforeach ?>
                      </tbody>
                  </table>
                  
              </div>
              <div class="pagination-area mt-30 mb-50">
                 <nav aria-label="Page navigation example">
                     <ul class="pagination justify-content-start">
                         <?= $pager->links('profiles', 'product_pagination'); ?>
							            <!-- <li class="page-item active"><a class="page-link" href="#">01</a></li>
							            <li class="page-item"><a class="page-link" href="#">02</a></li>
							            <li class="page-item"><a class="page-link" href="#">03</a></li>
							            <li class="page-item"><a class="page-link dot" href="#">...</a></li>
							            <li class="page-item"><a class="page-link" href="#">16</a></li>
							            <li class="page-item"><a class="page-link" href="#"><i class="material-icons md-chevron_right"></i></a></li> -->

							        </ul>
							    </nav>
							</div>
                        </div> <!-- .col// -->
                    </div> <!-- .row // -->
                </div> <!-- card body .// -->
            </div> <!-- card .// -->

            <?php $this->endSection() ?>
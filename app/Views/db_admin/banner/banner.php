<?php $this->extend('dashboard') ?>
<?php $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Banner </h2>
        <p>Add, edit or delete a banner</p>
    </div>
    <div>
        <form action="<?= base_url('category/search') ?>" method="post" class="row row-cols-lg-auto g-3 align-items-center">
            <div class="col-12">
                <input type="text" placeholder="Cari Banner" class="form-control bg-white" name="keyword">
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

                <h4>Tambah Banner</h4>
                <hr>
                <form action="<?= base_url('banner') ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label for="banner" class="form-label">Title</label>
                        <input type="text" placeholder="Type here" name="title" class="form-control" id="banner" />
                    </div>
                    <div class="mb-4">
                        <label for="sub_title" class="form-label">Sub Title</label>
                        <input type="text" placeholder="Type here" name="sub_title" class="form-control" id="sub_title" />
                    </div>
                    <div class="mb-4">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" placeholder="Type here" name="description" class="form-control" id="description" />
                    </div>
                    <div class="mb-4">
                        <label for="offer" class="form-label">Offer</label>
                        <input type="text" placeholder="Type here" name="offer" class="form-control" id="offer" />
                    </div>
                    <div class="mb-4">
                        <label for="photo" class="form-label">Photo</label>
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
                                <th width="80">Photo</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Offer</th>
                                <th>Sub Title</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($banners as $banner): ?>           
                              <tr>
                                  <td><img class="w-10 d-inline-block p-0" src="<?= base_url()  ?>/public/uploads/banner/<?= $banner->photo ?>"></td>
                                  <td><b><?= $banner->title ?></b></td>
                                  <td><b><?= $banner->sub_title ?></b></td>
                                  <td><b><?= $banner->description ?></b></td>
                                  <td><b><?= $banner->offer ?></b></td>
                                  <td>
                                      <a href="<?= base_url('banner/edit/'.$banner->id) ?>" class="btn btn-brand rounded btn-sm font-sm">
                                          <i class="material-icons md-edit"></i>
                                          Edit
                                      </a>
                                      <a href="<?= base_url('banner/delete/'.$banner->id) ?>" class="btn btn-light btn-sm font-sm rounded">
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
                         <?= $pager->links('banners', 'product_pagination'); ?>
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
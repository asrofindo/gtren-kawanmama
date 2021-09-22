<?= $this->extend('commerce/templates/index') ?>
<?= $this->section('content') ?>
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="row m-2 d-block d-xl-none d-md-none d-lg-none">
            <div class="search-style-1 w-100">
                        <form action="<?= base_url() ?>/products/search_p" method="get" class="w-100">
                            <input type="text" placeholder="Cari Produk" name="search" class="rounded-3">
                            <button type="submit"> <i class="far fa-search"></i> </button>
                        </form>
            </div>
        </div>
        <div class="row">
        <div class="sidebar-widget widget_categories mb-30 p-30 bg-grey border-radius-10">
                        <div class="widget-header position-relative mb-20 pb-10">
                            <h5 class="widget-title mb-10">Kategori</h5>
                            <div class="bt-1 border-color-1"></div>
                        </div>
                        <div class="">
                            <ul class="categor-list">
                                <?php foreach ($category  as $data) {?>
                                        <li class="cat-item text-muted"><a href="<?= base_url() ?>/category/product/<?= $data->id?>"><?= $data->category ?></a></li>
                                        <?php }?>
                            </ul>
                        </div>
                    </div>
        </div>
    

<?= $this->endSection() ?>
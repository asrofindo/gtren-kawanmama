<header class="main-header navbar">
    <div class="col-search"></div>
    <div class="col-nav">
        <button class="btn btn-icon btn-mobile me-auto" data-trigger="#offcanvas_aside"> <i class="material-icons md-apps"></i> </button>
        <ul class="nav">
            <li class="nav-item">
            </li>
            <li class="nav-item">
                <a class="nav-link btn-icon darkmode" href="#"> <i class="material-icons md-nights_stay"></i> </a>
            </li>
            <li class="dropdown nav-item">
                <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownAccount" aria-expanded="false"> <img class="img-xs rounded-circle" src="<?= base_url('/public/uploads/photo.svg') ?>" alt="User"></a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownAccount">
                    <a class="dropdown-item" href="<?php base_url() ?>/account"><i class="material-icons md-perm_identity"></i>Profil Saya</a>
                    <a class="dropdown-item" href="<?php base_url() ?>/profile"><i class="material-icons md-perm_identity"></i>Edit Profil</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="<?php base_url() ?>/logout"><i class="material-icons md-exit_to_app"></i>Logout</a>
                </div>
            </li>
        </ul>
    </div>
</header>
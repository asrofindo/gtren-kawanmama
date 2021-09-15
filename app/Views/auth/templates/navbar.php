
 <header class="main-header style-2 navbar">
            <div class="col-brand">
                <a href="index.html" class="brand-wrap">
                    <img src="<?php base_url() ?>/backend/imgs/theme/logo2.png" class="logo" alt="Wowy Dashboard">
                </a>
            </div>
            <div class="col-nav">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link btn-icon" href="#">
                            <i class="material-icons md-notifications animation-shake"></i>
                            <span class="badge rounded-pill">3</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn-icon darkmode" href="#"> <i class="material-icons md-nights_stay"></i> </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="requestfullscreen nav-link btn-icon"><i class="material-icons md-cast"></i></a>
                    </li>
                    <li class="dropdown nav-item">
                        <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownLanguage" aria-expanded="false"><i class="material-icons md-public"></i></a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownLanguage">
                            <a class="dropdown-item text-brand" href="#"><img src="<?php base_url() ?>/backend/imgs/theme/flag-us.png" alt="English">English</a>
                            <a class="dropdown-item" href="#"><img src="<?php base_url() ?>/backend/imgs/theme/flag-fr.png" alt="Français">Français</a>
                            <a class="dropdown-item" href="#"><img src="<?php base_url() ?>/backend/imgs/theme/flag-jp.png" alt="Français">日本語</a>
                            <a class="dropdown-item" href="#"><img src="<?php base_url() ?>/backend/imgs/theme/flag-cn.png" alt="Français">中国人</a>
                        </div>
                    </li>
                    <li class="dropdown nav-item">
                        <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownAccount" aria-expanded="false"> <img class="img-xs rounded-circle" src="<?php base_url() ?>/backend/imgs/people/avatar1.jpg" alt="User"></a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownAccount">
                            <a class="dropdown-item" href="<?= base_url()?>/profile"><i class="material-icons md-perm_identity"></i>Edit Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="#"><i class="material-icons md-exit_to_app"></i>Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </header>

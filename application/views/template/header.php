<!-- Sidebar toggle button-->
<a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
<!-- Menampilkan Waktu -->
<div class="app-nav__item col-md-3">
        <span style="color:white" id="dates"><span id="the-day"></span> || <span id="the-time"></span> </span>
</div>
<!-- Navbar Right Menu-->
<ul class="app-nav">
        <!--Notification Menu-->
        <?php 
        $jenis_kar = $this->session->userdata('jns_kar');

        if ($jenis_kar == 1) 
        {
                $nik = $this->session->userdata('nik');
                $karyawan = $this->Model_user->mmsg_kar($nik);
                $i = 0;
                foreach ($karyawan as $k ) {
                        $i++;
                }
                ?>
                <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications">
                                <i class="fa fa-bell-o fa-lg"></i>
                                <span class="badge badge-light"><?= $i ?></span>
                        </a>
                        <ul class="app-notification dropdown-menu dropdown-menu-right">
                                <li class="app-notification__title">Anda memiliki <?= $i ?> notifikasi baru</li>
                                <div class="app-notification__content">
                                        <?php foreach ($karyawan as $kar ) { ?>
                                        <li><a class="app-notification__item" href="<?= base_url() ?>Home/ntf_update_status_kar/<?= $kar['nik'] ?>/<?= date('m', strtotime($kar['periode'])) ?>/<?= $kar['id_nilai_akhir'] ?>">
                                                <span class="app-notification__icon">
                                                        <span class="fa-stack fa-lg">
                                                                <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                                                <i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
                                                        </span>
                                                </span>
                                                        <div>
                                                                <strong>
                                                                        <p class="app-notification__message">Hasil Penilaian</p>
                                                                </strong>
                                                                <p class="app-notification__meta"><?= date('d-m-Y', strtotime($kar['periode'])) ?></p>
                                                        </div>
                                                </a>
                                        </li>
                                        <?php } ?>
                                </div>
                        </ul>
                </li>
        <?php 
        } 
        elseif ($jenis_kar == 2) 
        {
                $nik = $this->session->userdata('nik');
                $satpam = $this->Model_user->mmsg_sat($nik);
                $i = 0;
                foreach ($satpam as $s ) {
                        $i++;
                }
                ?>
                <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications">
                                <i class="fa fa-bell-o fa-lg"></i>
                                <span class="badge badge-light"><?= $i ?></span>
                        </a>
                        <ul class="app-notification dropdown-menu dropdown-menu-right">
                                <li class="app-notification__title">Anda memiliki <?= $i ?> notifikasi baru</li>
                                <div class="app-notification__content">
                                        <?php foreach ($satpam as $sat ) { ?>
                                        <li><a class="app-notification__item" href="<?= base_url() ?>Home/ntf_update_status_sat/<?= $sat['nik'] ?>/<?= date('m', strtotime($sat['periode'])) ?>/<?= $sat['id_nilai_akhir'] ?>">
                                                <span class="app-notification__icon">
                                                        <span class="fa-stack fa-lg">
                                                                <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                                                <i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
                                                        </span>
                                                </span>
                                                        <div>
                                                                <strong>
                                                                        <p class="app-notification__message">Hasil Penilaian</p>
                                                                </strong>
                                                                <p class="app-notification__meta"><?= date('d-m-Y', strtotime($sat['periode'])) ?></p>
                                                        </div>
                                                </a>
                                        </li>
                                        <?php } ?>
                                </div>
                        </ul>
                </li>
        <?php } ?>

        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
                <ul class="dropdown-menu settings-menu dropdown-menu-right">
                        <!-- <li><a class="dropdown-item" href="#"><i class="fa fa-cog fa-lg"></i> Pengaturan</a></li> -->
                        <li><a class="dropdown-item" href="<?= base_url(); ?>Core/logout"><i class="fa fa-sign-out fa-lg"></i> Keluar</a></li>
                </ul>
        </li>
</ul>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <img class="app-sidebar__user-avatar" src="<?= base_url(); ?>assets_application/assets/faces/<?= $this->session->userdata('image'); ?>">
        <div>
            <span class="app-sidebar__user-name">
                <?php $str = $this->session->userdata('nama_pegawai');
                echo wordwrap($str, 15, "<br>\n"); ?>
            </span>
            <?php 
            $role = $this->session->userdata('role'); 
            if ($role == '1') 
            {
            ?>
                <p class="app-sidebar__user-designation">Administrator</p>
            <?php 
            } 
            elseif($role == '2') 
            {
            ?>
                <p class="app-sidebar__user-designation">Karyawan</p>
            <?php
            } 
            elseif ($role == '3') 
            {
            ?>
                <p class="app-sidebar__user-designation">Satpam</p>
            <?php 
            }
            ?>
        </div>
    </div>
    <ul class="app-menu">
<?php 
$role = $this->session->userdata('role'); 
if ($role == '1') 
{
?>
        <li>
            <a class="app-menu__item active" href="<?= Base_url(); ?>Home/Home_admin">
                <i class="app-menu__icon fa fa-home"></i>
                <span class="app-menu__label">Dashboard</span>
            </a>
        </li>
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-bar-chart"></i>
                <span class="app-menu__label">Hasil Penilaian</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <!-- <li><a class="treeview-item" href="<?= Base_url();?>Home/dt_nilai_kar"><i class="icon fa fa-circle-o"></i> Karyawan</a></li> -->
                <li><a class="treeview-item" href="<?= Base_url();?>Home/edit_nilai_kar"><i class="icon fa fa-circle-o"></i> Karyawan</a></li>
                <li><a class="treeview-item" href="<?= Base_url();?>Home/edit_nilai_sat"><i class="icon fa fa-circle-o"></i> Satpam</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-file-text"></i>
                <span class="app-menu__label">Laporan</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="<?= Base_url();?>Home/laporan_kar"><i class="icon fa fa-circle-o"></i> Karyawan</a></li>
                <li><a class="treeview-item" href="<?= Base_url();?>Home/laporan_sat"><i class="icon fa fa-circle-o"></i> Satpam</a></li>
            </ul>
        </li>
        <li>
            <a class="app-menu__item" href="<?= Base_url();?>Home/kelola_user">
                <i class="app-menu__icon fa fa-user"></i>
                <span class="app-menu__label">Kelola User</span>
            </a>
        </li>
    
    <?php 
} 
elseif($role == '2') 
{
    ?>
        <li>
            <a class="app-menu__item active" href="<?= Base_url(); ?>Home/Home_user">
                <i class="app-menu__icon fa fa-home"></i>
                <span class="app-menu__label">Dashboard</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item" href="<?= Base_url();?>Home/in_nilai_kar">
                <i class="app-menu__icon fa fa-bar-chart"></i>
                <span class="app-menu__label">Penilaian Karyawan</span>
            </a>
        </li>
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-pencil-square-o"></i>
                <span class="app-menu__label">Hasil Penilaian</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <!-- <li><a class="treeview-item" href="<?= Base_url();?>Home/nilai_kar"><i class="icon fa fa-circle-o"></i> Nilai</a></li> -->
                <li><a class="treeview-item" href="<?= Base_url();?>Home/nilai_kar"><i class="icon fa fa-circle-o"></i> Nilai</a></li>
                <li><a class="treeview-item" href="<?= Base_url();?>Home/evaluasi_kar"><i class="icon fa fa-circle-o"></i> Evaluasi</a></li>
            </ul>
        </li>
    <?php
} 
elseif ($role == 3) 
{ 
    ?>
        <li>
            <a class="app-menu__item active" href="<?= Base_url(); ?>Home/Home_user">
                <i class="app-menu__icon fa fa-home"></i>
                <span class="app-menu__label">Dashboard</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item" href="<?= Base_url();?>Home/in_nilai_sat">
                <i class="app-menu__icon fa fa-bar-chart"></i>
                <span class="app-menu__label">Penilaian Satpam</span>
            </a>
        </li>
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-pencil-square-o"></i>
                <span class="app-menu__label">Hasil Penilaian</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="<?= Base_url();?>Home/nilai_sat"><i class="icon fa fa-circle-o"></i> Nilai</a></li>
                <li><a class="treeview-item" href="<?= Base_url();?>Home/evaluasi_sat"><i class="icon fa fa-circle-o"></i> Evaluasi</a></li>
            </ul>
        </li>
<?php }?>
    </ul>
</aside>
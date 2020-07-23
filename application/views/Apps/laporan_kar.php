<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    $data['tittle'] = "Pegadaian";
    $this->load->view('template/head', $data);
    ?>

</head>

<body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="#">Pegadaian</a>
        <?php $this->load->view('template/header') ?>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>

    <?php $this->load->view('template/menu') ?>

    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-file-text"></i> Laporan Karyawan Oprasional</h1>
                <p>MENGATASI MASALAH TANPA MASALAH!!!</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#"> Laporan Karyawan</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="card-body">
                        <div class="tile-title-w-btn">
                            <?php
                                if (isset($_POST['bulan'])) 
                                {
                                    foreach ($nilai_kar_fix as $n) { } 
                                        if (isset($n['periode'])) { ?>
                                    <h4 class="title">Laporan Nilai Karyawan Oprasional Bulan
                                        <?php
                                            $date = date('F Y', strtotime($n['periode']));
                                            echo $date;
                                        ?>
                                    </h4>
                                <?php } elseif (empty($n['periode'])) {?>
                                <h4 class="title">Laporan Nilai Karyawan Oprasional</h4>
                                <?php }?>
                            <?php } elseif (empty($_POST['bulan'])) { ?>
                                <h4 class="title">Laporan Nilai Karyawan Oprasional</h4>
                            <?php } ?>
                        </div>
                        <hr align="right" color="black">
                        <div class="row">
                            <div class="form-group mx-sm-3 mb-2">
                                <?= form_open('Home/cari_bulan_laporan_kar'); ?>
                                <input type="month" name="bln" class="form-control">
                                <small class="form-text text-muted">Pilih Bulan yang akan anda cari</small>
                            </div>
                            <button class="btn btn-info mb-5" name="bulan" type="submit"><i class="fa fa-search fa-fw"></i> Cari</button>
                        </div>
                        <?= form_close() ?>
                        <table class="table table-hover table-bordered table-sm" id="sampleTable">
                            <thead>
                                <tr bgcolor="#F5F5F5">
                                    <th>No</th>
                                    <th>Nama Karyawan</th>
                                    <th>NIK</th>
                                    <th>Unit Kerja</th>
                                    <th>KTP</th>
                                    <th>Nilai</th>
                                    <th>Mencetak Laporan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if (isset($_POST['bulan'])) 
                                {
                                    $i=1;
                                    foreach ($nilai_kar_fix as $nf ) 
                                    { ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $nf['nama_karyawan'] ?></td>
                                        <td><?= $nf['nik'] ?></td>
                                        <td><?= $nf['unit_kerja'] ?></td>
                                        <td><?= $nf['ktp'] ?></td>
                                        <td><?= $nf['nilai_akhir'] ?></td>
                                        <td><a class="btn btn-primary icon-btn mb-5" href="<?= base_url() ?>Laporan/laporan_karyawan/<?= $nf['nik'] ?>"><i class="fa fa-print"></i>Mencetak Laporan </a></td>
                                    </tr>
                                    <?php } 
                                } elseif (empty($_POST['bulan'])) {?>
                                    <tr>
                                        <td colspan="7" class="text-center" >Data Tidak Ditemukan</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <?php 
                        if (isset($_POST['bulan'])) 
                        {
                            foreach ($nilai_kar_fix as $n) { }
                            if (isset($n['periode'])) {
                                $date = date('F Y', strtotime($n['periode']));
                            
                        ?>
                        <hr align="right" color="black">
                        <div class="modal-footer">
                            <a class="btn btn-primary icon-btn mb-5" href="<?= base_url() ?>Laporan/laporan_all/<?= $date ?>"><i class="fa fa-print"></i>Mencetak Laporan </a>
                        </div>
                        <?php } }?>
                    </div>
                </div>
            </div>
        </div>

        <footer>
            <!-- footer area start-->
            <?php $this->load->view('template/footer') ?>
            <!-- footer area end-->
        </footer>

    </main>


    <?php $this->load->view('template/script') ?>

</body>

</html>
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
                <h1><i class="fa fa-file-text"></i> Hasil Penilaian Karyawan Oprasional</h1>
                <p>MENGATASI MASALAH TANPA MASALAH!!!</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#"> Hasil Penilaian Karyawan</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="card-body">
                        <div class="tile-title-w-btn">
                            <h4 class="title">Rangking Karyawan Oprasional</h4>
                        </div>
                        <hr align="right" color="black">
                        <div class="row">
                            <div class="form-group mx-sm-3 mb-2">
                                <?= form_open('Home/c_nilai_kar'); ?>
                                <input type="month" name="tgl" class="form-control">
                                <small class="form-text text-muted">Pilih Bulan yang akan anda cari</small>
                            </div>
                            <button class="btn btn-info mb-5" name="bulan" type="submit"><i class="fa fa-search fa-fw"></i> Cari</button>
                        </div>
                        <?= form_close() ?>

                        <table class="table table-hover table-bordered table-sm" id="sampleTable">
                            <thead>
                                <tr bgcolor="#F5F5F5">
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama Karyawan</th>
                                    <th>Periode</th>
                                    <th>Nilai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if(isset($_POST['bulan']))
                                    {
                                        $i=1;
                                        foreach ($nilai_kar as $nf ) 
                                        { ?>
                                        <tr>
                                            <td class="text-center"><?= $i++; ?></td>
                                            <td class="text-center"><?= $nf['nik'] ?></td>
                                            <td><?= $nf['nama_karyawan'] ?></td>
                                            <td><?= date('d-m-Y', strtotime($nf['periode'])) ?></td>
                                            <td class="text-right"><?= $nf['nilai_akhir'] ?></td>
                                            <?php 
                                                $nik = $this->session->userdata('nik');
                                                if ($nik == $nf['nik']) {?>
                                            <td class="text-center">
                                                <a href="<?= base_url()?>Home/grafik_kar/<?= $nf['nik'] ?>/<?= date('m', strtotime($nf['periode'])) ?>" class="btn btn-info "><i class="fa fa-area-chart"></i>Lihat Grafik </a>
                                            </td>
                                                <?php } else {?>
                                                <td></td>
                                                <?php } ?>
                                        </tr>
                                    <?php }  ?>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="6" class="text-center" >Data Tidak Ditemukan</td>
                                    </tr>
                                <?php }  ?>
                            </tbody>
                        </table>
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
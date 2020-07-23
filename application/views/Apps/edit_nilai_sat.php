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
                <h1><i class="fa fa-bar-chart"></i> Hasil Nilai Satpam</h1>
                <p>MENGATASI MASALAH TANPA MASALAH!!!</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('Home/home_user') ?>"><i class="fa fa-home fa-lg"></i></a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="card-body">
                        <div class="tile-title-w-btn">
                            <h4 class="title">Daftar Karyawan</h4>
                            <div class="form-group mx-sm-5 col-md-7 ">
                            </div>
                            <a class="btn btn-primary icon-btn" title="Add Item" href="<?php echo base_url('Home/dt_nilai_sat') ?>">Proses Penilaian </a>
                        </div>
                        <hr align="right" color="black">
                        <div class="tile-body">
                            <table class="table table-hover table-bordered table-sm" id="sampleTable">
                                <thead>
                                    <tr bgcolor="#F5F5F5">
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Nama Satpam</th>
                                        <th>Unit Kerja</th>
                                        <th>No HP</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $i=1;
                                        foreach($satpam AS $sat) 
                                        {
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $i++?></td>
                                            <td class="text-center"><?= $sat['nik'] ?></td>
                                            <td><?= $sat['nama_satpam'] ?></td>
                                            <td><?= $sat['unit_kerja'] ?></td>
                                            <td class="text-right"><?= $sat['no_hp'] ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url()?>Home/action_edit_nilai_sat/<?= $sat['nik'] ?>" class="btn btn-info "> Ubah </a>
                                            </td>
                                        </tr>
                                    <?php 
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
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
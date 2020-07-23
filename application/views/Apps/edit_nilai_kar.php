<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    $data['tittle'] = "Pegadaian";
    $this->load->view('template/head', $data);
    ?>
    <style type="text/css">

    td {
        cursor: pointer;
    }

    .editor{
        display: none;
    }

    </style>

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
                <h1><i class="fa fa-bar-chart"></i> Penilaian Karyawan Oprasional</h1>
                <p>MENGATASI MASALAH TANPA MASALAH!!!</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('Home/home_user') ?>"><i class="fa fa-home fa-lg"></i></a></li>
                <li class="breadcrumb-item">Hasil Penilaian Karyawan</li>
            </ul>
        </div>
        <?= $this->session->flashdata('status_insert'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="card-body">
                        <div class="tile-title-w-btn">
                            <h4 class="title">Daftar Karyawan</h4>
                            <div class="form-group mx-sm-5 col-md-7 ">
                            </div>
                            <a class="btn btn-primary icon-btn" title="Add Item" href="<?php echo base_url('Home/dt_nilai_kar') ?>">Proses Penilaian </a>
                        </div>
                        <hr align="right" color="black">
                        <div class="tile-body">
                            <table class="table table-hover table-bordered table-sm" id="sampleTable">
                                <thead>
                                    <tr bgcolor="#F5F5F5">
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Nama Karyawan</th>
                                        <th>Jabatan</th>
                                        <th>Unit Kerja</th>
                                        <th>KTP</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $i=1;
                                        foreach($karyawan AS $kar) 
                                        {
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $i++?></td>
                                            <td class="text-center"><?= $kar['nik'] ?></td>
                                            <td><?= $kar['nama_karyawan'] ?></td>
                                            <td><?= $kar['jabatan'] ?></td>
                                            <td><?= $kar['unit_kerja'] ?></td>
                                            <td class="text-right"><?= $kar['ktp'] ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url()?>Home/action_edit_nilai_kar/<?= $kar['nik'] ?>" class="btn btn-info "> Ubah </a>
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
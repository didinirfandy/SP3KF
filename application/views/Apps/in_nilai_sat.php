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
                <h1><i class="fa fa-bar-chart"></i> Penilaian Satpam</h1>
                <p>MENGATASI MASALAH TANPA MASALAH!!!</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Penilaian Satpam</a></li>
            </ul>
        </div>
        <?= $this->session->flashdata('status_insert'); ?>
        <div class="status-gagal" data-statusgagal="<?= $this->session->flashdata('statusgagal'); ?>"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="card-body">
                        <h3 class="tile-title">Data Satpam</h3>
                        <hr align="right" color="black">
                        <div class="tile-body">
                            <table class="table table-hover table-bordered table-sm" id="sampleTable">
                                <thead>
                                    <tr bgcolor="#F5F5F5">
                                        <th>No</th>
                                        <th>Nama Satpam</th>
                                        <th>NIK</th>
                                        <th>Unit Kerja</th>
                                        <th>No Hp</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i = 1;
                                    foreach ($satpam as $kar ) {
                                    ?>
                                    <tr>
                                        <td class="text-center"><?= $i++?></td>
                                        <td><?= $kar['nama_satpam'] ?></td>
                                        <td class="text-center"><?= $kar['nik'] ?></td>
                                        <td class="text-center"><?= $kar['unit_kerja'] ?></td>
                                        <td class="text-right"><?= $kar['no_hp'] ?></td>
                                        <td class="text-center">
                                        <?php 
                                        $nama_pegawai = $this->session->userdata('nama_pegawai');
                                        $notnama_pegawai = $this->Model_user->notnama_pegawai($nama_pegawai);
                                        if ($notnama_pegawai) {?>                                                                                
                                            <button  disabled class="btn btn-danger"><i class="fa fa-pencil"></i>Penilaian </button>
                                        <?php } else {?>
                                            <a href="<?= base_url()?>Home/input_nilai/<?= $kar['nik'] ?>/<?= $kar['genre'] ?>/<?= $kar['jenis_kar'] ?>" class="btn btn-info "><i class="fa fa-pencil"></i>Penilaian </a>
                                        <?php } ?>
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
    <script>
        const statusgagal = $('.status-gagal').data('statusgagal');
            // console.log(statusgagal);
            if (statusgagal) {
                swal({
                    title: "Gagal " + statusgagal,
                    text: "INPUT KEMBALI NILAI JANAGAN KOSONG",
                    type: "error",
                    timer: 7000,
                    showConfirmButton: false
                });
            }
    </script>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    $data['tittle'] = "Dashboard";
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
                <h1><i class="fa fa-home"></i> Dashboard</h1>
                <p>MENGATASI MASALAH TANPA MASALAH!!!</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="widget-small primary"><i class="icon fa fa-line-chart fa-3x"></i>
                    <div class="info">
                        <h4>Periode Penilaian</h4>
                        <p><b>
                        <?php 
                            $hari_ini = date("Y-m-d");
                            $tgl_pertama = date('Y-m-01', strtotime($hari_ini));
                            $tgl_terakhir = date('Y-m-t', strtotime($hari_ini));

                            $awal = $tgl_pertama;
                            // $awal = '2019-12-30';
                            $awalTime = strtotime($awal);
                            $tgl = $tgl_terakhir;
                            // $tgl = '2020-01-04';
                            $tglTime = strtotime($tgl);
                            $selisih = $tglTime - $awalTime;
                            $minggu = ceil($selisih / 604800); // 1 minggu = 60 * 60 * 24 * 7 = 604800 detik
                            echo 'Minggu ke-'.($minggu).' ';

                            function tgl_indo($tanggal)
                            {
                                $bulan = array (
                                    1 =>   	'Januari',
                                            'Februari',
                                            'Maret',
                                            'April',
                                            'Mei',
                                            'Juni',
                                            'Juli',
                                            'Agustus',
                                            'September',
                                            'Oktober',
                                            'November',
                                            'Desember'
                                );
                                $pecahkan = explode('-', $tanggal);
                                
                                // variabel pecahkan 0 = tanggal
                                // variabel pecahkan 1 = bulan
                                // variabel pecahkan 2 = tahun
                            
                                return $bulan[ (int)$pecahkan[1] ];
                            }
                            echo tgl_indo(date("Y-m-d"));
                        ?>
                        </b></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="widget-small info"><i class="icon fa fa-star fa-3x"></i>
                    <div class="info">
                        <h4>Nilai </h4>
                        <p><b><?= $nilai['nilai_akhir'] ?></b></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="widget-small warning"><i class="icon fa fa-thumbs-up fa-3x"></i>
                    <div class="info">
                        <h4>Rangking</h4>
                        <p><b><?= $rangking['rangking'] ?></b></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="tile">
                    <center>
                        <h3 class="tile-title">SELAMAT DATANG</h3>
                    </center>
                    <center>
                        <h3 class="tile-title"></h3>
                    </center>
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
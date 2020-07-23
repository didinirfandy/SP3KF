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
            <div class="col-lg-6">
                <div class="widget-small primary"><i class="icon fa fa-users fa-3x"></i>
                    <div class="info">
                        <h4>Karyawan</h4>
                        <p><b><?= $jmlh_kar[0]['id_kar'] + $jmlh_sat[0]['id_sat'] ?></b></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="widget-small info"><i class="icon fa fa-line-chart fa-3x"></i>
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
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="tile">
                    <h4 class="tile-title">Pengguna Online</h4>
                    <table class="table table-sm">
                        <thead>
                            <tr bgcolor="#F5F5F5">
                                <!-- <th>No</th> -->
                                <th>NIK</th>
                                <th>Nama Pegawai</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  
                            $i=1;
                            foreach ($hak_akses as $hak ) { ?>
                            <tr>
                                <!-- <td><?= $i++;?></td> -->
                                <td><?= $hak['nik'] ?></td>
                                <td><?= $hak['nama_pegawai'] ?></td>
                                <td><?php
                                    if ($hak['status'] == 1) {
                                        echo "<font color='green'>Online</font>";
                                    } else {
                                        echo "<font color='red'>Offline</font>";
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="tile">
                    <h4 class="tile-title">Rangking Karyawan Bulan <?= tgl_indo(date("Y-m-d"));?></h4>
                    <div class="embed-responsive embed-responsive-16by9">
                        <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
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
    <script type="text/javascript" src="<?= base_url(); ?>assets_application/js/plugins/chart.js"></script>
    <script type="text/javascript">
        var data = {
            labels: ["Dede Sutisna", "Muhammad Ridwan Fahmi", "Ditta Dwi Anugrah", "Galuh Citra Rahayu", "Herdiansyah"],
            datasets: [
                {
                    label: "Minggu 2",
                    fillColor: "rgba(151,187,205,0.2)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",
                    data: [
                        <?= $dede['nilai_akhir'] ?>,<?= $fahmi['nilai_akhir'] ?>,<?= $ditta['nilai_akhir'] ?>,<?= $galuh['nilai_akhir'] ?>,<?= $herdi['nilai_akhir'] ?>
                    ]
                }
            ]
        };
        var ctxl = $("#lineChartDemo").get(0).getContext("2d");
        var lineChart = new Chart(ctxl).Line(data);
    </script>

</body>

</html>
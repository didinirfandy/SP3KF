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
                <h1><i class="fa fa-pencil-square-o"></i> Grafik Penilaian Satpam</h1>
                <p>MENGATASI MASALAH TANPA MASALAH!!!</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#"> Grafik Penilaian</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="row user1">
                    <div class="col-md-3"></div>
                    <div class="col-md-5">
                        <div class="profile1">
                            <div class="info">
                                <img class="app-sidebar__user-avatar1" src="<?= base_url(); ?>assets_application/assets/faces/<?= $nilai_fix_sat['image'] ?>">
                                <h4><?php $str = $nilai_fix_sat['nama_satpam'];
                                    echo wordwrap($str, 15, "<br>\n"); ?>
                                </h4>
                                <p>Satpam</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="tile">
                    <h3 class="tile-title">Grafik Keseluruhan</h3>
                    <div class="embed-responsive embed-responsive-16by9">
                        <canvas class="embed-responsive-item" id="radarChartDemo"></canvas>
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
            labels: ["Pakaian", "Perilaku / Sikap"],
            datasets: [
                {
                    label: "My First dataset",
                    fillColor: "rgba(80, 172, 26,0.5)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(0,0,0,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(0,0,0,1)",
                    data: [<?= $nilai_fix_sat['pakaian'] ?>, <?= $nilai_fix_sat['perilaku'] ?>]
                }
            ]
        }

        var ctxr = $("#radarChartDemo").get(0).getContext("2d");
        var radarChart = new Chart(ctxr).Radar(data);
    </script>

</body>

</html>
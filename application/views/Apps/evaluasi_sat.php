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
                <li class="breadcrumb-item"><a href="#"> Penilaian Satpam</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-title-w-btn">
                        <h5 class="title">Pimpinan Cabang (Admin)</h5>
                        <div class="btn-group">
                    <?php foreach ($evaluasi_sat as $e ) {?>
                            <a class="btn btn-primary" href="<?= Base_url();?>Home/evaluasi_nilai_sat/<?= date('Y-m-d', strtotime($e['periode'])) ?>"><i class="fa fa-eye"></i>Lihat Nilai</a>
                        </div>
                    </div>
                    <table>
                        <tbody>
                            <tr>
                                <td colspan="9"><?= date('d F Y', strtotime($e['periode'])) ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <td colspan="9"><textarea disabled rows="3" cols="142"><?= $e['evaluasi'] ?></textarea></td>
                                </td>
                            </tr>
                        <?php } ?>
                            
                        </tbody>
                    </table>
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
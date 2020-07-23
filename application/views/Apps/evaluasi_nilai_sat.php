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
                <h1><i class="fa fa-bar-chart"></i> Hasil Penilaian Satpam</h1>
                <p>MENGATASI MASALAH TANPA MASALAH!!!</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Hasil Penilaian Satpam</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <?php 
                    foreach ($bobot as $b ) 
                    {
                        $bobot[$b['selisih']] = $b['bobot'];
                    }
                    //---------------------Menyimpan tabel nilai dalam array---------------------
                    foreach($nilai_sat AS $n_bl)
                    {
                        $nilai_sample[$n_bl['nik']][$n_bl['id_faktor']] = $n_bl['nilai'];
                    }
                    //---------------------Menyimpan tabel satpam dalam array---------------------
                    $nama_satpam   = array();
                    $jenis_kar     = array();
                    $nik           = array();
                    $nilai_akhir   = array();
                    foreach ($satpam as $k) 
                    {
                        $nama_satpam[$k['nik']]   =   $k['nama_satpam'];
                        $nik[$k['nik']]           =   $k['nik'];
                        $jenis_kar[$k['nik']]     =   $k['jenis_kar'];
                        $genre[$k['nik']]         =   $k['genre'];
                    }
                    //---------------------Menyimpan tabel aspek dalam array---------------------
                    $nama_aspek   = array(); 
                    $nama_singkat = array(); 
                    $jumlah_kolom = array();
                    foreach ($aspek_sat as $a ) 
                    {
                        $aspek                          =   $a['id_aspek'];
                        $nama_aspek[$a['id_aspek']]     =   $a['nama_aspek'];
                        $nama_singkat[$a['id_aspek']]   =   $a['nama_singkat'];
                        $jumlah_kolom[$a['id_aspek']]   =   $a['jmlh_kolom'];
                        $ba_all[$a['id_aspek']]         =   $a['bobot'];
                        $ba_cf[$a['id_aspek']]          =   $a['bobot_core'];
                        $ba_sf[$a['id_aspek']]          =   $a['bobot_secondary'];

                        $faktor = $this->Model_admin->faktor_sat($a['id_aspek']);
                        $kolom = 1;
                        foreach ($faktor as $f ) 
                        {
                            $r_index[$aspek][$kolom]=$f['id_faktor'];
                            $kolom++;
                        }
                    }
                    ?>

                    <?php                                
                    foreach ($nama_aspek as $key => $value)
                    {
                        echo "<h4>".$nama_aspek[$key]."</h4>";
                        echo "<hr align='right' color='black'>";
                    ?>
                    <table class="table table-hover table-bordered table-sm">
                        <thead>
                            <tr>
                                <th bgcolor="#F5F5F5" >No</th>
                                <th bgcolor="#F5F5F5" >Nama satpam</th>
                                <?php for($kol=1;$kol<=$jumlah_kolom[$key];$kol++) {?>
                                <th bgcolor="#F5F5F5" ><?= $nama_singkat[$key]; ?><sub><?= $kol;?></sub></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <?php
                            reset($nama_satpam);
                            $nomor=1;
                            foreach ($nama_satpam as $k => $v )
                                {
                        ?>
                        <tbody>
                            <tr>
                                <td class="text-center"><?= $nomor++;?></td>
                                <td><?= $nama_satpam[$k];?></td>
                                <?php 
                                for($kol=1;$kol<=$jumlah_kolom[$key];$kol++) 
                                {
                                    $pos=$r_index[$key][$kol];
                                    if (isset($nilai_sample[$k])) 
                                    {
                                        if (isset($nilai_sample[$k][$pos])) 
                                        { ?>
                                            <td class="text-center" ><?= $nilai_sample[$k][$pos]; ?></td>
                                        <?php } else {?>
                                            <td class="text-center">0</td>
                                        <?php } 
                                    } else {?>
                                        <td class="text-center" >-</td>
                                    <?php }
                                } ?>
                            </tr>
                        </tbody>
                        <?php } ?>
                    </table>
                    <?php 
                    } ?>
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
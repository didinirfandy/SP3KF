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
                <h1><i class="fa fa-pencil-square-o"></i> Proses Hasil Penialain Satpam</h1>
                <p>MENGATASI MASALAH TANPA MASALAH!!!</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('Home/home_user') ?>"><i class="fa fa-home fa-lg"></i></a></li>
                <li class="breadcrumb-item"><a href="<?= Base_url('Home/edit_nilai_sat')?>">Hasil Penilaian Satpam</a></li>
                <li class="breadcrumb-item"> Proses Hasil Penilaian Satpam</li>
            </ul>
        </div>
        <?= $this->session->flashdata('status_insert'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="card-body">
                        <div class="tile-title-w-btn">
                            <?php
                                if (isset($_POST['cari_bulan_sat'])) 
                                {
                                    foreach ($nilai_sat as $n) { } 
                                        if (isset($n['entry_date'])) { ?>
                                    <h4 class="title">Daftar Nilai Satpam Bulan
                                        <?php
                                            $date = date('F Y', strtotime($n['entry_date']));
                                            echo $date;
                                            ?>
                                    </h4>
                                <?php } elseif (empty($n['entry_date'])) {?>
                                <h4 class="title">Daftar Nilai Satpam</h4>
                                <?php }?>
                            <?php } elseif (empty($_POST['cari_bulan_sat'])) { ?>
                                <h4 class="title">Daftar Nilai Satpam</h4>
                            <?php } ?>
                        </div>
                        <hr align="right" color="black">
                        <div class="row">
                            <div class="form-group mx-sm-3 mb-2">
                                <?= form_open('Home/cari_bulan_sat'); ?>
                                <input type="month" name="tgl" class="form-control">
                                <small class="form-text text-muted">Pilih Bulan yang akan anda cari</small>
                            </div>
                            <button class="btn btn-info mb-5" name="cari_bulan_sat" type="submit"><i class="fa fa-search fa-fw"></i> Cari</button>
                        </div>
                        <?= form_close() ?>

                        <?php 
                        if (isset($_POST['cari_bulan_sat'])) 
                        {
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
                                <hr align="right" color="black">
                                <h4 class="title">Daftar Nilai Faktor</h4>
                                <hr align="right" color="black">
                                <table class="table table-hover table-bordered table-sm" id="sampleTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Aspek</th>
                                            <th>Faktor</th>
                                            <th>Nilai Target</th>
                                            <th>Type</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <?php 
                                        $i=1;
                                        //---------------------Menyimpan tabel faktor dalam array dan menampilkan---------------------
                                            $target     = array();
                                            $nama_jenis = array();
                                            foreach ($faktor_sat as $df ) 
                                            {
                                                $target[$df['id_faktor']]     = $df['target'];
                                                $nama_jenis[$df['id_faktor']] = $df['nama_jenis'];
                                            
                                            ?>
                                            <td class="text-center"><?= $i++;?></td>
                                            <td><?= $df['nama_aspek'];?></td>
                                            <td><?= $df['nama_faktor'];?></td>
                                            <td class="text-center"><?= $df['target'];?></td>
                                            <td class="text-center"><?= $df['nama_jenis'];?></td>
                                        </tr>
                                            <?php 
                                            } 
                                            ?>
                                    </tbody>
                                </table>
                                <br><br>

                                <?php
                                $tot_akhir = $tot_akhir_pakaian = $tot_akhir_perilaku = 0;
                                $tot_array_pakaian = array(); 
                                $tot_array_perilaku = array();                                 
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
                                                        <td class="text-center">-</td>
                                                    <?php } 
                                                } else {?>
                                                    <td class="text-center" >-</td>
                                                <?php }
                                            } 
                                            
                                            $tot = 0;
                                            for($kol=1;$kol<=$jumlah_kolom[$key];$kol++) 
                                            {
                                                $pos=$r_index[$key][$kol];
                                                if (isset($nilai_sample[$k])) 
                                                {
                                                    if (isset($nilai_sample[$k][$pos])) 
                                                    { 
                                                        $tot += $nilai_sample[$k][$pos];
                                                        ?>
                                                        
                                                    <?php } else {?>
                                                        
                                                    <?php } 
                                                } else { ?>
                                                <?php }
                                            }
                                            $tot_akhir = $tot_akhir + $tot;
                                            if ($nama_aspek[$key]=="Pakaian") {
                                                array_push($tot_array_pakaian,array('nik' => $nik[$k] ,'nilai'=>$tot));
                                            }elseif ($nama_aspek[$key]=='Perilaku / Sikap') {
                                                array_push($tot_array_perilaku,array('nik' => $nik[$k] ,'nilai'=>$tot));
                                            }?>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                                <br>
                                <?php 
                                } ?>
                                <h2>PERHITUNGAN</h2>
                                <?php
                                //---------------------Proses menghitung nilai Faktor---------------------
                                reset($nama_aspek);		
                                foreach ($nama_aspek as $key => $value)
                                {
                                    echo "<h3>Aspek ".$nama_aspek[$key]."</h3>";
                                    echo "<hr align='right' color='black'>";
                                    ?>
                                    <table class="table table-hover table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <?php for($kol=1;$kol<=$jumlah_kolom[$key];$kol++) {?>
                                                <th><?php echo $nama_singkat[$key]; ?><sub><?php echo $kol;?></sub></th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php
                                    reset($nama_satpam);
                                    $nomor=1;
                                    foreach ($nama_satpam as $k => $v )
                                    {
                                        ?>
                                        <tr>
                                            <td><?php echo $nomor++;?></td>
                                            <td><?php echo $nama_satpam[$k];?></td>
                                        <?php 
                                        for($kol=1;$kol<=$jumlah_kolom[$key];$kol++) 
                                        {
                                            if (isset($nilai_sample[$k])) 
                                            {
                                                $pos=$r_index[$key][$kol];
                                                if (isset($nilai_sample[$k][$pos])) 
                                                {
                                                    $nilai_faktor[$k][$pos]=$nilai_sample[$k][$pos]-$target[$pos]
                                                    // echo $nilai_faktor[$k][$pos]=$nilai_sample[$k][$pos]-$target[$pos]."<br>";
                                                    ?>
                                                    <td class="text-center">(<?php echo $nilai_sample[$k][$pos]; ?>-<?php echo $target[$pos]; ?>)=<strong><?php echo $nilai_faktor[$k][$pos];?></strong></td>
                                                    <?php
                                                } else {
                                                ?>
                                                    <td class="text-center">-</td>
                                                <?php 
                                                }
                                            } else {
                                            ?>
                                                <td class="text-center">-</td>
                                            <?php 
                                            }
                                        }
                                    }?>
                                        </tbody>
                                    </table>
                                    <br>
                                <?php
                                }?>

                                <h2>PEMBOBOTAN</h2>
                                <?php
                                reset($nama_aspek);		
                                foreach ($nama_aspek as $key => $value)
                                {
                                    echo "<h3>Aspek ".$nama_aspek[$key]." (".$ba_all[$key]."%)</h3>";
                                    ?>
                                    <table class="table table-hover table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <?php 
                                                for($kol=1;$kol<=$jumlah_kolom[$key];$kol++) 
                                                {
                                                    $pos=$r_index[$key][$kol];
                                                    ?>
                                                        <th><?php echo $nama_singkat[$key]; ?><sub><?php echo $kol;?></sub>[<?php echo $nama_jenis[$pos];?>]</th>
                                                    <?php
                                                } ?>
                                                <th>rCF(<?php echo $ba_cf[$key];?>%)</th>
                                                <th>rSF(<?php echo $ba_sf[$key];?>%)</th>
                                                <th>Nilai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php

                                    reset($nama_satpam);
                                    $nomor=1;
                                    foreach ($nama_satpam as $k => $v )
                                    {
                                        $jum_cf=$jum_sf=$ccf=$csf=0;
                                        ?>
                                        <tr>
                                            <td><?php echo $nomor++;?></td>
                                            <td><?php echo $nama_satpam[$k];?></td>
                                            <?php
                                            for($kol=1;$kol<=$jumlah_kolom[$key];$kol++)
                                            {
                                                if (isset($nilai_sample[$k])) 
                                                {
                                                    $pos=$r_index[$key][$kol];
                                                    if (isset($nilai_sample[$k][$pos])) 
                                                    {
                                                        $nilai_bobot[$k][$pos]=$bobot[$nilai_sample[$k][$pos]-$target[$pos]];
                                                        if($nama_jenis[$pos]=="C")
                                                        {
                                                            $jum_cf+=$nilai_bobot[$k][$pos];
                                                            $ccf++;	
                                                            // echo $jum_cf+=$nilai_bobot[$k][$pos];
                                                        } else {
                                                            $jum_sf+=$nilai_bobot[$k][$pos];
                                                            $csf++;	
                                                            // echo $jum_sf+=$nilai_bobot[$k][$pos];
                                                        }
                                                        ?>	
                                                        <td class="text-center"><?php echo $nilai_bobot[$k][$pos];?></td>
                                                    <?php } else { ?>
                                                        <td class="text-center">-</td>
                                                    <?php }
                                                } else { ?>
                                                    <td class="text-center">-</td>
                                                <?php }
                                            }
                                            if (isset($nilai_sample[$k]))
                                            {
                                                $ncf=$jum_cf/$ccf;
                                                $nsf=$jum_sf/$csf;
                                                $nilai_bobot[$k][$key]=$ba_cf[$key]*($ncf/100)+$ba_sf[$key]*($nsf/100);
                                                if (isset($nilai_akhir[$k])) 
                                                {
                                                    $nilai_akhir[$k]+=$nilai_bobot[$k][$key]*($ba_all[$key]/100);
                                                } else {
                                                    $nilai_akhir[$k]=0;
                                                }
                                            } else {
                                                $ncf=0;
                                                $nsf=0;
                                                $nilai_bobot[$k][$key]=0;
                                                $nilai_akhir[$k]=0;
                                            }
                                            ?>
                                            <td class="text-center"><?php echo $jum_cf."/".$ccf;?>=<?php echo number_format($ncf,2,",","."); ?></td>
                                            <td class="text-center"><?php echo $jum_sf."/".$csf;?>=<?php echo number_format($nsf,2,",","."); ?></td>
                                            <td class="text-center"><?php echo  number_format($nilai_bobot[$k][$key],2,",","."); ?></td>
                                        </tr>
                                            <?php
                                    }?>
                                        </tbody>
                                    </table>
                                <?php
                                }
                                
                                // echo reset($nilai_akhir);
                                reset($nilai_akhir);
                                // echo arsort($nilai_akhir);
                                arsort($nilai_akhir);
                                ?>
                                <br><br>
                                <hr align="right" color="black">
                                <h4 class="title">Nilai Akhir Rengking</h4>
                                <hr align="right" color="black">
                                <table class="table table-hover table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Nilai</th>
                                            <th>Evaluasi</th>
                                        </tr>
                                    </thead>
                                    <?= form_open('Home/entry_nilai_sat_fix'); ?>
                                    <tbody>
                                        <?php 
                                        $i=1;
                                        foreach ($nilai_akhir as $k => $v) 
                                        {
                                            if (isset($nama_satpam[$k])) {
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $i++; ?></td>
                                            <td>
                                                <?= $nama_satpam[$k]; ?>
                                                <input type="hidden" name="nama_satpam[]" value="<?= $nama_satpam[$k]; ?>" >
                                                <input type="hidden" name="nik[]" value="<?= $nik[$k]; ?>" >
                                                <input type="hidden" name="genre[]" value="<?= $genre[$k]; ?>" >
                                                <input type="hidden" name="jenis_kar[]" value="<?= $jenis_kar[$k]; ?>" >
                                                <input type="hidden" name="nilai bobot[]" value="<?= number_format($nilai_bobot[$k][$key],2,",","."); ?>" >
                                                <?php 
                                                foreach ($tot_array_pakaian as $a) 
                                                {
                                                    if ($nik[$k] == $a['nik']) {
                                                        $hasil_pakaian = ($a['nilai']/$tot_akhir)*100;
                                                        ?>
                                                        <input type="hidden" name="pakaian[]" value="<?= $hasil_pakaian; ?>" >
                                                        <?php
                                                    }
                                                }
                                                foreach ($tot_array_perilaku as $a) 
                                                {
                                                    if ($nik[$k] == $a['nik']) {
                                                        $hasil_perilaku = ($a['nilai']/$tot_akhir)*100;
                                                        ?>
                                                        <input type="hidden" name="perilaku[]" value="<?= $hasil_perilaku; ?>" >
                                                        <?php
                                                    }
                                                }
                                                if (isset($n['entry_date'])) {?>
                                                <input type="hidden" name="periode[]" value="<?= $n['entry_date'] ?>" >
                                                <?php } ?>
                                            </td>
                                            <td class="text-center">
                                                <?= number_format($nilai_akhir[$k],2,",","."); ?>
                                                <input type="hidden" name="nilai_akhir[]" value="<?= number_format($nilai_akhir[$k],2,",","."); ?>" >
                                            </td>
                                            <td class="text-center">
                                                <textarea name="evaluasi[]" rows="3" cols="50"></textarea>
                                            </td>
                                        </tr>
                                        <?php
                                            } else {?>
                                                <tr>
                                                    <td class="text-center"><?= $i++; ?></td>
                                                    <td><b>LENGKAPI DATA TERLEBIH DAHULU</b></td>
                                                    <td class="text-center">0.00</td>
                                                    <td class="text-center">
                                                        <textarea name="evaluasi" rows="2" cols="50"></textarea>
                                                    </td>
                                                </tr>
                                            <?php 
                                            }
                                        } 
                                        ?>
                                    </tbody>
                                </table>
                                <hr align="right" color="black">
                                <div class="footer">
                                    <button class="btn btn-primary" name="submit" type="submit"><i class="fa fa-fw fa-floppy-o"></i>Simpan</button>
                                </div>
                                <?= form_close() ?>

                        <?php 
                        } else {
                        ?>
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th bgcolor="#F5F5F5" >No</th>
                                    <th bgcolor="#F5F5F5" >Nama satpam</th>
                                    <th bgcolor="#F5F5F5" >Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="3"></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-center" >Data not found</td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                </tr>
                            </tbody>
                        </table>
                        <?php } ?>
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
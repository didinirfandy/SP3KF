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
                <h1><i class="fa fa-pencil-square-o"></i> Proses Hasil Penialain Karyawan</h1>
                <p>MENGATASI MASALAH TANPA MASALAH!!!</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('Home/home_user') ?>"><i class="fa fa-home fa-lg"></i></a></li>
                <li class="breadcrumb-item"><a href="<?= Base_url('Home/edit_nilai_kar')?>">Hasil Penilaian Karyawan</a></li>
                <li class="breadcrumb-item"> Proses Hasil Penilaian Karyawan</li>
            </ul>
        </div>
        <?= $this->session->flashdata('status_insert'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="card-body">
                        <div class="tile-title-w-btn">
                            <?php
                                if (isset($_POST['cari_bulan_kar'])) {
                                    if (isset($nilai_kar)) { 
                                    foreach ($nilai_kar as $n) { } ?>
                                    <h4 class="title">Daftar Nilai Karyawan Bulan
                                        <?php
                                            date_default_timezone_set('Asia/Jakarta');
                                            $date = date('F Y', strtotime($n['entry_date']));
                                            echo $date;
                                            ?>
                                    </h4>
                                <?php } elseif (empty($nilai_kar)) {?>
                                <h4 class="title">Daftar Nilai Karyawan</h4>
                                <?php }?>
                            <?php } elseif (empty($_POST['cari_bulan_sat'])) { ?>
                                <h4 class="title">Daftar Nilai Karyawan</h4>
                            <?php } ?>
                        </div>
                        <hr align="right" color="black">
                        <div class="row">
                            <div class="form-group mx-sm-3 mb-2">
                                <?= form_open('Home/cari_bulan_kar'); ?>
                                <input type="month" name="tgl" class="form-control">
                                <small class="form-text text-muted">Pilih Bulan yang akan anda cari</small>
                            </div>
                            <button class="btn btn-info mb-5" name="cari_bulan_kar" type="submit"><i class="fa fa-search fa-fw"></i> Cari</button>
                        </div>
                        <?= form_close() ?>

                        <?php 
                        if (isset($_POST['cari_bulan_kar'])) 
                        {
                                foreach ($bobot as $b ) 
                                {
                                    $bobot[$b['selisih']] = $b['bobot'];
                                }
                            //---------------------Menyimpan tabel nilai dalam array---------------------
                                foreach($nilai_kar AS $n_bl)
                                {
                                    if ($minggu[$n_bl['nik']][$n_bl['id_faktor']] = $n_bl['mingguke'] == "1") 
                                    {
                                        $nilai_sample[$n_bl['nik']][$n_bl['id_faktor']] = $n_bl['nilai_t'];
                                    }
                                    elseif ($minggu[$n_bl['nik']][$n_bl['id_faktor']] = $n_bl['mingguke'] == "2") 
                                    {
                                        $nilai_sample[$n_bl['nik']][$n_bl['id_faktor']] = round($n_bl['nilai_t']/2);
                                    } 
                                    elseif ($minggu[$n_bl['nik']][$n_bl['id_faktor']] = $n_bl['mingguke'] == "3") 
                                    {
                                        $nilai_sample[$n_bl['nik']][$n_bl['id_faktor']] = round($n_bl['nilai_t']/3);
                                    } 
                                    elseif ($minggu[$n_bl['nik']][$n_bl['id_faktor']] = $n_bl['mingguke'] == "4" ) 
                                    {
                                        $nilai_sample[$n_bl['nik']][$n_bl['id_faktor']] = round($n_bl['nilai_t']/4);
                                    } 
                                    
                                }
                            //---------------------Menyimpan tabel karyawan dalam array---------------------
                                $nama_karyawan = array();
                                $jenis_kar     = array();
                                $nik           = array();
                                $nilai_akhir   = array();
                                foreach ($karyawan as $k) 
                                {
                                    $nama_karyawan[$k['nik']] =  $k['nama_karyawan'];
                                    $nik[$k['nik']]           =  $k['nik'];
                                    $jenis_kar[$k['nik']]     =  $k['jenis_kar'];
                                    $genre[$k['nik']]         =  $k['genre'];
                                    $nilai_akhir[$k['nik']]   =  0;
                                }
                            //---------------------Menyimpan tabel aspek dalam array---------------------
                                $nama_aspek   = array(); 
                                $nama_singkat = array(); 
                                $jumlah_kolom = array();
                                $nama_faktor  = array();
                                foreach ($aspek_kar as $a ) 
                                {
                                    $aspek                          =   $a['id_aspek'];
                                    $nama_aspek[$a['id_aspek']]     =   $a['nama_aspek'];
                                    $nama_singkat[$a['id_aspek']]   =   $a['nama_singkat'];
                                    $jumlah_kolom[$a['id_aspek']]   =   $a['jmlh_kolom'];
                                    $ba_all[$a['id_aspek']]         =   $a['bobot'];
                                    $ba_cf[$a['id_aspek']]          =   $a['bobot_core'];
                                    $ba_sf[$a['id_aspek']]          =   $a['bobot_secondary'];

                                    $faktor = $this->Model_admin->faktor_kar($a['id_aspek']);
                                    $kolom = 1;
                                    foreach ($faktor as $f ) 
                                    {
                                        $nama_faktor[$aspek][$kolom] = $f['nama_faktor'];
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
                                            foreach ($faktor_kar as $df ) 
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
                                $tot_akhir = $tot_akhir_pakaian = $tot_akhir_perilaku = $tot_akhir_telepon = 0;
                                $tot_array_pakaian = array(); 
                                $tot_array_perilaku = array(); 
                                $tot_array_telepon = array();                           
                                foreach ($nama_aspek as $key => $value)
                                {
                                    echo "<h4>".$nama_aspek[$key]."</h4>";
                                    echo "<hr align='right' color='black'>";
                                ?>
                                <table class="table table-hover table-bordered table-sm">
                                    <thead>
                                        <tr bgcolor="#F5F5F5">
                                            <th>No</th>
                                            <th>Nama Karyawan</th>
                                            <?php for($kol=1;$kol<=$jumlah_kolom[$key];$kol++) {?>
                                            <th><a data-toggle="tooltip" data-placement="top" title="<?= $nama_faktor[$key][$kol]; ?>"><?= $nama_singkat[$key]; ?><sub><?= $kol;?></sub></a></th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <?php
                                        reset($nama_karyawan);
                                        $nomor=1;
                                        
                                        foreach ($nama_karyawan as $k => $v )
                                            {
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td class="text-center"><?= $nomor++;?></td>
                                            <td><?= $nama_karyawan[$k];?></td>
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
                                                        <td class="text-center">tidak sesuai gender</td>
                                                    <?php } 
                                                } else { ?>
                                                    <td class="text-center">-</td>
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
                                            
                                            if ($nama_aspek[$key]=="Pakaian") 
                                            {
                                                array_push($tot_array_pakaian,array('nik' => $nik[$k] ,'nilai'=>$tot));
                                            }
                                            elseif ($nama_aspek[$key]=='Perilaku / Sikap') 
                                            {
                                                array_push($tot_array_perilaku,array('nik' => $nik[$k] ,'nilai'=>$tot));
                                            }
                                            elseif ($nama_aspek[$key]=='Penerimaan Telepon') 
                                            {
                                                array_push($tot_array_telepon,array('nik' => $nik[$k] ,'nilai'=>$tot));
                                            } ?>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <br>
                                <?php 
                                } 
                                //echo $tot_akhir;    
                                ?>

                                <h3>PERHITUNGAN</h3>
                                <?php
                                //---------------------Proses menghitung nilai Faktor---------------------
                                reset($nama_aspek);		
                                foreach ($nama_aspek as $key => $value)
                                {
                                    echo "<h4>Aspek ".$nama_aspek[$key]."</h4>";
                                    echo "<hr align='right' color='black'>";
                                    ?>
                                    <table class="table table-hover table-bordered table-sm">
                                        <thead>
                                            <tr bgcolor="#F5F5F5">
                                                <th>No</th>
                                                <th>Nama</th>
                                                <?php for($kol=1;$kol<=$jumlah_kolom[$key];$kol++) {?>
                                                <th><a data-toggle="tooltip" data-placement="top" title="<?= $nama_faktor[$key][$kol]; ?>"><?= $nama_singkat[$key]; ?><sub><?= $kol;?></sub></a></th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php
                                    reset($nama_karyawan);
                                    $nomor=1;
                                    foreach ($nama_karyawan as $k => $v )
                                    {
                                        ?>
                                        <tr>
                                            <td><?= $nomor++;?></td>
                                            <td><?= $nama_karyawan[$k];?></td>
                                        <?php 
                                        for($kol=1;$kol<=$jumlah_kolom[$key];$kol++) 
                                        {
                                            if (isset($nilai_sample[$k])) 
                                            {
                                                $pos=$r_index[$key][$kol];
                                                if (isset($nilai_sample[$k][$pos])) // id_faktor
                                                {
                                                    $nilai_faktor[$k][$pos]=$nilai_sample[$k][$pos]-$target[$pos]
                                                    // echo $nilai_faktor[$k][$pos]=$nilai_sample[$k][$pos]-$target[$pos]."<br>";
                                                    ?>
                                                    <td class="text-center">(<?= $nilai_sample[$k][$pos]; ?>-<?= $target[$pos]; ?>)=<strong><?= $nilai_faktor[$k][$pos];?></strong></td>
                                                    <?php
                                                } else {
                                                ?>
                                                    <td class="text-center">0</td>
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

                                <h3>PEMBOBOTAN</h3>
                                <?php
                                reset($nama_aspek);		
                                foreach ($nama_aspek as $key => $value)
                                {
                                    echo "<h4>Aspek ".$nama_aspek[$key]." (".$ba_all[$key]."%)</h4>";
                                    echo "<hr align='right' color='black'>";
                                    ?>
                                    <table class="table table-hover table-bordered table-sm">
                                        <thead>
                                            <tr bgcolor="#F5F5F5">
                                                <th>No</th>
                                                <th>Nama</th>
                                                <?php 
                                                for($kol=1;$kol<=$jumlah_kolom[$key];$kol++) 
                                                {
                                                    $pos=$r_index[$key][$kol];
                                                    if (isset($nama_jenis[$pos])) {
                                                    ?>
                                                        <th class="text-center"><a data-toggle="tooltip" data-placement="top" title="<?= $nama_faktor[$key][$kol]; ?>"><?= $nama_singkat[$key]; ?><sub><?= $kol;?></sub>[<?= $nama_jenis[$pos];?>]</a></th>
                                                    <?php } else { ?>
                                                        <th class="text-center"><a data-toggle="tooltip" data-placement="top" title="<?= $nama_faktor[$key][$kol]; ?>"><?= $nama_singkat[$key]; ?><sub><?= $kol;?></sub>[-]</a></th>
                                                    <?php
                                                    }
                                                } ?>
                                                <th class="text-center">rCF(<?= $ba_cf[$key];?>%)</th>
                                                <th class="text-center">rSF(<?= $ba_sf[$key];?>%)</th>
                                                <th class="text-center">Nilai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php

                                    reset($nama_karyawan);
                                    $nomor=1;
                                    foreach ($nama_karyawan as $k => $v )
                                    {
                                        $jum_cf=$jum_sf=$ccf=$csf=0;
                                        ?>
                                        <tr>
                                            <td><?= $nomor++;?></td>
                                            <td><?= $nama_karyawan[$k];?></td>
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
                                                        <td class="text-center"><?= $nilai_bobot[$k][$pos];?></td>
                                                    <?php } else { ?>
                                                        <td class="text-center">0</td>
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
                                                $nilai_akhir[$k]+=$nilai_bobot[$k][$key]*($ba_all[$key]/100);
                                                
                                            } else {
                                                $ncf=0;
                                                $nsf=0;
                                                $nilai_bobot[$k][$key]=0;
                                                $nilai_akhir[$k]=0;
                                            }
                                            ?>
                                            <td class="text-center"><?= $jum_cf."/".$ccf;?>=<?= number_format($ncf,2,",","."); ?></td>
                                            <td class="text-center"><?= $jum_sf."/".$csf;?>=<?= number_format($nsf,2,",","."); ?></td>
                                            <td class="text-center"><?=  number_format($nilai_bobot[$k][$key],2,",","."); ?></td>
                                        </tr>
                                            <?php
                                    }?>
                                        </tbody>
                                    </table>
                                    <br>
                                <?php
                                }
                                
                                // echo reset($nilai_akhir);
                                reset($nilai_akhir);
                                // echo arsort($nilai_akhir);
                                arsort($nilai_akhir);
                                ?>
                                <br><br>
                                <hr align="right" color="black">
                                <h4 class="title">Nilai Akhir Ranking</h4>
                                <hr align="right" color="black">
                                <table class="table table-hover table-bordered table-sm">
                                    <thead>
                                        <tr bgcolor="#F5F5F5">
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Nilai</th>
                                            <th>Evaluasi</th>
                                        </tr>
                                    </thead>
                                    <?= form_open('Home/entry_nilai_kar_fix'); ?>
                                    <tbody>
                                        <?php 
                                        $i=1;
                                        foreach ($nilai_akhir as $k => $v ) 
                                        {
                                            if (isset($nama_karyawan[$k])) {
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $i++; ?></td>
                                            <td>
                                                <?= $nama_karyawan[$k]; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= number_format($nilai_akhir[$k],2,".","."); ?>
                                                <input type="hidden" name="nilai_akhir[]" value="<?= number_format($nilai_akhir[$k],2,".","."); ?>" >
                                            </td>
                                            <td class="text-center">
                                                <!-- <input type="text" name="status[]" value="1" > -->
                                                <textarea name="evaluasi[]" rows="3" cols="50"></textarea>
                                                
                                                <input type="hidden" name="nama_karyawan[]" value="<?= $nama_karyawan[$k]; ?>" >
                                                <input type="hidden" name="nik[]" value="<?= $nik[$k]; ?>" >
                                                <input type="hidden" name="genre[]" value="<?= $genre[$k]; ?>" >
                                                <input type="hidden" name="jenis_kar[]" value="<?= $jenis_kar[$k]; ?>" >
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
                                                foreach ($tot_array_telepon as $a) 
                                                {
                                                    if ($nik[$k] == $a['nik']) {
                                                        $hasil_telepon = ($a['nilai']/$tot_akhir)*100;
                                                        ?>
                                                        <input type="hidden" name="telepon[]" value="<?= $hasil_telepon; ?>" >
                                                        <?php
                                                    }
                                                } 
                                                foreach ($nilai_kar as $n) { 
                                                if (isset($n['entry_date'])) {?>
                                                <input type="hidden" name="periode[]" value="<?= $n['entry_date'] ?>" >
                                                <?php } }?>
                                            </td>
                                        </tr>
                                        <?php
                                            } else {?>
                                                <tr>
                                                    <td class="text-center"></td>
                                                    <td><b>LENGKAPI DATA TERLEBIH DAHULU</b></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center">
                                                        <textarea rows="2" cols="50"></textarea>
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
                                    <th bgcolor="#F5F5F5" >Nama Karyawan</th>
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
    <script>
        $(function (){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

</body>

</html>
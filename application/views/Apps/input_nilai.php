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
                <h1><i class="fa fa-bar-chart"></i> Penilaian Karyawan Oprasional</h1>
                <p>MENGATASI MASALAH TANPA MASALAH!!!</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Penilaian Karyawan</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
					<div class="card-body">
                        <div class="tile-title-w-btn">
                            <h3 class="title">Penampilan dan Perilaku <i>Frontliners</i></h3>
                        </div>
						<?= form_open('Home/entry_nilai'); ?>
						<table class="table table-bordered table-sm">
							<thead>
								<tr>
									<?php 
									$jns_kar  = $this->uri->segment(5);
									if ($jns_kar == 1) 
									{
									?>
										<th width="33%" bgcolor="#F5F5F5"><b>IDENTITAS KARYAWAN</b></th>
									<?php 
									} 
									elseif ($jns_kar == 2) 
									{
									?>
										<th width="33%" bgcolor="#F5F5F5"><b>IDENTITAS SATPAM</b></th>
									<?php 
									}
									?>
									<th width="33%" bgcolor="#F5F5F5"><b>IDENTITAS PENILAI</b></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<?php 
										foreach ($dinilai as $lai) 
										{
											$jns_kar  = $this->uri->segment(5);
											if ($jns_kar == 1) 
											{
											?>
												<div class="form-row">
													<div class="form-group col-md-10">
														<label class="col-form-label col-form-label-sm">Nama Karyawan</label>
														<input class="form-control form-control-sm" type="text" readonly value="<?= $lai['nama_karyawan'] ?>">
													</div>
													<div class="form-group col-md-2">
														<label class="col-form-label col-form-label-sm">NIK</label>
														<input class="form-control form-control-sm" type="text" readonly value="<?= $lai['nik'] ?>">
													</div>
												</div>
												<div class="form-row">
													<div class="form-group col-md-4">
														<label class="col-form-label col-form-label-sm">Jabatan</label>
														<input class="form-control form-control-sm" type="text" readonly value="<?= $lai['jabatan'] ?>">
													</div>
													<div class="form-group col-md-4">
														<label class="col-form-label col-form-label-sm">Unit Kerja</label>
														<input class="form-control form-control-sm" type="text" readonly value="<?= $lai['unit_kerja'] ?>">
													</div>
													<div class="form-group col-md-4">
														<label class="col-form-label col-form-label-sm">KTP</label>
														<input class="form-control form-control-sm" type="text" readonly value="<?= $lai['ktp'] ?>">
													</div>
												</div>
											<?php 
											} 
											elseif ($jns_kar == 2) 
											{
											?>
												<div class="form-row">
													<div class="form-group col-md-9">
														<label class="col-form-label col-form-label-sm">Nama satpam</label>
														<input class="form-control form-control-sm" type="text" readonly value="<?= $lai['nama_satpam'] ?>">
													</div>
													<div class="form-group col-md-3">
														<label class="col-form-label col-form-label-sm">NIK</label>
														<input class="form-control form-control-sm" type="text" readonly value="<?= $lai['nik'] ?>">
													</div>
												</div>
												<div class="form-row">
													<div class="form-group col-md-6">
														<label class="col-form-label col-form-label-sm">Unit Kerja</label>
														<input class="form-control form-control-sm" type="text" readonly value="<?= $lai['unit_kerja'] ?>">
													</div>
													<div class="form-group col-md-6">
														<label class="col-form-label col-form-label-sm">No HP</label>
														<input class="form-control form-control-sm" type="text" readonly value="<?= $lai['no_hp'] ?>">
													</div>
												</div>
										<?php }
										}?>
									</td>
									<td>
										<?php 
										$jns_kar  = $this->uri->segment(5);
										if ($jns_kar == 1) 
										{
										?>
											<div class="form-row">
												<div class="form-group col-md-10">
													<label class="col-form-label col-form-label-sm">Nama Karyawan</label>
													<input class="form-control form-control-sm" type="text" readonly value="<?= $this->session->userdata('nama_pegawai'); ?>" >
												</div>
												<div class="form-group col-md-2">
													<label class="col-form-label col-form-label-sm">NIK</label>
													<input class="form-control form-control-sm" type="text" readonly value="<?= $this->session->userdata('nik'); ?>">
												</div>
											</div>
											<div class="form-row">
												<div class="form-group col-md-4">
													<label class="col-form-label col-form-label-sm">Tanggal Pemerikasan</label>
													<input class="form-control form-control-sm" type="date" name="entry_date" placeholder="DD-MM-YYYY" >
													<!-- <input class="form-control form-control-sm" type="text" readonly value="<?php $tgl=date('d-m-Y'); echo $tgl;?>"> -->
												</div>
												<div class="form-group col-md-4">
													<label class="col-form-label col-form-label-sm">Periode Penilaian</label>
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
														// echo 'Minggu ke-'.($minggu).' ';

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
														// echo tgl_indo(date("Y-m-d"));
													?>
													<input class="form-control form-control-sm" type="text" value="<?= 'Minggu ke-'.($minggu).' '.tgl_indo(date("Y-m-d")) ?>" >
												</div>
												<div class="form-group col-md-4">
													<label class="col-form-label col-form-label-sm">Sesi Pemerikasan</label>
													<?php 
														date_default_timezone_set("Asia/Jakarta");
														
														$b = time();
														$hour = date("G",$b);

														if ($hour>=6 AND $hour<=10)
														{
															$sesi = "Pagi";
														}
														elseif ($hour >=11 AND $hour<=14)
														{
															$sesi = "Siang";
														}
														elseif ($hour >=15 AND $hour<=17)
														{
															$sesi = "Sore";
														} else {
															$sesi = "Malam";
														}
													?>
													<input class="form-control form-control-sm" type="text" name="sesi_periksa" readonly value="<?= $sesi; ?>" >
												</div>
											</div>
										<?php 
										} 
										elseif ($jns_kar == 2) 
										{
										?>
												<div class="form-row">
													<div class="form-group col-md-9">
														<label class="col-form-label col-form-label-sm">Nama Satpam</label>
														<input class="form-control form-control-sm" type="text" readonly value="<?= $this->session->userdata('nama_pegawai'); ?>" >
													</div>
													<div class="form-group col-md-3">
														<label class="col-form-label col-form-label-sm">NIK</label>
														<input class="form-control form-control-sm" type="text" readonly value="<?= $this->session->userdata('nik'); ?>">
													</div>
												</div>
												<div class="form-row">
													<div class="form-group col-md-4">
														<label class="col-form-label col-form-label-sm">Tanggal Pemerikasan</label>
														<input class="form-control form-control-sm" type="date" name="entry_date" placeholder="DD-MM-YYYY" >
														<!-- <input class="form-control form-control-sm" type="text" readonly value="<?php $tgl=date('d-m-Y'); echo $tgl;?>"> -->
													</div>
													<div class="form-group col-md-4">
													<label class="col-form-label col-form-label-sm">Periode Penilaian</label>
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
															// echo 'Minggu ke-'.($minggu).' ';

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
															// echo tgl_indo(date("Y-m-d"));
														?>
														<input class="form-control form-control-sm" type="text" value="<?= 'Minggu ke-'.($minggu).' '.tgl_indo(date("Y-m-d")) ?>" >
													</div>
													<div class="form-group col-md-4">
														<label class="col-form-label col-form-label-sm">Sesi Pemerikasan</label>
														<?php 
															date_default_timezone_set("Asia/Jakarta");
															
															$b = time();
															$hour = date("G",$b);

															if ($hour>=6 && $hour<=10)
															{
																$sesi = "Pagi";
															}
															elseif ($hour >=11 && $hour<=14)
															{
																$sesi = "Siang";
															}
															elseif ($hour >=15 && $hour<=17)
															{
																$sesi = "Sore";
															} else {
																$sesi = "Malam";
															}
														?>
														<input class="form-control form-control-sm" type="text" name="sesi_periksa" readonly value="<?= $sesi; ?>" >
													</div>
												</div>
										<?php 
										}
										?>
									</td>
								</tr>
							</tbody>
						</table>
						<table class="table table-bordered table-sm">
							<thead>
								<tr bgcolor="#F5F5F5">
									<th rowspan="2" >NO</th>
									<th rowspan="2" >OBYEK PENGAMATAN</th>
									<th colspan="4" >NILAI</th>
								</tr>
								<tr bgcolor="#F5F5F5">
									<th>1 (Kurang)</th>
									<th>2 (Cukup)</th>
									<th>3 (Bagus)</th>
									<th>4 (Sangat Bagus)</th>
								</tr>
							</thead>
							<tbody>
							<?php
							$nexttype= 0;
							foreach ($faktor_nilai as $key) 
							{  
								$aspek = $nexttype == $key['aspek']? "":$key['nama_aspek'];
								if ($aspek != "") 
								{
									$n=1;
								?>
								<tr>
									<td colspan="10"><b><?= $key['nama_aspek']; ?></b></td>
								</tr>
								<?php }?>
								<tr>
									<td width="20" valign="top"><?=$n;?></td>
									<td valign="top">
										<?= $key['nama_faktor'] ?>
										<input type="hidden" name="id_faktor[]" value="<?=$key['id_faktor'];?>" >
										<input type="hidden" name="nm_sing[]" value="<?=$key['nama_singkat'];?>" >
										<input type="hidden" name="aspek[]" value="<?=$key['aspek'];?>" >
										<input type="hidden" name="genre[]" value="<?= $this->uri->segment(4); ?>" >
										<input type="hidden" name="jnis_kar[]" value="<?= $this->uri->segment(5); ?>" >
										<input type="hidden" name="entry_userid[]" value="<?= $this->session->userdata('nama_pegawai'); ?>" >
										<input type="hidden" name="nik[]" value="<?= $lai['nik'] ?>" >
										<input type="hidden" name="target[]" value="<?= $key['target'] ?>" >
									</td>
									<td valign="top" align="center">
										<div class="animated-radio-button">
											<label>
												<input type="radio" name="nilai[]<?=$key['id_faktor'];?>" value="1" <?=$key['nilai']==1? "checked":"";?> ><span class="label-text"></span>
											</label>
										</div>
									</td>
									<td valign="top" align="center">
										<div class="animated-radio-button">
											<label>
												<input type="radio" name="nilai[]<?=$key['id_faktor'];?>" value="2" <?=$key['nilai']==2? "checked":"";?> ><span class="label-text"></span>
											</label>
										</div>
									</td>
									<td valign="top" align="center">
										<div class="animated-radio-button">
											<label>
												<input type="radio" name="nilai[]<?=$key['id_faktor'];?>" value="3" <?=$key['nilai']==3? "checked":"";?> ><span class="label-text"></span>
											</label>
										</div>
									</td>
									<td valign="top" align="center">
										<div class="animated-radio-button">
											<label>
												<input type="radio" name="nilai[]<?=$key['id_faktor'];?>" value="4" <?=$key['nilai']==4? "checked":"";?> ><span class="label-text"></span>
											</label>
										</div>
									</td>
								</tr>
							<?php 
							$nexttype = $key['aspek'];
							$n++;
							}//$i++; ?>
								<tr>
									<th colspan="9" bgcolor="#F5F5F5" width="100">Catatan</th>
								</tr>
								<tr>
									<td colspan="9"><textarea name="catatan" rows="3" cols="135"></textarea></td>
								</tr>
							</tbody>
						</table>
						<hr align="right" color="black">
						<div class="modal-footer">
							<a class="btn btn-secondary" href="<?= Base_url();?>Home/in_nilai_kar"><i class="fa fa-arrow-left"></i>Kembali</a>
							<button class="btn btn-primary" name="submit" type="submit"><i class="fa fa-fw fa-floppy-o"></i>Simpan</button>
						</div>
						<?= form_close() ?>
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
	<script type="text/javascript">
		$('.select2').select2();
	</script>

</body>

</html>
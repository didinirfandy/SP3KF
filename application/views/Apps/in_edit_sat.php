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
                <h1><i class="fa fa-bar-chart"></i> Edit Nilai Satpam</h1>
                <p>MENGATASI MASALAH TANPA MASALAH!!!</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="<?= Base_url();?>Home/edit_nilai_sat">Hasil Nilai Satpam</a></li>
                <li class="breadcrumb-item">Edit Nilai Satpam</li>
            </ul>
        </div>
        <?= $this->session->flashdata('status_insert'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
					<div class="card-body">
                        <div class="tile-title-w-btn">
                            <h3 class="title">Edit Nilai Satpam</h3>
                        </div>
                        <div class="row">
                            <div class="form-group mx-sm-3 mb-2">
                            <?= form_open('Home/data_nilai_sat'); ?>
                                <input type="month" name="entry_date" class="form-control">
                                <small class="form-text text-muted">Pilih Bulan yang akan anda cari</small>
                                <input type="hidden" name="nik" value="<?= $this->uri->segment(3); ?>">
                            </div>
                            <button class="btn btn-info mb-5" name="cari_data_nilai" type="submit"><i class="fa fa-search fa-fw"></i> Cari</button>
                            <?= form_close() ?>
                        </div>
						<?= form_open('Home/in_edit_sat'); ?>
						<table class="table table-bordered table-sm">
							<thead>
								<tr bgcolor="#F5F5F5">
									<th rowspan="2">NO</th>
									<th rowspan="2">OBYEK PENGAMATAN</th>
                                    <th rowspan="2">TANGGAL</th>
									<th colspan="4">NILAI</th>
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
                            if (isset($_POST['cari_data_nilai'])) {
                                $nexttype= 0;
                                foreach ($nli_sat as $key) 
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
                                            <input type="hidden" name="id_nilai[]" value="<?=$key['id_nilai'];?>" >
                                        </td>
                                        <td class="text-center" ><?= $key['entry_date'] ?></td>
                                        <td valign="top" align="center">
                                            <div class="animated-radio-button">
                                                <label>
                                                    <input type="radio" name="nilai[]<?=$key['id_nilai'];?>" value="1" <?=$key['nilai']==1? "checked":"";?> ><span class="label-text"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td valign="top" align="center">
                                            <div class="animated-radio-button">
                                                <label>
                                                    <input type="radio" name="nilai[]<?=$key['id_nilai'];?>" value="2" <?=$key['nilai']==2? "checked":"";?> ><span class="label-text"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td valign="top" align="center">
                                            <div class="animated-radio-button">
                                                <label>
                                                    <input type="radio" name="nilai[]<?=$key['id_nilai'];?>" value="3" <?=$key['nilai']==3? "checked":"";?> ><span class="label-text"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td valign="top" align="center">
                                            <div class="animated-radio-button">
                                                <label>
                                                    <input type="radio" name="nilai[]<?=$key['id_nilai'];?>" value="4" <?=$key['nilai']==4? "checked":"";?> ><span class="label-text"></span>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                <?php 
                                $nexttype = $key['aspek'];
                                $n++;
                                } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="7" class="text-center" >Data Tidak Ditemukan</td>
                                </tr>
                            <?php } ?>
							</tbody>
						</table>
						<hr align="right" color="black">
						<div class="modal-footer">
                            <a class="btn btn-secondary" href="<?= Base_url();?>Home/edit_nilai_sat"><i class="fa fa-arrow-left"></i>Kembali</a>
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
<?php
if(empty($_SESSION['status_login'])){
    redirect();
}
else{
?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <?php $this->load->view('template/head') ?>

    </head>
    <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="<?php echo base_url() ?>index.php/welcome/in_admin">PTPN VIII</a>
        
        <?php $this->load->view('template/header') ?>
    
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>

        <?php $this->load->view('template/menu_admin') ?>

    <main class="app-content">
        <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i> SDM 08</h1>
            <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Tabel SDM</li>
            <li class="breadcrumb-item active"><a href="<?php echo base_url() ?>index.php/admin/tabel_sdm/sdm08"> SDM 08</a></li>
        </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">

                <?php $attributes = array('id_sdm08' => 'regForm'); 
                echo form_open('admin/input_sdm/sdm08',$attributes);?>

                    <h3 class="tile-title">Form Input SDM 08</h3>
                    <p><?php echo $status_insert ?></p>
                    <div class="tile-body">
                        <form>
                            <div class="form-group">
                                <label class="control-label">NPP</label>
                                <input class="form-control" type="text" name="npp" placeholder="NPP">
                            </div>
                            <div class="form-group">
                                <label class="control-label">No Urut</label>
                                <input class="form-control" type="text" name="no_urut" placeholder="Masukan No Urut Anda">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Kode Mutasi</label>
                                <input class="form-control" type="text" name="kd_mutasi" placeholder="Masukan Kode Mutasi">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Kode Unit</label>
                                <input class="form-control" type="text" name="kd_unit" placeholder="Masukan Kode Unit">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Kode Adf</label>
                                <input class="form-control" type="text" name="kd_adf" placeholder="Masukan Kode Adf">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Kode Budidaya</label>
                                <input class="form-control" type="text" name="kd_bud" placeholder="Masukan Kode Budidaya">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Jabatan</label>
                                <input class="form-control" type="text" name="jabatan" placeholder="Masukan Jabatan ">
                            </div>
                            <div class="form-group">
                                <label class="control-label">TMT</label>
                                <input class="form-control" type="text" name="tmt" placeholder="Masukan TMT">
                            </div>
                            <div class="form-group">
                                <label class="control-label">No SK</label>
                                <input class="form-control" type="text" name="no_sk" placeholder="Masukan No SK">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Tanggal SK</label>
                                <input class="form-control" type="text" name="tgl_sk" placeholder="Masukan Tanggal">
                            </div>
                            <div class="form-group">
                                <label class="control-label">NPP Jabatan</label>
                                <input class="form-control" type="text" name="npp_jbt" placeholder="Masukan NPP Jabatan ">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Tanggal </label>
                                <input class="form-control" type="text" name="tgl" placeholder="Tanggal">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Bulan Proses</label>
                                <input class="form-control" type="text" name="bln_proses" placeholder="Masukan Bulan Proses">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Stat REC</label>
                                <input class="form-control" type="text" name="stat_rec" placeholder="Masukan Stat REC">
                            </div>
                        </form>
                        <div class="tile-footer">
                        <button class="btn btn-primary" name="submit" type="submit">
                        <i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>&nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="<?php echo base_url() ?>index.php/admin/kembali/out_sdm08"><i class="fa fa-fw fa-lg fa-times-circle"></i>Kembali</a>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    <footer>
        <! -- footer area start-->
            <?php $this->load->view('template/footer') ?>
        <! -- footer area end-->
    </footer>
    </main>
        
        <!-- Main Menu area start-->
            <?php $this->load->view('template/script') ?>
        <!-- Main Menu area End-->

    </body>
</html>
<?php } ?>
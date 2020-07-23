<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    $data['tittle'] = "Hak Akses";
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
                <h1><i class="fa fa-user"></i> Hak Akses</h1>
                <p>MENGATASI MASALAH TANPA MASALAH!!!</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#"> Hak Akses</a></li>
            </ul>
        </div>
        <?= $this->session->flashdata('msg') ?>
        <?= $this->session->flashdata('gagal') ?>
        <!-- Swetalert Berhasil -->
        <div class="status-ok" data-statusok="<?= $this->session->flashdata('statusok'); ?>"></div>
        <div class="status-insert" data-statusinsert="<?= $this->session->flashdata('statusinsert'); ?>"></div>
        <div class="status-gagal" data-statusgagal="<?= $this->session->flashdata('statusgagal'); ?>"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="card-body">
                        <div class="tile-title-w-btn">
                            <h3 class="title">Hak Akses Karyawan dan Satpam</h3>
                            <div class="btn-group">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i>Tambah</button>
                            </div>
                        </div>
                        <hr align="right" color="black">
                        <table class="table table-hover table-bordered table-sm" id="sampleTable">
                            <thead>
                                <tr bgcolor="#F5F5F5">
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama Pegawai</th>
                                    <th>Unit Kerja</th>
                                    <th>KTP</th>
                                    <th>Status</th>
                                    <th>Tanggal Login</th>
                                    <th>Status Pengguna</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  
                                $i=1;
                                foreach ($hak_akses as $hak ) { ?>
                                <tr>
                                    <td><?= $i++;?></td>
                                    <td><?= $hak['nik'] ?></td>
                                    <td><?= $hak['nama_pegawai'] ?></td>
                                    <td><?= $hak['unit_kerja'] ?></td>
                                    <td><?= $hak['no_ktp'] ?></td>
                                    <td><?php
                                        if ($hak['status'] == 1) {
                                            echo "<font color='green'>Online</font>";
                                        } else {
                                            echo "<font color='red'>Offline</font>";
                                        }
                                        ?>
                                    </td>
                                    <td><?= date('H:i:s -- m/d/Y', strtotime($hak['tgl'])) ?></td>
                                    <td><?php
                                        if ($hak['valid'] == 1) {
                                            echo "<font color='green'>Aktif</font>";
                                        } else {
                                            echo "<font color='red'>Nonaktif</font>";
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center" >
                                        
                                        <a href="#edit<?= $hak['user_id'] ?>" data-toggle="modal"><button class="btn btn-info" type="button"><i class="fa fa-pencil"></i>Ubah</button></a>&nbsp;&nbsp;&nbsp;
                                        <a href="#delete<?= $hak['user_id'] ?>" data-toggle="modal">
                                        <?php 
                                        if ($hak['valid'] == 1) { ?>
                                        <button class="btn btn-danger" type="button"><i class="fa fa-key"></i>Nonaktifkan</button>
                                        <?php } else { ?>
                                        <button class="btn btn-warning" type="button"><i class="fa fa-key"></i>Aktifkan</button>
                                        <?php } ?>
                                        </a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tambah -->
        <div class="modal fade" id="tambah" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Pegawai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?= form_open_multipart('Home/input_akses'); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-form-label col-form-label-sm">Nama Pengguna</label>
                            <input type="text" class="form-control form-control-sm" name="username" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label col-form-label-sm">Kata Sandi</label>
                            <input type="password" class="form-control form-control-sm" name="password" value="123456" placeholder="123456" readonly>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label col-form-label-sm">Nama Pegawai</label>
                            <input type="text" class="form-control form-control-sm" name="nama_pegawai" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label col-form-label-sm">Nik</label>
                            <input type="text" class="form-control form-control-sm" name="nik" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label col-form-label-sm">Unit Kerja</label>
                            <input type="text" class="form-control form-control-sm" name="unit_kerja" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label col-form-label-sm">No KTP</label>
                            <input type="text" class="form-control form-control-sm" name="no_ktp" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label col-form-label-sm">Jabatan</label>
                            <input type="text" class="form-control form-control-sm" name="jabatan">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label col-form-label-sm">No HP</label>
                            <input type="text" class="form-control form-control-sm" name="no_hp">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label col-form-label-sm">Wewenang Akses</label>
                            <select class="form-control form-control-sm" name="role" required>
                                <option value="">--PILIH--</option>
                                <option value="1">Admin</option>
                                <option value="2">Karyawan</option>
                                <option value="3">Satpam</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label col-form-label-sm">Jenis Karyawan</label>
                            <select class="form-control form-control-sm" name="jns_kar" required>
                                <option value="">--PILIH--</option>
                                <option value="1">Karyawan</option>
                                <option value="2">Satpam</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label col-form-label-sm">Jenis Kelamin</label>
                            <select class="form-control form-control-sm" name="genre" required>
                                <option value="">--PILIH--</option>
                                <option value="1">Laki-Laki</option>
                                <option value="2">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label col-form-label-sm">Image</label>
                            <input type="file" class="form-control form-control-sm" name="image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>

        <!-- Edit -->
        <?php foreach ($hak_akses as $u) { ?>
        <div class="modal fade" id="edit<?= $u['user_id'] ?>" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ubah Data Pegawai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?= form_open_multipart('Home/edit_akses'); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-form-label col-form-label-sm">Nama Pegawai</label>
                            <input type="text" class="form-control form-control-sm" name="nama_pegawai" value="<?= $u['nama_pegawai'] ?>">
                            <input type="hidden" name="user_id" value="<?= $u['user_id'] ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label col-form-label-sm">NIK</label>
                            <input type="text" class="form-control form-control-sm" name="nik" value="<?= $u['nik'] ?>" Readonly>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label col-form-label-sm">Unit Kerja</label>
                            <input type="text" class="form-control form-control-sm" name="unit_kerja" value="<?= $u['unit_kerja'] ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label col-form-label-sm">No KTP</label>
                            <input type="text" class="form-control form-control-sm" name="no_ktp" value="<?= $u['no_ktp'] ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label col-form-label-sm">Nama Pengguna</label>
                            <input type="text" class="form-control form-control-sm" name="username" value="<?= $u['username'] ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label col-form-label-sm">Kata Sandi</label>
                            <input type="password" class="form-control form-control-sm" name="password" id="txtPassword">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label col-form-label-sm">Ulangi Kata Sandi</label>
                            <input type="password" class="form-control form-control-sm" name="kpassword" id="txtConfirmPassword">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label col-form-label-sm">Image</label>
                            <input type="file" class="form-control form-control-sm" name="image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button class="btn btn-primary" name="edit" id="btnSubmit" type="submit"><i class="fa fa-fw fa-lg fa-floppy-o"></i>Simpan</button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
        <?php } ?>

        <!-- Akses -->
        <?php foreach ($hak_akses as $u) { ?>
        <div class="modal fade" id="delete<?= $u['user_id'] ?>" role="dialog">
            <div class="modal-dialog modals-default nk-red">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-title"></div>
                    <div class="modal-body">
                        <?php if ($u['valid'] == 1) { ?>
                            <font color="red">
                                Apakah Anda Yakin Akan Menonaktifkan Karyawan <?= $u['nama_pegawai'] ?> ?
                            <?php } else { ?>
                            <font color="blue">
                                Apakah Anda Yakin Akan Mengaktifkan Karyawan <?= $u['nama_pegawai'] ?> ?
                                <?php } ?>
                            </font>
                            <?= form_open('Home/non_aktif_hak_akses') ?>
                            <input type="hidden" value="<?= $u['user_id'] ?>" name="user_id">
                            <input type="hidden" value="<?= $u['valid'] ?>" name="valid">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button class="btn btn-primary" type="submit" name="submit">Setuju</button>
                        <?= form_close(); ?>
                    </div>
                </div> <!-- / .modal-content -->
            </div>
        </div><!-- / .modal-dialog -->
        <?php } ?>

        <footer>
            <!-- footer area start-->
            <?php $this->load->view('template/footer') ?>
            <!-- footer area end-->
        </footer>

    </main>


    <?php $this->load->view('template/script') ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $(function() {
                $("#btnSubmit").click(function() {
                    var password = $("#txtPassword").val();
                    var confirmPassword = $("#txtConfirmPassword").val();
                    if (password != confirmPassword) {
                        swal("Kata Sandi Tidak Cocok", "Coba samakan Kata Sandi dan Ulang Kata Sandi", "error", {
                            button: "OK!",
                        });
                        return false;
                    }
                    return true;
                });
            });
        });

        const statusok = $('.status-ok').data('statusok');
        // console.log(statusok);
        if (statusok) {
            swal({
                title: "Berhasil " + statusok,
                text: "Data Berhasil Di Simpan",
                type: "success",
                timer: 7000,
                showConfirmButton: false
            });
        }

        const statusinsert = $('.status-insert').data('statusinsert');
        // console.log(statusinsert);
        if (statusinsert) {
            swal({
                title: "Berhasil " + statusinsert,
                text: "Data Berhasil Di Input",
                type: "success",
                timer: 7000,
                showConfirmButton: false
            });
        }

        const statusgagal = $('.status-gagal').data('statusgagal');
        // console.log(statusgagal);
        if (statusgagal) {
            swal({
                title: "Gagal " + statusgagal,
                text: "EDIT KEMBALI DATA ANDA DENGAN BENAR",
                type: "error",
                timer: 7000,
                showConfirmButton: false
            });
        }
    </script>

</body>

</html>
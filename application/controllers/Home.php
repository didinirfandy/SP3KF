<?php
defined('BASEPATH') or exit('No direct script access allowed');

class home extends CI_Controller
{
	function __construct()
	{
        parent::__construct();
        $this->load->model('Model_user');
        $this->load->model('Model_admin');
        $this->load->model('Model_login');
        $this->load->helper(array('form', 'url'));

        if (empty($_SESSION['username'])) 
        {
            redirect('Welcome/index');
        }
    }
    
	public function home_user()
	{
        $data['nilai']      = $this->Model_user->nil_kar();
        $data['rangking']   = $this->Model_user->rangking();
		$this->load->view('Apps/home_user',$data);
    }
    
    public function home_admin()
	{
        $data['jmlh_kar']   = $this->Model_admin->jmlh_kar();
        $data['jmlh_sat']   = $this->Model_admin->jmlh_sat();
        $data['hak_akses']  = $this->Model_admin->hak_akses();
        $data['fahmi']      = $this->Model_admin->nilai_grafik_fahmi();
        $data['dede']       = $this->Model_admin->nilai_grafik_dede();
        $data['galuh']      = $this->Model_admin->nilai_grafik_galuh();
        $data['ditta']      = $this->Model_admin->nilai_grafik_ditta();
        $data['herdi']      = $this->Model_admin->nilai_grafik_herdi();
		$this->load->view('Apps/home_admin',$data);
    }

    public function dt_nilai_kar()
    {
        $this->load->view('Apps/dt_nilai_kar');
    }
    
    public function dt_nilai_sat()
    {
        $this->load->view('Apps/dt_nilai_sat');
    }

    public function evaluasi_kar()
    {
        $nik    =   $this->session->userdata('nik');
        $data['evaluasi_kar'] = $this->Model_user->evaluasi_kar($nik);
        $this->load->view('Apps/evaluasi_kar',$data);
    }

    public function evaluasi_sat()
    {
        $nik    =   $this->session->userdata('nik');
        $data['evaluasi_sat'] = $this->Model_user->evaluasi_sat($nik);
        $this->load->view('Apps/evaluasi_sat',$data);
    }

    public function laporan_kar()
    {
        $this->load->view('Apps/laporan_kar');
    }

    public function laporan_sat()
    {
        $this->load->view('Apps/laporan_sat');
    }

    public function nilai_kar()
    {
        $this->load->view('Apps/nilai_kar');
    }

    public function nilai_sat()
    {
        $this->load->view('Apps/nilai_sat');
    }

    public function edit_nilai_kar()
    {
        $data['karyawan']   =   $this->Model_admin->karyawan();
        $this->load->view('Apps/edit_nilai_kar',$data);
    }

    public function edit_nilai_sat()
    {
        $data['satpam']   =   $this->Model_admin->satpam();
        $this->load->view('Apps/edit_nilai_sat',$data);
    }

    public function in_nilai_kar()
    {
        $data['karyawan']   =   $this->Model_user->karyawan();
        $this->load->view('Apps/in_nilai_kar',$data);
    }

    public function in_nilai_sat()
    {
        $data['satpam']   =   $this->Model_user->satpam();
        $this->load->view('Apps/in_nilai_sat',$data);
    }

    public function grafik_kar()
    {
        $nik    =     $this->uri->segment(3);
        $bln    =     $this->uri->segment(4);
        $data['nilai_fix_kar']  =   $this->Model_user->nilai_grafik_kar($nik,$bln);
        $this->load->view('Apps/nilai_grafik_kar',$data);
    }

    public function grafik_sat()
    {
        $nik    =     $this->uri->segment(3);
        $data['nilai_fix_sat']  =   $this->Model_user->nilai_grafik_sat($nik);
        $this->load->view('Apps/nilai_grafik_sat',$data);
    }

    public function input_nilai()
    {
        $nik                  = $this->uri->segment(3);
        $genre                = $this->uri->segment(4);
        $jns_kar              = $this->uri->segment(5);
        if ($jns_kar == 1) 
        {
            $data['dinilai']        = $this->Model_user->karyawan_dinilai($nik);
            $data['faktor_nilai']   = $this->Model_user->faktor_nilai($genre,$jns_kar);
            $this->load->view('Apps/input_nilai',$data);
        } 
        elseif ($jns_kar == 2) 
        {
            $data['dinilai']        = $this->Model_user->satpam_dinilai($nik);
            $data['faktor_nilai']   = $this->Model_user->faktor_nilai($genre,$jns_kar);
            $this->load->view('Apps/input_nilai',$data);
        }
    }

    public function entry_nilai()
    {
        if(!isset($_POST['nilai'])){
            $role = $this->session->userdata('role');
            if ($role == 2) 
            {
                $this->session->set_flashdata('statusgagal', 'Disimpan!!!');
                redirect('Home/in_nilai_kar');
            } 
            elseif ($role == 3) 
            {
                $this->session->set_flashdata('statusgagal', 'Disimpan!!!');
                redirect('Home/in_nilai_sat');
            }
        }
        $nik            =   $_POST['nik'];
        $id_faktor      =   $_POST['id_faktor'];
        $aspek          =   $_POST['aspek'];
        $target         =   $_POST['target'];
        $nilai          =   $_POST['nilai'];
        $nm_sing        =   $_POST['nm_sing'];
        $jnis_kar       =   $_POST['jnis_kar'];
        $genre          =   $_POST['genre'];
        $catatan        =   $_POST['catatan'];
        $sesi_periksa   =   $_POST['sesi_periksa'];
        $entry_date     =   $_POST['entry_date'];
        $entry_userid   =   $_POST['entry_userid'];

        $data = array();
        $totitem = $_POST['id_faktor'];

        for($i = 0; $i<count($totitem); $i++)
        {
            date_default_timezone_set('Asia/Jakarta');
            $date   =   date('Y-m-d H:i:s');
            array_push($data, array(
                'nik'           =>   $nik[$i],
                'id_faktor'     =>   $id_faktor[$i],
                'aspek'         =>   $aspek[$i],
                'target'        =>   $target[$i],
                'nilai'         =>   $nilai[$i],
                'nm_sing'       =>   $nm_sing[$i],
                'jnis_kar'      =>   $jnis_kar[$i],
                'genre'         =>   $genre[$i],
                'catatan'       =>   $catatan,
                'sesi_periksa'  =>   $sesi_periksa,
                'entry_date'    =>   $entry_date,
                'entry_userid'  =>   $entry_userid[$i],
            ));
        }
        $sql = $this->Model_user->entry_nilai_kar($data);

        if ($sql == 1) 
        {
			$this->session->set_flashdata('status_insert', '<div class="alert alert-success" role="alert"><button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
            <span class="icon-sc-cl" aria-hidden="true">x</span></button>Data Berhasil di Simpan</div>');
            $role = $this->session->userdata('role');
            if ($role == 2) 
            {
                redirect('Home/in_nilai_kar');
            } 
            elseif ($role == 3) 
            {
                redirect('Home/in_nilai_sat');
            }
		} else {
			$this->session->set_flashdata('status_insert', '<div class="alert alert-danger" role="alert"><button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
			<span class="icon-sc-cl" aria-hidden="true">x</span></button>Data Berhasil Gagal di Simpan!!!</div>');
            $role = $this->session->userdata('role');
            if ($role == 2) 
            {
                redirect('Home/in_nilai_kar');
            } 
            elseif ($role == 3) 
            {
                redirect('Home/in_nilai_sat');
            }
		}
    }

    public function cari_bulan_laporan_kar()
    {
        if (isset($_POST['bulan'])) 
        {
            $periode               = $this->input->post('bln');
            $data['nilai_kar_fix'] = $this->Model_admin->nilai_akhir_kar($periode);
            $this->load->view('Apps/laporan_kar',$data);
        } elseif (empty($_POST['bulan'])) {
            $this->load->view('Apps/laporan_kar');
        }
    }

    public function cari_bulan_laporan_sat()
    {
        if (isset($_POST['bulan'])) 
        {
            $periode               = $this->input->post('bln');
            $data['nilai_sat_fix'] = $this->Model_admin->nilai_akhir_sat($periode);
            $this->load->view('Apps/laporan_sat',$data);
        } elseif (empty($_POST['bulan'])) {
            $this->load->view('Apps/laporan_sat');
        }
    }

    public function kelola_user()
    {
        $data['hak_akses']  =  $this->Model_admin->hak_akses();
        $this->load->view('Apps/hak_akses',$data);
    }

    public function input_akses()
    {
        $username       = $this->input->post('username');
        $password       = md5($this->input->post('password'));
        $nama_pegawai   = $this->input->post('nama_pegawai');
        $nik            = $this->input->post('nik');
        $unit_kerja     = $this->input->post('unit_kerja');
        $no_ktp         = $this->input->post('no_ktp');
        $role           = $this->input->post('role');
        $jns_kar        = $this->input->post('jns_kar');
        $genre          = $this->input->post('genre');
        $jabatan        = $this->input->post('jabatan');
        $no_hp          = $this->input->post('no_hp');

        if ($_FILES['image'] != "") 
        {
            $config['upload_path']    = "./assets_application/assets/faces/";
            $config['allowed_types']  = 'png|jpg|jpeg';
            $config['overwrite']      = true;
            $config['max_size']       = 16048;
            $config['file_name']      = $username;
            $this->load->library('upload', $config);

            if (isset($_FILES['image'])) 
            {
                if (!$this->upload->do_upload('image')) 
                {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('msg', '<div class="alert alert-warning" role="alert">
                    <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                        <span class="icon-sc-cl" aria-hidden="true">x</span>
                    </button>' . $error . '</div>');
                } else {
                    $image = $config['file_name'] . $this->upload->data('file_ext');
                    $berhasil = $this->Model_admin->input_data_pegawai_img($username, $password, $nama_pegawai, $nik, $unit_kerja, $no_ktp, $role, $jns_kar, $genre, $jabatan, $no_hp, $image);

                    if ($berhasil == 1) {
                        $this->session->set_flashdata('statusok', 'Disimpan!!!');
                        redirect(base_url() . "Home/kelola_user");
                    } else {
                        $this->session->set_flashdata('statusgagal', 'Disimpan!!!');
                        redirect(base_url() . "Home/kelola_user");
                    }
                }
                $this->output->delete_cache();
            }
        } 
        else 
        {
            $berhasil = $this->Model_admin->input_data_pegawai($username, $password, $nama_pegawai, $nik, $unit_kerja, $no_ktp, $role, $jns_kar, $genre, $jabatan, $no_hp);

            if ($berhasil == 1) {
                $this->session->set_flashdata('statusok', 'Disimpan!!!');
                redirect(base_url() . "Home/kelola_user");
            } else {
                $this->session->set_flashdata('statusgagal', 'Disimpan!!!');
                redirect(base_url() . "Home/kelola_user");
            }
        }
        redirect(base_url() . "Home/kelola_user");
    }

    public function edit_akses()
    {
        $user_id	    =	$this->input->post('user_id');
		$username       =   $this->input->post('username');
		$nama_pegawai   =   $this->input->post('nama_pegawai');
		$nik		    =	$this->input->post('nik');
		$unit_kerja	    =	$this->input->post('unit_kerja');
        $no_ktp		    =	$this->input->post('no_ktp');
        $password	    =	$this->input->post('password');
        $kpassword 	    = 	$this->input->post('kpassword');
        
        if ($_POST['password'] != "" AND $_POST['kpassword'] != "") 
        {
			
            if ($password == $kpassword) 
            {
                $md5 		= 	md5($password);
				$berhasil = $this->Model_admin->edit_login_pss($user_id, $username, $md5, $nama_pegawai, $nik, $unit_kerja, $no_ktp);

				if ($berhasil == 1) {
                    $this->session->set_flashdata('statusinsert', 'Di edit!!!');
				} else {
                    $this->session->set_flashdata('statusgagal', 'Di edit!!!');
				}
			} else {
                $this->session->set_flashdata('statuspass', 'Input Data!!!');
			}
        } 
        elseif (isset($_FILES['image'])) 
        {
            $config['upload_path']   = './assets_application/assets/faces/';
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['overwrite']	 = true;
            $config['max_size']  	 = 16048;
            $config['file_name'] 	 = $username;
            $this->load->library('upload', $config);

            if (isset($_FILES['image'])) 
            {
                if (!$this->upload->do_upload('image')) 
                {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('msg', '<div class="alert alert-warning" role="alert">
                    <button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                        <span class="icon-sc-cl" aria-hidden="true">x</span>
                    </button>' . $error . '</div>');
                } else {
                    $image = $config['file_name'] . $this->upload->data('file_ext');
                    $berhasil = $this->Model_admin->edit_login_img($user_id, $username, $nama_pegawai, $nik, $unit_kerja, $no_ktp, $image);
                    
                    if ($berhasil == 1) {   
                        $this->session->set_flashdata('statusinsert', 'Di edit!!!');
                    } else {
                        $this->session->set_flashdata('statusgagal', 'Di edit!!!');
                    }
                }
                $this->output->delete_cache();
            }
        } else {
            $berhasil = $this->Model_admin->edit_login_dt($user_id, $username, $nama_pegawai, $nik, $unit_kerja, $no_ktp);
            if ($berhasil == 1) {   
                $this->session->set_flashdata('statusinsert', 'Di edit!!!');
                redirect(base_url('Home/kelola_user'));
            } else {
                $this->session->set_flashdata('statusgagal', 'Di edit!!!');
                redirect(base_url('Home/kelola_user'));
            }
        }
		// $this->session->set_flashdata('statusgagal', 'Gagal loh ini cuk!!!');
		redirect(base_url('Home/kelola_user'));
    }

    public function non_aktif_hak_akses()
	{
		$user_id              =  $this->input->post('user_id');
		$valid 	              =	 $this->input->post('valid');
		$hak_akses_non_aktif  =	 $this->Model_admin->non_aktif_hak_akses($user_id, $valid);
        redirect(base_url('Home/kelola_user'));
    }

    public function cari_nilai_kar()
    {
        if (isset($_POST['cari_nilai_kar'])) 
        {
            $nik                =  $this->input->post('nik');
            $tgl                =  $this->input->post('tgl');
            $data['nilai_kar']  =  $this->Model_admin->nilai_kar($nik,$tgl);
            $data['karyawan']   =  $this->Model_admin->karyawan();
            $this->load->view('Apps/edit_nilai_kar', $data);
        } 
        elseif (empty($_POST['cari_nilai_kar'])) 
        {
            $this->load->view('Apps/edit_nilai_kar');
        }
    }

    public function cari_nilai_sat()
    {
        if (isset($_POST['cari_nilai_sat'])) 
        {
            $nik                =  $this->input->post('nik');
            $tgl                =  $this->input->post('tgl');
            $data['nilai_sat']  =  $this->Model_admin->nilai_sat($nik,$tgl);
            $data['satpam']     =  $this->Model_admin->satpam();
            $this->load->view('Apps/edit_nilai_sat', $data);
        } 
        elseif (empty($_POST['cari_nilai_sat'])) 
        {
            $this->load->view('Apps/edit_nilai_sat');
        }
    }

    public function cari_bulan_kar()
    {
        if (isset($_POST['cari_bulan_kar'])) 
        {
            $tgl                  =  $this->input->post('tgl');
            $data['nilai_kar']    =  $this->Model_admin->nilai_bln_kar($tgl);
            $data['karyawan']     =  $this->Model_admin->karyawan();
            $data['aspek_kar']    =  $this->Model_admin->aspek_kar();
            $data['faktor_kar']   =  $this->Model_admin->data_faktor_kar();
            $data['bobot']        =  $this->Model_admin->bobot();
            $this->load->view('Apps/dt_nilai_kar', $data);
        } 
        elseif (empty($_POST['cari_bulan_kar'])) 
        {
            $this->load->view('Apps/dt_nilai_kar');
        }
    }

    public function cari_bulan_sat()
    {
        if (isset($_POST['cari_bulan_sat'])) 
        {
            $tgl                  =  $this->input->post('tgl');
            $data['nilai_sat']    =  $this->Model_admin->nilai_bln_sat($tgl);
            $data['satpam']       =  $this->Model_admin->satpam();
            $data['aspek_sat']    =  $this->Model_admin->aspek_sat();
            $data['faktor_sat']   =  $this->Model_admin->data_faktor_sat();
            $data['bobot']        =  $this->Model_admin->bobot();
            $this->load->view('Apps/dt_nilai_sat', $data);
        } 
        elseif (empty($_POST['cari_bulan_sat'])) 
        {
            $this->load->view('Apps/dt_nilai_sat');
        }
    }

    public function entry_nilai_kar_fix()
    {
        $nama_karyawan      =   $this->input->post('nama_karyawan');
        $nik                =   $this->input->post('nik');
        $genre              =   $this->input->post('genre');
        $jenis_kar          =   $this->input->post('jenis_kar');
        $nilai_akhir        =   $this->input->post('nilai_akhir');
        $evaluasi           =   $this->input->post('evaluasi');
        $periode            =   $this->input->post('periode');
        $pakaian            =   $this->input->post('pakaian');
        $perilaku           =   $this->input->post('perilaku');
        $telepon            =   $this->input->post('telepon');
        // $status             =   $this->input->post('status');

        $data = array();
        $totaldata = $nik;
        // print_r($nilai_akhir);die;

        for ($i=0; $i < count($totaldata) ; $i++) 
        { 
            date_default_timezone_set('Asia/Jakarta');
            $date   =   date('Y-m-d H:i:s');
            array_push($data, array(
                'nama_karyawan' =>  $nama_karyawan[$i],
                'nik'           =>  $nik[$i],
                'genre'         =>  $genre[$i],
                'jenis_kar'     =>  $jenis_kar[$i],
                'nilai_akhir'   =>  $nilai_akhir[$i],
                'evaluasi'      =>  $evaluasi[$i],
                'periode'       =>  $periode[$i],
                'pakaian'       =>  $pakaian[$i],
                'perilaku'      =>  $perilaku[$i],
                'telepon'       =>  $telepon[$i],
                'entry_date'    =>  $date,  
                'status'        =>  "1", 
            ));
        }
        // print_r($data);die;

        $query = $this->Model_admin->entry_nilai_kar_fix($data);

        if ($query == 1) 
        {
			$this->session->set_flashdata('status_insert', '<div class="alert alert-success" role="alert"><button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
            <span class="icon-sc-cl" aria-hidden="true">x</span></button>Data Berhasil di Simpan</div>');
            redirect('Home/dt_nilai_kar');
		} else {
			$this->session->set_flashdata('status_insert', '<div class="alert alert-danger" role="alert"><button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
			<span class="icon-sc-cl" aria-hidden="true">x</span></button>Data Berhasil Gagal di Simpan!!!</div>');
            redirect('Home/dt_nilai_kar');
		}
    }

    public function entry_nilai_sat_fix()
    {
        $nama_satpam        =   $this->input->post('nama_satpam');
        $nik                =   $this->input->post('nik');
        $genre              =   $this->input->post('genre');
        $jenis_kar          =   $this->input->post('jenis_kar');
        $nilai_akhir        =   $this->input->post('nilai_akhir');
        $evaluasi           =   $this->input->post('evaluasi');
        $periode            =   $this->input->post('periode');
        $periode            =   $this->input->post('periode');
        $pakaian            =   $this->input->post('pakaian');

        $data = array();
        $totaldata = $this->input->post('nik');

        for ($i=0; $i < count($totaldata) ; $i++) 
        { 
            date_default_timezone_set('Asia/Jakarta');
            $date   =   date('Y-m-d H:i:s');
            array_push($data, array(
                'nama_satpam'   =>  $nama_satpam[$i],
                'nik'           =>  $nik[$i],
                'genre'         =>  $genre[$i],
                'jenis_kar'     =>  $jenis_kar[$i],
                'nilai_akhir'   =>  $nilai_akhir[$i],
                'evaluasi'      =>  $evaluasi[$i],
                'periode'       =>  $periode[$i],
                'pakaian'       =>  $pakaian[$i],
                'entry_date'    =>  $date,
            ));
        }

        $query = $this->Model_admin->entry_nilai_sat_fix($data);

        if ($query == 1) 
        {
			$this->session->set_flashdata('status_insert', '<div class="alert alert-success" role="alert"><button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
            <span class="icon-sc-cl" aria-hidden="true">x</span></button>Data Berhasil di Simpan</div>');
            redirect('Home/dt_nilai_sat');
		} else {
			$this->session->set_flashdata('status_insert', '<div class="alert alert-danger" role="alert"><button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
			<span class="icon-sc-cl" aria-hidden="true">x</span></button>Data Berhasil Gagal di Simpan!!!</div>');
            redirect('Home/dt_nilai_sat');
        }
    }
    
    public function data_nilai_kar()
    {
        if (isset($_POST['cari_data_nilai'])) {
            $nik               = $this->input->post('nik');
            $entry_date        = $this->input->post('entry_date');
            $data['nli_kar']   = $this->Model_admin->data_nilai($nik,$entry_date);
            $this->load->view('Apps/in_edit_kar',$data);
        } elseif (empty($_POST['cari_data_nilai'])) {
            $this->load->view('Apps/in_edit_kar');
        }
    }

    public function data_nilai_sat()
    {
        if (isset($_POST['cari_data_nilai'])) 
        {
            $nik               = $this->input->post('nik');
            $entry_date        = $this->input->post('entry_date');
            $data['nli_sat']   = $this->Model_admin->data_nilai($nik,$entry_date);
            $this->load->view('Apps/in_edit_sat',$data);
        } 
        elseif (empty($_POST['cari_data_nilai'])) 
        {
            $this->load->view('Apps/in_edit_sat');
        }
    }

    public function action_edit_nilai_kar()
    {
        $nik = $this->uri->segment(2);
        $this->load->view('Apps/in_edit_kar');
    }

    public function action_edit_nilai_sat()
    {
        $nik = $this->uri->segment(2);
        $this->load->view('Apps/in_edit_sat');
    }

    public function in_edit_kar()
    {
        $id_nilai   = $_POST['id_nilai'];
        $id_faktor  = $_POST['id_faktor'];
        $nilai      = $_POST['nilai'];

        $data = array();
        $totitem = $id_faktor;

        for($i = 0; $i<count($totitem); $i++)
        {
            date_default_timezone_set('Asia/Jakarta');
            $date   =   date('Y-m-d H:i:s');
            array_push($data, array(
                'id_nilai' =>   $id_nilai[$i],
                'nilai'    =>   $nilai[$i],
            ));
        }
        $sql = $this->db->update_batch('tbl_nilai', $data, 'id_nilai' );

        if ($sql) 
        {
			$this->session->set_flashdata('status_insert', '<div class="alert alert-success" role="alert"><button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
            <span class="icon-sc-cl" aria-hidden="true">x</span></button>Data Berhasil di Ubah</div>');
            redirect(base_url('Home/edit_nilai_kar'));
		} else {
			$this->session->set_flashdata('status_insert', '<div class="alert alert-danger" role="alert"><button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
			<span class="icon-sc-cl" aria-hidden="true">x</span></button>Gagal di Ubah!!!</div>');
            redirect(base_url('Home/edit_nilai_kar'));
		}

    }

    public function in_edit_sat()
    {
        $id_nilai   = $_POST['id_nilai'];
        $id_faktor  = $_POST['id_faktor'];
        $nilai      = $_POST['nilai'];

        $data = array();
        $totitem = $id_faktor;

        for($i = 0; $i<count($totitem); $i++)
        {
            date_default_timezone_set('Asia/Jakarta');
            $date   =   date('Y-m-d H:i:s');
            array_push($data, array(
                'id_nilai' =>   $id_nilai[$i],
                'nilai'    =>   $nilai[$i],
            ));
        }
        $sql = $this->db->update_batch('tbl_nilai', $data, 'id_nilai' );

        if ($sql) 
        {
			$this->session->set_flashdata('status_insert', '<div class="alert alert-success" role="alert"><button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
            <span class="icon-sc-cl" aria-hidden="true">x</span></button>Data Berhasil di Ubah</div>');
            redirect(base_url('Home/edit_nilai_sat'));
		} else {
			$this->session->set_flashdata('status_insert', '<div class="alert alert-danger" role="alert"><button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
			<span class="icon-sc-cl" aria-hidden="true">x</span></button>Gagal di Ubah!!!</div>');
            redirect(base_url('Home/edit_nilai_sat'));
		}
    }

    public function ntf_update_status_kar()
    {
        $nik = $this->uri->segment(3);
        $bln = $this->uri->segment(4);
        $id = $this->uri->segment(5);
        $update = $this->Model_user->updt_sst_kar($id);
        $data['evaluasi_kar'] = $this->Model_user->evaluasi_kar($nik);
        $this->load->view('Apps/evaluasi_kar',$data);
    }

    public function ntf_update_status_sat()
    {
        $nik = $this->uri->segment(3);
        $bln = $this->uri->segment(4);
        $id = $this->uri->segment(5);
        $update = $this->Model_user->updt_sst_sat($id);
        $data['evaluasi_sat'] = $this->Model_user->evaluasi_sat($nik);
        $this->load->view('Apps/evaluasi_sat',$data);
    }

    public function evaluasi_nilai_kar()
    {
        $nik = $this->session->userdata('nik');
        $tgl = $this->uri->segment(3);
        $data['nilai_kar']    =  $this->Model_admin->eval_nilai_bln_kar($tgl,$nik);
        $data['karyawan']     =  $this->Model_admin->eval_karyawan($nik);
        $data['aspek_kar']    =  $this->Model_admin->aspek_kar();
        $data['faktor_kar']   =  $this->Model_admin->data_faktor_kar();
        $data['bobot']        =  $this->Model_admin->bobot();
        $this->load->view('Apps/evaluasi_nilai_kar',$data);
    }

    public function c_nilai_kar()
    {
        if (isset($_POST['bulan'])) 
        {
            $tgl                 =  $this->input->post('tgl');
            $data['nilai_kar']   =   $this->Model_user->nilai_kar($tgl);
            $this->load->view('Apps/nilai_kar', $data);
        } 
        elseif (empty($_POST['bulan'])) 
        {
            $this->load->view('Apps/nilai_kar');
        }
    }

    public function c_nilai_sat()
    {
        if (isset($_POST['bulan'])) 
        {
            $tgl                 =  $this->input->post('tgl');
            $data['nilai_sat']   =   $this->Model_user->nilai_sat($tgl);
            $this->load->view('Apps/nilai_sat', $data);
        } 
        elseif (empty($_POST['bulan'])) 
        {
            $this->load->view('Apps/nilai_sat');
        }
    }

}

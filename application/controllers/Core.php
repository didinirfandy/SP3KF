<?php
defined('BASEPATH') or exit('No direct script access allowed');

class core extends CI_Controller
{
    function __construct() 
    {
        parent::__construct();
        $this->load->model('Model_login');
    }

    function login()
    {
        if(isset($_POST['submit']))
        {
            $username   =   $this->input->post('username',true);
            $password   =   md5($this->input->post('password',true));
            $hasil      =   $this->Model_login->login($username, $password);

            if($hasil == 1)
            {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
				<span class="icon-sc-cl" aria-hidden="true">x</span></button>Login Berhasil</div>');
                redirect(base_url(). "Home/home_admin");
            }
            elseif($hasil == 2 OR $hasil == 3)
            {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
				<span class="icon-sc-cl" aria-hidden="true">x</span></button>Login Berhasil</div>');
                redirect(base_url(). "Home/home_user");
            } 
            else
            {
                $this->session->set_userdata('notif','<br><br><div class="alert alert-danger" role="alert">USERNAME ATAU PASSWORD ADA YANG SALAH</div>');
                redirect(base_url(). "Login/login");
            }
        }
        else
        {
            $this->session->set_userdata('notif','<br><br><div class="alert alert-danger" role="alert">Gagal Login!!!</div>');
            redirect(base_url(). "Login/login");
        }
    }

    function logout()
    {
        $username   =   $this->session->userdata('status_login');
                        $this->Model_login->logout($username);
                        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><button type="button" class="close sucess-op" data-dismiss="alert" aria-label="Close">
                        <span class="icon-sc-cl" aria-hidden="true">x</span></button> Loguot Berhasil, Terima Kasih </div>');
        redirect(base_url(). "Login/login");
    }
}
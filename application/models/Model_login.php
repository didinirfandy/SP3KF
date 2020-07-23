<?php 

class model_login extends CI_Model {

    function login($username,$password)
    {
        $query = $this->db->get_where('app_user',array('username'=>$username, 'password'=>$password));

        foreach ($query->result_array() as $q)
        {
            $this->session->set_userdata('username', $q['username']);
            $this->session->set_userdata('nama_pegawai', $q['nama_pegawai']);
            $this->session->set_userdata('unit_kerja', $q['unit_kerja']);
            $this->session->set_userdata('ktp', $q['ktp']);
            $this->session->set_userdata('nik', $q['nik']);
            $this->session->set_userdata('role', $q['role']);
            $this->session->set_userdata('jns_kar', $q['jns_kar']);
            $this->session->set_userdata('genre', $q['genre']);
            $this->session->set_userdata('image', $q['image']);
            $valid  =   $q['valid'];
        }

        if($valid == 1)
        {
            $row    =   $query->row_array();
            if ($query->num_rows()>0)
            {
                date_default_timezone_set('Asia/Jakarta');

                $date   =   date("Y/m/d H:i:s");  
                $data   =   array('tgl'=>$date, 'status'=>1);

                $this->db->where(username, $username);
                $this->db->update(app_user,$data);

                return $row['role'];
            }
            else
            {
                return 0;
            }
        } else {
            return 0;
        }
    }

    function logout()
    {
        $username = $this->session->userdata('username');
        $this->db->set(status, 0);
        $this->db->where(username, $username);
        $this->db->update(app_user);
    }
}

?>
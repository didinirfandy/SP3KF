<?php 

class model_admin extends CI_Model
{
    function jmlh_kar()
    {
        return $this->db->query(
            "SELECT COUNT(id_kar) AS id_kar FROM tbl_karyawan"
        )->result_array();
    }

    function jmlh_sat()
    {
        return $this->db->query(
            "SELECT COUNT(id_sat) AS id_sat FROM tbl_satpam"
        )->result_array();
    }

    function nilai_bln_kar($tgl)
    {
        $bulan = date("m",strtotime($tgl)); 
        return $this->db->query(
            "SELECT 
                a.*,
                (
                    SELECT 
                        SUM(nilai) 
                    FROM 
                        tbl_nilai 
                    WHERE 
                        id_faktor = a.id_faktor AND nik = a.nik AND MONTH(entry_date) = '$bulan'
                ) AS nilai_t,
                (
                    SELECT 
                        COUNT(aspek) 
                    FROM 
                        tbl_nilai 
                    WHERE 
                        id_faktor=a.id_faktor AND nik = a.nik AND aspek = a.aspek AND MONTH(entry_date) = '$bulan' 
                ) AS mingguke  
			FROM 
                tbl_nilai a
            WHERE 
                MONTH(a.entry_date) = '$bulan' 
                AND YEAR(a.entry_date) = '$tgl'
                AND a.jnis_kar = '1'
            ORDER BY 
                a.nik"
        )->result_array();
    }

    function nilai_bln_sat($tgl)
    {
        $bulan = date("m",strtotime($tgl)); 
        return $this->db->query(
            "SELECT 
                *
			FROM 
                tbl_nilai
            WHERE 
                MONTH(entry_date) = '$bulan' 
                AND YEAR(entry_date) = '$tgl'
                AND jnis_kar = '2'
            ORDER BY 
                nik"
        )->result_array();
    }

    function eval_nilai_bln_kar($tgl,$nik)
    {
        $bulan = date("m",strtotime($tgl)); 
        return $this->db->query(
            "SELECT 
                a.*,
                (
                    SELECT 
                        SUM(nilai) 
                    FROM 
                        tbl_nilai 
                    WHERE 
                        id_faktor = a.id_faktor AND nik = a.nik AND MONTH(entry_date) = '$bulan'
                ) AS nilai_t,
                (
                    SELECT 
                        COUNT(aspek) 
                    FROM 
                        tbl_nilai 
                    WHERE 
                        id_faktor=a.id_faktor AND nik = a.nik AND aspek = a.aspek AND MONTH(entry_date) = '$bulan' 
                ) AS mingguke  
			FROM 
                tbl_nilai a
            WHERE 
                MONTH(a.entry_date) = '$bulan' 
                AND YEAR(a.entry_date) = '$tgl'
                AND a.jnis_kar = '1'
                AND a.nik = '$nik'
            ORDER BY 
                a.nik"
        )->result_array();
    }

    function eval_nilai_bln_sat($tgl,$nik)
    {
        $bulan = date("m",strtotime($tgl)); 
        return $this->db->query(
            "SELECT 
                *
			FROM 
                tbl_nilai
            WHERE 
                MONTH(entry_date) = '$bulan' 
                AND YEAR(entry_date) = '$tgl'
                AND jnis_kar = '2'
                AND nik = '$nik'
            ORDER BY 
                nik"
        )->result_array();
    }

    function eval_karyawan($nik)
    {
        return $this->db->query(
            "SELECT * FROM tbl_karyawan WHERE nik = '$nik' ORDER BY nik"
        )->result_array();
    }

    function eval_satpam($nik)
    {
        return $this->db->query(
            "SELECT * FROM tbl_satpam WHERE nik = '$nik' ORDER BY nik"
        )->result_array();
    }

    function karyawan()
    {
        return $this->db->query(
            "SELECT * FROM tbl_karyawan ORDER BY nik ASC"
        )->result_array();
    }

    function satpam()
    {
        return $this->db->query(
            "SELECT * FROM tbl_satpam ORDER BY nik ASC"
        )->result_array();
    }

    function bobot()
    {
        return $this->db->query(
            "SELECT * FROM tbl_bobot"
        )->result_array();
    }

    function aspek_kar()
    {
        return $this->db->query(
            "SELECT *,
                (SELECT COUNT(id_faktor) 
                    FROM tbl_faktor 
                    WHERE aspek=id_aspek 
                    AND jenis_kar=1 ) AS jmlh_kolom 
            FROM tbl_aspek"
        )->result_array();
    }

    function aspek_sat()
    {
        return $this->db->query(
            "SELECT *,
                (SELECT COUNT(id_faktor) 
                    FROM tbl_faktor 
                    WHERE aspek=id_aspek 
                    AND jenis_kar=2 ) AS jmlh_kolom 
            FROM tbl_aspek
            WHERE NOT id_aspek=3"
        )->result_array();
    }

    function faktor_kar($aspek)
    {
        return $this->db->query(
            "SELECT * FROM tbl_faktor WHERE aspek='$aspek' AND jenis_kar='1' ORDER BY id_faktor"
        )->result_array();
    }

    function faktor_sat($aspek)
    {
        return $this->db->query(
            "SELECT * FROM tbl_faktor WHERE aspek='$aspek' AND jenis_kar='2' ORDER BY id_faktor"
        )->result_array();
    }

    function data_faktor_kar()
    {
        return  $this->db->query(
            "SELECT a.*,b.nama_aspek,IF(a.jenis='1','C','S') AS nama_jenis
            FROM tbl_faktor a
            LEFT JOIN tbl_aspek b ON a.aspek = b.id_aspek 
            WHERE jenis_kar='1'
            ORDER BY a.aspek,a.id_faktor"
        )->result_array();
    }

    function data_faktor_sat()
    {
        return  $this->db->query(
            "SELECT a.*,b.nama_aspek,IF(a.jenis='1','C','S') AS nama_jenis
            FROM tbl_faktor a
            LEFT JOIN tbl_aspek b ON a.aspek=b.id_aspek 
            WHERE jenis_kar=2
            ORDER BY a.aspek,a.id_faktor"
        )->result_array();
    }

    function hak_akses()
    {
        return $this->db->query(
            "SELECT * FROM app_user"
        )->result_array();
    }

    function ed_hak_akses($user_id)
    {
        return $this->db->query(
            "SELECT * FROM app_user WHERE user_id='$user_id' "
        )->result_array();
    }

    function non_aktif_hak_akses($user_id,$valid)
    {
        if ($valid == 1) {
            $data    =    array(
                'valid'  =>  0,
                'status' =>  0
            );

            $this->db->where('user_id', $user_id);
            $this->db->update('app_user', $data);

            return 1;
        } else {
            $data     =     array(
                'valid'   =>  1,
                'status'  =>  0
            );

            $this->db->where('user_id', $user_id);
            $this->db->update('app_user', $data);

            return 1;
        }
    }

    function entry_nilai_kar_fix($data)
    {
        $insert = $this->db->insert_batch('tbl_nilai_akhir_karyawan', $data);
        if ($insert) {
            return 1;
        } else {
            return 0;
        }
    }

    function entry_nilai_sat_fix($data)
    {
        $insert = $this->db->insert_batch('tbl_nilai_akhir_satpam', $data);
        if ($insert) {
            return 1;
        } else {
            return 0;
        }
    }

    function nilai_akhir_kar($periode)
    {
        $bln = date("m",strtotime($periode));
        return $this->db->query(
            "SELECT a.*, b.unit_kerja, b.ktp
            FROM 
                tbl_nilai_akhir_karyawan a
                LEFT JOIN tbl_karyawan b ON b.nik = a.nik
            WHERE 
                MONTH(a.periode) = '$bln'
            ORDER BY
                a.id_nilai_akhir"
        )->result_array();
    }

    function nilai_akhir_sat($periode)
    {
        $bln = date("m",strtotime($periode));
        return $this->db->query(
            "SELECT a.*, b.unit_kerja, b.no_hp
            FROM 
                tbl_nilai_akhir_satpam a
                LEFT JOIN tbl_satpam b ON b.nik = a.nik
            WHERE 
                MONTH(a.periode) = '$bln'
            ORDER BY
                a.id_nilai_akhir"
        )->result_array();
    }

    function nilai_kar($nik,$tgl)
    {
        $bln  = date("m",strtotime($tgl));
        $data = $this->db->query(
            "SELECT a.*, b.nama_karyawan, c.nama_aspek, d.nama_faktor
            FROM tbl_nilai a
            JOIN tbl_karyawan b ON b.nik = a.nik
            JOIN tbl_aspek c ON c.id_aspek = a.aspek
            JOIN tbl_faktor d ON d.id_faktor = a.id_faktor
            WHERE a.nik = '$nik' AND MONTH(a.entry_date) = '$bln'"
        )->result_array();

        return $data;
    }

    function tmpl_aspek()
    {
        return $this->db->query(
            "SELECT * FROM tbl_aspek ORDER BY id_aspek ASC"
        )->result_array();
    }

    function data_nilai($nik,$entry_date)
    {
        $bln  = date("m",strtotime($entry_date));
        $data = $this->db->query(
            "SELECT 
                a.id_nilai, a.id_faktor, a.nik,a.aspek, a.nilai, a.entry_date,
                b.nama_faktor,
                c.nama_aspek
            FROM
                tbl_nilai a
                LEFT JOIN tbl_faktor b ON b.id_faktor = a.id_faktor
                LEFT JOIN tbl_aspek c ON c.id_aspek = a.aspek
            WHERE
                a.nik = '$nik'
                AND MONTH(a.entry_date) = '$bln'
            ORDER BY
                a.id_nilai ASC LIMIT 150"
        )->result_array();
        return $data;
    }

    function edit_login_pss($user_id, $username, $md5, $nama_pegawai, $nik, $unit_kerja, $no_ktp)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date   =   date("Y-m-d h:i:s");
        $data   =   array(
            'username'      =>  $username,
            'password'      =>  $md5,
            'nama_pegawai'  =>  $nama_pegawai,
            'nik'           =>  $nik,
            'unit_kerja'    =>  $unit_kerja,
            'no_ktp'        =>  $no_ktp,
            'tgl'           =>  $date
        );
        $this->db->where('user_id', $user_id);
        $this->db->update('app_user', $data);

        return 1;
    }

    function edit_login_img($user_id, $username, $nama_pegawai, $nik, $unit_kerja, $no_ktp, $image)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date   =   date("Y-m-d h:i:s");
        $data   =   array(
            'username'      =>  $username,
            'nama_pegawai'  =>  $nama_pegawai,
            'nik'           =>  $nik,
            'unit_kerja'    =>  $unit_kerja,
            'no_ktp'        =>  $no_ktp,
            'tgl'           =>  $date,
            'image'         =>  $image
        );
        $this->db->where('user_id', $user_id);
        $this->db->update('app_user', $data);

        return 1;
    }

    function edit_login_dt($user_id, $username, $nama_pegawai, $nik, $unit_kerja, $no_ktp)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date   =   date("Y-m-d h:i:s");
        $data   =   array(
            'username'      =>  $username,
            'nama_pegawai'  =>  $nama_pegawai,
            'nik'           =>  $nik,
            'unit_kerja'    =>  $unit_kerja,
            'no_ktp'        =>  $no_ktp,
            'tgl'           =>  $date
        );
        $this->db->where('user_id', $user_id);
        $this->db->update('app_user', $data);

        return 1;
    }

    function input_data_pegawai($username, $password, $nama_pegawai, $nik, $unit_kerja, $no_ktp, $role, $jns_kar, $genre, $jabatan, $no_hp)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date   =   date("Y/m/d H:i:s");
        $data   =   array(
            'username'      =>  $username,
            'password'      =>  $password,
            'nama_pegawai'  =>  $nama_pegawai,
            'nik'           =>  $nik,
            'unit_kerja'    =>  $unit_kerja,
            'no_ktp'        =>  $no_ktp,
            'role'          =>  $role,
            'jns_kar'       =>  $jns_kar,
            'genre'         =>  $genre,
            'tgl'           =>  $date,
            'status'        =>  "0",
            'valid'         =>  "0",
            'image'         =>  "default.jpg"
        );

        $insert = $this->db->insert('app_user',$data);

        if ($jns_kar == 1) 
        {
            $data_kar = array(
                'nik'           =>  $nik,
                'nama_karyawan' =>  $nama_pegawai,
                'jabatan'       =>  $jabatan,
                'unit_kerja'    =>  $unit_kerja,
                'ktp'           =>  $no_ktp,
                'jenis_kar'     =>  $jns_kar,
                'genre'         =>  $genre
            );
            $insert_kar = $this->db->insert('tbl_karyawan', $data_kar);
        } 
        elseif ($jns_kar == 2) 
        {
            $data_sat = array(
                'nik'           =>  $nik,
                'nama_satpam'   =>  $nama_pegawai,
                'unit_kerja'    =>  $unit_kerja,
                'no_hp'         =>  $no_hp,
                'jenis_kar'     =>  $jns_kar,
                'genre'         =>  $genre
            );
            $insert_sat = $this->db->insert('tbl_satpam', $data_sat);
        }

        if ($insert AND $insert_kar OR $insert AND $insert_sat) 
        {
            return 1;
        } else {
            return 0;
        }
    }

    function input_data_pegawai_img($username, $password, $nama_pegawai, $nik, $unit_kerja, $no_ktp, $role, $jns_kar, $genre, $jabatan, $no_hp, $image)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date   =   date("Y/m/d H:i:s");
        $data   =   array(
            'username'      =>  $username,
            'password'      =>  $password,
            'nama_pegawai'  =>  $nama_pegawai,
            'nik'           =>  $nik,
            'unit_kerja'    =>  $unit_kerja,
            'no_ktp'        =>  $no_ktp,
            'role'          =>  $role,
            'jns_kar'       =>  $jns_kar,
            'genre'         =>  $genre,
            'tgl'           =>  $date,
            'status'        =>  "0",
            'valid'         =>  "0",
            'image'         =>  $image
        );

        $insert = $this->db->insert('app_user',$data);

        if ($jns_kar == 1) 
        {
            $data_kar = array(
                'nik'           =>  $nik,
                'nama_karyawan' =>  $nama_pegawai,
                'jabatan'       =>  $jabatan,
                'unit_kerja'    =>  $unit_kerja,
                'ktp'           =>  $no_ktp,
                'jenis_kar'     =>  $jns_kar,
                'genre'         =>  $genre
            );
            $insert_kar = $this->db->insert('tbl_karyawan', $data_kar);
        } 
        elseif ($jns_kar == 2) 
        {
            $data_sat = array(
                'nik'           =>  $nik,
                'nama_satpam'   =>  $nama_pegawai,
                'unit_kerja'    =>  $unit_kerja,
                'no_hp'         =>  $no_hp,
                'jenis_kar'     =>  $jns_kar,
                'genre'         =>  $genre
            );
            $insert_sat = $this->db->insert('tbl_satpam', $data_sat);
        }

        if ($insert AND $insert_kar OR $insert AND $insert_sat) 
        {
            return 1;
        } else {
            return 0;
        }
    }

    function nilai_grafik_fahmi()
    {
        $date = date("Y-m-d");
        $bln  = date("m",strtotime($date));
        return $this->db->query(
                "SELECT 
                    nama_karyawan,nilai_akhir
                FROM 
                    tbl_nilai_akhir_karyawan
                WHERE 
                    MONTH(periode) = '12'
                    AND nik='P86130'
                GROUP BY
                    nik" 
        )->row_array();
    }

    function nilai_grafik_herdi()
    {
        $date = date("Y-m-d");
        $bln  = date("m",strtotime($date));
        return $this->db->query(
                "SELECT 
                    nama_karyawan,nilai_akhir
                FROM 
                    tbl_nilai_akhir_karyawan
                WHERE 
                    MONTH(periode) = '12'
                    AND nik='P89619'
                GROUP BY
                    nik" 
        )->row_array();
    }

    function nilai_grafik_ditta()
    {
        $date = date("Y-m-d");
        $bln  = date("m",strtotime($date));
        return $this->db->query(
                "SELECT 
                    nama_karyawan,nilai_akhir
                FROM 
                    tbl_nilai_akhir_karyawan
                WHERE 
                    MONTH(periode) = '12'
                    AND nik='P84328'
                GROUP BY
                    nik" 
        )->row_array();
    }

    function nilai_grafik_galuh()
    {
        $date = date("Y-m-d");
        $bln  = date("m",strtotime($date));
        return $this->db->query(
                "SELECT 
                    nama_karyawan,nilai_akhir
                FROM 
                    tbl_nilai_akhir_karyawan
                WHERE 
                    MONTH(periode) = '12'
                    AND nik='P87382'
                GROUP BY
                    nik" 
        )->row_array();
    }

    function nilai_grafik_dede()
    {
        $date = date("Y-m-d");
        $bln  = date("m",strtotime($date));
        return $this->db->query(
                "SELECT 
                    nama_karyawan,nilai_akhir
                FROM 
                    tbl_nilai_akhir_karyawan
                WHERE 
                    MONTH(periode) = '12'
                    AND nik='P81384'
                GROUP BY
                    nik" 
        )->row_array();
    }

}
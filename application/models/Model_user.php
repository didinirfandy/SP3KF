<?php

class model_user extends CI_Model
{
    function faktor_nilai($genre,$jns_kar)
    {
        $entry_userid = $this->session->userdata('entry_userid');
        return $this->db->query(
            "SELECT 
                fak.id_faktor,fak.aspek,fak.nama_faktor,fak.genre,fak.jenis_kar,fak.target,
                pek.nama_aspek,pek.nama_singkat,
                lai.entry_userid,lai.nilai
            FROM
                tbl_faktor fak
                INNER JOIN tbl_aspek pek ON pek.id_aspek = fak.aspek
                LEFT JOIN tbl_nilai lai ON lai.entry_userid = '$entry_userid' AND lai.target = fak.target AND lai.jnis_kar = fak.jenis_kar
            WHERE
                fak.jenis_kar='$jns_kar'
                AND (fak.genre IS NULL OR fak.genre='$genre')
            ORDER BY 
                fak.aspek,fak.id_faktor"
        )->result_array();
    }

    function karyawan()
    {
        $nik = $this->session->userdata('nik');
        return $this->db->query(
            "SELECT * FROM tbl_karyawan WHERE NOT nik ='$nik'"
        )->result_array();
    }

    function notnama_pegawai($nama_pegawai)
    {
        return $this->db->query(
            "SELECT entry_userid FROM tbl_nilai WHERE entry_userid='$nama_pegawai'"
        )->result_array();
    }

    function notnik($nik)
    {
        return $this->db->query(
            "SELECT nik FROM tbl_nilai WHERE nik='$nik'"
        )->result_array();
    }

    function karyawan_dinilai($nik)
    {
        return $this->db->query(
            "SELECT 
                nama_karyawan,nik,jabatan,unit_kerja,ktp 
            FROM 
                tbl_karyawan 
            WHERE 
                nik = '$nik'"
        )->result_array();
    }

    function entry_nilai_kar($data)
    {
        $insert = $this->db->insert_batch('tbl_nilai', $data);
        if ($insert) {
            return 1;
        } else {
            return 0;
        }
    }

    function satpam()
    {
        $nik = $this->session->userdata('nik');
        return $this->db->query(
            "SELECT * FROM tbl_satpam WHERE NOT nik ='$nik'"
        )->result_array();
    }

    function satpam_dinilai($nik)
    {
        return $this->db->query(
            "SELECT 
                nama_satpam,nik,unit_kerja,no_hp 
            FROM 
                tbl_satpam 
            WHERE 
                nik = '$nik'"
        )->result_array();
    }

    function nilai_grafik_kar($nik,$bln)
    {
        return $this->db->query(
            "SELECT a.*, b.image
            FROM 
                tbl_nilai_akhir_karyawan a
                LEFT JOIN app_user b ON b.nik = .a.nik
            WHERE 
                a.nik = '$nik' 
                AND MONTH(a.periode) = '$bln' "
        )->row_array();
    }

    function nilai_grafik_sat($nik)
    {
        return $this->db->query(
            "SELECT a.*, b.image
            FROM 
                tbl_nilai_akhir_satpam a
                LEFT JOIN app_user b ON b.nik = .a.nik
            WHERE a.nik = '$nik' "
        )->row_array();
    }

    function nilai_kar($tgl)
    {
        $bulan = date("m",strtotime($tgl));
        return $this->db->query(
            "SELECT 
                * 
            FROM 
                tbl_nilai_akhir_karyawan
            WHERE 
                MONTH(periode) = '$bulan' 
                AND YEAR(periode) = '$tgl'
            ORDER BY 
                id_nilai_akhir ASC"
        )->result_array();
    }

    function nilai_sat($tgl)
    {
        $bulan = date("m",strtotime($tgl));
        return $this->db->query(
            "SELECT 
                * 
            FROM 
                tbl_nilai_akhir_satpam 
            WHERE 
                MONTH(periode) = '$bulan' 
                AND YEAR(periode) = '$tgl'
            ORDER BY 
                id_nilai_akhir ASC"
        )->result_array();
    }

    function evaluasi_kar($nik)
    {
        return $this->db->query(
            "SELECT evaluasi,periode FROM tbl_nilai_akhir_karyawan WHERE nik='$nik'"
        )->result_array();
    }

    function evaluasi_sat($nik)
    {
        return $this->db->query(
            "SELECT evaluasi,periode FROM tbl_nilai_akhir_satpam WHERE nik='$nik'"
        )->result_array();
    }

    function mmsg_kar($nik)
    {
        return $this->db->query("SELECT * FROM tbl_nilai_akhir_karyawan WHERE nik ='$nik' AND status = '1' ")->result_array();
    }

    function mmsg_sat($nik)
    {
        return $this->db->query("SELECT * FROM tbl_nilai_akhir_satpam WHERE nik ='$nik' AND status = '1' ")->result_array();
    }

    function updt_sst_kar($id)
    {
        $data = array(
            'status' => "2"
        );

        $this->db->where('id_nilai_akhir', $id);
        $this->db->update('tbl_nilai_akhir_karyawan', $data);

        return 1;
    }

    function updt_sst_sat($id)
    {
        $data = array(
            'status' => "2"
        );

        $this->db->where('id_nilai_akhir', $id);
        $this->db->update('tbl_nilai_akhir_satpam', $data);

        return 1;
    }

    function nil_kar()
    {
        $nik = $this->session->userdata('nik');
        return $this->db->query(
            "SELECT nilai_akhir FROM tbl_nilai_akhir_karyawan WHERE nik='$nik'"
        )->row_array();
    }

    function rangking()
    {
        $nik = $this->session->userdata('nik');
        $tgl = date("Y-m-d");
        $bulan = date("m",strtotime($tgl));
        return $this->db->query(
            "SELECT 
                nik, nama_karyawan, nilai_akhir,
                ( SELECT find_in_set( nilai_akhir,
                ( SELECT
                group_concat(DISTINCT nilai_akhir
                ORDER BY nilai_akhir DESC separator ',')
                FROM tbl_nilai_akhir_karyawan))
                ) AS rangking
            FROM 
                tbl_nilai_akhir_karyawan 
            WHERE
                MONTH(periode) = '$bulan' 
                AND YEAR(periode) = '$tgl'
                AND nik='$nik'
            ORDER BY 
                id_nilai_akhir"
        )->row_array();
    }
}

-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Des 2019 pada 22.58
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_frontliners`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `app_user`
--

CREATE TABLE `app_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_pegawai` varchar(60) NOT NULL,
  `nik` varchar(10) NOT NULL,
  `unit_kerja` varchar(60) NOT NULL,
  `no_ktp` varchar(20) NOT NULL,
  `role` enum('1','2','3') DEFAULT NULL COMMENT '1=Admin;2=Karyawan Oprawional;3=Satpam',
  `jns_kar` enum('1','2') DEFAULT NULL COMMENT '1=Karyawan Oprawional;2=Satpam',
  `genre` enum('1','2') DEFAULT NULL COMMENT '1=Laki_laki;2=Perempuan',
  `tgl` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `valid` int(11) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `app_user`
--

INSERT INTO `app_user` (`user_id`, `username`, `password`, `nama_pegawai`, `nik`, `unit_kerja`, `no_ktp`, `role`, `jns_kar`, `genre`, `tgl`, `status`, `valid`, `image`) VALUES
(1, 'tasya', 'e10adc3949ba59abbe56e057f20f883e', 'Tasya Wiendhyra', '123th23', 'Kantor Area Bandung', '321638201080009', '1', NULL, NULL, '2019-12-29 01:46:49', 0, 1, 'tasya.jpeg'),
(2, 'didin', 'e10adc3949ba59abbe56e057f20f883e', 'Didin Irfandi', 'P12323', 'Cikudapateuh', '1235789123123124123', '2', '1', '1', '2019-12-22 22:39:02', 0, 0, 'default.jpg'),
(3, 'dede', 'e10adc3949ba59abbe56e057f20f883e', 'Dede Sutisna', 'P81384', 'Kantor Area Bandung', '3205100502690002', '2', '1', '1', '2019-12-29 01:42:14', 0, 1, 'default.jpg'),
(4, 'yoyong', 'e10adc3949ba59abbe56e057f20f883e', 'Yoyong', 'PQ1234567', 'Cikudapateuh', '', '3', '2', '1', '2019-12-23 02:42:37', 0, 0, 'default.jpg'),
(5, 'fahmi', 'e10adc3949ba59abbe56e057f20f883e', 'Muhammad Ridwan Fahmi', 'P86130', 'Cikudapateuh', '3204090301890004', '2', '1', '1', '2019-12-29 03:59:35', 0, 1, 'fahmi.jpg'),
(6, 'ditta', 'e10adc3949ba59abbe56e057f20f883e', 'Ditta Dwi Anugrah', 'P84328', 'Cikudapateuh', '3278036411870002', '2', '1', '1', '2019-12-28 22:59:26', 0, 1, 'ditta.jpg'),
(7, 'hardi', 'e10adc3949ba59abbe56e057f20f883e', 'Herdiansyah', 'P89619', 'Cikudapateuh', '3278036411870002', '2', '1', '1', '2019-12-28 23:26:12', 0, 1, 'hardi.jpg'),
(8, 'galuh', 'e10adc3949ba59abbe56e057f20f883e', 'Galuh Citra Rahayu', 'P87382', 'Cikudapateuh', '3204090301890004', '2', '1', '1', '2019-12-28 23:22:37', 0, 1, 'galuh.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_aspek`
--

CREATE TABLE `tbl_aspek` (
  `id_aspek` tinyint(3) UNSIGNED NOT NULL,
  `nama_aspek` varchar(100) NOT NULL,
  `bobot` float NOT NULL,
  `bobot_core` float NOT NULL,
  `bobot_secondary` float NOT NULL,
  `nama_singkat` char(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_aspek`
--

INSERT INTO `tbl_aspek` (`id_aspek`, `nama_aspek`, `bobot`, `bobot_core`, `bobot_secondary`, `nama_singkat`) VALUES
(1, 'Pakaian', 30, 60, 40, 'P'),
(2, 'Perilaku / Sikap', 50, 70, 30, 'S'),
(3, 'Penerimaan Telepon', 20, 55, 45, 'T');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_bobot`
--

CREATE TABLE `tbl_bobot` (
  `selisih` tinyint(3) NOT NULL,
  `bobot` float NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_bobot`
--

INSERT INTO `tbl_bobot` (`selisih`, `bobot`, `keterangan`) VALUES
(4, 1.5, 'Kompetensi individu kelebihan 4 tingkat'),
(-3, 2, 'Kompetensi individu kekurangan 3 tingkat'),
(3, 2.5, 'Kompetensi individu kelebihan 3 tingkat'),
(-2, 3, 'Kompetensi individu kekurangan 2 tingkat'),
(2, 3.5, 'Kompetensi individu kelebihan 2 tingkat'),
(-1, 4, 'Kompetensi individu kekurangan 1 tingkat'),
(1, 4.5, 'Kompetensi individu kelebihan 1 tingkat'),
(0, 5, 'Tidak ada  selisih (kompetensi,sesuai dgn yang dibutuhkan)'),
(-4, 1, 'Kompetensi individu kekurangan 4 tingkat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_faktor`
--

CREATE TABLE `tbl_faktor` (
  `id_faktor` tinyint(3) UNSIGNED NOT NULL,
  `aspek` tinyint(3) UNSIGNED NOT NULL COMMENT 'FK tbl_aspek',
  `nama_faktor` varchar(150) NOT NULL,
  `target` tinyint(3) NOT NULL,
  `jenis` enum('1','2') DEFAULT NULL COMMENT '1=Core Factor;2=Secondary Factor',
  `jenis_kar` enum('1','2') DEFAULT NULL COMMENT '1=Karyawan Oprawional;2=Satpam',
  `genre` enum('1','2') DEFAULT NULL COMMENT '1=Laki_laki;2=Perempuan'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_faktor`
--

INSERT INTO `tbl_faktor` (`id_faktor`, `aspek`, `nama_faktor`, `target`, `jenis`, `jenis_kar`, `genre`) VALUES
(1, 1, 'Pakaian kerja sesuai jadwal', 4, '1', '1', NULL),
(2, 1, 'ID Card (jelas dan terlihat – tidak terbalik)', 2, '2', '1', NULL),
(3, 1, 'Tata rambut rapi', 4, '1', '1', '1'),
(4, 1, 'Makeup /rias wajah', 3, '1', '1', '2'),
(5, 1, 'Sepatu pantofel bagi pria', 3, '1', '1', '1'),
(6, 1, 'Sepatu berhak bagi wanita', 3, '1', '1', '2'),
(7, 1, 'Celana berwarna gelap', 4, '2', '1', NULL),
(8, 1, 'Menggunakan celana kain (kecuali sabtu)', 4, '1', '1', NULL),
(9, 2, 'Berdiri Tegak Pada Saat Nasabah Datang', 3, '1', '1', NULL),
(10, 2, 'Mengucapkan Salam', 4, '1', '1', NULL),
(11, 2, 'Memperkenalkan Diri', 4, '1', '1', NULL),
(12, 2, 'Tersenyum Dengan Pola 227(2 Cm Kiri Kanan Dan 7 Detik)', 3, '1', '1', NULL),
(13, 2, 'Eye Contact (Triangle Side)', 2, '2', '1', NULL),
(14, 2, 'Menyebutkan Nama Nasabah', 2, '2', '1', NULL),
(15, 2, 'Menjelaskan Kepada Nasabah Dengan Baik Dan Benar', 3, '1', '1', NULL),
(16, 2, 'Periksa Formulir Dengan Baik Dan Benar', 2, '2', '1', NULL),
(17, 2, 'Bila Menemukan Kesalahan Meminta Nasabah Untuk Memperbaikinya', 3, '1', '1', NULL),
(18, 2, 'Mempersilahkan Nasabah Duduk ', 3, '1', '1', NULL),
(19, 2, 'Bersikap Ramah', 3, '1', '1', NULL),
(20, 2, 'Melakukan Cross Selling', 3, '1', '1', NULL),
(21, 2, 'Menanyakan Konfirmasi', 3, '1', '1', NULL),
(22, 2, 'Melakukan Closing', 2, '2', '1', NULL),
(23, 2, 'Salam', 3, '1', '1', NULL),
(24, 3, 'Siap Sedia Menjawab Telepon', 2, '2', '1', NULL),
(25, 3, 'Angkat Telepon Maksimal Dering Ke Tiga', 2, '2', '1', NULL),
(26, 3, 'Tidak Sambil Berbicara Hal Lain', 3, '1', '1', NULL),
(27, 3, 'Tidak Sambil Makan Dan Minum', 3, '1', '1', NULL),
(28, 3, 'Suara Ramah, Tenang, Jelas, Dan Antusias', 3, '1', '1', NULL),
(29, 3, 'Mengucapkan Salam Dan Memperkenalkan Diri', 3, '1', '1', NULL),
(30, 3, 'Menanyakan Nama Nasabah', 3, '1', '1', NULL),
(31, 3, 'Selalu Menggunakan Bahasa Indonesia Yang Baik Dan Benar', 2, '2', '1', NULL),
(32, 3, 'Menyimak Pembicaraan Dan Menanggapinya Dengan Tepat', 3, '1', '1', NULL),
(33, 3, 'Tidak Memotong Pembicaraan', 4, '1', '1', NULL),
(34, 3, 'Mencatat Inti Pembicaraan', 2, '2', '1', NULL),
(35, 3, 'Mengatakan Dengan Sopan Apabila Suara Penelpon Kurang Jelas', 4, '1', '1', NULL),
(36, 3, 'Tidak Terdengar Suara Lain Jika Telepon Dialihkan', 2, '2', '1', NULL),
(37, 3, 'Mengucapkan Salam Penutup', 4, '1', '1', NULL),
(38, 1, 'Kemeja lengan pendek dengan lap pundak berwarna putih', 4, '1', '2', NULL),
(39, 1, 'Badge POLDA sesuai tempat bertugas di lengan kanan', 3, '1', '2', NULL),
(40, 1, 'Badge BUJP di lengan kiri', 3, '1', '2', NULL),
(41, 1, 'Pita standar satpam di dada kiri', 3, '1', '2', NULL),
(42, 1, 'Pita nama anggota standar satpam di dada kanan', 3, '1', '2', NULL),
(43, 1, 'Tanda Nama Kompetensi Kepolisian Terbatas di atas pita satpam dada kiri', 3, '1', '2', NULL),
(44, 1, 'Celana panjang biru dongker standar satpam', 3, '1', '2', NULL),
(45, 1, 'Kopel rim hitam standar satpam', 2, '2', '2', NULL),
(46, 1, 'Sepatu PDH hitam dengan kaos kaki hitam', 2, '2', '2', NULL),
(47, 1, 'Tali kur hitam dan peluit hitam', 2, '2', '2', NULL),
(48, 1, 'Tongkat T POLRI denga ring atau holster', 3, '1', '2', NULL),
(49, 1, 'Borgol standar POLRI dengan pocket', 2, '1', '2', NULL),
(50, 2, 'Beridir sigap di sisi luar pintu nasabah (untuk satu orang)', 2, '2', '2', NULL),
(51, 2, 'Memberi salam ketika nasabah datang', 4, '1', '2', NULL),
(52, 2, 'Menghindari diri dari makan dan minum pada saat bekerja di ruang tunggu nasabah', 4, '1', '2', NULL),
(53, 2, 'Menghindarkan diri dari merokok pada saat bertugas', 4, '1', '2', NULL),
(54, 2, 'Menghindarkan diri dari bermain hp pada saat bertugas', 4, '1', '2', NULL),
(55, 2, 'Tempat kerja bersih', 3, '1', '2', NULL),
(56, 2, 'Membukakan pintu ketika nasabah keluar dari ruangan', 2, '2', '2', NULL),
(57, 2, 'Mengucapkan terimakasih dan salam kepada nasabah ketika nasabah keluar dari ruangan', 3, '1', '2', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jabatan`
--

CREATE TABLE `tbl_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `kd_jabatan` varchar(20) NOT NULL,
  `nama_jabatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_jabatan`
--

INSERT INTO `tbl_jabatan` (`id_jabatan`, `kd_jabatan`, `nama_jabatan`) VALUES
(1, 'KM001', 'Kasir Muda'),
(2, 'KM002', 'Kasir Madya'),
(3, 'PAM001', 'Pengelola Agunan Muda'),
(4, 'PAM002', 'Pengelola Agunan Madya'),
(5, 'PM011', 'Penaksir Muda I'),
(6, 'PM012', 'Penaksir Muda II'),
(7, 'PM021', 'Penaksir Madya I'),
(8, 'PM022', 'Penaksir Madya II');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_karyawan`
--

CREATE TABLE `tbl_karyawan` (
  `id_kar` int(11) NOT NULL,
  `nik` varchar(15) NOT NULL,
  `nama_karyawan` varchar(250) NOT NULL,
  `jabatan` varchar(250) NOT NULL,
  `unit_kerja` varchar(250) NOT NULL,
  `ktp` varchar(25) NOT NULL,
  `jenis_kar` enum('1','2') DEFAULT NULL COMMENT '1=Karyawan Oprawional;2=Satpam',
  `genre` enum('1','2') DEFAULT NULL COMMENT '1=Laki_laki;2=Perempuan'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_karyawan`
--

INSERT INTO `tbl_karyawan` (`id_kar`, `nik`, `nama_karyawan`, `jabatan`, `unit_kerja`, `ktp`, `jenis_kar`, `genre`) VALUES
(1, 'P81384', 'Dede Sutisna', 'Pengelola Agunan Madya', 'Cikudapateuh', '3205100502690002', '1', '1'),
(2, 'P86130', 'Muhammad Ridwan Fahmi', 'Penaksir Muda I', 'Cikudapateuh', '3204090301890004', '1', '1'),
(3, 'P84328', 'Ditta Dwi Anugrah', 'Penaksir Madya II', 'Cikudapateuh', '3278036411870002', '1', '2'),
(4, 'P89619', 'Herdiansyah', 'Kasir Madya', 'Cikudapateuh', '', '1', '1'),
(5, 'P87382', 'Galuh Citra Rahayu', 'Kasir Muda', 'Cikudapateuh', '', '1', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_nilai`
--

CREATE TABLE `tbl_nilai` (
  `id_nilai` int(11) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `id_faktor` int(11) NOT NULL,
  `aspek` int(11) NOT NULL,
  `target` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  `nm_sing` varchar(11) NOT NULL,
  `jnis_kar` enum('1','2') DEFAULT NULL COMMENT '1=Karyawan Oprasional;2=Satpam',
  `genre` enum('1','2') DEFAULT NULL COMMENT '1=Laki_laki;2=Perempuan',
  `catatan` text NOT NULL,
  `sesi_periksa` enum('1','2','3') DEFAULT NULL COMMENT '1=Pagi;2=Siang;3=Sore',
  `entry_date` date NOT NULL,
  `entry_userid` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_nilai`
--

INSERT INTO `tbl_nilai` (`id_nilai`, `nik`, `id_faktor`, `aspek`, `target`, `nilai`, `nm_sing`, `jnis_kar`, `genre`, `catatan`, `sesi_periksa`, `entry_date`, `entry_userid`) VALUES
(1, 'P86130', 1, 1, 4, 3, 'P', '1', '1', '', '', '2019-12-28', 'Dede Sutisna'),
(2, 'P86130', 2, 1, 2, 3, 'P', '1', '1', '', '', '2019-12-28', 'Dede Sutisna'),
(3, 'P86130', 3, 1, 4, 4, 'P', '1', '1', '', '', '2019-12-28', 'Dede Sutisna'),
(4, 'P86130', 5, 1, 3, 3, 'P', '1', '1', '', '', '2019-12-28', 'Dede Sutisna'),
(5, 'P86130', 7, 1, 4, 2, 'P', '1', '1', '', '', '2019-12-28', 'Dede Sutisna'),
(6, 'P86130', 8, 1, 4, 4, 'P', '1', '1', '', '', '2019-12-28', 'Dede Sutisna'),
(7, 'P86130', 9, 2, 3, 3, 'S', '1', '1', '', '', '2019-12-28', 'Dede Sutisna'),
(8, 'P86130', 10, 2, 4, 4, 'S', '1', '1', '', '', '2019-12-28', 'Dede Sutisna'),
(9, 'P86130', 11, 2, 4, 3, 'S', '1', '1', '', '', '2019-12-28', 'Dede Sutisna'),
(10, 'P86130', 12, 2, 3, 2, 'S', '1', '1', '', '', '2019-12-28', 'Dede Sutisna'),
(11, 'P86130', 13, 2, 2, 3, 'S', '1', '1', '', '', '2019-12-28', 'Dede Sutisna'),
(12, 'P86130', 14, 2, 2, 4, 'S', '1', '1', '', '', '2019-12-28', 'Dede Sutisna'),
(13, 'P86130', 15, 2, 3, 3, 'S', '1', '1', '', '', '2019-12-28', 'Dede Sutisna'),
(14, 'P86130', 16, 2, 2, 3, 'S', '1', '1', '', '', '2019-12-28', 'Dede Sutisna'),
(15, 'P86130', 17, 2, 3, 4, 'S', '1', '1', '', '', '2019-12-28', 'Dede Sutisna'),
(16, 'P86130', 18, 2, 3, 3, 'S', '1', '1', '', '', '2019-12-28', 'Dede Sutisna'),
(17, 'P86130', 19, 2, 3, 2, 'S', '1', '1', '', '', '2019-12-28', 'Dede Sutisna'),
(18, 'P86130', 20, 2, 3, 3, 'S', '1', '1', '', '', '2019-12-28', 'Dede Sutisna'),
(19, 'P86130', 21, 2, 3, 4, 'S', '1', '1', '', '', '2019-12-28', 'Dede Sutisna'),
(20, 'P86130', 22, 2, 2, 3, 'S', '1', '1', '', '', '2019-12-28', 'Dede Sutisna'),
(21, 'P86130', 23, 2, 3, 2, 'S', '1', '1', '', '', '2019-12-28', 'Dede Sutisna'),
(22, 'P86130', 24, 3, 2, 3, 'T', '1', '1', '', '', '2019-12-28', 'Dede Sutisna'),
(23, 'P86130', 25, 3, 2, 3, 'T', '1', '1', '', '', '2019-12-28', 'Dede Sutisna'),
(24, 'P86130', 26, 3, 3, 4, 'T', '1', '1', '', '', '2019-12-28', 'Dede Sutisna'),
(25, 'P86130', 27, 3, 3, 3, 'T', '1', '1', '', '', '2019-12-28', 'Dede Sutisna'),
(26, 'P86130', 28, 3, 3, 2, 'T', '1', '1', '', '', '2019-12-28', 'Dede Sutisna'),
(27, 'P86130', 29, 3, 3, 3, 'T', '1', '1', '', '', '2019-12-28', 'Dede Sutisna'),
(28, 'P86130', 30, 3, 3, 3, 'T', '1', '1', '', '', '2019-12-28', 'Dede Sutisna'),
(29, 'P86130', 31, 3, 2, 4, 'T', '1', '1', '', '', '2019-12-28', 'Dede Sutisna'),
(30, 'P86130', 32, 3, 3, 3, 'T', '1', '1', '', '', '2019-12-28', 'Dede Sutisna'),
(31, 'P86130', 33, 3, 4, 2, 'T', '1', '1', '', '', '2019-12-28', 'Dede Sutisna'),
(32, 'P86130', 34, 3, 2, 3, 'T', '1', '1', '', '', '2019-12-28', 'Dede Sutisna'),
(33, 'P86130', 35, 3, 4, 4, 'T', '1', '1', '', '', '2019-12-28', 'Dede Sutisna'),
(34, 'P86130', 36, 3, 2, 4, 'T', '1', '1', '', '', '2019-12-28', 'Dede Sutisna'),
(35, 'P86130', 37, 3, 4, 4, 'T', '1', '1', '', '', '2019-12-28', 'Dede Sutisna'),
(36, 'P81384', 1, 1, 4, 3, 'P', '1', '1', '', '', '2019-12-28', 'Ditta Dwi Anugrah'),
(37, 'P81384', 2, 1, 2, 4, 'P', '1', '1', '', '', '2019-12-28', 'Ditta Dwi Anugrah'),
(38, 'P81384', 3, 1, 4, 3, 'P', '1', '1', '', '', '2019-12-28', 'Ditta Dwi Anugrah'),
(39, 'P81384', 5, 1, 3, 3, 'P', '1', '1', '', '', '2019-12-28', 'Ditta Dwi Anugrah'),
(40, 'P81384', 7, 1, 4, 3, 'P', '1', '1', '', '', '2019-12-28', 'Ditta Dwi Anugrah'),
(41, 'P81384', 8, 1, 4, 4, 'P', '1', '1', '', '', '2019-12-28', 'Ditta Dwi Anugrah'),
(42, 'P81384', 9, 2, 3, 3, 'S', '1', '1', '', '', '2019-12-28', 'Ditta Dwi Anugrah'),
(43, 'P81384', 10, 2, 4, 3, 'S', '1', '1', '', '', '2019-12-28', 'Ditta Dwi Anugrah'),
(44, 'P81384', 11, 2, 4, 4, 'S', '1', '1', '', '', '2019-12-28', 'Ditta Dwi Anugrah'),
(45, 'P81384', 12, 2, 3, 3, 'S', '1', '1', '', '', '2019-12-28', 'Ditta Dwi Anugrah'),
(46, 'P81384', 13, 2, 2, 3, 'S', '1', '1', '', '', '2019-12-28', 'Ditta Dwi Anugrah'),
(47, 'P81384', 14, 2, 2, 4, 'S', '1', '1', '', '', '2019-12-28', 'Ditta Dwi Anugrah'),
(48, 'P81384', 15, 2, 3, 2, 'S', '1', '1', '', '', '2019-12-28', 'Ditta Dwi Anugrah'),
(49, 'P81384', 16, 2, 2, 3, 'S', '1', '1', '', '', '2019-12-28', 'Ditta Dwi Anugrah'),
(50, 'P81384', 17, 2, 3, 4, 'S', '1', '1', '', '', '2019-12-28', 'Ditta Dwi Anugrah'),
(51, 'P81384', 18, 2, 3, 3, 'S', '1', '1', '', '', '2019-12-28', 'Ditta Dwi Anugrah'),
(52, 'P81384', 19, 2, 3, 2, 'S', '1', '1', '', '', '2019-12-28', 'Ditta Dwi Anugrah'),
(53, 'P81384', 20, 2, 3, 3, 'S', '1', '1', '', '', '2019-12-28', 'Ditta Dwi Anugrah'),
(54, 'P81384', 21, 2, 3, 4, 'S', '1', '1', '', '', '2019-12-28', 'Ditta Dwi Anugrah'),
(55, 'P81384', 22, 2, 2, 3, 'S', '1', '1', '', '', '2019-12-28', 'Ditta Dwi Anugrah'),
(56, 'P81384', 23, 2, 3, 2, 'S', '1', '1', '', '', '2019-12-28', 'Ditta Dwi Anugrah'),
(57, 'P81384', 24, 3, 2, 3, 'T', '1', '1', '', '', '2019-12-28', 'Ditta Dwi Anugrah'),
(58, 'P81384', 25, 3, 2, 3, 'T', '1', '1', '', '', '2019-12-28', 'Ditta Dwi Anugrah'),
(59, 'P81384', 26, 3, 3, 4, 'T', '1', '1', '', '', '2019-12-28', 'Ditta Dwi Anugrah'),
(60, 'P81384', 27, 3, 3, 3, 'T', '1', '1', '', '', '2019-12-28', 'Ditta Dwi Anugrah'),
(61, 'P81384', 28, 3, 3, 3, 'T', '1', '1', '', '', '2019-12-28', 'Ditta Dwi Anugrah'),
(62, 'P81384', 29, 3, 3, 4, 'T', '1', '1', '', '', '2019-12-28', 'Ditta Dwi Anugrah'),
(63, 'P81384', 30, 3, 3, 3, 'T', '1', '1', '', '', '2019-12-28', 'Ditta Dwi Anugrah'),
(64, 'P81384', 31, 3, 2, 4, 'T', '1', '1', '', '', '2019-12-28', 'Ditta Dwi Anugrah'),
(65, 'P81384', 32, 3, 3, 3, 'T', '1', '1', '', '', '2019-12-28', 'Ditta Dwi Anugrah'),
(66, 'P81384', 33, 3, 4, 3, 'T', '1', '1', '', '', '2019-12-28', 'Ditta Dwi Anugrah'),
(67, 'P81384', 34, 3, 2, 4, 'T', '1', '1', '', '', '2019-12-28', 'Ditta Dwi Anugrah'),
(68, 'P81384', 35, 3, 4, 3, 'T', '1', '1', '', '', '2019-12-28', 'Ditta Dwi Anugrah'),
(69, 'P81384', 36, 3, 2, 4, 'T', '1', '1', '', '', '2019-12-28', 'Ditta Dwi Anugrah'),
(70, 'P81384', 37, 3, 4, 3, 'T', '1', '1', '', '', '2019-12-28', 'Ditta Dwi Anugrah'),
(71, 'P84328', 1, 1, 4, 3, 'P', '1', '2', '', '', '2019-12-28', 'Muhammad Ridwan Fahmi'),
(72, 'P84328', 2, 1, 2, 3, 'P', '1', '2', '', '', '2019-12-28', 'Muhammad Ridwan Fahmi'),
(73, 'P84328', 4, 1, 3, 3, 'P', '1', '2', '', '', '2019-12-28', 'Muhammad Ridwan Fahmi'),
(74, 'P84328', 6, 1, 3, 3, 'P', '1', '2', '', '', '2019-12-28', 'Muhammad Ridwan Fahmi'),
(75, 'P84328', 7, 1, 4, 3, 'P', '1', '2', '', '', '2019-12-28', 'Muhammad Ridwan Fahmi'),
(76, 'P84328', 8, 1, 4, 3, 'P', '1', '2', '', '', '2019-12-28', 'Muhammad Ridwan Fahmi'),
(77, 'P84328', 9, 2, 3, 2, 'S', '1', '2', '', '', '2019-12-28', 'Muhammad Ridwan Fahmi'),
(78, 'P84328', 10, 2, 4, 3, 'S', '1', '2', '', '', '2019-12-28', 'Muhammad Ridwan Fahmi'),
(79, 'P84328', 11, 2, 4, 4, 'S', '1', '2', '', '', '2019-12-28', 'Muhammad Ridwan Fahmi'),
(80, 'P84328', 12, 2, 3, 3, 'S', '1', '2', '', '', '2019-12-28', 'Muhammad Ridwan Fahmi'),
(81, 'P84328', 13, 2, 2, 3, 'S', '1', '2', '', '', '2019-12-28', 'Muhammad Ridwan Fahmi'),
(82, 'P84328', 14, 2, 2, 2, 'S', '1', '2', '', '', '2019-12-28', 'Muhammad Ridwan Fahmi'),
(83, 'P84328', 15, 2, 3, 3, 'S', '1', '2', '', '', '2019-12-28', 'Muhammad Ridwan Fahmi'),
(84, 'P84328', 16, 2, 2, 4, 'S', '1', '2', '', '', '2019-12-28', 'Muhammad Ridwan Fahmi'),
(85, 'P84328', 17, 2, 3, 4, 'S', '1', '2', '', '', '2019-12-28', 'Muhammad Ridwan Fahmi'),
(86, 'P84328', 18, 2, 3, 3, 'S', '1', '2', '', '', '2019-12-28', 'Muhammad Ridwan Fahmi'),
(87, 'P84328', 19, 2, 3, 3, 'S', '1', '2', '', '', '2019-12-28', 'Muhammad Ridwan Fahmi'),
(88, 'P84328', 20, 2, 3, 3, 'S', '1', '2', '', '', '2019-12-28', 'Muhammad Ridwan Fahmi'),
(89, 'P84328', 21, 2, 3, 4, 'S', '1', '2', '', '', '2019-12-28', 'Muhammad Ridwan Fahmi'),
(90, 'P84328', 22, 2, 2, 2, 'S', '1', '2', '', '', '2019-12-28', 'Muhammad Ridwan Fahmi'),
(91, 'P84328', 23, 2, 3, 3, 'S', '1', '2', '', '', '2019-12-28', 'Muhammad Ridwan Fahmi'),
(92, 'P84328', 24, 3, 2, 3, 'T', '1', '2', '', '', '2019-12-28', 'Muhammad Ridwan Fahmi'),
(93, 'P84328', 25, 3, 2, 3, 'T', '1', '2', '', '', '2019-12-28', 'Muhammad Ridwan Fahmi'),
(94, 'P84328', 26, 3, 3, 2, 'T', '1', '2', '', '', '2019-12-28', 'Muhammad Ridwan Fahmi'),
(95, 'P84328', 27, 3, 3, 3, 'T', '1', '2', '', '', '2019-12-28', 'Muhammad Ridwan Fahmi'),
(96, 'P84328', 28, 3, 3, 4, 'T', '1', '2', '', '', '2019-12-28', 'Muhammad Ridwan Fahmi'),
(97, 'P84328', 29, 3, 3, 3, 'T', '1', '2', '', '', '2019-12-28', 'Muhammad Ridwan Fahmi'),
(98, 'P84328', 30, 3, 3, 3, 'T', '1', '2', '', '', '2019-12-28', 'Muhammad Ridwan Fahmi'),
(99, 'P84328', 31, 3, 2, 3, 'T', '1', '2', '', '', '2019-12-28', 'Muhammad Ridwan Fahmi'),
(100, 'P84328', 32, 3, 3, 4, 'T', '1', '2', '', '', '2019-12-28', 'Muhammad Ridwan Fahmi'),
(101, 'P84328', 33, 3, 4, 3, 'T', '1', '2', '', '', '2019-12-28', 'Muhammad Ridwan Fahmi'),
(102, 'P84328', 34, 3, 2, 2, 'T', '1', '2', '', '', '2019-12-28', 'Muhammad Ridwan Fahmi'),
(103, 'P84328', 35, 3, 4, 3, 'T', '1', '2', '', '', '2019-12-28', 'Muhammad Ridwan Fahmi'),
(104, 'P84328', 36, 3, 2, 3, 'T', '1', '2', '', '', '2019-12-28', 'Muhammad Ridwan Fahmi'),
(105, 'P84328', 37, 3, 4, 4, 'T', '1', '2', '', '', '2019-12-28', 'Muhammad Ridwan Fahmi'),
(141, 'P89619', 1, 1, 4, 3, 'P', '1', '1', '', '', '2019-12-28', 'Galuh Citra Rahayu'),
(142, 'P89619', 2, 1, 2, 2, 'P', '1', '1', '', '', '2019-12-28', 'Galuh Citra Rahayu'),
(143, 'P89619', 3, 1, 4, 3, 'P', '1', '1', '', '', '2019-12-28', 'Galuh Citra Rahayu'),
(144, 'P89619', 5, 1, 3, 4, 'P', '1', '1', '', '', '2019-12-28', 'Galuh Citra Rahayu'),
(145, 'P89619', 7, 1, 4, 3, 'P', '1', '1', '', '', '2019-12-28', 'Galuh Citra Rahayu'),
(146, 'P89619', 8, 1, 4, 4, 'P', '1', '1', '', '', '2019-12-28', 'Galuh Citra Rahayu'),
(147, 'P89619', 9, 2, 3, 3, 'S', '1', '1', '', '', '2019-12-28', 'Galuh Citra Rahayu'),
(148, 'P89619', 10, 2, 4, 3, 'S', '1', '1', '', '', '2019-12-28', 'Galuh Citra Rahayu'),
(149, 'P89619', 11, 2, 4, 3, 'S', '1', '1', '', '', '2019-12-28', 'Galuh Citra Rahayu'),
(150, 'P89619', 12, 2, 3, 4, 'S', '1', '1', '', '', '2019-12-28', 'Galuh Citra Rahayu'),
(151, 'P89619', 13, 2, 2, 2, 'S', '1', '1', '', '', '2019-12-28', 'Galuh Citra Rahayu'),
(152, 'P89619', 14, 2, 2, 3, 'S', '1', '1', '', '', '2019-12-28', 'Galuh Citra Rahayu'),
(153, 'P89619', 15, 2, 3, 4, 'S', '1', '1', '', '', '2019-12-28', 'Galuh Citra Rahayu'),
(154, 'P89619', 16, 2, 2, 3, 'S', '1', '1', '', '', '2019-12-28', 'Galuh Citra Rahayu'),
(155, 'P89619', 17, 2, 3, 3, 'S', '1', '1', '', '', '2019-12-28', 'Galuh Citra Rahayu'),
(156, 'P89619', 18, 2, 3, 2, 'S', '1', '1', '', '', '2019-12-28', 'Galuh Citra Rahayu'),
(157, 'P89619', 19, 2, 3, 3, 'S', '1', '1', '', '', '2019-12-28', 'Galuh Citra Rahayu'),
(158, 'P89619', 20, 2, 3, 4, 'S', '1', '1', '', '', '2019-12-28', 'Galuh Citra Rahayu'),
(159, 'P89619', 21, 2, 3, 3, 'S', '1', '1', '', '', '2019-12-28', 'Galuh Citra Rahayu'),
(160, 'P89619', 22, 2, 2, 2, 'S', '1', '1', '', '', '2019-12-28', 'Galuh Citra Rahayu'),
(161, 'P89619', 23, 2, 3, 3, 'S', '1', '1', '', '', '2019-12-28', 'Galuh Citra Rahayu'),
(162, 'P89619', 24, 3, 2, 3, 'T', '1', '1', '', '', '2019-12-28', 'Galuh Citra Rahayu'),
(163, 'P89619', 25, 3, 2, 2, 'T', '1', '1', '', '', '2019-12-28', 'Galuh Citra Rahayu'),
(164, 'P89619', 26, 3, 3, 3, 'T', '1', '1', '', '', '2019-12-28', 'Galuh Citra Rahayu'),
(165, 'P89619', 27, 3, 3, 4, 'T', '1', '1', '', '', '2019-12-28', 'Galuh Citra Rahayu'),
(166, 'P89619', 28, 3, 3, 3, 'T', '1', '1', '', '', '2019-12-28', 'Galuh Citra Rahayu'),
(167, 'P89619', 29, 3, 3, 2, 'T', '1', '1', '', '', '2019-12-28', 'Galuh Citra Rahayu'),
(168, 'P89619', 30, 3, 3, 3, 'T', '1', '1', '', '', '2019-12-28', 'Galuh Citra Rahayu'),
(169, 'P89619', 31, 3, 2, 3, 'T', '1', '1', '', '', '2019-12-28', 'Galuh Citra Rahayu'),
(170, 'P89619', 32, 3, 3, 3, 'T', '1', '1', '', '', '2019-12-28', 'Galuh Citra Rahayu'),
(171, 'P89619', 33, 3, 4, 4, 'T', '1', '1', '', '', '2019-12-28', 'Galuh Citra Rahayu'),
(172, 'P89619', 34, 3, 2, 3, 'T', '1', '1', '', '', '2019-12-28', 'Galuh Citra Rahayu'),
(173, 'P89619', 35, 3, 4, 4, 'T', '1', '1', '', '', '2019-12-28', 'Galuh Citra Rahayu'),
(174, 'P89619', 36, 3, 2, 3, 'T', '1', '1', '', '', '2019-12-28', 'Galuh Citra Rahayu'),
(175, 'P89619', 37, 3, 4, 3, 'T', '1', '1', '', '', '2019-12-28', 'Galuh Citra Rahayu'),
(176, 'P87382', 1, 1, 4, 3, 'P', '1', '2', '', '', '2019-12-28', 'Herdiansyah'),
(177, 'P87382', 2, 1, 2, 3, 'P', '1', '2', '', '', '2019-12-28', 'Herdiansyah'),
(178, 'P87382', 4, 1, 3, 2, 'P', '1', '2', '', '', '2019-12-28', 'Herdiansyah'),
(179, 'P87382', 6, 1, 3, 3, 'P', '1', '2', '', '', '2019-12-28', 'Herdiansyah'),
(180, 'P87382', 7, 1, 4, 4, 'P', '1', '2', '', '', '2019-12-28', 'Herdiansyah'),
(181, 'P87382', 8, 1, 4, 3, 'P', '1', '2', '', '', '2019-12-28', 'Herdiansyah'),
(182, 'P87382', 9, 2, 3, 2, 'S', '1', '2', '', '', '2019-12-28', 'Herdiansyah'),
(183, 'P87382', 10, 2, 4, 3, 'S', '1', '2', '', '', '2019-12-28', 'Herdiansyah'),
(184, 'P87382', 11, 2, 4, 4, 'S', '1', '2', '', '', '2019-12-28', 'Herdiansyah'),
(185, 'P87382', 12, 2, 3, 3, 'S', '1', '2', '', '', '2019-12-28', 'Herdiansyah'),
(186, 'P87382', 13, 2, 2, 3, 'S', '1', '2', '', '', '2019-12-28', 'Herdiansyah'),
(187, 'P87382', 14, 2, 2, 2, 'S', '1', '2', '', '', '2019-12-28', 'Herdiansyah'),
(188, 'P87382', 15, 2, 3, 3, 'S', '1', '2', '', '', '2019-12-28', 'Herdiansyah'),
(189, 'P87382', 16, 2, 2, 4, 'S', '1', '2', '', '', '2019-12-28', 'Herdiansyah'),
(190, 'P87382', 17, 2, 3, 3, 'S', '1', '2', '', '', '2019-12-28', 'Herdiansyah'),
(191, 'P87382', 18, 2, 3, 3, 'S', '1', '2', '', '', '2019-12-28', 'Herdiansyah'),
(192, 'P87382', 19, 2, 3, 3, 'S', '1', '2', '', '', '2019-12-28', 'Herdiansyah'),
(193, 'P87382', 20, 2, 3, 2, 'S', '1', '2', '', '', '2019-12-28', 'Herdiansyah'),
(194, 'P87382', 21, 2, 3, 3, 'S', '1', '2', '', '', '2019-12-28', 'Herdiansyah'),
(195, 'P87382', 22, 2, 2, 4, 'S', '1', '2', '', '', '2019-12-28', 'Herdiansyah'),
(196, 'P87382', 23, 2, 3, 3, 'S', '1', '2', '', '', '2019-12-28', 'Herdiansyah'),
(197, 'P87382', 24, 3, 2, 3, 'T', '1', '2', '', '', '2019-12-28', 'Herdiansyah'),
(198, 'P87382', 25, 3, 2, 3, 'T', '1', '2', '', '', '2019-12-28', 'Herdiansyah'),
(199, 'P87382', 26, 3, 3, 2, 'T', '1', '2', '', '', '2019-12-28', 'Herdiansyah'),
(200, 'P87382', 27, 3, 3, 2, 'T', '1', '2', '', '', '2019-12-28', 'Herdiansyah'),
(201, 'P87382', 28, 3, 3, 3, 'T', '1', '2', '', '', '2019-12-28', 'Herdiansyah'),
(202, 'P87382', 29, 3, 3, 4, 'T', '1', '2', '', '', '2019-12-28', 'Herdiansyah'),
(203, 'P87382', 30, 3, 3, 4, 'T', '1', '2', '', '', '2019-12-28', 'Herdiansyah'),
(204, 'P87382', 31, 3, 2, 4, 'T', '1', '2', '', '', '2019-12-28', 'Herdiansyah'),
(205, 'P87382', 32, 3, 3, 3, 'T', '1', '2', '', '', '2019-12-28', 'Herdiansyah'),
(206, 'P87382', 33, 3, 4, 4, 'T', '1', '2', '', '', '2019-12-28', 'Herdiansyah'),
(207, 'P87382', 34, 3, 2, 4, 'T', '1', '2', '', '', '2019-12-28', 'Herdiansyah'),
(208, 'P87382', 35, 3, 4, 3, 'T', '1', '2', '', '', '2019-12-28', 'Herdiansyah'),
(209, 'P87382', 36, 3, 2, 3, 'T', '1', '2', '', '', '2019-12-28', 'Herdiansyah'),
(210, 'P87382', 37, 3, 4, 4, 'T', '1', '2', '', '', '2019-12-28', 'Herdiansyah'),
(246, 'P87382', 1, 1, 4, 3, 'P', '1', '2', '', '', '2019-12-21', 'Dede Sutisna'),
(247, 'P87382', 2, 1, 2, 3, 'P', '1', '2', '', '', '2019-12-21', 'Dede Sutisna'),
(248, 'P87382', 4, 1, 3, 3, 'P', '1', '2', '', '', '2019-12-21', 'Dede Sutisna'),
(249, 'P87382', 6, 1, 3, 4, 'P', '1', '2', '', '', '2019-12-21', 'Dede Sutisna'),
(250, 'P87382', 7, 1, 4, 4, 'P', '1', '2', '', '', '2019-12-21', 'Dede Sutisna'),
(251, 'P87382', 8, 1, 4, 4, 'P', '1', '2', '', '', '2019-12-21', 'Dede Sutisna'),
(252, 'P87382', 9, 2, 3, 3, 'S', '1', '2', '', '', '2019-12-21', 'Dede Sutisna'),
(253, 'P87382', 10, 2, 4, 2, 'S', '1', '2', '', '', '2019-12-21', 'Dede Sutisna'),
(254, 'P87382', 11, 2, 4, 2, 'S', '1', '2', '', '', '2019-12-21', 'Dede Sutisna'),
(255, 'P87382', 12, 2, 3, 3, 'S', '1', '2', '', '', '2019-12-21', 'Dede Sutisna'),
(256, 'P87382', 13, 2, 2, 3, 'S', '1', '2', '', '', '2019-12-21', 'Dede Sutisna'),
(257, 'P87382', 14, 2, 2, 3, 'S', '1', '2', '', '', '2019-12-21', 'Dede Sutisna'),
(258, 'P87382', 15, 2, 3, 3, 'S', '1', '2', '', '', '2019-12-21', 'Dede Sutisna'),
(259, 'P87382', 16, 2, 2, 3, 'S', '1', '2', '', '', '2019-12-21', 'Dede Sutisna'),
(260, 'P87382', 17, 2, 3, 4, 'S', '1', '2', '', '', '2019-12-21', 'Dede Sutisna'),
(261, 'P87382', 18, 2, 3, 3, 'S', '1', '2', '', '', '2019-12-21', 'Dede Sutisna'),
(262, 'P87382', 19, 2, 3, 4, 'S', '1', '2', '', '', '2019-12-21', 'Dede Sutisna'),
(263, 'P87382', 20, 2, 3, 3, 'S', '1', '2', '', '', '2019-12-21', 'Dede Sutisna'),
(264, 'P87382', 21, 2, 3, 4, 'S', '1', '2', '', '', '2019-12-21', 'Dede Sutisna'),
(265, 'P87382', 22, 2, 2, 4, 'S', '1', '2', '', '', '2019-12-21', 'Dede Sutisna'),
(266, 'P87382', 23, 2, 3, 3, 'S', '1', '2', '', '', '2019-12-21', 'Dede Sutisna'),
(267, 'P87382', 24, 3, 2, 2, 'T', '1', '2', '', '', '2019-12-21', 'Dede Sutisna'),
(268, 'P87382', 25, 3, 2, 3, 'T', '1', '2', '', '', '2019-12-21', 'Dede Sutisna'),
(269, 'P87382', 26, 3, 3, 4, 'T', '1', '2', '', '', '2019-12-21', 'Dede Sutisna'),
(270, 'P87382', 27, 3, 3, 4, 'T', '1', '2', '', '', '2019-12-21', 'Dede Sutisna'),
(271, 'P87382', 28, 3, 3, 3, 'T', '1', '2', '', '', '2019-12-21', 'Dede Sutisna'),
(272, 'P87382', 29, 3, 3, 3, 'T', '1', '2', '', '', '2019-12-21', 'Dede Sutisna'),
(273, 'P87382', 30, 3, 3, 3, 'T', '1', '2', '', '', '2019-12-21', 'Dede Sutisna'),
(274, 'P87382', 31, 3, 2, 4, 'T', '1', '2', '', '', '2019-12-21', 'Dede Sutisna'),
(275, 'P87382', 32, 3, 3, 3, 'T', '1', '2', '', '', '2019-12-21', 'Dede Sutisna'),
(276, 'P87382', 33, 3, 4, 3, 'T', '1', '2', '', '', '2019-12-21', 'Dede Sutisna'),
(277, 'P87382', 34, 3, 2, 4, 'T', '1', '2', '', '', '2019-12-21', 'Dede Sutisna'),
(278, 'P87382', 35, 3, 4, 4, 'T', '1', '2', '', '', '2019-12-21', 'Dede Sutisna'),
(279, 'P87382', 36, 3, 2, 3, 'T', '1', '2', '', '', '2019-12-21', 'Dede Sutisna'),
(280, 'P87382', 37, 3, 4, 4, 'T', '1', '2', '', '', '2019-12-21', 'Dede Sutisna');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_nilai_akhir_karyawan`
--

CREATE TABLE `tbl_nilai_akhir_karyawan` (
  `id_nilai_akhir` int(11) NOT NULL,
  `nama_karyawan` varchar(250) NOT NULL,
  `nik` varchar(30) NOT NULL,
  `genre` enum('1','2') DEFAULT NULL COMMENT '1=Laki-laki;2=Perempuan',
  `jenis_kar` enum('1','2') DEFAULT NULL COMMENT '1=Karyawan;2=Satpam',
  `nilai_akhir` varchar(50) NOT NULL,
  `evaluasi` varchar(250) NOT NULL,
  `periode` date NOT NULL,
  `pakaian` varchar(250) NOT NULL,
  `perilaku` varchar(250) NOT NULL,
  `telepon` varchar(250) NOT NULL,
  `entry_date` datetime NOT NULL,
  `status` enum('1','2') DEFAULT NULL COMMENT '1=Belum;2=Sudah'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_nilai_akhir_karyawan`
--

INSERT INTO `tbl_nilai_akhir_karyawan` (`id_nilai_akhir`, `nama_karyawan`, `nik`, `genre`, `jenis_kar`, `nilai_akhir`, `evaluasi`, `periode`, `pakaian`, `perilaku`, `telepon`, `entry_date`, `status`) VALUES
(11, 'Herdiansyah', 'P89619', '1', '1', '4.58', '', '2019-12-28', '3.411131059246', '8.0789946140036', '7.7199281867145', '2019-12-29 02:46:40', '1'),
(12, 'Ditta Dwi Anugrah', 'P84328', '2', '1', '4.56', '', '2019-12-28', '3.2315978456014', '8.2585278276481', '7.7199281867145', '2019-12-29 02:46:40', '1'),
(13, 'Galuh Citra Rahayu', 'P87382', '2', '1', '4.55', '', '2019-12-28', '3.770197486535', '8.9766606822262', '8.7971274685817', '2019-12-29 02:46:40', '1'),
(14, 'Muhammad Ridwan Fahmi', 'P86130', '1', '1', '4.41', '', '2019-12-28', '3.411131059246', '8.2585278276481', '8.0789946140036', '2019-12-29 02:46:40', '1'),
(15, 'Dede Sutisna', 'P81384', '1', '1', '4.34', '', '2019-12-28', '3.5906642728905', '8.2585278276481', '8.4380610412926', '2019-12-29 02:46:40', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_nilai_akhir_satpam`
--

CREATE TABLE `tbl_nilai_akhir_satpam` (
  `id_nilai_akhir` int(11) NOT NULL,
  `nama_satpam` varchar(250) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `genre` enum('1','2') DEFAULT NULL COMMENT '1=Laki-laki;2=Perempuan',
  `jenis_kar` enum('1','2') DEFAULT NULL COMMENT '1=Karyawan;2=Satpam',
  `nilai_akhir` varchar(10) NOT NULL,
  `evaluasi` varchar(250) NOT NULL,
  `periode` date NOT NULL,
  `pakaian` varchar(250) NOT NULL,
  `perilaku` varchar(250) NOT NULL,
  `entry_date` datetime NOT NULL,
  `status` enum('1','2') DEFAULT NULL COMMENT '1=Belum;2=Sudah'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_satpam`
--

CREATE TABLE `tbl_satpam` (
  `id_sat` int(11) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `nama_satpam` varchar(100) NOT NULL,
  `unit_kerja` varchar(100) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `jenis_kar` enum('1','2') DEFAULT NULL COMMENT '1=Karyawan Oprawional;2=Satpam',
  `genre` enum('1','2') DEFAULT NULL COMMENT '1=Laki_laki;2=Perempuan'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_satpam`
--

INSERT INTO `tbl_satpam` (`id_sat`, `nik`, `nama_satpam`, `unit_kerja`, `no_hp`, `jenis_kar`, `genre`) VALUES
(1, 'PQ1008247', 'Ricky Satriawan', 'Cikudapateuh', '', '2', '1'),
(2, 'PQ1015710', 'Dodi', 'Cikudapateuh', '081221838896', '2', '1'),
(3, 'PQ1008530', 'Asep Juandi', 'Cikudapateuh', '08990944589', '2', '1'),
(4, 'PQ1008242', 'Ramdan Taopik', 'Cikudapateuh', '081321321977', '2', '1'),
(5, 'PQ1008529', 'Sofyan', 'Cikudapateuh', '', '2', '1'),
(6, 'PQ0201261', 'Zulfan Risa', 'Cikudapateuh', '085283777014', '2', '1');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `app_user`
--
ALTER TABLE `app_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indeks untuk tabel `tbl_aspek`
--
ALTER TABLE `tbl_aspek`
  ADD PRIMARY KEY (`id_aspek`);

--
-- Indeks untuk tabel `tbl_bobot`
--
ALTER TABLE `tbl_bobot`
  ADD PRIMARY KEY (`selisih`);

--
-- Indeks untuk tabel `tbl_faktor`
--
ALTER TABLE `tbl_faktor`
  ADD PRIMARY KEY (`id_faktor`);

--
-- Indeks untuk tabel `tbl_jabatan`
--
ALTER TABLE `tbl_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `tbl_karyawan`
--
ALTER TABLE `tbl_karyawan`
  ADD PRIMARY KEY (`id_kar`);

--
-- Indeks untuk tabel `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indeks untuk tabel `tbl_nilai_akhir_karyawan`
--
ALTER TABLE `tbl_nilai_akhir_karyawan`
  ADD PRIMARY KEY (`id_nilai_akhir`);

--
-- Indeks untuk tabel `tbl_nilai_akhir_satpam`
--
ALTER TABLE `tbl_nilai_akhir_satpam`
  ADD PRIMARY KEY (`id_nilai_akhir`);

--
-- Indeks untuk tabel `tbl_satpam`
--
ALTER TABLE `tbl_satpam`
  ADD PRIMARY KEY (`id_sat`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `app_user`
--
ALTER TABLE `app_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_aspek`
--
ALTER TABLE `tbl_aspek`
  MODIFY `id_aspek` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_faktor`
--
ALTER TABLE `tbl_faktor`
  MODIFY `id_faktor` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT untuk tabel `tbl_jabatan`
--
ALTER TABLE `tbl_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_karyawan`
--
ALTER TABLE `tbl_karyawan`
  MODIFY `id_kar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=281;

--
-- AUTO_INCREMENT untuk tabel `tbl_nilai_akhir_karyawan`
--
ALTER TABLE `tbl_nilai_akhir_karyawan`
  MODIFY `id_nilai_akhir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tbl_nilai_akhir_satpam`
--
ALTER TABLE `tbl_nilai_akhir_satpam`
  MODIFY `id_nilai_akhir` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_satpam`
--
ALTER TABLE `tbl_satpam`
  MODIFY `id_sat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

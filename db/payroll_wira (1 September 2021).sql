-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Sep 2021 pada 13.39
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payroll_wira`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` varchar(16) NOT NULL,
  `id_outlet` varchar(16) NOT NULL,
  `id_karyawan` varchar(16) NOT NULL,
  `bulan` varchar(20) NOT NULL,
  `periode` varchar(7) NOT NULL,
  `hadir` int(11) NOT NULL,
  `absen` int(11) NOT NULL,
  `lembur` longtext DEFAULT NULL,
  `created` varchar(128) NOT NULL,
  `edited` varchar(128) NOT NULL,
  `deleted` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `id_outlet`, `id_karyawan`, `bulan`, `periode`, `hadir`, `absen`, `lembur`, `created`, `edited`, `deleted`) VALUES
('ABSN202109010001', 'OUTL202108260001', '1', '09', '2021-09', 21, 0, '001 - Lembur Harian|2021-09-01', '01-09-2021 10:26:57-admin', '01-09-2021 18:27:07-admin', NULL),
('ABSN202109010002', 'OUTL202108260002', '27', '09', '2021-09', 15, 4, '001 - Lembur Harian|2021-09-01', '01-09-2021 13:17:02-admin', '01-09-2021 18:26:00-admin', NULL),
('ABSN202109010003', 'OUTL202108260001', '26', '09', '2021-09', 10, 3, '001 - Lembur Harian|2021-09-01,002 - Hari Raya Waisak|2021-09-02', '01-09-2021 15:57:08-admin', '', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `jabatan` varchar(500) NOT NULL,
  `created` varchar(128) NOT NULL,
  `edited` varchar(128) NOT NULL,
  `deleted` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `jabatan`, `created`, `edited`, `deleted`) VALUES
(1, 'Satpam', '28-07-2021 11:14:00', '04-08-2021 19:27:03', NULL),
(2, '123', '04-08-2021 15:32:06', '', '04-08-2021 15:32:13'),
(3, 'Cleaning Service1', '04-08-2021 15:33:11', '04-08-2021 15:33:15', '04-08-2021 15:33:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` varchar(16) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jekel` varchar(128) NOT NULL,
  `status` varchar(25) NOT NULL,
  `tempat_lahir` varchar(128) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `agama` varchar(128) NOT NULL,
  `jabatan` varchar(500) DEFAULT NULL,
  `tinggi` varchar(100) NOT NULL,
  `berat` varchar(100) NOT NULL,
  `suku` varchar(128) NOT NULL,
  `alamat` varchar(300) NOT NULL,
  `handphone` varchar(15) NOT NULL,
  `pendidikan` longtext NOT NULL,
  `pengalaman` longtext NOT NULL,
  `pelatihan` longtext NOT NULL,
  `foto` text DEFAULT NULL,
  `created` varchar(128) DEFAULT NULL,
  `edited` varchar(128) DEFAULT NULL,
  `deleted` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nik`, `nama`, `jekel`, `status`, `tempat_lahir`, `tanggal_lahir`, `agama`, `jabatan`, `tinggi`, `berat`, `suku`, `alamat`, `handphone`, `pendidikan`, `pengalaman`, `pelatihan`, `foto`, `created`, `edited`, `deleted`) VALUES
('1', '1207236701920002', 'JULI WARDANI', 'PEREMPUAN', 'BELUM MENIKAH', 'SEI SEMAYANG', '1992-01-27', 'ISLAM', 'Satpam', '158', '72', 'JAWA', 'DUSUN I AMAN DAMAI', '081910999176', 'SMA NEGERI 1 SUNGGAL TAMAT TAHUN 2010', 'SATPAM DI HOME CENTRAL TAHUN 2010 S/D TAHUN 2011', 'GADA PRATAMA TAHUN 2010', 'default.png', '2021-07-19 13:23:49', '28-07-2021 11:36:26', NULL),
('26', '1271034711970003', 'Larasati', '', 'BELUM MENIKAH', 'Medan', '1995-08-06', 'Islam', 'Satpam', '170', '75', 'Jawa', 'Medan', '061222222', 'SMK', 'Satpam BCA Mongonsidi', 'Ada', 'a61dfdd863ea0dbce6325450ae57b04b.png', '05-08-2021 11:06:54admin', NULL, NULL),
('27', '1271034711970001', 'Al Azmi', '', 'BELUM MENIKAH', 'Medan', '1996-11-07', 'Islam', 'Satpam', '170', '80', 'Jawa', 'Medan maimun', '081774124643', 'S1', '-', '-', 'ddbd8b87b0fc56b70c9cb5412af099bd.png', '26-08-2021 12:00:35admin', NULL, NULL),
('KRYW202109010002', '1271034711930005', 'Sunandar Astri', '', 'BELUM MENIKAH', 'Medan', '1993-09-15', 'Islam', 'Satpam', '170', '75', 'Jawa', 'Medan Marelan Jl JALA IX', '0611111111', 'SMA', '-', '-', 'c7fb0b67c22f3ce715efcdcaf9c3dcf0.png', '01-09-2021 10:57:57-admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `logs`
--

CREATE TABLE `logs` (
  `id_log` int(11) NOT NULL,
  `log` longtext NOT NULL,
  `user` varchar(128) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `logs`
--

INSERT INTO `logs` (`id_log`, `log`, `user`, `date`) VALUES
(8, 'hapus Karyawan => id : 18', 'admin', '2021-07-22 17:27:24'),
(9, 'Edit Karyawan => nik : 1207236701920002', 'admin', '2021-07-28 11:36:26'),
(10, 'hapus Karyawan => id : 2', 'admin', '2021-08-04 15:32:13'),
(11, 'hapus Karyawan => id : 3', 'admin', '2021-08-04 15:33:17'),
(12, 'hapus Karyawan => id : 1', 'admin', '2021-08-04 19:39:01'),
(13, 'Karyawan => error : <p>Silahkan pilih foto terlebih dahulu.</p>', 'admin', '2021-08-05 11:06:38'),
(14, 'Tambah Karyawan => nik : 1271034711970003', 'admin', '2021-08-05 11:06:54'),
(15, 'Karyawan => error : <p>Silahkan pilih foto terlebih dahulu.</p>', 'admin', '2021-08-26 12:00:07'),
(16, 'Tambah Karyawan => nik : 1271034711970001', 'admin', '2021-08-26 12:00:35'),
(17, 'Tambah Karyawan => nik : 1271034711930005', 'admin', '2021-09-01 10:57:57'),
(18, 'tambah Absensi => id_karyawan : 26', 'admin', '2021-09-01 14:52:15'),
(19, 'hapus Absensi => id : ABSN202109010003', 'admin', '2021-09-01 14:57:14'),
(20, 'hapus Absensi => id : ABSN202109010002', 'admin', '2021-09-01 14:58:12'),
(21, 'tambah Absensi => id_karyawan : 26', 'admin', '2021-09-01 15:57:08'),
(22, 'edit Absensi => id_karyawan : 27', 'admin', '2021-09-01 16:08:49'),
(23, 'edit Absensi => id_karyawan : 27', 'admin', '2021-09-01 16:08:54'),
(24, 'edit Absensi => id_karyawan : 27', 'admin', '2021-09-01 18:26:00'),
(25, 'edit Absensi => id_karyawan : 1', 'admin', '2021-09-01 18:27:07'),
(26, 'tambah Absensi => id_karyawan : 0', 'admin', '2021-09-01 18:30:48'),
(27, 'tambah Absensi => id_karyawan : KRYW202109010002', 'admin', '2021-09-01 18:33:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `outlet`
--

CREATE TABLE `outlet` (
  `id_outlet` varchar(16) NOT NULL,
  `nama_outlet` varchar(500) NOT NULL,
  `shift_outlet` varchar(128) DEFAULT NULL,
  `b_spkwt` varchar(25) DEFAULT NULL,
  `g_pkk` double DEFAULT NULL,
  `t_jbt` double DEFAULT NULL,
  `t_trans` double DEFAULT NULL,
  `t_ot` double DEFAULT NULL,
  `lhk` double NOT NULL,
  `lbu` double NOT NULL,
  `llr` double NOT NULL,
  `jst` double NOT NULL,
  `dpst` double NOT NULL,
  `srg` double NOT NULL,
  `bpdd` double NOT NULL,
  `dab` double NOT NULL,
  `diz` double NOT NULL,
  `dis` double NOT NULL,
  `lain` double NOT NULL,
  `created` varchar(128) NOT NULL,
  `edited` varchar(128) NOT NULL,
  `deleted` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `outlet`
--

INSERT INTO `outlet` (`id_outlet`, `nama_outlet`, `shift_outlet`, `b_spkwt`, `g_pkk`, `t_jbt`, `t_trans`, `t_ot`, `lhk`, `lbu`, `llr`, `jst`, `dpst`, `srg`, `bpdd`, `dab`, `diz`, `dis`, `lain`, `created`, `edited`, `deleted`) VALUES
('OUTL202108260001', 'BCA Juanda', '2', NULL, 2000000, 1, 1, 250000, 1, 1, 1, 0, 1, 1, 1, 0, 11, 1, 1, '04-08-2021 19:58:35', '26-08-2021 10:06:17admin', NULL),
('OUTL202108260002', 'Mandiri Juanda', '2', NULL, 3000000, 1000000, 250000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '26-08-2021 10:05:52admin', '', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `outlet_detail`
--

CREATE TABLE `outlet_detail` (
  `id_outletdetail` int(11) NOT NULL,
  `id_outlet` varchar(16) NOT NULL,
  `id_karyawan` varchar(16) NOT NULL,
  `shift_karyawan` varchar(128) NOT NULL,
  `created` varchar(128) NOT NULL,
  `edited` varchar(128) NOT NULL,
  `deleted` varchar(128) DEFAULT NULL,
  `user` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `outlet_detail`
--

INSERT INTO `outlet_detail` (`id_outletdetail`, `id_outlet`, `id_karyawan`, `shift_karyawan`, `created`, `edited`, `deleted`, `user`) VALUES
(1, 'OUTL202108260001', '1', '2', '05-08-2021 10:21:58admin', '08-08-2021 16:41:12admin', NULL, ''),
(2, 'OUTL202108260001', '26', '2', '05-08-2021 11:35:46admin', '05-08-2021 11:48:57admin', NULL, ''),
(3, 'OUTL202108260002', '27', '2', '26-08-2021 12:00:51admin', '', NULL, ''),
(4, 'OUTL202108260001', 'KRYW202109010002', '2', '01-09-2021 18:30:24-admin', '', NULL, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting_default`
--

CREATE TABLE `setting_default` (
  `shift_outlet` varchar(128) DEFAULT NULL,
  `b_spkwt` varchar(25) DEFAULT NULL,
  `g_pkk` double DEFAULT NULL,
  `t_jbt` double DEFAULT NULL,
  `t_trans` double DEFAULT NULL,
  `t_ot` double DEFAULT NULL,
  `lhk` double NOT NULL,
  `lbu` double NOT NULL,
  `llr` double NOT NULL,
  `jst` double NOT NULL,
  `dpst` double NOT NULL,
  `srg` double NOT NULL,
  `bpdd` double NOT NULL,
  `dab` double NOT NULL,
  `diz` double NOT NULL,
  `dis` double NOT NULL,
  `lain` double NOT NULL,
  `created` varchar(128) NOT NULL,
  `edited` varchar(128) NOT NULL,
  `deleted` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `setting_default`
--

INSERT INTO `setting_default` (`shift_outlet`, `b_spkwt`, `g_pkk`, `t_jbt`, `t_trans`, `t_ot`, `lhk`, `lbu`, `llr`, `jst`, `dpst`, `srg`, `bpdd`, `dab`, `diz`, `dis`, `lain`, `created`, `edited`, `deleted`) VALUES
('2', NULL, 3200000, 200000, 150000, 250000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '26-08-2021 11:26:58admin', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `level` enum('Admin','Dokter','Pegawai') NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `level`, `status`, `created_date`) VALUES
(1, 'Al azmi', 'admin', 'admin', 'Admin', 'Aktif', '2021-08-04 13:10:24');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indeks untuk tabel `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `outlet`
--
ALTER TABLE `outlet`
  ADD PRIMARY KEY (`id_outlet`);

--
-- Indeks untuk tabel `outlet_detail`
--
ALTER TABLE `outlet_detail`
  ADD PRIMARY KEY (`id_outletdetail`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `logs`
--
ALTER TABLE `logs`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `outlet_detail`
--
ALTER TABLE `outlet_detail`
  MODIFY `id_outletdetail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

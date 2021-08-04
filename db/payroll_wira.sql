-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Jul 2021 pada 10.28
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
(1, 'Satpam', '28-07-2021 11:14:00', '28-07-2021 11:20:23', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
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
(1, '1207236701920002', 'JULI WARDANI', 'PEREMPUAN', 'BELUM MENIKAH', 'SEI SEMAYANG', '1992-01-27', 'ISLAM', 'Satpam', '158', '72', 'JAWA', 'DUSUN I AMAN DAMAI', '081910999176', 'SMA NEGERI 1 SUNGGAL TAMAT TAHUN 2010', 'SATPAM DI HOME CENTRAL TAHUN 2010 S/D TAHUN 2011', 'GADA PRATAMA TAHUN 2010', 'default.png', '2021-07-19 13:23:49', '28-07-2021 11:36:26', NULL);

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
(9, 'Edit Karyawan => nik : 1207236701920002', 'admin', '2021-07-28 11:36:26');

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
(1, 'Sontina', 'admin', 'admin', 'Admin', 'Aktif', '2021-04-17 15:36:58');

--
-- Indexes for dumped tables
--

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
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `logs`
--
ALTER TABLE `logs`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

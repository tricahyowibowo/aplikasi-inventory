-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Mar 2024 pada 10.01
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asset_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(15) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `prodi` varchar(40) DEFAULT NULL,
  `qr_code` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `prodi`, `qr_code`) VALUES
('123', 'Tri Cahya Wibawa', 'Sistem Informasi', '123.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `spesifikasi_barang` text NOT NULL,
  `divisi_id` varchar(50) NOT NULL,
  `tgl_pembelian` date DEFAULT NULL,
  `stok_barang_normal` int(11) NOT NULL,
  `stok_barang_dipinjam` int(11) NOT NULL DEFAULT 0,
  `stok_barang_rusak` int(11) NOT NULL DEFAULT 0,
  `keterangan_barang` int(11) NOT NULL,
  `qrcode_barang` varchar(50) NOT NULL,
  `status_barang` varchar(50) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_barang`
--

INSERT INTO `tbl_barang` (`id_barang`, `nama_barang`, `spesifikasi_barang`, `divisi_id`, `tgl_pembelian`, `stok_barang_normal`, `stok_barang_dipinjam`, `stok_barang_rusak`, `keterangan_barang`, `qrcode_barang`, `status_barang`, `userId`) VALUES
(1, 'headset', 'logitec 234 with mic', '4', '2024-03-01', 9, 3, 0, 2, 'barang_1.png', '', 1),
(2, 'hape vivo', '', '3', '2024-03-12', 10, 0, 0, 2, 'barang_2.png', '', 1),
(3, 'Remote AC prosteo', '', '4', '2024-03-02', 1, 0, 0, 2, 'barang_3.png', '', 1),
(4, 'Remote AC Aula', 'ada 3 jenis remote', '4', '2024-03-02', 1, 0, 0, 2, 'barang_4.png', '', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_divisi`
--

CREATE TABLE `tbl_divisi` (
  `id_divisi` int(11) NOT NULL,
  `nama_divisi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_divisi`
--

INSERT INTO `tbl_divisi` (`id_divisi`, `nama_divisi`) VALUES
(2, 'MARKETING'),
(3, 'IT'),
(4, 'HRD'),
(5, 'KEUANGAN'),
(6, 'HRGA'),
(7, 'HRBP'),
(8, 'PROMOSI');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kendaraan`
--

CREATE TABLE `tbl_kendaraan` (
  `id_kendaraan` int(11) NOT NULL,
  `jenis_kendaraan` varchar(20) NOT NULL,
  `merek_kendaraan` varchar(20) NOT NULL,
  `nomor_polisi` varchar(20) NOT NULL,
  `tgl_stnk` date NOT NULL,
  `tahun` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_kendaraan`
--

INSERT INTO `tbl_kendaraan` (`id_kendaraan`, `jenis_kendaraan`, `merek_kendaraan`, `nomor_polisi`, `tgl_stnk`, `tahun`, `status`) VALUES
(1, 'mobil', 'CHEVROLET SPIN', 'AB 1029 UN', '2023-02-27', '2014', ''),
(2, 'mobil', 'MERCEDES BENZ/S 320', 'AB 1105 CZ', '2023-10-22', '2003', ''),
(3, 'montor', 'HONDA VARIO BIRU ', 'AB 2960 NI', '2023-08-06', '2012', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kerusakan_barang`
--

CREATE TABLE `tbl_kerusakan_barang` (
  `id_kerusakan_barang` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `jml_barang` int(11) NOT NULL,
  `keterangan_kerusakan_barang` text NOT NULL,
  `bukti_kerusakan_barang` varchar(50) NOT NULL,
  `datecreated` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `is_read` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kerusakan_ruangan`
--

CREATE TABLE `tbl_kerusakan_ruangan` (
  `id_kerusakan_ruangan` int(11) NOT NULL,
  `ruangan_id` int(11) NOT NULL,
  `keterangan_kerusakan_ruangan` text NOT NULL,
  `bukti_kerusakan_ruangan` varchar(255) NOT NULL,
  `is_read` int(11) NOT NULL DEFAULT 0,
  `datecreated` datetime NOT NULL,
  `tgl_penanganan` date DEFAULT NULL,
  `keterangan_penanganan` text DEFAULT NULL,
  `status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penanganan_barang`
--

CREATE TABLE `tbl_penanganan_barang` (
  `id_penanganan_barang` int(11) NOT NULL,
  `kerusakan_barang_id` int(11) NOT NULL,
  `tgl_penanganan` date NOT NULL,
  `keterangan_penanganan` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penanganan_ruangan`
--

CREATE TABLE `tbl_penanganan_ruangan` (
  `id_penanganan_ruangan` int(11) NOT NULL,
  `kerusakan_ruangan_id` int(11) NOT NULL,
  `tgl_penanganan` date NOT NULL,
  `keterangan_penanganan` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_perawatan_kendaraan`
--

CREATE TABLE `tbl_perawatan_kendaraan` (
  `id_perawatan_kendaraan` int(11) NOT NULL,
  `kendaraan_id` int(11) NOT NULL,
  `tgl_perawatan` datetime NOT NULL,
  `detail_perawatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_perawatan_kendaraan`
--

INSERT INTO `tbl_perawatan_kendaraan` (`id_perawatan_kendaraan`, `kendaraan_id`, `tgl_perawatan`, `detail_perawatan`) VALUES
(1, 1, '2024-03-14 14:09:00', 'ganti oli');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pinjam_barang`
--

CREATE TABLE `tbl_pinjam_barang` (
  `id_pinjam_barang` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `jumlah_pinjam` int(11) NOT NULL,
  `nama_pinjam_barang` varchar(50) NOT NULL,
  `divisi_id` int(11) NOT NULL,
  `tgl_mulai` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `tgl_kembali` datetime NOT NULL,
  `updateId` int(11) DEFAULT NULL,
  `tgl_update` datetime DEFAULT NULL,
  `status_pinjam_barang` varchar(20) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_pinjam_barang`
--

INSERT INTO `tbl_pinjam_barang` (`id_pinjam_barang`, `barang_id`, `jumlah_pinjam`, `nama_pinjam_barang`, `divisi_id`, `tgl_mulai`, `tgl_selesai`, `tgl_kembali`, `updateId`, `tgl_update`, `status_pinjam_barang`) VALUES
(14, 3, 1, 'tes', 3, '2024-02-15 10:19:00', '2024-02-15 11:19:00', '2024-02-15 12:19:00', 1, '2024-02-15 04:24:36', 'I'),
(15, 3, 4, 'tes', 3, '2024-02-15 11:17:00', '2024-02-15 12:18:00', '2024-02-15 11:18:00', 1, '2024-02-15 05:18:23', 'I'),
(16, 3, 1, 'tes', 3, '2024-02-15 11:22:00', '2024-02-15 12:22:00', '2024-02-15 11:23:00', 1, '2024-02-15 05:23:08', 'I'),
(17, 4, 1, 'cahyo', 3, '2024-02-16 08:35:00', '2024-02-16 09:36:00', '0000-00-00 00:00:00', NULL, NULL, 'N'),
(18, 8, 1, 'cahya', 3, '2024-02-16 08:38:00', '2024-02-16 10:38:00', '0000-00-00 00:00:00', NULL, NULL, 'N'),
(19, 9, 1, 'cahya', 3, '2024-02-16 08:43:00', '2024-02-16 09:43:00', '0000-00-00 00:00:00', NULL, NULL, 'N'),
(20, 9, 1, 'cahya', 3, '2024-02-16 08:43:00', '2024-02-16 09:43:00', '0000-00-00 00:00:00', NULL, NULL, 'N'),
(21, 3, 1, 'cahyo', 3, '2024-02-16 08:45:00', '2024-02-16 10:45:00', '0000-00-00 00:00:00', NULL, NULL, 'N'),
(22, 4, 1, 'cahyo', 3, '2024-02-16 08:45:00', '2024-02-16 10:45:00', '0000-00-00 00:00:00', NULL, NULL, 'N'),
(23, 3, 1, 'cahyo', 2, '2024-02-16 08:52:00', '2024-02-16 09:52:00', '2024-02-19 09:13:00', 1, '2024-02-19 03:13:14', 'I'),
(24, 4, 1, 'cahyo', 2, '2024-02-16 08:52:00', '2024-02-16 09:52:00', '0000-00-00 00:00:00', NULL, NULL, 'N'),
(25, 4, 1, 'cahyo', 3, '2024-02-16 08:54:00', '2024-02-16 10:55:00', '0000-00-00 00:00:00', NULL, NULL, 'N'),
(26, 1, 1, 'tes', 3, '2024-03-13 15:15:00', '2024-03-13 16:15:00', '2024-03-14 08:26:00', 1, '2024-03-14 08:26:12', 'I'),
(27, 2, 1, 'cahyo', 3, '2024-03-13 16:27:00', '2024-03-13 17:27:00', '2024-03-14 08:26:00', 1, '2024-03-14 08:26:20', 'I'),
(28, 2, 1, 'cahyo', 3, '2024-03-13 16:27:00', '2024-03-13 17:27:00', '2024-03-14 08:26:00', 1, '2024-03-14 08:26:29', 'I'),
(29, 2, 1, 'tes', 3, '2024-03-13 16:28:00', '2024-03-13 17:28:00', '2024-03-14 08:26:00', 1, '2024-03-14 08:26:38', 'I'),
(30, 2, 1, 'tes', 3, '2024-03-13 16:34:00', '2024-03-13 17:34:00', '2024-03-14 08:26:00', 1, '2024-03-14 08:26:47', 'I'),
(31, 2, 1, 'cahyo', 3, '2024-03-14 08:49:00', '2024-03-14 08:49:00', '2024-03-14 08:50:00', 1, '2024-03-14 08:50:13', 'I'),
(32, 2, 1, 'cahyo', 3, '2024-03-14 08:52:00', '2024-03-14 08:52:00', '2024-03-14 08:52:00', 1, '2024-03-14 09:02:06', 'I'),
(33, 2, 1, 'cahyo', 3, '2024-03-14 09:02:00', '2024-03-14 09:02:00', '2024-03-14 09:03:00', 1, '2024-03-14 09:03:11', 'I'),
(34, 2, 1, 'cahyo', 3, '2024-03-14 09:04:00', '2024-03-14 10:04:00', '2024-03-14 09:04:00', 1, '2024-03-14 09:05:44', 'I'),
(35, 2, 1, 'cahyo', 3, '2024-03-15 12:32:00', '2024-03-15 12:33:00', '2024-03-15 14:54:00', 1, '2024-03-15 14:54:25', 'I'),
(36, 2, 1, 'tes', 4, '2024-03-15 12:34:00', '2024-03-15 13:34:00', '2024-03-15 14:54:00', 1, '2024-03-15 14:54:42', 'I'),
(37, 2, 1, 'tes', 3, '2024-03-15 12:35:00', '2024-03-15 13:35:00', '2024-03-15 14:54:00', 1, '2024-03-15 14:54:53', 'I'),
(38, 1, 1, 'tes', 3, '2024-03-15 12:41:00', '2024-03-15 13:41:00', '2024-03-15 14:54:00', 1, '2024-03-15 14:54:14', 'I');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pinjam_ruangan`
--

CREATE TABLE `tbl_pinjam_ruangan` (
  `id_pinjam_ruangan` int(11) NOT NULL,
  `ruangan_id` int(11) NOT NULL,
  `nama_pinjam_ruangan` varchar(50) NOT NULL,
  `divisi_id` int(11) NOT NULL,
  `tgl_mulai` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `keterangan_pinjam` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_pinjam_ruangan`
--

INSERT INTO `tbl_pinjam_ruangan` (`id_pinjam_ruangan`, `ruangan_id`, `nama_pinjam_ruangan`, `divisi_id`, `tgl_mulai`, `tgl_selesai`, `keterangan_pinjam`) VALUES
(1, 14, 'Cahyo', 3, '2024-02-07 09:14:26', '2024-02-08 15:14:26', 'meeting'),
(2, 14, 'kasidi', 3, '2024-02-09 15:48:00', '2024-02-09 16:48:00', 'ada deh'),
(3, 2, 'cahyo', 3, '2024-03-13 12:26:00', '2024-03-14 12:26:00', 'testing');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_reset_password`
--

CREATE TABLE `tbl_reset_password` (
  `id` bigint(20) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activation_id` varchar(32) NOT NULL,
  `agent` varchar(512) NOT NULL,
  `client_ip` varchar(32) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `createdBy` bigint(20) NOT NULL DEFAULT 1,
  `createdDtm` datetime NOT NULL,
  `updatedBy` bigint(20) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `roleId` tinyint(4) NOT NULL COMMENT 'role id',
  `role` varchar(50) NOT NULL COMMENT 'role text'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_roles`
--

INSERT INTO `tbl_roles` (`roleId`, `role`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(3, 'Manager'),
(5, 'HRD'),
(4, 'Admin Pool');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ruangan`
--

CREATE TABLE `tbl_ruangan` (
  `id_ruangan` int(11) NOT NULL,
  `nama_ruangan` varchar(50) NOT NULL,
  `kondisi_ruangan` varchar(50) NOT NULL,
  `keterangan_ruangan` longtext NOT NULL,
  `qrcode_ruangan` varchar(50) NOT NULL,
  `status_ruangan` varchar(50) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_ruangan`
--

INSERT INTO `tbl_ruangan` (`id_ruangan`, `nama_ruangan`, `kondisi_ruangan`, `keterangan_ruangan`, `qrcode_ruangan`, `status_ruangan`, `userId`) VALUES
(1, 'ruangan prosteo', 'baik', '', 'ruangan_1.png', '', 1),
(2, 'ruangan aula', 'baik', '', 'ruangan_2.png', '', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userId` int(11) NOT NULL,
  `username` varchar(128) NOT NULL COMMENT 'login username',
  `email` varchar(255) NOT NULL,
  `password` varchar(128) NOT NULL COMMENT 'hashed login password',
  `name` varchar(128) DEFAULT NULL COMMENT 'full name of user',
  `divisi_id` varchar(20) DEFAULT NULL,
  `roleId` tinyint(4) NOT NULL,
  `hash_key` varchar(255) DEFAULT NULL,
  `hash_expiry` varchar(255) DEFAULT NULL,
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_users`
--

INSERT INTO `tbl_users` (`userId`, `username`, `email`, `password`, `name`, `divisi_id`, `roleId`, `hash_key`, `hash_expiry`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(1, 'admin', '', '$2y$10$xU7ZxIf.x.pmQ/t7hsy8bOokS0T1ODlCmZtYfM67qsHGzG7xa7LgG', 'Super Admin', '0', 1, '979fdd7f25f6eb247050fddd4fe63eef3c17209bb916112adf4bb13f088b0b21', '2023-10-21 05:31', 0, '2023-08-03 03:22:47', 1, '2024-03-19 15:48:02'),
(2, 'hrd', '', '$2y$10$.AOuu5pRsW3fQIgVj1z.9OHLaFqzi4s8m5JnL6oyCxeOrBZDXBWXe', 'Hrd Mirota Ksm', '4', 5, NULL, NULL, 1, '2024-03-05 11:36:17', 1, '2024-03-19 15:51:26'),
(3, 'manager', 'itmirota@gmail.com', '$2y$10$.Lxj5ubvGSQOAhg/sidYCe3lDqfTz6acyCmeyvZWs1dDJ.p6DemHW', 'Manager', '0', 3, NULL, NULL, 1, '2024-03-19 15:47:23', NULL, NULL),
(4, 'adminpool', 'itmirota@gmail.com', '$2y$10$30DgHpP.PDTdce9b6dRzTO5iotd5dSkmG26jjzAmR6bUrnauhP4FS', 'Adminpool', '0', 4, NULL, NULL, 1, '2024-03-19 15:46:50', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indeks untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `tbl_divisi`
--
ALTER TABLE `tbl_divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indeks untuk tabel `tbl_kendaraan`
--
ALTER TABLE `tbl_kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`);

--
-- Indeks untuk tabel `tbl_kerusakan_barang`
--
ALTER TABLE `tbl_kerusakan_barang`
  ADD PRIMARY KEY (`id_kerusakan_barang`);

--
-- Indeks untuk tabel `tbl_kerusakan_ruangan`
--
ALTER TABLE `tbl_kerusakan_ruangan`
  ADD PRIMARY KEY (`id_kerusakan_ruangan`);

--
-- Indeks untuk tabel `tbl_penanganan_barang`
--
ALTER TABLE `tbl_penanganan_barang`
  ADD PRIMARY KEY (`id_penanganan_barang`);

--
-- Indeks untuk tabel `tbl_penanganan_ruangan`
--
ALTER TABLE `tbl_penanganan_ruangan`
  ADD PRIMARY KEY (`id_penanganan_ruangan`);

--
-- Indeks untuk tabel `tbl_perawatan_kendaraan`
--
ALTER TABLE `tbl_perawatan_kendaraan`
  ADD PRIMARY KEY (`id_perawatan_kendaraan`);

--
-- Indeks untuk tabel `tbl_pinjam_barang`
--
ALTER TABLE `tbl_pinjam_barang`
  ADD PRIMARY KEY (`id_pinjam_barang`);

--
-- Indeks untuk tabel `tbl_pinjam_ruangan`
--
ALTER TABLE `tbl_pinjam_ruangan`
  ADD PRIMARY KEY (`id_pinjam_ruangan`);

--
-- Indeks untuk tabel `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`roleId`);

--
-- Indeks untuk tabel `tbl_ruangan`
--
ALTER TABLE `tbl_ruangan`
  ADD PRIMARY KEY (`id_ruangan`);

--
-- Indeks untuk tabel `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_barang`
--
ALTER TABLE `tbl_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_divisi`
--
ALTER TABLE `tbl_divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_kendaraan`
--
ALTER TABLE `tbl_kendaraan`
  MODIFY `id_kendaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_kerusakan_barang`
--
ALTER TABLE `tbl_kerusakan_barang`
  MODIFY `id_kerusakan_barang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_kerusakan_ruangan`
--
ALTER TABLE `tbl_kerusakan_ruangan`
  MODIFY `id_kerusakan_ruangan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_penanganan_barang`
--
ALTER TABLE `tbl_penanganan_barang`
  MODIFY `id_penanganan_barang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_penanganan_ruangan`
--
ALTER TABLE `tbl_penanganan_ruangan`
  MODIFY `id_penanganan_ruangan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_perawatan_kendaraan`
--
ALTER TABLE `tbl_perawatan_kendaraan`
  MODIFY `id_perawatan_kendaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_pinjam_barang`
--
ALTER TABLE `tbl_pinjam_barang`
  MODIFY `id_pinjam_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `tbl_pinjam_ruangan`
--
ALTER TABLE `tbl_pinjam_ruangan`
  MODIFY `id_pinjam_ruangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `roleId` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'role id', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_ruangan`
--
ALTER TABLE `tbl_ruangan`
  MODIFY `id_ruangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

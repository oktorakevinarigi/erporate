-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 23 Feb 2018 pada 07.07
-- Versi Server: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erporate`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jenis_kelamin` enum('Pria','Wanita') DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama`, `jenis_kelamin`, `jabatan`, `no_hp`, `alamat`) VALUES
(3, 'Ahmad', 'Pria', 'Programmer', '085xxxx', 'Jalan 1'),
(4, 'Lutfi', 'Pria', 'Analisis', '0878xxx', 'Jalan 2'),
(5, 'Sidiq', 'Pria', 'Android Dev', '0823xxx', 'Jalan 3'),
(6, 'Nadia', 'Wanita', 'Bisnis Develop', '0857xxx', 'Jalan 4'),
(21, 'Erik', 'Pria', 'Programmer', '087739253441', 'Yogyakarta');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kehadiran`
--

CREATE TABLE `kehadiran` (
  `id_kehadiran` int(11) NOT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `tgl` varchar(50) DEFAULT NULL,
  `jam_dtg` time DEFAULT NULL,
  `jam_plg` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kehadiran`
--

INSERT INTO `kehadiran` (`id_kehadiran`, `id_karyawan`, `tgl`, `jam_dtg`, `jam_plg`) VALUES
(1, 3, 'Senin, 19 Februari 2018', '07:30:00', '16:00:00'),
(2, 3, 'Selasa, 20 Februari 2018', '08:00:00', '16:30:00'),
(3, 6, 'Senin, 19 Februari 2018', '07:50:00', '17:00:00'),
(4, 4, 'Senin, 19 Februari 2018', '08:10:00', '17:30:00'),
(18, 21, 'Jumat, 23 Februari 2018', '12:56:48', '12:57:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kehadiran_karyawan`
--

CREATE TABLE `kehadiran_karyawan` (
  `id_kehadiran_karyawan` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `id_kehadiran` int(11) NOT NULL,
  `jam_kerja` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kehadiran_karyawan`
--

INSERT INTO `kehadiran_karyawan` (`id_kehadiran_karyawan`, `id_karyawan`, `id_kehadiran`, `jam_kerja`) VALUES
(2, 3, 1, '08:30:00'),
(5, 3, 2, '08:30:00'),
(6, 6, 3, '07:10:00'),
(7, 4, 4, '07:20:00'),
(10, 21, 17, '08:20:00'),
(11, 21, 18, '13:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD PRIMARY KEY (`id_kehadiran`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- Indexes for table `kehadiran_karyawan`
--
ALTER TABLE `kehadiran_karyawan`
  ADD PRIMARY KEY (`id_kehadiran_karyawan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `kehadiran`
--
ALTER TABLE `kehadiran`
  MODIFY `id_kehadiran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `kehadiran_karyawan`
--
ALTER TABLE `kehadiran_karyawan`
  MODIFY `id_kehadiran_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD CONSTRAINT `kehadiran_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

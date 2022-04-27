-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2022 at 02:39 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tasnanta`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nm_kriteria` varchar(100) NOT NULL,
  `j_kriteria` varchar(100) NOT NULL,
  `bobot_kriteria` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`id_kriteria`, `nm_kriteria`, `j_kriteria`, `bobot_kriteria`) VALUES
(1, 'Pengunjung', 'Cost', 50),
(2, 'Listrik', 'Benefit', 20),
(3, 'Toilet', 'Cost', 20),
(17, 'Mushola', 'Cost', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tb_level`
--

CREATE TABLE `tb_level` (
  `id_level` int(11) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_level`
--

INSERT INTO `tb_level` (`id_level`, `level`) VALUES
(1, 'dinas'),
(2, 'desa');

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai`
--

CREATE TABLE `tb_nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_pariwisata` int(11) NOT NULL,
  `kriteria_id` int(11) NOT NULL,
  `id_subkriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_nilai`
--

INSERT INTO `tb_nilai` (`id_nilai`, `id_pariwisata`, `kriteria_id`, `id_subkriteria`) VALUES
(1, 1, 1, 2),
(2, 1, 2, 2),
(3, 1, 17, 2),
(4, 1, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pariwisata`
--

CREATE TABLE `tb_pariwisata` (
  `id_pariwisata` int(11) NOT NULL,
  `id_subkriteria` int(100) NOT NULL,
  `nm_pariwisata` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pariwisata`
--

INSERT INTO `tb_pariwisata` (`id_pariwisata`, `id_subkriteria`, `nm_pariwisata`, `alamat`, `id_status`) VALUES
(1, 0, 'Wisata A', 'Madiun', 1),
(2, 0, 'Wisata B', 'Mejayan', 0),
(6, 3, 'wisata a', 'madiun', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_status`
--

CREATE TABLE `tb_status` (
  `id_status` int(11) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_status`
--

INSERT INTO `tb_status` (`id_status`, `status`) VALUES
(0, 'Tidak Valid'),
(1, 'Valid');

-- --------------------------------------------------------

--
-- Table structure for table `tb_subkriteria`
--

CREATE TABLE `tb_subkriteria` (
  `id_subkriteria` int(11) NOT NULL,
  `nm_subkriteria` varchar(100) NOT NULL,
  `nilai` int(50) NOT NULL,
  `id_kriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_subkriteria`
--

INSERT INTO `tb_subkriteria` (`id_subkriteria`, `nm_subkriteria`, `nilai`, `id_kriteria`) VALUES
(1, 'Sedikit', 1, 1),
(2, 'Sedang', 2, 1),
(3, 'Banyak', 3, 1),
(4, 'Banyak', 1, 2),
(7, 'Banyak', 1, 3),
(8, 'Sedang', 2, 2),
(9, 'Sedikit', 3, 2),
(10, 'Sedang', 2, 3),
(11, 'Sedikit', 3, 3),
(12, 'Sedikit', 3, 17),
(13, 'Banyak', 1, 17),
(14, 'Sedang', 2, 17),
(15, 'Tidak Ada', 0, 17);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telp` varchar(50) NOT NULL,
  `id_level` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `email`, `password`, `telp`, `id_level`, `foto`) VALUES
(1, 'Administrator 2', 'dinas@gmail.com', '$2y$10$BjleS28kVcRaWUvTGXexmOKXyOfsAEzeLo1I1B0JYA0PY5kaqwe9G', '083874858555', 1, 'default.png'),
(2, 'Administrator', 'dispar@yahoo.com', '$2y$10$pdCMJFxeXplplkjfPcVhve3FRVQdUEsyr.qb1a2GkaEZXV28CFCBi', '087834528312', 1, 'default.png'),
(3, 'Madiun', 'madiun@gmail.com', '$2y$10$BjleS28kVcRaWUvTGXexmOKXyOfsAEzeLo1I1B0JYA0PY5kaqwe9G', '087834858871', 2, 'jennn.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `tb_level`
--
ALTER TABLE `tb_level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `kriteria_id` (`kriteria_id`),
  ADD KEY `id_pariwisata` (`id_pariwisata`),
  ADD KEY `id_subkriteria` (`id_subkriteria`);

--
-- Indexes for table `tb_pariwisata`
--
ALTER TABLE `tb_pariwisata`
  ADD PRIMARY KEY (`id_pariwisata`),
  ADD KEY `id_status` (`id_status`);

--
-- Indexes for table `tb_status`
--
ALTER TABLE `tb_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `tb_subkriteria`
--
ALTER TABLE `tb_subkriteria`
  ADD PRIMARY KEY (`id_subkriteria`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_level` (`id_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_pariwisata`
--
ALTER TABLE `tb_pariwisata`
  MODIFY `id_pariwisata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_subkriteria`
--
ALTER TABLE `tb_subkriteria`
  MODIFY `id_subkriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  ADD CONSTRAINT `tb_nilai_ibfk_1` FOREIGN KEY (`kriteria_id`) REFERENCES `tb_kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_nilai_ibfk_2` FOREIGN KEY (`id_pariwisata`) REFERENCES `tb_pariwisata` (`id_pariwisata`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_nilai_ibfk_3` FOREIGN KEY (`id_subkriteria`) REFERENCES `tb_subkriteria` (`id_subkriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pariwisata`
--
ALTER TABLE `tb_pariwisata`
  ADD CONSTRAINT `tb_pariwisata_ibfk_1` FOREIGN KEY (`id_status`) REFERENCES `tb_status` (`id_status`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_subkriteria`
--
ALTER TABLE `tb_subkriteria`
  ADD CONSTRAINT `tb_subkriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `tb_kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `tb_level` (`id_level`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

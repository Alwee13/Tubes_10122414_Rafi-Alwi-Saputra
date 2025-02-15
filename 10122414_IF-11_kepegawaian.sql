-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2025 at 11:53 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mysql_if-11_kepegawaian`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetPegawaiByJabatan` (IN `jabatan_id` INT)   BEGIN
    SELECT * FROM Pegawai WHERE jabatan_id = jabatan_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `nama_jabatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `nama_jabatan`) VALUES
(1, 'Manager'),
(2, 'Supervisor'),
(3, 'Staff'),
(4, 'HRD'),
(5, 'IT Junior'),
(6, 'IT Senior'),
(8, 'Direktur');

--
-- Triggers `jabatan`
--
DELIMITER $$
CREATE TRIGGER `after_jabatan_delete` AFTER DELETE ON `jabatan` FOR EACH ROW BEGIN
    INSERT INTO jabatan_Log (jabatan_id, action) VALUES (OLD.id, 'DELETE');
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_jabatan_insert` AFTER INSERT ON `jabatan` FOR EACH ROW BEGIN
    INSERT INTO jabatan_Log (jabatan_id, action) VALUES (NEW.id, 'INSERT');
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_jabatan_update` AFTER UPDATE ON `jabatan` FOR EACH ROW BEGIN
    INSERT INTO jabatan_Log (jabatan_id, action) VALUES (NEW.id, 'UPDATE');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `jabatan_log`
--

CREATE TABLE `jabatan_log` (
  `id` int(11) NOT NULL,
  `jabatan_id` int(11) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jabatan_log`
--

INSERT INTO `jabatan_log` (`id`, `jabatan_id`, `action`, `timestamp`) VALUES
(1, 6, 'INSERT', '2025-02-09 12:55:03'),
(2, 5, 'UPDATE', '2025-02-09 13:01:45'),
(3, 7, 'INSERT', '2025-02-14 08:51:49'),
(4, 7, 'UPDATE', '2025-02-14 08:51:58'),
(5, 7, 'UPDATE', '2025-02-14 08:52:06'),
(6, 7, 'DELETE', '2025-02-14 08:56:29'),
(7, 8, 'INSERT', '2025-02-14 08:56:41');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `jabatan_id` int(11) DEFAULT NULL,
  `gaji` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `nama`, `jenis_kelamin`, `alamat`, `telepon`, `jabatan_id`, `gaji`) VALUES
(1, 'Rafi Alwi Saputra', 'L', 'Jl. Rajamandala No. 123', '0869696969', 1, 15000000.00),
(4, 'Chelsea Van Meijr', 'P', 'Jl. Merdeka No. 69', '08123456789', 5, 7000000.00),
(5, 'Kang Haerin', 'P', 'Jl. Tadika Mesra No. 69', '08987654321', 4, 8500000.00),
(8, 'Irene', 'P', 'Jl. Mana Ya No. 69', '08987654321', 8, 20000000.00),
(9, 'Ujang Garpu', 'L', 'Jl. Jalan Aja No. 13', '08924234231', 4, 9000000.00);

--
-- Triggers `pegawai`
--
DELIMITER $$
CREATE TRIGGER `after_pegawai_delete` AFTER DELETE ON `pegawai` FOR EACH ROW BEGIN
    INSERT INTO Pegawai_Log (pegawai_id, action) VALUES (OLD.id, 'DELETE');
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_pegawai_insert` AFTER INSERT ON `pegawai` FOR EACH ROW BEGIN
    INSERT INTO Pegawai_Log (pegawai_id, action) VALUES (NEW.id, 'INSERT');
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_pegawai_update` AFTER UPDATE ON `pegawai` FOR EACH ROW BEGIN
    INSERT INTO Pegawai_Log (pegawai_id, action) VALUES (NEW.id, 'UPDATE');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai_log`
--

CREATE TABLE `pegawai_log` (
  `id` int(11) NOT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai_log`
--

INSERT INTO `pegawai_log` (`id`, `pegawai_id`, `action`, `timestamp`) VALUES
(1, 1, 'INSERT', '2025-02-09 10:35:38'),
(2, 1, 'UPDATE', '2025-02-09 10:40:50'),
(3, 2, 'INSERT', '2025-02-09 10:43:26'),
(4, 2, 'DELETE', '2025-02-09 10:43:39'),
(5, 3, 'INSERT', '2025-02-09 11:03:11'),
(6, 3, 'DELETE', '2025-02-09 11:03:14'),
(7, 4, 'INSERT', '2025-02-09 11:53:59'),
(8, 1, 'UPDATE', '2025-02-09 12:36:19'),
(9, 1, 'UPDATE', '2025-02-13 09:31:34'),
(10, 4, 'UPDATE', '2025-02-13 09:31:55'),
(11, 5, 'INSERT', '2025-02-13 09:36:56'),
(12, 6, 'INSERT', '2025-02-14 08:34:11'),
(13, 6, 'DELETE', '2025-02-14 08:39:41'),
(14, 5, 'UPDATE', '2025-02-14 08:49:49'),
(15, 7, 'INSERT', '2025-02-14 08:50:39'),
(16, 7, 'DELETE', '2025-02-14 08:52:12'),
(17, 8, 'INSERT', '2025-02-14 08:57:07'),
(18, 9, 'INSERT', '2025-02-14 10:13:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `username`, `password`, `email`, `created_at`) VALUES
(1, 'pengguna', 'pengguna', 'pengguna@gmail.com', '2025-02-08 14:23:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan_log`
--
ALTER TABLE `jabatan_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jabatan_id` (`jabatan_id`);

--
-- Indexes for table `pegawai_log`
--
ALTER TABLE `pegawai_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jabatan_log`
--
ALTER TABLE `jabatan_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pegawai_log`
--
ALTER TABLE `pegawai_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2023 at 09:38 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mlm`
--

-- --------------------------------------------------------

--
-- Table structure for table `achievement`
--

CREATE TABLE `achievement` (
  `idachievement` int(11) NOT NULL,
  `idpengguna` int(11) NOT NULL,
  `achievement` text NOT NULL,
  `positionpoints` varchar(255) NOT NULL,
  `technicalpoints` varchar(255) NOT NULL,
  `presentation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `idmessage` int(11) NOT NULL,
  `idpengguna` int(11) NOT NULL,
  `idtarget` int(11) NOT NULL,
  `message` text NOT NULL,
  `baca` text NOT NULL,
  `waktu` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messagedetail`
--

CREATE TABLE `messagedetail` (
  `idmessagedetail` int(11) NOT NULL,
  `idmessage` int(11) NOT NULL,
  `rolepengirim` varchar(255) NOT NULL,
  `idpengguna` int(11) NOT NULL,
  `message` text NOT NULL,
  `fotokomentar` text NOT NULL,
  `waktu` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notifuser`
--

CREATE TABLE `notifuser` (
  `idnotifuser` int(11) NOT NULL,
  `idpengguna` int(11) NOT NULL,
  `message` text NOT NULL,
  `baca` text NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `idtujuan` int(11) NOT NULL,
  `waktu` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `idpengguna` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `idsponsor` text NOT NULL,
  `nowa` text NOT NULL,
  `identerprise` text NOT NULL,
  `foto` text NOT NULL,
  `level` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`idpengguna`, `nama`, `email`, `password`, `idsponsor`, `nowa`, `identerprise`, `foto`, `level`) VALUES
(4, 'Jess', 'jess@gmail.com', '12345', '124980128042', '08491284912', '12345', 'user.jpg', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `idpeserta` int(11) NOT NULL,
  `idtarget` int(11) NOT NULL,
  `idquestion` int(11) NOT NULL,
  `idpengguna` text NOT NULL,
  `file` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `presentation`
--

CREATE TABLE `presentation` (
  `idpresentation` int(11) NOT NULL,
  `idpengguna` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `presentation` text NOT NULL,
  `status` text NOT NULL,
  `keterangan` text NOT NULL,
  `file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `idquestion` int(11) NOT NULL,
  `idtarget` int(11) NOT NULL,
  `question` text NOT NULL,
  `link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`idquestion`, `idtarget`, `question`, `link`) VALUES
(1, 1, 'Are you kidding me ?', 'https://youtube.com'),
(2, 1, 'Are you like monkey ?', 'https://localhost/pelatihanhdi'),
(3, 1, 'Are you from Wakanda', 'https://localhost/pelatihanhdi'),
(4, 1, 'Are you love Pempek', 'https://localhost/pelatihanhdi');

-- --------------------------------------------------------

--
-- Table structure for table `target`
--

CREATE TABLE `target` (
  `idtarget` int(11) NOT NULL,
  `namatarget` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `target`
--

INSERT INTO `target` (`idtarget`, `namatarget`) VALUES
(1, 'Enterprise Manager'),
(2, 'Executive Diamond'),
(3, 'Star Crown Indonesia'),
(6, 'General Badut Indonesia'),
(7, 'Sambel');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achievement`
--
ALTER TABLE `achievement`
  ADD PRIMARY KEY (`idachievement`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`idmessage`);

--
-- Indexes for table `messagedetail`
--
ALTER TABLE `messagedetail`
  ADD PRIMARY KEY (`idmessagedetail`);

--
-- Indexes for table `notifuser`
--
ALTER TABLE `notifuser`
  ADD PRIMARY KEY (`idnotifuser`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`idpengguna`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`idpeserta`);

--
-- Indexes for table `presentation`
--
ALTER TABLE `presentation`
  ADD PRIMARY KEY (`idpresentation`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`idquestion`);

--
-- Indexes for table `target`
--
ALTER TABLE `target`
  ADD PRIMARY KEY (`idtarget`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achievement`
--
ALTER TABLE `achievement`
  MODIFY `idachievement` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `idmessage` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messagedetail`
--
ALTER TABLE `messagedetail`
  MODIFY `idmessagedetail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifuser`
--
ALTER TABLE `notifuser`
  MODIFY `idnotifuser` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `idpengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `idpeserta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `presentation`
--
ALTER TABLE `presentation`
  MODIFY `idpresentation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `idquestion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `target`
--
ALTER TABLE `target`
  MODIFY `idtarget` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2024 at 05:16 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbloginuploadfile`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gambar` text NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `gambar`, `alamat`) VALUES
(21, 'user', 'user@gmail.com', '66dc3a5e82e4a.png', 'Jl. Adisucipto'),
(25, 'Edo', 'edo@gmail.com', '66dc3a322d0c2.png', 'Jl. Adisucipto'),
(26, 'gwen', 'gwen@gmail.com', '66dc3a4d9d97e.png', 'Jl. Sui Raya Dalam'),
(27, 'Jihyo', 'jh@yahoo.com', '66dc3e7c6b2cd.png', 'Jl. Mujahidin'),
(28, 'abi', 'abi@gmail.com', '66f16017e6d93.png', 'Jl. Adisucipto'),
(29, 'aldo', 'aldo@yahoo.com', '66f160351059f.png', 'Jl. Perdamaian'),
(30, 'budi', 'budi@yahoo.com', '66f1604c74b53.png', 'Jl. Adisucipto'),
(31, 'bertha', 'bertha@gmail.com', '66f16060b3230.png', 'Jl. Sui Raya Dalam'),
(32, 'charlen', 'charlen@yahoo.com', '66f1607c60bb3.png', 'Jl. Mujahidin'),
(33, 'carol', 'carol@gmail.com', '66f160966507d.png', 'Jl. Mujahidin'),
(34, 'dodi', 'dodi@yahoo.com', '66f160b2d58e0.png', 'Jl. Perdamaian'),
(35, 'devon', 'dev@gmail.com', '66f160c56e0ec.png', 'Jl. Mujahidin'),
(36, 'edo', 'edo@yahoo.com', '66f160e2d5c20.png', 'Jl. Sui Raya Dalam'),
(37, 'erica', 'erica@gmail.com', '66f160f86462f.png', 'Jl. Adisucipto');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

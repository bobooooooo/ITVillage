-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2018 at 01:50 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itvillage`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `family` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `games` int(11) DEFAULT NULL,
  `win` int(11) DEFAULT NULL,
  `lose` int(11) DEFAULT NULL,
  `coins` int(11) NOT NULL,
  `date_deleted` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `family`, `username`, `password`, `email`, `games`, `win`, `lose`, `coins`, `date_deleted`) VALUES
(5, 'test', 'test', 'test2', '$2y$10$LKLQ5Zka5x9LMHDUAF5TaOgy0PIo8ZfNwMTevgijxpyGRWGMVIoC6', 'test@abv.bg', 0, 0, 0, 0, NULL),
(6, 'Демо', 'Потребител', 'demo', '$2y$10$BchkvpLNgdncOHueaUALzOl8iMLDn6sLT9S8uXZ5ybagKkz5W6zfW', 'demo@abv.bg', 24, 23, 2, 15971, NULL),
(32, 'Borislav', 'Krastev', 'bobo', '$2y$10$uFGdUxH/5nfL7Nvv2Gz.dOuCLmgs8ajx3QaRYqLnvQzSkYK8sGX.i', 'bp.krastev@gmail.com', 24, 14, 10, 1145, NULL),
(33, 'Павел', 'Иванов ', 'pavel', '$2y$10$t4kNO5SbUAozkcf3VN8EYOEji1HMwJnHvJ9ZTEBdcVpCOsP.lBHiW', 'paco@abv.bg', 1, 1, 0, 30, NULL),
(34, 'Марио', 'Маринов', 'mario', '$2y$10$S2dRQh.gkaUZHjk/8zR20OWst1EHxmnT3sx1SXiufuIxFxkV15/gO', 'mmar@gbg.bg', 0, 0, 0, 0, NULL),
(35, 'Ivan', 'Ivanov', 'ivan', '$2y$10$omwPbk35/wsB2soL7yRVFuD3E9xVxUc6hgiDCs7Vmd0Js/OKmNn1y', 'vankata@usa.net', 6, 2, 4, 25945, NULL),
(36, 'Красимир', 'Кръстев', 'краси', '$2y$10$/gf7n9JLTMsq3l5WfE55A.TgUIhuJHAAx2KaCZzFM12R9rycLF5zO', 'kkras@mail.bg', 1, 1, 0, 290, NULL),
(37, 'Георги', 'Иванов', 'георги', '$2y$10$tjl4s.nA3OmDKlBHuEcj4uAXLB.Hb1sk23djp3OGFMKscRV1VbGY2', 'givanov@mail.bg', 1, 0, 1, 1090, NULL),
(38, 'Boryana', 'Boryana', 'boryana', '$2y$10$T5MfpblgSJTEijQaQX9I5OA.CxdgtV62tdX4DfmJgQ.5ASY9wB33y', 'boryana@abv.bg', 1, 1, 0, 35, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

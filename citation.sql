-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3000
-- Generation Time: Jun 02, 2024 at 11:09 PM
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
-- Database: `citation`
--
CREATE DATABASE IF NOT EXISTS `citation` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `citation`;

-- --------------------------------------------------------

--
-- Table structure for table `autors`
--

DROP TABLE IF EXISTS `autors`;
CREATE TABLE `autors` (
  `Id` int(11) NOT NULL,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `siecle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `autors`
--

INSERT INTO `autors` (`Id`, `nom`, `prenom`, `siecle`) VALUES
(0, 'Prophet Muhammad', '(peace be upon him)', 5),
(1, 'Shakespeare', 'William', 17),
(2, 'Austen', 'Jane', 18),
(3, 'Orwell', 'George', 21),
(4, 'enagre', 'hakim', 21);

-- --------------------------------------------------------

--
-- Table structure for table `citaion`
--

DROP TABLE IF EXISTS `citaion`;
CREATE TABLE `citaion` (
  `idcit` int(11) NOT NULL,
  `idauto` int(11) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `citaion`
--

INSERT INTO `citaion` (`idcit`, `idauto`, `text`) VALUES
(0, 0, 'A white has no superiority over a black nor a black has any superiority over white except by piety and good actions.'),
(1, 1, 'To be, or not to be: that is the question.'),
(2, 1, 'All the world\'s a stage, and all the men and women merely players.'),
(3, 2, 'It is a truth universally acknowledged, that a single man in possession of a good fortune, must be in want of a wife.'),
(4, 2, 'The person, be it gentleman or lady, who has not pleasure in a good novel, must be intolerably stupid.'),
(5, 3, 'War is peace. Freedom is slavery. Ignorance is strength.'),
(6, 1, 'The fool doth think he is wise, but the wise man knows himself to be a fool.'),
(7, 2, 'I declare after all there is no enjoyment like reading! How much sooner one tires of any thing than of a book!'),
(8, 3, 'Political language... is designed to make lies sound truthful and murder respectable, and to give an appearance of solidity to pure wind.'),
(9, 4, 'Evryone must learn coding');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `name` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `password`) VALUES
('hakim', 'hakim');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autors`
--
ALTER TABLE `autors`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `citaion`
--
ALTER TABLE `citaion`
  ADD PRIMARY KEY (`idcit`),
  ADD KEY `fk_idauto` (`idauto`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `constraint_name` (`name`) USING HASH;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `citaion`
--
ALTER TABLE `citaion`
  ADD CONSTRAINT `fk_idauto` FOREIGN KEY (`idauto`) REFERENCES `autors` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

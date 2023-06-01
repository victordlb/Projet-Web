-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: May 31, 2023 at 08:58 PM
-- Server version: 8.0.33
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `piscine`
--

-- --------------------------------------------------------

--
-- Table structure for table `acheteur`
--

CREATE TABLE `acheteur` (
  `ID_acheteur` int NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `ville` varchar(255) DEFAULT NULL,
  `codep` int DEFAULT NULL,
  `pays` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `acheteur`
--

INSERT INTO `acheteur` (`ID_acheteur`, `adresse`, `ville`, `codep`, `pays`) VALUES
(5, '4 avenue de la terrasse', 'Montesson', 78360, 'France');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID_admin` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `ID_article` int NOT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `prix` float DEFAULT NULL,
  `ID_vendeur` int NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `categorie` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`ID_article`, `titre`, `description`, `prix`, `ID_vendeur`, `photo`, `categorie`, `date`) VALUES
(1, 'Table', 'une table', 78, 3, '', 'livre', '2023-05-31'),
(2, 'tshirt', 'blanc', 12, 3, '', 'vetement', '2023-05-31'),
(3, 'ak47', 'fusil', 780, 3, '', 'arme', '2023-05-31');

-- --------------------------------------------------------

--
-- Table structure for table `auser`
--

CREATE TABLE `auser` (
  `ID_auser` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `auser`
--

INSERT INTO `auser` (`ID_auser`) VALUES
(3);

-- --------------------------------------------------------

--
-- Table structure for table `enchere`
--

CREATE TABLE `enchere` (
  `ID_enchere` int NOT NULL,
  `date_fin` date DEFAULT NULL,
  `date_deb` date DEFAULT NULL,
  `prix_max` float DEFAULT NULL,
  `ID_acheteur` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `histo`
--

CREATE TABLE `histo` (
  `ID_histo` int NOT NULL,
  `ID_article` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `infop`
--

CREATE TABLE `infop` (
  `ID_info` int NOT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `cvc` int DEFAULT NULL,
  `expire` varchar(255) DEFAULT NULL,
  `num` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `infop`
--

INSERT INTO `infop` (`ID_info`, `prenom`, `nom`, `cvc`, `expire`, `num`, `type`) VALUES
(5, NULL, '', 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `nego`
--

CREATE TABLE `nego` (
  `ID_nego` int NOT NULL,
  `ID_article` int DEFAULT NULL,
  `ID_acheteur` int DEFAULT NULL,
  `compteur` int DEFAULT NULL,
  `newprice` int DEFAULT NULL,
  `tour` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notif`
--

CREATE TABLE `notif` (
  `ID_notif` int NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `message` varchar(255) NOT NULL,
  `ID_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `panier`
--

CREATE TABLE `panier` (
  `ID_panier` int NOT NULL,
  `ID_article` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `ID_request` int NOT NULL,
  `prix` float DEFAULT NULL,
  `date` date DEFAULT NULL,
  `ID_acheteur` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID_user` int NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `fond` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `pseudo` varchar(255) DEFAULT NULL,
  `age` int DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID_user`, `nom`, `prenom`, `mail`, `password`, `avatar`, `fond`, `tel`, `pseudo`, `age`, `status`) VALUES
(2, 'Nougarède', 'Paul', 'paul.nougarede78@gmail.com', '$2y$10$t3IEItTyUmL/lRjZQ9hpW.DcvV2H5SZIgAx7a6pCYodT7g30bhaS2', '../images/vinciphoto.jpg', NULL, '0644875489', 'blublu', 19, 'vendeur'),
(3, 'Noug', 'Paul', 'p@p.com', '$2y$10$XRobioynTvpAxYN8dqUlqOK0ed0xkaH.FwFXlT1V.UEubAh.MM3Fi', '../images/', NULL, '0644875489', 'Paul', 19, 'vendeur'),
(5, 'leveque', 'Martin', 'm@m.com', '$2y$10$/SRI.Y4jAPkOiyWiFiTIcuuRWVvZwvjXsnjp1THKQdxJZawNu8SvS', '../images/', NULL, '0644875489', 'Martin', 19, 'acheteur');

-- --------------------------------------------------------

--
-- Table structure for table `vendeur`
--

CREATE TABLE `vendeur` (
  `ID_vendeur` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vendeur`
--

INSERT INTO `vendeur` (`ID_vendeur`) VALUES
(2),
(3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acheteur`
--
ALTER TABLE `acheteur`
  ADD PRIMARY KEY (`ID_acheteur`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID_admin`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`ID_article`),
  ADD KEY `article_ibfk_1` (`ID_vendeur`);

--
-- Indexes for table `auser`
--
ALTER TABLE `auser`
  ADD PRIMARY KEY (`ID_auser`);

--
-- Indexes for table `enchere`
--
ALTER TABLE `enchere`
  ADD PRIMARY KEY (`ID_enchere`),
  ADD KEY `ID_acheteur` (`ID_acheteur`);

--
-- Indexes for table `histo`
--
ALTER TABLE `histo`
  ADD PRIMARY KEY (`ID_histo`),
  ADD KEY `ID_article` (`ID_article`);

--
-- Indexes for table `infop`
--
ALTER TABLE `infop`
  ADD PRIMARY KEY (`ID_info`);

--
-- Indexes for table `nego`
--
ALTER TABLE `nego`
  ADD PRIMARY KEY (`ID_nego`),
  ADD KEY `ID_acheteur` (`ID_acheteur`),
  ADD KEY `ID_article` (`ID_article`);

--
-- Indexes for table `notif`
--
ALTER TABLE `notif`
  ADD PRIMARY KEY (`ID_notif`),
  ADD KEY `ID_user` (`ID_user`);

--
-- Indexes for table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`ID_article`),
  ADD KEY `ID_article` (`ID_article`),
  ADD KEY `ID_panier` (`ID_panier`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`ID_request`),
  ADD KEY `ID_acheteur` (`ID_acheteur`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_user`);

--
-- Indexes for table `vendeur`
--
ALTER TABLE `vendeur`
  ADD PRIMARY KEY (`ID_vendeur`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `ID_article` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notif`
--
ALTER TABLE `notif`
  MODIFY `ID_notif` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `acheteur`
--
ALTER TABLE `acheteur`
  ADD CONSTRAINT `acheteur_ibfk_1` FOREIGN KEY (`ID_acheteur`) REFERENCES `user` (`ID_user`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`ID_admin`) REFERENCES `user` (`ID_user`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`ID_vendeur`) REFERENCES `vendeur` (`ID_vendeur`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `auser`
--
ALTER TABLE `auser`
  ADD CONSTRAINT `auser_ibfk_1` FOREIGN KEY (`ID_auser`) REFERENCES `user` (`ID_user`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `enchere`
--
ALTER TABLE `enchere`
  ADD CONSTRAINT `enchere_ibfk_2` FOREIGN KEY (`ID_acheteur`) REFERENCES `acheteur` (`ID_acheteur`) ON DELETE SET NULL ON UPDATE RESTRICT,
  ADD CONSTRAINT `enchere_ibfk_3` FOREIGN KEY (`ID_enchere`) REFERENCES `article` (`ID_article`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `histo`
--
ALTER TABLE `histo`
  ADD CONSTRAINT `histo_ibfk_2` FOREIGN KEY (`ID_histo`) REFERENCES `user` (`ID_user`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `histo_ibfk_3` FOREIGN KEY (`ID_article`) REFERENCES `article` (`ID_article`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `infop`
--
ALTER TABLE `infop`
  ADD CONSTRAINT `infop_ibfk_1` FOREIGN KEY (`ID_info`) REFERENCES `acheteur` (`ID_acheteur`) ON DELETE CASCADE;

--
-- Constraints for table `nego`
--
ALTER TABLE `nego`
  ADD CONSTRAINT `nego_ibfk_1` FOREIGN KEY (`ID_acheteur`) REFERENCES `acheteur` (`ID_acheteur`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `nego_ibfk_2` FOREIGN KEY (`ID_article`) REFERENCES `article` (`ID_article`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `notif`
--
ALTER TABLE `notif`
  ADD CONSTRAINT `notif_ibfk_1` FOREIGN KEY (`ID_user`) REFERENCES `user` (`ID_user`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`ID_panier`) REFERENCES `acheteur` (`ID_acheteur`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `panier_ibfk_2` FOREIGN KEY (`ID_article`) REFERENCES `article` (`ID_article`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`ID_request`) REFERENCES `enchere` (`ID_enchere`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`ID_acheteur`) REFERENCES `acheteur` (`ID_acheteur`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `vendeur`
--
ALTER TABLE `vendeur`
  ADD CONSTRAINT `vendeur_ibfk_1` FOREIGN KEY (`ID_vendeur`) REFERENCES `user` (`ID_user`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

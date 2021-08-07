-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 07-Ago-2021 às 15:28
-- Versão do servidor: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `notes`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `intGroupID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `strGroupName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`intGroupID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `groups`
--

INSERT INTO `groups` (`intGroupID`, `strGroupName`) VALUES
(1, 'Desenvolvimento'),
(2, 'Administração'),
(3, 'Comunicação'),
(4, 'Zeladoria');

-- --------------------------------------------------------

--
-- Estrutura da tabela `notes`
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE IF NOT EXISTS `notes` (
  `intNoteID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `intUserID` int(11) NOT NULL,
  `intNoteRespID` int(11) NOT NULL,
  `datNoteRegistration` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datNoteDateTime` datetime NOT NULL,
  `strNoteStatus` enum('open','finished') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'open',
  `strNoteTitle` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `strNoteText` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `strNoteType` enum('user','group') NOT NULL DEFAULT 'group',
  PRIMARY KEY (`intNoteID`),
  KEY `intUserID` (`intUserID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `intUserID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `datUserRegistration` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `intGroupID` int(11) NOT NULL,
  `strUserName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `strUserLogin` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `strUserPassword` char(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `strUserEmail` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `strUserStatus` enum('on','off') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'on',
  `strUserType` enum('admin','user') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  PRIMARY KEY (`intUserID`),
  KEY `intGroupID` (`intGroupID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`intUserID`, `datUserRegistration`, `intGroupID`, `strUserName`, `strUserLogin`, `strUserPassword`, `strUserEmail`, `strUserStatus`, `strUserType`) VALUES
(1, '2021-08-07 14:56:45', 1, 'Admin', 'admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'admin@mail.com', 'on', 'admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

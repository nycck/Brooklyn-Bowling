-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Gegenereerd op: 10 apr 2025 om 07:48
-- Serverversie: 8.2.0
-- PHP-versie: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brooklynbowling`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `banen`
--

DROP TABLE IF EXISTS `banen`;
CREATE TABLE IF NOT EXISTS `banen` (
  `Id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT,
  `BaanNummer` tinyint UNSIGNED NOT NULL,
  `IsKinderbaan` bit(1) NOT NULL DEFAULT b'0',
  `IsActief` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klanten`
--

DROP TABLE IF EXISTS `klanten`;
CREATE TABLE IF NOT EXISTS `klanten` (
  `Id` smallint UNSIGNED NOT NULL AUTO_INCREMENT,
  `Voornaam` varchar(50) NOT NULL,
  `Achternaam` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Wachtwoord` varchar(255) NOT NULL,
  `Telefoonnummer` varchar(20) DEFAULT NULL,
  `IsActief` bit(1) NOT NULL DEFAULT b'1',
  `DatumAangemaakt` datetime(6) NOT NULL,
  `DatumGewijzigd` datetime(6) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `medewerkers`
--

DROP TABLE IF EXISTS `medewerkers`;
CREATE TABLE IF NOT EXISTS `medewerkers` (
  `Id` smallint UNSIGNED NOT NULL AUTO_INCREMENT,
  `Naam` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Wachtwoord` varchar(255) NOT NULL,
  `Rol` varchar(50) NOT NULL,
  `IsActief` bit(1) NOT NULL DEFAULT b'1',
  `DatumAangemaakt` datetime(6) NOT NULL,
  `DatumGewijzigd` datetime(6) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `opties`
--

DROP TABLE IF EXISTS `opties`;
CREATE TABLE IF NOT EXISTS `opties` (
  `Id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT,
  `Naam` varchar(50) NOT NULL,
  `Prijs` decimal(5,2) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reserveringen`
--

DROP TABLE IF EXISTS `reserveringen`;
CREATE TABLE IF NOT EXISTS `reserveringen` (
  `Id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `KlantId` smallint UNSIGNED NOT NULL,
  `BaanId` tinyint UNSIGNED NOT NULL,
  `MedewerkerId` smallint UNSIGNED DEFAULT NULL,
  `Starttijd` datetime NOT NULL,
  `Eindtijd` datetime NOT NULL,
  `AantalVolwassenen` tinyint NOT NULL,
  `AantalKinderen` tinyint DEFAULT '0',
  `TotaalPrijs` decimal(6,2) DEFAULT NULL,
  `IsActief` bit(1) NOT NULL DEFAULT b'1',
  `DatumAangemaakt` datetime(6) NOT NULL,
  `DatumGewijzigd` datetime(6) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `KlantId` (`KlantId`),
  KEY `BaanId` (`BaanId`),
  KEY `MedewerkerId` (`MedewerkerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reserveringopties`
--

DROP TABLE IF EXISTS `reserveringopties`;
CREATE TABLE IF NOT EXISTS `reserveringopties` (
  `Id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `ReserveringId` int UNSIGNED NOT NULL,
  `OptieId` tinyint UNSIGNED NOT NULL,
  `Aantal` tinyint UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (`Id`),
  KEY `ReserveringId` (`ReserveringId`),
  KEY `OptieId` (`OptieId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `scores`
--

DROP TABLE IF EXISTS `scores`;
CREATE TABLE IF NOT EXISTS `scores` (
  `Id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `ReserveringId` int UNSIGNED NOT NULL,
  `SpelerNaam` varchar(100) NOT NULL,
  `Score` tinyint UNSIGNED NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `ReserveringId` (`ReserveringId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tarieven`
--

DROP TABLE IF EXISTS `tarieven`;
CREATE TABLE IF NOT EXISTS `tarieven` (
  `Id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT,
  `Dag` varchar(20) NOT NULL,
  `Starttijd` time NOT NULL,
  `Eindtijd` time NOT NULL,
  `Prijs` decimal(5,2) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `reserveringen`
--
ALTER TABLE `reserveringen`
  ADD CONSTRAINT `reserveringen_ibfk_1` FOREIGN KEY (`KlantId`) REFERENCES `klanten` (`Id`),
  ADD CONSTRAINT `reserveringen_ibfk_2` FOREIGN KEY (`BaanId`) REFERENCES `banen` (`Id`),
  ADD CONSTRAINT `reserveringen_ibfk_3` FOREIGN KEY (`MedewerkerId`) REFERENCES `medewerkers` (`Id`);

--
-- Beperkingen voor tabel `reserveringopties`
--
ALTER TABLE `reserveringopties`
  ADD CONSTRAINT `reserveringopties_ibfk_1` FOREIGN KEY (`ReserveringId`) REFERENCES `reserveringen` (`Id`),
  ADD CONSTRAINT `reserveringopties_ibfk_2` FOREIGN KEY (`OptieId`) REFERENCES `opties` (`Id`);

--
-- Beperkingen voor tabel `scores`
--
ALTER TABLE `scores`
  ADD CONSTRAINT `scores_ibfk_1` FOREIGN KEY (`ReserveringId`) REFERENCES `reserveringen` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

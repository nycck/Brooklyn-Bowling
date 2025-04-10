-- Step 01
-- ********************************************
-- Doel: Maak een nieuwe database aan met de naam Bowlingcentrum_2408A
-- ********************************************
-- Versie   | Datum      | Auteur             | Omschrijving
-- --------|------------|--------------------|---------------------
-- 01      | 10-04-2025 | [Jouw naam]        | Reserveringssysteem

-- Verwijder database als die al bestaat
DROP DATABASE IF EXISTS `Bowlingcentrum_2408A`;

-- Maak de nieuwe database aan
CREATE DATABASE `Bowlingcentrum_2408A`;
USE `Bowlingcentrum_2408A`;

-- Step 02
-- ********************************************
-- Doel: Maak tabellen aan
-- ********************************************

-- Tabel: Klanten
CREATE TABLE Klanten (
    Id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    Voornaam VARCHAR(50) NOT NULL,
    Achternaam VARCHAR(50) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    Wachtwoord VARCHAR(255) NOT NULL,
    Telefoonnummer VARCHAR(20),
    IsActief BIT NOT NULL DEFAULT 1,
    DatumAangemaakt DATETIME(6) NOT NULL,
    DatumGewijzigd DATETIME(6),
    PRIMARY KEY (Id)
) ENGINE=InnoDB;

-- Tabel: Medewerkers
CREATE TABLE Medewerkers (
    Id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    Naam VARCHAR(100) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    Wachtwoord VARCHAR(255) NOT NULL,
    Rol VARCHAR(50) NOT NULL,
    IsActief BIT NOT NULL DEFAULT 1,
    DatumAangemaakt DATETIME(6) NOT NULL,
    DatumGewijzigd DATETIME(6),
    PRIMARY KEY (Id)
) ENGINE=InnoDB;

-- Tabel: Banen
CREATE TABLE Banen (
    Id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    BaanNummer TINYINT UNSIGNED NOT NULL,
    IsKinderbaan BIT NOT NULL DEFAULT 0,
    IsActief BIT NOT NULL DEFAULT 1,
    PRIMARY KEY (Id)
) ENGINE=InnoDB;

-- Tabel: Tarieven
CREATE TABLE Tarieven (
    Id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    Dag VARCHAR(20) NOT NULL,
    Starttijd TIME NOT NULL,
    Eindtijd TIME NOT NULL,
    Prijs DECIMAL(5,2) NOT NULL,
    PRIMARY KEY (Id)
) ENGINE=InnoDB;

-- Tabel: Reserveringen
CREATE TABLE Reserveringen (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    KlantId SMALLINT UNSIGNED NOT NULL,
    BaanId TINYINT UNSIGNED NOT NULL,
    MedewerkerId SMALLINT UNSIGNED,
    Starttijd DATETIME NOT NULL,
    Eindtijd DATETIME NOT NULL,
    AantalVolwassenen TINYINT NOT NULL,
    AantalKinderen TINYINT DEFAULT 0,
    TotaalPrijs DECIMAL(6,2),
    IsActief BIT NOT NULL DEFAULT 1,
    DatumAangemaakt DATETIME(6) NOT NULL,
    DatumGewijzigd DATETIME(6),
    PRIMARY KEY (Id),
    FOREIGN KEY (KlantId) REFERENCES Klanten(Id),
    FOREIGN KEY (BaanId) REFERENCES Banen(Id),
    FOREIGN KEY (MedewerkerId) REFERENCES Medewerkers(Id)
) ENGINE=InnoDB;

-- Tabel: Opties (bijvoorbeeld snackpakketten, kinderfeest, etc.)
CREATE TABLE Opties (
    Id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    Naam VARCHAR(50) NOT NULL,
    Prijs DECIMAL(5,2) NOT NULL,
    PRIMARY KEY (Id)
) ENGINE=InnoDB;

-- Tabel: ReserveringOpties (koppeltabel tussen Reserveringen en Opties)
CREATE TABLE ReserveringOpties (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    ReserveringId INT UNSIGNED NOT NULL,
    OptieId TINYINT UNSIGNED NOT NULL,
    Aantal TINYINT UNSIGNED NOT NULL DEFAULT 1,
    PRIMARY KEY (Id),
    FOREIGN KEY (ReserveringId) REFERENCES Reserveringen(Id),
    FOREIGN KEY (OptieId) REFERENCES Opties(Id)
) ENGINE=InnoDB;

-- Tabel: Scores
CREATE TABLE Scores (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    ReserveringId INT UNSIGNED NOT NULL,
    SpelerNaam VARCHAR(100) NOT NULL,
    Score TINYINT UNSIGNED NOT NULL,
    PRIMARY KEY (Id),
    FOREIGN KEY (ReserveringId) REFERENCES Reserveringen(Id)
) ENGINE=InnoDB;

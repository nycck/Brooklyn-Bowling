-- Step: 01
-- ************************************************************
-- Doel : Maak een nieuwe database aan met de naam Brooklyn_Bowling
-- ************************************************************
-- Versie     Datum        Auteur              Omschrijving
-- ******     ***********  ******************  **********************
-- 01         10-04-2025   [Nick van Beusichem]         Bestellingentabel
-- ************************************************************

-- Verwijder database Brooklyn_Bowling als die al bestaat
DROP DATABASE IF EXISTS `Brooklyn_Bowling`;

-- Maak een nieuwe database aan
CREATE DATABASE `Brooklyn_Bowling`;

-- Gebruik de database Brooklyn_Bowling
USE `Brooklyn_Bowling`;


-- Step: 02
-- ************************************************************
-- Doel : Maak een nieuwe tabel aan met de naam Bestelling
-- ************************************************************
-- Versie     Datum        Auteur              Omschrijving
-- ******     ***********  ******************  **********************
-- 01         10-04-2025   [Nick van Beusichem]         Tabel Bestelling
-- ************************************************************

-- Onderstaande velden toevoegen aan de tabel Bestelling:
-- ReserveringId, DienstNaam, Aantal, Prijs, BestelDatum, Status

CREATE TABLE Bestelling
(
    Id              INT UNSIGNED NOT NULL AUTO_INCREMENT
   ,ReserveringId   INT UNSIGNED NOT NULL
   ,DienstNaam      VARCHAR(100) NOT NULL
   ,Aantal          INT UNSIGNED NOT NULL
   ,Prijs           DECIMAL(8,2) NOT NULL
   ,BestelDatum     DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6)
   ,Status          VARCHAR(50) NOT NULL DEFAULT 'In behandeling'
   ,Opmerking       VARCHAR(255) DEFAULT NULL
   ,DatumAangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6)
   ,DatumGewijzigd  DATETIME(6) DEFAULT NULL

   ,CONSTRAINT PK_Bestelling_Id PRIMARY KEY CLUSTERED (Id)
   -- ,CONSTRAINT FK_Bestelling_Reservering FOREIGN KEY (ReserveringId) REFERENCES Reservering(Id)
)

-- Step: 03
-- ************************************************************
-- Doel : Voeg voorbeeldgegevens toe aan de tabel Bestelling
-- ************************************************************

INSERT INTO Bestelling
(ReserveringId, DienstNaam, Aantal, Prijs, BestelDatum, Status, Opmerking, DatumAangemaakt)
VALUES
-- Klant huurt 4 paar schoenen (à €2,50 per stuk)
(1, 'Schoenen huren', 4, 10.00, '2025-04-09 18:45:00.000000', 'Betaald', NULL, '2025-04-09 18:45:00.000000'),

-- Klant boekt 2 extra spelrondes (à €6,00 per stuk)
(2, 'Extra spelronde', 2, 12.00, '2025-04-08 15:30:00.000000', 'In behandeling', 'Toegevoegd op aanvraag', '2025-04-08 15:30:00.000000'),

-- Klant huurt 3 paar schoenen en voegt 1 extra ronde toe
(3, 'Schoenen huren', 3, 7.50, '2025-04-07 17:15:00.000000', 'Betaald', NULL, '2025-04-07 17:15:00.000000'),
(4, 'Extra spelronde', 1, 6.00, '2025-04-07 17:16:00.000000', 'Betaald', NULL, '2025-04-07 17:16:00.000000'),

-- Klant bestelt snacks (bv. voor 5 personen à €3,50)
(5, 'Snackpakket', 5, 17.50, '2025-04-06 19:00:00.000000', 'Geannuleerd', 'Wilde annuleren wegens allergieën', '2025-04-06 19:00:00.000000');

ENGINE=InnoDB;

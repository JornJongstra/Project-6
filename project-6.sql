-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 28 jun 2022 om 09:39
-- Serverversie: 10.4.24-MariaDB
-- PHP-versie: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project-6`
--
CREATE DATABASE IF NOT EXISTS `project-6` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `project-6`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `boekingen`
--

CREATE TABLE `boekingen` (
  `ID` int(11) NOT NULL,
  `StartDatum` date NOT NULL,
  `PINCode` int(11) NOT NULL,
  `FKtochtenID` int(11) NOT NULL,
  `FKklantenID` int(11) NOT NULL,
  `FKstatussenID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIES VOOR TABEL `boekingen`:
--   `FKklantenID`
--       `klanten` -> `ID`
--   `FKstatussenID`
--       `statussen` -> `ID`
--   `FKtochtenID`
--       `tochten` -> `ID`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `herbergen`
--

CREATE TABLE `herbergen` (
  `ID` int(11) NOT NULL,
  `Naam` varchar(50) NOT NULL,
  `Adres` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Telefoon` varchar(20) NOT NULL,
  `Coordinaten` text NOT NULL,
  `Gewijzigd` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIES VOOR TABEL `herbergen`:
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klanten`
--

CREATE TABLE `klanten` (
  `ID` int(11) NOT NULL,
  `Naam` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Telefoon` varchar(20) NOT NULL,
  `Wachtwoord` varchar(100) NOT NULL,
  `Gewijzigd` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Level` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIES VOOR TABEL `klanten`:
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `overnachtingen`
--

CREATE TABLE `overnachtingen` (
  `ID` int(11) NOT NULL,
  `FKboekingenID` int(11) NOT NULL,
  `FKherbergenID` int(11) NOT NULL,
  `FKstatussenID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIES VOOR TABEL `overnachtingen`:
--   `FKboekingenID`
--       `boekingen` -> `ID`
--   `FKherbergenID`
--       `herbergen` -> `ID`
--   `FKstatussenID`
--       `statussen` -> `ID`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `pauzeplaatsen`
--

CREATE TABLE `pauzeplaatsen` (
  `ID` int(11) NOT NULL,
  `FKboekingenID` int(11) NOT NULL,
  `FKrestaurantsID` int(11) NOT NULL,
  `FKstatussenID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIES VOOR TABEL `pauzeplaatsen`:
--   `FKboekingenID`
--       `boekingen` -> `ID`
--   `FKrestaurantsID`
--       `restaurants` -> `ID`
--   `FKstatussenID`
--       `statussen` -> `ID`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `restaurants`
--

CREATE TABLE `restaurants` (
  `ID` int(11) NOT NULL,
  `Naam` varchar(50) NOT NULL,
  `Adres` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Telefoon` varchar(20) NOT NULL,
  `Coordinaten` text NOT NULL,
  `Gewijzigd` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIES VOOR TABEL `restaurants`:
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `statussen`
--

CREATE TABLE `statussen` (
  `ID` int(11) NOT NULL,
  `StatusCode` tinyint(4) NOT NULL,
  `Status` varchar(40) NOT NULL,
  `Verwijderbaar` tinyint(4) NOT NULL,
  `PINtoekennen` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIES VOOR TABEL `statussen`:
--

--
-- Gegevens worden geëxporteerd voor tabel `statussen`
--

INSERT INTO `statussen` (`ID`, `StatusCode`, `Status`, `Verwijderbaar`, `PINtoekennen`) VALUES
(1, 1, 'Aanvraag', 1, 0),
(2, 2, 'Definitief', 0, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tochten`
--

CREATE TABLE `tochten` (
  `ID` int(11) NOT NULL,
  `Omschrijving` text NOT NULL,
  `Route` varchar(50) NOT NULL,
  `AantalDagen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIES VOOR TABEL `tochten`:
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `trackers`
--

CREATE TABLE `trackers` (
  `ID` int(11) NOT NULL,
  `PINCode` int(11) NOT NULL,
  `Lat` double NOT NULL,
  `Lon` double NOT NULL,
  `Time` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIES VOOR TABEL `trackers`:
--

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `boekingen`
--
ALTER TABLE `boekingen`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FKklantenID` (`FKklantenID`),
  ADD KEY `FKstatussenID` (`FKstatussenID`),
  ADD KEY `FKtochtenID` (`FKtochtenID`);

--
-- Indexen voor tabel `herbergen`
--
ALTER TABLE `herbergen`
  ADD PRIMARY KEY (`ID`);

--
-- Indexen voor tabel `klanten`
--
ALTER TABLE `klanten`
  ADD PRIMARY KEY (`ID`);

--
-- Indexen voor tabel `overnachtingen`
--
ALTER TABLE `overnachtingen`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FKboekingenID` (`FKboekingenID`),
  ADD KEY `FKherbergenID` (`FKherbergenID`),
  ADD KEY `FKstatussenID` (`FKstatussenID`);

--
-- Indexen voor tabel `pauzeplaatsen`
--
ALTER TABLE `pauzeplaatsen`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FKboekingenID` (`FKboekingenID`),
  ADD KEY `FKrestaurantsID` (`FKrestaurantsID`),
  ADD KEY `FKstatussenID` (`FKstatussenID`);

--
-- Indexen voor tabel `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`ID`);

--
-- Indexen voor tabel `statussen`
--
ALTER TABLE `statussen`
  ADD PRIMARY KEY (`ID`);

--
-- Indexen voor tabel `tochten`
--
ALTER TABLE `tochten`
  ADD PRIMARY KEY (`ID`);

--
-- Indexen voor tabel `trackers`
--
ALTER TABLE `trackers`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `boekingen`
--
ALTER TABLE `boekingen`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `herbergen`
--
ALTER TABLE `herbergen`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `klanten`
--
ALTER TABLE `klanten`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `overnachtingen`
--
ALTER TABLE `overnachtingen`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `pauzeplaatsen`
--
ALTER TABLE `pauzeplaatsen`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `statussen`
--
ALTER TABLE `statussen`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `tochten`
--
ALTER TABLE `tochten`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `trackers`
--
ALTER TABLE `trackers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `boekingen`
--
ALTER TABLE `boekingen`
  ADD CONSTRAINT `boekingen_ibfk_1` FOREIGN KEY (`FKklantenID`) REFERENCES `klanten` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `boekingen_ibfk_2` FOREIGN KEY (`FKstatussenID`) REFERENCES `statussen` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `boekingen_ibfk_3` FOREIGN KEY (`FKtochtenID`) REFERENCES `tochten` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `overnachtingen`
--
ALTER TABLE `overnachtingen`
  ADD CONSTRAINT `overnachtingen_ibfk_1` FOREIGN KEY (`FKboekingenID`) REFERENCES `boekingen` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `overnachtingen_ibfk_2` FOREIGN KEY (`FKherbergenID`) REFERENCES `herbergen` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `overnachtingen_ibfk_3` FOREIGN KEY (`FKstatussenID`) REFERENCES `statussen` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `pauzeplaatsen`
--
ALTER TABLE `pauzeplaatsen`
  ADD CONSTRAINT `pauzeplaatsen_ibfk_1` FOREIGN KEY (`FKboekingenID`) REFERENCES `boekingen` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pauzeplaatsen_ibfk_2` FOREIGN KEY (`FKrestaurantsID`) REFERENCES `restaurants` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pauzeplaatsen_ibfk_3` FOREIGN KEY (`FKstatussenID`) REFERENCES `statussen` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

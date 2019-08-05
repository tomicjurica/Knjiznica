-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2019 at 07:43 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `knjiznicadb`
--

-- --------------------------------------------------------

--
-- Table structure for table `autori`
--

CREATE TABLE `autori` (
  `ID_Autor` int(11) NOT NULL,
  `Naziv_Autora` varchar(100) COLLATE utf8_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `autori`
--

INSERT INTO `autori` (`ID_Autor`, `Naziv_Autora`) VALUES
(1, 'Ivo Andrić'),
(2, 'Karl May'),
(3, 'Antoine de Saint-Exupéry'),
(5, 'Homer '),
(6, 'ivo');

-- --------------------------------------------------------

--
-- Table structure for table `izdavaci`
--

CREATE TABLE `izdavaci` (
  `ID_Izdavac` int(11) NOT NULL,
  `Naziv` varchar(100) COLLATE utf8_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `izdavaci`
--

INSERT INTO `izdavaci` (`ID_Izdavac`, `Naziv`) VALUES
(1, 'Nova Knjiga'),
(2, 'Delfi'),
(3, 'Školska naklada'),
(5, 'hdsgafjhsagfjhsadgfjdsa'),
(6, 'Svijetlost'),
(7, 'delfi');

-- --------------------------------------------------------

--
-- Table structure for table `iznajmljivanje`
--

CREATE TABLE `iznajmljivanje` (
  `Id_Iznajmljivanje` int(11) NOT NULL,
  `Datum_Iznajmljivanja` date DEFAULT NULL,
  `Datum_Vracanja` date DEFAULT NULL,
  `Korisnik_ID` int(11) NOT NULL,
  `Knjiga_ID` int(11) NOT NULL,
  `Status_Iznajmljivanja` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `iznajmljivanje`
--

INSERT INTO `iznajmljivanje` (`Id_Iznajmljivanje`, `Datum_Iznajmljivanja`, `Datum_Vracanja`, `Korisnik_ID`, `Knjiga_ID`, `Status_Iznajmljivanja`) VALUES
(1, '2019-07-01', '2019-07-28', 2, 1, 0),
(2, '2019-07-28', '2019-07-28', 2, 1, 0),
(3, '2019-07-28', NULL, 3, 2, 1),
(4, '2019-07-28', '2019-07-31', 1, 2, 0),
(5, '2019-07-28', '2019-07-30', 2, 6, 0),
(6, '2019-07-29', '2019-07-29', 6, 1, 0),
(7, '2019-07-29', NULL, 6, 2, 1),
(8, '2019-07-31', NULL, 3, 2, 1),
(9, '2019-08-05', '2019-08-05', 2, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `knjige`
--

CREATE TABLE `knjige` (
  `ID_Knjige` int(11) NOT NULL,
  `Naziv` varchar(100) COLLATE utf8_croatian_ci NOT NULL,
  `Godina_Izdavanja` varchar(10) COLLATE utf8_croatian_ci DEFAULT NULL,
  `Status` tinyint(1) DEFAULT '1',
  `Autor_ID` int(11) NOT NULL,
  `Izdavac_ID` int(11) NOT NULL,
  `Br_Stranica` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `knjige`
--

INSERT INTO `knjige` (`ID_Knjige`, `Naziv`, `Godina_Izdavanja`, `Status`, `Autor_ID`, `Izdavac_ID`, `Br_Stranica`) VALUES
(1, 'Na drini ćuprija', '1945', 1, 0, 0, 318),
(2, 'Winnetou', '1892', 1, 2, 2, 542),
(6, 'Mali princc', '1943', 1, 3, 2, 128),
(8, 'Ilijada i Odiseja', '1999', 1, 5, 6, 468),
(9, 'na drini ćuprija', '1945', 1, 1, 1, 418);

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `ID_Korisnik` int(11) NOT NULL,
  `Ime` varchar(50) COLLATE utf8_croatian_ci NOT NULL,
  `Prezime` varchar(50) COLLATE utf8_croatian_ci NOT NULL,
  `E_Mail` varchar(100) COLLATE utf8_croatian_ci NOT NULL,
  `Lozinka` varchar(50) COLLATE utf8_croatian_ci NOT NULL,
  `Adresa` varchar(50) COLLATE utf8_croatian_ci DEFAULT NULL,
  `Br_Telefona` varchar(50) COLLATE utf8_croatian_ci DEFAULT NULL,
  `Status` tinyint(1) DEFAULT '1',
  `Tip_KorisnikaID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`ID_Korisnik`, `Ime`, `Prezime`, `E_Mail`, `Lozinka`, `Adresa`, `Br_Telefona`, `Status`, `Tip_KorisnikaID`) VALUES
(1, 'Jurica', 'Tomic', 'jurica.tomic1@gmail.com', 'jurica', 'Cim 10A', '063448320', 1, 1),
(2, 'Marko', 'Tomic', 'marko.tomic1@gmail.com', 'marko', 'Cim 10A', '063411425', 1, 2),
(6, 'Ana ', 'Zadro', 'ana.zadro1@gmail.com', 'ana', 'S.Radica 55', '063117222', 1, 2),
(7, 'Dario', 'Zovko', 'dario.zovko1@gmail.com', 'dario', 'Cim 30b', '063777888', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tip_korisnika`
--

CREATE TABLE `tip_korisnika` (
  `ID_TipKorisnika` int(11) NOT NULL,
  `Naziv` varchar(50) COLLATE utf8_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `tip_korisnika`
--

INSERT INTO `tip_korisnika` (`ID_TipKorisnika`, `Naziv`) VALUES
(1, 'Administrator'),
(2, 'Korisnik'),
(3, 'Gost');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autori`
--
ALTER TABLE `autori`
  ADD PRIMARY KEY (`ID_Autor`);

--
-- Indexes for table `izdavaci`
--
ALTER TABLE `izdavaci`
  ADD PRIMARY KEY (`ID_Izdavac`);

--
-- Indexes for table `iznajmljivanje`
--
ALTER TABLE `iznajmljivanje`
  ADD PRIMARY KEY (`Id_Iznajmljivanje`);

--
-- Indexes for table `knjige`
--
ALTER TABLE `knjige`
  ADD PRIMARY KEY (`ID_Knjige`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`ID_Korisnik`);

--
-- Indexes for table `tip_korisnika`
--
ALTER TABLE `tip_korisnika`
  ADD PRIMARY KEY (`ID_TipKorisnika`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `autori`
--
ALTER TABLE `autori`
  MODIFY `ID_Autor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `izdavaci`
--
ALTER TABLE `izdavaci`
  MODIFY `ID_Izdavac` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `iznajmljivanje`
--
ALTER TABLE `iznajmljivanje`
  MODIFY `Id_Iznajmljivanje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `knjige`
--
ALTER TABLE `knjige`
  MODIFY `ID_Knjige` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `ID_Korisnik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tip_korisnika`
--
ALTER TABLE `tip_korisnika`
  MODIFY `ID_TipKorisnika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

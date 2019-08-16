-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 16, 2019 at 05:19 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id10403650_knjiznicadb`
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
(3, 'Homer '),
(4, 'Branko Ćopić');

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
(2, 'Školska naklada'),
(3, 'Svijetlost'),
(4, 'Ziral');

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
  `Status_Iznajmljivanja` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `iznajmljivanje`
--

INSERT INTO `iznajmljivanje` (`Id_Iznajmljivanje`, `Datum_Iznajmljivanja`, `Datum_Vracanja`, `Korisnik_ID`, `Knjiga_ID`, `Status_Iznajmljivanja`) VALUES
(1, '2019-07-01', '2019-07-28', 2, 1, 0),
(6, '2019-07-29', '2019-07-29', 4, 2, 0),
(14, '2019-08-06', NULL, 3, 3, 1),
(27, '2019-08-11', '2019-08-14', 2, 4, 0),
(34, '2019-08-12', NULL, 2, 2, 1),
(35, '2019-08-14', NULL, 3, 1, 1),
(36, '2019-08-14', '2019-08-14', 3, 2, 0),
(37, '2019-08-16', NULL, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `knjige`
--

CREATE TABLE `knjige` (
  `ID_Knjige` int(11) NOT NULL,
  `Naziv` varchar(100) COLLATE utf8_croatian_ci NOT NULL,
  `Godina_Izdavanja` varchar(10) COLLATE utf8_croatian_ci DEFAULT NULL,
  `Status` tinyint(1) DEFAULT 1,
  `Autor_ID` int(11) NOT NULL,
  `Izdavac_ID` int(11) NOT NULL,
  `Br_Stranica` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `knjige`
--

INSERT INTO `knjige` (`ID_Knjige`, `Naziv`, `Godina_Izdavanja`, `Status`, `Autor_ID`, `Izdavac_ID`, `Br_Stranica`) VALUES
(1, 'Na drini ćuprija', '1945', 1, 1, 1, 318),
(2, 'Winnetou', '1892', 1, 2, 4, 542),
(3, 'Slavno vojevanje', '1967.', 1, 4, 3, 516),
(4, 'Ilijada i Odiseja', '1999', 1, 3, 1, 468);

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
  `Status` tinyint(1) DEFAULT 1,
  `Tip_KorisnikaID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`ID_Korisnik`, `Ime`, `Prezime`, `E_Mail`, `Lozinka`, `Adresa`, `Br_Telefona`, `Status`, `Tip_KorisnikaID`) VALUES
(1, 'Jurica', 'Tomic', 'jurica.tomic1@gmail.com', 'jurica', 'Cim 10A', '063448320', 1, 1),
(2, 'Marko', 'Tomić', 'marko.tomic1@gmail.com', 'marko', 'Cim 10A', '063411425', 1, 2),
(3, 'Ana ', 'Zadro', 'ana.zadro1@gmail.com', 'ana', 'S.Radica 55', '063117222', 1, 2),
(4, 'Dario', 'Zovko', 'dario.zovko1@gmail.com', 'dario', 'Cim 30b', '063777888', 1, 2);

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
  MODIFY `ID_Autor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `izdavaci`
--
ALTER TABLE `izdavaci`
  MODIFY `ID_Izdavac` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `iznajmljivanje`
--
ALTER TABLE `iznajmljivanje`
  MODIFY `Id_Iznajmljivanje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `knjige`
--
ALTER TABLE `knjige`
  MODIFY `ID_Knjige` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `ID_Korisnik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tip_korisnika`
--
ALTER TABLE `tip_korisnika`
  MODIFY `ID_TipKorisnika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

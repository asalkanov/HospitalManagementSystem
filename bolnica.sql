-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2015 at 11:38 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bolnica`
--

-- --------------------------------------------------------

--
-- Table structure for table `doktor`
--

CREATE TABLE IF NOT EXISTS `doktor` (
  `idDoktora` int(11) NOT NULL,
  `imeDoktora` varchar(30) NOT NULL,
  `prezimeDoktora` varchar(50) NOT NULL,
  `grad` varchar(30) NOT NULL,
  `placa` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doktor`
--

INSERT INTO `doktor` (`idDoktora`, `imeDoktora`, `prezimeDoktora`, `grad`, `placa`) VALUES
(1, 'Lucija', 'Vanjaka Rogosic', 'Split', 8000),
(2, 'Kresimir', 'Kostovic', 'Zagreb', 8000),
(3, 'Zenon', 'Pogorelic', 'Split', 7500),
(4, 'Antun', 'Kljena', 'Zagreb', 9000),
(5, 'Zoran', 'Bahtijarevic', 'Zagreb', 8500),
(6, 'Nado', 'Bukvic', 'Rijeka', 7000),
(7, 'Dalibor', 'Divkovic', 'Osijek', 7000),
(8, 'Gorana', 'Mirosevic', 'Zagreb', 12000),
(9, 'Josip', 'Zmire', 'Zagreb', 12500),
(10, 'Darko', 'Kastelan', 'Zagreb', 11500),
(11, 'Silvija', 'Cukovic', 'Zagreb', 10000),
(12, 'Davor', 'Radic', 'Zagreb', 10500),
(13, 'Milos', 'Lalovac', 'Dubrovnik', 12000),
(14, 'Tihana', 'Mazalin', 'Zagreb', 9000),
(15, 'Iva', 'Bolanca', 'Rijeka', 10000),
(16, 'Martina', 'Ujevic', 'Sisak', 15000),
(17, 'Goran', 'Vujic', 'Slavonski Brod', 8000),
(18, 'Visnja', 'Tadic', 'Split', 7500),
(19, 'Dusko', 'Pall', 'Dubrovnik', 7000),
(20, 'Hrvoje', 'Brijacak', 'Varazdin', 9000),
(21, 'Josip', 'Tonkovic', 'Zadar', 18000),
(22, 'Dinko', 'Kulisic', 'Virovitica', 12700),
(23, 'Sandra', 'Basic', 'Zagreb', 15300),
(24, 'Pavle', 'Roncevic', 'Zagreb', 13400),
(25, 'Radmila', 'Mandac', 'Zagreb', 11100),
(26, 'Dubravka', 'Lisnjic', 'Osijek', 17000),
(27, 'Edvard', 'Galic', 'Zagreb', 22000),
(28, 'Miomir', 'Veskovic', 'Zagreb', 25600),
(29, 'Ante', 'Anic', 'Zadar', 17900),
(30, 'Igor', 'Nikolic', 'Zagreb', 19000),
(31, 'Predrag', 'Knezevic', 'Rijeka', 20000),
(32, 'Zoran', 'Veir', 'Karlovac', 17400),
(33, 'Rado', 'Zic', 'Karlovac', 15000),
(34, 'Ivo', 'Dzepina', 'Karlovac', 12200),
(35, 'Zvonko', 'Zadro', 'Karlovac', 13000),
(36, 'Mladen', 'Petrunic', 'Zagreb', 21500),
(37, 'Ivan', 'Koprivcic', 'Osijek', 16600),
(38, 'Damir', 'Tomac', 'Zagreb', 14500),
(39, 'Miroslav', 'Vukic', 'Zagreb', 16000),
(40, 'Goran', 'Mrak', 'Zagreb', 20000),
(41, 'Darko', 'Chudy', 'Rijeka', 13400),
(42, 'Javorka', 'Leko', 'Split', 15000),
(43, 'Mario', 'Mihalj', 'Split', 27000),
(44, 'Zeljka', 'Peterlin', 'Rijeka', 26500),
(45, 'Borna', 'Saric', 'Zagreb', 22000),
(46, 'Miro', 'Kalauz', 'Rijeka', 12200),
(47, 'Rajko', 'Kordic', 'Zagreb', 14300),
(48, 'Zlatko', 'Juratovac', 'Zagreb', 17700),
(49, 'Ljerka', 'Eljuga', 'Zagreb', 23000),
(50, 'Fedor', 'Santek', 'Zagreb', 19600),
(51, 'Ivica', 'Klapan', 'Zagreb', 23500),
(52, 'Renato', 'Janusic', 'Zagreb', 9500),
(53, 'Boris', 'Filipovic', 'Rijeka', 14400),
(54, 'Robert', 'Tafra', 'Split', 19200),
(55, 'Mihaela', 'Marinac', 'Slavonski Brod', 18900),
(56, 'Bojan', 'Fanfani', 'Karlovac', 15100),
(57, 'Branko', 'Strihic', 'Nova Gradiska', 12300),
(58, 'Sinisa', 'Klapan', 'Virovitica', 21000),
(59, 'Oskar', 'Lucev', 'Zagreb', 27200),
(60, 'Mirjana', 'Tomcic', 'Split', 14000),
(61, 'Blanka', 'Labura', 'Split', 13900),
(62, 'Lidija', 'Ceher', 'Osijek', 21600),
(63, 'Vera', 'Vukcevic', 'Dubrovnik', 25100),
(64, 'Marija', 'Rodin', 'Bjelovar', 19900),
(65, 'Ksenija', 'Matic', 'Samobor', 17100),
(66, 'Drago', 'Odak', 'Zagreb', 8800),
(67, 'Zeljko', 'Herceg', 'Rijeka', 11900),
(68, 'Suncana', 'Zetekovic', 'Osijek', 7900);

-- --------------------------------------------------------

--
-- Table structure for table `doktorspecijalizacija`
--

CREATE TABLE IF NOT EXISTS `doktorspecijalizacija` (
  `idDoktora` int(11) NOT NULL,
  `idSpecijalizacije` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doktorspecijalizacija`
--

INSERT INTO `doktorspecijalizacija` (`idDoktora`, `idSpecijalizacije`) VALUES
(1, 1),
(2, 1),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 3),
(9, 3),
(10, 3),
(13, 3),
(11, 4),
(12, 4),
(13, 4),
(14, 5),
(15, 5),
(16, 5),
(17, 5),
(18, 5),
(19, 5),
(20, 5),
(21, 5),
(22, 5),
(67, 5),
(23, 6),
(24, 6),
(25, 6),
(26, 7),
(32, 7),
(27, 8),
(28, 8),
(29, 8),
(30, 9),
(31, 9),
(32, 9),
(33, 9),
(34, 9),
(35, 9),
(36, 9),
(37, 9),
(38, 9),
(39, 9),
(40, 9),
(41, 9),
(67, 9),
(42, 10),
(43, 11),
(44, 11),
(45, 12),
(46, 12),
(47, 12),
(48, 12),
(49, 13),
(50, 13),
(51, 14),
(52, 14),
(53, 14),
(54, 14),
(55, 14),
(56, 14),
(57, 14),
(58, 14),
(59, 15),
(60, 15),
(61, 15),
(62, 15),
(63, 15),
(64, 15),
(65, 15),
(66, 16),
(67, 16),
(68, 16);

-- --------------------------------------------------------

--
-- Table structure for table `lijek`
--

CREATE TABLE IF NOT EXISTS `lijek` (
  `idLijeka` int(11) NOT NULL,
  `imeLijeka` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lijek`
--

INSERT INTO `lijek` (`idLijeka`, `imeLijeka`) VALUES
(1, 'Peptoran'),
(2, 'Ranix'),
(3, 'Ranital'),
(4, 'Ulfamid'),
(5, 'Famosan'),
(6, 'Ulzol'),
(7, 'Omezol'),
(8, 'Zoltex'),
(9, 'Acipan'),
(10, 'Nolpaza'),
(11, 'Peptix'),
(12, 'Larona'),
(13, 'Seval'),
(14, 'Esprol'),
(15, 'Nexium'),
(16, 'Metopran'),
(17, 'Aloxi'),
(18, 'Apidra'),
(19, 'Itaz'),
(20, 'Flixonase'),
(21, 'Tafen Nasal');

-- --------------------------------------------------------

--
-- Table structure for table `lijekpregled`
--

CREATE TABLE IF NOT EXISTS `lijekpregled` (
  `idLijeka` int(11) NOT NULL,
  `idPregled` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lijekpregled`
--

INSERT INTO `lijekpregled` (`idLijeka`, `idPregled`) VALUES
(20, 1),
(21, 1),
(1, 2),
(5, 3),
(12, 3),
(17, 3),
(18, 3),
(1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `narudzba`
--

CREATE TABLE IF NOT EXISTS `narudzba` (
  `idNarudzbe` int(11) NOT NULL,
  `opisNarudzbe` mediumtext NOT NULL,
  `idDoktora` int(11) NOT NULL,
  `idTipPregleda` int(11) NOT NULL,
  `idPacijenta` int(11) NOT NULL,
  `datum` date NOT NULL,
  `vrijeme` time NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `narudzba`
--

INSERT INTO `narudzba` (`idNarudzbe`, `opisNarudzbe`, `idDoktora`, `idTipPregleda`, `idPacijenta`, `datum`, `vrijeme`) VALUES
(1, 'Torakalna kirurgija - prvi pregled', 32, 6, 1, '2015-06-21', '14:00:00'),
(2, 'Dijagnostika ultrazvukom - kontrolni pregled', 67, 11, 13, '2015-07-04', '10:30:00'),
(3, 'Prednja i straznja rinoskopija - kontrolni pregled', 55, 8, 5, '2015-07-04', '12:00:00'),
(4, 'Pregled stitnjace', 32, 3, 1, '2015-06-19', '08:00:00'),
(5, 'Pregled', 32, 4, 10, '2015-06-19', '09:00:00'),
(6, 'Pregled', 32, 12, 15, '2015-06-19', '09:40:00'),
(7, 'Pregled', 32, 13, 17, '2015-06-19', '12:00:00'),
(8, 'Pregled', 55, 8, 2, '2015-06-19', '10:00:00'),
(9, 'Pregled', 55, 8, 4, '2015-06-17', '11:00:00'),
(10, 'Operacija', 55, 8, 7, '2015-06-19', '11:10:00');

-- --------------------------------------------------------

--
-- Table structure for table `pacijent`
--

CREATE TABLE IF NOT EXISTS `pacijent` (
  `idPacijenta` int(11) NOT NULL,
  `ime` varchar(30) NOT NULL,
  `prezime` varchar(50) NOT NULL,
  `grad` varchar(40) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pacijent`
--

INSERT INTO `pacijent` (`idPacijenta`, `ime`, `prezime`, `grad`) VALUES
(1, 'Sanja', 'Ogrebic', 'Split'),
(2, 'Jadranka', 'Aralica', 'Rijeka'),
(3, 'Marina', 'Barac', 'Zagreb'),
(4, 'Davor', 'Karl', 'Karlovac'),
(5, 'Sanja', 'Buljan', 'Rijeka'),
(6, 'Ivica', 'Marusic', 'Slavonski brod'),
(7, 'Zlatko', 'Zure', 'Zadar'),
(8, 'Neven', 'Petric', 'Virovitica'),
(9, 'Marija', 'Milkovic', 'Sisak'),
(10, 'Tomislav', 'Zamic', 'Sisak'),
(11, 'Marijana', 'Biljan', 'Osijek'),
(12, 'Marija', 'Luc', 'Osijek'),
(13, 'Kresimir', 'Vuletic', 'Osijek'),
(14, 'Vlasta', 'Markulak', 'Split'),
(15, 'Nada', 'Culo', 'Rijeka'),
(16, 'Ivana', 'Zecevic', 'Zadar'),
(17, 'Vesna', 'Brust', 'Bjelovar'),
(18, 'Natalija', 'Stjepanek', 'Zagreb'),
(19, 'Luka', 'Rimac', 'Bjelovar'),
(20, 'Lidija', 'Tihi', 'Sisak'),
(21, 'Lucija', 'Saulic', 'Varazdin'),
(22, 'Petar', 'Jukic', 'Varazdin'),
(23, 'Mario', 'Calic', 'Bjelovar'),
(24, 'Dunja', 'Novak', 'Nova Gradiska');

-- --------------------------------------------------------

--
-- Table structure for table `pregled`
--

CREATE TABLE IF NOT EXISTS `pregled` (
  `idPregled` int(11) NOT NULL,
  `rezultatPregleda` mediumtext NOT NULL,
  `idNarudzbe` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pregled`
--

INSERT INTO `pregled` (`idPregled`, `rezultatPregleda`, `idNarudzbe`) VALUES
(1, 'Pregledom je ustanovljeno da pacijent ima alergijski rinitis, te su mu propisani Flixonase i Tafen Nasal.', 3),
(2, 'Propisani lijekovi.', 9),
(3, 'Propisani lijekovi', 2),
(4, 'Propisani lijekovi', 3);

-- --------------------------------------------------------

--
-- Table structure for table `specijalizacija`
--

CREATE TABLE IF NOT EXISTS `specijalizacija` (
  `idSpecijalizacije` int(11) NOT NULL,
  `nazivSpecijalizacije` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `specijalizacija`
--

INSERT INTO `specijalizacija` (`idSpecijalizacije`, `nazivSpecijalizacije`) VALUES
(1, 'Dermatovenerologija'),
(2, 'Djecja kirurgija'),
(3, 'Endokrinologija'),
(4, 'Gastroentorologija'),
(5, 'Ginekologija'),
(6, 'Hematologija'),
(7, 'Infektologija'),
(8, 'Kardiologija'),
(9, 'Kirurgija'),
(10, 'Mikrobiologija'),
(11, 'Neurologija'),
(12, 'Oftalmologija'),
(13, 'Onkologija'),
(14, 'Otorinolaringologija'),
(15, 'Pedijatrija'),
(16, 'Radiologija');

-- --------------------------------------------------------

--
-- Table structure for table `tippregleda`
--

CREATE TABLE IF NOT EXISTS `tippregleda` (
  `idTipPregleda` int(11) NOT NULL,
  `idSpecijalizacija` int(11) NOT NULL,
  `nazivPregleda` varchar(40) NOT NULL,
  `trajanje` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tippregleda`
--

INSERT INTO `tippregleda` (`idTipPregleda`, `idSpecijalizacija`, `nazivPregleda`, `trajanje`) VALUES
(1, 8, 'Kardiologija - aritmije srca', 30),
(2, 11, 'Neurologija - glavobolje', 20),
(3, 9, 'Kirurgija stitnjace', 45),
(4, 9, 'Digestivna (abdominalna) kirurgija', 30),
(5, 13, 'Intratorakalno sijelo (onkologija)', 60),
(6, 9, 'Torakalna kirurgija', 120),
(7, 9, 'Kirurgija paratireoidnih zlijezda', 80),
(8, 14, 'Prednja i straznja rinoskopija ', 70),
(9, 14, 'Indirektna laringoskopija ', 50),
(10, 12, 'Automatska keratorefraktometrija', 35),
(11, 16, 'Dijagnostika ultrazvukom', 15),
(12, 9, 'Opca kirurgija', 30),
(13, 9, 'Abdominalna kirurgija', 60),
(14, 7, 'Imunizacija', 120),
(15, 7, 'Virusi', 60);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doktor`
--
ALTER TABLE `doktor`
  ADD PRIMARY KEY (`idDoktora`);

--
-- Indexes for table `doktorspecijalizacija`
--
ALTER TABLE `doktorspecijalizacija`
  ADD PRIMARY KEY (`idDoktora`,`idSpecijalizacije`), ADD KEY `doktoriSpecijalizacija_Specijalizacija_fk` (`idSpecijalizacije`);

--
-- Indexes for table `lijek`
--
ALTER TABLE `lijek`
  ADD PRIMARY KEY (`idLijeka`);

--
-- Indexes for table `lijekpregled`
--
ALTER TABLE `lijekpregled`
  ADD KEY `idLijeka` (`idLijeka`), ADD KEY `idPregleda` (`idPregled`);

--
-- Indexes for table `narudzba`
--
ALTER TABLE `narudzba`
  ADD PRIMARY KEY (`idNarudzbe`), ADD KEY `idTipPregleda` (`idTipPregleda`), ADD KEY `idPacijenta` (`idPacijenta`), ADD KEY `idDoktora` (`idDoktora`);

--
-- Indexes for table `pacijent`
--
ALTER TABLE `pacijent`
  ADD PRIMARY KEY (`idPacijenta`);

--
-- Indexes for table `pregled`
--
ALTER TABLE `pregled`
  ADD PRIMARY KEY (`idPregled`), ADD KEY `idNarudzbe` (`idNarudzbe`);

--
-- Indexes for table `specijalizacija`
--
ALTER TABLE `specijalizacija`
  ADD PRIMARY KEY (`idSpecijalizacije`);

--
-- Indexes for table `tippregleda`
--
ALTER TABLE `tippregleda`
  ADD PRIMARY KEY (`idTipPregleda`), ADD KEY `idSpecijalizacija` (`idSpecijalizacija`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doktor`
--
ALTER TABLE `doktor`
  MODIFY `idDoktora` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `lijek`
--
ALTER TABLE `lijek`
  MODIFY `idLijeka` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `narudzba`
--
ALTER TABLE `narudzba`
  MODIFY `idNarudzbe` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `pacijent`
--
ALTER TABLE `pacijent`
  MODIFY `idPacijenta` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `pregled`
--
ALTER TABLE `pregled`
  MODIFY `idPregled` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `specijalizacija`
--
ALTER TABLE `specijalizacija`
  MODIFY `idSpecijalizacije` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tippregleda`
--
ALTER TABLE `tippregleda`
  MODIFY `idTipPregleda` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `doktorspecijalizacija`
--
ALTER TABLE `doktorspecijalizacija`
ADD CONSTRAINT `doktoriSpecijalizacija_Specijalizacija_fk` FOREIGN KEY (`idSpecijalizacije`) REFERENCES `specijalizacija` (`idSpecijalizacije`),
ADD CONSTRAINT `doktoriSpecijalizacija_doktor_fk` FOREIGN KEY (`idDoktora`) REFERENCES `doktor` (`idDoktora`);

--
-- Constraints for table `lijekpregled`
--
ALTER TABLE `lijekpregled`
ADD CONSTRAINT `lijekPregled_lijek_fk` FOREIGN KEY (`idLijeka`) REFERENCES `lijek` (`idLijeka`),
ADD CONSTRAINT `lijekPregled_pregled_fk` FOREIGN KEY (`idPregled`) REFERENCES `pregled` (`idPregled`);

--
-- Constraints for table `narudzba`
--
ALTER TABLE `narudzba`
ADD CONSTRAINT `narudzba_doktor_fk` FOREIGN KEY (`idDoktora`) REFERENCES `doktor` (`idDoktora`),
ADD CONSTRAINT `narudzba_pacijent_fk` FOREIGN KEY (`idPacijenta`) REFERENCES `pacijent` (`idPacijenta`),
ADD CONSTRAINT `narudzba_tip_pregleda_fk` FOREIGN KEY (`idTipPregleda`) REFERENCES `tippregleda` (`idTipPregleda`);

--
-- Constraints for table `pregled`
--
ALTER TABLE `pregled`
ADD CONSTRAINT `pregled_narudzba_fk` FOREIGN KEY (`idNarudzbe`) REFERENCES `narudzba` (`idNarudzbe`);

--
-- Constraints for table `tippregleda`
--
ALTER TABLE `tippregleda`
ADD CONSTRAINT `specijalizacija_tippregleda_fk` FOREIGN KEY (`idSpecijalizacija`) REFERENCES `specijalizacija` (`idSpecijalizacije`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 06 Lis 2017, 01:30
-- Wersja serwera: 10.1.28-MariaDB
-- Wersja PHP: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `dbls`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `routes`
--

CREATE TABLE `routes` (
  `id` int(11) NOT NULL,
  `object` text COLLATE utf8_german2_ci NOT NULL,
  `km` text COLLATE utf8_german2_ci NOT NULL,
  `info` text COLLATE utf8_german2_ci,
  `class` text COLLATE utf8_german2_ci NOT NULL,
  `relation` varchar(6) COLLATE utf8_german2_ci NOT NULL,
  `ICE_stop` text COLLATE utf8_german2_ci,
  `IC_stop` text COLLATE utf8_german2_ci,
  `RE_stop` text COLLATE utf8_german2_ci,
  `RB_stop` text COLLATE utf8_german2_ci,
  `ICE_time` int(11) DEFAULT NULL,
  `IC_time` int(11) DEFAULT NULL,
  `RE_time` int(11) DEFAULT NULL,
  `RB_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Zrzut danych tabeli `routes`
--

INSERT INTO `routes` (`id`, `object`, `km`, `info`, `class`, `relation`, `ICE_stop`, `IC_stop`, `RE_stop`, `RB_stop`, `ICE_time`, `IC_time`, `RE_time`, `RB_time`) VALUES
(2, 'Berlin - Gesundbrunnen', '-12,2', '', 'timetable-city-big', 'berlip', 'on', 'on', 'on', 'on', 0, 0, 0, 0),
(4, 'Berlin Hauptbahnhof', '-7,4', '', 'timetable-city-big', 'berlip', 'on', 'on', 'on', 'on', 5, 5, 5, 5),
(5, '	Berlin - Potsdamer Platz', '-1,3', '', 'timetable-city', 'berlip', '', '', 'on', 'on', 0, 0, 5, 5),
(6, 'Berlin - SÃ¼kreuz', '3,6', '', 'timetable-city-big', 'berlip', 'on', 'on', 'on', 'on', 5, 5, 2, 2),
(7, 'A 100', '', '', 'timetable-weg-a', 'berlip', '', '', '', '', 0, 0, 0, 0),
(9, 'von der Ringbahn', '', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(10, 'Rangierbahnhof Berlin-Tempelhof', '', '', 'timetable-altbf', 'berlip', '', '', '', '', 0, 0, 0, 0),
(11, 'nach Dresden', '5,0', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(12, 'Berlin Priesterweg', '5,2', '', 'timetable-sbahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(13, 'nach Blankenfelde', '', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(14, 'Berlin Südende', '6,6', '', 'timetable-sbahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(15, 'Teltowkanal', '6,9', '', 'timetable-river', 'berlip', '', '', '', '', 0, 0, 0, 0),
(16, 'Berlin-Lankwitz', '7,9', '', 'timetable-sbahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(17, 'Berlin-Lichterfelde Ost', '9,2', '', 'timetable-city', 'berlip', '', '', 'on', 'on', 0, 0, 5, 5),
(18, 'Berlin Osdorfer Straße', '10,7', '', 'timetable-sbahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(19, 'Berlin-Lichterfelde Süd', '11,6', '', 'timetable-sbahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(20, 'nach Teltow Stadt', '', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(21, 'Güteraußenring', '', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(22, 'Teltow', '14,2', '', 'timetable-city', 'berlip', '', '', '', '', 0, 0, 0, 0),
(23, 'Teltower Eisenbahn', '', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(24, 'Großbeeren', '18,4', '', 'timetable-city', 'berlip', '', '', '', '', 0, 0, 0, 0),
(25, 'zum GVZ Großbeeren', '', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(26, 'zum/vom Berliner Außenring', '19,0', '', 'timetable-city-big', 'berlip', '', '', '', '', 0, 0, 0, 0),
(27, 'Berliner Außenring', '20,0', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(28, 'zur ehem. IFA-Anschlussbahn', '', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(29, 'vom Berliner Außenring', '20,5', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(30, 'Birkengrund Nord (bis 1994)', '21,1', '', 'timetable-altbf', 'berlip', '', '', '', '', 0, 0, 0, 0),
(31, 'Birkengrund', '22,5', '', 'timetable-city', 'berlip', '', '', '', '', 0, 0, 0, 0),
(32, 'A 10', '', '', 'timetable-weg-a', 'berlip', '', '', '', '', 0, 0, 0, 0),
(33, 'Ludwigsfelde', '24,5', '', 'timetable-city', 'berlip', '', '', 'on', 'on', 0, 0, 8, 8),
(34, 'B 101', '', '', 'timetable-weg-b', 'berlip', '', '', '', '', 0, 0, 0, 0),
(35, 'Thyrow', '30,3', '', 'timetable-city', 'berlip', '', '', 'on', 'on', 0, 0, 5, 5),
(36, 'Trebbin', '34,3', '', 'timetable-city', 'berlip', '', '', 'on', 'on', 0, 0, 4, 4),
(37, 'B 246', '', '', 'timetable-weg-b', 'berlip', '', '', '', '', 0, 0, 0, 0),
(38, 'Nuthe', '', '', 'timetable-river', 'berlip', '', '', '', '', 0, 0, 0, 0),
(39, 'Scharfenbrück', '40,2', '', 'timetable-altbf', 'berlip', '', '', '', '', 0, 0, 0, 0),
(40, 'Woltersdorf (Luckenwalde)', '49,1', '', 'timetable-city', 'berlip', '', '', '', '', 0, 0, 0, 0),
(41, 'Luckenwalde', '49,8', '', 'timetable-city', 'berlip', '', '', 'on', 'on', 0, 0, 9, 9),
(42, 'B 101', '', '', 'timetable-weg-b', 'berlip', '', '', '', '', 0, 0, 0, 0),
(43, 'Forst-Zinna (bis 1994)', '54,8', '', 'timetable-altbf', 'berlip', '', '', '', '', 0, 0, 0, 0),
(44, 'Grüna-Kloster Zinna (bis 1994)', '58,6', '', 'timetable-altbf', 'berlip', '', '', '', '', 0, 0, 0, 0),
(45, 'von Zossen', '', '', 'timetable-altbf', 'berlip', '', '', '', '', 0, 0, 0, 0),
(46, 'Jüterbog', '62,8', '', 'timetable-city-big', 'berlip', '', '', 'on', 'on', 0, 0, 8, 8),
(47, 'B 102', '', '', 'timetable-weg-b', 'berlip', '', '', '', '', 0, 0, 0, 0),
(48, 'nach Potsdam', '', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(49, 'nach Röderau', '', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(50, 'Abzw Dennewitz von Potsdam', '', '', 'timetable-altbf', 'berlip', '', '', '', '', 0, 0, 0, 0),
(51, 'Niedergörsdorf', '69,2', '', 'timetable-city', 'berlip', '', '', 'on', 'on', 0, 0, 5, 5),
(52, 'Blönsdorf', '75,1', '', 'timetable-city', 'berlip', '', '', 'on', 'on', 0, 0, 5, 5),
(53, 'Klebitz (bis 13. Dezember 2014)', '79,0', '', 'timetable-altbf', 'berlip', '', '', '', '', 0, 0, 0, 0),
(54, 'Zahna', '84,0', '', 'timetable-city', 'berlip', '', '', 'on', 'on', 0, 0, 13, 13),
(55, 'Bülzig', '87,5', '', 'timetable-city', 'berlip', '', '', '', '', 0, 0, 0, 0),
(56, 'Zörnigall', '89,4', '', 'timetable-city', 'berlip', '', '', '', '', 0, 0, 0, 0),
(57, 'von Falkenberg/Elster', '', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(58, 'Lutherstadt Wittenberg Hbf', '94,8', '', 'timetable-city-big', 'berlip', 'on', 'on', 'on', 'on', 33, 33, 6, 6),
(59, 'nach Roßlau', '', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(60, 'B 187', '', '', 'timetable-weg-b', 'berlip', '', '', '', '', 0, 0, 0, 0),
(61, 'Elbebrücke Wittenberg', '95,7', '', 'timetable-river', 'berlip', '', '', '', '', 0, 0, 0, 0),
(62, 'Pratau', '98,3', '', 'timetable-city', 'berlip', '', '', 'on', 'on', 0, 0, 3, 3),
(63, 'nach Torgau', '', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(64, 'B 2', '', '', 'timetable-weg-b', 'berlip', '', '', '', '', 0, 0, 0, 0),
(65, 'Bergwitz', '104,2', '', 'timetable-city', 'berlip', '', '', '', 'on', 0, 0, 0, 4),
(66, 'nach Kemberg', '', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(67, 'Radis', '111,6', '', 'timetable-city', 'berlip', '', '', 'on', 'on', 0, 0, 8, 5),
(68, 'B 100', '', '', 'timetable-weg-b', 'berlip', '', '', '', '', 0, 0, 0, 0),
(69, 'Gräfenhainichen', '116,1', '', 'timetable-city', 'berlip', '', '', 'on', 'on', 0, 0, 4, 4),
(70, 'nach Oranienbaum', '116,8', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(71, 'von Oranienbaum', '121,3', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(72, 'Burgkemnitz', '121,5', '', 'timetable-city', 'berlip', '', '', '', 'on', 0, 0, 0, 3),
(73, 'Muldenstein', '126,2', '', 'timetable-city', 'berlip', '', '', 'on', 'on', 0, 0, 7, 5),
(74, 'Nördliche Muldeflutbrücke', '', '', 'timetable-river', 'berlip', '', '', '', '', 0, 0, 0, 0),
(75, 'Muldebrücke', '127,8', '', 'timetable-river', 'berlip', '', '', '', '', 0, 0, 0, 0),
(76, 'Leinebrücke', '', '', 'timetable-river', 'berlip', '', '', '', '', 0, 0, 0, 0),
(77, '	von Dessau und von Stumsdorf', '', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(78, 'B 183', '', '', 'timetable-weg-b', 'berlip', '', '', '', '', 0, 0, 0, 0),
(79, 'Bitterfeld', '131,6', '', 'timetable-city-big', 'berlip', '', 'on', 'on', 'on', 0, 17, 6, 6),
(80, 'B 100', '', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(81, 'nach Halle (Saale)', '', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(82, 'Petersroda', '55,0', '', 'timetable-city', 'berlip', '', '', '', 'on', 0, 0, 0, 4),
(83, '	Kilometerwechsel +1,498 km', '59,5/58,0', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(84, 'zum Werk Delitzsch', '', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(85, 'B 183a', '', '', 'timetable-weg-b', 'berlip', '', '', '', '', 0, 0, 0, 0),
(86, 'Delitzsch unt Bf', '60,4', '', 'timetable-city', 'berlip', '', '', 'on', 'on', 0, 0, 9, 5),
(87, 'nach Halle (Saale)', '', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(88, 'Bahnstrecke Halle–Cottbus', '', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(89, 'von Halle (Saale)', '61,8', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(90, 'Zschortau', '65,1', '', 'timetable-city', 'berlip', '', '', '', 'on', 0, 0, 0, 4),
(91, 'Delitzscher Kleinbahn', '', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(92, 'Rackwitz (b Leipzig)', '', '', 'timetable-city', 'berlip', '', '', '', 'on', 0, 0, 0, 4),
(93, 'Verbindung zur Delitzscher Kleinbahn', '', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(94, 'B 184', '', '', 'timetable-weg-b', 'berlip', '', '', '', '', 0, 0, 0, 0),
(95, 'B 14', '', '', 'timetable-weg-b', 'berlip', '', '', '', '', 0, 0, 0, 0),
(96, 'Neubaustrecke von Erfurt', '', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(97, 'nach Leipzig-Wiederitzsch (Güterring)', '73,9', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(98, 'Neuwiederitzsch', '74,6', '', 'timetable-altbf', 'berlip', '', '', '', '', 0, 0, 0, 0),
(99, 'Leipzig Messe', '75,0', '', 'timetable-city', 'berlip', '', '', 'on', 'on', 0, 0, 9, 3),
(100, 'von Leipzig-Wiederitzsch (Güterring)', '75,8', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(101, 'B 2', '', '', 'timetable-weg-b', 'berlip', '', '', '', '', 0, 0, 0, 0),
(102, '	Anschluss Quelle / Leipziger Messe / BMW', '', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(103, 'Leipzig-Mockau', '77,0', '', 'timetable-altbf', 'berlip', '', '', '', '', 0, 0, 0, 0),
(104, 'nach Engelsdorf (Güterring)', '', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(105, 'Leipzig Essener Straße (geplant', '77,3', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(106, 'nach Eilenburg', '', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(107, 'Leipzig Nord', '77,9', '', 'timetable-city', 'berlip', '', '', '', 'on', 0, 0, 0, 4),
(108, 'Bundesstraße 2 (Berliner Brücke)', '', '', 'timetable-weg-b', 'berlip', '', '', '', '', 0, 0, 0, 0),
(109, 'Parthe', '', '', 'timetable-river', 'berlip', '', '', '', '', 0, 0, 0, 0),
(110, 'nach Leipzig Bayer Bf (City-Tunnel)', '', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(111, 'von Halle (Saale) und von Großkorbetha', '', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(112, 'von Dresden', '', '', 'timetable-bahn', 'berlip', '', '', '', '', 0, 0, 0, 0),
(113, 'Leipzig Hbf', '81,3', '', 'timetable-city-big', 'berlip', 'on', 'on', 'on', 'on', 17, 17, 6, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` text COLLATE utf8_german2_ci NOT NULL,
  `password` text COLLATE utf8_german2_ci NOT NULL,
  `fragile_question` text COLLATE utf8_german2_ci NOT NULL,
  `fragile_answer` text COLLATE utf8_german2_ci NOT NULL,
  `name` text COLLATE utf8_german2_ci NOT NULL,
  `surname` text COLLATE utf8_german2_ci NOT NULL,
  `acc_lvl` text COLLATE utf8_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_german2_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `fragile_question`, `fragile_answer`, `name`, `surname`, `acc_lvl`) VALUES
(1, 'admin', '4df7aeac341782c56d24d57791bca148ee6762ee4dbb5a107aca49d5f9d1e4fe', '1', 'Kapsel', 'Admin', 'Admin', 'administrator'),
(2, 'archi_tektur', '6432e0816ac5b89899e2db3d8960eaefd2eec9d1e97fda4decba8db4cf14ed7b', '1', 'Kapsel', 'Oskar', 'Barcz', 'lokfuhrer');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Värd: localhost
-- Tid vid skapande: 10 nov 2018 kl 21:07
-- Serverversion: 10.1.28-MariaDB
-- PHP-version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `spelbacklog`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `spel`
--

CREATE TABLE `spel` (
  `Id` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `ReleaseYear` int(11) NOT NULL,
  `DateAdded` date NOT NULL,
  `ImageUrl` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `spel`
--

INSERT INTO `spel` (`Id`, `Title`, `ReleaseYear`, `DateAdded`, `ImageUrl`) VALUES
(2, 'Red Dead Redemption 2', 2018, '2018-10-16', 'https://static.giantbomb.com/uploads/scale_small/5/56742/3018545-3469813732-redde.jpg'),
(3, 'Forza Horizon 4', 2018, '2018-10-16', 'https://static.giantbomb.com/uploads/scale_small/8/87790/3027867-box_fh4.png'),
(4, 'Shadow of the Tomb Raider', 2018, '2018-10-16', 'https://static.giantbomb.com/uploads/scale_small/8/87790/3018621-box_sottr.png'),
(6, 'Hitman', 2016, '2018-10-16', 'https://static.giantbomb.com/uploads/scale_small/0/3699/2950665-hitman+v3.jpg'),
(9, 'Marvel\'s Spider-Man', 2018, '2018-10-16', 'https://static.giantbomb.com/uploads/scale_small/0/3699/3037524-marvel%27s+spider-man.jpg'),
(10, 'Assassin\'s Creed Odyssey', 2018, '2018-10-16', 'https://static.giantbomb.com/uploads/scale_small/0/3699/3028052-assassins+creed+-+odyssey+v3.jpg'),
(11, 'Hitman 2', 2018, '2018-10-16', 'https://static.giantbomb.com/uploads/scale_small/8/87790/3034103-box_hm2.png'),
(12, 'The Legend of Zelda: Breath of the Wild', 2017, '2018-10-16', 'https://static.giantbomb.com/uploads/scale_small/0/3699/2920687-the+legend+of+zelda+-+breath+of+the+wild+v7.jpg');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `spel`
--
ALTER TABLE `spel`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `spel`
--
ALTER TABLE `spel`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Stř 11. kvě 2022, 14:00
-- Verze serveru: 10.4.19-MariaDB
-- Verze PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `projekt_i2b`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `rezervace`
--

CREATE TABLE `rezervace` (
  `ID_rezervace` int(11) NOT NULL,
  `uzivatel` int(11) NOT NULL,
  `datum_rezervace` date NOT NULL,
  `rezervona_doba` time NOT NULL,
  `ID_trenera` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `rezervace`
--

INSERT INTO `rezervace` (`ID_rezervace`, `uzivatel`, `datum_rezervace`, `rezervona_doba`, `ID_trenera`) VALUES
(2, 2, '2022-03-18', '11:30:00', 1),
(4, 2, '2022-04-24', '06:00:00', 1),
(5, 3, '2022-05-06', '15:00:00', 1),
(6, 3, '2022-05-09', '16:00:00', 1),
(8, 2, '2022-05-06', '05:00:00', 1),
(15, 1, '2022-05-13', '07:00:00', 2);

-- --------------------------------------------------------

--
-- Struktura tabulky `treneri`
--

CREATE TABLE `treneri` (
  `ID_trenera` int(11) NOT NULL,
  `jmeno` varchar(30) NOT NULL,
  `prijmeni` varchar(30) NOT NULL,
  `popis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `treneri`
--

INSERT INTO `treneri` (`ID_trenera`, `jmeno`, `prijmeni`, `popis`) VALUES
(1, 'fsdf', 'dfsfsd', 'dsfsdfsd'),
(2, 'Víězslav', 'Hudeček', 'Je to Vítek, neznáte ho snad???????!!!!!!');

-- --------------------------------------------------------

--
-- Struktura tabulky `uzivatele`
--

CREATE TABLE `uzivatele` (
  `ID_uzivatele` int(11) NOT NULL,
  `login` varchar(30) COLLATE utf8_czech_ci NOT NULL,
  `heslo` varchar(40) COLLATE utf8_czech_ci NOT NULL,
  `role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `uzivatele`
--

INSERT INTO `uzivatele` (`ID_uzivatele`, `login`, `heslo`, `role`) VALUES
(3, 'sus', 'a0f1490a20d0211c997b44bc357e1972deab8ae3', 3),
(4, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1),
(5, 'Pepa', '899ed5ef71b22ad224798d2b255ea073fdf4de20', 2),
(9, 'asdasd', 'f10e2821bbbea527ea02200352313bc059445190', 3);

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `rezervace`
--
ALTER TABLE `rezervace`
  ADD PRIMARY KEY (`ID_rezervace`),
  ADD UNIQUE KEY `datum_rezervace` (`datum_rezervace`,`rezervona_doba`,`ID_trenera`),
  ADD KEY `Omezeni_treneri` (`ID_trenera`);

--
-- Indexy pro tabulku `treneri`
--
ALTER TABLE `treneri`
  ADD PRIMARY KEY (`ID_trenera`);

--
-- Indexy pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
  ADD PRIMARY KEY (`ID_uzivatele`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `rezervace`
--
ALTER TABLE `rezervace`
  MODIFY `ID_rezervace` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pro tabulku `treneri`
--
ALTER TABLE `treneri`
  MODIFY `ID_trenera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
  MODIFY `ID_uzivatele` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `rezervace`
--
ALTER TABLE `rezervace`
  ADD CONSTRAINT `Omezeni_treneri` FOREIGN KEY (`ID_trenera`) REFERENCES `treneri` (`ID_trenera`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

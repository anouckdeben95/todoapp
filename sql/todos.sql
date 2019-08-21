-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 21 aug 2019 om 23:30
-- Serverversie: 10.1.38-MariaDB
-- PHP-versie: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todos`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tl_comments`
--

CREATE TABLE `tl_comments` (
  `id` int(11) NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `tl_comments`
--

INSERT INTO `tl_comments` (`id`, `message`, `task_id`) VALUES
(1, 'Vroeger aan beginnen', 1),
(2, 'Oef 3-7+11', 1),
(10, 'Test breuken', 1),
(11, 'herhalen blz 20-45', 2),
(12, 'Lees p 25-29', 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tl_lists`
--

CREATE TABLE `tl_lists` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `tl_lists`
--

INSERT INTO `tl_lists` (`id`, `name`, `user_id`, `active`) VALUES
(1, 'Homework', 3, 1),
(2, 'Party', 7, 1),
(3, 'Clean Up', 3, 1),
(4, 'Blokken', 3, 1),
(6, 'Zomer', 3, 1),
(7, '3D printer', 6, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tl_tasks`
--

CREATE TABLE `tl_tasks` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` int(3) NOT NULL,
  `deadline` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `list_id` int(11) NOT NULL,
  `done` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `tl_tasks`
--

INSERT INTO `tl_tasks` (`id`, `name`, `duration`, `deadline`, `user_id`, `list_id`, `done`) VALUES
(1, 'Wiskunde', 45, '2019-08-20', 3, 1, 1),
(2, 'Nederlands', 35, '2019-08-22', 3, 1, 1),
(3, 'Gedragswetenschappen', 80, '2019-08-23', 3, 1, 0),
(5, 'NW', 25, '2019-08-25', 3, 1, 0),
(6, 'LO', 60, '2019-08-28', 3, 1, 0),
(7, 'Esthetica', 15, '0000-00-00', 3, 1, 1),
(8, 'Geschiedenis', 80, '0000-00-00', 3, 1, 0),
(9, 'Expressie', 5, '0000-00-00', 3, 1, 0),
(10, 'Frans', 60, '2019-08-16', 3, 1, 1),
(11, 'Duits', 12, '0000-00-00', 3, 1, 0),
(12, 'Latijn', 5, '2019-08-24', 3, 1, 1),
(13, 'Doodskop', 45, '2019-08-22', 6, 7, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tl_uploads`
--

CREATE TABLE `tl_uploads` (
  `id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tl_users`
--

CREATE TABLE `tl_users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `tl_users`
--

INSERT INTO `tl_users` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `isAdmin`, `active`) VALUES
(1, 'Anouck', 'De Ben', 'Nouckie', 'anouck.deben@gmail.com', '$2y$10$RfVaTGSMDA60yprbCptJdOU8aQnfGRFYyMBrrTo8jKghq6zjj0JdK', 0, 1),
(2, 'Gilles', 'De Ben', 'gilleske', 'gdb@hotmail.com', '$2y$10$ocw5GRh1rl4F0Fq/Be1b4uJmz7irHEuHdXx6AZQIpshdmUsAVnlcS', 1, 1),
(3, 'Anna', 'Suykens', 'AnnaS', 'amsuykens@gmail.com', '$2y$10$K2oE2ZxL8WJd6FmnZcsnA.FrLrfXjjdKdWnRNYaWA5TfsjBipOA22', 1, 1),
(4, 'Milow', 'De Coster', 'Mickey_DC', 'mickeydc@skynet.com', '$2y$10$yINIVHefFx3wIuN61Vck0OdzS4cRncTaW9d01U5laNOt9nLqh5MNq', 0, 1),
(6, 'Stef', 'Bulteel', 'stef.bs', 'stef.bs@gmail.com', '$2y$10$NzIYTjv1BSrIAmiMWazwU.fAURdpjQU6OF/orcTAP4rrz8an.3P.u', 0, 1),
(7, 'Cindy', 'Lauper', 'lauc', 'cindy.lauper@hotmail.com', '$2y$10$LkkH53SUGYGCn2HIS0yHDu8TGvVy7B9WuiM9mx/yc0B65f9t7fBgi', 0, 1);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `tl_comments`
--
ALTER TABLE `tl_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `tl_lists`
--
ALTER TABLE `tl_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `tl_tasks`
--
ALTER TABLE `tl_tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `tl_uploads`
--
ALTER TABLE `tl_uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `tl_users`
--
ALTER TABLE `tl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `tl_comments`
--
ALTER TABLE `tl_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT voor een tabel `tl_lists`
--
ALTER TABLE `tl_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT voor een tabel `tl_tasks`
--
ALTER TABLE `tl_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT voor een tabel `tl_uploads`
--
ALTER TABLE `tl_uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT voor een tabel `tl_users`
--
ALTER TABLE `tl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

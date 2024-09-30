-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 30 sep 2024 om 11:52
-- Serverversie: 10.4.28-MariaDB
-- PHP-versie: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tle_1`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `friends`
--

INSERT INTO `friends` (`id`, `user_id`, `friend_id`, `created_at`) VALUES
(1, 17, 4, '2024-09-25 11:33:12'),
(2, 17, 4, '2024-09-25 11:33:45'),
(3, 17, 6, '2024-09-25 11:35:47'),
(4, 17, 8, '2024-09-25 11:46:21'),
(5, 17, 17, '2024-09-25 11:46:24'),
(6, 17, 4, '2024-09-25 12:13:05'),
(7, 16, 5, '2024-09-30 08:29:43'),
(8, 16, 16, '2024-09-30 09:27:25');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `friend_id` (`friend_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

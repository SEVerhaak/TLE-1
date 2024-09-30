-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 30 sep 2024 om 11:51
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
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `photo` mediumblob NOT NULL,
  `score` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `f_name`, `l_name`, `phone`, `photo`, `score`) VALUES
(4, '123@gmail.com', '$2y$10$Vr.WmgsxFzCS.Wgdg0FifuO5TcO9uudBcHnjq/fNFrpP67104Oi5u', 'Elisa', 'Zornig', '0612345678', '', 0),
(5, 'severhaak@hotmail.nl', '$2y$10$X5CKJFggmKLUYJeSSmoBOO6FzF7WsVcpvTek5I7eQ9/6eXGjChiGq', 'Bas', 'Verhaak', '06123456789', '', 0),
(6, 'aejf@gjs.com', '$2y$10$o49hrTXOOYv75iiEdd985eS20RQmBv8GhtJRgSTycqv8Im9UneZ0q', '`baw', 'wfg', '30634634', '', 0),
(8, 'yo@yo.com', '$2y$10$jDgo9MkKUS5phgUHjHGEre8kjvTLHcDR3Zr.SSdSIXxyoem/XH9rO', 'gfd', 'esg', '032323542', '', 0),
(10, 'yo@yo2.com', '$2y$10$RPm/YTiQn.yeZVRD4wzQB.qy51pUSBCf84fYYm.OcEt0/p9L.Zmw2', 'gfd', 'esg', '032323542', '', 0),
(11, 'yo@yo3.com', '$2y$10$hzhxNKxGUggVL6zjZlcrPeshgBc0qr5bDd3sXfpiQnj3m4aysLuiK', 'gfd', 'esg', '032323542', '', 0),
(12, 'fdghj@ghsd.com', '$2y$10$O7k2ciuB95eHZKTfiuxrluYozQnXaPg/hgU9DiFVCBSdaMXJRjlGC', 'gfgdhf', 'dgfdhfjk', '123467890', '', 0),
(13, 'sdfsgd@gamailc.com', '$2y$10$K69GAXJzyChHU9WVtd0k6O0/1Be4fYBT24.5o6PyyIlpq02IPEnEG', 'asfdgdg', 'ads@', '924583643549', '', 0),
(14, 'sfdgf', '$2y$10$S8x83CnIgbvQKuxtjBvOE.nYovvLkQ8pFzsoOxLE1fsjTJb1NDS06', 'fdsgdf', 'adsfgdg', 'asfdg', '', 0),
(15, 'fkldskfglk@gmail.com', '$2y$10$hbNjh4lipdue321fi9uQ9.CR.ZinZUZ8Ci7emKbGMcGcPaQ/kAXRi', 'sdfghjgsa', 'dgfhsafdg', 'vqwesgfdkl', '', 0),
(16, '1056796@hr.nl', '$2y$10$wxOiGKSQ3SankDcbDi2yeOWS.qYGbQgVrLtasHm/jBcjmjHjkGEiC', 'Wiewoe', 'zes', 'iurfpuqo89374', '', 20);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 16 sep 2024 om 14:41
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
-- Tabelstructuur voor tabel `products`
--

CREATE TABLE `products` (
  `EAN` varchar(13) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `producer` varchar(255) DEFAULT NULL,
  `diet_info` text DEFAULT NULL,
  `materials` text DEFAULT NULL,
  `eco_impact` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `products`
--

INSERT INTO `products` (`EAN`, `name`, `description`, `producer`, `diet_info`, `materials`, `eco_impact`) VALUES
('3017620422002', 'Luxe Dinerkaarsen Set', 'Stijlvolle set van zes dinerkaarsen in verschillende kleuren, gemaakt van plantaardige was.', 'CandleCreations', 'N.v.t.', 'Plantaardige was, katoenen lont.', '6'),
('3800020439428', 'GreenLeaf Toiletpapier', 'Zacht en stevig toiletpapier, gemaakt van 100% gerecycled papier.', 'GreenLeaf', 'N.v.t.', 'Gerecycled papier.', '7'),
('4005900199537', 'Nivea Soft Crème', 'Hydraterende bodycrème voor dagelijks gebruik met jojobaolie en vitamine E.', 'Nivea', 'Dierproefvrij.', 'Pot van gerecycled kunststof.', '5'),
('4006381333933', 'Vitality Multi-Vitaminen Gummies', 'Gezonde gummies vol met essentiële vitamines zoals C, D, en B12 voor extra energie en immuunondersteuning.', 'Vitality Supplements', 'Glutenvrij, vegetarisch, geen kunstmatige kleurstoffen.', 'Fles van gerecycled plastic (rPET).', '7'),
('4008496888658', 'PureBreeze Luchtreiniger', 'Stille en energiezuinige luchtreiniger die allergenen en geuren uit de lucht filtert.', 'PureBreeze Technologies', 'N.v.t.', 'Gerecycled kunststof en metaal.', '7'),
('4897073924142', 'AquaPure Waterfles', 'Herbruikbare waterfles van glas met een siliconen hoes, ideaal voor dagelijks gebruik.', 'AquaPure', 'N.v.t.', 'Glas en biologisch afbreekbare siliconen.', '8'),
('5000128384373', 'NutriFit Havermoutrepen', 'Energierijke havermoutrepen met noten en gedroogd fruit, perfect als snack voor onderweg.', 'NutriFit Foods', 'Vegan, glutenvrij, geen toegevoegde suikers.', 'Verpakking van recyclebaar papier.', '7'),
('5060212380266', 'EcoFlow Draagbare Zonnepaneel', 'Opvouwbaar en draagbaar zonnepaneel voor opladen van apparaten tijdens kampeertrips.', 'EcoFlow', 'N.v.t.', 'Aluminium frame, silicium zonnecellen.', '9'),
('5411188113148', 'EcoFresh Herbruikbare Groentezakken', 'Set van vijf herbruikbare zakken voor groente en fruit, ideaal voor zero-waste boodschappen.', 'EcoFresh Goods', 'N.v.t.', 'Biologisch katoen.', '9'),
('5702015869958', 'Lego Nature Adventures Set', 'Bouwset met natuurthema, inclusief dierenfiguren en een boslandschap.', 'LEGO', 'N.v.t.', 'Gerecycled plastic.', '5'),
('5999000056713', 'EcoBalance Yogamat', 'Antislip yogamat gemaakt van natuurlijke rubber, geschikt voor alle yogastijlen.', 'EcoBalance Yoga', 'N.v.t.', '100% natuurlijk rubber.', '8'),
('6941059632535', 'PureSound Noise-Cancelling Koptelefoon', 'Draadloze koptelefoon met actieve noise-cancelling en lange batterijduur.', 'PureSound Technologies', 'N.v.t.', 'Gerecycled plastic en metalen onderdelen.', '6'),
('7290010426314', 'AromaLux Geurkaarsen', 'Luxe geurkaarsen met natuurlijke oliën, verkrijgbaar in lavendel en sandelhout.', 'AromaLux Candles', 'N.v.t.', 'Sojawas, glazen pot.', '7'),
('7613035961586', 'AlpenNature Bio Muesli', 'Een voedzame biologische muesli met havervlokken, amandelen, en rozijnen. Ideaal voor een gezond ontbijt.', 'AlpenNature', 'Vegan, geen toegevoegde suikers, vezelrijk.', 'Verpakking van gerecycled papier en plastic.', '8'),
('7891025123136', 'NutriGreen Plantaardig Eiwitpoeder', 'Eiwitpoeder op basis van erwten en rijst, perfect voor sporters en vegans.', 'NutriGreen Supplements', 'Vegan, glutenvrij, geen kunstmatige zoetstoffen.', 'Pot gemaakt van gerecycled plastic.', '6'),
('8014966407219', 'DolceGusto Koffiecups - Espresso Intenso', 'Sterke en intense espressokoffie in biologisch afbreekbare cups.', 'DolceGusto', '100% Arabica koffiebonen.', 'Biologisch afbreekbare cups.', '7'),
('8421691321459', 'BambooBasics Herensokken', 'Zachte en ademende sokken gemaakt van duurzaam bamboe, in een set van drie paar.', 'BambooBasics', 'N.v.t.', 'Bamboevezels.', '8'),
('8711252001457', 'GreenPure Bio-Kruidenthee', 'Een verfrissende, biologisch gecertificeerde kruidenthee met munt, kamille en citroenmelisse.', 'GreenPure Organics', 'Vegan, glutenvrij, geen toegevoegde suikers.', 'Composteerbare theezakjes van ongebleekt katoen.', '8'),
('8714574678956', 'SunShield SPF 50 Zonnecrème', 'Waterbestendige zonnecrème met hoge beschermingsfactor en natuurlijke ingrediënten.', 'SunShield Naturals', 'Vegan, dierproefvrij.', 'Fles van gerecycled plastic.', '6'),
('8806088720154', 'FreshSkin Hydraterende Gezichtsgel', 'Lichtgewicht gezichtscrème met aloë vera en hyaluronzuur voor intense hydratatie.', 'FreshSkin Care', 'Vegan, vrij van parabenen en sulfaten.', 'Gerecycled glas en kunststof.', '6');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`EAN`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

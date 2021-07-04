SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE IF NOT EXISTS `film` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ime` varchar(30) COLLATE utf8_croatian_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ;

INSERT INTO `film` (`id`, `ime`) VALUES
(1, 'SPIDER-MAN'),
(2, 'SHREK'),
(3, 'IRONMAN');

CREATE TABLE IF NOT EXISTS `korisnik` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ime` varchar(20) COLLATE utf8_croatian_ci DEFAULT NULL,
  `password` varchar(20) COLLATE utf8_croatian_ci NOT NULL,
  `register_sequence` varchar(30) COLLATE utf8_croatian_ci DEFAULT NULL,
  `has_registered` int NOT NULL DEFAULT '0',
  `popust` float NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
);

INSERT INTO `korisnik` (`id`, `ime`, `password`, `register_sequence`, `has_registered`, `popust`) VALUES
(1, 'Mirko', 'm', '1234', 1, 0.25),
(2, 'Nikša', 'n', '1', 0, 0.5);

CREATE TABLE IF NOT EXISTS `prikaz` (
  `id` int NOT NULL AUTO_INCREMENT,
  `film_id` int DEFAULT NULL,
  `dvorana_id` int DEFAULT NULL,
  `red_br_prikazivanja` int DEFAULT NULL,
  `vrijeme_prikaza` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_prikaz_film` (`film_id`),
  KEY `fk_prikaz_dvorana` (`dvorana_id`)
);

INSERT INTO `prikaz` (`id`, `film_id`, `dvorana_id`, `red_br_prikazivanja`, `vrijeme_prikaza`) VALUES
(1, 2, 2, 1, '2021-07-14 16:00:00'),
(2, 3, 3, 1, '2021-07-22 18:00:00');

CREATE TABLE IF NOT EXISTS `rezervacija` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `prikaz_id` int NOT NULL,
  `kupljeno` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_rezervacija_prikaz` (`prikaz_id`),
  KEY `fk_rezervacija_korisnik` (`user_id`)
);

INSERT INTO `rezervacija` (`id`, `user_id`, `prikaz_id`, `kupljeno`) VALUES
(1, 1, 2, 0),
(2, 2, 1, 0);

CREATE TABLE IF NOT EXISTS `sjedalo` (
  `red` int NOT NULL,
  `broj_u_redu` int NOT NULL,
  `rezervacija_id` int NOT NULL,
  PRIMARY KEY (`broj_u_redu`,`rezervacija_id`,`red`),
  KEY `fk_sjedalo_rezervacija` (`rezervacija_id`)
);

INSERT INTO `sjedalo` (`red`, `broj_u_redu`, `rezervacija_id`) VALUES
(2, 2, 1),
(2, 3, 1),
(2, 4, 1),
(5, 6, 2);

CREATE TABLE IF NOT EXISTS `_dvorane` (
  `id` int NOT NULL AUTO_INCREMENT,
  `velicina` varchar(10) COLLATE utf8_croatian_ci DEFAULT NULL,
  `broj_sjedala` int DEFAULT NULL,
  `broj_redova` int DEFAULT NULL,
  `broj_sjedala_po_redu` int DEFAULT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `_dvorane` (`id`, `velicina`, `broj_sjedala`, `broj_redova`, `broj_sjedala_po_redu`) VALUES
(1, 'SREDNJA', 50, 5, 10),
(2, 'MALA', 24, 4, 6),
(3, 'VELIKA', 200, 10, 20);


/*ALTER TABLE `prikaz`
  ADD CONSTRAINT `fk_prikaz_dvorana` FOREIGN KEY (`dvorana_id`) REFERENCES `_dvorane` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_prikaz_film` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `rezervacija`
  ADD CONSTRAINT `fk_rezervacija_korisnik` FOREIGN KEY (`user_id`) REFERENCES `korisnik` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_rezervacija_prikaz` FOREIGN KEY (`prikaz_id`) REFERENCES `prikaz` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `sjedalo`
  ADD CONSTRAINT `fk_sjedalo_rezervacija` FOREIGN KEY (`rezervacija_id`) REFERENCES `rezervacija` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
*/
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

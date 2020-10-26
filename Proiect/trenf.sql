-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: iun. 06, 2020 la 07:51 PM
-- Versiune server: 10.4.11-MariaDB
-- Versiune PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `trenf`
--
CREATE DATABASE IF NOT EXISTS `trenf` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `trenf`;

DELIMITER $$
--
-- Proceduri
--
DROP PROCEDURE IF EXISTS `actualizare_plecare_sosire`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizare_plecare_sosire` (IN `plecare` VARCHAR(20), IN `sosire` VARCHAR(20), IN `id_ruta` INT(10))  BEGIN
UPDATE ruta
SET plecare = ADDTIME(plecare, "2:00:00"),
 sosire = ADDTIME(sosire, "2:00:00")
 where ruta.id_ruta = id_ruta;
END$$

DROP PROCEDURE IF EXISTS `creeaza_tabel_reducere_lunara`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `creeaza_tabel_reducere_lunara` ()  BEGIN
    CREATE TABLE reducere
    (
    id_reducere int(10) not null auto_increment,
    reducere int(10) not null,
    inceput_reducere date not null,
    sfarsit_reducere date not null,
    id_cont int(10) not null,
    PRIMARY key(id_reducere),
        FOREIGN Key(id_cont) references cont(id_cont)
    );
 END$$

DROP PROCEDURE IF EXISTS `delete_rezervare`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_rezervare` (IN `id_plata` INT(10), IN `id_rezervare` INT(10))  BEGIN
DELETE plata, rezervare
FROM plata
LEFT JOIN rezervare
ON rezervare.id_rezervare = plata.id_rezervare
WHERE plata.id_plata = id_plata  and rezervare.id_rezervare = id_rezervare;
END$$

DROP PROCEDURE IF EXISTS `delete_utilizator_cu_mesaj`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_utilizator_cu_mesaj` (IN `id_cont` INT(10), IN `id_contact` INT(10))  BEGIN
  DELETE cont, contact
  FROM cont
  LEFT JOIN contact
  ON contact.id_cont = cont.id_cont
  WHERE cont.id_cont = id_cont  and contact.id_contact = id_contact;
  END$$

DROP PROCEDURE IF EXISTS `preia_date_pentru_rezervare`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `preia_date_pentru_rezervare` (IN `data_rezervare` VARCHAR(20), IN `id_cont` INT(10), IN `id_tren` INT(10), IN `id_loc` INT(10))  BEGIN
    insert into rezervare (data_rezervare, id_cont, id_tren, id_loc) values (data_rezervare, id_cont, id_tren, id_loc);
END$$

--
-- Funcții
--
DROP FUNCTION IF EXISTS `calculare_viteza`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `calculare_viteza` (`distanta` INT(5), `durata` INT) RETURNS DOUBLE NO SQL
    DETERMINISTIC
return distanta/durata$$

DROP FUNCTION IF EXISTS `f_discount_pret`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `f_discount_pret` (`varsta` INT, `pret` DOUBLE) RETURNS DOUBLE NO SQL
    DETERMINISTIC
BEGIN
declare reducere_pret double;

if(varsta>=14 and varsta<=24) then
set reducere_pret = pret - (pret*50/100);
ELSEIF(varsta >24 and varsta<=50) then
set reducere_pret = pret - (pret*10/100);
ELSEIF (varsta>50) then
set reducere_pret = pret - (pret*25/100);
end if;
return (reducere_pret);
end$$

DROP FUNCTION IF EXISTS `genereaza_parola`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `genereaza_parola` () RETURNS VARCHAR(100) CHARSET utf8mb4 BEGIN

SET @set = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%?{}';
SET @lungime = length(@set);

SET @randomPassword = '';

WHILE length(@randomPassword) < 12
    DO
    SET @randomPassword = concat(@randomPassword, substring(@set, CEILING(RAND() * @lungime), 1));
END WHILE;

RETURN @randomPassword;
END$$

DROP FUNCTION IF EXISTS `lei_to_euro`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `lei_to_euro` (`lei` DOUBLE) RETURNS DOUBLE BEGIN
  DECLARE euro double;
  DECLARE valoare double;
  SET @valoare = 4.84;
  SET @euro = lei * @valoare;
  RETURN @euro;
END$$

DROP FUNCTION IF EXISTS `mesaj_reamintire_rezervare`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `mesaj_reamintire_rezervare` (`data_rezervare` DATE) RETURNS VARCHAR(100) CHARSET utf8mb4 NO SQL
    DETERMINISTIC
BEGIN
DECLARE mesaj varchar(100);
IF(DATEDIFF(data_rezervare, CURDATE()) = 1) then
set mesaj = "This is a reminder. Check your booking information.";
end if;
return (mesaj);
end$$

DROP FUNCTION IF EXISTS `transforma_prima_litera`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `transforma_prima_litera` (`str` VARCHAR(30)) RETURNS VARCHAR(30) CHARSET utf8 BEGIN  
  DECLARE c CHAR(1);  
  DECLARE s VARCHAR(255);  
  DECLARE i INT DEFAULT 1;  
  DECLARE bool INT DEFAULT 1;  
  DECLARE punct CHAR(17) DEFAULT ' ()[]{},.-_!@;:?/';  
  SET s = LCASE(str);  
  WHILE i < LENGTH(str) DO  
     BEGIN  
       SET c = SUBSTRING(s, i, 1);  
       IF LOCATE(c, punct) > 0 THEN  
        SET bool = 1;  
      ELSEIF bool=1 THEN  
        BEGIN  
          IF c >= 'a' AND c <= 'z' THEN  
             BEGIN  
               SET s = CONCAT(LEFT(s, i-1), UCASE(c), SUBSTRING(s, i+1));  
               SET bool = 0;  
             END;  
           ELSEIF c >= '0' AND c <= '9' THEN  
            SET bool = 0;  
          END IF;  
        END;
      END IF;  
      SET i = i+1;  
    END;  
  END WHILE;  
  RETURN s;  
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `cont`
--
-- Creare: mai 28, 2020 la 07:53 PM
-- Ultima actualizare: iun. 06, 2020 la 04:58 PM
--

DROP TABLE IF EXISTS `cont`;
CREATE TABLE IF NOT EXISTS `cont` (
  `id_cont` int(10) NOT NULL AUTO_INCREMENT,
  `nume` varchar(10) NOT NULL,
  `prenume` varchar(10) NOT NULL,
  `email` varchar(40) NOT NULL,
  `parola` varchar(100) NOT NULL,
  `varsta` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_cont`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

--
-- RELAȚII PENTRU TABELE `cont`:
--

--
-- Eliminarea datelor din tabel `cont`
--

INSERT INTO `cont` (`id_cont`, `nume`, `prenume`, `email`, `parola`, `varsta`) VALUES
(13, 'Emilia', 'Truta', 'emilia.truta22@yahoo.com', 'aafcc615b67a5a2e360fdd7b390060ee', '22'),
(19, 'Test', 'Name', 'test1@yahoo.com', '098f6bcd4621d373cade4e832627b4f6', NULL);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `contact`
--
-- Creare: iun. 04, 2020 la 05:19 PM
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id_contact` int(10) NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `mesaj` varchar(1000) NOT NULL,
  `id_cont` int(10) NOT NULL,
  PRIMARY KEY (`id_contact`),
  KEY `contact_ibfk_1` (`id_cont`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- RELAȚII PENTRU TABELE `contact`:
--   `id_cont`
--       `cont` -> `id_cont`
--

--
-- Eliminarea datelor din tabel `contact`
--

INSERT INTO `contact` (`id_contact`, `data`, `mesaj`, `id_cont`) VALUES
(3, '2020-05-30', 'Acest mesaj este unul de test', 13),
(7, '2020-06-02', 'Imi place!', 13),
(10, '2020-06-03', 'hbh', 13);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `loc`
--
-- Creare: mai 28, 2020 la 07:44 PM
--

DROP TABLE IF EXISTS `loc`;
CREATE TABLE IF NOT EXISTS `loc` (
  `id_loc` int(10) NOT NULL AUTO_INCREMENT,
  `loc` varchar(3) NOT NULL,
  `status_loc` varchar(1) NOT NULL,
  PRIMARY KEY (`id_loc`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4;

--
-- RELAȚII PENTRU TABELE `loc`:
--

--
-- Eliminarea datelor din tabel `loc`
--

INSERT INTO `loc` (`id_loc`, `loc`, `status_loc`) VALUES
(1, '1A', '1'),
(2, '2A', '0'),
(3, '3A', '1'),
(4, '4A', '0'),
(5, '5A', '1'),
(6, '6A', '0'),
(7, '7A', '0'),
(8, '8A', '1'),
(9, '9A', '0'),
(10, '10A', '0'),
(11, '11A', '0'),
(12, '12A', '0'),
(13, '1B', '0'),
(14, '2B', '0'),
(15, '3B', '0'),
(16, '4B', '0'),
(17, '5B', '0'),
(18, '6B', '0'),
(19, '7B', '0'),
(20, '8B', '0'),
(21, '9B', '1'),
(22, '10B', '1'),
(23, '11B', '1'),
(24, '12B', '0'),
(25, '1C', '0'),
(26, '2C', '0'),
(27, '3C', '0'),
(28, '4C', '0'),
(29, '5C', '0'),
(30, '6C', '0'),
(31, '7C', '0'),
(32, '8C', '0'),
(33, '9C', '0'),
(34, '10C', '0'),
(35, '11C', '0'),
(36, '12C', '0');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `plata`
--
-- Creare: mai 29, 2020 la 01:33 PM
-- Ultima actualizare: iun. 06, 2020 la 05:16 PM
--

DROP TABLE IF EXISTS `plata`;
CREATE TABLE IF NOT EXISTS `plata` (
  `id_plata` int(10) NOT NULL AUTO_INCREMENT,
  `card_numar` varchar(16) NOT NULL,
  `data_expirare` varchar(4) NOT NULL,
  `cod_securitate` varchar(3) NOT NULL,
  `pret_final` double NOT NULL,
  `id_rezervare` int(10) NOT NULL,
  PRIMARY KEY (`id_plata`),
  KEY `id_rezervare` (`id_rezervare`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4;

--
-- RELAȚII PENTRU TABELE `plata`:
--   `id_rezervare`
--       `rezervare` -> `id_rezervare`
--

--
-- Eliminarea datelor din tabel `plata`
--

INSERT INTO `plata` (`id_plata`, `card_numar`, `data_expirare`, `cod_securitate`, `pret_final`, `id_rezervare`) VALUES
(33, '9991111444411551', '2020', '111', 118.27, 99),
(35, '12345678910', '2020', '121', 13, 102);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `program_zile`
--
-- Creare: mai 28, 2020 la 07:44 PM
--

DROP TABLE IF EXISTS `program_zile`;
CREATE TABLE IF NOT EXISTS `program_zile` (
  `id_program` int(10) NOT NULL AUTO_INCREMENT,
  `ziua` varchar(10) NOT NULL,
  PRIMARY KEY (`id_program`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- RELAȚII PENTRU TABELE `program_zile`:
--

--
-- Eliminarea datelor din tabel `program_zile`
--

INSERT INTO `program_zile` (`id_program`, `ziua`) VALUES
(1, 'Sun'),
(2, 'Mon'),
(3, 'Tue'),
(4, 'Wed'),
(5, 'Thu'),
(6, 'Fri'),
(7, 'Sat');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `reducere`
--
-- Creare: iun. 02, 2020 la 06:32 AM
--

DROP TABLE IF EXISTS `reducere`;
CREATE TABLE IF NOT EXISTS `reducere` (
  `id_reducere` int(10) NOT NULL AUTO_INCREMENT,
  `reducere` int(10) NOT NULL,
  `inceput_reducere` date NOT NULL,
  `sfarsit_reducere` date NOT NULL,
  `id_cont` int(10) NOT NULL,
  PRIMARY KEY (`id_reducere`),
  KEY `id_cont` (`id_cont`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELAȚII PENTRU TABELE `reducere`:
--   `id_cont`
--       `cont` -> `id_cont`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `rezervare`
--
-- Creare: mai 29, 2020 la 01:06 PM
-- Ultima actualizare: iun. 06, 2020 la 05:16 PM
--

DROP TABLE IF EXISTS `rezervare`;
CREATE TABLE IF NOT EXISTS `rezervare` (
  `id_rezervare` int(10) NOT NULL AUTO_INCREMENT,
  `data_rezervare` varchar(20) NOT NULL,
  `id_cont` int(10) NOT NULL,
  `id_tren` int(10) NOT NULL,
  `id_loc` int(10) NOT NULL,
  PRIMARY KEY (`id_rezervare`),
  KEY `id_cont` (`id_cont`),
  KEY `id_tren` (`id_tren`),
  KEY `id_loc` (`id_loc`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4;

--
-- RELAȚII PENTRU TABELE `rezervare`:
--   `id_cont`
--       `cont` -> `id_cont`
--   `id_tren`
--       `tren` -> `id_tren`
--   `id_loc`
--       `loc` -> `id_loc`
--

--
-- Eliminarea datelor din tabel `rezervare`
--

INSERT INTO `rezervare` (`id_rezervare`, `data_rezervare`, `id_cont`, `id_tren`, `id_loc`) VALUES
(99, '2020-06-10', 13, 3, 1),
(100, '2020-05-28', 13, 7, 1),
(102, '2020-06-08', 19, 7, 1);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `ruta`
--
-- Creare: mai 28, 2020 la 07:44 PM
--

DROP TABLE IF EXISTS `ruta`;
CREATE TABLE IF NOT EXISTS `ruta` (
  `id_ruta` int(10) NOT NULL AUTO_INCREMENT,
  `origine` varchar(20) NOT NULL,
  `destinatie` varchar(20) NOT NULL,
  `durata` time NOT NULL,
  `distanta` int(5) NOT NULL,
  `plecare` time NOT NULL,
  `sosire` time DEFAULT NULL,
  `pret` double NOT NULL,
  PRIMARY KEY (`id_ruta`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- RELAȚII PENTRU TABELE `ruta`:
--

--
-- Eliminarea datelor din tabel `ruta`
--

INSERT INTO `ruta` (`id_ruta`, `origine`, `destinatie`, `durata`, `distanta`, `plecare`, `sosire`, `pret`) VALUES
(1, 'Cluj Napoca', 'Bucuresti', '18:00:00', 600, '15:29:00', '06:30:00', 90.56),
(2, 'Cluj Napoca', 'Bucuresti', '09:19:00', 600, '07:41:00', '17:00:00', 160.56),
(3, 'Cluj Napoca', 'Bucuresti', '12:22:00', 621, '22:22:00', '10:44:00', 118.27),
(4, 'Constanta', 'Iasi', '09:45:00', 542, '07:51:00', '17:26:00', 93.15),
(5, 'Constanta', 'Iasi', '10:20:00', 687, '08:20:00', '18:40:00', 131.15),
(6, 'Constanta', 'Iasi', '09:16:00', 887, '23:11:00', '08:27:00', 136.2),
(7, 'Alba Iulia', 'Sibiu', '03:02:00', 92, '07:30:00', '10:32:00', 13),
(8, 'Alba Iulia', 'Sibiu', '02:39:00', 92, '08:00:00', '10:39:00', 13),
(9, 'Alba Iulia', 'Sibiu', '02:44:00', 92, '12:11:00', '14:55:00', 13),
(10, 'Craiova', 'Timisoara', '06:22:00', 324, '10:19:00', '16:41:00', 72.6),
(11, 'Craiova', 'Timisoara', '06:16:00', 324, '08:10:00', '14:26:00', 72.6),
(12, 'Craiova', 'Timisoara', '06:04:00', 324, '19:07:00', '01:11:00', 72.6);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `tren`
--
-- Creare: mai 28, 2020 la 07:44 PM
--

DROP TABLE IF EXISTS `tren`;
CREATE TABLE IF NOT EXISTS `tren` (
  `id_tren` int(10) NOT NULL AUTO_INCREMENT,
  `nume` varchar(10) NOT NULL,
  `id_ruta` int(10) NOT NULL,
  PRIMARY KEY (`id_tren`),
  KEY `id_ruta` (`id_ruta`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- RELAȚII PENTRU TABELE `tren`:
--   `id_ruta`
--       `ruta` -> `id_ruta`
--

--
-- Eliminarea datelor din tabel `tren`
--

INSERT INTO `tren` (`id_tren`, `nume`, `id_ruta`) VALUES
(1, 'R3084', 1),
(2, 'R4104', 2),
(3, 'IRN1642', 3),
(4, 'R10001', 4),
(5, 'R99811', 5),
(6, 'IR1200', 6),
(7, 'N20018', 7);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `tren_loc`
--
-- Creare: mai 28, 2020 la 07:44 PM
--

DROP TABLE IF EXISTS `tren_loc`;
CREATE TABLE IF NOT EXISTS `tren_loc` (
  `id_tren` int(10) NOT NULL,
  `id_loc` int(10) NOT NULL,
  KEY `id_tren` (`id_tren`),
  KEY `id_loc` (`id_loc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELAȚII PENTRU TABELE `tren_loc`:
--   `id_tren`
--       `tren` -> `id_tren`
--   `id_loc`
--       `loc` -> `id_loc`
--

--
-- Eliminarea datelor din tabel `tren_loc`
--

INSERT INTO `tren_loc` (`id_tren`, `id_loc`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(2, 13),
(2, 14),
(2, 15),
(2, 16),
(2, 17),
(2, 18),
(2, 19),
(2, 20),
(2, 21),
(2, 22),
(2, 23),
(2, 24),
(3, 25),
(3, 26),
(3, 27),
(3, 28),
(3, 29),
(3, 30),
(3, 31),
(3, 32),
(3, 33),
(3, 34),
(3, 35),
(3, 36),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 22),
(1, 23),
(1, 13);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `tren_program_zile`
--
-- Creare: mai 28, 2020 la 07:44 PM
--

DROP TABLE IF EXISTS `tren_program_zile`;
CREATE TABLE IF NOT EXISTS `tren_program_zile` (
  `id_tren` int(10) NOT NULL,
  `id_program` int(10) NOT NULL,
  KEY `id_tren` (`id_tren`),
  KEY `id_program` (`id_program`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELAȚII PENTRU TABELE `tren_program_zile`:
--   `id_tren`
--       `tren` -> `id_tren`
--   `id_program`
--       `program_zile` -> `id_program`
--

--
-- Eliminarea datelor din tabel `tren_program_zile`
--

INSERT INTO `tren_program_zile` (`id_tren`, `id_program`) VALUES
(1, 1),
(2, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(4, 1),
(4, 2),
(4, 6),
(4, 7),
(5, 1),
(5, 2),
(5, 3),
(5, 6),
(5, 7),
(6, 1),
(6, 2),
(6, 3),
(6, 4),
(6, 5),
(6, 6),
(6, 7),
(7, 1),
(7, 2),
(7, 3);

-- --------------------------------------------------------

--
-- Substitut structură pentru vizualizare `v_pct_a`
-- (Vezi mai jos vizualizarea actuală)
--
DROP VIEW IF EXISTS `v_pct_a`;
CREATE TABLE IF NOT EXISTS `v_pct_a` (
`origine` varchar(20)
,`destinatie` varchar(20)
,`plecare` time
,`sosire` time
,`pret` double
,`durata` time
,`ziua` varchar(10)
,`nume` varchar(10)
,`id_tren` int(10)
,`id_ruta` int(10)
);

-- --------------------------------------------------------

--
-- Substitut structură pentru vizualizare `v_pct_b`
-- (Vezi mai jos vizualizarea actuală)
--
DROP VIEW IF EXISTS `v_pct_b`;
CREATE TABLE IF NOT EXISTS `v_pct_b` (
`id_cont` int(10)
,`nume` varchar(10)
,`prenume` varchar(10)
,`email` varchar(40)
);

-- --------------------------------------------------------

--
-- Substitut structură pentru vizualizare `v_pct_c`
-- (Vezi mai jos vizualizarea actuală)
--
DROP VIEW IF EXISTS `v_pct_c`;
CREATE TABLE IF NOT EXISTS `v_pct_c` (
`id_cont` int(10)
,`id_rezervare` int(10)
,`prenume` varchar(10)
,`data_rezervare` varchar(20)
,`origine` varchar(20)
,`destinatie` varchar(20)
,`plecare` time
,`pret_final` double
,`id_loc` int(10)
);

-- --------------------------------------------------------

--
-- Substitut structură pentru vizualizare `v_pct_d`
-- (Vezi mai jos vizualizarea actuală)
--
DROP VIEW IF EXISTS `v_pct_d`;
CREATE TABLE IF NOT EXISTS `v_pct_d` (
`Tren` varchar(10)
,`Origine` varchar(20)
,`Destinatie` varchar(20)
,`Numar Rezervari` bigint(21)
);

-- --------------------------------------------------------

--
-- Substitut structură pentru vizualizare `v_pct_e`
-- (Vezi mai jos vizualizarea actuală)
--
DROP VIEW IF EXISTS `v_pct_e`;
CREATE TABLE IF NOT EXISTS `v_pct_e` (
`Calator` varchar(21)
,`email` varchar(40)
,`id_cont` int(10)
,`data_rezervare` varchar(20)
);

-- --------------------------------------------------------

--
-- Substitut structură pentru vizualizare `v_pct_f`
-- (Vezi mai jos vizualizarea actuală)
--
DROP VIEW IF EXISTS `v_pct_f`;
CREATE TABLE IF NOT EXISTS `v_pct_f` (
`origine` varchar(20)
,`destinatie` varchar(20)
,`plecare` time
,`sosire` time
,`pret` double
,`durata` time
,`ziua` varchar(10)
,`nume` varchar(10)
,`id_tren` int(10)
,`id_ruta` int(10)
);

-- --------------------------------------------------------

--
-- Substitut structură pentru vizualizare `v_pct_g`
-- (Vezi mai jos vizualizarea actuală)
--
DROP VIEW IF EXISTS `v_pct_g`;
CREATE TABLE IF NOT EXISTS `v_pct_g` (
`id_contact` int(10)
,`data` date
,`mesaj` varchar(1000)
,`id_cont` int(10)
,`nume` varchar(10)
,`prenume` varchar(10)
,`email` varchar(40)
);

-- --------------------------------------------------------

--
-- Substitut structură pentru vizualizare `v_pct_h`
-- (Vezi mai jos vizualizarea actuală)
--
DROP VIEW IF EXISTS `v_pct_h`;
CREATE TABLE IF NOT EXISTS `v_pct_h` (
`id_tren` int(10)
,`id_ruta` int(10)
,`id_loc` int(10)
,`loc` varchar(3)
,`status_loc` varchar(1)
,`plecare` time
,`sosire` time
,`ziua` varchar(10)
);

-- --------------------------------------------------------

--
-- Structură pentru vizualizare `v_pct_a`
--
DROP TABLE IF EXISTS `v_pct_a`;

DROP VIEW IF EXISTS `v_pct_a`;
CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pct_a`  AS  select `ruta`.`origine` AS `origine`,`ruta`.`destinatie` AS `destinatie`,`ruta`.`plecare` AS `plecare`,`ruta`.`sosire` AS `sosire`,`ruta`.`pret` AS `pret`,`ruta`.`durata` AS `durata`,`program_zile`.`ziua` AS `ziua`,`tren`.`nume` AS `nume`,`tren`.`id_tren` AS `id_tren`,`ruta`.`id_ruta` AS `id_ruta` from (((`ruta` join `tren` on(`tren`.`id_tren` = `ruta`.`id_ruta`)) join `tren_program_zile` on(`tren_program_zile`.`id_tren` = `tren`.`id_tren`)) join `program_zile` on(`tren_program_zile`.`id_program` = `program_zile`.`id_program`)) ;

-- --------------------------------------------------------

--
-- Structură pentru vizualizare `v_pct_b`
--
DROP TABLE IF EXISTS `v_pct_b`;

DROP VIEW IF EXISTS `v_pct_b`;
CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pct_b`  AS  select `cont`.`id_cont` AS `id_cont`,`cont`.`nume` AS `nume`,`cont`.`prenume` AS `prenume`,`cont`.`email` AS `email` from `cont` ;

-- --------------------------------------------------------

--
-- Structură pentru vizualizare `v_pct_c`
--
DROP TABLE IF EXISTS `v_pct_c`;

DROP VIEW IF EXISTS `v_pct_c`;
CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pct_c`  AS  select `cont`.`id_cont` AS `id_cont`,`rezervare`.`id_rezervare` AS `id_rezervare`,`cont`.`prenume` AS `prenume`,`rezervare`.`data_rezervare` AS `data_rezervare`,`ruta`.`origine` AS `origine`,`ruta`.`destinatie` AS `destinatie`,`ruta`.`plecare` AS `plecare`,`plata`.`pret_final` AS `pret_final`,`rezervare`.`id_loc` AS `id_loc` from ((((`plata` join `rezervare` on(`rezervare`.`id_rezervare` = `plata`.`id_rezervare`)) join `cont` on(`cont`.`id_cont` = `rezervare`.`id_cont`)) join `tren` on(`tren`.`id_tren` = `rezervare`.`id_tren`)) join `ruta` on(`ruta`.`id_ruta` = `tren`.`id_ruta`)) ;

-- --------------------------------------------------------

--
-- Structură pentru vizualizare `v_pct_d`
--
DROP TABLE IF EXISTS `v_pct_d`;

DROP VIEW IF EXISTS `v_pct_d`;
CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pct_d`  AS  select `tren`.`nume` AS `Tren`,`ruta`.`origine` AS `Origine`,`ruta`.`destinatie` AS `Destinatie`,count(0) AS `Numar Rezervari` from ((`rezervare` `r` join `tren` on(`r`.`id_tren` = `tren`.`id_tren`)) join `ruta` on(`tren`.`id_ruta` = `ruta`.`id_ruta`)) group by `tren`.`nume`,`ruta`.`origine`,`ruta`.`destinatie` order by count(0) desc ;

-- --------------------------------------------------------

--
-- Structură pentru vizualizare `v_pct_e`
--
DROP TABLE IF EXISTS `v_pct_e`;

DROP VIEW IF EXISTS `v_pct_e`;
CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pct_e`  AS  select concat(`cont`.`nume`,' ',`cont`.`prenume`) AS `Calator`,`cont`.`email` AS `email`,`cont`.`id_cont` AS `id_cont`,`rezervare`.`data_rezervare` AS `data_rezervare` from (`rezervare` join `cont` on(`cont`.`id_cont` = `rezervare`.`id_cont`)) order by 'Calator',`rezervare`.`data_rezervare` desc ;

-- --------------------------------------------------------

--
-- Structură pentru vizualizare `v_pct_f`
--
DROP TABLE IF EXISTS `v_pct_f`;

DROP VIEW IF EXISTS `v_pct_f`;
CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pct_f`  AS  select `ruta`.`origine` AS `origine`,`ruta`.`destinatie` AS `destinatie`,`ruta`.`plecare` AS `plecare`,`ruta`.`sosire` AS `sosire`,`ruta`.`pret` AS `pret`,`ruta`.`durata` AS `durata`,`program_zile`.`ziua` AS `ziua`,`tren`.`nume` AS `nume`,`tren`.`id_tren` AS `id_tren`,`ruta`.`id_ruta` AS `id_ruta` from (((`ruta` join `tren` on(`tren`.`id_ruta` = `ruta`.`id_ruta`)) join `tren_program_zile` on(`tren_program_zile`.`id_tren` = `tren`.`id_tren`)) join `program_zile` on(`program_zile`.`id_program` = `tren_program_zile`.`id_program`)) group by `tren`.`id_tren`,`ruta`.`id_ruta`,`ruta`.`origine`,`ruta`.`destinatie`,`program_zile`.`id_program` order by min(`ruta`.`durata`) ;

-- --------------------------------------------------------

--
-- Structură pentru vizualizare `v_pct_g`
--
DROP TABLE IF EXISTS `v_pct_g`;

DROP VIEW IF EXISTS `v_pct_g`;
CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pct_g`  AS  select `contact`.`id_contact` AS `id_contact`,`contact`.`data` AS `data`,`contact`.`mesaj` AS `mesaj`,`contact`.`id_cont` AS `id_cont`,`cont`.`nume` AS `nume`,`cont`.`prenume` AS `prenume`,`cont`.`email` AS `email` from (`contact` join `cont` on(`cont`.`id_cont` = `contact`.`id_cont`)) group by concat(least(`contact`.`id_contact`,`cont`.`id_cont`)) order by `contact`.`data` desc ;

-- --------------------------------------------------------

--
-- Structură pentru vizualizare `v_pct_h`
--
DROP TABLE IF EXISTS `v_pct_h`;

DROP VIEW IF EXISTS `v_pct_h`;
CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pct_h`  AS  select `tren_loc`.`id_tren` AS `id_tren`,`ruta`.`id_ruta` AS `id_ruta`,`loc`.`id_loc` AS `id_loc`,`loc`.`loc` AS `loc`,`loc`.`status_loc` AS `status_loc`,`ruta`.`plecare` AS `plecare`,`ruta`.`sosire` AS `sosire`,`program_zile`.`ziua` AS `ziua` from (((((`tren_loc` join `loc` on(`loc`.`id_loc` = `tren_loc`.`id_loc`)) join `tren` on(`tren`.`id_tren` = `tren_loc`.`id_tren`)) join `ruta` on(`ruta`.`id_ruta` = `tren`.`id_ruta`)) join `tren_program_zile` on(`tren_program_zile`.`id_tren` = `tren`.`id_tren`)) join `program_zile` on(`program_zile`.`id_program` = `tren_program_zile`.`id_program`)) ;

--
-- Constrângeri pentru tabele eliminate
--

--
-- Constrângeri pentru tabele `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`id_cont`) REFERENCES `cont` (`id_cont`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constrângeri pentru tabele `plata`
--
ALTER TABLE `plata`
  ADD CONSTRAINT `plata_ibfk_1` FOREIGN KEY (`id_rezervare`) REFERENCES `rezervare` (`id_rezervare`);

--
-- Constrângeri pentru tabele `reducere`
--
ALTER TABLE `reducere`
  ADD CONSTRAINT `reducere_ibfk_1` FOREIGN KEY (`id_cont`) REFERENCES `cont` (`id_cont`);

--
-- Constrângeri pentru tabele `rezervare`
--
ALTER TABLE `rezervare`
  ADD CONSTRAINT `rezervare_ibfk_1` FOREIGN KEY (`id_cont`) REFERENCES `cont` (`id_cont`),
  ADD CONSTRAINT `rezervare_ibfk_2` FOREIGN KEY (`id_tren`) REFERENCES `tren` (`id_tren`),
  ADD CONSTRAINT `rezervare_ibfk_3` FOREIGN KEY (`id_loc`) REFERENCES `loc` (`id_loc`);

--
-- Constrângeri pentru tabele `tren`
--
ALTER TABLE `tren`
  ADD CONSTRAINT `tren_ibfk_1` FOREIGN KEY (`id_ruta`) REFERENCES `ruta` (`id_ruta`);

--
-- Constrângeri pentru tabele `tren_loc`
--
ALTER TABLE `tren_loc`
  ADD CONSTRAINT `tren_loc_ibfk_1` FOREIGN KEY (`id_tren`) REFERENCES `tren` (`id_tren`),
  ADD CONSTRAINT `tren_loc_ibfk_2` FOREIGN KEY (`id_loc`) REFERENCES `loc` (`id_loc`);

--
-- Constrângeri pentru tabele `tren_program_zile`
--
ALTER TABLE `tren_program_zile`
  ADD CONSTRAINT `tren_program_zile_ibfk_1` FOREIGN KEY (`id_tren`) REFERENCES `tren` (`id_tren`),
  ADD CONSTRAINT `tren_program_zile_ibfk_2` FOREIGN KEY (`id_program`) REFERENCES `program_zile` (`id_program`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

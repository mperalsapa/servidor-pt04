-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2022 a las 09:03:42
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;
--
-- Base de datos: `pt04_marc_peral`
--
DROP DATABASE IF EXISTS Pt04_Marc_Peral;
CREATE DATABASE Pt04_Marc_Peral;
USE Pt04_Marc_Peral;
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `article` varchar(1000) NOT NULL,
  `autor` int(11) NOT NULL,
  `data` date NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Volcado de datos para la tabla `article`
--

INSERT INTO `article` (`id`, `article`, `autor`, `data`)
VALUES (29, 'Article 29 editat.', 8, '2022-10-09'),
  (30, 'article 30', 11, '2022-10-10'),
  (31, 'article 31', 11, '2022-10-10'),
  (32, 'article 32', 11, '2022-10-10'),
  (33, 'article 33', 11, '2022-10-10'),
  (34, 'article 34', 11, '2022-10-10'),
  (35, 'article 35', 11, '2022-10-10'),
  (36, 'article 36', 11, '2022-10-10'),
  (37, 'article 37', 11, '2022-10-10'),
  (38, 'article 38', 11, '2022-10-10'),
  (39, 'article 39', 11, '2022-10-10'),
  (40, 'article 40', 11, '2022-10-10'),
  (41, 'article 41', 11, '2022-10-10'),
  (42, 'article 42', 11, '2022-10-10'),
  (43, 'article 43', 11, '2022-10-10'),
  (44, 'article 44', 11, '2022-10-10'),
  (45, 'article 45', 11, '2022-10-10'),
  (46, 'article 46', 11, '2022-10-10'),
  (47, 'article 47', 11, '2022-10-10'),
  (48, 'article 48', 11, '2022-10-10'),
  (49, 'article 49', 11, '2022-10-10'),
  (50, 'article 50', 11, '2022-10-10'),
  (51, 'article 51', 11, '2022-10-10'),
  (52, 'article 52', 11, '2022-10-10'),
  (53, 'article 53', 11, '2022-10-10'),
  (54, 'article 54', 11, '2022-10-10'),
  (55, 'article 55', 11, '2022-10-10'),
  (56, 'article 56', 11, '2022-10-10'),
  (57, 'article 57', 11, '2022-10-10'),
  (58, 'article 58', 11, '2022-10-10'),
  (59, 'article 59', 11, '2022-10-10'),
  (60, 'article 60', 11, '2022-10-10'),
  (61, 'article 61', 10, '2022-10-10'),
  (62, 'article 62', 10, '2022-10-10'),
  (63, 'article 63', 10, '2022-10-10'),
  (64, 'article 64', 10, '2022-10-10'),
  (65, 'article 65', 10, '2022-10-10'),
  (66, 'article 66', 10, '2022-10-10'),
  (67, 'article 67', 10, '2022-10-10'),
  (68, 'article 68', 10, '2022-10-10'),
  (69, 'article 69', 10, '2022-10-10'),
  (70, 'article 70', 10, '2022-10-10'),
  (71, 'article 71', 10, '2022-10-10'),
  (72, 'article 72', 10, '2022-10-10'),
  (73, 'article 73', 10, '2022-10-10'),
  (74, 'article 74', 10, '2022-10-10'),
  (75, 'article 75', 10, '2022-10-10'),
  (76, 'article 76', 10, '2022-10-10'),
  (77, 'article 77', 10, '2022-10-10'),
  (78, 'article 78', 10, '2022-10-10'),
  (79, 'article 79', 10, '2022-10-10'),
  (80, '1234', 12, '2022-10-13'),
  (83, 'Article modificat jeje', 12, '2022-10-11'),
  (84, 'Nou article. Editat. 😀', 8, '2022-10-14'),
  (85, 'Article numero 3!!!!', 8, '2022-10-15'),
  (86, 'Article Numero 4!', 8, '2022-10-16'),
  (87, 'Article Numero 5!', 8, '2022-10-17'),
  (88, 'Article Numero 6 😁', 8, '2022-10-18'),
  (
    89,
    'Article Super nou!! Numero 7 😋😎😎😍😍',
    8,
    '2022-10-19'
  ),
  (
    94,
    'article inserit amb compte autenticat amb oauth2 de google',
    19,
    '2022-10-21'
  );
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `usuari`
--

CREATE TABLE `usuari` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `cognoms` varchar(20) DEFAULT NULL,
  `correu` varchar(50) NOT NULL,
  `contrasenya` char(64) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
--
-- Volcado de datos para la tabla `usuari`
--

INSERT INTO `usuari` (`id`, `nom`, `cognoms`, `correu`, `contrasenya`)
VALUES (
    8,
    'Marc',
    'Peral Cajidos',
    'marcperal23@gmail.com',
    '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4'
  ),
  (
    10,
    'Juan',
    'Perez',
    'jp@localhost',
    '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4'
  ),
  (
    11,
    'Miguel',
    'Pelaez',
    'marc@arbros.online',
    '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4'
  ),
  (
    12,
    'Pepe',
    'Hernandez',
    'buit@localhost',
    '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4'
  ),
  (
    19,
    'Marc Jesús',
    'Peral Cajidos',
    'm.peral@sapalomera.cat',
    'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855'
  );
--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `article`
--
ALTER TABLE `article`
ADD PRIMARY KEY (`id`),
  ADD KEY `autor` (`autor`);
--
-- Indices de la tabla `usuari`
--
ALTER TABLE `usuari`
ADD PRIMARY KEY (`id`);
--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `article`
--
ALTER TABLE `article`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 95;
--
-- AUTO_INCREMENT de la tabla `usuari`
--
ALTER TABLE `usuari`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 20;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `article`
--
ALTER TABLE `article`
ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`autor`) REFERENCES `usuari` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;
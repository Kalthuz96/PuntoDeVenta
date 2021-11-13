-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 13-11-2021 a las 04:28:03
-- Versión del servidor: 8.0.21
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `retord`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `CategoryID` int NOT NULL AUTO_INCREMENT,
  `CategoryName` varchar(150) NOT NULL,
  `CategoryDescription` text NOT NULL,
  `CategoryColor` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL,
  `deleted_at` timestamp NOT NULL,
  `UserChange` int NOT NULL,
  PRIMARY KEY (`CategoryID`),
  KEY `UserChange` (`UserChange`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `ProductID` int NOT NULL,
  `ProductName` varchar(150) NOT NULL,
  `ProductDescription` text NOT NULL,
  `ProductPrice` decimal(10,2) NOT NULL,
  `ProductCategory` int NOT NULL,
  `ProductImage` varchar(250) NOT NULL,
  `ProductStock` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `UserChange` int NOT NULL,
  PRIMARY KEY (`ProductID`),
  KEY `UserChange` (`UserChange`),
  KEY `ProductCategory` (`ProductCategory`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE IF NOT EXISTS `ticket` (
  `TicketID` int NOT NULL AUTO_INCREMENT,
  `TicketPrice` decimal(10,2) NOT NULL,
  `TicketUser` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`TicketID`),
  KEY `TicketUser` (`TicketUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticketdetail`
--

DROP TABLE IF EXISTS `ticketdetail`;
CREATE TABLE IF NOT EXISTS `ticketdetail` (
  `TicketID` int NOT NULL,
  `ProductID` int NOT NULL,
  `Quantity` int NOT NULL,
  `TotalSale` decimal(10,2) NOT NULL,
  KEY `TicketID` (`TicketID`),
  KEY `ProductID` (`ProductID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transcription`
--

DROP TABLE IF EXISTS `transcription`;
CREATE TABLE IF NOT EXISTS `transcription` (
  `DateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DescriptionTrans` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Details` json NOT NULL,
  `UserChange` int NOT NULL,
  KEY `UserChange` (`UserChange`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `UserID` int NOT NULL AUTO_INCREMENT,
  `UserName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `UserLastName` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `UserImage` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `UserEmail` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `UserTelephone` bigint DEFAULT NULL,
  `UserNickName` varchar(50) NOT NULL,
  `UserPassword` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `UserStatus` int NOT NULL,
  `UserToken` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `UserChange` int NOT NULL,
  PRIMARY KEY (`UserID`),
  KEY `UserChange` (`UserChange`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`UserID`, `UserName`, `UserLastName`, `UserImage`, `UserEmail`, `UserTelephone`, `UserNickName`, `UserPassword`, `UserStatus`, `UserToken`, `created_at`, `update_at`, `deleted_at`, `UserChange`) VALUES
(1, 'Jesus Renato', 'De La Rosa Martínez', '', 'renato.dlr.martinez@hotmail.com', 9622438108, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 1, '9d50a910ac9e4410552a-9817cbf68469fa2b9b7a-6feb74e839070dd9130b-c6612443daf3edced3bb', '2021-11-11 23:09:45', '2021-11-13 04:24:57', NULL, 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`UserChange`) REFERENCES `user` (`UserID`);

--
-- Filtros para la tabla `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`UserChange`) REFERENCES `user` (`UserID`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`ProductCategory`) REFERENCES `category` (`CategoryID`);

--
-- Filtros para la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`TicketUser`) REFERENCES `user` (`UserID`);

--
-- Filtros para la tabla `ticketdetail`
--
ALTER TABLE `ticketdetail`
  ADD CONSTRAINT `ticketdetail_ibfk_1` FOREIGN KEY (`TicketID`) REFERENCES `ticket` (`TicketID`),
  ADD CONSTRAINT `ticketdetail_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);

--
-- Filtros para la tabla `transcription`
--
ALTER TABLE `transcription`
  ADD CONSTRAINT `transcription_ibfk_1` FOREIGN KEY (`UserChange`) REFERENCES `user` (`UserID`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`UserChange`) REFERENCES `user` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 11 2016 г., 15:25
-- Версия сервера: 5.5.45
-- Версия PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `magaz`
--

-- --------------------------------------------------------

--
-- Структура таблицы `images_bd`
--

CREATE TABLE IF NOT EXISTS `images_bd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `zzzz` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=164 ;

--
-- Дамп данных таблицы `images_bd`
--

INSERT INTO `images_bd` (`id`, `name`, `zzzz`) VALUES
(78, '255.jpg', 0),
(79, '8524698.jpg', 0),
(80, 'dali.jpg', 0),
(81, '8524698.jpg', 0),
(82, '8524698.jpg', 0),
(83, '8524698.jpg', 0),
(84, 'Array', 0),
(85, '255.jpg', 0),
(126, 'RoSOZZ0o0zg.jpg', 0),
(127, 'RoSOZZ0o0zg.jpg', 0),
(128, '43KF6v351Zw.jpg', 0),
(129, 'RoSOZZ0o0zg.jpg', 0),
(130, 'RoSOZZ0o0zg.jpg', 0),
(131, 'RoSOZZ0o0zg.jpg', 0),
(132, 'RoSOZZ0o0zg.jpg', 0),
(133, 'RoSOZZ0o0zg.jpg', 0),
(134, 'RoSOZZ0o0zg.jpg', 0),
(135, '0174_M_Roytman.jpg', 0),
(136, '0174_M_Roytman.jpg', 0),
(137, '0174_M_Roytman.jpg', 0),
(138, '0174_M_Roytman.jpg', 0),
(139, '0174_M_Roytman.jpg', 0),
(140, '0174_M_Roytman.jpg', 0),
(141, '0174_M_Roytman.jpg', 0),
(142, 'v6IZqKAvh54.jpg', 0),
(143, '4Oux9c7TJ9w.jpg', 0),
(144, '4Oux9c7TJ9w.jpg', 0),
(145, '4Oux9c7TJ9w.jpg', 0),
(146, '0171_M_Roytman.jpg', 0),
(147, '0171_M_Roytman.jpg', 0),
(148, '0171_M_Roytman.jpg', 0),
(149, 'v6IZqKAvh54.jpg', 0),
(150, 'v6IZqKAvh54.jpg', 0),
(151, '4Oux9c7TJ9w.jpg', 0),
(152, '4Oux9c7TJ9w.jpg', 0),
(153, '4Oux9c7TJ9w.jpg', 0),
(154, '4Oux9c7TJ9w.jpg', 0),
(155, '4Oux9c7TJ9w.jpg', 0),
(156, '0171_M_Roytman.jpg', 0),
(157, '0174_M_Roytman.jpg', 0),
(158, 'v6IZqKAvh54.jpg', 0),
(159, 'yIlX7HLC7iE.jpg', 0),
(160, 'den.jpg', 0),
(161, 'busi.jpg', 0),
(162, '6p62', 0),
(163, 'ys0h', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nameorder` text NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `datetime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `nameorder`, `price`, `quantity`, `datetime`) VALUES
(11, 'name341', 101, 1, 1472381883),
(12, 'name', 200, 1, 1472381883),
(13, 'name', 300, 1, 1472381883),
(14, 'name', 400, 1, 1472381883),
(15, 'name', 200, 1, 1472382192),
(16, 'name', 300, 1, 1472382192),
(17, 'name', 800, 1, 1472382192),
(18, 'aaaaa', 123, 11, 1472382346),
(19, 'name', 300, 10, 1473276823),
(20, 'name', 701, 99, 1473277279),
(21, 'name', 200, 1, 1474177098),
(22, 'name', 400, 11, 1474177098);

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `img` text NOT NULL,
  `description` text NOT NULL,
  `big_description` text NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=116 ;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `name`, `img`, `description`, `big_description`, `price`) VALUES
(57, 'Cиние', '5FUwC_o4WgM.jpg', 'Сделано из шолка 1', '', 1010),
(63, 'Красное', 'lDaiHIZkLkY.jpg', '8', '', 200),
(64, 'name', 'lDaiHIZkLkY.jpg', '8', '', 300),
(65, 'name', 'lDaiHIZkLkY.jpg', '8', '', 400),
(66, 'name', 'lDaiHIZkLkY.jpg', '8', '', 500),
(67, 'name', 'lDaiHIZkLkY.jpg', '8', '', 600),
(68, 'name', '5FUwC_o4WgM.jpg', 'descruption', '', 701),
(70, 'name', '5FUwC_o4WgM.jpg', 'descruption', '', 800),
(72, 'name2', '5FUwC_o4WgM.jpg', 'descruption', '', 900),
(73, 'name', 'lDaiHIZkLkY.jpg', 'descruption', '', 1000),
(74, 'test', 'lDaiHIZkLkY.jpg', 'test', 'test', 100),
(75, 'Платье', 'lDaiHIZkLkY.jpg', 'Красное описание', 'большое описание', 123),
(85, 'Платье', 'lDaiHIZkLkY.jpg', 'Сделано из шолка', 'Это большое описание', 231);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `password` text NOT NULL,
  `admin` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `admin`) VALUES
(1, 'admin', 'admin', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

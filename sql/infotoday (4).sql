-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2020 at 08:27 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `infotoday`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `newspaper_id` varchar(50) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  UNIQUE KEY `cart_id` (`cart_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `newspaper_id`, `user_id`) VALUES
(1, 'p1', '2'),
(3, 'p2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_name` varchar(15) NOT NULL,
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `date` int(15) NOT NULL,
  `comment_id` varchar(15) NOT NULL,
  `customer_id` varchar(15) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `newspaper`
--

CREATE TABLE IF NOT EXISTS `newspaper` (
  `name` varchar(50) NOT NULL,
  `gross_price` float NOT NULL,
  `newspaper_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` varchar(15) NOT NULL,
  `Publish_duration` varchar(15) NOT NULL,
  `thumbnail` longblob NOT NULL,
  `description` varchar(250) NOT NULL,
  `date` date NOT NULL,
  `category_id` varchar(15) NOT NULL,
  `file` varchar(255) NOT NULL,
  UNIQUE KEY `newspaper_id` (`newspaper_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE IF NOT EXISTS `purchases` (
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `net_ammount` int(15) NOT NULL,
  `customer_id` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subscribe`
--

CREATE TABLE IF NOT EXISTS `subscribe` (
  `expire_date` int(15) NOT NULL,
  `duration` int(15) NOT NULL,
  `customer_id` varchar(15) NOT NULL,
  `discount` int(15) NOT NULL,
  `newspaper_id` varchar(15) NOT NULL,
  `subscribe_date` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(255) NOT NULL,
  `join_date` date NOT NULL,
  `avatar` varchar(512) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `role`, `phone`, `email`, `join_date`, `avatar`, `password`) VALUES
(2, 'Madhushanka', 'SK', 'customer', '0784446639', 'ruvindumadushanka@gmail.com', '2020-04-12', '', '7c222fb2927d828af22f592134e8932480637c0d'),
(4, 'Manura', 'Lakshan', 'supplier', '767097577', 'sm.manura.96@gmail.com', '2020-05-27', '', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(5, 'Manura', 'Lakshan', 'customer', '767097577', 'sm.manura.96@gmail.com', '2020-05-28', 'imgs\\users\\user.png', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(6, 'Manura', 'Lakshan', 'supplier', '767097577', 'smsudara757@gmail.com', '2020-05-28', 'imgs\\users\\user.png', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

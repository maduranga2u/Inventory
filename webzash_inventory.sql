-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 08, 2015 at 04:02 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `webzash_inv`
--

-- --------------------------------------------------------

--
-- Table structure for table `balances`
--

CREATE TABLE IF NOT EXISTS `balances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `value` float NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `billdetails`
--

CREATE TABLE IF NOT EXISTS `billdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `billNo` int(11) DEFAULT NULL,
  `billType` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `description` text NOT NULL,
  `cheque` varchar(100) DEFAULT NULL,
  `payment_type` varchar(100) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `card_type` varchar(20) DEFAULT NULL,
  `card_no` int(11) DEFAULT NULL,
  `card_name` varchar(20) DEFAULT NULL,
  `currency_name` varchar(20) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `description` text,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text,
  `mobile` varchar(20) DEFAULT NULL,
  `land` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `entries`
--

CREATE TABLE IF NOT EXISTS `entries` (
  `id` bigint(18) NOT NULL AUTO_INCREMENT,
  `tag_id` bigint(18) DEFAULT NULL,
  `entrytype_id` bigint(18) NOT NULL,
  `number` bigint(18) DEFAULT NULL,
  `date` date NOT NULL,
  `dr_total` decimal(25,2) NOT NULL DEFAULT '0.00',
  `cr_total` decimal(25,2) NOT NULL DEFAULT '0.00',
  `narration` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_id` (`id`),
  KEY `id` (`id`),
  KEY `tag_id` (`tag_id`),
  KEY `entrytype_id` (`entrytype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `entryitems`
--

CREATE TABLE IF NOT EXISTS `entryitems` (
  `id` bigint(18) NOT NULL AUTO_INCREMENT,
  `entry_id` bigint(18) NOT NULL,
  `ledger_id` bigint(18) NOT NULL,
  `amount` decimal(25,2) NOT NULL DEFAULT '0.00',
  `dc` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `reconciliation_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_id` (`id`),
  KEY `id` (`id`),
  KEY `entry_id` (`entry_id`),
  KEY `ledger_id` (`ledger_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `feeds`
--

CREATE TABLE IF NOT EXISTS `feeds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `entrytype` varchar(20) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text,
  `size` varchar(50) DEFAULT NULL,
  `unit` varchar(20) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stockentryitems`
--

CREATE TABLE IF NOT EXISTS `stockentryitems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `rate` float NOT NULL,
  `entrytype_id` int(11) NOT NULL,
  `billNo` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

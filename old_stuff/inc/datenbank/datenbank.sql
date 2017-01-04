-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 25. Oktober 2010 um 14:58
-- Server Version: 5.1.37
-- PHP-Version: 5.2.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Datenbank: `projekt_innung`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(255) NOT NULL,
  `user_pw` varchar(255) NOT NULL,
  `user_forename` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_birthdate` date NOT NULL,
  `user_plz` varchar(5) NOT NULL,
  `user_place` varchar(255) NOT NULL,
  `user_street` varchar(255) NOT NULL,
  `user_streetnumber` varchar(5) NOT NULL,
  `user_phone` int(11) NOT NULL,
  `user_fax` int(11) NOT NULL,
  `user_active` int(1) DEFAULT NULL,
  `user_role_id` int(3) DEFAULT NULL,
  `user_createtime` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` VALUES(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '', '', '0000-00-00', '', '', '', '', 0, 0, 1, 100, '0000-00-00 00:00:00');

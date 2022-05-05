--
-- Base de données: `chat`
--
CREATE DATABASE `chat` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `chat`;

-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le: Sam 09 Février 2013 à 10:46
-- Version du serveur: 5.5.27-log
-- Version de PHP: 5.4.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `bdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `ancien_message`
--

CREATE TABLE IF NOT EXISTS `ancien_messageA` (
  `pseudo` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Structure de la table `chat_accounts`
--

CREATE TABLE IF NOT EXISTS `chat_accountsA` (
  `account_login` varchar(30) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `account_pass` varchar(255) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `mail` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `mail_verif` enum('0','1') NOT NULL,
  PRIMARY KEY (`account_login`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `chat_messages`
--

CREATE TABLE IF NOT EXISTS `chat_messagesA` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `message_text` longtext CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=174 ;

-- --------------------------------------------------------

--
-- Structure de la table `chat_online`
--

CREATE TABLE IF NOT EXISTS `chat_onlineA` (
  `online_id` int(11) NOT NULL AUTO_INCREMENT,
  `online_ip` varchar(100) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `online_user` varchar(255) NOT NULL,
  `online_status` enum('0','1','2') CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `online_time` bigint(21) NOT NULL,
  PRIMARY KEY (`online_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;
CREATE TABLE IF NOT EXISTS `ancien_message` (
  `pseudo` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `chat_accounts`
--

CREATE TABLE IF NOT EXISTS `chat_accounts` (
  `account_login` varchar(30) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `account_pass` varchar(255) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `mail` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `mail_verif` enum('0','1') NOT NULL,
  PRIMARY KEY (`account_login`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `chat_messages`
--

CREATE TABLE IF NOT EXISTS `chat_messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `message_text` longtext CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `chat_online`
--

CREATE TABLE IF NOT EXISTS `chat_online` (
  `online_id` int(11) NOT NULL AUTO_INCREMENT,
  `online_ip` varchar(100) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `online_user` varchar(255) NOT NULL,
  `online_status` enum('0','1','2') CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `online_time` bigint(21) NOT NULL,
  PRIMARY KEY (`online_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

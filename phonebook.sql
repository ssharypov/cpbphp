-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 24 2020 г., 10:32
-- Версия сервера: 5.6.13
-- Версия PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `phonebook`
--
CREATE DATABASE IF NOT EXISTS `phonebook` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `phonebook`;

-- --------------------------------------------------------

--
-- Структура таблицы `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `contactid` int(11) NOT NULL AUTO_INCREMENT,
  `fio` varchar(100) NOT NULL,
  `post` varchar(255) NOT NULL,
  `intnum` varchar(50) DEFAULT NULL,
  `extnum` varchar(50) DEFAULT NULL,
  `depid` int(11) NOT NULL,
  `contactsort` int(11) NOT NULL,
  PRIMARY KEY (`contactid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Структура таблицы `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `depid` int(11) NOT NULL AUTO_INCREMENT,
  `depname` varchar(100) NOT NULL,
  `depsort` int(11) NOT NULL,
  PRIMARY KEY (`depid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Подразделения' AUTO_INCREMENT=9 ;

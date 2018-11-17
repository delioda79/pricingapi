-- Adminer 4.6.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `amounts`;
CREATE TABLE `amounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `unit` int(10) unsigned NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `unit` (`unit`),
  CONSTRAINT `amounts_ibfk_1` FOREIGN KEY (`unit`) REFERENCES `units` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO `amounts` (`id`, `name`, `unit`, `qty`) VALUES
(1,	'Item',	1,	1),
(2,	'Couple',	1,	2),
(3,	'Batch of three',	1,	3),
(4,	'Dozen',	1,	3),
(5,	'Kgs',	2,	1),
(6,	'Tonnes',	2,	1000);

DROP TABLE IF EXISTS `discounts`;
CREATE TABLE `discounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `type` enum('percent','amount','fixed') NOT NULL,
  `value` float NOT NULL,
  `qty` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `qty` (`qty`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `discounts` (`id`, `name`, `type`, `value`, `qty`) VALUES
(1,	'Three for two',	'amount',	1,	3),
(2,	'5 for 3',	'amount',	2,	5),
(3,	'Half price',	'percent',	50,	4),
(4,	'5 pounds discount',	'fixed',	5,	12);

DROP TABLE IF EXISTS `prices`;
CREATE TABLE `prices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `products_id` int(10) unsigned NOT NULL,
  `amount` int(10) unsigned NOT NULL,
  `value` float NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `amount` (`amount`),
  KEY `products_id` (`products_id`),
  CONSTRAINT `prices_ibfk_2` FOREIGN KEY (`amount`) REFERENCES `amounts` (`id`),
  CONSTRAINT `prices_ibfk_3` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `prices` (`id`, `products_id`, `amount`, `value`) VALUES
(1,	1,	1,	0.5),
(2,	1,	5,	2),
(3,	2,	1,	0.8),
(4,	2,	5,	2),
(5,	3,	5,	16);

DROP TABLE IF EXISTS `price_discounts`;
CREATE TABLE `price_discounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `price` int(10) unsigned NOT NULL,
  `discount` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `price` (`price`),
  KEY `discount` (`discount`),
  CONSTRAINT `price_discounts_ibfk_1` FOREIGN KEY (`price`) REFERENCES `prices` (`id`),
  CONSTRAINT `price_discounts_ibfk_2` FOREIGN KEY (`discount`) REFERENCES `discounts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `price_discounts` (`id`, `price`, `discount`) VALUES
(1,	1,	1),
(2,	1,	2),
(3,	3,	3),
(4,	4,	4);

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `products` (`id`, `name`, `description`) VALUES
(1,	'Apple',	'Apple is a fruit'),
(2,	'Pears',	'Pear is a fruit'),
(3,	'Beans',	'Beans are legumes'),
(4,	'T-bone steak',	'The best cut of meat');

DROP TABLE IF EXISTS `units`;
CREATE TABLE `units` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `units` (`id`, `name`) VALUES
(1,	'item'),
(2,	'kg');

-- 2018-11-17 20:13:42

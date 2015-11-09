-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 08, 2015 at 06:18 PM
-- Server version: 5.5.31-cll
-- PHP Version: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shaw9409`
--

-- --------------------------------------------------------

--
-- Table structure for table `tp_accessories`
--

CREATE TABLE IF NOT EXISTS `tp_accessories` (
  `accessoryId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(40) NOT NULL,
  `numPerUnit` tinyint(3) unsigned NOT NULL,
  `chokingHazard` tinyint(1) NOT NULL,
  `price` tinyint(3) unsigned NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`accessoryId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `tp_accessories`
--

INSERT INTO `tp_accessories` (`accessoryId`, `title`, `numPerUnit`, `chokingHazard`, `price`, `description`) VALUES
(1, 'Fake blook packets', 5, 0, 10, 'Blood for all types of mayhem'),
(2, 'Stethoscope', 1, 0, 5, 'Listen to your heart!'),
(3, 'Batarangs', 4, 0, 7, 'Sharp projectiles launched at high speeds? Definitely a non-lethal option.'),
(4, 'Knight Stick', 1, 0, 7, 'The stick of knight'),
(5, 'red nose', 1, 1, 2, 'a regular clown nose...'),
(6, 'lasso', 1, 0, 3, 'The Lasso of Truth!'),
(7, 'Freddie Makeup', 1, 0, 6, 'It''ll make you look like a burn victim.'),
(8, 'pointed teeth', 1, 1, 4, 'Pointed teeth, for a vampire'),
(9, 'handcuffs', 2, 0, 4, 'You can''t break those cuffs.'),
(10, 'Walking Staff', 1, 0, 10, 'For Gandalf the Grey, after he turned Grey'),
(11, 'fake snakes', 5, 0, 4, 'For those crazy pharoes of yore'),
(12, 'flintlock pistol', 1, 0, 4, 'For when you are stranded on an island, left there by Barbosa'),
(13, 'Doctor Aid Kit', 1, 0, 6, 'Includes morphine for when you can''t do anything else'),
(14, 'Lolipop Chainsaw', 1, 1, 15, 'For when zombies overrun your high school, just like in that video game.'),
(15, 'plastic uzi', 1, 0, 3, 'Goes inside Red Riding hood''s basket, not so innocent is she?'),
(16, 'plastic daggers', 2, 0, 5, 'To aid V in liberating England'),
(17, 'Fake Knife', 1, 0, 6, 'For all those cheesy slasher costumes'),
(18, 'mustard scarf', 1, 0, 4, 'For giant hot dogs'),
(19, 'ketchup scarf', 1, 0, 4, 'for giant hot dogs as well'),
(20, 'lightsaber', 1, 0, 10, 'Not as clumsy as a random blaster.'),
(21, 'Blue Apple', 1, 1, 3, 'Don''t eat it.'),
(22, 'Web Slingers', 2, 1, 5, 'They put the amazing in the Amazing Spiderman'),
(23, 'compass', 1, 1, 6, 'It points to the thing you want most in this world'),
(24, 'broom', 1, 0, 3, 'A good witch''s Swiss army knife'),
(25, 'fake cookies', 5, 1, 5, 'For any cookie monster of merit'),
(26, 'pot of honey', 1, 0, 4, 'for any self respecting bear'),
(28, 'plastic machete', 1, 0, 3, 'Has its own fake blood supply. For any self respecting killer.'),
(29, 'face paint', 1, 0, 5, 'Makeup for any ghoul or goblin or monster');

-- --------------------------------------------------------

--
-- Table structure for table `tp_accessoriesCostumes`
--

CREATE TABLE IF NOT EXISTS `tp_accessoriesCostumes` (
  `costumeId` tinyint(3) unsigned NOT NULL,
  `accessoryId` tinyint(3) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tp_accessoriesCostumes`
--

INSERT INTO `tp_accessoriesCostumes` (`costumeId`, `accessoryId`) VALUES
(1, 1),
(2, 13),
(3, 3),
(4, 4),
(5, 5),
(6, 1),
(6, 29),
(7, 16),
(8, 1),
(8, 29),
(9, 3),
(1, 28),
(10, 6),
(11, 14),
(12, 15),
(14, 18),
(14, 19),
(13, 11),
(15, 20),
(16, 17),
(17, 12),
(17, 23),
(18, 24),
(22, 21),
(23, 29),
(25, 25),
(26, 26),
(27, 22);

-- --------------------------------------------------------

--
-- Table structure for table `tp_ageRanges`
--

CREATE TABLE IF NOT EXISTS `tp_ageRanges` (
  `ageId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `ageRange` varchar(40) NOT NULL,
  PRIMARY KEY (`ageId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tp_ageRanges`
--

INSERT INTO `tp_ageRanges` (`ageId`, `ageRange`) VALUES
(1, 'Adult'),
(2, 'Teenager'),
(3, 'Child');

-- --------------------------------------------------------

--
-- Table structure for table `tp_categories`
--

CREATE TABLE IF NOT EXISTS `tp_categories` (
  `categoryId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(40) NOT NULL,
  PRIMARY KEY (`categoryId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tp_categories`
--

INSERT INTO `tp_categories` (`categoryId`, `category`) VALUES
(1, 'decoration'),
(2, 'weapon'),
(3, 'clothes'),
(4, 'utility');

-- --------------------------------------------------------

--
-- Table structure for table `tp_costumes`
--

CREATE TABLE IF NOT EXISTS `tp_costumes` (
  `costumeId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(40) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `ageRange` tinyint(3) unsigned NOT NULL,
  `gender` varchar(1) NOT NULL,
  `size` int(11) NOT NULL,
  `price` tinyint(3) unsigned NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`costumeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `tp_costumes`
--

INSERT INTO `tp_costumes` (`costumeId`, `title`, `type`, `ageRange`, `gender`, `size`, `price`, `description`) VALUES
(1, 'Jason', 1, 1, 'M', 2, 12, 'Jason Outfit, You''ll be terrorizing teenagers in no time'),
(2, 'Doctor', 3, 1, 'M', 3, 11, 'A career doctor outfit, comes with a lab coat.'),
(3, 'Batman', 4, 1, 'M', 3, 15, 'The caped Crusader himself'),
(4, 'Cop', 3, 1, 'M', 4, 15, ''),
(5, 'Scary Clown', 2, 1, 'M', 5, 20, 'Creepy clown with orange wig, just like Pennywise'),
(6, 'Vampire', 2, 1, 'M', 1, 12, 'You''ll look just like Dracula, comes with a cape'),
(7, 'V - V for Vendetta', 2, 1, 'M', 2, 15, 'The literal cloak and dagger, comes with Guy Fawkes mask and Top Hat'),
(8, 'Vampire', 2, 1, 'F', 3, 14, 'Female Dracula look'),
(9, 'Bat Girl', 4, 1, 'F', 5, 17, 'The Female Dark Knight, you''ll definitely kick butt in this'),
(10, 'Wonderwoman', 4, 1, 'F', 3, 11, 'The real goddess of truth, comes with tiara and bracers'),
(11, 'Cheerleader', 3, 1, 'F', 3, 12, 'GO team, cheerleader outfit'),
(12, 'Red Riding Hood', 2, 1, 'F', 5, 11, 'Right out of the fairy tale'),
(13, 'Cleopatra', 2, 1, 'F', 2, 13, 'Right out of history'),
(14, 'Hot Dog', 5, 2, 'M', 2, 20, 'A delicious costume, 6 feet tall'),
(15, 'Darth Vader', 2, 2, 'M', 3, 15, 'He is your father'),
(16, 'Scream Murderer', 1, 2, 'M', 4, 10, 'WAZZZUUUUUP!'),
(17, 'Jack Sparrow', 2, 2, 'M', 4, 14, 'Captain Jack Sparrow to you!'),
(18, 'Witch', 2, 2, 'F', 2, 20, 'Regular witch, irregular powers'),
(19, 'Alice from Wonderland', 2, 2, 'F', 1, 14, 'She''s following the White Rabbit, which is totally not a euphemism for drugs.'),
(20, 'Little Lamb', 5, 3, 'F', 5, 10, 'A lamb costume...'),
(21, 'Minie Mouse', 2, 3, 'F', 4, 11, 'Micky''s right hand girl'),
(22, 'Snow White', 2, 3, 'F', 5, 11, 'She''s not asleep'),
(23, 'Minions', 2, 3, 'M', 3, 9, 'Must speak pseudo Spanish and gibberish as part of the costume'),
(24, 'Baby Jack - Incredibles', 4, 3, 'M', 4, 15, 'You don''t know Jack!'),
(25, 'Cookie Monster', 2, 3, 'M', 5, 14, 'a big furry guy who eats cookies...'),
(26, 'Winnie the Pooh', 2, 3, 'M', 4, 7, 'The Boss of the 100 acre wood'),
(27, 'Spiderman', 4, 3, 'M', 5, 12, 'New York''s web slinger');

-- --------------------------------------------------------

--
-- Table structure for table `tp_sizes`
--

CREATE TABLE IF NOT EXISTS `tp_sizes` (
  `sizeId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `size` varchar(20) NOT NULL,
  PRIMARY KEY (`sizeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tp_sizes`
--

INSERT INTO `tp_sizes` (`sizeId`, `size`) VALUES
(1, 'XXLarge'),
(2, 'XLarge'),
(3, 'Large'),
(4, 'Medium'),
(5, 'Small');

-- --------------------------------------------------------

--
-- Table structure for table `tp_types`
--

CREATE TABLE IF NOT EXISTS `tp_types` (
  `typeId` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(40) NOT NULL,
  PRIMARY KEY (`typeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tp_types`
--

INSERT INTO `tp_types` (`typeId`, `type`) VALUES
(1, 'slasher'),
(2, 'character'),
(3, 'career'),
(4, 'superhero'),
(5, 'miscellaneous');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

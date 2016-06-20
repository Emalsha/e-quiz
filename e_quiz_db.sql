-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2016 at 06:51 PM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_quiz_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE IF NOT EXISTS `admin_user` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `fname` varchar(15) DEFAULT NULL,
  `lname` varchar(15) DEFAULT NULL,
  `email` text NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`admin_id`, `username`, `password`, `fname`, `lname`, `email`) VALUES
(1, 'Emalsha', '123456', 'Emal', 'Rasa', 'remalsha@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qid` int(11) NOT NULL,
  `answer_num` int(11) NOT NULL,
  `answer` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `qid` (`qid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `papers`
--

DROP TABLE IF EXISTS `papers`;
CREATE TABLE IF NOT EXISTS `papers` (
  `paper_id` int(15) NOT NULL AUTO_INCREMENT,
  `admin_id` int(15) NOT NULL,
  `description` text,
  PRIMARY KEY (`paper_id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `qid` int(11) NOT NULL AUTO_INCREMENT,
  `paper_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `correct_answer` int(11) NOT NULL,
  `marks` int(11) NOT NULL,
  PRIMARY KEY (`qid`),
  KEY `paper_id` (`paper_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

DROP TABLE IF EXISTS `results`;
CREATE TABLE IF NOT EXISTS `results` (
  `result_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `paper_id` int(11) NOT NULL,
  `marks` int(11) NOT NULL,
  PRIMARY KEY (`result_id`),
  KEY `user_id` (`user_id`),
  KEY `paper_id` (`paper_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(15) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `fname` varchar(10) DEFAULT NULL,
  `lname` varchar(10) DEFAULT NULL,
  `email` text NOT NULL,
  `login_time` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `fname`, `lname`, `email`, `login_time`) VALUES
(1, 'ema', '112233', 'emal', '', 'remalsha@yahoo.com', '2016-06-20 17:22:43'),
(2, 'emalsha', '112233', 'emal', '', 'remalsha@yahoo.com', '2016-06-20 17:26:33');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`qid`) REFERENCES `question` (`qid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `papers`
--
ALTER TABLE `papers`
  ADD CONSTRAINT `papers_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin_user` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `papers_ibfk_2` FOREIGN KEY (`paper_id`) REFERENCES `results` (`paper_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`paper_id`) REFERENCES `papers` (`paper_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

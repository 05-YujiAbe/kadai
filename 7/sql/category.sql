-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015 年 9 月 26 日 16:19
-- サーバのバージョン： 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ibarucky`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(128) NOT NULL,
  `cat_slug` varchar(128) NOT NULL,
  `cat_description` varchar(1024) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `cat_slug`, `cat_description`) VALUES
(1, '遊ぶ', 'play', '遊ぶのカテゴリーです。'),
(2, '観る', 'tour', '観るのカテゴリーです！'),
(5, '体験', 'experience', ''),
(7, '食べる', 'eat', ''),
(8, '文化', 'culture', ''),
(9, '買う', 'shop', ''),
(10, '泊まる', 'stay', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-07-14 10:37:55
-- 服务器版本： 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- 表的结构 `szcp_info`
--

CREATE TABLE `szcp_info` (
  `id` int(11) NOT NULL COMMENT '活动id',
  `eventName` varchar(255) NOT NULL COMMENT '活动名称',
  `eventTime` varchar(255) NOT NULL COMMENT '活动时间',
  `eventPlace` varchar(255) DEFAULT NULL COMMENT '活动地点',
  `eventScore` int(10) NOT NULL COMMENT '活动分值',
  `eventTheme` varchar(255) NOT NULL COMMENT '活动主题',
  `eventDescribe` varchar(255) DEFAULT NULL COMMENT '活动介绍',
  `eventContent` varchar(255) DEFAULT NULL COMMENT '活动内容',
  `eventType` varchar(255) DEFAULT NULL COMMENT '活动类型',
  `peopleNumber` int(10) DEFAULT NULL COMMENT '活动人数',
  `eventLeader` varchar(20) DEFAULT NULL COMMENT '活动发起人',
  `phoneNumber` varchar(15) DEFAULT NULL COMMENT '发起人电话',
  `eventState` varchar(10) NOT NULL COMMENT '活动状态'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `szcp_info`
--
ALTER TABLE `szcp_info`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `szcp_info`
--
ALTER TABLE `szcp_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '活动id';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

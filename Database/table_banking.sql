-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2022 at 02:54 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `table_banking`
--

-- --------------------------------------------------------

--
-- Table structure for table `charges`
--

CREATE TABLE `charges` (
  `c_id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contributions`
--

CREATE TABLE `contributions` (
  `id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contributions`
--

INSERT INTO `contributions` (`id`, `amount`, `member_id`, `date_created`) VALUES
(14, 1000, 1, '2021-09-16 16:44:03'),
(15, 500, 1, '2021-09-16 19:25:25'),
(17, 2000, 2, '2021-09-27 19:01:06'),
(18, 1000, 1, '2021-10-04 05:49:24'),
(19, 1000, 3, '2021-10-27 09:53:27'),
(20, 1000, 1, '2021-11-12 19:11:52'),
(21, 1000, 1, '2021-11-12 19:12:12'),
(22, 1000, 1, '2022-01-04 11:09:27'),
(23, 1000, 25, '2022-01-04 11:09:48');

-- --------------------------------------------------------

--
-- Stand-in structure for view `dividends`
-- (See below for the actual view)
--
CREATE TABLE `dividends` (
`loan` int(11)
,`id` int(11)
,`status` tinyint(255)
,`payments` int(255)
,`name` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `loan_list`
--

CREATE TABLE `loan_list` (
  `id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `borrower_id` int(11) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `status` tinyint(255) NOT NULL COMMENT '0=request,1=confirmed,2=released,3=completed,4=denied\r\n\r\n',
  `date_released` varchar(255) NOT NULL,
  `date_borrowed` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan_list`
--

INSERT INTO `loan_list` (`id`, `type_id`, `borrower_id`, `purpose`, `amount`, `plan_id`, `status`, `date_released`, `date_borrowed`) VALUES
(23, 3, 1, '', 100, 3, 4, '', '2021-11-12'),
(24, 3, 3, '', 500, 12, 4, '', '2021-11-12'),
(25, 1, 1, '', 100, 12, 4, '', '2021-11-15'),
(26, 3, 1, '', 100, 3, 4, '', '2022-01-04'),
(27, 3, 25, '', 100, 12, 4, '', '2022-01-04'),
(28, 3, 1, '', 100, 3, 3, '', '2022-08-26');

-- --------------------------------------------------------

--
-- Table structure for table `loan_plan`
--

CREATE TABLE `loan_plan` (
  `id` int(11) NOT NULL,
  `months` int(11) NOT NULL,
  `interest_percentage` int(11) NOT NULL,
  `penalty_rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan_plan`
--

INSERT INTO `loan_plan` (`id`, `months`, `interest_percentage`, `penalty_rate`) VALUES
(1, 1, 4, 1),
(3, 3, 6, 2),
(12, 12, 5, 5),
(14, 9, 10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `loan_type`
--

CREATE TABLE `loan_type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan_type`
--

INSERT INTO `loan_type` (`type_id`, `type_name`, `description`, `date_created`) VALUES
(1, 'fee', 'help our children', '2021-09-08 16:30:02'),
(3, 'business', 'help business grow', '2021-09-08 16:40:53'),
(6, 'trial', 'free money', '2021-09-10 11:23:40');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `fileName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `name`, `email`, `contact`, `password`, `date_created`, `fileName`) VALUES
(1, 'Robert kimaru', 'robkym383@gmail.com', '0799429718', '$2y$10$H3IOywiCrxiNu7TQfHG0YujYZj23kZJIqIBCxFzUoRhHlfZW88FXO', '2021-10-27', 'Screenshot_20211026-200645.png'),
(25, 'munyoroku', 'kelvinmunyoroku@gmail', '2222222222', '$2y$10$Snq.TmQBPya4ziuAPVc8SeseEbgCkruFeXU/jSIYwqVsScXlVvT5y', '2022-05-29', 'Screenshot_20211026-200645.png');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `pay_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `amount` int(255) NOT NULL,
  `date_paid` date NOT NULL DEFAULT current_timestamp(),
  `loan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`pay_id`, `member_id`, `amount`, `date_paid`, `loan_id`) VALUES
(39, 1, 100, '2021-11-12', 23),
(40, 1, 19, '2021-11-12', 23),
(41, 3, 500, '2021-11-12', 24),
(42, 3, 398, '2021-11-12', 24),
(43, 1, 100, '2021-11-15', 25),
(44, 1, 80, '2021-11-15', 25),
(45, 1, 100, '2022-01-04', 26),
(46, 1, 19, '2022-01-04', 26),
(47, 25, 100, '2022-01-04', 27),
(48, 25, 80, '2022-01-04', 27);

-- --------------------------------------------------------

--
-- Stand-in structure for view `topay`
-- (See below for the actual view)
--
CREATE TABLE `topay` (
`loanid` int(11)
,`plan_id` int(11)
,`amount` int(11)
,`date_borrowed` date
,`id` int(11)
,`name` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `to_pay`
-- (See below for the actual view)
--
CREATE TABLE `to_pay` (
`loanid` int(11)
,`plan_id` int(11)
,`amount` int(11)
,`date_borrowed` date
,`id` int(11)
,`name` varchar(255)
,`months` int(11)
,`interest_percentage` int(11)
,`penalty_rate` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=admin\r\n2=accountant\r\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `date_created`, `user_type`) VALUES
(34, 'test123', 'robkym383@gmail.com', '$2y$10$UzFd.m26i82R/rmmIoqPOOXlXcEftiF6OpVFavvaK3IbrcxXrHBlu', '2021-11-08 18:11:37', 1),
(35, 'accounts', 'robkym383@gmail.com', '$2y$10$0h2CI9MrLNK/IUDxqMEwpOewehtUMoARfkwvKQuoLStSxPrzLilNC', '2021-11-08 18:14:03', 2),
(37, 'admin', 'admin@gmail.com', '$2y$10$W8bkTRAdNrkI9kJWCohN7eqomS2qkZFFYrJF/z6/GoMlfZLO5eGBS', '2021-11-15 10:48:43', 1),
(39, 'joseph', 'njoshjose2020@gmail.com', '$2y$10$MkSG2pwoYge2S/AXrODPQOM5P0Pc4l3l0VB0ZGzyV4K6IXbKbkJKa', '2022-05-29 11:22:57', 1),
(42, 'chege', 'chege@gmail.com', '$2y$10$p7v4yrEB/WJuuANueJHJKOY.4l/IOknLCBLTh/RgJ.pTmWSMpI14q', '2022-08-26 18:13:26', 1);

-- --------------------------------------------------------

--
-- Structure for view `dividends`
--
DROP TABLE IF EXISTS `dividends`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dividends`  AS SELECT `loan_list`.`amount` AS `loan`, `loan_list`.`id` AS `id`, `loan_list`.`status` AS `status`, `payments`.`amount` AS `payments`, `member`.`name` AS `name` FROM ((`loan_list` join `payments` on(`loan_list`.`id` = `payments`.`loan_id`)) join `member` on(`member`.`id` = `payments`.`member_id`)) GROUP BY `loan_list`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `topay`
--
DROP TABLE IF EXISTS `topay`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `topay`  AS SELECT `loan_list`.`id` AS `loanid`, `loan_list`.`plan_id` AS `plan_id`, `loan_list`.`amount` AS `amount`, `loan_list`.`date_borrowed` AS `date_borrowed`, `member`.`id` AS `id`, `member`.`name` AS `name` FROM (`loan_list` join `member` on(`loan_list`.`borrower_id` = `member`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `to_pay`
--
DROP TABLE IF EXISTS `to_pay`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `to_pay`  AS SELECT `loan_list`.`id` AS `loanid`, `loan_list`.`plan_id` AS `plan_id`, `loan_list`.`amount` AS `amount`, `loan_list`.`date_borrowed` AS `date_borrowed`, `member`.`id` AS `id`, `member`.`name` AS `name`, `loan_plan`.`months` AS `months`, `loan_plan`.`interest_percentage` AS `interest_percentage`, `loan_plan`.`penalty_rate` AS `penalty_rate` FROM ((`loan_list` join `member` on(`member`.`id` = `loan_list`.`borrower_id`)) join `loan_plan` on(`loan_list`.`plan_id` = `loan_plan`.`id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `charges`
--
ALTER TABLE `charges`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `contributions`
--
ALTER TABLE `contributions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_list`
--
ALTER TABLE `loan_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`,`borrower_id`,`plan_id`);

--
-- Indexes for table `loan_plan`
--
ALTER TABLE `loan_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_type`
--
ALTER TABLE `loan_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `charges`
--
ALTER TABLE `charges`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contributions`
--
ALTER TABLE `contributions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `loan_list`
--
ALTER TABLE `loan_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `loan_plan`
--
ALTER TABLE `loan_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `loan_type`
--
ALTER TABLE `loan_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

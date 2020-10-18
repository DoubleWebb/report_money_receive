-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 18 ต.ค. 2020 เมื่อ 03:44 PM
-- เวอร์ชันของเซิร์ฟเวอร์: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `workio_receive`
--

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(11) NOT NULL,
  `emp_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_team` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_firstname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_salary` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- dump ตาราง `employee`
--

INSERT INTO `employee` (`emp_id`, `emp_code`, `emp_team`, `emp_firstname`, `emp_lastname`, `emp_status`, `emp_salary`) VALUES
(6, '001', '1', 'พี่', 'ซัง', '1', NULL),
(7, '002', '1', 'เพ็ญนภา', 'ตาปัน', '1', NULL),
(8, '003', '1', 'ฐิติพงษ์', 'อินลม', '1', NULL);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `finger`
--

CREATE TABLE `finger` (
  `finger_id` int(11) NOT NULL,
  `emp_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `punch_time` datetime DEFAULT NULL,
  `emp_team` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- dump ตาราง `finger`
--

INSERT INTO `finger` (`finger_id`, `emp_code`, `punch_time`, `emp_team`) VALUES
(118, '3', '2020-10-17 09:10:10', '1'),
(119, '2', '2020-10-17 09:42:52', '1'),
(120, '1', '2020-10-17 10:00:14', '1'),
(164, '3', '2020-10-01 07:46:37', '1'),
(165, '2', '2020-10-01 10:04:43', '1'),
(166, '1', '2020-10-01 17:15:13', '1'),
(167, '2', '2020-10-01 18:35:29', '1'),
(168, '3', '2020-10-01 18:38:48', '1'),
(169, '3', '2020-10-02 09:16:15', '1'),
(170, '1', '2020-10-02 12:17:07', '1'),
(171, '3', '2020-10-02 18:35:55', '1'),
(172, '3', '2020-10-03 09:16:18', '1'),
(173, '1', '2020-10-03 10:49:29', '1'),
(174, '1', '2020-10-03 18:09:53', '1'),
(175, '3', '2020-10-03 18:15:49', '1'),
(176, '2', '2020-10-05 09:06:33', '1'),
(177, '3', '2020-10-05 09:19:48', '1'),
(178, '2', '2020-10-05 18:10:40', '1'),
(179, '3', '2020-10-05 18:10:47', '1'),
(180, '2', '2020-10-06 09:11:04', '1'),
(181, '3', '2020-10-06 09:19:35', '1'),
(182, '1', '2020-10-06 10:27:26', '1'),
(183, '1', '2020-10-06 18:10:06', '1'),
(184, '3', '2020-10-06 18:20:14', '1'),
(185, '2', '2020-10-06 18:21:40', '1'),
(186, '3', '2020-10-07 09:12:41', '1'),
(187, '2', '2020-10-07 09:18:18', '1'),
(188, '1', '2020-10-07 18:13:52', '1'),
(189, '3', '2020-10-07 18:17:39', '1'),
(190, '2', '2020-10-07 18:20:18', '1'),
(191, '3', '2020-10-08 09:15:03', '1'),
(192, '2', '2020-10-08 09:18:48', '1'),
(193, '3', '2020-10-08 18:02:47', '1'),
(194, '2', '2020-10-08 18:02:56', '1'),
(195, '2', '2020-10-09 09:13:17', '1'),
(196, '3', '2020-10-09 09:17:28', '1'),
(197, '2', '2020-10-09 18:04:44', '1'),
(198, '3', '2020-10-09 18:06:10', '1'),
(199, '2', '2020-10-10 09:10:18', '1'),
(200, '3', '2020-10-10 09:16:45', '1'),
(201, '2', '2020-10-10 18:16:46', '1'),
(202, '3', '2020-10-10 18:21:27', '1'),
(203, '2', '2020-10-12 08:53:44', '1'),
(204, '3', '2020-10-12 09:23:09', '1'),
(205, '1', '2020-10-12 09:59:40', '1'),
(206, '1', '2020-10-12 17:43:01', '1'),
(207, '3', '2020-10-12 18:25:37', '1'),
(208, '2', '2020-10-12 20:24:28', '1'),
(209, '2', '2020-10-13 08:35:55', '1'),
(210, '3', '2020-10-13 09:14:56', '1'),
(211, '1', '2020-10-13 18:40:35', '1'),
(212, '3', '2020-10-13 18:41:51', '1'),
(213, '2', '2020-10-13 18:48:43', '1'),
(214, '2', '2020-10-14 09:15:21', '1'),
(215, '3', '2020-10-14 09:21:45', '1'),
(216, '1', '2020-10-14 10:06:40', '1'),
(217, '2', '2020-10-14 18:04:52', '1'),
(218, '3', '2020-10-14 19:02:26', '1'),
(219, '1', '2020-10-14 19:07:52', '1'),
(220, '2', '2020-10-15 09:03:32', '1'),
(221, '3', '2020-10-15 09:26:15', '1'),
(222, '1', '2020-10-15 18:13:53', '1'),
(223, '2', '2020-10-15 18:22:03', '1'),
(224, '1', '2020-10-15 18:22:40', '1'),
(225, '3', '2020-10-15 18:24:18', '1'),
(226, '1', '2020-10-15 18:24:31', '1'),
(227, '1', '2020-10-15 18:30:05', '1'),
(228, '3', '2020-10-16 09:19:07', '1'),
(229, '2', '2020-10-16 09:37:12', '1'),
(230, '1', '2020-10-16 12:56:53', '1'),
(231, '1', '2020-10-16 18:38:53', '1'),
(232, '2', '2020-10-16 18:39:10', '1'),
(233, '3', '2020-10-16 20:15:20', '1');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `setting`
--

CREATE TABLE `setting` (
  `setting_id` int(11) NOT NULL,
  `setting_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `setting_value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- dump ตาราง `setting`
--

INSERT INTO `setting` (`setting_id`, `setting_name`, `setting_value`) VALUES
(1, 'work_in_days', '31');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `special_day`
--

CREATE TABLE `special_day` (
  `special_day_id` int(11) NOT NULL,
  `special_day_date` date DEFAULT NULL,
  `special_day_remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `special_day_status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- dump ตาราง `special_day`
--

INSERT INTO `special_day` (`special_day_id`, `special_day_date`, `special_day_remark`, `special_day_status`) VALUES
(4, '2020-10-13', 'วันคล้ายวันสวรรคต พระบาทสมเด็จพระบรมชนกาธิเบศร มหาภูมิพลอดุลยเดชมหาราช บรมนาถบพิตร         ', 1),
(5, '2020-10-23', 'วันปิยมหาราช', 1),
(6, '2020-12-07', 'ชดเชยวันคล้ายวันพระบรมราชสมภพของพระบาทสมเด็จพระบรมชนกาธิเบศร มหาภูมิพลอดุลยเดชมหาราช บรมนาถบพิตร วันชาติ และวันพ่อแห่งชาติ', 1),
(7, '2020-12-10', 'วันพระราชทานรัฐธรรมนูญ', 1),
(8, '2020-12-31', 'วันสิ้นปี', 1),
(9, '2020-10-03', 'ทดสอบ', 1);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `team`
--

CREATE TABLE `team` (
  `team_id` int(12) NOT NULL,
  `team_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `team_location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `team_day_off` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `team_last_send` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- dump ตาราง `team`
--

INSERT INTO `team` (`team_id`, `team_name`, `team_location`, `team_day_off`, `team_last_send`) VALUES
(1, 'doubleweb', 'Chiang Mai', '0', '2020-10-18 11:05:26');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `view_show` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- dump ตาราง `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `view_show`, `created_at`, `updated_at`) VALUES
(1, 'Thitipong Inlom', 'nice', '$2y$10$sCtYmFQ8cQ60nE5EnADi/.18l4f.5ijkJzvepF9iEjakCZhs2tLoi', NULL, '2020-10-01 03:52:01', '2020-10-01 03:52:01');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `work`
--

CREATE TABLE `work` (
  `work_id` int(11) NOT NULL,
  `date_work` date DEFAULT NULL,
  `date_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `punch_time_in` datetime DEFAULT NULL,
  `punch_time_out` datetime DEFAULT NULL,
  `work_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '0 = ไม่มาทำงาน 1 = มาทำงาน',
  `work_status_remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '0 = วันปกติ 1 = วันหยุด 2 = ลา 3 =  ป่วย 4 = เปลี่ยนวันหยุด',
  `work_bonus_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `work_bonus_remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_team` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `work_day_money` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- dump ตาราง `work`
--

INSERT INTO `work` (`work_id`, `date_work`, `date_name`, `punch_time_in`, `punch_time_out`, `work_status`, `work_status_remark`, `work_bonus_status`, `work_bonus_remark`, `emp_code`, `emp_team`, `work_day_money`) VALUES
(1, '2020-10-18', 'Sunday', NULL, NULL, '1', '1', '0', NULL, '001', '1', NULL),
(2, '2020-10-18', 'Sunday', NULL, NULL, '1', '1', '0', NULL, '002', '1', NULL),
(3, '2020-10-18', 'Sunday', NULL, NULL, '1', '1', '0', NULL, '003', '1', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `finger`
--
ALTER TABLE `finger`
  ADD PRIMARY KEY (`finger_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `special_day`
--
ALTER TABLE `special_day`
  ADD PRIMARY KEY (`special_day_id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`team_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work`
--
ALTER TABLE `work`
  ADD PRIMARY KEY (`work_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `finger`
--
ALTER TABLE `finger`
  MODIFY `finger_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `special_day`
--
ALTER TABLE `special_day`
  MODIFY `special_day_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `team_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `work`
--
ALTER TABLE `work`
  MODIFY `work_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

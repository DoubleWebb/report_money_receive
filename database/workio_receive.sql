-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2020 at 01:06 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(11) NOT NULL,
  `emp_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_team` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_firstname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_salary` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_work_last` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `emp_code`, `emp_team`, `emp_firstname`, `emp_lastname`, `emp_status`, `emp_salary`, `emp_work_last`) VALUES
(6, '001', '1', 'พี่', 'ซัง', '1', '20000', '2020-10-17 10:00:14'),
(7, '002', '1', 'เพ็ญนภา', 'ตาปัน', '1', '15000', '2020-10-17 09:42:52'),
(8, '003', '1', 'ฐิติพงษ์', 'อินลม', '1', '18000', '2020-10-17 09:10:10');

-- --------------------------------------------------------

--
-- Table structure for table `finger`
--

CREATE TABLE `finger` (
  `finger_id` int(11) NOT NULL,
  `emp_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `finger_date` date DEFAULT NULL,
  `punch_time` datetime DEFAULT NULL,
  `emp_team` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `finger`
--

INSERT INTO `finger` (`finger_id`, `emp_code`, `finger_date`, `punch_time`, `emp_team`) VALUES
(235, '3', '2020-10-17', '2020-10-17 09:10:10', '1'),
(236, '2', '2020-10-17', '2020-10-17 09:42:52', '1'),
(237, '1', '2020-10-17', '2020-10-17 10:00:14', '1'),
(238, '2', '2020-09-23', '2020-09-23 12:07:41', '1'),
(239, '3', '2020-09-23', '2020-09-23 12:10:40', '1'),
(240, '3', '2020-09-23', '2020-09-23 12:14:48', '1'),
(241, '1', '2020-09-23', '2020-09-23 12:17:17', '1'),
(242, '2', '2020-09-23', '2020-09-23 13:19:44', '1'),
(243, '2', '2020-09-23', '2020-09-23 13:26:18', '1'),
(244, '1', '2020-09-23', '2020-09-23 13:37:34', '1'),
(245, '2', '2020-09-23', '2020-09-23 14:01:24', '1'),
(246, '2', '2020-09-23', '2020-09-23 18:18:58', '1'),
(247, '3', '2020-09-23', '2020-09-23 18:27:47', '1'),
(248, '1', '2020-09-23', '2020-09-23 18:32:59', '1'),
(249, '1', '2020-09-23', '2020-09-23 13:51:17', '1'),
(250, '2', '2020-09-24', '2020-09-24 09:18:34', '1'),
(251, '3', '2020-09-24', '2020-09-24 09:19:36', '1'),
(252, '1', '2020-09-24', '2020-09-24 12:18:15', '1'),
(253, '1', '2020-09-24', '2020-09-24 19:16:07', '1'),
(254, '3', '2020-09-24', '2020-09-24 19:16:58', '1'),
(255, '2', '2020-09-24', '2020-09-24 19:35:14', '1'),
(256, '2', '2020-09-25', '2020-09-25 09:08:57', '1'),
(257, '3', '2020-09-25', '2020-09-25 09:11:17', '1'),
(258, '2', '2020-09-25', '2020-09-25 18:01:28', '1'),
(259, '3', '2020-09-25', '2020-09-25 18:02:19', '1'),
(260, '2', '2020-09-26', '2020-09-26 09:10:51', '1'),
(261, '3', '2020-09-26', '2020-09-26 09:12:14', '1'),
(262, '2', '2020-09-26', '2020-09-26 18:17:28', '1'),
(263, '3', '2020-09-26', '2020-09-26 18:17:40', '1'),
(264, '3', '2020-09-28', '2020-09-28 09:09:35', '1'),
(265, '2', '2020-09-28', '2020-09-28 09:19:23', '1'),
(266, '1', '2020-09-28', '2020-09-28 13:57:33', '1'),
(267, '2', '2020-09-28', '2020-09-28 18:06:19', '1'),
(268, '1', '2020-09-28', '2020-09-28 18:09:59', '1'),
(269, '3', '2020-09-28', '2020-09-28 18:10:09', '1'),
(270, '2', '2020-09-29', '2020-09-29 08:55:02', '1'),
(271, '3', '2020-09-29', '2020-09-29 09:13:08', '1'),
(272, '1', '2020-09-29', '2020-09-29 15:05:14', '1'),
(273, '2', '2020-09-29', '2020-09-29 18:25:28', '1'),
(274, '1', '2020-09-29', '2020-09-29 18:25:41', '1'),
(275, '3', '2020-09-29', '2020-09-29 18:27:54', '1'),
(276, '2', '2020-09-30', '2020-09-30 09:06:52', '1'),
(277, '3', '2020-09-30', '2020-09-30 09:50:33', '1'),
(278, '2', '2020-09-30', '2020-09-30 18:13:47', '1'),
(279, '3', '2020-09-30', '2020-09-30 21:28:10', '1'),
(280, '1', '2020-09-30', '2020-09-30 21:42:37', '1'),
(281, '3', '2020-10-01', '2020-10-01 07:46:37', '1'),
(282, '2', '2020-10-01', '2020-10-01 10:04:43', '1'),
(283, '1', '2020-10-01', '2020-10-01 17:15:13', '1'),
(284, '2', '2020-10-01', '2020-10-01 18:35:29', '1'),
(285, '3', '2020-10-01', '2020-10-01 18:38:48', '1'),
(286, '3', '2020-10-02', '2020-10-02 09:16:15', '1'),
(287, '1', '2020-10-02', '2020-10-02 12:17:07', '1'),
(288, '3', '2020-10-02', '2020-10-02 18:35:55', '1'),
(289, '3', '2020-10-03', '2020-10-03 09:16:18', '1'),
(290, '1', '2020-10-03', '2020-10-03 10:49:29', '1'),
(291, '1', '2020-10-03', '2020-10-03 18:09:53', '1'),
(292, '3', '2020-10-03', '2020-10-03 18:15:49', '1'),
(293, '2', '2020-10-05', '2020-10-05 09:06:33', '1'),
(294, '3', '2020-10-05', '2020-10-05 09:19:48', '1'),
(295, '2', '2020-10-05', '2020-10-05 18:10:40', '1'),
(296, '3', '2020-10-05', '2020-10-05 18:10:47', '1'),
(297, '2', '2020-10-06', '2020-10-06 09:11:04', '1'),
(298, '3', '2020-10-06', '2020-10-06 09:19:35', '1'),
(299, '1', '2020-10-06', '2020-10-06 10:27:26', '1'),
(300, '1', '2020-10-06', '2020-10-06 18:10:06', '1'),
(301, '3', '2020-10-06', '2020-10-06 18:20:14', '1'),
(302, '2', '2020-10-06', '2020-10-06 18:21:40', '1'),
(303, '3', '2020-10-07', '2020-10-07 09:12:41', '1'),
(304, '2', '2020-10-07', '2020-10-07 09:18:18', '1'),
(305, '1', '2020-10-07', '2020-10-07 18:13:52', '1'),
(306, '3', '2020-10-07', '2020-10-07 18:17:39', '1'),
(307, '2', '2020-10-07', '2020-10-07 18:20:18', '1'),
(308, '3', '2020-10-08', '2020-10-08 09:15:03', '1'),
(309, '2', '2020-10-08', '2020-10-08 09:18:48', '1'),
(310, '3', '2020-10-08', '2020-10-08 18:02:47', '1'),
(311, '2', '2020-10-08', '2020-10-08 18:02:56', '1'),
(312, '2', '2020-10-09', '2020-10-09 09:13:17', '1'),
(313, '3', '2020-10-09', '2020-10-09 09:17:28', '1'),
(314, '2', '2020-10-09', '2020-10-09 18:04:44', '1'),
(315, '3', '2020-10-09', '2020-10-09 18:06:10', '1'),
(316, '2', '2020-10-10', '2020-10-10 09:10:18', '1'),
(317, '3', '2020-10-10', '2020-10-10 09:16:45', '1'),
(318, '2', '2020-10-10', '2020-10-10 18:16:46', '1'),
(319, '3', '2020-10-10', '2020-10-10 18:21:27', '1'),
(320, '2', '2020-10-12', '2020-10-12 08:53:44', '1'),
(321, '3', '2020-10-12', '2020-10-12 09:23:09', '1'),
(322, '1', '2020-10-12', '2020-10-12 09:59:40', '1'),
(323, '1', '2020-10-12', '2020-10-12 17:43:01', '1'),
(324, '3', '2020-10-12', '2020-10-12 18:25:37', '1'),
(325, '2', '2020-10-12', '2020-10-12 20:24:28', '1'),
(326, '2', '2020-10-13', '2020-10-13 08:35:55', '1'),
(327, '3', '2020-10-13', '2020-10-13 09:14:56', '1'),
(328, '1', '2020-10-13', '2020-10-13 18:40:35', '1'),
(329, '3', '2020-10-13', '2020-10-13 18:41:51', '1'),
(330, '2', '2020-10-13', '2020-10-13 18:48:43', '1'),
(331, '2', '2020-10-14', '2020-10-14 09:15:21', '1'),
(332, '3', '2020-10-14', '2020-10-14 09:21:45', '1'),
(333, '1', '2020-10-14', '2020-10-14 10:06:40', '1'),
(334, '2', '2020-10-14', '2020-10-14 18:04:52', '1'),
(335, '3', '2020-10-14', '2020-10-14 19:02:26', '1'),
(336, '1', '2020-10-14', '2020-10-14 19:07:52', '1'),
(337, '2', '2020-10-15', '2020-10-15 09:03:32', '1'),
(338, '3', '2020-10-15', '2020-10-15 09:26:15', '1'),
(339, '1', '2020-10-15', '2020-10-15 18:13:53', '1'),
(340, '2', '2020-10-15', '2020-10-15 18:22:03', '1'),
(341, '1', '2020-10-15', '2020-10-15 18:22:40', '1'),
(342, '3', '2020-10-15', '2020-10-15 18:24:18', '1'),
(343, '1', '2020-10-15', '2020-10-15 18:24:31', '1'),
(344, '1', '2020-10-15', '2020-10-15 18:30:05', '1'),
(345, '3', '2020-10-16', '2020-10-16 09:19:07', '1'),
(346, '2', '2020-10-16', '2020-10-16 09:37:12', '1'),
(347, '1', '2020-10-16', '2020-10-16 12:56:53', '1'),
(348, '1', '2020-10-16', '2020-10-16 18:38:53', '1'),
(349, '2', '2020-10-16', '2020-10-16 18:39:10', '1'),
(350, '3', '2020-10-16', '2020-10-16 20:15:20', '1');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `setting_id` int(11) NOT NULL,
  `setting_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `setting_value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`setting_id`, `setting_name`, `setting_value`) VALUES
(1, 'work_in_days', '31');

-- --------------------------------------------------------

--
-- Table structure for table `special_day`
--

CREATE TABLE `special_day` (
  `special_day_id` int(11) NOT NULL,
  `special_day_date` date DEFAULT NULL,
  `special_day_remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `special_day_status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `special_day`
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
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `team_id` int(12) NOT NULL,
  `team_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `team_location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `team_day_off` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `team_last_send` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`team_id`, `team_name`, `team_location`, `team_day_off`, `team_last_send`) VALUES
(1, 'doubleweb', 'Chiang Mai', '0', '2020-10-18 11:05:26'),
(2, 'test', NULL, '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `view_show`, `created_at`, `updated_at`) VALUES
(1, 'Thitipong Inlom', 'nice', '$2y$10$sCtYmFQ8cQ60nE5EnADi/.18l4f.5ijkJzvepF9iEjakCZhs2tLoi', '1', '2020-10-01 03:52:01', '2020-10-01 03:52:01');

-- --------------------------------------------------------

--
-- Table structure for table `work`
--

CREATE TABLE `work` (
  `work_id` int(11) NOT NULL,
  `date_work` date DEFAULT NULL,
  `date_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `punch_time_in` datetime DEFAULT NULL,
  `punch_time_out` datetime DEFAULT NULL,
  `work_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '0 = ไม่มาทำงาน 1 = มาทำงาน',
  `work_status_remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '0 = วันปกติ 1 = วันหยุด 2 = ลา 3 =  ป่วย 4 = เปลี่ยนวันหยุด 5 = หักเงิน 25% 6 = หักเงิน 50% 7 = หักเงิน 75%',
  `work_bonus_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `work_bonus_remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_team` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `work_day_money` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `work`
--

INSERT INTO `work` (`work_id`, `date_work`, `date_name`, `punch_time_in`, `punch_time_out`, `work_status`, `work_status_remark`, `work_bonus_status`, `work_bonus_remark`, `emp_code`, `emp_team`, `work_day_money`) VALUES
(1, '2020-10-18', 'Sunday', NULL, NULL, '1', '1', '0', NULL, '001', '1', '0'),
(2, '2020-10-18', 'Sunday', NULL, NULL, '1', '1', '0', NULL, '002', '1', '0'),
(3, '2020-10-18', 'Sunday', NULL, NULL, '1', '1', '0', NULL, '003', '1', '0'),
(4, '2020-10-19', 'Monday', NULL, NULL, '0', '0', '0', NULL, '001', '1', '0'),
(5, '2020-10-19', 'Monday', NULL, NULL, '0', '0', '0', NULL, '002', '1', '0'),
(6, '2020-10-19', 'Monday', NULL, NULL, '0', '0', '0', NULL, '003', '1', '0'),
(7, '2020-10-17', 'Saturday', '2020-10-17 10:00:14', NULL, '1', '0', '0', NULL, '001', '1', '645.16129032258'),
(8, '2020-10-17', 'Saturday', '2020-10-17 09:42:52', NULL, '1', '0', '0', NULL, '002', '1', '483.87096774194'),
(9, '2020-10-17', 'Saturday', '2020-10-17 09:10:10', NULL, '1', '0', '0', NULL, '003', '1', '580.64516129032');

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
  MODIFY `finger_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=351;

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
  MODIFY `team_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `work`
--
ALTER TABLE `work`
  MODIFY `work_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

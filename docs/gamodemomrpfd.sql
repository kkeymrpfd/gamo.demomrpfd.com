-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2016 at 09:28 PM
-- Server version: 10.1.9-MariaDB-1~trusty
-- PHP Version: 5.6.99-hhvm

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamodemomrpfd`
--

-- --------------------------------------------------------

--
-- Table structure for table `actions_info`
--

CREATE TABLE IF NOT EXISTS `actions_info` (
  `actions_info_id` int(14) NOT NULL,
  `action_id` int(12) NOT NULL,
  `info_type` varchar(255) NOT NULL,
  `int_info` int(12) NOT NULL,
  `info` varchar(255) NOT NULL,
  `info_b` varchar(255) NOT NULL,
  `other_c` varchar(255) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=203 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `actions_info`
--

INSERT INTO `actions_info` (`actions_info_id`, `action_id`, `info_type`, `int_info`, `info`, `info_b`, `other_c`, `time`) VALUES
(77, 2, 'mdf_field', 0, 'packages_option_id', '1', '', '2016-01-03 01:52:11'),
(78, 2, 'mdf_field', 0, 'partner_contact_name', 'Naif Ahmed', '', '2016-01-03 01:52:11'),
(79, 2, 'mdf_field', 0, 'partner_contact_number', '555-456-1111', '', '2016-01-03 01:52:11'),
(80, 2, 'mdf_field', 0, 'partner_contact_email', 'nahmed@mrpfd.com', '', '2016-01-03 01:52:11'),
(81, 2, 'mdf_field', 0, 'message_topic', 'enterprise', '', '2016-01-03 01:52:11'),
(82, 2, 'mdf_field', 0, 'undefined', '0', '', '2016-01-03 01:52:11'),
(83, 2, 'mdf_field', 0, 'start_date', '01/22/2016', '', '2016-01-03 01:52:11'),
(84, 2, 'mdf_field', 0, 'sfdc_campaign_code', '', '', '2016-01-03 01:52:11'),
(85, 2, 'mdf_field', 0, 'geography', 'none', '', '2016-01-03 01:52:11'),
(86, 2, 'mdf_field', 0, 'employee_size_0_to_99', '0', '', '2016-01-03 01:52:11'),
(87, 2, 'mdf_field', 0, 'employee_size_100_to_249', '0', '', '2016-01-03 01:52:11'),
(88, 2, 'mdf_field', 0, 'employee_size_250_to_499', '0', '', '2016-01-03 01:52:11'),
(89, 2, 'mdf_field', 0, 'employee_size_500_to_999', '0', '', '2016-01-03 01:52:11'),
(90, 2, 'mdf_field', 0, 'employee_size_1000_to_5000', '0', '', '2016-01-03 01:52:11'),
(91, 3, 'mdf_field', 0, 'packages_option_id', '4', '', '2016-01-03 01:53:46'),
(92, 3, 'mdf_field', 0, 'partner_contact_name', 'Naif Ahmed', '', '2016-01-03 01:53:46'),
(93, 3, 'mdf_field', 0, 'partner_contact_number', '555-456-7890', '', '2016-01-03 01:53:46'),
(94, 3, 'mdf_field', 0, 'partner_contact_email', 'nahmed@mrpfd.com', '', '2016-01-03 01:53:46'),
(95, 3, 'mdf_field', 0, 'message_topic', 'enterprise', '', '2016-01-03 01:53:46'),
(96, 3, 'mdf_field', 0, 'undefined', '0', '', '2016-01-03 01:53:46'),
(97, 3, 'mdf_field', 0, 'start_date', '', '', '2016-01-03 01:53:46'),
(98, 3, 'mdf_field', 0, 'sfdc_campaign_code', '', '', '2016-01-03 01:53:46'),
(99, 3, 'mdf_field', 0, 'geography', 'none', '', '2016-01-03 01:53:46'),
(100, 3, 'mdf_field', 0, 'employee_size_0_to_99', '0', '', '2016-01-03 01:53:46'),
(101, 3, 'mdf_field', 0, 'employee_size_100_to_249', '0', '', '2016-01-03 01:53:46'),
(102, 3, 'mdf_field', 0, 'employee_size_250_to_499', '0', '', '2016-01-03 01:53:46'),
(103, 3, 'mdf_field', 0, 'employee_size_500_to_999', '0', '', '2016-01-03 01:53:46'),
(104, 3, 'mdf_field', 0, 'employee_size_1000_to_5000', '0', '', '2016-01-03 01:53:46'),
(105, 4, 'mdf_field', 0, 'packages_option_id', '1', '', '2016-01-03 01:57:45'),
(106, 4, 'mdf_field', 0, 'partner_contact_name', 'Naif Ahmed', '', '2016-01-03 01:57:45'),
(107, 4, 'mdf_field', 0, 'partner_contact_number', '555-456-7890', '', '2016-01-03 01:57:45'),
(108, 4, 'mdf_field', 0, 'partner_contact_email', 'nahmed@mrpfd.com', '', '2016-01-03 01:57:45'),
(109, 4, 'mdf_field', 0, 'message_topic', 'enterprise', '', '2016-01-03 01:57:45'),
(110, 4, 'mdf_field', 0, 'undefined', '0', '', '2016-01-03 01:57:45'),
(111, 4, 'mdf_field', 0, 'start_date', '', '', '2016-01-03 01:57:45'),
(112, 4, 'mdf_field', 0, 'sfdc_campaign_code', '', '', '2016-01-03 01:57:45'),
(113, 4, 'mdf_field', 0, 'geography', 'none', '', '2016-01-03 01:57:45'),
(114, 4, 'mdf_field', 0, 'employee_size_0_to_99', '0', '', '2016-01-03 01:57:45'),
(115, 4, 'mdf_field', 0, 'employee_size_100_to_249', '0', '', '2016-01-03 01:57:45'),
(116, 4, 'mdf_field', 0, 'employee_size_250_to_499', '0', '', '2016-01-03 01:57:45'),
(117, 4, 'mdf_field', 0, 'employee_size_500_to_999', '0', '', '2016-01-03 01:57:45'),
(118, 4, 'mdf_field', 0, 'employee_size_1000_to_5000', '0', '', '2016-01-03 01:57:45'),
(119, 5, 'mdf_field', 0, 'packages_option_id', '1', '', '2016-01-03 01:58:16'),
(120, 5, 'mdf_field', 0, 'partner_contact_name', 'Naif Ahmed', '', '2016-01-03 01:58:16'),
(121, 5, 'mdf_field', 0, 'partner_contact_number', '555-456-7890', '', '2016-01-03 01:58:16'),
(122, 5, 'mdf_field', 0, 'partner_contact_email', 'nahmed@mrpfd.com', '', '2016-01-03 01:58:16'),
(123, 5, 'mdf_field', 0, 'message_topic', 'enterprise', '', '2016-01-03 01:58:16'),
(124, 5, 'mdf_field', 0, 'undefined', '0', '', '2016-01-03 01:58:16'),
(125, 5, 'mdf_field', 0, 'start_date', '', '', '2016-01-03 01:58:16'),
(126, 5, 'mdf_field', 0, 'sfdc_campaign_code', '', '', '2016-01-03 01:58:16'),
(127, 5, 'mdf_field', 0, 'geography', 'none', '', '2016-01-03 01:58:16'),
(128, 5, 'mdf_field', 0, 'employee_size_0_to_99', '0', '', '2016-01-03 01:58:16'),
(129, 5, 'mdf_field', 0, 'employee_size_100_to_249', '0', '', '2016-01-03 01:58:16'),
(130, 5, 'mdf_field', 0, 'employee_size_250_to_499', '0', '', '2016-01-03 01:58:16'),
(131, 5, 'mdf_field', 0, 'employee_size_500_to_999', '0', '', '2016-01-03 01:58:16'),
(132, 5, 'mdf_field', 0, 'employee_size_1000_to_5000', '0', '', '2016-01-03 01:58:16'),
(147, 6, 'mdf_field', 0, 'packages_option_id', '17', '', '2016-01-03 01:59:14'),
(148, 6, 'mdf_field', 0, 'partner_contact_name', 'Naif Ahmed', '', '2016-01-03 01:59:14'),
(149, 6, 'mdf_field', 0, 'partner_contact_number', '555-456-7890', '', '2016-01-03 01:59:14'),
(150, 6, 'mdf_field', 0, 'partner_contact_email', 'nahmed@mrpfd.com', '', '2016-01-03 01:59:14'),
(151, 6, 'mdf_field', 0, 'message_topic', 'client', '', '2016-01-03 01:59:14'),
(152, 6, 'mdf_field', 0, 'undefined', '0', '', '2016-01-03 01:59:14'),
(153, 6, 'mdf_field', 0, 'start_date', '01/28/2016', '', '2016-01-03 01:59:14'),
(154, 6, 'mdf_field', 0, 'sfdc_campaign_code', '', '', '2016-01-03 01:59:14'),
(155, 6, 'mdf_field', 0, 'geography', 'none', '', '2016-01-03 01:59:14'),
(156, 6, 'mdf_field', 0, 'employee_size_0_to_99', '0', '', '2016-01-03 01:59:14'),
(157, 6, 'mdf_field', 0, 'employee_size_100_to_249', '0', '', '2016-01-03 01:59:14'),
(158, 6, 'mdf_field', 0, 'employee_size_250_to_499', '1', '', '2016-01-03 01:59:14'),
(159, 6, 'mdf_field', 0, 'employee_size_500_to_999', '1', '', '2016-01-03 01:59:14'),
(160, 6, 'mdf_field', 0, 'employee_size_1000_to_5000', '0', '', '2016-01-03 01:59:14'),
(161, 7, 'mdf_field', 0, 'packages_option_id', '1', '', '2016-01-03 02:05:06'),
(162, 7, 'mdf_field', 0, 'partner_contact_name', 'Naif Ahmed', '', '2016-01-03 02:05:06'),
(163, 7, 'mdf_field', 0, 'partner_contact_number', '555-456-7890', '', '2016-01-03 02:05:06'),
(164, 7, 'mdf_field', 0, 'partner_contact_email', 'nahmed@mrpfd.com', '', '2016-01-03 02:05:06'),
(165, 7, 'mdf_field', 0, 'message_topic', 'enterprise', '', '2016-01-03 02:05:06'),
(166, 7, 'mdf_field', 0, 'undefined', '0', '', '2016-01-03 02:05:06'),
(167, 7, 'mdf_field', 0, 'start_date', '', '', '2016-01-03 02:05:06'),
(168, 7, 'mdf_field', 0, 'sfdc_campaign_code', '', '', '2016-01-03 02:05:06'),
(169, 7, 'mdf_field', 0, 'geography', 'none', '', '2016-01-03 02:05:06'),
(170, 7, 'mdf_field', 0, 'employee_size_0_to_99', '0', '', '2016-01-03 02:05:06'),
(171, 7, 'mdf_field', 0, 'employee_size_100_to_249', '1', '', '2016-01-03 02:05:06'),
(172, 7, 'mdf_field', 0, 'employee_size_250_to_499', '1', '', '2016-01-03 02:05:06'),
(173, 7, 'mdf_field', 0, 'employee_size_500_to_999', '0', '', '2016-01-03 02:05:06'),
(174, 7, 'mdf_field', 0, 'employee_size_1000_to_5000', '0', '', '2016-01-03 02:05:06'),
(175, 8, 'mdf_field', 0, 'packages_option_id', '28', '', '2016-01-03 02:05:21'),
(176, 8, 'mdf_field', 0, 'partner_contact_name', 'Naif Ahmed', '', '2016-01-03 02:05:21'),
(177, 8, 'mdf_field', 0, 'partner_contact_number', '555-456-7890', '', '2016-01-03 02:05:21'),
(178, 8, 'mdf_field', 0, 'partner_contact_email', 'nahmed@mrpfd.com', '', '2016-01-03 02:05:21'),
(179, 8, 'mdf_field', 0, 'message_topic', 'client', '', '2016-01-03 02:05:21'),
(180, 8, 'mdf_field', 0, 'undefined', '0', '', '2016-01-03 02:05:21'),
(181, 8, 'mdf_field', 0, 'start_date', '', '', '2016-01-03 02:05:21'),
(182, 8, 'mdf_field', 0, 'sfdc_campaign_code', '', '', '2016-01-03 02:05:21'),
(183, 8, 'mdf_field', 0, 'geography', 'none', '', '2016-01-03 02:05:21'),
(184, 8, 'mdf_field', 0, 'employee_size_0_to_99', '0', '', '2016-01-03 02:05:21'),
(185, 8, 'mdf_field', 0, 'employee_size_100_to_249', '0', '', '2016-01-03 02:05:21'),
(186, 8, 'mdf_field', 0, 'employee_size_250_to_499', '0', '', '2016-01-03 02:05:21'),
(187, 8, 'mdf_field', 0, 'employee_size_500_to_999', '0', '', '2016-01-03 02:05:21'),
(188, 8, 'mdf_field', 0, 'employee_size_1000_to_5000', '0', '', '2016-01-03 02:05:21'),
(189, 9, 'mdf_field', 0, 'packages_option_id', '38', '', '2016-01-03 02:24:12'),
(190, 9, 'mdf_field', 0, 'partner_contact_name', 'Naif Ahmed', '', '2016-01-03 02:24:12'),
(191, 9, 'mdf_field', 0, 'partner_contact_number', '555-456-7890', '', '2016-01-03 02:24:12'),
(192, 9, 'mdf_field', 0, 'partner_contact_email', 'nahmed@mrpfd.com', '', '2016-01-03 02:24:12'),
(193, 9, 'mdf_field', 0, 'message_topic', 'enterprise', '', '2016-01-03 02:24:12'),
(194, 9, 'mdf_field', 0, 'undefined', '0', '', '2016-01-03 02:24:12'),
(195, 9, 'mdf_field', 0, 'start_date', '', '', '2016-01-03 02:24:12'),
(196, 9, 'mdf_field', 0, 'sfdc_campaign_code', '', '', '2016-01-03 02:24:12'),
(197, 9, 'mdf_field', 0, 'geography', 'none', '', '2016-01-03 02:24:12'),
(198, 9, 'mdf_field', 0, 'employee_size_0_to_99', '1', '', '2016-01-03 02:24:12'),
(199, 9, 'mdf_field', 0, 'employee_size_100_to_249', '0', '', '2016-01-03 02:24:12'),
(200, 9, 'mdf_field', 0, 'employee_size_250_to_499', '0', '', '2016-01-03 02:24:12'),
(201, 9, 'mdf_field', 0, 'employee_size_500_to_999', '0', '', '2016-01-03 02:24:12'),
(202, 9, 'mdf_field', 0, 'employee_size_1000_to_5000', '0', '', '2016-01-03 02:24:12');

-- --------------------------------------------------------

--
-- Table structure for table `actions_log`
--

CREATE TABLE IF NOT EXISTS `actions_log` (
  `action_id` int(12) NOT NULL,
  `action_types_id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `point_value` int(5) NOT NULL,
  `point_value_use` int(5) NOT NULL,
  `point_value_used` int(5) NOT NULL,
  `int_other` int(12) NOT NULL,
  `other` varchar(80) NOT NULL,
  `other_b` varchar(80) NOT NULL,
  `other_c` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  `triggered_by` int(12) NOT NULL DEFAULT '-1',
  `trigger_type` int(1) NOT NULL DEFAULT '-1',
  `active` tinyint(1) NOT NULL,
  `action_id_alias` varchar(12) NOT NULL DEFAULT ''
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `actions_log`
--

INSERT INTO `actions_log` (`action_id`, `action_types_id`, `user_id`, `point_value`, `point_value_use`, `point_value_used`, `int_other`, `other`, `other_b`, `other_c`, `time`, `triggered_by`, `trigger_type`, `active`, `action_id_alias`) VALUES
(2, 47, 759, 0, 0, 0, 5, '1', '1u0r5ehw3s2ay3e8', '1', '2016-01-03 01:50:09', -1, -1, 0, ''),
(3, 47, 759, 0, 0, 0, 5, '2', '3khv3g2z86ubwdk7', '1', '2016-01-03 01:53:46', -1, -1, 0, ''),
(4, 47, 759, 0, 0, 0, 5, '1', 'hh0cvm0ytv0byyuc', '1', '2016-01-03 01:57:45', -1, -1, 0, ''),
(5, 47, 759, 0, 0, 0, 5, '1', '3jqysgus83chmfwd', '1', '2016-01-03 01:58:16', -1, -1, 1, ''),
(6, 47, 759, 0, 0, 0, 5, '10', 'mjy2648gcyr4f2o3', '1', '2016-01-03 01:58:58', -1, -1, 0, ''),
(7, 47, 759, 0, 0, 0, 5, '1', 'mznsffvmdvwicw8w', '1', '2016-01-03 02:05:06', -1, -1, 0, ''),
(8, 47, 759, 0, 0, 0, 5, '14', 'm910e73nkcshs0ka', '1', '2016-01-03 02:05:21', -1, -1, 0, ''),
(9, 47, 759, 0, 0, 0, 5, '20', '6znkcntzz1t7liuu', '1', '2016-01-03 02:24:12', -1, -1, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `action_types`
--

CREATE TABLE IF NOT EXISTS `action_types` (
  `action_types_id` int(12) NOT NULL,
  `action_name` varchar(120) NOT NULL,
  `points` int(5) NOT NULL,
  `action_key` varchar(30) NOT NULL DEFAULT '',
  `action_types_id_alias` varchar(120) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `action_types`
--

INSERT INTO `action_types` (`action_types_id`, `action_name`, `points`, `action_key`, `action_types_id_alias`) VALUES
(2, 'Download/View a resource', 30, 'download_resource', ''),
(3, 'Send resource to a contact', 25, 'share_resource', ''),
(5, 'Schedule a Meeting with a C-Level', 300, 'schedule_meeting_clevel', ''),
(25, 'Upload your profile picture', 20, 'upload_profile_pic', ''),
(26, 'Answer Submitted', 0, 'answer_submitted', ''),
(27, 'Answer a question!', 50, 'answer_quiz', ''),
(30, 'Register for Dell Overdrive', 25, 'register_portal', ''),
(31, 'Pre-Registration', 20, 'preregister', ''),
(32, 'Submit feedback for an opportinity', 100, 'transacted_meeting_manager', ''),
(34, 'Submit an approved opportunity', 200, 'schedule_meeting_manager', ''),
(35, 'Submit feedback for an opportinity', 100, 'transacted_meeting_clevel', ''),
(36, 'Close a deal ', 300, 'won_meeting', ''),
(37, 'Schedule a POC/Eval', 500, 'poc_meeting', ''),
(39, 'Watched 15 min video', 0, 'watched_full_79', ''),
(40, 'Watched 1 hour video', 0, 'watched_full_78', ''),
(41, 'Create a case study', 100, 'case_study', ''),
(42, 'Submit deal registration', 200, 'submit_meeting', ''),
(43, 'Submit deal closing', 300, 'submit_deal_close', ''),
(44, 'Submit deal feedback', 100, 'submit_deal_feedback', ''),
(45, 'Send email to a contact using the demand gen module', 2, 'send_demandgen', ''),
(46, 'Login at least 3 days a week for 4 weeks', 0, 'multiple_logins', ''),
(47, 'Create MDF Activity', 0, 'create_mdf_activity', '');

-- --------------------------------------------------------

--
-- Table structure for table `action_types_info`
--

CREATE TABLE IF NOT EXISTS `action_types_info` (
  `action_types_info_id` int(12) NOT NULL,
  `action_types_id` int(12) NOT NULL,
  `info_type` varchar(30) NOT NULL,
  `int_info` int(12) NOT NULL,
  `info` varchar(120) NOT NULL,
  `info_b` varchar(80) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `action_types_info`
--

INSERT INTO `action_types_info` (`action_types_info_id`, `action_types_id`, `info_type`, `int_info`, `info`, `info_b`, `time`) VALUES
(3, 2, 'category', 14, '', '', '0000-00-00 00:00:00'),
(1, 2, 'max_month_qty', 2, '', '', '0000-00-00 00:00:00'),
(2, 2, 'max_qty', 7, '', '', '0000-00-00 00:00:00'),
(12, 3, 'max_points_per_seconds', 500, '2592000', '', '0000-00-00 00:00:00'),
(4, 3, 'max_qty_per_seconds', 2, '178800', '', '0000-00-00 00:00:00'),
(5, 5, 'category', 18, '', '', '0000-00-00 00:00:00'),
(13, 5, 'max_daily_qty', 5, '', '', '0000-00-00 00:00:00'),
(14, 27, 'category', 74, '', '', '0000-00-00 00:00:00'),
(11, 30, 'activity_display', 0, '[display-name] registered for gamification and got [points] pts!', '', '0000-00-00 00:00:00'),
(6, 32, 'category', 18, '', '', '0000-00-00 00:00:00'),
(7, 34, 'max_month_qty', 20, '', '', '0000-00-00 00:00:00'),
(8, 35, 'category', 18, '', '', '0000-00-00 00:00:00'),
(9, 36, 'max_month_qty', 3, '', '', '0000-00-00 00:00:00'),
(10, 37, 'category', 18, '', '', '0000-00-00 00:00:00'),
(15, 45, 'max_month_qty', 500, '', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `answer_id` int(12) NOT NULL,
  `question_id` int(12) NOT NULL,
  `answer` varchar(200) NOT NULL,
  `correct` tinyint(1) NOT NULL,
  `answer_order` int(12) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`answer_id`, `question_id`, `answer`, `correct`, `answer_order`, `active`) VALUES
(1, 4, 'C-LEVEL EXECUTIVE', 0, 1, 1),
(2, 4, 'VICE PRESIDENT', 0, 2, 1),
(3, 4, 'DIRECTOR', 0, 3, 1),
(4, 4, 'MANAGER', 0, 4, 1),
(9, 2, '18', 1, 1, 1),
(10, 2, '9', 0, 2, 1),
(11, 2, '14', 0, 3, 1),
(12, 2, '28', 0, 4, 1),
(13, 3, 'NEUTRAL ASYMETRICAL STORAGE', 0, 1, 1),
(14, 3, 'NETWORK ATTACHED STORAGE', 1, 2, 1),
(15, 3, 'NETWORK ASYNCHRONOUS STORAGE', 0, 3, 1),
(16, 3, 'NETWORKABLE AVAILABLE STORAGE', 0, 4, 1),
(17, 5, '20%', 0, 1, 1),
(18, 5, '50%', 0, 2, 1),
(19, 5, '60%', 0, 3, 1),
(20, 5, '90%', 1, 4, 1),
(21, 4, 'ARCHITECT', 0, 5, 1),
(22, 4, 'CONSULTANT', 0, 6, 1),
(23, 4, 'ADMINISTRATOR', 0, 7, 1),
(24, 4, 'DEVELOPER', 0, 8, 1),
(26, 4, 'OTHER - TECHNICAL', 0, 9, 1),
(27, 4, 'OTHER - NON-TECHNICAL', 0, 10, 1),
(28, 12, '2', 0, 1, 1),
(29, 12, '4', 1, 2, 1),
(30, 12, '16', 0, 3, 1),
(31, 12, '24', 0, 4, 1),
(32, 1, '2000', 0, 1, 1),
(33, 1, '7000', 0, 2, 1),
(34, 14, 'BACK DOOR EXIT', 0, 1, 1),
(35, 14, 'DISK BURN', 0, 2, 1),
(36, 1, '9000', 1, 3, 1),
(37, 1, '5000', 0, 4, 1),
(39, 14, 'BACKUP STORAGE', 1, 3, 1),
(40, 14, 'BACKSPACE KEY', 0, 4, 1),
(41, 15, 'ADDING STORAGE', 0, 1, 1),
(42, 15, 'BACKUP', 0, 2, 1),
(43, 15, 'CLOUD INITIATIVES', 0, 3, 1),
(44, 15, 'DISASTER RECOVERY', 0, 4, 1),
(45, 15, 'HADOOP ANALYTICS', 0, 5, 1),
(46, 15, 'SERVER CONSOLIDATION', 0, 6, 1),
(47, 15, 'VIRTUALIZATION', 0, 7, 1),
(48, 15, 'OTHER', 0, 8, 1),
(49, 16, '$1 BILLION', 0, 1, 1),
(50, 16, '$300 BILLION', 0, 2, 1),
(51, 16, '$1 TRILLION', 0, 3, 1),
(52, 16, '$600 BILLION', 1, 4, 1),
(53, 17, '20 PETABYTES', 1, 1, 1),
(54, 17, '20 TERABYTES', 0, 2, 1),
(55, 17, '20 HELIEBYTES', 0, 3, 1),
(56, 17, '20 EXABYTES', 0, 4, 1),
(57, 18, '500+ TB', 0, 1, 1),
(58, 18, '101-500 TB', 0, 2, 1),
(59, 18, '26-100 TB', 0, 3, 1),
(60, 18, '0-25 TB', 0, 4, 1),
(61, 19, '1 TRILLION', 0, 1, 1),
(62, 19, '50 BILLION', 1, 2, 1),
(63, 19, '70 MILLION', 0, 3, 1),
(64, 19, '9 BILLION', 0, 4, 1),
(65, 20, '5%', 0, 1, 1),
(66, 20, '19%', 0, 2, 1),
(67, 20, '1%', 0, 3, 1),
(68, 20, '24%', 1, 4, 1),
(69, 21, 'FOOD, WATER AND CHOCOLATE', 1, 1, 1),
(70, 21, 'ROCK AND ROLL', 0, 2, 1),
(71, 21, 'WEIGHT AND SORENESS', 0, 3, 1),
(72, 21, 'HAPPINESS', 0, 4, 1),
(73, 22, 'EMC', 0, 1, 1),
(74, 22, 'IBM', 0, 2, 1),
(75, 6, 'COMMANDER', 0, 1, 1),
(76, 6, 'LIEUTENANT COMMANDER', 1, 2, 1),
(77, 22, 'NETAPP', 0, 3, 1),
(78, 22, 'HP', 0, 4, 1),
(79, 6, 'CAPTAIN', 0, 3, 1),
(80, 6, 'ENSIGN', 0, 4, 1),
(81, 22, 'HITACHI', 0, 5, 1),
(82, 22, 'OTHER', 0, 6, 1),
(83, 7, 'XABYTE', 0, 1, 1),
(84, 7, 'ZETTABYTE', 0, 2, 1),
(85, 23, 'IMPROVED STORAGE UTILIZATION', 0, 1, 1),
(86, 23, 'IT PRODUCTIVITY', 0, 2, 1),
(87, 7, 'YOTTABYTE', 0, 3, 1),
(88, 7, 'HEILEYBYTE', 1, 4, 1),
(89, 23, 'REDUCED COSTS', 0, 3, 1),
(90, 23, 'ALL THE ABOVE', 1, 4, 1),
(91, 8, 'BRAINIAC', 1, 1, 1),
(92, 8, 'COLOSSUS', 0, 2, 1),
(93, 24, 'APPLE', 0, 1, 1),
(94, 24, 'WALMART', 0, 2, 1),
(95, 8, 'COMPUTO', 0, 3, 1),
(96, 8, 'MENTO', 0, 4, 1),
(97, 24, 'U.S. GOVERNMENT', 1, 3, 1),
(98, 9, 'STORAGE', 0, 1, 1),
(99, 9, 'COMPUTE', 0, 2, 1),
(100, 24, 'CHINESE GOVERNMENT', 0, 4, 1),
(101, 9, 'MEMORY AND I/O', 3, 0, 1),
(102, 9, 'ALL OF THE ABOVE', 1, 4, 1),
(103, 25, 'THE NEW YORK LIBRARY', 0, 1, 1),
(104, 25, 'THE SMITHSONIAN', 0, 2, 1),
(105, 25, 'THE BETTMANN ARCHIVE', 0, 3, 1),
(106, 25, 'U.S. LIBRARY OF CONGRESS', 1, 4, 1),
(107, 26, 'EMC', 1, 1, 1),
(108, 10, 'BETWEEN 1 TO 2 YEARS', 0, 1, 1),
(109, 10, 'BETWEEN 1 WEEK TO 2 YEARS', 0, 2, 1),
(110, 26, 'IBM', 0, 2, 1),
(111, 10, 'UNDER 1 WEEK', 1, 3, 1),
(112, 10, 'LESS THAN 1 DAY', 0, 4, 1),
(113, 26, 'MICROSOFT', 0, 3, 1),
(114, 26, 'CISCO', 0, 4, 1),
(115, 27, 'GOVERNMENT', 1, 1, 1),
(116, 11, '60%', 0, 1, 1),
(117, 11, '13%', 0, 2, 1),
(118, 27, 'THE MUSIC INDUSTRY', 0, 2, 1),
(119, 27, 'GLOBAL WARMING', 0, 3, 1),
(120, 11, '3%', 0, 3, 1),
(121, 11, 'LESS THAN 1%', 1, 4, 1),
(122, 27, 'ASTEROID COLLISIONS', 0, 4, 1),
(123, 28, '3 MILLION', 0, 1, 1),
(124, 28, '6 MILLION', 0, 2, 1),
(125, 28, '9 MILLION', 1, 3, 1),
(126, 28, '1 MILLION', 0, 4, 1),
(127, 13, 'MITT ROMNEY', 0, 1, 1),
(128, 13, 'BARACK OBAMA', 1, 2, 1),
(129, 13, 'JOHN MCCAIN', 0, 3, 1),
(130, 13, 'JOHN KERRY', 0, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `answers_info`
--

CREATE TABLE IF NOT EXISTS `answers_info` (
  `answers_info_id` int(12) NOT NULL,
  `answer_id` int(12) NOT NULL,
  `info_type` varchar(60) NOT NULL,
  `int_info` int(12) NOT NULL,
  `info` varchar(255) NOT NULL,
  `info_b` text NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers_info`
--

INSERT INTO `answers_info` (`answers_info_id`, `answer_id`, `info_type`, `int_info`, `info`, `info_b`, `time`) VALUES
(1, 1, 'validation', 0, 'min_length', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `badges`
--

CREATE TABLE IF NOT EXISTS `badges` (
  `badge_id` int(12) NOT NULL,
  `badge_name` varchar(30) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `hidden` tinyint(1) NOT NULL,
  `rank` int(3) NOT NULL DEFAULT '0',
  `ordered` int(11) NOT NULL,
  `int_info` bigint(20) NOT NULL,
  `info` varchar(80) NOT NULL,
  `info_b` varchar(255) NOT NULL,
  `trigger_action` int(12) NOT NULL DEFAULT '-1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `badges`
--

INSERT INTO `badges` (`badge_id`, `badge_name`, `active`, `hidden`, `rank`, `ordered`, `int_info`, `info`, `info_b`, `trigger_action`) VALUES
(5, 'Novice Level', 1, 0, 2, 2, 0, '', '', -1),
(6, 'Intermediate Level', 1, 0, 3, 3, 0, '', '', -1),
(7, 'Master Level', 1, 0, 4, 4, 0, '', '', -1),
(11, 'Beginner Level', 1, 0, 1, 0, 0, '', '', -1),
(25, 'Contact Champion', 1, 0, 0, 5, 0, '', '', -1),
(26, 'The Closer', 1, 0, 0, 6, 0, '', '', -1),
(28, 'Wheelin'' & Dealin''', 1, 0, 0, 8, 0, '', '', -1),
(29, 'Excellently Active', 1, 0, 0, 9, 0, '', '', -1),
(33, 'Content Wizard', 1, 0, 0, 11, 0, '', '', -1);

-- --------------------------------------------------------

--
-- Table structure for table `badges_info`
--

CREATE TABLE IF NOT EXISTS `badges_info` (
  `badges_info_id` int(12) NOT NULL,
  `badge_id` int(12) NOT NULL,
  `info_type` varchar(30) NOT NULL,
  `is_req` tinyint(1) NOT NULL,
  `action_types_id` int(12) NOT NULL,
  `points` int(12) NOT NULL,
  `int_info` int(12) NOT NULL,
  `info` varchar(255) NOT NULL,
  `info_b` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `badges_info`
--

INSERT INTO `badges_info` (`badges_info_id`, `badge_id`, `info_type`, `is_req`, `action_types_id`, `points`, `int_info`, `info`, `info_b`) VALUES
(51, 5, 'min_points', 1, -1, 1500, 0, '', ''),
(52, 6, 'min_points', 1, 0, 3000, 0, '', ''),
(53, 7, 'min_points', 1, -1, 4000, 0, '', ''),
(54, 11, 'min_points', 1, -1, 500, 0, '', ''),
(55, 27, 'min_action_qty_meeting_rep', 1, 35, 0, 1, '', ''),
(56, 28, 'min_action_qty', 1, 42, 0, 1, '', ''),
(58, 6, 'description', 0, 0, 0, 0, 'Earn 3000 points', ''),
(59, 6, 'prize', 0, 0, 0, 0, 'Win a $100 Amazon Gift Card', ''),
(60, 7, 'description', 0, 0, 0, 0, 'Earn 4000 points', ''),
(61, 7, 'prize', 0, 0, 0, 0, 'Win a $200 Visa Gift Card', ''),
(62, 26, 'description', 0, 0, 0, 0, 'Submit a closed deal', ''),
(63, 26, 'prize', 0, 0, 0, 0, '<div style="font-size:0.9em">For every closed deal you submit, if it''s value is $5,000-$9,999 get a $100 Amazon Gift Card, for deals $10,000-$25,000 get a $250 Amazon Gift Card, and for deals $25,000 and greater get a $500 Amazon Gift Card.</div>', ''),
(64, 11, 'description', 0, 0, 0, 0, 'Earn 500 points', ''),
(65, 11, 'prize', 0, 0, 0, 0, 'Win a $5 Amazon Gift Card', ''),
(66, 5, 'description', 0, 0, 0, 0, 'Earn 1500 points', ''),
(67, 5, 'prize', 0, 0, 0, 0, 'Win a $20 Amazon Gift Card', ''),
(68, 25, 'description', 0, 0, 0, 0, 'Send emails in the content module to at least 300 valid recipients', ''),
(69, 25, 'prize', 0, 0, 0, 0, 'Win a $50 Amazon Gift Card', ''),
(70, 29, 'description', 0, 0, 0, 0, 'Login at least 3 days a week for 4 weeks', ''),
(71, 29, 'prize', 0, 0, 0, 0, 'Win a $10 Amazon Gift Card', ''),
(72, 27, 'description', 0, 0, 0, 0, 'Transact a meeting with a C-level', ''),
(73, 27, 'prize', 0, 0, 0, 0, 'Win a $200 Visa Gift Card', ''),
(74, 28, 'description', 0, 0, 0, 0, 'Submit a registered deal', ''),
(75, 28, 'prize', 0, 0, 0, 0, 'Get $20 for every registered deal', ''),
(78, 34, 'description', 0, 0, 0, 0, 'Watch "Advanced Threat Protection Lifecycle Defense in 15 Minutes". Only first 100 users.', ''),
(79, 34, 'prize', 0, 0, 0, 0, 'Win $15 Visa Gift Card', ''),
(80, 33, 'description', 0, 0, 0, 0, 'Download at least 5 resources from the sales resources section', ''),
(81, 33, 'prize', 0, 0, 0, 0, 'Win a $30 Amazon Gift Card', ''),
(83, 34, 'min_action_qty', 1, 39, 0, 1, '', ''),
(84, 36, 'min_action_qty', 1, 41, 0, 1, '', ''),
(85, 37, 'close_deal_type', 1, 0, 0, 1, 'ssl', ''),
(86, 36, 'description', 0, 0, 0, 0, 'Have a customer case study made about SSL', ''),
(87, 36, 'prize', 0, 0, 0, 0, 'Win a $250 Visa Gift Card', ''),
(88, 37, 'description', 0, 0, 0, 0, 'Close a deal including SSL ', ''),
(89, 37, 'prize', 0, 0, 0, 0, 'Win a $400 Visa Gift Card', ''),
(90, 38, 'description', 0, 0, 0, 0, 'Transact a c-level meeting about SSL ', ''),
(91, 38, 'prize', 0, 0, 0, 0, 'Win a $200 Visa Gift Card', ''),
(92, 38, 'transact_meeting_type', 1, 0, 0, 1, 'ssl', 'Meeting C-Level'),
(94, 37, 'close_deal_type', 1, 0, 0, 0, 'ssl', ''),
(95, 36, 'user_region', 0, 0, 0, 0, 'apac', ''),
(96, 37, 'user_region', 0, 0, 0, 0, 'apac', ''),
(97, 38, 'user_region', 0, 0, 0, 0, 'apac', ''),
(98, 36, 'ssl_case_study', 1, 0, 0, 0, '', ''),
(99, 25, 'min_action_qty', 1, 45, 0, 300, '', ''),
(100, 26, 'min_action_qty', 1, 43, 0, 1, '', ''),
(101, 29, 'min_action_qty', 1, 46, 0, 1, '', ''),
(102, 33, 'min_action_qty', 1, 2, 0, 5, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(12) NOT NULL,
  `category_name` varchar(40) NOT NULL,
  `category_type` varchar(30) NOT NULL,
  `category_tag` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_type`, `category_tag`) VALUES
(14, 'Resources', 'action_type', ''),
(18, 'Schedule a Meeting', 'action_type', ''),
(74, 'Trivia', 'action_type', ''),
(82, 'Enterprise', 'mdf_bucket_type', ''),
(83, 'Client', 'mdf_bucket_type', ''),
(84, 'Software', 'mdf_bucket_type', ''),
(85, 'BANT Leads', 'mdf_package_type', ''),
(86, 'Content Creation', 'mdf_package_type', ''),
(87, 'Database & Analytics', 'mdf_package_type', ''),
(88, 'Event Recruitment', 'mdf_package_type', ''),
(89, 'Telemarketing', 'mdf_package_type', ''),
(90, 'Webinar', 'mdf_package_type', '');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `msg` varchar(500) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `reply_to` int(12) NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `user_id`, `msg`, `active`, `reply_to`, `approved`, `datetime`) VALUES
(1, 7, 'this is great - good work enter:marketing!\n', 1, -1, 1, '2013-07-24 20:22:00'),
(2, 15, 'Looking forward to learning more on Gamefication next week!', 1, -1, 1, '2013-07-24 20:43:27'),
(3, 16, 'Game On? Yes it is! Really looking forward to this event.', 1, -1, 1, '2013-07-24 20:50:27'),
(4, 17, 'Site is really cool, Enter Team!\n', 1, -1, 1, '2013-07-24 21:29:19'),
(5, 21, 'Gamefication is fun! :)', 1, -1, 1, '2013-07-24 22:10:23'),
(6, 21, 'Looking forward to learning more during the virtual event next week.  ', 1, -1, 1, '2013-07-24 22:11:14'),
(7, 38, 'Game on! ', 1, -1, 1, '2013-07-26 14:23:43'),
(8, 23, 'Gamification - Because you need it!', 1, -1, 1, '2013-07-29 18:54:50'),
(9, 28, 'Did your social media points show up?', 1, -1, 1, '2013-07-29 18:55:07'),
(10, 23, 'Yeah, what Kory said!', 1, 7, 1, '2013-07-29 18:55:30'),
(11, 5, 'Hi Andrea - it takes about 20 min.  the game "scrapes" social sites about once every 20 min\n', 1, 9, 1, '2013-07-29 19:38:30'),
(12, 28, 'They did.  Thanks!  I didn''t notice the message that it take time.  Oops!\n', 1, 9, 1, '2013-07-30 15:08:48'),
(13, 28, 'Getting excited to learn more on gamification!', 1, -1, 1, '2013-07-30 15:09:12'),
(14, 23, 'Andrea, nice job dominating the leaderboard!! ', 1, 13, 1, '2013-07-30 15:11:23'),
(15, 15, 'I''m back in the game!  Thanks Jeff Warnock for helping me get my password situated again!', 1, -1, 1, '2013-07-30 16:24:59'),
(16, 15, 'Michelle, its only 25 minutes away!', 1, 6, 1, '2013-07-30 16:36:23'),
(17, 15, 'True Story!', 1, 5, 1, '2013-07-30 16:36:47'),
(18, 15, 'I''m having trouble accessing the virtual event?  Anyone else having the same issue?', 1, -1, 1, '2013-07-30 17:09:46'),
(19, 21, 'Trying to login to the virtual event, but having issues? ;( Anyone else having trouble logging in?', 1, -1, 1, '2013-07-30 17:09:47'),
(20, 15, 'M-Hizzy - I''m having trouble too\n', 1, 19, 1, '2013-07-30 17:10:34'),
(21, 83, 'I am not sure what I am supposed to do after I log in. \nPlease assist', 1, -1, 1, '2013-07-30 17:13:13'),
(22, 28, 'I am also not seeing the viewer box.  I just sent an email\n', 1, 19, 1, '2013-07-30 17:13:28'),
(23, 21, 'Argh, this is frustrating! I was hoping to join the webinar...find out more ways to try to beat you in the game! Ha, the truth comes out. ;)', 1, 18, 1, '2013-07-30 17:13:34'),
(24, 15, 'I''ve sent 2 emails and am waiting to hear back', 1, 19, 1, '2013-07-30 17:14:57'),
(25, 78, 'Still trying to get in, but no luck yet.', 1, -1, 1, '2013-07-30 17:15:12'),
(26, 15, 'I think we''re supposed to go to ''Virtual Events'' to view the webinar, however that is not working for a few of us right now', 1, 21, 1, '2013-07-30 17:15:26'),
(27, 83, 'Thanks Anne', 1, 21, 1, '2013-07-30 17:16:25'),
(28, 92, 'McLuvin it!', 1, -1, 1, '2013-07-30 17:19:31'),
(29, 69, 'This is not working.. is there any other way to join webinar?', 1, -1, 1, '2013-07-30 17:20:28'),
(30, 28, 'I don''t think so.', 1, 29, 1, '2013-07-30 17:24:54'),
(31, 92, 'Chrome Plugin is having a fairy attack on on me.', 1, -1, 1, '2013-07-30 17:31:13'),
(32, 94, 'I hope I win the trip to NYC. I love NYC', 1, -1, 1, '2013-07-30 17:44:43'),
(33, 94, 'You really should win :)', 1, 32, 1, '2013-07-30 17:45:06'),
(34, 94, 'Why did you keep removing all my points? I''d really like to win this. ', 1, -1, 1, '2013-07-30 20:50:09'),
(35, 19, 'Well done, Professor Tim, on the Gamification webinar.', 1, -1, 1, '2013-07-31 17:23:23'),
(36, 15, 'the replay quality is MUCH better!  Thanks for providing the replay.  I didn''t wan to miss out!', 1, -1, 1, '2013-07-31 17:29:30'),
(37, 5, 'upload your photo!  ;o)', 1, 35, 1, '2013-07-31 17:29:33'),
(38, 19, 'Anonymous is here!', 1, 35, 1, '2013-07-31 17:50:27'),
(39, 21, 'Just watched the replay of the gamification virtual event..great job Tim! ', 1, -1, 1, '2013-08-01 03:10:46'),
(40, 21, 'There''s no "Like" button, but if there was, I would "Like" this comment. ;)', 1, 36, 1, '2013-08-01 03:12:17'),
(41, 21, 'Hey e:m Team - Hope you enjoy Super Glue Day on Friday! #jealous', 1, -1, 1, '2013-08-01 03:15:40'),
(42, 5, 'Thanks Michelle!', 1, 39, 1, '2013-08-01 14:37:22'),
(43, 15, 'Superglue day?  How do I get in on that action?', 1, 41, 1, '2013-08-01 18:56:08'),
(44, 15, '*like*', 1, 36, 1, '2013-08-01 18:56:25'),
(45, 28, 'The mysterious Carlos M!', 1, 35, 1, '2013-08-07 18:21:17'),
(46, 28, 'When is the next virtual event?  Is there a series we can expect?', 1, -1, 1, '2013-08-07 18:21:50'),
(47, 21, '@Anne C - way to beat me to it on the referral. This is war!', 1, -1, 1, '2013-08-08 16:12:27'),
(48, 15, 'mua ha ha ha ha ha (evil plans to rule the world)', 1, 47, 1, '2013-08-08 16:13:32'),
(49, 5, 'Posting a new one shortly!  stay tuned!', 1, 46, 1, '2013-08-08 18:12:51'),
(50, 28, 'Awesome!', 1, 46, 1, '2013-08-08 18:52:13'),
(51, 28, 'Excited at the top prizes you are offering.  How long is the game running though?', 1, -1, 1, '2013-08-08 18:53:16'),
(52, 21, 'According to the "Your game interface is live!" email we received when we signed up, the game runs until October 22nd." Game On!', 1, 51, 1, '2013-08-08 19:59:44'),
(53, 28, 'Thanks Michelle!', 1, 51, 1, '2013-08-09 15:49:02'),
(54, 15, 'I heard a rumor of a new challenge hitting this week.  Did I miss something?', 1, -1, 1, '2013-08-09 18:28:44'),
(55, 28, 'Interested to see the format for enter:Marketing''s survey.  I wonder if there is any formatting surprised for us.', 1, -1, 1, '2013-08-12 15:05:32');

-- --------------------------------------------------------

--
-- Table structure for table `demandgen_contacts`
--

CREATE TABLE IF NOT EXISTS `demandgen_contacts` (
  `demandgen_contact_id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `email_to` varchar(255) COLLATE utf8_bin NOT NULL,
  `email_template_id` int(12) NOT NULL,
  `opened` datetime NOT NULL,
  `clicked` datetime NOT NULL,
  `ip` varchar(255) COLLATE utf8_bin NOT NULL,
  `datetime` datetime NOT NULL,
  `test` tinyint(1) NOT NULL,
  `hash` varchar(20) COLLATE utf8_bin NOT NULL,
  `data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE IF NOT EXISTS `emails` (
  `email_id` int(12) NOT NULL,
  `email_to` varchar(256) NOT NULL,
  `name_to` varchar(60) NOT NULL,
  `name_from` varchar(60) NOT NULL,
  `email_from` varchar(256) NOT NULL,
  `reply_to` varchar(80) NOT NULL,
  `subject` varchar(78) NOT NULL,
  `message` text NOT NULL,
  `message_text` text NOT NULL,
  `time` datetime NOT NULL,
  `sent` tinyint(4) NOT NULL DEFAULT '0',
  `item_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE IF NOT EXISTS `email_templates` (
  `email_template_id` int(12) NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `html` longtext COLLATE utf8_bin NOT NULL,
  `plaintext` longtext COLLATE utf8_bin NOT NULL,
  `subject` varchar(255) COLLATE utf8_bin NOT NULL,
  `settings` longtext COLLATE utf8_bin NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`email_template_id`, `title`, `description`, `html`, `plaintext`, `subject`, `settings`, `active`) VALUES
(1, 'Threat Research', 'Strategizing for emerging threats can be like shooting in the dark. The report sheds light on upcoming attacks with the in-depth research and analysis from Dell’s Global Response Intelligence Defense (GRID) network and telemetry data from Dell SonicWALL network traffic.', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">\n<html>\n<head>\n    <title>Shed light on emerging security risks: Read the 2015 Dell Security Annual Threat Report.</title>\n    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" >\n</head>\n<body>\n<style>\n    table, td, p, ul, ol {\n        font-size: 12px;\n        line-height:130%;\n        color:#323232;\n        font-family: ''Trebuchet MS'', Arial, Helvetica, sans-serif;\n    }\n    a {\n        color:#3399CC;\n    }\n    table, td {\n        border-collapse:collapse;\n    }\n</style>\n<table cellspacing="0" cellpadding="0" width="620" style="border: 1px solid #C4C4C4;" align="center">\n    <tr>\n        <td style="line-height:100%;" width="620" bgcolor="#ffffff">\n            <table cellpadding="0" cellspacing="0" border="0">\n                <tr>\n                    <td>\n                        <img src="[logo]" style="margin:8px">\n                    </td>\n                </tr>\n            </table>\n        </td>\n    </tr>\n    <tr>\n        <td style="height:1px;background-color:#ccc"></td>\n    </tr>\n    <tr>\n        <td style="line-height:100%;"><a href="http://software.dell.com/ecard-42343-32750-h-0"><img src="http://[url]/img/hosted/dell-bi.png" alt="Gain practical advice to prep for and prevent attacks." style="border: 0;" /></a></td>\n    </tr>\n\n    <tr>\n        <td align="left" style="padding:16px 14px 15px 14px; font-size:12px; font-family:''Trebuchet MS'', Arial, Helvetica, sans-serif; line-height:130%;" bgcolor="#ffffff"><p>\nOrganizations are spending more than ever on IT security, both to comply with internal and regulatory\nrequirements and to protect their data from cyber threats. Yet each year, high-profile data breaches\ncontinue to fill the headlines, sabotaging the reputations, relationships, and revenue of the businesses\nthat are victimized.\n<br /><br />In the 2015 Dell Security Annual Threat Report, we’ll present the most common attacks that were\nobserved by the Dell SonicWALL Threat Research Team in 2014 and the ways we expect emergent\nthreats to affect businesses of all sizes throughout 2015. Our goal is not to frighten, but to inform and\nprovide organizations of all sizes with practical advice that will help them adjust their practices to more\neffectively prepare for and prevent attacks, even from threat sources that have yet to emerge.</p>\n\n            <table border="0" cellpadding="0" cellspacing="0">\n                <tbody>\n                <tr>\n                    <td>\n                        <img border="0" height="20" src="http://software.dell.com/ecard/images/buttons/blue-button-end-left.gif" style="display: block" width="9" /></td>\n                    <td align="left" bgcolor="#0085c3" style="line-height: 13px; padding-left: 5px; font-family: ''trebuchet ms'', arial, helvetica, sans-serif; white-space: nowrap; color: #ffffff; font-size: 13px; font-weight: bold; text-decoration: none" valign="middle">\n                        <a href="http://[url]/?a=download_asset&resource_id=77&hash=[hash]" style="color: #ffffff; text-decoration: none" target="_blank">Download Asset</a></td>\n                    <td>\n                        <img border="0" height="20" src="http://software.dell.com/ecard/images/buttons/blue-button-end-right-arrow.gif" style="display: block" width="23" /></td>\n                </tr>\n                </tbody>\n            </table>\n        </td>\n    </tr>\n</table>\n<center>\n<table cellspacing="0" cellpadding="0" width="620">\n    <tr>\n        <td style="line-height:100%;text-align:right" width="620" bgcolor="#ffffff">\n            <img src="http://delloverdrive.com/img/hosted/partner_direct.png">\n        </td>\n    </tr>\n</table>\n</center>\n</body>\n</html>', '', 'A resource has been shared with you', '{"partner_image":{"type":"image","name":"Partner Logo","required":1}}', 1),
(2, 'Types of Cyber Attacks and How To Prevent Them', 'This ebook details the strategies and tools that\ncybercriminals use to infiltrate your network and how you\ncan stop them.', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">\n<html>\n<head>\n    <title>Shed light on emerging security risks: Read the 2015 Dell Security Annual Threat Report.</title>\n    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" >\n</head>\n<body>\n<style>\n    table, td, p, ul, ol {\n        font-size: 12px;\n        line-height:130%;\n        color:#323232;\n        font-family: ''Trebuchet MS'', Arial, Helvetica, sans-serif;\n    }\n    a {\n        color:#3399CC;\n    }\n    table, td {\n        border-collapse:collapse;\n    }\n</style>\n<table cellspacing="0" cellpadding="0" width="620" style="border: 1px solid #C4C4C4;" align="center">\n    <tr>\n        <td style="line-height:100%;" width="620" bgcolor="#ffffff">\n            <table cellpadding="0" cellspacing="0" border="0">\n                <tr>\n                    <td>\n                        <img src="[logo]" style="margin:8px">\n                    </td>\n                </tr>\n            </table>\n        </td>\n    </tr>\n    <tr>\n        <td style="height:1px;background-color:#ccc"></td>\n    </tr>\n    <tr>\n        <td style="line-height:100%;"><a href="http://software.dell.com/ecard-42343-32750-h-0"><img src="http://[url]/img/hosted/dell-types.png" alt="Gain practical advice to prep for and prevent attacks." style="border: 0;" /></a></td>\n    </tr>\n\n    <tr>\n        <td align="left" style="padding:16px 14px 15px 14px; font-size:12px; font-family:''Trebuchet MS'', Arial, Helvetica, sans-serif; line-height:130%;" bgcolor="#ffffff"><p>\nToday’s cybercriminals employ several complex techniques to avoid detection as they sneak quietly into corporate networks to steal intellectual property. Their threats are often encoded using complicated algorithms to evade detection by intrusion prevention systems. Once they have exploited a target, attackers will attempt to download and install malware onto the compromised system. In many instances, the malware used is a newly evolved variant that traditional anti-virus solutions don’t yet know about.\n<br /><br />This ebook details the strategies and tools that cybercriminals use to infiltrate your network and how you can stop them.\n<br /><br />\n            <table border="0" cellpadding="0" cellspacing="0">\n                <tbody>\n                <tr>\n                    <td>\n                        <img border="0" height="20" src="http://software.dell.com/ecard/images/buttons/blue-button-end-left.gif" style="display: block" width="9" /></td>\n                    <td align="left" bgcolor="#0085c3" style="line-height: 13px; padding-left: 5px; font-family: ''trebuchet ms'', arial, helvetica, sans-serif; white-space: nowrap; color: #ffffff; font-size: 13px; font-weight: bold; text-decoration: none" valign="middle">\n                        <a href="http://[url]/?a=download_asset&resource_id=79&hash=[hash]" style="color: #ffffff; text-decoration: none" target="_blank">Download Asset</a></td>\n                    <td>\n                        <img border="0" height="20" src="http://software.dell.com/ecard/images/buttons/blue-button-end-right-arrow.gif" style="display: block" width="23" /></td>\n                </tr>\n                </tbody>\n            </table>\n        </td>\n    </tr>\n</table>\n<center>\n<table cellspacing="0" cellpadding="0" width="620">\n    <tr>\n        <td style="line-height:100%;text-align:right" width="620" bgcolor="#ffffff">\n            <img src="http://delloverdrive.com/img/hosted/partner_direct.png">\n        </td>\n    </tr>\n</table>\n</center>\n</body>\n</html>', '', 'A resource has been shared with you', '{"partner_image":{"type":"image","name":"Partner Logo","required":1}}', 1),
(3, 'Big Security For Your Small Business', 'Watch this Dell Software video to learn how Dell SonicWALL TZ firewalls deliver the same level of security, performance and manageability as firewalls used by banks, government agencies and large businesses – at an affordable price.', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">\n<html>\n<head>\n    <title>Shed light on emerging security risks: Read the 2015 Dell Security Annual Threat Report.</title>\n    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" >\n</head>\n<body>\n<style>\n    table, td, p, ul, ol {\n        font-size: 12px;\n        line-height:130%;\n        color:#323232;\n        font-family: ''Trebuchet MS'', Arial, Helvetica, sans-serif;\n    }\n    a {\n        color:#3399CC;\n    }\n    table, td {\n        border-collapse:collapse;\n    }\n</style>\n<table cellspacing="0" cellpadding="0" width="620" style="border: 1px solid #C4C4C4;" align="center">\n    <tr>\n        <td style="line-height:100%;" width="620" bgcolor="#ffffff">\n            <table cellpadding="0" cellspacing="0" border="0">\n                <tr>\n                    <td>\n                        <img src="[logo]" style="margin:8px">\n                    </td>\n                </tr>\n            </table>\n        </td>\n    </tr>\n    <tr>\n        <td style="height:1px;background-color:#ccc"></td>\n    </tr>\n    <tr>\n        <td style="line-height:100%;"><a href="http://software.dell.com/ecard-42343-32750-h-0"><img src="http://[url]/img/hosted/dell-bigsecurity.png" alt="Gain practical advice to prep for and prevent attacks." style="border: 0;" /></a></td>\n    </tr>\n\n    <tr>\n        <td align="left" style="padding:16px 14px 15px 14px; font-size:12px; font-family:''Trebuchet MS'', Arial, Helvetica, sans-serif; line-height:130%;" bgcolor="#ffffff"><p>\nTo counter emerging threats, your small business needs big security. Watch this Dell Software video to learn how Dell SonicWALL TZ firewalls deliver the same level of security, performance and manageability as firewalls used by banks, government agencies and large businesses – at an affordable price.\n<br /><br />\n            <table border="0" cellpadding="0" cellspacing="0">\n                <tbody>\n                <tr>\n                    <td>\n                        <img border="0" height="20" src="http://software.dell.com/ecard/images/buttons/blue-button-end-left.gif" style="display: block" width="9" /></td>\n                    <td align="left" bgcolor="#0085c3" style="line-height: 13px; padding-left: 5px; font-family: ''trebuchet ms'', arial, helvetica, sans-serif; white-space: nowrap; color: #ffffff; font-size: 13px; font-weight: bold; text-decoration: none" valign="middle">\n                        <a href="http://[url]/?a=download_asset&resource_id=78&hash=[hash]" style="color: #ffffff; text-decoration: none" target="_blank">View Video</a></td>\n                    <td>\n                        <img border="0" height="20" src="http://software.dell.com/ecard/images/buttons/blue-button-end-right-arrow.gif" style="display: block" width="23" /></td>\n                </tr>\n                </tbody>\n            </table>\n        </td>\n    </tr>\n</table>\n<center>\n<table cellspacing="0" cellpadding="0" width="620">\n    <tr>\n        <td style="line-height:100%;text-align:right" width="620" bgcolor="#ffffff">\n            <img src="http://delloverdrive.com/img/hosted/partner_direct.png">\n        </td>\n    </tr>\n</table>\n</center>\n</body>\n</html>', '', 'A resource has been shared with you', '{"partner_image":{"type":"image","name":"Partner Logo","required":1}}', 1),
(4, 'Mobile Security Webcast', 'Invite contacts to this webcase where they''ll hear from product expert Jane Wasson on how it’s possible to enable mobile worker productivity — without compromising security. You’ll also gain a better understanding of the mobile threats you need to protect your business from.', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">\n<html>\n<head>\n    <title>See how to stay ahead of mobile security threats &#8212; join this webcast.</title>\n    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">\n</head>\n<body>\n    <style>\n        table, td, p, ul, ol { font-size: 12px;line-height: 130%;color: #323232;font-family: ''Trebuchet MS'', Arial, Helvetica, sans-serif; }\n        a { color: #3399CC; }\n        table, td {border-collapse: collapse; }\n    </style>\n    <table cellspacing="0" cellpadding="0" width="620" style="border: 1px solid #C4C4C4;" align="center">\n      <tr>\n            <td style="line-height:100%;" width="620" bgcolor="#ffffff"></td>\n        </tr>\n        <tr>\n            <td style="line-height:100%;" width="620" bgcolor="#ffffff">\n                <table cellpadding="0" cellspacing="0" border="0">\n                    <tr>\n                        <td>\n                            <img src="[logo]" style="margin:8px">\n                        </td>\n                    </tr>\n                </table>\n            </td>\n        </tr>\n        <tr>\n            <td style="height:1px;background-color:#ccc"></td>\n        </tr>\n        <tr>\n            <td style="line-height:100%;"><a><img src="http://software.dell.com/ecard/43521/35417/header.png" alt="Modernize your mobile security technology." style="border: 0;" /></a></td>\n        </tr>\n        \n        <tr>\n            <td align="left" style="padding:16px 14px 15px 14px; font-size:12px; font-family:''Trebuchet MS'', Arial, Helvetica, sans-serif; line-height:130%;" bgcolor="#ffffff"><p><strong>Webcast:</strong> Mobile security checklist: Get ahead of the next wave of mobile access and security challenges<br /><strong>When:</strong> Wednesday, November 11, 2015<br /><strong>Time:</strong> 10 a.m. PT / 1 p.m. ET<br /><strong>Presenter:</strong> Jane Wasson, Senior Product Marketing Manager, Dell Security</p><p></p><p>Join this webcast to see how you can ensure your business stays one step ahead of emerging mobile access and security challenges.</p><p>You&rsquo;ll hear from product expert Jane Wasson on how it&rsquo;s possible to enable mobile worker productivity &mdash; without compromising security. You&rsquo;ll also gain a better understanding of the mobile threats you need to protect your business from.</p><p>During the webcast, you&rsquo;ll learn how Dell Security can help you:</p><ul><li>Modernize access infrastructure to support explosive mobile growth</li><li>Enable access for more devices, to more resources, more securely</li><li>Ensure end-to-end comprehensive data protection and security for your mobile deployment</li></ul>\n\n            <table border="0" cellpadding="0" cellspacing="0">\n            <tbody>\n            <tr>\n                <td>\n                    <img border="0" height="20" src="http://software.dell.com/ecard/images/buttons/blue-button-end-left.gif" style="display: block" width="9" /></td>\n                <td align="left" bgcolor="#0085c3" style="line-height: 13px; padding-left: 5px; font-family: ''trebuchet ms'', arial, helvetica, sans-serif; white-space: nowrap; color: #ffffff; font-size: 13px; font-weight: bold; text-decoration: none" valign="middle">\n                    <a href="http://[url]/?a=download_asset&redirect_url=[redirect_url]&hash=[hash]" style="color: #ffffff; text-decoration: none" target="_blank">Register Today</a></td>\n                <td>\n                    <img border="0" height="20" src="http://software.dell.com/ecard/images/buttons/blue-button-end-right-arrow.gif" style="display: block" width="23" /></td>\n            </tr>\n            </tbody>\n            </table>\n\n\n            </td>\n        </tr>\n        <tr>\n          <td align="left" style="padding:16px 14px 15px 14px; font-size:12px; font-family:''Trebuchet MS'', Arial, Helvetica, sans-serif; line-height:130%;" bgcolor="#ffffff"></td>\n        </tr>\n    </table>\n    <center>\n<table cellspacing="0" cellpadding="0" width="620">\n    <tr>\n        <td style="line-height:100%;text-align:right" width="620" bgcolor="#ffffff">\n            <img src="http://delloverdrive.com/img/hosted/partner_direct.png">\n        </td>\n    </tr>\n</table>\n</center>\n</body>\n</html>', '', 'You have been invited to the Mobile Security webcast', '{"partner_image":{"type":"image","name":"Partner Logo","required":1},"redirect_url":{"type":"text","name":"Registration URL","required":1,"hint":"Contact your channel manager to get your registration URL"}}', 0);
INSERT INTO `email_templates` (`email_template_id`, `title`, `description`, `html`, `plaintext`, `subject`, `settings`, `active`) VALUES
(5, 'Network Security Challenges During The Holidays', 'Learn the top 10 network security challenges that will be faced during the holidays and 10 easy ways to overcome them.', '\r\n<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head>\r\n    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">\r\n    <meta name="viewport" content="width=device-width">\r\n    <style type="text/css">\r\n        @media only screen and (max-width: 600px) {\r\n            table[class="body"] img {\r\n                width: auto !important;\r\n                height: auto !important;\r\n            }\r\n\r\n            table[class="body"] center {\r\n                min-width: 0 !important;\r\n            }\r\n\r\n            table[class="body"] .container {\r\n                width: 95% !important;\r\n            }\r\n\r\n            table[class="body"] .row {\r\n                width: 100% !important;\r\n                display: block !important;\r\n            }\r\n\r\n            table[class="body"] .wrapper {\r\n                display: block !important;\r\n                padding-right: 0 !important;\r\n            }\r\n\r\n            table[class="body"] .columns, table[class="body"] .column {\r\n                table-layout: fixed !important;\r\n                float: none !important;\r\n                width: 100% !important;\r\n                padding-right: 0px !important;\r\n                padding-left: 0px !important;\r\n                display: block !important;\r\n            }\r\n\r\n            table[class="body"] table.columns td, table[class="body"] table.column td {\r\n                width: 100% !important;\r\n            }\r\n\r\n            table[class="body"] .columns td.one, table[class="body"] .column td.one {\r\n                width: 8.333333% !important;\r\n            }\r\n\r\n            table[class="body"] .columns td.two, table[class="body"] .column td.two {\r\n                width: 16.666666% !important;\r\n            }\r\n\r\n            table[class="body"] .columns td.three, table[class="body"] .column td.three {\r\n                width: 25% !important;\r\n            }\r\n\r\n            table[class="body"] .columns td.four, table[class="body"] .column td.four {\r\n                width: 33.333333% !important;\r\n            }\r\n\r\n            table[class="body"] .columns td.five, table[class="body"] .column td.five {\r\n                width: 41.666666% !important;\r\n            }\r\n\r\n            table[class="body"] .columns td.six, table[class="body"] .column td.six {\r\n                width: 50% !important;\r\n            }\r\n\r\n            table[class="body"] .columns td.seven, table[class="body"] .column td.seven {\r\n                width: 58.333333% !important;\r\n            }\r\n\r\n            table[class="body"] .columns td.eight, table[class="body"] .column td.eight {\r\n                width: 66.666666% !important;\r\n            }\r\n\r\n            table[class="body"] .columns td.nine, table[class="body"] .column td.nine {\r\n                width: 75% !important;\r\n            }\r\n\r\n            table[class="body"] .columns td.ten, table[class="body"] .column td.ten {\r\n                width: 83.333333% !important;\r\n            }\r\n\r\n            table[class="body"] .columns td.eleven, table[class="body"] .column td.eleven {\r\n                width: 91.666666% !important;\r\n            }\r\n\r\n            table[class="body"] .columns td.twelve, table[class="body"] .column td.twelve {\r\n                width: 100% !important;\r\n            }\r\n\r\n            table[class="body"] td.offset-by-one, table[class="body"] td.offset-by-two, table[class="body"] td.offset-by-three, table[class="body"] td.offset-by-four, table[class="body"] td.offset-by-five, table[class="body"] td.offset-by-six, table[class="body"] td.offset-by-seven, table[class="body"] td.offset-by-eight, table[class="body"] td.offset-by-nine, table[class="body"] td.offset-by-ten, table[class="body"] td.offset-by-eleven {\r\n                padding-left: 0 !important;\r\n            }\r\n\r\n            table[class="body"] table.columns td.expander {\r\n                width: 1px !important;\r\n            }\r\n\r\n            table[class="body"] .text-pad-right {\r\n                padding-left: 10px !important;\r\n            }\r\n\r\n            table[class="body"] .text-pad-left {\r\n                padding-right: 10px !important;\r\n            }\r\n\r\n            table[class="body"] .hide-for-small {\r\n                display: none !important;\r\n                height: 0;\r\n                width: 0;\r\n                visibility: hidden;\r\n            }\r\n\r\n            table[class="body"] .show-for-small {\r\n                display: inherit !important;\r\n                max-height: unset !important;\r\n                overflow: inherit !important;\r\n            }\r\n\r\n            .text-size-17 {\r\n                font-size: 19px;\r\n            }\r\n\r\n                .text-size-17 td {\r\n                    font-size: 19px;\r\n                }\r\n\r\n                .text-size-17 p {\r\n                    font-size: 19px;\r\n                }\r\n\r\n                .text-size-17 span {\r\n                    font-size: 19px;\r\n                }\r\n\r\n            .text-size-16 {\r\n                font-size: 18px;\r\n            }\r\n\r\n                .text-size-16 td {\r\n                    font-size: 18px;\r\n                }\r\n\r\n                .text-size-16 p {\r\n                    font-size: 18px;\r\n                }\r\n\r\n                .text-size-16 span {\r\n                    font-size: 18px;\r\n                }\r\n\r\n            .text-size-15 {\r\n                font-size: 17px;\r\n            }\r\n\r\n                .text-size-15 td {\r\n                    font-size: 17px;\r\n                }\r\n\r\n                .text-size-15 p {\r\n                    font-size: 17px;\r\n                }\r\n\r\n                .text-size-15 span {\r\n                    font-size: 17px;\r\n                }\r\n\r\n            .text-size-14 {\r\n                font-size: 16px;\r\n            }\r\n\r\n                .text-size-14 td {\r\n                    font-size: 16px;\r\n                }\r\n\r\n                .text-size-14 p {\r\n                    font-size: 16px;\r\n                }\r\n\r\n                .text-size-14 span {\r\n                    font-size: 16px;\r\n                }\r\n\r\n            .text-size-13 {\r\n                font-size: 15px;\r\n            }\r\n\r\n                .text-size-13 td {\r\n                    font-size: 15px;\r\n                }\r\n\r\n                .text-size-13 p {\r\n                    font-size: 15px;\r\n                }\r\n\r\n                .text-size-13 span {\r\n                    font-size: 15px;\r\n                }\r\n\r\n            .text-size-12 {\r\n                font-size: 14px;\r\n            }\r\n\r\n                .text-size-12 td {\r\n                    font-size: 14px;\r\n                }\r\n\r\n                .text-size-12 p {\r\n                    font-size: 14px;\r\n                }\r\n\r\n                .text-size-12 span {\r\n                    font-size: 14px;\r\n                }\r\n\r\n            h1 {\r\n                font-size: 29px;\r\n            }\r\n\r\n            h5 {\r\n                font-size: 17px;\r\n            }\r\n\r\n            table.button.button-width-auto {\r\n                width: 100% !important;\r\n                display: table !important;\r\n            }\r\n\r\n            table.button td a, table.button td a:visited {\r\n                white-space: normal !important;\r\n            }\r\n\r\n			.pb-0-sm {\r\n                padding-bottom: 0 !important;\r\n\r\n            }\r\n\r\n            .pt-0-sm {\r\n                padding-top: 0 !important;\r\n\r\n            }\r\n\r\n        }\r\n\r\n        @media only screen and (min-width: 601px) {\r\n            .p-0-md {\r\n                padding: 0 !important;\r\n            }\r\n\r\n            .p-15-md {\r\n                padding: 15px !important;\r\n            }\r\n\r\n            .p-25-md {\r\n                padding: 25px !important;\r\n            }\r\n\r\n            .pt-0-md {\r\n                padding-top: 0 !important;\r\n            }\r\n\r\n            .pt-10-md {\r\n                padding-top: 10px !important;\r\n            }\r\n\r\n            .pt-20-md {\r\n                padding-top: 20px !important;\r\n            }\r\n\r\n            .pt-30-md {\r\n                padding-top: 30px !important;\r\n            }\r\n\r\n            .pb-0-md {\r\n                padding-bottom: 0 !important;\r\n            }\r\n\r\n            .pb-10-md {\r\n                padding-bottom: 10px !important;\r\n            }\r\n\r\n            .pb-20-md {\r\n                padding-bottom: 20px !important;\r\n            }\r\n\r\n            .pb-30-md {\r\n                padding-bottom: 30px !important;\r\n            }\r\n\r\n            .pl-0-md {\r\n                padding-left: 0 !important;\r\n            }\r\n\r\n            .pl-10-md {\r\n                padding-left: 10px !important;\r\n            }\r\n\r\n            .pl-25-md {\r\n                padding-left: 25px !important;\r\n            }\r\n\r\n            .pl-28-md {\r\n                padding-left: 28px !important;\r\n            }\r\n\r\n            .pr-0-md {\r\n                padding-right: 0 !important;\r\n            }\r\n\r\n            .m-0-md {\r\n                margin: 0 !important;\r\n            }\r\n\r\n            .mt-0-md {\r\n                margin-top: 0 !important;\r\n            }\r\n\r\n            .mt-10-md {\r\n                margin-top: 10px !important;\r\n            }\r\n\r\n            .mt-20-md {\r\n                margin-top: 20px !important;\r\n            }\r\n\r\n            .mb-0-md {\r\n                margin-bottom: 0 !important;\r\n            }\r\n\r\n            .mb-10-md {\r\n                margin-bottom: 10px !important;\r\n            }\r\n\r\n            .mb-15-md {\r\n                margin-bottom: 15px !important;\r\n            }\r\n\r\n            .mb-20-md {\r\n                margin-bottom: 20px !important;\r\n            }\r\n\r\n            .mb-30-md {\r\n                margin-bottom: 30px !important;\r\n            }\r\n\r\n            .mb-40-md {\r\n                margin-bottom: 40px !important;\r\n            }\r\n\r\n            .mb-50-md {\r\n                margin-bottom: 50px !important;\r\n            }\r\n\r\n            .mr-0-md {\r\n                margin-right: 0 !important;\r\n            }\r\n\r\n            .mr-10-md {\r\n                margin-right: 10px !important;\r\n            }\r\n\r\n            .mr-20-md {\r\n                margin-right: 20px !important;\r\n            }\r\n\r\n            .ml-10-md {\r\n                margin-left: 10px !important;\r\n            }\r\n\r\n            .ml-20-md {\r\n                margin-left: 20px !important;\r\n            }\r\n        }\r\n    </style>\r\n\r\n    \r\n\r\n    \r\n</head>\r\n<body style=''width: 100% !important;min-width: 100%;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;margin: 0;padding: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;text-align: left;line-height: 19px;font-size: 14px''>\r\n\r\n        <table cellspacing="0" cellpadding="0" width="600" align="center">\r\n        <tr>\r\n            <td style="line-height:100%;" width="600" bgcolor="#ffffff">\r\n                <table cellpadding="0" cellspacing="0" border="0">\r\n                    <tr>\r\n                        <td>\r\n                            <img src="[logo]" style="margin:8px">\r\n                        </td>\r\n                    </tr>\r\n                </table>\r\n            </td>\r\n        </tr>\r\n        </table>\r\n\r\n        <table class="body" style=''border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;height: 100%;width: 100%;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px''>\r\n            <tbody><tr style="padding: 0;vertical-align: top;text-align: left">\r\n                <td class="center" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0;vertical-align: top;text-align: center;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px'' align="center" valign="top">\r\n                    <center style="width: 100%;min-width: 580px">\r\n                    </center>\r\n                </td>\r\n            </tr>\r\n        </tbody></table>\r\n\r\n        <table class="body" style=''border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;height: 100%;width: 100%;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px''>\r\n            <tbody><tr style="padding: 0;vertical-align: top;text-align: left">\r\n                <td class="center" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0;vertical-align: top;text-align: center;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px'' align="center" valign="top">\r\n                    <center style="width: 100%;min-width: 580px">\r\n\r\n                        <table class="container" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: inherit;width: 580px;margin: 0 auto">\r\n                            <tbody><tr style="padding: 0;vertical-align: top;text-align: left">\r\n                                <td style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px''>\r\n\r\n                                    <table class="row" style="border-spacing: 0;border-collapse: collapse;padding: 0px;vertical-align: top;text-align: left;width: 100%;position: relative;display: block">\r\n                                        <tbody><tr style="padding: 0;vertical-align: top;text-align: left">\r\n                                            <td class="wrapper last p-0" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0 !important;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;position: relative;padding-right: 0px''>\r\n                                                <table class="twelve columns" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;margin: 0 auto;width: 580px">\r\n                                                    <tbody><tr style="padding: 0;vertical-align: top;text-align: left">\r\n                                                        <td class="pt-0 pb-0" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0px 0px 10px;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;padding-bottom: 0 !important;padding-top: 0 !important''>\r\n                                                            <a style="color: #2ba6cb;text-decoration: none">\r\n                                                                <img style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;max-width: 100%;float: left;clear: both;display: block;border: none" src="http://software.dell.com/ecard/45573/38777/header/2-173-Dell-Security.jpg">\r\n                                                            </a>\r\n                                                        </td>\r\n                                                        <td class="expander" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0 !important;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;visibility: hidden;width: 0px''></td>\r\n                                                    </tr>\r\n                                                </tbody></table>\r\n                                            </td>\r\n                                        </tr>\r\n                                    </tbody></table>\r\n\r\n                                </td>\r\n                            </tr>\r\n                        </tbody></table>\r\n\r\n                    </center>\r\n                </td>\r\n            </tr>\r\n        </tbody></table>\r\n\r\n    <!-- START: Header Area -->\r\n<table class="body" style=''border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;height: 100%;width: 100%;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px''>\r\n	<tbody><tr style="padding: 0;vertical-align: top;text-align: left">\r\n		<td class="center" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0;vertical-align: top;text-align: center;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px'' align="center" valign="top">\r\n			<center style="width: 100%;min-width: 580px">\r\n\r\n\r\n				<table class="container" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: inherit;width: 580px;margin: 0 auto">\r\n					<tbody><tr style="padding: 0;vertical-align: top;text-align: left">\r\n						<td style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px''>\r\n\r\n							<table class="row" style="border-spacing: 0;border-collapse: collapse;padding: 0px;vertical-align: top;text-align: left;width: 100%;position: relative;display: block">\r\n								<tbody><tr style="padding: 0;vertical-align: top;text-align: left">\r\n									<td class="wrapper last" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 10px 20px 0px 0px;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;position: relative;padding-right: 0px''>\r\n										<table class="twelve columns m-0" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;margin: 0 !important;width: 580px">\r\n											<tbody><tr style="padding: 0;vertical-align: top;text-align: left">\r\n												<td class="text-pad-left text-pad-right" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0px 0px 10px;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;padding-left: 10px;padding-right: 10px''>\r\n													<h1 style=''color: #6EA204;font-family: "museo-sans-for-dell-300","Trebuchet MS","Roboto","Segoe UI","Helvetica Neue","Meiryo UI Reg","メイリオ Reg","MS UI Gothic Reg","Hiragino Kaku Gothic Reg","ヒラギノ角ゴ Pro W3 Reg","Microsoft YaHei","微软雅黑","Hiragino Sans GB","Microsoft JhengHei","微軟正黑體","Malgun Gothic",Gulim,Tahoma,"Arial Unicode",sans-serif;font-weight: 500;padding: 0;margin: 0;text-align: left;line-height: 1.16667;word-break: normal;font-size: 27px''>Learn the top 10 network security challenges you&#8217;ll face these holidays.</h1>\r\n\r\n													<h5 class="mt-10" style=''color: #444444;font-family: "Trebuchet MS","Roboto","Segoe UI","Helvetica Neue","Meiryo UI Reg","メイリオ Reg","MS UI Gothic Reg","Hiragino Kaku Gothic Reg","ヒラギノ角ゴ Pro W3 Reg","Microsoft YaHei","微软雅黑","Hiragino Sans GB","Microsoft JhengHei","微軟正黑體","Malgun Gothic",Gulim,Tahoma,"Arial Unicode",sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 1.3;word-break: normal;font-size: 15px;margin-top: 10px !important''>Then get 10 easy ways to overcome them.</h5>\r\n												</td>\r\n												<td class="expander" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0 !important;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;visibility: hidden;width: 0px''></td>\r\n											</tr>\r\n										</tbody></table>\r\n									</td>\r\n								</tr>\r\n							</tbody></table>\r\n\r\n							<table class="button button-green m-0" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;margin: 0 !important;width: 100%;overflow: hidden">\r\n								<tbody><tr style="padding: 0;vertical-align: top;text-align: left">\r\n									<td style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 3px 15px !important;vertical-align: top;text-align: center;color: #ffffff;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;display: block;width: auto !important;background: #005a85;border: 1px solid #6EA204;background-color: #6EA204''>\r\n										<a href="http://[url]/?a=download_asset&resource_id=83&hash=[hash]" target="_blank" class="text-underline" style=''color: #ffffff;text-decoration: none;font-family: "Trebuchet MS", Helvetica, Arial, sans-serif;font-size: 19px;white-space: nowrap;display: block;line-height: 1.3em''>Read the E-book</a>\r\n									</td>\r\n								</tr>\r\n							</tbody></table>\r\n\r\n						</td>\r\n					</tr>\r\n				</tbody></table>\r\n\r\n			</center>\r\n		</td>\r\n	</tr>\r\n</tbody></table>    <!-- END: Header Area -->\r\n    <!-- START: Body Area -->\r\n<table class="body" style=''border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;height: 100%;width: 100%;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px''>\r\n    <tbody><tr style="padding: 0;vertical-align: top;text-align: left">\r\n        <td class="center" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0;vertical-align: top;text-align: center;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px'' align="center" valign="top">\r\n            <center style="width: 100%;min-width: 580px">\r\n\r\n                <table class="container" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: inherit;width: 580px;margin: 0 auto">\r\n                    <tbody><tr style="padding: 0;vertical-align: top;text-align: left">\r\n                        <td style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px''>\r\n\r\n                            <table class="row hide-for-small" style="border-spacing: 0;border-collapse: collapse;padding: 0px;vertical-align: top;text-align: left;width: 100%;position: relative;display: block">\r\n                                <tbody><tr style="padding: 0;vertical-align: top;text-align: left">\r\n                                    <td class="wrapper bg-light-gray" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 10px 20px 0px 0px;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;position: relative;background: #eeeeee''>\r\n                                        <table class="five columns" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;margin: 0 auto;width: 230px">\r\n                                            <tbody><tr style="padding: 0;vertical-align: top;text-align: left">\r\n                                                <td class="text-pad" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0px 0px 10px;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;padding-left: 10px;padding-right: 10px''>\r\n                                                    <p class="text-size-14" style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''>In this e-book, discover how to:</p><ul>    <li>Bolster your defense against new threats at every layer</li>    <li>Block threats before they enter your network</li>    <li>Cut out the cost and complexity</li>    <li>And much more</li></ul>\r\n                                                </td>\r\n                                                <td class="expander" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0 !important;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;visibility: hidden;width: 0px''></td>\r\n                                            </tr>\r\n                                        </tbody></table>\r\n                                    </td>\r\n                                    <td class="wrapper last" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 10px 20px 0px 0px;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;position: relative;padding-right: 0px''>\r\n                                        <table class="seven columns" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;margin: 0 auto;width: 330px">\r\n                                            <tbody><tr style="padding: 0;vertical-align: top;text-align: left">\r\n                                                <td style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0px 0px 10px;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px''><img style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;max-width: 100%;float: left;clear: both;display: block" src="http://software.dell.com/images/email/blank.gif" width="20"></td>\r\n                                                <td class="text-pad" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0px 0px 10px;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;padding-left: 10px;padding-right: 10px''>\r\n                                                    <p style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''>Small retail business networks face the same security challenges as large enterprises &#8212; particularly during the holiday shopping season. This e-book examines these challenges and how modern network security technology can resolve them.</p>\r\n\r\n                                                    <table class="medium button button-blue button-width-auto mb-5 mt-10" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;margin-bottom: 5px !important;margin-top: 10px !important;width: auto;overflow: hidden;margin: 20px 0;display: inline-block">\r\n                                                        <tbody><tr style="padding: 0;vertical-align: top;text-align: left">\r\n                                                            <td style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 3px 15px !important;vertical-align: top;text-align: center;color: #ffffff;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;display: block;width: auto !important;background: #005a85;border: 1px solid #007db8;background-color: #007db8''>\r\n                                                        \r\n                                                                <!--[if !mso]><!-->\r\n                                                                    <a href="http://[url]/?a=download_asset&resource_id=83&hash=[hash]" target="_blank" style=''color: #ffffff;text-decoration: none;font-family: "Trebuchet MS", Helvetica, Arial, sans-serif;font-size: 19px;white-space: nowrap;display: block;line-height: 1.3em''>\r\n                                                                      <span style="color: #ffffff">\r\n                                                                        Read the E-book\r\n                                                                     </span>\r\n                                                                    </a>\r\n                                                                 <!--<![endif]-->\r\n                                    <!--[if gte mso 9]>\r\n                                       <a style=''color: #ffffff;text-decoration: none;font-family: "Trebuchet MS", Helvetica, Arial, sans-serif;font-size: 19px;white-space: nowrap;display: block;line-height: 1.3em'' href="http://software.dell.com/ecard-45573-38777-1">\r\n                                        <span style="color: #ffffff">\r\n                                          \r\n                                            &nbsp;&nbsp; Read the E-book &nbsp;&nbsp;\r\n                                        \r\n                                        </span>\r\n                                      </a>\r\n                                    <![endif]-->\r\n                                    \r\n																                    \r\n                                                            </td>\r\n                                                        </tr>\r\n                                                    </tbody></table>\r\n\r\n                                                </td>\r\n                                                <td class="expander" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0 !important;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;visibility: hidden;width: 0px''></td>\r\n                                            </tr>\r\n                                        </tbody></table>\r\n                                    </td>\r\n                                </tr>\r\n                            </tbody></table>\r\n\r\n                            <!--[if !mso]><!-->\r\n                            <div class="show-for-small" style="display: none;max-height: 0;overflow: hidden">\r\n                                <table class="row" style="border-spacing: 0;border-collapse: collapse;padding: 0px;vertical-align: top;text-align: left;width: 100%;position: relative;display: block">\r\n                                    <tbody><tr style="padding: 0;vertical-align: top;text-align: left">\r\n                                        <td class="wrapper last bg-light-gray" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 10px 20px 0px 0px;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;position: relative;background: #eeeeee;padding-right: 0px''>\r\n                                            <table class="twelve columns" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;margin: 0 auto;width: 580px">\r\n                                                <tbody><tr style="padding: 0;vertical-align: top;text-align: left">\r\n                                                    <td class="text-pad-left" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0px 0px 10px;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;padding-left: 10px''>\r\n                                                        <p class="text-size-14" style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''>In this e-book, discover how to:</p><ul>    <li>Bolster your defense against new threats at every layer</li>    <li>Block threats before they enter your network</li>    <li>Cut out the cost and complexity</li>    <li>And much more</li></ul>\r\n                                                    </td>\r\n                                                    <td class="expander" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0 !important;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;visibility: hidden;width: 0px''></td>\r\n                                                </tr>\r\n                                            </tbody></table>\r\n                                        </td>\r\n                                    </tr>\r\n                                </tbody></table>\r\n                                <table class="row" style="border-spacing: 0;border-collapse: collapse;padding: 0px;vertical-align: top;text-align: left;width: 100%;position: relative;display: block">\r\n                                        <tbody><tr style="padding: 0;vertical-align: top;text-align: left"><td class="wrapper last" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 10px 20px 0px 0px;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;position: relative;padding-right: 0px''>\r\n                                            <table class="twelve columns" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;margin: 0 auto;width: 580px">\r\n                                                <tbody><tr style="padding: 0;vertical-align: top;text-align: left">\r\n                                                    <td class="text-pad" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0px 0px 10px;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;padding-left: 10px;padding-right: 10px''>\r\n                                                        <p style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''>Small retail business networks face the same security challenges as large enterprises &#8212; particularly during the holiday shopping season. This e-book examines these challenges and how modern network security technology can resolve them.</p>\r\n\r\n                                                        <table class="medium button button-blue button-width-auto mb-5" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;margin-bottom: 5px !important;width: auto;overflow: hidden;margin: 20px 0;display: inline-block">\r\n                                                            <tbody><tr style="padding: 0;vertical-align: top;text-align: left">\r\n                                                                <td style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 3px 15px !important;vertical-align: top;text-align: center;color: #ffffff;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;display: block;width: auto !important;background: #005a85;border: 1px solid #007db8;background-color: #007db8''>\r\n                                                                    <a style=''color: #ffffff;text-decoration: none;font-family: "Trebuchet MS", Helvetica, Arial, sans-serif;font-size: 19px;white-space: nowrap;display: block;line-height: 1.3em'' href="http://software.dell.com/ecard-45573-38777-1">\r\n																	<span style="color: #ffffff">\r\n																		Read the E-book\r\n																	</span>\r\n                                                                    </a>\r\n                                                                </td>\r\n                                                            </tr>\r\n                                                        </tbody></table>\r\n\r\n                                                    </td>\r\n                                                    <td class="expander" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0 !important;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;visibility: hidden;width: 0px''></td>\r\n                                                </tr>\r\n                                            </tbody></table>\r\n                                        </td>\r\n                                    </tr></tbody></table></div></td></tr>\r\n                                \r\n                            \r\n                            <!--<![endif]-->\r\n\r\n                        \r\n                    </tbody></table></center></td></tr>\r\n                \r\n\r\n            \r\n        \r\n    \r\n    <!-- END: Body Area -->\r\n    <!-- START: Footer Area -->\r\n</tbody></table><table class="body" style=''border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;height: 100%;width: 100%;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px''>\r\n    <tbody><tr style="padding: 0;vertical-align: top;text-align: left">\r\n        <td class="center" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0;vertical-align: top;text-align: center;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px'' align="center" valign="top">\r\n        <center style="width: 100%;min-width: 580px">\r\n        </center>\r\n        </td>\r\n    </tr>\r\n</tbody></table><table class="body" style=''border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;height: 100%;width: 100%;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px''>\r\n    <tbody><tr style="padding: 0;vertical-align: top;text-align: left">\r\n        <td class="center" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0;vertical-align: top;text-align: center;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px'' align="center" valign="top">\r\n        <center style="width: 100%;min-width: 580px">\r\n        <table class="container" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: inherit;width: 580px;margin: 0 auto">\r\n            <tbody><tr style="padding: 0;vertical-align: top;text-align: left">\r\n                <td style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px''>&nbsp;</td>\r\n            </tr>\r\n        </tbody></table>\r\n\r\n        <table cellspacing="0" cellpadding="0" width="600">\r\n    <tr>\r\n        <td style="line-height:100%;text-align:right" width="620" bgcolor="#ffffff">\r\n            <img src="http://delloverdrive.com/img/hosted/partner_direct.png">\r\n        </td>\r\n    </tr>\r\n</table>\r\n\r\n        </center>\r\n        </td>\r\n    </tr>\r\n</tbody></table>&nbsp;    <!-- END: Footer Area -->\r\n    <!-- Tracking Pixel -->\r\n        <img style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;max-width: 100%;float: left;clear: both;display: block" src="http://activate.software.dell.com/no-content?at=7" width="1" height="1">\r\n\r\n\r\n</body></html>', '', 'You have been invited to the Mobile Security webcast', '{"partner_image":{"type":"image","name":"Partner Logo","required":1}}', 1);
INSERT INTO `email_templates` (`email_template_id`, `title`, `description`, `html`, `plaintext`, `subject`, `settings`, `active`) VALUES
(6, 'Threat Landscape Webcast', 'Invite contacts to this webcast where they''ll find out how to anticipate and prevent emerging security threats and see how to better secure their organization, keeping it safe from external and internal threats.', '\n<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head>\n    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">\n    <meta name="viewport" content="width=device-width">\n    <style type="text/css">\n        @media only screen and (max-width: 600px) {\n            table[class="body"] img {\n                width: auto !important;\n                height: auto !important;\n            }\n\n            table[class="body"] center {\n                min-width: 0 !important;\n            }\n\n            table[class="body"] .container {\n                width: 95% !important;\n            }\n\n            table[class="body"] .row {\n                width: 100% !important;\n                display: block !important;\n            }\n\n            table[class="body"] .wrapper {\n                display: block !important;\n                padding-right: 0 !important;\n            }\n\n            table[class="body"] .columns, table[class="body"] .column {\n                table-layout: fixed !important;\n                float: none !important;\n                width: 100% !important;\n                padding-right: 0px !important;\n                padding-left: 0px !important;\n                display: block !important;\n            }\n\n            table[class="body"] table.columns td, table[class="body"] table.column td {\n                width: 100% !important;\n            }\n\n            table[class="body"] .columns td.one, table[class="body"] .column td.one {\n                width: 8.333333% !important;\n            }\n\n            table[class="body"] .columns td.two, table[class="body"] .column td.two {\n                width: 16.666666% !important;\n            }\n\n            table[class="body"] .columns td.three, table[class="body"] .column td.three {\n                width: 25% !important;\n            }\n\n            table[class="body"] .columns td.four, table[class="body"] .column td.four {\n                width: 33.333333% !important;\n            }\n\n            table[class="body"] .columns td.five, table[class="body"] .column td.five {\n                width: 41.666666% !important;\n            }\n\n            table[class="body"] .columns td.six, table[class="body"] .column td.six {\n                width: 50% !important;\n            }\n\n            table[class="body"] .columns td.seven, table[class="body"] .column td.seven {\n                width: 58.333333% !important;\n            }\n\n            table[class="body"] .columns td.eight, table[class="body"] .column td.eight {\n                width: 66.666666% !important;\n            }\n\n            table[class="body"] .columns td.nine, table[class="body"] .column td.nine {\n                width: 75% !important;\n            }\n\n            table[class="body"] .columns td.ten, table[class="body"] .column td.ten {\n                width: 83.333333% !important;\n            }\n\n            table[class="body"] .columns td.eleven, table[class="body"] .column td.eleven {\n                width: 91.666666% !important;\n            }\n\n            table[class="body"] .columns td.twelve, table[class="body"] .column td.twelve {\n                width: 100% !important;\n            }\n\n            table[class="body"] td.offset-by-one, table[class="body"] td.offset-by-two, table[class="body"] td.offset-by-three, table[class="body"] td.offset-by-four, table[class="body"] td.offset-by-five, table[class="body"] td.offset-by-six, table[class="body"] td.offset-by-seven, table[class="body"] td.offset-by-eight, table[class="body"] td.offset-by-nine, table[class="body"] td.offset-by-ten, table[class="body"] td.offset-by-eleven {\n                padding-left: 0 !important;\n            }\n\n            table[class="body"] table.columns td.expander {\n                width: 1px !important;\n            }\n\n            table[class="body"] .text-pad-right {\n                padding-left: 10px !important;\n            }\n\n            table[class="body"] .text-pad-left {\n                padding-right: 10px !important;\n            }\n\n            table[class="body"] .hide-for-small {\n                display: none !important;\n                height: 0;\n                width: 0;\n                visibility: hidden;\n            }\n\n            table[class="body"] .show-for-small {\n                display: inherit !important;\n                max-height: unset !important;\n                overflow: inherit !important;\n            }\n\n            .text-size-17 {\n                font-size: 19px;\n            }\n\n                .text-size-17 td {\n                    font-size: 19px;\n                }\n\n                .text-size-17 p {\n                    font-size: 19px;\n                }\n\n                .text-size-17 span {\n                    font-size: 19px;\n                }\n\n            .text-size-16 {\n                font-size: 18px;\n            }\n\n                .text-size-16 td {\n                    font-size: 18px;\n                }\n\n                .text-size-16 p {\n                    font-size: 18px;\n                }\n\n                .text-size-16 span {\n                    font-size: 18px;\n                }\n\n            .text-size-15 {\n                font-size: 17px;\n            }\n\n                .text-size-15 td {\n                    font-size: 17px;\n                }\n\n                .text-size-15 p {\n                    font-size: 17px;\n                }\n\n                .text-size-15 span {\n                    font-size: 17px;\n                }\n\n            .text-size-14 {\n                font-size: 16px;\n            }\n\n                .text-size-14 td {\n                    font-size: 16px;\n                }\n\n                .text-size-14 p {\n                    font-size: 16px;\n                }\n\n                .text-size-14 span {\n                    font-size: 16px;\n                }\n\n            .text-size-13 {\n                font-size: 15px;\n            }\n\n                .text-size-13 td {\n                    font-size: 15px;\n                }\n\n                .text-size-13 p {\n                    font-size: 15px;\n                }\n\n                .text-size-13 span {\n                    font-size: 15px;\n                }\n\n            .text-size-12 {\n                font-size: 14px;\n            }\n\n                .text-size-12 td {\n                    font-size: 14px;\n                }\n\n                .text-size-12 p {\n                    font-size: 14px;\n                }\n\n                .text-size-12 span {\n                    font-size: 14px;\n                }\n\n            h1 {\n                font-size: 29px;\n            }\n\n            h5 {\n                font-size: 17px;\n            }\n\n            table.button.button-width-auto {\n                width: 100% !important;\n                display: table !important;\n            }\n\n            table.button td a, table.button td a:visited {\n                white-space: normal !important;\n            }\n\n			.pb-0-sm {\n                padding-bottom: 0 !important;\n\n            }\n\n            .pt-0-sm {\n                padding-top: 0 !important;\n\n            }\n\n        }\n\n        @media only screen and (min-width: 601px) {\n            .p-0-md {\n                padding: 0 !important;\n            }\n\n            .p-15-md {\n                padding: 15px !important;\n            }\n\n            .p-25-md {\n                padding: 25px !important;\n            }\n\n            .pt-0-md {\n                padding-top: 0 !important;\n            }\n\n            .pt-10-md {\n                padding-top: 10px !important;\n            }\n\n            .pt-20-md {\n                padding-top: 20px !important;\n            }\n\n            .pt-30-md {\n                padding-top: 30px !important;\n            }\n\n            .pb-0-md {\n                padding-bottom: 0 !important;\n            }\n\n            .pb-10-md {\n                padding-bottom: 10px !important;\n            }\n\n            .pb-20-md {\n                padding-bottom: 20px !important;\n            }\n\n            .pb-30-md {\n                padding-bottom: 30px !important;\n            }\n\n            .pl-0-md {\n                padding-left: 0 !important;\n            }\n\n            .pl-10-md {\n                padding-left: 10px !important;\n            }\n\n            .pl-25-md {\n                padding-left: 25px !important;\n            }\n\n            .pl-28-md {\n                padding-left: 28px !important;\n            }\n\n            .pr-0-md {\n                padding-right: 0 !important;\n            }\n\n            .m-0-md {\n                margin: 0 !important;\n            }\n\n            .mt-0-md {\n                margin-top: 0 !important;\n            }\n\n            .mt-10-md {\n                margin-top: 10px !important;\n            }\n\n            .mt-20-md {\n                margin-top: 20px !important;\n            }\n\n            .mb-0-md {\n                margin-bottom: 0 !important;\n            }\n\n            .mb-10-md {\n                margin-bottom: 10px !important;\n            }\n\n            .mb-15-md {\n                margin-bottom: 15px !important;\n            }\n\n            .mb-20-md {\n                margin-bottom: 20px !important;\n            }\n\n            .mb-30-md {\n                margin-bottom: 30px !important;\n            }\n\n            .mb-40-md {\n                margin-bottom: 40px !important;\n            }\n\n            .mb-50-md {\n                margin-bottom: 50px !important;\n            }\n\n            .mr-0-md {\n                margin-right: 0 !important;\n            }\n\n            .mr-10-md {\n                margin-right: 10px !important;\n            }\n\n            .mr-20-md {\n                margin-right: 20px !important;\n            }\n\n            .ml-10-md {\n                margin-left: 10px !important;\n            }\n\n            .ml-20-md {\n                margin-left: 20px !important;\n            }\n        }\n    </style>\n\n    \n\n    \n</head>\n<body style=''width: 100% !important;min-width: 100%;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;margin: 0;padding: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;text-align: left;line-height: 19px;font-size: 14px''>\n\n        <table class="body" style=''border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;height: 100%;width: 100%;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px''>\n            <tbody><tr style="padding: 0;vertical-align: top;text-align: left">\n                <td class="center" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0;vertical-align: top;text-align: center;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px'' align="center" valign="top">\n                    <center style="width: 100%;min-width: 580px">\n                    </center>\n                </td>\n            </tr>\n        </tbody></table>\n\n        <table class="body" style=''border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;height: 100%;width: 100%;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px''>\n            <tbody><tr style="padding: 0;vertical-align: top;text-align: left">\n                <td class="center" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0;vertical-align: top;text-align: center;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px'' align="center" valign="top">\n                    <center style="width: 100%;min-width: 580px">\n\n                        <table class="container" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: inherit;width: 580px;margin: 0 auto">\n                            <tbody><tr style="padding: 0;vertical-align: top;text-align: left">\n                                <td style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px''>\n                                <img src="[logo]" style="margin:8px;width:140px">\n                                    <table class="row" style="border-spacing: 0;border-collapse: collapse;padding: 0px;vertical-align: top;text-align: left;width: 100%;position: relative;display: block">\n                                        <tbody><tr style="padding: 0;vertical-align: top;text-align: left">\n                                            <td class="wrapper last p-0" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0 !important;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;position: relative;padding-right: 0px''>\n                                                <table class="twelve columns" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;margin: 0 auto;width: 580px">\n                                                    <tbody><tr style="padding: 0;vertical-align: top;text-align: left">\n                                                        <td class="pt-0 pb-0" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0px 0px 10px;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;padding-bottom: 0 !important;padding-top: 0 !important''>\n                                                            <a style="color: #2ba6cb;text-decoration: none">\n                                                                <img style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;max-width: 100%;float: left;clear: both;display: block;border: none" src="http://software.dell.com/ecard/43383/39101/header/1-172-IAM-vid.jpg">\n                                                            </a>\n                                                        </td>\n                                                        <td class="expander" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0 !important;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;visibility: hidden;width: 0px''></td>\n                                                    </tr>\n                                                </tbody></table>\n                                            </td>\n                                        </tr>\n                                    </tbody></table>\n\n                                </td>\n                            </tr>\n                        </tbody></table>\n\n                    </center>\n                </td>\n            </tr>\n        </tbody></table>\n\n    <!-- START: Header Area -->\n<table class="body" style=''border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;height: 100%;width: 100%;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px''>\n	<tbody><tr style="padding: 0;vertical-align: top;text-align: left">\n		<td class="center" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0;vertical-align: top;text-align: center;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px'' align="center" valign="top">\n			<center style="width: 100%;min-width: 580px">\n\n				<table class="container" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: inherit;width: 580px;margin: 0 auto">\n					<tbody><tr style="padding: 0;vertical-align: top;text-align: left">\n						<td style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px''>\n\n							<table class="row" style="border-spacing: 0;border-collapse: collapse;padding: 0px;vertical-align: top;text-align: left;width: 100%;position: relative;display: block">\n								<tbody><tr style="padding: 0;vertical-align: top;text-align: left">\n									<td class="wrapper last" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 10px 20px 0px 0px;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;position: relative;padding-right: 0px''>\n										<table class="twelve columns m-0" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;margin: 0 !important;width: 580px">\n											<tbody><tr style="padding: 0;vertical-align: top;text-align: left">\n												<td class="text-pad-left text-pad-right" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0px 0px 10px;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;padding-left: 10px;padding-right: 10px''>\n													<h1 style=''color: #00447c;font-family: "museo-sans-for-dell-300","Trebuchet MS","Roboto","Segoe UI","Helvetica Neue","Meiryo UI Reg","メイリオ Reg","MS UI Gothic Reg","Hiragino Kaku Gothic Reg","ヒラギノ角ゴ Pro W3 Reg","Microsoft YaHei","微软雅黑","Hiragino Sans GB","Microsoft JhengHei","微軟正黑體","Malgun Gothic",Gulim,Tahoma,"Arial Unicode",sans-serif;font-weight: 500;padding: 0;margin: 0;text-align: left;line-height: 1.16667;word-break: normal;font-size: 27px''>Delve into today&#8217;s threat landscape.</h1>\n\n													<h5 class="mt-10" style=''color: #444444;font-family: "Trebuchet MS","Roboto","Segoe UI","Helvetica Neue","Meiryo UI Reg","メイリオ Reg","MS UI Gothic Reg","Hiragino Kaku Gothic Reg","ヒラギノ角ゴ Pro W3 Reg","Microsoft YaHei","微软雅黑","Hiragino Sans GB","Microsoft JhengHei","微軟正黑體","Malgun Gothic",Gulim,Tahoma,"Arial Unicode",sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 1.3;word-break: normal;font-size: 15px;margin-top: 10px !important''>Keep your network safe and secure.</h5>\n												</td>\n												<td class="expander" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0 !important;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;visibility: hidden;width: 0px''></td>\n											</tr>\n										</tbody></table>\n									</td>\n								</tr>\n							</tbody></table>\n\n							<table class="button button-dark-blue m-0" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;margin: 0 !important;width: 100%;overflow: hidden">\n								<tbody><tr style="padding: 0;vertical-align: top;text-align: left">\n									<td style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 3px 15px !important;vertical-align: top;text-align: center;color: #ffffff;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;display: block;width: auto !important;background: #005a85;border: 1px solid #00618F;background-color: #00618F''>\n										<a href=''http://[url]/?a=download_asset&redirect_url=[redirect_url]&hash=[hash]'' class="text-underline" style=''color: #ffffff;text-decoration: none;font-family: "Trebuchet MS", Helvetica, Arial, sans-serif;font-size: 19px;white-space: nowrap;display: block;line-height: 1.3em''">Register today for the webcast</a>\n									</td>\n								</tr>\n							</tbody></table>\n\n						</td>\n					</tr>\n				</tbody></table>\n\n			</center>\n		</td>\n	</tr>\n</tbody></table>    <!-- END: Header Area -->\n    <!-- START: Body Area -->\n<table class="body" style=''border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;height: 100%;width: 100%;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px''>\n    <tbody><tr style="padding: 0;vertical-align: top;text-align: left">\n        <td class="center" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0;vertical-align: top;text-align: center;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px'' align="center" valign="top">\n            <center style="width: 100%;min-width: 580px">\n\n                <table class="container" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: inherit;width: 580px;margin: 0 auto">\n                    <tbody><tr style="padding: 0;vertical-align: top;text-align: left">\n                        <td style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px''>\n\n                            <table class="row hide-for-small" style="border-spacing: 0;border-collapse: collapse;padding: 0px;vertical-align: top;text-align: left;width: 100%;position: relative;display: block">\n                                <tbody><tr style="padding: 0;vertical-align: top;text-align: left">\n                                    <td class="wrapper bg-light-gray" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 10px 20px 0px 0px;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;position: relative;background: #eeeeee''>\n                                        <table class="five columns" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;margin: 0 auto;width: 230px">\n                                            <tbody><tr style="padding: 0;vertical-align: top;text-align: left">\n                                                <td class="text-pad" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0px 0px 10px;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;padding-left: 10px;padding-right: 10px''>\n                                                    <p style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''><p style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''><p style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''>\n                                                    <p class="text-size-14" style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''>Title: </p>\n                                                    <p class="text-size-14" style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''><strong>Rob Krug, Sr. Sales Engineer</strong><br>\n                                                    </p>\n                                                    <p class="text-size-14" style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''>Date: </p>\n<p class="text-size-14" style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''><strong>Thursday, December 10</strong></p>\n<p class="text-size-14" style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''>Time: </p>\n<p class="text-size-14" style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''><strong>10am PST</strong></p>													<p class="text-size-14" style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''>&nbsp;</p>													<p class="text-size-14" style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''>&nbsp;														</p>&nbsp;<p style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''>&nbsp;&nbsp;&nbsp;</p><p style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''><p style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''>&nbsp;</p>\n                                                </td>\n                                                <td class="expander" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0 !important;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;visibility: hidden;width: 0px''></td>\n                                            </tr>\n                                        </tbody></table>\n                                    </td>\n                                    <td class="wrapper last" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 10px 20px 0px 0px;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;position: relative;padding-right: 0px''>\n                                        <table class="seven columns" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;margin: 0 auto;width: 330px">\n                                            <tbody><tr style="padding: 0;vertical-align: top;text-align: left">\n                                                <td style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0px 0px 10px;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px''><img style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;max-width: 100%;float: left;clear: both;display: block" src="http://software.dell.com/images/email/blank.gif" width="20"></td>\n                                                <td class="text-pad" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0px 0px 10px;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;padding-left: 10px;padding-right: 10px''>\n                                                    <p style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''><p style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''><p style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''>Join this webcast and discover a day in the life of your network security and what it may face on a daily basis. Find out how to anticipate and prevent emerging security threats and see how to better secure your organization, keeping it safe from external and internal threats.</p><p style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''>Take a walk through the current threat landscape with a practicing security engineer. Then watch live demonstrations from a SonicWALL system engineer of how to leverage Dell solutions to counter these intrusions.&nbsp;</p>&nbsp;<p style=''margin: 0;color: #444444;font-family: &quot;Trebuchet MS&quot;,&quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''>You&#8217;ll learn more about: </p><ul><li>Understanding the threat landscape and need for security&nbsp;&nbsp;</li><li>Easy methods of extending security awareness to internal and external customers &nbsp;&nbsp;</li><li>Combating threats with Dell Software solutions <br>&nbsp;</li>&nbsp;</ul>&nbsp;<p style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''><p style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''>\n\n                                                    </p><table class="medium button button-blue button-width-auto mb-5 mt-10" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;margin-bottom: 5px !important;margin-top: 10px !important;width: auto;overflow: hidden;margin: 20px 0;display: inline-block">\n                                                        <tbody><tr style="padding: 0;vertical-align: top;text-align: left">\n                                                            <td style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 3px 15px !important;vertical-align: top;text-align: center;color: #ffffff;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;display: block;width: auto !important;background: #005a85;border: 1px solid #007db8;background-color: #007db8''>\n                                                        \n                                                                <!--[if !mso]><!-->\n                                                                    <a href=''http://[url]/?a=download_asset&redirect_url=[redirect_url]&hash=[hash]'''' style=''color: #ffffff;text-decoration: none;font-family: "Trebuchet MS", Helvetica, Arial, sans-serif;font-size: 19px;white-space: nowrap;display: block;line-height: 1.3em''">\n                                                                      <span style="color: #ffffff">\n                                                                        Register Today\n                                                                     </span>\n                                                                    </a>\n                                                                 <!--<![endif]-->\n                                    <!--[if gte mso 9]>\n                                       <a style=''color: #ffffff;text-decoration: none;font-family: "Trebuchet MS", Helvetica, Arial, sans-serif;font-size: 19px;white-space: nowrap;display: block;line-height: 1.3em'' href="http://software.dell.com/ecard-43383-39101-1">\n                                        <span style="color: #ffffff">\n                                          \n                                            &nbsp;&nbsp; Register Today &nbsp;&nbsp;\n                                        \n                                        </span>\n                                      </a>\n                                    <![endif]-->\n                                    \n																                    \n                                                            </td>\n                                                        </tr>\n                                                    </tbody></table>\n\n                                                </td>\n                                                <td class="expander" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0 !important;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;visibility: hidden;width: 0px''></td>\n                                            </tr>\n                                        </tbody></table>\n                                    </td>\n                                </tr>\n                            </tbody></table>\n\n                            <!--[if !mso]><!-->\n                            <div class="show-for-small" style="display: none;max-height: 0;overflow: hidden">\n                                <table class="row" style="border-spacing: 0;border-collapse: collapse;padding: 0px;vertical-align: top;text-align: left;width: 100%;position: relative;display: block">\n                                    <tbody><tr style="padding: 0;vertical-align: top;text-align: left">\n                                        <td class="wrapper last bg-light-gray" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 10px 20px 0px 0px;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;position: relative;background: #eeeeee;padding-right: 0px''>\n                                            <table class="twelve columns" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;margin: 0 auto;width: 580px">\n                                                <tbody><tr style="padding: 0;vertical-align: top;text-align: left">\n                                                    <td class="text-pad-left" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0px 0px 10px;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;padding-left: 10px''>\n                                                        <p style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''><p style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''><p style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''><p class="text-size-14" style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''>Title: </p>													<p class="text-size-14" style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''><strong>Rob Krug, Sr. Sales Engineer </strong></p>													<p class="text-size-14" style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''><br>Date: </p>													<p class="text-size-14" style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''><strong>Thursday, December 10</strong></p>													<p class="text-size-14" style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''><br>Time: </p>													<p class="text-size-14" style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''><strong>10am PST</strong></p>													<p class="text-size-14" style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''>&nbsp;</p>													<p class="text-size-14" style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''>														&nbsp;</p>&nbsp;<p style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''>&nbsp;&nbsp;&nbsp;</p><p style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''><p style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''>&nbsp;</p>\n                                                    </td>\n                                                    <td class="expander" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0 !important;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;visibility: hidden;width: 0px''></td>\n                                                </tr>\n                                            </tbody></table>\n                                        </td>\n                                    </tr>\n                                </tbody></table>\n                                <table class="row" style="border-spacing: 0;border-collapse: collapse;padding: 0px;vertical-align: top;text-align: left;width: 100%;position: relative;display: block">\n                                        <tbody><tr style="padding: 0;vertical-align: top;text-align: left"><td class="wrapper last" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 10px 20px 0px 0px;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;position: relative;padding-right: 0px''>\n                                            <table class="twelve columns" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;margin: 0 auto;width: 580px">\n                                                <tbody><tr style="padding: 0;vertical-align: top;text-align: left">\n                                                    <td class="text-pad" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0px 0px 10px;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;padding-left: 10px;padding-right: 10px''>\n                                                        <p style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''><p style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''><p style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''>Join this webcast and discover a day in the life of your network security and what it may face on a daily basis. Find out how to anticipate and prevent emerging security threats and see how to better secure your organization, keeping it safe from external and internal threats.</p><p style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''>Take a walk through the current threat landscape with a practicing security engineer. Then watch live demonstrations from a SonicWALL system engineer of how to leverage Dell solutions to counter these intrusions.&nbsp;</p>&nbsp;<p style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''>You&#8217;ll learn more about: </p>&nbsp;<p style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''>&nbsp;</p><ul><li>Understanding the threat landscape and need for security&nbsp;</li>&nbsp;<li>Easy methods of extending security awareness to internal and external customers &nbsp;</li>&nbsp;<li>Combating threats with Dell Software solutions <br>&nbsp;</li>&nbsp;</ul>&nbsp;<p style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''><p style=''margin: 0;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 14px;margin-bottom: 10px''>\n\n                                                        </p><table class="medium button button-blue button-width-auto mb-5" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;margin-bottom: 5px !important;width: auto;overflow: hidden;margin: 20px 0;display: inline-block">\n                                                            <tbody><tr style="padding: 0;vertical-align: top;text-align: left">\n                                                                <td style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 3px 15px !important;vertical-align: top;text-align: center;color: #ffffff;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;display: block;width: auto !important;background: #005a85;border: 1px solid #007db8;background-color: #007db8''>\n                                                                    <a style=''color: #ffffff;text-decoration: none;font-family: "Trebuchet MS", Helvetica, Arial, sans-serif;font-size: 19px;white-space: nowrap;display: block;line-height: 1.3em'' href="http://software.dell.com/ecard-43383-39101-1">\n																	<span style="color: #ffffff">\n																		Register Today\n																	</span>\n                                                                    </a>\n                                                                </td>\n                                                            </tr>\n                                                        </tbody></table>\n\n                                                    </td>\n                                                    <td class="expander" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0 !important;vertical-align: top;text-align: left;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;visibility: hidden;width: 0px''></td>\n                                                </tr>\n                                            </tbody></table>\n                                        </td>\n                                    </tr></tbody></table></div></td></tr>\n                                \n                            \n                            <!--<![endif]-->\n\n                        \n                    </tbody></table></center></td></tr>\n                \n\n            \n        \n    \n    <!-- END: Body Area -->\n    <!-- START: Footer Area -->\n</tbody></table><table class="body" style=''border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;height: 100%;width: 100%;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px''>\n    <tbody><tr style="padding: 0;vertical-align: top;text-align: left">\n        <td class="center" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0;vertical-align: top;text-align: center;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px'' align="center" valign="top">\n        <center style="width: 100%;min-width: 580px">\n        </center>\n        </td>\n    </tr>\n</tbody></table><table class="body" style=''border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;height: 100%;width: 100%;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px''>\n    <tbody><tr style="padding: 0;vertical-align: top;text-align: left">\n        <td class="center" style=''word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;padding: 0;vertical-align: top;text-align: center;color: #444444;font-family: "Trebuchet MS","Helvetica", "Arial", sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px'' align="center" valign="top">\n        <center style="width: 100%;min-width: 580px">\n        </center>\n        </td>\n    </tr>\n</tbody></table>\n<center>\n<table cellspacing="0" cellpadding="0" width="580">\n    <tbody><tr>\n        <td style="text-align:right" bgcolor="#ffffff">\n            <img src="http://delloverdrive.com/img/hosted/partner_direct.png">\n        </td>\n    </tr>\n</tbody>\n</table>\n</center>\n&nbsp;    <!-- END: Footer Area -->\n        <!-- Tracking Pixel -->\n        <img style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;max-width: 100%;float: left;clear: both;display: block" src="http://activate.software.dell.com/no-content?at=7" width="1" height="1">\n        <style>\n            @media print{#_t { background-image: url(''https://it53d263.emltrk.com/it53d263?p&d=<span class=eloquaemail>EmailAddress</span>'');}} \n            div.OutlookMessageHeader {background-image:url(''https://it53d263.emltrk.com/it53d263?f&d=<span class=eloquaemail>EmailAddress</span>'')} \n            table.moz-email-headers-table {background-image:url(''https://it53d263.emltrk.com/it53d263?f&d=<span class=eloquaemail>EmailAddress</span>'')} \n            blockquote #_t {background-image:url(''https://it53d263.emltrk.com/it53d263?f&d=<span class=eloquaemail>EmailAddress</span>'')} \n            #MailContainerBody #_t {background-image:url(''https://it53d263.emltrk.com/it53d263?f&d=<span class=eloquaemail>EmailAddress</span>'')}\n        </style><div id="_t"></div><img style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;max-width: 100%;float: left;clear: both;display: block" src="https://it53d263.emltrk.com/it53d263?d=<span class=eloquaemail>EmailAddress</span>" width="1" height="1" border="0">\n\n\n</body></html>', '', 'You have been invited to the Threat Landscape webcast', '{"partner_image":{"type":"image","name":"Partner Logo","required":1},"redirect_url":{"type":"text","name":"Registration URL","required":1,"hint":"Contact your channel manager to get your registration URL"}}', 1);

-- --------------------------------------------------------

--
-- Table structure for table `entities`
--

CREATE TABLE IF NOT EXISTS `entities` (
  `entity_id` int(12) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `type` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `entities`
--

INSERT INTO `entities` (`entity_id`, `name`, `type`) VALUES
(5, 'Acme Corp', 'partner'),
(6, 'Market Resource Partners', 'vendor'),
(7, 'OneAffiniti', 'vendor'),
(8, 'The Channel Company', 'vendor');

-- --------------------------------------------------------

--
-- Table structure for table `entities_info`
--

CREATE TABLE IF NOT EXISTS `entities_info` (
  `entities_info_id` int(12) NOT NULL,
  `entity_id` int(12) NOT NULL,
  `info_type` varchar(255) COLLATE utf8_bin NOT NULL,
  `info_a` varchar(255) COLLATE utf8_bin NOT NULL,
  `info_b` varchar(255) COLLATE utf8_bin NOT NULL,
  `numeric_info` decimal(12,4) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `entities_info`
--

INSERT INTO `entities_info` (`entities_info_id`, `entity_id`, `info_type`, `info_a`, `info_b`, `numeric_info`, `datetime`) VALUES
(5, 5, 'partner_level', 'Gold', '', 0.0000, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `hosted_emails`
--

CREATE TABLE IF NOT EXISTS `hosted_emails` (
  `hosted_email_id` int(12) NOT NULL,
  `html` longtext COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `hosted_emails`
--

INSERT INTO `hosted_emails` (`hosted_email_id`, `html`) VALUES
(1, '\n\n<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\n<html xmlns="http://www.w3.org/1999/xhtml">\n	<head>\n        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />\n        <title>Email</title>\n        <style type="text/css">\n			/* /\\/\\/\\/\\/\\/\\/\\/\\/ CLIENT-SPECIFIC STYLES /\\/\\/\\/\\/\\/\\/\\/\\/ */\n			#outlook a{padding:0;} /* Force Outlook to provide a "view in browser" message */\n			.ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail to display emails at full width */\n			.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing */\n			body, table, td, p, a, li, blockquote{-webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;} /* Prevent WebKit and Windows mobile changing default text sizes */\n			table, td{mso-table-lspace:0pt; mso-table-rspace:0pt;} /* Remove spacing between tables in Outlook 2007 and up */\n			img{-ms-interpolation-mode:bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */\n\n			/* /\\/\\/\\/\\/\\/\\/\\/\\/ RESET STYLES /\\/\\/\\/\\/\\/\\/\\/\\/ */\n			body{margin:0; padding:0;}\n			img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;}\n			table{border-collapse:collapse !important;}\n			body, #bodyTable, #bodyCell{height:100% !important; margin:0; padding:0; width:100% !important;}\n\n			/* /\\/\\/\\/\\/\\/\\/\\/\\/ TEMPLATE STYLES /\\/\\/\\/\\/\\/\\/\\/\\/ */\n\n			/* ========== Page Styles ========== */\n\n			#bodyCell{padding:20px;}\n			#templateContainer{width:600px;}\n\n			/**\n			* @tab Page\n			* @section background style\n			* @tip Set the background color and top border for your email. You may want to choose colors that match your company''s branding.\n			* @theme page\n			*/\n			body, #bodyTable{\n				/*@editable*/ background-color:#EEEEEE;\n			}\n\n			/**\n			* @tab Page\n			* @section background style\n			* @tip Set the background color and top border for your email. You may want to choose colors that match your company''s branding.\n			* @theme page\n			*/\n			#bodyCell{\n				/*@editable*/ border-top:4px solid #BBBBBB;\n			}\n\n			/**\n			* @tab Page\n			* @section email border\n			* @tip Set the border for your email.\n			*/\n			#templateContainer{\n				/*@editable*/ border:1px solid #0085C3;\n			}\n\n			/**\n			* @tab Page\n			* @section heading 1\n			* @tip Set the styling for all first-level headings in your emails. These should be the largest of your headings.\n			* @style heading 1\n			*/\n			h1{\n				/*@editable*/ color:#202020 !important;\n				display:block;\n				/*@editable*/ font-family:Helvetica;\n				/*@editable*/ font-size:26px;\n				/*@editable*/ font-style:normal;\n				/*@editable*/ font-weight:bold;\n				/*@editable*/ line-height:100%;\n				/*@editable*/ letter-spacing:normal;\n				margin-top:0;\n				margin-right:0;\n				margin-bottom:10px;\n				margin-left:0;\n				/*@editable*/ text-align:left;\n			}\n\n			/**\n			* @tab Page\n			* @section heading 2\n			* @tip Set the styling for all second-level headings in your emails.\n			* @style heading 2\n			*/\n			h2{\n				/*@editable*/ color:#444444 !important;\n				display:block;\n				/*@editable*/ font-family:Helvetica;\n				/*@editable*/ font-size:20px;\n				/*@editable*/ font-style:normal;\n				/*@editable*/ font-weight:bold;\n				/*@editable*/ line-height:100%;\n				/*@editable*/ letter-spacing:normal;\n				margin-top:0;\n				margin-right:0;\n				margin-bottom:10px;\n				margin-left:0;\n				/*@editable*/ text-align:left;\n			}\n\n			/**\n			* @tab Page\n			* @section heading 3\n			* @tip Set the styling for all third-level headings in your emails.\n			* @style heading 3\n			*/\n			h3{\n				/*@editable*/ color:#444444 !important;\n				display:block;\n				/*@editable*/ font-family:Helvetica;\n				/*@editable*/ font-size:16px;\n				/*@editable*/ font-style:italic;\n				/*@editable*/ font-weight:normal;\n				/*@editable*/ line-height:100%;\n				/*@editable*/ letter-spacing:normal;\n				margin-top:0;\n				margin-right:0;\n				margin-bottom:10px;\n				margin-left:0;\n				/*@editable*/ text-align:left;\n			}\n\n			/**\n			* @tab Page\n			* @section heading 4\n			* @tip Set the styling for all fourth-level headings in your emails. These should be the smallest of your headings.\n			* @style heading 4\n			*/\n			h4{\n				/*@editable*/ color:#808080 !important;\n				display:block;\n				/*@editable*/ font-family:Helvetica;\n				/*@editable*/ font-size:14px;\n				/*@editable*/ font-style:italic;\n				/*@editable*/ font-weight:normal;\n				/*@editable*/ line-height:100%;\n				/*@editable*/ letter-spacing:normal;\n				margin-top:0;\n				margin-right:0;\n				margin-bottom:10px;\n				margin-left:0;\n				/*@editable*/ text-align:left;\n			}\n\n			/* ========== Header Styles ========== */\n\n			/**\n			* @tab Header\n			* @section preheader style\n			* @tip Set the background color and bottom border for your email''s preheader area.\n			* @theme header\n			*/\n			#templatePreheader{\n				/*@editable*/ background-color:#FFFFFF;\n			}\n\n			/**\n			* @tab Header\n			* @section preheader text\n			* @tip Set the styling for your email''s preheader text. Choose a size and color that is easy to read.\n			*/\n			.preheaderContent{\n				/*@editable*/ color:#444444;\n				/*@editable*/ font-family:Helvetica;\n				/*@editable*/ font-size:10px;\n				/*@editable*/ line-height:125%;\n				/*@editable*/ text-align:left;\n			}\n\n			/**\n			* @tab Header\n			* @section preheader link\n			* @tip Set the styling for your email''s preheader links. Choose a color that helps them stand out from your text.\n			*/\n			.preheaderContent a:link, .preheaderContent a:visited, /* Yahoo! Mail Override */ .preheaderContent a .yshortcuts /* Yahoo! Mail Override */{\n				/*@editable*/ color:#606060;\n				/*@editable*/ font-weight:normal;\n				/*@editable*/ text-decoration:underline;\n			}\n\n			/**\n			* @tab Header\n			* @section header style\n			* @tip Set the background color and borders for your email''s header area.\n			* @theme header\n			*/\n			#templateHeader{\n				/*@editable*/ background-color:#FFFFFF;\n				/*@editable*/ border-bottom:1px solid #0085C3;\n			}\n\n			/**\n			* @tab Header\n			* @section header text\n			* @tip Set the styling for your email''s header text. Choose a size and color that is easy to read.\n			*/\n			.headerContent{\n				/*@editable*/ color:#505050;\n				/*@editable*/ font-family:Helvetica;\n				/*@editable*/ font-size:20px;\n				/*@editable*/ font-weight:bold;\n				/*@editable*/ line-height:100%;\n				/*@editable*/ padding-top:0;\n				/*@editable*/ padding-right:0;\n				/*@editable*/ padding-bottom:0;\n				/*@editable*/ padding-left:0;\n				/*@editable*/ text-align:left;\n				/*@editable*/ vertical-align:middle;\n			}\n\n			/**\n			* @tab Header\n			* @section header link\n			* @tip Set the styling for your email''s header links. Choose a color that helps them stand out from your text.\n			*/\n			.headerContent a:link, .headerContent a:visited, /* Yahoo! Mail Override */ .headerContent a .yshortcuts /* Yahoo! Mail Override */{\n				/*@editable*/ color:#EB4102;\n				/*@editable*/ font-weight:normal;\n				/*@editable*/ text-decoration:underline;\n			}\n\n			#headerImage{\n				height:auto;\n				max-width:600px;\n			}\n\n			/* ========== Body Styles ========== */\n\n			/**\n			* @tab Body\n			* @section body style\n			* @tip Set the background color and borders for your email''s body area.\n			*/\n			#templateBody{\n				/*@editable*/ background-color:#FFFFFF;\n				/*@editable*/ border-top:0px solid #FFFFFF;\n				/*@editable*/ border-bottom:0px solid #CCCCCC;\n			}\n\n			/**\n			* @tab Body\n			* @section body text\n			* @tip Set the styling for your email''s main content text. Choose a size and color that is easy to read.\n			* @theme main\n			*/\n			.bodyContent{\n				/*@editable*/ color:#444444;\n				/*@editable*/ font-family:Helvetica;\n				/*@editable*/ font-size:14px;\n				/*@editable*/ line-height:150%;\n				padding-top:20px;\n				padding-right:20px;\n				padding-bottom:20px;\n				padding-left:20px;\n				/*@editable*/ text-align:left;\n			}\n\n			/**\n			* @tab Body\n			* @section body link\n			* @tip Set the styling for your email''s main content links. Choose a color that helps them stand out from your text.\n			*/\n			.bodyContent a:link, .bodyContent a:visited, /* Yahoo! Mail Override */ .bodyContent a .yshortcuts /* Yahoo! Mail Override */{\n				/*@editable*/ color:#EB4102;\n				/*@editable*/ font-weight:normal;\n				/*@editable*/ text-decoration:underline;\n			}\n\n			.bodyContent img{\n				display:inline;\n				height:auto;\n				max-width:560px;\n			}\n\n			/* ========== Footer Styles ========== */\n\n			/**\n			* @tab Footer\n			* @section footer style\n			* @tip Set the background color and borders for your email''s footer area.\n			* @theme footer\n			*/\n			#templateFooter{\n				/*@editable*/ background-color:#FFFFFF;\n				/*@editable*/ border-top:0px solid #FFFFFF;\n			}\n\n			/**\n			* @tab Footer\n			* @section footer text\n			* @tip Set the styling for your email''s footer text. Choose a size and color that is easy to read.\n			* @theme footer\n			*/\n			.footerContent{\n				/*@editable*/ color:#808080;\n				/*@editable*/ font-family:Helvetica;\n				/*@editable*/ font-size:10px;\n				/*@editable*/ line-height:150%;\n				padding-top:20px;\n				padding-right:20px;\n				padding-bottom:20px;\n				padding-left:20px;\n				/*@editable*/ text-align:left;\n			}\n\n			/**\n			* @tab Footer\n			* @section footer link\n			* @tip Set the styling for your email''s footer links. Choose a color that helps them stand out from your text.\n			*/\n			.footerContent a:link, .footerContent a:visited, /* Yahoo! Mail Override */ .footerContent a .yshortcuts, .footerContent a span /* Yahoo! Mail Override */{\n				/*@editable*/ color:#606060;\n				/*@editable*/ font-weight:normal;\n				/*@editable*/ text-decoration:underline;\n			}\n\n			/* /\\/\\/\\/\\/\\/\\/\\/\\/ MOBILE STYLES /\\/\\/\\/\\/\\/\\/\\/\\/ */\n\n            @media only screen and (max-width: 480px){\n				/* /\\/\\/\\/\\/\\/\\/ CLIENT-SPECIFIC MOBILE STYLES /\\/\\/\\/\\/\\/\\/ */\n				body, table, td, p, a, li, blockquote{-webkit-text-size-adjust:none !important;} /* Prevent Webkit platforms from changing default text sizes */\n                body{width:100% !important; min-width:100% !important;} /* Prevent iOS Mail from adding padding to the body */\n\n				/* /\\/\\/\\/\\/\\/\\/ MOBILE RESET STYLES /\\/\\/\\/\\/\\/\\/ */\n				#bodyCell{padding:10px !important;}\n\n				/* /\\/\\/\\/\\/\\/\\/ MOBILE TEMPLATE STYLES /\\/\\/\\/\\/\\/\\/ */\n\n				/* ======== Page Styles ======== */\n\n				/**\n				* @tab Mobile Styles\n				* @section template width\n				* @tip Make the template fluid for portrait or landscape view adaptability. If a fluid layout doesn''t work for you, set the width to 300px instead.\n				*/\n				#templateContainer{\n					max-width:600px !important;\n					/*@editable*/ width:100% !important;\n				}\n\n				/**\n				* @tab Mobile Styles\n				* @section heading 1\n				* @tip Make the first-level headings larger in size for better readability on small screens.\n				*/\n				h1{\n					/*@editable*/ font-size:24px !important;\n					/*@editable*/ line-height:100% !important;\n				}\n\n				/**\n				* @tab Mobile Styles\n				* @section heading 2\n				* @tip Make the second-level headings larger in size for better readability on small screens.\n				*/\n				h2{\n					/*@editable*/ font-size:20px !important;\n					/*@editable*/ line-height:100% !important;\n				}\n\n				/**\n				* @tab Mobile Styles\n				* @section heading 3\n				* @tip Make the third-level headings larger in size for better readability on small screens.\n				*/\n				h3{\n					/*@editable*/ font-size:18px !important;\n					/*@editable*/ line-height:100% !important;\n				}\n\n				/**\n				* @tab Mobile Styles\n				* @section heading 4\n				* @tip Make the fourth-level headings larger in size for better readability on small screens.\n				*/\n				h4{\n					/*@editable*/ font-size:16px !important;\n					/*@editable*/ line-height:100% !important;\n				}\n\n				/* ======== Header Styles ======== */\n\n				#templatePreheader{display:none !important;} /* Hide the template preheader to save space */\n\n				/**\n				* @tab Mobile Styles\n				* @section header image\n				* @tip Make the main header image fluid for portrait or landscape view adaptability, and set the image''s original width as the max-width. If a fluid setting doesn''t work, set the image width to half its original size instead.\n				*/\n				#headerImage{\n					height:auto !important;\n					/*@editable*/ max-width:600px !important;\n					/*@editable*/ width:100% !important;\n				}\n\n				/**\n				* @tab Mobile Styles\n				* @section header text\n				* @tip Make the header content text larger in size for better readability on small screens. We recommend a font size of at least 16px.\n				*/\n				.headerContent{\n					/*@editable*/ font-size:20px !important;\n					/*@editable*/ line-height:125% !important;\n				}\n\n				/* ======== Body Styles ======== */\n\n				/**\n				* @tab Mobile Styles\n				* @section body text\n				* @tip Make the body content text larger in size for better readability on small screens. We recommend a font size of at least 16px.\n				*/\n				.bodyContent{\n					/*@editable*/ font-size:18px !important;\n					/*@editable*/ line-height:125% !important;\n				}\n\n				/* ======== Footer Styles ======== */\n\n				/**\n				* @tab Mobile Styles\n				* @section footer text\n				* @tip Make the body content text larger in size for better readability on small screens.\n				*/\n				.footerContent{\n					/*@editable*/ font-size:14px !important;\n					/*@editable*/ line-height:115% !important;\n				}\n\n				.footerContent a{display:block !important;} /* Place footer social and utility links on their own lines, for easier access */\n			}\n		</style>\n    </head>\n    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">\n<center>\n        	<table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">\n            	<tbody><tr>\n                	<td align="center" valign="top" id="bodyCell">\n                    	<!-- BEGIN TEMPLATE // -->\n                    	<table border="0" cellpadding="0" cellspacing="0" id="templateContainer">\n                        	<tbody>\n                        	<tr>\n                            	<td align="center" valign="top">\n                                	<!-- BEGIN HEADER // -->\n                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateHeader">\n                                        <tbody><tr>\n                                            <td valign="top" class="headerContent"><img id="headerImage" mc:allowdesigner="" mc:allowtext="" mc:edit="header_image" mc:label="header_image" src="http://delloverdrive.com/img/hosted/emailbanner.png" style="max-width:600px;"></td>\n                                        </tr>\n                                    </tbody></table>\n                                    <!-- // END HEADER -->\n                                </td>\n                            </tr>\n                        	<tr>\n                            	<td align="center" valign="top">\n                                	<!-- BEGIN BODY // -->\n                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateBody">\n                                        <tbody><tr>\n                                            <td valign="top" class="bodyContent" mc:edit="body_content"><h1><span style="font-size:26px;"><span style="color:#0085C3;">Push your security sales into overdrive.</span></span></h1>\n\n<h2><span style="font-size:18px;"><span style="color:#AAAAAA;"><strong>Rev the meter to meet your goals. Sign up to get started today.</strong></span></span></h2>\n<br>\n<strong>Dear Recipient,</strong><br>\n<br>\nDell is proud to invite you to participate in&nbsp;<strong><a href="dellovedrive.com" target="_blank">Dell Security Overdrive</a></strong>, our new partner sales rep incentive platform.<br>\n<br>\nWhen we say overdrive, we mean it! Earn by just doing your everyday sales activities and also be entered into our Grand Prize drawing for a trip for two to the World Golf Championships-Dell Match Play in Austin, Texas.<br>\n<br>\n<span style="color:#0085C3;"><strong>Here''s how to get started:</strong></span><br>\n&nbsp;\n<div>\n<hr style="border:1px solid #0085C3" width="75%"></div>\n<br/>\n\n<table align="center" border="0" cellpadding="15" cellspacing="1" class="pd-table" style="width:75%;">\n	<tbody>\n		<tr>\n			<td style="width: 14px; text-align: center;"><img alt="1" border="0" height="56" src=" http://go.mrpfd.com/l/24472/2015-09-02/2vkpdw/24472/89092/1.png" style="width: 56px; height: 56px; border-width: 0px; border-style: solid; float: left;" width="56"></td>\n			<td style="width: 195px; background-color: rgb(238, 238, 238);"><span style="font-size:22px;"><strong>LOG IN</strong>:</span><br>\n			<br>\n			Visit <strong><a href="http://delloverdrive.com" style="color:#00447c;" target="_blank">DellOverdrive.com</a>&nbsp;</strong> and register with your information. Access will be approved instantly and you’ll have immediate access to the Dell Security Overdrive platform. </td>\n		</tr>\n	</tbody>\n</table>\n\n<div>&nbsp;</div>\n\n<table align="center" border="0" cellpadding="15" cellspacing="1" class="pd-table" style="width:75%;">\n	<tbody>\n		<tr>\n			<td style="width: 49px; text-align: center;"><img align="left" alt="2" border="0" height="56" src="http://go.mrpfd.com/l/24472/2015-09-02/2vkpdy/24472/89094/2.png" style="width: 56px; height: 56px; float: left; border-width: 0px; border-style: solid;" width="56"></td>\n			<td style="width: 196px; background-color: rgb(238, 238, 238);"><span style="font-size: 22px;"><b>EARN POINTS</b>:</span><br>\n			<br>\n			Once you''re logged in, you can start earning points immediately. You can improve your position on the leaderboard by viewing sales resources, testing your product knowledge, and registering deals. The more active you are, the more points you earn and redeem.</td>\n		</tr>\n	</tbody>\n</table>\n&nbsp;\n\n<table align="center" border="0" cellpadding="15" cellspacing="1" class="pd-table" style="width: 75%;">\n	<tbody>\n		<tr>\n			<td style="width: 49px; text-align: center;"><img align="left" alt="3" border="0" height="56" src="http://go.mrpfd.com/l/24472/2015-09-02/2vkpf3/24472/89098/3.png" style="width: 56px; height: 56px; float: left; border-width: 0px; border-style: solid;" width="56"></td>\n			<td style="width: 196px; background-color: rgb(238, 238, 238);"><span style="font-size: 22px;"><b>COLLECT REWARDS</b>:</span><br>\n			<br>\n			After earning a qualifying amount of points each quarter, you can exchange them for Amazon gift cards and be entered into the grand prize sweepstake. \n			</td>\n		</tr>\n	</tbody>\n</table>\n&nbsp;\n\n<div>\n<hr style="border:1px solid #0085C3" width="75%"></div>\n<br/>\n\n<div style="text-align: center;"><br>\nStart learning, selling more and earning! <a href="http://delloverdrive.com" target="_blank">Register now</a> to increase your earning potential</div>\n\n<br/>\n<div>\n<hr style="border:1px solid #0085C3" width="75%"></div>\n\n<br/>\n\n</td>\n                                        </tr>\n                                    </tbody></table>\n                                    <!-- // END BODY -->\n                                </td>\n                            </tr>\n                        	<tr>\n                            	<td align="center" valign="top">\n                                	<!-- BEGIN FOOTER // -->\n                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateFooter">\n                                        <tbody>\n                                        <tr>\n                                            <td valign="top" class="footerContent" style="padding-top:0;" mc:edit="footer_content01"><table border="0" cellpadding="0" cellspacing="0" class="pd-table" style="width:100%;">\n	<tbody>\n		<tr>\n			<td>This email was sent on behalf of<strong> Dell Security </strong>by:<br>\n			<br>\n			Marvin Blough<br>\n			Vice President, WW Channels<br>\n			Dell Security</td>\n			<td style="vertical-align: middle; text-align: right;"><img alt="Dell Security" border="0" height="67" src="http://delloverdrive.com/img/hosted/dell_logo2.png" style="border-width: 0px; border-style: solid; float: right;"></td>\n		</tr>\n	</tbody>\n</table>\n</td>\n                                        </tr>\n                                        <tr>\n                                            <td valign="top" class="footerContent" style="padding-top:0; padding-bottom:40px;" mc:edit="footer_content02"><div style="text-align: center;"><br>\n<span style="color:#AAAAAA;">This email was sent because you have opted-in to receive it.<br>\nWant to change your preferences?</span>&nbsp;<a href="%%unsubscribe%%" style="color:#00447C;">U</a><a href="%%unsubscribe%%">nsubscribe from this list</a></div>\n</td>\n                                        </tr>\n                                    </tbody></table>\n                                    <!-- // END FOOTER -->\n                                </td>\n                            </tr>\n                        </tbody></table>\n                        <!-- // END TEMPLATE -->\n                    </td>\n                </tr>\n            </tbody></table>\n        </center>\n</body>\n</html>');

-- --------------------------------------------------------

--
-- Table structure for table `invites`
--

CREATE TABLE IF NOT EXISTS `invites` (
  `invite_id` int(12) NOT NULL,
  `from_user_id` int(12) NOT NULL,
  `to_name` varchar(200) NOT NULL,
  `to_company` varchar(120) NOT NULL,
  `to_title` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `invite_time` datetime NOT NULL,
  `response_time` datetime NOT NULL,
  `invite_status` tinyint(1) NOT NULL,
  `invite_key` varchar(20) NOT NULL,
  `msg` varchar(400) NOT NULL,
  `event_id` int(12) NOT NULL,
  `sent_qty` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invites`
--

INSERT INTO `invites` (`invite_id`, `from_user_id`, `to_name`, `to_company`, `to_title`, `email`, `invite_time`, `response_time`, `invite_status`, `invite_key`, `msg`, `event_id`, `sent_qty`) VALUES
(10, 1, 'John Doe', 'Acme', 'Dev', 'naif@entermarketing.com', '2013-10-24 16:58:32', '0000-00-00 00:00:00', 0, '7eiveeugm2kad7e', '', 7, 1),
(11, 2, 'John', 'Acme', 'Doe', 'nahmed@entermarketing.com', '2013-10-24 19:48:34', '0000-00-00 00:00:00', 0, '2tokfodytxm8ux4', '', 7, 1),
(12, 2, 'Russel', 'MP', 'Watts', 'rw@entermarketing.com', '2013-10-24 19:49:11', '0000-00-00 00:00:00', 0, 'yx6pyvwih6hq0o0', '', 7, 1),
(13, 3, 'Rachel Adelman', 'Enter', 'MP', 'ra@entermarketing.com', '2013-10-24 21:44:51', '0000-00-00 00:00:00', 0, '8xj3i9q2yv3j370', '', 7, 1),
(14, 5, 'Tim Freestone', 'EM', 'Awesome', 'tf@entermarketing.com', '2013-10-24 23:51:41', '0000-00-00 00:00:00', 0, 'ujiscgd3al8ejq4', '', 7, 1),
(15, 3, 'jim', 'somewhere', 'johnson', 'jimjohnson@entermarketing.com', '2013-10-25 14:31:36', '0000-00-00 00:00:00', 0, 'wdue3f9q5o6harv', '', 7, 1),
(16, 3, 'test', 'test', 'test', 'test23123@entermarketing.com', '2013-10-25 14:31:50', '0000-00-00 00:00:00', 0, 's9pne8xykpsla2t', '', 7, 1),
(17, 3, 'asdasd', '4234asdasd', 'sadsad', '7uasdjao@entermarketing.com', '2013-10-25 14:32:12', '0000-00-00 00:00:00', 0, 'mqf8e7jxq4hajua', '', 7, 1),
(18, 3, 'someone', '87asd', 'here', 'hakjsd98a@entermarketing.com', '2013-10-25 14:32:26', '0000-00-00 00:00:00', 0, 'spxr9mxartq9w8c', '', 7, 1),
(19, 3, 'uhajksdhk', 'ujlkasdu09', '7uojasodl', 'jhlkasd798@entermarketing.com', '2013-10-25 14:32:39', '0000-00-00 00:00:00', 0, '1wgxbvab0hgrtu0', '', 7, 1),
(20, 3, 'asdhk', 'jlkasd', '87o0', 'hyasoiduo@entermarketing.com', '2013-10-25 14:32:58', '0000-00-00 00:00:00', 0, 'miid19jleeuu8pw', '', 7, 1),
(21, 3, 'hkasdu98', 'asdu90ujo', 'jhklasdu90', 'uaosduj968@entermarketing.com', '2013-10-25 14:33:04', '0000-00-00 00:00:00', 0, '8jvt7mitx2rzkby', '', 7, 1),
(22, 3, 'hjkasdu98', 'jalsd80', 'jlkasd80', 'jlkasda0sdm@entermarketing.com', '2013-10-25 14:33:19', '0000-00-00 00:00:00', 0, 'nti5h1sr9hcol72', '', 7, 1),
(23, 7, 'r', 'c', 't', 'asdf@entermarketing.com', '2013-10-25 18:07:48', '0000-00-00 00:00:00', 0, '2hnjkqke2ktc5l8', '', 7, 1),
(24, 7, 'Derek', 'em', 'D', 'dd@entermarketing.com', '2013-10-25 18:23:30', '0000-00-00 00:00:00', 0, 'glr12nll27cilly', '', 7, 1),
(25, 8, 'david', 'asdc', 'title', 'db@entermarketing.com', '2013-10-28 14:42:01', '0000-00-00 00:00:00', 0, 'hj40om9o5a4axn2', '', 7, 1),
(27, 11, 'Fabio Caparelli', 'enter:marketing', 'QA', 'fc@entermarketing.com', '2013-10-28 20:39:34', '0000-00-00 00:00:00', 0, '55s7j29kabzn49v', '', 7, 1),
(28, 11, 'russ etc', 'c', 't', 'rw@entertechconnect.com', '2013-10-28 20:45:40', '0000-00-00 00:00:00', 0, 'nv98s5g1j2cxmqy', '', 7, 1),
(29, 12, 'brian lener', 'enter', 'qa master', 'bl@entermarketing.com', '2013-10-28 21:26:41', '0000-00-00 00:00:00', 0, '8a8y6c0c2w8d2ce', '', 7, 1),
(30, 12, 'miriam vieyra', 'em', 'email queen', 'mv@entermarketing.com', '2013-10-28 21:26:58', '0000-00-00 00:00:00', 0, 'luxzas41mswawz3', '', 7, 1),
(31, 12, 'dasha solovieva', 'em', 'email annhilaltor ', 'ds@entermarketing.com', '2013-10-28 21:28:01', '0000-00-00 00:00:00', 0, 't72z9txk4tmdbw7', '', 7, 1),
(32, 12, 'jeremiah bird', 'em', 'DESIGN RAPIST', 'jb@entermarketing.com', '2013-10-28 21:32:17', '0000-00-00 00:00:00', 0, '5xyt7d1ha1x0bii', '', 7, 1),
(33, 12, 'Ray McGale', 'em', 'DESIGN RAPIST', 'rm@entermarketing.com', '2013-10-28 21:32:49', '0000-00-00 00:00:00', 0, 'cg4jiat8x4tzzy8', '', 7, 1),
(34, 12, 'anthony firetto', 'em', 'butt sniffer', 'af@entermarketing.com', '2013-10-28 21:36:01', '0000-00-00 00:00:00', 0, 'esv4dg5bj1pr38k', '', 7, 1),
(35, 12, 'kent yuen', 'em', 'BABY MAKER', 'ky@entermarketing.com', '2013-10-28 21:40:52', '0000-00-00 00:00:00', 0, '8t9xbdh05bf5js8', '', 7, 1),
(36, 3, 'Naif', 'test', 'Test', 'contact@naifahmed.com', '2013-10-29 18:19:26', '0000-00-00 00:00:00', 0, 'vgl57e6qsu7ouej', '', 7, 1),
(37, 5, 'max test', 'asdf', 't', 'ms@entermarketing.com', '2013-10-31 17:04:09', '0000-00-00 00:00:00', 0, 'wxugprz0r1rbut2', '', 7, 1),
(38, 5, '2pac', 'thugz mansion', 'gangsta', 'jr@entermarketing.com', '2013-10-31 18:04:47', '0000-00-00 00:00:00', 0, 'cu8fz28yk1edcn9', '', 7, 1),
(39, 30, 'Pat Abernathy', 'OWASA', 'Network Administrator', 'pabernathy@owasa.org', '2013-11-04 15:21:50', '0000-00-00 00:00:00', 0, 'gj8m0hpbbt264qz', '', 7, 1),
(40, 32, 'Jud Hendricks', 'Isilon', 'The Main Man', 'judson.hendricks@isilon.com', '2013-11-04 22:49:13', '0000-00-00 00:00:00', 0, 'p6z4nbrjza3ocbf', '', 7, 1),
(41, 48, 'Liwei Jiang', 'AKG ', 'App Programmer', 'liwei.jiang@akg-america.com', '2013-11-06 14:29:27', '0000-00-00 00:00:00', 0, '9sm1ie794f1erbu', '', 7, 1),
(42, 14, 'test', '2', 't', 'test@test.com', '2013-11-06 22:48:24', '0000-00-00 00:00:00', 0, 'uicanb2clm4f253', '', 7, 1),
(43, 32, 'The Quocinator', 'em', 'Quocinator', 'qc@entermarketing.com', '2013-11-12 22:04:23', '0000-00-00 00:00:00', 0, 'odtjudnzf02mues', '', 7, 1),
(44, 112, 'chris petterson', 'american express', 'lead quality analyst', 'chris.d.petterson@aexp.com', '2013-11-14 18:51:07', '0000-00-00 00:00:00', 0, 'bjyah8k1w8fdddk', '', 7, 1),
(45, 112, 'Phil Rohkohl', 'american express', 'Lead Quality Analyst', 'philip.a.rohkohl@aexp.com', '2013-11-14 18:52:17', '0000-00-00 00:00:00', 0, '5hrvy676v9sei2n', '', 7, 1),
(46, 132, 'Craig Bourquin', 'GPM Life', 'Systems Manager', 'CBourquin@gpmlife.com', '2013-11-14 19:40:12', '0000-00-00 00:00:00', 0, 'qyob5hzlnc4jicc', '', 7, 1),
(47, 142, 'devon bowers', 'block vision', 'Mgr Data Center', 'dbowers@blockvision.com', '2013-11-15 17:07:33', '0000-00-00 00:00:00', 0, 'iakwo4w3om518h9', '', 7, 1),
(48, 187, 'Noopur Gupta', 'HNW', 'Java Developer', 'ngupta@hnw.com', '2013-11-18 20:10:02', '0000-00-00 00:00:00', 0, 'ui9t2z20yfaa8mp', '', 7, 1),
(49, 187, 'Genevieve Ngambia ', 'HNW', 'Java Developer', 'gngambia@hnw.com', '2013-11-18 20:10:17', '0000-00-00 00:00:00', 0, 'lw1wawv327ui4y3', '', 7, 1),
(50, 187, 'Peter Petrou', 'HNW', 'Vice President, Software Development', 'ppetrou@hnw.com', '2013-11-18 20:11:40', '0000-00-00 00:00:00', 0, 'c0v8c6kp2kf6ijp', '', 7, 1),
(51, 32, 'Mike G', 'em', 'baller', 'mg@entermarketing.com', '2013-11-18 23:05:16', '0000-00-00 00:00:00', 0, '8qb0ctje2kzuwxj', '', 7, 1),
(52, 32, 'lindsey', 'l', 'l', 'lp@entermarketing.com', '2013-11-20 20:01:57', '0000-00-00 00:00:00', 0, 'htvhgpzln3yxn56', '', 7, 1),
(53, 199, 'r', 'r', 'r', 'pk@entertechconnect.com', '2013-11-20 20:25:27', '0000-00-00 00:00:00', 0, 'g94vcom656t6i72', '', 7, 1),
(54, 199, 'jay test', 'a', 'a', 'jay@itmeetingmaker.com', '2013-11-20 20:30:22', '0000-00-00 00:00:00', 0, 'rr21woxihtshwhr', '', 7, 1),
(55, 14, 'test', 'test', 'test', 'test@asdasdsadsad.com', '2013-11-21 15:29:42', '0000-00-00 00:00:00', 0, 'sy85sf3kips9iy0', '', 7, 1),
(56, 30, 'Richard Wyatt', 'OWASA', 'IT Specialist', 'rwyatt@owasa.org', '2013-11-21 18:23:01', '0000-00-00 00:00:00', 0, 's9ym7rts47t0qq4', '', 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `locales`
--

CREATE TABLE IF NOT EXISTS `locales` (
  `locale_id` int(12) NOT NULL,
  `locale` varchar(20) NOT NULL,
  `locale_name` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `locale_id_alias` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locales`
--

INSERT INTO `locales` (`locale_id`, `locale`, `locale_name`, `locale_id_alias`) VALUES
(45, 'en-US', 'English', '1'),
(46, 'de', 'Deutsch', '3'),
(47, 'es-ES', 'Español', '7'),
(48, 'fr', 'Français', '4'),
(49, 'it', 'Italiano', '5'),
(50, 'pt-BR', 'Portugues (Brazil)', '12'),
(51, 'ru', 'Russian', '13'),
(52, 'ko', 'Korean', '23'),
(53, 'ja', 'Japanese', '34'),
(54, 'zh-CN', 'Simplified Chinese', '14');

-- --------------------------------------------------------

--
-- Table structure for table `locale_text`
--

CREATE TABLE IF NOT EXISTS `locale_text` (
  `locale_text_id` int(12) NOT NULL,
  `text_name` varchar(200) NOT NULL,
  `locale_id` int(12) NOT NULL,
  `info` varchar(800) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=171 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locale_text`
--

INSERT INTO `locale_text` (`locale_text_id`, `text_name`, `locale_id`, `info`) VALUES
(1, 'Completed creating an Event', 45, 'Completed creating an Event'),
(2, 'Completed creating an Event', 46, ''),
(3, 'Completed creating an Event', 47, ''),
(4, 'Completed creating an Event', 48, ''),
(5, 'Completed creating an Event', 49, ''),
(6, 'Completed creating an Event', 50, ''),
(7, 'Completed creating an Event', 51, ''),
(8, 'Completed creating an Event', 52, ''),
(9, 'Completed creating an Event', 53, ''),
(10, 'Completed creating an Event', 54, ''),
(11, 'Downloaded a Resource', 45, 'Downloaded a Resource'),
(12, 'Downloaded a Resource', 46, ''),
(13, 'Downloaded a Resource', 47, ''),
(14, 'Downloaded a Resource', 48, ''),
(15, 'Downloaded a Resource', 49, ''),
(16, 'Downloaded a Resource', 50, ''),
(17, 'Downloaded a Resource', 51, ''),
(18, 'Downloaded a Resource', 52, ''),
(19, 'Downloaded a Resource', 53, ''),
(20, 'Downloaded a Resource', 54, ''),
(21, 'Downloaded the Getting Started', 45, 'Downloaded the Getting Started'),
(22, 'Downloaded the Getting Started', 46, ''),
(23, 'Downloaded the Getting Started', 47, ''),
(24, 'Downloaded the Getting Started', 48, ''),
(25, 'Downloaded the Getting Started', 49, ''),
(26, 'Downloaded the Getting Started', 50, ''),
(27, 'Downloaded the Getting Started', 51, ''),
(28, 'Downloaded the Getting Started', 52, ''),
(29, 'Downloaded the Getting Started', 53, ''),
(30, 'Downloaded the Getting Started', 54, ''),
(31, 'Launched a featured JMC Campaign', 45, 'Launched a featured JMC Campaign'),
(32, 'Launched a featured JMC Campaign', 46, ''),
(33, 'Launched a featured JMC Campaign', 47, ''),
(34, 'Launched a featured JMC Campaign', 48, ''),
(35, 'Launched a featured JMC Campaign', 49, ''),
(36, 'Launched a featured JMC Campaign', 50, ''),
(37, 'Launched a featured JMC Campaign', 51, ''),
(38, 'Launched a featured JMC Campaign', 52, ''),
(39, 'Launched a featured JMC Campaign', 53, ''),
(40, 'Launched a featured JMC Campaign', 54, ''),
(41, 'Launched a JMC Campaign Activity', 45, 'Launched a JMC Campaign Activity'),
(42, 'Launched a JMC Campaign Activity', 46, ''),
(43, 'Launched a JMC Campaign Activity', 47, ''),
(44, 'Launched a JMC Campaign Activity', 48, ''),
(45, 'Launched a JMC Campaign Activity', 49, ''),
(46, 'Launched a JMC Campaign Activity', 50, ''),
(47, 'Launched a JMC Campaign Activity', 51, ''),
(48, 'Launched a JMC Campaign Activity', 52, ''),
(49, 'Launched a JMC Campaign Activity', 53, ''),
(50, 'Launched a JMC Campaign Activity', 54, ''),
(51, 'Registered for a Commercial Accceleration Day', 45, 'Registered for a Commercial Accceleration Day'),
(52, 'Registered for a Commercial Accceleration Day', 46, ''),
(53, 'Registered for a Commercial Accceleration Day', 47, ''),
(54, 'Registered for a Commercial Accceleration Day', 48, ''),
(55, 'Registered for a Commercial Accceleration Day', 49, ''),
(56, 'Registered for a Commercial Accceleration Day', 50, ''),
(57, 'Registered for a Commercial Accceleration Day', 51, ''),
(58, 'Registered for a Commercial Accceleration Day', 52, ''),
(59, 'Registered for a Commercial Accceleration Day', 53, ''),
(60, 'Registered for a Commercial Accceleration Day', 54, ''),
(61, 'Signup for Juniper Marketing Campaign', 45, 'Signup for Juniper Marketing Campaign'),
(62, 'Signup for Juniper Marketing Campaign', 46, ''),
(63, 'Signup for Juniper Marketing Campaign', 47, ''),
(64, 'Signup for Juniper Marketing Campaign', 48, ''),
(65, 'Signup for Juniper Marketing Campaign', 49, ''),
(66, 'Signup for Juniper Marketing Campaign', 50, ''),
(67, 'Signup for Juniper Marketing Campaign', 51, ''),
(68, 'Signup for Juniper Marketing Campaign', 52, ''),
(69, 'Signup for Juniper Marketing Campaign', 53, ''),
(70, 'Signup for Juniper Marketing Campaign', 54, ''),
(71, 'Started a JMC Campaign Activity', 45, 'Started a JMC Campaign Activity'),
(72, 'Started a JMC Campaign Activity', 46, ''),
(73, 'Started a JMC Campaign Activity', 47, ''),
(74, 'Started a JMC Campaign Activity', 48, ''),
(75, 'Started a JMC Campaign Activity', 49, ''),
(76, 'Started a JMC Campaign Activity', 50, ''),
(77, 'Started a JMC Campaign Activity', 51, ''),
(78, 'Started a JMC Campaign Activity', 52, ''),
(79, 'Started a JMC Campaign Activity', 53, ''),
(80, 'Started a JMC Campaign Activity', 54, ''),
(81, 'Started creating a BrightTALK ', 45, 'Started creating a BrightTALK '),
(82, 'Started creating a BrightTALK ', 46, ''),
(83, 'Started creating a BrightTALK ', 47, ''),
(84, 'Started creating a BrightTALK ', 48, ''),
(85, 'Started creating a BrightTALK ', 49, ''),
(86, 'Started creating a BrightTALK ', 50, ''),
(87, 'Started creating a BrightTALK ', 51, ''),
(88, 'Started creating a BrightTALK ', 52, ''),
(89, 'Started creating a BrightTALK ', 53, ''),
(90, 'Started creating a BrightTALK ', 54, ''),
(91, 'Started creating an Event', 45, 'Started creating an Event'),
(92, 'Started creating an Event', 46, ''),
(93, 'Started creating an Event', 47, ''),
(94, 'Started creating an Event', 48, ''),
(95, 'Started creating an Event', 49, ''),
(96, 'Started creating an Event', 50, ''),
(97, 'Started creating an Event', 51, ''),
(98, 'Started creating an Event', 52, ''),
(99, 'Started creating an Event', 53, ''),
(100, 'Started creating an Event', 54, ''),
(101, 'Updated Partner Profile', 45, 'Updated Partner Profile'),
(102, 'Updated Partner Profile', 46, ''),
(103, 'Updated Partner Profile', 47, ''),
(104, 'Updated Partner Profile', 48, ''),
(105, 'Updated Partner Profile', 49, ''),
(106, 'Updated Partner Profile', 50, ''),
(107, 'Updated Partner Profile', 51, ''),
(108, 'Updated Partner Profile', 52, ''),
(109, 'Updated Partner Profile', 53, ''),
(110, 'Updated Partner Profile', 54, ''),
(111, 'Uploaded a Contact List', 45, 'Uploaded a Contact List'),
(112, 'Uploaded a Contact List', 46, ''),
(113, 'Uploaded a Contact List', 47, ''),
(114, 'Uploaded a Contact List', 48, ''),
(115, 'Uploaded a Contact List', 49, ''),
(116, 'Uploaded a Contact List', 50, ''),
(117, 'Uploaded a Contact List', 51, ''),
(118, 'Uploaded a Contact List', 52, ''),
(119, 'Uploaded a Contact List', 53, ''),
(120, 'Uploaded a Contact List', 54, ''),
(121, 'Uploaded a Logo', 45, 'Uploaded a Logo'),
(122, 'Uploaded a Logo', 46, ''),
(123, 'Uploaded a Logo', 47, ''),
(124, 'Uploaded a Logo', 48, ''),
(125, 'Uploaded a Logo', 49, ''),
(126, 'Uploaded a Logo', 50, ''),
(127, 'Uploaded a Logo', 51, ''),
(128, 'Uploaded a Logo', 52, ''),
(129, 'Uploaded a Logo', 53, ''),
(130, 'Uploaded a Logo', 54, ''),
(131, 'Uploaded Profile Photo', 45, 'Uploaded Profile Photo'),
(132, 'Uploaded Profile Photo', 46, ''),
(133, 'Uploaded Profile Photo', 47, ''),
(134, 'Uploaded Profile Photo', 48, ''),
(135, 'Uploaded Profile Photo', 49, ''),
(136, 'Uploaded Profile Photo', 50, ''),
(137, 'Uploaded Profile Photo', 51, ''),
(138, 'Uploaded Profile Photo', 52, ''),
(139, 'Uploaded Profile Photo', 53, ''),
(140, 'Uploaded Profile Photo', 54, ''),
(141, 'Intermediate', 45, 'Intermediate'),
(142, 'Intermediate', 46, ''),
(143, 'Intermediate', 47, ''),
(144, 'Intermediate', 48, ''),
(145, 'Intermediate', 49, ''),
(146, 'Intermediate', 50, ''),
(147, 'Intermediate', 51, ''),
(148, 'Intermediate', 52, ''),
(149, 'Intermediate', 53, ''),
(150, 'Intermediate', 54, ''),
(151, 'Novice', 45, 'Novice'),
(152, 'Novice', 46, ''),
(153, 'Novice', 47, ''),
(154, 'Novice', 48, ''),
(155, 'Novice', 49, ''),
(156, 'Novice', 50, ''),
(157, 'Novice', 51, ''),
(158, 'Novice', 52, ''),
(159, 'Novice', 53, ''),
(160, 'Novice', 54, ''),
(161, 'Pro', 45, 'Pro'),
(162, 'Pro', 46, ''),
(163, 'Pro', 47, ''),
(164, 'Pro', 48, ''),
(165, 'Pro', 49, ''),
(166, 'Pro', 50, ''),
(167, 'Pro', 51, ''),
(168, 'Pro', 52, ''),
(169, 'Pro', 53, ''),
(170, 'Pro', 54, '');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `log_id` int(12) NOT NULL,
  `info_type` varchar(60) NOT NULL,
  `info_a` varchar(60) NOT NULL,
  `info_b` varchar(60) NOT NULL,
  `info_c` varchar(3000) NOT NULL,
  `url` varchar(500) NOT NULL,
  `ip` varchar(60) NOT NULL,
  `request` varchar(2000) NOT NULL,
  `post` varchar(2000) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE IF NOT EXISTS `logins` (
  `login_id` int(14) NOT NULL,
  `user_id` int(12) NOT NULL,
  `session_id` varchar(40) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`login_id`, `user_id`, `session_id`, `ip`, `active`, `time`) VALUES
(1, 759, 't72cac1py02tnvrzroi2p8kw7837ludg3la695g1', '127.0.0.1', 1, '2015-12-28 08:21:19'),
(2, 759, 'nlf4xy4851icq2jmenxx3wfgshtf34crt6s651nk', '127.0.0.1', 1, '2015-12-29 22:00:58'),
(3, 759, 'yhpevncjazo6rwa14w6dn9cu4qv7jpyjswl89j82', '127.0.0.1', 1, '2016-01-02 10:58:09'),
(4, 759, '52thhhn724l2365i4xq6x0bdfmehekuim8sed8nd', '127.0.0.1', 1, '2016-01-02 13:24:06'),
(5, 759, '3eeffkctvqd97s42f5vvkqc3qfjfpimyddi0xlvg', '127.0.0.1', 1, '2016-01-02 16:40:12'),
(6, 759, 'b6z4nmnhvdov8tc5espycvlpij7xqpaj43f8f3yn', '127.0.0.1', 1, '2016-01-02 18:55:41');

-- --------------------------------------------------------

--
-- Table structure for table `mdf_forms`
--

CREATE TABLE IF NOT EXISTS `mdf_forms` (
  `mdf_form_id` int(11) NOT NULL,
  `form` longtext COLLATE utf8_bin NOT NULL,
  `description` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `mdf_forms`
--

INSERT INTO `mdf_forms` (`mdf_form_id`, `form`, `description`) VALUES
(1, '[{"name":"Partner Information","fields":[{"id":"partner_contact_name","label":"Partner Contact Name","type":"text","required":1,"prefill":"user_full_name"},{"id":"partner_contact_number","label":"Partner Contact Phone","type":"text","required":1,"prefill":"user_phone","validate":{"min_length":10}},{"id":"partner_contact_email","label":"Partner Contact Email","type":"text","required":1,"prefill":"user_email","validate":{"is_email":1}}]},{"name":"Target Details","fields":[{"id":"message_topic","label":"Message Topic","type":"select","required":0,"options":[{"value":"software","label":"Software","bucket_require":"84"},{"value":"enterprise","label":"Enterprise","bucket_require":"82"},{"value":"client","label":"Client","bucket_require":"83"}]},{"id":"message_topic_client","label":"","type":"radio_group","required":0,"show_if":{"id":"message_topic","value":"client"},"groups":[{"group_name":"Productivity","options":["Notebooks","Desktops"]},{"group_name":"Mobility","options":["Tablets","Tablets 2-in-1s"]},{"group_name":"Performance","options":["Workstations","Ruggedized Systems"]}]},{"id":"message_topic_software","label":"","type":"radio_group","required":0,"show_if":{"id":"message_topic","value":"software"},"groups":[{"group_name":"Software","options":["KACE","Data Protection","SonicWALL"]}]},{"id":"message_topic_enterprise","label":"","type":"radio_group","required":0,"show_if":{"id":"message_topic","value":"enterprise"},"groups":[{"group_name":"Converged Solutions","options":["PowerEdge FX Architecture","PowerEdge VRTX","Nutanix with Citrix","EVO:Rail with VMware"]},{"group_name":"Modernize and transform the network","options":["Software-defined networking","Data center networking","Campus \\/ office networking"]},{"group_name":"Your scale to hyperscale","options":["13G PowerEdge servers","X86 Server transition"]},{"group_name":"Cloud client-computing","options":["End-to-end desktop virtualization solutions for Citrix, Microsoft, VMware and Wyse vWorkspace"]},{"group_name":"Redefining the economics of storage","options":["Flash at the price of disk","Mid-range SAN","SC4000","SC4020","Flash Leadership","SCv2000","Software-defined storage","Storage Solutions"]}]},{"id":"start_date","label":"Campaign Start Date","type":"date"},{"id":"sfdc_campaign_code","label":"SFDC Campaign Code","type":"text"},{"id":"geography","label":"Geography","type":"select","required":0,"options":[{"value":"none","label":"Please select an option"},{"value":"city_radius","label":"City Radius"},{"value":"area_codes","label":"Area Codes"}]},{"id":"state","label":"State","type":"text","show_if":{"id":"geography","value":"city_radius"}},{"id":"city","label":"City Name","type":"text","show_if":{"id":"geography","value":"city_radius"}},{"id":"radius","label":"Radius","type":"text","show_if":{"id":"geography","value":"city_radius"}},{"id":"area_codes","label":"Area Codes","type":"text","show_if":{"id":"geography","value":"area_codes"}},{"id":"employee_size","type":"checkbox_list","label":"Employee Size","options":[{"id":"employee_size_0_to_99","label":"1 - 99"},{"id":"employee_size_100_to_249","label":"100 - 249"},{"id":"employee_size_250_to_499","label":"250 - 499"},{"id":"employee_size_500_to_999","label":"500 - 999"},{"id":"employee_size_1000_to_5000","label":"1000 to 5000"}]}]}]', 'Default order form');

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE IF NOT EXISTS `meetings` (
  `meeting_id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `name` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `company` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(60) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `topic` varchar(300) NOT NULL,
  `rep` varchar(100) NOT NULL,
  `opportunity` varchar(10) NOT NULL DEFAULT '0',
  `deal_types` varchar(255) NOT NULL,
  `amount` varchar(10) NOT NULL DEFAULT '0',
  `datetime_a` datetime NOT NULL,
  `datetime_b` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`meeting_id`, `user_id`, `name`, `title`, `company`, `email`, `phone`, `city`, `state`, `topic`, `rep`, `opportunity`, `deal_types`, `amount`, `datetime_a`, `datetime_b`, `status`, `active`, `created_time`) VALUES
(13, 547, 'Christina Smith', 'CIO', 'ACME Inc', 'cs@acme.com', '8976678876', '', '', 'Meeting C-Level', 'Derick Blakely', '0', '', '0', '2014-07-15 13:00:00', '1970-01-01 00:00:00', 3, 1, '2014-07-11 20:55:15'),
(17, 558, 'michael peterson', 'manager', 'blue coat', 'michael.peterson@bluecoat.com', '123-456-7890', '', '', 'Meeting Manager', '', '0', '', '0', '2014-07-17 13:00:00', '1970-01-01 00:00:00', 0, 1, '2014-07-16 23:11:29'),
(47, 654, 'Joanne DiPaola', 'IT Manager', 'Canadian Bankers Association', 'jdipaola@cba.ca', '416-362-6092', '', '', 'Meeting Manager', '', '0', '', '0', '2014-09-10 17:00:00', '1970-01-01 00:00:00', 0, 1, '2014-09-10 13:24:19'),
(48, 565, 'Frank Stellato', 'Project Manager', 'Shoppers Drug Mart', 'fstellato@shoppersdrugmart.ca', '(416) 493-1220 x 5859', '', '', 'Meeting Manager', '', '0', '', '0', '2014-09-05 15:00:00', '1970-01-01 00:00:00', 1, 1, '2014-09-10 17:07:02'),
(49, 672, 'Jose Braz', 'IT manager', 'Itau Unibanco', 'jose.braz@itau-unibanco.com', '2482234581', '', '', 'Meeting Manager', '', '0', '', '0', '2014-09-12 13:00:00', '1970-01-01 00:00:00', 3, 1, '2014-09-12 12:51:01'),
(50, 598, 'Chris Williams', 'Infrastructure Manager', 'EM', 'rw@entermarketing.com', '212-731-2033', '', '', 'Meeting Manager', '', '0', '', '0', '2014-09-30 05:00:00', '1970-01-01 00:00:00', 1, 1, '2014-09-16 21:15:42'),
(51, 684, 'German Alfonso Castaño', 'Director Operacion Sr Gestion Aplicaciones CTS', 'Carvajal Tecnologia y Servicios', 'german.castano@carvajal.com', '572-6510550', '', '', 'Meeting C-Level', '', '0', '', '0', '2014-09-19 18:30:00', '1970-01-01 00:00:00', 0, 1, '2014-09-18 18:52:14'),
(52, 704, 'shakil shahid', 'Assistant Manager', 'TPS solution', 'shakeel.shahid@tpsonline.com', '903323000525', '', '', 'Meeting Manager', '', '0', '', '0', '2014-09-25 22:00:00', '1970-01-01 00:00:00', 1, 1, '2014-09-26 05:00:23'),
(53, 710, 'Ronald Lawrimore', 'System Manager', 'NC Blumenthal Performing Arts Center', 'Rlawrimore@ncbpac.org', '704-379-1285', '', '', 'Meeting Manager', '', '0', '', '0', '2014-09-29 16:30:00', '1970-01-01 00:00:00', 2, 1, '2014-09-30 16:32:30'),
(54, 673, 'Scott Graham', 'Manager of Network Engineering Services', 'Premier Healthcare Solutions Inc.', 'scott_graham@premierinc.com', '704.816.5283', '', '', 'Meeting Manager', '', '0', '', '0', '2014-08-15 18:00:00', '1970-01-01 00:00:00', 3, 1, '2014-10-01 14:53:09'),
(55, 722, 'Chong Gwee Kong', 'Manager', 'Singapore Telecommunications Ltd', 'gweekong@singtel.com', '96668240', '', '', 'Meeting Manager', '', '0', '', '0', '2014-10-14 18:00:00', '1970-01-01 00:00:00', 0, 1, '2014-10-20 13:28:50'),
(56, 724, 'Don Amerman', 'Chief Technology Officer', 'Blenheim Capital Management, LLC', 'damerman@blenheiminv.com', '(732) 560-6235 ', '', '', 'Meeting C-Level', '', '0', '', '0', '2014-09-24 14:00:00', '1970-01-01 00:00:00', 0, 1, '2014-10-20 13:30:29'),
(57, 734, 'Adji Adwiwidjana', 'Country Manager ', 'Blue Coat Systems indonesia ', 'adji@bluecoat.com', '628129369966', '', '', 'Meeting C-Level', '', '0', '', '0', '2014-10-21 14:00:00', '1970-01-01 00:00:00', 0, 1, '2014-10-21 15:13:51'),
(58, 740, 'Jeff Lockwood', 'Director Inrastructure and Operations', 'HealthStream', 'jeff.lockwood@healthstream.com', '6153013100', '', '', 'Meeting Manager', '', '0', '', '0', '2014-10-24 16:00:00', '1970-01-01 00:00:00', 0, 1, '2014-10-22 22:10:10'),
(59, 747, 'Gretchen Arey', 'Director IT Security', 'Air Products', 'AREYG@airproducts.com', '610.481.4525', '', '', 'Meeting Manager', '', '0', '', '0', '2014-10-20 13:00:00', '1970-01-01 00:00:00', 0, 1, '2014-10-23 21:23:15'),
(60, 634, 'Frank Fiammetta', 'Project Manager', 'Taylor Farms', 'ffiammetta@taylorfarms.com', '(831) 682-8264', '', '', 'Meeting Manager', '', '0', '', '0', '2014-10-22 13:00:00', '1970-01-01 00:00:00', 0, 1, '2014-10-23 22:22:19'),
(61, 667, 'Bob Tan', 'Vice President', 'United Overseas Bank', 'bob.tanBK@uobgroup.com', '63800257', '', '', 'Meeting Manager', '', '0', '', '0', '2014-10-24 20:00:00', '1970-01-01 00:00:00', 0, 1, '2014-10-24 06:19:23'),
(62, 710, 'Kirk Brackett', 'CIO', 'Vitalabs, Inc', 'kirk@vitalabs.com', '770-478-0007', '', '', 'Meeting C-Level', '', '0', '', '0', '2014-10-27 13:30:00', '1970-01-01 00:00:00', 2, 1, '2014-10-29 21:33:09'),
(63, 752, 'John Foley', 'IT Manager', 'Maine Medical Center', 'foleyj@mmc.org', '(207) 662-6938', '', '', 'Meeting Manager', '', '0', '', '0', '2014-09-16 17:30:00', '1970-01-01 00:00:00', 3, 1, '2014-10-31 12:46:40'),
(64, 710, 'Alain Contreras', 'Network Admin', 'Safari Ltd', 'alc@safariltd.com', '3056211000', '', '', 'Meeting Manager', '', '0', '', '0', '2014-11-13 14:00:00', '1970-01-01 00:00:00', 1, 1, '2014-11-13 17:18:57'),
(65, 851, 'Antonio Gouvea', 'Gerente de Infraestrutura', 'Serasa Experian', 'antonio.gouvea@br.experian.com', '551125997701', '', '', 'Meeting Manager', '', '0', '', '0', '2014-11-18 18:00:00', '1970-01-01 00:00:00', 0, 1, '2014-11-14 18:50:12'),
(66, 851, 'Antonio Gouvea', 'Gerente de Infraestrutura', 'Serasa Experian', 'antonio.gouvea@br.experian.com', '551125997701', '', '', 'Meeting Manager', '', '0', '', '0', '2014-11-18 18:00:00', '1970-01-01 00:00:00', 0, 1, '2014-11-14 18:50:12'),
(71, 598, 'b', 'b', 'bbb', '9@9.com', '97989898', '', '', 'Meeting C-Level', '', '0', '', '0', '2014-11-13 14:00:00', '1970-01-01 00:00:00', 0, 1, '2014-11-14 22:45:42'),
(72, 835, 'Nate Smithson', 'CIO', 'Kings Daughters Medical Center', 'Nate.Smithson@kdmc.kdhs.us', '606-408-9153', '', '', 'Meeting C-Level', '', '0', '', '0', '2014-11-18 18:30:00', '1970-01-01 00:00:00', 0, 1, '2014-11-17 22:38:19'),
(73, 756, 'Raymond Buttry', 'VP/Director Data Network Services', 'Springleaf Financial Services', 'Ray.Buttry@springleaf.com', '(812) 468-5726', '', '', 'Meeting Manager', '', '0', 'bundle', '0', '2014-11-24 20:00:00', '1970-01-01 00:00:00', 1, 1, '2014-11-25 13:32:09'),
(74, 865, 'Joni Antoni', 'Head of IT manager', 'PT. Astragraphia', 'joni.antoni@astragraphia.co.id', '62213909190', '', '', 'Meeting Manager', '', '0', '', '0', '2014-12-10 19:00:00', '1970-01-01 00:00:00', 0, 1, '2014-11-27 07:11:21'),
(75, 867, 'Silvio Monteiro', 'CIO', 'Banco Safra', 'silvio.monteiro@safra.com.br', '55-11-3175-9645', '', '', 'Meeting C-Level', '', '0', '', '0', '2014-12-01 18:00:00', '1970-01-01 00:00:00', 0, 1, '2014-11-27 18:54:08'),
(76, 759, 'John Doe', 'CTO', 'Acme', 'johndoe@acme.com', '5555555555', '', '', 'Meeting Manager', '', '0', '', '0', '2014-12-30 04:00:00', '1970-01-01 00:00:00', 3, 1, '2014-12-16 19:32:27'),
(77, 759, 'John Doe', 'Manager', 'Acme', 'jd@acmetest.com', '55555555', '', '', 'Meeting Manager', '', '0', '', '0', '2015-03-25 13:00:00', '1970-01-01 00:00:00', 3, 1, '2015-03-16 17:14:27'),
(78, 759, 'John Doe', 'Manager', 'Dell', 'test@gmail34.com', '7892374343', '', '', 'Meeting Manager', '', '0', '', '0', '2015-08-27 13:00:00', '1970-01-01 00:00:00', 3, 1, '2015-08-29 21:57:50'),
(79, 759, 'John Doe', 'test', 'test', 'test@testing.com', '7843344623', '', '', 'Meeting Manager', '', '0', '', '0', '2015-08-13 13:00:00', '1970-01-01 00:00:00', 0, 1, '2015-08-29 23:06:11'),
(80, 759, 'john doe3', 'testing', 'here', 'john.doe@gmail.com', '3432545', '', '', 'Meeting Manager', '', '0', '', '0', '2015-08-20 13:00:00', '1970-01-01 00:00:00', 0, 1, '2015-08-29 23:07:55'),
(81, 759, 'JIM JOHNSON', 'test', 'test', 'test@134.com', '2u7384732984', '', '', 'Meeting Manager', '', '0', '', '0', '2015-08-27 13:00:00', '1970-01-01 00:00:00', 3, 1, '2015-08-29 23:11:22'),
(82, 875, 'Bill Thomas', 'Manager', 'Microsoft', 'bill.thomas@test.com', '783 283 2719', '', '', 'Meeting Manager', '', '0', '', '0', '2015-08-27 13:00:00', '1970-01-01 00:00:00', 0, 1, '2015-08-30 01:54:52'),
(83, 875, 'Bill Thomas', 'Manager', 'Microsoft', 'bill.thomas@test.com', '783 283 2719', '', '', 'Meeting Manager', '', '0', '', '0', '2015-08-27 13:00:00', '1970-01-01 00:00:00', 0, 1, '2015-08-30 01:54:53'),
(84, 876, 'John Doe', 'Director', 'Intelocorp', 'jdoe@testing.com', '8392837', '', '', 'Meeting Manager', '', '0', '', '0', '2015-08-26 13:00:00', '1970-01-01 00:00:00', 3, 1, '2015-08-30 01:58:08'),
(85, 877, 'John Doe', 'test', 'test', 'test@test.com', '5545425', '', '', 'Meeting Manager', '', '0', '', '0', '2015-08-19 13:00:00', '1970-01-01 00:00:00', 3, 1, '2015-08-30 03:02:55'),
(86, 879, 'test', 'test', 'test', 'test@test1.com', '45435435', '', '', 'Meeting Manager', '', '0', '', '0', '2015-08-24 13:00:00', '1970-01-01 00:00:00', 0, 1, '2015-08-30 03:06:14'),
(87, 879, 'test 300', 'test', 'test', 'test@test34.com', '35435', '', '', 'Meeting Manager', '', '0', '', '0', '2015-08-27 13:00:00', '1970-01-01 00:00:00', 0, 1, '2015-08-30 03:06:48'),
(88, 880, 'test', 'test', 'test4', 'test@testing.com', '545345', '', '', 'Meeting Manager', '', '0', '', '0', '2015-08-31 13:00:00', '1970-01-01 00:00:00', 3, 1, '2015-08-30 03:09:31'),
(89, 880, 'test', 'test', 'test', 'test@test.com', 'test', '', '', 'Meeting Manager', '', '0', '', '0', '2015-08-12 13:00:00', '1970-01-01 00:00:00', 3, 1, '2015-08-30 03:09:51'),
(90, 880, 'test test', 'test', 'test', 'test34@test.com', '435435435', '', '', 'Meeting Manager', '', '0', '', '0', '2015-08-25 13:00:00', '1970-01-01 00:00:00', 0, 1, '2015-08-30 03:34:04'),
(91, 880, 'test', 'test', 'etst', 'test@testin23.com', '45435435', '', '', 'Meeting Manager', '', '0', '', '0', '2015-07-30 13:00:00', '1970-01-01 00:00:00', 0, 1, '2015-08-30 03:35:50'),
(92, 880, 'test', 'test', 'test', 'test@7asdasd.com', '345435t', '', '', 'Meeting Manager', '', '0', '', '0', '2015-08-24 13:00:00', '1970-01-01 00:00:00', 1, 1, '2015-08-30 03:50:49'),
(93, 881, 'Quynh', 'Luu', 'Dell Software', 'quynh.luu@software.dell.com', '650 678 9800', '', '', 'Meeting Manager', '', '0', '', '0', '2015-08-31 13:00:00', '1970-01-01 00:00:00', 0, 1, '2015-08-31 01:51:20'),
(94, 759, 'John Doe', 'test', 'test', 'test@testin34g.com', '324234', '', '', 'Meeting Manager', '', '0', '', '0', '2015-09-30 13:00:00', '1970-01-01 00:00:00', 0, 1, '2015-09-02 19:47:27'),
(95, 892, 'Mitch Doneberger', 'Head of Creative', 'MRP', 'mitch@mitch.com', '134564354', '', '', 'Meeting Manager', '', '0', '', '0', '2015-09-16 13:00:00', '1970-01-01 00:00:00', 3, 1, '2015-09-03 11:30:11');

-- --------------------------------------------------------

--
-- Table structure for table `meetings_info`
--

CREATE TABLE IF NOT EXISTS `meetings_info` (
  `meetings_info_id` int(12) NOT NULL,
  `meeting_id` int(12) NOT NULL,
  `info_type` varchar(30) NOT NULL,
  `int_info` int(12) NOT NULL,
  `info` varchar(120) NOT NULL,
  `info_b` varchar(80) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=656 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meetings_info`
--

INSERT INTO `meetings_info` (`meetings_info_id`, `meeting_id`, `info_type`, `int_info`, `info`, `info_b`, `time`) VALUES
(77, 1, 'did_poc', 1, '', '', '2014-07-11 18:55:53'),
(3, 1, 'did_transact', 1, '', '', '2014-07-06 22:15:48'),
(2, 1, 'level', 0, 'Manager', '', '2014-07-06 22:05:52'),
(76, 1, 'rep_name', 0, '111111111111111111111111111111111111111111111111111', '', '2014-07-11 18:55:53'),
(93, 2, 'amount', 0, '55555', '', '2014-07-14 13:59:08'),
(8, 2, 'did_transact', 1, '', '', '2014-07-06 23:50:28'),
(5, 2, 'level', 0, 'Manager', '', '2014-07-06 23:50:19'),
(94, 2, 'opportunity', 0, '5555', '', '2014-07-14 13:59:08'),
(95, 2, 'rep_name', 0, 'Alex', '', '2014-07-14 13:59:08'),
(16, 3, 'did_poc', 1, '', '', '2014-07-06 23:52:58'),
(13, 3, 'did_transact', 1, '', '', '2014-07-06 23:52:47'),
(10, 3, 'level', 0, 'Manager', '', '2014-07-06 23:52:07'),
(15, 3, 'opportunity', 0, '50000', '', '2014-07-06 23:52:58'),
(9, 3, 'rep_name', 0, 'john', '', '2014-07-06 23:52:07'),
(24, 4, 'amount', 0, '34543345', '', '2014-07-07 14:38:36'),
(21, 4, 'did_poc', 1, '', '', '2014-07-07 14:36:51'),
(25, 4, 'did_won', 1, '', '', '2014-07-07 14:38:36'),
(18, 4, 'level', 0, 'Manager', '', '2014-07-07 14:23:27'),
(17, 4, 'rep_name', 0, 'asdfafsda', '', '2014-07-07 14:23:27'),
(20, 5, 'level', 0, 'Manager', '', '2014-07-07 14:24:28'),
(19, 5, 'rep_name', 0, 'testtt', '', '2014-07-07 14:24:28'),
(32, 6, 'amount', 0, '10000', '', '2014-07-07 14:44:46'),
(29, 6, 'did_transact', 1, '', '', '2014-07-07 14:44:37'),
(33, 6, 'did_won', 1, '', '', '2014-07-07 14:44:46'),
(26, 6, 'level', 0, 'C-Level', '', '2014-07-07 14:44:04'),
(31, 6, 'opportunity', 0, '10000', '', '2014-07-07 14:44:46'),
(44, 7, 'amount', 0, '234234234', '', '2014-07-07 14:47:59'),
(41, 7, 'did_poc', 1, '', '', '2014-07-07 14:47:51'),
(38, 7, 'did_transact', 1, '', '', '2014-07-07 14:47:42'),
(45, 7, 'did_won', 1, '', '', '2014-07-07 14:47:59'),
(35, 7, 'level', 0, 'C-Level', '', '2014-07-07 14:47:32'),
(43, 7, 'opportunity', 0, '23454', '', '2014-07-07 14:47:59'),
(34, 7, 'rep_name', 0, '234', '', '2014-07-07 14:47:32'),
(50, 8, 'amount', 0, '5000', '', '2014-07-07 15:17:29'),
(48, 8, 'did_poc', 1, '', '', '2014-07-07 15:17:13'),
(47, 8, 'did_transact', 1, '', '', '2014-07-07 15:17:04'),
(51, 8, 'did_won', 1, '', '', '2014-07-07 15:17:29'),
(46, 8, 'level', 0, 'Manager', '', '2014-07-07 14:54:29'),
(54, 9, 'did_poc', 1, '', '', '2014-07-07 15:41:50'),
(53, 9, 'level', 0, 'Manager', '', '2014-07-07 15:41:27'),
(52, 9, 'rep_name', 0, 'asdf fdas', '', '2014-07-07 15:41:27'),
(67, 10, 'amount', 0, '25000', '', '2014-07-07 16:25:17'),
(62, 10, 'did_poc', 1, '', '', '2014-07-07 16:22:40'),
(59, 10, 'did_transact', 1, '', '', '2014-07-07 16:22:16'),
(68, 10, 'did_won', 1, '', '', '2014-07-07 16:25:17'),
(56, 10, 'level', 0, 'C-Level', '', '2014-07-07 16:21:12'),
(66, 10, 'opportunity', 0, '25000', '', '2014-07-07 16:25:17'),
(55, 10, 'rep_name', 0, 'WILL SMITH', '', '2014-07-07 16:21:12'),
(73, 11, 'did_transact', 1, '', '', '2014-07-07 17:01:53'),
(70, 11, 'level', 0, 'Manager', '', '2014-07-07 17:01:44'),
(72, 11, 'opportunity', 0, 'asdf', '', '2014-07-07 17:01:53'),
(69, 11, 'rep_name', 0, 'asdf', '', '2014-07-07 17:01:44'),
(75, 12, 'level', 0, 'C-Level', '', '2014-07-07 19:49:15'),
(74, 12, 'rep_name', 0, 'asdf', '', '2014-07-07 19:49:15'),
(91, 13, 'amount', 0, '10000', '', '2014-07-11 20:58:05'),
(87, 13, 'did_poc', 1, '', '', '2014-07-11 20:56:33'),
(83, 13, 'did_transact', 1, '', '', '2014-07-11 20:55:57'),
(92, 13, 'did_won', 1, '', '', '2014-07-11 20:58:05'),
(79, 13, 'level', 0, 'C-Level', '', '2014-07-11 20:55:15'),
(89, 13, 'opportunity', 0, '10000', '', '2014-07-11 20:58:05'),
(90, 13, 'rep_name', 0, 'Derick Blakely', '', '2014-07-11 20:58:05'),
(105, 14, 'did_poc', 1, '', '', '2014-07-14 14:02:30'),
(101, 14, 'did_transact', 1, '', '', '2014-07-14 14:02:25'),
(97, 14, 'level', 0, 'Manager', '', '2014-07-14 14:02:19'),
(106, 14, 'opportunity', 0, '55555', '', '2014-07-14 14:02:38'),
(107, 14, 'rep_name', 0, 'test', '', '2014-07-14 14:02:38'),
(125, 17, 'level', 0, 'Manager', '', '2014-07-16 23:11:29'),
(124, 17, 'rep_name', 0, 'Koji', '', '2014-07-16 23:11:29'),
(131, 18, 'did_poc', 1, '', '', '2014-07-17 17:12:34'),
(127, 18, 'level', 0, 'Manager', '', '2014-07-17 17:12:14'),
(130, 18, 'opportunity', 0, '555555', '', '2014-07-17 17:12:34'),
(129, 18, 'rep_name', 0, 'test', '', '2014-07-17 17:12:34'),
(133, 19, 'level', 0, 'Manager', '', '2014-07-17 19:54:19'),
(132, 19, 'rep_name', 0, 'test', '', '2014-07-17 19:54:19'),
(147, 22, 'level', 0, 'Manager', '', '2014-07-18 17:56:24'),
(146, 22, 'rep_name', 0, 'test', '', '2014-07-18 17:56:24'),
(184, 23, 'did_poc', 1, '', '', '2014-07-23 19:16:44'),
(149, 23, 'level', 0, 'Manager', '', '2014-07-18 18:01:00'),
(186, 23, 'rep_name', 0, 'test', '', '2014-07-23 19:16:52'),
(157, 24, 'did_poc', 1, '', '', '2014-07-21 16:32:27'),
(153, 24, 'did_transact', 1, '', '', '2014-07-21 16:31:47'),
(151, 24, 'level', 0, 'C-Level', '', '2014-07-21 16:31:24'),
(158, 24, 'opportunity', 0, '$100', '', '2014-07-21 16:32:38'),
(159, 24, 'rep_name', 0, 'NA', '', '2014-07-21 16:32:38'),
(168, 25, 'did_poc', 1, '', '', '2014-07-21 16:36:23'),
(164, 25, 'did_transact', 1, '', '', '2014-07-21 16:36:18'),
(173, 25, 'did_won', 1, '', '', '2014-07-21 16:37:07'),
(161, 25, 'level', 0, 'Manager', '', '2014-07-21 16:34:57'),
(171, 25, 'opportunity', 0, '55555', '', '2014-07-21 16:37:07'),
(172, 25, 'rep_name', 0, 'NA', '', '2014-07-21 16:37:07'),
(177, 26, 'did_not_transact', 1, '', '', '2014-07-21 20:21:07'),
(180, 26, 'did_poc', 1, '', '', '2014-07-21 20:21:17'),
(175, 26, 'level', 0, 'Manager', '', '2014-07-21 20:20:32'),
(181, 26, 'rep_name', 0, 'qweee', '', '2014-07-21 20:21:23'),
(193, 27, 'amount', 0, 'wrtg', '', '2014-07-23 19:45:49'),
(190, 27, 'did_transact', 1, '', '', '2014-07-23 19:45:38'),
(194, 27, 'did_won', 1, '', '', '2014-07-23 19:45:49'),
(188, 27, 'level', 0, 'Manager', '', '2014-07-23 19:45:30'),
(192, 27, 'rep_name', 0, 'wrtg', '', '2014-07-23 19:45:49'),
(200, 28, 'did_poc', 1, '', '', '2014-07-28 21:48:00'),
(198, 28, 'did_transact', 1, '', '', '2014-07-28 21:46:43'),
(196, 28, 'level', 0, 'Manager', '', '2014-07-28 21:46:25'),
(201, 28, 'rep_name', 0, 'fabio test', '', '2014-07-28 21:48:09'),
(211, 29, 'did_poc', 1, '', '', '2014-08-13 17:06:14'),
(207, 29, 'did_transact', 1, '', '', '2014-08-13 17:06:09'),
(203, 29, 'level', 0, 'C-Level', '', '2014-08-13 17:05:41'),
(212, 29, 'opportunity', 0, '10000', '', '2014-08-13 17:06:18'),
(213, 29, 'rep_name', 0, 'John', '', '2014-08-13 17:06:18'),
(215, 30, 'level', 0, 'Manager', '', '2014-08-13 17:16:24'),
(214, 30, 'rep_name', 0, 'test', '', '2014-08-13 17:16:24'),
(254, 34, 'did_poc', 1, '', '', '2014-08-27 15:55:53'),
(250, 34, 'did_transact', 1, '', '', '2014-08-27 15:55:47'),
(246, 34, 'level', 0, 'Manager', '', '2014-08-27 15:55:36'),
(255, 34, 'opportunity', 0, '5555555', '', '2014-08-27 15:56:00'),
(256, 34, 'rep_name', 0, 'here!', '', '2014-08-27 15:56:00'),
(258, 35, 'level', 0, 'Manager', '', '2014-08-27 15:57:29'),
(257, 35, 'rep_name', 0, 'fabio rep', '', '2014-08-27 15:57:29'),
(270, 36, 'did_poc', 1, '', '', '2014-08-27 16:33:10'),
(266, 36, 'did_transact', 1, '', '', '2014-08-27 16:33:07'),
(260, 36, 'level', 0, 'Manager', '', '2014-08-27 16:32:27'),
(271, 36, 'opportunity', 0, '5555555', '', '2014-08-27 16:33:13'),
(272, 36, 'rep_name', 0, 'test', '', '2014-08-27 16:33:13'),
(286, 37, 'did_poc', 1, '', '', '2014-08-27 16:34:34'),
(282, 37, 'did_transact', 1, '', '', '2014-08-27 16:34:22'),
(262, 37, 'level', 0, 'C-Level', '', '2014-08-27 16:32:45'),
(287, 37, 'opportunity', 0, '555555', '', '2014-08-27 16:34:37'),
(288, 37, 'rep_name', 0, 'yest', '', '2014-08-27 16:34:37'),
(292, 38, 'amount', 0, '5555555', '', '2014-08-27 16:34:49'),
(278, 38, 'did_transact', 1, '', '', '2014-08-27 16:34:05'),
(293, 38, 'did_won', 1, '', '', '2014-08-27 16:34:49'),
(274, 38, 'level', 0, 'Manager', '', '2014-08-27 16:33:48'),
(290, 38, 'opportunity', 0, 'test!', '', '2014-08-27 16:34:49'),
(291, 38, 'rep_name', 0, 'test', '', '2014-08-27 16:34:49'),
(303, 39, 'did_poc', 1, '', '', '2014-08-27 18:10:19'),
(299, 39, 'did_transact', 1, '', '', '2014-08-27 18:09:45'),
(295, 39, 'level', 0, 'C-Level', '', '2014-08-27 18:09:36'),
(302, 39, 'opportunity', 0, '500000', '', '2014-08-27 18:10:19'),
(301, 39, 'rep_name', 0, 'test', '', '2014-08-27 18:10:18'),
(315, 40, 'amount', 0, '$500,000', '', '2014-08-27 21:15:05'),
(310, 40, 'did_poc', 1, '', '', '2014-08-27 21:14:31'),
(307, 40, 'did_transact', 1, '', '', '2014-08-27 21:13:36'),
(314, 40, 'did_won', 1, '', '', '2014-08-27 21:15:01'),
(305, 40, 'level', 0, 'Manager', '', '2014-08-27 21:12:22'),
(316, 40, 'rep_name', 0, 'sdafddfs', '', '2014-08-27 21:15:05'),
(322, 41, 'did_poc', 1, '', '', '2014-08-28 15:07:22'),
(320, 41, 'did_transact', 1, '', '', '2014-08-28 15:07:11'),
(318, 41, 'level', 0, 'Manager', '', '2014-08-28 14:58:30'),
(321, 41, 'rep_name', 0, 'qerf', '', '2014-08-28 15:07:22'),
(328, 42, 'did_poc', 1, '', '', '2014-08-28 15:27:10'),
(326, 42, 'did_transact', 1, '', '', '2014-08-28 15:26:56'),
(324, 42, 'level', 0, 'Manager', '', '2014-08-28 15:26:47'),
(329, 42, 'rep_name', 0, 'wrthwtrh', '', '2014-08-28 15:27:34'),
(339, 43, 'did_poc', 1, '', '', '2014-08-28 18:09:54'),
(341, 43, 'did_transact', 1, '', '', '2014-08-28 18:09:54'),
(331, 43, 'level', 0, 'Manager', '', '2014-08-28 15:35:17'),
(340, 43, 'opportunity', 0, '123', '', '2014-08-28 18:09:54'),
(337, 43, 'rep_name', 0, 'etyh', '', '2014-08-28 18:09:54'),
(343, 44, 'level', 0, 'Manager', '', '2014-08-28 19:59:09'),
(342, 44, 'rep_name', 0, 'tester', '', '2014-08-28 19:59:09'),
(345, 45, 'level', 0, 'Manager', '', '2014-08-28 20:02:52'),
(344, 45, 'rep_name', 0, 'wtrg', '', '2014-08-28 20:02:52'),
(347, 46, 'level', 0, 'Manager', '', '2014-08-29 15:05:44'),
(346, 46, 'rep_name', 0, 'test', '', '2014-08-29 15:05:44'),
(349, 47, 'level', 0, 'Manager', '', '2014-09-10 13:24:19'),
(348, 47, 'rep_name', 0, 'Leanne Sharpe', '', '2014-09-10 13:24:19'),
(355, 48, 'did_transact', 1, '', '', '2014-09-10 17:07:41'),
(351, 48, 'level', 0, 'Manager', '', '2014-09-10 17:07:02'),
(354, 48, 'opportunity', 0, '10000', '', '2014-09-10 17:07:41'),
(353, 48, 'rep_name', 0, 'Barry DeWitt', '', '2014-09-10 17:07:41'),
(369, 49, 'amount', 0, '87000', '', '2014-09-12 15:36:22'),
(366, 49, 'did_poc', 1, '', '', '2014-09-12 15:36:21'),
(368, 49, 'did_transact', 1, '', '', '2014-09-12 15:36:21'),
(370, 49, 'did_won', 1, '', '', '2014-09-12 15:36:22'),
(357, 49, 'level', 0, 'Manager', '', '2014-09-12 12:51:01'),
(367, 49, 'opportunity', 0, '87000', '', '2014-09-12 15:36:21'),
(364, 49, 'rep_name', 0, 'Chris Dailey', '', '2014-09-12 15:36:21'),
(440, 50, 'did_transact', 1, '', '', '2014-11-07 20:14:00'),
(372, 50, 'level', 0, 'Manager', '', '2014-09-16 21:15:42'),
(503, 50, 'opportunity', 0, '345000', '', '2014-11-14 22:38:46'),
(504, 50, 'rep_name', 0, 'Johnny', '', '2014-11-14 22:38:46'),
(374, 51, 'level', 0, 'C-Level', '', '2014-09-18 18:52:14'),
(373, 51, 'rep_name', 0, 'Jairo Parra', '', '2014-09-18 18:52:14'),
(380, 52, 'did_transact', 1, '', '', '2014-09-26 05:01:08'),
(376, 52, 'level', 0, 'Manager', '', '2014-09-26 05:00:23'),
(379, 52, 'opportunity', 0, '23000', '', '2014-09-26 05:01:08'),
(378, 52, 'rep_name', 0, 'Anas Azam', '', '2014-09-26 05:01:08'),
(399, 53, 'did_poc', 1, '', '', '2014-10-09 20:57:27'),
(401, 53, 'did_transact', 1, '', '', '2014-10-09 20:57:27'),
(382, 53, 'level', 0, 'Manager', '', '2014-09-30 16:32:30'),
(400, 53, 'opportunity', 0, '$30000', '', '2014-10-09 20:57:27'),
(395, 53, 'rep_name', 0, 'Mike Burgoyne', '', '2014-10-09 20:57:27'),
(392, 54, 'amount', 0, '$475,000', '', '2014-10-01 15:00:35'),
(388, 54, 'did_transact', 1, '', '', '2014-10-01 15:00:00'),
(393, 54, 'did_won', 1, '', '', '2014-10-01 15:00:35'),
(384, 54, 'level', 0, 'Manager', '', '2014-10-01 14:53:09'),
(390, 54, 'opportunity', 0, '$475,000', '', '2014-10-01 15:00:35'),
(391, 54, 'rep_name', 0, 'Tim Obrien', '', '2014-10-01 15:00:35'),
(403, 55, 'level', 0, 'Manager', '', '2014-10-20 13:28:50'),
(402, 55, 'rep_name', 0, 'Alison Heng', '', '2014-10-20 13:28:50'),
(405, 56, 'level', 0, 'C-Level', '', '2014-10-20 13:30:29'),
(404, 56, 'rep_name', 0, 'Scott Wolf', '', '2014-10-20 13:30:29'),
(407, 57, 'level', 0, 'C-Level', '', '2014-10-21 15:13:51'),
(406, 57, 'rep_name', 0, 'Aryo Prakoso ', '', '2014-10-21 15:13:51'),
(409, 58, 'level', 0, 'Manager', '', '2014-10-22 22:10:10'),
(408, 58, 'rep_name', 0, 'Tim O''Brien', '', '2014-10-22 22:10:10'),
(411, 59, 'level', 0, 'Manager', '', '2014-10-23 21:23:15'),
(410, 59, 'rep_name', 0, 'Vince Trovarelli', '', '2014-10-23 21:23:15'),
(413, 60, 'level', 0, 'Manager', '', '2014-10-23 22:22:19'),
(412, 60, 'rep_name', 0, 'Sevi Boisvert', '', '2014-10-23 22:22:19'),
(415, 61, 'level', 0, 'Manager', '', '2014-10-24 06:19:23'),
(414, 61, 'rep_name', 0, 'Doris Yeo & Edwin Poon', '', '2014-10-24 06:19:23'),
(423, 62, 'did_poc', 1, '', '', '2014-10-29 21:33:52'),
(425, 62, 'did_transact', 1, '', '', '2014-10-29 21:33:52'),
(417, 62, 'level', 0, 'C-Level', '', '2014-10-29 21:33:09'),
(424, 62, 'opportunity', 0, '$30000', '', '2014-10-29 21:33:52'),
(419, 62, 'rep_name', 0, 'Mike Burgoyne', '', '2014-10-29 21:33:52'),
(435, 63, 'amount', 0, '$150K', '', '2014-10-31 12:49:11'),
(431, 63, 'did_transact', 1, '', '', '2014-10-31 12:48:33'),
(436, 63, 'did_won', 1, '', '', '2014-10-31 12:49:11'),
(427, 63, 'level', 0, 'Manager', '', '2014-10-31 12:46:40'),
(433, 63, 'opportunity', 0, 'SG900 - $140K', '', '2014-10-31 12:49:11'),
(434, 63, 'rep_name', 0, 'Patrick Mathews', '', '2014-10-31 12:49:11'),
(446, 64, 'did_transact', 1, '', '', '2014-11-13 17:19:38'),
(442, 64, 'level', 0, 'Manager', '', '2014-11-13 17:18:57'),
(445, 64, 'opportunity', 0, '15000', '', '2014-11-13 17:19:38'),
(444, 64, 'rep_name', 0, 'Mike Burgoyne', '', '2014-11-13 17:19:38'),
(449, 65, 'level', 0, 'Manager', '', '2014-11-14 18:50:12'),
(447, 65, 'rep_name', 0, 'Rogerio Macedo', '', '2014-11-14 18:50:12'),
(450, 66, 'level', 0, 'Manager', '', '2014-11-14 18:50:12'),
(448, 66, 'rep_name', 0, 'Rogerio Macedo', '', '2014-11-14 18:50:12'),
(459, 67, 'did_poc', 1, '', '', '2014-11-14 21:49:32'),
(461, 67, 'did_transact', 1, '', '', '2014-11-14 21:49:32'),
(452, 67, 'level', 0, 'Manager', '', '2014-11-14 21:49:21'),
(453, 67, 'notes', 0, 'test', '', '2014-11-14 21:49:31'),
(460, 67, 'opportunity', 0, '555', '', '2014-11-14 21:49:32'),
(455, 67, 'rep_name', 0, 'test', '', '2014-11-14 21:49:31'),
(474, 68, 'amount', 0, '1000000', '', '2014-11-14 21:53:21'),
(471, 68, 'did_poc', 1, '', '', '2014-11-14 21:53:21'),
(473, 68, 'did_transact', 1, '', '', '2014-11-14 21:53:21'),
(475, 68, 'did_won', 1, '', '', '2014-11-14 21:53:21'),
(463, 68, 'level', 0, 'Manager', '', '2014-11-14 21:52:53'),
(465, 68, 'notes', 0, 'test notes', '', '2014-11-14 21:53:21'),
(472, 68, 'opportunity', 0, '1000000 ', '', '2014-11-14 21:53:21'),
(467, 68, 'rep_name', 0, 'test', '', '2014-11-14 21:53:21'),
(486, 69, 'amount', 0, '980000', '', '2014-11-14 22:00:04'),
(480, 69, 'did_poc', 1, '', '', '2014-11-14 21:55:20'),
(481, 69, 'did_transact', 1, '', '', '2014-11-14 21:55:20'),
(487, 69, 'did_won', 1, '', '', '2014-11-14 22:00:04'),
(477, 69, 'level', 0, 'C-Level', '', '2014-11-14 21:54:49'),
(485, 69, 'rep_name', 0, 'd', '', '2014-11-14 22:00:04'),
(500, 70, 'did_poc', 1, '', '', '2014-11-14 22:31:57'),
(502, 70, 'did_transact', 1, '', '', '2014-11-14 22:31:58'),
(489, 70, 'level', 0, 'Manager', '', '2014-11-14 22:31:41'),
(494, 70, 'notes', 0, 'test', '', '2014-11-14 22:31:57'),
(501, 70, 'opportunity', 0, '555555', '', '2014-11-14 22:31:58'),
(496, 70, 'rep_name', 0, 'test', '', '2014-11-14 22:31:57'),
(507, 71, 'did_not_transact', 1, '', '', '2014-11-14 22:45:58'),
(506, 71, 'level', 0, 'C-Level', '', '2014-11-14 22:45:42'),
(508, 71, 'rep_name', 0, 'kh', '', '2014-11-14 22:45:58'),
(510, 72, 'level', 0, 'C-Level', '', '2014-11-17 22:38:19'),
(509, 72, 'rep_name', 0, 'Katie Nye', '', '2014-11-17 22:38:19'),
(517, 73, 'did_transact', 1, '', '', '2014-11-25 14:33:26'),
(512, 73, 'level', 0, 'Manager', '', '2014-11-25 13:32:09'),
(513, 73, 'notes', 0, 'Refresh from ProxySG810-10s/ProxyAV combo.', '', '2014-11-25 14:33:26'),
(516, 73, 'opportunity', 0, '$496,000.00', '', '2014-11-25 14:33:26'),
(515, 73, 'rep_name', 0, 'Martin TePoele', '', '2014-11-25 14:33:26'),
(519, 74, 'level', 0, 'Manager', '', '2014-11-27 07:11:21'),
(518, 74, 'rep_name', 0, 'Stephanos', '', '2014-11-27 07:11:21'),
(521, 75, 'level', 0, 'C-Level', '', '2014-11-27 18:54:08'),
(520, 75, 'rep_name', 0, 'Rogerio Macedo', '', '2014-11-27 18:54:08'),
(549, 76, 'amount', 0, '$80000', '', '2015-08-29 17:00:30'),
(545, 76, 'did_transact', 1, '', '', '2015-08-29 17:00:04'),
(550, 76, 'did_won', 1, '', '', '2015-08-29 17:00:30'),
(523, 76, 'level', 0, 'Manager', '', '2014-12-16 19:32:27'),
(547, 76, 'opportunity', 0, '$50000', '', '2015-08-29 17:00:30'),
(548, 76, 'rep_name', 0, 'Bill Thomas', '', '2015-08-29 17:00:30'),
(539, 77, 'amount', 0, '40000000', '', '2015-06-26 17:51:56'),
(534, 77, 'did_poc', 1, '', '', '2015-06-25 19:41:24'),
(536, 77, 'did_transact', 1, '', '', '2015-06-25 19:41:24'),
(538, 77, 'did_won', 1, '', '', '2015-06-25 19:41:25'),
(525, 77, 'level', 0, 'Manager', '', '2015-03-16 17:14:27'),
(540, 77, 'opportunity', 0, '$50000', '', '2015-06-26 17:51:56'),
(541, 77, 'rep_name', 0, 'Alex', '', '2015-06-26 17:51:56'),
(563, 78, 'amount', 0, '$40000', '', '2015-08-29 21:58:46'),
(559, 78, 'did_transact', 1, '', '', '2015-08-29 21:58:29'),
(564, 78, 'did_won', 1, '', '', '2015-08-29 21:58:46'),
(552, 78, 'level', 0, 'Manager', '', '2015-08-29 21:57:50'),
(561, 78, 'opportunity', 0, '$5000', '', '2015-08-29 21:58:45'),
(562, 78, 'rep_name', 0, '783472', '', '2015-08-29 21:58:45'),
(566, 79, 'level', 0, 'Manager', '', '2015-08-29 23:06:11'),
(565, 79, 'rep_name', 0, '3246', '', '2015-08-29 23:06:11'),
(568, 80, 'level', 0, 'Manager', '', '2015-08-29 23:07:55'),
(567, 80, 'rep_name', 0, '34356', '', '2015-08-29 23:07:55'),
(578, 81, 'amount', 0, '$20000', '', '2015-08-29 23:11:53'),
(574, 81, 'did_transact', 1, '', '', '2015-08-29 23:11:37'),
(579, 81, 'did_won', 1, '', '', '2015-08-29 23:11:53'),
(570, 81, 'level', 0, 'Manager', '', '2015-08-29 23:11:22'),
(576, 81, 'opportunity', 0, '5000', '', '2015-08-29 23:11:53'),
(577, 81, 'rep_name', 0, '345', '', '2015-08-29 23:11:53'),
(581, 82, 'level', 0, 'Manager', '', '2015-08-30 01:54:52'),
(580, 82, 'rep_name', 0, '3483', '', '2015-08-30 01:54:52'),
(583, 83, 'level', 0, 'Manager', '', '2015-08-30 01:54:53'),
(582, 83, 'rep_name', 0, '3483', '', '2015-08-30 01:54:53'),
(593, 84, 'amount', 0, '50000', '', '2015-08-30 02:04:36'),
(589, 84, 'did_transact', 1, '', '', '2015-08-30 01:59:17'),
(594, 84, 'did_won', 1, '', '', '2015-08-30 02:04:36'),
(585, 84, 'level', 0, 'Manager', '', '2015-08-30 01:58:08'),
(591, 84, 'opportunity', 0, '$5000', '', '2015-08-30 02:04:36'),
(592, 84, 'rep_name', 0, '3452', '', '2015-08-30 02:04:36'),
(604, 85, 'amount', 0, '$50000', '', '2015-08-30 03:04:50'),
(600, 85, 'did_transact', 1, '', '', '2015-08-30 03:03:15'),
(605, 85, 'did_won', 1, '', '', '2015-08-30 03:04:50'),
(596, 85, 'level', 0, 'Manager', '', '2015-08-30 03:02:55'),
(602, 85, 'opportunity', 0, '5000', '', '2015-08-30 03:04:50'),
(603, 85, 'rep_name', 0, '435435', '', '2015-08-30 03:04:50'),
(607, 86, 'level', 0, 'Manager', '', '2015-08-30 03:06:14'),
(606, 86, 'rep_name', 0, '2324', '', '2015-08-30 03:06:14'),
(609, 87, 'level', 0, 'Manager', '', '2015-08-30 03:06:48'),
(608, 87, 'rep_name', 0, 't34', '', '2015-08-30 03:06:48'),
(630, 88, 'amount', 0, '$60000', '', '2015-08-30 03:11:31'),
(621, 88, 'did_transact', 1, '', '', '2015-08-30 03:11:04'),
(631, 88, 'did_won', 1, '', '', '2015-08-30 03:11:31'),
(611, 88, 'level', 0, 'Manager', '', '2015-08-30 03:09:31'),
(628, 88, 'opportunity', 0, '$24000', '', '2015-08-30 03:11:30'),
(629, 88, 'rep_name', 0, '435435', '', '2015-08-30 03:11:30'),
(625, 89, 'amount', 0, '$1000000', '', '2015-08-30 03:11:15'),
(617, 89, 'did_transact', 1, '', '', '2015-08-30 03:10:30'),
(626, 89, 'did_won', 1, '', '', '2015-08-30 03:11:15'),
(613, 89, 'level', 0, 'Manager', '', '2015-08-30 03:09:51'),
(623, 89, 'opportunity', 0, '$50000', '', '2015-08-30 03:11:14'),
(624, 89, 'rep_name', 0, '345435', '', '2015-08-30 03:11:14'),
(633, 90, 'level', 0, 'Manager', '', '2015-08-30 03:34:04'),
(632, 90, 'rep_name', 0, '45435', '', '2015-08-30 03:34:04'),
(635, 91, 'level', 0, 'Manager', '', '2015-08-30 03:35:50'),
(634, 91, 'rep_name', 0, 'test', '', '2015-08-30 03:35:50'),
(641, 92, 'did_transact', 1, '', '', '2015-08-30 03:57:07'),
(637, 92, 'level', 0, 'Manager', '', '2015-08-30 03:50:49'),
(640, 92, 'opportunity', 0, 't325', '', '2015-08-30 03:57:07'),
(639, 92, 'rep_name', 0, 'test', '', '2015-08-30 03:57:07'),
(643, 93, 'level', 0, 'Manager', '', '2015-08-31 01:51:20'),
(642, 93, 'rep_name', 0, '5678912', '', '2015-08-31 01:51:20'),
(644, 94, 'level', 0, 'Manager', '', '2015-09-02 19:47:27'),
(653, 95, 'amount', 0, '28500', '', '2015-09-03 11:46:04'),
(648, 95, 'did_transact', 1, '', '', '2015-09-03 11:45:31'),
(652, 95, 'did_won', 1, '', '', '2015-09-03 11:45:56'),
(645, 95, 'level', 0, 'Manager', '', '2015-09-03 11:30:11'),
(654, 95, 'opportunity', 0, '25000', '', '2015-09-03 11:46:04'),
(655, 95, 'rep_name', 0, '23456543', '', '2015-09-03 11:46:04');

-- --------------------------------------------------------

--
-- Table structure for table `meeting_requested`
--

CREATE TABLE IF NOT EXISTS `meeting_requested` (
  `meeting_requested_id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `trivia_id` int(12) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meeting_requested`
--

INSERT INTO `meeting_requested` (`meeting_requested_id`, `user_id`, `trivia_id`, `active`, `datetime`) VALUES
(15, 197, 0, 1, '2013-11-21 00:46:24'),
(16, 200, 0, 1, '2013-11-21 01:03:29'),
(17, 202, 0, 1, '2013-11-21 02:06:22'),
(18, 199, 0, 1, '2013-11-21 02:06:26'),
(19, 198, 0, 1, '2013-11-21 16:37:57'),
(20, 201, 0, 1, '2013-11-21 16:38:01'),
(21, 14, 0, 1, '2013-11-21 16:44:14'),
(22, 122, 0, 1, '2013-11-21 18:20:11'),
(23, 266, 0, 1, '2013-11-21 18:20:16'),
(24, 65, 0, 1, '2013-11-21 18:20:19'),
(25, 243, 0, 1, '2013-11-21 18:20:20'),
(26, 142, 0, 1, '2013-11-21 18:20:23'),
(27, 83, 0, 1, '2013-11-21 18:20:29'),
(28, 242, 0, 1, '2013-11-21 18:20:29'),
(29, 129, 0, 1, '2013-11-21 18:20:33'),
(30, 260, 0, 1, '2013-11-21 18:20:34'),
(31, 52, 0, 1, '2013-11-21 18:20:35'),
(32, 22, 0, 1, '2013-11-21 18:20:37'),
(33, 195, 0, 1, '2013-11-21 18:21:08');

-- --------------------------------------------------------

--
-- Table structure for table `notify`
--

CREATE TABLE IF NOT EXISTS `notify` (
  `notify_id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `msg` varchar(800) NOT NULL,
  `int_other` int(12) NOT NULL,
  `other` varchar(80) NOT NULL,
  `other_b` varchar(80) NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=283 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notify`
--

INSERT INTO `notify` (`notify_id`, `user_id`, `subject`, `msg`, `int_other`, `other`, `other_b`, `seen`, `active`, `time`) VALUES
(1, 12, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 1, 1, '2013-10-31 18:36:15'),
(2, 40, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 1, 1, '2013-11-05 19:29:02'),
(3, 47, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 0, 1, '2013-11-06 12:43:06'),
(4, 52, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 1, 1, '2013-11-08 17:15:38'),
(5, 65, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 1, 1, '2013-11-11 21:07:31'),
(6, 64, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 1, 1, '2013-11-11 21:24:40'),
(7, 73, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 0, 1, '2013-11-11 22:59:27'),
(8, 79, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 1, 1, '2013-11-11 23:25:15'),
(9, 80, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 1, 1, '2013-11-12 00:11:31'),
(10, 95, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 0, 1, '2013-11-12 13:36:10'),
(11, 99, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 0, 1, '2013-11-12 16:55:47'),
(12, 100, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 1, 1, '2013-11-12 17:35:41'),
(13, 16, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 1, 1, '2013-11-13 20:58:43'),
(14, 112, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 1, 1, '2013-11-14 18:43:50'),
(15, 122, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 1, 1, '2013-11-14 18:54:37'),
(16, 120, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 0, 1, '2013-11-14 19:23:09'),
(17, 135, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 1, 1, '2013-11-14 20:20:55'),
(18, 32, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 1, 1, '2013-11-15 18:18:53'),
(19, 14, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 1, 1, '2013-11-15 18:39:50'),
(20, 157, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 1, 1, '2013-11-17 01:33:50'),
(21, 162, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 0, 1, '2013-11-17 03:44:05'),
(22, 173, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 0, 1, '2013-11-18 01:21:42'),
(23, 177, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 1, 1, '2013-11-18 13:21:14'),
(24, 180, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 1, 1, '2013-11-18 14:14:15'),
(25, 196, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 1, 1, '2013-11-20 08:02:00'),
(26, 198, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 0, 1, '2013-11-20 20:18:56'),
(27, 201, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 0, 1, '2013-11-20 20:29:43'),
(28, 207, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 1, 1, '2013-11-20 22:04:24'),
(29, 211, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 1, 1, '2013-11-20 23:58:51'),
(30, 201, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 01:15:10'),
(31, 201, '', 'You''ve moved up to <b>Intermediate</b> rank!', -1, '', '', 0, 1, '2013-11-21 01:15:11'),
(32, 201, '', 'You''ve moved up to <b>Master</b> rank!', -1, '', '', 0, 1, '2013-11-21 01:15:11'),
(33, 202, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 0, 1, '2013-11-21 01:32:47'),
(34, 199, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 0, 1, '2013-11-21 01:33:08'),
(35, 202, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 01:42:36'),
(36, 199, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 01:42:50'),
(37, 202, '', 'You''ve moved up to <b>Intermediate</b> rank!', -1, '', '', 0, 1, '2013-11-21 01:43:23'),
(38, 199, '', 'You''ve moved up to <b>Intermediate</b> rank!', -1, '', '', 0, 1, '2013-11-21 01:44:20'),
(39, 202, '', 'You''ve moved up to <b>Master</b> rank!', -1, '', '', 0, 1, '2013-11-21 01:44:29'),
(40, 199, '', 'You''ve moved up to <b>Master</b> rank!', -1, '', '', 0, 1, '2013-11-21 01:45:16'),
(41, 213, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 1, 1, '2013-11-21 13:18:45'),
(42, 127, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 0, 1, '2013-11-21 13:27:48'),
(43, 214, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 1, 1, '2013-11-21 14:04:07'),
(44, 136, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 1, 1, '2013-11-21 15:38:36'),
(45, 216, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 1, 1, '2013-11-21 15:48:42'),
(46, 204, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 0, 1, '2013-11-21 16:19:48'),
(47, 200, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 16:28:45'),
(48, 200, '', 'You''ve moved up to <b>Intermediate</b> rank!', -1, '', '', 0, 1, '2013-11-21 16:33:14'),
(49, 198, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 16:35:05'),
(50, 200, '', 'You''ve moved up to <b>Master</b> rank!', -1, '', '', 0, 1, '2013-11-21 16:36:25'),
(51, 14, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 16:37:19'),
(52, 226, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 0, 1, '2013-11-21 17:52:15'),
(53, 230, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 0, 1, '2013-11-21 17:52:47'),
(54, 190, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 0, 1, '2013-11-21 17:52:51'),
(55, 241, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 0, 1, '2013-11-21 17:53:29'),
(56, 54, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 0, 1, '2013-11-21 17:53:43'),
(57, 248, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 0, 1, '2013-11-21 17:55:39'),
(58, 124, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 0, 1, '2013-11-21 17:56:16'),
(59, 16, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 0, 1, '2013-11-21 17:57:35'),
(60, 260, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 0, 1, '2013-11-21 18:02:01'),
(61, 261, '', 'You earned the <b>Smarty Pants</b> badge!', -1, '', '', 0, 1, '2013-11-21 18:03:22'),
(62, 22, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:13:55'),
(63, 261, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:14:48'),
(64, 260, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:14:48'),
(65, 121, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:15:34'),
(66, 196, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:16:15'),
(67, 88, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:16:16'),
(68, 83, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:16:16'),
(69, 187, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:16:52'),
(70, 213, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:17:19'),
(71, 127, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:17:21'),
(72, 30, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:17:21'),
(73, 226, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:17:21'),
(74, 230, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:17:21'),
(75, 18, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:17:21'),
(76, 229, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:17:21'),
(77, 191, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:17:21'),
(78, 124, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:17:22'),
(79, 269, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:17:22'),
(80, 261, '', 'You''ve moved up to <b>Intermediate</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:17:56'),
(81, 52, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:17:57'),
(82, 22, '', 'You''ve moved up to <b>Intermediate</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:18:01'),
(83, 242, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:18:23'),
(84, 121, '', 'You''ve moved up to <b>Intermediate</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:18:44'),
(85, 265, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:18:45'),
(86, 129, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:18:45'),
(87, 216, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:18:46'),
(88, 273, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:18:46'),
(89, 266, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:18:47'),
(90, 87, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:18:47'),
(91, 260, '', 'You''ve moved up to <b>Intermediate</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:18:47'),
(92, 190, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:19:14'),
(93, 83, '', 'You''ve moved up to <b>Intermediate</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:19:14'),
(94, 122, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:19:15'),
(95, 187, '', 'You''ve moved up to <b>Intermediate</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:19:16'),
(96, 239, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:19:16'),
(97, 65, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:19:17'),
(98, 263, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:19:19'),
(99, 127, '', 'You''ve moved up to <b>Intermediate</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:19:38'),
(100, 261, '', 'You''ve moved up to <b>Master</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:19:38'),
(101, 213, '', 'You''ve moved up to <b>Intermediate</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:19:40'),
(102, 228, '', 'You''ve moved up to <b>Novice</b> rank!', -1, '', '', 0, 1, '2013-11-21 18:19:42'),
(103, 14, '', 'You''ve moved up to <b>Intermediate</b> rank!', -1, '', '', 0, 1, '2013-12-27 18:18:46'),
(111, 538, '', 'You''ve moved up to <b>Newbie</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Newbie+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Newbie level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-07-03 18:04:01'),
(114, 539, '', 'You''ve moved up to <b>Newbie</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Newbie+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Newbie level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-07-07 14:36:51'),
(115, 539, '', 'You''ve moved up to <b>Novice</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Novice+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Novice level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-07-07 14:38:36'),
(116, 539, '', 'You''ve moved up to <b>Intermediate</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Intermediate+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Intermediate level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-07-07 14:47:42'),
(117, 539, '', 'You''ve moved up to <b>Master</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Master+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Master level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-07-07 15:17:29'),
(119, 542, '', 'You''ve moved up to <b>Newbie</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Newbie+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Newbie level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-07-07 16:21:12'),
(120, 542, '', 'You''ve moved up to <b>Novice</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Novice+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Novice level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-07-07 16:22:40'),
(121, 547, '', 'You''ve moved up to <b>Newbie</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Newbie+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Newbie level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-07-11 20:55:15'),
(122, 547, '', 'You''ve moved up to <b>Novice</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Novice+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Novice level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-07-11 20:56:33'),
(124, 548, '', 'You''ve moved up to <b>Newbie</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Newbie+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Newbie level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-07-14 12:15:46'),
(126, 552, '', 'You''ve moved up to <b>Newbie</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Newbie+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Newbie level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-07-14 16:31:13'),
(127, 552, '', 'You''ve moved up to <b>Novice</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Novice+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Novice level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-07-14 16:31:44'),
(129, 552, '', 'You''ve moved up to <b>Intermediate</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Intermediate+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Intermediate level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-07-18 03:19:51'),
(135, 552, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-08-12 20:20:57'),
(139, 572, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-08-26 23:03:05'),
(140, 572, '', 'You''ve moved up to <b>Novice Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Novice+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Novice Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-08-26 23:05:19'),
(141, 572, '', 'You''ve moved up to <b>Intermediate Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Intermediate+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Intermediate Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-08-27 15:19:50'),
(146, 524, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-08-27 21:14:31'),
(147, 524, '', 'You''ve moved up to <b>Novice Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Novice+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Novice Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-08-27 21:15:03'),
(148, 524, '', 'You''ve moved up to <b>Intermediate Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Intermediate+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Intermediate Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-08-28 18:09:54'),
(149, 599, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-09-07 12:20:45'),
(150, 639, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-09-10 02:18:59'),
(151, 642, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-09-10 02:35:34'),
(152, 643, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-09-10 02:51:49'),
(153, 644, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-09-10 02:54:49'),
(154, 645, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-09-10 05:52:18'),
(155, 594, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-09-10 06:55:08'),
(156, 664, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-09-10 23:04:35'),
(157, 672, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-09-12 15:36:21'),
(158, 672, '', 'You''ve moved up to <b>Novice Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Novice+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Novice Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-09-12 15:36:22'),
(159, 684, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-09-18 18:52:14'),
(160, 673, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-10-01 15:00:35'),
(161, 710, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-10-01 19:55:32'),
(162, 710, '', 'You''ve moved up to <b>Novice Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Novice+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Novice Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-10-09 20:57:27'),
(163, 644, '', 'You''ve moved up to <b>Novice Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Novice+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Novice Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-10-20 09:30:16'),
(164, 724, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-10-20 13:30:29'),
(165, 734, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-10-21 15:13:51'),
(166, 639, '', 'You''ve moved up to <b>Novice Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Novice+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Novice Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-10-23 02:57:14'),
(167, 738, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-10-24 12:21:37'),
(168, 710, '', 'You''ve moved up to <b>Intermediate Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Intermediate+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Intermediate Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-10-29 21:52:16'),
(169, 752, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-10-31 12:49:11'),
(170, 824, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-11-12 18:12:22'),
(171, 825, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-11-12 18:12:44'),
(172, 704, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-11-13 04:59:26'),
(173, 759, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-11-13 21:23:36'),
(174, 759, '', 'You''ve moved up to <b>Novice Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Novice+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Novice Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-11-14 21:49:32'),
(175, 596, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-11-14 21:53:21'),
(176, 596, '', 'You''ve moved up to <b>Novice Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Novice+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Novice Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-11-14 21:53:21'),
(177, 598, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-11-14 21:54:49'),
(178, 598, '', 'You''ve moved up to <b>Novice Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Novice+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Novice Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-11-14 21:55:20'),
(179, 835, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-11-17 22:38:20'),
(180, 867, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-11-27 18:54:08'),
(181, 865, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2014-11-28 01:09:43'),
(182, 759, '', 'You''ve moved up to <b>Intermediate Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Intermediate+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Intermediate Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-06-25 19:41:24'),
(183, 759, '', 'You''ve moved up to <b>Master Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Master+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Master Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-08-29 21:57:50'),
(184, 876, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-08-30 02:04:37'),
(185, 877, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-08-30 03:04:50');
INSERT INTO `notify` (`notify_id`, `user_id`, `subject`, `msg`, `int_other`, `other`, `other_b`, `seen`, `active`, `time`) VALUES
(186, 880, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-08-30 03:10:31'),
(187, 880, '', 'You''ve moved up to <b>Novice Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Novice+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Novice Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-08-30 03:11:31'),
(188, 892, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-09-03 11:45:56'),
(189, 898, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-09-09 19:39:16'),
(190, 910, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-09-09 23:24:57'),
(191, 916, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-09-14 15:08:59'),
(192, 916, '', 'You''ve moved up to <b>Novice Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Novice+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Novice Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-09-14 15:21:24'),
(193, 881, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-09-14 18:19:22'),
(194, 916, '', 'You''ve moved up to <b>Intermediate Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Intermediate+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Intermediate Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-09-14 19:07:40'),
(195, 916, '', 'You''ve moved up to <b>Master Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Master+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Master Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-09-14 19:14:07'),
(196, 925, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-09-23 00:48:27'),
(197, 926, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-09-23 16:40:38'),
(198, 904, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-09-23 21:07:08'),
(199, 936, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-10-19 19:00:45'),
(200, 936, '', 'You''ve moved up to <b>Novice Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Novice+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Novice Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-10-19 19:10:33'),
(201, 936, '', 'You''ve moved up to <b>Intermediate Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Intermediate+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Intermediate Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-10-20 22:03:48'),
(202, 936, '', 'You''ve moved up to <b>Master Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Master+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Master Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-10-21 17:15:50'),
(203, 881, '', 'You''ve moved up to <b>Novice Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Novice+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Novice Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-10-26 21:00:03'),
(204, 952, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-10-27 18:21:36'),
(205, 908, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-10-27 18:34:42'),
(206, 971, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-10-27 18:39:48'),
(207, 971, '', 'You''ve moved up to <b>Novice Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Novice+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Novice Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-10-27 18:46:41'),
(208, 971, '', 'You''ve moved up to <b>Intermediate Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Intermediate+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Intermediate Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-10-27 19:25:55'),
(209, 952, '', 'You''ve moved up to <b>Novice Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Novice+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Novice Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-10-27 20:23:37'),
(210, 952, '', 'You''ve moved up to <b>Intermediate Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Intermediate+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Intermediate Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-10-27 20:47:31'),
(211, 952, '', 'You''ve moved up to <b>Master Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Master+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Master Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-10-27 20:58:07'),
(212, 970, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-10-27 23:04:40'),
(213, 970, '', 'You''ve moved up to <b>Novice Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Novice+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Novice Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-10-27 23:34:35'),
(214, 970, '', 'You''ve moved up to <b>Intermediate Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Intermediate+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Intermediate Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-10-28 01:50:57'),
(215, 971, '', 'You''ve moved up to <b>Master Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Master+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Master Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-10-28 12:28:47'),
(216, 926, '', 'You''ve moved up to <b>Novice Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Novice+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Novice Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-10-28 19:34:39'),
(217, 970, '', 'You''ve moved up to <b>Master Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Master+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Master Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-10-29 02:21:31'),
(218, 960, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-10-29 16:22:16'),
(219, 960, '', 'You''ve moved up to <b>Novice Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Novice+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Novice Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-10-29 21:40:49'),
(220, 960, '', 'You''ve moved up to <b>Intermediate Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Intermediate+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Intermediate Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-10-29 21:59:17'),
(221, 960, '', 'You''ve moved up to <b>Master Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Master+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Master Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-10-29 22:13:43'),
(222, 985, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-10-30 04:11:31'),
(223, 938, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-10-30 16:38:08'),
(224, 938, '', 'You''ve moved up to <b>Novice Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Novice+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Novice Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-10-30 17:23:13'),
(225, 1006, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-10-30 19:53:58'),
(226, 938, '', 'You''ve moved up to <b>Intermediate Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Intermediate+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Intermediate Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-10-30 20:30:13'),
(227, 938, '', 'You''ve moved up to <b>Master Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Master+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Master Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-04 15:08:42'),
(228, 985, '', 'You''ve moved up to <b>Novice Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Novice+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Novice Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-05 06:16:19'),
(229, 1061, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-05 19:59:43'),
(230, 1066, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-05 23:48:53'),
(231, 1070, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-09 20:55:29'),
(232, 1074, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-10 18:39:25'),
(233, 969, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-10 21:33:52'),
(234, 954, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-11 16:53:05'),
(235, 1074, '', 'You''ve moved up to <b>Novice Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Novice+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Novice Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-11 17:17:27'),
(236, 1074, '', 'You''ve moved up to <b>Intermediate Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Intermediate+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Intermediate Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-11 17:21:50'),
(237, 1094, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-11 17:30:52'),
(238, 1044, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-12 19:51:52'),
(239, 1105, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-13 19:21:03'),
(240, 925, '', 'You''ve moved up to <b>Novice Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Novice+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Novice Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-16 19:36:33'),
(241, 1114, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-17 14:34:53'),
(242, 1114, '', 'You''ve moved up to <b>Novice Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Novice+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Novice Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-17 15:09:45'),
(243, 1119, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-17 20:59:16'),
(244, 1124, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-18 13:26:09'),
(245, 1124, '', 'You''ve moved up to <b>Novice Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Novice+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Novice Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-18 13:34:43'),
(246, 1124, '', 'You''ve moved up to <b>Intermediate Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Intermediate+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Intermediate Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-18 13:51:01'),
(247, 1114, '', 'You''ve moved up to <b>Intermediate Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Intermediate+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Intermediate Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-18 14:14:38'),
(248, 950, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-18 14:16:08'),
(249, 1114, '', 'You''ve moved up to <b>Master Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Master+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Master Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-18 14:18:13'),
(250, 1126, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-18 14:43:36'),
(251, 1115, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-18 21:46:23'),
(252, 1136, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-18 23:08:02'),
(253, 1136, '', 'You''ve moved up to <b>Novice Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Novice+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Novice Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-18 23:11:18'),
(254, 1136, '', 'You''ve moved up to <b>Intermediate Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Intermediate+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Intermediate Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-18 23:14:58'),
(255, 1136, '', 'You''ve moved up to <b>Master Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Master+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Master Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-18 23:17:59'),
(256, 1017, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-19 14:47:26'),
(257, 1144, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-19 16:40:17');
INSERT INTO `notify` (`notify_id`, `user_id`, `subject`, `msg`, `int_other`, `other`, `other_b`, `seen`, `active`, `time`) VALUES
(258, 1074, '', 'You''ve moved up to <b>Master Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Master+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Master Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-20 15:57:16'),
(259, 1164, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-21 23:25:18'),
(260, 1165, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-23 15:33:42'),
(261, 1182, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-23 21:18:22'),
(262, 985, '', 'You''ve moved up to <b>Intermediate Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Intermediate+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Intermediate Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-24 03:25:39'),
(263, 1198, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-24 14:13:42'),
(264, 1167, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-24 14:22:47'),
(265, 1200, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-11-24 20:56:02'),
(266, 1119, '', 'You''ve moved up to <b>Novice Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Novice+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Novice Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-12-01 13:09:14'),
(267, 1234, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-12-01 16:57:56'),
(268, 1234, '', 'You''ve moved up to <b>Novice Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Novice+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Novice Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-12-01 17:04:59'),
(269, 903, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-12-01 19:21:01'),
(270, 903, '', 'You''ve moved up to <b>Novice Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Novice+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Novice Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-12-01 19:49:04'),
(271, 1161, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-12-02 18:52:37'),
(272, 1239, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-12-02 19:45:57'),
(273, 1159, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-12-03 16:25:07'),
(274, 1223, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-12-03 17:28:38'),
(275, 1195, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-12-04 15:34:46'),
(276, 1255, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-12-04 20:12:27'),
(277, 1275, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-12-04 20:32:49'),
(278, 1251, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-12-04 20:47:53'),
(279, 1251, '', 'You''ve moved up to <b>Novice Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Novice+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Novice Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-12-04 20:58:31'),
(280, 1273, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-12-04 21:33:58'),
(281, 1246, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-12-07 06:07:09'),
(282, 1300, '', 'You''ve moved up to <b>Beginner Level</b> rank!<br><br><center>\n<a href="https://www.facebook.com/dialog/feed?\n  app_id=145634995501895\n  &display=popup&caption=I+earned+the+Beginner+Level+level+in+the+Momentum+Trivia+Legacy+game+at+EMC+Conference+www.trivialegacy.com \n  &link=http://trivialegacy.com\n  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>\n<br>\n<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the Beginner Level level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>\n</center>', -1, '', '', 0, 1, '2015-12-08 23:42:17');

-- --------------------------------------------------------

--
-- Table structure for table `opp_deals`
--

CREATE TABLE IF NOT EXISTS `opp_deals` (
  `deal_id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `opp_title` varchar(60) NOT NULL,
  `product` varchar(60) NOT NULL,
  `opp_id` varchar(60) NOT NULL,
  `time` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `opp_deals`
--

INSERT INTO `opp_deals` (`deal_id`, `user_id`, `opp_title`, `product`, `opp_id`, `time`, `status`) VALUES
(22, 64, 'Test Deal', 'VSPEX', '87965', '2013-05-16 00:00:00', 1),
(23, 64, 'Great Deal', 'pppp', '000000', '2013-05-17 00:00:00', 2),
(24, 58, 'Close Deal #1', 'test', '0000', '2013-05-30 00:00:00', 2),
(25, 58, 'Register Deal #1', 'test', '0001', '2013-05-31 00:00:00', 1),
(26, 64, 'new deal for jb', 'new deal for jb', 'new deal for jb', '2013-05-16 00:00:00', 1),
(27, 64, 'new deal for jb', 'new deal for jb', 'new deal for jb', '2013-05-23 00:00:00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `id` int(10) unsigned NOT NULL,
  `tkey` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=340 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `tkey`, `value`) VALUES
(301, 'scraperFacebookPagePostActivities-lock', '0'),
(302, 'scraperFacebookPagePostActivities-lastRun', '1366044012'),
(303, 'scraperFacebookVotePoll-lock', '0'),
(304, 'scraperFacebookVotePoll-lastRun', '0'),
(305, 'scraperFacebookLikePage-lock', '0'),
(306, 'scraperFacebookLikePage-lastRun', '0'),
(307, 'scraperFacebookShare-lock', '0'),
(308, 'scraperFacebookShare-lastRun', '1366044010'),
(309, 'scraperFoursquareVenueCheckin-lock', '0'),
(310, 'scraperFoursquareVenueCheckin-lastRun', '0'),
(311, 'scraperInstagramTagPhoto-lock', '0'),
(312, 'scraperInstagramTagPhoto-lastRun', '1365750005'),
(313, 'scraperTwitterFollowAccount-lock', '0'),
(314, 'scraperTwitterFollowAccount-lastRun', '1382023803'),
(315, 'scraperTwitterTweetHashtag-lock', '0'),
(316, 'scraperTwitterTweetHashtag-lastRun', '1382023816'),
(317, 'scraperFacebookPageUserPosts-lock', '0'),
(318, 'scraperFacebookPageUserPosts-lastRun', '0'),
(319, 'scraperFacebookCommentPost-lock', '0'),
(320, 'scraperFacebookCommentPost-lastRun', '0'),
(321, 'scraperFacebookPostWall-lock', '0'),
(322, 'scraperFacebookPostWall-lastRun', '0'),
(323, 'scraperFacebookLikePost-lock', '0'),
(324, 'scraperFacebookLikePost-lastRun', '0'),
(325, 'scraperInstagramFollowAccount-lock', '0'),
(326, 'scraperInstagramFollowAccount-lastRun', '0'),
(327, 'invite_ct_id', '42'),
(328, 'fb_api_id', '166049330260165'),
(329, 'fb_api_secret', 'ef0947e80744f465641f898f41580e04'),
(330, 'event_start_time', '2013-07-01'),
(331, 'fb_page_count', '1'),
(332, 'fb_page_id_1', '141205826079600'),
(333, 'fb_page_name_1', 'NetechCorporation'),
(334, 'fb_page_label_1', 'likeNetechFbPage'),
(335, 'fb_content_count', '1'),
(336, 'fb_content_name_1', 'I''m participating in Netech rewards. If you''re an IT professional you should too!'),
(337, 'fb_content_label_1', 'postOnUserFbWallNetechGameonLink'),
(338, 'error_level', 'none'),
(339, 'recalc_rewards', '1');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE IF NOT EXISTS `packages` (
  `package_id` int(12) NOT NULL,
  `vendor_entity_id` int(12) NOT NULL,
  `bucket_category_id` int(12) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`package_id`, `vendor_entity_id`, `bucket_category_id`, `name`, `description`, `active`) VALUES
(1, 6, 82, 'Dynamic E-Mail', 'Dynamic E-Mail-Create a multifaceted experience w/ rotating offers, videos, lead capture forms, and downloads such as white papers and case studies. Leads via Content Downloads, Emails per Quarter, and contacts with email addresses.  Net New Prospects.', 1),
(2, 6, 83, 'Dynamic E-Mail', 'Dynamic E-Mail-Create a multifaceted experience w/ rotating offers, videos, lead capture forms, and downloads such as white papers and case studies. Leads via Content Downloads, Emails per Quarter, and contacts with email addresses.  Net New Prospects.', 1),
(3, 6, 82, 'Delta Prelytix (IP Listening)', 'IP Listening Program-Engage with the right prospects at the right time by pursuing opportunities with the highest propensity to buy.  200-350 Leads, access to MRP Marketing Cloud – Real time reporting dashboard, Topic / Keyword recommendation and selection, Target IP Listening on Monitored Websites, Taxonomy Details and topic Unique to Partner.  Net New Prospects.', 1),
(4, 6, 83, 'Delta Prelytix (IP Listening)', 'IP Listening Program-Engage with the right prospects at the right time by pursuing opportunities with the highest propensity to buy.  200-350 Leads, access to MRP Marketing Cloud – Real time reporting dashboard, Topic / Keyword recommendation and selection, Target IP Listening on Monitored Websites, Taxonomy Details and topic Unique to Partner.  Net New Prospects.', 1),
(5, 6, 82, 'Event Registration Generation', 'Event Recruitment-MRP:  Drive audience acquisition to live or digital events. Target Accounts provided by MRP, 3 Weeks of Awareness via Tele-Prospecting, 1 week of reminder calls.  Net New Prospects.', 1),
(6, 6, 83, 'Event Registration Generation', 'Event Recruitment-MRP:  Drive audience acquisition to live or digital events. Target Accounts provided by MRP, 3 Weeks of Awareness via Tele-Prospecting, 1 week of reminder calls.  Net New Prospects.', 1),
(7, 6, 82, 'Event Registration Generation with Dynamic E-Mail', 'Event Recruitment-MRP: Drive audience acquisition to live or digital events. (E-Mail Blast Included). Target Accounts provided by MRP, 3 Weeks of Awareness via Tele-Prospecting, 1 week of reminder calls, Dynamic Email & Registration Landing Page for Event Awareness.  Net New Prospects.', 1),
(8, 6, 83, 'Event Registration Generation with Dynamic E-Mail', 'Event Recruitment-MRP: Drive audience acquisition to live or digital events. (E-Mail Blast Included). Target Accounts provided by MRP, 3 Weeks of Awareness via Tele-Prospecting, 1 week of reminder calls, Dynamic Email & Registration Landing Page for Event Awareness.  Net New Prospects.', 1),
(9, 6, 82, 'Tele-Optimization (BANT-P)', 'Telemarketing-MRP: Drive pipeline and revenue via tele-prospecting and BANT qualification around solution area of choice. Includes BANT-P Qualified Opportunities & Nurture Leads), dedicated campaign resource, and IT End User Contact Database.  Net New Prospects.', 1),
(10, 6, 83, 'Tele-Optimization (BANT-P)', 'Telemarketing-MRP: Drive pipeline and revenue via tele-prospecting and BANT qualification around solution area of choice. Includes BANT-P Qualified Opportunities & Nurture Leads), dedicated campaign resource, and IT End User Contact Database.  Net New Prospects.', 1),
(11, 6, 83, 'High Impact Direct Mailer', 'High Impact Direct Mailer-Integrated, incentive based, demand generation campaign driving high quality leads and sales engagements.   Includes incentive Based Leads, Phone-Validated Contacts, Direct Mailers, Microsite with survey, Personalized lead monitoring portal, Creative concept, copywriting, survey development and survey management, Dedicated account executive for the confirmation of leads and confirmation of meetings.  Net New Prospects.', 1),
(12, 6, 82, 'High Impact Direct Mailer', 'High Impact Direct Mailer-Integrated, incentive based, demand generation campaign driving high quality leads and sales engagements.   Includes incentive Based Leads, Phone-Validated Contacts, Direct Mailers, Microsite with survey, Personalized lead monitoring portal, Creative concept, copywriting, survey development and survey management, Dedicated account executive for the confirmation of leads and confirmation of meetings.  Net New Prospects.', 1),
(13, 6, 82, 'Dynamic + Tele-Optimization', 'MRP will make emails and landing pages more visual and engaging, MRP will prioritize email responders for follow up to generate qualified opportunities. Includes BANT-P Qualified Opportunities &  Nurture Leads, E-Mails , contacts with email addresses, and  Leads via Content Download.  Net New Prospects.', 1),
(14, 6, 83, 'Dynamic + Tele-Optimization', 'MRP will make emails and landing pages more visual and engaging, MRP will prioritize email responders for follow up to generate qualified opportunities. Includes BANT-P Qualified Opportunities &  Nurture Leads, E-Mails , contacts with email addresses, and  Leads via Content Download.  Net New Prospects.', 1),
(15, 6, 82, 'Market Segmentation Heat Map + Tele-Optimization', 'Database and Analytics-MRP: Build out an end user database, receive high level marketing recommendations around Dell specific products that are resonating in your target market. Includes BANT-P Qualified Opportunities & Nurture Leads, Dedicated Marketing Analyst, Customized segmentation report: Whitespace prospects vs. existing customer analysis, Vertical Prioritization/Recommendations, and Contact Database of  Accounts/ Contacts.  Net New Prospects.', 1),
(16, 6, 83, 'Market Segmentation Heat Map + Tele-Optimization', 'Database and Analytics-MRP: Build out an end user database, receive high level marketing recommendations around Dell specific products that are resonating in your target market. Includes BANT-P Qualified Opportunities & Nurture Leads, Dedicated Marketing Analyst, Customized segmentation report: Whitespace prospects vs. existing customer analysis, Vertical Prioritization/Recommendations, and Contact Database of  Accounts/ Contacts.  Net New Prospects.', 1),
(17, 7, 82, 'OneAffiniti Lead Generation Program', 'Marketing campaign that drives leads by activating existing accounts. Campaign consists of email, landing page, social, tele-qualification and closed loop sales reporting  Less than five minutes of time a month for 15 sales-ready leads and a closed revenue target of $45,000 over 3 months.', 1),
(18, 7, 83, 'OneAffiniti Lead Generation Program', 'Marketing campaign that drives leads by activating existing accounts. Campaign consists of email, landing page, social, tele-qualification and closed loop sales reporting  Less than five minutes of time a month for 15 sales-ready leads and a closed revenue target of $45,000 over 3 months.', 1),
(19, 8, 83, 'Lead Generation Program', 'Telemarketing generation campaign that includes list rental, script and delivery of sales-qualified leads who are expecting a call from partner.', 1),
(20, 8, 82, 'Lead Generation Program', 'Telemarketing generation campaign that includes list rental, script and delivery of sales-qualified leads who are expecting a call from partner.', 1),
(21, 8, 83, 'Integrated Lead Generation', 'Integrated campaign that includes list rental, email creation and deployment, Twitter and LinkedIn post creation, custom solutions brief & telemarketing for  sales-qualified leads expecting call from partner.', 1),
(22, 8, 83, 'Webinar Campaign', 'Webinar package that includes list rental, creation and deployment of  emails, webinar hosting, registration management & telemarketing for  sales-qualified leads expecting call from partner.', 1),
(23, 8, 82, 'Integrated Lead Generation', 'Integrated campaign that includes list rental, email creation and deployment, Twitter and LinkedIn post creation, custom solutions brief & telemarketing for  sales-qualified leads expecting call from partner.', 1),
(24, 8, 82, 'Webinar Campaign', 'Webinar package that includes list rental, creation and deployment of  emails, webinar hosting, registration management & telemarketing for  sales-qualified leads expecting call from partner.', 1),
(25, 8, 83, 'Integrated Video Campaign', 'Integrated video campaign that includes list rental, cobranding/deployment of  emails, creation of one custom video & telemarketing for  sales-qualified leads expecting call from partner.', 1),
(26, 8, 82, 'Integrated Video Campaign', 'Integrated video campaign includes list rental, cobranding/deployment  emails, creation of one custom video & telemarketing for  sales-qualified leads expecting call from partner.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `packages_info`
--

CREATE TABLE IF NOT EXISTS `packages_info` (
  `packages_info_id` int(12) NOT NULL,
  `package_id` int(12) NOT NULL,
  `info_type` varchar(255) COLLATE utf8_bin NOT NULL,
  `info_a` varchar(255) COLLATE utf8_bin NOT NULL,
  `info_b` varchar(255) COLLATE utf8_bin NOT NULL,
  `numeric_info` decimal(12,4) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `packages_info`
--

INSERT INTO `packages_info` (`packages_info_id`, `package_id`, `info_type`, `info_a`, `info_b`, `numeric_info`, `datetime`) VALUES
(1, 1, 'quarter', '', '', 1.0000, '0000-00-00 00:00:00'),
(2, 1, 'category', '', '', 86.0000, '0000-00-00 00:00:00'),
(3, 2, 'quarter', '', '', 1.0000, '0000-00-00 00:00:00'),
(4, 2, 'category', '', '', 86.0000, '0000-00-00 00:00:00'),
(5, 3, 'quarter', '', '', 1.0000, '0000-00-00 00:00:00'),
(6, 3, 'category', '', '', 87.0000, '0000-00-00 00:00:00'),
(7, 4, 'quarter', '', '', 1.0000, '0000-00-00 00:00:00'),
(8, 4, 'category', '', '', 87.0000, '0000-00-00 00:00:00'),
(9, 5, 'quarter', '', '', 1.0000, '0000-00-00 00:00:00'),
(10, 5, 'category', '', '', 88.0000, '0000-00-00 00:00:00'),
(11, 6, 'quarter', '', '', 1.0000, '0000-00-00 00:00:00'),
(12, 6, 'category', '', '', 88.0000, '0000-00-00 00:00:00'),
(13, 7, 'quarter', '', '', 1.0000, '0000-00-00 00:00:00'),
(14, 7, 'category', '', '', 88.0000, '0000-00-00 00:00:00'),
(15, 8, 'quarter', '', '', 1.0000, '0000-00-00 00:00:00'),
(16, 8, 'category', '', '', 88.0000, '0000-00-00 00:00:00'),
(17, 9, 'quarter', '', '', 1.0000, '0000-00-00 00:00:00'),
(18, 9, 'category', '', '', 89.0000, '0000-00-00 00:00:00'),
(19, 10, 'quarter', '', '', 1.0000, '0000-00-00 00:00:00'),
(20, 10, 'category', '', '', 89.0000, '0000-00-00 00:00:00'),
(21, 11, 'quarter', '', '', 1.0000, '0000-00-00 00:00:00'),
(22, 11, 'category', '', '', 86.0000, '0000-00-00 00:00:00'),
(23, 12, 'quarter', '', '', 1.0000, '0000-00-00 00:00:00'),
(24, 12, 'category', '', '', 86.0000, '0000-00-00 00:00:00'),
(25, 13, 'quarter', '', '', 1.0000, '0000-00-00 00:00:00'),
(26, 13, 'category', '', '', 86.0000, '0000-00-00 00:00:00'),
(27, 14, 'quarter', '', '', 1.0000, '0000-00-00 00:00:00'),
(28, 14, 'category', '', '', 86.0000, '0000-00-00 00:00:00'),
(29, 15, 'quarter', '', '', 1.0000, '0000-00-00 00:00:00'),
(30, 15, 'category', '', '', 87.0000, '0000-00-00 00:00:00'),
(31, 16, 'quarter', '', '', 1.0000, '0000-00-00 00:00:00'),
(32, 16, 'category', '', '', 87.0000, '0000-00-00 00:00:00'),
(33, 17, 'quarter', '', '', 1.0000, '0000-00-00 00:00:00'),
(34, 17, 'category', '', '', 86.0000, '0000-00-00 00:00:00'),
(35, 18, 'quarter', '', '', 1.0000, '0000-00-00 00:00:00'),
(36, 18, 'category', '', '', 86.0000, '0000-00-00 00:00:00'),
(37, 19, 'quarter', '', '', 1.0000, '0000-00-00 00:00:00'),
(38, 19, 'category', '', '', 89.0000, '0000-00-00 00:00:00'),
(39, 20, 'quarter', '', '', 1.0000, '0000-00-00 00:00:00'),
(40, 20, 'category', '', '', 89.0000, '0000-00-00 00:00:00'),
(41, 21, 'quarter', '', '', 1.0000, '0000-00-00 00:00:00'),
(42, 21, 'category', '', '', 86.0000, '0000-00-00 00:00:00'),
(43, 22, 'quarter', '', '', 1.0000, '0000-00-00 00:00:00'),
(44, 22, 'category', '', '', 90.0000, '0000-00-00 00:00:00'),
(45, 23, 'quarter', '', '', 1.0000, '0000-00-00 00:00:00'),
(46, 23, 'category', '', '', 86.0000, '0000-00-00 00:00:00'),
(47, 24, 'quarter', '', '', 1.0000, '0000-00-00 00:00:00'),
(48, 24, 'category', '', '', 90.0000, '0000-00-00 00:00:00'),
(49, 25, 'quarter', '', '', 1.0000, '0000-00-00 00:00:00'),
(50, 25, 'category', '', '', 86.0000, '0000-00-00 00:00:00'),
(51, 26, 'quarter', '', '', 1.0000, '0000-00-00 00:00:00'),
(52, 26, 'category', '', '', 86.0000, '0000-00-00 00:00:00'),
(53, 1, 'order_form', '', '', 1.0000, '0000-00-00 00:00:00'),
(54, 2, 'order_form', '', '', 1.0000, '0000-00-00 00:00:00'),
(55, 3, 'order_form', '', '', 1.0000, '0000-00-00 00:00:00'),
(56, 4, 'order_form', '', '', 1.0000, '0000-00-00 00:00:00'),
(57, 5, 'order_form', '', '', 1.0000, '0000-00-00 00:00:00'),
(58, 6, 'order_form', '', '', 1.0000, '0000-00-00 00:00:00'),
(59, 7, 'order_form', '', '', 1.0000, '0000-00-00 00:00:00'),
(60, 8, 'order_form', '', '', 1.0000, '0000-00-00 00:00:00'),
(61, 9, 'order_form', '', '', 1.0000, '0000-00-00 00:00:00'),
(62, 10, 'order_form', '', '', 1.0000, '0000-00-00 00:00:00'),
(63, 11, 'order_form', '', '', 1.0000, '0000-00-00 00:00:00'),
(64, 12, 'order_form', '', '', 1.0000, '0000-00-00 00:00:00'),
(65, 13, 'order_form', '', '', 1.0000, '0000-00-00 00:00:00'),
(66, 14, 'order_form', '', '', 1.0000, '0000-00-00 00:00:00'),
(67, 15, 'order_form', '', '', 1.0000, '0000-00-00 00:00:00'),
(68, 16, 'order_form', '', '', 1.0000, '0000-00-00 00:00:00'),
(69, 17, 'order_form', '', '', 1.0000, '0000-00-00 00:00:00'),
(70, 18, 'order_form', '', '', 1.0000, '0000-00-00 00:00:00'),
(71, 19, 'order_form', '', '', 1.0000, '0000-00-00 00:00:00'),
(72, 20, 'order_form', '', '', 1.0000, '0000-00-00 00:00:00'),
(73, 21, 'order_form', '', '', 1.0000, '0000-00-00 00:00:00'),
(74, 22, 'order_form', '', '', 1.0000, '0000-00-00 00:00:00'),
(75, 23, 'order_form', '', '', 1.0000, '0000-00-00 00:00:00'),
(76, 24, 'order_form', '', '', 1.0000, '0000-00-00 00:00:00'),
(77, 25, 'order_form', '', '', 1.0000, '0000-00-00 00:00:00'),
(78, 26, 'order_form', '', '', 1.0000, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `packages_options`
--

CREATE TABLE IF NOT EXISTS `packages_options` (
  `packages_option_id` int(12) NOT NULL,
  `package_id` int(12) NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `price` decimal(12,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `packages_options`
--

INSERT INTO `packages_options` (`packages_option_id`, `package_id`, `description`, `price`) VALUES
(1, 1, ' Dynamic E-Mail-Create a multifaceted experience w/ rotating offers, videos, lead capture forms, and downloads such as white papers and case studies. 20 Leads via Content Downloads, 4 Emails per Quarter, and 2,500 contacts with email addresses.  Net New Prospects.', 5000.00),
(2, 1, ' Dynamic E-Mail-Create a multifaceted experience w/ rotating offers, videos, lead capture forms, and downloads such as white papers and case studies.  40 Leads via Content Downloads, 8 Emails per Quarter, and 5,000 contacts with email addresses.  Net New Prospects.', 10000.00),
(3, 2, ' Dynamic E-Mail-Create a multifaceted experience w/ rotating offers, videos, lead capture forms, and downloads such as white papers and case studies.   20 Leads via Content Downloads, 4 Emails per Quarter, and 2,500 contacts with email addresses.  Net New Prospects.', 5000.00),
(4, 2, ' Dynamic E-Mail-Create a multifaceted experience w/ rotating offers, videos, lead capture forms, and downloads such as white papers and case studies.   40 Leads via Content Downloads, 8 Emails per Quarter, and 5,000 contacts with email addresses.  Net New Prospects.', 10000.00),
(5, 3, ' IP Listening Program-Engage with the right prospects at the right time by pursuing opportunities with the highest propensity to buy.  200-350 Leads, access to MRP Marketing Cloud – Real time reporting dashboard, Topic / Keyword recommendation and selection, Target IP Listening on Monitored Websites, Taxonomy Details and topic Unique to Partner.  Net New Prospects.', 20000.00),
(6, 4, ' IP Listening Program-Engage with the right prospects at the right time by pursuing opportunities with the highest propensity to buy.  200-350 Leads, access to MRP Marketing Cloud – Real time reporting dashboard, Topic / Keyword recommendation and selection, Target IP Listening on Monitored Websites, Taxonomy Details and topic Unique to Partner.  Net New Prospects.', 20000.00),
(7, 5, '  Drive audience acquisition to live or digital events. Estimated 75+ Registrants (No Guarantee for Attendance), 500-1,000 Target Accounts provided by MRP, 3 Weeks of Awareness via Tele-Prospecting, 1 week of reminder calls.  Net New Prospects.', 5000.00),
(8, 6, ' Drive audience acquisition to live or digital events. Estimated 75+ Registrants (No Guarantee for Attendance), 500-1,000 Target Accounts provided by MRP, 3 Weeks of Awareness via Tele-Prospecting, 1 week of reminder calls.  Net New Prospects.', 5000.00),
(9, 7, ' Drive audience acquisition to live or digital events. (E-Mail Blast Included).  Estimated 75+ Registrants (No Guarantee for Attendance), 500-1,000 Target Accounts provided by MRP, 3 Weeks of Awareness via Tele-Prospecting, 1 week of reminder calls, Dynamic Email & Registration Landing Page for Event Awareness.  Net New Prospects.', 10000.00),
(10, 7, ' Drive audience acquisition to live or digital events. (E-Mail Blast Included).  Estimated 150+ Registrants (No Guarantee for Attendance), 500-1,000 Target Accounts provided by MRP, 3 Weeks of Awareness via Tele-Prospecting, 1 week of reminder calls, Dynamic Email & Registration Landing Page for Event Awareness.  Net New Prospects.', 15000.00),
(11, 8, ' Drive audience acquisition to live or digital events. (E-Mail Blast Included).  Estimated 75+ Registrants (No Guarantee for Attendance), 500-1,000 Target Accounts provided by MRP, 3 Weeks of Awareness via Tele-Prospecting, 1 week of reminder calls, Dynamic Email & Registration Landing Page for Event Awareness..  Net New Prospects.', 10000.00),
(12, 8, ' Drive audience acquisition to live or digital events. (E-Mail Blast Included).  Estimated 150+ Registrants (No Guarantee for Attendance), 500-1,000 Target Accounts provided by MRP, 3 Weeks of Awareness via Tele-Prospecting, 1 week of reminder calls, Dynamic Email & Registration Landing Page for Event Awareness.  Net New Prospects.', 15000.00),
(13, 9, ' Drive pipeline and revenue via tele-prospecting and BANT qualification around solution area of choice. 14 Total Leads (7 BANT-P Qualified Opportunities & 7 Nurture Leads), dedicated campaign resource, and 300-500 IT End User Contact Database.  Net New Prospects.', 5000.00),
(14, 9, ' Drive pipeline and revenue via tele-prospecting and BANT qualification around solution area of choice. 32 Total Leads (16 BANT-P Qualified Opportunities & 16 Nurture Leads),  dedicated campaign resource, and 300-500 IT End User Contact Database.  Net New Prospects.', 10000.00),
(15, 9, ' Drive pipeline and revenue via tele-prospecting and BANT qualification around solution area of choice.  48 Total Leads (24 BANT-P Qualified Opportunities & 24 Nurture Leads), dedicated campaign resource, and 300-500 IT End User Contact. Net New Prospects.', 15000.00),
(16, 9, ' Drive pipeline and revenue via tele-prospecting and BANT qualification around solution area of choice. 66 Total Leads (33 BANT-P Qualified Opportunities & 33 Nurture Leads), dedicated campaign resource, and 300-500 IT End User Contacts.  Net New Prospects.', 20000.00),
(17, 10, ' Drive pipeline and revenue via tele-prospecting and BANT qualification around solution area of choice.  16 Total Leads (8 BANT-P Qualified Opportunities & 8 Nurture Leads), dedicated campaign resource, and 300-500 IT End User Contact Database. Net New Prospects.', 5000.00),
(18, 10, ' Drive pipeline and revenue via tele-prospecting and BANT qualification around solution area of choice. 38 Total Leads (19 BANT-P Qualified Opportunities & 19 Nurture Leads), dedicated campaign resource, and 300-500 IT End User Contact.  Net New Prospects.', 10000.00),
(19, 10, ' Drive pipeline and revenue via tele-prospecting and BANT qualification around solution area of choice. 58 Total Leads (29 BANT-P Qualified Opportunities & 29 Nurture Leads), dedicated campaign resource, and 300-500 IT End User Contact Database\nprovided by MRP. Net New Prospects.', 15000.00),
(20, 10, ' Drive pipeline and revenue via tele-prospecting and BANT qualification around solution area of choice.   78 Total Leads (39 BANT-P Qualified Opportunities & 39 Nurture Leads), dedicated campaign resource, and 300-500 IT End User Contact Database\nprovided by MRP.  Net New Prospects.', 20000.00),
(21, 11, ' High Impact Direct Mailer-Integrated, incentive based, demand generation campaign driving high quality leads and sales engagements.   50 Incentive Based Leads, 400 Phone-Validated Contacts, 400 Direct Mailers, Microsite with survey, Personalized lead monitoring portal, Creative concept, copywriting, survey development and survey management, Dedicated account executive for the confirmation of leads and confirmation of meetings.  Net New Prospects.', 10000.00),
(22, 11, ' High Impact Direct Mailer-Integrated, incentive based, demand generation campaign driving high quality leads and sales engagements.   100 Incentive Based Leads, 800 Phone-Validated Contacts, 800 Direct Mailers, Microsite with survey, Personalized lead monitoring portal, Creative concept, copywriting, survey development and survey management, and Dedicated account executive for the confirmation of leads and confirmation of meetings.  Net New Prospects.', 20000.00),
(23, 12, ' High Impact Direct Mailer-Integrated, incentive based, demand generation campaign driving high quality leads and sales engagements.    50 Incentive Based Leads, 400 Phone-Validated Contacts, 400 Direct Mailers, Microsite with survey, Personalized lead monitoring portal, Creative concept, copywriting, survey development and survey management, Dedicated account executive for the confirmation of leads and confirmation of meetings.  Net New Prospects.', 10000.00),
(24, 12, ' High Impact Direct Mailer-Integrated, incentive based, demand generation campaign driving high quality leads and sales engagements.   100 Incentive Based Leads, 800 Phone-Validated Contacts, 800 Direct Mailers, Microsite with survey, Personalized lead monitoring portal, Creative concept, copywriting, survey development and survey management, and Dedicated account executive for the confirmation of leads and confirmation of meetings.  Net New Prospects.', 20000.00),
(25, 13, ' MRP will make emails and landing pages more visual and engaging, MRP will prioritize email responders for follow up to generate qualified opportunities. 14 Total Leads (7 BANT-P Qualified Opportunities & 7 Nurture Leads), 4 E-Mails per Quarter, 2,500 contacts with email addresses, and 20 Leads via Content Download.  Net New Prospects.', 10000.00),
(26, 13, ' MRP will make emails and landing pages more visual and engaging, MRP will prioritize email responders for follow up to generate qualified opportunities. 32 Total Leads (16 BANT-P Qualified Opportunities & 16 Nurture Leads), 8 E-Mails per Quarter, 5,000 contacts with email addresses, and 40 Leads via Content Download.  Net New Prospects.', 15000.00),
(27, 13, ' MRP will make emails and landing pages more visual and engaging, MRP will prioritize email responders for follow up to generate qualified opportunities. 48 Total Leads (24 BANT-P Qualified Opportunities & 24 Nurture Leads), 8 E-Mails per Quarter, 5,000 contacts with email addresses, and 40 Leads via Content Download.  Net New Prospects.', 20000.00),
(28, 14, ' MRP will make emails and landing pages more visual and engaging, MRP will prioritize email responders for follow up to generate qualified opportunities. 16 Total Leads (8 BANT-P Qualified Opportunities & 8 Nurture Leads),  4 E-Mails per Quarter, 2,500 contacts with email addresses, and 20 Leads via Content Download.  Net New Prospects.', 10000.00),
(29, 14, ' MRP will make emails and landing pages more visual and engaging, MRP will prioritize email responders for follow up to generate qualified opportunities. 38 Total Leads (19 BANT-P Qualified Opportunities & 19 Nurture Leads), 8 E-Mails per Quarter, 5,000 contacts with email addresses, and 40 Leads via Content Download.  Net New Prospects.', 15000.00),
(30, 14, ' MRP will make emails and landing pages more visual and engaging, MRP will prioritize email responders for follow up to generate qualified opportunities. 58 Total Leads (29 BANT-P Qualified Opportunities & 29 Nurture Leads), 8 E-Mails per Quarter, 5,000 contacts with email addresses, and 40 Leads via Content Download.  Net New Prospects.', 20000.00),
(31, 15, ' Build out an end user database, receive high level marketing recommendations around Dell specific products that are resonating in your target market. 14 Total Leads (7 BANT-P Qualified Opportunities & 7 Nurture Leads), Dedicated Marketing Analyst, Customized segmentation report: Whitespace prospects vs. existing customer analysis, Vertical Prioritization/Recommendations, and Contact Database of 200 Accounts/600+ Contacts.  Net New Prospects.', 10000.00),
(32, 15, ' Build out an end user database, receive high level marketing recommendations around Dell specific products that are resonating in your target market. 32 Total Leads (16 BANT-P Qualified Opportunities & 16 Nurture Leads), Dedicated Marketing Analyst, Customized segmentation report: Whitespace prospects vs. existing customer analysis, Vertical Prioritization/Recommendations, and Contact Database of 200 Accounts/600+ Contacts.  Net New Prospects.', 20000.00),
(33, 16, ' Build out an end user database, receive high level marketing recommendations around Dell specific products that are resonating in your target market. 16 Total Leads (8 BANT-P Qualified Opportunities & 8 Nurture Leads), Dedicated Marketing Analyst, Customized segmentation report: Whitespace prospects vs. existing customer analysis, Vertical Prioritization/Recommendations, and Contact Database of 200 Accounts/600+ Contacts.  Net New Prospects.', 10000.00),
(34, 16, '  Build out an end user database, receive high level marketing recommendations around Dell specific products that are resonating in your target market. 38 Total Leads (19 BANT-P Qualified Opportunities & 19 Nurture Leads), Dedicated Marketing Analyst, Customized segmentation report: Whitespace prospects vs. existing customer analysis, Vertical Prioritization/Recommendations, and Contact Database of 200 Accounts/600+ Contacts.  Net New Prospects.', 20000.00),
(35, 17, 'Marketing campaign that drives leads by activating existing accounts. Campaign consists of email, landing page, social, tele-qualification and closed loop sales reporting  Less than five minutes of time a month for 15 sales-ready leads and a closed revenue target of $45,000 over 3 months.', 5000.00),
(36, 18, 'Marketing campaign that drives leads by activating existing accounts. Campaign consists of email and landing page development, social media, tele-qualification and closed loop sales reporting  Less than five minutes of time a month for 15 sales-ready leads and a closed revenue target of $45,000 over 3 months.', 5000.00),
(37, 19, 'Telemarketing generation campaign that includes list rental, script and delivery of 9 sales-qualified leads who are expecting a call from partner.', 5000.00),
(38, 20, 'Telemarketing generation campaign that includes list rental, campaigns include list rental, script and delivery of 8 sales-qualified leads who are expecting a call from partner.', 5000.00),
(39, 21, 'Integrated campaign that includes list rental, cobranding/deployment of 3 emails, creation of one custom case study or solutions brief, telemarketing for 7 sales-qualified leads expecting a call from partner.', 10000.00),
(40, 21, 'Integrated email campaign that includes list rental, cobranding and deployment of 3 emails and telemarketing for 12 sales-qualified leads who are expecting a call from partner.', 10000.00),
(41, 22, 'Webinar package that includes list rental, creation and deployment of 4 emails, webinar hosting, registration management & telemarketing for 8 sales-qualified leads expecting call from partner.', 10000.00),
(42, 23, 'Integrated campaign that includes list rental, cobranding/deployment of 3 emails, creation of one custom case study or solutions brief, telemarketing for 6 sales-qualified leads expecting call from partner.', 10000.00),
(43, 23, 'Email campaign that includes list rental, cobranding and deployment of 3 emails and telemarketing for 12 sales-qualified leads who are expecting a call from partner.', 10000.00),
(44, 24, 'Webinar package that includes list rental, creation and deployment of 4 emails, webinar hosting, registration management & telemarketing for 7 sales-qualified leads expecting call from partner.', 10000.00),
(45, 21, 'Integrated campaign including list rental, cobranding/deployment of 3 emails, creation of one custom case study or solutions brief & telemarketing for 18 sales-qualified leads expecting call from partner.', 15000.00),
(46, 21, 'Integrated email campaign including list rental, cobranding and deployment of 3 emails & telemarketing for 22 sales-qualified leads who are expecting a call from partner.', 15000.00),
(47, 25, 'Integrated video campaign that includes list rental, cobranding/deployment of 3 emails, creation of one 2-3 min custom video & telemarketing for 11 sales-qualified leads expecting call from partner.', 15000.00),
(48, 23, 'Integrated campaign including list rental, cobranding/deployment three emails, creation of one custom case study or solutions brief & telemarketing for 15 sales-qualified leads expecting call from partner.', 15000.00),
(49, 23, 'Integrated email campaign that includes list rental, cobranding and deployment of 3 emails telemarketing for 19 sales-qualified leads who are expecting a call from partner.', 15000.00),
(50, 26, 'Integrated video campaign includes list rental, cobranding/deployment 3 emails, creation of one 2-3 min custom video & telemarketing for 9 sales-qualified leads expecting call from partner.', 15000.00),
(51, 21, 'Integrated email campaign that includes list rental, cobranding and deployment of 3 emails & telemarketing for 35 sales-qualified leads who are expecting a call from partner.', 20000.00),
(52, 21, 'Integrated campaign that includes list rental, email creation and deployment, Twitter and LinkedIn post creation, custom solutions brief & telemarketing for 18 sales-qualified leads expecting call from partner.', 20000.00),
(53, 23, 'Integrated email campaign that includes list rental, cobranding and deployment of 3 emails & telemarketing for 29 sales-qualified leads who are expecting a call from partner.', 20000.00),
(54, 23, 'Integrated campaign that includes list rental, email creation and deployment, Twitter and LinkedIn post creation, custom solutions brief & telemarketing for 15 sales-qualified leads expecting call from partner.', 20000.00);

-- --------------------------------------------------------

--
-- Table structure for table `password_request`
--

CREATE TABLE IF NOT EXISTS `password_request` (
  `request_id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `reset_key` varchar(30) NOT NULL,
  `request_time` datetime NOT NULL,
  `used_time` datetime NOT NULL,
  `ip` varchar(60) NOT NULL,
  `used_ip` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `password_request`
--

INSERT INTO `password_request` (`request_id`, `user_id`, `reset_key`, `request_time`, `used_time`, `ip`, `used_ip`) VALUES
(1, 3, '5uocj0ccgql1orydugulfici541ers', '2013-07-24 19:56:16', '2013-07-24 19:57:29', '74.113.164.226', '74.113.164.226'),
(2, 23, 'luecle6wvntk6eugmz76ss530v21u8', '2013-07-25 13:49:51', '2013-07-25 13:50:41', '24.1.5.94', '24.1.5.94'),
(3, 6, '4r8rmgavi5d820hzahzcsk1ra5uqbb', '2013-07-26 19:48:13', '2013-07-26 19:49:25', '74.113.164.226', '74.113.164.226'),
(4, 22, 'xqs2o9s3f9hopalp9jrlp214lrkp11', '2013-07-29 17:38:31', '2013-07-29 17:39:39', '24.12.6.135', '24.12.6.135'),
(5, 15, 'qre4equchlx31auv97hhky3bxiwuq8', '2013-07-29 17:59:26', '2013-07-30 15:51:11', '66.129.224.36', '74.113.164.226'),
(6, 21, 'khaoawj62ofakxo3mn0vn8wcgre39w', '2013-07-29 18:46:32', '2013-07-29 18:48:21', '66.129.224.36', '66.129.224.36'),
(7, 39, 'kyqeqbedn9fddq1uv703handd192p2', '2013-07-29 18:58:12', '2013-07-29 18:59:50', '71.223.226.52', '71.223.226.52'),
(8, 5, '6hh6gdoy0enon0cahj1i3djtri2oik', '2013-07-30 15:49:27', '2013-07-30 15:49:27', '74.113.164.226', ''),
(9, 20, 'a95uz8f5u0ffekhh68gagixjbzhbop', '2013-07-30 16:57:17', '2013-07-30 17:00:05', '72.52.96.15', '72.52.96.15'),
(10, 33, '8l1qn2i7hudxw0nx0o5v1rborgest2', '2013-07-30 17:05:56', '2013-07-30 17:06:24', '72.52.96.15', '72.52.96.15'),
(11, 12, 'qiwowt5ldxhpu4kn11bqptq9p6uz0r', '2013-07-30 17:07:47', '2013-07-30 17:09:05', '198.200.139.3', '198.200.139.3'),
(12, 92, '7sdw1n8xyfwf5vjpbkm5skh5bjlo5x', '2013-07-30 18:12:08', '2013-07-30 18:16:39', '168.159.213.137', '198.228.200.177'),
(13, 103, 's9kz1g0a9jss55enwz6zys3bjvrfzc', '2013-07-31 16:46:47', '2013-07-31 16:50:10', '75.130.111.95', '75.130.111.95'),
(14, 106, 'bn1e15u2yykfal8jk2wwim787xa0zc', '2013-08-05 17:39:55', '2013-08-05 17:47:03', '173.12.54.33', '173.12.54.33'),
(15, 108, 'klknrp47aegg975w9xjbn0tquoerq8', '2013-08-06 15:50:13', '2013-08-06 15:51:48', '12.9.138.11', '12.9.138.11'),
(16, 113, 'pi5sb93u8f95h2a0pia1ryndlbqyqq', '2013-10-16 16:22:30', '2013-10-16 16:22:30', '74.113.164.226', ''),
(17, 12, 'gnffou0rb1128uo8wbg5u12zheverr', '2013-10-28 20:46:54', '2013-10-28 21:16:09', '10.189.246.4', '10.189.246.4'),
(18, 32, 'uvt58y8kz3fumselueufj20hfsnshn', '2013-11-18 22:12:19', '2013-11-20 23:30:21', '74.113.164.226', '74.113.164.226'),
(19, 136, 'hsg4imdnkwe33sjqa0va4bp5e5krgd', '2013-11-21 17:55:58', '2013-11-21 17:56:27', '12.42.131.10', '12.42.131.10'),
(20, 129, 'gsuh9xjwh4wv72so7tvefgi0jgulam', '2013-11-21 17:57:26', '2013-11-21 17:58:27', '173.226.243.221', '173.226.243.210'),
(21, 127, 'tnmu7s4f7z4m9giwny6daypednh8e1', '2013-11-21 17:58:19', '2013-11-21 17:59:36', '65.116.81.200', '65.116.81.200'),
(22, 30, 'woucksn93wbseywocgpy679kia493i', '2013-11-21 18:00:54', '2013-11-21 18:01:41', '70.62.99.18', '70.62.99.18'),
(23, 101, 'z3ppklx3agh68aw7b89s9kto039654', '2013-11-21 18:10:32', '2013-11-21 18:12:12', '146.79.254.10', '146.79.254.10'),
(24, 534, '7iazc9dnnhc4t65ial1a247028ojia', '2014-07-05 02:06:37', '2014-07-05 02:48:12', '74.113.164.226', '74.113.164.226'),
(25, 535, 'r43ul9sad3aczfukceb6e2xwecyu9w', '2014-07-05 14:50:23', '2014-07-05 15:25:00', '72.89.78.93', '72.89.78.93'),
(26, 552, '10eseem6tcwp4t8vi3c8joquv2pdje', '2014-07-14 14:41:07', '2014-08-12 20:20:20', '74.113.164.226', '173.166.16.82'),
(27, 551, 'z7f60rb62poc5z5gr4hciyqsmalpkp', '2014-07-14 14:41:21', '2014-07-14 14:46:02', '74.113.164.226', '74.113.164.226'),
(28, 551, '1dryyqruvyhxsi3kohr8bak7nu617x', '2014-07-14 16:29:21', '2014-07-14 16:30:39', '74.113.164.226', '74.113.164.226'),
(29, 567, 'w0713nljvd7wnnz9dz5lycks07hyhx', '2014-08-12 17:19:04', '2014-08-12 17:19:04', '199.19.250.23', ''),
(30, 556, 'hux2tyqyjdu3mj3loqkbnimkfyrjin', '2014-08-13 13:06:57', '2014-08-13 13:06:57', '173.166.16.82', ''),
(31, 535, 'u89x1w59tdhgp9llq7ie9dgatv8w8t', '2014-08-13 16:05:56', '2014-08-27 21:49:16', '74.113.164.226', '74.113.164.226'),
(32, 552, 'ggha98lyfrci3rf51h7j50yadhn1jr', '2014-08-13 16:06:31', '2014-09-02 22:58:18', '74.113.164.226', '162.17.44.17'),
(33, 594, 'l64l6ihgd6shb1gln6je6m4jv8g7k7', '2014-09-10 06:36:46', '2014-09-10 06:37:59', '121.58.210.27', '121.58.210.27'),
(34, 673, '9ptdm5xonalpng62m2n99hjsgxs6lx', '2014-10-13 19:56:38', '2014-10-13 19:57:47', '24.224.86.91', '24.224.86.91'),
(35, 586, 'hh3md8ahcded1gywhzh0j7fseiwmi1', '2014-10-20 15:54:18', '2014-10-20 15:56:16', '115.242.140.165', '115.242.140.165'),
(36, 595, '37nu4q7hvtffmt4qx5ecn43k3ks9px', '2014-10-20 16:48:28', '2014-10-20 16:54:07', '171.101.140.70', '171.101.140.70'),
(37, 597, 'cxdyjwekes74tlz9yepebp9exactx4', '2014-10-23 04:08:25', '2014-10-23 04:08:25', '42.112.209.12', ''),
(38, 599, '9ktm2k4lksh62wfyim22064j00jec8', '2014-10-27 14:16:39', '2014-10-27 14:18:38', '110.168.229.139', '110.168.229.139'),
(39, 688, 'oc1qk9c2itpacjepzkf9j7lnrsldy1', '2014-11-13 01:28:45', '2014-11-13 01:52:04', '139.192.82.54', '139.192.82.54'),
(40, 709, 'ho4qqzyif30vxotg2lbfkdu7e4wxda', '2014-11-17 01:19:18', '2014-11-17 01:35:56', '58.182.23.39', '58.182.23.39'),
(41, 683, 'cf5yww6ufgln02a8dngnq5zom4iw1u', '2014-11-17 01:30:09', '2014-11-18 10:16:17', '112.198.77.105', '121.58.210.27'),
(42, 816, 'e51gf3y1c4i7nc1bqp4kz14acu1r8r', '2014-11-24 20:36:47', '2014-11-24 20:38:03', '144.232.131.202', '144.232.131.202'),
(43, 798, 'w2thmtjvzokv8lijly305wz9kr6mn4', '2014-11-24 20:40:32', '2014-11-24 20:41:33', '69.76.161.188', '69.76.161.188'),
(44, 952, 'cqu8qq6w1r0zvg0txptr4gk1yas7ig', '2015-10-28 22:30:16', '2015-10-28 22:30:16', '24.14.244.153', ''),
(45, 954, '8fagppl167eznjog4jr7xgjiz15ifp', '2015-10-29 16:12:34', '2015-10-29 16:12:34', '64.40.239.150', ''),
(46, 920, '32d6lroefvm46dgk7qm6g6xjdh1jry', '2015-10-29 18:58:27', '2015-10-29 18:58:27', '173.76.199.190', ''),
(47, 900, 'ms584nrwt71itfxkg9uu0dhqtlbgl9', '2015-11-03 00:31:58', '2015-11-03 00:31:58', '97.77.97.26', ''),
(48, 1013, '39yo9c0clnuuxzfquyb6vrihzsyjt1', '2015-11-05 20:21:06', '2015-11-05 20:21:06', '96.228.152.10', ''),
(49, 982, 'm7o2n8pvcrq6n43ngdi4p2x0fkoeoa', '2015-11-10 19:09:41', '2015-11-10 19:09:41', '67.52.192.2', ''),
(50, 965, 'hlvi8z5co7xfrq1r36lyd1monm86d9', '2015-11-10 20:14:05', '2015-11-10 20:14:05', '75.151.239.117', ''),
(51, 956, 'fuawoz6ol4qg76vq2y8kwbzaxanxfd', '2015-11-11 00:07:14', '2015-11-11 00:07:14', '184.183.30.114', ''),
(52, 1052, 'x38kezmfrwzq8qcsvs98zatjsc868e', '2015-11-13 16:37:21', '2015-11-13 16:37:21', '74.81.106.42', ''),
(53, 1149, 'm5vxyz2noeegl2p6mxacl92hfejfs9', '2015-11-23 21:18:12', '2015-11-23 21:18:12', '71.81.30.106', ''),
(54, 1146, '6qdyei9zsog2r3kfzm3vtjbsni34wt', '2015-11-27 16:20:21', '2015-11-27 16:20:21', '172.56.27.138', ''),
(55, 1146, 'dksvte7w9bxyr0risfuvim706ranun', '2015-11-27 16:20:21', '2015-11-27 16:20:21', '172.56.27.138', ''),
(56, 1016, 'w4748wiwe614nfjmkaamrcd7xfulfr', '2015-12-03 05:23:48', '2015-12-03 05:23:48', '216.251.96.17', ''),
(57, 1002, 'afhphqlkea37iq9co0q06fa1rupjt8', '2015-12-03 16:09:23', '2015-12-03 16:09:23', '24.230.232.142', '');

-- --------------------------------------------------------

--
-- Table structure for table `ping_msgs`
--

CREATE TABLE IF NOT EXISTS `ping_msgs` (
  `msg_id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `msg` varchar(400) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `refer` varchar(80) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ping_msgs`
--

INSERT INTO `ping_msgs` (`msg_id`, `user_id`, `msg`, `status`, `refer`, `time`) VALUES
(32, 75, 'Submit a partner sale', 1, 'submit_partner_sale_8', '0000-00-00 00:00:00'),
(33, 75, 'Submit a partner sale', 1, 'submit_partner_sale_9', '0000-00-00 00:00:00'),
(34, 75, 'hey admin, <b>hey</b>', 1, '', '2013-05-22 10:51:31');

-- --------------------------------------------------------

--
-- Table structure for table `qr_codes`
--

CREATE TABLE IF NOT EXISTS `qr_codes` (
  `qr_id` int(12) NOT NULL,
  `qr_code` varchar(20) NOT NULL,
  `url` varchar(200) NOT NULL,
  `int_info` int(12) NOT NULL,
  `info_a` varchar(200) NOT NULL,
  `info_b` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qr_codes`
--

INSERT INTO `qr_codes` (`qr_id`, `qr_code`, `url`, `int_info`, `info_a`, `info_b`) VALUES
(1, '0nxf9', '/?p=partner_scanned&set_id=29', 29, '', ''),
(3, 'accenture-zmv', '/?p=partner_scanned&set_id=55', 55, '', ''),
(4, 'bonus1-4rskz', '/?p=partner_scanned&set_id=', 0, '', ''),
(5, 'bonus10-vncll', '/?p=partner_scanned&set_id=', 0, '', ''),
(6, 'bonus11-yj34u', '/?p=partner_scanned&set_id=', 0, '', ''),
(7, 'bonus2-8upfb', '/?p=partner_scanned&set_id=', 0, '', ''),
(8, 'bonus3-9oh5a', '/?p=partner_scanned&set_id=', 0, '', ''),
(9, 'bonus4-avcgq', '/?p=partner_scanned&set_id=', 0, '', ''),
(10, 'bonus5-b0rvw', '/?p=partner_scanned&set_id=', 0, '', ''),
(11, 'bonus6-e7g45', '/?p=partner_scanned&set_id=', 0, '', ''),
(12, 'bonus7-k1xa6', '/?p=partner_scanned&set_id=', 0, '', ''),
(13, 'bonus8-nbe38', '/?p=partner_scanned&set_id=', 0, '', ''),
(14, 'bonus9-roxf3', '/?p=partner_scanned&set_id=', 0, '', ''),
(15, 'affecto-esi', '/?p=partner_scanned&set_id=', 0, '', ''),
(16, 'amazon-tm6', '/?p=partner_scanned&set_id=46', 46, '', ''),
(17, 'amberleaf-vd1', '/?p=partner_scanned&set_id=37', 37, '', ''),
(18, 'analytix-jeh', '/?p=partner_scanned&set_id=41', 41, '', ''),
(19, 'appfluent-lr1', '/?p=partner_scanned&set_id=51', 51, '', ''),
(20, 'attivio-1jv', '/?p=partner_scanned&set_id=40', 40, '', ''),
(21, 'brainbrokers-ii8', '/?p=partner_scanned&set_id=', 0, '', ''),
(22, 'bytemanagers-5n4', '/?p=partner_scanned&set_id=', 0, '', ''),
(23, 'capgemini-95t', '/?p=partner_scanned&set_id=54', 54, '', ''),
(24, 'cisco-662', '/?p=partner_scanned&set_id=73', 73, '', ''),
(25, 'cloudera-e7p', '/?p=partner_scanned&set_id=65', 65, '', ''),
(26, 'cloudperspective-flt', '/?p=partner_scanned&set_id=31', 31, '', ''),
(27, 'cloudsherpas-9xn', '/?p=partner_scanned&set_id=39', 39, '', ''),
(28, 'cognizant-x0a', '/?p=partner_scanned&set_id=42', 42, '', ''),
(29, 'collaborative-kex', '/?p=partner_scanned&set_id=30', 30, '', ''),
(30, 'corporatetech-lh5', '/?p=partner_scanned&set_id=50', 50, '', ''),
(31, 'datasift-8rt', '/?p=partner_scanned&set_id=36', 36, '', ''),
(32, 'datasource-8ns', '/?p=partner_scanned&set_id=', 0, '', ''),
(33, 'dell-ipc', '/?p=partner_scanned&set_id=64', 64, '', ''),
(34, 'deloutte-haw', '/?p=partner_scanned&set_id=33', 33, '', ''),
(35, 'eccella-1yu', '/?p=partner_scanned&set_id=45', 45, '', ''),
(36, 'engagepoint-ryg', '/?p=partner_scanned&set_id=62', 62, '', ''),
(37, 'etlfactory-nbs', '/?p=partner_scanned&set_id=', 0, '', ''),
(38, 'hcl-g5g', '/?p=partner_scanned&set_id=60', 60, '', ''),
(39, 'hexaware-3xz', '/?p=partner_scanned&set_id=69', 69, '', ''),
(40, 'highpoint-r6i', '/?p=partner_scanned&set_id=47', 47, '', ''),
(41, 'hitachi-rm4', '/?p=partner_scanned&set_id=44', 44, '', ''),
(42, 'infolink-ctj', '/?p=partner_scanned&set_id=', 0, '', ''),
(43, 'infosys-tdq', '/?p=partner_scanned&set_id=66', 66, '', ''),
(44, 'infoverity-n92', '/?p=partner_scanned&set_id=53', 53, '', ''),
(45, 'intricity-mkr', '/?p=partner_scanned&set_id=63', 63, '', ''),
(46, 'logan-rgd', '/?p=partner_scanned&set_id=56', 56, '', ''),
(47, 'lumendata-x1r', '/?p=partner_scanned&set_id=43', 43, '', ''),
(48, 'mapr-jko', '/?p=partner_scanned&set_id=34', 34, '', ''),
(49, 'momentum-xnm', '/?p=partner_scanned&set_id=68', 68, '', ''),
(50, 'myersholum-8gn', '/?p=partner_scanned&set_id=', 0, '', ''),
(51, 'oliktech-rel', '/?p=partner_scanned&set_id=', 0, '', ''),
(52, 'oracle-xuj', '/?p=partner_scanned&set_id=', 0, '', ''),
(53, 'perficient-r3e', '/?p=partner_scanned&set_id=', 0, '', ''),
(54, 'pwc-n3n', '/?p=partner_scanned&set_id=', 0, '', ''),
(55, 'rcg-ktm', '/?p=partner_scanned&set_id=59', 59, '', ''),
(56, 'scalable-xjk', '/?p=partner_scanned&set_id=48', 48, '', ''),
(57, 'softpath-ist', '/?p=partner_scanned&set_id=61', 61, '', ''),
(58, 'ssg-a73', '/?p=partner_scanned&set_id=32', 32, '', ''),
(59, 'systech-m96', '/?p=partner_scanned&set_id=67', 67, '', ''),
(60, 'tata-uwb', '/?p=partner_scanned&set_id=', 0, '', ''),
(61, 'teradata-pr4', '/?p=partner_scanned&set_id=52', 52, '', ''),
(62, 'trinus-msc', '/?p=partner_scanned&set_id=', 0, '', ''),
(63, 'wipro-an4', '/?p=partner_scanned&set_id=70', 70, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `quarters`
--

CREATE TABLE IF NOT EXISTS `quarters` (
  `quarter_id` int(12) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `sort` int(12) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `quarters`
--

INSERT INTO `quarters` (`quarter_id`, `name`, `start_date`, `end_date`, `sort`, `active`) VALUES
(1, 'Q1FY16', '2016-01-01 00:00:00', '2016-03-01 00:00:00', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `question_id` int(12) NOT NULL,
  `trivia_id` int(12) NOT NULL,
  `question` text NOT NULL,
  `question_type` text NOT NULL,
  `question_order` int(12) NOT NULL,
  `broadcasted` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `trivia_id`, `question`, `question_type`, `question_order`, `broadcasted`, `active`) VALUES
(1, 1, 'WHAT WAS THE SERIES NUMBER OF ''HAL'' IN 2001: A SPACE ODYSSEY?', 'multiple', 2, 1, 1),
(2, 1, 'HOW MANY ZEROES AFTER THE ''1'' IN AN EXABYTE?', 'multiple', 3, 1, 1),
(3, 1, 'WHAT DOES ''NAS'' STAND FOR?', 'multiple', 4, 1, 1),
(4, 1, 'WHAT IS YOUR ROLE WHERE YOU WORK?', 'multiple', 5, 1, 1),
(5, 1, 'WHAT PERCENTAGE OF THE WORLD’S DATA WAS CREATED IN JUST THE LAST 2 YEARS?\n', 'multiple', 6, 1, 1),
(6, 1, 'WHAT RANK WAS DATA ON “STAR TREK: THE NEXT GENERATION”?', 'multiple', 7, 1, 1),
(7, 1, 'WHAT IS CURRENTLY THE LARGEST UNIT OF DATA MEASUREMENT IN COMPUTING?', 'multiple', 8, 1, 1),
(8, 1, '[PHOTO OF BRAINIAC LOOKING MUSCULAR – IT IS REVEALED OVER 15 SECONDS]', 'multiple', 9, 1, 1),
(9, 1, 'WHICH OF THESE FUNCTIONS SCALE OUT LINEARLY ON EMC ISILON?', 'multiple', 10, 1, 1),
(10, 1, 'HOW FAST CAN THE HUMAN GENOME BE DECODED IN 2013?', 'multiple', 11, 1, 1),
(11, 1, 'WHAT PERCENT OF EXISTING DATA IN THE DIGITAL UNIVERSE HAS BEEN ANALYZED?', 'multiple', 12, 1, 1),
(12, 1, 'WHAT IS 2+2?', 'multiple', 1, 1, 1),
(13, 1, 'WHICH CAMPAIGNER UTILIZED BIG DATA TO WIN THE PRESIDENCY?', 'multiple', 13, 1, 1),
(14, 1, '[PICTURE IMAGE REVEALED:  PERSON’S BACK + PHOTO OF DISNEY’S “UP” POSTER ||  GROCERY STORE+ BIRTHDAY CAKE WITH NUMBER CANDLES ON IT. IN THIS PICTOGRAM]', 'multiple', 14, 1, 1),
(15, 1, 'WHAT PROJECTS DO YOU HAVE COMING UP IN THE NEXT 12 MONTHS?', 'multiple', 15, 1, 1),
(16, 1, 'WHAT IS THE IMPACT OF BAD OR POOR QUALITY DATA ON US BUSINESSES ANNUALLY?', 'multiple', 16, 1, 1),
(17, 1, 'A SINGLE EMC ISILON CLUSTER CAN BE SCALED TO WHAT CAPACITY?', 'multiple', 17, 1, 1),
(18, 1, 'WHAT IS YOUR ORGANIZATIONS CURRENT STORAGE AMOUNT?', 'multiple', 18, 1, 1),
(19, 1, 'HOW MANY PHOTOS HAS FACEBOOK HAD TO STORE?', 'multiple', 19, 1, 1),
(20, 1, 'WHAT PERCENT OF ALL EXTERNAL STORAGE SHIPPED IN THE LAST DECADE IS FROM EMC?', 'multiple', 20, 1, 1),
(21, 1, 'WHAT WERE THE MOST TWEETED WORDS FOUND BY EMC’S BIG DATA “FIREHOSE” PROJECT?', 'multiple', 21, 1, 1),
(22, 1, 'WHO ARE YOUR CURRENT STORAGE VENDORS?', 'multiple', 22, 1, 1),
(23, 1, 'AN EMC ISILON NETWORK-ATTACHED STORAGE SOLUTION RESULTS IN WHICH OF THE FOLLOWING?', 'multiple', 23, 1, 1),
(24, 1, 'WHAT ORGANIZATION OWNS 6 OF THE 10 MOST POWERFUL KNOWN SUPERCOMPUTERS IN THE WORLD?', 'multiple', 24, 1, 1),
(25, 1, 'WALMART DATABASES CONTAIN MORE THAN 2.5 PETABYTES OF DATA. THAT’S EQUIVALENT TO 167 TIMES ALL THE BOOKS HELD IN WHAT PLACE?', 'multiple', 25, 1, 1),
(26, 1, 'WHO INTRODUCED THE FIRST HIGH-PERFORMANCE, DATA CO-PROCESSING HADOOP APPLIANCE FOR UNSTRUCTURED ENTERPRISE DATA?', 'multiple', 26, 1, 1),
(27, 1, 'THE BIG DATA RESEARCH AND DEVELOPMENT INITIATIVE IS A PROGRAM TO EXPLORE HOW BIG DATA CAN ADDRESS PROBLEMS FACED BY WHO?', 'multiple', 27, 1, 1),
(28, 1, 'EBAY, MANAGED BY EMC INFRASTRUCTURE, HAS APPROXIMATELY HOW MANY USERS?', 'multiple', 28, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `questions_info`
--

CREATE TABLE IF NOT EXISTS `questions_info` (
  `questions_info_id` int(12) NOT NULL,
  `question_id` int(12) NOT NULL,
  `info_type` varchar(60) NOT NULL,
  `int_info` int(12) NOT NULL,
  `info` varchar(255) NOT NULL,
  `info_b` text NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions_info`
--

INSERT INTO `questions_info` (`questions_info_id`, `question_id`, `info_type`, `int_info`, `info`, `info_b`, `time`) VALUES
(24, 12, 'primer', 0, '', '', '0000-00-00 00:00:00'),
(26, 4, 'poll', 0, '', '', '0000-00-00 00:00:00'),
(27, 15, 'has_multiple', 0, '', '', '0000-00-00 00:00:00'),
(28, 15, 'poll', 0, '', '', '0000-00-00 00:00:00'),
(30, 18, 'poll', 0, '', '', '0000-00-00 00:00:00'),
(31, 22, 'has_multiple', 0, '', '', '0000-00-00 00:00:00'),
(32, 22, 'poll', 0, '', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE IF NOT EXISTS `quizzes` (
  `quiz_id` int(12) NOT NULL,
  `quiz_name` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`quiz_id`, `quiz_name`) VALUES
(1, 'Identity Group Quiz'),
(2, 'Fraud Group Quiz'),
(3, 'Clinical');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes_info`
--

CREATE TABLE IF NOT EXISTS `quizzes_info` (
  `quizzes_info_id` int(14) NOT NULL,
  `quiz_id` int(12) NOT NULL,
  `info_type` varchar(30) CHARACTER SET latin1 NOT NULL,
  `int_info` int(12) NOT NULL,
  `info` varchar(80) CHARACTER SET latin1 NOT NULL,
  `info_b` varchar(80) CHARACTER SET latin1 NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quizzes_info`
--

INSERT INTO `quizzes_info` (`quizzes_info_id`, `quiz_id`, `info_type`, `int_info`, `info`, `info_b`, `time`) VALUES
(1, 1, 'user_group', 0, 'identity', '', '0000-00-00 00:00:00'),
(2, 2, 'user_group', 0, 'fraud', '', '0000-00-00 00:00:00'),
(3, 3, 'user_group', 0, 'clinical', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_answers`
--

CREATE TABLE IF NOT EXISTS `quiz_answers` (
  `answer_id` int(12) NOT NULL,
  `question_id` int(12) NOT NULL,
  `answer` varchar(1000) CHARACTER SET latin1 NOT NULL,
  `correct` tinyint(1) NOT NULL,
  `sort_order` tinyint(3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quiz_answers`
--

INSERT INTO `quiz_answers` (`answer_id`, `question_id`, `answer`, `correct`, `sort_order`) VALUES
(1, 1, 'Disease Management/Wellness Outreach', 1, 1),
(2, 1, 'Enrollment', 1, 2),
(3, 1, 'Regulatory Compliance', 1, 3),
(4, 1, 'Marketing efforts', 1, 4),
(5, 2, 'Claim process', 1, 1),
(6, 2, 'Marketing', 1, 2),
(7, 2, 'Compliance', 1, 3),
(8, 2, 'Provider Network Management', 1, 4),
(9, 3, 'With blood, sweat and tears', 1, 1),
(10, 3, 'It’s manual, and very time consuming ', 1, 2),
(11, 3, 'It’s manual, but very effective', 1, 3),
(12, 3, 'We have analytics tools in place', 1, 4),
(13, 4, 'Large data sets', 1, 1),
(14, 4, 'Lack of comprehensive profile data on users', 1, 2),
(15, 4, 'Can’t spot suspicious patterns or relationships', 1, 3),
(16, 4, 'Effort doesn’t fit with our workflow', 1, 1),
(17, 5, 'We leverage a vendor solution to support pop health', 1, 3),
(18, 5, 'We use a homegrown solution', 1, 2),
(19, 5, 'We have no formal pop health tool in place', 1, 1),
(20, 6, 'Accuracy of the science/analytics driving the tool', 1, 3),
(21, 6, 'User interface', 1, 2),
(22, 6, 'Ability to customize ', 1, 4),
(23, 6, 'Customer Service', 1, 1),
(24, 6, 'Availability of consultative services', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_answers_info`
--

CREATE TABLE IF NOT EXISTS `quiz_answers_info` (
  `quiz_answers_info_id` int(14) NOT NULL,
  `answer_id` int(12) NOT NULL,
  `info_type` varchar(30) CHARACTER SET latin1 NOT NULL,
  `int_info` int(12) NOT NULL,
  `info` varchar(80) CHARACTER SET latin1 NOT NULL,
  `info_b` varchar(80) CHARACTER SET latin1 NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quiz_answers_info`
--

INSERT INTO `quiz_answers_info` (`quiz_answers_info_id`, `answer_id`, `info_type`, `int_info`, `info`, `info_b`, `time`) VALUES
(3, 12, 'text_field', 1, '', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_answer_times`
--

CREATE TABLE IF NOT EXISTS `quiz_answer_times` (
  `time_id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `question_id` int(12) NOT NULL,
  `start_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

CREATE TABLE IF NOT EXISTS `quiz_questions` (
  `question_id` int(12) NOT NULL,
  `question` varchar(1000) CHARACTER SET latin1 NOT NULL,
  `sort_order` int(3) NOT NULL,
  `points` int(7) NOT NULL,
  `quiz_id` int(12) NOT NULL,
  `timer_seconds` int(9) NOT NULL,
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  `polling` tinyint(1) NOT NULL DEFAULT '0',
  `user_group` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quiz_questions`
--

INSERT INTO `quiz_questions` (`question_id`, `question`, `sort_order`, `points`, `quiz_id`, `timer_seconds`, `locked`, `polling`, `user_group`) VALUES
(1, 'Better member data would help my organization improve:', 1, 0, 1, 0, 0, 0, ''),
(2, 'Where does inaccurate provider data impact your organization the most?', 2, 0, 1, 0, 0, 0, ''),
(3, 'How does your organization address fraud, waste and abuse detection?', 1, 0, 2, 0, 0, 0, ''),
(4, 'What’s your biggest hurdle to detecting fraud?', 2, 0, 2, 0, 0, 0, ''),
(5, 'What is the state of your population health management process?', 1, 0, 3, 0, 0, 0, ''),
(6, 'Which of the following is most likely to influence your decision to purchase a pop health tool?', 2, 0, 3, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions_info`
--

CREATE TABLE IF NOT EXISTS `quiz_questions_info` (
  `quiz_questions_info_id` int(14) NOT NULL,
  `question_id` int(12) NOT NULL,
  `info_type` varchar(30) CHARACTER SET latin1 NOT NULL,
  `int_info` int(12) NOT NULL,
  `info` varchar(80) CHARACTER SET latin1 NOT NULL,
  `info_b` varchar(80) CHARACTER SET latin1 NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE IF NOT EXISTS `referrals` (
  `referral_id` int(12) NOT NULL,
  `name` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `company` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `msg` varchar(500) NOT NULL,
  `user_created` int(12) NOT NULL,
  `user_claimed` int(12) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `claimed_datetime` datetime NOT NULL,
  `sent_qty` int(2) NOT NULL DEFAULT '0',
  `active` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `referrals`
--

INSERT INTO `referrals` (`referral_id`, `name`, `title`, `company`, `email`, `msg`, `user_created`, `user_claimed`, `created_datetime`, `claimed_datetime`, `sent_qty`, `active`) VALUES
(41, 'brian l', 'qa', 'e:m', 'bl@entermarketing.com', 'join', 3, 3, '2013-07-24 21:02:17', '2013-07-24 21:02:17', 1, 1),
(42, 'fabio c', 'QA', 'e:m', 'fc@entermarketing.com', 'join', 3, 3, '2013-07-24 21:56:13', '2013-07-24 21:56:13', 1, 1),
(43, 'ray', 'designer', 'e:m', 'rm@entermarketing.com', 'join', 3, 3, '2013-07-24 21:58:08', '2013-07-24 21:58:08', 1, 1),
(44, 'Florence Sullivan', 'Events Manager', 'Juniper Network', 'fsullivan@juniper.net', 'Hi Flo!  Earning points and learning gamefication with Enter:Marketing!', 15, 15, '2013-07-30 16:27:02', '2013-07-30 16:27:02', 1, 1),
(45, 'Alex', 'Director Marketing', 'RSA', 'alex.bender@rsa.com', 'Alex - I''m playing with EnterMarketing''s Gamification platform and am referring you for points. Pay no heed : )', 92, 92, '2013-07-30 17:20:49', '2013-07-30 17:20:49', 1, 1),
(46, 'Stuart Carol', 'CEO', 'self-employed', 'applejacks18@yahoo.com', 'Join. This is great.', 94, 94, '2013-07-30 17:46:13', '2013-07-30 17:46:13', 1, 1),
(47, 'Michael', 'Director', 'Eggberts', 'scottmarkman@gmail.com', 'I''m not sure how to great a referral link, but a referral link should be imbedded in this emaill.', 94, 94, '2013-07-30 17:49:19', '2013-07-30 17:49:19', 1, 1),
(48, 'Justin Thorn', 'Director ', 'EcoSolutions', 'justin.r.Thorn@gmail.com', 'Hey Justin - this is what you need to grow your business. Of course the issue is you need money first.....quandry..', 92, 92, '2013-07-30 17:50:04', '2013-07-30 17:50:04', 1, 1),
(49, 'scott', 'manager', 'happy days', 'smarkman@yahoo.com', 'Watch this', 94, 94, '2013-07-30 17:55:42', '2013-07-30 17:55:42', 1, 1),
(50, 'Charlie', 'VP', 'Market Sales', 'scottmarkman@hotmail.com', 'Join this', 94, 94, '2013-07-30 17:56:09', '2013-07-30 17:56:09', 1, 1),
(51, 'Marty Vales', 'Coordinator', 'Hosery Plus', 'scott@scottmarkman.net', 'Check this out.', 94, 94, '2013-07-30 17:56:51', '2013-07-30 17:56:51', 1, 1),
(52, 'Fryer Tuck', 'Consultant', 'Robin Hood', 'sidneysloanoffice@gmail.com', 'This is amazing', 94, 94, '2013-07-30 17:58:07', '2013-07-30 17:58:07', 1, 1),
(53, 'Test Email', 'Tester', 'Test', 'test@test.com', 'Test', 94, 94, '2013-07-30 17:58:31', '2013-07-30 17:58:31', 1, 1),
(54, 'Scott', 'Scott', 'Scott', 'scott@scottmarkman.com', 'Please join', 94, 94, '2013-07-30 18:03:17', '2013-07-30 18:03:17', 1, 1),
(55, 'Helda Lopes', 'Sr. Director, Partner Marketing', 'Juniper Networks', 'hlopes@juniper.net', 'Looking to earn more points with JMC and Gamefication', 15, 15, '2013-07-30 18:04:43', '2013-07-30 18:04:43', 1, 1),
(56, 'Carolyn Cox', 'Sr. Director Global Channel Marketing', 'VM Ware', 'coxc@vmware.com', 'Carolyn - as you launch your JMC equivalent for VMWare, one of the things we saw as a success for our numbers and engagement is Gamefication.  EnterMarketing has done a great job for the platform and our Global Partner Conference.', 15, 15, '2013-07-30 18:06:42', '2013-07-30 18:06:42', 1, 1),
(57, 'Test', 'Test', 'Test', 'test@test1.com', 'I''m probably going to get disqualified for all this', 94, 94, '2013-07-30 18:07:41', '2013-07-30 18:07:41', 1, 1),
(58, 'Marilyn', 'Specialist', 'Sizzle Steak', 'marily@sizzlesteak.com', 'Join please', 94, 94, '2013-07-30 18:08:23', '2013-07-30 18:08:23', 1, 1),
(59, 'Ronni', 'VP of Sales', 'JCC', 'ronni@jcc.com', 'Join this program it''s great', 94, 94, '2013-07-30 18:08:53', '2013-07-30 18:08:53', 1, 1),
(60, 'Frederick', 'Real Estate', 'Foders', 'frederick@foders.com', 'This is a great site', 94, 94, '2013-07-30 18:10:14', '2013-07-30 18:10:14', 1, 1),
(61, 'Nalina Athyantha', 'Product Marketing Manger', 'RSA SilverTaiil', 'Nalina.Athyantha@rsa.com', 'Hi Nalina, Want to refer EnterMarketing for any future SilverTail social projects that we might want to entertain using social gamification techniques. Give me a buzz if you''re interested.Nick', 92, 92, '2013-07-30 18:26:05', '2013-07-30 18:26:05', 1, 1),
(62, 'Scott', 'Owner', 'Freelancer', 'admin@scottmarkman.net', 'Check this out.', 94, 94, '2013-07-30 19:20:29', '2013-07-30 19:20:29', 1, 1),
(63, 'Trevor Wilson', 'Business Development', 'Coretek Solutions', 'trevor.wilson@coretekservices.com', 'Check this out.', 40, 40, '2013-07-31 17:24:04', '2013-07-31 17:24:04', 1, 1),
(64, 'Amy Little', 'Marketing Manager', 'Infoblox', 'alittle@infoblox.com', 'Hi Amy - I know you and I are in similar roles, we''ve used EnterMarketing for a variety of projects ranging from marketing collateral to gamefication.  Not sure if this is in your line of work, but I wanted to send you their information to keep in your back pocket.xoxoAnne', 15, 15, '2013-07-31 17:50:55', '2013-07-31 17:50:55', 1, 1),
(65, 'Richard Glisky', 'CEO', 'Compsat Technology', 'rglisky@compsat.com', 'Check this out ...', 40, 40, '2013-07-31 17:53:34', '2013-07-31 17:53:34', 1, 1),
(66, 'david', 'dev', 'E:M', 'dbaldo@entermarketing.com', 'hey!', 1, 1, '2013-07-31 18:33:02', '2013-07-31 18:33:02', 1, 1),
(67, 'Sanjeev Sanghera', 'Partner Portal Program Manager', 'Juniper Networks', 'ssanghera@juniper.net', 'Thought you might be interested in checking out what enter:marketing has to offer.', 21, 21, '2013-08-01 03:20:26', '2013-08-01 03:20:26', 1, 1),
(68, 'Taryn Gifford', 'Web Marketing', 'Juniper Networks', 'tgifford@juniper.net', 'Thought you might be interested in checking out what enter:marketing has to offer.', 21, 21, '2013-08-01 03:21:19', '2013-08-01 03:21:19', 1, 1),
(69, 'Roger Horine', 'Program Administrator', 'Juniper Networks', 'rhorine@juniper.net', 'Hi Roger - Was thinking of you in regards to gamefication... perhaps it is something can utilize for your newsletters...  Anne', 15, 15, '2013-08-01 20:07:44', '2013-08-01 20:07:44', 1, 1),
(70, 'Janice LaTourette', 'Channel Development', 'Juniper Networks', 'jlatourette@juniper.net', 'Hi Janice - We work with Enter quite frequently for a variety of different things.  I was thinking of you and the Champion''s program and perhaps Gamefication can be something useful...  I''ll send you some more details.  Let me know if you have any questions. Anne', 15, 15, '2013-08-01 20:11:36', '2013-08-01 20:11:36', 1, 1),
(71, 'Jenny Fong', 'Channel Marketing', 'VM Ware', 'Fongj@vmware.com', 'Hi Jenny - this is the gamefication company I was talking about the other night.  Hope you are having a good week!!Anne', 15, 15, '2013-08-05 18:42:23', '2013-08-05 18:42:23', 1, 1),
(72, 'CaseyLynn Smirnio', 'Social Media Maven', 'Juniper Networks / Core Ideas', 'csmirnio@juniper.net', 'Hi Casey - Here''s a fun way to get in the game.Anne', 15, 15, '2013-08-08 16:07:04', '2013-08-08 16:07:04', 1, 1),
(73, 'Lauren Grady', 'Marketing Assistant', 'Juniper Networks', 'lgrady@juniper.net', 'Hey Lauren,thought you might be interested in checking out the programs enter:marketing has to offer.-Michelle Hagen-Michelle', 21, 21, '2013-08-08 20:48:05', '2013-08-08 20:48:05', 1, 1),
(74, 'Andrea Jaramillo', 'Marketing Program Manager', 'Juniper Networks', 'ajaramillo@juniper.net', 'Hi Andrea - this is a great company that we engage with on various Marketing items from campaign collateral, events and gamefication', 15, 15, '2013-08-12 20:32:55', '2013-08-12 20:32:55', 1, 1),
(75, 'test test', 'test', 'test', 'tes1212312t@test.com', 'test', 1, 1, '2013-10-09 23:35:34', '2013-10-09 23:35:34', 1, 1),
(76, 'test test', 'test', 'test', 'testsdfsfdsfsdfsdfs@test.com', 'tests fas dfd fas f', 1, 1, '2013-10-09 23:36:08', '2013-10-09 23:36:08', 1, 1),
(77, 'Lindsey', 'Test', 'enter:marketing', 'lp@entermarketing.com', 'Hi Lindsey, please forward this to me', 113, 113, '2013-10-15 17:04:52', '2013-10-15 17:04:52', 1, 1),
(78, 'test', 't', 't', 'a@aaa.com', 'asdfasdfasdfs', 34, 34, '2013-10-15 21:26:41', '2013-10-15 21:26:41', 1, 1),
(79, 'rach', 't', 'c', 'ra@entermarketing.com', 'asdf', 34, 34, '2013-10-15 21:29:53', '2013-10-15 21:29:53', 1, 1),
(80, 'test', 'test', 'test', 'test234234@entermarketing.com', 'test', 1, 1, '2013-10-16 17:58:26', '2013-10-16 17:58:26', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE IF NOT EXISTS `resources` (
  `resource_id` int(12) NOT NULL,
  `title` varchar(80) NOT NULL,
  `descrip` text NOT NULL,
  `type` varchar(30) NOT NULL,
  `location` varchar(1000) NOT NULL,
  `user_id` int(12) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `time_added` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`resource_id`, `title`, `descrip`, `type`, `location`, `user_id`, `active`, `time_added`) VALUES
(77, '2015 Dell Security Annual Threat Report', 'Best Practice Sales Strategies for corporate reputation, remediation costs and data loss consolidation. In the 2015 Dell Security Annual Threat Report, we’ll present the most common attacks that were\nobserved by the Dell SonicWALL Threat Research Team in 2014 and the ways we expect emergent\nthreats to affect businesses of all sizes throughout 2015. Our goal is not to frighten, but to inform and\nprovide organizations of all sizes with practical advice that will help them adjust their practices to more\neffectively prepare for and prevent attacks, even from threat sources that have yet to emerge.', 'pdf', '2015 Dell Security Annual Threat Report.pdf', 3, 1, '2013-10-31 00:59:47'),
(78, 'Get Big Security For Your Small Business With Dell', 'To counter emerging threats, your small business needs big security. Watch this Dell Software video to learn how Dell SonicWALL TZ firewalls deliver the same level of security, performance and manageability as firewalls used by banks, government agencies and large businesses – at an affordable price.', 'video', 'video/big_security_small_business.mp4', 3, 1, '2013-10-31 00:59:47'),
(79, 'Types of Cyber Attacks and How To Prevent Them', 'This ebook details the strategies and tools that cybercriminals use to infiltrate your network and how you\r\ncan stop them.', 'pdf', 'Types of Cyber Attacks and How To Prevent Them.pdf', 3, 1, '2013-10-31 00:59:47'),
(80, 'Dell SonicPoint Wireless Access Points', 'This infographic gives an overview of how Dell SonicPoint Wireless Access Points help build a better, faster network.', 'pdf', 'tz-series-infographic.pdf', 3, 1, '2013-10-31 00:59:47'),
(81, 'NSA Series Firewalls', 'The ideal choice for distributed enterprises with remote and branch offices, SMBs, school campuses and other public institutions, Dell SonicWALL NSA Series next-generation firewalls (NGFWs) deliver the high level of security, application control and performance across wired and wireless networks that network administrators have come to expect from a recognized industry leader.', 'pdf', 'NSA Series Firewalls.pdf', 3, 1, '2013-10-31 00:59:47'),
(82, 'TZ Series Battlecard', 'A competitive battlecard for Dell versus Fortinet SMB Firewalls.', 'pdf', 'Dell SonicWALL vs  Fortinet SMB Firewalls Battle Card - September 2015.pdf', 3, 1, '2013-10-31 00:59:47'),
(83, 'Network Security For Retail Small Businesses', 'Simple step-by-step IT solutions for small business in retail to leverage\r\nadvanced protection technology in ways that are affordable, fast and easy', 'pdf', 'Network Security For Small Businesses.pdf', 3, 1, '2013-10-31 00:59:47'),
(84, 'Dell SonicWALL Security News Podcast', 'Get the latest updates on the threat landscape and some of the tools that users and admins can use to protect themselves.', 'video', 'video/security_new_podcast.mp4', 3, 1, '2013-10-31 00:59:47'),
(85, 'The Importance of DPI SSL ', 'Do you know how much of your web traffic is HTTPS traffic? It''s on the rise and businesses need to ensure that their firewalls can inspect this traffic. This video gives you an overview of this important component of enterprise security and how it can impact organizations.', 'video', 'video/dpi_ssl.mp4', 3, 1, '2013-10-31 00:59:47'),
(86, 'Dell SonicWALL SuperMassive Series Next-Generation Firewalls', 'Understand what prospects are looking for when evaluating firewalls, and the advantages of Dell SonicWALL SuperMassive Series Next-Generation Firewalls', 'pdf', 'sonicwall-supermassive-partner-prospecting-card.pdf', 3, 1, '2013-10-31 00:59:47'),
(87, 'Dell Security Overdrive Solution Selling', 'Networks are growing more complex, and understanding the big picture of security and where it''s needed is pivotal to stay safe. Go beyond just firewalls and sell full security solutions.', 'video', 'video/dell_security_overdrive_solution_selling.mp4', 3, 1, '2013-10-31 00:59:47'),
(88, 'Dell SuperMassive vs. Fortigate Mid/High-Range Firewalls', 'Take a look at the benefits of Dell SuperMassive over Fortigate mid/high-range firewalls', 'pdf', 'sonicwall-vs-fortinet-sm-firewalls-battle-card.pdf', 3, 1, '2013-10-31 00:59:47'),
(89, 'Dell Security Podcast', 'Learn about some of the latest security news across the web and best security practices to protect against exploits that hackers use.', 'video', 'video/december_podcast.mp4', 3, 1, '2013-10-31 00:59:47');

-- --------------------------------------------------------

--
-- Table structure for table `resources_info`
--

CREATE TABLE IF NOT EXISTS `resources_info` (
  `resources_info_id` int(12) NOT NULL,
  `resource_id` int(12) NOT NULL,
  `info_type` varchar(80) NOT NULL,
  `int_info` int(12) NOT NULL,
  `info_a` varchar(200) NOT NULL,
  `info_b` varchar(200) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resources_info`
--

INSERT INTO `resources_info` (`resources_info_id`, `resource_id`, `info_type`, `int_info`, `info_a`, `info_b`, `time`) VALUES
(1, 73, 'filter_type', 0, 'download_resource', '', '0000-00-00 00:00:00'),
(2, 74, 'filter_type', 0, 'download_resource', '', '0000-00-00 00:00:00'),
(3, 75, 'filter_type', 0, 'download_resource', '', '0000-00-00 00:00:00'),
(4, 76, 'filter_type', 0, 'download_resource', '', '0000-00-00 00:00:00'),
(5, 77, 'filter_type', 0, 'download_resource', '', '0000-00-00 00:00:00'),
(6, 78, 'filter_type', 0, 'download_resource', '', '0000-00-00 00:00:00'),
(7, 79, 'filter_type', 0, 'download_resource', '', '0000-00-00 00:00:00'),
(8, 80, 'filter_type', 0, 'download_resource', '', '0000-00-00 00:00:00'),
(9, 81, 'filter_type', 0, 'download_resource', '', '0000-00-00 00:00:00'),
(10, 82, 'filter_type', 0, 'download_resource', '', '0000-00-00 00:00:00'),
(11, 83, 'filter_type', 0, 'download_resource', '', '0000-00-00 00:00:00'),
(12, 84, 'filter_type', 0, 'download_resource', '', '0000-00-00 00:00:00'),
(13, 85, 'filter_type', 0, 'download_resource', '', '0000-00-00 00:00:00'),
(14, 86, 'filter_type', 0, 'share_resource', '', '0000-00-00 00:00:00'),
(15, 87, 'filter_type', 0, 'download_resource', '', '0000-00-00 00:00:00'),
(18, 82, 'resource_category', 0, 'tzseries', '', '0000-00-00 00:00:00'),
(19, 81, 'resource_category', 0, 'nsaseries', '', '0000-00-00 00:00:00'),
(20, 84, 'resource_category', 0, 'videos', '', '0000-00-00 00:00:00'),
(21, 85, 'resource_category', 0, 'videos', '', '0000-00-00 00:00:00'),
(22, 86, 'filter_type', 0, 'download_resource', '', '0000-00-00 00:00:00'),
(23, 86, 'resource_category', 0, 'supermassive', '', '0000-00-00 00:00:00'),
(24, 87, 'resource_category', 0, 'videos', '', '0000-00-00 00:00:00'),
(25, 88, 'resource_category', 0, 'supermassive', '', '0000-00-00 00:00:00'),
(26, 88, 'filter_type', 0, 'download_resource', '', '0000-00-00 00:00:00'),
(27, 89, 'filter_type', 0, 'download_resource', '', '0000-00-00 00:00:00'),
(28, 89, 'resource_category', 0, 'videos', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `slots`
--

CREATE TABLE IF NOT EXISTS `slots` (
  `slot_id` int(12) NOT NULL,
  `slot_name` varchar(255) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `max_qty` int(8) NOT NULL,
  `slot_group` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slots`
--

INSERT INTO `slots` (`slot_id`, `slot_name`, `start_time`, `end_time`, `max_qty`, `slot_group`) VALUES
(1, 'In-person meetinng', '2014-06-11 12:00:00', '2014-06-11 12:30:00', 4, 'inperson'),
(2, 'In-person meetinng', '2014-06-11 12:30:00', '2014-06-11 13:00:00', 4, 'inperson'),
(3, 'In-person meetinng', '2014-06-11 17:30:00', '2014-06-11 18:00:00', 4, 'inperson'),
(4, 'In-person meetinng', '2014-06-11 18:30:00', '2014-06-11 19:00:00', 4, 'inperson'),
(5, 'In-person meetinng', '2014-06-11 19:00:00', '2014-06-11 19:30:00', 4, 'inperson'),
(6, 'In-person meetinng', '2014-06-12 12:15:00', '2014-06-12 12:45:00', 4, 'inperson'),
(7, 'In-person meetinng', '2014-06-12 12:45:00', '2014-06-12 13:15:00', 4, 'inperson'),
(8, 'In-person meetinng', '2014-06-12 17:35:00', '2014-06-12 18:00:00', 4, 'inperson'),
(9, 'In-person meetinng', '2014-06-12 18:00:00', '2014-06-12 18:30:00', 4, 'inperson'),
(10, 'In-person meetinng', '2014-06-12 18:30:00', '2014-06-12 19:00:00', 4, 'inperson');

-- --------------------------------------------------------

--
-- Table structure for table `trivia`
--

CREATE TABLE IF NOT EXISTS `trivia` (
  `trivia_id` int(12) NOT NULL,
  `virtual_events_id` int(12) NOT NULL,
  `started` tinyint(1) NOT NULL,
  `ended` tinyint(1) NOT NULL,
  `active` int(12) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trivia`
--

INSERT INTO `trivia` (`trivia_id`, `virtual_events_id`, `started`, `ended`, `active`) VALUES
(1, 7, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(12) NOT NULL,
  `first_name` varchar(120) NOT NULL,
  `last_name` varchar(120) NOT NULL,
  `display_name` varchar(20) NOT NULL,
  `company` varchar(80) NOT NULL,
  `title` varchar(60) NOT NULL,
  `country` varchar(30) NOT NULL,
  `city` varchar(60) NOT NULL,
  `state` varchar(40) NOT NULL,
  `zip` varchar(40) NOT NULL,
  `locale` varchar(20) NOT NULL,
  `email` varchar(80) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `password` varchar(70) NOT NULL,
  `points` int(14) NOT NULL,
  `int_other` int(10) NOT NULL,
  `other` varchar(80) NOT NULL,
  `other_b` varchar(80) NOT NULL,
  `user_group` varchar(30) NOT NULL DEFAULT '',
  `last_login` datetime NOT NULL,
  `user_id_alias` int(12) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1311 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `display_name`, `company`, `title`, `country`, `city`, `state`, `zip`, `locale`, `email`, `phone`, `image_url`, `password`, `points`, `int_other`, `other`, `other_b`, `user_group`, `last_login`, `user_id_alias`) VALUES
(759, 'Naif', 'Ahmed', 'Naif A', 'MRP', 'Dev', 'United States', '', '', '', '', 'nahmed@mrpfd.com', '555-456-7890', '', '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08', 8397, 0, '', '', '', '0000-00-00 00:00:00', 0),
(883, 'Brian', 'Travers', ' Brian T', 'MRP', '', '', '', '', '', '', 'btravers@mrpfd.com', '', '', '8581f6653176c29e128e3876708eedc38392071f611b342ed9db584ed52ed6e6', 25, 0, '', '', '', '0000-00-00 00:00:00', 0),
(892, 'Jaime', 'Romero', 'Jaime R', 'MRP', '', '', '', '', '', '', 'jromero@mrpfd.com', '', '', 'ab85f44d4a78cc17801ee9104e60199af860db8e5cba884ddd7ac0fa157a0171', 715, 0, '', '', '', '0000-00-00 00:00:00', 0),
(928, 'Jamie', 'Johnston', 'Jamie J', 'Acme', '', '', '', '', '', '', 'test34@mrpfd.com', '', '', '1b4f0e9851971998e732078544c96b36c3d01cedf7caa332359d6f1d83567014', 25, 0, '', '', '', '0000-00-00 00:00:00', 0),
(929, 'Samantha', 'Saunders', 'Samantha S', 'Acme', '', '', '', '', '', '', 'test4@mrpfd.com', '', '', '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08', 25, 0, '', '', '', '0000-00-00 00:00:00', 0),
(932, 'John', 'Doe', 'John D', 'Acme', '', '', '', '', '', '', 'test3@mrpfd.com', '', '', '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08', 25, 0, '', '', '', '0000-00-00 00:00:00', 0),
(933, 'John', 'Doe', 'John D', 'Acme', '', '', '', '', '', '', 'test5@mrpfd.com', '', '', '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08', 25, 0, '', '', '', '0000-00-00 00:00:00', 0),
(934, 'John', 'Doe', 'John D', 'Acme', '', '', '', '', '', '', 'test8@mrpfd.com', '', '', '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08', 25, 0, '', '', '', '0000-00-00 00:00:00', 0),
(935, 'John', 'Doe', 'John D', 'Acme', '', '', '', '', '', '', 'test17@mrpfd.com', '', '', '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08', 55, 0, '', '', '', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_info`
--

CREATE TABLE IF NOT EXISTS `users_info` (
  `users_info_id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `badge_id` tinyint(1) NOT NULL DEFAULT '0',
  `rank` int(3) NOT NULL,
  `info_type` varchar(30) NOT NULL,
  `int_info` bigint(20) NOT NULL,
  `info` varchar(80) NOT NULL,
  `info_b` varchar(255) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2400 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_info`
--

INSERT INTO `users_info` (`users_info_id`, `user_id`, `badge_id`, `rank`, `info_type`, `int_info`, `info`, `info_b`, `time`) VALUES
(1217, 759, -1, 0, 'visited', 1, '', '', '2014-11-05 22:25:15'),
(1218, 759, -1, 0, 'access_level', 0, 'admin', '', '0000-00-00 00:00:00'),
(1412, 759, 11, 1, 'ba__Beginner Level', -1, '', '', '2014-11-13 21:23:36'),
(1417, 759, 5, 2, 'ba__Novice Level', -1, '', '', '2014-11-14 21:49:32'),
(1419, 759, 36, 0, 'ba__On The Case', -1, '', '', '2014-11-14 21:49:44'),
(1465, 759, 34, 0, 'ba__Student', -1, '', '', '2015-05-27 14:13:34'),
(1468, 759, 6, 3, 'ba__Intermediate Level', -1, '', '', '2015-06-25 19:41:24'),
(1470, 759, -1, 0, 'has_img', 1, '', '', '2015-08-29 20:47:04'),
(1473, 759, 7, 4, 'ba__Master Level', -1, '', '', '2015-08-29 21:57:50'),
(1495, 883, -1, 0, 'visited', 1, '', '', '2015-08-31 15:08:18'),
(1506, 883, -1, 0, 'has_img', 1, '', '', '2015-09-02 00:34:49'),
(1507, 892, -1, 0, 'visited', 1, '', '', '2015-09-03 11:27:09'),
(1508, 892, -1, 0, 'has_img', 1, '', '', '2015-09-03 11:27:40'),
(1509, 892, 11, 1, 'ba__Beginner Level', -1, '', '', '2015-09-03 11:45:56'),
(1559, 928, -1, 0, 'visited', 1, '', '', '2015-09-26 19:00:44'),
(1560, 929, -1, 0, 'visited', 1, '', '', '2015-09-26 19:01:11'),
(1563, 934, -1, 0, 'visited', 1, '', '', '2015-09-29 12:45:44'),
(1564, 935, -1, 0, 'visited', 1, '', '', '2015-10-07 21:11:36'),
(1751, 883, -1, 0, 'exclude_stats', 1, '', '', '2015-11-05 16:55:00'),
(1763, 892, -1, 0, 'exclude_stats', 1, '', '', '2015-11-05 16:55:00'),
(1773, 759, -1, 0, 'exclude_stats', 1, '', '', '2015-11-05 16:55:01'),
(1784, 935, -1, 0, 'exclude_stats', 1, '', '', '2015-11-05 16:55:02'),
(1785, 928, -1, 0, 'exclude_stats', 1, '', '', '2015-11-05 16:55:02'),
(1786, 932, -1, 0, 'exclude_stats', 1, '', '', '2015-11-05 16:55:02'),
(1787, 929, -1, 0, 'exclude_stats', 1, '', '', '2015-11-05 16:55:02'),
(1788, 933, -1, 0, 'exclude_stats', 1, '', '', '2015-11-05 16:55:02'),
(1789, 934, -1, 0, 'exclude_stats', 1, '', '', '2015-11-05 16:55:02'),
(2399, 759, -1, 0, 'partner', 5, '', '', '2015-12-20 18:55:53');

-- --------------------------------------------------------

--
-- Table structure for table `user_answers`
--

CREATE TABLE IF NOT EXISTS `user_answers` (
  `user_answer_id` int(12) NOT NULL,
  `answer_id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `datetime` datetime NOT NULL,
  `received` datetime NOT NULL,
  `submitted` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1294 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_answers`
--

INSERT INTO `user_answers` (`user_answer_id`, `answer_id`, `user_id`, `active`, `datetime`, `received`, `submitted`) VALUES
(1, 29, 88, 1, '2013-11-21 18:04:41', '1974-05-23 01:05:27', '1974-05-23 01:05:28'),
(2, 29, 191, 1, '2013-11-21 18:04:42', '1974-05-23 01:05:27', '1974-05-23 01:05:28'),
(3, 29, 87, 1, '2013-11-21 18:04:42', '1974-05-23 01:05:28', '1974-05-23 01:05:28'),
(4, 29, 65, 1, '2013-11-21 18:04:43', '1974-05-23 01:05:27', '1974-05-23 01:05:28'),
(5, 29, 55, 1, '2013-11-21 18:04:43', '1974-05-23 01:05:27', '1974-05-23 01:05:28'),
(6, 29, 230, 1, '2013-11-21 18:04:43', '1974-05-23 01:05:27', '1974-05-23 01:05:28'),
(7, 29, 213, 1, '2013-11-21 18:04:44', '1974-05-23 01:05:27', '1974-05-23 01:05:28'),
(8, 29, 142, 1, '2013-11-21 18:04:44', '1974-05-23 01:05:27', '1974-05-23 01:05:28'),
(9, 29, 238, 1, '2013-11-21 18:04:44', '1974-05-23 01:05:27', '1974-05-23 01:05:28'),
(10, 29, 83, 1, '2013-11-21 18:04:44', '1974-05-23 01:05:27', '1974-05-23 01:05:28'),
(11, 29, 226, 1, '2013-11-21 18:04:45', '1974-05-23 01:05:27', '1974-05-23 01:05:28'),
(12, 29, 124, 1, '2013-11-21 18:04:45', '1974-05-23 01:05:27', '1974-05-23 01:05:28'),
(13, 29, 196, 1, '2013-11-21 18:04:46', '1974-05-23 01:05:27', '1974-05-23 01:05:28'),
(14, 29, 121, 1, '2013-11-21 18:04:46', '1974-05-23 01:05:27', '1974-05-23 01:05:28'),
(15, 29, 261, 1, '2013-11-21 18:04:46', '1974-05-23 01:05:27', '1974-05-23 01:05:28'),
(16, 29, 127, 1, '2013-11-21 18:04:46', '1974-05-23 01:05:27', '1974-05-23 01:05:28'),
(17, 29, 187, 1, '2013-11-21 18:04:46', '1974-05-23 01:05:27', '1974-05-23 01:05:28'),
(18, 29, 263, 1, '2013-11-21 18:04:47', '1974-05-23 01:05:27', '1974-05-23 01:05:28'),
(19, 29, 18, 1, '2013-11-21 18:04:47', '1974-05-23 01:05:27', '1974-05-23 01:05:28'),
(20, 29, 239, 1, '2013-11-21 18:04:47', '1974-05-23 01:05:27', '1974-05-23 01:05:28'),
(21, 29, 240, 1, '2013-11-21 18:04:47', '1974-05-23 01:05:27', '1974-05-23 01:05:28'),
(22, 29, 260, 1, '2013-11-21 18:04:47', '1974-05-23 01:05:27', '1974-05-23 01:05:28'),
(23, 29, 228, 1, '2013-11-21 18:04:47', '1974-05-23 01:05:27', '1974-05-23 01:05:28'),
(24, 29, 42, 1, '2013-11-21 18:04:48', '1974-05-23 01:05:27', '1974-05-23 01:05:28'),
(25, 29, 122, 1, '2013-11-21 18:04:49', '1974-05-23 01:05:27', '1974-05-23 01:05:28'),
(26, 29, 202, 1, '2013-11-21 18:04:49', '1974-05-23 01:05:27', '1974-05-23 01:05:28'),
(27, 29, 190, 1, '2013-11-21 18:04:50', '1974-05-23 01:05:27', '1974-05-23 01:05:29'),
(28, 29, 217, 1, '2013-11-21 18:04:50', '1974-05-23 01:05:27', '1974-05-23 01:05:29'),
(29, 29, 264, 1, '2013-11-21 18:04:54', '1974-05-23 01:05:27', '1974-05-23 01:05:29'),
(30, 36, 226, 1, '2013-11-21 18:05:05', '1974-05-23 01:05:30', '1974-05-23 01:05:30'),
(31, 32, 22, 1, '2013-11-21 18:05:06', '1974-05-23 01:05:29', '1974-05-23 01:05:29'),
(32, 32, 87, 1, '2013-11-21 18:05:06', '1974-05-23 01:05:30', '1974-05-23 01:05:30'),
(33, 36, 230, 1, '2013-11-21 18:05:06', '1974-05-23 01:05:30', '1974-05-23 01:05:30'),
(34, 32, 263, 1, '2013-11-21 18:05:06', '1974-05-23 01:05:30', '1974-05-23 01:05:30'),
(35, 36, 196, 1, '2013-11-21 18:05:07', '1974-05-23 01:05:30', '1974-05-23 01:05:30'),
(36, 36, 260, 1, '2013-11-21 18:05:07', '1974-05-23 01:05:30', '1974-05-23 01:05:30'),
(37, 36, 187, 1, '2013-11-21 18:05:07', '1974-05-23 01:05:30', '1974-05-23 01:05:30'),
(38, 37, 65, 1, '2013-11-21 18:05:07', '1974-05-23 01:05:30', '1974-05-23 01:05:30'),
(39, 36, 88, 1, '2013-11-21 18:05:07', '1974-05-23 01:05:30', '1974-05-23 01:05:30'),
(40, 36, 261, 1, '2013-11-21 18:05:08', '1974-05-23 01:05:30', '1974-05-23 01:05:30'),
(41, 36, 124, 1, '2013-11-21 18:05:08', '1974-05-23 01:05:30', '1974-05-23 01:05:30'),
(42, 36, 191, 1, '2013-11-21 18:05:08', '1974-05-23 01:05:30', '1974-05-23 01:05:30'),
(43, 33, 83, 1, '2013-11-21 18:05:09', '1974-05-23 01:05:30', '1974-05-23 01:05:30'),
(44, 36, 264, 1, '2013-11-21 18:05:09', '1974-05-23 01:05:30', '1974-05-23 01:05:30'),
(45, 32, 238, 1, '2013-11-21 18:05:09', '1974-05-23 01:05:30', '1974-05-23 01:05:30'),
(46, 32, 239, 1, '2013-11-21 18:05:10', '1974-05-23 01:05:30', '1974-05-23 01:05:31'),
(47, 37, 55, 1, '2013-11-21 18:05:10', '1974-05-23 01:05:30', '1974-05-23 01:05:31'),
(48, 37, 213, 1, '2013-11-21 18:05:10', '1974-05-23 01:05:30', '1974-05-23 01:05:31'),
(49, 33, 127, 1, '2013-11-21 18:05:11', '1974-05-23 01:05:30', '1974-05-23 01:05:31'),
(50, 36, 142, 1, '2013-11-21 18:05:11', '1974-05-23 01:05:30', '1974-05-23 01:05:31'),
(51, 37, 190, 1, '2013-11-21 18:05:12', '1974-05-23 01:05:30', '1974-05-23 01:05:31'),
(52, 36, 18, 1, '2013-11-21 18:05:12', '1974-05-23 01:05:30', '1974-05-23 01:05:31'),
(53, 36, 121, 1, '2013-11-21 18:05:13', '1974-05-23 01:05:30', '1974-05-23 01:05:31'),
(54, 33, 243, 1, '2013-11-21 18:05:13', '1974-05-23 01:05:30', '1974-05-23 01:05:31'),
(55, 33, 240, 1, '2013-11-21 18:05:14', '1974-05-23 01:05:30', '1974-05-23 01:05:31'),
(56, 36, 228, 1, '2013-11-21 18:05:14', '1974-05-23 01:05:30', '1974-05-23 01:05:31'),
(57, 37, 42, 1, '2013-11-21 18:05:15', '1974-05-23 01:05:30', '1974-05-23 01:05:31'),
(58, 36, 122, 1, '2013-11-21 18:05:16', '1974-05-23 01:05:30', '1974-05-23 01:05:31'),
(59, 32, 195, 1, '2013-11-21 18:05:16', '1974-05-23 01:05:30', '1974-05-23 01:05:31'),
(60, 36, 183, 1, '2013-11-21 18:05:16', '1974-05-23 01:05:30', '1974-05-23 01:05:31'),
(61, 10, 260, 1, '2013-11-21 18:05:49', '1974-05-23 01:05:34', '1974-05-23 01:05:34'),
(62, 12, 65, 1, '2013-11-21 18:05:49', '1974-05-23 01:05:34', '1974-05-23 01:05:34'),
(63, 12, 124, 1, '2013-11-21 18:05:49', '1974-05-23 01:05:34', '1974-05-23 01:05:34'),
(64, 10, 238, 1, '2013-11-21 18:05:49', '1974-05-23 01:05:34', '1974-05-23 01:05:34'),
(65, 9, 196, 1, '2013-11-21 18:05:49', '1974-05-23 01:05:34', '1974-05-23 01:05:34'),
(66, 11, 121, 1, '2013-11-21 18:05:50', '1974-05-23 01:05:34', '1974-05-23 01:05:35'),
(67, 12, 52, 1, '2013-11-21 18:05:50', '1974-05-23 01:05:34', '1974-05-23 01:05:35'),
(68, 12, 190, 1, '2013-11-21 18:05:50', '1974-05-23 01:05:34', '1974-05-23 01:05:35'),
(69, 11, 83, 1, '2013-11-21 18:05:50', '1974-05-23 01:05:34', '1974-05-23 01:05:35'),
(70, 9, 55, 1, '2013-11-21 18:05:51', '1974-05-23 01:05:34', '1974-05-23 01:05:35'),
(71, 11, 228, 1, '2013-11-21 18:05:51', '1974-05-23 01:05:34', '1974-05-23 01:05:35'),
(72, 11, 226, 1, '2013-11-21 18:05:51', '1974-05-23 01:05:34', '1974-05-23 01:05:35'),
(73, 11, 187, 1, '2013-11-21 18:05:51', '1974-05-23 01:05:34', '1974-05-23 01:05:35'),
(74, 12, 129, 1, '2013-11-21 18:05:51', '1974-05-23 01:05:34', '1974-05-23 01:05:35'),
(75, 10, 22, 1, '2013-11-21 18:05:51', '1974-05-23 01:05:33', '1974-05-23 01:05:34'),
(76, 9, 261, 1, '2013-11-21 18:05:51', '1974-05-23 01:05:34', '1974-05-23 01:05:35'),
(77, 12, 142, 1, '2013-11-21 18:05:52', '1974-05-23 01:05:34', '1974-05-23 01:05:35'),
(78, 9, 243, 1, '2013-11-21 18:05:52', '1974-05-23 01:05:34', '1974-05-23 01:05:35'),
(79, 11, 88, 1, '2013-11-21 18:05:52', '1974-05-23 01:05:34', '1974-05-23 01:05:35'),
(80, 9, 229, 1, '2013-11-21 18:05:52', '1974-05-23 01:05:34', '1974-05-23 01:05:35'),
(81, 12, 239, 1, '2013-11-21 18:05:53', '1974-05-23 01:05:34', '1974-05-23 01:05:35'),
(82, 12, 18, 1, '2013-11-21 18:05:53', '1974-05-23 01:05:34', '1974-05-23 01:05:35'),
(83, 9, 42, 1, '2013-11-21 18:05:53', '1974-05-23 01:05:34', '1974-05-23 01:05:35'),
(84, 9, 191, 1, '2013-11-21 18:05:53', '1974-05-23 01:05:34', '1974-05-23 01:05:35'),
(85, 11, 127, 1, '2013-11-21 18:05:53', '1974-05-23 01:05:34', '1974-05-23 01:05:35'),
(86, 10, 195, 1, '2013-11-21 18:05:54', '1974-05-23 01:05:34', '1974-05-23 01:05:35'),
(87, 12, 230, 1, '2013-11-21 18:05:54', '1974-05-23 01:05:34', '1974-05-23 01:05:35'),
(88, 10, 213, 1, '2013-11-21 18:05:54', '1974-05-23 01:05:34', '1974-05-23 01:05:35'),
(89, 9, 122, 1, '2013-11-21 18:05:54', '1974-05-23 01:05:34', '1974-05-23 01:05:35'),
(90, 12, 264, 1, '2013-11-21 18:05:56', '1974-05-23 01:05:34', '1974-05-23 01:05:35'),
(91, 10, 183, 1, '2013-11-21 18:05:56', '1974-05-23 01:05:34', '1974-05-23 01:05:35'),
(92, 10, 240, 1, '2013-11-21 18:05:56', '1974-05-23 01:05:34', '1974-05-23 01:05:35'),
(93, 12, 30, 1, '2013-11-21 18:05:58', '1974-05-23 01:05:34', '1974-05-23 01:05:35'),
(94, 11, 72, 1, '2013-11-21 18:05:59', '1974-05-23 01:05:34', '1974-05-23 01:05:35'),
(95, 14, 52, 1, '2013-11-21 18:06:31', '1974-05-23 01:05:38', '1974-05-23 01:05:39'),
(96, 14, 88, 1, '2013-11-21 18:06:32', '1974-05-23 01:05:38', '1974-05-23 01:05:39'),
(97, 14, 121, 1, '2013-11-21 18:06:32', '1974-05-23 01:05:38', '1974-05-23 01:05:39'),
(98, 13, 65, 1, '2013-11-21 18:06:32', '1974-05-23 01:05:38', '1974-05-23 01:05:39'),
(99, 14, 191, 1, '2013-11-21 18:06:32', '1974-05-23 01:05:39', '1974-05-23 01:05:39'),
(100, 14, 260, 1, '2013-11-21 18:06:33', '1974-05-23 01:05:38', '1974-05-23 01:05:39'),
(101, 14, 261, 1, '2013-11-21 18:06:33', '1974-05-23 01:05:38', '1974-05-23 01:05:39'),
(102, 14, 228, 1, '2013-11-21 18:06:33', '1974-05-23 01:05:38', '1974-05-23 01:05:39'),
(103, 14, 196, 1, '2013-11-21 18:06:33', '1974-05-23 01:05:38', '1974-05-23 01:05:39'),
(104, 14, 55, 1, '2013-11-21 18:06:33', '1974-05-23 01:05:38', '1974-05-23 01:05:39'),
(105, 14, 87, 1, '2013-11-21 18:06:34', '1974-05-23 01:05:39', '1974-05-23 01:05:39'),
(106, 14, 213, 1, '2013-11-21 18:06:34', '1974-05-23 01:05:39', '1974-05-23 01:05:39'),
(107, 14, 30, 1, '2013-11-21 18:06:34', '1974-05-23 01:05:39', '1974-05-23 01:05:39'),
(108, 14, 127, 1, '2013-11-21 18:06:34', '1974-05-23 01:05:38', '1974-05-23 01:05:39'),
(109, 14, 230, 1, '2013-11-21 18:06:34', '1974-05-23 01:05:38', '1974-05-23 01:05:39'),
(110, 14, 238, 1, '2013-11-21 18:06:35', '1974-05-23 01:05:38', '1974-05-23 01:05:39'),
(111, 14, 142, 1, '2013-11-21 18:06:35', '1974-05-23 01:05:38', '1974-05-23 01:05:39'),
(112, 14, 18, 1, '2013-11-21 18:06:35', '1974-05-23 01:05:38', '1974-05-23 01:05:39'),
(113, 15, 22, 1, '2013-11-21 18:06:35', '1974-05-23 01:05:38', '1974-05-23 01:05:38'),
(114, 14, 226, 1, '2013-11-21 18:06:35', '1974-05-23 01:05:38', '1974-05-23 01:05:39'),
(115, 15, 124, 1, '2013-11-21 18:06:36', '1974-05-23 01:05:38', '1974-05-23 01:05:39'),
(116, 14, 187, 1, '2013-11-21 18:06:36', '1974-05-23 01:05:38', '1974-05-23 01:05:39'),
(117, 15, 129, 1, '2013-11-21 18:06:36', '1974-05-23 01:05:39', '1974-05-23 01:05:39'),
(118, 14, 263, 1, '2013-11-21 18:06:36', '1974-05-23 01:05:38', '1974-05-23 01:05:39'),
(119, 15, 266, 1, '2013-11-21 18:06:36', '1974-05-23 01:05:38', '1974-05-23 01:05:39'),
(120, 14, 122, 1, '2013-11-21 18:06:36', '1974-05-23 01:05:39', '1974-05-23 01:05:39'),
(121, 14, 239, 1, '2013-11-21 18:06:36', '1974-05-23 01:05:38', '1974-05-23 01:05:39'),
(122, 14, 240, 1, '2013-11-21 18:06:36', '1974-05-23 01:05:38', '1974-05-23 01:05:39'),
(123, 14, 190, 1, '2013-11-21 18:06:38', '1974-05-23 01:05:38', '1974-05-23 01:05:39'),
(124, 14, 188, 1, '2013-11-21 18:06:38', '1974-05-23 01:05:38', '1974-05-23 01:05:39'),
(125, 15, 195, 1, '2013-11-21 18:06:38', '1974-05-23 01:05:39', '1974-05-23 01:05:39'),
(126, 14, 83, 1, '2013-11-21 18:06:38', '1974-05-23 01:05:38', '1974-05-23 01:05:39'),
(127, 15, 229, 1, '2013-11-21 18:06:39', '1974-05-23 01:05:38', '1974-05-23 01:05:39'),
(128, 16, 243, 1, '2013-11-21 18:06:40', '1974-05-23 01:05:38', '1974-05-23 01:05:40'),
(129, 13, 264, 1, '2013-11-21 18:06:40', '1974-05-23 01:05:38', '1974-05-23 01:05:40'),
(130, 13, 22, 1, '2013-11-21 18:06:41', '1974-05-23 01:05:38', '1974-05-23 01:05:39'),
(131, 14, 183, 1, '2013-11-21 18:06:41', '1974-05-23 01:05:38', '1974-05-23 01:05:40'),
(132, 16, 42, 1, '2013-11-21 18:06:42', '1974-05-23 01:05:38', '1974-05-23 01:05:40'),
(133, 14, 20, 1, '2013-11-21 18:06:43', '1974-05-23 01:05:38', '1974-05-23 01:05:40'),
(134, 3, 65, 1, '2013-11-21 18:07:01', '1974-05-23 01:05:41', '1974-05-23 01:05:42'),
(135, 4, 87, 1, '2013-11-21 18:07:02', '1974-05-23 01:05:41', '1974-05-23 01:05:42'),
(136, 23, 229, 1, '2013-11-21 18:07:02', '1974-05-23 01:05:41', '1974-05-23 01:05:42'),
(137, 2, 127, 1, '2013-11-21 18:07:02', '1974-05-23 01:05:41', '1974-05-23 01:05:42'),
(138, 4, 260, 1, '2013-11-21 18:07:03', '1974-05-23 01:05:41', '1974-05-23 01:05:42'),
(139, 4, 55, 1, '2013-11-21 18:07:03', '1974-05-23 01:05:41', '1974-05-23 01:05:42'),
(140, 3, 121, 1, '2013-11-21 18:07:03', '1974-05-23 01:05:41', '1974-05-23 01:05:42'),
(141, 4, 52, 1, '2013-11-21 18:07:03', '1974-05-23 01:05:41', '1974-05-23 01:05:42'),
(142, 2, 263, 1, '2013-11-21 18:07:03', '1974-05-23 01:05:41', '1974-05-23 01:05:42'),
(143, 3, 30, 1, '2013-11-21 18:07:03', '1974-05-23 01:05:41', '1974-05-23 01:05:42'),
(144, 3, 122, 1, '2013-11-21 18:07:04', '1974-05-23 01:05:41', '1974-05-23 01:05:42'),
(145, 4, 129, 1, '2013-11-21 18:07:04', '1974-05-23 01:05:42', '1974-05-23 01:05:42'),
(146, 24, 187, 1, '2013-11-21 18:07:04', '1974-05-23 01:05:41', '1974-05-23 01:05:42'),
(147, 3, 191, 1, '2013-11-21 18:07:04', '1974-05-23 01:05:41', '1974-05-23 01:05:42'),
(148, 3, 226, 1, '2013-11-21 18:07:04', '1974-05-23 01:05:41', '1974-05-23 01:05:42'),
(149, 23, 261, 1, '2013-11-21 18:07:05', '1974-05-23 01:05:41', '1974-05-23 01:05:42'),
(150, 4, 18, 1, '2013-11-21 18:07:05', '1974-05-23 01:05:41', '1974-05-23 01:05:42'),
(151, 2, 196, 1, '2013-11-21 18:07:05', '1974-05-23 01:05:41', '1974-05-23 01:05:42'),
(152, 23, 88, 1, '2013-11-21 18:07:05', '1974-05-23 01:05:41', '1974-05-23 01:05:42'),
(153, 3, 228, 1, '2013-11-21 18:07:05', '1974-05-23 01:05:41', '1974-05-23 01:05:42'),
(154, 2, 22, 1, '2013-11-21 18:07:05', '1974-05-23 01:05:41', '1974-05-23 01:05:41'),
(155, 24, 188, 1, '2013-11-21 18:07:06', '1974-05-23 01:05:41', '1974-05-23 01:05:42'),
(156, 3, 142, 1, '2013-11-21 18:07:07', '1974-05-23 01:05:41', '1974-05-23 01:05:42'),
(157, 2, 183, 1, '2013-11-21 18:07:07', '1974-05-23 01:05:41', '1974-05-23 01:05:42'),
(158, 4, 243, 1, '2013-11-21 18:07:07', '1974-05-23 01:05:41', '1974-05-23 01:05:42'),
(159, 1, 266, 1, '2013-11-21 18:07:07', '1974-05-23 01:05:41', '1974-05-23 01:05:42'),
(160, 3, 83, 1, '2013-11-21 18:07:07', '1974-05-23 01:05:41', '1974-05-23 01:05:42'),
(161, 3, 213, 1, '2013-11-21 18:07:07', '1974-05-23 01:05:41', '1974-05-23 01:05:42'),
(162, 4, 238, 1, '2013-11-21 18:07:07', '1974-05-23 01:05:41', '1974-05-23 01:05:42'),
(163, 3, 264, 1, '2013-11-21 18:07:07', '1974-05-23 01:05:41', '1974-05-23 01:05:42'),
(164, 23, 230, 1, '2013-11-21 18:07:08', '1974-05-23 01:05:41', '1974-05-23 01:05:42'),
(165, 26, 239, 1, '2013-11-21 18:07:08', '1974-05-23 01:05:41', '1974-05-23 01:05:42'),
(166, 4, 216, 1, '2013-11-21 18:07:08', '1974-05-23 01:05:36', '1974-05-23 01:05:38'),
(167, 4, 124, 1, '2013-11-21 18:07:11', '1974-05-23 01:05:41', '1974-05-23 01:05:43'),
(168, 3, 21, 1, '2013-11-21 18:07:12', '1974-05-23 01:05:41', '1974-05-23 01:05:43'),
(169, 23, 242, 1, '2013-11-21 18:07:13', '1974-05-23 01:05:41', '1974-05-23 01:05:43'),
(170, 1, 265, 1, '2013-11-21 18:07:13', '1974-05-23 01:05:41', '1974-05-23 01:05:43'),
(171, 23, 240, 1, '2013-11-21 18:07:14', '1974-05-23 01:05:41', '1974-05-23 01:05:43'),
(172, 2, 20, 1, '2013-11-21 18:07:14', '1974-05-23 01:05:41', '1974-05-23 01:05:43'),
(173, 2, 254, 1, '2013-11-21 18:07:14', '1974-05-23 01:05:41', '1974-05-23 01:05:43'),
(174, 26, 42, 1, '2013-11-21 18:07:16', '1974-05-23 01:05:41', '1974-05-23 01:05:43'),
(175, 3, 195, 1, '2013-11-21 18:07:17', '1974-05-23 01:05:41', '1974-05-23 01:05:43'),
(176, 2, 190, 1, '2013-11-21 18:07:17', '1974-05-23 01:05:41', '1974-05-23 01:05:43'),
(177, 19, 265, 1, '2013-11-21 18:07:33', '1974-05-23 01:05:45', '1974-05-23 01:05:45'),
(178, 20, 187, 1, '2013-11-21 18:07:34', '1974-05-23 01:05:45', '1974-05-23 01:05:45'),
(179, 19, 254, 1, '2013-11-21 18:07:34', '1974-05-23 01:05:45', '1974-05-23 01:05:45'),
(180, 19, 266, 1, '2013-11-21 18:07:35', '1974-05-23 01:05:45', '1974-05-23 01:05:45'),
(181, 19, 191, 1, '2013-11-21 18:07:35', '1974-05-23 01:05:45', '1974-05-23 01:05:45'),
(182, 19, 65, 1, '2013-11-21 18:07:35', '1974-05-23 01:05:45', '1974-05-23 01:05:45'),
(183, 20, 55, 1, '2013-11-21 18:07:35', '1974-05-23 01:05:45', '1974-05-23 01:05:45'),
(184, 20, 121, 1, '2013-11-21 18:07:35', '1974-05-23 01:05:45', '1974-05-23 01:05:45'),
(185, 20, 127, 1, '2013-11-21 18:07:35', '1974-05-23 01:05:45', '1974-05-23 01:05:45'),
(186, 20, 213, 1, '2013-11-21 18:07:36', '1974-05-23 01:05:45', '1974-05-23 01:05:45'),
(187, 19, 52, 1, '2013-11-21 18:07:36', '1974-05-23 01:05:45', '1974-05-23 01:05:45'),
(188, 17, 87, 1, '2013-11-21 18:07:36', '1974-05-23 01:05:45', '1974-05-23 01:05:45'),
(189, 20, 261, 1, '2013-11-21 18:07:36', '1974-05-23 01:05:45', '1974-05-23 01:05:45'),
(190, 20, 30, 1, '2013-11-21 18:07:36', '1974-05-23 01:05:45', '1974-05-23 01:05:45'),
(191, 20, 142, 1, '2013-11-21 18:07:36', '1974-05-23 01:05:45', '1974-05-23 01:05:45'),
(192, 20, 229, 1, '2013-11-21 18:07:36', '1974-05-23 01:05:45', '1974-05-23 01:05:45'),
(193, 19, 260, 1, '2013-11-21 18:07:36', '1974-05-23 01:05:45', '1974-05-23 01:05:45'),
(194, 18, 196, 1, '2013-11-21 18:07:37', '1974-05-23 01:05:44', '1974-05-23 01:05:45'),
(195, 18, 228, 1, '2013-11-21 18:07:37', '1974-05-23 01:05:45', '1974-05-23 01:05:45'),
(196, 20, 83, 1, '2013-11-21 18:07:37', '1974-05-23 01:05:45', '1974-05-23 01:05:45'),
(197, 20, 22, 1, '2013-11-21 18:07:37', '1974-05-23 01:05:44', '1974-05-23 01:05:45'),
(198, 19, 216, 1, '2013-11-21 18:07:37', '1974-05-23 01:05:40', '1974-05-23 01:05:40'),
(199, 20, 124, 1, '2013-11-21 18:07:37', '1974-05-23 01:05:45', '1974-05-23 01:05:45'),
(200, 20, 226, 1, '2013-11-21 18:07:38', '1974-05-23 01:05:45', '1974-05-23 01:05:45'),
(201, 19, 190, 1, '2013-11-21 18:07:38', '1974-05-23 01:05:45', '1974-05-23 01:05:45'),
(202, 20, 263, 1, '2013-11-21 18:07:38', '1974-05-23 01:05:45', '1974-05-23 01:05:45'),
(203, 20, 88, 1, '2013-11-21 18:07:38', '1974-05-23 01:05:45', '1974-05-23 01:05:45'),
(204, 20, 242, 1, '2013-11-21 18:07:38', '1974-05-23 01:05:45', '1974-05-23 01:05:45'),
(205, 20, 239, 1, '2013-11-21 18:07:38', '1974-05-23 01:05:45', '1974-05-23 01:05:45'),
(206, 20, 20, 1, '2013-11-21 18:07:39', '1974-05-23 01:05:44', '1974-05-23 01:05:45'),
(207, 18, 122, 1, '2013-11-21 18:07:39', '1974-05-23 01:05:45', '1974-05-23 01:05:45'),
(208, 20, 240, 1, '2013-11-21 18:07:40', '1974-05-23 01:05:45', '1974-05-23 01:05:46'),
(209, 20, 183, 1, '2013-11-21 18:07:40', '1974-05-23 01:05:45', '1974-05-23 01:05:46'),
(210, 20, 18, 1, '2013-11-21 18:07:40', '1974-05-23 01:05:45', '1974-05-23 01:05:46'),
(211, 20, 129, 1, '2013-11-21 18:07:40', '1974-05-23 01:05:45', '1974-05-23 01:05:46'),
(212, 19, 230, 1, '2013-11-21 18:07:41', '1974-05-23 01:05:45', '1974-05-23 01:05:46'),
(213, 20, 269, 1, '2013-11-21 18:07:42', '1974-05-23 01:05:46', '1974-05-23 01:05:47'),
(214, 19, 188, 1, '2013-11-21 18:07:42', '1974-05-23 01:05:45', '1974-05-23 01:05:46'),
(215, 19, 264, 1, '2013-11-21 18:07:45', '1974-05-23 01:05:45', '1974-05-23 01:05:46'),
(216, 20, 42, 1, '2013-11-21 18:07:45', '1974-05-23 01:05:45', '1974-05-23 01:05:46'),
(217, 75, 229, 1, '2013-11-21 18:07:58', '1974-05-23 01:05:47', '1974-05-23 01:05:47'),
(218, 76, 121, 1, '2013-11-21 18:07:58', '1974-05-23 01:05:47', '1974-05-23 01:05:47'),
(219, 76, 265, 1, '2013-11-21 18:07:58', '1974-05-23 01:05:47', '1974-05-23 01:05:47'),
(220, 76, 127, 1, '2013-11-21 18:07:59', '1974-05-23 01:05:47', '1974-05-23 01:05:47'),
(221, 75, 260, 1, '2013-11-21 18:08:00', '1974-05-23 01:05:47', '1974-05-23 01:05:47'),
(222, 76, 196, 1, '2013-11-21 18:08:00', '1974-05-23 01:05:47', '1974-05-23 01:05:47'),
(223, 76, 269, 1, '2013-11-21 18:08:00', '1974-05-23 01:05:48', '1974-05-23 01:05:48'),
(224, 76, 213, 1, '2013-11-21 18:08:00', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(225, 76, 42, 1, '2013-11-21 18:08:00', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(226, 80, 191, 1, '2013-11-21 18:08:00', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(227, 76, 261, 1, '2013-11-21 18:08:00', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(228, 76, 183, 1, '2013-11-21 18:08:00', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(229, 76, 230, 1, '2013-11-21 18:08:01', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(230, 76, 188, 1, '2013-11-21 18:08:01', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(231, 75, 216, 1, '2013-11-21 18:08:01', '1974-05-23 01:05:42', '1974-05-23 01:05:43'),
(232, 75, 226, 1, '2013-11-21 18:08:01', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(233, 75, 52, 1, '2013-11-21 18:08:01', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(234, 76, 88, 1, '2013-11-21 18:08:01', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(235, 75, 65, 1, '2013-11-21 18:08:02', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(236, 75, 122, 1, '2013-11-21 18:08:02', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(237, 75, 228, 1, '2013-11-21 18:08:02', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(238, 76, 242, 1, '2013-11-21 18:08:02', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(239, 76, 187, 1, '2013-11-21 18:08:02', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(240, 76, 83, 1, '2013-11-21 18:08:02', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(241, 76, 266, 1, '2013-11-21 18:08:02', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(242, 76, 124, 1, '2013-11-21 18:08:03', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(243, 80, 30, 1, '2013-11-21 18:08:04', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(244, 80, 22, 1, '2013-11-21 18:08:04', '1974-05-23 01:05:46', '1974-05-23 01:05:47'),
(245, 76, 142, 1, '2013-11-21 18:08:04', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(246, 76, 129, 1, '2013-11-21 18:08:04', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(247, 76, 239, 1, '2013-11-21 18:08:05', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(248, 76, 263, 1, '2013-11-21 18:08:05', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(249, 76, 18, 1, '2013-11-21 18:08:05', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(250, 76, 87, 1, '2013-11-21 18:08:06', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(251, 76, 20, 1, '2013-11-21 18:08:06', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(252, 76, 55, 1, '2013-11-21 18:08:06', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(253, 80, 240, 1, '2013-11-21 18:08:06', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(254, 80, 254, 1, '2013-11-21 18:08:06', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(255, 76, 264, 1, '2013-11-21 18:08:07', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(256, 80, 21, 1, '2013-11-21 18:08:08', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(257, 76, 190, 1, '2013-11-21 18:08:10', '1974-05-23 01:05:47', '1974-05-23 01:05:49'),
(258, 83, 22, 1, '2013-11-21 18:08:29', '1974-05-23 01:05:50', '1974-05-23 01:05:50'),
(259, 88, 243, 1, '2013-11-21 18:08:29', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(260, 84, 65, 1, '2013-11-21 18:08:29', '1974-05-23 01:05:50', '1974-05-23 01:05:50'),
(261, 84, 87, 1, '2013-11-21 18:08:30', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(262, 88, 265, 1, '2013-11-21 18:08:30', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(263, 84, 254, 1, '2013-11-21 18:08:30', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(264, 87, 213, 1, '2013-11-21 18:08:30', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(265, 87, 260, 1, '2013-11-21 18:08:30', '1974-05-23 01:05:50', '1974-05-23 01:05:50'),
(266, 87, 261, 1, '2013-11-21 18:08:30', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(267, 87, 190, 1, '2013-11-21 18:08:31', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(268, 84, 30, 1, '2013-11-21 18:08:31', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(269, 83, 230, 1, '2013-11-21 18:08:31', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(270, 83, 55, 1, '2013-11-21 18:08:31', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(271, 84, 124, 1, '2013-11-21 18:08:32', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(272, 84, 269, 1, '2013-11-21 18:08:32', '1974-05-23 01:05:51', '1974-05-23 01:05:52'),
(273, 83, 228, 1, '2013-11-21 18:08:32', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(274, 87, 239, 1, '2013-11-21 18:08:32', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(275, 87, 187, 1, '2013-11-21 18:08:32', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(276, 84, 52, 1, '2013-11-21 18:08:32', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(277, 83, 266, 1, '2013-11-21 18:08:32', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(278, 84, 83, 1, '2013-11-21 18:08:33', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(279, 87, 196, 1, '2013-11-21 18:08:33', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(280, 88, 22, 1, '2013-11-21 18:08:33', '1974-05-23 01:05:50', '1974-05-23 01:05:50'),
(281, 83, 129, 1, '2013-11-21 18:08:33', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(282, 84, 142, 1, '2013-11-21 18:08:33', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(283, 87, 229, 1, '2013-11-21 18:08:33', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(284, 84, 271, 1, '2013-11-21 18:08:33', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(285, 84, 226, 1, '2013-11-21 18:08:33', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(286, 84, 122, 1, '2013-11-21 18:08:33', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(287, 83, 127, 1, '2013-11-21 18:08:34', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(288, 83, 264, 1, '2013-11-21 18:08:34', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(289, 84, 88, 1, '2013-11-21 18:08:34', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(290, 83, 234, 1, '2013-11-21 18:08:34', '1974-05-23 01:05:46', '1974-05-23 01:05:46'),
(291, 84, 216, 1, '2013-11-21 18:08:34', '1974-05-23 01:05:45', '1974-05-23 01:05:46'),
(292, 87, 242, 1, '2013-11-21 18:08:34', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(293, 84, 121, 1, '2013-11-21 18:08:34', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(294, 83, 263, 1, '2013-11-21 18:08:34', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(295, 83, 240, 1, '2013-11-21 18:08:36', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(296, 87, 18, 1, '2013-11-21 18:08:37', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(297, 84, 188, 1, '2013-11-21 18:08:37', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(298, 84, 20, 1, '2013-11-21 18:08:37', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(299, 88, 183, 1, '2013-11-21 18:08:38', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(300, 84, 191, 1, '2013-11-21 18:08:38', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(301, 84, 42, 1, '2013-11-21 18:08:41', '1974-05-23 01:05:50', '1974-05-23 01:05:52'),
(302, 91, 22, 1, '2013-11-21 18:09:02', '1974-05-23 01:05:53', '1974-05-23 01:05:53'),
(303, 91, 254, 1, '2013-11-21 18:09:04', '1974-05-23 01:05:54', '1974-05-23 01:05:54'),
(304, 95, 243, 1, '2013-11-21 18:09:06', '1974-05-23 01:05:54', '1974-05-23 01:05:54'),
(305, 92, 265, 1, '2013-11-21 18:09:07', '1974-05-23 01:05:54', '1974-05-23 01:05:54'),
(306, 92, 260, 1, '2013-11-21 18:09:08', '1974-05-23 01:05:53', '1974-05-23 01:05:54'),
(307, 92, 266, 1, '2013-11-21 18:09:09', '1974-05-23 01:05:54', '1974-05-23 01:05:54'),
(308, 96, 65, 1, '2013-11-21 18:09:09', '1974-05-23 01:05:54', '1974-05-23 01:05:54'),
(309, 91, 127, 1, '2013-11-21 18:09:10', '1974-05-23 01:05:54', '1974-05-23 01:05:55'),
(310, 96, 263, 1, '2013-11-21 18:09:10', '1974-05-23 01:05:54', '1974-05-23 01:05:54'),
(311, 92, 21, 1, '2013-11-21 18:09:10', '1974-05-23 01:05:54', '1974-05-23 01:05:55'),
(312, 96, 271, 1, '2013-11-21 18:09:10', '1974-05-23 01:05:54', '1974-05-23 01:05:55'),
(313, 96, 83, 1, '2013-11-21 18:09:11', '1974-05-23 01:05:54', '1974-05-23 01:05:55'),
(314, 91, 52, 1, '2013-11-21 18:09:11', '1974-05-23 01:05:54', '1974-05-23 01:05:55'),
(315, 91, 88, 1, '2013-11-21 18:09:11', '1974-05-23 01:05:54', '1974-05-23 01:05:55'),
(316, 96, 124, 1, '2013-11-21 18:09:11', '1974-05-23 01:05:54', '1974-05-23 01:05:55'),
(317, 92, 264, 1, '2013-11-21 18:09:12', '1974-05-23 01:05:54', '1974-05-23 01:05:55'),
(318, 96, 213, 1, '2013-11-21 18:09:12', '1974-05-23 01:05:54', '1974-05-23 01:05:55'),
(319, 92, 239, 1, '2013-11-21 18:09:12', '1974-05-23 01:05:54', '1974-05-23 01:05:55'),
(320, 92, 261, 1, '2013-11-21 18:09:13', '1974-05-23 01:05:54', '1974-05-23 01:05:55'),
(321, 92, 269, 1, '2013-11-21 18:09:13', '1974-05-23 01:05:55', '1974-05-23 01:05:56'),
(322, 91, 240, 1, '2013-11-21 18:09:13', '1974-05-23 01:05:54', '1974-05-23 01:05:55'),
(323, 92, 226, 1, '2013-11-21 18:09:14', '1974-05-23 01:05:54', '1974-05-23 01:05:55'),
(324, 91, 234, 1, '2013-11-21 18:09:14', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(325, 92, 121, 1, '2013-11-21 18:09:14', '1974-05-23 01:05:54', '1974-05-23 01:05:55'),
(326, 96, 229, 1, '2013-11-21 18:09:14', '1974-05-23 01:05:54', '1974-05-23 01:05:55'),
(327, 91, 187, 1, '2013-11-21 18:09:14', '1974-05-23 01:05:54', '1974-05-23 01:05:55'),
(328, 91, 18, 1, '2013-11-21 18:09:14', '1974-05-23 01:05:54', '1974-05-23 01:05:55'),
(329, 95, 129, 1, '2013-11-21 18:09:14', '1974-05-23 01:05:54', '1974-05-23 01:05:55'),
(330, 96, 122, 1, '2013-11-21 18:09:14', '1974-05-23 01:05:54', '1974-05-23 01:05:55'),
(331, 92, 216, 1, '2013-11-21 18:09:14', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(332, 96, 191, 1, '2013-11-21 18:09:15', '1974-05-23 01:05:54', '1974-05-23 01:05:55'),
(333, 92, 242, 1, '2013-11-21 18:09:15', '1974-05-23 01:05:54', '1974-05-23 01:05:55'),
(334, 96, 30, 1, '2013-11-21 18:09:15', '1974-05-23 01:05:54', '1974-05-23 01:05:55'),
(335, 91, 230, 1, '2013-11-21 18:09:15', '1974-05-23 01:05:54', '1974-05-23 01:05:55'),
(336, 96, 228, 1, '2013-11-21 18:09:15', '1974-05-23 01:05:54', '1974-05-23 01:05:55'),
(337, 96, 196, 1, '2013-11-21 18:09:15', '1974-05-23 01:05:53', '1974-05-23 01:05:55'),
(338, 92, 87, 1, '2013-11-21 18:09:16', '1974-05-23 01:05:54', '1974-05-23 01:05:55'),
(339, 96, 142, 1, '2013-11-21 18:09:16', '1974-05-23 01:05:54', '1974-05-23 01:05:55'),
(340, 91, 20, 1, '2013-11-21 18:09:21', '1974-05-23 01:05:53', '1974-05-23 01:05:56'),
(341, 101, 22, 1, '2013-11-21 18:09:38', '1974-05-23 01:05:57', '1974-05-23 01:05:57'),
(342, 102, 254, 1, '2013-11-21 18:09:39', '1974-05-23 01:05:57', '1974-05-23 01:05:57'),
(343, 102, 243, 1, '2013-11-21 18:09:39', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(344, 102, 65, 1, '2013-11-21 18:09:40', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(345, 102, 261, 1, '2013-11-21 18:09:40', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(346, 102, 190, 1, '2013-11-21 18:09:40', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(347, 102, 187, 1, '2013-11-21 18:09:40', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(348, 102, 83, 1, '2013-11-21 18:09:40', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(349, 101, 265, 1, '2013-11-21 18:09:40', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(350, 102, 229, 1, '2013-11-21 18:09:41', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(351, 102, 196, 1, '2013-11-21 18:09:41', '1974-05-23 01:05:57', '1974-05-23 01:05:57'),
(352, 102, 30, 1, '2013-11-21 18:09:41', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(353, 102, 121, 1, '2013-11-21 18:09:41', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(354, 102, 52, 1, '2013-11-21 18:09:41', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(355, 102, 264, 1, '2013-11-21 18:09:41', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(356, 102, 22, 1, '2013-11-21 18:09:42', '1974-05-23 01:05:57', '1974-05-23 01:05:57'),
(357, 102, 273, 1, '2013-11-21 18:09:42', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(358, 102, 88, 1, '2013-11-21 18:09:42', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(359, 102, 87, 1, '2013-11-21 18:09:42', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(360, 102, 228, 1, '2013-11-21 18:09:42', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(361, 102, 18, 1, '2013-11-21 18:09:42', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(362, 102, 230, 1, '2013-11-21 18:09:42', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(363, 102, 260, 1, '2013-11-21 18:09:42', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(364, 102, 263, 1, '2013-11-21 18:09:43', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(365, 102, 234, 1, '2013-11-21 18:09:43', '1974-05-23 01:05:53', '1974-05-23 01:05:53'),
(366, 102, 226, 1, '2013-11-21 18:09:43', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(367, 102, 216, 1, '2013-11-21 18:09:43', '1974-05-23 01:05:52', '1974-05-23 01:05:53'),
(368, 102, 191, 1, '2013-11-21 18:09:43', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(369, 102, 242, 1, '2013-11-21 18:09:43', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(370, 102, 129, 1, '2013-11-21 18:09:43', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(371, 102, 42, 1, '2013-11-21 18:09:43', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(372, 102, 213, 1, '2013-11-21 18:09:44', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(373, 102, 127, 1, '2013-11-21 18:09:44', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(374, 102, 142, 1, '2013-11-21 18:09:44', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(375, 102, 124, 1, '2013-11-21 18:09:44', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(376, 101, 55, 1, '2013-11-21 18:09:45', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(377, 102, 122, 1, '2013-11-21 18:09:45', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(378, 101, 240, 1, '2013-11-21 18:09:46', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(379, 102, 266, 1, '2013-11-21 18:09:46', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(380, 102, 21, 1, '2013-11-21 18:09:47', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(381, 102, 239, 1, '2013-11-21 18:09:47', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(382, 102, 20, 1, '2013-11-21 18:09:48', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(383, 102, 183, 1, '2013-11-21 18:09:48', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(384, 102, 269, 1, '2013-11-21 18:09:50', '1974-05-23 01:05:58', '1974-05-23 01:05:59'),
(385, 102, 188, 1, '2013-11-21 18:09:52', '1974-05-23 01:05:57', '1974-05-23 01:05:59'),
(386, 108, 22, 1, '2013-11-21 18:10:24', '1974-05-23 01:05:01', '1974-05-23 01:05:01'),
(387, 108, 254, 1, '2013-11-21 18:10:24', '1974-05-23 01:05:02', '1974-05-23 01:05:02'),
(388, 112, 265, 1, '2013-11-21 18:10:25', '1974-05-23 01:05:02', '1974-05-23 01:05:02'),
(389, 111, 260, 1, '2013-11-21 18:10:26', '1974-05-23 01:05:02', '1974-05-23 01:05:02'),
(390, 111, 190, 1, '2013-11-21 18:10:26', '1974-05-23 01:05:02', '1974-05-23 01:05:02'),
(391, 112, 196, 1, '2013-11-21 18:10:26', '1974-05-23 01:05:01', '1974-05-23 01:05:02'),
(392, 112, 226, 1, '2013-11-21 18:10:27', '1974-05-23 01:05:02', '1974-05-23 01:05:02'),
(393, 111, 124, 1, '2013-11-21 18:10:27', '1974-05-23 01:05:02', '1974-05-23 01:05:02'),
(394, 111, 83, 1, '2013-11-21 18:10:27', '1974-05-23 01:05:02', '1974-05-23 01:05:02'),
(395, 112, 127, 1, '2013-11-21 18:10:27', '1974-05-23 01:05:02', '1974-05-23 01:05:02'),
(396, 111, 264, 1, '2013-11-21 18:10:27', '1974-05-23 01:05:02', '1974-05-23 01:05:02'),
(397, 111, 22, 1, '2013-11-21 18:10:27', '1974-05-23 01:05:01', '1974-05-23 01:05:02'),
(398, 112, 142, 1, '2013-11-21 18:10:28', '1974-05-23 01:05:02', '1974-05-23 01:05:02'),
(399, 111, 52, 1, '2013-11-21 18:10:28', '1974-05-23 01:05:02', '1974-05-23 01:05:02'),
(400, 111, 229, 1, '2013-11-21 18:10:28', '1974-05-23 01:05:02', '1974-05-23 01:05:02'),
(401, 111, 213, 1, '2013-11-21 18:10:28', '1974-05-23 01:05:02', '1974-05-23 01:05:02'),
(402, 112, 121, 1, '2013-11-21 18:10:28', '1974-05-23 01:05:02', '1974-05-23 01:05:02'),
(403, 111, 228, 1, '2013-11-21 18:10:28', '1974-05-23 01:05:02', '1974-05-23 01:05:02'),
(404, 111, 30, 1, '2013-11-21 18:10:28', '1974-05-23 01:05:02', '1974-05-23 01:05:02'),
(405, 111, 65, 1, '2013-11-21 18:10:28', '1974-05-23 01:05:02', '1974-05-23 01:05:02'),
(406, 109, 243, 1, '2013-11-21 18:10:28', '1974-05-23 01:05:02', '1974-05-23 01:05:02'),
(407, 109, 126, 1, '2013-11-21 18:10:29', '1974-05-23 01:05:02', '1974-05-23 01:05:02'),
(408, 111, 242, 1, '2013-11-21 18:10:29', '1974-05-23 01:05:02', '1974-05-23 01:05:02'),
(409, 112, 266, 1, '2013-11-21 18:10:29', '1974-05-23 01:05:02', '1974-05-23 01:05:02'),
(410, 111, 269, 1, '2013-11-21 18:10:29', '1974-05-23 01:05:03', '1974-05-23 01:05:03'),
(411, 112, 230, 1, '2013-11-21 18:10:29', '1974-05-23 01:05:02', '1974-05-23 01:05:02'),
(412, 112, 239, 1, '2013-11-21 18:10:30', '1974-05-23 01:05:02', '1974-05-23 01:05:03'),
(413, 108, 216, 1, '2013-11-21 18:10:30', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(414, 111, 191, 1, '2013-11-21 18:10:30', '1974-05-23 01:05:02', '1974-05-23 01:05:03'),
(415, 111, 273, 1, '2013-11-21 18:10:30', '1974-05-23 01:05:02', '1974-05-23 01:05:03'),
(416, 111, 88, 1, '2013-11-21 18:10:30', '1974-05-23 01:05:02', '1974-05-23 01:05:03'),
(417, 111, 18, 1, '2013-11-21 18:10:30', '1974-05-23 01:05:02', '1974-05-23 01:05:03'),
(418, 111, 87, 1, '2013-11-21 18:10:31', '1974-05-23 01:05:02', '1974-05-23 01:05:03'),
(419, 111, 122, 1, '2013-11-21 18:10:31', '1974-05-23 01:05:02', '1974-05-23 01:05:03'),
(420, 112, 261, 1, '2013-11-21 18:10:31', '1974-05-23 01:05:02', '1974-05-23 01:05:03'),
(421, 111, 263, 1, '2013-11-21 18:10:32', '1974-05-23 01:05:02', '1974-05-23 01:05:03'),
(422, 108, 129, 1, '2013-11-21 18:10:32', '1974-05-23 01:05:02', '1974-05-23 01:05:03'),
(423, 109, 21, 1, '2013-11-21 18:10:32', '1974-05-23 01:05:02', '1974-05-23 01:05:03'),
(424, 111, 55, 1, '2013-11-21 18:10:33', '1974-05-23 01:05:02', '1974-05-23 01:05:03'),
(425, 111, 234, 1, '2013-11-21 18:10:33', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(426, 112, 240, 1, '2013-11-21 18:10:34', '1974-05-23 01:05:02', '1974-05-23 01:05:03'),
(427, 112, 236, 1, '2013-11-21 18:10:34', '1974-05-23 01:05:03', '1974-05-23 01:05:05'),
(428, 112, 183, 1, '2013-11-21 18:10:34', '1974-05-23 01:05:02', '1974-05-23 01:05:03'),
(429, 111, 187, 1, '2013-11-21 18:10:35', '1974-05-23 01:05:02', '1974-05-23 01:05:03'),
(430, 109, 42, 1, '2013-11-21 18:10:36', '1974-05-23 01:05:02', '1974-05-23 01:05:03'),
(431, 112, 20, 1, '2013-11-21 18:10:36', '1974-05-23 01:05:02', '1974-05-23 01:05:03'),
(432, 121, 126, 1, '2013-11-21 18:11:02', '1974-05-23 01:05:06', '1974-05-23 01:05:06'),
(433, 121, 191, 1, '2013-11-21 18:11:02', '1974-05-23 01:05:05', '1974-05-23 01:05:06'),
(434, 121, 254, 1, '2013-11-21 18:11:02', '1974-05-23 01:05:06', '1974-05-23 01:05:06'),
(435, 121, 265, 1, '2013-11-21 18:11:03', '1974-05-23 01:05:06', '1974-05-23 01:05:06'),
(436, 121, 261, 1, '2013-11-21 18:11:03', '1974-05-23 01:05:05', '1974-05-23 01:05:06'),
(437, 120, 52, 1, '2013-11-21 18:11:03', '1974-05-23 01:05:05', '1974-05-23 01:05:06'),
(438, 121, 213, 1, '2013-11-21 18:11:03', '1974-05-23 01:05:05', '1974-05-23 01:05:06'),
(439, 116, 22, 1, '2013-11-21 18:11:04', '1974-05-23 01:05:05', '1974-05-23 01:05:05'),
(440, 121, 121, 1, '2013-11-21 18:11:04', '1974-05-23 01:05:05', '1974-05-23 01:05:06'),
(441, 121, 187, 1, '2013-11-21 18:11:04', '1974-05-23 01:05:06', '1974-05-23 01:05:06'),
(442, 121, 88, 1, '2013-11-21 18:11:04', '1974-05-23 01:05:05', '1974-05-23 01:05:06'),
(443, 116, 243, 1, '2013-11-21 18:11:04', '1974-05-23 01:05:06', '1974-05-23 01:05:06'),
(444, 121, 124, 1, '2013-11-21 18:11:04', '1974-05-23 01:05:05', '1974-05-23 01:05:06'),
(445, 117, 271, 1, '2013-11-21 18:11:04', '1974-05-23 01:05:06', '1974-05-23 01:05:06'),
(446, 117, 273, 1, '2013-11-21 18:11:04', '1974-05-23 01:05:05', '1974-05-23 01:05:06'),
(447, 116, 266, 1, '2013-11-21 18:11:04', '1974-05-23 01:05:06', '1974-05-23 01:05:06'),
(448, 121, 196, 1, '2013-11-21 18:11:04', '1974-05-23 01:05:05', '1974-05-23 01:05:06'),
(449, 121, 269, 1, '2013-11-21 18:11:04', '1974-05-23 01:05:06', '1974-05-23 01:05:07'),
(450, 121, 236, 1, '2013-11-21 18:11:05', '1974-05-23 01:05:07', '1974-05-23 01:05:08'),
(451, 121, 127, 1, '2013-11-21 18:11:05', '1974-05-23 01:05:06', '1974-05-23 01:05:06'),
(452, 121, 87, 1, '2013-11-21 18:11:05', '1974-05-23 01:05:06', '1974-05-23 01:05:06'),
(453, 121, 260, 1, '2013-11-21 18:11:05', '1974-05-23 01:05:05', '1974-05-23 01:05:06'),
(454, 117, 229, 1, '2013-11-21 18:11:05', '1974-05-23 01:05:05', '1974-05-23 01:05:06'),
(455, 121, 83, 1, '2013-11-21 18:11:06', '1974-05-23 01:05:05', '1974-05-23 01:05:06'),
(456, 121, 183, 1, '2013-11-21 18:11:06', '1974-05-23 01:05:05', '1974-05-23 01:05:06'),
(457, 120, 226, 1, '2013-11-21 18:11:06', '1974-05-23 01:05:05', '1974-05-23 01:05:06'),
(458, 120, 190, 1, '2013-11-21 18:11:06', '1974-05-23 01:05:06', '1974-05-23 01:05:06'),
(459, 116, 21, 1, '2013-11-21 18:11:06', '1974-05-23 01:05:05', '1974-05-23 01:05:06'),
(460, 121, 228, 1, '2013-11-21 18:11:06', '1974-05-23 01:05:05', '1974-05-23 01:05:06'),
(461, 121, 65, 1, '2013-11-21 18:11:07', '1974-05-23 01:05:06', '1974-05-23 01:05:06'),
(462, 121, 18, 1, '2013-11-21 18:11:07', '1974-05-23 01:05:05', '1974-05-23 01:05:06'),
(463, 121, 55, 1, '2013-11-21 18:11:07', '1974-05-23 01:05:06', '1974-05-23 01:05:06'),
(464, 121, 30, 1, '2013-11-21 18:11:07', '1974-05-23 01:05:05', '1974-05-23 01:05:06'),
(465, 116, 142, 1, '2013-11-21 18:11:07', '1974-05-23 01:05:05', '1974-05-23 01:05:06'),
(466, 121, 22, 1, '2013-11-21 18:11:07', '1974-05-23 01:05:05', '1974-05-23 01:05:06'),
(467, 120, 239, 1, '2013-11-21 18:11:07', '1974-05-23 01:05:06', '1974-05-23 01:05:06'),
(468, 120, 234, 1, '2013-11-21 18:11:08', '1974-05-23 01:05:01', '1974-05-23 01:05:02'),
(469, 116, 42, 1, '2013-11-21 18:11:08', '1974-05-23 01:05:05', '1974-05-23 01:05:06'),
(470, 121, 263, 1, '2013-11-21 18:11:08', '1974-05-23 01:05:05', '1974-05-23 01:05:06'),
(471, 121, 122, 1, '2013-11-21 18:11:08', '1974-05-23 01:05:05', '1974-05-23 01:05:06'),
(472, 121, 129, 1, '2013-11-21 18:11:08', '1974-05-23 01:05:06', '1974-05-23 01:05:07'),
(473, 121, 230, 1, '2013-11-21 18:11:09', '1974-05-23 01:05:06', '1974-05-23 01:05:06'),
(474, 121, 242, 1, '2013-11-21 18:11:09', '1974-05-23 01:05:06', '1974-05-23 01:05:06'),
(475, 121, 240, 1, '2013-11-21 18:11:10', '1974-05-23 01:05:05', '1974-05-23 01:05:07'),
(476, 121, 216, 1, '2013-11-21 18:11:11', '1974-05-23 01:05:01', '1974-05-23 01:05:02'),
(477, 121, 264, 1, '2013-11-21 18:11:16', '1974-05-23 01:05:06', '1974-05-23 01:05:07'),
(478, 121, 20, 1, '2013-11-21 18:11:17', '1974-05-23 01:05:05', '1974-05-23 01:05:07'),
(479, 128, 273, 1, '2013-11-21 18:11:35', '1974-05-23 01:05:09', '1974-05-23 01:05:09'),
(480, 128, 230, 1, '2013-11-21 18:11:35', '1974-05-23 01:05:09', '1974-05-23 01:05:09'),
(481, 128, 229, 1, '2013-11-21 18:11:35', '1974-05-23 01:05:09', '1974-05-23 01:05:09'),
(482, 128, 271, 1, '2013-11-21 18:11:35', '1974-05-23 01:05:09', '1974-05-23 01:05:09'),
(483, 127, 22, 1, '2013-11-21 18:11:35', '1974-05-23 01:05:08', '1974-05-23 01:05:08'),
(484, 128, 261, 1, '2013-11-21 18:11:35', '1974-05-23 01:05:09', '1974-05-23 01:05:09'),
(485, 128, 265, 1, '2013-11-21 18:11:35', '1974-05-23 01:05:09', '1974-05-23 01:05:09'),
(486, 128, 18, 1, '2013-11-21 18:11:36', '1974-05-23 01:05:09', '1974-05-23 01:05:09'),
(487, 127, 243, 1, '2013-11-21 18:11:36', '1974-05-23 01:05:09', '1974-05-23 01:05:09'),
(488, 128, 87, 1, '2013-11-21 18:11:36', '1974-05-23 01:05:09', '1974-05-23 01:05:09'),
(489, 128, 127, 1, '2013-11-21 18:11:36', '1974-05-23 01:05:09', '1974-05-23 01:05:09'),
(490, 128, 260, 1, '2013-11-21 18:11:36', '1974-05-23 01:05:09', '1974-05-23 01:05:09'),
(491, 128, 266, 1, '2013-11-21 18:11:36', '1974-05-23 01:05:09', '1974-05-23 01:05:09'),
(492, 128, 83, 1, '2013-11-21 18:11:36', '1974-05-23 01:05:09', '1974-05-23 01:05:09'),
(493, 128, 124, 1, '2013-11-21 18:11:36', '1974-05-23 01:05:09', '1974-05-23 01:05:09'),
(494, 129, 254, 1, '2013-11-21 18:11:36', '1974-05-23 01:05:09', '1974-05-23 01:05:09'),
(495, 128, 65, 1, '2013-11-21 18:11:37', '1974-05-23 01:05:09', '1974-05-23 01:05:09'),
(496, 128, 228, 1, '2013-11-21 18:11:37', '1974-05-23 01:05:09', '1974-05-23 01:05:09'),
(497, 128, 187, 1, '2013-11-21 18:11:37', '1974-05-23 01:05:09', '1974-05-23 01:05:09'),
(498, 128, 269, 1, '2013-11-21 18:11:37', '1974-05-23 01:05:10', '1974-05-23 01:05:10'),
(499, 128, 52, 1, '2013-11-21 18:11:37', '1974-05-23 01:05:09', '1974-05-23 01:05:09'),
(500, 128, 242, 1, '2013-11-21 18:11:37', '1974-05-23 01:05:09', '1974-05-23 01:05:09'),
(501, 128, 263, 1, '2013-11-21 18:11:37', '1974-05-23 01:05:09', '1974-05-23 01:05:09'),
(502, 129, 21, 1, '2013-11-21 18:11:37', '1974-05-23 01:05:09', '1974-05-23 01:05:09'),
(503, 128, 226, 1, '2013-11-21 18:11:37', '1974-05-23 01:05:09', '1974-05-23 01:05:09'),
(504, 128, 121, 1, '2013-11-21 18:11:37', '1974-05-23 01:05:09', '1974-05-23 01:05:09'),
(505, 128, 264, 1, '2013-11-21 18:11:38', '1974-05-23 01:05:09', '1974-05-23 01:05:09'),
(506, 128, 196, 1, '2013-11-21 18:11:38', '1974-05-23 01:05:09', '1974-05-23 01:05:09'),
(507, 128, 55, 1, '2013-11-21 18:11:38', '1974-05-23 01:05:09', '1974-05-23 01:05:09'),
(508, 128, 216, 1, '2013-11-21 18:11:38', '1974-05-23 01:05:04', '1974-05-23 01:05:04'),
(509, 128, 213, 1, '2013-11-21 18:11:38', '1974-05-23 01:05:09', '1974-05-23 01:05:09'),
(510, 128, 122, 1, '2013-11-21 18:11:38', '1974-05-23 01:05:09', '1974-05-23 01:05:09'),
(511, 128, 190, 1, '2013-11-21 18:11:38', '1974-05-23 01:05:09', '1974-05-23 01:05:09'),
(512, 130, 88, 1, '2013-11-21 18:11:38', '1974-05-23 01:05:09', '1974-05-23 01:05:09'),
(513, 127, 191, 1, '2013-11-21 18:11:39', '1974-05-23 01:05:09', '1974-05-23 01:05:09'),
(514, 128, 22, 1, '2013-11-21 18:11:39', '1974-05-23 01:05:08', '1974-05-23 01:05:09'),
(515, 127, 183, 1, '2013-11-21 18:11:39', '1974-05-23 01:05:09', '1974-05-23 01:05:09'),
(516, 128, 234, 1, '2013-11-21 18:11:39', '1974-05-23 01:05:04', '1974-05-23 01:05:05'),
(517, 130, 126, 1, '2013-11-21 18:11:40', '1974-05-23 01:05:09', '1974-05-23 01:05:10'),
(518, 129, 142, 1, '2013-11-21 18:11:41', '1974-05-23 01:05:09', '1974-05-23 01:05:10'),
(519, 128, 240, 1, '2013-11-21 18:11:41', '1974-05-23 01:05:09', '1974-05-23 01:05:10'),
(520, 128, 236, 1, '2013-11-21 18:11:41', '1974-05-23 01:05:10', '1974-05-23 01:05:11'),
(521, 127, 129, 1, '2013-11-21 18:11:42', '1974-05-23 01:05:09', '1974-05-23 01:05:10'),
(522, 128, 239, 1, '2013-11-21 18:11:42', '1974-05-23 01:05:09', '1974-05-23 01:05:10'),
(523, 127, 42, 1, '2013-11-21 18:11:43', '1974-05-23 01:05:09', '1974-05-23 01:05:10'),
(524, 128, 30, 1, '2013-11-21 18:11:46', '1974-05-23 01:05:09', '1974-05-23 01:05:10'),
(525, 34, 22, 1, '2013-11-21 18:12:19', '1974-05-23 01:05:13', '1974-05-23 01:05:13'),
(526, 40, 254, 1, '2013-11-21 18:12:21', '1974-05-23 01:05:13', '1974-05-23 01:05:14'),
(527, 39, 52, 1, '2013-11-21 18:12:21', '1974-05-23 01:05:13', '1974-05-23 01:05:14'),
(528, 39, 190, 1, '2013-11-21 18:12:21', '1974-05-23 01:05:13', '1974-05-23 01:05:14'),
(529, 39, 269, 1, '2013-11-21 18:12:22', '1974-05-23 01:05:14', '1974-05-23 01:05:15'),
(530, 39, 243, 1, '2013-11-21 18:12:23', '1974-05-23 01:05:13', '1974-05-23 01:05:14'),
(531, 39, 124, 1, '2013-11-21 18:12:23', '1974-05-23 01:05:13', '1974-05-23 01:05:14'),
(532, 35, 55, 1, '2013-11-21 18:12:23', '1974-05-23 01:05:13', '1974-05-23 01:05:14'),
(533, 39, 87, 1, '2013-11-21 18:12:23', '1974-05-23 01:05:13', '1974-05-23 01:05:14'),
(534, 35, 271, 1, '2013-11-21 18:12:23', '1974-05-23 01:05:13', '1974-05-23 01:05:14'),
(535, 39, 22, 1, '2013-11-21 18:12:23', '1974-05-23 01:05:13', '1974-05-23 01:05:13'),
(536, 39, 261, 1, '2013-11-21 18:12:23', '1974-05-23 01:05:13', '1974-05-23 01:05:14'),
(537, 39, 88, 1, '2013-11-21 18:12:24', '1974-05-23 01:05:13', '1974-05-23 01:05:14'),
(538, 40, 273, 1, '2013-11-21 18:12:24', '1974-05-23 01:05:13', '1974-05-23 01:05:14'),
(539, 39, 127, 1, '2013-11-21 18:12:25', '1974-05-23 01:05:13', '1974-05-23 01:05:14'),
(540, 39, 228, 1, '2013-11-21 18:12:25', '1974-05-23 01:05:13', '1974-05-23 01:05:14'),
(541, 39, 226, 1, '2013-11-21 18:12:25', '1974-05-23 01:05:13', '1974-05-23 01:05:14'),
(542, 39, 229, 1, '2013-11-21 18:12:25', '1974-05-23 01:05:13', '1974-05-23 01:05:14'),
(543, 39, 191, 1, '2013-11-21 18:12:25', '1974-05-23 01:05:13', '1974-05-23 01:05:14'),
(544, 34, 121, 1, '2013-11-21 18:12:26', '1974-05-23 01:05:13', '1974-05-23 01:05:14'),
(545, 39, 266, 1, '2013-11-21 18:12:26', '1974-05-23 01:05:13', '1974-05-23 01:05:14'),
(546, 34, 122, 1, '2013-11-21 18:12:26', '1974-05-23 01:05:13', '1974-05-23 01:05:14'),
(547, 39, 30, 1, '2013-11-21 18:12:26', '1974-05-23 01:05:13', '1974-05-23 01:05:14'),
(548, 39, 21, 1, '2013-11-21 18:12:27', '1974-05-23 01:05:13', '1974-05-23 01:05:14'),
(549, 39, 187, 1, '2013-11-21 18:12:27', '1974-05-23 01:05:13', '1974-05-23 01:05:14'),
(550, 35, 240, 1, '2013-11-21 18:12:27', '1974-05-23 01:05:13', '1974-05-23 01:05:14'),
(551, 39, 263, 1, '2013-11-21 18:12:28', '1974-05-23 01:05:13', '1974-05-23 01:05:14'),
(552, 39, 264, 1, '2013-11-21 18:12:28', '1974-05-23 01:05:13', '1974-05-23 01:05:14'),
(553, 39, 265, 1, '2013-11-21 18:12:28', '1974-05-23 01:05:13', '1974-05-23 01:05:14'),
(554, 39, 230, 1, '2013-11-21 18:12:28', '1974-05-23 01:05:13', '1974-05-23 01:05:14'),
(555, 34, 213, 1, '2013-11-21 18:12:28', '1974-05-23 01:05:13', '1974-05-23 01:05:14'),
(556, 39, 216, 1, '2013-11-21 18:12:29', '1974-05-23 01:05:08', '1974-05-23 01:05:10'),
(557, 34, 65, 1, '2013-11-21 18:12:29', '1974-05-23 01:05:13', '1974-05-23 01:05:14'),
(558, 39, 260, 1, '2013-11-21 18:12:29', '1974-05-23 01:05:13', '1974-05-23 01:05:14'),
(559, 39, 129, 1, '2013-11-21 18:12:29', '1974-05-23 01:05:14', '1974-05-23 01:05:15'),
(560, 39, 18, 1, '2013-11-21 18:12:29', '1974-05-23 01:05:13', '1974-05-23 01:05:14'),
(561, 39, 83, 1, '2013-11-21 18:12:29', '1974-05-23 01:05:13', '1974-05-23 01:05:14'),
(562, 35, 234, 1, '2013-11-21 18:12:31', '1974-05-23 01:05:09', '1974-05-23 01:05:10'),
(563, 40, 20, 1, '2013-11-21 18:12:31', '1974-05-23 01:05:13', '1974-05-23 01:05:15'),
(564, 39, 42, 1, '2013-11-21 18:12:31', '1974-05-23 01:05:13', '1974-05-23 01:05:15'),
(565, 34, 242, 1, '2013-11-21 18:12:32', '1974-05-23 01:05:13', '1974-05-23 01:05:15'),
(566, 34, 183, 1, '2013-11-21 18:12:32', '1974-05-23 01:05:13', '1974-05-23 01:05:15'),
(567, 41, 22, 1, '2013-11-21 18:12:49', '1974-05-23 01:05:16', '1974-05-23 01:05:16'),
(568, 48, 126, 1, '2013-11-21 18:12:50', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(569, 48, 265, 1, '2013-11-21 18:12:51', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(570, 48, 18, 1, '2013-11-21 18:12:51', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(571, 41, 273, 1, '2013-11-21 18:12:52', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(572, 42, 273, 1, '2013-11-21 18:12:52', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(573, 44, 273, 1, '2013-11-21 18:12:52', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(574, 48, 273, 1, '2013-11-21 18:12:52', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(575, 42, 239, 1, '2013-11-21 18:12:52', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(576, 46, 229, 1, '2013-11-21 18:12:53', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(577, 47, 190, 1, '2013-11-21 18:12:53', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(578, 41, 230, 1, '2013-11-21 18:12:53', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(579, 42, 230, 1, '2013-11-21 18:12:53', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(580, 43, 230, 1, '2013-11-21 18:12:53', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(581, 44, 230, 1, '2013-11-21 18:12:53', '1974-05-23 01:05:16', '1974-05-23 01:05:17');
INSERT INTO `user_answers` (`user_answer_id`, `answer_id`, `user_id`, `active`, `datetime`, `received`, `submitted`) VALUES
(582, 47, 230, 1, '2013-11-21 18:12:53', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(583, 41, 52, 1, '2013-11-21 18:12:54', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(584, 42, 52, 1, '2013-11-21 18:12:54', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(585, 43, 52, 1, '2013-11-21 18:12:54', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(586, 44, 52, 1, '2013-11-21 18:12:54', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(587, 41, 261, 1, '2013-11-21 18:12:54', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(588, 47, 261, 1, '2013-11-21 18:12:54', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(589, 48, 142, 1, '2013-11-21 18:12:55', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(590, 41, 240, 1, '2013-11-21 18:12:55', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(591, 48, 191, 1, '2013-11-21 18:12:55', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(592, 42, 187, 1, '2013-11-21 18:12:55', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(593, 43, 213, 1, '2013-11-21 18:12:56', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(594, 47, 213, 1, '2013-11-21 18:12:56', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(595, 43, 234, 1, '2013-11-21 18:12:56', '1974-05-23 01:05:12', '1974-05-23 01:05:13'),
(596, 42, 216, 1, '2013-11-21 18:12:56', '1974-05-23 01:05:11', '1974-05-23 01:05:12'),
(597, 41, 127, 1, '2013-11-21 18:12:56', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(598, 46, 127, 1, '2013-11-21 18:12:56', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(599, 48, 127, 1, '2013-11-21 18:12:56', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(600, 43, 228, 1, '2013-11-21 18:12:56', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(601, 44, 228, 1, '2013-11-21 18:12:56', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(602, 47, 228, 1, '2013-11-21 18:12:56', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(603, 41, 55, 1, '2013-11-21 18:12:56', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(604, 42, 55, 1, '2013-11-21 18:12:56', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(605, 44, 55, 1, '2013-11-21 18:12:56', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(606, 41, 243, 1, '2013-11-21 18:12:57', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(607, 42, 243, 1, '2013-11-21 18:12:57', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(608, 43, 30, 1, '2013-11-21 18:12:57', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(609, 43, 243, 1, '2013-11-21 18:12:57', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(610, 44, 30, 1, '2013-11-21 18:12:57', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(611, 44, 243, 1, '2013-11-21 18:12:57', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(612, 45, 243, 1, '2013-11-21 18:12:57', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(613, 46, 243, 1, '2013-11-21 18:12:57', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(614, 47, 243, 1, '2013-11-21 18:12:57', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(615, 48, 243, 1, '2013-11-21 18:12:57', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(616, 44, 88, 1, '2013-11-21 18:12:57', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(617, 41, 236, 1, '2013-11-21 18:12:57', '1974-05-23 01:05:18', '1974-05-23 01:05:19'),
(618, 46, 88, 1, '2013-11-21 18:12:57', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(619, 42, 236, 1, '2013-11-21 18:12:57', '1974-05-23 01:05:18', '1974-05-23 01:05:19'),
(620, 47, 88, 1, '2013-11-21 18:12:57', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(621, 43, 236, 1, '2013-11-21 18:12:57', '1974-05-23 01:05:18', '1974-05-23 01:05:19'),
(622, 44, 236, 1, '2013-11-21 18:12:57', '1974-05-23 01:05:18', '1974-05-23 01:05:19'),
(623, 45, 236, 1, '2013-11-21 18:12:57', '1974-05-23 01:05:18', '1974-05-23 01:05:19'),
(624, 46, 236, 1, '2013-11-21 18:12:57', '1974-05-23 01:05:18', '1974-05-23 01:05:19'),
(625, 47, 236, 1, '2013-11-21 18:12:57', '1974-05-23 01:05:18', '1974-05-23 01:05:19'),
(626, 41, 21, 1, '2013-11-21 18:12:57', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(627, 47, 21, 1, '2013-11-21 18:12:57', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(628, 47, 124, 1, '2013-11-21 18:12:57', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(629, 44, 226, 1, '2013-11-21 18:12:57', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(630, 42, 121, 1, '2013-11-21 18:12:57', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(631, 43, 121, 1, '2013-11-21 18:12:57', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(632, 44, 121, 1, '2013-11-21 18:12:57', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(633, 46, 121, 1, '2013-11-21 18:12:57', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(634, 47, 121, 1, '2013-11-21 18:12:57', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(635, 48, 122, 1, '2013-11-21 18:12:58', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(636, 48, 260, 1, '2013-11-21 18:12:58', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(637, 41, 65, 1, '2013-11-21 18:12:58', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(638, 43, 65, 1, '2013-11-21 18:12:58', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(639, 45, 65, 1, '2013-11-21 18:12:58', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(640, 41, 264, 1, '2013-11-21 18:12:58', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(641, 43, 264, 1, '2013-11-21 18:12:58', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(642, 46, 264, 1, '2013-11-21 18:12:58', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(643, 44, 266, 1, '2013-11-21 18:12:58', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(644, 47, 266, 1, '2013-11-21 18:12:58', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(645, 48, 263, 1, '2013-11-21 18:12:58', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(646, 41, 42, 1, '2013-11-21 18:12:58', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(647, 46, 42, 1, '2013-11-21 18:12:58', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(648, 47, 42, 1, '2013-11-21 18:12:58', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(649, 41, 196, 1, '2013-11-21 18:12:59', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(650, 43, 196, 1, '2013-11-21 18:12:59', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(651, 45, 196, 1, '2013-11-21 18:12:59', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(652, 47, 196, 1, '2013-11-21 18:12:59', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(653, 42, 242, 1, '2013-11-21 18:12:59', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(654, 43, 242, 1, '2013-11-21 18:12:59', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(655, 46, 242, 1, '2013-11-21 18:12:59', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(656, 47, 242, 1, '2013-11-21 18:12:59', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(657, 42, 87, 1, '2013-11-21 18:12:59', '1974-05-23 01:05:16', '1974-05-23 01:05:18'),
(658, 47, 87, 1, '2013-11-21 18:12:59', '1974-05-23 01:05:16', '1974-05-23 01:05:18'),
(659, 41, 271, 1, '2013-11-21 18:12:59', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(660, 43, 271, 1, '2013-11-21 18:12:59', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(661, 44, 271, 1, '2013-11-21 18:12:59', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(662, 47, 271, 1, '2013-11-21 18:12:59', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(663, 41, 83, 1, '2013-11-21 18:12:59', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(664, 42, 83, 1, '2013-11-21 18:12:59', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(665, 44, 83, 1, '2013-11-21 18:12:59', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(666, 46, 83, 1, '2013-11-21 18:12:59', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(667, 41, 129, 1, '2013-11-21 18:13:00', '1974-05-23 01:05:16', '1974-05-23 01:05:18'),
(668, 42, 129, 1, '2013-11-21 18:13:00', '1974-05-23 01:05:16', '1974-05-23 01:05:18'),
(669, 43, 129, 1, '2013-11-21 18:13:00', '1974-05-23 01:05:16', '1974-05-23 01:05:18'),
(670, 44, 129, 1, '2013-11-21 18:13:00', '1974-05-23 01:05:16', '1974-05-23 01:05:18'),
(671, 46, 129, 1, '2013-11-21 18:13:00', '1974-05-23 01:05:16', '1974-05-23 01:05:18'),
(672, 48, 20, 1, '2013-11-21 18:13:00', '1974-05-23 01:05:16', '1974-05-23 01:05:17'),
(673, 41, 269, 1, '2013-11-21 18:13:03', '1974-05-23 01:05:17', '1974-05-23 01:05:19'),
(674, 42, 269, 1, '2013-11-21 18:13:03', '1974-05-23 01:05:17', '1974-05-23 01:05:19'),
(675, 43, 269, 1, '2013-11-21 18:13:03', '1974-05-23 01:05:17', '1974-05-23 01:05:19'),
(676, 44, 269, 1, '2013-11-21 18:13:03', '1974-05-23 01:05:17', '1974-05-23 01:05:19'),
(677, 46, 269, 1, '2013-11-21 18:13:03', '1974-05-23 01:05:17', '1974-05-23 01:05:19'),
(678, 47, 269, 1, '2013-11-21 18:13:03', '1974-05-23 01:05:17', '1974-05-23 01:05:19'),
(679, 48, 269, 1, '2013-11-21 18:13:03', '1974-05-23 01:05:17', '1974-05-23 01:05:19'),
(680, 41, 183, 1, '2013-11-21 18:13:03', '1974-05-23 01:05:16', '1974-05-23 01:05:18'),
(681, 42, 183, 1, '2013-11-21 18:13:03', '1974-05-23 01:05:16', '1974-05-23 01:05:18'),
(682, 44, 183, 1, '2013-11-21 18:13:03', '1974-05-23 01:05:16', '1974-05-23 01:05:18'),
(683, 41, 101, 1, '2013-11-21 18:13:05', '1974-05-23 01:05:16', '1974-05-23 01:05:18'),
(684, 42, 101, 1, '2013-11-21 18:13:05', '1974-05-23 01:05:16', '1974-05-23 01:05:18'),
(685, 43, 101, 1, '2013-11-21 18:13:05', '1974-05-23 01:05:16', '1974-05-23 01:05:18'),
(686, 44, 101, 1, '2013-11-21 18:13:05', '1974-05-23 01:05:16', '1974-05-23 01:05:18'),
(687, 45, 101, 1, '2013-11-21 18:13:05', '1974-05-23 01:05:16', '1974-05-23 01:05:18'),
(688, 46, 101, 1, '2013-11-21 18:13:05', '1974-05-23 01:05:16', '1974-05-23 01:05:18'),
(689, 47, 101, 1, '2013-11-21 18:13:05', '1974-05-23 01:05:16', '1974-05-23 01:05:18'),
(690, 49, 22, 1, '2013-11-21 18:13:15', '1974-05-23 01:05:18', '1974-05-23 01:05:18'),
(691, 50, 243, 1, '2013-11-21 18:13:15', '1974-05-23 01:05:19', '1974-05-23 01:05:19'),
(692, 51, 261, 1, '2013-11-21 18:13:16', '1974-05-23 01:05:19', '1974-05-23 01:05:19'),
(693, 52, 273, 1, '2013-11-21 18:13:17', '1974-05-23 01:05:19', '1974-05-23 01:05:19'),
(694, 51, 52, 1, '2013-11-21 18:13:17', '1974-05-23 01:05:19', '1974-05-23 01:05:19'),
(695, 51, 190, 1, '2013-11-21 18:13:17', '1974-05-23 01:05:19', '1974-05-23 01:05:19'),
(696, 52, 260, 1, '2013-11-21 18:13:17', '1974-05-23 01:05:19', '1974-05-23 01:05:19'),
(697, 51, 271, 1, '2013-11-21 18:13:17', '1974-05-23 01:05:19', '1974-05-23 01:05:19'),
(698, 51, 230, 1, '2013-11-21 18:13:18', '1974-05-23 01:05:19', '1974-05-23 01:05:19'),
(699, 51, 124, 1, '2013-11-21 18:13:18', '1974-05-23 01:05:19', '1974-05-23 01:05:19'),
(700, 51, 18, 1, '2013-11-21 18:13:18', '1974-05-23 01:05:19', '1974-05-23 01:05:19'),
(701, 51, 127, 1, '2013-11-21 18:13:18', '1974-05-23 01:05:19', '1974-05-23 01:05:19'),
(702, 51, 213, 1, '2013-11-21 18:13:18', '1974-05-23 01:05:19', '1974-05-23 01:05:19'),
(703, 52, 30, 1, '2013-11-21 18:13:19', '1974-05-23 01:05:19', '1974-05-23 01:05:19'),
(704, 52, 22, 1, '2013-11-21 18:13:19', '1974-05-23 01:05:18', '1974-05-23 01:05:19'),
(705, 51, 129, 1, '2013-11-21 18:13:19', '1974-05-23 01:05:19', '1974-05-23 01:05:20'),
(706, 51, 87, 1, '2013-11-21 18:13:19', '1974-05-23 01:05:19', '1974-05-23 01:05:20'),
(707, 51, 142, 1, '2013-11-21 18:13:19', '1974-05-23 01:05:19', '1974-05-23 01:05:19'),
(708, 52, 191, 1, '2013-11-21 18:13:19', '1974-05-23 01:05:19', '1974-05-23 01:05:19'),
(709, 50, 269, 1, '2013-11-21 18:13:19', '1974-05-23 01:05:20', '1974-05-23 01:05:20'),
(710, 51, 228, 1, '2013-11-21 18:13:19', '1974-05-23 01:05:19', '1974-05-23 01:05:19'),
(711, 50, 265, 1, '2013-11-21 18:13:19', '1974-05-23 01:05:19', '1974-05-23 01:05:20'),
(712, 51, 88, 1, '2013-11-21 18:13:19', '1974-05-23 01:05:19', '1974-05-23 01:05:19'),
(713, 51, 266, 1, '2013-11-21 18:13:20', '1974-05-23 01:05:19', '1974-05-23 01:05:19'),
(714, 52, 121, 1, '2013-11-21 18:13:20', '1974-05-23 01:05:19', '1974-05-23 01:05:20'),
(715, 52, 226, 1, '2013-11-21 18:13:20', '1974-05-23 01:05:19', '1974-05-23 01:05:19'),
(716, 52, 229, 1, '2013-11-21 18:13:20', '1974-05-23 01:05:19', '1974-05-23 01:05:20'),
(717, 49, 263, 1, '2013-11-21 18:13:20', '1974-05-23 01:05:19', '1974-05-23 01:05:19'),
(718, 52, 83, 1, '2013-11-21 18:13:20', '1974-05-23 01:05:19', '1974-05-23 01:05:20'),
(719, 52, 216, 1, '2013-11-21 18:13:21', '1974-05-23 01:05:14', '1974-05-23 01:05:15'),
(720, 51, 239, 1, '2013-11-21 18:13:21', '1974-05-23 01:05:19', '1974-05-23 01:05:20'),
(721, 50, 187, 1, '2013-11-21 18:13:21', '1974-05-23 01:05:19', '1974-05-23 01:05:20'),
(722, 51, 21, 1, '2013-11-21 18:13:22', '1974-05-23 01:05:19', '1974-05-23 01:05:20'),
(723, 51, 122, 1, '2013-11-21 18:13:22', '1974-05-23 01:05:19', '1974-05-23 01:05:20'),
(724, 52, 242, 1, '2013-11-21 18:13:22', '1974-05-23 01:05:19', '1974-05-23 01:05:20'),
(725, 52, 196, 1, '2013-11-21 18:13:23', '1974-05-23 01:05:19', '1974-05-23 01:05:20'),
(726, 51, 240, 1, '2013-11-21 18:13:23', '1974-05-23 01:05:19', '1974-05-23 01:05:20'),
(727, 50, 183, 1, '2013-11-21 18:13:24', '1974-05-23 01:05:19', '1974-05-23 01:05:20'),
(728, 50, 65, 1, '2013-11-21 18:13:24', '1974-05-23 01:05:19', '1974-05-23 01:05:20'),
(729, 51, 236, 1, '2013-11-21 18:13:25', '1974-05-23 01:05:20', '1974-05-23 01:05:22'),
(730, 50, 42, 1, '2013-11-21 18:13:26', '1974-05-23 01:05:19', '1974-05-23 01:05:20'),
(731, 51, 55, 1, '2013-11-21 18:13:27', '1974-05-23 01:05:19', '1974-05-23 01:05:20'),
(732, 52, 264, 1, '2013-11-21 18:13:31', '1974-05-23 01:05:19', '1974-05-23 01:05:21'),
(733, 53, 22, 1, '2013-11-21 18:13:55', '1974-05-23 01:05:22', '1974-05-23 01:05:22'),
(734, 55, 243, 1, '2013-11-21 18:13:56', '1974-05-23 01:05:23', '1974-05-23 01:05:23'),
(735, 56, 261, 1, '2013-11-21 18:13:56', '1974-05-23 01:05:23', '1974-05-23 01:05:23'),
(736, 55, 271, 1, '2013-11-21 18:13:56', '1974-05-23 01:05:23', '1974-05-23 01:05:23'),
(737, 56, 273, 1, '2013-11-21 18:13:56', '1974-05-23 01:05:23', '1974-05-23 01:05:23'),
(738, 53, 191, 1, '2013-11-21 18:13:57', '1974-05-23 01:05:23', '1974-05-23 01:05:23'),
(739, 56, 65, 1, '2013-11-21 18:13:57', '1974-05-23 01:05:23', '1974-05-23 01:05:23'),
(740, 55, 228, 1, '2013-11-21 18:13:57', '1974-05-23 01:05:23', '1974-05-23 01:05:23'),
(741, 53, 260, 1, '2013-11-21 18:13:57', '1974-05-23 01:05:23', '1974-05-23 01:05:23'),
(742, 53, 216, 1, '2013-11-21 18:13:57', '1974-05-23 01:05:18', '1974-05-23 01:05:18'),
(743, 53, 127, 1, '2013-11-21 18:13:57', '1974-05-23 01:05:23', '1974-05-23 01:05:23'),
(744, 56, 196, 1, '2013-11-21 18:13:57', '1974-05-23 01:05:23', '1974-05-23 01:05:23'),
(745, 55, 187, 1, '2013-11-21 18:13:58', '1974-05-23 01:05:23', '1974-05-23 01:05:23'),
(746, 55, 269, 1, '2013-11-21 18:13:58', '1974-05-23 01:05:24', '1974-05-23 01:05:24'),
(747, 53, 213, 1, '2013-11-21 18:13:58', '1974-05-23 01:05:23', '1974-05-23 01:05:23'),
(748, 54, 208, 1, '2013-11-21 18:13:58', '1974-05-23 01:05:23', '1974-05-23 01:05:23'),
(749, 55, 88, 1, '2013-11-21 18:13:58', '1974-05-23 01:05:23', '1974-05-23 01:05:23'),
(750, 53, 230, 1, '2013-11-21 18:13:58', '1974-05-23 01:05:23', '1974-05-23 01:05:23'),
(751, 56, 226, 1, '2013-11-21 18:13:58', '1974-05-23 01:05:23', '1974-05-23 01:05:23'),
(752, 55, 229, 1, '2013-11-21 18:13:58', '1974-05-23 01:05:23', '1974-05-23 01:05:23'),
(753, 53, 83, 1, '2013-11-21 18:13:58', '1974-05-23 01:05:23', '1974-05-23 01:05:23'),
(754, 56, 124, 1, '2013-11-21 18:13:59', '1974-05-23 01:05:23', '1974-05-23 01:05:23'),
(755, 55, 190, 1, '2013-11-21 18:13:59', '1974-05-23 01:05:23', '1974-05-23 01:05:23'),
(756, 53, 87, 1, '2013-11-21 18:13:59', '1974-05-23 01:05:23', '1974-05-23 01:05:24'),
(757, 56, 129, 1, '2013-11-21 18:13:59', '1974-05-23 01:05:23', '1974-05-23 01:05:24'),
(758, 55, 142, 1, '2013-11-21 18:13:59', '1974-05-23 01:05:23', '1974-05-23 01:05:23'),
(759, 53, 236, 1, '2013-11-21 18:13:59', '1974-05-23 01:05:24', '1974-05-23 01:05:25'),
(760, 55, 265, 1, '2013-11-21 18:14:00', '1974-05-23 01:05:23', '1974-05-23 01:05:24'),
(761, 56, 121, 1, '2013-11-21 18:14:00', '1974-05-23 01:05:23', '1974-05-23 01:05:24'),
(762, 56, 266, 1, '2013-11-21 18:14:00', '1974-05-23 01:05:23', '1974-05-23 01:05:24'),
(763, 53, 52, 1, '2013-11-21 18:14:00', '1974-05-23 01:05:23', '1974-05-23 01:05:24'),
(764, 53, 239, 1, '2013-11-21 18:14:00', '1974-05-23 01:05:23', '1974-05-23 01:05:24'),
(765, 53, 30, 1, '2013-11-21 18:14:00', '1974-05-23 01:05:23', '1974-05-23 01:05:24'),
(766, 55, 55, 1, '2013-11-21 18:14:00', '1974-05-23 01:05:23', '1974-05-23 01:05:24'),
(767, 53, 122, 1, '2013-11-21 18:14:01', '1974-05-23 01:05:23', '1974-05-23 01:05:24'),
(768, 56, 242, 1, '2013-11-21 18:14:02', '1974-05-23 01:05:23', '1974-05-23 01:05:24'),
(769, 53, 18, 1, '2013-11-21 18:14:02', '1974-05-23 01:05:23', '1974-05-23 01:05:24'),
(770, 53, 188, 1, '2013-11-21 18:14:03', '1974-05-23 01:05:23', '1974-05-23 01:05:24'),
(771, 53, 240, 1, '2013-11-21 18:14:03', '1974-05-23 01:05:23', '1974-05-23 01:05:24'),
(772, 53, 101, 1, '2013-11-21 18:14:03', '1974-05-23 01:05:23', '1974-05-23 01:05:24'),
(773, 56, 263, 1, '2013-11-21 18:14:04', '1974-05-23 01:05:23', '1974-05-23 01:05:24'),
(774, 53, 21, 1, '2013-11-21 18:14:04', '1974-05-23 01:05:23', '1974-05-23 01:05:24'),
(775, 55, 42, 1, '2013-11-21 18:14:05', '1974-05-23 01:05:23', '1974-05-23 01:05:24'),
(776, 53, 183, 1, '2013-11-21 18:14:07', '1974-05-23 01:05:23', '1974-05-23 01:05:24'),
(777, 53, 20, 1, '2013-11-21 18:14:09', '1974-05-23 01:05:23', '1974-05-23 01:05:24'),
(778, 60, 22, 1, '2013-11-21 18:14:21', '1974-05-23 01:05:25', '1974-05-23 01:05:25'),
(779, 58, 273, 1, '2013-11-21 18:14:22', '1974-05-23 01:05:26', '1974-05-23 01:05:26'),
(780, 57, 265, 1, '2013-11-21 18:14:23', '1974-05-23 01:05:26', '1974-05-23 01:05:26'),
(781, 58, 243, 1, '2013-11-21 18:14:24', '1974-05-23 01:05:26', '1974-05-23 01:05:26'),
(782, 59, 65, 1, '2013-11-21 18:14:24', '1974-05-23 01:05:26', '1974-05-23 01:05:26'),
(783, 59, 52, 1, '2013-11-21 18:14:24', '1974-05-23 01:05:26', '1974-05-23 01:05:26'),
(784, 59, 191, 1, '2013-11-21 18:14:24', '1974-05-23 01:05:26', '1974-05-23 01:05:26'),
(785, 58, 142, 1, '2013-11-21 18:14:24', '1974-05-23 01:05:25', '1974-05-23 01:05:26'),
(786, 60, 261, 1, '2013-11-21 18:14:25', '1974-05-23 01:05:26', '1974-05-23 01:05:26'),
(787, 57, 124, 1, '2013-11-21 18:14:25', '1974-05-23 01:05:26', '1974-05-23 01:05:26'),
(788, 60, 87, 1, '2013-11-21 18:14:25', '1974-05-23 01:05:26', '1974-05-23 01:05:26'),
(789, 60, 121, 1, '2013-11-21 18:14:25', '1974-05-23 01:05:26', '1974-05-23 01:05:26'),
(790, 59, 18, 1, '2013-11-21 18:14:25', '1974-05-23 01:05:26', '1974-05-23 01:05:26'),
(791, 59, 127, 1, '2013-11-21 18:14:25', '1974-05-23 01:05:26', '1974-05-23 01:05:26'),
(792, 58, 129, 1, '2013-11-21 18:14:25', '1974-05-23 01:05:26', '1974-05-23 01:05:26'),
(793, 60, 55, 1, '2013-11-21 18:14:25', '1974-05-23 01:05:26', '1974-05-23 01:05:26'),
(794, 59, 229, 1, '2013-11-21 18:14:25', '1974-05-23 01:05:26', '1974-05-23 01:05:26'),
(795, 58, 196, 1, '2013-11-21 18:14:25', '1974-05-23 01:05:25', '1974-05-23 01:05:26'),
(796, 60, 230, 1, '2013-11-21 18:14:25', '1974-05-23 01:05:26', '1974-05-23 01:05:26'),
(797, 58, 21, 1, '2013-11-21 18:14:26', '1974-05-23 01:05:26', '1974-05-23 01:05:26'),
(798, 60, 30, 1, '2013-11-21 18:14:26', '1974-05-23 01:05:26', '1974-05-23 01:05:26'),
(799, 60, 228, 1, '2013-11-21 18:14:26', '1974-05-23 01:05:26', '1974-05-23 01:05:26'),
(800, 57, 236, 1, '2013-11-21 18:14:26', '1974-05-23 01:05:27', '1974-05-23 01:05:28'),
(801, 60, 187, 1, '2013-11-21 18:14:26', '1974-05-23 01:05:26', '1974-05-23 01:05:26'),
(802, 59, 88, 1, '2013-11-21 18:14:26', '1974-05-23 01:05:26', '1974-05-23 01:05:26'),
(803, 58, 269, 1, '2013-11-21 18:14:27', '1974-05-23 01:05:27', '1974-05-23 01:05:27'),
(804, 57, 240, 1, '2013-11-21 18:14:27', '1974-05-23 01:05:26', '1974-05-23 01:05:26'),
(805, 59, 216, 1, '2013-11-21 18:14:27', '1974-05-23 01:05:21', '1974-05-23 01:05:21'),
(806, 60, 266, 1, '2013-11-21 18:14:27', '1974-05-23 01:05:26', '1974-05-23 01:05:26'),
(807, 57, 271, 1, '2013-11-21 18:14:28', '1974-05-23 01:05:26', '1974-05-23 01:05:26'),
(808, 59, 122, 1, '2013-11-21 18:14:28', '1974-05-23 01:05:26', '1974-05-23 01:05:26'),
(809, 60, 242, 1, '2013-11-21 18:14:28', '1974-05-23 01:05:26', '1974-05-23 01:05:26'),
(810, 60, 226, 1, '2013-11-21 18:14:28', '1974-05-23 01:05:26', '1974-05-23 01:05:26'),
(811, 57, 213, 1, '2013-11-21 18:14:28', '1974-05-23 01:05:26', '1974-05-23 01:05:26'),
(812, 59, 83, 1, '2013-11-21 18:14:28', '1974-05-23 01:05:25', '1974-05-23 01:05:26'),
(813, 60, 183, 1, '2013-11-21 18:14:29', '1974-05-23 01:05:26', '1974-05-23 01:05:26'),
(814, 57, 42, 1, '2013-11-21 18:14:29', '1974-05-23 01:05:26', '1974-05-23 01:05:26'),
(815, 59, 239, 1, '2013-11-21 18:14:30', '1974-05-23 01:05:26', '1974-05-23 01:05:27'),
(816, 58, 190, 1, '2013-11-21 18:14:30', '1974-05-23 01:05:26', '1974-05-23 01:05:26'),
(817, 60, 260, 1, '2013-11-21 18:14:30', '1974-05-23 01:05:25', '1974-05-23 01:05:26'),
(818, 58, 20, 1, '2013-11-21 18:14:31', '1974-05-23 01:05:25', '1974-05-23 01:05:27'),
(819, 60, 274, 1, '2013-11-21 18:14:31', '1974-05-23 01:05:26', '1974-05-23 01:05:27'),
(820, 58, 263, 1, '2013-11-21 18:14:32', '1974-05-23 01:05:25', '1974-05-23 01:05:27'),
(821, 60, 188, 1, '2013-11-21 18:14:33', '1974-05-23 01:05:26', '1974-05-23 01:05:27'),
(822, 57, 237, 1, '2013-11-21 18:14:37', '1974-05-23 01:05:26', '1974-05-23 01:05:27'),
(823, 61, 22, 1, '2013-11-21 18:14:46', '1974-05-23 01:05:27', '1974-05-23 01:05:27'),
(824, 64, 228, 1, '2013-11-21 18:14:48', '1974-05-23 01:05:28', '1974-05-23 01:05:28'),
(825, 64, 265, 1, '2013-11-21 18:14:48', '1974-05-23 01:05:28', '1974-05-23 01:05:28'),
(826, 62, 261, 1, '2013-11-21 18:14:48', '1974-05-23 01:05:28', '1974-05-23 01:05:28'),
(827, 61, 273, 1, '2013-11-21 18:14:48', '1974-05-23 01:05:28', '1974-05-23 01:05:28'),
(828, 61, 87, 1, '2013-11-21 18:14:48', '1974-05-23 01:05:28', '1974-05-23 01:05:28'),
(829, 62, 260, 1, '2013-11-21 18:14:48', '1974-05-23 01:05:28', '1974-05-23 01:05:28'),
(830, 62, 269, 1, '2013-11-21 18:14:48', '1974-05-23 01:05:29', '1974-05-23 01:05:29'),
(831, 62, 121, 1, '2013-11-21 18:14:48', '1974-05-23 01:05:28', '1974-05-23 01:05:28'),
(832, 61, 243, 1, '2013-11-21 18:14:49', '1974-05-23 01:05:28', '1974-05-23 01:05:28'),
(833, 62, 22, 1, '2013-11-21 18:14:49', '1974-05-23 01:05:27', '1974-05-23 01:05:28'),
(834, 62, 88, 1, '2013-11-21 18:14:49', '1974-05-23 01:05:28', '1974-05-23 01:05:28'),
(835, 62, 216, 1, '2013-11-21 18:14:49', '1974-05-23 01:05:23', '1974-05-23 01:05:24'),
(836, 64, 191, 1, '2013-11-21 18:14:49', '1974-05-23 01:05:28', '1974-05-23 01:05:28'),
(837, 61, 124, 1, '2013-11-21 18:14:49', '1974-05-23 01:05:28', '1974-05-23 01:05:28'),
(838, 62, 229, 1, '2013-11-21 18:14:49', '1974-05-23 01:05:28', '1974-05-23 01:05:28'),
(839, 61, 196, 1, '2013-11-21 18:14:49', '1974-05-23 01:05:28', '1974-05-23 01:05:28'),
(840, 61, 142, 1, '2013-11-21 18:14:49', '1974-05-23 01:05:28', '1974-05-23 01:05:28'),
(841, 62, 30, 1, '2013-11-21 18:14:49', '1974-05-23 01:05:28', '1974-05-23 01:05:28'),
(842, 61, 263, 1, '2013-11-21 18:14:50', '1974-05-23 01:05:28', '1974-05-23 01:05:28'),
(843, 61, 236, 1, '2013-11-21 18:14:50', '1974-05-23 01:05:29', '1974-05-23 01:05:30'),
(844, 62, 266, 1, '2013-11-21 18:14:50', '1974-05-23 01:05:28', '1974-05-23 01:05:29'),
(845, 64, 65, 1, '2013-11-21 18:14:50', '1974-05-23 01:05:28', '1974-05-23 01:05:29'),
(846, 62, 242, 1, '2013-11-21 18:14:51', '1974-05-23 01:05:28', '1974-05-23 01:05:29'),
(847, 61, 127, 1, '2013-11-21 18:14:51', '1974-05-23 01:05:28', '1974-05-23 01:05:29'),
(848, 64, 190, 1, '2013-11-21 18:14:51', '1974-05-23 01:05:28', '1974-05-23 01:05:29'),
(849, 63, 21, 1, '2013-11-21 18:14:51', '1974-05-23 01:05:28', '1974-05-23 01:05:29'),
(850, 62, 230, 1, '2013-11-21 18:14:51', '1974-05-23 01:05:28', '1974-05-23 01:05:29'),
(851, 62, 52, 1, '2013-11-21 18:14:51', '1974-05-23 01:05:28', '1974-05-23 01:05:29'),
(852, 62, 83, 1, '2013-11-21 18:14:51', '1974-05-23 01:05:28', '1974-05-23 01:05:29'),
(853, 62, 271, 1, '2013-11-21 18:14:52', '1974-05-23 01:05:28', '1974-05-23 01:05:29'),
(854, 64, 274, 1, '2013-11-21 18:14:52', '1974-05-23 01:05:28', '1974-05-23 01:05:29'),
(855, 64, 213, 1, '2013-11-21 18:14:52', '1974-05-23 01:05:28', '1974-05-23 01:05:29'),
(856, 62, 18, 1, '2013-11-21 18:14:52', '1974-05-23 01:05:28', '1974-05-23 01:05:29'),
(857, 62, 129, 1, '2013-11-21 18:14:52', '1974-05-23 01:05:28', '1974-05-23 01:05:29'),
(858, 61, 42, 1, '2013-11-21 18:14:53', '1974-05-23 01:05:28', '1974-05-23 01:05:29'),
(859, 62, 240, 1, '2013-11-21 18:14:53', '1974-05-23 01:05:28', '1974-05-23 01:05:29'),
(860, 62, 226, 1, '2013-11-21 18:14:53', '1974-05-23 01:05:28', '1974-05-23 01:05:29'),
(861, 64, 122, 1, '2013-11-21 18:14:54', '1974-05-23 01:05:28', '1974-05-23 01:05:29'),
(862, 63, 237, 1, '2013-11-21 18:14:54', '1974-05-23 01:05:28', '1974-05-23 01:05:29'),
(863, 61, 239, 1, '2013-11-21 18:14:55', '1974-05-23 01:05:28', '1974-05-23 01:05:29'),
(864, 64, 187, 1, '2013-11-21 18:14:55', '1974-05-23 01:05:28', '1974-05-23 01:05:29'),
(865, 63, 183, 1, '2013-11-21 18:14:55', '1974-05-23 01:05:28', '1974-05-23 01:05:29'),
(866, 61, 20, 1, '2013-11-21 18:14:55', '1974-05-23 01:05:28', '1974-05-23 01:05:29'),
(867, 62, 55, 1, '2013-11-21 18:14:56', '1974-05-23 01:05:28', '1974-05-23 01:05:29'),
(868, 67, 22, 1, '2013-11-21 18:15:30', '1974-05-23 01:05:32', '1974-05-23 01:05:32'),
(869, 68, 65, 1, '2013-11-21 18:15:31', '1974-05-23 01:05:32', '1974-05-23 01:05:33'),
(870, 68, 265, 1, '2013-11-21 18:15:31', '1974-05-23 01:05:32', '1974-05-23 01:05:33'),
(871, 68, 273, 1, '2013-11-21 18:15:31', '1974-05-23 01:05:32', '1974-05-23 01:05:33'),
(872, 66, 243, 1, '2013-11-21 18:15:32', '1974-05-23 01:05:32', '1974-05-23 01:05:33'),
(873, 66, 271, 1, '2013-11-21 18:15:33', '1974-05-23 01:05:32', '1974-05-23 01:05:33'),
(874, 68, 266, 1, '2013-11-21 18:15:33', '1974-05-23 01:05:32', '1974-05-23 01:05:33'),
(875, 68, 261, 1, '2013-11-21 18:15:33', '1974-05-23 01:05:32', '1974-05-23 01:05:33'),
(876, 66, 52, 1, '2013-11-21 18:15:33', '1974-05-23 01:05:32', '1974-05-23 01:05:33'),
(877, 68, 229, 1, '2013-11-21 18:15:33', '1974-05-23 01:05:32', '1974-05-23 01:05:33'),
(878, 68, 22, 1, '2013-11-21 18:15:33', '1974-05-23 01:05:32', '1974-05-23 01:05:32'),
(879, 68, 121, 1, '2013-11-21 18:15:33', '1974-05-23 01:05:32', '1974-05-23 01:05:33'),
(880, 66, 83, 1, '2013-11-21 18:15:34', '1974-05-23 01:05:32', '1974-05-23 01:05:33'),
(881, 66, 191, 1, '2013-11-21 18:15:34', '1974-05-23 01:05:32', '1974-05-23 01:05:33'),
(882, 66, 127, 1, '2013-11-21 18:15:34', '1974-05-23 01:05:32', '1974-05-23 01:05:33'),
(883, 68, 269, 1, '2013-11-21 18:15:34', '1974-05-23 01:05:33', '1974-05-23 01:05:34'),
(884, 68, 196, 1, '2013-11-21 18:15:34', '1974-05-23 01:05:32', '1974-05-23 01:05:33'),
(885, 68, 18, 1, '2013-11-21 18:15:34', '1974-05-23 01:05:32', '1974-05-23 01:05:33'),
(886, 68, 226, 1, '2013-11-21 18:15:34', '1974-05-23 01:05:32', '1974-05-23 01:05:33'),
(887, 66, 260, 1, '2013-11-21 18:15:34', '1974-05-23 01:05:32', '1974-05-23 01:05:33'),
(888, 66, 237, 1, '2013-11-21 18:15:35', '1974-05-23 01:05:32', '1974-05-23 01:05:33'),
(889, 68, 239, 1, '2013-11-21 18:15:35', '1974-05-23 01:05:32', '1974-05-23 01:05:33'),
(890, 66, 88, 1, '2013-11-21 18:15:35', '1974-05-23 01:05:32', '1974-05-23 01:05:33'),
(891, 66, 242, 1, '2013-11-21 18:15:35', '1974-05-23 01:05:32', '1974-05-23 01:05:33'),
(892, 66, 230, 1, '2013-11-21 18:15:35', '1974-05-23 01:05:32', '1974-05-23 01:05:33'),
(893, 66, 216, 1, '2013-11-21 18:15:36', '1974-05-23 01:05:28', '1974-05-23 01:05:28'),
(894, 66, 228, 1, '2013-11-21 18:15:36', '1974-05-23 01:05:32', '1974-05-23 01:05:33'),
(895, 65, 213, 1, '2013-11-21 18:15:36', '1974-05-23 01:05:32', '1974-05-23 01:05:33'),
(896, 68, 30, 1, '2013-11-21 18:15:36', '1974-05-23 01:05:32', '1974-05-23 01:05:33'),
(897, 66, 87, 1, '2013-11-21 18:15:36', '1974-05-23 01:05:32', '1974-05-23 01:05:33'),
(898, 68, 129, 1, '2013-11-21 18:15:36', '1974-05-23 01:05:33', '1974-05-23 01:05:33'),
(899, 68, 274, 1, '2013-11-21 18:15:36', '1974-05-23 01:05:32', '1974-05-23 01:05:33'),
(900, 66, 142, 1, '2013-11-21 18:15:36', '1974-05-23 01:05:32', '1974-05-23 01:05:33'),
(901, 68, 187, 1, '2013-11-21 18:15:38', '1974-05-23 01:05:32', '1974-05-23 01:05:33'),
(902, 68, 122, 1, '2013-11-21 18:15:38', '1974-05-23 01:05:32', '1974-05-23 01:05:33'),
(903, 68, 263, 1, '2013-11-21 18:15:38', '1974-05-23 01:05:32', '1974-05-23 01:05:33'),
(904, 68, 240, 1, '2013-11-21 18:15:39', '1974-05-23 01:05:32', '1974-05-23 01:05:33'),
(905, 66, 42, 1, '2013-11-21 18:15:39', '1974-05-23 01:05:32', '1974-05-23 01:05:33'),
(906, 66, 55, 1, '2013-11-21 18:15:40', '1974-05-23 01:05:32', '1974-05-23 01:05:34'),
(907, 67, 20, 1, '2013-11-21 18:15:41', '1974-05-23 01:05:32', '1974-05-23 01:05:34'),
(908, 65, 183, 1, '2013-11-21 18:15:42', '1974-05-23 01:05:32', '1974-05-23 01:05:34'),
(909, 68, 275, 1, '2013-11-21 18:15:43', '1974-05-23 01:05:32', '1974-05-23 01:05:34'),
(910, 71, 22, 1, '2013-11-21 18:16:11', '1974-05-23 01:05:36', '1974-05-23 01:05:36'),
(911, 70, 243, 1, '2013-11-21 18:16:13', '1974-05-23 01:05:37', '1974-05-23 01:05:37'),
(912, 69, 273, 1, '2013-11-21 18:16:13', '1974-05-23 01:05:36', '1974-05-23 01:05:37'),
(913, 69, 261, 1, '2013-11-21 18:16:13', '1974-05-23 01:05:36', '1974-05-23 01:05:37'),
(914, 72, 265, 1, '2013-11-21 18:16:13', '1974-05-23 01:05:37', '1974-05-23 01:05:37'),
(915, 72, 275, 1, '2013-11-21 18:16:14', '1974-05-23 01:05:36', '1974-05-23 01:05:37'),
(916, 72, 230, 1, '2013-11-21 18:16:14', '1974-05-23 01:05:37', '1974-05-23 01:05:37'),
(917, 72, 229, 1, '2013-11-21 18:16:14', '1974-05-23 01:05:36', '1974-05-23 01:05:37'),
(918, 69, 22, 1, '2013-11-21 18:16:14', '1974-05-23 01:05:36', '1974-05-23 01:05:36'),
(919, 69, 196, 1, '2013-11-21 18:16:15', '1974-05-23 01:05:36', '1974-05-23 01:05:37'),
(920, 72, 65, 1, '2013-11-21 18:16:15', '1974-05-23 01:05:37', '1974-05-23 01:05:37'),
(921, 72, 52, 1, '2013-11-21 18:16:16', '1974-05-23 01:05:36', '1974-05-23 01:05:37'),
(922, 69, 88, 1, '2013-11-21 18:16:16', '1974-05-23 01:05:36', '1974-05-23 01:05:37'),
(923, 69, 269, 1, '2013-11-21 18:16:16', '1974-05-23 01:05:37', '1974-05-23 01:05:38'),
(924, 69, 83, 1, '2013-11-21 18:16:16', '1974-05-23 01:05:36', '1974-05-23 01:05:37'),
(925, 72, 266, 1, '2013-11-21 18:16:16', '1974-05-23 01:05:37', '1974-05-23 01:05:37'),
(926, 69, 271, 1, '2013-11-21 18:16:16', '1974-05-23 01:05:37', '1974-05-23 01:05:37'),
(927, 69, 124, 1, '2013-11-21 18:16:16', '1974-05-23 01:05:36', '1974-05-23 01:05:37'),
(928, 71, 216, 1, '2013-11-21 18:16:17', '1974-05-23 01:05:32', '1974-05-23 01:05:32'),
(929, 70, 21, 1, '2013-11-21 18:16:17', '1974-05-23 01:05:37', '1974-05-23 01:05:37'),
(930, 72, 127, 1, '2013-11-21 18:16:17', '1974-05-23 01:05:36', '1974-05-23 01:05:37'),
(931, 69, 226, 1, '2013-11-21 18:16:17', '1974-05-23 01:05:36', '1974-05-23 01:05:37'),
(932, 69, 129, 1, '2013-11-21 18:16:17', '1974-05-23 01:05:37', '1974-05-23 01:05:38'),
(933, 69, 237, 1, '2013-11-21 18:16:17', '1974-05-23 01:05:36', '1974-05-23 01:05:37'),
(934, 70, 87, 1, '2013-11-21 18:16:17', '1974-05-23 01:05:37', '1974-05-23 01:05:37'),
(935, 71, 213, 1, '2013-11-21 18:16:18', '1974-05-23 01:05:36', '1974-05-23 01:05:37'),
(936, 69, 242, 1, '2013-11-21 18:16:18', '1974-05-23 01:05:37', '1974-05-23 01:05:37'),
(937, 72, 228, 1, '2013-11-21 18:16:18', '1974-05-23 01:05:36', '1974-05-23 01:05:37'),
(938, 72, 121, 1, '2013-11-21 18:16:19', '1974-05-23 01:05:36', '1974-05-23 01:05:37'),
(939, 72, 122, 1, '2013-11-21 18:16:19', '1974-05-23 01:05:37', '1974-05-23 01:05:37'),
(940, 71, 30, 1, '2013-11-21 18:16:19', '1974-05-23 01:05:36', '1974-05-23 01:05:37'),
(941, 72, 263, 1, '2013-11-21 18:16:19', '1974-05-23 01:05:36', '1974-05-23 01:05:37'),
(942, 72, 42, 1, '2013-11-21 18:16:20', '1974-05-23 01:05:36', '1974-05-23 01:05:37'),
(943, 70, 191, 1, '2013-11-21 18:16:20', '1974-05-23 01:05:36', '1974-05-23 01:05:38'),
(944, 69, 274, 1, '2013-11-21 18:16:20', '1974-05-23 01:05:37', '1974-05-23 01:05:38'),
(945, 71, 260, 1, '2013-11-21 18:16:20', '1974-05-23 01:05:36', '1974-05-23 01:05:37'),
(946, 71, 240, 1, '2013-11-21 18:16:21', '1974-05-23 01:05:36', '1974-05-23 01:05:38'),
(947, 72, 18, 1, '2013-11-21 18:16:21', '1974-05-23 01:05:36', '1974-05-23 01:05:38'),
(948, 72, 55, 1, '2013-11-21 18:16:21', '1974-05-23 01:05:36', '1974-05-23 01:05:38'),
(949, 69, 239, 1, '2013-11-21 18:16:22', '1974-05-23 01:05:36', '1974-05-23 01:05:38'),
(950, 72, 142, 1, '2013-11-21 18:16:22', '1974-05-23 01:05:36', '1974-05-23 01:05:38'),
(951, 70, 183, 1, '2013-11-21 18:16:23', '1974-05-23 01:05:36', '1974-05-23 01:05:38'),
(952, 69, 187, 1, '2013-11-21 18:16:23', '1974-05-23 01:05:36', '1974-05-23 01:05:38'),
(953, 72, 20, 1, '2013-11-21 18:16:26', '1974-05-23 01:05:36', '1974-05-23 01:05:38'),
(954, 81, 22, 1, '2013-11-21 18:16:50', '1974-05-23 01:05:40', '1974-05-23 01:05:40'),
(955, 73, 273, 1, '2013-11-21 18:16:50', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(956, 73, 261, 1, '2013-11-21 18:16:51', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(957, 73, 265, 1, '2013-11-21 18:16:52', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(958, 82, 265, 1, '2013-11-21 18:16:52', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(959, 73, 52, 1, '2013-11-21 18:16:52', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(960, 78, 52, 1, '2013-11-21 18:16:52', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(961, 78, 187, 1, '2013-11-21 18:16:52', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(962, 82, 266, 1, '2013-11-21 18:16:52', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(963, 73, 229, 1, '2013-11-21 18:16:53', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(964, 74, 229, 1, '2013-11-21 18:16:53', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(965, 73, 65, 1, '2013-11-21 18:16:53', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(966, 81, 65, 1, '2013-11-21 18:16:53', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(967, 73, 42, 1, '2013-11-21 18:16:53', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(968, 77, 42, 1, '2013-11-21 18:16:53', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(969, 81, 42, 1, '2013-11-21 18:16:53', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(970, 73, 142, 1, '2013-11-21 18:16:53', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(971, 77, 127, 1, '2013-11-21 18:16:54', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(972, 81, 127, 1, '2013-11-21 18:16:54', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(973, 73, 87, 1, '2013-11-21 18:16:54', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(974, 73, 124, 1, '2013-11-21 18:16:54', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(975, 74, 124, 1, '2013-11-21 18:16:54', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(976, 77, 124, 1, '2013-11-21 18:16:54', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(977, 78, 124, 1, '2013-11-21 18:16:54', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(978, 81, 124, 1, '2013-11-21 18:16:54', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(979, 82, 124, 1, '2013-11-21 18:16:54', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(980, 77, 191, 1, '2013-11-21 18:16:54', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(981, 78, 191, 1, '2013-11-21 18:16:54', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(982, 82, 191, 1, '2013-11-21 18:16:54', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(983, 78, 263, 1, '2013-11-21 18:16:54', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(984, 74, 242, 1, '2013-11-21 18:16:54', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(985, 78, 242, 1, '2013-11-21 18:16:54', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(986, 73, 237, 1, '2013-11-21 18:16:54', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(987, 74, 271, 1, '2013-11-21 18:16:54', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(988, 77, 271, 1, '2013-11-21 18:16:54', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(989, 78, 122, 1, '2013-11-21 18:16:54', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(990, 78, 183, 1, '2013-11-21 18:16:55', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(991, 82, 230, 1, '2013-11-21 18:16:55', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(992, 82, 216, 1, '2013-11-21 18:16:55', '1974-05-23 01:05:35', '1974-05-23 01:05:36'),
(993, 82, 18, 1, '2013-11-21 18:16:55', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(994, 73, 226, 1, '2013-11-21 18:16:55', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(995, 78, 226, 1, '2013-11-21 18:16:55', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(996, 73, 274, 1, '2013-11-21 18:16:55', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(997, 78, 274, 1, '2013-11-21 18:16:55', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(998, 73, 228, 1, '2013-11-21 18:16:55', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(999, 78, 228, 1, '2013-11-21 18:16:55', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(1000, 82, 228, 1, '2013-11-21 18:16:55', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(1001, 78, 269, 1, '2013-11-21 18:16:55', '1974-05-23 01:05:41', '1974-05-23 01:05:42'),
(1002, 82, 269, 1, '2013-11-21 18:16:55', '1974-05-23 01:05:41', '1974-05-23 01:05:42'),
(1003, 74, 21, 1, '2013-11-21 18:16:56', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(1004, 77, 21, 1, '2013-11-21 18:16:56', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(1005, 73, 30, 1, '2013-11-21 18:16:56', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(1006, 82, 30, 1, '2013-11-21 18:16:56', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(1007, 73, 213, 1, '2013-11-21 18:16:56', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(1008, 74, 213, 1, '2013-11-21 18:16:56', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(1009, 82, 243, 1, '2013-11-21 18:16:57', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(1010, 82, 275, 1, '2013-11-21 18:16:57', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(1011, 73, 88, 1, '2013-11-21 18:16:57', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(1012, 77, 88, 1, '2013-11-21 18:16:57', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(1013, 78, 88, 1, '2013-11-21 18:16:57', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(1014, 78, 121, 1, '2013-11-21 18:16:58', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(1015, 77, 129, 1, '2013-11-21 18:16:58', '1974-05-23 01:05:41', '1974-05-23 01:05:42'),
(1016, 78, 129, 1, '2013-11-21 18:16:58', '1974-05-23 01:05:41', '1974-05-23 01:05:42'),
(1017, 77, 260, 1, '2013-11-21 18:16:59', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(1018, 78, 260, 1, '2013-11-21 18:16:59', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(1019, 82, 239, 1, '2013-11-21 18:16:59', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(1020, 73, 196, 1, '2013-11-21 18:17:00', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(1021, 77, 196, 1, '2013-11-21 18:17:00', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(1022, 82, 196, 1, '2013-11-21 18:17:00', '1974-05-23 01:05:40', '1974-05-23 01:05:41'),
(1023, 73, 101, 1, '2013-11-21 18:17:02', '1974-05-23 01:05:40', '1974-05-23 01:05:42'),
(1024, 77, 101, 1, '2013-11-21 18:17:02', '1974-05-23 01:05:40', '1974-05-23 01:05:42'),
(1025, 81, 101, 1, '2013-11-21 18:17:02', '1974-05-23 01:05:40', '1974-05-23 01:05:42'),
(1026, 81, 83, 1, '2013-11-21 18:17:02', '1974-05-23 01:05:40', '1974-05-23 01:05:42'),
(1027, 82, 83, 1, '2013-11-21 18:17:02', '1974-05-23 01:05:40', '1974-05-23 01:05:42'),
(1028, 74, 240, 1, '2013-11-21 18:17:02', '1974-05-23 01:05:40', '1974-05-23 01:05:42'),
(1029, 78, 240, 1, '2013-11-21 18:17:02', '1974-05-23 01:05:40', '1974-05-23 01:05:42'),
(1030, 73, 20, 1, '2013-11-21 18:17:06', '1974-05-23 01:05:40', '1974-05-23 01:05:42'),
(1031, 90, 213, 1, '2013-11-21 18:17:19', '1974-05-23 01:05:43', '1974-05-23 01:05:43'),
(1032, 90, 121, 1, '2013-11-21 18:17:20', '1974-05-23 01:05:43', '1974-05-23 01:05:44'),
(1033, 90, 187, 1, '2013-11-21 18:17:20', '1974-05-23 01:05:43', '1974-05-23 01:05:44'),
(1034, 85, 243, 1, '2013-11-21 18:17:20', '1974-05-23 01:05:43', '1974-05-23 01:05:44'),
(1035, 90, 265, 1, '2013-11-21 18:17:20', '1974-05-23 01:05:43', '1974-05-23 01:05:44'),
(1036, 90, 65, 1, '2013-11-21 18:17:20', '1974-05-23 01:05:43', '1974-05-23 01:05:44'),
(1037, 85, 22, 1, '2013-11-21 18:17:20', '1974-05-23 01:05:43', '1974-05-23 01:05:43'),
(1038, 90, 83, 1, '2013-11-21 18:17:21', '1974-05-23 01:05:43', '1974-05-23 01:05:44'),
(1039, 90, 52, 1, '2013-11-21 18:17:21', '1974-05-23 01:05:43', '1974-05-23 01:05:44'),
(1040, 90, 127, 1, '2013-11-21 18:17:21', '1974-05-23 01:05:43', '1974-05-23 01:05:44'),
(1041, 90, 18, 1, '2013-11-21 18:17:21', '1974-05-23 01:05:43', '1974-05-23 01:05:44'),
(1042, 90, 230, 1, '2013-11-21 18:17:21', '1974-05-23 01:05:43', '1974-05-23 01:05:44'),
(1043, 90, 226, 1, '2013-11-21 18:17:21', '1974-05-23 01:05:43', '1974-05-23 01:05:44'),
(1044, 90, 30, 1, '2013-11-21 18:17:21', '1974-05-23 01:05:43', '1974-05-23 01:05:44'),
(1045, 90, 228, 1, '2013-11-21 18:17:21', '1974-05-23 01:05:43', '1974-05-23 01:05:44'),
(1046, 90, 183, 1, '2013-11-21 18:17:21', '1974-05-23 01:05:43', '1974-05-23 01:05:44'),
(1047, 90, 229, 1, '2013-11-21 18:17:21', '1974-05-23 01:05:43', '1974-05-23 01:05:44'),
(1048, 90, 261, 1, '2013-11-21 18:17:21', '1974-05-23 01:05:43', '1974-05-23 01:05:44'),
(1049, 90, 190, 1, '2013-11-21 18:17:21', '1974-05-23 01:05:43', '1974-05-23 01:05:44'),
(1050, 90, 191, 1, '2013-11-21 18:17:21', '1974-05-23 01:05:43', '1974-05-23 01:05:44'),
(1051, 90, 266, 1, '2013-11-21 18:17:21', '1974-05-23 01:05:43', '1974-05-23 01:05:44'),
(1052, 90, 271, 1, '2013-11-21 18:17:21', '1974-05-23 01:05:43', '1974-05-23 01:05:44'),
(1053, 90, 275, 1, '2013-11-21 18:17:21', '1974-05-23 01:05:43', '1974-05-23 01:05:44'),
(1054, 90, 216, 1, '2013-11-21 18:17:21', '1974-05-23 01:05:38', '1974-05-23 01:05:39'),
(1055, 90, 260, 1, '2013-11-21 18:17:21', '1974-05-23 01:05:43', '1974-05-23 01:05:44'),
(1056, 90, 87, 1, '2013-11-21 18:17:21', '1974-05-23 01:05:43', '1974-05-23 01:05:44'),
(1057, 90, 196, 1, '2013-11-21 18:17:21', '1974-05-23 01:05:43', '1974-05-23 01:05:43'),
(1058, 90, 242, 1, '2013-11-21 18:17:22', '1974-05-23 01:05:43', '1974-05-23 01:05:44'),
(1059, 90, 124, 1, '2013-11-21 18:17:22', '1974-05-23 01:05:43', '1974-05-23 01:05:44'),
(1060, 90, 122, 1, '2013-11-21 18:17:22', '1974-05-23 01:05:43', '1974-05-23 01:05:44'),
(1061, 90, 273, 1, '2013-11-21 18:17:22', '1974-05-23 01:05:43', '1974-05-23 01:05:44'),
(1062, 90, 269, 1, '2013-11-21 18:17:22', '1974-05-23 01:05:44', '1974-05-23 01:05:45'),
(1063, 90, 21, 1, '2013-11-21 18:17:23', '1974-05-23 01:05:43', '1974-05-23 01:05:44'),
(1064, 90, 88, 1, '2013-11-21 18:17:23', '1974-05-23 01:05:43', '1974-05-23 01:05:44'),
(1065, 90, 129, 1, '2013-11-21 18:17:23', '1974-05-23 01:05:44', '1974-05-23 01:05:44'),
(1066, 90, 42, 1, '2013-11-21 18:17:24', '1974-05-23 01:05:43', '1974-05-23 01:05:44'),
(1067, 90, 22, 1, '2013-11-21 18:17:24', '1974-05-23 01:05:43', '1974-05-23 01:05:43'),
(1068, 90, 237, 1, '2013-11-21 18:17:24', '1974-05-23 01:05:43', '1974-05-23 01:05:44'),
(1069, 90, 239, 1, '2013-11-21 18:17:24', '1974-05-23 01:05:43', '1974-05-23 01:05:44'),
(1070, 90, 263, 1, '2013-11-21 18:17:25', '1974-05-23 01:05:43', '1974-05-23 01:05:44'),
(1071, 90, 274, 1, '2013-11-21 18:17:25', '1974-05-23 01:05:43', '1974-05-23 01:05:44'),
(1072, 90, 142, 1, '2013-11-21 18:17:27', '1974-05-23 01:05:43', '1974-05-23 01:05:44'),
(1073, 90, 240, 1, '2013-11-21 18:17:27', '1974-05-23 01:05:43', '1974-05-23 01:05:44'),
(1074, 90, 20, 1, '2013-11-21 18:17:37', '1974-05-23 01:05:43', '1974-05-23 01:05:45'),
(1075, 93, 243, 1, '2013-11-21 18:17:55', '1974-05-23 01:05:47', '1974-05-23 01:05:47'),
(1076, 94, 190, 1, '2013-11-21 18:17:56', '1974-05-23 01:05:47', '1974-05-23 01:05:47'),
(1077, 97, 261, 1, '2013-11-21 18:17:56', '1974-05-23 01:05:47', '1974-05-23 01:05:47'),
(1078, 97, 271, 1, '2013-11-21 18:17:56', '1974-05-23 01:05:47', '1974-05-23 01:05:47'),
(1079, 97, 127, 1, '2013-11-21 18:17:56', '1974-05-23 01:05:47', '1974-05-23 01:05:47'),
(1080, 94, 191, 1, '2013-11-21 18:17:56', '1974-05-23 01:05:47', '1974-05-23 01:05:47'),
(1081, 100, 273, 1, '2013-11-21 18:17:57', '1974-05-23 01:05:47', '1974-05-23 01:05:47'),
(1082, 97, 266, 1, '2013-11-21 18:17:57', '1974-05-23 01:05:47', '1974-05-23 01:05:47'),
(1083, 94, 269, 1, '2013-11-21 18:17:57', '1974-05-23 01:05:48', '1974-05-23 01:05:48'),
(1084, 93, 265, 1, '2013-11-21 18:17:57', '1974-05-23 01:05:47', '1974-05-23 01:05:47'),
(1085, 94, 22, 1, '2013-11-21 18:17:57', '1974-05-23 01:05:46', '1974-05-23 01:05:47'),
(1086, 97, 213, 1, '2013-11-21 18:17:57', '1974-05-23 01:05:47', '1974-05-23 01:05:47'),
(1087, 97, 87, 1, '2013-11-21 18:17:57', '1974-05-23 01:05:47', '1974-05-23 01:05:47'),
(1088, 97, 52, 1, '2013-11-21 18:17:57', '1974-05-23 01:05:47', '1974-05-23 01:05:47'),
(1089, 94, 124, 1, '2013-11-21 18:17:57', '1974-05-23 01:05:47', '1974-05-23 01:05:47'),
(1090, 94, 196, 1, '2013-11-21 18:17:57', '1974-05-23 01:05:47', '1974-05-23 01:05:47'),
(1091, 97, 121, 1, '2013-11-21 18:17:58', '1974-05-23 01:05:47', '1974-05-23 01:05:47'),
(1092, 97, 229, 1, '2013-11-21 18:17:58', '1974-05-23 01:05:47', '1974-05-23 01:05:47'),
(1093, 97, 260, 1, '2013-11-21 18:17:58', '1974-05-23 01:05:47', '1974-05-23 01:05:47'),
(1094, 100, 228, 1, '2013-11-21 18:17:58', '1974-05-23 01:05:47', '1974-05-23 01:05:47'),
(1095, 97, 129, 1, '2013-11-21 18:17:58', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(1096, 97, 275, 1, '2013-11-21 18:17:58', '1974-05-23 01:05:47', '1974-05-23 01:05:47'),
(1097, 94, 88, 1, '2013-11-21 18:17:58', '1974-05-23 01:05:47', '1974-05-23 01:05:47'),
(1098, 97, 18, 1, '2013-11-21 18:17:58', '1974-05-23 01:05:47', '1974-05-23 01:05:47'),
(1099, 97, 242, 1, '2013-11-21 18:17:58', '1974-05-23 01:05:47', '1974-05-23 01:05:47'),
(1100, 94, 30, 1, '2013-11-21 18:17:59', '1974-05-23 01:05:47', '1974-05-23 01:05:47'),
(1101, 100, 274, 1, '2013-11-21 18:17:59', '1974-05-23 01:05:47', '1974-05-23 01:05:47'),
(1102, 97, 226, 1, '2013-11-21 18:17:59', '1974-05-23 01:05:47', '1974-05-23 01:05:47'),
(1103, 97, 216, 1, '2013-11-21 18:17:59', '1974-05-23 01:05:42', '1974-05-23 01:05:43'),
(1104, 94, 21, 1, '2013-11-21 18:17:59', '1974-05-23 01:05:47', '1974-05-23 01:05:47'),
(1105, 97, 187, 1, '2013-11-21 18:17:59', '1974-05-23 01:05:47', '1974-05-23 01:05:47'),
(1106, 94, 83, 1, '2013-11-21 18:17:59', '1974-05-23 01:05:47', '1974-05-23 01:05:47'),
(1107, 100, 65, 1, '2013-11-21 18:18:00', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(1108, 93, 230, 1, '2013-11-21 18:18:00', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(1109, 93, 263, 1, '2013-11-21 18:18:00', '1974-05-23 01:05:47', '1974-05-23 01:05:47'),
(1110, 97, 122, 1, '2013-11-21 18:18:00', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(1111, 93, 142, 1, '2013-11-21 18:18:00', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(1112, 100, 237, 1, '2013-11-21 18:18:01', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(1113, 100, 183, 1, '2013-11-21 18:18:01', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(1114, 97, 22, 1, '2013-11-21 18:18:01', '1974-05-23 01:05:46', '1974-05-23 01:05:47'),
(1115, 97, 42, 1, '2013-11-21 18:18:02', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(1116, 97, 239, 1, '2013-11-21 18:18:04', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(1117, 100, 240, 1, '2013-11-21 18:18:07', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(1118, 93, 20, 1, '2013-11-21 18:18:09', '1974-05-23 01:05:47', '1974-05-23 01:05:48'),
(1119, 104, 22, 1, '2013-11-21 18:18:20', '1974-05-23 01:05:49', '1974-05-23 01:05:49'),
(1120, 106, 265, 1, '2013-11-21 18:18:20', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(1121, 106, 275, 1, '2013-11-21 18:18:20', '1974-05-23 01:05:49', '1974-05-23 01:05:49'),
(1122, 106, 271, 1, '2013-11-21 18:18:20', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(1123, 106, 190, 1, '2013-11-21 18:18:20', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(1124, 106, 127, 1, '2013-11-21 18:18:21', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(1125, 106, 187, 1, '2013-11-21 18:18:21', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(1126, 106, 229, 1, '2013-11-21 18:18:21', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(1127, 106, 52, 1, '2013-11-21 18:18:21', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(1128, 106, 273, 1, '2013-11-21 18:18:21', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(1129, 106, 83, 1, '2013-11-21 18:18:21', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(1130, 106, 261, 1, '2013-11-21 18:18:22', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(1131, 106, 230, 1, '2013-11-21 18:18:22', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(1132, 106, 266, 1, '2013-11-21 18:18:22', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(1133, 106, 260, 1, '2013-11-21 18:18:22', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(1134, 106, 191, 1, '2013-11-21 18:18:22', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(1135, 106, 121, 1, '2013-11-21 18:18:22', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(1136, 106, 196, 1, '2013-11-21 18:18:22', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(1137, 106, 142, 1, '2013-11-21 18:18:23', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(1138, 106, 213, 1, '2013-11-21 18:18:23', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(1139, 106, 269, 1, '2013-11-21 18:18:23', '1974-05-23 01:05:50', '1974-05-23 01:05:51'),
(1140, 106, 129, 1, '2013-11-21 18:18:23', '1974-05-23 01:05:50', '1974-05-23 01:05:50'),
(1141, 106, 216, 1, '2013-11-21 18:18:23', '1974-05-23 01:05:44', '1974-05-23 01:05:45'),
(1142, 106, 21, 1, '2013-11-21 18:18:23', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(1143, 104, 122, 1, '2013-11-21 18:18:23', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(1144, 106, 242, 1, '2013-11-21 18:18:23', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(1145, 106, 65, 1, '2013-11-21 18:18:23', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(1146, 104, 87, 1, '2013-11-21 18:18:24', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(1147, 106, 88, 1, '2013-11-21 18:18:24', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(1148, 106, 22, 1, '2013-11-21 18:18:24', '1974-05-23 01:05:49', '1974-05-23 01:05:49'),
(1149, 106, 226, 1, '2013-11-21 18:18:24', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(1150, 106, 124, 1, '2013-11-21 18:18:24', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(1151, 106, 228, 1, '2013-11-21 18:18:24', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(1152, 106, 18, 1, '2013-11-21 18:18:25', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(1153, 106, 30, 1, '2013-11-21 18:18:25', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(1154, 106, 239, 1, '2013-11-21 18:18:25', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(1155, 104, 243, 1, '2013-11-21 18:18:25', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(1156, 106, 263, 1, '2013-11-21 18:18:26', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(1157, 106, 183, 1, '2013-11-21 18:18:27', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(1158, 106, 240, 1, '2013-11-21 18:18:29', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(1159, 106, 274, 1, '2013-11-21 18:18:29', '1974-05-23 01:05:49', '1974-05-23 01:05:50'),
(1160, 106, 42, 1, '2013-11-21 18:18:29', '1974-05-23 01:05:49', '1974-05-23 01:05:50');
INSERT INTO `user_answers` (`user_answer_id`, `answer_id`, `user_id`, `active`, `datetime`, `received`, `submitted`) VALUES
(1161, 106, 20, 1, '2013-11-21 18:18:40', '1974-05-23 01:05:49', '1974-05-23 01:05:51'),
(1162, 110, 22, 1, '2013-11-21 18:18:43', '1974-05-23 01:05:51', '1974-05-23 01:05:51'),
(1163, 107, 191, 1, '2013-11-21 18:18:43', '1974-05-23 01:05:52', '1974-05-23 01:05:52'),
(1164, 107, 261, 1, '2013-11-21 18:18:43', '1974-05-23 01:05:52', '1974-05-23 01:05:52'),
(1165, 107, 127, 1, '2013-11-21 18:18:44', '1974-05-23 01:05:52', '1974-05-23 01:05:52'),
(1166, 107, 121, 1, '2013-11-21 18:18:44', '1974-05-23 01:05:52', '1974-05-23 01:05:52'),
(1167, 107, 65, 1, '2013-11-21 18:18:44', '1974-05-23 01:05:52', '1974-05-23 01:05:52'),
(1168, 107, 190, 1, '2013-11-21 18:18:44', '1974-05-23 01:05:52', '1974-05-23 01:05:52'),
(1169, 107, 83, 1, '2013-11-21 18:18:44', '1974-05-23 01:05:52', '1974-05-23 01:05:52'),
(1170, 110, 271, 1, '2013-11-21 18:18:45', '1974-05-23 01:05:52', '1974-05-23 01:05:52'),
(1171, 107, 265, 1, '2013-11-21 18:18:45', '1974-05-23 01:05:52', '1974-05-23 01:05:52'),
(1172, 107, 228, 1, '2013-11-21 18:18:45', '1974-05-23 01:05:52', '1974-05-23 01:05:52'),
(1173, 107, 269, 1, '2013-11-21 18:18:45', '1974-05-23 01:05:53', '1974-05-23 01:05:53'),
(1174, 107, 129, 1, '2013-11-21 18:18:45', '1974-05-23 01:05:52', '1974-05-23 01:05:52'),
(1175, 107, 52, 1, '2013-11-21 18:18:45', '1974-05-23 01:05:52', '1974-05-23 01:05:52'),
(1176, 107, 122, 1, '2013-11-21 18:18:45', '1974-05-23 01:05:52', '1974-05-23 01:05:52'),
(1177, 107, 124, 1, '2013-11-21 18:18:45', '1974-05-23 01:05:52', '1974-05-23 01:05:52'),
(1178, 107, 274, 1, '2013-11-21 18:18:45', '1974-05-23 01:05:52', '1974-05-23 01:05:52'),
(1179, 107, 142, 1, '2013-11-21 18:18:45', '1974-05-23 01:05:52', '1974-05-23 01:05:52'),
(1180, 107, 242, 1, '2013-11-21 18:18:45', '1974-05-23 01:05:52', '1974-05-23 01:05:52'),
(1181, 107, 216, 1, '2013-11-21 18:18:46', '1974-05-23 01:05:47', '1974-05-23 01:05:47'),
(1182, 107, 273, 1, '2013-11-21 18:18:46', '1974-05-23 01:05:52', '1974-05-23 01:05:52'),
(1183, 107, 30, 1, '2013-11-21 18:18:46', '1974-05-23 01:05:52', '1974-05-23 01:05:52'),
(1184, 107, 226, 1, '2013-11-21 18:18:46', '1974-05-23 01:05:52', '1974-05-23 01:05:52'),
(1185, 113, 243, 1, '2013-11-21 18:18:46', '1974-05-23 01:05:52', '1974-05-23 01:05:52'),
(1186, 107, 263, 1, '2013-11-21 18:18:46', '1974-05-23 01:05:52', '1974-05-23 01:05:52'),
(1187, 107, 213, 1, '2013-11-21 18:18:46', '1974-05-23 01:05:52', '1974-05-23 01:05:52'),
(1188, 107, 22, 1, '2013-11-21 18:18:46', '1974-05-23 01:05:51', '1974-05-23 01:05:52'),
(1189, 107, 183, 1, '2013-11-21 18:18:46', '1974-05-23 01:05:52', '1974-05-23 01:05:52'),
(1190, 107, 266, 1, '2013-11-21 18:18:47', '1974-05-23 01:05:52', '1974-05-23 01:05:52'),
(1191, 107, 239, 1, '2013-11-21 18:18:47', '1974-05-23 01:05:52', '1974-05-23 01:05:52'),
(1192, 107, 87, 1, '2013-11-21 18:18:47', '1974-05-23 01:05:52', '1974-05-23 01:05:52'),
(1193, 107, 187, 1, '2013-11-21 18:18:47', '1974-05-23 01:05:52', '1974-05-23 01:05:52'),
(1194, 110, 229, 1, '2013-11-21 18:18:47', '1974-05-23 01:05:52', '1974-05-23 01:05:52'),
(1195, 110, 275, 1, '2013-11-21 18:18:47', '1974-05-23 01:05:52', '1974-05-23 01:05:52'),
(1196, 107, 260, 1, '2013-11-21 18:18:47', '1974-05-23 01:05:52', '1974-05-23 01:05:52'),
(1197, 107, 21, 1, '2013-11-21 18:18:48', '1974-05-23 01:05:52', '1974-05-23 01:05:52'),
(1198, 110, 88, 1, '2013-11-21 18:18:48', '1974-05-23 01:05:52', '1974-05-23 01:05:52'),
(1199, 107, 230, 1, '2013-11-21 18:18:48', '1974-05-23 01:05:52', '1974-05-23 01:05:52'),
(1200, 107, 196, 1, '2013-11-21 18:18:48', '1974-05-23 01:05:51', '1974-05-23 01:05:52'),
(1201, 107, 18, 1, '2013-11-21 18:18:50', '1974-05-23 01:05:52', '1974-05-23 01:05:53'),
(1202, 107, 276, 1, '2013-11-21 18:18:51', '1974-05-23 01:05:52', '1974-05-23 01:05:53'),
(1203, 107, 42, 1, '2013-11-21 18:18:52', '1974-05-23 01:05:52', '1974-05-23 01:05:53'),
(1204, 107, 240, 1, '2013-11-21 18:18:53', '1974-05-23 01:05:52', '1974-05-23 01:05:53'),
(1205, 107, 20, 1, '2013-11-21 18:18:53', '1974-05-23 01:05:52', '1974-05-23 01:05:53'),
(1206, 107, 237, 1, '2013-11-21 18:18:54', '1974-05-23 01:05:52', '1974-05-23 01:05:53'),
(1207, 115, 243, 1, '2013-11-21 18:19:13', '1974-05-23 01:05:55', '1974-05-23 01:05:55'),
(1208, 118, 22, 1, '2013-11-21 18:19:13', '1974-05-23 01:05:54', '1974-05-23 01:05:54'),
(1209, 118, 265, 1, '2013-11-21 18:19:13', '1974-05-23 01:05:55', '1974-05-23 01:05:55'),
(1210, 119, 52, 1, '2013-11-21 18:19:13', '1974-05-23 01:05:55', '1974-05-23 01:05:55'),
(1211, 115, 190, 1, '2013-11-21 18:19:13', '1974-05-23 01:05:55', '1974-05-23 01:05:55'),
(1212, 115, 276, 1, '2013-11-21 18:19:14', '1974-05-23 01:05:55', '1974-05-23 01:05:55'),
(1213, 115, 83, 1, '2013-11-21 18:19:14', '1974-05-23 01:05:55', '1974-05-23 01:05:55'),
(1214, 119, 275, 1, '2013-11-21 18:19:14', '1974-05-23 01:05:55', '1974-05-23 01:05:55'),
(1215, 119, 127, 1, '2013-11-21 18:19:14', '1974-05-23 01:05:55', '1974-05-23 01:05:55'),
(1216, 119, 87, 1, '2013-11-21 18:19:14', '1974-05-23 01:05:55', '1974-05-23 01:05:55'),
(1217, 115, 266, 1, '2013-11-21 18:19:14', '1974-05-23 01:05:55', '1974-05-23 01:05:55'),
(1218, 119, 196, 1, '2013-11-21 18:19:14', '1974-05-23 01:05:54', '1974-05-23 01:05:55'),
(1219, 115, 229, 1, '2013-11-21 18:19:14', '1974-05-23 01:05:55', '1974-05-23 01:05:55'),
(1220, 122, 226, 1, '2013-11-21 18:19:14', '1974-05-23 01:05:55', '1974-05-23 01:05:55'),
(1221, 115, 121, 1, '2013-11-21 18:19:15', '1974-05-23 01:05:55', '1974-05-23 01:05:55'),
(1222, 115, 30, 1, '2013-11-21 18:19:15', '1974-05-23 01:05:55', '1974-05-23 01:05:55'),
(1223, 115, 88, 1, '2013-11-21 18:19:15', '1974-05-23 01:05:55', '1974-05-23 01:05:55'),
(1224, 119, 228, 1, '2013-11-21 18:19:15', '1974-05-23 01:05:55', '1974-05-23 01:05:55'),
(1225, 115, 142, 1, '2013-11-21 18:19:15', '1974-05-23 01:05:55', '1974-05-23 01:05:55'),
(1226, 122, 230, 1, '2013-11-21 18:19:15', '1974-05-23 01:05:55', '1974-05-23 01:05:55'),
(1227, 115, 21, 1, '2013-11-21 18:19:15', '1974-05-23 01:05:55', '1974-05-23 01:05:55'),
(1228, 115, 122, 1, '2013-11-21 18:19:15', '1974-05-23 01:05:55', '1974-05-23 01:05:55'),
(1229, 115, 187, 1, '2013-11-21 18:19:15', '1974-05-23 01:05:55', '1974-05-23 01:05:55'),
(1230, 115, 239, 1, '2013-11-21 18:19:16', '1974-05-23 01:05:55', '1974-05-23 01:05:55'),
(1231, 115, 237, 1, '2013-11-21 18:19:16', '1974-05-23 01:05:55', '1974-05-23 01:05:55'),
(1232, 115, 271, 1, '2013-11-21 18:19:16', '1974-05-23 01:05:55', '1974-05-23 01:05:55'),
(1233, 122, 124, 1, '2013-11-21 18:19:16', '1974-05-23 01:05:55', '1974-05-23 01:05:55'),
(1234, 115, 191, 1, '2013-11-21 18:19:16', '1974-05-23 01:05:55', '1974-05-23 01:05:55'),
(1235, 119, 260, 1, '2013-11-21 18:19:16', '1974-05-23 01:05:54', '1974-05-23 01:05:55'),
(1236, 115, 22, 1, '2013-11-21 18:19:16', '1974-05-23 01:05:54', '1974-05-23 01:05:55'),
(1237, 118, 273, 1, '2013-11-21 18:19:16', '1974-05-23 01:05:55', '1974-05-23 01:05:55'),
(1238, 115, 183, 1, '2013-11-21 18:19:16', '1974-05-23 01:05:55', '1974-05-23 01:05:55'),
(1239, 119, 216, 1, '2013-11-21 18:19:17', '1974-05-23 01:05:50', '1974-05-23 01:05:50'),
(1240, 115, 65, 1, '2013-11-21 18:19:17', '1974-05-23 01:05:55', '1974-05-23 01:05:55'),
(1241, 115, 213, 1, '2013-11-21 18:19:18', '1974-05-23 01:05:55', '1974-05-23 01:05:55'),
(1242, 115, 263, 1, '2013-11-21 18:19:18', '1974-05-23 01:05:54', '1974-05-23 01:05:55'),
(1243, 115, 274, 1, '2013-11-21 18:19:19', '1974-05-23 01:05:55', '1974-05-23 01:05:55'),
(1244, 115, 18, 1, '2013-11-21 18:19:19', '1974-05-23 01:05:55', '1974-05-23 01:05:55'),
(1245, 119, 242, 1, '2013-11-21 18:19:19', '1974-05-23 01:05:55', '1974-05-23 01:05:55'),
(1246, 115, 261, 1, '2013-11-21 18:19:19', '1974-05-23 01:05:55', '1974-05-23 01:05:55'),
(1247, 115, 42, 1, '2013-11-21 18:19:20', '1974-05-23 01:05:55', '1974-05-23 01:05:56'),
(1248, 118, 269, 1, '2013-11-21 18:19:21', '1974-05-23 01:05:56', '1974-05-23 01:05:56'),
(1249, 115, 240, 1, '2013-11-21 18:19:22', '1974-05-23 01:05:55', '1974-05-23 01:05:56'),
(1250, 115, 129, 1, '2013-11-21 18:19:22', '1974-05-23 01:05:55', '1974-05-23 01:05:56'),
(1251, 124, 22, 1, '2013-11-21 18:19:36', '1974-05-23 01:05:56', '1974-05-23 01:05:57'),
(1252, 126, 243, 1, '2013-11-21 18:19:36', '1974-05-23 01:05:57', '1974-05-23 01:05:57'),
(1253, 124, 265, 1, '2013-11-21 18:19:37', '1974-05-23 01:05:57', '1974-05-23 01:05:57'),
(1254, 125, 196, 1, '2013-11-21 18:19:37', '1974-05-23 01:05:57', '1974-05-23 01:05:57'),
(1255, 124, 190, 1, '2013-11-21 18:19:37', '1974-05-23 01:05:57', '1974-05-23 01:05:57'),
(1256, 125, 276, 1, '2013-11-21 18:19:37', '1974-05-23 01:05:57', '1974-05-23 01:05:57'),
(1257, 125, 127, 1, '2013-11-21 18:19:38', '1974-05-23 01:05:57', '1974-05-23 01:05:57'),
(1258, 125, 230, 1, '2013-11-21 18:19:38', '1974-05-23 01:05:57', '1974-05-23 01:05:57'),
(1259, 124, 83, 1, '2013-11-21 18:19:38', '1974-05-23 01:05:57', '1974-05-23 01:05:57'),
(1260, 125, 273, 1, '2013-11-21 18:19:38', '1974-05-23 01:05:57', '1974-05-23 01:05:57'),
(1261, 125, 229, 1, '2013-11-21 18:19:38', '1974-05-23 01:05:57', '1974-05-23 01:05:57'),
(1262, 124, 240, 1, '2013-11-21 18:19:38', '1974-05-23 01:05:57', '1974-05-23 01:05:57'),
(1263, 125, 122, 1, '2013-11-21 18:19:38', '1974-05-23 01:05:57', '1974-05-23 01:05:57'),
(1264, 125, 261, 1, '2013-11-21 18:19:38', '1974-05-23 01:05:57', '1974-05-23 01:05:57'),
(1265, 125, 275, 1, '2013-11-21 18:19:38', '1974-05-23 01:05:57', '1974-05-23 01:05:57'),
(1266, 125, 52, 1, '2013-11-21 18:19:38', '1974-05-23 01:05:57', '1974-05-23 01:05:57'),
(1267, 125, 237, 1, '2013-11-21 18:19:39', '1974-05-23 01:05:57', '1974-05-23 01:05:57'),
(1268, 125, 266, 1, '2013-11-21 18:19:39', '1974-05-23 01:05:57', '1974-05-23 01:05:57'),
(1269, 125, 191, 1, '2013-11-21 18:19:39', '1974-05-23 01:05:57', '1974-05-23 01:05:57'),
(1270, 125, 65, 1, '2013-11-21 18:19:39', '1974-05-23 01:05:57', '1974-05-23 01:05:57'),
(1271, 125, 22, 1, '2013-11-21 18:19:40', '1974-05-23 01:05:56', '1974-05-23 01:05:57'),
(1272, 125, 213, 1, '2013-11-21 18:19:40', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(1273, 123, 87, 1, '2013-11-21 18:19:40', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(1274, 125, 88, 1, '2013-11-21 18:19:40', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(1275, 124, 216, 1, '2013-11-21 18:19:40', '1974-05-23 01:05:52', '1974-05-23 01:05:53'),
(1276, 125, 271, 1, '2013-11-21 18:19:40', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(1277, 125, 18, 1, '2013-11-21 18:19:41', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(1278, 125, 187, 1, '2013-11-21 18:19:41', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(1279, 124, 21, 1, '2013-11-21 18:19:41', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(1280, 125, 30, 1, '2013-11-21 18:19:41', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(1281, 125, 183, 1, '2013-11-21 18:19:41', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(1282, 125, 269, 1, '2013-11-21 18:19:41', '1974-05-23 01:05:58', '1974-05-23 01:05:59'),
(1283, 125, 228, 1, '2013-11-21 18:19:41', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(1284, 125, 121, 1, '2013-11-21 18:19:41', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(1285, 124, 142, 1, '2013-11-21 18:19:41', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(1286, 125, 260, 1, '2013-11-21 18:19:42', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(1287, 125, 226, 1, '2013-11-21 18:19:42', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(1288, 125, 263, 1, '2013-11-21 18:19:43', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(1289, 124, 124, 1, '2013-11-21 18:19:43', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(1290, 124, 129, 1, '2013-11-21 18:19:43', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(1291, 125, 239, 1, '2013-11-21 18:19:45', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(1292, 125, 242, 1, '2013-11-21 18:19:46', '1974-05-23 01:05:57', '1974-05-23 01:05:58'),
(1293, 125, 42, 1, '2013-11-21 18:19:48', '1974-05-23 01:05:57', '1974-05-23 01:05:58');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE IF NOT EXISTS `user_groups` (
  `user_groups_id` int(12) NOT NULL,
  `group_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `virtual_events`
--

CREATE TABLE IF NOT EXISTS `virtual_events` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `summary` varchar(600) NOT NULL,
  `date_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `time_added` datetime NOT NULL,
  `event_type` tinyint(1) NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `hide` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `virtual_events`
--

INSERT INTO `virtual_events` (`id`, `title`, `description`, `summary`, `date_time`, `end_time`, `time_added`, `event_type`, `active`, `hide`) VALUES
(7, 'Tech Trivia', 'The first Tech Trivia - come and play!', 'The first Tech Trivia - come and play!', '2013-11-21 17:00:00', '2013-11-21 17:30:00', '2013-07-18 12:00:00', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `virtual_events_info`
--

CREATE TABLE IF NOT EXISTS `virtual_events_info` (
  `virtual_events_info_id` int(12) NOT NULL,
  `event_id` int(12) NOT NULL,
  `info_type` varchar(60) NOT NULL,
  `int_info` int(12) NOT NULL,
  `info` varchar(255) NOT NULL,
  `info_b` text NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `virtual_events_info`
--

INSERT INTO `virtual_events_info` (`virtual_events_info_id`, `event_id`, `info_type`, `int_info`, `info`, `info_b`, `time`) VALUES
(1, 7, 'event_url', 0, 'http://[SITE-URL]/?p=virtual_events&event_id=[EVENT-ID]', '', '0000-00-00 00:00:00'),
(2, 7, 'from_email', 0, 'gameon@entermarketing.com', '', '0000-00-00 00:00:00'),
(3, 7, 'from_name', 0, 'Game On', '', '0000-00-00 00:00:00'),
(7, 7, 'online_version', 0, '', '<head>\r\n<title>Invite</title>\r\n<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">\r\n</head>\r\n<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">\r\n<center>\r\n	<table width="600" height="1055"  border="0" cellpadding="0" cellspacing="0">\r\n		<tr>\r\n			<td valign="top" align="left" bgcolor="#000000" width="600" style="font-size:0;">\r\n				<a href="http://[SITE-URL]/?invite_key=[INVITE-KEY]&pin=[PIN]#virtualevents"><img src="http://[SITE-URL]/vevent_email_img.php?id=[EVENT-ID]" alt="" width="600" height="1055" border="0"/></a>\r\n			</td>\r\n		</tr>\r\n	</table>\r\n</center>\r\n</body>\r\n</html>', '0000-00-00 00:00:00'),
(8, 7, 'launched', 0, '', '', '0000-00-00 00:00:00'),
(9, 7, 'coveritlive_id', 0, 'dbeb3efadf', '', '0000-00-00 00:00:00'),
(16, 10, 'event_url', 0, 'http://[SITE-URL]/?p=virtual_events&event_id=[EVENT-ID]', '', '0000-00-00 00:00:00'),
(17, 10, 'from_email', 0, 'gameon@entermarketing.com', '', '0000-00-00 00:00:00'),
(18, 10, 'from_name', 0, 'Game On', '', '0000-00-00 00:00:00'),
(19, 10, 'online_version', 0, '', '<head>\r\n<title>Invite</title>\r\n<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">\r\n</head>\r\n<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">\r\n<center>\r\n	<table width="600" height="1055"  border="0" cellpadding="0" cellspacing="0">\r\n		<tr>\r\n			<td valign="top" align="left" bgcolor="#000000" width="600" style="font-size:0;">\r\n				<a href="http://[SITE-URL]/?pin=[PIN]&invite_key=[INVITE_KEY]#virtualevents"><img src="http://[SITE-URL]/vevent_email_img.php?id=[EVENT-ID]" alt="" width="600" height="1055" border="0"/></a>\r\n			</td>\r\n		</tr>\r\n	</table>\r\n</center>\r\n</body>\r\n</html>', '0000-00-00 00:00:00'),
(20, 10, 'launched', 0, '', '', '0000-00-00 00:00:00'),
(21, 10, 'coveritlive_id', 0, 'dbeb3efadf', '', '0000-00-00 00:00:00'),
(22, 10, 'event_location', 1, 'New York', 'ny', '0000-00-00 00:00:00'),
(23, 10, 'event_location', 2, 'San Francisco', 'sanfran', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE IF NOT EXISTS `wallets` (
  `wallet_id` int(12) NOT NULL,
  `entity_id` int(12) NOT NULL,
  `quarter_id` int(12) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`wallet_id`, `entity_id`, `quarter_id`, `active`) VALUES
(2, 5, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wallets_history`
--

CREATE TABLE IF NOT EXISTS `wallets_history` (
  `wallets_history_id` int(12) NOT NULL,
  `wallet_id` int(12) NOT NULL,
  `bucket_category_id` int(12) NOT NULL,
  `entity_id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `reference_id` varchar(30) COLLATE utf8_bin NOT NULL,
  `type` varchar(100) COLLATE utf8_bin NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `notes` varchar(255) COLLATE utf8_bin NOT NULL,
  `info_a` varchar(255) COLLATE utf8_bin NOT NULL,
  `info_b` varchar(255) COLLATE utf8_bin NOT NULL,
  `datetime` datetime NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `wallets_history`
--

INSERT INTO `wallets_history` (`wallets_history_id`, `wallet_id`, `bucket_category_id`, `entity_id`, `user_id`, `reference_id`, `type`, `amount`, `notes`, `info_a`, `info_b`, `datetime`, `active`) VALUES
(1, 2, 82, 5, 759, '0', 'fund_adjustment', 10000.00, '', '', '', '2015-12-21 01:55:50', 1),
(2, 2, 83, 5, 759, '0', 'fund_adjustment', 15000.00, '', '', '', '2015-12-21 01:56:04', 1),
(34, 2, 82, 5, 759, '1u0r5ehw3s2ay3e8', 'order', -5000.00, '', '', '', '2016-01-03 01:50:09', 1),
(35, 2, 82, 5, 759, '1u0r5ehw3s2ay3e8', 'order_delete', 5000.00, '', '', '', '2016-01-03 01:53:03', 1),
(36, 2, 83, 5, 759, '3khv3g2z86ubwdk7', 'order', -10000.00, '', '', '', '2016-01-03 01:53:46', 1),
(37, 2, 83, 5, 759, '3khv3g2z86ubwdk7', 'order_delete', 10000.00, '', '', '', '2016-01-03 01:54:07', 1),
(38, 2, 82, 5, 759, 'hh0cvm0ytv0byyuc', 'order', -5000.00, '', '', '', '2016-01-03 01:57:45', 1),
(39, 2, 82, 5, 759, 'hh0cvm0ytv0byyuc', 'order_delete', 5000.00, '', '', '', '2016-01-03 01:58:06', 1),
(40, 2, 82, 5, 759, '3jqysgus83chmfwd', 'order', -5000.00, '', '', '', '2016-01-03 01:58:16', 1),
(41, 2, 83, 5, 759, 'mjy2648gcyr4f2o3', 'order', -5000.00, '', '', '', '2016-01-03 01:58:58', 1),
(42, 2, 83, 5, 759, 'mjy2648gcyr4f2o3', 'order_delete', 5000.00, '', '', '', '2016-01-03 02:04:55', 1),
(43, 2, 82, 5, 759, 'mznsffvmdvwicw8w', 'order', -5000.00, '', '', '', '2016-01-03 02:05:06', 1),
(44, 2, 82, 5, 759, 'mznsffvmdvwicw8w', 'order_delete', 5000.00, '', '', '', '2016-01-03 02:05:13', 1),
(45, 2, 83, 5, 759, 'm910e73nkcshs0ka', 'order', -10000.00, '', '', '', '2016-01-03 02:05:21', 1),
(46, 2, 83, 5, 759, 'm910e73nkcshs0ka', 'order_delete', 10000.00, '', '', '', '2016-01-03 02:05:28', 1),
(47, 2, 82, 5, 759, '6znkcntzz1t7liuu', 'order', -5000.00, '', '', '', '2016-01-03 02:24:12', 1),
(48, 2, 82, 5, 759, '6znkcntzz1t7liuu', 'order_delete', 5000.00, '', '', '', '2016-01-03 02:24:28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `whats_new`
--

CREATE TABLE IF NOT EXISTS `whats_new` (
  `entry_id` int(12) NOT NULL,
  `title` varchar(255) NOT NULL,
  `descrip` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `user_id` int(12) NOT NULL,
  `time_added` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `whats_new`
--

INSERT INTO `whats_new` (`entry_id`, `title`, `descrip`, `url`, `image`, `active`, `user_id`, `time_added`) VALUES
(1, 'Earn Points and Rewards With Sales Resources', 'Download and view training resources by click on the "Training" section in the side bar. You will receive 30 points for each resource you view.', '/?p=training', '/resource_img.php?image=pdf', 1, 0, '2014-06-28 00:00:00'),
(5, 'Earn Points and Rewards By Creating Demand Generation', 'Use Dell Overdrive to send valuable resources to prospects and customers', '/?p=demandgen', '/img/Header_Meetings.png', 1, 0, '2014-06-27 00:00:00'),
(6, 'Earn Points and Rewards With Sales Activities', 'Submit registered opportunities, feedback, and closed deals to earn points and rewards.', '/?p=meetings', '/img/Header_Meetings.png', 1, 0, '2014-06-24 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actions_info`
--
ALTER TABLE `actions_info`
  ADD PRIMARY KEY (`actions_info_id`);

--
-- Indexes for table `actions_log`
--
ALTER TABLE `actions_log`
  ADD PRIMARY KEY (`action_id`),
  ADD UNIQUE KEY `action_id` (`action_id`),
  ADD KEY `action_types_id` (`action_types_id`,`active`),
  ADD KEY `action_types_id_2` (`action_types_id`,`user_id`,`active`);

--
-- Indexes for table `action_types`
--
ALTER TABLE `action_types`
  ADD UNIQUE KEY `action_types_id` (`action_types_id`);

--
-- Indexes for table `action_types_info`
--
ALTER TABLE `action_types_info`
  ADD PRIMARY KEY (`action_types_info_id`),
  ADD UNIQUE KEY `actio_type_info_id` (`action_types_info_id`),
  ADD KEY `action_types_id` (`action_types_id`,`info_type`,`int_info`),
  ADD KEY `action_types_id_2` (`action_types_id`,`info_type`,`int_info`,`info`,`info_b`,`time`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `answers_info`
--
ALTER TABLE `answers_info`
  ADD PRIMARY KEY (`answers_info_id`),
  ADD UNIQUE KEY `virtual_events_info_id` (`answers_info_id`);

--
-- Indexes for table `badges_info`
--
ALTER TABLE `badges_info`
  ADD UNIQUE KEY `badges_info_id` (`badges_info_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_id` (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD UNIQUE KEY `comment_id` (`comment_id`);

--
-- Indexes for table `demandgen_contacts`
--
ALTER TABLE `demandgen_contacts`
  ADD UNIQUE KEY `demandgen_contact_id` (`demandgen_contact_id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`email_to`,`email_template_id`,`test`),
  ADD KEY `user_id_2` (`user_id`,`email_template_id`,`test`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`email_id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD UNIQUE KEY `email_id` (`email_template_id`);

--
-- Indexes for table `entities`
--
ALTER TABLE `entities`
  ADD UNIQUE KEY `entity_id` (`entity_id`);

--
-- Indexes for table `entities_info`
--
ALTER TABLE `entities_info`
  ADD UNIQUE KEY `entities_info_id` (`entities_info_id`);

--
-- Indexes for table `hosted_emails`
--
ALTER TABLE `hosted_emails`
  ADD UNIQUE KEY `id` (`hosted_email_id`);

--
-- Indexes for table `invites`
--
ALTER TABLE `invites`
  ADD UNIQUE KEY `invite_id` (`invite_id`),
  ADD UNIQUE KEY `from_user_id` (`from_user_id`,`email`,`event_id`);

--
-- Indexes for table `locales`
--
ALTER TABLE `locales`
  ADD PRIMARY KEY (`locale_id`),
  ADD UNIQUE KEY `locale_id` (`locale_id`);

--
-- Indexes for table `locale_text`
--
ALTER TABLE `locale_text`
  ADD UNIQUE KEY `locale_text_id` (`locale_text_id`),
  ADD UNIQUE KEY `text_name` (`text_name`,`locale_id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`log_id`),
  ADD UNIQUE KEY `log_id` (`log_id`);

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`login_id`),
  ADD UNIQUE KEY `login_id` (`login_id`);

--
-- Indexes for table `mdf_forms`
--
ALTER TABLE `mdf_forms`
  ADD UNIQUE KEY `mdf_form_id` (`mdf_form_id`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`meeting_id`),
  ADD UNIQUE KEY `meeting_id` (`meeting_id`);

--
-- Indexes for table `meetings_info`
--
ALTER TABLE `meetings_info`
  ADD PRIMARY KEY (`meetings_info_id`),
  ADD UNIQUE KEY `actio_type_info_id` (`meetings_info_id`),
  ADD KEY `action_types_id` (`meeting_id`,`info_type`,`int_info`),
  ADD KEY `action_types_id_2` (`meeting_id`,`info_type`,`int_info`,`info`,`info_b`,`time`);

--
-- Indexes for table `meeting_requested`
--
ALTER TABLE `meeting_requested`
  ADD PRIMARY KEY (`meeting_requested_id`);

--
-- Indexes for table `notify`
--
ALTER TABLE `notify`
  ADD PRIMARY KEY (`notify_id`),
  ADD UNIQUE KEY `notify_id` (`notify_id`),
  ADD KEY `user_id` (`user_id`,`subject`,`msg`(767),`int_other`,`other`,`other_b`,`seen`,`active`);

--
-- Indexes for table `opp_deals`
--
ALTER TABLE `opp_deals`
  ADD PRIMARY KEY (`deal_id`),
  ADD UNIQUE KEY `deal_id` (`deal_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key` (`tkey`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD UNIQUE KEY `package_id` (`package_id`);

--
-- Indexes for table `packages_info`
--
ALTER TABLE `packages_info`
  ADD UNIQUE KEY `packages_info_id` (`packages_info_id`);

--
-- Indexes for table `packages_options`
--
ALTER TABLE `packages_options`
  ADD UNIQUE KEY `packages_option_id` (`packages_option_id`);

--
-- Indexes for table `password_request`
--
ALTER TABLE `password_request`
  ADD PRIMARY KEY (`request_id`),
  ADD UNIQUE KEY `request_id` (`request_id`);

--
-- Indexes for table `ping_msgs`
--
ALTER TABLE `ping_msgs`
  ADD PRIMARY KEY (`msg_id`),
  ADD UNIQUE KEY `msg_id` (`msg_id`);

--
-- Indexes for table `qr_codes`
--
ALTER TABLE `qr_codes`
  ADD PRIMARY KEY (`qr_id`),
  ADD UNIQUE KEY `qr_id` (`qr_id`),
  ADD UNIQUE KEY `qr_code` (`qr_code`);

--
-- Indexes for table `quarters`
--
ALTER TABLE `quarters`
  ADD UNIQUE KEY `quarter_id` (`quarter_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `questions_info`
--
ALTER TABLE `questions_info`
  ADD PRIMARY KEY (`questions_info_id`),
  ADD UNIQUE KEY `virtual_events_info_id` (`questions_info_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`quiz_id`);

--
-- Indexes for table `quizzes_info`
--
ALTER TABLE `quizzes_info`
  ADD PRIMARY KEY (`quizzes_info_id`);

--
-- Indexes for table `quiz_answers`
--
ALTER TABLE `quiz_answers`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `quiz_answers_info`
--
ALTER TABLE `quiz_answers_info`
  ADD PRIMARY KEY (`quiz_answers_info_id`);

--
-- Indexes for table `quiz_answer_times`
--
ALTER TABLE `quiz_answer_times`
  ADD PRIMARY KEY (`time_id`);

--
-- Indexes for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `quiz_questions_info`
--
ALTER TABLE `quiz_questions_info`
  ADD PRIMARY KEY (`quiz_questions_info_id`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`referral_id`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`resource_id`),
  ADD UNIQUE KEY `resource_id` (`resource_id`);

--
-- Indexes for table `resources_info`
--
ALTER TABLE `resources_info`
  ADD UNIQUE KEY `resource_info_id` (`resources_info_id`),
  ADD KEY `resource_id` (`resource_id`);

--
-- Indexes for table `slots`
--
ALTER TABLE `slots`
  ADD PRIMARY KEY (`slot_id`),
  ADD UNIQUE KEY `slot_id` (`slot_id`);

--
-- Indexes for table `trivia`
--
ALTER TABLE `trivia`
  ADD PRIMARY KEY (`trivia_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `user_id_alias` (`user_id_alias`),
  ADD KEY `user_id_2` (`user_id`,`email`),
  ADD KEY `points` (`points`);

--
-- Indexes for table `users_info`
--
ALTER TABLE `users_info`
  ADD PRIMARY KEY (`users_info_id`),
  ADD UNIQUE KEY `user_info_id` (`users_info_id`),
  ADD KEY `user_id` (`user_id`,`badge_id`,`info_type`,`int_info`,`info`,`info_b`);

--
-- Indexes for table `user_answers`
--
ALTER TABLE `user_answers`
  ADD PRIMARY KEY (`user_answer_id`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`user_groups_id`),
  ADD UNIQUE KEY `user_group_id` (`user_groups_id`),
  ADD UNIQUE KEY `group_name` (`group_name`);

--
-- Indexes for table `virtual_events`
--
ALTER TABLE `virtual_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `virtual_events_info`
--
ALTER TABLE `virtual_events_info`
  ADD PRIMARY KEY (`virtual_events_info_id`),
  ADD UNIQUE KEY `virtual_events_info_id` (`virtual_events_info_id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD UNIQUE KEY `wallet_id` (`wallet_id`);

--
-- Indexes for table `wallets_history`
--
ALTER TABLE `wallets_history`
  ADD UNIQUE KEY `wallets_history_id` (`wallets_history_id`);

--
-- Indexes for table `whats_new`
--
ALTER TABLE `whats_new`
  ADD PRIMARY KEY (`entry_id`),
  ADD UNIQUE KEY `entry_id` (`entry_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actions_info`
--
ALTER TABLE `actions_info`
  MODIFY `actions_info_id` int(14) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=203;
--
-- AUTO_INCREMENT for table `actions_log`
--
ALTER TABLE `actions_log`
  MODIFY `action_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `action_types`
--
ALTER TABLE `action_types`
  MODIFY `action_types_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `action_types_info`
--
ALTER TABLE `action_types_info`
  MODIFY `action_types_info_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `answer_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=131;
--
-- AUTO_INCREMENT for table `answers_info`
--
ALTER TABLE `answers_info`
  MODIFY `answers_info_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `demandgen_contacts`
--
ALTER TABLE `demandgen_contacts`
  MODIFY `demandgen_contact_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `email_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `email_template_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `entities`
--
ALTER TABLE `entities`
  MODIFY `entity_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `entities_info`
--
ALTER TABLE `entities_info`
  MODIFY `entities_info_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `hosted_emails`
--
ALTER TABLE `hosted_emails`
  MODIFY `hosted_email_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `invites`
--
ALTER TABLE `invites`
  MODIFY `invite_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `locales`
--
ALTER TABLE `locales`
  MODIFY `locale_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `locale_text`
--
ALTER TABLE `locale_text`
  MODIFY `locale_text_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=171;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `log_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `login_id` int(14) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `mdf_forms`
--
ALTER TABLE `mdf_forms`
  MODIFY `mdf_form_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `meeting_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=96;
--
-- AUTO_INCREMENT for table `meetings_info`
--
ALTER TABLE `meetings_info`
  MODIFY `meetings_info_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=656;
--
-- AUTO_INCREMENT for table `meeting_requested`
--
ALTER TABLE `meeting_requested`
  MODIFY `meeting_requested_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `notify`
--
ALTER TABLE `notify`
  MODIFY `notify_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=283;
--
-- AUTO_INCREMENT for table `opp_deals`
--
ALTER TABLE `opp_deals`
  MODIFY `deal_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=340;
--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `package_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `packages_info`
--
ALTER TABLE `packages_info`
  MODIFY `packages_info_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `packages_options`
--
ALTER TABLE `packages_options`
  MODIFY `packages_option_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `password_request`
--
ALTER TABLE `password_request`
  MODIFY `request_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `ping_msgs`
--
ALTER TABLE `ping_msgs`
  MODIFY `msg_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `qr_codes`
--
ALTER TABLE `qr_codes`
  MODIFY `qr_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `quarters`
--
ALTER TABLE `quarters`
  MODIFY `quarter_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `questions_info`
--
ALTER TABLE `questions_info`
  MODIFY `questions_info_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `quiz_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `quizzes_info`
--
ALTER TABLE `quizzes_info`
  MODIFY `quizzes_info_id` int(14) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `quiz_answers`
--
ALTER TABLE `quiz_answers`
  MODIFY `answer_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `quiz_answers_info`
--
ALTER TABLE `quiz_answers_info`
  MODIFY `quiz_answers_info_id` int(14) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `quiz_answer_times`
--
ALTER TABLE `quiz_answer_times`
  MODIFY `time_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `question_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `quiz_questions_info`
--
ALTER TABLE `quiz_questions_info`
  MODIFY `quiz_questions_info_id` int(14) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `referral_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `resource_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=90;
--
-- AUTO_INCREMENT for table `resources_info`
--
ALTER TABLE `resources_info`
  MODIFY `resources_info_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `slots`
--
ALTER TABLE `slots`
  MODIFY `slot_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `trivia`
--
ALTER TABLE `trivia`
  MODIFY `trivia_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1311;
--
-- AUTO_INCREMENT for table `users_info`
--
ALTER TABLE `users_info`
  MODIFY `users_info_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2400;
--
-- AUTO_INCREMENT for table `user_answers`
--
ALTER TABLE `user_answers`
  MODIFY `user_answer_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1294;
--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `user_groups_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `virtual_events`
--
ALTER TABLE `virtual_events`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `virtual_events_info`
--
ALTER TABLE `virtual_events_info`
  MODIFY `virtual_events_info_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `wallet_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `wallets_history`
--
ALTER TABLE `wallets_history`
  MODIFY `wallets_history_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `whats_new`
--
ALTER TABLE `whats_new`
  MODIFY `entry_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

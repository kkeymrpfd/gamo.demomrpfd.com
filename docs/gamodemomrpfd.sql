-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2015 at 08:50 PM
-- Server version: 5.5.46-0ubuntu0.14.04.2
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
  `info_type` varchar(30) NOT NULL,
  `int_info` int(12) NOT NULL,
  `info` varchar(80) NOT NULL,
  `info_b` varchar(80) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `time` datetime NOT NULL,
  `triggered_by` int(12) NOT NULL DEFAULT '-1',
  `trigger_type` int(1) NOT NULL DEFAULT '-1',
  `active` tinyint(1) NOT NULL,
  `action_id_alias` varchar(12) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(12) NOT NULL,
  `category_name` varchar(40) NOT NULL,
  `category_type` varchar(30) NOT NULL,
  `category_tag` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `entities`
--

CREATE TABLE IF NOT EXISTS `entities` (
  `entity_id` int(12) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `type` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `hosted_emails`
--

CREATE TABLE IF NOT EXISTS `hosted_emails` (
  `hosted_email_id` int(12) NOT NULL,
  `html` longtext COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `locales`
--

CREATE TABLE IF NOT EXISTS `locales` (
  `locale_id` int(12) NOT NULL,
  `locale` varchar(20) NOT NULL,
  `locale_name` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `locale_id_alias` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `locale_text`
--

CREATE TABLE IF NOT EXISTS `locale_text` (
  `locale_text_id` int(12) NOT NULL,
  `text_name` varchar(200) NOT NULL,
  `locale_id` int(12) NOT NULL,
  `info` varchar(800) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `id` int(10) unsigned NOT NULL,
  `tkey` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `packages_options`
--

CREATE TABLE IF NOT EXISTS `packages_options` (
  `packages_option_id` int(12) NOT NULL,
  `package_id` int(12) NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `price` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE IF NOT EXISTS `quizzes` (
  `quiz_id` int(12) NOT NULL,
  `quiz_name` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE IF NOT EXISTS `wallets` (
  `wallet_id` int(12) NOT NULL,
  `entity_id` int(12) NOT NULL,
  `quarter_id` int(12) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
  `reference_id` int(12) NOT NULL,
  `type` varchar(100) COLLATE utf8_bin NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `notes` varchar(255) COLLATE utf8_bin NOT NULL,
  `info_a` varchar(255) COLLATE utf8_bin NOT NULL,
  `info_b` varchar(255) COLLATE utf8_bin NOT NULL,
  `datetime` datetime NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  MODIFY `actions_info_id` int(14) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `actions_log`
--
ALTER TABLE `actions_log`
  MODIFY `action_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `action_types_info`
--
ALTER TABLE `action_types_info`
  MODIFY `action_types_info_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `answer_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `answers_info`
--
ALTER TABLE `answers_info`
  MODIFY `answers_info_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(12) NOT NULL AUTO_INCREMENT;
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
  MODIFY `email_template_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `entities`
--
ALTER TABLE `entities`
  MODIFY `entity_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `entities_info`
--
ALTER TABLE `entities_info`
  MODIFY `entities_info_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hosted_emails`
--
ALTER TABLE `hosted_emails`
  MODIFY `hosted_email_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invites`
--
ALTER TABLE `invites`
  MODIFY `invite_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `locales`
--
ALTER TABLE `locales`
  MODIFY `locale_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `locale_text`
--
ALTER TABLE `locale_text`
  MODIFY `locale_text_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `log_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `login_id` int(14) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `meeting_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `meetings_info`
--
ALTER TABLE `meetings_info`
  MODIFY `meetings_info_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `meeting_requested`
--
ALTER TABLE `meeting_requested`
  MODIFY `meeting_requested_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notify`
--
ALTER TABLE `notify`
  MODIFY `notify_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `opp_deals`
--
ALTER TABLE `opp_deals`
  MODIFY `deal_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `package_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `packages_info`
--
ALTER TABLE `packages_info`
  MODIFY `packages_info_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `packages_options`
--
ALTER TABLE `packages_options`
  MODIFY `packages_option_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `password_request`
--
ALTER TABLE `password_request`
  MODIFY `request_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ping_msgs`
--
ALTER TABLE `ping_msgs`
  MODIFY `msg_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `qr_codes`
--
ALTER TABLE `qr_codes`
  MODIFY `qr_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quarters`
--
ALTER TABLE `quarters`
  MODIFY `quarter_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `questions_info`
--
ALTER TABLE `questions_info`
  MODIFY `questions_info_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `quiz_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quizzes_info`
--
ALTER TABLE `quizzes_info`
  MODIFY `quizzes_info_id` int(14) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quiz_answers`
--
ALTER TABLE `quiz_answers`
  MODIFY `answer_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quiz_answers_info`
--
ALTER TABLE `quiz_answers_info`
  MODIFY `quiz_answers_info_id` int(14) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quiz_answer_times`
--
ALTER TABLE `quiz_answer_times`
  MODIFY `time_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `question_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quiz_questions_info`
--
ALTER TABLE `quiz_questions_info`
  MODIFY `quiz_questions_info_id` int(14) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `referral_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `resource_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `resources_info`
--
ALTER TABLE `resources_info`
  MODIFY `resources_info_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `slots`
--
ALTER TABLE `slots`
  MODIFY `slot_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `trivia`
--
ALTER TABLE `trivia`
  MODIFY `trivia_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_info`
--
ALTER TABLE `users_info`
  MODIFY `users_info_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_answers`
--
ALTER TABLE `user_answers`
  MODIFY `user_answer_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `user_groups_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `virtual_events`
--
ALTER TABLE `virtual_events`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `virtual_events_info`
--
ALTER TABLE `virtual_events_info`
  MODIFY `virtual_events_info_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `wallet_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wallets_history`
--
ALTER TABLE `wallets_history`
  MODIFY `wallets_history_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `whats_new`
--
ALTER TABLE `whats_new`
  MODIFY `entry_id` int(12) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

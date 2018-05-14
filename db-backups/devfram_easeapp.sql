-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 15, 2018 at 09:58 PM
-- Server version: 10.0.34-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `devfram_easeapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `cron_file_details`
--

CREATE TABLE `cron_file_details` (
  `sno` int(10) NOT NULL,
  `cron_file_name` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cron_file_description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cron_file_status_setting` enum('ON','OFF') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ON',
  `cron_file_numb_record_limit` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cron_file_numb_loop_count_limit` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `cron_file_sleep_seconds_limit` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `cron_file_set_time_interval` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'execution',
  `remarks` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `cron_file_details`
--

INSERT INTO `cron_file_details` (`sno`, `cron_file_name`, `cron_file_description`, `cron_file_status_setting`, `cron_file_numb_record_limit`, `cron_file_numb_loop_count_limit`, `cron_file_sleep_seconds_limit`, `cron_file_set_time_interval`, `remarks`) VALUES
(1, 'cron-test.php', 'Sample PHP File, that is enabled as Cron Job, on PHP CLI.\r\n\r\nThis \"sno\", has to be used, as value for cron_number variable, in the respective PHP File.', 'ON', '50000', '1', '0', '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `cron_file_statistics`
--

CREATE TABLE `cron_file_statistics` (
  `sno` int(10) NOT NULL,
  `cron_file_id` int(10) NOT NULL,
  `cron_file_execution_time` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deployment_maintenance_window_history`
--

CREATE TABLE `deployment_maintenance_window_history` (
  `id` char(65) CHARACTER SET ascii NOT NULL,
  `maintenance_date_time_from` datetime NOT NULL,
  `maintenance_date_time_to` datetime DEFAULT NULL,
  `status` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '0: disabled, 1: enabled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `settings_id` char(65) CHARACTER SET ascii NOT NULL,
  `deployment_status` enum('live','maintenance') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'live',
  `time_to_go_live` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'this will be defined in seconds and will be valid if deployment_status = maintenance'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`settings_id`, `deployment_status`, `time_to_go_live`) VALUES
('1', 'live', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `site_members`
--

CREATE TABLE `site_members` (
  `sm_memb_id` bigint(11) NOT NULL,
  `sm_username` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sm_password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sm_email` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sm_salutation` enum('Mr.','Mrs.','Ms.','Dr.') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Mrs.',
  `sm_firstname` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'applies to individuals only, (need to fill when sm_individual_setting = yes)',
  `sm_lastname` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'applies to individuals only, need to fill when sm_individual_setting = yes',
  `sm_dob` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sm_phone` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sm_mobile` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sm_address` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sm_city` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sm_state` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sm_country` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sm_zipcode` int(11) NOT NULL,
  `sm_ip_addr_reg` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'ip address during user registration',
  `security_question` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `security_answer` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sm_registered_date` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sm_registered_date_timezone` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sm_registered_date_epoch` bigint(20) NOT NULL,
  `sm_total_no_of_logins` int(6) NOT NULL COMMENT 'total number of logins by each user',
  `sm_user_email_act_code` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'email activation code',
  `sm_user_email_act_status` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '0:email not activated; 1: email activated',
  `sm_user_status` enum('not_activated','normal','suspended','banned') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'not_activated' COMMENT 'not_activated: not activated, normal: activated user, suspended: user is suspended temporarily, banned: banned permanently, unless site admin unbans with a cause'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `site_members`
--

INSERT INTO `site_members` (`sm_memb_id`, `sm_username`, `sm_password`, `sm_email`, `sm_salutation`, `sm_firstname`, `sm_lastname`, `sm_dob`, `sm_phone`, `sm_mobile`, `sm_address`, `sm_city`, `sm_state`, `sm_country`, `sm_zipcode`, `sm_ip_addr_reg`, `security_question`, `security_answer`, `sm_registered_date`, `sm_registered_date_timezone`, `sm_registered_date_epoch`, `sm_total_no_of_logins`, `sm_user_email_act_code`, `sm_user_email_act_status`, `sm_user_status`) VALUES
(1, 'superadmin', '$2y$10$mO82I.atn07qExJqrUAgFuBq/86EFXDWavjFtOvSwjl.95j0rFgVS', 'superadmin@easeapp.org', 'Mr.', 'super', 'admin', '1982-12-10', '', '', '', 'Hyderabad', 'Telangana', 'India', 500073, '', '', '', '2018-04-02 03:39:56', '', 0, 5, '0f65bf1e2da769989123', '1', 'normal'),
(2, 'siteadmin', '$2y$10$BfT1HsOaSwoTH70S1/rHDuuR29Jgv.5HyJBhH/1MKxpfwM8HW/H1u', 'siteadmin@easeapp.org', 'Mr.', 'Raghu Veer', 'D', '1982-08-10', '', '', '', 'Hyderabad', 'Telangana', 'India', 500073, '', '', '', '2018-04-02 03:39:56', '', 0, 1403, '0f65bf1e2da769989129', '1', 'normal');

-- --------------------------------------------------------

--
-- Table structure for table `sm_site_member_classification_associations`
--

CREATE TABLE `sm_site_member_classification_associations` (
  `member_classification_associations_id` bigint(20) NOT NULL,
  `sm_memb_id` bigint(11) NOT NULL COMMENT 'sm_memb_id from site_members db table',
  `sm_site_member_classification_details_id` mediumint(6) NOT NULL COMMENT 'sm_site_member_classification_details_id from sm_site_member_classification_details db table',
  `valid_from_date` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `valid_to_date` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'present',
  `is_active_status` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '0:disabled, 1:enabled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `sm_site_member_classification_associations`
--

INSERT INTO `sm_site_member_classification_associations` (`member_classification_associations_id`, `sm_memb_id`, `sm_site_member_classification_details_id`, `valid_from_date`, `valid_to_date`, `is_active_status`) VALUES
(1, 1, 19, '02-04-2018', 'present', '1'),
(2, 2, 18, '02-04-2018', 'present', '1');

-- --------------------------------------------------------

--
-- Table structure for table `sm_site_member_classification_details`
--

CREATE TABLE `sm_site_member_classification_details` (
  `sm_site_member_classification_details_id` mediumint(6) NOT NULL,
  `sm_user_type` enum('member','admin') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'member: frontend user, admin: backend user',
  `sm_user_level` smallint(3) NOT NULL COMMENT 'This defines the user level where 1 is the minimum and 999 is the maximum',
  `sm_user_role` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'role of the user to identify and define user type, level and role',
  `department` enum('accounts','customer-support','java-application-developers','android-application-developers','ios-application-developers','php-application-developers','sales','hr','product-management','technology-management','management') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'different user departments',
  `user_privilege_summary` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'This briefs the user type, level and role briefly',
  `user_privilege_description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'This value gives more detail about the particular user type, level and role',
  `is_active_status` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '0: disabled, 1: enabled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci COMMENT='This table will have details of different user types, their levels and roles ';

--
-- Dumping data for table `sm_site_member_classification_details`
--

INSERT INTO `sm_site_member_classification_details` (`sm_site_member_classification_details_id`, `sm_user_type`, `sm_user_level`, `sm_user_role`, `department`, `user_privilege_summary`, `user_privilege_description`, `is_active_status`) VALUES
(1, 'member', 0, 'member', NULL, 'Regular Frontend user', 'member or basic user (frontend)', '1'),
(2, 'member', 0, 'administrative', NULL, 'administrative role', 'assignable privileges (db based) for frontend user', '1'),
(3, 'admin', 1, 'website-management', 'php-application-developers', 'Webmaster', 'Webmaster', '1'),
(4, 'admin', 2, 'sales-and-support', 'customer-support', 'Customer Support', 'Customer Support', '1'),
(5, 'admin', 3, 'accountant', 'accounts', 'Accountant', 'Accountant', '1'),
(6, 'admin', 4, 'senior-accountant', 'accounts', 'Senior Accountant', 'Senior Accountant', '1'),
(7, 'admin', 5, 'sales-executive', 'sales', 'Sales Executive', 'Sales Executive', '1'),
(8, 'admin', 6, 'business-development-manager', 'sales', 'Business Development Manager', 'Business Development Manager', '1'),
(9, 'admin', 7, 'customer-support-java-apps', 'java-application-developers', 'Tech Support Java Applications', 'Tech Support for Java Applications', '1'),
(10, 'admin', 8, 'customer-support-android', 'android-application-developers', 'Tech Support Android Applications', 'Tech Support for Android Applications', '1'),
(11, 'admin', 9, 'customer-support-ios', 'ios-application-developers', 'Tech Support iOS Applications', 'Tech Support for iOS Applications', '1'),
(12, 'admin', 10, 'customer-support-php', 'php-application-developers', 'Tech Support PHP Applications', 'Tech Support for PHP Applications', '1'),
(13, 'admin', 11, 'shop', NULL, 'Shop Account', 'Primary Contact of Shop', '1'),
(14, 'admin', 12, 'distributor', NULL, 'Distributor', 'Primary Contact of Distributor', '1'),
(15, 'admin', 13, 'product-management', 'product-management', 'Product Manager', 'Product Manager', '1'),
(16, 'admin', 14, 'technology-management', 'technology-management', 'Technology Management', 'Technology Management', '1'),
(17, 'admin', 15, 'executive-management', 'management', 'Executive Management', 'CEO and other will be with this role', '1'),
(18, 'admin', 998, 'site-admin', '', 'Site Administrator', 'Site Administrator across the application', '1'),
(19, 'admin', 999, 'super-admin', '', 'Super Administrator', 'Super Administrator across the Application', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cron_file_details`
--
ALTER TABLE `cron_file_details`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `cron_file_statistics`
--
ALTER TABLE `cron_file_statistics`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `deployment_maintenance_window_history`
--
ALTER TABLE `deployment_maintenance_window_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`settings_id`);

--
-- Indexes for table `site_members`
--
ALTER TABLE `site_members`
  ADD PRIMARY KEY (`sm_memb_id`),
  ADD UNIQUE KEY `sm_memb_id` (`sm_memb_id`),
  ADD KEY `sw_username` (`sm_username`),
  ADD KEY `sm_user_type` (`sm_user_status`),
  ADD KEY `sm_username` (`sm_username`,`sm_email`(255)),
  ADD KEY `sm_email` (`sm_email`(255)),
  ADD KEY `sm_username_2` (`sm_username`,`sm_user_email_act_code`);

--
-- Indexes for table `sm_site_member_classification_associations`
--
ALTER TABLE `sm_site_member_classification_associations`
  ADD PRIMARY KEY (`member_classification_associations_id`),
  ADD KEY `sm_memb_id` (`sm_memb_id`,`is_active_status`);

--
-- Indexes for table `sm_site_member_classification_details`
--
ALTER TABLE `sm_site_member_classification_details`
  ADD PRIMARY KEY (`sm_site_member_classification_details_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cron_file_details`
--
ALTER TABLE `cron_file_details`
  MODIFY `sno` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cron_file_statistics`
--
ALTER TABLE `cron_file_statistics`
  MODIFY `sno` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_members`
--
ALTER TABLE `site_members`
  MODIFY `sm_memb_id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sm_site_member_classification_associations`
--
ALTER TABLE `sm_site_member_classification_associations`
  MODIFY `member_classification_associations_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sm_site_member_classification_details`
--
ALTER TABLE `sm_site_member_classification_details`
  MODIFY `sm_site_member_classification_details_id` mediumint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

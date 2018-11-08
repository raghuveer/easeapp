-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2018 at 10:32 AM
-- Server version: 10.1.25-MariaDB-1~xenial
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `easeapp_db`
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
-- Table structure for table `event_summary_logs`
--

CREATE TABLE `event_summary_logs` (
  `id` bigint(20) NOT NULL,
  `table_primary_key_id` bigint(20) NOT NULL,
  `table_name` varchar(60) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `activity_summary_description` varchar(240) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `activity_summary_description_full` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `is_active_status` enum('0','1') COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '1' COMMENT '0: In-Active, 1: Active'
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
  `sm_memb_id` bigint(20) NOT NULL,
  `sm_email` varchar(240) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `sm_password` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `sm_mobile` varchar(12) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `sm_salutation` enum('Mr','Ms','Mrs','Dr') COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'A Salutation has to be chosen, among the available options.',
  `sm_firstname` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL COMMENT 'First Name of the User of the Admin Group',
  `sm_middlename` varchar(50) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'Middle Name of the User of the Admin Group',
  `sm_lastname` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL COMMENT 'Last Name of the User of the Admin Group',
  `sm_dob` varchar(10) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `sm_phone` varchar(12) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `sm_address` varchar(250) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `sm_city` varchar(20) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `sm_state` varchar(50) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `sm_country` varchar(50) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `sm_zipcode` int(11) DEFAULT NULL,
  `sm_designation` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL COMMENT 'designation of the member of the admin user group',
  `sm_added_date_epoch` bigint(20) DEFAULT NULL,
  `sm_user_type` enum('member','admin') COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'member' COMMENT 'member or admin',
  `sm_admin_level` enum('0','1','2','3') COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '0' COMMENT '0: Not an Admin; 1: Site Manager; 2: Site Administrator; 3: Super Administrator',
  `sm_user_role` enum('member','administrative','admin_user','internal') COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'member, administrative, admin_user, internal',
  `added_by_admin_user_id` bigint(20) DEFAULT NULL COMMENT 'sm_memb_id of the admin user, from site_members db table, who added this member of admin group, in the application. NULL is Applicable, only to Super Admin',
  `added_by_admin_user_firstname` varchar(50) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'sm_firstname of the admin user, from site_members db table, who added this member of admin group, in the application. NULL is Applicable, only to Super Admin',
  `added_by_admin_user_middlename` varchar(50) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'sm_middlename of the admin user, from site_members db table, who added this member of admin group, in the application. NULL is Applicable, only to Super Admin',
  `added_by_admin_user_lastname` varchar(50) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'sm_lastname of the admin user, from site_members db table, who added this member of admin group, in the application. NULL is Applicable, only to Super Admin',
  `added_date_time` varchar(30) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'date and time, when this admin group member''s data is added at. NULL is Applicable, only to Super Admin',
  `added_date_time_epoch` bigint(20) DEFAULT NULL COMMENT 'epoch value of date and time, when this admin group member''s data is added at. NULL is Applicable, only to Super Admin',
  `last_updated_date_time` varchar(30) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'date time when the admin group member info is last updated at ',
  `last_updated_date_time_epoch` bigint(20) DEFAULT NULL COMMENT 'date time when the admin group member data is last updated at ',
  `last_active_event_time` varchar(30) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'date time when the user is last active ',
  `last_active_event_time_epoch` bigint(20) DEFAULT NULL COMMENT 'epoch value of date and time when the user is last active ',
  `sm_total_no_of_logins` int(6) NOT NULL DEFAULT '0' COMMENT 'total number of logins by each user',
  `sm_user_email_act_code` varchar(72) COLLATE utf8mb4_unicode_520_ci NOT NULL COMMENT 'email activation code',
  `sm_user_status` enum('0','1','2','3') COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '0' COMMENT '0: In-Active, 1: Active, 2: Suspended, 3: Banned '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `site_members`
--

INSERT INTO `site_members` (`sm_memb_id`, `sm_email`, `sm_password`, `sm_mobile`, `sm_salutation`, `sm_firstname`, `sm_middlename`, `sm_lastname`, `sm_dob`, `sm_phone`, `sm_address`, `sm_city`, `sm_state`, `sm_country`, `sm_zipcode`, `sm_designation`, `sm_added_date_epoch`, `sm_user_type`, `sm_admin_level`, `sm_user_role`, `added_by_admin_user_id`, `added_by_admin_user_firstname`, `added_by_admin_user_middlename`, `added_by_admin_user_lastname`, `added_date_time`, `added_date_time_epoch`, `last_updated_date_time`, `last_updated_date_time_epoch`, `last_active_event_time`, `last_active_event_time_epoch`, `sm_total_no_of_logins`, `sm_user_email_act_code`, `sm_user_status`) VALUES
(1, 'webmaster@easeapp.org', '$2y$10$qP2oi.2Ib4omXaHoNAokjO7ybBP1lsg81c/mtsB7tz4/2mTFg/qgm', '', 'Mr', 'Super', NULL, 'Admin', '', '', '', '', '', '', 0, '', 0, 'admin', '3', 'admin_user', 0, '', '', '', '', 0, NULL, NULL, NULL, NULL, 0, 'hjgkjhfyhg9795tfyig87657ytg895674re8f7878', '1');

-- --------------------------------------------------------

--
-- Table structure for table `sm_site_member_classification_associations`
--

CREATE TABLE `sm_site_member_classification_associations` (
  `sm_site_member_classification_association_id` bigint(20) NOT NULL,
  `sm_memb_id` bigint(11) NOT NULL COMMENT 'sm_memb_id from site_members db table',
  `sm_site_member_classification_details_id` mediumint(6) NOT NULL COMMENT 'sm_site_member_classification_details_id from sm_site_member_classification_details db table',
  `valid_from_date` varchar(30) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `valid_to_date` varchar(30) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'present',
  `is_active_status` enum('0','1') COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '1' COMMENT '0:disabled, 1:enabled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `sm_site_member_classification_associations`
--

INSERT INTO `sm_site_member_classification_associations` (`sm_site_member_classification_association_id`, `sm_memb_id`, `sm_site_member_classification_details_id`, `valid_from_date`, `valid_to_date`, `is_active_status`) VALUES
(1, 1, 7, '01-12-2014', 'present', '1'),
(2, 1, 6, '01-12-2014', 'present', '1');

-- --------------------------------------------------------

--
-- Table structure for table `sm_site_member_classification_details`
--

CREATE TABLE `sm_site_member_classification_details` (
  `sm_site_member_classification_details_id` mediumint(6) NOT NULL,
  `sm_user_type` enum('member','admin') COLLATE utf8mb4_unicode_520_ci NOT NULL COMMENT 'member: frontend user, admin: backend user',
  `sm_user_level` smallint(3) NOT NULL COMMENT 'This defines the user level where 1 is the minimum and 999 is the maximum',
  `sm_user_role` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL COMMENT 'role of the user to identify and define user type, level and role',
  `department` enum('sales-and-marketing','customer-support','legal-and-immigration','internal-administration','web-application-dev-team','technology-management','management') COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'different user departments',
  `user_privilege_summary` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL COMMENT 'This briefs the user type, level and role briefly',
  `user_privilege_description` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL COMMENT 'This value gives more detail about the particular user type, level and role',
  `is_active_status` enum('0','1') COLLATE utf8mb4_unicode_520_ci NOT NULL COMMENT '0: disabled, 1: enabled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci COMMENT='This table will have details of different user types, their levels and roles ';

--
-- Dumping data for table `sm_site_member_classification_details`
--

INSERT INTO `sm_site_member_classification_details` (`sm_site_member_classification_details_id`, `sm_user_type`, `sm_user_level`, `sm_user_role`, `department`, `user_privilege_summary`, `user_privilege_description`, `is_active_status`) VALUES
(1, 'member', 0, 'member', NULL, 'User', 'User Access Level', '1'),
(2, 'member', 0, 'administrative', NULL, 'administrative role', 'assignable privileges (db based) for frontend user', '0'),
(3, 'admin', 1, 'website-management', 'web-application-dev-team', 'Webmaster', 'Webmaster', '1'),
(4, 'admin', 2, 'technology-management', 'technology-management', 'Technology Management', 'Technology Management', '1'),
(5, 'admin', 3, 'executive-management', 'management', 'Executive Management', 'CEO and other will be with this role', '1'),
(6, 'admin', 998, 'site-admin', 'management', 'Site Administrator', 'Site Administrator across the application', '1'),
(7, 'admin', 999, 'super-admin', 'management', 'Super Administrator', 'Super Administrator across the Application', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user_auth_tokens`
--

CREATE TABLE `user_auth_tokens` (
  `user_auth_token_id` bigint(20) NOT NULL COMMENT 'The "jti" (JWT ID) claim provides a unique identifier for the JWT.    The identifier value MUST be assigned in a manner that ensures that    there is a negligible probability that the same value will be    accidentally assigned to a different data object; if the application    uses multiple issuers, collisions MUST be prevented among values    produced by different issuers as well.  The "jti" claim can be used    to prevent the JWT from being replayed.  The "jti" value is a case-    sensitive string.  Use of this claim is OPTIONAL.',
  `user_id` bigint(20) NOT NULL,
  `date_time_token_creation` datetime NOT NULL,
  `jwt_iss` varchar(64) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'The "iss" (issuer) claim identifies the principal that issued the    JWT.  The processing of this claim is generally application specific.    The "iss" value is a case-sensitive string containing a StringOrURI    value.  Use of this claim is OPTIONAL.',
  `jwt_sub` varchar(64) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT ' The "sub" (subject) claim identifies the principal that is the    subject of the JWT.  The claims in a JWT are normally statements    about the subject.  The subject value MUST either be scoped to be    locally unique in the context of the issuer or be globally unique.    The processing of this claim is generally application specific.  The    "sub" value is a case-sensitive string containing a StringOrURI    value.  Use of this claim is OPTIONAL.',
  `jwt_aud` varchar(250) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'The "aud" (audience) claim identifies the recipients that the JWT is    intended for.  Each principal intended to process the JWT MUST    identify itself with a value in the audience claim.  If the principal    processing the claim does not identify itself with a value in the    "aud" claim when this claim is present, then the JWT MUST be    rejected.  In the general case, the "aud" value is an array of case-    sensitive strings, each containing a StringOrURI value.  In the    special case when the JWT has one audience, the "aud" value MAY be a    single case-sensitive string containing a StringOrURI value.  The    interpretation of audience values is generally application specific.    Use of this claim is OPTIONAL.',
  `jwt_iat` bigint(20) NOT NULL COMMENT ' The "iat" (issued at) claim identifies the time at which the JWT was    issued.  This claim can be used to determine the age of the JWT.  Its    value MUST be a number containing a NumericDate value.  Use of this    claim is OPTIONAL.',
  `jwt_nbf` bigint(20) DEFAULT NULL COMMENT 'The "nbf" (not before) claim identifies the time before which the JWT    MUST NOT be accepted for processing.  The processing of the "nbf"    claim requires that the current date/time MUST be after or equal to    the not-before date/time listed in the "nbf" claim.  Implementers MAY    provide for some small leeway, usually no more than a few minutes, to    account for clock skew.  Its value MUST be a number containing a    NumericDate value.  Use of this claim is OPTIONAL.',
  `jwt_exp` bigint(20) NOT NULL COMMENT ' The "exp" (expiration time) claim identifies the expiration time on    or after which the JWT MUST NOT be accepted for processing.  The    processing of the "exp" claim requires that the current date/time    MUST be before the expiration date/time listed in the "exp" claim.',
  `jwt_jws_alg` enum('HS256','HS384','HS512','RS256','RS384','RS512','ES256','ES384','ES512','PS256','PS384','none') COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'HS256' COMMENT 'HS256: HMAC using SHA-256, HS384: HMAC using SHA-384, HS512:HMAC using SHA-512, RS256: RSASSA-PKCS1-v1_5 using SHA-256, RS384: RSASSA-PKCS1-v1_5 using SHA-384, RS512: RSASSA-PKCS1-v1_5 using SHA-512, ES256: ECDSA using P-256 and SHA-256, ES384: ECDSA using P-384 and SHA-384, ES512: ECDSA using P-521 and SHA-512, PS256: RSASSA-PSS using SHA-256 and MGF1 with SHA-256, PS384: RSASSA-PSS using SHA-384 and MGF1 with SHA-384, PS512: RSASSA-PSS using SHA-512 and MGF1 with SHA-512, none: No digital signature or MAC performed. This is as per 3.1 section of https://www.rfc-editor.org/rfc/rfc7518.txt',
  `is_reusable` enum('1','0') COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '1' COMMENT '1: yes, till the token expires, 0: no, useful for single transaction only',
  `is_active_status` enum('0','1') COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '1' COMMENT '0: inactive, 1: active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `user_auth_tokens`
--

INSERT INTO `user_auth_tokens` (`user_auth_token_id`, `user_id`, `date_time_token_creation`, `jwt_iss`, `jwt_sub`, `jwt_aud`, `jwt_iat`, `jwt_nbf`, `jwt_exp`, `jwt_jws_alg`, `is_reusable`, `is_active_status`) VALUES
(1, 1, '2018-11-05 08:12:03', 'Easeapp JWT Token Issuer', '1', '[\"Web Application\",\"Android Mobile App\",\"iOS mobile App\"]', 1541405523, 1541405523, 1541412723, 'HS256', '1', '0'),
(2, 1, '2018-11-05 09:12:12', 'Easeapp JWT Token Issuer', '1', '[\"Web Application\",\"Android Mobile App\",\"iOS mobile App\"]', 1541409132, 1541409132, 1541416332, 'HS256', '1', '0'),
(3, 1, '2018-11-05 13:17:46', 'Easeapp JWT Token Issuer', '1', '[\"Web Application\",\"Android Mobile App\",\"iOS mobile App\"]', 1541423866, 1541423866, 1541431066, 'HS256', '1', '1');

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
-- Indexes for table `event_summary_logs`
--
ALTER TABLE `event_summary_logs`
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
  ADD KEY `sm_email` (`sm_email`(191)),
  ADD KEY `sm_mobile` (`sm_mobile`),
  ADD KEY `sm_user_status` (`sm_user_status`),
  ADD KEY `added_by_admin_user_id` (`added_by_admin_user_id`),
  ADD KEY `sm_user_type` (`sm_user_type`),
  ADD KEY `sm_admin_level` (`sm_admin_level`),
  ADD KEY `sm_user_role` (`sm_user_role`);

--
-- Indexes for table `sm_site_member_classification_associations`
--
ALTER TABLE `sm_site_member_classification_associations`
  ADD PRIMARY KEY (`sm_site_member_classification_association_id`),
  ADD KEY `sm_memb_id` (`sm_memb_id`,`is_active_status`);

--
-- Indexes for table `sm_site_member_classification_details`
--
ALTER TABLE `sm_site_member_classification_details`
  ADD PRIMARY KEY (`sm_site_member_classification_details_id`);

--
-- Indexes for table `user_auth_tokens`
--
ALTER TABLE `user_auth_tokens`
  ADD PRIMARY KEY (`user_auth_token_id`),
  ADD KEY `custid_token_status` (`user_id`,`is_active_status`) USING BTREE;

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
-- AUTO_INCREMENT for table `event_summary_logs`
--
ALTER TABLE `event_summary_logs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_members`
--
ALTER TABLE `site_members`
  MODIFY `sm_memb_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sm_site_member_classification_associations`
--
ALTER TABLE `sm_site_member_classification_associations`
  MODIFY `sm_site_member_classification_association_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sm_site_member_classification_details`
--
ALTER TABLE `sm_site_member_classification_details`
  MODIFY `sm_site_member_classification_details_id` mediumint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_auth_tokens`
--
ALTER TABLE `user_auth_tokens`
  MODIFY `user_auth_token_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'The "jti" (JWT ID) claim provides a unique identifier for the JWT.    The identifier value MUST be assigned in a manner that ensures that    there is a negligible probability that the same value will be    accidentally assigned to a different data object; if the application    uses multiple issuers, collisions MUST be prevented among values    produced by different issuers as well.  The "jti" claim can be used    to prevent the JWT from being replayed.  The "jti" value is a case-    sensitive string.  Use of this claim is OPTIONAL.', AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2021 at 01:14 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kernig`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessories`
--

CREATE TABLE `accessories` (
  `accessory_id` bigint(20) UNSIGNED NOT NULL,
  `accessory_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `accessory_price` double(8,2) NOT NULL,
  `accessory_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accessory_status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `account_setting`
--

CREATE TABLE `account_setting` (
  `account_setting_id` bigint(20) UNSIGNED NOT NULL,
  `site_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `site_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `top_tagline` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_sales_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `site_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `site_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `email_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scroll_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `twitter_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `instagram_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `googleplus_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `pinterest_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_setting`
--

INSERT INTO `account_setting` (`account_setting_id`, `site_name`, `site_email`, `top_tagline`, `site_sales_email`, `site_number`, `site_logo`, `email_logo`, `scroll_logo`, `site_address`, `facebook_url`, `twitter_url`, `instagram_url`, `googleplus_url`, `pinterest_url`, `created_at`, `updated_at`) VALUES
(1, 'Kernig Krafts', 'kernigkrafts@gmail.com', 'LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING!', 'kernigkrafts@gmail.com', '+91-1234567890', '49d73819-6c94-4221-b324-39ebd8653a8f-1619514162.png', 'ff417014-1552-4410-8b2f-dfaee59519b8-1619514162.png', 'a16d7036-36f3-4984-bb0e-ba2060d09b7e-1587815776.png', 'Kernig Krafts, Jodhpur', 'https://www.facebook.com/kernigkrafts', 'https://twitter.com/kernigkrafts', 'https://instagram.com/kernigkrafts', '', 'https://www.pinterest.com/kernigkrafts', NULL, '2021-05-10 14:09:26');

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `profile_image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:Active, 2:Inactive',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `name`, `email`, `mobile_number`, `email_verified_at`, `profile_image`, `password`, `user_status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Bagtesh Fashion', 'giribhagirath169@gmail.com', NULL, NULL, NULL, '$2y$10$vx3OPb.GzsApunWccW6XIOjAGB1fgBy.7RVygkRYhciQoIIO8BL6C', 1, 'xQMLGK6zqYwyyAOOx0wkPHU8AznwKiX1Edj2MHLyu5NEbp4f74FfrO0Ru9nS', NULL, '2021-05-18 17:18:06');

-- --------------------------------------------------------

--
-- Table structure for table `api_tokens`
--

CREATE TABLE `api_tokens` (
  `api_token_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `api_token` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:Active, 2:Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_failed_jobs`
--

CREATE TABLE `app_failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_jobs`
--

CREATE TABLE `app_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `category_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `category_root_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `category_subroot_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `category_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size_chart` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_order` int(11) NOT NULL DEFAULT 0,
  `category_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:Active, 2:Inactive',
  `category_meta_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_heading` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_slug`, `category_root_id`, `category_subroot_id`, `category_image`, `size_chart`, `category_desc`, `category_order`, `category_status`, `category_meta_title`, `category_heading`, `category_meta_keywords`, `category_meta_description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(77, 'Sofa', 'sofa', 0, 0, 'ef06f846-eac0-498c-9bae-b42dcaf4d2f7-1620184654.png', NULL, '<p>Sofa&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>', 0, 1, 'sofa', NULL, 'sofa', 'sofa', '2021-05-05 03:17:34', '2021-05-05 03:17:34', NULL),
(78, 'Single Seater', 'single-seater', 77, 0, 'edf5681a-188b-465e-90a4-8ec193704925-1620184730.png', NULL, '<p>single-seater sofa&nbsp;&nbsp;&nbsp;&nbsp;</p>', 0, 1, 'single-seater sofa', NULL, 'single-seater sofa', 'single-seater sofa', '2021-05-05 03:18:50', '2021-05-05 03:18:50', NULL),
(79, 'Valvet', 'valvet', 77, 78, 'e3fe313f-fee4-4086-84aa-becc08a6cde8-1620185844.png', NULL, '<p>qwertyuio&nbsp;&nbsp;&nbsp;&nbsp;</p>', 0, 1, 'wertyu', NULL, 'werwerwe', 'erweret', '2021-05-05 03:37:24', '2021-05-05 03:37:24', NULL),
(80, 'Table', 'table', 0, 0, '40fc7b3a-f229-414b-bdb8-d0e209962a65-1620186228.png', NULL, '<p>wertyulkjhgf&nbsp;&nbsp;&nbsp;&nbsp;</p>', 5, 1, 'dsfssdfdsf', NULL, 'dfffgdfg', 'rgdfgfg', '2021-05-05 03:43:48', '2021-05-08 04:00:32', NULL),
(81, 'Dinning Table', 'dinning-table', 80, 0, '20074c9b-526d-40a3-aae4-0cb268ea8e98-1620186352.png', NULL, '<p>qwertyuiop</p>', 3, 1, 'wertyhjkjhbv', NULL, 'sdsfdzfxvf', 'xdsznbmb', '2021-05-05 03:45:52', '2021-05-08 04:00:25', NULL),
(82, 'First', 'first', 0, 0, 'da291fef-ba7a-40c3-b709-56d27e6154c8-1620446720.jpg', NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, '2021-05-08 04:05:20', '2021-05-08 04:05:20', NULL),
(83, 'Second', 'second', 0, 0, '56f2b7ab-9de6-4540-9832-2e968d058a6e-1620446740.jpg', NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, '2021-05-08 04:05:40', '2021-05-08 04:05:40', NULL),
(84, 'Third', 'third', 0, 0, 'dbe84276-b5fd-4554-8b52-ea59639a79d6-1620446761.jpg', NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, '2021-05-08 04:06:01', '2021-05-08 04:06:01', NULL),
(85, 'Fourth', 'fourth', 0, 0, '102b6dae-a7a7-4c25-a8c0-3eaa8b233749-1620446790.jpg', NULL, NULL, 10, 1, NULL, NULL, NULL, NULL, '2021-05-08 04:06:30', '2021-05-08 04:06:45', NULL),
(86, 'First One', 'first-one', 82, 0, 'f609f603-3c21-4c26-acdf-f6b9949ea7ce-1620446847.jpg', NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, '2021-05-08 04:07:27', '2021-05-08 04:07:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `color_id` bigint(20) UNSIGNED NOT NULL,
  `color_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `color_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `color_code` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `color_order` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `color_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:Active, 2:Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `country_name` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = Active , 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `country_name`, `country_status`, `created_at`, `updated_at`) VALUES
(99, 'India', 1, '2020-06-27 11:05:19', '2020-06-27 11:05:19'),
(193, 'South Africa', 1, '2020-06-27 11:05:23', '2020-06-27 11:05:23'),
(223, 'United States Of America', 1, '2020-06-27 11:05:25', '2020-06-27 11:05:25'),
(250, 'Afghanistan', 1, '2020-06-27 11:05:27', '2020-06-27 11:05:27'),
(251, 'Albania', 1, '2020-06-27 11:05:27', '2020-06-27 11:05:27'),
(252, 'Algeria', 1, '2020-06-27 11:05:27', '2020-06-27 11:05:27'),
(253, 'American Samoa', 1, '2020-06-27 11:05:26', '2020-06-27 11:05:26'),
(254, 'Andorra', 1, '2020-06-27 11:05:26', '2020-06-27 11:05:26'),
(255, 'Angola', 1, '2020-06-27 11:05:26', '2020-06-27 11:05:26'),
(256, 'Anguilla', 1, '2020-06-27 11:05:26', '2020-06-27 11:05:26'),
(257, 'Antigua', 1, '2020-06-27 11:05:26', '2020-06-27 11:05:26'),
(258, 'Argentina', 1, '2020-06-27 11:05:26', '2020-06-27 11:05:26'),
(259, 'Armenia', 1, '2020-06-27 11:05:26', '2020-06-27 11:05:26'),
(260, 'Aruba', 1, '2020-06-27 11:05:26', '2020-06-27 11:05:26'),
(261, 'Australia', 1, '2020-06-27 11:05:26', '2020-06-27 11:05:26'),
(262, 'Austria', 1, '2020-06-27 11:05:26', '2020-06-27 11:05:26'),
(263, 'Azerbaijan', 1, '2020-06-27 11:05:26', '2020-06-27 11:05:26'),
(264, 'Bahamas', 1, '2020-06-27 11:05:26', '2020-06-27 11:05:26'),
(265, 'Bahrain', 1, '2020-06-27 11:05:26', '2020-06-27 11:05:26'),
(266, 'Bangladesh', 1, '2020-06-27 11:05:26', '2020-06-27 11:05:26'),
(267, 'Barbados', 1, '2020-06-27 11:05:25', '2020-06-27 11:05:25'),
(268, 'Belarus', 1, '2020-06-27 11:05:25', '2020-06-27 11:05:25'),
(269, 'Belgium', 1, '2020-06-27 11:05:25', '2020-06-27 11:05:25'),
(270, 'Belize', 1, '2020-06-27 11:05:25', '2020-06-27 11:05:25'),
(271, 'Benin', 1, '2020-06-27 11:05:25', '2020-06-27 11:05:25'),
(272, 'Bermuda', 1, '2020-06-27 11:05:25', '2020-06-27 11:05:25'),
(273, 'Bhutan', 1, '2020-06-27 11:05:25', '2020-06-27 11:05:25'),
(274, 'Bolivia', 1, '2020-06-27 11:05:25', '2020-06-27 11:05:25'),
(275, 'Bonaire', 1, '2020-06-27 11:05:25', '2020-06-27 11:05:25'),
(276, 'Bosnia and Herzegovina', 1, '2020-06-27 11:05:25', '2020-06-27 11:05:25'),
(277, 'Botswana', 1, '2020-06-27 11:05:24', '2020-06-27 11:05:24'),
(278, 'Brazil', 1, '2020-06-27 11:05:24', '2020-06-27 11:05:24'),
(279, 'Brunei', 1, '2020-06-27 11:05:24', '2020-06-27 11:05:24'),
(280, 'Bulgaria', 1, '2020-06-27 11:05:24', '2020-06-27 11:05:24'),
(281, 'Burkina Faso', 1, '2020-06-27 11:05:24', '2020-06-27 11:05:24'),
(282, 'Burundi', 1, '2020-06-27 11:05:23', '2020-06-27 11:05:23'),
(283, 'Cambodia', 1, '2020-06-27 11:05:23', '2020-06-27 11:05:23'),
(284, 'Cameroon', 1, '2020-06-27 11:05:23', '2020-06-27 11:05:23'),
(285, 'Canada', 1, '2020-06-27 11:05:23', '2020-06-27 11:05:23'),
(286, 'Canary Islands', 1, '2020-06-27 11:05:23', '2020-06-27 11:05:23'),
(287, 'Cape Verde', 1, '2020-06-27 11:05:23', '2020-06-27 11:05:23'),
(288, 'Cayman Islands', 1, '2020-06-27 11:05:23', '2020-06-27 11:05:23'),
(289, 'Central African Republic', 1, '2020-06-27 11:05:23', '2020-06-27 11:05:23'),
(290, 'Chad', 1, '2020-06-27 11:05:23', '2020-06-27 11:05:23'),
(291, 'Chile', 1, '2020-06-27 11:05:23', '2020-06-27 11:05:23'),
(292, 'China', 1, '2020-06-27 11:05:23', '2020-06-27 11:05:23'),
(293, 'Colombia', 1, '2020-06-27 11:05:23', '2020-06-27 11:05:23'),
(294, 'Comoros', 1, '2020-06-27 11:05:23', '2020-06-27 11:05:23'),
(295, 'Congo', 1, '2020-06-27 11:05:22', '2020-06-27 11:05:22'),
(296, 'Cook Islands', 1, '2020-06-27 11:05:22', '2020-06-27 11:05:22'),
(297, 'Costa Rica', 1, '2020-06-27 11:05:22', '2020-06-27 11:05:22'),
(298, 'Cote d\'Ivoire', 1, '2020-06-27 11:05:22', '2020-06-27 11:05:22'),
(299, 'Croatia', 1, '2020-06-27 11:05:22', '2020-06-27 11:05:22'),
(300, 'Cuba', 1, '2020-06-27 11:05:22', '2020-06-27 11:05:22'),
(301, 'Curacao', 1, '2020-06-27 11:05:22', '2020-06-27 11:05:22'),
(302, 'Cyprus', 1, '2020-06-27 11:05:22', '2020-06-27 11:05:22'),
(303, 'Czech Republic', 1, '2020-06-27 11:05:22', '2020-06-27 11:05:22'),
(304, 'Denmark', 1, '2020-06-27 11:05:22', '2020-06-27 11:05:22'),
(305, 'Djibouti', 1, '2020-06-27 11:05:22', '2020-06-27 11:05:22'),
(306, 'Dominican Republic', 1, '2020-06-27 11:05:22', '2020-06-27 11:05:22'),
(307, 'East Timor', 1, '2020-06-27 11:05:22', '2020-06-27 11:05:22'),
(308, 'Ecuador', 1, '2020-06-27 11:05:22', '2020-06-27 11:05:22'),
(309, 'Egypt', 1, '2020-06-27 11:05:22', '2020-06-27 11:05:22'),
(310, 'El Salvador', 1, '2020-06-27 11:05:22', '2020-06-27 11:05:22'),
(311, 'Eritrea', 1, '2020-06-27 11:05:22', '2020-06-27 11:05:22'),
(312, 'Estonia', 1, '2020-06-27 11:05:22', '2020-06-27 11:05:22'),
(313, 'Ethiopia', 1, '2020-06-27 11:05:22', '2020-06-27 11:05:22'),
(314, 'Falkland Islands', 1, '2020-06-27 11:05:21', '2020-06-27 11:05:21'),
(315, 'Faroe Islands', 1, '2020-06-27 11:05:21', '2020-06-27 11:05:21'),
(316, 'Fiji', 1, '2020-06-27 11:05:21', '2020-06-27 11:05:21'),
(317, 'Finland', 1, '2020-06-27 11:05:21', '2020-06-27 11:05:21'),
(318, 'France', 1, '2020-06-27 11:05:21', '2020-06-27 11:05:21'),
(319, 'French Guyana', 1, '2020-06-27 11:05:21', '2020-06-27 11:05:21'),
(320, 'Gabon', 1, '2020-06-27 11:05:21', '2020-06-27 11:05:21'),
(321, 'Gambia', 1, '2020-06-27 11:05:21', '2020-06-27 11:05:21'),
(322, 'Georgia', 1, '2020-06-27 11:05:21', '2020-06-27 11:05:21'),
(323, 'Germany', 1, '2020-06-27 11:05:21', '2020-06-27 11:05:21'),
(324, 'Ghana', 1, '2020-06-27 11:05:21', '2020-06-27 11:05:21'),
(325, 'Gibraltar', 1, '2020-06-27 11:05:21', '2020-06-27 11:05:21'),
(326, 'Greece', 1, '2020-06-27 11:05:21', '2020-06-27 11:05:21'),
(327, 'Greenland', 1, '2020-06-27 11:05:21', '2020-06-27 11:05:21'),
(328, 'Grenada', 1, '2020-06-27 11:05:21', '2020-06-27 11:05:21'),
(329, 'Guadeloupe', 1, '2020-06-27 11:05:21', '2020-06-27 11:05:21'),
(330, 'Guam', 1, '2020-06-27 11:05:21', '2020-06-27 11:05:21'),
(331, 'Guatemala', 1, '2020-06-27 11:05:21', '2020-06-27 11:05:21'),
(332, 'Guernsey', 1, '2020-06-27 11:05:21', '2020-06-27 11:05:21'),
(333, 'Guinea', 1, '2020-06-27 11:05:21', '2020-06-27 11:05:21'),
(334, 'Guyana', 1, '2020-06-27 11:05:21', '2020-06-27 11:05:21'),
(335, 'Haiti', 1, '2020-06-27 11:05:21', '2020-06-27 11:05:21'),
(336, 'Honduras', 1, '2020-06-27 11:05:21', '2020-06-27 11:05:21'),
(337, 'Hong Kong', 1, '2020-06-27 11:05:20', '2020-06-27 11:05:20'),
(338, 'Hungary', 1, '2020-06-27 11:05:20', '2020-06-27 11:05:20'),
(339, 'Iceland', 1, '2020-06-27 11:05:20', '2020-06-27 11:05:20'),
(340, 'Indonesia', 1, '2020-06-27 11:05:20', '2020-06-27 11:05:20'),
(341, 'Iran', 1, '2020-06-27 11:05:20', '2020-06-27 11:05:20'),
(342, 'Iraq', 1, '2020-06-27 11:05:20', '2020-06-27 11:05:20'),
(343, 'Ireland', 1, '2020-06-27 11:05:20', '2020-06-27 11:05:20'),
(344, 'Israel', 1, '2020-06-27 11:05:20', '2020-06-27 11:05:20'),
(345, 'Italy', 1, '2020-06-27 11:05:20', '2020-06-27 11:05:20'),
(346, 'Jamaica', 1, '2020-06-27 11:05:20', '2020-06-27 11:05:20'),
(347, 'Japan', 1, '2020-06-27 11:05:20', '2020-06-27 11:05:20'),
(348, 'Jersey', 1, '2020-06-27 11:05:20', '2020-06-27 11:05:20'),
(349, 'Jordan', 1, '2020-06-27 11:05:20', '2020-06-27 11:05:20'),
(350, 'Kazakhstan', 1, '2020-06-27 11:05:20', '2020-06-27 11:05:20'),
(351, 'Kenya', 1, '2020-06-27 11:05:20', '2020-06-27 11:05:20'),
(352, 'Kiribati', 1, '2020-06-27 11:05:20', '2020-06-27 11:05:20'),
(353, 'Korea, Republic Of', 1, '2020-06-27 11:05:19', '2020-06-27 11:05:19'),
(354, 'Korea, The D.P.R of', 1, '2020-06-27 11:05:19', '2020-06-27 11:05:19'),
(355, 'Kosovo', 1, '2020-06-27 11:05:19', '2020-06-27 11:05:19'),
(356, 'Kuwait', 1, '2020-06-27 11:05:19', '2020-06-27 11:05:19'),
(357, 'Kyrgyzstan', 1, '2020-06-27 11:05:19', '2020-06-27 11:05:19'),
(358, 'Lao', 1, '2020-06-27 11:05:19', '2020-06-27 11:05:19'),
(359, 'Latvia', 1, '2020-06-27 11:05:19', '2020-06-27 11:05:19'),
(360, 'Lebanon', 1, '2020-06-27 11:05:19', '2020-06-27 11:05:19'),
(361, 'Lesotho', 1, '2020-06-27 11:05:19', '2020-06-27 11:05:19'),
(362, 'Liberia', 1, '2020-06-27 11:05:19', '2020-06-27 11:05:19'),
(363, 'Libya', 1, '2020-06-27 11:05:19', '2020-06-27 11:05:19'),
(364, 'Liechtenstein', 1, '2020-06-27 11:05:19', '2020-06-27 11:05:19'),
(365, 'Lithuania', 1, '2020-06-27 11:05:19', '2020-06-27 11:05:19'),
(366, 'Luxembourg', 1, '2020-06-27 11:05:19', '2020-06-27 11:05:19'),
(367, 'Macau', 1, '2020-06-27 11:05:19', '2020-06-27 11:05:19'),
(368, 'Macedonia', 1, '2020-06-27 11:05:19', '2020-06-27 11:05:19'),
(369, 'Madagascar', 1, '2020-06-27 11:05:19', '2020-06-27 11:05:19'),
(370, 'Malawi', 1, '2020-06-27 11:05:19', '2020-06-27 11:05:19'),
(371, 'Malaysia', 1, '2020-06-27 11:05:19', '2020-06-27 11:05:19'),
(372, 'Maldives', 1, '2020-06-27 11:05:19', '2020-06-27 11:05:19'),
(373, 'Mali', 1, '2020-06-27 11:05:19', '2020-06-27 11:05:19'),
(374, 'Malta', 1, '2020-06-27 11:05:18', '2020-06-27 11:05:18'),
(375, 'Marshall Islands', 1, '2020-06-27 11:05:18', '2020-06-27 11:05:18'),
(376, 'Martinique', 1, '2020-06-27 11:05:18', '2020-06-27 11:05:18'),
(377, 'Mauritania', 1, '2020-06-27 11:05:18', '2020-06-27 11:05:18'),
(378, 'Mauritius', 1, '2020-06-27 11:05:18', '2020-06-27 11:05:18'),
(379, 'Mayotte', 1, '2020-06-27 11:05:18', '2020-06-27 11:05:18'),
(380, 'Mexico', 1, '2020-06-27 11:05:18', '2020-06-27 11:05:18'),
(381, 'Micronesia, Federated States of', 1, '2020-06-27 11:05:18', '2020-06-27 11:05:18'),
(382, 'Moldova', 1, '2020-06-27 11:05:18', '2020-06-27 11:05:18'),
(383, 'Monaco', 1, '2020-06-27 11:05:18', '2020-06-27 11:05:18'),
(384, 'Mongolia', 1, '2020-06-27 11:05:18', '2020-06-27 11:05:18'),
(385, 'Montenegro', 1, '2020-06-27 11:05:18', '2020-06-27 11:05:18'),
(386, 'Montserrat', 1, '2020-06-27 11:05:18', '2020-06-27 11:05:18'),
(387, 'Morocco', 1, '2020-06-27 11:05:18', '2020-06-27 11:05:18'),
(388, 'Mozambique', 1, '2020-06-27 11:05:18', '2020-06-27 11:05:18'),
(389, 'Myanmar', 1, '2020-06-27 11:05:18', '2020-06-27 11:05:18'),
(390, 'Namibia', 1, '2020-06-27 11:05:18', '2020-06-27 11:05:18'),
(391, 'Nauru', 1, '2020-06-27 11:05:18', '2020-06-27 11:05:18'),
(392, 'Nepal', 1, '2020-06-27 11:05:18', '2020-06-27 11:05:18'),
(393, 'Netherlands Antilles', 1, '2020-06-27 11:05:18', '2020-06-27 11:05:18'),
(394, 'Netherlands, The', 1, '2020-06-27 11:05:18', '2020-06-27 11:05:18'),
(395, 'Nevis', 1, '2020-06-27 11:05:17', '2020-06-27 11:05:17'),
(396, 'New Caledonia', 1, '2020-06-27 11:05:17', '2020-06-27 11:05:17'),
(397, 'New Zealand', 1, '2020-06-27 11:05:17', '2020-06-27 11:05:17'),
(398, 'Nicaragua', 1, '2020-06-27 11:05:17', '2020-06-27 11:05:17'),
(399, 'Niger', 1, '2020-06-27 11:05:17', '2020-06-27 11:05:17'),
(400, 'Nigeria', 1, '2020-06-27 11:05:17', '2020-06-27 11:05:17'),
(401, 'Niue', 1, '2020-06-27 11:05:17', '2020-06-27 11:05:17'),
(402, 'Norway', 1, '2020-06-27 11:05:17', '2020-06-27 11:05:17'),
(403, 'Oman', 1, '2020-06-27 11:05:17', '2020-06-27 11:05:17'),
(404, 'Pakistan', 1, '2020-06-27 11:05:17', '2020-06-27 11:05:17'),
(405, 'Palau', 1, '2020-06-27 11:05:17', '2020-06-27 11:05:17'),
(406, 'Panama', 1, '2020-06-27 11:05:17', '2020-06-27 11:05:17'),
(407, 'Papua New Guinea', 1, '2020-06-27 11:05:17', '2020-06-27 11:05:17'),
(408, 'Paraguay', 1, '2020-06-27 11:05:17', '2020-06-27 11:05:17'),
(409, 'Peru', 1, '2020-06-27 11:05:17', '2020-06-27 11:05:17'),
(410, 'Philippines', 1, '2020-06-27 11:05:17', '2020-06-27 11:05:17'),
(411, 'Poland', 1, '2020-06-27 11:05:17', '2020-06-27 11:05:17'),
(412, 'Portugal', 1, '2020-06-27 11:05:17', '2020-06-27 11:05:17'),
(413, 'Puerto Rico', 1, '2020-06-27 11:05:17', '2020-06-27 11:05:17'),
(414, 'Qatar', 1, '2020-06-27 11:05:17', '2020-06-27 11:05:17'),
(415, 'Reunion', 1, '2020-06-27 11:05:17', '2020-06-27 11:05:17'),
(416, 'Romania', 1, '2020-06-27 11:05:17', '2020-06-27 11:05:17'),
(417, 'Russia', 1, '2020-06-27 11:05:17', '2020-06-27 11:05:17'),
(418, 'Rwanda', 1, '2020-06-27 11:05:17', '2020-06-27 11:05:17'),
(419, 'Saint Helena', 1, '2020-06-27 11:05:16', '2020-06-27 11:05:16'),
(420, 'Saipan', 1, '2020-06-27 11:05:16', '2020-06-27 11:05:16'),
(421, 'Samoa', 1, '2020-06-27 11:05:16', '2020-06-27 11:05:16'),
(422, 'San Marino', 1, '2020-06-27 11:05:16', '2020-06-27 11:05:16'),
(423, 'Sao Tome and Principe', 1, '2020-06-27 11:05:16', '2020-06-27 11:05:16'),
(424, 'Saudi Arabia', 1, '2020-06-27 11:05:16', '2020-06-27 11:05:16'),
(425, 'Senegal', 1, '2020-06-27 11:05:16', '2020-06-27 11:05:16'),
(426, 'Serbia', 1, '2020-06-27 11:05:16', '2020-06-27 11:05:16'),
(427, 'Seychelles', 1, '2020-06-27 11:05:16', '2020-06-27 11:05:16'),
(428, 'Sierra Leone', 1, '2020-06-27 11:05:27', '2020-06-27 11:05:27'),
(429, 'Singapore', 1, '2020-06-27 11:05:27', '2020-06-27 11:05:27'),
(430, 'Slovakia', 1, '2020-06-27 11:05:27', '2020-06-27 11:05:27'),
(431, 'Slovenia', 1, '2020-06-27 11:05:27', '2020-06-27 11:05:27'),
(432, 'Solomon Islands', 1, '2020-06-27 11:05:27', '2020-06-27 11:05:27'),
(433, 'Somalia', 1, '2020-06-27 11:05:27', '2020-06-27 11:05:27'),
(434, 'Somaliland, Rep of (North Somalia)', 1, '2020-06-27 11:05:27', '2020-06-27 11:05:27'),
(435, 'South Sudan', 1, '2020-06-27 11:05:27', '2020-06-27 11:05:27'),
(436, 'Spain', 1, '2020-06-27 11:05:27', '2020-06-27 11:05:27'),
(437, 'Sri Lanka', 1, '2020-06-27 11:05:27', '2020-06-27 11:05:27'),
(438, 'St. Barthelemy', 1, '2020-06-27 11:05:27', '2020-06-27 11:05:27'),
(439, 'St. Eustatius', 1, '2020-06-27 11:05:27', '2020-06-27 11:05:27'),
(440, 'St. Kitts', 1, '2020-06-27 11:05:27', '2020-06-27 11:05:27'),
(441, 'St. Lucia', 1, '2020-06-27 11:05:27', '2020-06-27 11:05:27'),
(442, 'St. Maarten', 1, '2020-06-27 11:05:28', '2020-06-27 11:05:28'),
(443, 'St. Vincent', 1, '2020-06-27 11:05:28', '2020-06-27 11:05:28'),
(444, 'Sudan', 1, '2020-06-27 11:05:28', '2020-06-27 11:05:28'),
(445, 'Suriname', 1, '2020-06-27 11:05:28', '2020-06-27 11:05:28'),
(446, 'Swaziland', 1, '2020-06-27 11:05:28', '2020-06-27 11:05:28'),
(447, 'Sweden', 1, '2020-06-27 11:05:28', '2020-06-27 11:05:28'),
(448, 'Switzerland', 1, '2020-06-27 11:05:28', '2020-06-27 11:05:28'),
(449, 'Syria', 1, '2020-06-27 11:05:28', '2020-06-27 11:05:28'),
(450, 'Tahiti', 1, '2020-06-27 11:05:28', '2020-06-27 11:05:28'),
(451, 'Taiwan', 1, '2020-06-27 11:05:28', '2020-06-27 11:05:28'),
(452, 'Tajikistan', 1, '2020-06-27 11:05:28', '2020-06-27 11:05:28'),
(453, 'Tanzania', 1, '2020-06-27 11:05:28', '2020-06-27 11:05:28'),
(454, 'Thailand', 1, '2020-06-27 11:05:28', '2020-06-27 11:05:28'),
(455, 'Togo', 1, '2020-06-27 11:05:28', '2020-06-27 11:05:28'),
(456, 'Tonga', 1, '2020-06-27 11:05:28', '2020-06-27 11:05:28'),
(457, 'Trinidad and Tobago', 1, '2020-06-27 11:05:28', '2020-06-27 11:05:28'),
(458, 'Tunisia', 1, '2020-06-27 11:05:28', '2020-06-27 11:05:28'),
(459, 'Turkey', 1, '2020-06-27 11:05:28', '2020-06-27 11:05:28'),
(460, 'Turks and Caicos Islands', 1, '2020-06-27 11:05:28', '2020-06-27 11:05:28'),
(461, 'Tuvalu', 1, '2020-06-27 11:05:28', '2020-06-27 11:05:28'),
(462, 'Uganda', 1, '2020-06-27 11:05:28', '2020-06-27 11:05:28'),
(463, 'Ukraine', 1, '2020-06-27 11:05:29', '2020-06-27 11:05:29'),
(464, 'United Arab Emirates', 1, '2020-06-27 11:05:29', '2020-06-27 11:05:29'),
(465, 'United Kingdom', 1, '2020-06-27 11:05:29', '2020-06-27 11:05:29'),
(466, 'Uruguay', 1, '2020-06-27 11:05:29', '2020-06-27 11:05:29'),
(467, 'Uzbekistan', 1, '2020-06-27 11:05:29', '2020-06-27 11:05:29'),
(468, 'Vanuatu', 1, '2020-06-27 11:05:29', '2020-06-27 11:05:29'),
(469, 'Venezuela', 1, '2020-06-27 11:05:29', '2020-06-27 11:05:29'),
(470, 'Vietnam', 1, '2020-06-27 11:05:29', '2020-06-27 11:05:29'),
(471, 'Virgin Islands (British)', 1, '2020-06-27 11:05:29', '2020-06-27 11:05:29'),
(472, 'Virgin Islands (US)', 1, '2020-06-27 11:05:29', '2020-06-27 11:05:29'),
(473, 'Yemen', 1, '2020-06-27 11:05:29', '2020-06-27 11:05:29'),
(474, 'Zambia', 1, '2020-06-27 11:05:29', '2020-06-27 11:05:29'),
(475, 'Zimbabwe', 1, '2020-06-27 11:05:29', '2020-06-27 11:05:29');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `coupon_id` bigint(20) UNSIGNED NOT NULL,
  `coupon_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `coupon_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` double(8,2) NOT NULL,
  `start_price` double(8,2) NOT NULL,
  `end_price` double(8,2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `coupon_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = Active, 0 = Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `enquiry_id` bigint(20) UNSIGNED NOT NULL,
  `enquiry_first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `enquiry_last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `enquiry_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enquiry_phone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enquiry_comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `enquiry_status` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1 = Pending , 2 = Replyed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fabrics`
--

CREATE TABLE `fabrics` (
  `fabric_id` bigint(20) UNSIGNED NOT NULL,
  `fabric_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fabric_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `fabric_order` int(11) DEFAULT 0,
  `fabric_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT ' 1 = Active , 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fabrics`
--

INSERT INTO `fabrics` (`fabric_id`, `fabric_name`, `fabric_slug`, `fabric_order`, `fabric_status`, `created_at`, `updated_at`) VALUES
(56, 'Sagwan', 'sagwan', 0, 1, '2021-05-06 03:23:17', '2021-05-06 03:23:17');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `faq_id` bigint(20) UNSIGNED NOT NULL,
  `faq_question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `faq_answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `faq_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1: Active, 0: Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`faq_id`, `faq_question`, `faq_answer`, `faq_status`, `created_at`, `updated_at`) VALUES
(26, 'Testing the data', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2021-05-08 04:35:30', '2021-05-08 04:35:30'),
(27, 'Testing second data', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2021-05-08 04:35:51', '2021-05-08 04:35:51');

-- --------------------------------------------------------

--
-- Table structure for table `gallary`
--

CREATE TABLE `gallary` (
  `image_id` bigint(20) UNSIGNED NOT NULL,
  `image_title` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Used As Alt text also',
  `gallary_image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gallary_order` int(11) DEFAULT 0,
  `image_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 = Inactive, 1 = Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `homepage_content`
--

CREATE TABLE `homepage_content` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homepage_content`
--

INSERT INTO `homepage_content` (`id`, `title`, `image`, `link`, `created_at`, `updated_at`) VALUES
(1, 'Nehru Jacket', 'nehru-jacket.jpg', 'https://www.bagteshfashion.com', '2020-02-05 18:30:00', '2020-02-04 18:30:00'),
(2, 'Kurta Pyjama', 'kurta-payjama.jpg', 'https://www.bagteshfashion.com', '2020-02-05 18:30:00', '2020-02-04 18:30:00'),
(3, 'Sherwanis', '3.jpg', 'https://www.bagteshfashion.com', '2020-02-05 18:30:00', '2020-02-04 18:30:00'),
(4, 'Mens Suits', 'mens-suit.jpg', 'https://www.bagteshfashion.com', '2020-02-05 18:30:00', '2020-02-04 18:30:00'),
(5, 'Mens Blazer', 'blazer.jpg', 'https://www.bagteshfashion.com', '2020-02-05 18:30:00', '2020-02-04 18:30:00'),
(6, 'Celebrity Styles', 'celebrity-style.jpg', 'https://www.bagteshfashion.com', '2020-02-05 18:30:00', '2020-02-04 18:30:00'),
(7, 'New Arrivals', 'new-arrival.jpg', 'https://www.bagteshfashion.com', '2020-02-05 18:30:00', '2020-02-04 18:30:00'),
(8, 'Traditional Wear', 'traditional.jpg', 'https://www.bagteshfashion.com', '2020-02-05 18:30:00', '2020-02-04 18:30:00'),
(9, 'Designer Lehenga Choli', 'lehnga-choli.jpg', 'https://www.bagteshfashion.com', '2020-02-05 18:30:00', '2020-02-04 18:30:00'),
(10, 'Salwar Kameez', 'salwar-kameez.jpg', 'https://www.bagteshfashion.com', '2020-02-05 18:30:00', '2020-02-04 18:30:00'),
(11, 'Bridal Sarees', 'bridalsaree.jpg', 'https://www.bagteshfashion.com', '2020-02-05 18:30:00', '2020-02-04 18:30:00'),
(12, 'Bridal Lehenga Choli', 'bridallehnga.jpg', 'https://www.bagteshfashion.com', '2020-02-05 18:30:00', '2020-02-04 18:30:00'),
(13, 'Lehenga Collection', 'lehnga-collection.jpg', 'https://www.bagteshfashion.com', '2020-02-05 18:30:00', '2020-02-04 18:30:00'),
(14, 'Saree Collection', 'saree-collection.jpg', 'https://www.bagteshfashion.com', '2020-02-05 18:30:00', '2020-02-04 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `master_pages`
--

CREATE TABLE `master_pages` (
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `page_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `page_short_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_long_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_meta_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_meta_keyword` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1:Active, 0:Inactive',
  `description_flag` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: No need of description, 1: Description needed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image_flag` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1: Has Image, 0: No Image'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_pages`
--

INSERT INTO `master_pages` (`page_id`, `page_name`, `page_slug`, `page_short_description`, `page_long_description`, `image_name`, `page_meta_title`, `page_meta_keyword`, `page_meta_description`, `page_status`, `description_flag`, `created_at`, `updated_at`, `image_flag`) VALUES
(1, 'Home', 'home', NULL, '<div style=\"text-align: start;\"><span style=\"line-height: 14px; text-align: justify; font-family: Arial, Helvetica, sans; font-size: 11px;\">Welcome to Bagtesh Fashion online Designer, Manufacturers, Exporters and wholesaler Webstore offering a wide range of Indian ethnic wears like as Jodhpuri suit, Tuxedos, Jodhpurs Riding Breeches, Nehru jacket, Wedding sherwani, Indo western, Rajasthani Turbans and Mojadi are ship to all over the world.</span><span style=\"line-height: 14px; text-align: justify; font-family: Arial, Helvetica, sans; font-size: 11px;\"><br />\r\n</span></div>', '', 'Buy Jodhpuri Suit, Mens Tuxedo, Nehru Jacket, Sherwani, Baggy Breeches, Turban, Mojari, Saree, Lehenga, Suits', 'Wedding Tuxedo, Latest Jodhpuri Suit, Nehru Collar Jacket, Sherwanis, Men Blazer, Riding Jodhpurs Breeches, Safari Shirts, Wedding Turban Mojadi and Bridal Sarees, Wedding Lehengas, Salwar kameez Online Shop - Bagtesh Fashion', 'Buy Indian Wedding Jodhpuri Groom Suits, Indowestern Sherwani, Equestrian Jodphur Breeches, Nehru waistcoat, Men Party Tuxedos, Cotton Shirt, Turbans, Wedding Mojari and Exclusive Collection of Indian Sarees, Bridal Lehenga Choli, Eid Salwar Kameez Online from Bagtesh Fashion', 1, 1, '2020-02-29 05:58:26', '2020-02-29 05:58:26', 0),
(2, 'About Us', 'about-us', '', '<h1>About Bagtesh Fashion </h1>\r\n        <p class=\"common_description\">Bagtesh Fashion is in ecommerce business worldwide since 2015, under the same\r\n          ownership. Your satisfaction is the highest priority at the Bagtesh Fashion, Our engaging workplace is based\r\n          on teamwork, growth, and respect, with a culture built on these guiding principles. We\'ve been able to make\r\n          good on that promise thanks to the world class customer service delivered each and every day by express\r\n          shipping so most orders reach the customer within 4 - 7 days. A completely home grown fashion brand, Bagtesh\r\n          Fashion enjoys a vast international customer base.</p>\r\n        <p class=\"common_description\"> Largest online lifestyle brand operating across the categories of Wedding\r\n          Clothing’s, Designer Apparels, Horse Riding Jodhpurs, Accessories, etc .</p>\r\n        <h1> Offered for sale:- </h1>\r\n        <ul>\r\n          <li> Our Wedding collection for grooms include designer men tuxedo, jodhpuri suit, designer sherwanis,\r\n            Indo-western suits, wedding kurta pyjamas, etc.</li>\r\n          <li> Wedding collection for brides include bridal sarees, designer lehenga choli, lehenga style sarees, In\r\n            vogue sarees, silk sarees, Party Wear Sarees, Wedding Gawns and Suits etc.</li>\r\n          <li> For bridesmaid and family, our collection includes lehenga choli, long choli lehenga, lehengas, sarees,\r\n            Salwar suit, Pyjama, Wedding Shoes etc.</li>\r\n          <li>For horse riding equestrian clothing include Breeches, Jodhpurs, Polo pants, Baggy breeches, etc.</li>\r\n          <li> Our other collection of Indian wear include Grooms Turbans, Wedding Mojari, Party sarees, Bollywood\r\n            Replica Outfits, Anarkali suits, tunics, Patialas, salwars, kurtis ... the list is endless.</li>\r\n        </ul>', 'about.jpg', '', 'About Us', '', 1, 1, '2020-02-29 05:58:26', '2020-04-02 09:01:35', 1),
(3, 'Privacy', 'privacy', NULL, '<ul>\r\n          <li> We respect your privacy and are committed to protect your private information. When you shop on\r\n            www.bagteshfashion.com, we will ask you to give your personal information such as your name, e-mail address,\r\n            billing address, shipping address, telephone/mobile number and product selections etc. We will use your\r\n            information on a voluntary basis for place an order or subscribe to newsletter. </li>\r\n          <li> We may collect this information even if you do not register with us. None of this data is of a personal\r\n            nature and will help us improve the quality of our service. </li>\r\n          <li>We do not store any credit card details of the client on our servers. After a transaction, your private\r\n            information (credit cards, social security numbers, financials, etc.) will not be stored on our servers.\r\n          </li>\r\n          <li> If there are any questions regarding this privacy policy you may contact us using the information below.\r\n          </li>\r\n        </ul>', '', ' Privacy', ' Privacy', ' Privacy', 1, 1, '2020-02-29 05:58:26', '2020-02-29 05:58:26', 0),
(4, 'How to Order', 'how-to-order', NULL, '<h1>Please Follow this steps: </h1>\r\n        <h5>Step 1</h5>\r\n        <p>Visit the link of the product you are interested in purchasing.</p>\r\n        <p>Then select the quantity to order.</p>\r\n\r\n        <h5>Step 2</h5>\r\n        <p>Please choose any one option in Standard Size or Custom Measurement.</p>\r\n        <p>Standard Size:- Select your size according our size chart.</p>\r\n        <p>Custom Measurement:- click on check box then also click Submit size button, after you will get a measurement form, Please fill your measurements in form and click to save and close popup box.</p>\r\n\r\n        <h5>Step 3</h5>\r\n        <p>Click on \"Add to Cart\" button</p>\r\n        <p>You can also continue shopping by Clicking \"Continue Shopping\" button if you still wish to add more products</p>\r\n        <p>Click on \'Proceed to Checkout\' button.</p>\r\n\r\n        <h5>Step 4</h5>\r\n        <p>You will be asked to login with your email-id if you already have registered with Bagtesh Fashion before.</p>\r\n        <p>Please login and New customer will be Register.</p>\r\n\r\n        <h5>Step 5</h5>\r\n        <p>If you want to do shipping address change please click/unclick for Shipping Billing Address or contact address.</p>\r\n        <p>Click the Continue button to proceed to Payment.</p>', '', 'How to Order', 'How to Order', 'How To Buy', 1, 1, '2020-02-29 05:58:26', '2020-02-29 05:58:26', 0),
(5, 'Terms For Sale', 'terms-for-sale', NULL, 'Terms for sale', '', 'Terms for sale', 'Terms for sale', 'Terms for sale', 1, 0, '2020-02-29 05:58:26', '2020-02-29 05:58:26', 0),
(6, 'Shipment', 'shipment', NULL, '<ul>\r\n          <li> We deliver to all and any postal address around the world. You will be able to see shipping charges at\r\n            the final checkout page for the item</li>\r\n          <li> Our courier agents DHL, DTDC, FEDEX, UPS, SpeedPost etc . </li>\r\n          <li>Free shipping to any address in India. In India, we use couriers like Blue Dart, Frist Flight ,etc to ship\r\n            the products that are completely insured and reliable. </li>\r\n          <li> Courier companies do not deliver to P.O.Box address, so we request you to provide full street address\r\n            with pin code / zip code. </li>\r\n          <li>All orders are shipped by 1st class air courier services and home delivered within approximately 7-15\r\n            working days after dispatch of the shipment.</li>\r\n          <li>Custom duties and other levies in destination country are responsibility of the customer. Bagtesh Fashion\r\n            will not pay any type of taxes and duties in respective countries of the customer.</li>\r\n        </ul>\r\n        <h5>Address change requests :</h5>\r\n        <p>Once an order is registered, you cannot make any alterations. You may send your alteration request to\r\n          info@bagteshfashion.com and the needful will be done.</p>', '', ' Shipment', ' Shipment', ' Shipment', 1, 1, '2020-02-29 05:58:26', '2020-02-29 05:58:26', 0),
(7, 'Why People Prefer Us?', 'why-people-prefer-us?', NULL, 'Why People Prefer Us?', '', 'Why People Prefer Us?', 'Why People Prefer Us?', 'Why People Prefer Us?', 1, 1, '2020-02-29 05:58:26', '2020-02-29 05:58:26', 0),
(9, 'Disclaimer', 'disclaimer', NULL, '<ul>\r\n          <li> The product image is for reference purpose only. </li>\r\n          <li> Saree, Lehenga choli and salwar kameez product will be un-stitched. </li>\r\n          <li>All workmanship, beads, jardozi are not real. For any real workmanship such as real gold, real silver,\r\n            diamonds, swarovski etc unless specified real under the product description, these are artificial. </li>\r\n          <li> There might be slight variation in the color of the product due to digital photography and different\r\n            computer resolutions. </li>\r\n        </ul>', '', 'Disclaimer', 'Disclaimer', 'Disclaimer', 1, 1, '2020-02-29 05:58:26', '2020-02-29 05:58:26', 0),
(10, 'Achievements', 'achievements', NULL, 'Achievements', '', 'Achievements', 'Achievements', 'Achievements', 1, 0, '2020-02-29 05:58:26', '2020-02-29 05:58:26', 0),
(11, 'Terms of Use', 'terms-of-use', NULL, '<ul>\r\n          <li>\r\n            Customers must provide full, accurate, and legible information in\r\n            the order form. Telephone number and zip code are must if you are\r\n            going to place an order.\r\n          </li>\r\n          <li>\r\n            Bagteshfashion.com deliver the products to our customer within 10\r\n            business days of purchase in India and 21 days in all over world.\r\n            However, in case of any unavoidable circumstances, the customers\r\n            would be duly informed.\r\n          </li>\r\n          <li>Designs and price are subject to change without notice.</li>\r\n          <li>\r\n            When your order is shipped, BagteshFashion.com will send you a\r\n            shipment confirmation email with the shipping tracking number, By\r\n            tracking number, you can check the detailed delivery status of your\r\n            order.\r\n          </li>\r\n          <li>\r\n            BagteshFashion.com will not be responsible for wrong delivery due to\r\n            incorrect and/or incomplete address supplied by the customer.\r\n          </li>\r\n          <li>\r\n            In the feedback area or through any email feature send me with\r\n            reviews, comments, feedback, postcards, suggestions, ideas, and\r\n            other submissions submit. We will protect Your Information in\r\n            accordance with our Privacy Policy.\r\n          </li>\r\n          <li>\r\n            BagteshFashion.com has made every effort to display as accurately as\r\n            possible the colours of our products that appear on the Site.\r\n            Further, BagteshFashion.com has ensured that the measurements,\r\n            information and description for products furnished on the site are\r\n            best calculated and stated to accuracy and true to its dimensions.\r\n            However, due to the inherent characteristics of certain materials,\r\n            actual measurements of individual items might vary slightly. Slight\r\n            marks and colour / print variations should not be considered as a\r\n            fault, but they are inherent characteristics of the product.\r\n          </li>\r\n          <li>\r\n            BagteshFashion.com reserve the right, at our sole discretion, to\r\n            refuse or cancel any order for any reason. Some situations that may\r\n            result in your order being canceled include limitations on\r\n            quantities available for purchase, inaccuracies or errors in product\r\n            or pricing information, or problems identified by our credit and\r\n            fraud avoidance department. We may also require additional\r\n            verifications or information before accepting any order. We will\r\n            contact you if all or any portion of your order is canceled or if\r\n            additional information is required to accept your order. If your\r\n            order is cancelled after your credit card has been charged, the said\r\n            amount will be reversed back in your Card Account.\r\n          </li>\r\n          <li>\r\n            We cannot ship any real gold and silver jewellery items for any\r\n            other counrty. You will get only artificial jewellery.\r\n          </li>\r\n          <li>\r\n            This Agreement and the relationship between you and\r\n            BagteshFashion.com will be governed by the laws as applicable in\r\n            India. Any disputes will be handled in the competent courts of\r\n            Jodhpur, India.\r\n          </li>\r\n          <li>\r\n            This Site may contain links to other sites on the Internet that are\r\n            owned and operated by third parties. You acknowledge\r\n            BagteshFashion.com is not responsible for the operation of or\r\n            content located on or through any such site.\r\n          </li>\r\n        </ul>', '', 'Terms of Use', 'Terms of Use', 'Terms of Use', 1, 1, '2020-02-29 05:58:26', '2020-02-29 05:58:26', 0),
(12, 'Privacy Policy', 'privacy-policy', NULL, '<ul>\r\n          <li> We respect your privacy and are committed to protect your private information. When you shop on\r\n            www.bagteshfashion.com, we will ask you to give your personal information such as your name, e-mail address,\r\n            billing address, shipping address, telephone/mobile number and product selections etc. We will use your\r\n            information on a voluntary basis for place an order or subscribe to newsletter. </li>\r\n          <li> We may collect this information even if you do not register with us. None of this data is of a personal\r\n            nature and will help us improve the quality of our service. </li>\r\n          <li>We do not store any credit card details of the client on our servers. After a transaction, your private\r\n            information (credit cards, social security numbers, financials, etc.) will not be stored on our servers.\r\n          </li>\r\n          <li> If there are any questions regarding this privacy policy you may contact us using the information below.\r\n          </li>\r\n        </ul>', '', 'Privacy Policy', 'Privacy Policy', 'Privacy Policy', 1, 1, '2020-02-29 05:58:26', '2020-02-29 05:58:26', 0),
(13, 'Return Policy', 'return-policy', NULL, '<p>We have a customer friendly return policy - we will refund you the full amount. However, return shipping cost\r\n          is incurred by the buyer. It should be return to us within 15 days from the date you received the item.</p>\r\n        <h5>Note:</h5>\r\n        <ul>\r\n          <li> If the product is sent back to us without our consent, return/exchange will not be accepted.</li>\r\n          <li> As a policy, we do not offer returns or exchanges on products which are delivered in perfect condition as\r\n            per the order placed. </li>\r\n          <li>Jewellery and Handicrafts Accessories items cannot be returned. </li>\r\n          <li> No returns/refund/exchange will be accepted for customized/stitched products. </li>\r\n          <li>In the unlikely event that your merchandise arrives damaged / manufacturing defect / damaged during\r\n            transportation / Wrong product delivered, you should email us a photo of the same product. You must email us\r\n            at info@bagteshfashion.com within 2 days of receiving your order.</li>\r\n          <li>In case you have ordered the wrong size, we can offer to alter it without a charge. However, shipping\r\n            charges will be borne by the customer. </li>\r\n          <li>We would request you to send us mail for any return request on :- info@bagteshfashion.com with the below\r\n            mentioned details :- <ul class=\"pt-3\">\r\n              <li>Order Number</li>\r\n              <li>Product code </li>\r\n              <li>Reason for returning the product</li>\r\n              <li>Photo of the product which you intend to deliver back to us</li>\r\n            </ul>\r\n          </li>\r\n          <li> No refunds would be given if the customer has provided wrong or incomplete shipping address or the\r\n            package is refused by the recipient.</li>\r\n        </ul>\r\n        <h5> Cancellations Policy:</h5>\r\n        <ul>\r\n          <li>We cannot cancel orders after 24 hours.</li>\r\n          <li>If your order is cancelled after your credit card has been charged, the said amount will be reversed back\r\n            in your Card Account.</li>\r\n        </ul>', '', 'Return Policy', 'Return Policy', 'Return Policy', 1, 1, '2020-02-29 05:58:26', '2020-02-29 05:58:26', 0),
(14, 'Testimonials', 'testimonials', NULL, NULL, '', 'Testimonials', 'Testimonials', 'Testimonials', 1, 0, '2020-02-29 05:58:26', '2020-02-29 05:58:26', 0),
(15, 'Our Store', 'our-store', NULL, 'Our Store', '', 'Our Store', 'Our Store', 'Our Store', 1, 0, '2020-02-29 05:58:26', '2020-02-29 05:58:26', 0),
(17, 'Blouse design', 'blouse-design', NULL, 'Blouse design', '', 'Blouse design', 'Blouse design', 'Blouse design', 1, 0, '2020-02-29 05:58:26', '2020-02-29 05:58:26', 0),
(18, 'Shoppers gallery', 'shoppers-gallery', NULL, 'Shoppers-gallery', '', 'Shoppers-gallery', 'Shoppers-gallery', 'Shoppers-gallery', 1, 0, '2020-02-29 05:58:26', '2020-02-29 05:58:26', 0),
(19, 'Contact Us', 'contact-us', NULL, '<p>You may contact our customer care for anything pertaining to Bagtesh Fashion. Our customer care support help\r\n          customer for:</p>\r\n        <ul>\r\n          <li> <i data-feather=\"chevron-right\"></i>Order Related Queries </li>\r\n          <li><i data-feather=\"chevron-right\"></i>Password Related Queries</li>\r\n          <li><i data-feather=\"chevron-right\"></i>Delivery Related Queries</li>\r\n          <li><i data-feather=\"chevron-right\"></i>Product Related Queries</li>\r\n          <li><i data-feather=\"chevron-right\"></i>Login Related Queries</li>\r\n          <li> <i data-feather=\"chevron-right\"></i>Payment Related Queries</li>\r\n        </ul>\r\n        <p>Anything that the customer may clarify about Bagtesh Fashion.</p>', '', 'Contact Us', 'Contact Us', 'Contact Us', 1, 1, '2020-02-29 05:58:26', '2020-02-29 05:58:26', 0),
(20, 'Faq', 'faq', NULL, NULL, '', 'Faq', 'Faq', 'Q: From where can I log in to My Account?\r\n\r\nA: On our home page at the top right corner you will see the option of \"Sign In / Register\". Click on it and you will be guided \r\n\r\nto the \"log in\" page.\r\n\r\nQ: I am unable to log in to My Account. Please help.\r\n\r\nA: Please take a screen shot of the error message and send it across through an email. We will look into the issue.\r\n\r\nQ: How do I place an order?\r\n\r\nA: You may follow the following steps to place an order:\r\n   1) Select the desirable item (as fabric or as customizable)\r\n   2) Add the item to Shopping cart\r\n   3) Click Proceed to checkout option\r\n   4) Login with your account details or proceed as guest\r\n   5) Enter the shipping address and select a payment mode to proceed with the payment.\r\n   6) Click Place order and complete the payment.\r\n   7) On successful order placement the Order ID will be generated.\r\n\r\n\r\nQ: How will I send you my measurement?\r\n\r\nA: We will send you a measurement form to fill your details, after you confirm your order with us.\r\n\r\nQ: In what time I can cancel my order?\r\n\r\nA: You can cancel your order within 24 hours, after that your order will not be cancelled.\r\n\r\n\r\nQ: How do I know that my order has been dispatched?\r\n\r\nA: We always send an e-mail with all the tracking details, so that the customers can track their shipment on their own.\r\n\r\n\r\nQ: What is the estimated delivery time? \r\n\r\nA: Regarding shipment time we can send you in 11 days from the receipt of payment in our account otherwise in normal way it takes \r\n\r\n21 days to reach at your doorsteps. Charges for shipment will vary.\r\n\r\nQ: Do you Offer Free Shipping?\r\n\r\nA: Currently we are offering Free Shipping in India Only. However we are continuously working with our shipping partners to \r\n\r\nreduce the International shipping and logistics costs so that we can offer lower shipping charge to you.\r\n\r\nQ: What currency are your prices in?\r\n\r\nA: All our prices are in US $.  If you would like to convert the currency from USD to another currency here is a link to a site \r\n\r\nthat allows you to convert the prices easily. http://www.xe.com/currencyconverter/\r\n\r\n\r\nQ: My credit card was declined and I know there is enough money in the account.\r\n\r\nA: This happens occasionally and does not reflect your credit status. It is sometimes a problem with a bank which has safety \r\n\r\nrestrictions in place regarding foreign online transactions. In our experience, the owner of the card is not aware of these until \r\n\r\nit happens. I would check that out with my bank if I were you. A phone call usually fixes it.', 1, 0, '2020-02-29 05:58:26', '2020-02-29 05:58:26', 0),
(21, 'Site Map', 'sitemap', NULL, 'Site Map', '', 'Site Map', 'Site Map', 'Site Map', 1, 0, '2020-02-29 05:58:26', '2020-02-29 05:58:26', 0),
(22, 'Order history', 'order history', NULL, 'Order history', '', 'Order history', 'Order history', 'Order history', 1, 0, '2020-02-29 05:58:26', '2020-02-29 05:58:26', 0),
(23, 'Wish list', 'wish list', NULL, 'Wish list', '', 'Wish list', 'Order history', 'Wish list', 1, 0, '2020-02-29 05:58:26', '2020-02-29 05:58:26', 0),
(24, 'Bagtesh cart', 'bagetesh cart', NULL, 'Bagtesh cart', '', 'Bagtesh cart', 'Bagtesh cart', 'Bagtesh cart', 1, 0, '2020-02-29 05:58:26', '2020-02-29 05:58:26', 0),
(26, 'My Dashboard', 'my-dashboard', NULL, 'My Dashboard', '', 'My Dashboard', 'My Dashboard', 'My Dashboard', 1, 0, '2020-02-29 05:58:26', '2020-02-29 05:58:26', 0),
(27, 'New', 'new', NULL, 'New', '', 'New Arrivals Indian Wedding Outfits and Accessories Collection', 'New collection of sarees, latest lehengas, new arrival salwar kameez, new arrival outfits, new arrival sherwani, latest jodhpuri suits pattern, latest breeches, latest nehru jacket and lestest wedding accessories\r\n', 'New collection of sarees, latest lehengas, new arrival salwar kameez, new arrival outfits, new arrival sherwani, latest jodhpuri suits pattern, latest breeches, latest nehru jacket and lestest wedding accessories\r\n', 1, 0, '2020-02-29 05:58:26', '2020-02-29 05:58:26', 0),
(28, 'Sale', 'sale', NULL, 'Sale', '', 'Discount Sale And Offers on Indian Outfits', 'Saree sale, Lehengas sale, Salwar kameez sale, Menswear sale, Indian Wedding Dresses sale, Mens suits sale, Jacket sale, Trousers sale, Turbans sale, Mojari sale', 'Saree sale, Lehengas sale, Salwar kameez sale, Menswear sale, Indian Wedding Dresses sale, Mens suits sale, Jacket sale, Trousers sale, Turbans sale, Mojari sale', 1, 0, '2020-02-29 05:58:26', '2020-02-29 05:58:26', 0),
(29, 'Login', 'login', NULL, NULL, '', 'Login', 'Login', 'Login', 1, 0, '2020-02-29 05:58:26', '2020-02-29 05:58:26', 0),
(30, 'Register', 'register', NULL, NULL, '', 'Register', 'Register', 'Register', 1, 0, '2020-02-29 05:58:26', '2020-02-29 05:58:26', 0),
(32, 'Forgot password', 'forgot-password', NULL, NULL, '', 'Forgot password', 'Forgot password', 'Forgot password', 1, 0, '2020-02-29 05:58:27', '2020-02-29 05:58:27', 0),
(33, 'Check out', 'check-out', NULL, NULL, '', 'Check out', 'Check out', 'Check out', 1, 0, '2020-02-29 05:58:27', '2020-02-29 05:58:27', 0),
(34, 'Thank You', 'thank-you', NULL, NULL, '', 'Thank You', 'Thank You', 'Thank You', 1, 0, '2020-02-29 05:58:27', '2020-02-29 05:58:27', 0),
(35, 'Trending', 'trending', NULL, 'Trending', '', 'Trending Indian Wedding Outfits and Accessories Collection', 'New collection of sarees, latest lehengas, new arrival salwar kameez, new arrival outfits, new arrival sherwani, latest jodhpuri suits pattern, latest breeches, latest nehru jacket and lestest wedding accessories\r\n', 'New collection of sarees, latest lehengas, new arrival salwar kameez, new arrival outfits, new arrival sherwani, latest jodhpuri suits pattern, latest breeches, latest nehru jacket and lestest wedding accessories\r\n', 1, 0, '2020-02-29 05:58:26', '2020-02-29 05:58:26', 0);

-- --------------------------------------------------------

--
-- Table structure for table `measurements`
--

CREATE TABLE `measurements` (
  `measurement_id` bigint(20) UNSIGNED NOT NULL,
  `measurement_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `measurement_price` double(8,2) NOT NULL,
  `measurement_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `measurement_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `measurement_chart` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `measurement_order` int(11) DEFAULT 0,
  `measurement_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = Active , 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `detail_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `measurement_details`
--

CREATE TABLE `measurement_details` (
  `measurement_detail_id` bigint(20) UNSIGNED NOT NULL,
  `measurement_id` bigint(20) UNSIGNED NOT NULL,
  `measurement_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `details_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = Active, 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_05_08_064810_create_categories_table', 1),
(9, '2019_05_08_082133_create_products_table', 1),
(10, '2019_05_08_085540_create_product_images_table', 1),
(11, '2019_05_08_090909_create_product_carts_table', 1),
(12, '2019_05_08_092126_create_product_orders_table', 1),
(13, '2019_05_08_095502_create_user_whish_lists_table', 1),
(14, '2019_05_08_100313_create_banners_table', 2),
(15, '2019_05_08_114418_create_product_order_details_table', 2),
(16, '2019_05_09_045803_create_master_pages_table', 2),
(17, '2019_05_11_062121_create_api_tokens_table', 2),
(18, '2019_05_14_094450_create_admin_users_table', 2),
(19, '2019_05_31_095049_createaccountsetting', 2),
(20, '2019_06_04_045725_add_field_banner', 2),
(21, '2019_06_10_090752_create_notification', 2),
(22, '2019_06_22_062838_add_field_category', 2),
(23, '2019_06_22_070540_add_field_order_details', 2),
(24, '2020_01_22_035141_add_category_desc_to_categories', 2),
(25, '2020_01_23_125338_create_color_table', 2),
(26, '2020_01_24_075728_add_color_status_to_colors', 2),
(27, '2020_01_24_103833_add_category_subroot_id_to_category', 2),
(28, '2020_01_24_111446_add_size_chart_to_categories', 2),
(29, '2020_01_25_061758_add_columns_to_categories', 2),
(31, '2020_01_27_101434_create_febrics_table', 3),
(32, '2020_01_27_105925_add_febric_status_to_febrics', 3),
(33, '2020_01_27_111205_add_category_order_to_categories', 3),
(34, '2020_01_27_111234_add_category_order_to_colors', 3),
(35, '2020_01_27_111250_add_category_order_to_febrics', 3),
(36, '2020_01_28_111212_create_occasion_table', 3),
(37, '2020_01_28_122405_create_sizes_table', 3),
(38, '2020_01_29_073435_create_accessories_table', 3),
(39, '2020_01_29_104401_create_measurements_table', 3),
(40, '2020_01_30_075624_add_cols_to_measurements', 3),
(41, '2020_01_30_103031_create_measurement_details_table', 3),
(42, '2020_01_31_101518_create_blouse_designs_table', 3),
(43, '2020_01_31_101657_create_orders_table', 3),
(44, '2020_01_31_101746_create_gallary_table', 3),
(45, '2020_01_31_101831_create_shipping_charges_table', 3),
(46, '2020_01_31_102008_create_saree_measurements_table', 3),
(47, '2020_01_31_102024_create_salwar_measurements_table', 3),
(48, '2020_01_31_102042_create_slider_images_table', 3),
(49, '2020_01_31_102144_create_enquiries_table', 3),
(50, '2020_01_31_102227_create_countries_table', 3),
(51, '2020_01_31_102321_create_social_urls_table', 3),
(52, '2020_01_31_102404_create_news_letters_table', 3),
(53, '2020_02_13_131842_create_top_salwar_measurements_table', 3),
(54, '2020_02_13_132031_create_bottom_salwar_measurements_table', 3),
(55, '2020_02_13_135238_add_salwar_description_to_salwar_measurements', 3),
(56, '2020_02_18_163548_create_coupans_table', 3),
(57, '2020_02_18_182408_add_coupan_status_to_coupans', 3),
(58, '2020_02_21_162850_add_zip_code_to_users', 3),
(59, '2020_02_22_162129_add_image_flag_to_master_pages', 3),
(60, '2020_02_25_141206_add_slug_to_categories', 3),
(61, '2020_02_25_151315_create_faqs_table', 3),
(62, '2020_02_25_152200_create_testimonials_table', 3),
(63, '2020_01_27_101434_create_fabrics_table', 4),
(67, '2020_02_27_152131_modifty_users_table', 5),
(68, '2020_02_27_173225_create_slider_table', 6),
(69, '2020_02_27_175757_modifty_color_table', 7),
(70, '2020_02_28_101924_modifty_enquiry_table', 8),
(71, '2020_02_28_110701_create_product_enquiry_table', 9),
(72, '2020_02_28_111851_modifty_accountsetting_table', 10),
(73, '2020_02_28_133306_modify_size_table', 11),
(75, '2020_02_28_133325_modify_testimonial_table', 12),
(77, '2020_02_28_154732_modify_categroies_table', 13),
(78, '2020_02_28_191845_modifty_masterpage_table', 14),
(80, '2020_02_29_122331_modifty_cart_table', 15),
(81, '2020_02_29_124317_modifty_coupon_table', 15),
(82, '2020_02_29_131043_create_homepage_content_table', 16),
(83, '2020_02_29_150612_modifty_topsalwar_table', 17),
(84, '2020_02_29_150621_modifty_bottomsalwar_table', 17),
(85, '2020_02_29_164222_modifty_product_table', 18),
(86, '2020_02_29_164238_create_productcategory_table', 18),
(87, '2020_02_29_164330_modifty_productimages_table', 18),
(88, '2020_02_29_164346_create_productcolor_table', 18),
(89, '2020_02_29_164355_create_productfabric_table', 18),
(90, '2020_02_29_164403_create_productoccasion_table', 18),
(91, '2020_02_29_164412_create_productsize_table', 18),
(92, '2020_02_29_164432_create_productaccessories_table', 18),
(93, '2020_03_03_192533_modifty_user_table', 19),
(94, '2020_03_04_154922_modifty_user_table', 20),
(96, '2020_03_04_180813_modifty_testimonial_table', 21),
(97, '2020_02_18_163548_create_coupons_table', 22),
(98, '2020_03_16_161555_modify_product_order_types', 22),
(99, '2020_03_23_151334_add_soft_delete_to_product_orders_table', 23),
(100, '2020_03_26_153450_edit_order_table', 24),
(101, '2020_03_26_160543_modify_orderdetails_table', 24),
(102, '2020_03_28_104112_create_reviews_table', 25),
(103, '2020_03_30_140236_modify_color_table', 26),
(104, '2020_03_30_141725_modify_fabric_table', 27),
(105, '2020_03_30_141743_modify_occasion_table', 27),
(106, '2020_03_31_114401_modify_product_table', 28),
(107, '2020_04_02_202801_modify_orderdetails_table', 29),
(108, '2020_04_03_112247_modify_orderdetails_table', 30),
(109, '2020_04_02_144158_add_desc_flag_to_master_pages', 31),
(110, '2020_04_15_205022_create_transaction_table', 31),
(111, '2020_04_20_161929_modify_cart_table', 32),
(112, '2020_04_21_135454_modify_orderdetails_table', 33),
(113, '2020_04_21_180800_create_app_jobs_table', 34),
(114, '2020_04_21_185034_create_app_failed_jobs_table', 35);

-- --------------------------------------------------------

--
-- Table structure for table `news_letters`
--

CREATE TABLE `news_letters` (
  `news_letter_id` bigint(20) UNSIGNED NOT NULL,
  `news_letter_email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `news_letter_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = Active , 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news_letters`
--

INSERT INTO `news_letters` (`news_letter_id`, `news_letter_email`, `news_letter_status`, `created_at`, `updated_at`) VALUES
(24, 'swami@wscubetech.com', 1, '2021-05-08 03:40:12', '2021-05-08 03:40:12'),
(25, 'swami.v2r@gmail.com', 1, '2021-05-08 03:40:22', '2021-05-08 03:40:22'),
(26, 'bhagirath.wscube@gmail.com', 1, '2021-05-08 03:41:40', '2021-05-08 03:41:40'),
(27, 'bhagirath.wsucbe@gmail.com', 1, '2021-05-08 03:44:16', '2021-05-08 03:44:16'),
(28, 'bhagirath123@gmail.com', 1, '2021-05-08 03:45:33', '2021-05-08 03:45:33'),
(29, 'admin@gmail.com', 1, '2021-05-08 04:07:59', '2021-05-08 04:07:59'),
(30, 'giribhagirath169@gmail.com', 1, '2021-05-08 04:11:38', '2021-05-08 04:11:38'),
(31, 'testing@gmail.com', 1, '2021-05-09 16:00:43', '2021-05-09 16:00:43');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL DEFAULT 0,
  `product_id` bigint(20) NOT NULL DEFAULT 0,
  `product_order_id` bigint(20) NOT NULL DEFAULT 0,
  `notification_type` bigint(20) NOT NULL COMMENT '1:Top Deals, 2:Order Placed, 3:Order Completed, 4:Order Cancelled, 5:Order Failed, 6:Order Return',
  `notification_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Bagtesh Fashion Personal Access Client', '92k6Dkwe6IVAiTjE2qVxcos6EuwZCG1Xyl60A0xD', 'http://localhost', 1, 0, 0, '2020-03-02 12:05:18', '2020-03-02 12:05:18'),
(2, NULL, 'Bagtesh Fashion Password Grant Client', 'aNzCd6TFyUpnGsmfybTDK1EF1dVxT2WDOt6Esjqq', 'http://localhost', 0, 1, 0, '2020-03-02 12:05:18', '2020-03-02 12:05:18'),
(3, NULL, 'Bagtesh Fashion Personal Access Client', 'qZutXvrJS1fQm9VlsX3YBXAJ9uLGI7lKTfcsT3w5', 'http://localhost', 1, 0, 0, '2020-03-02 12:30:01', '2020-03-02 12:30:01'),
(4, NULL, 'Bagtesh Fashion Password Grant Client', 'ic4rx6788ksuWYKtjMLowctTchsuN042A2BZjA7Q', 'http://localhost', 0, 1, 0, '2020-03-02 12:30:01', '2020-03-02 12:30:01');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-03-02 12:05:18', '2020-03-02 12:05:18'),
(2, 3, '2020-03-02 12:30:01', '2020-03-02 12:30:01');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `occasions`
--

CREATE TABLE `occasions` (
  `occasion_id` bigint(20) UNSIGNED NOT NULL,
  `occasion_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `occasion_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `occasion_order` int(11) NOT NULL DEFAULT 0,
  `occasion_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = Actice , 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `order_user_id` bigint(20) UNSIGNED NOT NULL,
  `order_product_id` bigint(20) UNSIGNED NOT NULL,
  `order_quantity` tinyint(4) NOT NULL,
  `order_status` tinyint(4) NOT NULL COMMENT '1 = Progress , 2 = Shipped , 3 = Completed',
  `ordered_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('lipika.mangla.web@gmail.com', '$2y$10$FyoKOKqOhBuV/XRts/5pT.0X1MNTJ5aR56zyGEV6RdSV8dqahIKYO', '2021-01-24 00:39:17'),
('giribhagirath169@gmail.com', '$2y$10$b9Xv9TvSEaDy6kFWP0VWUOUFFCfvpwaZwDz5yrYkIz5hTH7mP4FWa', '2021-05-18 20:10:51');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `product_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `hot_seller` int(11) DEFAULT NULL COMMENT '0 - No, 1 - Yes',
  `measurement_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_price` decimal(8,2) NOT NULL,
  `product_discounted_price` decimal(8,2) DEFAULT 0.00,
  `product_discount_percent` decimal(8,2) DEFAULT NULL,
  `product_categories` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Multiple ids of category',
  `product_colors` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT 'Multiple ids of color',
  `product_fabrics` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT 'Multiple ids of fabric',
  `product_occasions` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT 'Multiple ids of occasions',
  `product_sizes` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT 'Multiple ids of sizes',
  `product_accessories` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT 'Multiple ids of accesories',
  `product_weight` double DEFAULT NULL,
  `product_timetoship` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `product_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_views` int(11) NOT NULL DEFAULT 0 COMMENT 'Total Views',
  `product_image_small` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `product_order` int(11) NOT NULL DEFAULT 0,
  `product_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:Active, 0:Inactive',
  `out_of_stock` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1:Yes, 2:No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_code`, `product_name`, `product_slug`, `hot_seller`, `measurement_id`, `product_price`, `product_discounted_price`, `product_discount_percent`, `product_categories`, `product_colors`, `product_fabrics`, `product_occasions`, `product_sizes`, `product_accessories`, `product_weight`, `product_timetoship`, `product_description`, `product_notes`, `product_views`, `product_image_small`, `product_image`, `product_order`, `product_status`, `out_of_stock`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2768, 'TEST', 'Testing', 'testing-test', 1, NULL, '1200.00', '1000.00', '16.67', '79', '', '', '', '', '', 5000, '4 days', 'qwertyu', 'qwerty', 0, 'TEST.jpg', 'TEST.jpg', 0, 1, 2, '2021-05-06 02:55:47', '2021-05-06 03:04:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_accessories`
--

CREATE TABLE `product_accessories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `accessory_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_carts`
--

CREATE TABLE `product_carts` (
  `product_cart_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'for loggedin user',
  `cart` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assessories` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_measurment` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saree_measurment` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salwar_measurment` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cart_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:Active, 2:Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `product_id`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(955, 2768, 79, '2021-05-06 02:55:50', '2021-05-06 02:55:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_color`
--

CREATE TABLE `product_color` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `color_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_enquiry`
--

CREATE TABLE `product_enquiry` (
  `product_enquiry_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_item_code` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enquiry_first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `enquiry_last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `enquiry_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `enquiry_phone` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enquiry_comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enquiry_status` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1 = Pending , 2 = Replyed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_fabric`
--

CREATE TABLE `product_fabric` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `fabric_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `product_image_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_order` int(11) DEFAULT 1,
  `image_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:Active, 2:Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_occasion`
--

CREATE TABLE `product_occasion` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `occasion_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_orders`
--

CREATE TABLE `product_orders` (
  `product_order_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_date` datetime NOT NULL,
  `estimate_delivery_date` date DEFAULT NULL,
  `order_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `product_quantity` int(11) NOT NULL DEFAULT 0,
  `total_amount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `discount_amount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `shipping_charge` decimal(8,2) NOT NULL DEFAULT 0.00,
  `net_amount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `bill_shipping` int(11) DEFAULT NULL COMMENT '1 - Same as billing',
  `order_gift` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:No, 1:Yes',
  `billing_first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `billing_last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `billing_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `billing_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `billing_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `billing_state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `billing_pincode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `billing_country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `shipping_first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `shipping_last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `shipping_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `shipping_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `shipping_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `shipping_state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `shipping_pincode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `shipping_country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `payment_mode` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:COD, 2:PayPal, 3:Other',
  `order_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1.Order Placed (New Order) 2. Under Process 3. Processed 4. Shipped 5. Out for delivery 6. Completed 7. Canceled. 8. Return.',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_order_details`
--

CREATE TABLE `product_order_details` (
  `product_order_detail_id` bigint(20) UNSIGNED NOT NULL,
  `product_order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_quantity` int(11) NOT NULL DEFAULT 1,
  `product_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_price` decimal(8,2) NOT NULL DEFAULT 0.00,
  `discount_price` decimal(8,2) DEFAULT 0.00,
  `total_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size_id` int(11) NOT NULL DEFAULT 0,
  `size_measure` decimal(8,2) DEFAULT 0.00,
  `accessories_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accessories_details` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `measurement_id` bigint(20) UNSIGNED NOT NULL,
  `measurment_details` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_measurement` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saree_measurment_ids` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saree_measurment_details` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saree_measurement` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salwar_measurment_ids` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salwar_measurment_details` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salwar_measurment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:Active, 2:Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `product_review_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `user_rating` int(11) DEFAULT 0,
  `review_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review_message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review_date` datetime DEFAULT NULL,
  `review_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:Not Publised, 2:Publised',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_size`
--

CREATE TABLE `product_size` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `size_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salwar_measurements`
--

CREATE TABLE `salwar_measurements` (
  `salwar_measurement_id` bigint(20) UNSIGNED NOT NULL,
  `salwar_measurement_titles` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salwar_measurement_price` double(8,2) DEFAULT NULL,
  `salwar_measurement_chart` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salwar_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salwar_measurements`
--

INSERT INTO `salwar_measurements` (`salwar_measurement_id`, `salwar_measurement_titles`, `salwar_measurement_price`, `salwar_measurement_chart`, `salwar_description`, `created_at`, `updated_at`) VALUES
(1, 'Salwar Kameez Measurement', 20.00, '1.jpg', 'Salwar Kameez Measurement', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `saree_measurements`
--

CREATE TABLE `saree_measurements` (
  `saree_measurement_id` bigint(20) UNSIGNED NOT NULL,
  `saree_measurement_title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saree_measurement_price` double(8,2) NOT NULL,
  `saree_custom_id` bigint(20) UNSIGNED DEFAULT NULL,
  `saree_measurement_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = Active , 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_charges`
--

CREATE TABLE `shipping_charges` (
  `shipping_id` bigint(20) UNSIGNED NOT NULL,
  `shipping_country_id` bigint(20) UNSIGNED NOT NULL,
  `shipping_weight` double(10,0) DEFAULT NULL,
  `shipping_price` double(8,0) DEFAULT NULL,
  `shipping_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = Active , 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `size_id` bigint(20) UNSIGNED NOT NULL,
  `size_measure` decimal(8,2) NOT NULL DEFAULT 0.00,
  `price_percent` decimal(8,2) NOT NULL DEFAULT 0.00,
  `size_order` int(11) NOT NULL DEFAULT 0,
  `size_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = Active , 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `slider_id` bigint(20) UNSIGNED NOT NULL,
  `slider_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `slider_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slider_link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slider_image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slider_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = Active , 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`slider_id`, `slider_title`, `slider_description`, `slider_link`, `slider_image`, `slider_status`, `created_at`, `updated_at`) VALUES
(18, 'Testing the data', 'qwertyuiop', 'https://www.facebook.com', 'f63ece7a-3d26-461a-9ef7-2e3a013a5f4b-1620195727.png', 1, '2021-05-05 06:22:09', '2021-05-05 06:22:09'),
(19, 'Testing the data 2', 'qwertyui', 'https://www.facebook.com/', '116ad96d-d6f7-4c02-bb9f-74b275e008f6-1620196119.jpg', 1, '2021-05-05 06:28:39', '2021-05-05 06:28:39');

-- --------------------------------------------------------

--
-- Table structure for table `social_urls`
--

CREATE TABLE `social_urls` (
  `social_url_id` bigint(20) UNSIGNED NOT NULL,
  `social_url_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `social_url_link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `social_url_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = Active , 0 = Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `testimonial_id` bigint(20) UNSIGNED NOT NULL,
  `testimonial_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `testimonial_message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `testimonial_place` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `testimonial_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `testimonial_order` int(11) DEFAULT 0,
  `testimonial_homepage` int(11) NOT NULL DEFAULT 0,
  `testimonial_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1: Active, 0: Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `paypal_payment_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `transaction_amount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `transaction_status` tinyint(1) DEFAULT NULL COMMENT '1: Success , 0: Failed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `f_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `l_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `zip_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `user_social_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_reg_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1:Active, 0:Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `f_name`, `l_name`, `email`, `mobile_number`, `address`, `city`, `state`, `country_id`, `zip_code`, `password`, `email_verified_at`, `user_social_id`, `user_reg_type`, `remember_token`, `user_status`, `created_at`, `updated_at`) VALUES
(591, 'Bhagirath Giri', NULL, 'giribhagirath169@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '92c09de6cf37666c4150a50b0455ac83', NULL, NULL, NULL, NULL, 1, '2021-05-18 19:43:00', '2021-05-18 20:48:58');

-- --------------------------------------------------------

--
-- Table structure for table `user_whish_lists`
--

CREATE TABLE `user_whish_lists` (
  `user_whish_list_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `whishlist_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:Active, 2:Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accessories`
--
ALTER TABLE `accessories`
  ADD PRIMARY KEY (`accessory_id`);

--
-- Indexes for table `account_setting`
--
ALTER TABLE `account_setting`
  ADD PRIMARY KEY (`account_setting_id`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_users_email_unique` (`email`);

--
-- Indexes for table `api_tokens`
--
ALTER TABLE `api_tokens`
  ADD PRIMARY KEY (`api_token_id`),
  ADD KEY `api_tokens_user_id_foreign` (`user_id`);

--
-- Indexes for table `app_failed_jobs`
--
ALTER TABLE `app_failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_jobs`
--
ALTER TABLE `app_jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_jobs_queue_index` (`queue`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`color_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`enquiry_id`);

--
-- Indexes for table `fabrics`
--
ALTER TABLE `fabrics`
  ADD PRIMARY KEY (`fabric_id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `gallary`
--
ALTER TABLE `gallary`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `homepage_content`
--
ALTER TABLE `homepage_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_pages`
--
ALTER TABLE `master_pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `measurements`
--
ALTER TABLE `measurements`
  ADD PRIMARY KEY (`measurement_id`);

--
-- Indexes for table `measurement_details`
--
ALTER TABLE `measurement_details`
  ADD PRIMARY KEY (`measurement_detail_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_letters`
--
ALTER TABLE `news_letters`
  ADD PRIMARY KEY (`news_letter_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `occasions`
--
ALTER TABLE `occasions`
  ADD PRIMARY KEY (`occasion_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `orders_order_user_id_foreign` (`order_user_id`),
  ADD KEY `orders_order_product_id_foreign` (`order_product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `products_measurement_id_foreign` (`measurement_id`);

--
-- Indexes for table `product_accessories`
--
ALTER TABLE `product_accessories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_accessories_product_id_foreign` (`product_id`),
  ADD KEY `product_accessories_accessory_id_foreign` (`accessory_id`);

--
-- Indexes for table `product_carts`
--
ALTER TABLE `product_carts`
  ADD PRIMARY KEY (`product_cart_id`),
  ADD KEY `product_carts_user_id_foreign` (`user_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category_product_id_foreign` (`product_id`),
  ADD KEY `product_category_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_color`
--
ALTER TABLE `product_color`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_color_product_id_foreign` (`product_id`),
  ADD KEY `product_color_color_id_foreign` (`color_id`);

--
-- Indexes for table `product_enquiry`
--
ALTER TABLE `product_enquiry`
  ADD PRIMARY KEY (`product_enquiry_id`),
  ADD KEY `product_enquiry_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_fabric`
--
ALTER TABLE `product_fabric`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_fabric_product_id_foreign` (`product_id`),
  ADD KEY `product_fabric_fabric_id_foreign` (`fabric_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`product_image_id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_occasion`
--
ALTER TABLE `product_occasion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_occasion_product_id_foreign` (`product_id`),
  ADD KEY `product_occasion_occasion_id_foreign` (`occasion_id`);

--
-- Indexes for table `product_orders`
--
ALTER TABLE `product_orders`
  ADD PRIMARY KEY (`product_order_id`),
  ADD KEY `product_orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `product_order_details`
--
ALTER TABLE `product_order_details`
  ADD PRIMARY KEY (`product_order_detail_id`),
  ADD KEY `product_order_details_product_order_id_foreign` (`product_order_id`),
  ADD KEY `product_order_details_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`product_review_id`),
  ADD KEY `product_reviews_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_size`
--
ALTER TABLE `product_size`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_size_product_id_foreign` (`product_id`),
  ADD KEY `product_size_size_id_foreign` (`size_id`);

--
-- Indexes for table `salwar_measurements`
--
ALTER TABLE `salwar_measurements`
  ADD PRIMARY KEY (`salwar_measurement_id`);

--
-- Indexes for table `saree_measurements`
--
ALTER TABLE `saree_measurements`
  ADD PRIMARY KEY (`saree_measurement_id`),
  ADD UNIQUE KEY `saree_measurements_saree_measurement_title_unique` (`saree_measurement_title`),
  ADD KEY `saree_measurements_saree_custom_id_foreign` (`saree_custom_id`);

--
-- Indexes for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  ADD PRIMARY KEY (`shipping_id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`size_id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- Indexes for table `social_urls`
--
ALTER TABLE `social_urls`
  ADD PRIMARY KEY (`social_url_id`),
  ADD UNIQUE KEY `social_urls_social_url_title_unique` (`social_url_title`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`testimonial_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_country_id_foreign` (`country_id`);

--
-- Indexes for table `user_whish_lists`
--
ALTER TABLE `user_whish_lists`
  ADD PRIMARY KEY (`user_whish_list_id`),
  ADD KEY `user_whish_lists_user_id_foreign` (`user_id`),
  ADD KEY `user_whish_lists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accessories`
--
ALTER TABLE `accessories`
  MODIFY `accessory_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `account_setting`
--
ALTER TABLE `account_setting`
  MODIFY `account_setting_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `api_tokens`
--
ALTER TABLE `api_tokens`
  MODIFY `api_token_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_failed_jobs`
--
ALTER TABLE `app_failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_jobs`
--
ALTER TABLE `app_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `color_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `country_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=476;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `coupon_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `enquiry_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `fabrics`
--
ALTER TABLE `fabrics`
  MODIFY `fabric_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `faq_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `gallary`
--
ALTER TABLE `gallary`
  MODIFY `image_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `homepage_content`
--
ALTER TABLE `homepage_content`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `master_pages`
--
ALTER TABLE `master_pages`
  MODIFY `page_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `measurements`
--
ALTER TABLE `measurements`
  MODIFY `measurement_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `measurement_details`
--
ALTER TABLE `measurement_details`
  MODIFY `measurement_detail_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `news_letters`
--
ALTER TABLE `news_letters`
  MODIFY `news_letter_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `occasions`
--
ALTER TABLE `occasions`
  MODIFY `occasion_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2769;

--
-- AUTO_INCREMENT for table `product_accessories`
--
ALTER TABLE `product_accessories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_carts`
--
ALTER TABLE `product_carts`
  MODIFY `product_cart_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=956;

--
-- AUTO_INCREMENT for table `product_color`
--
ALTER TABLE `product_color`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1005;

--
-- AUTO_INCREMENT for table `product_enquiry`
--
ALTER TABLE `product_enquiry`
  MODIFY `product_enquiry_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_fabric`
--
ALTER TABLE `product_fabric`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=992;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `product_image_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_occasion`
--
ALTER TABLE `product_occasion`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5556;

--
-- AUTO_INCREMENT for table `product_orders`
--
ALTER TABLE `product_orders`
  MODIFY `product_order_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `product_order_details`
--
ALTER TABLE `product_order_details`
  MODIFY `product_order_detail_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `product_review_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_size`
--
ALTER TABLE `product_size`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3050;

--
-- AUTO_INCREMENT for table `salwar_measurements`
--
ALTER TABLE `salwar_measurements`
  MODIFY `salwar_measurement_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `saree_measurements`
--
ALTER TABLE `saree_measurements`
  MODIFY `saree_measurement_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  MODIFY `shipping_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7251;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `size_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `slider_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `social_urls`
--
ALTER TABLE `social_urls`
  MODIFY `social_url_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `testimonial_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=592;

--
-- AUTO_INCREMENT for table `user_whish_lists`
--
ALTER TABLE `user_whish_lists`
  MODIFY `user_whish_list_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `api_tokens`
--
ALTER TABLE `api_tokens`
  ADD CONSTRAINT `api_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_order_product_id_foreign` FOREIGN KEY (`order_product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_order_user_id_foreign` FOREIGN KEY (`order_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_measurement_id_foreign` FOREIGN KEY (`measurement_id`) REFERENCES `measurements` (`measurement_id`);

--
-- Constraints for table `product_accessories`
--
ALTER TABLE `product_accessories`
  ADD CONSTRAINT `product_accessories_accessory_id_foreign` FOREIGN KEY (`accessory_id`) REFERENCES `accessories` (`accessory_id`),
  ADD CONSTRAINT `product_accessories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `product_carts`
--
ALTER TABLE `product_carts`
  ADD CONSTRAINT `product_carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `product_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `product_category_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

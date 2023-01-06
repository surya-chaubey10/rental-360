-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 19, 2022 at 01:39 AM
-- Server version: 8.0.30-0ubuntu0.22.04.1
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rent-365`
--

-- --------------------------------------------------------

--
-- Table structure for table `releases`
--

CREATE TABLE `releases` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb3_unicode_ci NOT NULL,
  `organisation_id` bigint UNSIGNED NOT NULL DEFAULT '1',
  `request_id` bigint UNSIGNED DEFAULT NULL,
  `company_name` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `withdraw_amount` int DEFAULT NULL,
  `withdraw_fees` int DEFAULT NULL,
  `request_on` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `last_approval_date` date DEFAULT NULL,
  `status` enum('1','2') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL COMMENT '1:Approved, 2:Rejected',
  `created_user` bigint UNSIGNED DEFAULT NULL,
  `updated_user` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `releases`
--

INSERT INTO `releases` (`id`, `uuid`, `organisation_id`, `request_id`, `company_name`, `withdraw_amount`, `withdraw_fees`, `request_on`, `last_approval_date`, `status`, `created_user`, `updated_user`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '05922a73-9b4b-4fdf-9368-3fdc932ce829', 1, 1, NULL, 500, NULL, '2022-10-18', '2022-10-18', '1', NULL, NULL, '2022-10-18 12:51:53', '2022-10-18 12:51:53', NULL),
(2, '4df787fc-09cb-4310-b9b2-878175dc88ae', 1, 2, NULL, 100, NULL, '2022-10-18', '2022-10-18', '1', NULL, NULL, '2022-10-18 12:51:59', '2022-10-18 12:51:59', NULL),
(3, 'ef33b6fb-ab90-4ff9-9f80-d99e3e7ad774', 1, 1, NULL, 500, NULL, '2022-10-18', '2022-10-18', '1', NULL, NULL, '2022-10-18 12:52:10', '2022-10-18 12:52:10', NULL),
(4, '992ed0eb-07aa-4b04-8a5a-6aebcebc216f', 1, 1, NULL, 500, 100, '2022-10-18', '2022-10-18', '1', NULL, NULL, '2022-10-18 13:02:42', '2022-10-18 13:02:42', NULL),
(5, '66b48542-6f92-402d-8426-b52cbb1850d4', 1, 2, NULL, 100, 100, '2022-10-18', '2022-10-18', '1', 28, NULL, '2022-10-18 13:05:48', '2022-10-18 13:05:48', NULL),
(6, '18175dab-27aa-41dd-b322-d8e90df9aaa9', 1, 1, NULL, 500, 100, '2022-10-18', '2022-10-18', '1', 28, NULL, '2022-10-18 13:08:10', '2022-10-18 13:08:10', NULL),
(7, 'd180ae46-e79f-4287-8aae-16b0fa1c10d8', 1, 1, NULL, 500, 100, '2022-10-18', '2022-10-18', '1', 28, NULL, '2022-10-18 13:52:10', '2022-10-18 13:52:10', NULL),
(8, '744ef818-f80f-4f13-83fe-ef66313a8f30', 1, 1, NULL, 500, 100, '2022-10-18', '2022-10-18', '1', 28, NULL, '2022-10-18 13:53:41', '2022-10-18 13:53:41', NULL),
(9, '27c97654-ab13-4d01-a164-6b9fc6f1f3cd', 1, 1, NULL, 500, 100, '2022-10-18', '2022-10-18', '1', 28, NULL, '2022-10-18 14:18:27', '2022-10-18 14:18:27', NULL),
(10, 'ffea31f4-37aa-42c7-a9fc-70b1a61f82fb', 1, 1, NULL, 500, 100, '2022-10-18', '2022-10-18', '1', 28, NULL, '2022-10-18 14:30:31', '2022-10-18 14:30:31', NULL),
(11, 'f862c66b-e938-4989-9625-ad21f1190254', 1, 3, NULL, 1000, 100, '2022-10-18', '2022-10-18', '1', 28, NULL, '2022-10-18 14:30:59', '2022-10-18 14:30:59', NULL),
(12, '11b6ba84-89f5-4611-a551-3d2a5698e3a3', 1, 4, NULL, 1000, 100, '2022-10-18', '2022-10-18', NULL, 28, NULL, '2022-10-18 14:32:49', '2022-10-18 14:32:49', NULL),
(13, 'f958d034-0c3d-4d51-8655-38bf68c58cca', 1, 7, NULL, 200, 100, '2022-10-18', '2022-10-18', NULL, 28, NULL, '2022-10-18 14:33:10', '2022-10-18 14:33:10', NULL),
(14, 'a0c83de4-4bb8-4020-8cd1-bd93fb0a3b2b', 1, 7, NULL, 200, 100, '2022-10-18', '2022-10-18', NULL, 28, NULL, '2022-10-18 14:33:24', '2022-10-18 14:33:24', NULL),
(15, '5f899b6b-3e5e-40f5-852b-d88a123dadbc', 1, 1, NULL, 500, 100, '2022-10-18', '2022-10-18', NULL, 28, NULL, '2022-10-18 14:33:28', '2022-10-18 14:33:28', NULL),
(16, '3cc8f1d3-5b37-472f-9cb7-d44fb63bf461', 1, 2, NULL, 100, 100, '2022-10-18', '2022-10-18', NULL, 28, NULL, '2022-10-18 14:33:31', '2022-10-18 14:33:31', NULL),
(17, 'd402a885-f930-4910-9d21-8544cc313488', 1, 3, NULL, 1000, 100, '2022-10-18', '2022-10-18', NULL, 28, NULL, '2022-10-18 14:33:38', '2022-10-18 14:33:38', NULL),
(18, '0bfbc129-0284-4a0d-ae7d-a12f21c2c9d3', 1, 2, NULL, 100, 100, '2022-10-18', '2022-10-18', NULL, 28, NULL, '2022-10-18 14:34:40', '2022-10-18 14:34:40', NULL),
(19, '33f87722-df9b-4501-b836-7621301c7a2e', 1, 3, NULL, 1000, 100, '2022-10-18', '2022-10-18', NULL, 28, NULL, '2022-10-18 14:34:43', '2022-10-18 14:34:43', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `releases`
--
ALTER TABLE `releases`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `releases`
--
ALTER TABLE `releases`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

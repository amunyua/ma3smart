-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 05, 2016 at 10:01 AM
-- Server version: 5.7.16-0ubuntu0.16.04.1
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bus_service`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buses`
--

CREATE TABLE `buses` (
  `id` int(10) UNSIGNED NOT NULL,
  `number_plate` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `buses`
--

INSERT INTO `buses` (`id`, `number_plate`, `status`, `created_at`, `updated_at`) VALUES
(1, 'KAS512Z', 1, '2016-11-02 16:12:14', '2016-11-02 16:12:14');

-- --------------------------------------------------------

--
-- Table structure for table `daily_bank_accumulations`
--

CREATE TABLE `daily_bank_accumulations` (
  `id` int(10) UNSIGNED NOT NULL,
  `transaction_id` int(10) UNSIGNED NOT NULL,
  `total_amount_collected` double NOT NULL,
  `actual_banked` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `daily_bank_accumulations`
--

INSERT INTO `daily_bank_accumulations` (`id`, `transaction_id`, `total_amount_collected`, `actual_banked`, `created_at`, `updated_at`) VALUES
(1, 1, 15600, 6000, '2016-11-04 20:13:59', '2016-11-04 20:13:59'),
(2, 2, 180000, 6500, '2016-11-05 02:01:05', '2016-11-05 02:01:05');

-- --------------------------------------------------------

--
-- Table structure for table `daily_expenses`
--

CREATE TABLE `daily_expenses` (
  `id` int(10) UNSIGNED NOT NULL,
  `transaction_id` int(10) UNSIGNED NOT NULL,
  `expense_id` int(10) UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `daily_expenses`
--

INSERT INTO `daily_expenses` (`id`, `transaction_id`, `expense_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 300, '2016-11-04 20:13:59', '2016-11-04 20:13:59'),
(2, 1, 2, 200, '2016-11-04 20:13:59', '2016-11-04 20:13:59'),
(3, 1, 3, 100, '2016-11-04 20:13:59', '2016-11-04 20:13:59'),
(4, 1, 4, 100, '2016-11-04 20:13:59', '2016-11-04 20:13:59'),
(5, 1, 5, 100, '2016-11-04 20:13:59', '2016-11-04 20:13:59'),
(6, 1, 6, 1000, '2016-11-04 20:13:59', '2016-11-04 20:13:59'),
(7, 1, 7, 70, '2016-11-04 20:13:59', '2016-11-04 20:13:59'),
(8, 1, 13, 200, '2016-11-04 20:13:59', '2016-11-04 20:13:59'),
(9, 1, 8, 3240, '2016-11-04 20:13:59', '2016-11-04 20:13:59'),
(10, 1, 9, 2800, '2016-11-04 20:13:59', '2016-11-04 20:13:59'),
(11, 1, 10, 0, '2016-11-04 20:13:59', '2016-11-04 20:13:59'),
(12, 1, 11, 900, '2016-11-04 20:13:59', '2016-11-04 20:13:59'),
(13, 1, 12, 600, '2016-11-04 20:13:59', '2016-11-04 20:13:59'),
(14, 2, 1, 300, '2016-11-05 02:01:05', '2016-11-05 02:01:05'),
(15, 2, 2, 200, '2016-11-05 02:01:05', '2016-11-05 02:01:05'),
(16, 2, 3, 100, '2016-11-05 02:01:05', '2016-11-05 02:01:05'),
(17, 2, 4, 100, '2016-11-05 02:01:05', '2016-11-05 02:01:05'),
(18, 2, 5, 100, '2016-11-05 02:01:05', '2016-11-05 02:01:05'),
(19, 2, 6, 1000, '2016-11-05 02:01:05', '2016-11-05 02:01:05'),
(20, 2, 7, 70, '2016-11-05 02:01:05', '2016-11-05 02:01:05'),
(21, 2, 13, 200, '2016-11-05 02:01:05', '2016-11-05 02:01:05'),
(22, 2, 8, 4500, '2016-11-05 02:01:05', '2016-11-05 02:01:05'),
(23, 2, 9, 2800, '2016-11-05 02:01:05', '2016-11-05 02:01:05'),
(24, 2, 10, 0, '2016-11-05 02:01:05', '2016-11-05 02:01:05'),
(25, 2, 11, 0, '2016-11-05 02:01:05', '2016-11-05 02:01:05'),
(26, 2, 12, 0, '2016-11-05 02:01:05', '2016-11-05 02:01:05');

-- --------------------------------------------------------

--
-- Stand-in structure for view `daily_report_view`
--
CREATE TABLE `daily_report_view` (
`id` int(10) unsigned
,`transaction_id` int(10) unsigned
,`expense_id` int(10) unsigned
,`amount` double
,`created_at` timestamp
,`updated_at` timestamp
,`bus_id` int(10) unsigned
,`transaction_date` date
,`driver_id` int(10) unsigned
,`total_trips` double
,`total_amount_collected` double
,`actual_banked` double
);

-- --------------------------------------------------------

--
-- Table structure for table `daily_transactions`
--

CREATE TABLE `daily_transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `bus_id` int(10) UNSIGNED NOT NULL,
  `transaction_date` date NOT NULL,
  `driver_id` int(10) UNSIGNED NOT NULL,
  `total_amount_collected` double NOT NULL,
  `total_trips` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `daily_transactions`
--

INSERT INTO `daily_transactions` (`id`, `bus_id`, `transaction_date`, `driver_id`, `total_amount_collected`, `total_trips`, `created_at`, `updated_at`) VALUES
(1, 1, '2016-11-05', 1, 15600, 8, '2016-11-04 20:13:59', '2016-11-04 20:13:59'),
(2, 1, '2016-11-03', 1, 180000, 8, '2016-11-05 02:01:05', '2016-11-05 02:01:05');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(10) UNSIGNED NOT NULL,
  `expense_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expense_name`, `amount`, `status`, `created_at`, `updated_at`, `code`, `amount_type`) VALUES
(1, 'Car Wash', 300, 1, '2016-11-02 16:48:39', '2016-11-02 16:48:39', 'CARWASH', 'Fixed'),
(2, 'Line', 200, 1, '2016-11-02 16:56:05', '2016-11-02 16:56:05', 'LINE', 'Fixed'),
(3, 'Legal', 100, 1, '2016-11-02 16:56:38', '2016-11-02 16:56:38', 'LEGAL', 'Fixed'),
(4, 'Security', 100, 1, '2016-11-02 16:56:59', '2016-11-02 16:56:59', 'SEC', 'Fixed'),
(5, 'Parking', 100, 1, '2016-11-02 16:57:19', '2016-11-02 16:57:19', 'PARKING', 'Fixed'),
(6, 'SACCO', 1000, 1, '2016-11-02 16:57:49', '2016-11-02 16:57:49', 'SACCO', 'Fixed'),
(7, 'I.T', 70, 1, '2016-11-02 17:05:33', '2016-11-02 17:05:33', 'IT', 'Fixed'),
(8, 'Fuel', 0, 1, '2016-11-03 16:22:49', '2016-11-03 16:22:49', 'FL', 'Custom'),
(9, 'Salaries', 0, 1, '2016-11-03 16:23:27', '2016-11-03 16:23:27', 'SL', 'Custom'),
(10, 'Releiver', 0, 1, '2016-11-03 16:23:59', '2016-11-03 16:23:59', 'RL', 'Custom'),
(11, 'Garage', 0, 1, '2016-11-03 16:25:11', '2016-11-03 16:25:11', 'GG', 'Custom'),
(12, 'Cops and Road misc', 0, 1, '2016-11-03 19:02:17', '2016-11-03 19:02:17', 'CR', 'Custom'),
(13, 'Lunch', 200, 1, '2016-11-04 19:52:45', '2016-11-04 19:52:45', 'LUNCH', 'Fixed');

-- --------------------------------------------------------

--
-- Table structure for table `masterfiles`
--

CREATE TABLE `masterfiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `surname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `middlename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_path` text COLLATE utf8_unicode_ci,
  `id_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `registration_date` date NOT NULL,
  `b_role` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `masterfiles`
--

INSERT INTO `masterfiles` (`id`, `surname`, `firstname`, `middlename`, `image_path`, `id_no`, `registration_date`, `b_role`, `created_at`, `updated_at`) VALUES
(1, 'Kamau', 'Alex', 'Chege', NULL, '3000125', '2016-11-03', 'Driver', '2016-11-03 17:42:35', '2016-11-03 17:42:43');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 2),
(3, '2016_11_01_092857_create_masterfile_table', 2),
(4, '2016_11_02_183215_create_buses_table', 3),
(5, '2016_11_02_191731_create_expenses_table', 4),
(7, '2016_11_02_203132_create_accounts_table', 5),
(10, '2016_11_03_185419_addcolumnstoexpenses', 7),
(11, '2016_11_03_172512_create_daily_transactions_table', 8),
(12, '2016_11_03_212422_create_daily_expenses_table', 8),
(13, '2016_11_03_212509_create_daily_bank_accumulations_table', 8);

-- --------------------------------------------------------

--
-- Stand-in structure for view `on_demand_daily_report`
--
CREATE TABLE `on_demand_daily_report` (
`id` int(10) unsigned
,`bus_id` int(10) unsigned
,`transaction_date` date
,`driver_id` int(10) unsigned
,`total_amount_collected` double
,`total_trips` double
,`created_at` timestamp
,`updated_at` timestamp
,`total_expenses` double
);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', '$2y$10$c2sNQsvSpORuJCbdoHXSuOkA/4n1BBKDOHMprW1gcTx0LJggRceEO', 'QCJ1ZMwEp1wHB2umDXCedoHubztey0PBuuIHbRXpSpnZlLSTbt92TxKkOvMg', '2016-11-02 14:53:32', '2016-11-02 18:52:44');

-- --------------------------------------------------------

--
-- Structure for view `daily_report_view`
--
DROP TABLE IF EXISTS `daily_report_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `daily_report_view`  AS  select `de`.`id` AS `id`,`de`.`transaction_id` AS `transaction_id`,`de`.`expense_id` AS `expense_id`,`de`.`amount` AS `amount`,`de`.`created_at` AS `created_at`,`de`.`updated_at` AS `updated_at`,`dt`.`bus_id` AS `bus_id`,`dt`.`transaction_date` AS `transaction_date`,`dt`.`driver_id` AS `driver_id`,`dt`.`total_trips` AS `total_trips`,`dba`.`total_amount_collected` AS `total_amount_collected`,`dba`.`actual_banked` AS `actual_banked` from ((`daily_expenses` `de` left join `daily_transactions` `dt` on((`dt`.`id` = `de`.`transaction_id`))) left join `daily_bank_accumulations` `dba` on((`dba`.`transaction_id` = `de`.`transaction_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `on_demand_daily_report`
--
DROP TABLE IF EXISTS `on_demand_daily_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `on_demand_daily_report`  AS  select `dt`.`id` AS `id`,`dt`.`bus_id` AS `bus_id`,`dt`.`transaction_date` AS `transaction_date`,`dt`.`driver_id` AS `driver_id`,`dt`.`total_amount_collected` AS `total_amount_collected`,`dt`.`total_trips` AS `total_trips`,`dt`.`created_at` AS `created_at`,`dt`.`updated_at` AS `updated_at`,sum(`de`.`amount`) AS `total_expenses` from ((`daily_transactions` `dt` left join `daily_expenses` `de` on((`dt`.`id` = `de`.`transaction_id`))) left join `daily_bank_accumulations` `dba` on((`dba`.`transaction_id` = `dt`.`id`))) where (`dt`.`id` = `de`.`transaction_id`) group by `de`.`transaction_id` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buses`
--
ALTER TABLE `buses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily_bank_accumulations`
--
ALTER TABLE `daily_bank_accumulations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_id` (`transaction_id`);

--
-- Indexes for table `daily_expenses`
--
ALTER TABLE `daily_expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily_transactions`
--
ALTER TABLE `daily_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `masterfiles`
--
ALTER TABLE `masterfiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `buses`
--
ALTER TABLE `buses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `daily_bank_accumulations`
--
ALTER TABLE `daily_bank_accumulations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `daily_expenses`
--
ALTER TABLE `daily_expenses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `daily_transactions`
--
ALTER TABLE `daily_transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `masterfiles`
--
ALTER TABLE `masterfiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

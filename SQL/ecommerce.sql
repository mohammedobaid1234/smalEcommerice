-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2023 at 11:18 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `msg` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(32, '2014_10_12_000000_create_users_table', 1),
(33, '2014_10_12_100000_create_password_resets_table', 1),
(34, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(35, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(36, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(37, '2016_06_01_000004_create_oauth_clients_table', 1),
(38, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(39, '2019_08_19_000000_create_failed_jobs_table', 1),
(40, '2022_11_30_092849_create_products_table', 1),
(41, '2023_05_17_074520_create_contact_us_table', 1),
(52, '2023_05_17_193012_create_orders_table', 2),
(53, '2023_05_17_215332_create_order_details_table', 2),
(54, '2023_05_18_204245_add_address_to_users_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
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
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total` double(8,2) NOT NULL DEFAULT 0.00,
  `checkout` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total`, `checkout`, `deleted_at`, `created_at`, `updated_at`) VALUES
(3, 3, 635.00, '2023-05-18 17:12:36', NULL, '2023-05-18 14:40:29', '2023-05-18 17:12:36');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` smallint(6) DEFAULT NULL,
  `price` double(8,2) DEFAULT NULL,
  `total` double(8,2) NOT NULL DEFAULT 0.00,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `price`, `total`, `deleted_at`, `created_at`, `updated_at`) VALUES
(9, 3, 6, 1, 185.00, 185.00, NULL, '2023-05-18 14:41:06', '2023-05-18 14:41:06');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` double(8,2) NOT NULL DEFAULT 0.00,
  `type` enum('1','2') NOT NULL DEFAULT '1',
  `is_new` smallint(6) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `type`, `is_new`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'عطر ليبر انتنس الأنثوي المميز', 'أودريد- ليبر انتنس عطر أودريد-ليبر انتنس من أفضل العطور النسائية الفاخرة والجريئة، وهو عطر مُستوحى من أجود الماركات العالمية منعطر ليبر انتنس سان لوران المُميز، حيث تمتزج المُكونات المُميزة الموجودة النوتات العطرية مع بعضها البعض في تركيبته ليصبح عطر ذو لمسة ورائحة عطرية تدوم طويلاً.', 250.00, '2', NULL, 'dvRuSE8mPAvsWSRI7rTJiPpooNN1WkIZ4LFyzIk0.jpg', '2023-05-17 14:32:13', '2023-05-17 19:21:04', NULL),
(2, 'عطر فيكتوس انتنس الرجالي المميز', 'أودريد- ليبر انتنس عطر أودريد-ليبر انتنس من أفضل العطور النسائية الفاخرة والجريئة، وهو عطر مُستوحى من أجود الماركات العالمية منعطر ليبر انتنس سان لوران المُميز، حيث تمتزج المُكونات المُميزة الموجودة النوتات العطرية مع بعضها البعض في تركيبته ليصبح عطر ذو لمسة ورائحة عطرية تدوم طويلاً.', 555.00, '1', NULL, 'wJzEYGQAlfakAgCIK4AjC8n9Shl9cAEWP9f3z2ga.jpg', '2023-05-17 15:58:12', '2023-05-17 19:24:33', NULL),
(3, 'عطر برايس انتنس الرجالي المميز', 'أودريد- ليبر انتنس عطر أودريد-ليبر انتنس من أفضل العطور النسائية الفاخرة والجريئة، وهو عطر مُستوحى من أجود الماركات العالمية منعطر ليبر انتنس سان لوران المُميز، حيث تمتزج المُكونات المُميزة الموجودة النوتات العطرية مع بعضها البعض في تركيبته ليصبح عطر ذو لمسة عطرية تدوم طويلاً.', 5151.00, '2', NULL, 'Pw3kBP3dWSG5tIyxmpczD5aiysnVHMZthxhr2QcR.jpg', '2023-05-17 16:07:49', '2023-05-17 19:24:25', NULL),
(4, 'عطر برشل  الرجالي المميز', 'عطر فيكتوس انتنس الرجالي المميز', 150.00, '1', 1, 'FiDCHmTNB9K0RH91uVIdB97BvzdlHMSLLcA1Y8j3.jpg', '2023-05-17 19:25:16', '2023-05-17 19:35:28', NULL),
(5, 'عطر رجالي', 'عطر ليبر انتنس الرجالي المميز', 522.00, '1', 1, '42YgRTP4qQKPwN1B3oo7TIsj5tH0FZnfiCRnsyYY.jpg', '2023-05-17 19:25:56', '2023-05-17 19:35:51', NULL),
(6, 'عطر لابورت الرجالي', 'عطر ليبر انتنس الرجالي المميز\nعطر لابورت الرجالي', 185.00, '1', 1, 'AfGmxsTpWFAHAzsfeqK07YJ1lySXtEWdNGrgE7r6.jpg', '2023-05-17 19:25:56', '2023-05-17 19:38:04', NULL),
(7, 'عطر لابورت الرجالي', 'عطر ليبر انتنس الرجالي المميز\nعطر لابورت الرجالي', 185.00, '2', 1, 'SklsAiqlLFAdHzruT3kpCiIkD6KD9Jk6SoFfwcfB.jpg', '2023-05-17 19:25:56', '2023-05-17 19:38:20', NULL),
(8, 'عطر لابورت الرجالي', 'عطر ليبر انتنس الرجالي المميز\nعطر لابورت الرجالي', 185.00, '2', 1, 'zh1yBvddepNZ7euwawiBRnsa6KML7Q6LcezADvBl.jpg', '2023-05-17 19:25:56', '2023-05-17 19:38:34', NULL),
(9, 'عطر لابورت الرجالي', 'عطر ليبر انتنس الرجالي المميز\nعطر لابورت الرجالي', 185.00, '2', NULL, 'A13dFLe8CX3OtPFGBrqZA1luEJtqmcMEXSjalusx.jpg', '2023-05-17 19:25:56', '2023-05-17 19:38:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `type` enum('1','2') NOT NULL DEFAULT '1',
  `is_most` smallint(6) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile_no`, `address`, `email_verified_at`, `type`, `is_most`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mohammed Obaid', 'mhmd.obaid.18@gmail.com', '0594034429', 'غزة', '2023-05-17 13:53:05', '2', NULL, '$2y$10$fANq6qZfsVXeogs2x2jIPufmCDDp4H7jROGXvXb4Gzf2yw1GP2XaC', '1yVyFgSYAEfQv8kP0LZ4zbOKDovfr7aMaTwKhRVCLjf8sc0BgUn8x795JCCW', '2023-05-17 13:53:05', '2023-05-17 13:53:05'),
(2, 'Vera Avery', 'ruheno@mailinator.com', 'qizy@mailinator.com', 'رفح', NULL, '1', NULL, '$2y$10$77s7uqTLe2yz14mdSEeFT.FP9P3uqMz1oAd5Ws5wtkiaNyFOLpxKm', NULL, '2023-05-18 07:43:15', '2023-05-18 07:43:15'),
(3, 'Ali', 'user1@user.com', '0598751236', 'رام الله', NULL, '1', NULL, '$2y$10$97sB35Qp6zwUpqzr7hbK/.5a0/dnezCmARdKCRRIu19upei9kgsp.', NULL, '2023-05-18 07:51:04', '2023-05-18 18:07:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_product_id_foreign` (`product_id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

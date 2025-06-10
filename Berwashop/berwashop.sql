-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2025 at 10:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `berwashop`
--

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_06_03_163547_create_shopkeepers_table', 1),
(6, '2025_06_03_163554_create_products_table', 1),
(7, '2025_06_03_163618_create_product_ins_table', 1),
(8, '2025_06_03_163626_create_product_outs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductCode` varchar(255) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductCode`, `ProductName`, `created_at`, `updated_at`) VALUES
('B1', 'Shirts', '2025-06-03 15:15:43', '2025-06-03 18:00:49'),
('B2', 'Shoes', '2025-06-03 15:15:30', '2025-06-03 15:15:30');

-- --------------------------------------------------------

--
-- Table structure for table `product_ins`
--

CREATE TABLE `product_ins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ProductCode` varchar(255) NOT NULL,
  `Date` date NOT NULL,
  `Quantity` int(11) NOT NULL,
  `UniquePrice` decimal(10,2) NOT NULL,
  `TotalPrice` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_ins`
--

INSERT INTO `product_ins` (`id`, `ProductCode`, `Date`, `Quantity`, `UniquePrice`, `TotalPrice`, `created_at`, `updated_at`) VALUES
(1, 'B1', '2025-06-03', 20, 2500.00, 50000.00, '2025-06-03 15:27:31', '2025-06-03 15:27:31');

-- --------------------------------------------------------

--
-- Table structure for table `product_outs`
--

CREATE TABLE `product_outs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ProductCode` varchar(255) NOT NULL,
  `Date` date NOT NULL,
  `Quantity` int(11) NOT NULL,
  `UniquePrice` decimal(10,2) NOT NULL,
  `TotalPrice` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_outs`
--

INSERT INTO `product_outs` (`id`, `ProductCode`, `Date`, `Quantity`, `UniquePrice`, `TotalPrice`, `created_at`, `updated_at`) VALUES
(1, 'B1', '2025-06-03', 10, 200.00, 2000.00, '2025-06-03 15:28:04', '2025-06-03 15:28:04');

-- --------------------------------------------------------

--
-- Table structure for table `shopkeepers`
--

CREATE TABLE `shopkeepers` (
  `ShopkeeperId` bigint(20) UNSIGNED NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shopkeepers`
--

INSERT INTO `shopkeepers` (`ShopkeeperId`, `UserName`, `Password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Junior', '$2y$12$2OSUnUdzsQnsOP0MVp35Ee829.m.i6kmwrhfoPGAQDvn1NF3twR/i', NULL, '2025-06-03 15:15:15', '2025-06-03 15:15:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'lewis', 'lewis@gmail.com', '0000-00-00 00:00:00', 'pianist', 'Shop', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductCode`);

--
-- Indexes for table `product_ins`
--
ALTER TABLE `product_ins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_ins_productcode_foreign` (`ProductCode`);

--
-- Indexes for table `product_outs`
--
ALTER TABLE `product_outs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_outs_productcode_foreign` (`ProductCode`);

--
-- Indexes for table `shopkeepers`
--
ALTER TABLE `shopkeepers`
  ADD PRIMARY KEY (`ShopkeeperId`),
  ADD UNIQUE KEY `shopkeepers_username_unique` (`UserName`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_ins`
--
ALTER TABLE `product_ins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_outs`
--
ALTER TABLE `product_outs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shopkeepers`
--
ALTER TABLE `shopkeepers`
  MODIFY `ShopkeeperId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_ins`
--
ALTER TABLE `product_ins`
  ADD CONSTRAINT `product_ins_productcode_foreign` FOREIGN KEY (`ProductCode`) REFERENCES `products` (`ProductCode`) ON DELETE CASCADE;

--
-- Constraints for table `product_outs`
--
ALTER TABLE `product_outs`
  ADD CONSTRAINT `product_outs_productcode_foreign` FOREIGN KEY (`ProductCode`) REFERENCES `products` (`ProductCode`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

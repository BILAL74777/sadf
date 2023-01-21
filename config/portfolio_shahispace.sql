-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2021 at 08:17 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portfolio_shahispace`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `national_number` varchar(255) NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `email`, `national_number`, `contact_person`, `address`, `city`, `country`, `created_at`, `updated_at`) VALUES
('9503a539-8951-481b-9043-9afc24d60473', 'Shahispace', 'shahi@shahi.com', '+92456456', '+923564545444', 'Gul Berg lahore Pakistan', 'Lahore', 'Pakisatan', '2021-12-02 02:08:14', '2021-12-02 02:08:14');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `address_2` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_name`, `first_name`, `last_name`, `email`, `password`, `role`, `city`, `address`, `address_2`, `telephone`, `created_at`, `updated_at`) VALUES
('94d57610-8df2-413d-ab3a-46bce84b31a6', 'BilalUserName', 'Bilal', 'Khan', 'bilal@gmail.com', '456', 'updated', 'Karachi', 'updated', 'updaed', '0300000000', '2021-11-09 03:08:17', '2021-11-09 03:22:24'),
('95062aca-7044-4020-9349-9a5bfa113f7d', 'arqam@gmail.com', 'Bilal', 'Hussain', 'arqam@healthcare.com', '123', 'Peshawar', 'Peshawar', 'SamarBagh Jandool Dir Lower KPK', 'SamarBagh Jandool Dir Lower KPK', '3005974777', '2021-12-03 08:13:22', '2021-12-03 08:13:22'),
('95062ae4-da86-4ca8-86e0-37ec642b851f', 'arqam@gmail.com', 'Bilal', 'Hussain', 'billhssn777@gmail.com', '123', 'Peshawar', 'Peshawar', 'SamarBagh Jandool Dir Lower KPK', 'sfg', '3005974777', '2021-12-03 08:13:39', '2021-12-03 08:13:39');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` varchar(255) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `ordering` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(139, 'App\\Models\\User', 1, 'webToken', '86ffd0e7ff81e150bf35e4703a36cb2b136c9aa545e6054a5d7af4c35e0d0f6c', '[\"*\"]', NULL, '2021-11-07 12:40:49', '2021-11-07 12:40:49'),
(140, 'App\\Models\\User', 1, 'webToken', '6e71c71750131fb327db431ccf77af0e700ab3d5133060e4caeb2712294596a5', '[\"*\"]', NULL, '2021-11-08 02:07:28', '2021-11-08 02:07:28'),
(141, 'App\\Models\\User', 1, 'webToken', '5b9946add2e30ab9e4fee975d4573db7c4fc57169d491fe066bc0a4aed057349', '[\"*\"]', NULL, '2021-11-08 04:41:51', '2021-11-08 04:41:51'),
(142, 'App\\Models\\User', 1, 'webToken', '55dfef0141285690697bb3a190c02cd5b99497b9a8c6f3e85c4a7dceeecb798e', '[\"*\"]', NULL, '2021-11-08 12:26:16', '2021-11-08 12:26:16'),
(143, 'App\\Models\\User', 1, 'webToken', 'adc5b69fe50af819e1c18509277d747a2de31a9b6d1243b549ed8c0403800265', '[\"*\"]', NULL, '2021-11-08 12:26:22', '2021-11-08 12:26:22'),
(144, 'App\\Models\\User', 1, 'webToken', 'a24d34ec3e9f012323087fa90207be48c7ab525a9a8de5f7bfcf74ebf9903f78', '[\"*\"]', NULL, '2021-11-08 12:26:41', '2021-11-08 12:26:41'),
(145, 'App\\Models\\User', 1, 'webToken', 'de3ebbcb963fc8a576f63fbbfeac79182260fec6f228290083414074115d3038', '[\"*\"]', NULL, '2021-11-08 12:28:27', '2021-11-08 12:28:27'),
(146, 'App\\Models\\User', 1, 'webToken', '6a4ca14f9fe7ef4cf7e2f585f26e5b03f845817edc99c036ca5fd666e37c8a05', '[\"*\"]', NULL, '2021-11-08 12:28:37', '2021-11-08 12:28:37'),
(147, 'App\\Models\\User', 1, 'webToken', 'da37c94e8da50eb03eac23c2ff009ba391998401e99ece104b0bfa2d52da14ac', '[\"*\"]', NULL, '2021-11-08 12:28:41', '2021-11-08 12:28:41'),
(148, 'App\\Models\\User', 1, 'webToken', '52ec3f2424c55c7a615a77bf8a317d39ba3376a239b8ef6349775bdc0610c3ad', '[\"*\"]', NULL, '2021-11-08 12:29:09', '2021-11-08 12:29:09'),
(149, 'App\\Models\\User', 1, 'webToken', '43f8f93d01b3f47f452644eee54fd47078087ceb498335d1134a23d4784276a9', '[\"*\"]', NULL, '2021-11-08 12:29:14', '2021-11-08 12:29:14'),
(150, 'App\\Models\\User', 1, 'webToken', '7d5f9784243a31f06c6f7df4b287767956bf8f885b8c0ef6dd873a24cffebbe6', '[\"*\"]', NULL, '2021-11-08 12:29:40', '2021-11-08 12:29:40'),
(151, 'App\\Models\\User', 1, 'webToken', 'd33cc3e838d58c5b596312f50c2cc5f53f4d9376dd46282cc8b12fe5fa3fa17f', '[\"*\"]', NULL, '2021-11-08 12:30:11', '2021-11-08 12:30:11'),
(152, 'App\\Models\\User', 1, 'webToken', '355db0e14b8284251201c952e8b8eea13485a225cd7cfafc311b22c76fa2efcd', '[\"*\"]', NULL, '2021-11-08 12:30:37', '2021-11-08 12:30:37'),
(153, 'App\\Models\\User', 1, 'webToken', '632bc49fd95c249bc7352c188f0940a8a87e8f7e9338a63f82e1508d9bc19561', '[\"*\"]', NULL, '2021-11-08 12:31:54', '2021-11-08 12:31:54'),
(154, 'App\\Models\\User', 1, 'webToken', '2c05244e3e979751c73810e5c2b9fd0de4deacad4e204add052a9af28e6105e2', '[\"*\"]', NULL, '2021-11-09 00:38:53', '2021-11-09 00:38:53'),
(155, 'App\\Models\\User', 1, 'webToken', '5876468e099312c77185fc15dd3f7c7a33361787df4bda61179e63769c8d16a1', '[\"*\"]', NULL, '2021-11-09 02:39:09', '2021-11-09 02:39:09'),
(156, 'App\\Models\\User', 1, 'webToken', '1564d45bb87aded35613cb527668db1a4df6852127e19fbb90ccb45502cf41e1', '[\"*\"]', NULL, '2021-11-25 04:54:09', '2021-11-25 04:54:09'),
(157, 'App\\Models\\User', 1, 'webToken', '1b5e8958554f7b749c59db95a7f8d6895fa23c84c0f077b8bc2866c906e8f58c', '[\"*\"]', NULL, '2021-11-25 06:55:20', '2021-11-25 06:55:20'),
(158, 'App\\Models\\User', 1, 'webToken', '16ca8db712b15c88847b42bec04a66e5b907117185861efc7b5d9c12fd0ac93f', '[\"*\"]', NULL, '2021-12-02 01:33:02', '2021-12-02 01:33:02'),
(159, 'App\\Models\\User', 1, 'webToken', 'c6b002666846d44ad0a0a6f97314c22881d9eafd2acc072a2897a3c8221a8ddc', '[\"*\"]', NULL, '2021-12-02 12:10:19', '2021-12-02 12:10:19'),
(160, 'App\\Models\\User', 1, 'webToken', '9e0a782a793c1690c32313d3e46610eff5d263569e1fa3fca16f7954698ef892', '[\"*\"]', NULL, '2021-12-03 07:43:48', '2021-12-03 07:43:48'),
(161, 'App\\Models\\User', 1, 'webToken', '59cc9eb3ea284b20be0e5c31cc7f380eda112e9e802b86a855ecabd09c3d8708', '[\"*\"]', NULL, '2021-12-03 08:38:06', '2021-12-03 08:38:06'),
(162, 'App\\Models\\User', 1, 'webToken', 'bad4a60c3f98e2bf2b31e09076d150b0e8010080647a08266d6ff3619a749dba', '[\"*\"]', NULL, '2021-12-03 12:06:34', '2021-12-03 12:06:34'),
(163, 'App\\Models\\User', 1, 'webToken', 'a5d5e2abbecabc1b95140c20ed639efb2fdd6049f0319c980bc48d98c4632c10', '[\"*\"]', NULL, '2021-12-04 01:23:21', '2021-12-04 01:23:21'),
(164, 'App\\Models\\User', 1, 'webToken', '89c8c61af06e3eb35998eb8eb46f46e62ad95a527fd72d975b52a0d49e5f62b9', '[\"*\"]', NULL, '2021-12-04 01:23:45', '2021-12-04 01:23:45'),
(165, 'App\\Models\\User', 1, 'webToken', 'f4412466c723a75b8571ae6d5aadb39258de85f1288803b722573b4a1570a8c1', '[\"*\"]', NULL, '2021-12-04 01:23:51', '2021-12-04 01:23:51'),
(166, 'App\\Models\\User', 1, 'webToken', '2242f6f95b5666d106b420378795067e2bf71298563e09a9af5cf345fd184a72', '[\"*\"]', NULL, '2021-12-04 11:12:27', '2021-12-04 11:12:27'),
(167, 'App\\Models\\User', 1, 'webToken', '58dc6f4669054e6b93da1d0a5bdedc98e0b56d1710be43f1248a24b66ca37a72', '[\"*\"]', NULL, '2021-12-04 11:23:30', '2021-12-04 11:23:30'),
(168, 'App\\Models\\User', 1, 'webToken', '8ffd2feee8d837176614fdc8d84e69414cd4e759d303862d9f73f1bc9f7ff753', '[\"*\"]', NULL, '2021-12-04 11:56:01', '2021-12-04 11:56:01'),
(169, 'App\\Models\\User', 1, 'webToken', 'b95c51fa584824384114670318993a4222acdc4588833954242f0d5b56571933', '[\"*\"]', NULL, '2021-12-04 12:00:52', '2021-12-04 12:00:52'),
(170, 'App\\Models\\User', 1, 'webToken', 'bcf1d11870fbd3e9ad66262799637ad8ac4c3e508b17796141b1b75031a18311', '[\"*\"]', NULL, '2021-12-05 05:47:34', '2021-12-05 05:47:34'),
(171, 'App\\Models\\User', 1, 'webToken', 'be2c2a013b1cb2c83faf418dba73404758d8c132df1ea0b5c88b61d27775784a', '[\"*\"]', NULL, '2021-12-05 07:06:19', '2021-12-05 07:06:19'),
(172, 'App\\Models\\User', 1, 'webToken', 'cd7453471bd2da6440bae84afe593c27b0145334ff209213948cd847b57bdf5e', '[\"*\"]', NULL, '2021-12-05 07:07:20', '2021-12-05 07:07:20'),
(173, 'App\\Models\\User', 1, 'webToken', '7a3893f6f5f61f9421086ae8d763f3c9d8322177b46cc9f9ae5b760ca743089f', '[\"*\"]', NULL, '2021-12-05 07:10:14', '2021-12-05 07:10:14'),
(174, 'App\\Models\\User', 1, 'webToken', 'f3955988c0b0e0e128d1b4f06b2a526b242368bf3002719ae8a71f8cb0349b8b', '[\"*\"]', NULL, '2021-12-05 07:44:08', '2021-12-05 07:44:08');

-- --------------------------------------------------------

--
-- Table structure for table `portfolios`
--

CREATE TABLE `portfolios` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) DEFAULT NULL,
  `image3` varchar(255) DEFAULT NULL,
  `category` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `portfolios`
--

INSERT INTO `portfolios` (`id`, `name`, `image1`, `image2`, `image3`, `category`, `link`, `created_at`, `updated_at`) VALUES
('94b93721-80de-4b3c-a466-cdf5c6dddb0d', 'App 1', 'portfolioImages/bmkfEKkAkWxRE217l0QNhzF9G3ONJ7j2bAGOq0wb.jpg', 'portfolioImages/8ZZFNKyuo3hkP0AzWwYE6o8mIUmrt7gAWQn0magx.jpg', 'portfolioImages/oxSsk8oNcTiK35fs12LNaibPiNXcFoHpILiU2dIV.jpg', 'Mobile App', 'https://www.google.', '2021-10-26 02:09:08', '2021-11-17 13:18:11'),
('94e24e2b-836a-4fd1-bc1f-88e7a115c110', 'ABC Portfolio', 'portfolioImages/OQ48bGrGtvKn9f8WmPyUCe0jIhmlm62K03HCR1Ok.jpg', 'portfolioImages/VIYYaCLeJlHZVo8YES9xCg9eF1qM1pCQYd41He6L.jpg', 'portfolioImages/BXKneuxWXyFl2fNJlLExpxwqNPadcgYLoTgCRhk1.jpg', 'Web App', 'http://acb.com', '2021-11-15 12:22:30', '2021-11-17 04:47:15'),
('94e5a74a-b912-4c8c-a89e-e86dcd1e783a', 'New Portfolio', 'portfolioImages/XBKKkbE6Yn9meOvf2UYocK02IQfduVDTBYg0DDO3.jpg', 'portfolioImages/9cd8dBIQs6Vdpqnji0chuEDthVaYrCbS9UUslYDb.jpg', 'portfolioImages/GsGMb3wtBJbJsXgrYPNdXcuCcPQqZIFSYHGCAsB7.jpg', 'Mobile App', 'http://portfolio.com', '2021-11-17 04:19:11', '2021-11-17 13:04:06'),
('94e66e19-6585-4e7c-8e24-6ff1c7151556', 'Updated Name', 'portfolioImages/ZJSxzM7u7SpPnPkNQVNjyjEhAAxRFDUFGFx0UdxO.jpg', 'portfolioImages/vwqSlejhY6YVM7W8hY6U2pxePyWO1WlT5HyJa6Vj.jpg', 'portfolioImages/0VLclB8nPQ0YSvsdXMQ7ZnyUaPFzmkdUKFVntQ2a.jpg', 'Web App', 'http://asdf', '2021-11-17 13:35:05', '2021-11-17 13:35:32');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `director` varchar(255) NOT NULL,
  `camera_man` varchar(255) NOT NULL,
  `responsible_partner` varchar(2555) NOT NULL,
  `address` text NOT NULL,
  `address_2` text NOT NULL,
  `wardrobe_fitting_date` date NOT NULL,
  `recording_date` date NOT NULL,
  `industry` varchar(255) NOT NULL,
  `security_period` varchar(255) NOT NULL,
  `casting_instruction` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `owner`, `director`, `camera_man`, `responsible_partner`, `address`, `address_2`, `wardrobe_fitting_date`, `recording_date`, `industry`, `security_period`, `casting_instruction`, `video`, `created_at`, `updated_at`) VALUES
('9503a178-ecb0-4ef0-aaf5-69d7abee9119', 'Working On API\'s', 'Khalid Kamal', 'Shafi Ullah', 'Zia ud Din', 'Khalid Khatak', 'Lahore', 'Islamabad', '2018-12-31', '2018-01-02', 'ShahiSpace', '1-Month', 'Lorem ipsum....', 'videos/fO9TyH3e82PpMuA5cI9nH4LRDDtR5JIUWQa2vBke.mp4', '2021-12-02 01:57:45', '2021-12-02 01:57:45'),
('950a4081-04d6-4674-b30b-37337df15a5b', 'HP-Solid Ind', 'Gul Khan', 'Zabih Ullah', 'Zakir Ullah', 'Alam Gul', 'Pakistan Lahore', 'Pakistan Karachi', '2021-12-31', '2022-12-31', 'ShahiSpace', '2-Months', 'Casting Instructions details', 'videos/lcblSDA8XbVWiPHoAOZS6KbYrwB6sDRrk3Jaq3Un.mp4', '2021-12-05 08:57:24', '2021-12-05 08:59:18'),
('950a40ef-b7b8-4f84-8221-2b1cd174739c', 'Gold & Gyms', 'Gul Khan', 'Iftikhar Alam', 'Gul Said', 'Roman Rahim', 'Karachi Pakisatn', 'Islamabad Pakisatan', '2021-12-05', '2021-12-23', 'ShahiSpace', '3-Months', 'Casting instruction details', 'videos/hUeQdOALgLTClyiosmKJRjsSgBvYPyYIFvpcMtMS.mp4', '2021-12-05 08:58:36', '2021-12-05 08:58:36');

-- --------------------------------------------------------

--
-- Table structure for table `project_roles`
--

CREATE TABLE `project_roles` (
  `id` varchar(255) NOT NULL,
  `project_id` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price_tag` varchar(255) NOT NULL,
  `vacant` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project_roles`
--

INSERT INTO `project_roles` (`id`, `project_id`, `gender`, `age`, `description`, `price_tag`, `vacant`, `created_at`, `updated_at`) VALUES
('950a3715-27f1-4914-98ec-69462809b881', '9503a178-ecb0-4ef0-aaf5-69d7abee9119', 'Female', '45', 'Role 1', 'Price tag for this role', 'Yes', '2021-12-05 08:31:03', '2021-12-05 08:31:03'),
('950a4165-c26b-4320-be71-c7c6d578ebcd', '950a4081-04d6-4674-b30b-37337df15a5b', 'Male', '23', 'Role 2', 'pricing tag', 'Yes', '2021-12-05 08:59:54', '2021-12-05 08:59:54'),
('950a4915-79e5-4dc9-98b3-9c15af8d20ca', '950a4081-04d6-4674-b30b-37337df15a5b', 'Female', '56', 'Role 3', 'Price tag for this roleasd', 'Yes', '2021-12-05 09:21:23', '2021-12-05 09:21:23'),
('950a4947-c051-4f07-bf14-15a34fc35c87', '950a40ef-b7b8-4f84-8221-2b1cd174739c', 'Female', '23', 'Role 4', 'Price tag for this roleasd', 'Yes', '2021-12-05 09:21:56', '2021-12-05 09:21:56'),
('d50a3715-37f1-4914-98ec-69462809b881', '9503a178-ecb0-4ef0-aaf5-69d7abee9119', 'Female', '45', 'Role 5', 'Price tag for this role', 'Yes', '2021-12-05 08:31:03', '2021-12-05 08:31:03');

-- --------------------------------------------------------

--
-- Table structure for table `selected_projects`
--

CREATE TABLE `selected_projects` (
  `id` varchar(255) NOT NULL,
  `project_id` varchar(255) NOT NULL,
  `selected_by_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0lZiNZXuBh1Fni6wLcJzsT52FYFoPBsp5eGkTzHZ', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.45 Safari/537.36', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiRXFQVldObjFnYTJ2UXloS2JDYm1IblRYNHdUM2E2UHo4SUdmcEJxaiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo4NToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL3Byb2plY3Rfcm9sZXMvc2VsZWN0Lzk1MDNhMTc4LWVjYjAtNGVmMC1hYWY1LTY5ZDdhYmVlOTExOSI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQwOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcHJvamVjdF9zZWxlY3Rpb25zIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjEwOiJhdXRoX3Rva2VuIjtzOjQ0OiIxNzR8a3RnMnJGTVY0YW5sMmhzTXRFdEhhNElRRWZ5ejJvSXhYSzBzSXdMZiI7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCRvdmJwOGNDZDgvV05wNmh1V1ZlTnZlVmV4Y1BQdVpPbWRwSGRyclFCa2ZQckFld05EZTJoQyI7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTAkb3ZicDhjQ2Q4L1dOcDZodVdWZU52ZVZleGNQUHVaT21kcEhkcnJRQmtmUHJBZXdORGUyaEMiO30=', 1638731740);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `site_setting`
--

CREATE TABLE `site_setting` (
  `id` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `talent`
--

CREATE TABLE `talent` (
  `id` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `hair_color` varchar(255) DEFAULT NULL,
  `eyes_color` varchar(255) NOT NULL,
  `hair` varchar(255) NOT NULL,
  `skin_color` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `height` varchar(255) NOT NULL,
  `shirt_size` varchar(255) NOT NULL,
  `pant_size` varchar(255) NOT NULL,
  `shoes_size` varchar(255) NOT NULL,
  `body` varchar(255) NOT NULL,
  `id_number` varchar(255) NOT NULL,
  `home_telephone` varchar(255) NOT NULL,
  `cellular` varchar(255) NOT NULL,
  `has_whatsapp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `city_of_residence` varchar(255) NOT NULL,
  `country_of_origin` varchar(255) NOT NULL,
  `drive_motorcycle` varchar(255) NOT NULL,
  `has_license` varchar(255) NOT NULL,
  `drive_car` varchar(255) NOT NULL,
  `manual_drives` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `bank_account` varchar(255) NOT NULL,
  `number_type_of_account_holder` varchar(255) NOT NULL,
  `is_out_of_the_city` varchar(255) NOT NULL,
  `city_date_of_return` date NOT NULL,
  `is_out_of_the_country` varchar(255) NOT NULL,
  `country_date_of_return` date NOT NULL,
  `has_brackets` varchar(255) NOT NULL,
  `date_of_withdrawal_of_brackets` date NOT NULL,
  `has_nails` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `hair_cut` varchar(255) NOT NULL,
  `hair_lighter` varchar(255) NOT NULL,
  `darken` varchar(255) NOT NULL,
  `tattoos` varchar(255) NOT NULL,
  `how_many_tattoos` varchar(255) NOT NULL,
  `have_cars` varchar(255) NOT NULL,
  `how_many_cars` varchar(255) NOT NULL,
  `places` varchar(255) NOT NULL,
  `mark` varchar(255) NOT NULL,
  `long_` varchar(255) NOT NULL,
  `rights` varchar(255) NOT NULL,
  `have_desease` varchar(255) NOT NULL,
  `which_desease` varchar(255) NOT NULL,
  `have_allergies` varchar(255) NOT NULL,
  `which_allergies` varchar(255) NOT NULL,
  `diet` varchar(255) NOT NULL,
  `blood_group` varchar(255) NOT NULL,
  `sporting_activities` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `talent`
--

INSERT INTO `talent` (`id`, `first_name`, `last_name`, `hair_color`, `eyes_color`, `hair`, `skin_color`, `gender`, `height`, `shirt_size`, `pant_size`, `shoes_size`, `body`, `id_number`, `home_telephone`, `cellular`, `has_whatsapp`, `email`, `dob`, `city_of_residence`, `country_of_origin`, `drive_motorcycle`, `has_license`, `drive_car`, `manual_drives`, `address`, `location`, `bank_account`, `number_type_of_account_holder`, `is_out_of_the_city`, `city_date_of_return`, `is_out_of_the_country`, `country_date_of_return`, `has_brackets`, `date_of_withdrawal_of_brackets`, `has_nails`, `color`, `hair_cut`, `hair_lighter`, `darken`, `tattoos`, `how_many_tattoos`, `have_cars`, `how_many_cars`, `places`, `mark`, `long_`, `rights`, `have_desease`, `which_desease`, `have_allergies`, `which_allergies`, `diet`, `blood_group`, `sporting_activities`, `created_at`, `updated_at`) VALUES
('9507d89b-e32b-4975-9283-041c1be7ddab', 'Updated', 'Updated', 'Black', 'Light', 'Churos', 'Trigueño', 'Female', '34', 'S', 'M', '46', 'Skinny', '12', '3005974777', 'cellular UPdatedd', 'Yes', 'Gul@gmail.com', '2017-11-30', 'res city Up', 'city origin UP', 'No', 'Yes', 'Yes', 'Yes', 'Updated address', 'locations uopd', '12345676789', '1233434124', 'Yes', '2019-12-30', 'Yes', '2018-12-31', 'Yes', '2019-12-30', 'Yes', 'brown', 'Yes', 'Yes', 'Yes', 'Yes', '5 tattoos Up', 'Yes', 'how many cars Up', 'places UPd', 'marks Upd', 'longsv Upd', 'Photo', 'Yes', 'wch dsz Upd', 'Yes', 'wch alrgz UPd', 'Carnibora', 'B+', 'Dance', '2021-12-04 04:15:14', '2021-12-04 05:11:48');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Arqam Saeed', 'arqam@gmail.com', NULL, '$2y$10$ovbp8cCd8/WNp6huWVeNveVexcPPuZOmdpHdrrQBkfPrAewNDe2hC', NULL, NULL, NULL, NULL, NULL, '2021-10-14 04:46:44', '2021-11-03 03:07:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
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
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_roles`
--
ALTER TABLE `project_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `selected_projects`
--
ALTER TABLE `selected_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_setting`
--
ALTER TABLE `site_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `talent`
--
ALTER TABLE `talent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

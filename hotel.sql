-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2026 at 02:50 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`id`, `name`) VALUES
(5, 'Air Conditioning'),
(12, 'Bathrobe & Slippers'),
(11, 'Bathtub'),
(21, 'Butler Service'),
(6, 'Coffee Maker'),
(16, 'Connecting Rooms'),
(15, 'Crib Available'),
(20, 'Day Bed'),
(23, 'Dining Area'),
(2, 'Flat-screen TV'),
(1, 'Free Wi-Fi'),
(17, 'Garden Access'),
(25, 'Jacuzzi'),
(14, 'Kids Amenity Kit'),
(3, 'Mini Bar'),
(9, 'Ocean View'),
(26, 'Panoramic View'),
(19, 'Pool Access'),
(8, 'Premium Toiletries'),
(18, 'Private Patio'),
(22, 'Private Study'),
(13, 'Private Terrace'),
(4, 'Room Service'),
(7, 'Safe Box'),
(10, 'Sitting Area'),
(24, 'Walk-in Closet');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `secret_key` char(40) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `reservation_id`, `secret_key`, `expires_at`, `created_at`) VALUES
(1, 33, 'BK_69B14FB268F9B9A1428BBA30', NULL, '2026-07-25 16:08:09'),
(2, 34, 'BK_03CDB1F8A2A98940F6B3FD58', NULL, '2026-07-25 16:15:57'),
(3, 8, 'ABC', NULL, '2026-07-25 17:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `phone_number` varchar(40) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `first_name`, `last_name`, `phone_number`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', 'Admin', '09123456789', '2026-07-21 09:48:46', '2026-07-21 09:48:46'),
(3, 3, 'Justine', 'Carl', '9827364678', '2026-07-25 04:15:40', '2026-07-25 04:15:40'),
(4, 4, 'dsa', 'dsa', '9279845127', '2026-07-25 07:33:34', '2026-07-25 07:33:34'),
(6, 5, 'Justine', 'Carl', '321321321', '2026-07-25 13:25:01', '2026-07-25 13:25:01'),
(7, 6, 'Justine', 'Carl', '321321321', '2026-07-25 13:26:40', '2026-07-25 13:26:40'),
(8, 7, 'Leinox', 'Saraspe', '039213782183721', '2026-07-25 13:44:21', '2026-07-25 13:44:21'),
(9, 8, 'Leinox', 'Saraspe', '321321', '2026-07-25 13:45:01', '2026-07-25 13:45:01'),
(12, 11, 'Test', 'test', '2131321', '2026-07-25 13:50:38', '2026-07-25 13:50:38'),
(13, 12, 'jahnelle', 'caudilla', '321312321', '2026-07-25 15:15:07', '2026-07-25 15:15:07');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `payment_reference` varchar(20) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `transaction_reference` varchar(100) DEFAULT NULL,
  `paid_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `payment_reference`, `reservation_id`, `payment_method_id`, `status_id`, `amount`, `transaction_reference`, `paid_at`, `created_at`, `updated_at`) VALUES
(16, 'PAY-001', 7, 2, 2, 19278.00, NULL, '2026-07-25 04:11:24', '2026-07-25 01:52:12', '2026-07-25 02:11:24'),
(18, 'PAY-017', 8, 2, 2, 2052.00, NULL, '2026-07-25 15:15:20', '2026-07-25 13:15:20', '2026-07-25 13:15:20'),
(19, 'PAY-019', 31, 1, 3, 19278.00, '3213123123213', NULL, '2026-07-25 15:27:44', '2026-07-25 16:19:37'),
(20, 'PAY-020', 32, 2, 1, 684.00, 'CARD-20260725175240-286E44', NULL, '2026-07-25 15:52:40', '2026-07-25 15:52:40'),
(21, 'PAY-021', 33, 2, 4, 1368.00, 'CARD-20260725180809-D4FA7A', NULL, '2026-07-25 16:08:09', '2026-07-25 17:09:03'),
(22, 'PAY-022', 34, 3, 4, 12852.00, NULL, NULL, '2026-07-25 16:15:57', '2026-07-25 17:15:43');

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`) VALUES
(2, 'Card'),
(3, 'Cash'),
(1, 'GCash');

-- --------------------------------------------------------

--
-- Table structure for table `payment_statuses`
--

CREATE TABLE `payment_statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_statuses`
--

INSERT INTO `payment_statuses` (`id`, `name`) VALUES
(4, 'Cancelled'),
(2, 'Paid'),
(1, 'Pending'),
(3, 'Refunded');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `booking_reference` varchar(20) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `number_of_guests` int(11) NOT NULL,
  `requests` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `booking_reference`, `customer_id`, `room_id`, `status_id`, `check_in`, `check_out`, `number_of_guests`, `requests`, `created_at`, `updated_at`) VALUES
(7, 'GH-2026-0001', 1, 37, 2, '2026-08-01', '2026-08-11', 2, '', '2026-07-25 01:47:09', '2026-07-25 09:06:06'),
(8, 'GH-2026-0002', 1, 39, 3, '2026-07-25', '2026-07-31', 2, '', '2026-07-25 04:03:04', '2026-07-25 17:58:25'),
(9, 'GH-2026-0003', 1, 39, 1, '2026-08-01', '2026-08-04', 2, '', '2026-07-25 04:04:51', '2026-07-25 04:04:51'),
(21, 'GH-2026-0010', 12, 37, 1, '2026-08-11', '2026-08-19', 2, '', '2026-07-25 13:51:01', '2026-07-25 14:10:50'),
(31, 'GH-2026-0022', 13, 37, 2, '2026-07-25', '2026-07-31', 2, '', '2026-07-25 15:27:44', '2026-07-25 15:28:08'),
(32, 'GH-2026-0032', 13, 39, 1, '2026-08-19', '2026-08-21', 1, '', '2026-07-25 15:52:40', '2026-07-25 15:52:40'),
(33, 'GH-2026-0033', 13, 39, 4, '2026-08-25', '2026-08-29', 1, '', '2026-07-25 16:08:09', '2026-07-25 17:09:03'),
(34, 'GH-2026-0034', 13, 37, 4, '2026-08-21', '2026-08-25', 1, '', '2026-07-25 16:15:57', '2026-07-25 17:15:43');

-- --------------------------------------------------------

--
-- Table structure for table `reservation_statuses`
--

CREATE TABLE `reservation_statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation_statuses`
--

INSERT INTO `reservation_statuses` (`id`, `name`) VALUES
(4, 'Cancelled'),
(3, 'Checked Out'),
(2, 'Confirmed'),
(1, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `room_number` int(11) NOT NULL,
  `price_per_night` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `size` decimal(6,2) NOT NULL COMMENT 'Square foot',
  `bed_type` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_name`, `room_type_id`, `room_number`, `price_per_night`, `capacity`, `size`, `bed_type`, `description`, `status_id`) VALUES
(37, 'Deluxe Ocean Suite', 1, 121, 3213, 2, 424.00, '1 King Bed', 'dsadadasdas', 1),
(38, 'Extra Room Suite', 1, 202, 3, 2, 123.00, '1 King Bed', '', 2),
(39, 'This is suite', 1, 424, 342, 2, 32.00, '1 King Bed + 2 Queen Bed + Mama mo', 'ABC', 1),
(40, 'Testing', 2, 505, 321332, 2, 424.00, '1 King Bed + 2 Queen Bed + Mama mo', 'weqewqewqewq', 1),
(42, 'Deluxe Ocean Suiteea', 3, 222, 213, 2, 242.00, '1 King Bed + 2 Queen Bed', 'Test', 1);

-- --------------------------------------------------------

--
-- Table structure for table `room_amenities`
--

CREATE TABLE `room_amenities` (
  `room_id` int(11) NOT NULL,
  `amenity_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_amenities`
--

INSERT INTO `room_amenities` (`room_id`, `amenity_id`) VALUES
(37, 2),
(37, 3),
(37, 7),
(37, 8),
(37, 13),
(38, 2),
(38, 3),
(38, 8),
(39, 2),
(39, 8),
(42, 1),
(42, 2),
(42, 3),
(42, 4),
(42, 5);

-- --------------------------------------------------------

--
-- Table structure for table `room_images`
--

CREATE TABLE `room_images` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_images`
--

INSERT INTO `room_images` (`id`, `room_id`, `thumbnail`, `cover_image`, `created_at`, `updated_at`) VALUES
(2, 37, '6a64482370a67_1784956963.jpg', '6a64482370d3c_1784956963.jpg', '2026-07-22 15:11:58', '2026-07-25 05:22:43'),
(3, 38, '6a641654dc418_1784944212.jpg', '6a641654dc808_1784944212.jpg', '2026-07-25 01:50:12', '2026-07-25 01:50:12'),
(4, 39, '6a64342ce1b4c_1784951852.jpg', '6a64342ce1e9f_1784951852.jpg', '2026-07-25 03:57:32', '2026-07-25 03:57:32'),
(5, 40, '6a644850e224f_1784957008.png', '6a644850e24e7_1784957008.png', '2026-07-25 05:23:28', '2026-07-25 05:23:28'),
(6, 42, '6a646a008a642_1784965632.jpg', '6a646a008aa1b_1784965632.jpg', '2026-07-25 07:47:12', '2026-07-25 07:47:12');

-- --------------------------------------------------------

--
-- Table structure for table `room_statuses`
--

CREATE TABLE `room_statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_statuses`
--

INSERT INTO `room_statuses` (`id`, `name`) VALUES
(1, 'Available'),
(3, 'Maintenance'),
(2, 'Occupied');

-- --------------------------------------------------------

--
-- Table structure for table `room_types`
--

CREATE TABLE `room_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price_per_night` decimal(10,2) NOT NULL,
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_types`
--

INSERT INTO `room_types` (`id`, `name`, `description`, `price_per_night`, `capacity`) VALUES
(1, 'Standard', 'Comfortable, well-appointed rooms perfect for solo travelers or couples.', 189.00, 2),
(2, 'Deluxe', 'Spacious rooms with premium views and upgraded amenities.', 349.00, 3),
(3, 'Family Room', 'Generous spaces designed for families with kid-friendly features.', 429.00, 4),
(4, 'Suite', 'The ultimate in luxury with separate living areas and exclusive services.', 899.00, 6);

-- --------------------------------------------------------

--
-- Table structure for table `room_type_amenities`
--

CREATE TABLE `room_type_amenities` (
  `room_type_id` int(11) NOT NULL,
  `amenity_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_type_amenities`
--

INSERT INTO `room_type_amenities` (`room_type_id`, `amenity_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 10),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(2, 12),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 6),
(3, 7),
(3, 8),
(3, 9),
(3, 10),
(3, 11),
(3, 12),
(3, 13),
(3, 14),
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(4, 6),
(4, 7),
(4, 8),
(4, 9),
(4, 10),
(4, 11),
(4, 12),
(4, 13),
(4, 14);

-- --------------------------------------------------------

--
-- Table structure for table `stays`
--

CREATE TABLE `stays` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `checked_in_at` datetime DEFAULT NULL,
  `checked_out_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stays`
--

INSERT INTO `stays` (`id`, `reservation_id`, `checked_in_at`, `checked_out_at`, `created_at`) VALUES
(2, 8, '2026-07-25 17:30:34', '2026-07-26 01:58:25', '2026-07-25 09:30:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` tinyint(3) UNSIGNED NOT NULL DEFAULT 2,
  `created_at` int(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role_id`, `created_at`) VALUES
(1, 'admin@hotel.com', '$2y$10$Uq6/IXcJ5sAShbjW9NdujOlTDbJbQoKq1UB6De33qPXl8fJFsR1Iy', 1, 2147483647),
(3, 'loxuscarl@gmail.com', '$2y$10$kRsx.rpMhbZJhkDa9WrA1OHMrp6DOZHdi7GPCaxwU8S9GPGr1ZweC', 2, 2147483647),
(4, 'dsadl@gmail.com', '$2y$10$GatbgbDGnTHXGEWYU7Vaa.OvCOggEtbDTat6kSzjK20vtalope7sW', 2, 2147483647),
(5, 'caudilla@mail.com', '$2y$10$JdorKZOMdLkkIgmomTaFy.Kv/ckE/qE8VQ25mqQMZRzgtjuz9aj/m', 2, 2147483647),
(6, 'caudaaaailla@mail.com', '$2y$10$/TVUg8pJ0jNVnWCtBFBznOAKP7b/.gyyfvjQWl1R.sS0reX4lyF5C', 2, 2147483647),
(7, 'aw@mail.com', '$2y$10$m1NZNjvt05Z2ebN.zt3RSOyUNjoRANFABMWGKScF6aogp9jMR7HlO', 2, 2147483647),
(8, 'awit@mail.com', '$2y$10$n/D.IVKTbz0c30xupYBJyOyT1Z8y5Ljj5c636cVMKpEl/v6VU1dum', 2, 2147483647),
(11, 'test@mail.com', '$2y$10$XIQdC4JX7fPDYvEeCvK5I.kqgQFY4LWtLEelv2WvqWTeUtLwVNYva', 2, 2147483647),
(12, 'jahnellecaudilla1@gmail.com', '$2y$10$EIzPHvJU89yjJWMxrknJCeFfTblRAEmoNt4wwGoDw2Jb/Vu0c1clq', 2, 2147483647);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `name_2` (`name`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reservation_id` (`reservation_id`),
  ADD UNIQUE KEY `secret_key` (`secret_key`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_reference` (`payment_reference`),
  ADD KEY `fk_payment_reservation` (`reservation_id`),
  ADD KEY `fk_payment_method` (`payment_method_id`),
  ADD KEY `fk_payment_status` (`status_id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `payment_statuses`
--
ALTER TABLE `payment_statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `booking_reference` (`booking_reference`),
  ADD KEY `fk_reservation_room` (`room_id`),
  ADD KEY `fk_reservation_status` (`status_id`);

--
-- Indexes for table `reservation_statuses`
--
ALTER TABLE `reservation_statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_rooms_room_number` (`room_number`),
  ADD KEY `fk_room_type` (`room_type_id`),
  ADD KEY `fk_rooms_status` (`status_id`);

--
-- Indexes for table `room_amenities`
--
ALTER TABLE `room_amenities`
  ADD PRIMARY KEY (`room_id`,`amenity_id`),
  ADD KEY `amenity_id` (`amenity_id`);

--
-- Indexes for table `room_images`
--
ALTER TABLE `room_images`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `room_id` (`room_id`);

--
-- Indexes for table `room_statuses`
--
ALTER TABLE `room_statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `room_type_amenities`
--
ALTER TABLE `room_type_amenities`
  ADD PRIMARY KEY (`room_type_id`,`amenity_id`),
  ADD KEY `amenity_id` (`amenity_id`);

--
-- Indexes for table `stays`
--
ALTER TABLE `stays`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reservation_id` (`reservation_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_statuses`
--
ALTER TABLE `payment_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `reservation_statuses`
--
ALTER TABLE `reservation_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `room_images`
--
ALTER TABLE `room_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `room_statuses`
--
ALTER TABLE `room_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `room_types`
--
ALTER TABLE `room_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `stays`
--
ALTER TABLE `stays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `fk_bookings_reservation` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `fk_customer_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_payment_method` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`),
  ADD CONSTRAINT `fk_payment_reservation` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_payment_status` FOREIGN KEY (`status_id`) REFERENCES `payment_statuses` (`id`);

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `fk_room_type` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`id`),
  ADD CONSTRAINT `fk_rooms_status` FOREIGN KEY (`status_id`) REFERENCES `room_statuses` (`id`);

--
-- Constraints for table `room_amenities`
--
ALTER TABLE `room_amenities`
  ADD CONSTRAINT `room_amenities_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `room_amenities_ibfk_2` FOREIGN KEY (`amenity_id`) REFERENCES `amenities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `room_images`
--
ALTER TABLE `room_images`
  ADD CONSTRAINT `fk_room_images_room` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `room_type_amenities`
--
ALTER TABLE `room_type_amenities`
  ADD CONSTRAINT `room_type_amenities_ibfk_1` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `room_type_amenities_ibfk_2` FOREIGN KEY (`amenity_id`) REFERENCES `amenities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stays`
--
ALTER TABLE `stays`
  ADD CONSTRAINT `stays_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

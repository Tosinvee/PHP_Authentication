-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2024 at 10:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;

--
-- Database: `test_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
    `id` int(6) UNSIGNED NOT NULL,
    `username` varchar(25) NOT NULL,
    `email` varchar(255) NOT NULL,
    `password` varchar(125) NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO
    `users` (
        `id`,
        `username`,
        `email`,
        `password`,
        `created_at`
    )
VALUES (
        1,
        'Vicmar',
        'bayodeoluwatosin06@gmail.com',
        '$2y$10$F6s9FIp53NKZeWWK.wvf1eC2KIgZWH1CiFE.ID.TiT9ukR9k.Xd/.',
        '2024-06-21 23:30:29'
    ),
    (
        4,
        'shade',
        'bayodeoluwatosin@gmail.com',
        '$2y$10$aEu61heIxkYiJtzu1CJmS.zIWI9TZ5uUd3ZrwZ0YpsHG/zNRx9D3S',
        '2024-06-22 00:17:44'
    ),
    (
        8,
        'Oluwatosin_feranmi',
        'bayodeoluwatos@gmail.com',
        '$2y$10$Et8SqiqvMDMYjOE3otphfOLI0Y34olrp3nmBToyNyLx8VYbzVdgyS',
        '2024-06-24 05:30:14'
    );

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
ADD PRIMARY KEY (`id`),
ADD UNIQUE KEY `email` (`email`),
ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 9;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;
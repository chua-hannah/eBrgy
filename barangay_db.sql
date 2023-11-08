-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2023 at 09:31 PM
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
-- Database: `barangay_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time DEFAULT NULL,
  `status` enum('Present','Absent','Late') NOT NULL,
  `remark` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `user_id`, `username`, `date`, `time_in`, `time_out`, `status`, `remark`) VALUES
(1, 1, 'lance chua', '2023-07-21', '15:16:52', NULL, 'Late', ''),
(2, 1, 'lance chua', '2023-07-22', '00:09:57', '00:15:52', 'Present', ''),
(3, 2, 'kagawad1', '2023-07-22', '00:17:33', NULL, 'Present', ''),
(4, 3, 'kagawad2', '2023-07-22', '00:20:22', NULL, 'Present', ''),
(5, 4, 'kagawad3', '2023-07-22', '00:24:33', '00:32:49', 'Present', ''),
(6, 5, 'kagawad4', '2023-07-22', '00:42:44', '00:42:50', 'Present', ''),
(7, 6, 'kagawad5', '2023-07-22', '00:45:53', '00:45:55', 'Present', ''),
(8, 7, 'kagawad6', '2023-07-22', '00:47:05', '00:47:12', 'Present', ''),
(9, 1, 'lance chua', '2023-08-02', '20:12:08', '20:12:20', 'Late', ''),
(10, 1, 'lance chua', '2023-09-02', '13:12:44', '13:12:45', 'Present', ''),
(11, 1, 'lance chua', '2023-09-18', '21:12:48', '21:18:43', 'Late', ''),
(12, 1, 'kapitantest', '2023-10-18', '05:36:16', NULL, 'Present', ''),
(13, 1, 'kapitantest', '2023-11-06', '01:16:51', NULL, 'Present', ''),
(14, 1, 'kapitantest', '2023-11-07', '10:55:55', NULL, 'Late', '');

-- --------------------------------------------------------

--
-- Table structure for table `doc_requests`
--

CREATE TABLE `doc_requests` (
  `id` int(11) NOT NULL,
  `request_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `purpose` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `process_by` varchar(255) NOT NULL,
  `process_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doc_settings`
--

CREATE TABLE `doc_settings` (
  `request_type_id` int(11) NOT NULL,
  `request_name` varchar(255) NOT NULL,
  `request_status` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doc_settings`
--

INSERT INTO `doc_settings` (`request_type_id`, `request_name`, `request_status`, `description`, `created_at`) VALUES
(1, 'firstjob certificate', '0', 'Certificates', '2023-07-20'),
(2, 'indigency certificate', '1', 'Birth Certificate', '2023-07-20'),
(3, 'barangay certificate', '1', 'Taxpayer Identification Number', '2023-07-20'),
(4, 'oath certificate', '1', 'POST OFFICE VALID ID', '2023-09-18');

-- --------------------------------------------------------

--
-- Table structure for table `equipment_requests`
--

CREATE TABLE `equipment_requests` (
  `id` int(11) NOT NULL,
  `equipment_id` int(50) NOT NULL,
  `equipment_name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `total_equipment_borrowed` int(11) DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `process_by` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `process_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `process_return` varchar(255) NOT NULL,
  `returned_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `equipment_settings`
--

CREATE TABLE `equipment_settings` (
  `equipment_id` int(11) NOT NULL,
  `equipment_name` varchar(255) NOT NULL,
  `total_equipment` int(11) NOT NULL,
  `availability` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment_settings`
--

INSERT INTO `equipment_settings` (`equipment_id`, `equipment_name`, `total_equipment`, `availability`) VALUES
(1, 'plastic chair', 1, '0'),
(2, 'plastic table', 5, '0'),
(3, 'router', 0, '1'),
(4, 'Jack Hammer', 23, '1'),
(5, 'NMAX', 100, '1'),
(6, 'NMAX', 100, '1'),
(7, 'VESPA JB limited edition', 23, '1'),
(8, 'Truck', 0, '1'),
(9, 'Karaoke', 10, '1');

-- --------------------------------------------------------

--
-- Table structure for table `health_info`
--

CREATE TABLE `health_info` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `VAX1` varchar(255) DEFAULT NULL,
  `VAX2` varchar(255) DEFAULT NULL,
  `VAX3` varchar(255) DEFAULT NULL,
  `VAX4` varchar(255) DEFAULT NULL,
  `test2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `health_info`
--

INSERT INTO `health_info` (`id`, `firstname`, `middlename`, `lastname`, `age`, `VAX1`, `VAX2`, `VAX3`, `VAX4`, `test2`) VALUES
(1, 'batangqc', 'batangqc', 'batangqc', 18, NULL, NULL, NULL, NULL, NULL),
(2, 'Reynaldo', '', 'Reyes', 33, NULL, NULL, NULL, NULL, NULL),
(3, 'Giannis', 'test', 'qweqweqwe', 24, NULL, NULL, NULL, NULL, NULL),
(4, 'Edgardo', '', 'Feliciano', 40, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `home_setting`
--

CREATE TABLE `home_setting` (
  `id` int(11) NOT NULL,
  `announcement_text` varchar(255) DEFAULT NULL,
  `mission_text` varchar(255) DEFAULT NULL,
  `vision_text` varchar(255) DEFAULT NULL,
  `slide1` varchar(255) DEFAULT NULL,
  `slide2` varchar(255) DEFAULT NULL,
  `slide3` varchar(255) DEFAULT NULL,
  `slide4` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `messenger` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home_setting`
--

INSERT INTO `home_setting` (`id`, `announcement_text`, `mission_text`, `vision_text`, `slide1`, `slide2`, `slide3`, `slide4`, `contact`, `facebook`, `messenger`) VALUES
(1, 'We have a Feeding Program this upcoming Sunday, November 12. \r\nLet\'s come together to nourish our community. \r\nVolunteers and donations welcome!', '\"Our mission is to provide a safe, inclusive, and empowered community where residents can thrive. We are committed to delivering efficient and responsive public services, fostering unity among our residents, and promoting sustainable development for the b', 'Our vision is to become a model Barangay known for its harmonious and resilient community. We aspire to create an environment where every resident enjoys a high quality of life, has access to essential services, and actively participates in the decision-m', '370827994_677871561041615_6287721289644807065_n.jpg', '370827994_677871561041615_6287721289644807065_n.jpg', 'cityhall2022-05-0823-02-37_2022-07-15_23-10-24.jpg', 'officials_photo.jpg', '8-294-47-66', 'https://www.facebook.com/Barangay95/', 'm.me/Barangay95/');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `seen` tinyint(1) DEFAULT NULL,
  `contact_message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report_requests`
--

CREATE TABLE `report_requests` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `reported_person` varchar(255) NOT NULL,
  `subject_person` varchar(255) NOT NULL,
  `place_of_incident` varchar(255) NOT NULL,
  `date_of_incident` date NOT NULL,
  `time_of_incident` time NOT NULL,
  `note` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `process_at` timestamp NULL DEFAULT NULL,
  `process_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_requests`
--

CREATE TABLE `schedule_requests` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `schedule_date` date DEFAULT NULL,
  `time_in` time DEFAULT NULL,
  `time_out` time DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `process_at` timestamp NULL DEFAULT NULL,
  `process_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `time_settings`
--

CREATE TABLE `time_settings` (
  `setting_id` int(11) UNSIGNED NOT NULL,
  `work_hours_start` time DEFAULT NULL,
  `work_hours_end` time DEFAULT NULL,
  `late_threshold` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `time_settings`
--

INSERT INTO `time_settings` (`setting_id`, `work_hours_start`, `work_hours_end`, `late_threshold`) VALUES
(1, '10:20:00', '20:00:00', '10:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `sex` varchar(100) NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `senior` tinyint(1) DEFAULT NULL,
  `four_ps` tinyint(1) DEFAULT NULL,
  `pwd` tinyint(1) DEFAULT NULL,
  `solo_parent` tinyint(1) DEFAULT NULL,
  `scholar` tinyint(1) DEFAULT NULL,
  `id_selfie` varchar(255) DEFAULT NULL,
  `valid_id` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `mobile`, `firstname`, `middlename`, `lastname`, `address`, `birthdate`, `age`, `sex`, `role`, `position`, `senior`, `four_ps`, `pwd`, `solo_parent`, `scholar`, `id_selfie`, `valid_id`, `status`) VALUES
(1, 'chairman', 'qweasdzxc', 'chairman', '+639999999999', 'Ronnie', 'M', 'Lee', 'Tondo', '1986-06-17', 37, 'Male', 'captain', 'captain', NULL, NULL, NULL, NULL, NULL, 'Ronald_M._Lee.png', '8.png', 'activated'),
(2, 'kagawadrey', 'pass1234', 'ReynaldoReyes19@gmail.com', '+639786453434', 'Reynaldo', '', 'Reyes', 'Tondo', '1990-01-19', 33, 'Male', 'kagawad', 'councilor', 0, 0, 0, 0, 0, 'Reynaldo_Reyes.png', '8.png', 'activated'),
(3, 'kagawadedgar', 'pass1234', 'kagawadEd@gmail.com', '+639611231231', 'Edgardo', '', 'Feliciano', 'Tondo', '1982-12-25', 40, 'Male', 'kagawad', 'councilor', 0, 0, 0, 0, 0, 'Edgardo_Feliciano.png', '8.png', 'activated');

-- --------------------------------------------------------

--
-- Table structure for table `users_masterlist`
--

CREATE TABLE `users_masterlist` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `senior` tinyint(1) DEFAULT NULL,
  `pwd` tinyint(1) DEFAULT NULL,
  `four_ps` tinyint(1) DEFAULT NULL,
  `solo_parent` tinyint(1) DEFAULT NULL,
  `scholar` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_masterlist`
--

INSERT INTO `users_masterlist` (`id`, `email`, `mobile`, `firstname`, `middlename`, `lastname`, `address`, `birthdate`, `age`, `gender`, `role`, `position`, `senior`, `pwd`, `four_ps`, `solo_parent`, `scholar`) VALUES
(1, 'batangqc@mail.com', '+639841238123', 'batangqc', 'batangqc', 'batangqc', 'Tondo', '2005-01-22', 18, 'Male', NULL, 'residence', 0, 0, 0, 0, 1),
(2, 'usersReport@mail.com', '+639612312312', 'Lebrong', 'King', 'James', 'Tondo', '2004-11-05', 19, 'Male', NULL, 'residence', 0, 1, 0, 0, 1),
(3, '11232131312@mail.com', '+639999999999', 'Giannis', 'test', 'qweqweqwe', 'Tondo', '1999-02-05', 24, 'Male', NULL, 'residence', 0, 0, 1, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_requests`
--
ALTER TABLE `doc_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_settings`
--
ALTER TABLE `doc_settings`
  ADD PRIMARY KEY (`request_type_id`);

--
-- Indexes for table `equipment_requests`
--
ALTER TABLE `equipment_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment_settings`
--
ALTER TABLE `equipment_settings`
  ADD PRIMARY KEY (`equipment_id`);

--
-- Indexes for table `health_info`
--
ALTER TABLE `health_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_setting`
--
ALTER TABLE `home_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_requests`
--
ALTER TABLE `report_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_requests`
--
ALTER TABLE `schedule_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_settings`
--
ALTER TABLE `time_settings`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_masterlist`
--
ALTER TABLE `users_masterlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `doc_requests`
--
ALTER TABLE `doc_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc_settings`
--
ALTER TABLE `doc_settings`
  MODIFY `request_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `equipment_requests`
--
ALTER TABLE `equipment_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `equipment_settings`
--
ALTER TABLE `equipment_settings`
  MODIFY `equipment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `health_info`
--
ALTER TABLE `health_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `home_setting`
--
ALTER TABLE `home_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_requests`
--
ALTER TABLE `report_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedule_requests`
--
ALTER TABLE `schedule_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `time_settings`
--
ALTER TABLE `time_settings`
  MODIFY `setting_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_masterlist`
--
ALTER TABLE `users_masterlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

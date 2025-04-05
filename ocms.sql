-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Mar 24, 2025 at 11:28 PM
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
-- Database: `ocms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','police_officer','support_personnel') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'admin', '$2y$10$zHXTLbYylmknMObFVkhAOu7CqV/YJ25RCm5NYyrxjQpIb2aOPRPBG', 'admin', '2025-03-06 21:22:29'),
(2, 'police1', '$2y$10$oCdRkkWN9sOXyJ8pvOg9mOzLVzQjmAwTa3zXEhIaJV6y3oZp/KIYS', 'police_officer', '2025-03-06 21:22:29'),
(3, 'support1', '$2y$10$BKhF3PeaXm11QeAQuV//ve3YRqfB6l3fLMRT3vStKQgcC2KXEjm2K', 'support_personnel', '2025-03-06 21:22:30');

-- --------------------------------------------------------

--
-- Table structure for table `cases`
--

CREATE TABLE `cases` (
  `id` int(11) NOT NULL,
  `citizen_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `status` enum('Unresolved','Under Investigation','Resolved') DEFAULT 'Unresolved',
  `escalation_requested` tinyint(1) DEFAULT 0,
  `escalation_reason` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cases`
--

INSERT INTO `cases` (`id`, `citizen_id`, `description`, `status`, `escalation_requested`, `escalation_reason`, `created_at`, `updated_at`) VALUES
(11, 2, 'Hit and run accident on Highway 21', 'Under Investigation', 0, 'I have some evidence ', '2025-03-01 16:22:21', '2025-03-01 16:24:32'),
(12, 3, 'Robbery at a bank in downtown', 'Under Investigation', 0, 'I have some evidence', '2025-03-01 16:22:21', '2025-03-24 15:03:08'),
(13, 4, 'Missing person report for a 15-year-old girl', 'Unresolved', 1, 'I have some evidence ', '2025-03-01 16:22:21', '2025-03-01 16:29:44'),
(14, 5, 'Vandalism at a public park', 'Unresolved', 1, 'I have some evidence', '2025-03-01 16:22:21', '2025-03-21 15:21:38'),
(20, 6, 'Hit and run accident near school', 'Unresolved', 0, NULL, '2025-03-22 09:18:52', '2025-03-22 09:18:52'),
(21, 7, 'Cybercrime fraud case', 'Unresolved', 0, NULL, '2025-03-22 09:18:52', '2025-03-22 09:18:52');

-- --------------------------------------------------------

--
-- Table structure for table `chatbot_logs`
--

CREATE TABLE `chatbot_logs` (
  `id` int(11) NOT NULL,
  `user_question` text NOT NULL,
  `bot_response` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chatbot_logs`
--

INSERT INTO `chatbot_logs` (`id`, `user_question`, `bot_response`, `timestamp`) VALUES
(1, 'what are the features', 'I\'m sorry, I couldn\'t find an answer. Try asking about crime reporting, complaint tracking, or website features.', '2025-02-21 09:38:36'),
(2, 'website features', 'I\'m sorry, I couldn\'t find an answer. Try asking about crime reporting, complaint tracking, or website features.', '2025-02-21 09:38:58'),
(3, 'crime reporting', 'To report a crime, go to the \'Report Crime\' section and fill in the form.', '2025-02-21 09:39:13'),
(4, 'website features', 'I\'m sorry, I couldn\'t find an answer. Try asking about crime reporting, complaint tracking, or website features.', '2025-02-21 09:39:24'),
(5, 'complaint tracking', 'You can check your complaint status in the \'Complaint Status\' section.', '2025-02-21 09:39:37'),
(6, 'report crime, complaint, how to report', 'To report a crime, go to the \'Report Crime\' section and fill in the form.', '2025-02-21 09:41:09'),
(7, 'what are the features', 'I\'m sorry, I couldn\'t find an answer. Try asking about crime reporting, complaint tracking, or website features.', '2025-02-21 09:48:19'),
(8, 'check status of complaints', 'Please provide your Complaint ID (e.g., \'Check status of complaint 3\').', '2025-02-21 09:48:39'),
(9, 'check status of complaints 5', 'Your complaint (ID: 5) status is: Pending', '2025-02-21 09:48:51'),
(10, 'what are the features', '🔹 Crime Reporting – Users can submit crime reports with details such as location, description, and images.\r\n🔹 Complaint Status Tracking – Users can check the status of their complaints (Pending, In Progress, Resolved).\r\n🔹 Crime Alerts & Notifications – Users receive email alerts if crimes occur near their location.\r\n🔹 Chatbot Assistance – Users can ask FAQs about the website, crime reporting, and complaint tracking.\r\n🔹 User Registration & Login – Secure authentication for citizens to track their reports.\r\n🔹 Emergency Contact Information – Quick access to police and emergency numbers.', '2025-02-25 14:33:50');

-- --------------------------------------------------------

--
-- Table structure for table `citizen_geolocation`
--

CREATE TABLE `citizen_geolocation` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `location_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `citizen_geolocation`
--

INSERT INTO `citizen_geolocation` (`id`, `email`, `latitude`, `longitude`, `location_name`) VALUES
(10, 'jananikodithuwakku124@gmail.com', 7.0516736, 80.5306368, 'Peradeniya');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `phone_number`, `message`, `created_at`) VALUES
(2, 'Janani', 'Janani@gmail.com', '0771563248', 'Great', '2025-02-04 09:15:41'),
(3, 'Janani', 'kodithuwakkujanani@gmail.com', '0712601635', 'This is Helpful system', '2025-03-08 20:21:51');

-- --------------------------------------------------------

--
-- Table structure for table `crime_reports`
--

CREATE TABLE `crime_reports` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `location` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `description` text NOT NULL,
  `evidence` varchar(255) DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crime_reports`
--

INSERT INTO `crime_reports` (`id`, `name`, `email`, `phone`, `location`, `date`, `description`, `evidence`, `submitted_at`, `latitude`, `longitude`, `status`, `notes`) VALUES
(1, 'Sakuni', 'Sakuni@gmail.com', '0712601635', 'kandy', '2025-02-05', 'Reported a robbery near Main Street.', 'uploads/5bf24714c10eaa291d159f27d261e845.jpg', '2025-02-05 14:29:02', NULL, NULL, 'In Progress', 'The suspect was taken into custody.'),
(2, 'Jani Kodi', 'kodithuwakkujanani@gmail.com', '0712601635', 'Embuldeniya, Mirihana, Sri Jayawardenepura Kotte, Colombo District, Western Province, 23010, Sri Lanka', '2025-02-05', 'Break-in attempt at a jewelry shop.', 'uploads/5e401c16552c52cb85da5f64abe73115.jpg', '2025-02-05 14:33:47', 6.87144960, 79.91132160, 'Resolved', 'Thank you for the support'),
(3, 'Kamal', 'kamal@gmail.com', '10234569', 'Sarana Mawatha, Udahamulla, Mirihana, Thalapathpitiya, Colombo District, Western Province, 10250, Sri Lanka', '2025-02-14', 'Witnessed a burglary at her neighbor’s house.', 'uploads/ABCLOGO.png', '2025-02-08 13:57:51', 6.86489600, 79.91459840, 'In Progress', 'The suspect was taken into custody.'),
(4, 'Mohan Raj', 'Mohan@gmail.com', '0712601635', 'Piligalla Road, Daulagala, Kandy District, Central Province, 20460, Sri Lanka', '2025-02-06', 'Pickpocketing incident at the train station.', 'uploads/Logo.png', '2025-02-08 14:05:22', 7.22899060, 80.58198110, 'Resolved', 'Thank you for the support '),
(5, 'Ganesh', 'Ganesh@gmail.com', '0712601635', 'Piligalla Road, Daulagala, Kandy District, Central Province, 20460, Sri Lanka', '2025-02-11', 'Mobile phone stolen at the beach.', 'uploads/Classification1 (2).ipynb', '2025-02-11 11:55:54', 7.22899570, 80.58197780, 'Pending', NULL),
(6, 'Kaveesha', 'Kavvesha@gmail.com', '0712601635', 'Piligalla Road, Daulagala, Kandy District, Central Province, 20460, Sri Lanka', '2025-02-11', 'Vandalism at a public park.', 'uploads/titanic_submission.csv', '2025-02-11 12:55:26', 7.22899170, 80.58197780, 'Pending', NULL),
(7, 'John Deo', 'JhonD@gmail.com', '0712601635', 'Dharmaratana Mawatha, Madiwela, Sri Jayawardenepura Kotte, Colombo District, Western Province, 23010, Sri Lanka', '2025-02-11', 'Attempted cyber fraud reported.', 'uploads/crime_reports.csv', '2025-02-11 13:41:04', 6.87472640, 79.92115200, 'Pending', NULL),
(8, 'Nimal Perera', 'Nimal@gmail.com', '0712601635', 'Dharmaratana Mawatha, Madiwela, Sri Jayawardenepura Kotte, Colombo District, Western Province, 23010, Sri Lanka', '2025-02-11', 'Illegal drug transaction spotted.', 'uploads/crime_reports.csv', '2025-02-11 13:41:09', 6.87472640, 79.92115200, 'Pending', NULL),
(9, 'Ravi Kumar', 'Ravi@gmail.com', '0712601635', 'Dharmaratana Mawatha, Madiwela, Sri Jayawardenepura Kotte, Colombo District, Western Province, 23010, Sri Lanka', '2025-02-11', 'Fake currency used at a supermarket.', 'uploads/analytics_report.csv', '2025-02-11 13:46:19', 6.87472640, 79.92115200, 'Pending', NULL),
(10, 'Binara', 'Binara@gmail.com', '0712601635', 'Dharmaratana Mawatha, Madiwela, Sri Jayawardenepura Kotte, Colombo District, Western Province, 23010, Sri Lanka', '2025-02-11', 'Mobile phone stolen at the bus stop.', 'uploads/analytics_report.csv', '2025-02-11 13:47:06', 6.87472640, 79.92115200, 'Pending', NULL),
(11, 'Janani', 'jananikodithuwakku124@gmail.com', '0712601635', 'Piligalla Road, Daulagala, Kandy District, Central Province, 20460, Sri Lanka', '2025-02-11', 'Hit and run case reported on A9 Road.', 'uploads/crime_reports.csv', '2025-02-11 13:48:37', 7.22899290, 80.58197600, 'In Progress', 'The suspect is taken into custody.'),
(13, 'Janani', 'jananikodithuwakku124@gmail.com', '0712601635', 'නාවලපිටිය, Kandy District, Central Province, 20650, Sri Lanka', '2025-03-04', 'A bank robbery occurred on Malwatta Street 5 minutes ago.', 'uploads/Home.png', '2025-03-24 10:22:25', 7.05167360, 80.53063680, 'Pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `keywords` text NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `keywords`, `answer`) VALUES
(1, 'report crime,complaint,how to report', 'To report a crime, go to the \'Report Crime\' section, fill in the required details, and submit.'),
(2, 'track complaint,status,check case', 'Log in and go to \'Complaint Status\' to check updates on your complaint.'),
(3, 'types of crime,reportable crimes', 'You can report crimes such as theft, assault, cybercrime, fraud, and more.'),
(4, 'confidential,safe,my data secure', 'Yes, all data you provide is strictly confidential and secured with encryption.'),
(5, 'contact police,emergency,911', 'You can contact the police by calling 911 or using the emergency contact section on our website.'),
(6, 'What are the Features', '🔹 Crime Reporting – Users can submit crime reports with details such as location, description, and images.\r\n🔹 Complaint Status Tracking – Users can check the status of their complaints (Pending, In Progress, Resolved).\r\n🔹 Crime Alerts & Notifications – Users receive email alerts if crimes occur near their location.\r\n🔹 Chatbot Assistance – Users can ask FAQs about the website, crime reporting, and complaint tracking.\r\n🔹 User Registration & Login – Secure authentication for citizens to track their reports.\r\n🔹 Emergency Contact Information – Quick access to police and emergency numbers.'),
(7, 'What are the Features', '🔹 Crime Reporting – Users can submit crime reports with details such as location, description, and images.\r\n🔹 Complaint Status Tracking – Users can check the status of their complaints (Pending, In Progress, Resolved).\r\n🔹 Crime Alerts & Notifications – Users receive email alerts if crimes occur near their location.\r\n🔹 Chatbot Assistance – Users can ask FAQs about the website, crime reporting, and complaint tracking.\r\n🔹 User Registration & Login – Secure authentication for citizens to track their reports.\r\n🔹 Emergency Contact Information – Quick access to police and emergency numbers.'),
(8, 'What are the Features', 'v');

-- --------------------------------------------------------

--
-- Table structure for table `police_officers`
--

CREATE TABLE `police_officers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `updates`
--

CREATE TABLE `updates` (
  `id` int(11) NOT NULL,
  `report_id` int(11) DEFAULT NULL,
  `update_text` text NOT NULL,
  `update_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `updates`
--

INSERT INTO `updates` (`id`, `report_id`, `update_text`, `update_date`) VALUES
(1, 1, 'fg', '2025-02-06 21:09:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `otp_code` varchar(6) DEFAULT NULL,
  `otp_expires_at` datetime DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT 0,
  `verification_code` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `otp_code`, `otp_expires_at`, `is_verified`, `verification_code`) VALUES
(2, 'janani', 'janani@gmail.com', '$2y$10$5ymcU1Fv3NND2iVSG42OCeN91Se46nkFkSRlYRjYM1VDxGCeemY.u', NULL, NULL, 0, NULL),
(3, 'janani', 'janani@gmail.com', '$2y$10$Gvuj0ha5k.0qhwrtSr1a6OJq7KTBMIW3s9/q/rhNI3TFmUsqq7fCa', NULL, NULL, 0, NULL),
(4, 'janani', 'kodithuwakkujanani@gmail.com', '$2y$10$hlHWJkIwPw6mgcW885Wp7u4SJariRWyV3hmAsdVJNKFzYOwnEfI7a', NULL, NULL, 1, NULL),
(5, 'janani', 'jananikodithuwakku124@gmail.com', '$2y$10$p9zX1.CQ.rMnLekXuOmOMexpDqI.XwkngOk2/INMipz/T0J1TynJ.', '297960', '2025-03-20 21:28:04', 0, 'affafc'),
(6, 'Don', 'Don@gmail.com', '$2y$10$ioIbuVE0a8LOeXq5lQcaA.Gevqtx36RXipQ8h2gRTn6.S5e/gUbzS', NULL, NULL, 0, NULL),
(7, 'Sam', 'Sam@gmail.com', '$2y$10$cVvc7dGtSLz4p4XK5xk/A.Ez7wBGcX5kBwA.h5Wc3XvXwwVShD5F2', NULL, NULL, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `cases`
--
ALTER TABLE `cases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `citizen_id` (`citizen_id`);

--
-- Indexes for table `chatbot_logs`
--
ALTER TABLE `chatbot_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `citizen_geolocation`
--
ALTER TABLE `citizen_geolocation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crime_reports`
--
ALTER TABLE `crime_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `police_officers`
--
ALTER TABLE `police_officers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `updates`
--
ALTER TABLE `updates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `report_id` (`report_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cases`
--
ALTER TABLE `cases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `chatbot_logs`
--
ALTER TABLE `chatbot_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `citizen_geolocation`
--
ALTER TABLE `citizen_geolocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `crime_reports`
--
ALTER TABLE `crime_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `police_officers`
--
ALTER TABLE `police_officers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `updates`
--
ALTER TABLE `updates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cases`
--
ALTER TABLE `cases`
  ADD CONSTRAINT `cases_ibfk_1` FOREIGN KEY (`citizen_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `updates`
--
ALTER TABLE `updates`
  ADD CONSTRAINT `updates_ibfk_1` FOREIGN KEY (`report_id`) REFERENCES `crime_reports` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

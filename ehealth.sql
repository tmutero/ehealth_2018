-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2018 at 05:38 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ehealth`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `status` char(20) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `date_created`, `patient_id`, `doctor_id`, `status`, `comment`) VALUES
(1, '2018-04-26 14:37:50', 1, 1, '1', 'comment'),
(2, '2018-04-26 14:38:09', 4, 1, '1', 'weleom'),
(3, '2018-04-26 14:38:54', 4, 1, '1', 'Severe Headache'),
(4, '2018-04-26 14:39:54', 4, 1, '1', 'Weleocmen '),
(5, '2018-04-26 15:34:46', 4, 1, '1', 'kdkjf');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `province` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`, `province`) VALUES
(1, 'Bulawayo', 'Bulawayo'),
(2, 'Harare', 'Harare');

-- --------------------------------------------------------

--
-- Table structure for table `disease`
--

CREATE TABLE `disease` (
  `id` int(11) NOT NULL,
  `disease` varchar(100) NOT NULL,
  `notes` varchar(100) NOT NULL,
  `cutoff` varchar(10) NOT NULL,
  `date_created` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `disease`
--

INSERT INTO `disease` (`id`, `disease`, `notes`, `cutoff`, `date_created`) VALUES
(1, 'Malaria', '', '4', '2018-Apr-Mon'),
(2, 'Cholera', '', '4', '2018-Apr-Mon'),
(3, 'Typhoid', '', '3', '2018-Apr-Mon'),
(4, 'Yellow Fever', '', '4', '2018-Apr-Mon'),
(5, 'Ebola', '', '2', '2018-Apr-Mon'),
(6, 'Tuberculosis', '', '4', '2018-Apr-Mon');

-- --------------------------------------------------------

--
-- Table structure for table `facility`
--

CREATE TABLE `facility` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `city_id` int(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facility`
--

INSERT INTO `facility` (`id`, `name`, `city_id`, `address`, `latitude`, `longitude`) VALUES
(1, 'Harare Hospital', 2, '266 Harare Drive Willowvale', -17.8356011, 31.0104234),
(2, 'Chitungwiza General Hospital', 2, 'Chitungwiza Unit K', -18.0130903, 31.0503486),
(3, 'Baines Avenue Clinic', 1, '66 Baines Ave ', -17.8192311, 31.0430568),
(4, 'Bindura General Hospital', 2, '23 Shashi Road Bindura', -17.2978812, 31.3195807),
(5, 'Red Cross Clinic', 1, '99 Cameron Street', -17.8326983, 31.0418788);

-- --------------------------------------------------------

--
-- Table structure for table `future`
--

CREATE TABLE `future` (
  `id` int(11) NOT NULL,
  `symptom` varchar(250) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `found` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `future`
--

INSERT INTO `future` (`id`, `symptom`, `time`, `found`, `user_id`) VALUES
(1, 'fever', '2018-04-24 11:19:29', 1, 4),
(2, 'Jaundice_or_Yellow', '2018-04-24 11:19:35', 1, 4),
(3, 'fatigue', '2018-04-24 11:19:56', 1, 4),
(4, 'Stomach_Pain', '2018-04-24 11:19:59', 1, 4),
(5, 'chest_pain', '2018-04-24 11:20:15', 1, 4),
(6, 'Night_Sweats', '2018-04-24 11:20:19', 1, 4),
(7, 'Constipation', '2018-04-24 18:18:19', 1, 4),
(8, 'Dull_frontal_headache', '2018-04-24 18:18:24', 1, 4),
(9, 'fever', '2018-04-25 20:09:45', 1, 4),
(10, 'Muscle_pain', '2018-04-25 20:09:50', 1, 4),
(11, 'fever', '2018-04-25 20:11:39', 1, 4),
(12, 'Muscle_pain', '2018-04-25 20:11:43', 1, 4),
(13, 'fever', '2018-04-25 20:15:02', 1, 4),
(14, 'Jaundice_or_Yellow', '2018-04-25 20:15:06', 1, 4),
(15, 'Cold', '2018-04-25 20:16:30', 1, 4),
(16, 'Jaundice_or_Yellow', '2018-04-25 20:17:02', 1, 4),
(17, 'fatigue', '2018-04-25 20:17:16', 1, 4),
(18, 'Severe_Headache', '2018-04-25 20:17:20', 1, 4),
(19, 'Night_Sweats', '2018-04-25 20:17:38', 1, 4),
(20, 'Hypotension', '2018-04-25 20:21:50', 1, 4),
(21, 'Jaundice_or_Yellow', '2018-04-25 20:22:01', 1, 4),
(22, 'Slow_Heart_Beat', '2018-04-25 20:22:15', 1, 4),
(23, 'fever', '2018-04-25 20:22:49', 1, 4),
(24, 'Slow_Heart_Beat', '2018-04-25 20:23:05', 1, 4),
(25, 'fever', '2018-04-25 21:33:13', 1, 4),
(26, 'Nausea_and_Vomiting', '2018-04-25 21:33:21', 1, 4),
(27, 'Jaundice_or_Yellow', '2018-04-25 21:33:38', 1, 4),
(28, 'headache', '2018-04-25 21:33:50', 1, 4),
(29, 'Nausea_and_Vomiting', '2018-04-25 21:33:54', 1, 4),
(30, 'Muscle_pain', '2018-04-25 21:34:01', 1, 4),
(31, 'Fever', '2018-04-25 21:34:09', 1, 4),
(32, 'chest_pain', '2018-04-25 21:34:23', 1, 4),
(33, 'Night_Sweats', '2018-04-25 21:34:26', 1, 4),
(34, 'fatigue', '2018-04-25 21:36:54', 1, 4),
(35, 'Cough_up_blood', '2018-04-25 21:37:03', 1, 4),
(36, 'Vomiting', '2018-04-25 21:37:14', 1, 4),
(37, 'fever', '2018-04-26 02:46:35', 1, 4),
(38, 'Headache', '2018-04-26 02:46:43', 1, 4),
(39, 'fatigue', '2018-04-26 02:47:25', 1, 4),
(40, 'Cough_up_blood', '2018-04-26 02:47:32', 1, 4),
(41, 'chest_pain', '2018-04-26 02:47:51', 1, 4),
(42, 'Night_Sweats', '2018-04-26 02:47:55', 1, 4),
(43, 'fever', '2018-04-26 14:21:41', 1, 4),
(44, 'fever', '2018-04-26 14:21:41', 1, 4),
(45, 'Jaundice_or_Yellow', '2018-04-26 14:21:48', 1, 4),
(46, 'fever', '2018-04-26 14:39:32', 1, 4),
(47, 'Nausea_and_Vomiting', '2018-04-26 14:39:36', 1, 4),
(48, 'fatigue', '2018-04-26 15:34:16', 1, 4),
(49, 'Muscle_Pain', '2018-04-26 15:34:21', 1, 4),
(50, 'Abnormal_Pain', '2018-04-26 15:36:24', 1, 4),
(51, 'Severe_Headache', '2018-04-26 15:36:42', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `practitioner`
--

CREATE TABLE `practitioner` (
  `id` int(11) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `contact_details` varchar(250) NOT NULL,
  `date_created` varchar(250) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `facility_id` int(11) NOT NULL,
  `speciality` varchar(250) NOT NULL,
  `disease_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `practitioner`
--

INSERT INTO `practitioner` (`id`, `firstname`, `lastname`, `contact_details`, `date_created`, `gender`, `facility_id`, `speciality`, `disease_id`) VALUES
(1, 'Tafadzwa', 'Mutero', '0775 939 233', '2018-Mar-Mon', 'M', 1, 'Surgeon Doctor', 2),
(2, 'Lee ', 'Kaliyati', '073345732', '', 'M', 3, 'Surgeon', 0),
(3, 'Wadzaanai', 'Mufaro', 'tafadzwa@gmail.com', '', 'F', 5, 'General Practitioner', 0),
(4, 'Tafadzwa', 'Tendekai', '0776 362 638', '2018-Apr-Thu', 'M', 2, '', 0),
(5, 'Eve', 'Beura', '07887 279 27', '2018-Apr-Fri', 'F', 4, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `symptoms`
--

CREATE TABLE `symptoms` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `notes` varchar(250) NOT NULL,
  `date_created` varchar(200) DEFAULT NULL,
  `disease_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `symptoms`
--

INSERT INTO `symptoms` (`id`, `name`, `notes`, `date_created`, `disease_id`) VALUES
(1, 'Fever', 'Fever', '2018-Apr-Mon', 1),
(2, 'Headache', 'Headache', '2018-Apr-Mon', 1),
(3, 'Weakness', 'weakness', '2018-Apr-Mon', 1),
(4, 'Muscle_pain', 'Muscle pain', '2018-Apr-Mon', 1),
(5, 'Cold', 'cold', '2018-Apr-Mon', 1),
(6, 'Nausea_and_Vomiting', 'Nausea and Vomiting', '2018-Apr-Mon', 1),
(7, 'Watery_diarrhea', 'Watery diarrhea', '2018-Apr-Mon', 2),
(8, 'Vomiting', 'Vomiting', '2018-Apr-Mon', 2),
(9, 'Stomach_Pain', 'Stomach Pain', '2018-Apr-Mon', 2),
(10, 'Fatigue', 'Fatigue', '2018-Apr-Mon', 2),
(11, 'High_Fever', 'High Fever', '2018-Apr-Mon', 3),
(12, 'Abnormal_Pain', 'Abnormal Pain', '2018-Apr-Mon', 3),
(13, 'Constipation', 'Constipation', '2018-Apr-Mon', 3),
(14, 'Cough', 'Cough', '2018-Apr-Mon', 3),
(15, 'Dull_frontal_headache', 'Dull frontal headache', '2018-Apr-Mon', 3),
(16, 'Fever', 'Fever', '2018-Apr-Mon', 4),
(17, 'Jaundice_or_Yellow Skin', 'Jaundice or Yellow Skin', '2018-Apr-Mon', 4),
(18, 'Vomiting', 'Vomiting', '2018-Apr-Mon', 4),
(19, 'Hypotension', 'Hypotension', '2018-Apr-Mon', 4),
(20, 'Slow_Heart_Beat', 'Slow Heart Beat', '2018-Apr-Mon', 4),
(21, 'Fever', 'Fever', '2018-Apr-Mon', 5),
(22, 'Muscle_Pain', 'Muscle Pain', '2018-Apr-Mon', 5),
(23, 'Severe_Headache', 'Severe Headache', '2018-Apr-Mon', 5),
(24, 'Weakness', 'Weakness', '2018-Apr-Mon', 5),
(25, 'Fatigue', 'Fatigue', '2018-Apr-Mon', 5),
(26, 'Abnormal_Pain', 'Abnormal Pain', '2018-Apr-Mon', 5),
(27, 'Cough_up_blood', 'Cough up blood', '2018-Apr-Mon', 6),
(28, 'Chest_Pain', 'Chest Pain', '2018-Apr-Mon', 6),
(29, 'Night_Sweats', 'Night Sweats', '2018-Apr-Mon', 6),
(30, 'Fever', 'Fever', '2018-Apr-Mon', 6),
(31, 'Fatigue', 'Fatigue', '2018-Apr-Mon', 6);

-- --------------------------------------------------------

--
-- Table structure for table `tmp`
--

CREATE TABLE `tmp` (
  `name` varchar(250) NOT NULL,
  `city_id` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `distance` decimal(10,3) NOT NULL,
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `facility_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `user_type` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `longitude` decimal(10,6) NOT NULL,
  `latitude` decimal(10,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `user_type`, `password`, `date_create`, `longitude`, `latitude`) VALUES
(2, 'admin', 'admin@gmail.com', 'admin', 'admin', '2018-04-19 02:05:50', '0.000000', '0.000000'),
(3, 't', 't@gmail.com', 'admin', 'e358efa489f58062f10dd7316b65649e', '2018-04-19 02:05:50', '0.000000', '0.000000'),
(4, 'tafadzwa', 'tafadzwa@gmail.com', 'user', '154072a750541f54250de83a125003a4', '2018-04-24 11:20:16', '31.346814', '-17.291441'),
(5, 'tafadzwa', 'tafadzwa@yahoo.com', 'user', '154072a750541f54250de83a125003a4', '2018-04-19 02:05:50', '0.000000', '0.000000'),
(6, 'wadza', 'wadzwa@yahoo.com', 'user', '3a912fdb3a2866feb8f002c72a8f2ae5', '2018-04-19 02:05:50', '0.000000', '0.000000'),
(7, 'tanaka', 'tanaka@gmail.com', 'user', '0292e031195ca50fed149b421c7df329', '2018-04-19 02:05:50', '0.000000', '0.000000'),
(8, 'tafadzwa', 'mutero@gmail.com', 'user', 'e358efa489f58062f10dd7316b65649e', '2018-04-19 02:05:50', '0.000000', '0.000000'),
(11, 'tanaka', 'tanaka@gmail.com', 'user', 'fa6a91ef9baa242de0b354a212e8cf82', '2018-04-21 11:11:37', '31.346800', '-17.291481'),
(12, 'b1440945', 't@yahoo.com', 'user', '92eb5ffee6ae2fec3ad71c777531578f', '2018-04-21 08:27:59', '0.000000', '0.000000'),
(13, 'beura', 'eve@gmail.com', 'user', 'fa6a91ef9baa242de0b354a212e8cf82', '2018-04-23 20:36:09', '0.000000', '0.000000'),
(14, 'eve', 'beuraeve@gmail.com', 'user', 'fa6a91ef9baa242de0b354a212e8cf82', '2018-04-23 20:34:51', '0.000000', '0.000000'),
(15, 'kossam', 'kossam@gmail.com', 'user', 'cdb0cca70d02c44dc6a818deae8f366d', '2018-04-24 03:07:12', '31.346778', '-17.291423');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disease`
--
ALTER TABLE `disease`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facility`
--
ALTER TABLE `facility`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city` (`city_id`);

--
-- Indexes for table `future`
--
ALTER TABLE `future`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `practitioner`
--
ALTER TABLE `practitioner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `facility_id` (`facility_id`),
  ADD KEY `disease_id` (`disease_id`);

--
-- Indexes for table `symptoms`
--
ALTER TABLE `symptoms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `disease_id` (`disease_id`);

--
-- Indexes for table `tmp`
--
ALTER TABLE `tmp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `disease`
--
ALTER TABLE `disease`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `facility`
--
ALTER TABLE `facility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `future`
--
ALTER TABLE `future`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `practitioner`
--
ALTER TABLE `practitioner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `symptoms`
--
ALTER TABLE `symptoms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tmp`
--
ALTER TABLE `tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

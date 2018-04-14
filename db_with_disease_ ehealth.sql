-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2018 at 05:49 AM
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
  `doctor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'Hypertension', 'Heart related disease. Caused by Obesity and lack of exercise', '2', '2018-Mar-Mon'),
(2, 'Stroke', 'Caused by blood clotting in the brain. Stroke is always caused by poor diet, age and stress', '2', '2018-Mar-Mon'),
(3, 'Heart Attach', 'Caused by vessel narrowing. Always caused by poor diet, obese', '2', '2018-Mar-Mon'),
(5, 'Chickenpox', '', '', ''),
(6, 'Hand,Foot and mouth disease', '', '', ''),
(7, 'Head lice(Nits)', '', '', ''),
(8, 'Measles', '', '', ''),
(9, 'Ringworm', '', '', ''),
(10, 'Rubella( German Measles)', '', '', ''),
(11, 'Scabies', '', '', ''),
(12, 'School sores( Impetigo)', '', '', ''),
(13, 'Human parvovirus infection', '', '', ''),
(14, 'Salmonella', '', '', ''),
(15, 'Hepatitis A', '', '', ''),
(16, 'Norovirus', '', '', ''),
(17, 'Rotavirus', '', '', ''),
(18, 'Shigella', '', '', ''),
(19, 'Verocytotoxin', '', '', ''),
(20, 'Influenza', '', '', ''),
(21, 'Streptococcal sore throat', '', '', ''),
(22, 'Whooping cough', '', '', ''),
(23, 'Conjuctivitis', '', '', ''),
(24, 'Meningococcal Meningitis', '', '', ''),
(25, 'Meningitis-Viral', '', '', ''),
(26, 'Mumps', '', '', ''),
(27, 'Non melanoma skin cancer', '', '', ''),
(28, 'Lung cancer', '', '', ''),
(29, 'Breast cancer', '', '', ''),
(30, 'Prostate cancer', '', '', ''),
(31, 'Colon cancer', '', '', ''),
(32, 'Leukemia', '', '', ''),
(33, 'Lymphoma', '', '', ''),
(34, 'Asthma', '', '', ''),
(35, 'Chronic Kidney disease', '', '', ''),
(36, 'Constipation', '', '', ''),
(37, 'Ebola', '', '', '');

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
(1, 'Harare Hospital', 2, '266 Harare Drive Willowvale', -17.8165877, 30.916772),
(2, 'Chitungwiza', 2, 'CHitungwiza Unit K', -17.297353, 31.3427256),
(3, 'Mpilo Hospital', 1, '', -17.8463846, 31.179599),
(4, 'Baines Avenues', 2, '', -17.8165877, 30.916772),
(5, 'Bulawayo Hospital', 1, '', -17.8167823, 30.916772);

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
(1, 'fever', '2018-04-13 06:40:20', 1, 4),
(2, 'fever', '2018-04-13 06:43:05', 1, 4),
(3, 'fever', '2018-04-13 06:44:20', 1, 4),
(4, 'fever', '2018-04-13 06:44:55', 1, 4),
(5, 'fever', '2018-04-13 06:46:30', 1, 4),
(6, 'fever', '2018-04-13 22:25:06', 1, 4),
(7, 'fever', '2018-04-13 22:26:36', 1, 7),
(8, 'fever', '2018-04-13 23:30:08', 1, 7),
(9, 'coughing blood', '2018-04-13 23:30:51', 1, 7),
(10, 'wheezing', '2018-04-13 23:31:28', 1, 7),
(11, 'wheezing', '2018-04-13 23:32:31', 1, 7),
(12, 'wheezing', '2018-04-13 23:33:17', 1, 7),
(13, 'chest pain', '2018-04-13 23:33:36', 1, 7),
(14, 'chest pain', '2018-04-13 23:34:05', 1, 7),
(15, 'fever', '2018-04-13 23:39:21', 1, 7),
(16, 'fever', '2018-04-13 23:40:31', 1, 7),
(17, 'fever', '2018-04-13 23:40:45', 1, 7),
(18, 'fever', '2018-04-13 23:40:56', 1, 7),
(19, 'headache', '2018-04-13 23:41:32', 1, 7),
(20, 'fever', '2018-04-14 03:48:31', 1, 4);

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
(3, 'Wadzaanai', 'Mufaro', 'tafadzwa@gmail.com', '', 'F', 4, 'General Practitioner', 0),
(4, 'Tafadzwa', 'Tendekai', '0776 362 638', '2018-Apr-Thu', 'M', 2, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `symptoms`
--

CREATE TABLE `symptoms` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `notes` varchar(250) NOT NULL,
  `date_created` varchar(200) DEFAULT NULL,
  `disease_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `symptoms`
--

INSERT INTO `symptoms` (`id`, `name`, `notes`, `date_created`, `disease_id`) VALUES
(1, 'Headache', 'strong', '2018-Mar-Mon', 2),
(2, 'Chest Pain', 'chest pain', '2018-Mar-Mon', 1),
(3, 'Loss of appetite', '.', '2018-Mar-Mon', 3),
(4, 'Chest Pain', 'Chest Pain', '2018-Mar-Mon', 2),
(5, 'Fever', '', '2018-Mar-Mon', 5),
(6, 'Fever', '', '2018-Mar-Mon', 6),
(7, 'itchy scalp behind ears', '', '2018-Mar-Mon', 7),
(8, 'runny nose', '', '2018-Mar-Mon', 8),
(9, 'flat and ring shaped rash', '', '2018-Mar-Mon', 9),
(10, 'fever', '', '2018-Mar-Mon', 10),
(11, 'itchy rash', '', '2018-Mar-Mon', 11),
(12, 'blisters on body', '', '2018-Mar-Mon', 12),
(13, 'red cheeks', '', '2018-Mar-Mon', 13),
(14, 'stomach pain', '', '2018-Mar-Mon', 14),
(15, 'Nausea', '', '2018-Mar-Mon', 15),
(16, 'Nausea', '', '2018-Mar-Mon', 16),
(17, 'Nausea', '', '2018-Mar-Mon', 17),
(18, 'bloody diarrhoea', '', '2018-Mar-Mon', 18),
(19, 'bloody diarrhoea', '', '2018-Mar-Mon', 19),
(20, 'fever', '', '2018-Mar-Mon', 20),
(21, 'headache', '', '2018-Mar-Mon', 21),
(22, 'runny nose', '', '2018-Mar-Mon', 22),
(23, 'irritation', '', '2018-Mar-Mon', 23),
(24, 'generally unwell', '', '2018-Mar-Mon', 24),
(25, 'generally unwell', '', '2018-Mar-Mon', 25),
(26, 'pain in jaw', '', '2018-Mar-Mon', 26),
(27, 'sore that doesn\'t heal ', '', '2018-Mar-Mon', 27),
(28, 'persistent and worsening cough', '', '2018-Mar-Mon', 28),
(29, 'lump in breast', '', '2018-Mar-Mon', 29),
(30, 'Frequent urinating', '', '2018-Mar-Mon', 30),
(31, 'unintended weight loss', '', '2018-Mar-Mon', 31),
(32, 'Fever', '', '2018-Mar-Mon', 32),
(33, 'weight loss', '', '2018-Mar-Mon', 33),
(34, 'wheezing', '', '2018-Mar-Mon', 34),
(35, 'weight loss', '', '2018-Mar-Mon', 35),
(36, 'stomach ache and cramps?', '', '2018-Mar-Mon', 36),
(37, 'fever', '', '2018-Mar-Mon', 37),
(38, 'Spots with blister on top of each spot', '', '2018-Mar-Mon', 5),
(39, 'Flue-like', '', '2018-Mar-Mon', 6),
(41, 'eye problems', '', '2018-Mar-Mon', 8),
(43, 'swollen neck glands', '', '2018-Mar-Mon', 10),
(45, 'burst blisters', '', '2018-Mar-Mon', 12),
(46, 'lace-like rash on body', '', '2018-Mar-Mon', 13),
(47, 'fever', '', '2018-Mar-Mon', 14),
(48, 'stomach pains', '', '2018-Mar-Mon', 15),
(49, 'diarrhoea', '', '2018-Mar-Mon', 16),
(50, 'diarrhoea', '', '2018-Mar-Mon', 17),
(51, 'fever', '', '2018-Mar-Mon', 18),
(52, 'stomach pains', '', '2018-Mar-Mon', 19),
(53, 'cough', '', '2018-Mar-Mon', 20),
(54, 'vomiting', '', '2018-Mar-Mon', 21),
(55, 'persistent cough', '', '2018-Mar-Mon', 22),
(56, 'redness of eye', '', '2018-Mar-Mon', 23),
(57, 'fever', '', '2018-Mar-Mon', 24),
(58, 'fever', '', '2018-Mar-Mon', 25),
(59, 'swelling in front of ear', '', '2018-Mar-Mon', 26),
(60, 'pale white scars', '', '2018-Mar-Mon', 27),
(61, 'chest pain', '', '2018-Mar-Mon', 28),
(62, 'change in shape or size of breasts', '', '2018-Mar-Mon', 29),
(63, 'difficulty in starting and holding back urine', '', '2018-Mar-Mon', 30),
(64, 'cramping or abdominal pain', '', '2018-Mar-Mon', 31),
(65, 'persistent fatigue', '', '2018-Mar-Mon', 32),
(66, 'fever', '', '2018-Mar-Mon', 35),
(67, 'shortness of breath', '', '2018-Mar-Mon', 36),
(68, 'poor appetite', '', '2018-Mar-Mon', 37),
(74, 'rash on soles,palms and mouth', '', NULL, 6),
(75, 'cough', '', NULL, 8),
(76, 'rash on face, scalp and body', '', NULL, 10),
(77, 'scabby sores                 ', '', NULL, 12),
(78, 'nausea\r\n', '', NULL, 14),
(79, 'jaundice or yellow', '', NULL, 15),
(80, 'vomiting', '', NULL, 16),
(81, 'vomiting', '', NULL, 17),
(82, 'stomach pain', '', NULL, 18),
(83, 'high rate of hospitalisation and complications', '', NULL, 19),
(84, 'sore throat          ', '', NULL, 20),
(85, 'sore throat', '', NULL, 21),
(86, 'whoop vomiting', '', NULL, 22),
(87, 'headache', '', NULL, 24),
(88, 'headache', '', NULL, 25),
(89, 'fever', '', NULL, 26),
(90, 'scaly red patches', '', NULL, 27),
(91, 'coughing blood', '', NULL, 28),
(92, 'change in skin texture', '', NULL, 29),
(93, 'painful or burning urination', '', NULL, 30),
(94, 'dark stools', '', NULL, 31),
(95, 'easy bleeding', '', NULL, 32),
(96, 'sweating and chills', '', NULL, 33),
(97, 'tight chest ', '', NULL, 34),
(98, 'swollen ankles, feet or hands (due to water retention', '', NULL, 35),
(99, 'feeling sick', '', NULL, 36),
(100, 'joint and muscle pain', '', NULL, 37);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `user_type` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `user_type`, `password`) VALUES
(2, 'admin', 'admin@gmail.com', 'admin', 'admin'),
(3, 't', 't@gmail.com', 'admin', 'e358efa489f58062f10dd7316b65649e'),
(4, 'tafadzwa', 'tafadzwa@gmail.com', 'user', '154072a750541f54250de83a125003a4'),
(5, 'tafadzwa', 'tafadzwa@yahoo.com', 'user', '154072a750541f54250de83a125003a4'),
(6, 'wadza', 'wadzwa@yahoo.com', 'user', '3a912fdb3a2866feb8f002c72a8f2ae5'),
(7, 'tanaka', 'tanaka@gmail.com', 'user', '0292e031195ca50fed149b421c7df329');

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `disease`
--
ALTER TABLE `disease`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `facility`
--
ALTER TABLE `facility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `future`
--
ALTER TABLE `future`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `practitioner`
--
ALTER TABLE `practitioner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `symptoms`
--
ALTER TABLE `symptoms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

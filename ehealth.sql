-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2018 at 11:51 PM
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
(6, 'Tuberculosis', '', '4', '2018-Apr-Mon'),
(7, 'Whooping cough', '', '', '2018-May-Sun'),
(8, 'Measles', '', '', '2018-May-Sun'),
(9, 'Hepatitis A', '', '', '2018-May-Sun'),
(10, 'Influenza', '', '', '2018-May-Sun'),
(11, 'Asthma', '', '', '2018-May-Sun'),
(12, 'Chickenpox', '', '', '2018-May-Sun'),
(13, 'Meningococcal Meningitis', '', '', '2018-May-Sun'),
(14, 'Scabies', '', '', '2018-May-Sun'),
(15, 'Lymphoma', '', '', '2018-May-Sun'),
(16, 'Mumps', '', '', '2018-May-Sun'),
(17, 'Leukemia', '', '', '2018-May-Sun');

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
(1, 'Loss of appetite', 'Fever', '2018-Apr-Mon', 1),
(2, 'Headache', 'Headache', '2018-Apr-Mon', 1),
(3, 'Weakness', 'weakness', '2018-Apr-Mon', 1),
(4, 'Muscle pain', 'Muscle pain', '2018-Apr-Mon', 1),
(5, 'Profuse sweating', 'cold', '2018-Apr-Mon', 1),
(6, 'Nausea and Vomiting', 'Nausea and Vomiting', '2018-Apr-Mon', 1),
(7, 'Watery diarrhea', 'Watery diarrhea', '2018-Apr-Mon', 2),
(8, 'Vomiting', 'Vomiting', '2018-Apr-Mon', 2),
(9, 'Stomach Pain', 'Stomach Pain', '2018-Apr-Mon', 2),
(10, 'Dehydration', 'Dehydration', '2018-Apr-Mon', 2),
(11, 'High Fever', 'High Fever', '2018-Apr-Mon', 3),
(12, 'Abnormal Pain', 'Abnormal Pain', '2018-Apr-Mon', 3),
(13, 'Constipation', 'Constipation', '2018-Apr-Mon', 3),
(14, 'Cough', 'Cough', '2018-Apr-Mon', 3),
(15, 'Dull frontal headache', 'Dull frontal headache', '2018-Apr-Mon', 3),
(16, 'Fever', 'Fever', '2018-Apr-Mon', 4),
(17, 'Jaundice or Yellow Skin', 'Jaundice or Yellow Skin', '2018-Apr-Mon', 4),
(18, 'Vomiting', 'Vomiting', '2018-Apr-Mon', 4),
(19, 'Hypotension', 'Hypotension', '2018-Apr-Mon', 4),
(20, 'Slow Heart Beat', 'Slow Heart Beat', '2018-Apr-Mon', 4),
(21, 'Joint and muscle pain', 'Fever', '2018-Apr-Mon', 5),
(22, 'Severe muscle weakness\r\n', 'Muscle Pain', '2018-Apr-Mon', 5),
(23, 'Severe Headache', 'Severe Headache', '2018-Apr-Mon', 5),
(24, 'Sore throat', 'Weakness', '2018-Apr-Mon', 5),
(25, 'Diarrhoea\r\n', 'Diarrhoea\r\n', '2018-Apr-Mon', 5),
(26, 'Abnormal Pain', 'Abnormal Pain', '2018-Apr-Mon', 5),
(27, 'Cough up blood', 'Cough up blood', '2018-Apr-Mon', 6),
(28, 'Chest Pain', 'Chest Pain', '2018-Apr-Mon', 6),
(29, 'Night Sweats', 'Night Sweats', '2018-Apr-Mon', 6),
(30, 'Chills', 'Chills', '2018-Apr-Mon', 6),
(31, 'Fatigue', 'Fatigue', '2018-Apr-Mon', 6),
(32, 'Runny nose', 'runny nose', '2018-May-Sun', 8),
(33, 'Eye problems', 'eye problems', '2018-May-Sun', 8),
(34, 'Rash\r\n', 'cough', '2018-May-Sun', 8),
(35, 'Rash', 'rash', '2018-May-Sun', 8),
(36, 'Muscular aches', 'muscular aches', '2018-May-Sun', 8),
(37, 'Runny nose', 'runny nose', '2018-May-Sun', 7),
(38, 'Persistent cough', 'persistent cough', '2018-May-Sun', 7),
(39, 'Whoop vomiting', 'whoop vomiting', '2018-May-Sun', 7),
(40, 'Breathlessness', 'breathlessness', '2018-May-Sun', 7),
(41, 'Nausea', 'Nausea', '2018-May-Sun', 9),
(42, 'Stomach pains', 'stomach pains', '2018-May-Sun', 9),
(43, 'Jaundice', 'Jaundice', '2018-May-Sun', 9),
(44, 'Joint pain', 'joint pain', '2018-May-Sun', 9),
(45, 'Low-grade fever', 'Low-grade fever', '2018-May-Sun', 9),
(46, 'Difficulty breathing', 'Difficulty breathing', '2018-May-Sun', 11),
(47, 'Chest tightness', 'Chest tightness', '2018-May-Sun', 11),
(48, 'Shortness of breath', 'Shortness of breath', '2018-May-Sun', 11),
(49, 'Wheezing', 'Wheezing', '2018-May-Sun', 11),
(50, 'Coughing', 'coughing', '2018-May-Sun', 11),
(51, 'Sore throat', 'Sore throat', '2018-May-Sun', 10),
(52, 'Body aches.', 'body aches.', '2018-May-Sun', 10),
(53, 'Headaches', 'Headaches', '2018-May-Sun', 10),
(54, 'Nasal congestion', 'Nasal congestion', '2018-May-Sun', 10),
(55, 'Sneezing', 'sneezing', '2018-May-Sun', 10),
(56, 'Neck stiffness', 'Neck stiffness', '2018-May-Sun', 13),
(57, 'Discomfort in bright lights', 'Discomfort in bright lights', '2018-May-Sun', 13),
(58, 'Difficulty awakening', 'difficulty awakening', '2018-May-Sun', 13),
(59, 'Persistent headache', 'persistent headache', '2018-May-Sun', 13),
(60, 'Joint pain', 'Joint pain', '2018-May-Sun', 13),
(61, 'Soles of the feet', 'soles of the feet', '2018-May-Sun', 14),
(62, 'Itchy rash', 'itchy rash', '2018-May-Sun', 14),
(63, 'Skin rash', 'skin rash', '2018-May-Sun', 14),
(64, 'Sweating and chills', 'sweating and chills', '2018-May-Sun', 15),
(65, 'Chest pain or pressure', 'chest pain or pressure', '2018-May-Sun', 15),
(66, 'shortness of breath', 'shortness of breath', '2018-May-Sun', 15),
(67, 'Swollen abdomen', 'swollen abdomen', '2018-May-Sun', 15),
(68, 'Enlarged lumps', 'enlarged lumps', '2018-May-Sun', 15),
(69, 'Painful salivary glands', 'painful salivary gland', '2018-May-Sun', 16),
(70, 'Swollen', 'Swollen', '2018-May-Sun', 16),
(71, 'Pain in Chewing', 'Pain', '2018-May-Sun', 16),
(72, 'Swelling in front of ear', 'swelling in front of ear', '2018-May-Sun', 16),
(73, 'Swollen lymph nodes', 'Swollen lymph nodes', '2018-May-Sun', 17),
(74, 'Persistent fatigue', 'persistent fatigue', '2018-May-Sun', 17),
(75, 'Recurrent nose bleed', 'recurrent nose bleed', '2018-May-Sun', 17),
(76, 'Bone pains or tenderness', 'bone pains or tenderness', '2018-May-Sun', 17),
(77, 'Easy bleeding', 'easy bleeding', '2018-May-Sun', 17),
(78, 'Cold', '', NULL, 5);

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
(4, 'tafadzwa', 'tafadzwa@gmail.com', 'user', '154072a750541f54250de83a125003a4', '2018-05-06 21:51:33', '31.346804', '-17.291407'),
(5, 'tafadzwa', 'tafadzwa@yahoo.com', 'user', '154072a750541f54250de83a125003a4', '2018-04-19 02:05:50', '0.000000', '0.000000'),
(6, 'wadza', 'wadzwa@yahoo.com', 'user', '3a912fdb3a2866feb8f002c72a8f2ae5', '2018-04-19 02:05:50', '0.000000', '0.000000'),
(7, 'tanaka', 'tanaka@gmail.com', 'user', '0292e031195ca50fed149b421c7df329', '2018-04-19 02:05:50', '0.000000', '0.000000'),
(8, 'tafadzwa', 'mutero@gmail.com', 'user', 'e358efa489f58062f10dd7316b65649e', '2018-04-19 02:05:50', '0.000000', '0.000000'),
(11, 'tanaka', 'tanaka@gmail.com', 'user', 'fa6a91ef9baa242de0b354a212e8cf82', '2018-04-21 11:11:37', '31.346800', '-17.291481'),
(12, 'b1440945', 't@yahoo.com', 'user', '92eb5ffee6ae2fec3ad71c777531578f', '2018-04-21 08:27:59', '0.000000', '0.000000'),
(13, 'beura', 'eve@gmail.com', 'user', 'fa6a91ef9baa242de0b354a212e8cf82', '2018-04-23 20:36:09', '0.000000', '0.000000'),
(14, 'eve', 'beuraeve@gmail.com', 'user', 'fa6a91ef9baa242de0b354a212e8cf82', '2018-04-23 20:34:51', '0.000000', '0.000000'),
(15, 'kossam', 'kossam@gmail.com', 'user', 'cdb0cca70d02c44dc6a818deae8f366d', '2018-04-24 03:07:12', '31.346778', '-17.291423'),
(16, 'Lee', 'lee@gmail.com', 'user', 'b0f8b49f22c718e9924f5b1165111a67', '2018-05-06 21:15:56', '31.346788', '-17.291418'),
(17, 'Kossam', 'kossam@gmail.com', 'user', 'cdb0cca70d02c44dc6a818deae8f366d', '2018-05-06 21:17:58', '31.346787', '-17.291411');

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
  ADD UNIQUE KEY `symptom` (`symptom`),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `facility`
--
ALTER TABLE `facility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `future`
--
ALTER TABLE `future`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=293;

--
-- AUTO_INCREMENT for table `practitioner`
--
ALTER TABLE `practitioner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `symptoms`
--
ALTER TABLE `symptoms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `tmp`
--
ALTER TABLE `tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=576;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

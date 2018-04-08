-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2018 at 09:33 PM
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
  `who_stage` varchar(10) NOT NULL,
  `date_created` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `disease`
--

INSERT INTO `disease` (`id`, `disease`, `notes`, `who_stage`, `date_created`) VALUES
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
(1, 'Harare Hospital', 2, '266 Harare Drive Willowvale', 31.200092, 31.235712),
(2, 'Chitungwiza', 2, '', -17.297353, 31.3427256),
(3, 'Mpilo Hospital', 1, '', -17.2797353, 33.5427256),
(4, 'Baines Avenues', 2, '', -15.297353, 31.3427256),
(5, 'Bulawayo Hospital', 1, '', -13.297353, 21.3427256);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `title`, `description`) VALUES
(1, 'ddd', 'ddd'),
(2, 'ddd', 'ddd');

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
(3, 'Wadzaanai', 'Mufaro', 'tafadzwa@gmail.com', '', 'F', 4, 'General Practitioner', 0);

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
(1, 'Headache', 'strong', '2018-Mar-Fri', 2),
(2, 'Chest Pain', 'chest pain', '2018-Mar-Fri', 1),
(3, 'Loss of appetite', '.', '2018-Mar-Fri', 3),
(4, 'Chest Pain', 'Chest Pain', NULL, 2),
(5, 'Fever', '', NULL, 5),
(6, 'Fever', '', NULL, 6),
(7, 'itchy scalp behind ears', '', NULL, 7),
(8, 'runny nose', '', NULL, 8),
(9, 'flat and ring shaped rash', '', NULL, 9),
(10, 'fever', '', NULL, 10),
(11, 'itchy rash', '', NULL, 11),
(12, 'blisters on body', '', NULL, 12),
(13, 'red cheeks', '', NULL, 13),
(14, 'stomach pain', '', NULL, 14),
(15, 'Nausea', '', NULL, 15),
(16, 'Nausea', '', NULL, 16),
(17, 'Nausea', '', NULL, 17),
(18, 'bloody diarrhoea', '', NULL, 18),
(19, 'bloody diarrhoea', '', NULL, 19),
(20, 'fever', '', NULL, 20),
(21, 'headache', '', NULL, 21),
(22, 'runny nose', '', NULL, 22),
(23, 'irritation', '', NULL, 23),
(24, 'generally unwell', '', NULL, 24),
(25, 'generally unwell', '', NULL, 25),
(26, 'pain in jaw', '', NULL, 26),
(27, 'sore that doesn\'t heal ', '', NULL, 27),
(28, 'persistent and worsening cough', '', NULL, 28),
(29, 'lump in breast', '', NULL, 29),
(30, 'Frequent urinating', '', NULL, 30),
(31, 'unintended weight loss', '', NULL, 31),
(32, 'Fever', '', NULL, 32),
(33, 'weight loss', '', NULL, 33),
(34, 'wheezing', '', NULL, 34),
(35, 'weight loss', '', NULL, 35),
(36, 'stomach ache and cramps?', '', NULL, 36),
(37, 'fever', '', NULL, 37);

-- --------------------------------------------------------

--
-- Table structure for table `table 8`
--

CREATE TABLE `table 8` (
  `COL 1` varchar(27) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `table 8`
--

INSERT INTO `table 8` (`COL 1`) VALUES
('disease'),
('Chickenpox'),
('Hand,Foot and mouth disease'),
('Head lice(Nits)'),
('Measles'),
('Ringworm'),
('Rubella( German Measles)'),
('Scabies'),
('School sores( Impetigo)'),
('Human parvovirus infection'),
('Salmonella'),
('Hepatitis A'),
('Norovirus'),
('Rotavirus'),
('Shigella'),
('Verocytotoxin'),
('Influenza'),
('Streptococcal sore throat'),
('Whooping cough'),
('Conjuctivitis'),
('Meningococcal Meningitis'),
('Meningitis-Viral'),
('Mumps'),
('Non melanoma skin cancer'),
('Lung cancer'),
('Breast cancer'),
('Prostate cancer'),
('Colon cancer'),
('Leukemia'),
('Lymphoma'),
('Asthma'),
('Chronic Kidney disease'),
('Constipation'),
('Ebola');

-- --------------------------------------------------------

--
-- Table structure for table `table 9`
--

CREATE TABLE `table 9` (
  `COL 1` varchar(27) DEFAULT NULL,
  `COL 2` varchar(50) DEFAULT NULL,
  `COL 3` varchar(45) DEFAULT NULL,
  `COL 4` varchar(67) DEFAULT NULL,
  `COL 5` varchar(58) DEFAULT NULL,
  `COL 6` varchar(51) DEFAULT NULL,
  `COL 7` varchar(45) DEFAULT NULL,
  `COL 8` varchar(27) DEFAULT NULL,
  `COL 9` varchar(51) DEFAULT NULL,
  `COL 10` varchar(18) DEFAULT NULL,
  `COL 11` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `table 9`
--

INSERT INTO `table 9` (`COL 1`, `COL 2`, `COL 3`, `COL 4`, `COL 5`, `COL 6`, `COL 7`, `COL 8`, `COL 9`, `COL 10`, `COL 11`) VALUES
('Disease', 'Symptom 1', 'Symptom 2', 'Symptom 3', 'Symptom 4', 'Symptom 5', 'Symptom 6', 'Symptom 7', 'Symptom 8', 'Symptom 9 ', 'Symptom 10'),
('Chickenpox', 'Fever', 'Spots with blister on top of each spot', '', '', '', '', '', '', '', ''),
('Hand,Foot and mouth disease', 'Fever', 'Flue-like', 'rash on soles,palms and mouth ', '', '', '', '', '', '', ''),
('Head lice(Nits)', 'itchy scalp behind ears', '', '', '', '', '', '', '', '', ''),
('Measles', 'runny nose', 'eye problems', 'cough', 'fever', 'rash', '', '', '', '', ''),
('Ringworm', 'flat and ring shaped rash', '', '', '', '', '', '', '', '', ''),
('Rubella( German Measles)', 'fever', 'swollen neck glands', 'rash on face, scalp and body', '', '', '', '', '', '', ''),
('Scabies', 'itchy rash', '', '', '', '', '', '', '', '', ''),
('School sores( Impetigo)', 'blisters on body', 'burst blisters', 'scabby sores', '', '', '', '', '', '', ''),
('Human parvovirus infection', 'red cheeks', 'lace-like rash on body', '', '', '', '', '', '', '', ''),
('Salmonella', 'stomach pain', 'fever', 'nausea', 'diarrhoea', 'vomiting', '', '', '', '', ''),
('Hepatitis A', 'Nausea', 'stomach pains', 'jaundice or yellow', '', '', '', '', '', '', ''),
('Norovirus', 'Nausea', 'diarrhoea', 'vomiting', '', '', '', '', '', '', ''),
('Rotavirus', 'Nausea', 'diarrhoea', 'vomiting', '', '', '', '', '', '', ''),
('Shigella', 'bloody diarrhoea', 'fever', 'stomach pain', '', '', '', '', '', '', ''),
('Verocytotoxin', 'bloody diarrhoea', 'stomach pains', 'high rate of hospitalisation and complications', '', '', '', '', '', '', ''),
('Influenza', 'fever', 'cough', 'sore throat', 'muscular aches', 'headache', '', '', '', '', ''),
('Streptococcal sore throat', 'headache', 'vomiting', 'sore throat', 'rheumatic fever', '', '', '', '', '', ''),
('Whooping cough', 'runny nose', 'persistent cough', 'whoop vomiting', 'breathlessness', '', '', '', '', '', ''),
('Conjuctivitis', 'irritation', 'redness of eye', '', '', '', '', '', '', '', ''),
('Meningococcal Meningitis', 'generally unwell', 'fever', 'headache', 'vomiting', 'rash', '', '', '', '', ''),
('Meningitis-Viral', 'generally unwell', 'fever', 'headache', 'vomiting', '', '', '', '', '', ''),
('Mumps', 'pain in jaw', 'swelling in front of ear', 'fever', '', '', '', '', '', '', ''),
('Non melanoma skin cancer', 'sore that doesn?t heal or comes back after healing', 'pale white scars', 'scaly red patches', 'smallsmooth shiny lumps that are pearly white, pink or red', 'pink growth that has small blood vessels on surface', 'sore that bleeds', 'an itchy growth', '', '', ''),
('Lung cancer', 'persistent and worsening cough', 'chest pain', 'coughing blood', 'shortness of breath', 'wheezing', 'hoarseness of the voice', 'difficulty swallowing', 'loss of appetite', 'weight loss', 'fatigue'),
('Breast cancer', 'lump in breast', 'change in shape or size of breasts', 'change in skin texture', 'colour change in breasts', 'change in nipples', 'nipple discharge', 'nipple rash or crusting', '', '', ''),
('Prostate cancer', 'Frequent urinating', 'difficulty in starting and holding back urine', 'painful or burning urination', 'difficulty in erection', 'blood in urine or semen', 'painful ejaculation', '', '', '', ''),
('Colon cancer', 'unintended weight loss', 'cramping or abdominal pain', 'dark stools', 'blood in stool', 'rectal bleeding', 'diarrhoea', 'constipation', '', '', ''),
('Leukemia', 'Fever', 'persistent fatigue', 'easy bleeding ', 'recurrent nose bleed', 'bone pains or tenderness', 'tiny red spots on skin', 'excessive sweating at night', 'weight loss', 'persistent fatigue', ''),
('Lymphoma', 'weight loss', 'fever', 'sweating and chills', 'chest pain or pressure', 'shortness of breath or cough', 'feelin full after taking small amount of food', 'swollen abdomen', 'enlarged lumps', '', ''),
('Asthma', 'wheezing (a whistling sound when you breathe)', 'shortness of breath', 'a tight chest ? which may feel like?a band is tightening around?it?', 'coughing', '', '', '', '', '', ''),
('Chronic Kidney disease', 'weight loss', 'poor appetite', 'swollen ankles, feet or hands (due to water retention)?', 'shortness of breath?', 'muscle cramps', 'nausea', 'erectile dysfunction?', 'an increased need to urinate, particularly at night', 'itchy skin', 'nausea'),
('Constipation', 'stomach ache and cramps?', 'feeling bloated', 'feeling?sick', 'loss of appetite', 'difficult to pass stools', 'dry, hard and lumpy stool', '', '', '', ''),
('Ebola', 'fever', '?headache', 'joint and muscle pain', 'sore throat', 'severe muscle weakness', 'Diarrhoea', '?vomiting', 'rash', 'stomach pain', '');

-- --------------------------------------------------------

--
-- Table structure for table `table 10`
--

CREATE TABLE `table 10` (
  `COL 1` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `table 10`
--

INSERT INTO `table 10` (`COL 1`) VALUES
('Fever'),
('Fever'),
('itchy scalp behind ears'),
('runny nose'),
('flat and ring shaped rash'),
('fever'),
('itchy rash'),
('blisters on body'),
('red cheeks'),
('stomach pain'),
('Nausea'),
('Nausea'),
('Nausea'),
('bloody diarrhoea'),
('bloody diarrhoea'),
('fever'),
('headache'),
('runny nose'),
('irritation'),
('generally unwell'),
('generally unwell'),
('pain in jaw'),
('sore that doesn?t heal or comes back after healing'),
('persistent and worsening cough'),
('lump in breast'),
('Frequent urinating'),
('unintended weight loss'),
('Fever'),
('weight loss'),
('wheezing (a whistling sound when you breathe)'),
('weight loss'),
('stomach ache and cramps?'),
('fever');

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
(5, 'tafadzwa', 'tafadzwa@yahoo.com', 'user', '154072a750541f54250de83a125003a4');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `practitioner`
--
ALTER TABLE `practitioner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `symptoms`
--
ALTER TABLE `symptoms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

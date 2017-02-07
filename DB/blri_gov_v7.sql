-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 09, 2016 at 04:42 PM
-- Server version: 5.6.28
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blri_gov`
--

-- --------------------------------------------------------

--
-- Table structure for table `blri_admin`
--

CREATE TABLE `blri_admin` (
  `blri_admin_id` int(50) NOT NULL,
  `blri_admin_name` varchar(50) NOT NULL,
  `blri_admin_username` varchar(100) NOT NULL,
  `blri_admin_password` varchar(150) NOT NULL,
  `blri_admin_phone_number` varchar(20) NOT NULL,
  `blri_admin_NID` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blri_admin`
--

INSERT INTO `blri_admin` (`blri_admin_id`, `blri_admin_name`, `blri_admin_username`, `blri_admin_password`, `blri_admin_phone_number`, `blri_admin_NID`) VALUES
(1, 'BlRI Blri', 'blri@gmail.com', 'bb54cd4c784378e2ceb3af53b95127cc', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `blri_applicant`
--

CREATE TABLE `blri_applicant` (
  `applicant_id` int(200) NOT NULL,
  `applicant_name` varchar(100) NOT NULL,
  `applicant_date_of_birth` varchar(30) NOT NULL,
  `applicant_father_name` varchar(100) NOT NULL,
  `applicant_NID` varchar(50) NOT NULL,
  `applicant_mobile` varchar(20) NOT NULL,
  `applicant_email` varchar(100) NOT NULL,
  `applicant_village` varchar(50) NOT NULL,
  `applicant_post_office` varchar(50) NOT NULL,
  `applicant_district_id` int(20) NOT NULL,
  `applicant_subdistrict_id` int(20) NOT NULL,
  `applicant_course_id` int(100) NOT NULL DEFAULT '0',
  `applicant_photo` varchar(200) NOT NULL,
  `finally_submitted` tinyint(9) NOT NULL DEFAULT '0',
  `application_date` varchar(100) NOT NULL,
  `applicant_is_enrolled` tinyint(3) NOT NULL DEFAULT '0',
  `applicant_is_passed` tinyint(3) NOT NULL DEFAULT '0',
  `applicant_is_trashed` tinyint(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blri_applicant`
--

INSERT INTO `blri_applicant` (`applicant_id`, `applicant_name`, `applicant_date_of_birth`, `applicant_father_name`, `applicant_NID`, `applicant_mobile`, `applicant_email`, `applicant_village`, `applicant_post_office`, `applicant_district_id`, `applicant_subdistrict_id`, `applicant_course_id`, `applicant_photo`, `finally_submitted`, `application_date`, `applicant_is_enrolled`, `applicant_is_passed`, `applicant_is_trashed`) VALUES
(34, 'আরাফাত', '25/10/2016', 'fdsf', 'fdsf', '01687127823', '', 'fsdfdsf', 'fdsfdsf', 2, 1, 5, '13241138_781825218584826_4462034292391027226_n.jpg', 1, '2016-01-10', 1, 1, 0),
(42, 'zabeer', '14-10-2016', 'test', 'test', '01687127823', '', 'test', 'test', 2, 1, 5, '13241138_781825218584826_4462034292391027226_n.jpg', 1, '2016-08-10', 0, 0, 0),
(43, 'zara', '19-10-2016', 'harun', 'test', '01687127832', '', 'deliaie', 'deliaie', 2, 1, 5, '13173664_214688512247949_3962250314405501304_n.jpg', 1, '2016-10-10', 1, 1, 1),
(45, 'aftab', '25/10/2016', 'fdsfdsf', 'sdfsdf', '01687127823', '', 'fdfsdsf', 'fdsfdsf', 1, 3, 5, '13173664_214688512247949_3962250314405501304_n.jpg', 1, '2016-10-10', 0, 0, 0),
(48, 'harun', '25/10/2016', 'fdsf', 'fdsf', '01687127823', '', 'fdfsdsf', 'fdsfdsf', 2, 5, 4, '13312917_1039493796133202_1809505278339915411_n.jpg', 1, '2016-02-02', 1, 1, 1),
(50, 'Tanbir', '13-10-2016', 'fdsfdsf', 'fdsf', '01687127823', '', 'fdfsdsf', 'fdsfdsf', 2, 1, 5, 'tanbir_pp.jpg', 1, '2016-10-25', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `blri_applicant_forms`
--

CREATE TABLE `blri_applicant_forms` (
  `applicant_form_id` bigint(30) NOT NULL,
  `applicant_form_name` varchar(100) NOT NULL,
  `applicant_form_file_name` varchar(200) NOT NULL,
  `applicant_form_file_created` datetime NOT NULL,
  `applicant_form_file_modified` datetime NOT NULL,
  `applicant_form_is_active` tinyint(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blri_applicant_forms`
--

INSERT INTO `blri_applicant_forms` (`applicant_form_id`, `applicant_form_name`, `applicant_form_file_name`, `applicant_form_file_created`, `applicant_form_file_modified`, `applicant_form_is_active`) VALUES
(1, 'Application Form', '887.pdf', '2016-11-18 00:00:00', '2016-11-18 00:00:00', 0),
(2, 'Application Forms', 'CV_of_Ibrahim_Arafat_Software-Engineer_(Japan).pdf', '2016-11-18 00:00:00', '2016-11-18 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `blri_course`
--

CREATE TABLE `blri_course` (
  `course_id` int(100) NOT NULL,
  `course_name` varchar(120) NOT NULL,
  `course_description` text,
  `course_start_date` varchar(50) NOT NULL,
  `course_end_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blri_course`
--

INSERT INTO `blri_course` (`course_id`, `course_name`, `course_description`, `course_start_date`, `course_end_date`) VALUES
(4, 'dfds', '', '27-09-2016', '06-10-2016'),
(5, 'গরু মোটা তাজা করন', 'গরু মোটা তাজা করন', '29-09-2016', '29-12-2016');

-- --------------------------------------------------------

--
-- Table structure for table `blri_course_instructor`
--

CREATE TABLE `blri_course_instructor` (
  `instructor_id` int(50) NOT NULL,
  `course_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blri_course_instructor`
--

INSERT INTO `blri_course_instructor` (`instructor_id`, `course_id`) VALUES
(1, 4),
(2, 4),
(1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `blri_district`
--

CREATE TABLE `blri_district` (
  `district_id` int(100) NOT NULL,
  `district_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blri_district`
--

INSERT INTO `blri_district` (`district_id`, `district_name`) VALUES
(1, 'বরগুনা'),
(2, 'বরিশাল'),
(3, 'ভোলা'),
(4, 'ঝালকাঠি'),
(5, 'পটুয়াখালী'),
(6, 'পিরোজপুর'),
(7, 'বান্দরবান'),
(8, 'ব্রাহ্মণবাড়িয়া'),
(9, 'চাঁদপুর'),
(10, 'চট্টগ্রাম'),
(11, 'কুমিল্লা'),
(12, 'কক্সবাজার'),
(13, 'ফেনী'),
(14, 'খাগড়াছড়ি'),
(15, 'লক্ষ্মীপুর'),
(16, 'নোয়াখালী'),
(17, 'রাঙ্গামাটি'),
(18, 'ঢাকা'),
(19, 'ফরিদপুর'),
(20, 'গাজীপুর'),
(21, 'গোপালগঞ্জ'),
(22, 'জামালপুর');

-- --------------------------------------------------------

--
-- Table structure for table `blri_instructor`
--

CREATE TABLE `blri_instructor` (
  `instructor_id` int(80) NOT NULL,
  `instructor_name` varchar(100) NOT NULL,
  `instructor_email` varchar(100) NOT NULL,
  `instructor_phone_number` varchar(15) NOT NULL,
  `instructor_organization` varchar(50) NOT NULL,
  `instructor_designation` varchar(50) DEFAULT NULL,
  `instructor_photo` varchar(100) NOT NULL,
  `course_count` int(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blri_instructor`
--

INSERT INTO `blri_instructor` (`instructor_id`, `instructor_name`, `instructor_email`, `instructor_phone_number`, `instructor_organization`, `instructor_designation`, `instructor_photo`, `course_count`) VALUES
(1, 'Harun Rashid', 'harun.bin.illius@gmail.com', '01944416535', 'Family', 'Chariman', 'resample(lanczos).jpeg', 2),
(2, 'test', 'test@gmail.com', '01944416535', 'fsdfdsfd', 'fdsfdsfsf', 'chartwell_new_option_add_1.jpg', 1),
(3, 'test', 'test@tg.com', '01988816535', 'test', 'test', 'Screen_Shot_2016-08-16_at_4_53_32_PM.png', 0),
(4, 'test', 'test@g.com', '01687128978', 'tests', 'test', 'BDNationalFlag.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `blri_sub_district`
--

CREATE TABLE `blri_sub_district` (
  `sub_district_id` int(20) NOT NULL,
  `sub_district_name` varchar(100) NOT NULL,
  `district_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blri_sub_district`
--

INSERT INTO `blri_sub_district` (`sub_district_id`, `sub_district_name`, `district_id`) VALUES
(1, 'আমতলী', 2),
(2, 'বামনা', 2),
(3, 'বরগুনা সদর', 1),
(4, 'বেতাগী', 2),
(5, 'পাথরঘাটা', 2),
(6, 'তালতলি', 2),
(7, 'আগৈলঝাড়াs', 3),
(8, 'বাবুগঞ্জ', 4),
(9, 'বাকেরগঞ্জ', 4),
(10, 'বানারীপাড়া', 4),
(11, 'গৌরনদী', 4),
(12, 'হিজলা', 5),
(13, 'বরিশাল সদর (কোতোয়ালী)', 5),
(14, 'মেহেন্দিগঞ্জ', 5),
(15, 'মুলাদী', 5),
(16, 'উজিরপুর', 6),
(17, 'ভোলা সদর', 6),
(18, 'বোরহানউদ্দিন', 7),
(19, 'দৌলতখান', 1),
(20, 'লালমোহন', 11),
(21, 'মনপুরা', 12),
(22, 'তজুমদ্দিন', 0),
(23, 'ঝালকাঠি সদর', 0),
(24, 'নলছিটি', 0),
(25, 'কাঠালিয়া', 0),
(27, 'দশমিনা', 0),
(28, 'দুমকি', 0),
(29, 'কলাপাড়া', 0),
(30, 'মির্জাগঞ্জ', 0),
(31, 'বাউফল', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blri_admin`
--
ALTER TABLE `blri_admin`
  ADD PRIMARY KEY (`blri_admin_id`);

--
-- Indexes for table `blri_applicant`
--
ALTER TABLE `blri_applicant`
  ADD PRIMARY KEY (`applicant_id`);

--
-- Indexes for table `blri_applicant_forms`
--
ALTER TABLE `blri_applicant_forms`
  ADD PRIMARY KEY (`applicant_form_id`);

--
-- Indexes for table `blri_course`
--
ALTER TABLE `blri_course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `blri_course_instructor`
--
ALTER TABLE `blri_course_instructor`
  ADD KEY `course_id` (`course_id`,`instructor_id`);

--
-- Indexes for table `blri_district`
--
ALTER TABLE `blri_district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `blri_instructor`
--
ALTER TABLE `blri_instructor`
  ADD PRIMARY KEY (`instructor_id`);

--
-- Indexes for table `blri_sub_district`
--
ALTER TABLE `blri_sub_district`
  ADD PRIMARY KEY (`sub_district_id`),
  ADD KEY `district_id` (`district_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blri_admin`
--
ALTER TABLE `blri_admin`
  MODIFY `blri_admin_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `blri_applicant`
--
ALTER TABLE `blri_applicant`
  MODIFY `applicant_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `blri_applicant_forms`
--
ALTER TABLE `blri_applicant_forms`
  MODIFY `applicant_form_id` bigint(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `blri_course`
--
ALTER TABLE `blri_course`
  MODIFY `course_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `blri_district`
--
ALTER TABLE `blri_district`
  MODIFY `district_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `blri_instructor`
--
ALTER TABLE `blri_instructor`
  MODIFY `instructor_id` int(80) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `blri_sub_district`
--
ALTER TABLE `blri_sub_district`
  MODIFY `sub_district_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

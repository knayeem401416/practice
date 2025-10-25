-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2025 at 07:15 AM
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
-- Database: `bu_tech`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(255) NOT NULL,
  `name` varchar(20) NOT NULL,
  `num` varchar(255) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `name`, `num`, `subject`, `message`) VALUES
(6, 'sheoti', '1233445656', 'cu', 'saddad'),
(10, 'Fahim ', '32323', 'Mentor Info', 'Need Rifat Sir Info'),
(11, 'Rimu', '2225556', 'tryhgjghjt', 'ghndthgkjhjk,'),
(14, '233', '2147483647', 'dzxcx', 'xczcdxszc'),
(15, '2323', '32322332323', '3232323232323232323232323', '2323232323');

-- --------------------------------------------------------

--
-- Table structure for table `notice_board`
--

CREATE TABLE `notice_board` (
  `notice_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `date_posted` date NOT NULL,
  `posted_by` int(11) NOT NULL,
  `priority_level` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notice_board`
--

INSERT INTO `notice_board` (`notice_id`, `title`, `content`, `date_posted`, `posted_by`, `priority_level`) VALUES
(32, 'Mentor notice 1', 'Outside Dhaka', '0000-00-00', 54, 'mid'),
(33, 'Director 1st Notice', 'Long time Holiday', '0000-00-00', 51, 'high');

-- --------------------------------------------------------

--
-- Table structure for table `notice_review`
--

CREATE TABLE `notice_review` (
  `notice_review_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `date_posted` datetime NOT NULL,
  `posted_by` int(11) NOT NULL,
  `priority_level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notice_review`
--

INSERT INTO `notice_review` (`notice_review_id`, `title`, `content`, `date_posted`, `posted_by`, `priority_level`) VALUES
(23, 'Mentor notice 1', 'Outside Dhaka', '0000-00-00 00:00:00', 54, 'mid'),
(24, 'Director 1st Notice', 'Long time Holiday', '0000-00-00 00:00:00', 51, 'high'),
(25, '5retaeryer', 'hgdthuyjtdyhuj', '0000-00-00 00:00:00', 54, 'mid');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL,
  `project_title` varchar(255) NOT NULL,
  `mentor_id` int(11) NOT NULL,
  `student_id1` int(11) NOT NULL,
  `student_id2` int(11) DEFAULT NULL,
  `student_id3` int(11) DEFAULT NULL,
  `student_id4` int(11) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `submission_date` date NOT NULL,
  `approval_date` date NOT NULL,
  `pdf` varchar(300) NOT NULL,
  `comment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_registration`
--

CREATE TABLE `student_registration` (
  `reg_id` int(11) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_registration`
--

INSERT INTO `student_registration` (`reg_id`, `f_name`, `l_name`, `contact`, `password`, `dob`, `age`, `gender`, `type`, `profile_pic`, `status`) VALUES
(7, 'ppp', 'qqq', '23123123131', 'aaa', '2025-10-03', 21, 'M', 'Student', 'uploads/1761369136_DEF-005.PNG', 'Approved'),
(8, 'ddd', 'sss', '21312312313', 'www', '2025-10-15', 23, 'F', 'Student', 'uploads/1761369160_DEF-002_01.PNG', 'Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(5) NOT NULL,
  `f_name` varchar(10) NOT NULL,
  `l_name` varchar(10) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `password` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `type` varchar(10) NOT NULL,
  `profile_pic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `f_name`, `l_name`, `contact`, `password`, `dob`, `age`, `gender`, `type`, `profile_pic`) VALUES
(40, 'Sheoti', 'Khanam', '6453', 'sheoti', '0000-00-00', 40, 'F', 'Officer', 'uploads/3220811593_user3.jpg'),
(50, 'Zara', 'Akter', '345262', 'zara', '0000-00-00', 45, 'M', 'Mentor', 'uploads/1712311593_user4.jpg'),
(51, 'Nazmul', 'Hossain', '1234567', 'nazmul', '0000-00-00', 34, 'M', 'Director', 'uploads/1131313593_user5.jpg'),
(52, 'Fahim', 'Ahmed', '366986986', 'fahim', '0000-00-00', 23, 'M', 'Student', 'uploads/1760811789_user2.jpg'),
(53, 'Aqib', 'Khan', '45673', 'aqib', '0000-00-00', 23, 'M', 'Student', 'uploads/1760843433_user1.jpg'),
(54, 'Nayeem', 'Khan', '23123', 'nayeem', '2019-11-19', 34, 'M', 'Mentor', 'uploads/1760811593_user6.jpg'),
(69, 'ppp', 'qqq', '23123123131', 'aaa', '2025-10-03', 21, 'M', 'Student', 'uploads/1761369136_DEF-005.PNG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `notice_board`
--
ALTER TABLE `notice_board`
  ADD PRIMARY KEY (`notice_id`),
  ADD KEY `fk_posted_by_user` (`posted_by`);

--
-- Indexes for table `notice_review`
--
ALTER TABLE `notice_review`
  ADD PRIMARY KEY (`notice_review_id`),
  ADD KEY `posted_by` (`posted_by`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `mentor_id` (`mentor_id`),
  ADD KEY `student_id1` (`student_id1`),
  ADD KEY `student_id2` (`student_id2`),
  ADD KEY `student_id3` (`student_id3`,`student_id4`);

--
-- Indexes for table `student_registration`
--
ALTER TABLE `student_registration`
  ADD PRIMARY KEY (`reg_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `notice_board`
--
ALTER TABLE `notice_board`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `notice_review`
--
ALTER TABLE `notice_review`
  MODIFY `notice_review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `student_registration`
--
ALTER TABLE `student_registration`
  MODIFY `reg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notice_board`
--
ALTER TABLE `notice_board`
  ADD CONSTRAINT `fk_posted_by_user` FOREIGN KEY (`posted_by`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `notice_review`
--
ALTER TABLE `notice_review`
  ADD CONSTRAINT `notice_review_ibfk_1` FOREIGN KEY (`posted_by`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`mentor_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `projects_ibfk_2` FOREIGN KEY (`student_id1`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `projects_ibfk_3` FOREIGN KEY (`student_id2`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2025 at 06:25 PM
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
  `num` int(20) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `name`, `num`, `subject`, `message`) VALUES
(6, 'sheoti', 1233445656, 'cu', 'saddad'),
(7, 'Sheoti', 23132, 'con1', 'sadda'),
(8, 'Sheoti', 23132, 'con1', 'adada'),
(9, 'Sheoti', 23132, 'con1', 'ddd');

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
(27, 'this', '         adsadasdsadadas         ', '0000-00-00', 50, 'mid'),
(28, 'THAT', 'hhhhhhhhhhhhhhhhhhhhhhhhh                  ', '0000-00-00', 50, 'high'),
(29, 'test', 'test1', '0000-00-00', 51, 'high'),
(30, 'sdd', 'sdds', '0000-00-00', 51, 'high'),
(31, 'Not in Office', 'Outside Dhaka', '0000-00-00', 51, 'low');

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
(19, 'test', 'test1', '0000-00-00 00:00:00', 50, 'high'),
(20, 'test2', 'test1234', '0000-00-00 00:00:00', 51, 'mid'),
(21, 'Not in Office ', 'Outside Dhaka', '0000-00-00 00:00:00', 51, 'low'),
(22, 'dsd', 'dsd', '0000-00-00 00:00:00', 51, 'high');

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
  `status` varchar(10) NOT NULL,
  `submission_date` date NOT NULL,
  `approval_date` date NOT NULL,
  `pdf` varchar(300) NOT NULL,
  `comment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `project_title`, `mentor_id`, `student_id1`, `student_id2`, `student_id3`, `student_id4`, `status`, `submission_date`, `approval_date`, `pdf`, `comment`) VALUES
(33, 'trail1', 50, 52, NULL, NULL, NULL, 'Approved', '0000-00-00', '0000-00-00', 'Sheoti.CV.pdf', 'dsds'),
(34, 'trail2', 50, 53, 52, NULL, NULL, 'Rejected', '0000-00-00', '0000-00-00', 'Sheoti_202221063026_Algorithm_Lab.pdf', 'add more figure'),
(35, 'trail3', 50, 53, NULL, NULL, NULL, 'Rechecked', '0000-00-00', '0000-00-00', 'Sheoti_202221063026_Project.pdf', NULL),
(36, 'trail4', 50, 53, NULL, NULL, NULL, 'Rechecked', '0000-00-00', '0000-00-00', 'Sheoti_202221063026_Project_2.pdf', NULL),
(37, 'trail5', 50, 52, 53, NULL, NULL, 'Approved', '0000-00-00', '0000-00-00', 'Sheoti.CV.pdf', NULL),
(40, 'dasd', 50, 52, NULL, NULL, NULL, 'Rejected', '0000-00-00', '0000-00-00', 'Sheoti_202221063026_Algorithm_Lab.pdf', 'so many ai'),
(41, 'dfsdfafaf', 50, 52, NULL, NULL, NULL, 'Rechecked', '0000-00-00', '0000-00-00', 'Sheoti.CV.pdf', 'fff'),
(42, 'fasfafaf', 54, 52, 53, NULL, NULL, 'Approved', '0000-00-00', '0000-00-00', 'Sheoti_202221063026_Project_2.pdf', NULL),
(43, 'dadafafa', 50, 52, NULL, NULL, NULL, 'Rechecked', '0000-00-00', '0000-00-00', 'Sheoti_202221063026_Project.pdf', 'ddd'),
(44, 'gdgfdfg', 50, 52, NULL, NULL, NULL, 'Approved', '0000-00-00', '0000-00-00', 'Sheoti_202221063026_Algorithm_Lab.pdf', NULL),
(45, 'dadada', 54, 52, 53, NULL, NULL, 'Approved', '0000-00-00', '0000-00-00', 'Sheoti.CV.pdf', NULL),
(46, 'dadadda', 50, 52, NULL, NULL, NULL, 'Rejected', '0000-00-00', '0000-00-00', 'Sheoti_202221063026_Project_2.pdf', 'do proper data'),
(47, 'addad', 50, 52, NULL, NULL, NULL, 'Approved', '0000-00-00', '0000-00-00', 'Sheoti_202221063026_Project.pdf', NULL),
(48, 'gsdfdf', 50, 52, NULL, NULL, NULL, 'Rechecked', '0000-00-00', '0000-00-00', 'Sheoti_202221063026_Project.pdf', 'do it more example'),
(55, 'project1', 54, 62, NULL, NULL, NULL, 'Rejected', '0000-00-00', '0000-00-00', 'Sheoti_202221063026_Project.pdf', 'not good project'),
(56, 'project2', 54, 62, NULL, NULL, NULL, 'Approved', '0000-00-00', '0000-00-00', 'Sheoti.CV.pdf', 'not good project'),
(57, 'project3', 54, 62, NULL, NULL, NULL, 'Rechecked', '0000-00-00', '0000-00-00', 'Sheoti_202221063026_Algorithm_Lab.pdf', 'Ai detect'),
(58, 'dad', 50, 62, NULL, NULL, NULL, 'Pending', '0000-00-00', '0000-00-00', 'Sheoti_202221063026_Project_2.pdf', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(5) NOT NULL,
  `f_name` varchar(10) NOT NULL,
  `l_name` varchar(10) NOT NULL,
  `contact` int(11) NOT NULL,
  `password` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `type` varchar(10) NOT NULL,
  `profile_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `f_name`, `l_name`, `contact`, `password`, `dob`, `age`, `gender`, `type`, `profile_pic`) VALUES
(40, 'Sheoti', 'Khanam', 6453, 'sheoti', '0000-00-00', 40, 'F', 'Officer', 'uploads/3220811593_user3.jpg'),
(50, 'Zara', 'Akter', 345262, 'zara', '0000-00-00', 45, 'M', 'Mentor', 'uploads/1712311593_user4.jpg'),
(51, 'Nazmul', 'Hossain', 1234567, 'nazmul', '0000-00-00', 34, 'M', 'Director', 'uploads/1131313593_user5.jpg'),
(52, 'Fahim', 'Ahmed', 366986986, 'fahim', '0000-00-00', 23, 'M', 'Student', 'uploads/1760811789_user2.jpg'),
(53, 'Aqib', 'Khan', 45673, 'aqib', '0000-00-00', 23, 'M', 'Student', 'uploads/1760843433_user1.jpg'),
(54, 'Nayeem', 'Khan', 23123, 'nayeem', '2019-11-19', 34, 'M', 'Mentor', 'uploads/1760811593_user6.jpg'),
(62, 'Jahid', 'Khan', 32443, 'jahid', '2025-10-01', 21, 'M', 'Student', 'uploads/1760948404_user7.jpg');

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
  MODIFY `contact_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `notice_board`
--
ALTER TABLE `notice_board`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `notice_review`
--
ALTER TABLE `notice_review`
  MODIFY `notice_review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

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

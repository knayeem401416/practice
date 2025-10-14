-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2023 at 09:47 AM
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
-- Database: `iub_tech_360`
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
(28, 'THAT', 'hhhhhhhhhhhhhhhhhhhhhhhhh                  ', '0000-00-00', 50, 'high');

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
(13, 'NORICE REQ 1', '                  THIS IS TRIAL', '0000-00-00 00:00:00', 50, 'high'),
(15, 'asdsd', 'kjfghjklfghsdk                  ', '0000-00-00 00:00:00', 50, 'mid');

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
  `status` varchar(10) NOT NULL,
  `submission_date` date NOT NULL,
  `approval_date` date NOT NULL,
  `pdf` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `project_title`, `mentor_id`, `student_id1`, `student_id2`, `status`, `submission_date`, `approval_date`, `pdf`) VALUES
(29, 'traial 1', 50, 52, 53, 'Approved', '0000-00-00', '0000-00-00', 'Surds.pdf'),
(30, 'Trial 2', 50, 53, 52, 'Rejected', '0000-00-00', '0000-00-00', 'A2_CSE307_AUT23_2120009_2120757_2022459_2120756_2121028_SM_Aqib_Hossain_Fahim_Ahmed_Atikul_Islam_Nayeem_Khan_Rizwan_Mohammad_Chowdhury (1).pdf'),
(32, 'TRIAL 3', 50, 53, 52, 'Rechecked', '0000-00-00', '0000-00-00', 'SMAqibHossain_Assignment9.pdf');

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
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `f_name`, `l_name`, `contact`, `password`, `dob`, `age`, `gender`, `type`) VALUES
(40, 'Aqib ', 'Uddin', 6453, 'aqibuddin', '0000-00-00', 40, 'F', 'Officer'),
(49, 'Rizwan', 'Chow', 56, 'rizwan', '0000-00-00', 23, 'F', 'Trainer'),
(50, 'Nayeem', 'Khan', 345262, 'nayeem', '0000-00-00', 45, 'M', 'Mentor'),
(51, 'Nayeem', 'Hossain', 1234567, 'hossain', '0000-00-00', 34, 'M', 'Director'),
(52, 'Fahim', 'Ahmed', 366986986, 'fahim', '0000-00-00', 23, 'M', 'Student'),
(53, 'Aqib', 'Khan', 45673, 'aqib1', '0000-00-00', 23, 'M', 'Student');

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
  ADD KEY `student_id2` (`student_id2`);

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
  MODIFY `contact_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notice_board`
--
ALTER TABLE `notice_board`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `notice_review`
--
ALTER TABLE `notice_review`
  MODIFY `notice_review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

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
